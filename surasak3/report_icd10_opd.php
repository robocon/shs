<style>
.fonthead{
	font-family:"Angsana New";
	font-size:18PX;
	/*font-weight:bold;*/
}
.fontlist{
	font-family:"Angsana New";
	font-size:18PX;
}
</style>
<!-- นำสคริปต่างๆ เข้ามา -->
	<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
	<link rel="stylesheet" type="text/css" href="js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
 	<link rel="stylesheet" href="css/style.css" />

<script type="text/javascript">
		$(document).ready(function() {
	

			$('a[id^="show"]').fancybox({
				'width'				: '70%',
				'height'			: '100%',
				'autoScale'     	: false,
				'transitionIn'		: 'none',
				'transitionOut'		: 'none',
				'type'				: 'iframe',
				onClosed	:	function() {
					//parent.location.reload(true); 
				}
			});

		/*	$('a[id^="delete"]').fancybox({
				'width'				: '20%',
				'height'			: '20%',
				onStart		:	function() {
					return window.confirm('Do you want to delete?');
				},
				onClosed	:	function() {
					parent.location.reload(true); 
				}
			});
*/
			/*
				onStart		:	function() {
					return window.confirm('Continue?');
				},
				onCancel	:	function() {
					alert('Canceled!');
				},
				onComplete	:	function() {
					alert('Completed!');
				},
				onCleanup	:	function() {
					return window.confirm('Close?');
				},
				onClosed	:	function() {
					alert('Closed!');
				}
				*/

		});
	</script>
<form name="f1" method="post">
<table  border="0">

  <tr>
    <td  height="36">ค้นหาจาก 
      <input name="rdo4" type="radio" value="Y"  onClick="javaScript:if(this.checked){document.all.spName1.style.display=''; document.all.spName2.style.display='none'; }">
วันที่
<input name="rdo4" type="radio" value="N" onClick="javaScript:if(this.checked){document.all.spName1.style.display='none'; document.all.spName2.style.display='';}">
HN</td>
    <td > *เลือกการค้นหา จากวันที่ หรือ HN    <a target=_self  href='../nindex.htm'><----ไปเมนู</a></td>
  </tr>
    <tr>
    <td height="46" colspan="2"><span id="spName1" style="display:none;">วัน/เดือน/ปี :<select name='d_start'>
      <option value=''>ไม่เลือกวัน</option>
      <? 
				$dd=date("d");
				for($d=1;$d<=31;$d++){
					
					if($d<=9){
						$d="0".$d;	
					}
					?>
      
      <option value="<?=$d;?>" <? if($dd==$d){ echo "selected"; } ?>><?=$d;?></option>
      <?	
				}
				
				?>
      </select>
      <? $m=date('m'); ?>
      <select name="m_start">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' >";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
  <?
				}
				echo "<select>";
				?></span>
  <span id="spName2" style="display:none;">HN : <input type="text" name="hn" value=""></span></td>
    </tr>
  
  <tr>
    <td align="center"><input name="btnSubmit" type="submit" value="Submit"></td>
    <td align="center">&nbsp;</td>
    </tr>
</table>

</form>


<table>
 <tr class="fonthead">
  <th bgcolor=CD853F>วันและเวลา</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>ชื่อ-สกุล</th>
  <th bgcolor=CD853F>สิทธิ</th>
  <th bgcolor=CD853F>โรค</th>
  <th bgcolor=CD853F>PRINCIPLE</th>
  <th bgcolor=CD853F>CO-MORBIDITY</th>
  <th bgcolor=CD853F>COMPLICATION</th>
  <th bgcolor=CD853F>OTHER</th>
  <th bgcolor=CD853F>EXTERNAL CAUSE</th>
  <th bgcolor=CD853F>ICD9CM</th>
  <th bgcolor=CD853F>แพทย์</th>
  </tr>

