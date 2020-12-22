{{-- legend 
	* Global Variables
	* Start of buttons
	* Start of Functions
		*Funtion to view all the data of cart
		*function to change the quantity
		*Function to remove item to cart
--}}

<script type="text/javascript">
	$(document).ready(function(){
		/*document ready functions*/
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		view_cart_data();
		
		/*global variables here*/
		var count = 0;
	
		/*ALL ONCHANGE HERE*/
		$(document).on('change','#province',()=>{
			province_id = $('#province option:selected').val();
			region_id = $('#province option:selected').attr('region_id')
			console.log(province_id,region_id)
			$('#municipality').empty();
			$('#municipality').append(`<option selected disabled>Loading...</option>`)

			$.ajax({
				type:'POST',
				url:'municipalities',
				data:{
					region_id: region_id,
					province_id:province_id,
				},success: (response)=> {
					$('#municipality').empty() // empty municipality
                    var options = `<option value="0" selected disabled>Municipality</option>`
                    response.forEach((item)=> {
                        options += `<option value="`+item.municipality_id+`">`+item.name+`</option>`
                    })
                    $('#municipality').append(options)
				}
			})
		})	

		/*ALL BUTTONS HERE*/
		/*$(document).on('click','.checkMe',function(e){
			if($(this).prop('checked') == true){

			}else{}
		})*/

		/*$('#selectAll').click(function(e){

			if($(this).prop('checked') == true){
				$('.checkMe').prop('checked',true);
			}else{
				$('.checkMe').prop('checked',false);
			}
		})*/
		$(document).on('click','.plus1',function(e){
			HoldOn.open({
			  theme:"sk-cube-grid"
			});
			quantity = $(this).closest('div').find('.quantity1').val();
			let cart_id = $(this).closest('div').find('.quantity1').data('id');
			console.log($(this))
			change_quantity(quantity,cart_id);
		})

		$(document).on('click','.minus1',function(e){
			HoldOn.open({
			  theme:"sk-cube-grid"
			});
			quantity = $(this).closest('div').find('.quantity1').val();
			cart_id = $(this).closest('div').find('.quantity1').data('id');
			change_quantity(quantity,cart_id);
		})

		$(document).on('click','.delete_button',function(e){
			e.preventDefault();
			HoldOn.open({
			  theme:"sk-cube-grid"
			});
			cart_id = $(this).closest('.row').find('.quantity1').data('id');
			delete_cart_item(cart_id);

		})
		$(document).on('click','.checkout_btn',function(e){
			e.preventDefault();
			var array = [];
			$(".quantity1").each(function(){
				array.push({cart_id : $(this).data('id')});
			})
				$.ajax({
					type:'post',
					url:'proceed_checkout',
					data:{
						cart_id_array: array
					}
				})
				.done(function(response){
					if(response == 'success'){
						window.location.href = "{{url('/checkout')}}";
					}
				})
		})

		$(document).on('click','.save_address',(e)=>{
			province_id = $('#province option:selected').val();
			region_id = $('#province option:selected').attr('region_id');
			municipality_id = $('#municipality option:selected').val();
			barangay = document.getElementById('barangay').value
			other_details = document.getElementById('other_details').value
			set_default = $('#set_default:checked').val();
			if(set_default == undefined)
			{
				set_default = '0'
			}

			console.log(set_default)
			if(province_id == 0 || municipality_id == 0 || barangay == '' || other_details == ''){
				/*swal.fire({
					'Please fill up all the fields'
				})*/
			}
			else{

				$.ajax({
					type: 'post',
					url:'save_address',
					data:{
						province_id : province_id,
						region_id :region_id,
						municipality_id :municipality_id,
						barangay :barangay,
						other_details :other_details,
						set_default :set_default,
					},
					success: (res)=>{
						location.reload();
					}
				})
			}
			
		})

		$(document).on('click','.change_button',(e)=>{
			e.preventDefault()
			$('.append_address_button').empty();

			html = ''
			html +=	'<div class="row">'
		        html += '<div class="col-md-12">'
		            html += '<button type="button" class="btn btn-light" data-toggle="modal" data-target="#addressModal"><i class="fa fa-plus"></i> Add Address</button>&nbsp;';
		            /*html += '<button class="btn btn-light"><i class="fa fa-plus"></i> Manage Address</button>'*/
		        html += '</div>'
		    html += '</div>'
		    $('.append_address_button').append(html);
		    get_shipping_addresses();
		})

		$(document).on('click','#cancel_address',(e)=>{
			$('.append_address_button').empty();
			$('.append_addresses').empty();

			get_active_address();
		})

		$(document).on('click','#submit_address',(e)=>{
			id = $('input[name="is_default"]:checked').data('id');
			 
			 $.ajax({
			 	type:'get',
			 	url:'set_active_address/'+id,
			 	success:(res)=>{
			 		if(res == 'success'){
			 			get_active_address();
			 			$('.append_address_button').empty();
			 		}
			 	}
			 })
		})
		/*ALL FUNCTIONS HERE*/
		/*Funtion to view all the data of cart*/
		function view_cart_data(){
			//$('.append_here').empty();
			//$('.subtotal').empty()
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

								
								html += '<div class="col-md-2 offset-md-1">';
									html += '<h5 class="h6 text-center">';
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
										html += '<input type="number" min="0" value="'+value.quantity+'" data-id="'+value.cart_id+'" name="quantity" class="quantity1">';
										html += '<button class="plus1"></button>';
									html += '</div>';
								html += '</div>';

								html += '<div class="col-md-2">';
									html += '<h5 class="h6 text-center">';
										html += '₱'+total_price
									html += '</h5>';
								html += '</div>';

								html += '<div class="col-md-2">';
									html += '<h5 class="h6 text-center">';
										html += '<a href="#" class="delete_button text-danger">Delete</a>'
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

				count++;		
				})
				$('.subtotal').html('₱'+subtotal)
				$('.append_here').html(html)
				setTimeout(function(){ HoldOn.close() }, 2000);
			})
		}

		/*function to change the quantity*/
		function change_quantity(quantity,cart_id){
			//alert(cart_id)
			$.ajax({
				type:'POST',
				url:'change_quantity',
				data:{
					'quantity' : quantity,
					'cart_id' : cart_id
				}
			})
			.done(function(response){
				if(response == 'success'){
					view_cart_data();
				}
			})
		}
		/*Function to remove item to cart*/
		function delete_cart_item(cart_id){
			$.ajax({
				type:'POST',
				url:'delete_cart_item',
				data:{
					'cart_id': cart_id
				}
			})
			.done(function(response){
				if(response == 'success'){
					view_cart_data();
				}
			})
		}

		function get_shipping_addresses(){
			$('.append_addresses').empty();

			$.ajax({
				type:'get',
				url:'get_shipping_addresses',
				success:(res)=>{
					html = '';
					$.each(res,(index,value)=>{
						html += '<div class="row">';
							html += '<div class="col-md-1">';
								html += '<div class="form-check">'
								
								if(value.is_default == 1){
									html += '<input class="form-check-input" type="radio" name="is_default" data-id="'+value.shipping_address_id+'" value="1" checked>'
								}else{
									html += '<input class="form-check-input" type="radio" name="is_default" data-id="'+value.shipping_address_id+'" value="1">'
								}
								html += '</div>';
							html += '</div>';
							html += '<div class="col-md-3">';
								html += '<p><strong>'+'{!! Auth::user()->fullname !!}'+'</strong></p>';
							html += '</div>';

							html += '<div class="col-md-6">';
								html += value.other_details+', '+value.barangay+', '+ value.city+', '+value.province+', '+value.region
							html += '</div>';
						html += '</div>';
					})

					html += '<div class="row">';
						html += '<div class="col-md-12">'
				            html += '<button type="button" class="btn btn-info" id="submit_address">Submit</button>&nbsp;';
				            html += '<button class="btn btn-danger" id="cancel_address">Cancel</button>'
				        html += '</div>'
					html += '</div>';
					$('.append_addresses').append(html);
				}
			})	
		}

		function get_active_address(){
			$('.append_addresses').empty();

			$.ajax({
				type:'get',
				url:'get_active_address',
				success:(res)=>{
					html = ''

					html += '<div class="row">'
	                    html += '<div class="col-md-3">'
	                    	html += '<p><strong>'+'{!!Auth::user()->fullname!!}'+'</strong></p>'
	                    html += '</div>'
	                    html += '<div class="col-md-6">'
	                    	html += res.other_details+', '+res.barangay+', '+res.city+', '+res.province+', '+res.region
	                    html += '</div>'
	                    html += '<div class="col-md-1">'
	                    	html += '<p class=" text-info">Default</p>'
	                    html += '</div>'
	                    html += '<div class="col-md-1">'
	                    	html += '<a href="#" class="change_button">Change</a>'
	                    html += '</div>'
                	html += '</div>'

                	$('.append_addresses').append(html)
				}

			})
		}
	})
</script>