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
<strong>���͡������ DBF ������ 10 (IOP)</strong>
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

//---------------Start Dataset10---------------//
$dbname10 = "IOP".$yy.$mm.".dbf";
	$def10 = array(
	  array("AN","C",15),		  
	  array("OPER","C",7),		  
	  array("OPTYPE","C",1),
	  array("DROPID","C",6),
	  array("DATEIN","D"),	  
 	  array("TIMEIN","C",4),
	  array("DATEOUT","D"),	 
	  array("TIMEOUT","C",4)
	);
	
	// creation
	if (!dbase_create($dbname10, $def10)) {
	  echo "Error, can't create the database10\n";
	}
	
	$sqliop ="select * from ipcard where dcdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59'";   //  Query ��Ң����Ũҡ���ҧ ipcard
	$resultiop = mysql_query($sqliop) or die("Query IOP Failed");
   	while($rowsiop = mysql_fetch_array($resultiop)){
		$aniop=$rowsiop["an"]; //  AN �����ù�����Ң�����
		//$dateidx = substr($rowsiop["dcdate"],0,10);
		

		$sql10 ="select * from ipicd9cm  where an ='".$aniop."' ";    //  Query ��Ң����Ũҡ���ҧ ipicd9cm
		$result10 = mysql_query($sql10) or die("Query failed10");
		$num10 =mysql_num_rows($result10);
		//echo "�ӹǹ : $num10";
		if($num10 > 1 ){
			while($rows10 = mysql_fetch_array($result10)){
			$an10=$rows10["an"];
			$oper10=$rows10["icd9cm"];   //  OPER �����ù�����Ң����� 
			$optype ="1";  //  OPTYPE �����ù�����Ң����� 
			
			//------------------��˹�����âͧ ��Դ�ͧ�ä
/*			$dxtype10=$rows10["type"];
			if($dxtype10=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="OTHER"){
				$dxtype ="3";
			}*/
			
			//---------------------��������Ъ������-------------------------//
			$doctor_name10=$rowsiop["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name10%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdropid = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name10%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdropid = $rowsinp["codedoctor"];
			}
			
			//datetime
			$datetime10=$rows10["icddate"];
			$date =explode("/",$datetime10);
			$newdate=$date[2]-543;
			$newdatein =$newdate.$date[1].$date[0];  //  DATEIN �����ù�����Ң�����
			//echo "$datetime10 --> $date --> $newdatein </br>";
			
			$newtimein = "1300";  //  TIMEOPD �����ù�����Ң�����			
			
			$db10 = dbase_open($dbname10, 2);
				if ($db10) {
					  dbase_add_record($db10, array(
						  $aniop, 	
						  $oper10, 	
						  $optype,
						  $newdropid, 		
						  $newdatein, 						  
						  $newtimein, 		
						  $dateout, 							  
						  $timeout));   
							dbase_close($db10);
						}  //if db		
				} //while
		}else{
			$rows10 = mysql_fetch_array($result10);
			$an10=$rows10["an"];
			$oper10=$rows10["icd9cm"];   //  OPER �����ù�����Ң����� 
			$optype ="1";  //  OPTYPE �����ù�����Ң����� 
			
			//------------------��˹�����âͧ ��Դ�ͧ�ä
/*			$dxtype10=$rows10["type"];
			if($dxtype10=="PRINCIPLE"){		
				$dxtype ="1";
			}else if(dxtype9=="CO-MORBIDITY"){
				$dxtype ="2";
			}else if(dxtype9=="OTHER"){
				$dxtype ="3";
			}*/
			
			//---------------------��������Ъ������-------------------------//
			$doctor_name10=$rowsiop["doctor"];
			$sqldoc ="select doctorcode from doctor where  name like  '%$doctor_name10%' ";   //  Query ��Ң����Ũҡ���ҧ doctor
			$resultdoc = mysql_query($sqldoc) or die("Query doctor failed");
			$numdoc = mysql_num_rows($resultdoc);
			$rowsdoc = mysql_fetch_array($resultdoc);
			if($numdoc > 0){
					$newdropid = $rowsdoc["doctorcode"];
			}else{			
			$sqlinp ="select codedoctor from inputm where  name like  '%$doctor_name10%' ";   //  Query ��Ң����Ũҡ���ҧ inputm
			$resultinp = mysql_query($sqlinp) or die("Query inputm failed");
			$rowsinp = mysql_fetch_array($resultinp);	
					$newdropid = $rowsinp["codedoctor"];
			}
			
			//datetime
			$datetime10=$rows10["icddate"];
			$date =explode("/",$datetime10);
			$newdate=$date[2]-543;
			$newdatein =$newdate.$date[1].$date[0];  //  DATEIN �����ù�����Ң�����
			//echo "$datetime10 --> $date --> $newdatein </br>";
			
			$newtimein = "1300";  //  TIMEOPD �����ù�����Ң�����						
			
			$db10 = dbase_open($dbname10, 2);
				if ($db10) {
					  dbase_add_record($db10, array(
						  $aniop, 	
						  $oper10, 	
						  $optype, 
						  $newdropid, 		
						  $newdatein, 						  
						  $newtimein, 		
						  $dateout, 							  
						  $timeout));   
							dbase_close($db10);
						}  //if db		
				} //while	
		}  // if num
//---------------End Dataset10---------------//

}  // if check box �Դ�ش����
?>