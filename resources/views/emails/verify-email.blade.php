<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patvirtinkite savo el. paštą - Qvicker</title>
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
            Sveiki atvykę, {{ ucfirst($user->name) }}!
        </h1>

        <p style="margin-bottom: 2rem; text-align: center; color: #6b7280;">
            Ačiū, kad prisiregistravote prie <strong>Qvicker</strong>! Prieš pradėdami naudotis mūsų platforma, prašome patvirtinti savo el. pašto adresą.
        </p>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $verificationUrl }}"
               style="display: inline-block; background-color: #266867; color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 600;">
                Patvirtinti el. pašto adresą
            </a>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background-color: #f3f4f6; border-radius: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <p style="margin: 0 0 0.5rem 0;"><strong>Negalite paspausti mygtuko?</strong></p>
            <p style="margin: 0 0 0.5rem 0;">Nukopijuokite ir įklijuokite šią nuorodą į savo naršyklę:</p>
            <p style="margin: 0; word-break: break-all; color: #266867;">{{ $verificationUrl }}</p>
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
