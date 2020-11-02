<script type="text/javascript">
	$(document).ready(function(){
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
			let quantity = $(this).closest('input[name="quantity"]');
			console.log(quantity);
		})
	})
</script>