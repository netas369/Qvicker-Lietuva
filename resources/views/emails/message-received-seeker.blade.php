<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nauja žinutė - Qvicker</title>
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

            @if($messageCount > 1)
                Naujos žinutės, {{ ucfirst($notifiable->name) }}!
            @else
                Nauja žinutė, {{ ucfirst($notifiable->name) }}!
            @endif
        </h1>

        <p style="margin-bottom: 2rem; text-align: center; color: #6b7280; font-size: 1.125rem;">
            {{ $introLine }}
        </p>

        <!-- Message Info Card -->
        <div style="background-color: #f0f9ff; border: 1px solid #7dd3fc; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #0369a1; font-size: 1.125rem; font-weight: 600;">
                Žinutės informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 140px;">Siuntėjas:</span>
                <span style="color: #266867; font-weight: 500;">{{ $provider->name }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 140px;">Rezervacija Nr.:</span>
                <span style="color: #266867; font-weight: 500;">{{ $reservation->id }}</span>
            </div>

            @if($messageCount > 1)
                <div style="margin-bottom: 0.75rem;">
                    <span style="font-weight: 600; color: #374151; display: inline-block; width: 140px;">Žinučių kiekis:</span>
                    <span style="color: #dc2626; font-weight: 600;">{{ $messageCount }} naujos žinutės</span>
                </div>
            @endif

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 140px;">Rezervacijos data:</span>
                <span style="color: #266867; font-weight: 500;">{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</span>
            </div>
        </div>

        <!-- Reservation Details Card -->
        <div style="background-color: #f0fdf4; border: 1px solid #86efac; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #166534; font-size: 1.125rem; font-weight: 600;">
                📋 Rezervacijos informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">Paslauga:</span>
                <span style="color: #166534; font-weight: 500;">{{ $reservation->subcategory ?? 'Bendra paslauga' }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">Miestas:</span>
                <span style="color: #166534; font-weight: 500;">{{ $reservation->city }}</span>
            </div>

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">Statusas:</span>
                <span style="color: #166534; font-weight: 500;">
                    @if($reservation->status == 'pending')
                        Laukiama patvirtinimo
                    @elseif($reservation->status == 'accepted')
                        Patvirtinta
                    @elseif($reservation->status == 'completed')
                        Užbaigta
                    @else
                        {{ ucfirst($reservation->status) }}
                    @endif
                </span>
            </div>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $actionUrl }}"
               style="display: inline-block; background-color: #266867; color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 600; font-size: 1.125rem;">
                📱 {{ $actionText }}
            </a>
        </div>

        <!-- Urgency Notice -->
        <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 0.5rem; padding: 1rem; margin: 2rem 0; text-align: center;">
            <p style="margin: 0; color: #dc2626; font-weight: 600;">
                ⚡ Prašome kuo greičiau atsakyti į žinutes!
            </p>
            <p style="margin: 0.5rem 0 0 0; color: #991b1b; font-size: 0.875rem;">
                Greitas atsakymas užtikrina sklandų bendravimą ir geresnį paslaugų kokybę.
            </p>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background-color: #f3f4f6; border-radius: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <p style="margin: 0 0 0.5rem 0;"><strong>Negalite paspausti mygtuko?</strong></p>
            <p style="margin: 0 0 0.5rem 0;">Nukopijuokite ir įklijuokite šią nuorodą į savo naršyklę:</p>
            <p style="margin: 0; word-break: break-all; color: #266867;">{{ $actionUrl }}</p>
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 2rem 0;"></div>

    </div>

    <!-- Footer -->
    <div style="background-color: #f8fafc; padding: 2rem; text-align: center; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">
        <p style="margin: 0 0 0.5rem 0;"><strong>Qvicker</strong> - Jūsų patikimas partneris paslaugų srityje</p>
        <p style="margin: 0 0 0.5rem 0;">© {{ date('Y') }} Qvicker. Visos teisės saugomos.</p>
        <p style="margin: 0;">
            Klausimų turite? Susisiekite su mumis:
            <a href="mailto:info@qvicker.lt" style="color: #266867; text-decoration: none;">info@qvicker.lt</a>
        </p>
    </div>

</div>

</body>
</html>
