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
.pdxhead1 {
	font-family: "TH SarabunPSK";
	font-size: 20pt;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.subpdx {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}

hr {
  height: 2px;
  width: 100%;
  color: #000000;
  background-color: #000;
}
</style>
<!--<script>window.print();</script>-->
<?
$_GET["part"]="ควอลิตี้เซรามิค60";
$showpart="ควอลิตี้เซรามิค60";
if(isset($_GET['part'])){
	$sql = "select *  from opcardchk where part = '".$_GET['part']."' order by row asc limit 600,100";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$name_n= $arr['name']." ".$arr['surname'];
	$hn_n= $arr['HN'];
	$runno= sprintf("%03d",$arr['pid']);
	$pid=$arr['pid'];
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$exam_no= $arr['exam_no'];
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
					<span class="pdxhead1">เอกสารใบนำทางการตรวจสุขภาพ (กรุณานำมาแสดงเมื่อมาใช้บริการ)</span>
				</span>
			</strong>
		</td>
        <td width="6%" rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=$exam_no;?></div>
        </span></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305-6 ต่อ 1132</strong></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead">หน่วยงาน : <?=$showpart;?>  <strong>(<?=$course;?>)</strong>&nbsp;&nbsp;ตรวจวันที่ <?=$datechkup;?></td>
      </tr>
    </table>
 <hr>
 
 
       <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx"><strong>ชื่อ-สกุล : 
                     <?=$name_n." [$pid]";?> 
&nbsp;&nbsp;HN :
<?=$hn_n;?>
&nbsp;&nbsp;</strong>โทรศัพท์ : ...............................................</td>
               </tr>	   
			   <tr>
                 <td align="left" class="pdx">น้ำหนัก...........................กก. ส่วนสูง..............................ซม. BP....................../...................... T.........................</td>
               </tr>
			   <tr>
                 <td align="left" class="pdx">P....................ครั้ง/นาที R....................ครั้ง/นาที โรคประจำตัว...........................................................................</td>
               </tr>
			   <tr>
                 <td align="left" class="pdx">สูบบุหรี่.......................... ดื่มสุรา......................... ออกกำลังกาย......................... แพ้ยา.......................................</td>
               </tr>
           </table></td>
         </tr>
       </table>      
     <table width="756">
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
         <!-------- สถานีตรวจ  ----------->
			<table>
             <tr style='line-height:24px'>
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:24px'>
                     <td><strong>สถานี 1</strong> <br />
                       จุดลงทะเบียน<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>สถานี 2</strong><br />
                       ตรวจเลือด/ปัสสาวะ<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>สถานี 3</strong><br />
                       ตรวจ X-RAY<br />
                       เจ้าหน้าที่<br />
                       .............................</td>
                 </tr>
               </table></td>
				<td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>สถานี 4</strong><br />
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
<p class="subpdx" align="left"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพควรเข้ารับการตรวจให้ครบตามสถานีที่กำหนด&nbsp;&nbsp;
	   2.ส่งเอกสารใบนำทางที่สถานีสุดท้ายที่ใช้บริการ</p><br />
</div>
    
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    