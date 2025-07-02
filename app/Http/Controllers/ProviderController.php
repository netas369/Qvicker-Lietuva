<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config;

class ProviderController extends Controller
{
    public function dashboard()
    {
        return view('provider.dashboard');
    }

    public function calendar()
    {
        return view('profile.calendar');
    }

    public function work()
    {
        return view('profile.work');
    }

    public function support()
    {
        return view('profile.provider-support');
    }

    /**
     * Handle support form submission
     */
    public function sendSupport(Request $request)
    {
        // Validate the form data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:2|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20|regex:/^[\+\d\s\-\(\)]+$/',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:5000',
            'priority' => 'required|in:low,normal,high,urgent'
        ], [
            // Name validation messages
            'name.required' => 'Vardas ir pavardė yra privalomi.',
            'name.string' => 'Vardas ir pavardė turi būti tekstas.',
            'name.min' => 'Vardas ir pavardė turi būti bent :min simboliai.',
            'name.max' => 'Vardas ir pavardė negali būti ilgesni nei :max simbolių.',

            // Email validation messages
            'email.required' => 'El. pašto adresas yra privalomas.',
            'email.email' => 'Įveskite teisingą el. pašto adresą.',
            'email.max' => 'El. pašto adresas negali būti ilgesnis nei :max simbolių.',

            // Phone validation messages
            'phone.string' => 'Telefono numeris turi būti tekstas.',
            'phone.max' => 'Telefono numeris negali būti ilgesnis nei :max simbolių.',
            'phone.regex' => 'Įveskite teisingą telefono numerio formatą.',

            // Subject validation messages
            'subject.required' => 'Tema yra privaloma.',
            'subject.string' => 'Tema turi būti tekstas.',
            'subject.max' => 'Tema negali būti ilgesnė nei :max simbolių.',

            // Message validation messages
            'message.required' => 'Žinutė yra privaloma.',
            'message.string' => 'Žinutė turi būti tekstas.',
            'message.min' => 'Žinutė turi būti bent :min simbolių.',
            'message.max' => 'Žinutė negali būti ilgesnė nei :max simbolių.',

            // Priority validation messages
            'priority.required' => 'Prioritetas yra privalomas.',
            'priority.in' => 'Pasirinkite tinkamą prioritetą (žemas, normalus, aukštas arba skubus).'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Check mail configuration first
        if (!$this->checkMailConfiguration()) {
            Log::error('Mail configuration is incomplete');
            return redirect()->back()
                ->with('error', 'Mail sistema šiuo metu nepasiekiama. Prašome susisiekti tiesiogiai: info@qvicker.lt')
                ->withInput();
        }

        try {
            // Prepare email data
            $emailData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone ?? 'Nenurodytas',
                'subject' => $request->subject,
                'user_message' => $request->message, // Changed from 'message' to 'user_message'
                'priority' => $request->priority,
                'priority_label' => $this->getPriorityLabel($request->priority),
                'priority_color' => $this->getPriorityColor($request->priority),
                'user_id' => auth()->id() ?? 'Neprisijungęs',
                'submitted_at' => now()->format('Y-m-d H:i:s'),
                'user_agent' => $request->userAgent(),
                'ip_address' => $request->ip()
            ];

            // Log attempt
            Log::info('Attempting to send provider support email', [
                'user_id' => auth()->id(),
                'email' => $request->email,
                'subject' => $request->subject,
                'priority' => $request->priority
            ]);

            // Send email to support with more robust error handling
            $supportEmailSent = false;
            try {
                Mail::send('emails.provider-support', $emailData, function ($message) use ($emailData) {
                    $message->to('info@qvicker.lt', 'Qvicker Support')
                        ->subject('[PARTNERIO PALAIKYMAS] ' . $emailData['subject'])
                        ->from(Config::get('mail.from.address'), Config::get('mail.from.name'))
                        ->replyTo($emailData['email'], $emailData['name']);

                    // Set priority header based on priority level
                    $priorityMap = [
                        'low' => '5',
                        'normal' => '3',
                        'high' => '2',
                        'urgent' => '1'
                    ];

                    $headers = $message->getHeaders();
                    $headers->addTextHeader('X-Priority', $priorityMap[$emailData['priority']]);

                    // Add urgency flag for urgent messages
                    if ($emailData['priority'] === 'urgent') {
                        $headers->addTextHeader('X-MSMail-Priority', 'High');
                        $headers->addTextHeader('Importance', 'High');
                    }
                });
                $supportEmailSent = true;
                Log::info('Support email sent successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send support email', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            // Send confirmation email to user
            $confirmationEmailSent = false;
            try {
                Mail::send('emails.provider-support-confirmation', $emailData, function ($message) use ($emailData) {
                    $message->to($emailData['email'], $emailData['name'])
                        ->subject('Patvirtinimas: Jūsų užklausa gauta - ' . $emailData['subject'])
                        ->from(Config::get('mail.from.address'), Config::get('mail.from.name'));
                });
                $confirmationEmailSent = true;
                Log::info('Confirmation email sent successfully');
            } catch (\Exception $e) {
                Log::error('Failed to send confirmation email', [
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }

            // Log the support request for tracking
            Log::info('Provider support request processed', [
                'user_id' => auth()->id(),
                'email' => $request->email,
                'subject' => $request->subject,
                'priority' => $request->priority,
                'ip_address' => $request->ip(),
                'support_email_sent' => $supportEmailSent,
                'confirmation_email_sent' => $confirmationEmailSent
            ]);

            // Determine response message based on what succeeded
            if ($supportEmailSent) {
                $message = 'Jūsų užklausa sėkmingai išsiųsta! Mes su jumis susisieksime per 24 valandas.';
                if (!$confirmationEmailSent) {
                    $message .= ' (Patvirtinimo laiškas nepavyko išsiųsti, bet jūsų užklausa buvo gauta)';
                }
                return redirect()->back()->with('success', $message);
            } else {
                // If support email failed, but we got here, show partial success
                return redirect()->back()
                    ->with('error', 'Atsiprašome, įvyko klaida siunčiant žinutę. Prašome bandyti dar kartą arba susisiekti tiesiogiai el. paštu: info@qvicker.lt')
                    ->withInput();
            }

        } catch (\Exception $e) {
            // Log the error
            Log::error('Provider support email sending failed with exception', [
                'user_id' => auth()->id(),
                'email' => $request->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return redirect()->back()
                ->with('error', 'Atsiprašome, įvyko klaida siunčiant žinutę. Prašome bandyti dar kartą arba susisiekti tiesiogiai el. paštu: info@qvicker.lt')
                ->withInput();
        }
    }

    /**
     * Check if mail configuration is properly set
     */
    private function checkMailConfiguration()
    {
        $requiredConfigs = [
            'mail.default',
            'mail.from.address',
            'mail.from.name'
        ];

        foreach ($requiredConfigs as $config) {
            if (empty(Config::get($config))) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get priority label in Lithuanian
     */
    private function getPriorityLabel($priority)
    {
        $labels = [
            'low' => 'Žemas',
            'normal' => 'Normalus',
            'high' => 'Aukštas',
            'urgent' => 'Skubus'
        ];

        return $labels[$priority] ?? 'Normalus';
    }

    /**
     * Get priority color for styling
     */
    private function getPriorityColor($priority)
    {
        $colors = [
            'low' => '#10B981',     // Green
            'normal' => '#3B82F6',  // Blue
            'high' => '#F59E0B',    // Orange
            'urgent' => '#EF4444'   // Red
        ];

        return $colors[$priority] ?? '#3B82F6';
    }
}
