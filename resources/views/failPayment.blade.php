@extends('layouts.app')

@section('content')
<div style="overflow-y: hidden">
    <div class="alert alert-danger" style="margin-left:10%;margin-right:10%;margin-top: 10%">Payment Failed. Please check your credentials and try again.</div>

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
@endsection