@extends('layouts.app')

@section('content')
<div style="overflow-y: hidden">
    @if($transaction->paymentInstrumentType == "credit_card")
    <div class="row panel panel-success" style="background-color:white;padding:1%;margin-left:5%;margin-top: 10%;margin-right: 5%">
        <div class="alert alert-success">You have successfully made a payment of USD {{$transaction->amount}}</div>
        <div class="col-xs-5">
            <p>At {{$transaction->createdAt->format('Y-m-d H:i:s')}} </p>
             <p>with card (last 4 digits) :{{$transaction->creditCardDetails->last4}}</p>
             <p>Card Type: {{$transaction->creditCardDetails->cardType}} issued by {{$transaction->creditCardDetails->issuingBank}}&nbsp;&nbsp;&nbsp;<img src="{{$transaction->creditCardDetails->imageUrl}}"></p>
        </div>
        <div class="col-xs-4">
            <p>Name: {{$user->name}}</p>
            <p>E-mail: {{$user->email}} </p>
            <p>Theme ID: {{$theme_id}}</p>
        </div>
    </div>
    @endif
    @if($transaction->paymentInstrumentType == "paypal_account")
            <div class="row panel panel-success" style="background-color:white;padding:1%;margin-left:5%;margin-top: 10%;margin-right: 5%">
                <div class="alert alert-success">You have successfully made a payment of USD {{$transaction->amount}}</div>
                <div class="col-xs-5">
                    <p>At {{$transaction->createdAt->format('Y-m-d H:i:s')}} </p>
                    <p>Transaction ID :{{$transaction->paypalDetails->captureId}}</p>
                    <p>Payment made using&nbsp;<img src="{{$transaction->paypalDetails->imageUrl}}"></p>
                </div>
                <div class="col-xs-4">
                    <p>Name: {{$user->name}}</p>
                    <p>E-mail: {{$user->email}} </p>
                    <p>Theme ID: {{$theme_id}}</p>
                </div>
            </div>
    @endif

    <a style="margin-left: 40%" href="/home" class="btn btn-info">Return to Resume Builder</a>



<!-- Footer -->
<footer style="width:100%;margin: 0 auto;padding:0;position: absolute;bottom: 0;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-inline">
                    <li>
                        <a href="#">Home</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="/terms_of_services">Terms of Services</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="/privacy">Privacy</a>
                    </li>
                    <li class="footer-menu-divider">&sdot;</li>
                    <li>
                        <a href="#contact">Contact</a>
                    </li>
                </ul>
                <p class="copyright text-muted small">Copyright &copy; Visualast 2017. All Rights Reserved</p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>
@endsection