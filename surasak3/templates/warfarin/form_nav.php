<?php

$inter_active = ( $page === 'intervention' ) ? 'class="current"' : '' ;
$inr = ( $page === 'inr' ) ? 'class="current"' : '' ;
$warfarin = ( $page === 'warfarin' ) ? 'class="current"' : '' ;
$adr = ( $page === 'adr' ) ? 'class="current"' : '' ;
$inr6 = ( $page === 'inr6' ) ? 'class="current"' : '' ;
$inr1_5 = ( $page === 'inr1_5' ) ? 'class="current"' : '' ;
$inr_range = ( $page === 'inr_range' ) ? 'class="current"' : '' ;

?>
<style type="text/css">
.nav-guide{
	padding: 0;
	margin: 0;
	list-style: none;
	/*height: 32px;*/
}
.nav-guide li{
	display: block;
	position: relative;
	float: left;
	/*padding: 4px;*/
}
.nav-guide li a{
	/*padding: 4px;*/
	font-weight: bold;
}
.nav-guide li:before{
	content: "\00a0";
}
.nav-guide li:after{
	content: "\00a0>>";
}
#intervention{
	background-color: #6b6b6b;
	color: white;
}
.nav-guide .current{
	background-color: #6b6b6b;
	color: white;
}
.last-child:after{
	content: ""!important;
}
</style>
<div class="col">
	<div class="cell">
		<ul class="nav-guide">
			<li><a href="phar_warfarin.php?page=intervention&id=<?=$id;?>" <?=$inter_active;?>>Intervention</a></li>
			<li><a href="phar_warfarin.php?page=inr&id=<?=$id;?>" <?=$inr;?>>Inr</a></li>
			<li><a href="phar_warfarin.php?page=warfarin&id=<?=$id;?>" <?=$warfarin;?>>ให้ความรู้ยา Warfarin</a></li>
			<li><a href="phar_warfarin.php?page=adr&id=<?=$id;?>" <?=$adr;?>>ADR</a></li>
			<li><a href="phar_warfarin.php?page=inr6&id=<?=$id;?>" <?=$inr6;?>>INR > 6</a></li>
			<li><a href="phar_warfarin.php?page=inr1_5&id=<?=$id;?>" <?=$inr1_5;?>>INR < 1.5</a></li>
			<li class="last-child"><a href="phar_warfarin.php?page=inr_range&id=<?=$id;?>" <?=$inr_range;?>>INR ในช่วงเป้าหมาย</a></li>
		</ul>
	</div>
</div>