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
$sql2 = "Select * From opday where thdatehn = '".date("d-m-").(date("Y")+543).$_SESSION['cHn']."' ";
$result2 = mysql_query($sql2);
$arr2 = mysql_fetch_array($result2);

$sql = "Select * From dorderbmd where hn= '".$_SESSION['cHn']."' limit 1";
$result = mysql_query($sql);
$arr = mysql_fetch_array($result);
$count1 = mysql_num_rows($result);
?>
<table  border="0">
  <tr>
    <td>ผู้ป่วยนอก</td>
   <td rowspan="5" valign="top">
   <?=$image;?>
 
 </td>
  </tr>
  <tr>
     <td>HN :<?=$arr2['hn']?></td>
  </tr>
  <tr>
    <td>VN :<?=$arr2['vn']?></td>
  </tr>
  <tr>
   <td><?=$arr2['ptname']?></td>
  </tr>
  <?
  if($count1>0){
  ?>
  <tr>
    <td><font color='#FF0000' style='font-size:18px'>อายุ: <?=$arr['age']?></font></td>
  </tr>
  <?
  }
  ?>
</table>
<form method="POST" action="bmddoctor1.php" onSubmit="return check();">
<TABLE border="3" bordercolor="#FFFFFF" style='BORDER-COLLAPSE: collapse' width="50%" >
<TR  bgcolor="#3366FF" class="font_title">
	<TD align="center" >#</TD>
	<TD align="center" >วันที่สั่ง</TD>
	<TD align="center" >HN</TD>
	<TD align="center" >ชื่อ - สกุล</TD>
	<TD align="center" >แพทย์ผู้สั่ง</TD>
	<TD align="center" >เบิกได้</TD>
	<TD align="center" >เบิกไม่ได้</TD>
</TR>
<?
	$sql = "Select * From dorderbmd where hn= '".$_SESSION['cHn']."' and status='N' order by thidate desc";
	$result = mysql_query($sql);
	while($arr = mysql_fetch_array($result)){
		$i++;
		if($i % 2 == 0){
			$bgcolor="#FFFFFF";
		}else{
			$bgcolor="#BFFFBF";
		}
		
		echo "<TR bgcolor=\"",$bgcolor,"\">";
		echo "<TD align=\"center\" ><input name='ch1' type='radio' value='".$arr["idno"]."'></TD>";
		 echo "<TD align=\"center\" >".substr($arr["thidate"],8,2)."-".substr($arr["thidate"],5,2)."-".substr($arr["thidate"],0,4)." ".substr($arr["thidate"],11)."</TD>";
		echo "<TD align=\"center\" >",$arr["hn"],"</TD>";
		echo "<TD align=\"center\" >",$arr["ptname"],"</TD>";
		echo "<TD align=\"center\" >",$arr["doctor"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumyprice"],"</TD>";
		echo "<TD align=\"center\" >",$arr["sumnprice"],"</TD>";
		echo "</TR>";
		echo "<TR bgcolor=\"#FFFF06\">";
		echo "<TD colspan=\"9\" height=\"5\"></TD>";
		echo "</TR>";
		
			}
?>
  </TABLE>
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