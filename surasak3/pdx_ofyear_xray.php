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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
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
</style>
<div id="no_print" > 
<form action="<? $_SERVER['PHP_SELF']?>" method="POST" name="pdxofyear1">
	<table align="center" cellspacing="0">
    	<tr>
    	  <td colspan="2" align="center" bgcolor="#339966" class="pdxhead"><strong>ข้อมูลประวัติ</strong></td>
   	  </tr>
    	<tr>
          <td align="right" bgcolor="#FFFFCC"><span class="pdxhead">HN</span> : </td>
    	  <td bgcolor="#FFFFCC"><span class="pdxhead">
            <input name="hn_n" type="text" class="pdxpro" id="hn_n" size="30" />
          </span></td>
  	  </tr>
    	<tr>
    	  <td width="167" align="right" bgcolor="#FFFFCC"><span class="pdxhead">ชื่อ - นามสกุล</span> : </td>
    	  <td width="377" bgcolor="#FFFFCC"><span class="pdxhead">
    	    <input name="name_n" type="text" class="pdxpro" id="name_n" size="30" />
    	  </span></td>
  	  </tr>
    	<tr>
          <td align="right" bgcolor="#FFFFCC"><span class="pdxhead">เลขที่บัตรประชาชน : </span></td>
    	  <td bgcolor="#FFFFCC"><span class="pdxhead">
            <input name="idcard_n" type="text" class="pdxpro" id="idcard_n" size="30" />
          </span></td>
  	  </tr>
    	<tr>
    	  <td align="right" valign="top" bgcolor="#FFFFCC"><span class="pdxhead">ที่อยู่</span> : </td>
    	  <td valign="top" bgcolor="#FFFFCC"><label>
    	    <textarea name="address_n" cols="45" rows="5" class="pdxpro" id="address_n"></textarea>
    	  </label></td>
  	  </tr>
    	<tr>
    	  <td align="right" valign="top" bgcolor="#FFFFCC"><span class="pdxhead">ประเภทการตรวจ</span> : </td>
    	  <td valign="top" bgcolor="#FFFFCC"><span class="pdxhead">
    	    <input name="type_n" type="text" class="pdxpro" id="type_n" size="40" />
    	  </span></td>
  	  </tr>
        <tr>
          <td align="right" bgcolor="#FFFFCC"><span class="pdxhead">หน่วยงาน : </span></td>
        	<td bgcolor="#FFFFCC"><span class="pdxhead">
        	  <input name="company_n" type="text" class="pdxpro" id="company_n" size="40" />
   	    </span></td>
        </tr>
        <tr>
          <td align="right" bgcolor="#FFFFCC"><span class="pdxhead">วันที่ตรวจ : </span></td>
          <td bgcolor="#FFFFCC"><span class="pdxhead">
            <input name="datechkup_n" type="text" class="pdxpro" id="datechkup_n" size="30" />
          </span> <span class="pdx">ตัวอย่าง เช่น 1 มกราคม 2557 </span></td>
        </tr>
        <tr>
          <td align="left" bgcolor="#FFFFCC">&nbsp;</td>
        <td align="left" bgcolor="#FFFFCC"><div style="margin-left:60px;"><input name="okselect" type="submit" class="pdxpro"  value="   ตกลง   "/></div></td></tr>
</table>
</form>
</div>
<?
if(isset($_POST['okselect'])){
			$sql2 = "insert into pdxofyearxray set hn='".$_POST['hn_n']."', name='".$_POST['name_n']."', idcard='".$_POST['idcard_n']."', address='".$_POST['address_n']."', type='".$_POST['type_n']."', company='".$_POST['company_n']."', datechkup='".$_POST['datechkup_n']."'";
			//echo $sql2;
		if(mysql_query($sql2)){
				
		}else{
			echo "บันทึกข้อมูลผิดพลาด กรุณาบันทึกข้อมูลใหม่";
		}
	?>
    <script>
    window.print();
    </script>
<table width="100%">
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="8%" rowspan="3" align="center"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="75%" align="center" class="pdx"><strong><span class="pdxhead">แบบการตรวจสุขภาพ
              <?=$_POST['company_n']?>
        </span></strong></td>
        <td width="17%" align="center" class="pdx">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="pdx"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
        <td align="center" class="pdx">&nbsp;</td>
      </tr>
      <tr>
        <td align="center" class="pdx"><span class="pdxhead">ตรวจวันที่   <?=$_POST['datechkup_n']?></span></td>
        <td align="center" class="pdx">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
  <tr><td><span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      <strong>1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี</strong></span><br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$_POST['hn_n']?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$_POST['name_n']?></strong>
      <?=$_POST["age_n"]?>      </td>
      </tr>
    <tr>
      <td class="pdx">เลขบัตรปชช : <?=$_POST["idcard_n"]?>&nbsp;ที่อยู่ :
        <?=$_POST['address_n']?></td>
    </tr>
      </table>
      </td></tr>
    </table>
<table width="100%">
    <tr>
      <td class="pdxpro" colspan="2"><strong>รายการตรวจสุขภาพ</strong></td>
    </tr>
    <tr>
      <td class="pdxpro" colspan="2"><strong><?=$_POST['type_n']?></strong></td>
    </tr>
    <tr>
      <td class="pdx" colspan="2"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
      </tr>
    <tr>
      <td class="pdx" colspan="2">
      <table width="100" border="1" cellspacing="0" style="border: #666666 solid 1px;">
        <tr>
          <td align="center">สถานีที่ 1<br />
            XRAY<br />
            ......................................................</td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
    </tr>
    <tr>
      <td class="pdx">*** หมายเหตุ กรุณานำเอกสารคืนเจ้าหน้าที่ xray เมื่อทำการตรวจเสร็จแล้ว</td>
    </tr>
    </table>
</td></tr></table>
<?

}
include("unconnect.inc");

?>