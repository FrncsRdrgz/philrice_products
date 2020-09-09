<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="csrf-token" content="{{csrf_token()}}">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>BDD Online</title>

		@include('layouts.cssLinks')

		@stack('styles')
	</head>
	<body class="goto-here">
		<div class="wrapper">
			
		</div>
		<div class="py-1 bg-primary">
	    	<div class="container">
	    		<div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
		    		<div class="col-lg-12 d-block">
			    		<div class="row d-flex">
			    			<div class="col-md pr-4 d-flex topper align-items-center">
						    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-phone2"></span></div>
							    <span class="text">+ 1235 2355 98</span>
						    </div>
						    <div class="col-md pr-4 d-flex topper align-items-center">
						    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							    <span class="text">youremail@email.com</span>
						    </div>
						    <div class="col-md pr-4 d-flex topper align-items-center">
						    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							    <span class="text">youremail@email.com</span>
						    </div>
						    <div class="col-md pr-4 d-flex topper align-items-center">
						    	<div class="icon mr-2 d-flex justify-content-center align-items-center"><span class="icon-paper-plane"></span></div>
							    <span class="text">youremail@email.com</span>
						    </div>
						    <div class="col-md-2 pr-4 d-flex topper align-items-center">
						    	<a class="text" href="{{route('logout')}}" onclick="event.preventDefault();
						            document.getElementById('logout-form').submit();">
						            <i class="fas fa-user"></i> Logout</a>

						            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						                {{ csrf_field() }}
						            </form>
						    </div>
					    </div>
				    </div>
			    </div>
			  </div>
	    </div>
	    @include('layouts.sidebar')
	    @include('layouts.navbar')

	    @yield('content')

	    @include('layouts.footer')
		@include('layouts.jsLinks')
        @stack('scripts')
	</body>
</html>