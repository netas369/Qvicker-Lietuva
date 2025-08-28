<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\Notification;
use App\Models\Reservation;
use App\Models\Review;
use App\Models\Unavailability;
use App\Models\User;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    /**
     * Store a new reservation request.
     */
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'provider_id' => 'required|exists:users,id',
            'description' => 'required|string|min:10',
            'address' => 'required|string',
            'phone' => 'required|string',
            'date' => 'required|date|after_or_equal:today',
            'task_size' => 'required|string|in:small,medium,big',
            'subcategory' => 'nullable|string',
            'city' => 'required|string',
            ], [
            'description.required' => 'Užduoties aprašymas yra privalomas.',
            'description.min' => 'Užduoties aprašymas turi būti bent 10 simbolių ilgio.',
            'address.required' => 'Adresas yra privalomas.',
            'phone.required' => 'Telefono numeris yra privalomas.',
            'date.required' => 'Data yra privaloma.',
            'date.after_or_equal' => 'Data negali būti praeityje.',
            'city.required' => 'Miestas yra privalomas.',
        ]);


        $subcategoryPricing = DB::table('user_subcategory')
            ->join('categories', 'user_subcategory.subcategory_id', '=', 'categories.id')
            ->where('user_subcategory.user_id', $validated['provider_id'])
            ->where('categories.subcategory', $validated['subcategory'])
            ->select('user_subcategory.price', 'user_subcategory.type')
            ->first();

        // Create the reservation
        $reservation = new Reservation();
        $reservation->seeker_id = Auth::id(); // Current logged in user (seeker)
        $reservation->provider_id = $validated['provider_id'];
        $reservation->reservation_date = $validated['date'];
        $reservation->description = $validated['description'];
        $reservation->address = $validated['address'];
        $reservation->phone = $validated['phone'];
        $reservation->task_size = $validated['task_size'];
        $reservation->subcategory = $validated['subcategory'] ?? null;
        $reservation->city = $validated['city'];
        $reservation->status = 'pending';
        $reservation->price = $subcategoryPricing->price;
        $reservation->type = $subcategoryPricing->type;

        $reservation->save();

        $seeker = Auth::user();
        $this->notificationService->notifyNewReservation($reservation->provider, $reservation->seeker, $reservation);

        // Redirect with success message
        return redirect()->route('reservation.modifySeeker', [$reservation->id])->with('success', 'Jūsų užklausa išsiųsta. Meistras peržiūrės ją artimiausiu metu.');
    }

    /**
     * Display seeker's reservations
     */
    public function seekerReservations(Request $request)
    {
        $status = $request->query('status', 'all');
        $perPage = $request->query('per_page', 10);

        $query = Reservation::where('seeker_id', Auth::id())
            ->with('provider')
            ->orderBy('created_at', 'desc');

        if ($status !== 'all')
        {
            $query->where('status', $status);
        }

        $reservations = $query->paginate($perPage);

        $reservations->appends($request->query());

        return view('reservations.seeker', compact('reservations'));
    }

    /**
     * Display provider's reservations
     */
    /**
     * Display provider's reservations
     */
    public function providerReservations(Request $request)
    {

        $status = $request->query('status', 'all');
        $perPage = $request->query('per_page', 10);

        $query = Reservation::where('provider_id', Auth::id())
            ->with('seeker')
            ->orderBy('created_at', 'desc');

        // Filter by status if not showing all
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $reservations = $query->paginate($perPage);

        $reservations->appends($request->query());

        return view('reservations.provider', compact('reservations'));
    }

    /**
     * Cancel a reservation request
     */
    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Make sure the user can only cancel their own reservations
        if (Auth::id() != $reservation->seeker_id) {
            return redirect()->back()->with('error', 'Neturite teisių atšaukti šios užklausos.');
        }

        // Only allow cancellation of pending reservations
        if ($reservation->status != 'pending') {
            return redirect()->back()->with('error', 'Galima atšaukti tik laukiančias užklausas.');
        }

        // Update the status to canceled instead of deleting
        $reservation->status = 'canceled';
        $reservation->save();

        return redirect()->back()->with('success', 'Užklausa sėkmingai atšaukta.');
    }

    /**
     * Accept a reservation
     */
    public function accept($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Ensure the provider can only accept their own reservations
        if (Auth::id() != $reservation->provider_id) {
            return redirect()->back()->with('error', 'Neturite teisių patvirtinti šios užklausos.');
        }

        // Only allow accepting pending reservations
        if ($reservation->status != 'pending') {
            return redirect()->back()->with('error', 'Galima patvirtinti tik laukiančias užklausas.');
        }

        $this->notificationService->notifySeekerReservationAccepted($reservation);

        $reservation->status = 'accepted';
        $reservation->accepted_at = now();

        $reservation->save();

        return redirect()->back()->with('success', 'Užklausa sėkmingai patvirtinta.');
    }

    /**
     * Decline a reservation
     */
    public function declineSeeker($id)
    {
        $reservation = Reservation::findOrFail($id);

         //Ensure the seeker can only decline their own reservations
        if (Auth::id() != $reservation->seeker_id) {
            return redirect()->back()->with('error', 'Neturite teisių atmesti šios užklausos.');
        }

        // Only allow declining pending reservations
        if ($reservation->status != 'pending') {
            return redirect()->back()->with('error', 'Galima atmesti tik laukiančias užklausas.');
        }

        $reservation->status = 'declined';
        $reservation->save();

        $this->notificationService->notifySeekerCanceledReservation($reservation);

        if (Auth::id() == $reservation->seeker_id)
        {
            return redirect()->back()->with('success', 'Užklausa atšaukta.');
        } else if(Auth::id() !== $reservation->seeker_id){
            return redirect()->back()->with('success', 'Užklausa atšaukta.');
        }
    }

    public function declineProvider($id)
    {
        $reservation = Reservation::findOrFail($id);
        if (Auth::id() != $reservation->provider_id) {
            return redirect()->back()->with('error', 'Neturite teisių atmesti šios užklausos.');
        }

        // Only allow declining pending reservations
        if ($reservation->status != 'pending') {
            return redirect()->back()->with('error', 'Galima atmesti tik laukiančias užklausas.');
        }

        $reservation->status = 'declined';
        $reservation->save();

        $this->notificationService->notifyProviderCanceledReservation($reservation);

//        $declineMessage = 'Sveiki, ' . ucfirst($reservation->seeker->name) . ' jūsų ūžklausa atšaukta, kadangi ..... ';
//        $message = new Message([
//            'reservation_id' => $reservation->id,
//            'sender_id' => Auth::id(),
//            'sender_type' => 'provider',
//            'message' => $declineMessage,
//        ]);
//        $message->save();

        if (Auth::id() == $reservation->provider_id)
        {
            return redirect()->back()->with('success', 'Užklausa atmesta.');
        } else if(Auth::id() !== $reservation->seeker_id){
            return redirect()->back()->with('success', 'Užklausa atmesta.');
        }
    }

    /**
     * Mark a reservation as completed
     */
    public function complete($id)
    {
        $reservation = Reservation::findOrFail($id);
        $current_time = Carbon::now()->format('Y-m-d');
        $reservation_date = $reservation->reservation_date;


        if ($current_time < $reservation_date) {
            return redirect()->back()->with('error', 'Užklausą galima užbaigti tik rezervacijos dieną arba vėliau.');
        }

        // Ensure the provider can only complete their own reservations
        if (Auth::id() != $reservation->provider_id) {
            return redirect()->back()->with('error', 'Neturite teisių užbaigti šios užklausos.');
        }

        // Only allow completing accepted reservations
        if ($reservation->status != 'accepted') {
            return redirect()->back()->with('error', 'Galima užbaigti tik patvirtintas užklausas.');
        }

        $reservation->status = 'completed';
        $reservation->save();

        $this->notificationService->notifyReservationCompleted($reservation);

        return redirect()->back()->with('success', 'Užklausa pažymėta kaip užbaigta.');
    }

    public function modifyProvider($id)
    {
        $reservation = Reservation::findOrFail($id);

        $reviewIsLeft = Review::where('reservation_id', $reservation->id)->first();

        // Check if the reservation belongs to the authenticated provider
        if (auth()->user()->id !== $reservation->provider_id) {
            abort(403, 'Unauthorized action. This reservation does not belong to you.');
        }

        // Get subcategory ID from reservation
        $subcategoryId = null;
        if ($reservation->subcategory) {
            $subcategoryRecord = \App\Models\Category::where('subcategory', $reservation->subcategory)->first();
            if ($subcategoryRecord) {
                $subcategoryId = $subcategoryRecord->id;
            }
        }

        // Load authenticated provider (current user) with pricing information
        $provider = auth()->user();
        if ($subcategoryId) {
            $provider->load(['categories' => function($query) use ($subcategoryId) {
                $query->where('categories.id', $subcategoryId);
            }]);

            // Prepare pricing information for the authenticated provider
            $this->preparePricingInfo($provider, $subcategoryId);
        }

        return view('reservations.modify-reservation-providers.modify-reservation', compact('reservation', 'reviewIsLeft', 'provider'));
    }


    public function modifySeeker($id)
    {
        $reservation = Reservation::findOrFail($id);
        $user = auth()->user();

        // Check if the reservation belongs to the authenticated seeker
        if (auth()->user()->id !== $reservation->seeker_id) {
            abort(403, 'Unauthorized action. This reservation does not belong to you.');
        }

        // Get subcategory ID from reservation
        $subcategoryId = null;
        if ($reservation->subcategory) {
            $subcategoryRecord = \App\Models\Category::where('subcategory', $reservation->subcategory)->first();
            if ($subcategoryRecord) {
                $subcategoryId = $subcategoryRecord->id;
            }
        }

        // Load provider with pricing information if we have a provider and subcategory
        if ($reservation->provider && $subcategoryId) {
            $reservation->provider->load(['categories' => function($query) use ($subcategoryId) {
                $query->where('categories.id', $subcategoryId);
            }]);

            // Prepare pricing information
            $this->preparePricingInfo($reservation->provider, $subcategoryId);
        }

        return view('reservations.modify-reservation-seeker.modify-reservation', compact('reservation', 'user'));
    }

    /**
     * Prepare pricing information for a provider
     */
    private function preparePricingInfo($provider, $subcategoryId)
    {
        $provider->pricing_info = null;

        if ($subcategoryId) {
            $pivotData = $provider->categories->where('id', $subcategoryId)->first();
            if ($pivotData && $pivotData->pivot) {
                $provider->pricing_info = [
                    'price' => $pivotData->pivot->price,
                    'type' => $pivotData->pivot->type,
                    'experience' => $pivotData->pivot->experience,
                    'formatted_price' => number_format($pivotData->pivot->price, 2),
                    'type_label_full' => $this->getPriceTypeLabel($pivotData->pivot->type, false),
                    'type_label_short' => $this->getPriceTypeLabel($pivotData->pivot->type, true)
                ];
            }
        }
    }

    /**
     * Get price type label
     */
    private function getPriceTypeLabel($type, $short = false)
    {
        if ($short) {
            switch ($type) {
                case 'hourly':
                    return '/val.';
                case 'fixed':
                    return '(fiks.)';
                case 'meter':
                    return '/m';
                default:
                    return '';
            }
        } else {
            switch ($type) {
                case 'hourly':
                    return '/ val.';
                case 'fixed':
                    return '(fiksuotas)';
                case 'meter':
                    return '/ m';
                default:
                    return '';
            }
        }
    }

    public function editProvider($id, Request $request)
    {
        // Eager load relationships to avoid N+1 queries
        $reservation = Reservation::with(['seeker', 'provider'])->findOrFail($id);

        if(Auth::id() !== $reservation->provider_id){
            abort(403, 'Unauthorized action. This reservation does not belong to you.');
        }

        $validated = $request->validate([
            'date' => 'required|date',
            'price' => 'required|numeric|min:0|max:1000'
        ]);

        // Store old values for comparison
        $oldReservationDate = $reservation->reservation_date;
        $oldPrice = $reservation->price;

        // Update reservation
        $reservation->price = $validated['price'];
        $reservation->reservation_date = $validated['date'];
        $reservation->save();

        // Prepare changes array for event
        $changes = [];
        if($oldPrice != $reservation->price) {
            $changes['price'] = ['old' => $oldPrice, 'new' => $reservation->price];
        }
        if($oldReservationDate != $reservation->reservation_date) {
            $changes['date'] = ['old' => $oldReservationDate, 'new' => $reservation->reservation_date];
        }

        // Dispatch single event if there are changes
        if (!empty($changes)) {
            event(new \App\Events\ReservationUpdated($reservation, $changes));
        }

        return redirect()->back()->with('success', 'Rezervacijos duomenys sėkmingai atnaujinti.');
    }
}
