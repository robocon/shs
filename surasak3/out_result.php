<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บันทึกข้อมูลซักประวัตินอกหน่วย 2560</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.style1 {color: #FF0000}
.style2 {color: #0000FF}
</style>
</head>

<body>
<div id="no_print">
<form action="" method="post" name="f1">
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339933" class="pdxhead">
  <tr><td height="40" align="center" bgcolor="#66CC99"><strong>กรอกข้อมูล HN </strong></td>
  </tr>
  <tr><td align="left">HN: <input name="hn" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
</form>
<br />
<? 
if(isset($_POST['hn'])){
				
	include("connect.inc");		
	
			////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix2="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////
$part=$_GET["part"];
		
			$sql1="SELECT * ,concat(yot,name,' ',surname)as ptname,part FROM `opcardchk` WHERE HN='".$_POST['hn']."' ";	
			//echo "-->".$sql1;
	  	    $query=mysql_query($sql1) or die (mysql_error());
			$Row=mysql_num_rows($query);
			$arr=mysql_fetch_array($query);
			$hn=$arr['HN'];
			$ptname=$arr['ptname'];			

				$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
				//echo $sqlchk;
				$querychk=mysql_query($sqlchk) or die (mysql_error());
				$Rowchk=mysql_num_rows($querychk);
		
				if($Rowchk>0){
					
					$arrchk=mysql_fetch_array($querychk);	
					$data1="update";
					$button="<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
				}else{
					$data1="insert";
					$button="<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
				}
				
if(!$Row){	
			$sql2="SELECT hn as HN ,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='".$_POST['hn']."' ";	
			//echo "-->".$sql2;
	  	    $query=mysql_query($sql2) or die (mysql_error());
			$Row2=mysql_num_rows($query);	
			if(empty($Row2)){
				echo "<div align='center' class='fontsara'>!!! ไม่พบ HN  $_POST[hn]!! </div>";		
			}else{
				$arr=mysql_fetch_array($query);
				$hn=$arr['HN'];
				$ptname=$arr['ptname'];
				
				$sqlchk="SELECT * FROM `out_result_chkup` WHERE hn='".$hn."' and year_chk ='$nPrefix' ";
				//echo $sqlchk;
				$querychk=mysql_query($sqlchk) or die (mysql_error());
				$Rowchk=mysql_num_rows($querychk);
		
				if($Rowchk>0){
					
					$arrchk=mysql_fetch_array($querychk);	
					$data1="update";
					$button="<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
				}else{
					$data1="insert";
					$button="<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
				}
			}
}		
?>
<form action="" method="post" name="f2">
 <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF9900">
    <tr><td>
      <table width="100%">
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$hn?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$ptname?></strong>  &nbsp;&nbsp; หน่วย:    <strong><?=$part;?></strong>      </td>
      </tr>
    <tr>
      <td class="pdx">น้ำหนัก  <input name="weight" type="text" size="5" class="pdxhead" value="<?=$arrchk['weight']?>" />  กก. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ส่วนสูง <input name="height" type="text" size="5" class="pdxhead"   value="<?=$arrchk['height']?>"  /> 
        ซม. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP  
        <input name="bp1" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp1']?>"/> / <input name="bp2" type="text" size="5" class="pdxhead"  value="<?=$arrchk['bp2']?>"/>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;P
        <input name="p" type="text" size="5" class="pdxhead" id="p" value="<?=$arrchk['p']?>" />
ครั้ง/นาที</td>
      </tr>
    <tr>
      <td class="pdx">ผล X-RAY
        <input name="cxr" type="text" class="pdxhead" size="50" id="cxr" value="<?=$arrchk['cxr']?>" />
      </td>
    </tr>
    <tr>
      <td class="pdx">EKG
        <input name="ekg" type="text" class="pdxhead" size="50" id="ekg" value="<?=$arrchk['ekg']?>" />
      </td>
    </tr>
    <tr>
      <td class="pdx">ผลการตรวจความหนาแน่นของมวลกระดูก
        <input name="42702" type="text" class="pdxhead" size="50" id="42702" value="<?=$arrchk['42702']?>" />
      </td>
    </tr>
    <tr>
      <td align="left" class="pdx">
        <input type="hidden" name="ptname" value="<?=$ptname?>" />
        <input type="hidden" name="hn" value="<?=$hn?>" />
        <input type="hidden" name="part" value="<?=$part;?>" />
        <input type="hidden" name="row_id" value="<?=$arrchk['row_id']?>" />
        <?=$button;?></td>
      </tr>
      </table>
   </td></tr>
  </table>
</form>
<p>
  <?				
}
if(isset($_POST['okhn2'])){
	
	include("connect.inc");	
	

	
if($data1=="update"){
	
$update="UPDATE `out_result_chkup` SET `weight` = '".$_POST['weight']."',
`height` = '".$_POST['height']."',
`bp1` = '".$_POST['bp1']."',
`bp2` ='".$_POST['bp2']."',
`p` ='".$_POST['p']."' ,
`ekg`='".$_POST['ekg']."',
`va`='".$_POST['va']."',
`stool`='".$_POST['stool']."',
`cxr`='".$_POST['cxr']."',
`doctor_result`='".$_POST['doctor_result']."',
year_chk='".$nPrefix."',
`part`='".$_POST['part']."',
`42702` = '".$_POST['42702']."'
WHERE  `row_id` ='".$_POST['row_id']."' ";


}else if($data1=="insert"){
$active="y";
$update="INSERT INTO `out_result_chkup` ( `hn` , `ptname`  , `weight` , `height` , `bp1` , `bp2` , `p` , `ekg` , `va`, `cxr`, year_chk,`register`,`part`)
VALUES ('".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['weight']."', '".$_POST['height']."',  '".$_POST['bp1']."','".$_POST['bp2']."','".$_POST['p']."','".$_POST['ekg']."','".$_POST['va']."','".$_POST['cxr']."','$nPrefix', '','".$_POST['part']."');";
}
//echo $update;
$upquery=mysql_query($update)or die (mysql_error());

if($upquery){  //บันทึกสำเร็จ
	echo "<script>alert('บันทึกข้อมูลเรียบร้อยแล้ว');window.location='out_result.php?hn=$_POST[hn]&part=$_POST[part]&act=print';</script>" ;
}	
}
?>
<br />
<? 
include("connect.inc");			
$showpart=$_GET["part"];
$sql1="SELECT * FROM  out_result_chkup where part='$showpart' ORDER BY hn asc";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
?>
<h1 class="pdx" align="center">รายชื่อผู้ตรวจสุขภาพ <?=$showpart;?></h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
  <tr>
    <td width="3%" align="center" bgcolor="#FF99CC">#</td>
    <td width="7%" height="31" align="left" bgcolor="#FF99CC"><strong>HN</strong></td>
    <td width="26%" align="left" bgcolor="#FF99CC"><strong>ชื่อ-สกุล</strong></td>
    <td width="10%" align="left" bgcolor="#FF99CC"><strong>น้ำหนัก</strong></td>
    <td width="9%" align="left" bgcolor="#FF99CC"><strong>ส่วนสูง</strong></td>
    <td width="5%" align="left" bgcolor="#FF99CC"><strong>BP</strong></td>
    <td width="22%" align="left" bgcolor="#FF99CC"><strong>P</strong></td>
    <td width="9%" align="center" bgcolor="#FF99CC"><strong>สติ๊กเกอร์</strong></td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['ptname'];?></td>
    <td align="left"><?=$arr1['weight'];?></td>
    <td align="left"><?=$arr1['height'];?></td>
    <td align="left"><?=$arr1['bp1'].'/'.$arr1['bp2'];?></td>
    <td align="left"><?=$arr1['p'];?></td>
    <td align="center"><a href="out_result.php?hn=<?=$arr1['hn'];?>&part=<?=$showpart;?>&act=print">พิมพ์</a></td>
  </tr>
  <? } ?>
</table>
</div>
</body>
<?
if($_GET["act"]=="print"){
include("connect.inc");	
$showpart=$_GET["part"];
$sql1="SELECT * FROM  out_result_chkup where hn='$_GET[hn]' and part='$showpart'";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$arr1=mysql_fetch_array($query1);
$d=date("d");
$m=date("m");
$y=date("Y")+543;
$time=date("H:i:s");

$thidate="$d/$m/$y $time";
?>
<script type="text/javascript">
window.print();
</script>
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN : <?=$arr1['hn'];?>&nbsp;&nbsp;(<?php echo $thidate;?>)</td>
  </tr>
<tr>
    <td>ชื่อ-นามสกุล : <?=$arr1['ptname'];?></td>
  </tr>  
  <tr>
    <td>BP : <?php echo $arr1["bp1"];?> / <?php echo $arr1["bp2"];?> mmHg, T : 36.0 C, P : <?php echo $arr1["p"];?> ครั้ง/นาที</td>
  </tr>
  <tr>
    <td>นน : <?php echo $arr1["weight"];?> กก., สส : <?php echo $arr1["height"];?> ซม.</td>
  </tr>
  <tr>
    <td>S : <?=$arr1["part"];?> ตรวจสุขภาพประจำปี</td>
  </tr>    
</table>
<?
echo "<meta http-equiv='refresh' content='1; url=out_result.php?part=$arr1[part]'>" ;
}
?>
</html>