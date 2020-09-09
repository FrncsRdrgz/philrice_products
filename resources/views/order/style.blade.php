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
</style>