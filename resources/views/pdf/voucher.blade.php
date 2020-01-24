<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Your Voucher</title>
    <style>
        h1{
            font-size: 72px;
            font-weight: 300;
            text-align: center;
            font-style: italic;
            line-height: 1.5em;
            padding-bottom: 10px;
            text-transform: capitalize;
            margin: 10px;
            padding: 0px;
        }
        html{

            padding: 0px;
            margin: 0px;
            /*font-family: DejaVu Sans;*/
        }
        body {
            text-align: center;
            font-size: 16px;
            line-height: 1em;
            background-color: #f1f1f1;
            padding: 0px;
            margin: 0px;

        }
        p{
            font-size: 20px;
            line-height: 36px;

        }
        .content{
            width: 100%;
            border-color: #00b3ee;
            margin: 24px 10px;
            background-color: #ffffff;
        }
        .pink {
            color: rgb(255, 192, 203);
        }
        h2 {
            font-size: 72px;
            font-weight: 600;
            font-style: italic;
            margin: 0 0 10px 0;
            padding: 0;
            line-height: 1.5em;

        }
        .small{
            font-size: 16px;
            line-height: 20px;
        }
        .title{
            font-size: 36px;
            line-height: 48px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .table{
            font-size: 20px;
            line-height: 24px;
            font-style: italic;
            width: 100%;
            margin-bottom: 10px;
        }
        .table td{
            padding: 5px 50px;
        }
        .qr-code{
            padding: 5px;
            border-color: pink;
            border-style: solid;
            border-width: 10px;
            box-shadow: 5px 15px pink;
        }

    </style>
</head>
<body>
<div class="content">
    <div>
        <img height="150" src="{{ $order->merchant->shopImages->logo }}" alt="Company Logo">
    </div>
    <h1 class="pink">{{ $user_profile->company_name }}</h1>

    <p>serdecznie zaprasza</p>

    <h2><span class="small">Sz. P.</span> {{ $order->first_name }}&nbsp;{{ $order->last_name }}</h2>

    <p class="title">na dowolny zestaw zabiegów <br>w kwocie {{ $order->voucher->price }} zł</p>

    <table class="table">
        <tr>
            <td>Dane kontaktowe:</td>
        </tr>
        <tr><td class="left">Telefon: {{$user_profile->phone}}</td><td class="right">ul. {{ $user_profile->phone }}</td></tr>
        <tr><td class="left">email: {{ $user_profile->user->email }}</td><td class="right">adres: {{$user_profile->address }}</td></tr>
    </table>
    <div>
        <img class="qr-code" src="{{ asset('qrcode.png') }}" alt="QR Code">
    </div>
    <p class="small">w celu uzgodnienia dogodnego terminu prosimy o kontakt
        <br>Termin realizacji bonu upływa: 20.10.2010r.</p>
</div>
</body>
</html>
