'use strict';
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
/*Status
 1 = Pending
 2 = Processed
 3 = Cancelled
 4 = Completed
*/
let status = 0;

const orderHeader = document.querySelectorAll(".orderHeader");

const getAllOrders = function(){
	
	$.ajax({
		method:'GET',
		url:`getOrders?status=${status}`,
		success:function(res){
			document.querySelector('.order_div').innerHTML = (res.length !== 0) ? res.map(ordersTemplate).join("") : emptyTemplate();
		}
	})
}
const toggleActiveClass = function(elem){
	document.querySelector('.orderHeader.active').classList.remove('active');
	elem.classList.add('active');
	getAllOrders();
}
const emptyTemplate = function (){
	return `
		<div class="card bg-light no-radius">
			<div class="card-body">
				<div class="row justify-content-md-center">
					<div class="col-md-6 text-center">
						<p>There are no orders</p>
					</div>
				</div>
			</div>
		</div>
	`;
}

const ordersTemplate = function(item){
	let html = "";
	html +=`
		<div class="card bg-light no-radius">
			<div class="card-body order_div">
				<div class="row">
					<div class="col-md-11 border-bottom">
						<p class="m-0">Order No. : ${item.order_id}</p>
					</div>
					<div class="col-md-1 border-bottom">
					<p class="text-danger">`;
					if(item.status === 1) html += `Pending`
					else if (item.status === 2) html += `For Pickup`
					else if (item.status === 3) html += `Cancelled`
					else if (item.status === 4) html += `Completed`
	html += 		`</p>
					</div>
					<div class="container">
						${item.data.map(orderItemsTemplate).join("")}
					</div>
				</div>
			</div>
		</div>
	`;
	return html;
}

const orderItemsTemplate = function (item){
	return `<div class="row  border-bottom pb-3 pt-3">
			<div class="col-md-3 text-center">
				<img class="img-thumbnail" src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/15/No_image_available_600_x_450.svg/1280px-No_image_available_600_x_450.svg.png" alt="Colorlib Template">
				<div class="overlay"></div>
			</div>
			<div class="col-md-2">
				<p class="pt-2 m-0">Variety: <span class="font-weight-bold">${item.variety}</span></p>
				<p class="m-0">Average Yield: <span class="font-weight-bold">${item.ave_yld} t/ha</span></p>
				<p class="m-0">Max Yield: <span class="font-weight-bold">${item.max_yld} t/ha</span></p>
				<p class="m-0">Maturity: <span class="font-weight-bold">${item.maturity} days</span></p>
				<p class="m-0">Quantity: <span class="font-weight-bold"> ${item.quantity} bags</span></p>
			</div>
		</div>
		`;
	
}

for(let i = 0; i < orderHeader.length; i++){
	orderHeader[i].addEventListener('click', function(){
		if(this.id === 'btnAll' && status !== 0){
			status = 0;
			toggleActiveClass(this);
			/*document.querySelector('.orderHeader.active').classList.remove('active');
			this.classList.add('active');
			getAllOrders();*/
		}else if(this.id === 'btnPending' && status !== 1){
			status = 1;
			toggleActiveClass(this);
			/*document.querySelector('.orderHeader.active').classList.remove('active');
			this.classList.add('active');
			getAllOrders();*/
		}else if(this.id === 'btnProcessed' && status !== 2){
			status = 2;
			toggleActiveClass(this);
			/*document.querySelector('.orderHeader.active').classList.remove('active');
			this.classList.add('active');
			getAllOrders();*/
		}else if(this.id === 'btnCancelled' && status !== 3){
			status = 3;
			toggleActiveClass(this);
			/*document.querySelector('.orderHeader.active').classList.remove('active');
			this.classList.add('active');
			getAllOrders();*/
		}else if(this.id === 'btnCompleted' && status !== 4){
			status = 4;
			toggleActiveClass(this);
			/*document.querySelector('.orderHeader.active').classList.remove('active');
			this.classList.add('active');
			getAllOrders();*/
		}
		
	})
}
/*document.getElementById('btnAll').addEventListener('click', function(){
	if(status !== 0){
		status = 0;
		this.classList.add('active');
		getAllOrders();	
	}
	
});
document.getElementById('btnPending').addEventListener('click', function (){
	if(status !== 1){
		status = 1;
		getAllOrders();
	}
})

document.getElementById('btnProcessed').addEventListener('click', function (){
	if(status !== 2){
		status = 2;
		getAllOrders();
	}
})

document.getElementById('btnCancelled').addEventListener('click', function (){
	if(status !== 3){
		status = 3;
		getAllOrders();
	}
})

document.getElementById('btnCompleted').addEventListener('click', function (){
	if(status !== 4){
		status = 4;
		getAllOrders();
	}
})*/


//call all function here
getAllOrders();