$(document).ready(function(){
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	$('.cart_trigger_button').on('click', function (e) {
			e.preventDefault();
			$('#mySidenav').toggleClass('sidenav-open');
	        //$('.drawer').toggleClass('drawer-is-open');
	        $('body').toggleClass('overflow-hidden');
	        $('.div_blocker').toggleClass('d-block');
	        $('.div_blocker').toggleClass('d-none');
	        view_cart_data();
	    });
	    $('.closebtn').on('click',function(){
	    	$('#mySidenav').toggleClass('sidenav-open');
	    	$('body').toggleClass('overflow-hidden');
	    	$('.div_blocker').toggleClass('d-block');
	    	$('.div_blocker').toggleClass('d-none');
	    })

	function view_cart_data(){
		$.ajax({
			type:'post',
			url:'view_cart_data',
		})
		.done(function(response){

		})
	}
})