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
$_GET['part']="ราชมงคล58";
if(isset($_GET['part'])){
	$sql = "select *  from opcardchk where part = '".$_GET['part']."' order by row asc limit 798,178";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$birth_n= "วัน/เดือน/ปีเกิด :.....".$arr['dbirth']."......";
	$age2_n= "อายุ :..........".$arr['agey'].".........ปี";
		
	$add_n="...............................................................................................................";
	$tel_n="..............................";
	$name_n= $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
	$hn_n= $arr['HN'];
	$idcard_n= $arr['idcard'];
	$exam_no= $arr['exam_no'];
	$idcard =$arr['idcard'];
	$prog=$arr['exam_no'];
?> 
<div align="center" style="width: 97%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style='line-height:18px'>
        <td rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td height="26" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจสุขภาพ
          <?=$_GET['part']?>
        </span></span></strong></td>
        <td rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
              <div style="font-size:36px;"><?=$exam_no;?></div>
        </span></td>
      </tr>
      <tr style='line-height:18px'>
        <td height="28" align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <!--<td align="center" class="pdxhead">ตรวจเมื่อวันที่...<?=date("d-m-").(date("Y")+543)?>...เวลา...<?=date("H:i:s")?>....</td>-->
        <td align="center" valign="bottom" class="pdxhead">ตรวจวันที่ <?=$arr['datechkup']?></td>
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
                     </strong>เลขที่บัตรประชาชน : <strong>
                     <?=$idcard_n;?>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">หลักสูตร :
                   <strong><?=$arr['course']?></strong>
                   &nbsp;สาขาวิชา :
                   <strong><?=$arr['branch']?></strong></td>
               </tr>
               <tr>
                 <td align="left" class="pdx">น้ำหนัก...................กก. &nbsp;ส่วนสูง.....................ซม. &nbsp;BP................./.............. P...............ครั้ง/นาที</td>
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
     <p></p>
     <table width="756">
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2"><table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 1</strong><br />
                       ลงทะเบียน<br />
เจ้าหน้าที่<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 2</strong> <br />
                       วัดความดันโลหิต<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 3</strong><br />
                       ตรวจปัสสาวะ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>สถานี 4</strong><br />
                     X-RAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>จุดลงทะเบียน</strong><br />
                       คืนเอกสารใบนำทาง<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>               
             </tr>
         </table></td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
<p></p>
<p></p>
    <div class="style2" style="margin-left:10px;">* ทำการตรวจครบทุกสถานีแล้ว นำเอกสารส่งคืนเจ้าหน้าที่ ณ จุดลงทะเบียน</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    