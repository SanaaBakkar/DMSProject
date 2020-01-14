<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <title>Document Management System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css')}}">
    
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css')}}">

    <link rel="stylesheet" href="{{ asset('css/aos.css')}}">

    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css')}}">
    
    <link rel="stylesheet" href="{{ asset('css/flaticon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css')}}">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css')}}">


   <!-- font awesome-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">

     <!-- DataTables JS and CSS -->

     <script src="{{ asset('js/jquery.min.js')}}"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <script type="text/javascript">

    <!--
    function ouverture()
    {
    window.open("/document", "ouverture", "toolbar=no, status=yes, scrollbars=yes, resizable=no, width=200, height=100");
    }
    //-->
    </SCRIPT>

  </head>
  <body>
	  
	  <nav class="navbar navbar-expand-lg navbar-dark bg-dark ftco-navbar-light" id="ftco-navbar">
      <div class="bg-top navbar-light d-flex flex-column-reverse" style="margin: 0px 0px 0px 0px;">
      <div class="container py-3">
        <div class="row no-gutters d-flex align-items-center align-items-stretch">
          <div class="col-md-4 d-flex align-items-center py-4">
            <a class="navbar-brand" href="index.html">DMS PROJECT <span>Manage your Documents</span></a>
          </div>
        </div>
      </div>
    </div>

	    <div class="container d-flex align-items-center">
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>
	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto" >
                       <!-- Authentication Links -->
                        @guest
                            <li class="nav-item" >
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item" >
                                    <a class="nav-link" href="{{ route('register') }}" hidden>{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
 
	          <li id="home" class="nav-item" ><a href="{{url('/')}}" class="nav-link">Home</a></li>
	          <li class="nav-item"><a id="my_doc" href="{{ url('/document') }}" class="nav-link">My documents</a></li>
	          <li class="nav-item"><a id="tasks" href="{{ url('/task') }}" class="nav-link">My Tasks</a></li>
	          <li class="nav-item"><a href="project.html" class="nav-link">Team</a></li>
	          <li class="nav-item"><a href="{{ url('/documentation') }}" class="nav-link">Documentation</a></li>
            <li class="nav-item">
                    @if(Auth::user()->admin == 1)
                      <a class="nav-link" href="{{url('/admin')}}">Administration</a> @endif                        
                  </li>
	        </ul>
          <ul class="navbar-nav">
           <li class="nav-item dropdown">
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" >
                      {{ Auth::user()->name }} <span class="caret"></span>
                 </a>

                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item show" href="{{ url('/settings') }}" id="setting">  Settings </a>
                     <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="logout">  {{ __('Logout') }}
                     </a>

                     <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                    </form>
                 </div>              
            </li>
             @endguest
          </ul>
	      </div>
	    </div>
	  </nav>

  
     <main class="py-4">
                @yield('content')
     </main>

<!-- Change nav-item to active when we click on -->

  <script type="text/javascript">
     // clicking on anchor element inside li
      $('li a').click(function () {
         // remove existing active class inside li elements
      $('li.nav-item').removeClass('active');
        // add class to current clicked element
      $(this).closest('li.nav-item').addClass('active');
      });
  </script>


 <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>


  <script src="{{ asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
  <script src="{{ asset('js/bootstrap.min.js')}}"></script>
  <script src="{{ asset('js/jquery.easing.1.3.js')}}"></script>
  <script src="{{ asset('js/jquery.waypoints.min.js')}}"></script>
  <script src="{{ asset('js/jquery.stellar.min.js')}}"></script>
  <script src="{{ asset('js/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('js/jquery.magnific-popup.min.js')}}"></script>
  <script src="{{ asset('js/aos.js')}}"></script>
  <script src="{{ asset('js/jquery.animateNumber.min.js')}}"></script>
  <script src="{{ asset('js/scrollax.min.js')}}"></script>
  <script src="{{ asset('js/main.js')}}"></script>

  </body>
  </html>     