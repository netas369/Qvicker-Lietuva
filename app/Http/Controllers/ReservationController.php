<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
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
        ]);

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
        $reservation->save();

        // Redirect with success message
        return redirect()->route('reservations.seeker')->with('success', 'Jūsų užklausa išsiųsta. Meistras peržiūrės ją artimiausiu metu.');
    }

    /**
     * Display seeker's reservations
     */
    public function seekerReservations()
    {
        $reservations = Reservation::where('seeker_id', Auth::id())
            ->with('provider')
            ->orderBy('created_at', 'desc')
            ->get();

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

        $query = Reservation::where('provider_id', Auth::id())
            ->with('seeker')
            ->orderBy('created_at', 'desc');

        // Filter by status if not showing all
        if ($status !== 'all') {
            $query->where('status', $status);
        }

        $reservations = $query->get();

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

        return redirect()->route('reservations.seeker')->with('success', 'Užklausa sėkmingai atšaukta.');
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

        $reservation->status = 'accepted';
        $reservation->save();

        return redirect()->route('reservations.provider')->with('success', 'Užklausa sėkmingai patvirtinta.');
    }

    /**
     * Decline a reservation
     */
    public function decline($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Ensure the provider can only decline their own reservations
        if (Auth::id() != $reservation->provider_id) {
            return redirect()->back()->with('error', 'Neturite teisių atmesti šios užklausos.');
        }

        // Only allow declining pending reservations
        if ($reservation->status != 'pending') {
            return redirect()->back()->with('error', 'Galima atmesti tik laukiančias užklausas.');
        }

        $reservation->status = 'declined';
        $reservation->save();

        return redirect()->route('reservations.provider')->with('success', 'Užklausa atmesta.');
    }

    /**
     * Mark a reservation as completed
     */
    public function complete($id)
    {
        $reservation = Reservation::findOrFail($id);

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

        return redirect()->route('reservations.provider')->with('success', 'Užklausa pažymėta kaip užbaigta.');
    }

    public function modify($id)
    {
        $reservation = Reservation::findOrFail($id);

        // Check if the reservation belongs to the authenticated provider
        if (auth()->user()->id !== $reservation->provider_id) {
            abort(403, 'Unauthorized action. This reservation does not belong to you.');
        }

        return view('reservations.modify-reservation-providers.modify-reservation', compact('reservation'));
    }
}
