<?
session_start();
include("connect.inc");
function getAge($birthday) {
$then = strtotime($birthday);
return(floor((time()-$then)/31556926));
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
//$hn = $_GET["cHn"];
//$vn = $_GET["cVn"];

$sql="select * from opcard where hn='$hn'";
$query=mysql_query($sql) or die ("Query fail on line 37");
$rows=mysql_fetch_array($query);
$dateB=$rows["dob"]; // ตัวแปรเก็บวันเกิด


$yy=date("Y")+543;
$mm=date("m");
$dd=date("d");
$time=date('H:i:s');
$newdate="$yy$mm$dd";
$thaidate="$dd/$mm/$yy ".$time;
$thaidatehn="$dd-$mm-$yy".$hn;

$strSQL="select * from opday where hn='$hn' and vn='$vn' and thdatehn='$thaidatehn'";
$strQuery=mysql_query($strSQL) or die ("Query fail on line 50");
$strRows=mysql_fetch_array($strQuery);
$strlenvn=strlen($strRows["vn"]);
/*
if($strlenvn==1){
	$newvn="00".$strRows["vn"];
}else if($strlenvn==2){
	$newvn="0".$strRows["vn"];
}else{
	$newvn=$strRows["vn"];
}
*/

$vn=sprintf('%03d',$vn);

$newtoborow=substr($strRows["toborow"],2,2);

$runnoopd=$newdate.$vn.$newtoborow."0001";
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
            <td align="center" valign="top"><? print "<img src = \"barcode/opdcard.php?runnoopd=$runnoopd\" height=\"50\" width=\"300\">"; ?></td>
            </tr>
          
        </table>        </td>
        </tr>
      <tr>
        <td align="center" class="style3"><span class="style4">VN : <?=$strRows["vn"];?></span> วันที่ : <?=$thaidate; time("hh");?></td>
        </tr>
      <tr>
        <td align="left"><span class="style2">สิทธิ :
          <?=$strRows["ptright"];?></span>
           <?=$strRows["toborow"];?></td>
      </tr>
    </table></td>
  </tr>
  <tr class="style2">
    <td height="28" colspan="3" align="center" class="style3"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top"><strong>ชื่อ : </strong>......................................................</td>
    <td width="19%" align="left" valign="top"><strong>HN : </strong>.........................</td>
  </tr>
  <tr align="left" valign="top">
    <td width="15%"><strong>อายุ : </strong>.............</td>
    <td width="15%"><strong>เพศ : </strong>
      .................</td>
    <td>...................................</td>
  </tr>
</table>
<table width="100%" height="85%" border="0" cellpadding="0" cellspacing="0" style="border-top:1px solid #000000;">
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
        <td height="21" colspan="3" align="left" valign="top"><strong>อาการ : </strong>...........................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">..........................................................................................................</td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top">..........................................................................................................</td>
      </tr>
    </table>
      <hr />
      <div style="margin-top:150px;" align="center">- สำหรับติดสติ๊กเกอร์ยา -</div>
    </td>
   <td width="55%" rowspan="2" align="left" valign="top" style="border-left:1px solid #000000;">
    <div><strong>สำหรับแพทย์ : </strong></div>
    <div style="height:50px;">
        <?
		$hn="";
        $tbsql = "Select tradname, advreact  From drugreact where hn = '$hn' and hn !=''";
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
   <div style="margin-top:375px;"><strong>แพทย์ผู้ตรวจ : </strong></div>
    <div><strong>คำแนะนำ : </strong></div>
    </td>
  </tr>
</table>
  </td>
 </tr>
 </table>