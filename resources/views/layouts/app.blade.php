<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Resume Designer</title>

    <!-- Bootstrap Core CSS -->

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{!! URL::to('/css/landing-page.css') !!}" rel="stylesheet">


    <!-- Custom CSS -->
    <link href="{!! URL::to('/font-awesome/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="{!! URL::to('/css/simple-sidebar.css') !!}" rel="stylesheet">
    <link rel="stylesheet" href="{!! URL::to('/css/bootstrap-datepicker.css') !!}">
    <link type="text/css" rel="stylesheet" href="{!! URL::to('/css/style.css') !!}">
    <link href='http://fonts.googleapis.com/css?family=Rokkitt:400,700|Lato:400,300' rel='stylesheet' type='text/css'>
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.css">
    <!-- Scripts -->

    <script src="{!! URL::to('/js/jquery.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>

    <script src="{!! URL::to('/js/bootstrap-datepicker.js') !!}"></script>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
    <script src="{!! URL::to('/js/html2canvas.js') !!}"></script>

    <script>
        window.Laravel = <?php echo json_encode([
        'csrfToken' => csrf_token(),
    ]); ?>

    $( document ).ready(function() {

        });
    </script>
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-fixed-top topnav" role="navigation">
        <div class="container topnav">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a href="{{ url('/') }}">
                    <img style="width:7pc;" src="{{ url('images/VisualastPNG.png') }}" />
                </a>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown"><a href="{{ url('/home') }}">Resume Builder</a></li>
                        <li class="dropdown"><a href="/dashboard">Dashboard</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/logout') }}"
                               onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                        </li>

                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    @endif
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
</div>
@yield('content')

<!--Mandatory Hidden Fields for ALl resumes. -->
<input type="hidden" id="workExperienceAddOrEdit" value="-1">
<input type="hidden" id="educationAddOrEdit" value="-1">
<input type="hidden" id="myLinksAddOrEdit" value="-1">

</body>
</html>

<!-- Scripts -->
<script src="/js/app.js"></script>


