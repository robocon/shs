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
<strong>���͡������ DBF ������ 09 (IDX)</strong>
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

//---------------Start Dataset9---------------//
$dbname9 = "IDX".$yy.$mm.".dbf";
	$def9 = array(
	  array("AN","C",15),		  	  
	  array("DIAG","C",7),
	  array("DXTYPE","C",1),	  
	  array("DRDX","C",6)
	);
	
	// creation
	if (!dbase_create($dbname9, $def9)) {
	  echo "Error, can't create the database9\n";
	}	

	$sqlipc ="select * from ipcard where dcdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59'";   //  Query ��Ң����Ũҡ���ҧ ipcard
	$resultipc = mysql_query($sqlipc) or die("Query IDX Failed");
   	while($rowsipc = mysql_fetch_array($resultipc)){
		$anipc=$rowsipc["an"]; //  AN �����ù�����Ң�����
		$dateidx = substr($rows5["date"],0,10);
		

		$sql9 ="select * from diag  where an ='".$anipc."' ";    //  Query ��Ң����Ũҡ���ҧ opday
		$result9 = mysql_query($sql9) or die("Query failed9");
		$num9 =mysql_num_rows($result9);
		//echo "�ӹǹ : $num9";
		if($num9 > 1 ){
			while($rows9 = mysql_fetch_array($result9)){
			$an9=$rows9["an"];   //  AN �����ù�����Ң�����
			$diag9=$rows9["icd10"];  //  DIAG �����ù�����Ң�����
			
			//------------------��˹�����âͧ ��Դ�ͧ�ä
			$dxtype9=$rows9["type"];
			if($dxtype9=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="COMPLICATION"){
				$dxtype ="3";
			}else if(dxtype9=="OTHER"){
				$dxtype ="4";
			}else if(dxtype9=="EXTERNAL CAUSE"){
				$dxtype ="5";
			}else{
				$dxtype ="4";
			}	
			
			//---------------------��������Ъ������-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}
			
			$db9 = dbase_open($dbname9, 2);
				if ($db9) {
					  dbase_add_record($db9, array(
						  $anipc,   
						  $diag9, 		
						  $dxtype, 	
						  $newdrdx));   
							dbase_close($db9);
						}  //if db		
				} //while
		}else{
			$rows9 = mysql_fetch_array($result9);
			$an9=$rows9["an"];   //  AN �����ù�����Ң�����
			$diag9=$rows9["icd10"];  //  DIAG �����ù�����Ң�����
			
			//------------------��˹�����âͧ ��Դ�ͧ�ä
			$dxtype9=$rows9["type"];
			if($dxtype9=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="COMPLICATION"){
				$dxtype ="3";
			}else if(dxtype9=="OTHER"){
				$dxtype ="4";
			}else if(dxtype9=="EXTERNAL CAUSE"){
				$dxtype ="5";
			}else{
				$dxtype ="4";
			}	
			
			//---------------------��������Ъ������-------------------------//
			$doctor_name9=$rowsipc["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name9%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdrdx = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name9%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdrdx = $rowsinp["codedoctor"];
			}
			
			$db9 = dbase_open($dbname9, 2);
				if ($db9) {
					  dbase_add_record($db9, array(
						  $anipc,   
						  $diag9, 		
						  $dxtype, 	
						  $newdrdx));   
							dbase_close($db9);
						}  //if db
		} // if num
	}  //while		
			
//---------------End Dataset9---------------//

}  // if check box �Դ�ش����
?>