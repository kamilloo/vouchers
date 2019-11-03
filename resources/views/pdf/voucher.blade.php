<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Your Voucher</title>
    <style>
        h1{
            font-size: 36px;
            font-weight: bold;
            text-align: center;
            padding-bottom: 20px;
        }
        body{
            text-align: center;
            font-size: 14px;
            /*font-family: DejaVu Sans;*/
        }
        .pink {
            color: rgb(255, 192, 203);
        }
        h2 {
            font-weight: 300;
            font-style: italic;
        }
        .small{
            font-size: 12px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .full-width{
            width: 100%;
            margin-bottom: 10px;
        }
        .qr-code{
            padding: 15px;
            border-color: pink;
            border-style: solid;
            border-width: 2px;
            box-shadow: 5px 15px pink;
        }

    </style>
</head>
<body>
<div>
    <img height="150" src="{{ $order->merchant->shopImages->logo }}" alt="Company Logo">
</div>
    <h1 class="pink">Your voucher</h1>

    <h3>{{ $user_profile->company_name }}</h3>

    <p>serdecznie zaprasza</p>

    <h2>Sz. P. {{ $order->first_name }}&nbsp;{{ $order->last_name }}</h2>

    <p>na dowolny zestaw zabiegów <br>w kwocie {{ $order->voucher->price }} zł</p>

    <p class="small">w celu uzgodnienia dogodnego terminu prosimy o kontakt</p>
<table class="full-width">
    <tr>
        <td>Dane kontaktowe:</td>
    </tr>
    <tr><td class="left">Telefon: {{$user_profile->phone}}</td><td class="right">ul. {{ $user_profile->phone }}</td></tr>
    <tr><td class="left">email: {{ $user_profile->user->email }}</td><td class="right">adres: {{$user_profile->address }}</td></tr>
</table>
<div >
    <img class="qr-code" src="{{ asset('images/qrcode-sample.png') }}" alt="QR Code">
</div>

<p class="small">Termin realizacji bonu upływa: 20.10.2010r.</p>
</body>
</html>
