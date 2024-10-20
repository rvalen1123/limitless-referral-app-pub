<!DOCTYPE html>
<html>
    <head>
        <title>Referral Document</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @php
            $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
            $appCssFiles = $manifest['resources/js/app.js']['css'] ?? [];
        @endphp

        @foreach ($appCssFiles as $cssFile)
            <link rel="stylesheet" href="{{ public_path('build/' . $cssFile) }}">
        @endforeach

        <style>
            .text-color-primary {
                color: #1363DF;
            }

            .text-color-default {
                color: #1e293b;
            }

            .text-color-muted {
                color: #6b7280;
            }
        </style>
    </head>

    <body class="font-sans">
        <div class="bg-gray-50 py-4" style="width: 100%; text-align: center;">
            <img
                src="{{ public_path('assets/image/logo.svg') }}"
                style="display: block; height: 80px; margin: 0 auto;"
            />
        </div>

        <div class="py-4 px-6">
            <h2 class="text-color-default">#{{ str_pad($referral->getKey(), 5, "0", STR_PAD_LEFT) }}</h2>
            <h2 class="text-color-default">{{ $referral->referral_date->format('F d, Y') }}</h2>
        </div>
        
        <div class="py-4">
            <div class="bg-gray-50 py-3 text-left px-6">
                <h2 class="text-sm text-color-primary uppercase tracking-wide">Patient Information</h2>
            </div>

            <div class="mt-3 px-6">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <td style="width: 50%; vertical-align: top;">
                                <h3 class="text-color-default">{{ $referral->patientUser->name }}</h3>
                                
                                <div class="italic text-color-muted">
                                    <p>{{ $referral->patientUser->email }}</p>
                                    <p>{{ $referral->patientUser->phone_number }}</p>
                                </div>

                                <p class="italic text-color-muted">
                                    {{ $referral->patientUser->address_line_1 }},
                                    @if($referral->patientUser->address_line_2)
                                        {{ $referral->patientUser->address_line_2 }},
                                    @endif
                                    {{ $referral->patientUser->city }},
                                    {{ $referral->patientUser->state->name }},
                                    {{ $referral->patientUser->zip_code }}
                                </p>

                                @if($referral->patientUser->birthdate)
                                    <p class="italic text-color-muted">Birthdate: {{ $referral->patientUser->birthdate->format('Y-m-d') }}</p>
                                @else
                                    <p class="italic text-color-muted">Birthdate: N/A</p>
                                @endif
                            </td>

                            <td style="width: 50%; vertical-align: top;">
                                <div class="mt-3 pr-6">
                                    <h6 class="text-color-default">Referral Reasons</h6>

                                    <div class="flex items-center gap-2">
                                        <ul class="italic text-color-muted">
                                            @foreach($referral->referralReasons as $referralReason)
                                                <li>- {{ $referralReason->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="py-4">
            <div class="bg-gray-50 py-3 text-left px-6">
                <h2 class="text-sm text-color-primary uppercase tracking-wide">Recipient Information</h2>
            </div>

            <div class="mt-3 px-6">
                <h6 class="text-color-default">{{ $referral->recipientUser->name }}</h6>

                <div class="flex items-center gap-2 italic text-color-muted">
                    <p>{{ $referral->recipientUser->email }}</p>
                    <p>{{ $referral->recipientUser->phone_number }}</p>
                </div>
            </div>
        </div>
    </body>
</html>