<style type="text/css">
.disabled{
	color:#e8e8e1 !important;

}
.radio-disabled{
	pointer-events: none;
}
.seed_div.radio_label.disabled:before{
	position:absolute;
	content: "";
	border:1px solid;
	left:50%;
	top:0;
	bottom:0;
	transform: rotate(45deg);
}
.radio_input {
	clip: rect(0,0,0,0);
	height:1px;
	width:1px;
	position: absolute;
}

.radio_label{
	border:1px solid #ddd;
	padding:0.2rem;
	color: black;
	margin-right:.3rem;
}

.seed_div #rs_class:checked+label{
	border:3px solid;
	background:green;
	color:white;
	font-weight: 700;
}

.seed_div #fs_class:checked+label{
	border:3px solid;
	background:red;
	color:white;
	font-weight: 700;
}


input[type="number"] {
  -webkit-appearance: textfield;
    -moz-appearance: textfield;
          appearance: textfield;
          text-align: center;
}
input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
  -webkit-appearance: none;
}
.qty_wrapper {
  border: 2px solid #ddd;
  width: 11.8rem;
}
.qty_wrapper button {
  -webkit-appearance: none;
  background-color: transparent;
  border: none;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  margin: 0;
  position: relative;
  outline: none;
  width: 3rem;
  height: 2rem;
  padding-top: .8rem;
}
.qty_wrapper button:before,
.qty_wrapper button:after {
  display: inline-block;
  position: absolute;
  content: '';
  height: 2px;
  transform: translate(-50%, -50%);
}
.qty_wrapper button.plus:after {
  transform: translate(-50%, -50%) rotate(90deg);
}

.qty_wrapper button.minus {
  padding-left: 8px;
}
.qty_wrapper button.plus {
  padding-left: 5px;
}
.qty_wrapper button:before,
.qty_wrapper button:after {
  width: 1rem;
  background-color: #212121;
}
.qty_wrapper input[type=number] {
  max-width: 5rem;
  padding: .5rem;
  border: solid #ddd;
  border-width: 0 2px;
  font-size: 2rem;
  height: 3rem;
  font-weight: bold;
  outline: none;
}

@media not all and (min-resolution:.001dpcm)
{ @supports (-webkit-appearance:none) and (stroke-color:transparent) {
  .qty_wrapper1.safari_only button:before, 
  .qty_wrapper1.safari_only button:after {
    margin-top: -.6rem;
  }
}
}

.product_detail_button:hover{
  cursor:pointer;
}

</style>