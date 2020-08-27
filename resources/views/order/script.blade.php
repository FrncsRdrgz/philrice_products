<script type="text/javascript">
	document.addEventListener("DOMContentLoaded",function(){
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		
		display_seed();
		function display_seed(){
			$.ajax({
				url: 'shop_display_seeds',
				type: 'POST',
				dataType: 'json',
			})
			.done(function(response) {
				var append_seed = document.getElementById("append_seed");
				console.log(append_seed);
				response.map(function(value, key) {

					let card_div = document.createElement("div");
					card_div.classList.add("col-md-6","col-lg-3","ftco-animate","fadeInUp", "ftco-animated");

					/*<div class="product">*/
					let inner_div = document.createElement("div");
					inner_div.classList.add("product");
					card_div.appendChild(inner_div)

					let product_div = document.createElement("div");
					product_div.classList.add("text","py-3","pb-4","px-3","text-center")
					inner_div.appendChild(product_div);

					let product_node = document.createElement("h3");
					let product_text = document.createTextNode(value.variety)
					product_div.appendChild(product_node);
					product_node.appendChild(product_text);

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