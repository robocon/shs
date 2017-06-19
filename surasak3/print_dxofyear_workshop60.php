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
<title>Untitled Document</title>
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
	font-size: 12pt;
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
</style>
<!--<script>window.print();</script>-->
<?
$_GET["part"]="มูลนิธิคืนช้างสู่ธรรมชาติ60";
$showpart="มูลนิธิคืนช้างสู่ธรรมชาติ60";
if(isset($_GET['part'])){
	$sql = "select *  from opcardchk where part = '".$_GET['part']."' order by hn asc";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	$name_n= $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
	$hn_n= $arr['HN'];
	$runno= $arr['exam_no'];
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$exam_no= $arr['idcard'];
	$idcard =$arr['idcard'];
	$course=$arr['course'];
	$datechkup=$arr['datechkup'];
?> 
<div align="center" style="width: 99%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="82%" align="center" class="pdx">
			<strong>
				<span class="pdx">
					<span class="pdxhead">เอกสารใบนำทางการตรวจสุขภาพ (กรุณานำมาแสดงเมื่อมาใช้บริการ)</span>
				</span>
			</strong>
		</td>
        <td width="6%" rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=$runno;?></div>
        </span></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305-6</strong></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead">หน่วยงาน : <?=$showpart;?> &nbsp;&nbsp;ตรวจวันที่ <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี&nbsp;&nbsp;
	   2.ส่งเอกสารใบนำทางที่สถานีสุดท้ายที่ใช้บริการ</span><br />
       <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx">ชื่อ-สกุล : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;HN : <strong>
                   <?=$hn_n;?>
                   </strong>&nbsp;&nbsp;&nbsp;วัน/เดือน/ปีเกิด : <strong>
                   <?=$arr['dbirth'];?>
                   </strong>&nbsp;&nbsp;&nbsp;อายุ : <strong>
                   <?=$arr['agey'];?> ปี
                   </strong>&nbsp;&nbsp;&nbsp;สิทธิการรักษา : <strong>
                   <?=$arr['branch'];?>
                   </strong>                
                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">หมายเลขโทรศัพท์ .....................................................................</td>
               </tr>
           </table></td>
         </tr>
       </table>      
     <table width="756">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>ตรวจสุขภาพประจำปี
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
         <!-------- สถานีตรวจ  ----------->
			<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>สถานี 1 <br />
                       แผนกพยาธิวิทยา<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 2<br />
                       แผนกเอ๊กซเรย์<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 3<br />
                       ตรวจวัดสัญญาณชีพ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>                              
             </tr>
         </table>  
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong style="font-size: 20px;">*** หมายเหตุ ***</strong><br /><strong>สิทธิประกันสังคม</strong>  ผู้ประกันตนหญิงที่มีอายุตั้งแต่ 30 ปีขี้นไป ในการตรวจสุขภาพประจำปีสามารถตรวจมะเร็งปากมดลูกได้ <br />โดยประกันสังคมสนันสนุนค่าใช้จ่าย 50 บาทและต้องจ่ายส่วนเกินในการใช้บริการให้กับ ร.พ. จำนวน 150 บาท (คิดตามราคากรมบัญชีกลาง) <br />ท่านสนใจตรวจมะเร็งปากมดลูกหรือไม่ <br/>
<p><span style="margin-left:20px;">..........สนใจ</span><span style="margin-left:50px;">..........ไม่สนใจ</span></p>
</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    