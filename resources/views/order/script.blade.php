<script type="text/javascript">
	document.addEventListener("DOMContentLoaded",function(){
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		
		/*setTimeout(function(){
			display_seed()
		},1000)*/
		function display_seed(){
			$.ajax({
				url: 'shop_display_seeds',
				type: 'POST',
				dataType: 'json',
			})
			.done(function(response) {

				var append_seed = document.getElementById("append_seed");
				console.log(response);
				response.data.map(function(value, key) {

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
				})
			})
			.fail(function() {
				console.log("error");
			})
			.always(function() {
				console.log("complete");
			});
		}
	})
</script>