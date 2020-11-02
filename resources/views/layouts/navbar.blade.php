<nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
    	@if(Request::segment(1) == 'checkout')
			<a class="navbar-brand"  href="{{url('/')}}">PhilRice Products | Checkout</a>
		@else
		<a href="{{url('/')}}" class="navbar-brand">
			<span class="brand-text font-weight-light">PhilRice Products</span>
		</a>

		<button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse order-3" id="navbarCollapse">
			<!-- Left navbar links -->
			<ul class="navbar-nav ml-auto">
			  <li class="nav-item">
			    <a href="{{url('/')}}" class="nav-link">Home</a>
			  </li>
			  <li class="nav-item">
			    <a href="{{url('/shop')}}" class="nav-link">Shop</a>
			  </li>
			  <li class="nav-item cart_trigger_button"><a href="{{url('/cart')}}" class="nav-link"><i class="fa fa-shopping-cart"></i><span class="badge badge-primary navbar-badge">{{$item_count->quantity}}</span></a></li>

			</ul>
		</div>
    	@endif
    </div>
  </nav>