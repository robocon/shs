<?
session_start();
if (isset($sIdname)){} else {die;} //for security
include("connect.inc");

		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
		$newPrefix="25".$nPrefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-size: 18px;
	font-family: TH SarabunPSK;
}

-->
</style>
<title>รายงานรายชื่อกำลังพลทหารที่ลงทะเบียนตรวจสุขภาพ</title><form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
		 <option value="all">ทั้งหมดทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from armychkup where yearchkup = '$nPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
</form>
<?
echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
?>
<? if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){ $showcamp="ทุกหน่วย";}else{ $showcamp=$_POST["camp"];}
?>
<p align="center"><strong>รายชื่อกำลังพลทหารที่ลงทะเบียนตรวจสุขภาพ<br />หน่วย : <?=$showcamp;?></strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center"><strong>ลำดับ</strong></td>
    <td width="7%" align="center"><strong>HN</strong></td>
    <td width="38%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center"><strong>หน่วย</strong></td>
    <td width="10%" align="center"><strong>ตำแหน่ง</strong></td>
    <td width="11%" align="center"><strong>ช่วยราชการ</strong></td>
    <td width="16%" align="center"><strong>วันที่ลงทะเบียน</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
$sql = "select * from chkup_solider where yearchkup='$nPrefix' and (camp !='D33 หน่วยทหารอื่นๆ' && camp !='D34 กทพ.33') order by hn, camp asc, yot desc, chunyot asc, age desc";
}else{
$sql = "select * from chkup_solider where yearchkup='$nPrefix' and camp like '$_POST[camp]%'  order by yot desc, chunyot asc, age desc ";
}
//echo $sql;
$query = mysql_query($sql);
$i=0;
while($result=mysql_fetch_array($query)){
$i++;
$ptname=$result["yot"]." ".$result["ptname"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><? if(empty($result["camp"])){ echo "&nbsp;";}else{ echo $result["camp"];}?></td>
    <td><? if(empty($result["position"])){ echo "&nbsp;";}else{ echo $result["position"];}?></td>
    <td align="center"><? if(empty($result["ratchakarn"])){ echo "&nbsp;";}else{ echo $result["ratchakarn"];}?></td>
    <td align="center"><?=$result["thidate"];?></td>
  </tr>
<?
}
?>
</table>
<?
echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
?>
<p align="center"><strong>รายชื่อกำลังพลทหารที่บันทึกผลตรวจสุขภาพในระบบ<br />หน่วย : <?=$showcamp;?></strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center"><strong>ลำดับ</strong></td>
    <td width="7%" align="center"><strong>HN</strong></td>
    <td width="38%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center"><strong>หน่วย</strong></td>
    <td width="23%" align="center"><strong>ตำแหน่ง</strong></td>
    <td width="14%" align="center"><strong>ช่วยราชการ</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
$sql1 = "select * from armychkup where yearchkup='$nPrefix' and (camp !='D33 หน่วยทหารอื่นๆ' && camp !='D34 กทพ.33') order by camp asc, yot desc, chunyot asc, age desc";
}else{
$sql1 = "select * from armychkup where yearchkup='$nPrefix' and camp like '$_POST[camp]%' order by yot desc, chunyot asc, age desc";
}
//echo $sql1;
$query1 = mysql_query($sql1);
$num1 = mysql_num_rows($query1);
if(empty($num1)){
	echo "<tr><td colspan='3' align='center'>-------------------- ไม่มีข้อมูล --------------------</td></tr>";
}
$i=0;
while($result1=mysql_fetch_array($query1)){
$i++;
$ptname=$result1["yot"]." ".$result1["ptname"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result1["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><? if(empty($result1["camp"])){ echo "&nbsp;";}else{ echo $result1["camp"];}?></td>
    <td><? if(empty($result1["position"])){ echo "&nbsp;";}else{ echo $result1["position"];}?></td>
    <td align="center"><? if(empty($result1["ratchakarn"])){ echo "&nbsp;";}else{ echo $result1["ratchakarn"];}?></td>
  </tr>
<?
}
?>
</table>
<?
echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
?>
<p align="center"><strong>รายชื่อกำลังพลทหารที่ยังไม่ได้ตรวจ/ไม่มีผลตรวจสุขภาพในระบบ<br />หน่วย : <?=$showcamp;?></strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center"><strong>ลำดับ</strong></td>
    <td width="9%" align="center"><strong>HN</strong></td>
    <td width="47%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="16%" align="center"><strong>หน่วย</strong></td>
    <td width="12%" align="center"><strong>ตำแหน่ง</strong></td>
    <td width="12%" align="center"><strong>ช่วยราชการ</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
$sql2 = "select a.* from chkup_solider as a left join armychkup as b on a.hn=b.hn  where  b.hn is null  and a.yearchkup='$nPrefix' and (a.camp !='D33 หน่วยทหารอื่นๆ' && a.camp !='D34 กทพ.33') order by a.camp asc, a.yot desc, a.chunyot asc, a.age desc";
}else{
$sql2 = "select a.* from chkup_solider as a left join armychkup as b on a.hn=b.hn  where  b.hn is null  and a.yearchkup='$nPrefix' and a.camp like '$_POST[camp]%' order by a.yot desc, a.chunyot asc, a.age desc";
}
//echo $sql2;
$query2 = mysql_query($sql2);
$i=0;
while($result2=mysql_fetch_array($query2)){
$ptname=$result2["yot"]." ".$result2["ptname"];

	$sql4 = "select * from condxofyear_so where  yearcheck='$newPrefix' and hn ='".$result2["hn"]."' and (camp1 !='D33 หน่วยทหารอื่นๆ' && camp1 !='D34 กทพ.33') order by camp1 asc, chunyot1 asc, age desc";  //ถ้ามีในระบบเก่า
	$query4 = mysql_query($sql4);
	$num4=mysql_num_rows($query4);
	if($num4 < 1){  //ถ้าไม่ได้ตรวจในระบบเก่า
	$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result2["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><? if(empty($result2["camp"])){ echo "&nbsp;";}else{ echo $result2["camp"];}?></td>
    <td><? if(empty($result2["position"])){ echo "&nbsp;";}else{ echo $result2["position"];}?></td>
    <td align="center"><? if(empty($result2["ratchakarn"])){ echo "&nbsp;";}else{ echo $result2["ratchakarn"];}?></td>
  </tr>
<?
	}
}
?>
</table>
<?
echo "<div style='page-break-after : always; position: fixed; top:0; left:0;'>&nbsp;</div>";
?>
<p align="center"><strong>รายชื่อกำลังพลทหารที่มีผลตรวจสุขภาพแบบเดิม<br />หน่วย : <?=$showcamp;?></strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center"><strong>ลำดับ</strong></td>
    <td width="9%" align="center"><strong>HN</strong></td>
    <td width="43%" align="center"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center"><strong>หน่วย</strong></td>
    <td width="12%" align="center"><strong>ตำแหน่ง</strong></td>
    <td width="17%" align="center"><strong>วันที่ตรวจ</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
$sql3 = "select * from condxofyear_so where  yearcheck='$newPrefix' and (camp1 !='D33 หน่วยทหารอื่นๆ' && camp1 !='D34 กทพ.33') order by camp1 asc, chunyot1 asc, age desc";
}else{
$sql3 = "select * from condxofyear_so where  yearcheck='$newPrefix' and camp1 like '$_POST[camp]%' order by  camp1 asc, chunyot1 asc, age desc";
}
//echo $sql3;
$query3 = mysql_query($sql3);
$num3 = mysql_num_rows($query3);
if(empty($num3)){
	echo "<tr><td colspan='3' align='center'>-------------------- ไม่มีข้อมูล --------------------</td></tr>";
}
$i=0;
while($result3=mysql_fetch_array($query3)){
$i++;
$ptname=$result3["yot"]." ".$result3["ptname"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result3["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><? if(empty($result3["camp"])){ echo "&nbsp;";}else{ echo $result3["camp"];}?></td>
    <td><? if(empty($result3["camp1"])){ echo "&nbsp;";}else{ echo $result3["camp1"];}?></td>
    <td align="center"><?=$result3["thidate"];?></td>
  </tr>
<?
}
?>
</table>

<? } ?>

