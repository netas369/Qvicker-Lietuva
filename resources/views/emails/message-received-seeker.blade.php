<!DOCTYPE html>
<html lang="lt" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <title>
        @if($messageCount > 1)
            Naujos žinutės - Qvicker
        @else
            Nauja žinutė - Qvicker
        @endif
    </title>
    <!--[if !mso]><!-- -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table, td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <!--[if mso]>
    <xml>
        <o:OfficeDocumentSettings>
            <o:AllowPNG/>
            <o:PixelsPerInch>96</o:PixelsPerInch>
        </o:OfficeDocumentSettings>
    </xml>
    <![endif]-->
    <!--[if lte mso 11]>
    <style type="text/css">
        .mj-outlook-group-fix { width:100% !important; }
    </style>
    <![endif]-->
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            table.mj-full-width-mobile {
                width: 100% !important;
            }
            td.mj-full-width-mobile {
                width: auto !important;
            }
        }
    </style>
    <style type="text/css">
        a, span, td, th {
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
    </style>
</head>

<body style="background-color:#f8fafc;">
<div style="display:none;font-size:1px;color:#f8fafc;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">
    @if($messageCount > 1)
        Naujos žinutės nuo {{ $provider->name }} - Qvicker
    @else
        Nauja žinutė nuo {{ $provider->name }} - Qvicker
    @endif
</div>

<div style="background-color:#f8fafc;">
    <!--[if mso | IE]>
    <table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600">
        <tr>
            <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
    <![endif]-->

    <!-- Header with Logo -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:40px 0 20px 0;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:32px;font-weight:900;line-height:1;text-align:center;color:#266867;">
                                        Q<span style="color: #1A4645; font-weight: 900;">vicker</span><span style="color: #6b7280; font-size: 12px; margin-left: 4px;">LT</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Main Title -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0px;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:24px;font-weight:600;line-height:30px;text-align:center;color:#1A4645;">
                                        <h1 style="margin: 0; font-size: 24px; line-height: normal; font-weight: 600;">
                                            @if($messageCount > 1)
                                                Naujos žinutės, {{ ucfirst($notifiable->name) }}!
                                            @else
                                                Nauja žinutė, {{ ucfirst($notifiable->name) }}!
                                            @endif
                                        </h1>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:center;color:#6b7280;">
                                        <p style="margin: 0;">{{ $introLine }}</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Message Information -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;line-height:24px;text-align:left;color:#1A4645;border-bottom:1px solid #e5e7eb;padding-bottom:8px;margin-bottom:16px;">
                                        Žinutės informacija
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Siuntėjas:</strong><br />{{ $provider->name }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Rezervacija Nr.:</strong><br />{{ $reservation->id }}</p>
                                    </div>
                                </td>
                            </tr>
                            @if($messageCount > 1)
                                <tr>
                                    <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                        <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                            <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Žinučių kiekis:</strong><br /><span style="color: #dc2626; font-weight: 600;">{{ $messageCount }} naujos žinutės</span></p>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Rezervacijos data:</strong><br />{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('Y-m-d') }}</p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Reservation Information -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;line-height:24px;text-align:left;color:#1A4645;border-bottom:1px solid #e5e7eb;padding-bottom:8px;margin-bottom:16px;">
                                        Rezervacijos informacija
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Paslauga:</strong><br />{{ $reservation->subcategory ?? 'Bendra paslauga' }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Miestas:</strong><br />{{ $reservation->city }}</p>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#374151;">
                                        <p style="margin: 0;"><strong style="font-size: 14px; color: #6b7280; line-height: 18px">Statusas:</strong><br />
                                            @if($reservation->status == 'pending')
                                                Laukiama patvirtinimo
                                            @elseif($reservation->status == 'accepted')
                                                Patvirtinta
                                            @elseif($reservation->status == 'completed')
                                                Užbaigta
                                            @else
                                                {{ ucfirst($reservation->status) }}
                                            @endif
                                        </p>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- CTA Button -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="center" vertical-align="middle" style="font-size:0px;padding:20px 25px;word-break:break-word;">
                                    <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:separate;line-height:100%;">
                                        <tbody>
                                        <tr>
                                            <td align="center" bgcolor="#1A4645" role="presentation" style="border:none;border-radius:6px;cursor:auto;mso-padding-alt:16px 32px;background:#1A4645;" valign="middle">
                                                <a href="{{ $actionUrl }}" style="display: inline-block; background: #1A4645; color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 600; line-height: 24px; margin: 0; text-decoration: none; padding: 16px 32px; mso-padding-alt: 0px; border-radius: 6px;" target="_blank">
                                                    {{ $actionText }}
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Urgency Notice -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0px;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:16px;font-weight:600;line-height:24px;text-align:left;color:#1A4645;background-color:#f8fafc;border-left:3px solid #266867;padding:16px;border-radius:4px;">
                                        <strong>Prašome kuo greičiau atsakyti į žinutes</strong>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="left" style="font-size:0px;padding:5px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#6b7280;">
                                        Greitas atsakymas užtikrina sklandų bendravimą ir geresnį paslaugų kokybę.
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Fallback Link -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="left" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:left;color:#6b7280;background-color:#f8fafc;padding:16px;border-radius:4px;">
                                        <strong style="color: #374151;">Negalite paspausti mygtuko?</strong><br>
                                        Nukopijuokite ir įklijuokite šią nuorodą į savo naršyklę:<br>
                                        <span style="color: #266867; word-break: break-all;">{{ $actionUrl }}</span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Divider -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;padding-top:0;text-align:center;background-color:#ffffff;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <p style="border-top: solid 1px #e5e7eb; font-size: 1px; margin: 0px auto; width: 100%;"></p>
                                    <!--[if mso | IE]>
                                    <table align="center" border="0" cellpadding="0" cellspacing="0" style="border-top:solid 1px #e5e7eb;font-size:1px;margin:0px auto;width:550px;" role="presentation" width="550px">
                                        <tr>
                                            <td style="height:0;line-height:0;">&nbsp;</td>
                                        </tr>
                                    </table>
                                    <![endif]-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <div style="margin:0px auto;max-width:600px;">
        <table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;">
            <tbody>
            <tr>
                <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;background-color:#f8fafc;">
                    <!--[if mso | IE]>
                    <table role="presentation" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                            <td class="" style="vertical-align:top;width:600px;">
                    <![endif]-->
                    <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%">
                            <tbody>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:center;color:#6b7280;">
                                        <strong style="color: #1A4645;">Qvicker</strong> - Jūsų patikimas partneris paslaugų srityje
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:center;color:#6b7280;">
                                        © {{ date('Y') }} Qvicker. Visos teisės saugomos.
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;">
                                    <div style="font-family:Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:24px;text-align:center;color:#6b7280;">
                                        Klausimų turite? Susisiekite su mumis: <a href="mailto:info@qvicker.lt" style="color: #266867; text-decoration: none;">info@qvicker.lt</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <!--[if mso | IE]>
                    </td>
                    </tr>
                    </table>
                    <![endif]-->
                </td>
            </tr>
            </tbody>
        </table>
    </div>

    <!--[if mso | IE]>
    </td>
    </tr>
    </table>
    <![endif]-->
</div>
</body>
</html>
