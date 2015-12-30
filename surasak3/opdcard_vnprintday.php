<?
session_start();
include("connect.inc");
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
?>
<script type="text/javascript">
window.onload= function () { window.print();window.close();   }
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-size: 20px;
	font-weight: bold;
}
.style4 {
	font-size: 32px;
	font-weight: bold;
}
-->
</style>
<?
if(isset($_GET['nat'])){
$detail=substr($_GET['detail'],0,5);
	if(isset($_GET['doctor'])){	
		$tell = "and doctor like '".$detail."%'";
	}else{
		$tell = "and detail = '".$detail."'";
	}
if(isset($_GET["act"]) && $_GET["act"]="show1"){
$query1 = "SELECT hn FROM appoint WHERE hn='".$_GET['hn']."' AND appdate = '".$_GET['nat']."' ".$tell." AND apptime <> 'ยกเลิกการนัด' order by hn ";	
//echo $query1;
}else{
$query1 = "SELECT hn FROM appoint WHERE appdate = '".$_GET['nat']."' ".$tell." AND apptime <> 'ยกเลิกการนัด' order by hn ";
}
$result1 = mysql_query($query1) or die("Query failed");
$num1=mysql_num_rows($result1);
if($num1 < 1){
	echo "ยกเลิกการนัด";
}
while(list($Thn) = mysql_fetch_array($result1)){
$hn = $Thn;

$sql="select * from opcard where hn='$hn'";
$query=mysql_query($sql) or die ("Query fail on line 37");
$rows=mysql_fetch_array($query);


$yy=date("Y")+543;
$mm=date("m");
$dd=date("d");
$time=date('H:i:s');
$newdate="$yy$mm$dd";
$thaidate="$dd/$mm/$yy ".$time;
$thaidatehn="$dd-$mm-$yy".$hn;

$strSQL="select * from opcard where hn='$hn'";
$strQuery=mysql_query($strSQL) or die ("Query fail on line 50");
$strRows=mysql_fetch_array($strQuery);
?>
<?
if(isset($_GET["act"]) && $_GET["act"]="show1"){
	echo "";
}else{
	echo "<div style=\"page-break-after:always;\">";
}
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="6%" height="600" valign="top">&nbsp;</td>
  <td width="94%" height="600" valign="top">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="28" colspan="3" align="center" class="style2"><strong>แบบบันทึกการตรวจรักษาผู้ป่วยนอก</strong></td>
    <td width="51%" rowspan="5" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>
        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top">&nbsp;</td>
            </tr>
          
        </table>        </td>
        </tr>
      <tr>
        <td align="center" class="style3"><span class="style4">VN : ..........</span> วันที่ : <?=$_GET['nat'];?></td>
        </tr>
      <tr>
        <td align="center"><span class="style2">สิทธิ :
          <?=$strRows["ptright"];?>&nbsp;</span>EX04 ผู้ป่วยนัด</td>
      </tr>
    </table></td>
  </tr>
  <tr class="style2">
    <td height="28" colspan="3" align="center" class="style3"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="style3"><strong>ชื่อ : </strong><?=$rows["yot"].$rows["name"]."  ".$rows["surname"];?></td>
    <td width="23%" align="left" valign="top"><strong>HN : </strong><?=$rows["hn"];?></td>
  </tr>
  <tr align="left" valign="top">
    <td width="14%"><strong>อายุ : </strong><?=calcage($rows["dbirth"]);?></td>
    <td width="12%"><strong>เพศ : </strong>
      <? if($rows["sex"]=="ช" || $rows["sex"]=="1"){ echo "ชาย";}else if($rows["sex"]=="ญ" || $rows["sex"]=="2"){ echo "หญิง";}else{ echo "ไม่ได้ระบุ";}?></td>
    <td><?=$rows["idcard"];?></td>
  </tr>
</table>
<table width="100%" height="87%" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #000000;">
  <tr>
    <td width="45%" height="416" align="left" valign="top"><table width="100%" height="189" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="21" colspan="3"><strong>เวลา : </strong>.....................<strong>ลักษณะผู้ป่วย : </strong>...........................................</td>
        </tr>
      <tr>
        <td width="28%" height="21"><strong>BW : </strong> ..........Kg.</td>
        <td width="30%"><strong>High : </strong>..........cm.</td>
        <td width="42%"><strong>BP : </strong>........../..........mmHg.</td>
      </tr>
      <tr>
        <td height="21"><strong>T : </strong>..........c</td>
        <td><strong>P : </strong>.............../min</td>
        <td><strong>R : </strong>.............../min</td>
      </tr>
      <tr>
        <td height="21" colspan="3"><strong>บุหรี่ : </strong>...............<strong>สุรา : </strong>.................<strong>Pain Score : </strong>........................</td>
        </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>โรคประจำตัว : </strong>...............................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>อาการ : </strong>.............................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">............................................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">............................................................................................................</td>
      </tr>
    </table>
      <hr />
      <div style="margin-top:150px;" align="center">- สำหรับติดสติ๊กเกอร์ยา -</div>
    </td>
   <td width="55%" rowspan="2" align="left" valign="top" style="border-left:1px solid #000000;">
    <div><strong>สำหรับแพทย์ : </strong></div>

        <?
        $tbsql = "Select tradname, advreact  From drugreact where hn = '$hn' ";
        $tbquery=mysql_query($tbsql) or die ("Query fail on line 70");
		$tbnum=mysql_num_rows($tbquery);
		if($tbnum < 1){
		echo "<div style='height:50px;'></div>";
		echo "<div style='margin-top:400px;'><strong>แพทย์ผู้ตรวจ : </strong></div>";
		echo "<div><strong>คำแนะนำ : </strong></div>";	
		}else{
		echo "<div style='height:50px;'><strong>ผู้ป่วยแพ้ยา : </strong>";		
			while($tbrows=mysql_fetch_array($tbquery)){    
				$tradname=$tbrows["tradname"];
				 echo "$tradname, ";
			}
		echo "</div>";
		echo "<div style='margin-top:365px;'><strong>แพทย์ผู้ตรวจ : </strong></div>";
		echo "<div><strong>คำแนะนำ : </strong></div>";		
		}
        ?>    
    </td>
  </tr>
</table>
  </td>
 </tr>
</table>
<?
if(isset($_GET["act"]) && $_GET["act"]="show1"){
	echo "";
}else{
	echo "</div>";
}
?>
<?
/*$ok = "S";
$query ="UPDATE opday SET phaok='$ok'  WHERE thdatehn = '$thdatehn' AND vn = '".$vn."' ";
$result = mysql_query($query) or die("Query failed,update opday");*/
?>
<?
	} // close while
}  //close	isset($_GET['nat'])
?>