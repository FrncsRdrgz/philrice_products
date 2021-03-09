@extends('layouts.index')
@push('styles')
	<link rel="stylesheet" type="text/css" href="{{asset('public/css/myOrder.css')}}">
@endpush
@section('content')
	<section class="content">
		<div class="container mt-3">
			<div class="card no-radius">
				<div class="card-body">
					<div class="row justify-content-md-center text-center">
						<div class=" col-md-2 border-right">
							<p class="m-0 orderHeader active" id="btnAll">All</p>
						</div>
						<div class=" col-md-2 border-right">
							<p class="m-0 orderHeader" id="btnPending">Pending</p>
						</div>
						<div class=" col-md-2 border-right">
							<p class="m-0 orderHeader" id="btnProcessed">Processed</p>
						</div>
						<div class=" col-md-2">
							<p class="m-0 orderHeader" id="btnCompleted">Completed</p>
						</div>
						<div class=" col-md-2">
							<p class="m-0 orderHeader" id="btnCancelled">Cancelled</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="content">
		<div class="container mt-3 order_div">
			<div class="card bg-light no-radius">
				<div class="card-body order_div">
					<div class="row border-bottom">
						<div class="col-md-12 border-bottom">
							<p>Test 1</p>
						</div>
						<div class="container">
							<div class="row">
								<div class="col-md-3">
									<p>Vareity</p>
								</div>

							</div>
							<div class="row">
								<div class="col-md-3">
									<p>Vareity</p>
								</div>
								
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<p>Test 2</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@push('scripts')
    <script type="text/javascript" src="{{asset('public/js/myOrder.js')}}?v=1"></script>
@endpush