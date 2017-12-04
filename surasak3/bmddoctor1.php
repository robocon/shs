<?php
session_start();
include("connect.inc");
?>
<a target=_self  href='bmdhn.php'><<กลับ</a>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>
<?
function calcage($birth){
		$today = getdate();   
		$nY  = $today['year']; 
		$nM = $today['mon'] ;
		$bY=substr($birth,0,4)-543;
		$bM=substr($birth,5,2);
		$ageY=$nY-$bY;
		$ageM=$nM-$bM;
	
		if ($ageM<0) {
			$ageY=$ageY-1;
			$ageM=12+$ageM;
		}
	
		if ($ageM==0){
			$pAge="$ageY ปี";
		}else{
			$pAge="$ageY ปี $ageM เดือน";
		}
	
	return $pAge;
}
if(!isset($_POST['ch1'])){
	?>
	<script>
    	alert("กรุณาเลือกรายการตรวจก่อนคะ");
		window.history.back();
    </script>
	<?
}
$sql = "Select * From dorderbmd where idno= '".$_POST['ch1']."' limit 1";
$result = mysql_query($sql);
$arr = mysql_fetch_array($result);

$sql2 = "Select * From opday where thdatehn = '".date("d-m-").(date("Y")+543).$arr['hn']."' ";
$result2 = mysql_query($sql2);
$arr2 = mysql_fetch_array($result2);

$sql3 = "Select * From inputm where name= '".$arr['doctor']."' ";
$result3 = mysql_query($sql3);
$arr3 = mysql_fetch_array($result3);

?>
<table  border="0">
  <tr>
    <td>ผู้ป่วยนอก</td>
  </tr>
  <tr>
     <td>HN :<?=$arr['hn']?></td>
  </tr>
  <tr>
    <td>VN :<?=$arr2['vn']?></td>
    </tr>
  <tr>
   <td><?=$arr['ptname']?></td>
    </tr>
  <tr>
    <td><font color='#FF0000' style='font-size:18px'>อายุ: <?=$arr['age']?></font></td>
    </tr>
  <tr>
    <td bgcolor="#CCCC99"><font face="Angsana New" style="font-size:20px" ><u><strong>รายการตรวจ</strong></u><br>
#
    <?=$arr['detail']?>
จำนวน 1 รายการ ราคา
<?=$arr['price']?>
บาท<strong> เบิกไม่ได้
<?=$arr['sumnprice']?>
บาท</strong></font></td>
  </tr>
</table>
<form method="POST" action="bmdxray.php" onSubmit="return check();">
  <p><font face="Angsana New"><br>

&nbsp;&nbsp;&#3650;&#3619;&#3588;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;
  <select size="1" name="diag" id="aLink">
    <option value="ตรวจวิเคราะห์เพื่อการรักษา" <? if($arr['sumyprice']>0) echo "selected";?>>ตรวจวิเคราะห์เพื่อการรักษา</option>
    <option value="ตรวจสุขภาพ" <? if($arr['sumnprice']>0) echo "selected";?>>ตรวจสุขภาพ</option>
  </select>&nbsp;</font></p>
<font face="Angsana New">&nbsp;&nbsp;สิทธิ&nbsp;&nbsp;&nbsp;
<select name="pt" id="pt">
  <?
  	$sqlpt = "select * from ptright where status = 'a' order by code asc";
   $rowpt = mysql_query($sqlpt);
   while($resultpt = mysql_fetch_array($rowpt)){
	$re = $resultpt[0]." ".$resultpt[1];
	//R01 เงินสด
		if($cPtright==$re){
			 $c=0;
			 ?>
              	<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
             <?
		}
		else{
			$b=0;
			?>
  				<option value="<?=$re?>"><?=$re?></option>
  			<?
		}
	}
	if(!isset($c)){
		?>
  			<option value="<?=$cPtright?>" selected="selected"><?=$cPtright?></option>
  		<?
	}
   ?>
</select></font>
  <p><font face="Angsana New" >&nbsp;&nbsp;</font><font face="Angsana New">&#3649;&#3614;&#3607;&#3618;&#3660;&nbsp;&nbsp;
 
  <?php
   include("connect.inc");
   $month = array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
  
   ////////////////////////////////////
$strSQL = "SELECT name,doctorcode FROM doctor where status='y'  order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor" id="doctor"> 
<?
  	while($objResult = mysql_fetch_array($objQuery)) {
	?>
<option value="<?=$objResult["name"]?>" <? if($arr3['codedoctor']==$objResult["doctorcode"]) echo "selected";?>><?=$objResult["name"]?></option>
 	<?
	}
?>
</select>

	
 
 </font> <br>
 <br>
<input type="hidden" name="idno" value="<?=$_POST['ch1']?>">
   <input type="checkbox" name="payout" id="payout"> 
   คิดค่าบริการนอกเวลาราชการ

  200 บาท</p>
  <p><font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></font></p>
</form>

<!--<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="100%" >
<TR  bgcolor="#3366FF" class="font_title">
	<TD align="center" >No.</TD>
	<TD align="center" >วันที่สั่ง</TD>
	<TD align="center" >HN</TD>
	<TD align="center" >ชื่อ - สกุล</TD>
	<TD align="center" >แพทย์ผู้สั่ง</TD>
	<TD align="center" >เบิกได้</TD>
	<TD align="center" >เบิกไม่ได้</TD>
	<TD align="center" >ในเวลาราชการ</TD>
	<TD align="center" >นอกเวลาราชการ</TD>
</TR>
<?php
	/*$i=1;
	$Thidate = (date("Y")+543).date("-m-d");
	$sql = "Select * From dorderbmd where hn= '".$_SESSION['cHn']."' order by thidate desc";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_array($result)){

		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
		echo "<TD align=\"center\" >",$i,"</TD>";
		echo "<TD align=\"center\" >".substr($arr["thidate"],8,2)."-".substr($arr["thidate"],5,2)."-".substr($arr["thidate"],0,4)." ".substr($arr["thidate"],11)."</TD>";
		echo "<TD align=\"center\" >",$arr["hn"],"</TD>";
		echo "<TD align=\"center\" >",$arr["ptname"],"</TD>";
		echo "<TD align=\"center\" >",$arr["doctor"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumyprice"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumnprice"],"</TD>";
		if($arr["status"]=="Y"){
			echo "<TD align=\"center\" >หมดรายการ</TD>";
		}else{
			echo "<TD align=\"center\" ><A target='_blank' HREF=\"bmdxray.php?idno=".$arr["idno"]."&tvn=".$_SESSION['tvn']."&yprice=".$arr["sumyprice"]."\" onclick=\"return confirm('ยืนยันการคิดค่าใช้จ่ายรายการที่ $i?');\">หมดรายการ</A></TD>";
		}
		if($arr["status"]=="Y"){
			echo "<TD align=\"center\" >หมดรายการ</TD>";
		}else{
			echo "<TD align=\"center\" ><A target='_blank' HREF=\"bmdxray.php?idno=".$arr["idno"]."&tvn=".$_SESSION['tvn']."&yprice=".$arr["sumyprice"]."&out=300\" onclick=\"return confirm('ยืนยันการคิดค่าใช้จ่ายรายการที่ $i?');\">หมดรายการ</A></TD>";
		}
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
		echo "<TD colspan=\"9\" height=\"5\"></TD>";
		echo "</TR>";
		$i++;
	}*/
?>
</TABLE>-->

</body>
</html>
<?php include("unconnect.inc");?>