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
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>พิมพ์ใบนำทางตรวจสุขภาพมหาวิทยาลัยสวนดุสิต 2560</title>
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
	font-size: 18px
}
@media print{
	#none_print { display:none;}
}
.style3 {
	color: #FFFF00
}
.style4 {color: #0000FF}
</style>
<!--<script>window.print();</script>-->
<?

$series=$_POST["series"];
$part="สวนดุสิต60";
$showpart="มหาวิทยาลัยสวนดุสิต 2560";
	$sql = "select HN,yot,name,surname,idcard,dbirth,agey,agem,exam_no,pid,datechkup  from opcardchk where part = '".$part."' and HN='60138' order by row asc";
	$result = mysql_query($sql);
	$i=300;
while($arr = mysql_fetch_array($result)){
	$i++;
	
	$birth_n= "วัน/เดือน/ปีเกิด :.....".$arr['dbirth']."......";
	$age2_n= "อายุ :..........".$arr['agey'].".........ปี";
		
	$add_n=".................................................................................................................................................";
	$tel_n="...........................................................";
	$name_n= $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
	$hn_n= $arr['idcard'];
	$runno= $arr['exam_no'];
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$programe= $arr['pid'];
	$hn=$arr['HN'];
	$prog=$arr['exam_no'];
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
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead">ตรวจวันที่ <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี&nbsp;&nbsp;
	   2.ส่งเอกสารการตรวจที่สถานีลงทะเบียน</span><br />
       <table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="86%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?></strong>
                   &nbsp;&nbsp;&nbsp;
                   HN XRAY : <strong>
                     <?=$hn;?></strong>
                     &nbsp;&nbsp;&nbsp;ชื่อ-สกุล : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   ลำดับ LAB : <strong>
                     <?="170110".$i;?>
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
                 <? if($programe==2){ ?>
                 <td width="7%" rowspan="2" align="left" bordercolor="#FFFF00" bgcolor="#FFFF00"><img src="images/bg-yellow.jpg" width="90" height="52" /></td>
                 <? }else if($programe==3){ ?>
                  <td width="7%" rowspan="2" align="left" bordercolor="#0000FF" bgcolor="#0000FF"><img src="images/bg-blue.jpg" width="90" height="52" /></td>
                  <? } ?>
               </tr>
               <tr>
                 <td height="23" align="left" class="pdx">น้ำหนัก...................กก. ส่วนสูง.....................ซม. BP................./.............. P...............ครั้ง/นาที</td>
                </tr>
           </table></td>
         </tr>
       </table>     
     <table width="99%">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>รายการตรวจสุขภาพ
           <!--<?//=$_POST['company']?>-->
           โปรแกรมที่ <?=$programe;?>
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
<? if($programe==1){ ?>         
         <table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 1</strong><br />
                     รับใบนำทาง<br />
เจ้าหน้าที่<br />
.............................</td>
                   </tr>
               </table>
               
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 2 </strong><br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 3</strong><br />
                     เจาะเลือด<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 4</strong><br />
                     XRAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 5</strong><br />
                     ตรวจตา<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 6</strong><br />
                       คืนเอกสารใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
             </tr>
         </table>
<? }else if($programe==2){ ?>  
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 1</strong><br />
รับใบนำทาง<br />
เจ้าหน้าที่<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 2 </strong><br />
วัดความดันโลหิต<br />
เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 3</strong><br />
เจาะเลือด<br />
เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 4</strong><br />
                       Swab Test<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 5</strong><br />
                     XRAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 6</strong><br />
                     ตรวจตา<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>               
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 7</strong><br />
                     คืนใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                                              
             </tr>
         </table>
<? }else if($programe==3){ ?>  
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 1</strong><br />
รับใบนำทาง<br />
เจ้าหน้าที่<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 2 </strong><br />
วัดความดันโลหิต<br />
เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 3</strong><br />
เจาะเลือด<br />
เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 4</strong><br />
                       XRAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 5</strong><br />
                     ตรวจ EKG<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 6</strong><br />
                     ตรวจตา<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>               
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 7</strong><br />
                     คืนใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                                              
                                            
             </tr>
         </table>
<? } ?>              
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong>*** หมายเหตุ ***</strong><br />
    - XRAY ตรวจที่ <strong>รถ XRAY จอดอยู่ที่ข้างห้อง CMS หลังห้องประชุม 1 </strong><br />
    <? if($programe==2){ ?>  
    - Swab Test ตรวจที่ <strong>ห้องตรวจสูตินารีเวช</strong><br />
    <? }else if($programe==3){ ?>  
    - EKG ตรวจที่ <strong>ห้องตรวจตา</strong><br />
    <? } ?>
    - เมื่อทำการตรวจครบทุกสถานีแล้ว <strong>กรุณานำเอกสารใบนำทางส่งคืนเจ้าหน้าที่ ณ จุดลงทะเบียน ห้องประชุม 1</strong><br />
    - กรุณาอย่าทำเอกสารใบนำทางหาย เป็นอันเด็ดขาด</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
}
?>    