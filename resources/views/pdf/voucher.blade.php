<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Your Voucher</title>
    <style>
        h1{
            font-size: 36px;
            font-weight: 300;
            text-align: center;
            font-style: italic;
            line-height: 48px;
            height: 48px;
            text-transform: capitalize;
            margin: 10px;
            padding: 0px;
        }
        html{

            padding: 0px;
            margin: 0px;
            font-family: DejaVu Sans;
        }
        body {
            text-align: center;
            font-size: 16px;
            line-height: 20px;
            background-color: #ffffff;
            padding: 0;
            margin: 0;

        }
        p{
            font-size: 20px;
            line-height: 36px;
            padding: 0px;
            margin: 10px 0 0 0;

        }
        .content{
            width: 100%;
            margin: 24px 10px;
            background-color: #ffffff;
        }
        .gold {
            color: #f7c83b;
        }
        h2 {
            font-size: 32px;
            font-weight: 600;
            font-style: italic;
            margin: 0 0 10px 0;
            padding: 0;
            line-height: 36px;
            height: 72px;

        }
        .footer{
            height: 40px;
            padding: 0;
            margin: 0;
        }
        .small{
            font-size: 16px;
            line-height: 20px;
        }
        .title{
            font-size: 20px;
            line-height: 25px;
            height: 50px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .table{
            font-size: 16px;
            line-height: 16px;
            font-style: italic;
            width: 100%;
            margin-bottom: 5px;
        }
        .table td{
            padding: 2px 50px;
            margin: 0px;
        }
        .qr-code{
            padding: 0px;
            margin: 0px;
        }
        .code{
            text-align: center;
            margin-bottom: 5px
        }
        .code p{
            width: 300px ;
            margin: 0px auto;
            font-size: 24px;
            line-height: 48px;
            vertical-align: middle;
            border-color: green;
            border-style: solid;
            border-width: 10px;

        }

    </style>
</head>
<body>
<div class="content">
    <h1>{{ $voucher->title  }}</h1>
    <div>
        <img height="100" src="{{ $custom_logo ?? asset('checkout/template1/images/img-01.png') }}" alt="Company Logo">
    </div>
    <h1 class="gold">{{ $user_profile->company_name }}</h1>

    <p>serdecznie zaprasza</p>

    <h2><span class="small">Sz. P.</span> {{ $full_name }}</h2>

    <p class="title">{!!  $order->voucher->presenter->title() !!}

    <table class="table">
        <tr>
            <td>Dane kontaktowe:</td>
        </tr>
        <tr><td class="left">Telefon: {{$user_profile->phone}}</td><td class="right">ul. {{ $user_profile->address }}</td></tr>
        <tr><td class="left">email: {{ $user_profile->user->email }}</td><td class="right">{{$user_profile->city }}</td></tr>
    </table>
    <div>
        <img class="qr-code" src="data:image/png;base64,{{ $qr_code }}" alt="QR Code">
    </div>
    <div class="code">
        <p>{{ $order->qr_code }}</p>
    </div>
    <div class="footer">
        <p class="small">w celu uzgodnienia dogodnego terminu prosimy o kontakt
            <br>Termin realizacji bonu upływa: {{ \Carbon\Carbon::parse($order->expired_at)->toDateString() }}</p>
    </div>

</div>
</body>
</html>
