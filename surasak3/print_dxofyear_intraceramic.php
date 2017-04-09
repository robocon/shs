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
	font-size: 14px
}
</style>
<!--<script>window.print();</script>-->
<?
$_GET["part"]="อินทราเซรามิค";
$showpart="อินทราเซรามิค";
if(isset($_GET['part'])){
	$sql = "select *  from opcardchk where part = '".$_GET['part']."' order by row asc limit 1";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$birth_n= "วัน/เดือน/ปีเกิด :.....".$arr['dbirth']."......";
	$age2_n= "อายุ :..........".$arr['agey'].".........ปี";
		
	$add_n="............................................................................................................";
	$tel_n="..............................................";
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
        <td width="82%" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจสุขภาพ
          <?=$showpart;?>
        </span></span></strong></td>
        <td width="6%" rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=$runno;?></div>
        </span></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead">ตรวจวันที่ <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี&nbsp;&nbsp;
	   2.ส่งเอกสารการตรวจที่สถานีลงทะเบียน</span><br />
       <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?>
                   </strong>ชื่อ-สกุล : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   เลขที่บัตร : <strong>
                     <?=$exam_no;?>
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">ที่อยู่ :
                   <?=$add_n;?>
                   &nbsp;โทรศัพท์ :
                   <?=$tel_n;?> ความเห็นแพทย์</td>
               </tr>
               <tr>
                 <td align="left" class="pdx">น้ำหนัก...................กก. ส่วนสูง.....................ซม. BP................./.............. P...............ครั้ง/นาที</td>
               </tr>
           </table></td>
         </tr>
       </table>
<?
$arrtype = array('ตรวจ x-ray ปอด','CBC(ตรวจความสมบูรณ์ของเม็ดเลือด)','UA(ตรวจปัสสาวะ)','ไขมัน(CHOL,TRI)','เบาหวาน(BS)','ตรวจหน้าที่ของตับ(SGOT,SGPT,ALK)','ตรวจหน้าที่ของไต(BUN,CR)','เก๊าท์(URIC)');
$arrprice = array('560','90.00','50.00','120.00','40.00','150.00','100.00','60.00');

//$arrtype1 = array('น้ำตาลในเลือด(BS)','ไขมันในเลือด (CHOL)','ตรวจการทำงานของไต(CR)','ตรวจการทำงานของตับ(SGOP,SGOT)');
if($prog==1){
$arrtype2= array('ตรวจร่างกายทั่วไปโดยแพทย์(PE)','ตรวจความสมบูรณ์ของเม็ดเลือด (CBC)','ตรวจปัสสาวะสมบูรณ์แบบ (UA)','X-ray (ฟิมส์ใหญ่)');
	
	$pro="โปรแกรมที่1 (อายุน้อยกว่า 35 ปี) ";
	$p="P1";
}elseif($prog==2){


$arrtype2= array('ตรวจร่างกายทั่วไปโดยแพทย์(PE)','ตรวจความสมบูรณ์ของเม็ดเลือด (CBC)','ตรวจปัสสาวะสมบูรณ์แบบ (UA)','X-ray (ฟิมส์ใหญ่)','ภายใน(สำหรับผู้หญิงบริการที่โรงพยาบาล)','ตรวจมะเร็งปากมดลูก(สำหรับผู้หญิงบริการที่โรงพยาบาล)');
$pro="โปรแกรมที่2 (อายุน้อยกว่า 35 ปี) ";
$p="P2";

}else if($prog==3){
$arrtype2= array('ตรวจร่างกายทั่วไปโดยแพทย์(PE)','ตรวจความสมบูรณ์ของเม็ดเลือด (CBC)','ตรวจปัสสาวะสมบูรณ์แบบ (UA)','X-ray (ฟิมส์ใหญ่)','ตรวจน้ำตาลในเลือด(FBS)','การตรวจหาระดับกรดยูริค (Uric)','ตรวจการทำงานของตับ(SGOP,SGOT)','ตรวจการทำงานของไต(CR,BUN)','ตรวจไขมันในเลือด(CHOL,TRI)');

	
	$pro="โปรแกรมที่3 (อายุมากกว่า 35 ปี)  ";
	$p="P3";
}else if($prog==4){
$arrtype2= array('ตรวจร่างกายทั่วไปโดยแพทย์(PE)','ตรวจความสมบูรณ์ของเม็ดเลือด (CBC)','ตรวจปัสสาวะสมบูรณ์แบบ (UA)','X-ray (ฟิมส์ใหญ่)','ตรวจน้ำตาลในเลือด(FBS)','การตรวจหาระดับกรดยูริค (Uric)','ตรวจการทำงานของตับ(SGOP,SGOT)','ตรวจการทำงานของไต(CR,BUN)','ตรวจไขมันในเลือด(CHOL,TRI)','ภายใน(สำหรับผู้หญิงบริการที่โรงพยาบาล)','ตรวจมะเร็งปากมดลูก(สำหรับผู้หญิงบริการที่โรงพยาบาล)');

	
	$pro="โปรแกรมที่4 (อายุมากกว่า 35 ปี)  ";
	$p="P4";
}
//$arrprice2 = array('','90.00','50.00','170.00','40.00','60.00','100.00','50.00','60.00','');
	?>       
     <table width="756">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>ตรวจสุขภาพประจำปี 
           <!--<?//=$_POST['company']?>-->
           <?=$course;?>
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
         <!-------- สถานีตรวจ  ----------->
         <? if($course=="โปรแกรมที่ 1"){?>
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>สถานี 1 <br />
                       ลงทะเบียน<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 2<br />
                       X-RAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 3<br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 4<br />
                     ตรวจเลือด/ปัสสาวะ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>            
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 5<br />
                     คืนเอกสารใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                              
             </tr>
         </table>  
         <? }else if($course=="โปรแกรมที่ 2"){?>
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>สถานี 1 <br />
                       ลงทะเบียน<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 2<br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 3<br />
                     ตรวจเลือด/ปัสสาวะ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>            
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 4<br />
                     คืนเอกสารใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                              
             </tr>
         </table>           
         <? }else if($course=="โปรแกรมที่ 3"){?>       
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>สถานี 1 <br />
                       ลงทะเบียน<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 2<br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 3<br />
                     ตรวจเลือด/ปัสสาวะ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>            
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>สถานี 4<br />
                     คืนเอกสารใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                              
             </tr>
         </table>           
         <? }?>       
         <!-------- จบสถานีตรวจ ----------->
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong>*** หมายเหตุ ***</strong><br />
    - เมื่อทำการตรวจครบทุกสถานีแล้ว นำเอกสารส่งคืนเจ้าหน้าที่ ณ จุดลงทะเบียน <br />
    - กรุณาอย่าทำเอกสารใบนำทางหาย เป็นอันเด็ดขาด</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    