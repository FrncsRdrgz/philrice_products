<script type="text/javascript">
	$(document).ready(function(){
		var fs;
		var rs;
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		
		/*ALL BUTTONS HERE*/
		$(document).on('click','.product a',function(e){
			e.preventDefault();
		})
		//refresh the displayed seeds according to page
		$(document).on('click','.pagination a', function(e){
			e.preventDefault();
			
			var page = $(this).attr('href').split('page=')[1];
			display_seed(page);
		})

		//display the seeds details when clicked the product detail button
		$(document).on('click','.product_detail_button',function(e){
			e.preventDefault()
			seed_id=$(this).data('id');
			seed_detail(seed_id);
			//$('#exampleModal').modal();
		})

		$(document).on('click','.buy_now_button',function(e){
			e.preventDefault();
		})

		$(document).on('click','.add_to_cart_button', function(e){
			e.preventDefault();

			var seed_variety = this.parentNode.parentNode.querySelector('.seed_div').dataset.id;
			var seed_class = $("input[name='seed_class']:checked").val();
			var quantity = $(".quantity").val();

			console.log(quantity);
			if(seed_class === undefined){
				alert('please select seed_class')
			}
			else{
				var params = {id:seed_variety,seed_class:seed_class,quantity:quantity};
				add_to_cart(params);
			}		
		})

		$(document).on('change','input:radio[name="seed_class"]',function(){
			if($(this).is(':checked') && $(this).val() == 'FS'){
				html ='';
				html += 'Packaging (kilos per bag)';
				html += '<h4>'+fs[0].packaging+'</h4> ';

				$('.packaging_div').html(html);
				$('.add_to_cart_button').prop('disabled',false).css('cursor','pointer')
				//$('.qty_wrapper input[name="quantity"]').val(fs[0].packaging).attr("step",fs[0].packaging);
			}
			if($(this).is(':checked') && $(this).val() == 'RS'){
				html ='';
				html += 'Packaging (kilos per bag)';
				html += '<h4>'+rs[0].packaging+'</h4>';
				$('.add_to_cart_button').prop('disabled',false).css('cursor','pointer')
				$('.packaging_div').html(html);
				//$('.qty_wrapper input[name="quantity"]').val(rs[0].packaging).attr("step",rs[0].packaging);
			}
		})
		//Buttons that will change the value of quantity
		$(document).on('click','.minus',function(){
			this.parentNode.querySelector("input[type=number]").stepDown();
		})
		$(document).on('click','.plus',function(){
			this.parentNode.querySelector("input[type=number]").stepUp();
		})

		/*ALL FUNCTIONS HERE*/
		//display all the seeds from warehouse
		function display_seed(page){
			$.ajax({
				url: 'shop_display_seeds?page='+page,
				type: 'get',
			})
			.done(function(response) {

				var append_seed = document.getElementById("append_seed");
				$('.append_here').html(response);
				/*response.data.map(function(value, key) {

					var card_div = document.createElement("div");
					card_div.classList.add("col-md-6","col-lg-3","ftco-animate","fadeInUp", "ftco-animated");

					//<div class="product">
					var inner_div = document.createElement("div");
					inner_div.classList.add("product");
					//div class product appended to card div
					card_div.appendChild(inner_div)

					//displaying image appended to inner_div variable
					var image_anchor = document.createElement("a")
					image_anchor.href ="#"
					image_anchor.classList.add("img-prod")
					inner_div.appendChild(image_anchor)

					var img_holder = document.createElement("img")
					img_holder.classList.add("img-fluid")
					img_holder.src="https://miro.medium.com/max/500/1*NcuvxuZUmkGMc0UXg8lMMw.jpeg"
					img_holder.alt="Testing"
					image_anchor.appendChild(img_holder)


					var div_overlay = document.createElement("div")
					div_overlay.classList.add("overlay")
					image_anchor.appendChild(div_overlay)
					//<div class="text py-3 pb-4 px-3 text-center">
					var product_div = document.createElement("div");
					product_div.classList.add("text","py-3","pb-4","px-3","text-center")
					//product div appended to inner_div
					inner_div.appendChild(product_div);

					//<div class="h3"> Variety Name
					var product_node = document.createElement("h3");
					var product_text = document.createTextNode(value.variety)
					//Variety name H3 appended to product_div
					product_div.appendChild(product_node);
					product_node.appendChild(product_text);

					//<div class="d-flex"> append to product div
					var pricing_outer_div = document.createElement("div");
					pricing_outer_div.classList.add("d-flex")
					product_div.appendChild(pricing_outer_div)

					//<div class="pricing"> append to pricing outer div
					var pricing_inner_div = document.createElement("div")
					pricing_inner_div.classList.add("pricing")
					pricing_outer_div.appendChild(pricing_inner_div)

					var p_price = document.createElement("p")
					p_price.classList.add("price")
					//p_price appended to pricing_inner_div
					pricing_inner_div.appendChild(p_price)


					var span_price = document.createElement("span")
					span_price.classList.add("price")
					var span_text = document.createTextNode("₱ 38.00")
					span_price.appendChild(span_text)
					p_price.appendChild(span_price)

					//<div class="bottom-area d-flex px-3">
					var bottom_area_div = document.createElement("div");
					bottom_area_div.classList.add("bottom-area","d-flex","px-3");
					//bottom area appended to product div
					product_div.appendChild(bottom_area_div);

					//<div class="m-auto d-flex">
					var inner_bottom_area_div = document.createElement("div");
					inner_bottom_area_div.classList.add("m-auto", "d-flex")
					//append to bottom-area class div
					bottom_area_div.appendChild(inner_bottom_area_div);

					//seed variety detail button
					var view_product_button = document.createElement("a");
					view_product_button.classList.add("add-to-cart","d-flex","justify-content-center","align-items-center","text-center");
					view_product_button.href="#";

					var span_ios_menu = document.createElement("span")
					var i_ios_menu = document.createElement("i")
					i_ios_menu.classList.add("ion-ios-menu")
					//append to span ios menu
					span_ios_menu.appendChild(i_ios_menu)

					//append span ios menu to seed variety detail button
					view_product_button.appendChild(span_ios_menu)
					//append seed variety detail button to inner bottom area div
					inner_bottom_area_div.appendChild(view_product_button);


					//add to cart button
					var add_to_cart_button = document.createElement("a")
					add_to_cart_button.classList.add("add-to-cart","d-flex","justify-content-center","align-items-center","text-center","mx-1");
					add_to_cart_button.href = "#"

					var span_ios_cart = document.createElement("span")
					var i_ios_cart = document.createElement("i")
					i_ios_cart.classList.add("ion-ios-cart");
					//append i ios cart to span ios cart
					span_ios_cart.appendChild(i_ios_cart)

					//append span_ios_cart to add to cart button
					add_to_cart_button.appendChild(span_ios_cart);
					//append add to cart button to inner bottom area div
					inner_bottom_area_div.appendChild(add_to_cart_button);


					//append card div to main div
					append_seed.appendChild(card_div);
				})*/
			})
		}

		//display the details of selected seed
		function seed_detail(seed_id){
			$.ajax({
				url:'seed_details',
				type:'POST',
				data:{
					seed_id :seed_id
				}
			})
			.done(function(response){
				console.log(response);
				fs = response.data.filter(function(test){
					return test.taggedSeedClass == 'FS'
				})
				rs = response.data.filter(function(test){
					return test.taggedSeedClass == 'RS'
				})
				//console.log(fs.maturity,rs);
				html = "";
				html += '<div class="seed_div" data-id="'+response.seeds.id+'">'
					html += 'Ecosystem';
					html += '<h4>'+response.seeds.ecosystem+'</h4>';
					html += 'Average yield';
					html += '<h4>'+response.seeds.ave_yld + ' per ha </h4>';
					html += 'Max yield';
					html += '<h4>'+response.seeds.max_yld + ' per ha </h4>';
					html += 'Maturity';
					html +='<h4>'+response.seeds.maturity + ' days </h4>';
					html += '<div class="seed_class_div">';
					html += 'Seed Class</br>'
					if(fs === undefined || fs.length==0){
						html += '<input type="radio" name="seed_class" id="fs_class" class="radio_input" >';
						html += '<label for="fs_class" id="fs_label" class="radio_label disabled radio-disabled">Foundation Seed</label>'
					}
					else {
						html += '<input type="radio" name="seed_class" id="fs_class" class="radio_input" value="FS" >';
						html += '<label for="fs_class" id="fs_label" class="radio_label">Foundation Seed</label>'
					}
					if(rs === undefined || rs.length==0){
						html += '<input type="radio" id="rs_class" name="seed_class" class="radio_input" >';
						html += '<label for="rs_class" id="rs_label" class="radio_label disabled radio-disabled">Registered Seed</label>'
					}
					else {
						html += '<input type="radio" id="rs_class" name="seed_class" class="radio_input" value="RS" >';
						html += '<label for="rs_class" id="rs_label" class="radio_label">Registered Seed</label>'
					}
					html += '</div>';
					html += '<div class="packaging_div">';
					html += '</div>';
					html += 'Quantity (per bag)<br/>'
					html += '<div class="qty_wrapper">';
						html += '<button class="minus"></button>';
						html += '<input type="number" min="0" value="1" name="quantity" class="quantity">'
						html += '<button class="plus"></button>';
					html += '</div>';
				html += '</div>';
				$('#exampleModalLabel').html('<h2>'+response.seeds.variety+'</h2>')
				$('#exampleModal .modal-body').html(html);
				$('#exampleModal').modal();
			})
		}

		function add_to_cart(params){
			$.ajax({
				url:'add_to_cart',
				type:'POST',
				data:{
					seed_id : params.id,
					seed_class :params.seed_class,
					quantity: params.quantity
				}
			})
			.done(function(response){
				$('#exampleModal').modal('hide')
			})
		}
	})
</script>