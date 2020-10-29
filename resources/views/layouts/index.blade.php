<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
		<meta name="csrf-token" content="{{csrf_token()}}">
		
		<title>PhilRice Products</title>

		@include('layouts.cssLinks')

		@stack('styles')
	</head>
	<body class="layout-top-nav layout-footer-fixed">
		<div class="wrapper">

		    @include('layouts.navbar')

		    @yield('content')

		    @include('layouts.footer')
		</div>
		@include('layouts.jsLinks')
        @stack('scripts')
	</body>
</html>