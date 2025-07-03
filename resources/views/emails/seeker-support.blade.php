<!DOCTYPE html>
<html lang="lt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naudotojo pagalbos užklausa</title>
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
            🛠️ Naudotojo palaikymo užklausa
        </h1>

        <!-- Priority Badge -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <span style="display: inline-block; padding: 0.5rem 1rem; border-radius: 1rem; font-size: 0.875rem; font-weight: bold; text-transform: uppercase;
                         background-color: {{ $priority_color ?? '#3B82F6' }}; color: white;">
                {{ $priority_label ?? 'Normalus' }} PRIORITETAS
            </span>
        </div>

        <p style="margin-bottom: 2rem; text-align: center; color: #6b7280; font-size: 1.125rem;">
            Gauta nauja pagalbos užklausa nuo naudotojo <strong style="color: #266867;">{{ $name }}</strong>
        </p>

        <!-- Contact Details Card -->
        <div style="background-color: #9BCCCB; border: 1px solid #79A5A4; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                👤 Kontaktinė informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📧 El. paštas:</span>
                <span style="color: #133232; font-weight: 500;">{{ $email }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📞 Telefonas:</span>
                <span style="color: #133232; font-weight: 500;">{{ $phone }}</span>
            </div>

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">🆔 Vartotojo ID:</span>
                <span style="color: #133232; font-weight: 500;">{{ $user_id }}</span>
            </div>
        </div>

        <!-- Request Details Card -->
        <div style="background-color: #f0fdf4; border: 1px solid #0A97B0; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                📋 Užklausos informacija
            </h3>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">📝 Tema:</span>
                <span style="color: #133232; font-weight: 500;">{{ $subject }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">⚡ Prioritetas:</span>
                <span style="color: {{ $priority_color ?? '#266867' }}; font-weight: 500;">{{ $priority_label ?? 'Normalus' }}</span>
            </div>

            <div style="margin-bottom: 0.75rem;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">👥 Vartotojo tipas:</span>
                <span style="color: #133232; font-weight: 500;">{{ $user_type ?? 'Naudotojas' }}</span>
            </div>

            <div style="margin-bottom: 0;">
                <span style="font-weight: 600; color: #374151; display: inline-block; width: 120px;">🕐 Pateikta:</span>
                <span style="color: #133232; font-weight: 500;">{{ $submitted_at }}</span>
            </div>
        </div>

        <!-- Message Card -->
        <div style="background-color: #fefce8; border: 1px solid #266867; border-radius: 0.75rem; padding: 1.5rem; margin: 1.5rem 0;">
            <h3 style="margin: 0 0 1rem 0; color: #1A4645; font-size: 1.125rem; font-weight: 600;">
                💬 Žinutės turinys
            </h3>
            <p style="margin: 0; color: #133232; font-weight: 500; line-height: 1.5; white-space: pre-wrap;">
                {{ $user_message }}
            </p>
        </div>

        <!-- CTA Button -->
        <div style="text-align: center; margin: 2rem 0;">
            <a href="mailto:{{ $email }}?subject=Re: {{ $subject }}"
               style="display: inline-block; background-color: #266867; color: white; text-decoration: none; padding: 1rem 2rem; border-radius: 0.5rem; font-weight: 600; font-size: 1.125rem;">
                📧 Atsakyti naudotojui
            </a>
        </div>

        @if($priority === 'urgent')
            <!-- Urgency Notice -->
            <div style="background-color: #fef2f2; border: 1px solid #fca5a5; border-radius: 0.5rem; padding: 1rem; margin: 2rem 0; text-align: center;">
                <p style="margin: 0; color: #dc2626; font-weight: 600;">
                    🚨 SKUBUS KLAUSIMAS
                </p>
                <p style="margin: 0.5rem 0 0 0; color: #991b1b; font-size: 0.875rem;">
                    Šis klausimas pažymėtas kaip skubus. Prašome atsakyti kuo greičiau.
                </p>
            </div>
        @endif

        <!-- Technical Info -->
        <div style="margin-top: 2rem; padding: 1rem; background-color: #f3f4f6; border-radius: 0.5rem; font-size: 0.875rem; color: #6b7280;">
            <p style="margin: 0 0 0.5rem 0;"><strong>Techninė informacija:</strong></p>
            <p style="margin: 0 0 0.5rem 0;">IP adresas: {{ $ip_address }}</p>
            <p style="margin: 0; word-break: break-all;">Naršyklė: {{ $user_agent }}</p>
        </div>

        <div style="height: 1px; background-color: #e5e7eb; margin: 2rem 0;"></div>

    </div>

    <!-- Footer -->
    <div style="background-color: #f8fafc; padding: 2rem; text-align: center; border-top: 1px solid #e5e7eb; color: #6b7280; font-size: 0.875rem;">
        <p style="margin: 0 0 0.5rem 0;"><strong>Qvicker</strong> - Naudotojų palaikymo sistema</p>
        <p style="margin: 0 0 0.5rem 0;">© {{ date('Y') }} Qvicker. Visos teisės saugomos.</p>
        <p style="margin: 0;">
            Šis laiškas buvo automatiškai sugeneruotas iš naudotojų palaikymo formos.
        </p>
    </div>

</div>

</body>
</html>