<?php
if($_POST['btnSubmit']){
    include("connect.inc");
	
 $thisdate=$_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
 
 
 
	
  
  if($_POST['rdo4']=="Y"){
	$query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101,thdatehn ,officer2,icd9cm FROM opday WHERE thidate like  '$thisdate%' ORDER BY thidate asc   ";

  }else{
	  
	  $query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101,thdatehn ,officer2,icd9cm FROM opday WHERE hn = '$hn' ORDER BY thidate asc   ";
  }
    $result = mysql_query($query)or die("Query failed");
$i=0;
    while (list ($hn,$an,$vn,$ptname,$ptright,$thidate,$diag,$doctor,$okopd,$toborow,$borow,$officer,$icd10,$icd101,$thdatehn,$officer2,$icd9cm) = mysql_fetch_row ($result)) {
		
		$subdate=substr($thidate,0,10);
		
$i++;



?>


<tr class="fontlist">
   <td BGCOLOR=F5DEB3  valign="top"><?=$thidate;?></a></td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$hn;?></td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$an;?></td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$ptname;?></td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$ptright;?></td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$diag;?></td>
  <td BGCOLOR=F5DEB3  valign="top">
  <?   $sql1="select * from diag where hn ='".$hn."'  and svdate like '".$subdate."%' and  type='PRINCIPLE' ";
  	     $query1=mysql_query($sql1);
		 $arr1=mysql_fetch_array($query1);
  	if($arr1['icd10']!=''){
		
		echo $arr1['icd10'];
	} 
  ?>
</td>
  <td BGCOLOR=F5DEB3  valign="top">
  <?
  		 $sql2 = "SELECT * FROM diag where hn ='".$hn."'  and svdate like '".$subdate."%' and  type='CO-MORBIDITY' ";
		$query2=mysql_query($sql2);

	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows = 0;
	while($arr2=mysql_fetch_array($query2))
	{
	$intRows++;
	echo "<td>";									

	
		echo $arr2["icd10"].',';
		
		echo"</td>";
		if(($intRows)%2==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";
	?>
 </td>
  <td BGCOLOR=F5DEB3 valign="top">
  <?
  		 $sql3 = "SELECT * FROM diag where hn ='".$hn."'  and svdate like '".$subdate."%' and  type='COMPLICATION' ";
		$query3=mysql_query($sql3);

	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows3 = 0;
	while($arr3=mysql_fetch_array($query3))
	{
	$intRows3++;
	echo "<td>";									

	
		echo $arr3["icd10"].',';
		
		echo"</td>";
		if(($intRows3)%2==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";
	?>
  </td>
  <td BGCOLOR=F5DEB3  valign="top">
   <?
  		 $sql4 = "SELECT * FROM diag where hn ='".$hn."'  and svdate like '".$subdate."%' and  type='OTHER' ";
		$query4=mysql_query($sql4);

	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows4 = 0;
	while($arr4=mysql_fetch_array($query4))
	{
	$intRows4++;
	echo "<td>";									

	
		echo $arr4["icd10"].',';
		
		echo"</td>";
		if(($intRows4)%2==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";
	?>
  </td>
  <td BGCOLOR=F5DEB3  valign="top">
   <?
  		 $sql5 = "SELECT * FROM diag where hn ='".$hn."'  and svdate like '".$subdate."%' and  type='EXTERNAL CAUSE' ";
		$query5=mysql_query($sql5);

	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows5 = 0;
	while($arr5=mysql_fetch_array($query5))
	{
	$intRows5++;
	echo "<td>";									

	
		echo $arr5["icd10"].',';
		
		echo"</td>";
		if(($intRows5)%2==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";
	?>
  </td>
  <td BGCOLOR=F5DEB3  valign="top">
  
  <?
  		$sql6="select * from opicd9cm where hn ='".$hn."'  and svdate   like '".$subdate."%'  ";
  		$query6=mysql_query($sql6) or die (mysql_error());

	echo"<table border=\"0\"  cellspacing=\"1\" cellpadding=\"1\"><tr>";	
	$intRows6 = 0;
	while($arr6=mysql_fetch_array($query6))
	{
	$intRows6++;
	echo "<td>";									

	
		echo $arr6["icd9cm"].',';
		
		echo"</td>";
		if(($intRows6)%2==0)
		{
		echo"</tr>";
		}
		else
		{
		echo "<td>";
		}	
	}
	echo"</tr></table>";
	?>
  </td>
  <td BGCOLOR=F5DEB3  valign="top"><?=$doctor;?></td>
 </tr>

<?
       }
include("unconnect.inc");
       }
?>
</table>

