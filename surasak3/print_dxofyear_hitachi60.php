<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>พิมพ์ใบนำทางตรวจสุขภาพ</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 14pt;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 14pt;
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
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 16px
}
@media print{
	#none_print { display:none;}
}
</style>
<!--<script>window.print();</script>-->
<div id="none_print">
<p align="center"><strong>พิมพ์ใบนำทางตรวจสุขภาพ บ.ฮิตาชิ</strong></p>
</div>
<?
$part="ฮิตาชิ60";
$showpart="ฮิตาชิ 2560";
	$sql = "select *  from opcardchk where part = '".$part."' order by row asc";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$birth_n= "วัน/เดือน/ปีเกิด :.....".$arr['dbirth']."......";
	$age2_n= "อายุ :..........".$arr['agey'].".........ปี";
		
	$add_n=".................................................................................................................................................";
	$tel_n="...........................................................";
	$name_n= $arr['name'].' '.$arr['surname'];
	$hn_n= $arr['HN'];
	$runno= $arr['exam_no'];
	$age= $arr['agey'];
	$idcard =$arr['idcard'];
	$pro=$arr['pid'];
	$datechkup=$arr['datechkup'];
?> 
<div align="center" style="width: 99%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style='line-height:18px'>
        <td width="12%" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="82%" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">ใบนำทางการตรวจสุขภาพ
          <?=$showpart;?>
        </span></span></strong></td>
        <td width="6%" rowspan="3" align="right" valign="top"><div class="pdx" style="margin-right: 10px;"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=sprintf("%03d",$runno);?></div>
        </div></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305 ต่อ 6701</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead">ตรวจวันที่ <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี&nbsp;&nbsp;
	   2.ส่งเอกสารการตรวจที่จุดซักประวัติ</span><br />
       <table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?>
                   </strong>ชื่อ-สกุล : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   อายุ : <strong>
                     <?=$age;?> ปี
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">น้ำหนัก...................กก. ส่วนสูง.....................ซม.   P...............ครั้ง/นาที BP................./..............mmHg</td>
               </tr>
           </table></td>
         </tr>
       </table>       
     <table width="99%">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>รายการตรวจสุขภาพโปรแกรม ที่ <?=$pro;?> (เรียกเก็บ)
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
		<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td height="80">ห้องพยาธิ<br />
                       เจาะเลือด/ปัสสาวะ<br />
เจ้าหน้าที่<br />
<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td height="80">ห้อง XRAY<br />
                       XRAY<br />
                       เจ้าหน้าที่<br />
                       <br />
                       .............................<br /></td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td height="80">OPD ซักประวัติ<br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       <br />
                       .............................</td>
                 </tr>
               </table></td>
               <td>&nbsp;</td>
               </tr>
         </table>            
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong>*** หมายเหตุ ***</strong><br />
    - เมื่อทำการตรวจครบทุกสถานีแล้ว <strong>นำเอกสารส่งคืนเจ้าหน้าที่ ณ จุดซักประวัติ </strong><br />
    - กรุณาอย่าทำเอกสารใบนำทางหาย เป็นอันเด็ดขาด</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
?>    