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
<strong>���͡������ DBF ������ 04 (ORF)</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
<font face="Angsana New">
��͹ 
</font>
</span>
 <select name="mon">
   <option value="01">���Ҥ�</option>
   <option value="02">����Ҿѹ��</option>
   <option value="03">�չҤ�</option>
   <option value="04">����¹</option>
   <option value="05">����Ҥ�</option>
   <option value="06">�Զع�¹</option>
   <option value="07">�á�Ҥ�</option>
   <option value="08">�ԧ�Ҥ�</option>
   <option value="09">�ѹ��¹</option>
   <option value="10">���Ҥ�</option>
   <option value="11">��Ȩԡ�¹</option>
   <option value="12">�ѹ�Ҥ�</option>
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
<input name="BOK" value="��ŧ" type="submit" />
  </span>
</form>
</div>

<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

//--------------------Start DataSet4-------------------------//
$dbname4 = "ORF".$yy.$mm.".dbf";
	$def4 = array(
	  array("HN","C",15),
	  array("DATEOPD","D"),
	  array("CLINIC","C",4),	  
	  array("REFER","C",5),
	  array("REFERTYPE","C",1),
	  array("SEQ","C",15)
	);

	// creation
	if (!dbase_create($dbname4, $def4)) {
	  echo "Error, can't create the database4\n";
	}	

	$db3 = dbase_open($dbname3, 2);
		if ($db3) {
			  dbase_add_record($db3, array(
				   $hn2, 
				  $clinic2, 
 				  $time2, 
				  $thidate2,
				  $sql, 
				  $hcode2));     
					dbase_close($db2);
				}  //if db
//--------------------End DataSet4-------------------------//	

}  // if check box �Դ�ش����
?>