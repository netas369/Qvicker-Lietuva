<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Slaptažodžio atkūrimas - Qvicker</title>
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
            Slaptažodžio atkūrimas
        </h1>

        <p style="margin-bottom: 1.5rem; text-align: center; color: #6b7280;">
            Sveiki, <strong>{{ $notifiable->name ?? 'Gerb. kliente' }}</strong>!
        </p>

        <p style="margin-bottom: 2rem; color: #374151; text-align: center;">
            Jūs gaunate šį laišką, nes gavome slaptažodžio atkūrimo užklausą jūsų <strong>Qvicker</strong> paskyrai.
        </p>

        <div style="text-align: center; margin: 2rem 0;">
            <a href="{{ $url }}"
               style="display: inline-block; background-color: #266867; color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 600; font-size: 1rem;">
                Atkurti slaptažodį
            </a>
        </div>

        <div style="background-color: #fef3cd; border: 1px solid #f59e0b; border-radius: 0.5rem; padding: 1rem; margin: 2rem 0;">
            <p style="margin: 0 0 0.5rem 0; color: #92400e; font-weight: 600; font-size: 0.875rem;">⚠️ Svarbu žinoti:</p>
            <ul style="margin: 0; padding-left: 1.5rem; color: #92400e; font-size: 0.875rem;">
                <li>Ši slaptažodžio atkūrimo nuoroda galioja <strong>60 minučių</strong></li>
                <li>Nuoroda gali būti panaudota tik vieną kartą</li>
                <li>Jei neprašėte slaptažodžio atkūrimo, papildomų veiksmų nereikia</li>
            </ul>
        </div>

        <div style="margin-top: 2rem; padding: 1rem; background-color: #f3f4f6; border-radius: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <p style="margin: 0 0 0.5rem 0;"><strong>Negalite paspausti mygtuko?</strong></p>
            <p style="margin: 0 0 0.5rem 0;">Nukopijuokite ir įklijuokite šią nuorodą į savo naršyklę:</p>
            <p style="margin: 0; word-break: break-all; color: #266867;">{{ $url }}</p>
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 2rem 0;"></div>

        <div style="background-color: #f0fdf4; border: 1px solid #22c55e; border-radius: 0.5rem; padding: 1rem; margin: 1rem 0;">
            <p style="margin: 0; color: #166534; font-size: 0.875rem; text-align: center;">
                <strong>🔒 Saugumo patarimas:</strong> Niekada nesidalykite savo slaptažodžiu su kitais ir reguliariai jį keiskite.
            </p>
        </div>

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
