<?  session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>

<style>
body{
	font-family:"TH SarabunPSK";
}
.textindent{
	text-indent:2.5cm;
}
.textindent2{
	text-indent:1cm;
}
.textindent3{
	text-indent:5cm;
}
.textindent5{
	text-indent:7cm;
}
.textindent4{
	text-indent:3cm;
}
.fonth1{
	font-size:18pt;
}
.font2{
	font-size:16pt;
}
.font3{
	font-size:10pt;
}
</style>
</head>
<?
 include("connect.inc");

    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
   If ($result){
	$regisdate=$row->regisdate;
	$idcard =$row->idcard;
	$vHN =$row->hn;
	$yot=$row->yot;
	$name=$row->name;
	$surname =$row->surname;
    $ptname=$yot.' '.$name.'  '.$surname;
	$goup =$row->goup;
	$married =$row->married;
//	$cbirth (วันเกิดข้อความเก็บไว้ดู)
	$cbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
	$dbirth =$row->dbirth;
	$guardian=$row->guardian;
	$idguard=$row->idguard;
	$nation =$row->nation;
	$religion =$row->religion;
	$career =$row->career;
	$ptright =$row->ptright;
	$address =$row->address;
	$tambol =$row->tambol;
	$ampur =$row->ampur;
	$changwat =$row->changwat;
	$phone =$row->phone;
	$phone2 =$row->phone2;
	$father =$row->father;
	$mother =$row->mother;
	$couple =$row->couple;
	$note=$row->note;
	$sex =$row->sex;
	$camp =$row->camp;
	$race=$row->race;
$ptf=$row->ptf;
$ptfadd=$row->ptfadd;
$ptffone=$row->ptffone;
$ptfmon=$row->ptfmon;
//  2494-05-28
    $d=substr($dbirth,8,2);
    $m=substr($dbirth,5,2); 
    $y=substr($dbirth,0,4); 
    $birthdate="$d-$m-$y"; //print into opdcard
 //   $cAge=calcage($dbirth);
    $cPtname=$yot.' '.$name.' '.$surname;
  
                  }  
   else {
      echo "ไม่พบ HN : $cHn ";
           }   

include("unconnect.inc");

$dateday=date("d");
$datem=date("m");
$dateyear=(date("Y")+543);


switch($datem){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}

?>
<body onload="window.print()">
<!--<table width="100%" border="0">
  <tr>
    <td class="textindent">--><table width="100%" border="0">
      <tr>
        <td class="textindent2">&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="35%" class="textindent2">&nbsp;</td>
        <td >&nbsp;</td>
      </tr>
      <tr>
        <td width="35%"  rowspan="3" class="textindent2"><img src="images/L83LVEIGXVK9GDJ.jpg" alt="" width="70" height="70" /></td>
        <td width="65%" ><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
      </tr>
      <tr>
        <td><strong>หนังสือขอสำเนาประวัติการรักษาพยาบาล</strong></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="center">วันที่ <?=$dateday;?>&nbsp;&nbsp;เดือน <?=$printmonth;?> พ.ศ. <?=$dateyear;?>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
      <tr>
        <td colspan="2">&nbsp;</td>
        </tr>
      <tr>
        <td colspan="2" class="textindent2">เรื่อง ขอสำเนาประวัติผู้ป่วย</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">เรียน แพทย์ผู้เกี่ยวข้อง</td>
      </tr>
      <tr>
        <td height="32" colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">ด้วยข้าพเจ้า..............................................................................อยู่บ้านเลขที่ .....................หมู่ที่..........................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">ตำบล......................................................อำเภอ...............................................จังหวัด..........................................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">หมายเลขโทรศัพท์..............................................มีความประสงค์ขอสำเนาประวัติ</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2">ผู้ป่วยชื่อ  <strong>
        <?=$ptname;?></strong>
        HN
          <strong>
          <?=$vHN?>
          </strong> &nbsp;หมายเลขประชาชน <strong>
          <?=$idcard;?>
        </strong> &nbsp;&nbsp;เพื่อ</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ประกอบการักษาต่อ ณ สถานพยาบาลอื่น</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> ประกอบการพิจารณา เกี่ยวกับกิจการประกันชีวิต</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ระบุเหตุผล...............................................................................................................</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> เป็นพยานเอกสาร</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> อื่นๆ (ระบุ................................................................................................................)</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">ซึ่งข้าพเจ้าเกี่ยวเกี่ยวข้องกับเจ้าของประวัติในฐานะ...........................................................................และ</td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;"> ข้าพเจ้าทราบดีว่า การขอสำเนาประวัติผู้ป่วยในครั้งนี้ของข้าพเจ้า อาจทำให้เกิดผลเสียหายต่อทางโรงพยาบาลค่ายสุรศักดิ์มนตรี </td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;">หรือแพทย์ผู้เกี่ยวข้องหรือเจ้าหน้าที่ที่เกี่ยวข้อง  ข้าพเจ้าขอรับรองว่าหากเกิดผลเสียหายจากการขอสำเนาประวัติผู้ป่วยของข้าพเจ้าในครั้งนี้ </td>
      </tr>
      <tr>
        <td colspan="2" style="text-justify :newspaper; text-indent:1cm;">ข้าพเจ้ายินดีรับผิด รวมกระทั่งยินยอมให้ผู้ที่อาจได้รับความเสียหาย ได้ใช้หนังสือยืนยันต่อผู้เกี่ยวข้องต่อไป</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent">จึงเรียนมาเพื่อโปรดพิจารณา</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent5">ขอแสดงความนับถือ</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ลงชื่อ)............................................................................ผู้ยื่นคำร้อง</td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><u>หมายเหตุ</u> &nbsp;&nbsp;<u>เอกสารประกอบ </u></td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> สำเนาบัตรประจำตัวผู้ขอ</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> สำเนาบัตรประจำตัวผู้ป่วย</span></td>
      </tr>
      <tr>
        <td colspan="2" class="textindent2"><span class="textindent"><img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> สำเนาทะเบียนบ้านผู้ขอ &nbsp;&nbsp;&nbsp;&nbsp;<img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> สำเนาทะเบียนบ้านผู้ป่วย &nbsp;&nbsp;&nbsp;<img src="images/opdprint7_clip_image001.gif" alt="" width="16" height="16" /> หนังสือมอบอำนาจ </span></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent3">(ลงชื่อ)............................................................................แพทย์ผู้อนุญาต</span></td>
      </tr>
      <tr>
        <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="textindent3">(ลงชื่อ)............................................................................จนท.ผู้ดำเนินการ</span></td>
      </tr>
      <tr>
        <td colspan="2" class="font3 textindent3">กองตรวจโรคผู้ป่วยนอก เอกสารหมายเลข FR-OPD-002/15....แก้ไขครั้งที่ 02,1 ม.ค.52</td>
      </tr>
    </table><!--</td>
  </tr>
</table>-->
</body>
</html>