<script type="text/javascript">
	$(document).ready(function(){
		view_cart_data();
		/*ALL PROPS HERE*/
		$('#selectAll').click(function(e){

			if($(this).prop('checked') == true){
				$('.checkMe').prop('checked',true);
			}else{
				console.log('test')
				$('.checkMe').prop('checked',false);
			}
		})

		$('.plus1').on('click',function(e){
			quantity = $(this).closest('div').find('.quantity1').val();
		})

		$('.minus1').on('click',function(e){
			quantity = $(this).closest('div').find('.quantity1').val();
		})


		/*ALL FUNCTIONS HERE*/
		function view_cart_data(){
			$('.append_here').empty();
			$.ajax({
				type:'get',
				url:'view_cart_data',
			})
			.done(function(response){
				console.log(response);
				html = "";
				var subtotal = 0;
				$.each(response, function(index,value){
					total_price = (parseInt(value.price) * parseInt(value.quantity))
					subtotal += total_price
					html += '<div class="card no_radius mb-2">';
						html += '<div class="card-body p-2">';
							html += '<div class="row">';

								html += '<div class="col-md-1">';
									html += '<input type="checkbox" class="checkMe">'
								html += '</div>';

								html += '<div class="col-md-2">';
									html += '<h5 class="h6">';
										html += value.variety
									html += '</h5>';
									html += '<img class="img-fluid" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">';
									html += '<div class="overlay"></div>';
								html += '</div>';

								html += '<div class="col-md-2 offset-md-1">';
									html += '<h5 class="h6 text-center">';
										html += '₱'+value.price
									html += '</h5>';
								html += '</div>';

								html += '<div class="col-md-2">';
									html += '<div class="qty_wrapper1 m-auto">';
										html += '<button class="minus1"></button>';
										html += '<input type="number" min="0" value="'+value.quantity+'" name="quantity" class="quantity1">';
										html += '<button class="plus1"></button>';
									html += '</div>';
								html += '</div>';

								html += '<div class="col-md-2">';
									html += '<h5 class="h6 text-center">';
										html += '₱'+total_price
									html += '</h5>';
								html += '</div>';
							html += '</div>';
						html += '</div>';
					html += '</div>';

					/*html += '<div class="row border-bottom p-3">';
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
					html += '</div>';*/

							
				})
				$('.subtotal').append('₱'+subtotal)
				$('.append_here').append(html)	
			})
		}
	})
</script>