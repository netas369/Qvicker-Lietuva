<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naujas užsakymas - Qvicker</title>
</head>
<body style="margin: 0; padding: 0; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif; background-color: #f8fafc; color: #374151; line-height: 1.6;">

<div style="max-width: 600px; margin: 0 auto; background-color: white;">

    <!-- Header with Logo -->
    <div style="background-color: white; padding: 2rem; border-bottom: 1px solid #e5e7eb; text-align: center;">
        <div style="font-size: 2rem; font-weight: bold; color: #266867;">
            Q<span style="color: #1A4645;">vicker</span><span style="color: #6b7280; font-size: 0.75rem; margin-left: 0.25rem;">LT</span>
        </div>
    </div>

    <!-- Main Content -->
    <div style="padding: 2rem;">
        <h1 style="font-size: 1.5rem; font-weight: bold; color: #266867; margin-bottom: 1rem; text-align: center;">
            🎯 Naujas užsakymas, {{ ucfirst($notifiable->name) }}!
        </h1>

        <p style="margin-bottom: 2rem; text-align: center; color: #6b7280; font-size: 1.125rem;">
            Gavote naują užsakymą nuo kliento <strong style="color: #266867;">{{ $reservation->seeker->name }}</strong>
        </p>

        <!-- Order Details Card -->
        <div style="background-color: #f0f9ff; border: 1px solid #7dd3fc; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #0369a1; font-size: 1.125rem; font-weight: 600;">
                📋 Užsakymo informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📍 Miestas:</span>
                <span style="color: #266867; font-weight: 500;">{{ $reservation->city }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📅 Data:</span>
                <span style="color: #266867; font-weight: 500;">{{ $reservation->reservation_date }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📏 Darbo dydis:</span>
                <span style="color: #266867; font-weight: 500; text-transform: capitalize;">{{ $reservation->task_size }}</span>
            </div>

            @if($reservation->subcategory)
                <div style="margin-bottom: 0.75rem;">
                    <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">🏷️ Kategorija:</span>
                    <span style="color: #266867; font-weight: 500;">{{ $reservation->subcategory }}</span>
                </div>
            @endif
        </div>

        <!-- Contact Details Card -->
        <div style="background-color: #f0fdf4; border: 1px solid #86efac; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #166534; font-size: 1.125rem; font-weight: 600;">
                📞 Kontaktinė informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">👤 Vardas:</span>
                <span style="color: #166534; font-weight: 500;">{{ $reservation->seeker->name }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📞 Telefonas:</span>
                <span style="color: #166534; font-weight: 500;">Matoma Patvirtinus Rezervaciją</span>
            </div>

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px; vertical-align: top;">📍 Adresas:</span>
                <span style="color: #166534; font-weight: 500;">{{ $reservation->address }}</span>
            </div>
        </div>

        <!-- Description Card -->
        <div style="background-color: #fefce8; border: 1px solid #fde047; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #ca8a04; font-size: 1.125rem; font-weight: 600;">
                📝 Užduoties aprašymas
            </h3>
            <p style="margin: 0; color: #713f12; font-weight: 500; line-height: 1.5;">
                {{ $reservation->description }}
            </p>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ route('reservation.modify', $reservation->id) }}"
               style="display: inline-block; background-color: #266867; color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 600; font-size: 1.125rem;">
                📱 Peržiūrėti ir valdyti užsakymą
            </a>
        </div>

        <!-- Urgency Notice -->
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 0.5rem; padding: 1rem; margin: 2rem 0; text-align: center;">
            <p style="margin: 0; color: #dc2626; font-weight: 600;">
                ⚡ Prašome kuo greičiau atsakyti į šią užklausą!
            </p>
            <p style="margin: 0.5rem 0 0 0; color: #991b1b; font-size: 0.875rem;">
                Klientas laukia jūsų atsakymo. Greitas atsakymas pagerina jūsų reputaciją platformoje.
            </p>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background-color: #f3f4f6; border-radius: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <p style="margin: 0 0 0.5rem 0;"><strong>Negalite paspausti mygtuko?</strong></p>
            <p style="margin: 0 0 0.5rem 0;">Nukopijuokite ir įklijuokite šią nuorodą į savo naršyklę:</p>
            <p style="margin: 0; word-break: break-all; color: #266867;">{{ route('reservation.modify', $reservation->id) }}</p>
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 2rem 0;"></div>

    </div>

    <!-- Footer -->
    <div style="background-color: #f8fafc; padding: 2rem; text-align: center; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">
        <p style="margin: 0 0 0.5rem 0;"><strong>Qvicker</strong> - Jūsų patikimas partneris paslaugų srityje</p>
        <p style="margin: 0 0 0.5rem 0;">© {{ date('Y') }} Qvicker. Visos teisės saugomos.</p>
        <p style="margin: 0;">
            Klausimų turite? Susisiekite su mumis:
            <a href="mailto:info@qvicker.lt" style="color: #266867;">info@qvicker.lt</a>
        </p>
    </div>

</div>

</body>
</html>
