$(document).ready(function(){
	$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
	/*$('.cart_trigger_button').on('click', function (e) {
			e.preventDefault();
			$('#mySidenav').toggleClass('sidenav-open');
	        //$('.drawer').toggleClass('drawer-is-open');
	        $('body').toggleClass('overflow-hidden');
	        $('.div_blocker').toggleClass('d-block');
	        $('.div_blocker').toggleClass('d-none');
	        view_cart_data();
	    });
*/
    $('.closebtn').on('click',function(){
    	$('#mySidenav').toggleClass('sidenav-open');
    	$('body').toggleClass('overflow-hidden');
    	$('.div_blocker').toggleClass('d-block');
    	$('.div_blocker').toggleClass('d-none');
    })

	function view_cart_data(){
		$('.cart-body').empty();
		$.ajax({
			type:'get',
			url:'view_cart_data',
		})
		.done(function(response){
			console.log(response);
			html = "";
			$.each(response, function(index,value){
				html += '<div class="row border-bottom p-3">';
					html += '<div class="col-md-4">';
						html += '<a href="#" class="img-prod"><img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">';
							html += '<div class="overlay"></div>';
						html += '</a>';
					html += '</div>';

					html += '<div class="col-md-8">';
						html += '<p class="h4">';
							html += value.variety
						html += '</p>';
						html += '<p class="h6 text-secondary">Quantity: </p>'
						html += '<div class="qty_wrapper1">';
							html += '<button class="minus1"></button>';
							html += '<input type="number" min="0" value="'+value.quantity+'" name="quantity" class="quantity1">';
							html += '<button class="plus1"></button>';
						html += '</div>';
					html += '</div>';
				html += '</div>';

						
			})
			$('.cart-body').append(html)	
		})
	}

	$(document).on('click','.minus1',function(){
			this.parentNode.querySelector("input[type=number]").stepDown();
		})
		$(document).on('click','.plus1',function(){
			this.parentNode.querySelector("input[type=number]").stepUp();
		})
})