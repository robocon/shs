<?php 
session_start();
include("connect.inc");

if($_REQUEST['do']=='edit'){

	function DateDiff($strDate1,$strDate2){
		return (strtotime($strDate2) - strtotime($strDate1))/ ( 60 * 60 * 24 ); // 1 day = 60*60*24
	}
	
	$thidate = (date("Y")+543).date("-m-d H:i:s"); 
	$row=$_POST['row'];
	$p_edit=$_POST['p_edit'];
	$programmer=$_POST['programmer'];
	
	$date=substr($_POST['date'],0,10);  //วันที่แจ้ง
	list($y,$m,$d)=explode("-",$date);
	$y=$y-543;
	$date1="$y-$m-$d";
	
	$dateend=substr($thidate,0,10);  //วันที่เสร็จ
	list($yy,$mm,$dd)=explode("-",$dateend);
	$yy=$yy-543;
	$date2="$yy-$mm-$dd";	
	
	$hold=DateDiff("$date1","$date2");
	
	$update="UPDATE com_support SET status='n', p_edit='".$p_edit."' ,dateend='$thidate' , programmer='$programmer', hold='$hold' Where row='$row' ";
	$query=mysql_query($update);
	if($query){ 

		$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS"; // test
		$sMessage = iconv('TIS-620','UTF-8',"เรื่อง: $head\nดำเนินการเรียบร้อยโดย $programmer");
		$chOne = curl_init(); 
		curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
		curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
		curl_setopt( $chOne, CURLOPT_POST, 1); 
		curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage."&stickerPackageId=1&stickerId=114"); 
		$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
		curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
		curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
		$result = curl_exec( $chOne ); 
		curl_close($chOne);

		$_SESSION['supportMessage'] = "บันทึกข้อมูลเรียบร้อยแล้ว";
		header("Location: com_support.php");

	}else { 

		$_SESSION['supportMessage'] = "ไม่สามารถเพิ่มข้อมูลได้";
		header("Location: com_support.php");
	}
		
	exit;

}

?>
<style type="text/css">
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
	color: #FFFFFF;
}
</style>
<body bgcolor="#FFFFFF" >
<script language="javascript">
function fncSubmit()
{
	if(document.edit.p_edit.value=="")
	{
		alert('ใส่ผลการดำเนินงาน');
		document.edit.p_edit.focus();		
		return false;
	}	
	
	document.edit.submit();
}

</script>
<?
$row=$_GET['row'];
$query = "SELECT  *  FROM com_support   WHERE row ='$row'";
$result = mysql_query($query)or die("Query failed"); 
$dbarr=mysql_fetch_array($result);
?>

<form method="POST" action="?do=edit" onSubmit="JavaScript:return fncSubmit();" name="edit">
<input type="hidden" name="date" value="<?=$dbarr["date"];?>">
<table align="center" cellpadding="0" cellspacing="0" class="forntsarabun">
  <tr>
    <td height="48" colspan="4" bgcolor="#CC6699"><span class="style2"><strong>ระบบแจ้ง เพิ่มแก้ไข/ปรับปรุง เพิ่มเติม โปรแกรมโรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></span></td>
    </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>แผนก</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="depart" id="depart" class="forntsarabun">
      <option value="0">เลือกแผนก</option>
      <?
		$sql="select  *  from   departments where status='y' order by id asc";
		$result=mysql_query($sql);
			while($arr=mysql_fetch_array($result)) {
				if($dbarr['depart']==$arr['name']){
    				echo '<option value="'.$arr['name'].'" selected>'.$arr['name'].' </option>';
				}else{
					echo '<option value="'.$arr['name'].'">'.$arr['name'].' </option>';
				}
		}
	  ?>
    </select></td>
  </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>ประเภทงาน</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="jobtype" id="jobtype" class="forntsarabun">
        <option value="0">เลือกงาน</option>
        <option value="hardware" <? if($dbarr['jobtype']=="hardware"){ echo "selected";}?>>งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย</option>
        <option value="software" <? if($dbarr['jobtype']=="software"){ echo "selected";}?>>งานแก้ไข/พัฒนาโปรแกมโรงพยาบาล</option>
    </select></td>
  </tr>
  <tr>
    <td width="112" bgcolor="#FF99CC"><strong>หัวข้อ</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><input name="head" type="text" class="forntsarabun" value="<?=$dbarr['head'];?>" size="40" readonly></td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FF99CC"><strong>รายละเอียด</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><textarea name="detail" cols="100" rows="10" readonly class="forntsarabun"><?=$dbarr['detail'];?></textarea></td>
    </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>ผู้แจ้ง</strong></td>
    <td width="160" bgcolor="#FF99CC"><input name="user" type="text" class="forntsarabun" value="<?=$dbarr['user'];?>" size="20" readonly></td>
    <td width="102" bgcolor="#FF99CC">โทรศัพท์ภายใน</td>
    <td width="553" bgcolor="#FF99CC"><input name="phone" type="text" class="forntsarabun" value="<?=$dbarr['phone'];?>" size="20" readonly></td>
  </tr>
  <tr>
    <td bgcolor="#FF99CC"><strong>ผู้รับผิดชอบ</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><select name="programmer" class="forntsarabun" >
     <option value="0" selected>==กรุณาเลือก==</option>
    <option value="เทวิน  ศรีแก้ว" <? if($dbarr['programmer']=="เทวิน  ศรีแก้ว"){ echo "selected"; } ?>>เทวิน  ศรีแก้ว</option>
	<option value="กฤษณะศักดิ์  กันธะรส" <? if($dbarr['programmer']=="กฤษณะศักดิ์  กันธะรส"){ echo "selected"; } ?>>กฤษณะศักดิ์  กันธะรส</option>
    <option value="ชาญวิทย์  ตากาบุตร" <? if($dbarr['programmer']=="ชาญวิทย์  ตากาบุตร"){ echo "selected"; } ?>>ชาญวิทย์  ตากาบุตร</option>
    <option value="จักรพันธ์  รุ่งเรืองศรี" <? if($dbarr['programmer']=="จักรพันธ์  รุ่งเรืองศรี"){ echo "selected"; } ?>>จักรพันธ์  รุ่งเรืองศรี</option>
	<option value="ฐานะพัฒน์  นิลคำ" <? if($dbarr['programmer']=="ฐานะพัฒน์  นิลคำ"){ echo "selected"; } ?>>ฐานะพัฒน์  นิลคำ</option>    
    </select>    </td>
    </tr>
  <tr>
    <td valign="top" bgcolor="#FF99CC"><strong>ผลการดำเนินงาน</strong></td>
    <td colspan="3" bgcolor="#FF99CC"><textarea name="p_edit" cols="100" rows="5" class="forntsarabun"></textarea></td>
  </tr>
  <tr>
    <td bgcolor="#CC6699">&nbsp;</td>
    <td colspan="3" bgcolor="#CC6699"><input name="B1" type="submit" class="forntsarabun" value="ตกลง">
    <input type="hidden" name="row" value="<?=$row;?>">
      <input name="B2" type="reset" class="forntsarabun" value="ลบทิ้ง">
      &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<<ไปเมนู</a></td>
    </tr>
</table>
</form>

<?php


?>

</body>

