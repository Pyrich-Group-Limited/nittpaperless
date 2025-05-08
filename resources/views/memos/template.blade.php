<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Internal Memo</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            font-size: 14px;
            margin: 40px;
        }

        .memo-wrapper {
            border: 1px solid #000;
            padding: 30px;
        }

        .header-table {
            width: 100%;
            border-collapse: collapse;
        }

        .header-table td {
            vertical-align: top;
        }

        .logo {
            width: 100px;
        }

        .center-text {
            text-align: center;
            font-weight: bold;
        }

        .title {
            font-size: 18px;
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }

        .section {
            margin-top: 30px;
        }

        .section p {
            margin: 4px 0;
        }

        .subject-line {
            font-weight: bold;
            text-decoration: none;
            margin-top: 20px;
        }

        .body-content {
            margin-top: 30px;
            text-align: justify;
        }

        hr {
            border: 0;
            border-top: 2px solid #000;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="memo-wrapper">
        <hr>
        <table class="header-table">
            <tr>
                <td class="logo">
                    <img src="{{ public_path('assets/images/logo-dark.png') }}" width="80%">
                </td>
                <td class="center-text">
                    <div>NIGERIAN INSTITUTE OF TRANSPORT TECHNOLOGY (NITT), ZARIA</div>
                    <div>INTERNAL MEMO</div>
                    <div>{{ strtoupper(Auth::user()->department->name ?? '') }}</div>
                    <div>{{ strtoupper(Auth::user()->unit->name ?? '') }}</div>
                </td>
            </tr>
        </table>
        <hr>

        <div class="section">
            <p><strong>DATE:</strong> {{ $date }}</p>
            <p><strong>TO:</strong> {{ $to ?? '' }}</p>
        </div>

        <div class="subject-line">
            SUBJECT: {{ strtoupper($title) }}
        </div>
        <hr>
        <div class="body-content">
            {!! nl2br(e($content)) !!}
        </div>

        <table width="100%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin-top: 20px;">
            <tr style="background-color: #f2f2f2;">
                <th colspan="3" align="left">Signatures</th>
            </tr>
        
            @if ($memo->signedUsers->isEmpty())
                <tr>
                    <td colspan="3">No signatures yet.</td>
                </tr>
            @else
                @foreach ($memo->signedUsers as $user)
                    <tr>
                        <td width="40%">
                            <strong>{{ $user->name }}</strong><br>
                            <small>({{ $user->designation ?? 'No Designation' }})</small>
                        </td>
                        <td>
                            @if ($user->signature && file_exists(public_path('storage/' . $user->signature->signature_path)))
                                <img src="{{ public_path('storage/' . $user->signature->signature_path) }}" alt="Signature" height="50">
                            @else
                                <em>No signature uploaded.</em>
                            @endif
                        </td>
                        <td>{{ $user->signature->created_at->format('d-M-Y') }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
        
    </div>
</body>
</html>
