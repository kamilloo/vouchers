<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <title>Your Voucher</title>
    <style>
        h1{
            font-size: 36px;
            font-weight: normal;
            text-align: center;
            line-height: 36px;
            height: 48px;
            text-transform: capitalize;
            margin: 10px;
            padding-bottom: 10px;
        }
        html{

            padding: 0px;
            margin: 0px;
            font-family: DejaVu Sans;
            /*font-family: Sans;*/
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
            text-align: center;

        }
        h3{
            font-size: 42px;
            line-height: 42px;
            padding: 0px;
            margin: 15px 0 0;
            font-weight: normal;
            text-align: center;

        }
        .content{
            width: 100%;
            margin: 24px 10px;
            background-color: #ffffff;
        }
        h2 {
            font-size: 32px;
            font-weight: bold;
            font-style: normal;
            margin: 0 0 10px 0;
            padding: 0;
            line-height: 36px;
            height: 72px;
            text-align: center;

        }
        .footer{
            height: 60px;
            padding: 0;
            margin: 0;
        }
        .notice{
            height: 30px;
            padding: 0;
            margin: 0;

        }
        .notice p{
            font-size: 12px;
            line-height: 16px;
            padding: 0;
            margin-left: 20px;
        }
        .small{
            font-size: 16px;
            line-height: 20px;
        }
        .title{
            font-size: 20px;
            line-height: 25px;
            height: 50px;
            padding-bottom: 50px;
        }
        .left{
            text-align: left;
        }
        .right{
            text-align: right;
        }
        .table-contact{
            font-size: 16px;
            line-height: 24px;
            font-style: normal;
            width: 100%;
            margin-bottom: 45px;
        }
        .table-contact td{
            padding: 2px 50px;
            margin: 0px;
        }
        .qr-code{
            padding: 0px;
            margin: 0px;
        }
        .qr-code-wrapper{
        }
        .code{
            text-align: center;
            margin: 0px
        }
        .code p{
            width: 300px ;
            margin: 0px auto 100px;
            font-size: 24px;
            line-height: 48px;
            vertical-align: middle;
            border-color: rgb(230,101,135);
            border-style: solid;
            border-width: 10px;
        }
        .table-company-title{
            width: 100%;
            height: 200px;
        }
        .table {
            width: 100%;
            height: 710px;
        }
        .table td {
            margin: 0;
            padding: 0;
        }
        .table td.description {
            width: 50%;
        }
        .table td.qr-code {
            width: 40%;
        }
        .table td.vl {
            background-color: rgb(230,101,135);
            margin: 0;
            padding: 10px 5px;
        }
        .app-logo{
            text-align: right;
        }

    </style>
</head>
<body>
<div class="content">
    <table class="table">
        <tr>
            <td class="description">
                <table class="table-company-title">
                    <tr>
                        <td class="left">
                            <img height="100" src="{{ $custom_logo ?? asset('images/placeholder_512_x_512.png') }}" alt="Company Logo">
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h1>{{ $user_profile->presenter->company() }}</h1>
                        </td>
                    </tr>
                </table>
                <div class="left">
                </div>

                <h3>{!!  $order->voucher->presenter->title() !!}</h3>

                <h2>{{ $full_name }}</h2>

                <table class="table-contact">
                    <tr>
                        <td></td><td class="left">Dane kontaktowe:</td>
                    </tr>
                    <tr>
                        <td rowspan="4" class="left" width="5%">
                            <img height="100" src="{{ asset('images/address_logo.png') }}" alt="Company Logo">
                        </td>
                        <td class="left">Telefon: {{$user_profile->phone}}</td>
                    </tr>
                    <tr><td class="left">ul. {{ $user_profile->address }}</td></tr>
                    <tr><td class="left">email: {{ $user_profile->user->email }}</td></tr>
                    <tr><td class="left">{{$user_profile->city }}</td></tr>

                </table>

                <div class="footer">
                    <p class="small">w celu uzgodnienia dogodnego terminu<br>prosimy o kontakt</p>
                </div>
                @if(1 || !$order->voucher->isQuoteType())
                    <div class="notice">
                        <p class="left">{{  $order->voucher->description }}</p>
                    </div>
                @endif
            </td>
            <td class="vl">
                <img height="100" src="{{ asset('images/logo_vertical.png') }}" alt="Company Logo">

            </td>
            <td class="qr-code">
                <div class="app-logo">
                    <img height="50" src="{{ asset('images/my-vouchers.png') }}" alt="Company Logo">
                </div>
                <div class="qr-code-wrapper">
                    <img class="qr-code" src="data:image/png;base64,{{ $qr_code }}" alt="QR Code">
                </div>
                <div class="code">
                    <p>{{ $order->qr_code }}</p>
                </div>
                <div class="footer">
                    <p class="small">Termin realizacji bonu upływa: {{ $order->presenter->expitedAt() }}</p>
                </div>
            </td>
        </tr>
    </table>

</div>
</body>
</html>
