<?php
    include("../connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 08 (IRF)</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
<font face="Angsana New">
เดือน 
</font>
</span>
 <select name="mon">
   <option value="01">มกราคม</option>
   <option value="02">กุมภาพันธ์</option>
   <option value="03">มีนาคม</option>
   <option value="04">เมษายน</option>
   <option value="05">พฤษภาคม</option>
   <option value="06">มิถุนายน</option>
   <option value="07">กรกฎาคม</option>
   <option value="08">สิงหาคม</option>
   <option value="09">กันยายน</option>
   <option value="10">ตุลาคม</option>
   <option value="11">พฤศจิกายน</option>
   <option value="12">ธันวาคม</option>
 </select>
<span class="font1">
<font face="Angsana New">
</font>
</span>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
<input name="BOK" value="ตกลง" type="submit" />
  </span>
</form>
</div>

<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

//---------------Start Dataset8---------------//
$dbname8 = "IRF".$yy.$mm.".dbf";
	$def8 = array(
	  array("AN","C",15),		  	  
	  array("REFER","C",5),
	  array("REFERTYPE","C",1)
	);
	
	// creation
	if (!dbase_create($dbname8, $def8)) {
	  echo "Error, can't create the database8\n";
	}	;

//---------------End Dataset8---------------//

}  // if check box ปิดสุดท้าย
?>