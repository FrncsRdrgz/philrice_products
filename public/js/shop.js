'use strict';
	$(document).ready(function(){
		$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		const seedClassBtn = document.querySelectorAll('.seed_class');
		const seedModalTemplate = function (params){
			let checkClassFS = params.inbred_class === 'Foundation Seed' ? params.inbred_class : undefined;
			let checkClassRS = params.inbred_class === 'Registered Seed' ? params.inbred_class : undefined;

			let html = "";
			let seedClass = "";
				html += `
					<div class="seed_div" data-id="${params.variety}">
					<p class="m-0">Ecosystem</p>
					<h4 class="border-bottom">${params.ecosystem}</h4>
					<p class="m-0">Average Yield</p>
					<h4 class="border-bottom">${params.ave_yld} t/ha</h4>
					<p class="m-0">Max Yield</p>
					<h4 class="border-bottom">${params.max_yld} t/ha</h4>
					<p class="m-0">Maturity</p>
					<h4 class="border-bottom">${params.maturity} days</h4>
					<p class="m-0">Seed Class</p>
				`;
				if(checkClassFS === undefined)
				{
					html += `
						<input type="radio" name="seed_class" id="fs_class" class="radio_input">
						<label for="fs_class" id="fs_label" class="radio_label disabled radio-disabled">Foundation Seed</label>
					`;
				}
				else{
					html += `
						<input type="radio" name="seed_class" id="fs_class" class="radio_input" data-packaging="${params.packaging}" value="${params.taggedSeedClass}>
						<label for="fs_class" id="fs_label" class="radio_label">Foundation Seed</label>
					`;
				}

				if(checkClassRS === undefined && checkClassRS !== 'RS'){
					html += `
						<input type="radio" id="rs_class" name="seed_class" class="radio_input" >
						<label for="rs_class" id="rs_label" class="radio_label disabled radio-disabled">Registered Seed</label>
					`;
				}
				else{
					html += `
						<input type="radio" id="rs_class" name="seed_class" class="radio_input" data-packaging="${params.packaging}" value="${params.taggedSeedClass}">
						<label for="rs_class" id="rs_label" class="radio_label">Registered Seed</label>
					`;
				}

				html += `
					</div>
					<div class="packaging_div"></div>

					<p class="m-0">Quantity (per bag)</p>
					<div class="qty_wrapper">
						<button class="minus"></button>
						<input type="number" min="0" value="1" name="quantity" class="quantity">
						<button class="plus"></button>
					</div>
				`;

			return html;
		}

		/*ALL BUTTONS HERE*/
		$(document).on('click','.product a',function(e){
			e.preventDefault();
		})
		//refresh the displayed seeds according to page
		$(document).on('click','.pagination a', function(e){
			e.preventDefault();
			
			let page = $(this).attr('href').split('page=')[1];
			display_seed(page);
		})

		//display the seeds details when clicked the product detail button
		$(document).on('click','.product_detail_button',function(e){
			e.preventDefault()
			let variety=$(this).data('id');
			seed_detail(variety);
			//$('#exampleModal').modal();
		})

		$(document).on('click','.buy_now_button',function(e){
			e.preventDefault();
		})

		$(document).on('click','.add_to_cart_button', function(e){
			e.preventDefault();

			let seed_variety = this.parentNode.parentNode.querySelector('.seed_div').dataset.id;
			let seed_class = $("input[name='seed_class']:checked").val();
			let quantity = $(".quantity").val();
			if(seed_class === undefined){
				alert('please select seed_class')
			}
			else{
				let params = {id:seed_variety,seed_class:seed_class,quantity:quantity};
				add_to_cart(params);
			}		
		})

		$(document).on('change','input:radio[name="seed_class"]',function(){
			let html = "";
			if($(this).is(':checked') && $(this).val() === 'FS'){
				html += ` <p class="m-0">Packaging (kgs/bag)</p>
					<h4>${$(this).data('packaging')} kilograms</h4>
				`;
			}
			else{
				html += ` <p class="m-0">Packaging (kgs/bag)</p>
					<h4>${$(this).data('packaging')} kilograms</h4>
				`;
			}

			$('.add_to_cart_button').prop('disabled',false).css('cursor','pointer')
			document.querySelector('.packaging_div').innerHTML = html;
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

				let append_seed = document.getElementById("append_seed");
				$('.append_here').html(response);
				
			})
		}

		//display the details of selected seed
		function seed_detail(variety){
			$.ajax({
				url:'seed_details',
				type:'POST',
				data:{
					variety :variety
				}
			})
			.done(function(response){
				
				/*fs = response.data.filter(function(test){
					return test.taggedSeedClass == 'FS'
				})
				rs = response.data.filter(function(test){
					return test.taggedSeedClass == 'RS'
				})*/
				//console.log(fs.maturity,rs);
				
				$('#exampleModalLabel').html('<h2>'+response['variety']+'</h2>')
				document.querySelector('.modal-body').innerHTML = seedModalTemplate(response);;
				//$('#exampleModal .modal-body').html(html);
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