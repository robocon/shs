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
</style>
</head>

<body>


<?



		$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem,exam_no  from opcardchk where hn = '".$_GET['hn']."' and part='กัลยาณี' ";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
	//	$bdate = explode("-",$arr['dbirth']);
		//$_SESSION["age_n"] = "ว.ด.ป. เกิด...".$arr['dbirth']." ";
		$_SESSION["age2_n"] = "อายุ :.".$arr['agey']." ปี";
		
		$_SESSION['add_n'] ="...............................................................................................................";
 		$_SESSION['tel_n']="..............................";
		$_SESSION['name_n'] = $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
		$idcard =$arr['idcard'];
		
		$prog=$arr['exam_no'];
/*elseif($_POST['idcard']!=""){
		$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem from opcardchk where hn = '".$_POST['hn']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
	//	$bdate = explode("-",$arr['dbirth']);
	$_SESSION["age_n"] = "ว.ด.ป. เกิด...".$arr['dbirth']."... อายุ :.".$arr['agey'].".ปี";
	//	$_SESSION["age_n2"]=calcage($arr['dbirth']);
	    $_SESSION['add_n'] =".........................................";
	//	$_SESSION['tel_n'] = $arr['phone'];
		$_SESSION['name_n'] = $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
	}*/

	?>
 <div id="no_print" >  <a href ="../nindex.htm" >**** &lt;&lt; เมนู****</a> &nbsp;&nbsp;<a href="Predx_ofyear_sticker.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>" target="_blank">พิมพ์สติกเกอร์</a>&nbsp;&nbsp;<a href="Predx_ofyear_stickerstool.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>&pro=<?=$_POST['pro'];?>" target="_blank">สติกเกอร์ STOOL</a></div>
    <script>
    window.print();
    </script>
<table width="100%"><tr><td>
<table width="98%">
    <tr style='line-height:18px'>
    	<td width="126" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="687" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจมะเร็งปากมดลูก โรงเรียนลำปางกัลยาณี  	  
   	    <?=$_POST['company']?></span></span></strong></td>
        <td width="13" rowspan="3" align="center" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$_SESSION['hn_n'];?>" alt="" /><br /><?=$_SESSION['hn_n'];?>
        </span></td>
    </tr>
    <tr style='line-height:18px'>
      <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
    <tr style='line-height:18px'>
      <!--<td align="center" class="pdxhead">ตรวจเมื่อวันที่...<?=date("d-m-").(date("Y")+543)?>...เวลา...<?=date("H:i:s")?>....</td>-->
      <td align="center" class="pdxhead">ตรวจเมื่อวันที่ 25 มีนาคม 2557 </td>
      </tr>
      </table>
      <span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
      1. ผู้เข้ารับการตรวจสุขภาพให้รับบริการที่หอผู้ป่วยสูติ <br />
      2. เจ้าหน้าที่โรงพยาบาลให้เก็บเอกสารการตรวจไว้ที่แผนก
      </span><br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table width="100%">
    <tr>
      <td width="69%" class="pdx">HN :
        <strong>
          <?=$_SESSION['hn_n']?>
          </strong>ชื่อ-สกุล : 
        <strong><?=$_SESSION['name_n']?></strong>
        <?=$_SESSION["age2_n"]?> <!--ID : <?//=$_SESSION["idcard_n"]?>-->
      </td>
      </tr>
    <tr>
      <td class="pdx">ที่อยู่ :
        <?=$_SESSION['add_n']?>&nbsp;โทรศัพท์ :
  <?=$_SESSION['tel_n']?>&nbsp;ความเห็นแพทย์</td>
      </tr>
      </table>
      </td></tr>
    </table>

<table width="756">
    <tr>
      <td class="pdxpro" colspan="2"><strong>รายการตรวจสุขภาพ <!--<?//=$_POST['company']?>--> <?=$pro;?></strong></td>
    </tr>
    <?
	
				echo "<tr style='line-height:15px'><td class='pdx'>ตรวจมะเร็งปากมดลูก</td><td class='pdx'>[  ]</td></tr>";
				echo "<tr style='line-height:15px'><td class='pdx'>ตรวจภายใน</td><td class='pdx'>[  ]</td></tr>";

			//$sumpri = number_format(($sumpri2+250),2);
			//echo "<tr style='line-height:12px'><td class='pdx' align='center'> ค่าตรวจ</td><td class='pdx'>ราคา 1,020.00 บาท</td></tr>";
	
/*if(!empty($idcard)){
					
$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"<FONT SIZE='2' COLOR='#0000FF'><BR>&nbsp;&nbsp;มีสิทธิประกันสังคม ร.พ.ค่าย</FONT>";
			}else{
				echo"<FONT SIZE='2' COLOR='#0000FF'><BR>&nbsp;&nbsp;ไม่มีสิทธิประกันสังคม</FONT>";
			}
	}else{
			echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;ตรวจสอบฐานข้อมูลผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
		}*/
		//	echo "<tr style='line-height:12px'><td class='pdx' align='center'> ค่าบริการ</td><td class='pdx'>ราคา 100.00 บาท</td></tr>";
		//	echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>รวม</B></td><td class='pdx'><B>ราคา 1100.00 บาท</B></td>";
	?>
    <tr>
      <td class="pdx" colspan="2"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
      </tr>
    <tr>
      <td class="pdx" colspan="2">
      
<table>
<tr style='line-height:16px'>
<td>
  <table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'>
  <td>หอผู้ป่วยสูติ<br>
    เจ้าหน้าที่<br>.............................</td>
  </tr>
  </table>
</td>
	</tr>
</table>
</td></tr>
</table>


</body>
</html>