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

function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

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
$hn = $cHn;
$sql="select * from opcard where hn='$hn'";
//echo $sql;
$query=mysql_query($sql) or die ("Query fail on line 55");
$rows=mysql_fetch_array($query);

$yy=date("Y");
$mm=date("m");
$dd=date("d")+1;
$time=date('H:i:s');
if($dd <= 9){
$dd="0".$dd;
}else{
$dd=$dd;
}
$showdate="$dd/$mm/$yy";
$newdate="$yy-$mm-$dd";
$newdate=displaydate($newdate);

$query1 = "SELECT doctor FROM appoint WHERE hn='".$hn."' AND appdate = '".$newdate."' AND apptime <> 'ยกเลิกการนัด'";
//echo $query1;
$result1 = mysql_query($query1) or die("Query failed");
if(mysql_num_rows($result1) < 1){
	echo "<script>alert('ผู้ป่วย HN: $hn ไม่มีในรายการผู้ป่วยนัด');window.close();</script>";
}
$rows1=mysql_fetch_array($result1)
?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#000000">
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
        <td align="center" class="style3"><span class="style4">VN : ..........</span> วันที่ : <?=$newdate;?></td>
        </tr>
      <tr>
        <td align="center"><span class="style2">สิทธิ :
          <?=$rows["ptright"];?>&nbsp;</span>EX04 ผู้ป่วยนัด</td>
      </tr>
      <tr>
        <td align="center"> <?=$rows1["doctor"];?></td>
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
    <td width="17%"><strong>อายุ : </strong><?=calcage($rows["dbirth"]);?></td>
    <td width="9%"><strong>เพศ : </strong>
      <? if($rows["sex"]=="ช" || $rows["sex"]=="1"){ echo "ชาย";}else if($rows["sex"]=="ญ" || $rows["sex"]=="2"){ echo "หญิง";}else{ echo "ไม่ได้ระบุ";}?></td>
    <td><?=$rows["idcard"];?></td>
  </tr>
</table>
<table width="100%" height="87%" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #000000;">
  <tr>
    <td width="45%" align="left" valign="top"><table width="100%" height="189" border="0" cellpadding="0" cellspacing="0">
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
    <div style="height:50px;">
        <?
        $tbsql = "Select tradname, advreact  From drugreact where hn = '$hn' ";
        $tbquery=mysql_query($tbsql) or die ("Query fail on line 70");
		$tbnum=mysql_num_rows($tbquery);
		if($tbnum < 1){
		echo "";
		}else{
		echo "<strong>ผู้ป่วยแพ้ยา : </strong>";		
			while($tbrows=mysql_fetch_array($tbquery)){    
				$tradname=$tbrows["tradname"];
				 echo "$tradname, ";
			}
		}
        ?>    
    </div>
   <div style="margin-top:390px;"><strong>แพทย์ผู้ตรวจ : </strong></div>
    <div><strong>คำแนะนำ : </strong></div>
    </td>
  </tr>
</table>
  </td>
 </tr>
 </table>
	<?
/*    $ok = "S";
    $query ="UPDATE opday SET phaok='$ok'  WHERE thdatehn = '$thdatehn' AND vn = '".$vn."' ";
    $result = mysql_query($query) or die("Query failed,update opday");*/
    ?>  