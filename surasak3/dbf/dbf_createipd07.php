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
<strong>���͡������ DBF ������ 07 (IPD)</strong>
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

//--------------------Start DataSet7-------------------------//
$dbname7 = "IPD".$yy.$mm.".dbf";
	$def7 = array(
	  array("HN","C",15),
	  array("AN","C",15),
	  array("DATEADM","D"),	  
	  array("TIMEADM","C",4),
	  array("DATEDSC","D"),
	  array("TIMEDSC","C",4),	  
	  array("DISCHS","C",1),
 	  array("DISCHT","C",1),
	  array("WARDDSC","C",4),
	  array("DEPT","C",2),
	  array("ADM_W","C",7),
	  array("UUC","C",1),
	);

	// creation
	if (!dbase_create($dbname7, $def7)) {
	  echo "Error, can't create the database7\n";
	};
	
	$sql7 ="select * from ipcard where dcdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59'";   //  Query ��Ң����Ũҡ���ҧ ipcard
	$result7 = mysql_query($sql7) or die("Query IPD Failed");
   	while($rows7 = mysql_fetch_array($result7)){
		$hn7=$rows7["hn"];  //  HN �����ù�����Ң�����
		$an7=$rows7["an"]; //  AN �����ù�����Ң�����
	
		//datetimeADM
		$datetimead=$rows7["date"];
		$datead7 = substr($datetimead,0,10);
		$datead =explode("-",$datead7);
		$newdatead=$datead[0]-543;
		$newdateadm =$newdatead.$datead[1].$datead[2];  //  DATEADM�����ù�����Ң�����
		
		$timead = substr($datetimead,11,8);	
		$newtimead =explode(":",$timead);
		$newtimeadm = $newtimead[0].$newtimead[1];  //  TIMEADM �����ù�����Ң�����
		
		//datetimeDSC
		$datetimedc=$rows7["dcdate"];
		$datedc7 = substr($datetimedc,0,10);
		$datedc =explode("-",$datedc7);
		$newdatedc=$datedc[0]-543;
		$newdatedsc =$newdatedc.$datedc[1].$datedc[2];  //  DATEDSC�����ù�����Ң�����
		
		$timedc = substr($datetimedc,11,8);	
		$newtimedc =explode(":",$timedc);
		$newtimedsc = $newtimedc[0].$newtimedc[1];  //  TIMEDSC �����ù�����Ң�����
		
		$dischs=$rows7["dcstatus"]; //  DISCHS �����ù�����Ң�����
		$discht=substr($rows7["dctype"],0,1); //  DISCHT �����ù�����Ң�����			
		
		$warddsc=substr($rows7["bedcode"],0,2); //  WARDDSC �����ù�����Ң�����				
		$adm_w=$rows7["adm_w"]; //  ADM_W �����ù�����Ң�����
		$ucc7="1";  //  UCC �����ù�����Ң�����				
		
	$db7 = dbase_open($dbname7, 2);
		if ($db7) {
			  dbase_add_record($db7, array(
				  $hn7, 
				  $an7,		  
				  $newdateadm,
				  $newtimeadm, 		
				  $newdatedsc,
				  $newtimedsc, 						  
				  $dischs, 
				  $discht,
				  $warddsc, 						  
				  $dept, 	
				  $adm_w, 					  			  				  		  
				  $ucc7));   
					dbase_close($db7);
				}  //if db
	}  //while			
//--------------------End DataSet7-------------------------//

}  // if check box �Դ�ش����
?>