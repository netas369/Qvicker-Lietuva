<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patvirtinimas: Jūsų užklausa gauta</title>
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
        <h1 style="font-size: 1.5rem; font-weight: bold; color: #0A97B0; margin-bottom: 1rem; text-align: center;">
            Užklausa sėkmingai gauta!
        </h1>

        <p style="margin-bottom: 2rem; text-align: center; color: #6b7280; font-size: 1.125rem;">
            Ačiū, <strong style="color: #0A97B0;">{{ $name }}</strong>! Jūsų palaikymo užklausa buvo sėkmingai pateikta.
        </p>

        <!-- Summary Card -->
        <div style="background-color: #9BCCCB; border: 1px solid #79A5A4; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                📋 Jūsų užklausos santrauka
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📝 Tema:</span>
                <span style="color: #133232; font-weight: 500;">{{ $subject }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">⚡ Prioritetas:</span>
                <span style="color: {{ $priority_color ?? '#266867' }}; font-weight: 500;">
                    {{ $priority === 'low' ? 'Žemas' : ($priority === 'normal' ? 'Normalus' : ($priority === 'high' ? 'Aukštas' : 'Skubus')) }}
                </span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">🕐 Pateikta:</span>
                <span style="color: #133232; font-weight: 500;">{{ $submitted_at }}</span>
            </div>

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📧 El. paštas:</span>
                <span style="color: #133232; font-weight: 500;">{{ $email }}</span>
            </div>
        </div>

        <!-- Next Steps Card -->
        <div style="background-color: #fffbeb; border: 1px solid #266867; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                🕐 Kas toliau?
            </h3>
            <ul style="margin: 0; padding-left: 20px; color: #133232;">
                <li>Mūsų palaikymo komanda peržiūrės jūsų užklausą</li>
                <li>Su jumis susisieksime el. paštu per <strong>24 valandas</strong></li>
                <li>Skubūs klausimai bus sprendžiami pirmiausiai</li>
                <li>Gausite detalų atsakymą ir sprendimo planą</li>
            </ul>
        </div>

        @if($priority === 'urgent')
            <!-- Urgency Notice -->
            <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 0.5rem; padding: 1rem; margin: 2rem 0; text-align: center;">
                <p style="margin: 0; color: #dc2626; font-weight: 600;">
                    🚨 SKUBUS KLAUSIMAS
                </p>
                <p style="margin: 0.5rem 0 0 0; color: #991b1b; font-size: 0.875rem;">
                    Kadangi jūsų užklausa pažymėta kaip skubi, ji bus sprendžiama pirmumo tvarka. Tikimės su jumis susisiekti dar šiandien.
                </p>
            </div>
        @endif


        <!-- Tips Card -->
        <div style="background-color: #f0fdf4; border: 1px solid #0A97B0; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                💡 Patarimas
            </h3>
            <p style="margin: 0; color: #133232; font-size: 0.875rem;">
                Kol laukiate atsakymo, galite peržiūrėti mūsų <strong>DUK skyrių</strong> - ten rasite atsakymus į dažniausius klausimus.
                Taip pat galite susisiekti su kitais partneriais mūsų platformoje.
            </p>
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 2rem 0;"></div>

    </div>

    <!-- Footer -->
    <div style="background-color: #f8fafc; padding: 2rem; text-align: center; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">
        <p style="margin: 0 0 0.5rem 0;"><strong>Qvicker partnerių pagalba</strong></p>
        <p style="margin: 0 0 0.5rem 0;">info@qvicker.lt | Mes čia, kad padėtume!</p>
        <p style="margin: 0;">
            Šis el. laiškas buvo išsiųstas automatiškai. Jei turite skubų klausimą,
            atsakykite į šį el. laišką arba rašykite tiesiogiai: info@qvicker.lt
        </p>
    </div>

</div>

</body>
</html>
