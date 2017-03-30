<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
////*runno ตรวจสุขภาพ*/////////
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<p align="center" style="font-weight:bold;">รายงานผลการตรวจสุขภาพกำลังพล ทบ. (ผสต.11) ประจำปี <?="25".$nPrefix;?> (ใหม่)
</p>
<div align="center"><a href ="report_chkup11_armynew.php">รายงานกลุ่มย่อย</a> || <strong>รายงานกลุ่มใหญ่</strong></div>
<form name="form1" method="post" action="<?=$PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>ทุกหน่วย</option>
          <option value="รพ.ค่ายสุรศักดิ์มนตรี">รพ.ค่ายสุรศักดิ์มนตรี</option>
          <option value="มทบ.32">มทบ.32</option>
          <option value="ร้อย.ฝรพ.3">ร้อย.ฝรพ.3</option>
          <option value="ร.17 พัน.2">ร.17 พัน.2</option>
          <option value="ช.พัน.4 ร้อย4">ช.พัน.4 ร้อย4</option>
          <option value="สง.สด.จว.ล.ป.">สง.สด.จว.ล.ป.</option>
          <option value="กทพ.33">กทพ.33</option>
        </select>
        <input type="submit" name="button" id="button" value="ดูรายงาน">
        </label></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){
$sql1="SELECT *
FROM `armychkup`
WHERE `yearchkup` = '$nPrefix'  and (camp !='D33 หน่วยทหารอื่นๆ' and camp !='')  order by chunyot asc, age desc";
}else{
$sql1="SELECT *
FROM `armychkup`
WHERE `camp` like '%$_POST[camp]%' AND `yearchkup` = '$nPrefix' and camp !='' order by chunyot asc, age desc";
}
//var_dump($sql1);
$query1=mysql_query($sql1)or die ("Query armychkup Error");

$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);

?>
<div align="center">
<div align="right">( แบบ รง.ผสต.11 )</div>
<h3 align="center">ผนวก ค</h3>
<div align="center"><strong>ชื่อรายงาน และแบบฟอร์มรายงานการตรวจร่างกายประจำปี ของกำลังพลกองทัพบกและครอบครัว</strong></div>
<div align="left"><strong>1. รายงานข้อมูลการตรวจร่างกายของกำลังพลกองทัพบก(รายบุคคล) ประจำปี</strong> <?="25".$nPrefix;?></div>
<div align="left"><strong>หน่วยสายแพทย์ที่ทำการตรวจ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="left"><strong>หน่วยทหารที่มารับการตรวจ</strong> <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo $_POST["camp"];}?></div>
<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;" class="pdxpro">
  <tr>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ลำดับ</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ยศ</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ชื่อ</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>นามสกุล</strong></td>
    <td width="3%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>เลขประจำตัว<br />
    ประชาชน</strong></td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>สังกัด</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ตำแหน่ง</strong></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ช่วยราชการ</strong><br />
    (ระบุ)</td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>อายุ</strong><br />
    (ปี)</td>
    <td width="1%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>เพศ</strong><br />
    <div align="left">(1) ชาย<br />
    (2) หญิง</div></td>
    <td width="2%" rowspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>สิทธิเบิก</strong><br />
      <div align="left">(1) ข้าราชการ<br />
      (2) รัฐวิสาหกิจ<br />
      (3) ปกส.<br />
      (4) สปสช.<br />
      (5) อื่นๆ</div></td>
    <td colspan="4" align="center" valign="top" bgcolor="#FFFFFF"><strong>น้ำหนักส่วนสูง</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>BP</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Ches x-ray</strong></td>
    <td colspan="4" align="center" valign="top" bgcolor="#FFFFFF"><strong>Urine Examination</strong></td>
    <td colspan="12" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผลการตรวจเลือด</strong></td>
    <td colspan="2" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Pap smear</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ประวัติโรคประจำตัว</strong></td>
    <td colspan="3" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>พฤติกรรมการดำเนินชีวิติที่มีผลต่อความเสี่ยงโรค</strong></td>
  </tr>
  <tr>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>น้ำหนัก</strong><br />
    (kg)</td>
    <td width="1%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ส่วนสูง</strong><br />
    (m)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>BMI</strong><br />
    (kg/m2)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>รอบเอว</strong><br />
    (inch)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Systolic</strong><br />
    (mmHg)</td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>Diastolic</strong><br />
    (mmHg)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผล</strong><br />
      <div align="left">0=ไม่ได้ตรวจ<br />
      1=ปกติ<br />
      2=ผิดปกติ</div></td>
    <td width="2%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผิดปกติ</strong><br />
(ระบุ)</td>
    <td width="3%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผล</strong><br />
      <div align="left">0=ไม่ได้ตรวจ<br />
      1=ปกติ<br />
      2=ผิดปกติ</div></td>
    <td colspan="3" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผิดปกติ</strong></td>
    <td colspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>CBC</strong></td>
    <td colspan="10" align="center" valign="top" bgcolor="#FFFFFF"><strong>Blood Chemistry</strong></td>
    <td width="5%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผล</strong><br />
      <div align="left">0=ไม่มีโรคประจำตัว<br />
      1=ความดันโลหิต<br />
      2=เบาหวาน<br />
      3=โรคหัวใจและหลอดเลือด<br />
      4=ไขมันในเลือดสูง<br />
      5=โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป<br />
      6=โรคประจำตัวอื่นๆ</div></td>
    <td width="4%" rowspan="2" align="center" valign="top" bgcolor="#FFFFFF"><strong>โรคอื่นๆ</strong><br />
    (ระบุ)</td>
  </tr>
  <tr>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Proteinurea&gt;1+</strong><br />
      <div align="left">1=ไม่มี<br />
      2=มี</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Hematuria&gt;1+</strong><br />
    <div align="left">1=ไม่มี<br />
    2=มี</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผิดปกติอื่นๆ</strong><br />
      (ระบุ)</td>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผล</strong><br />
      <div align="left">0=ไม่ได้ตรวจ,error<br />
      1=ปกติ<br />
      2=ผิดปกติ Hct&lt;40% และ MCV &lt; 78%<br />
      3=ผิดปกติอื่นๆ</div></td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผิดปกติอื่นๆ</strong><br />
      (ระบุ)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Glu</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Chol</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>TG</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>HDL-C</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>LDL-C</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>BUN</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Cr</strong><br />
    (mg/dL)</td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>Uric</strong><br />
    (mg/dL)</td>
    <td width="1%" align="center" valign="top" bgcolor="#FFFFFF"><strong>AST</strong><br />
    (U/L)</td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ALT</strong><br />
      (U/L)</td>
    <td width="4%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผล</strong><br />
      <div align="left">0=ไม่ได้ตรวจ,error<br />
      1=ปกติ<br />
      2=ผิดปกติ</div></td>
    <td width="2%" align="center" valign="top" bgcolor="#FFFFFF"><strong>ผิดปกติ</strong> (ระบุ)</td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>การสูบบุหรี่</strong><br />
    <div align="left">0=ไม่เคยสูบบุหรี่<br />
      1=เคยสูบ แต่เลิกแล้ว<br />
      2=สูบบุหรี่ เป็นครั้งคราว<br />
      3=สูบบุหรี่ เป็นประจำ</div></td>
    <td width="3%" align="center" valign="top" bgcolor="#FFFFFF"><strong>การดื่มเครื่องดื่มที่มีแอลกอฮอล์</strong><br />
    <div align="left">0=ไม่เคยดื่ม<br />
1=เคยดื่ม แต่เลิกแล้ว<br />
2=ดื่ม เป็นครั้งคราว<br />
3=ดื่ม เป็นประจำ</div></td>
    <td width="6%" align="center" valign="top" bgcolor="#FFFFFF"><strong>การออกกำลังกาย</strong><br />
    <div align="left">0=ไม่เคยออกกำลังกาย<br />
1=ออกกำลังกายต่ำกว่าเกณฑ์<br />
2=ออกกำลังกายตามเกณฑ์<br />
    </div></td>
  </tr>
  <?
  $i=0;
  while($arr1=mysql_fetch_array($query1)){
  	$i++;
	if(!empty($arr1["height"])){	
	$ht = $arr1['height']/100;
	$bmi=number_format($arr1['weight'] /($ht*$ht),2);  
	}else{
	$bmi="&nbsp;";
	}
	
  
	
	
	$opsql=mysql_query("select yot,name,surname,idcard from opcard where hn='$arr1[hn]'");		
	list($yot,$name,$surname,$idcard)=mysql_fetch_row($opsql);	
	
	$chksql=mysql_query("select gender,position,ratchakarn,dxptright from chkup_solider where hn='$arr1[hn]' and yearchkup='$nPrefix'");		
	list($gender,$position,$ratchakarn,$dxptright)=mysql_fetch_row($chksql);		
	
	$age=substr($arr1["age"],0,2);
  
   ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><? if(!empty($yot)){ echo $yot;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($name)){ echo $name;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($surname)){ echo $surname;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($idcard)){ echo "<span style='color:#fff;'>'</span>".$idcard;}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($arr1['camp'])){ echo substr($arr1['camp'],4);}else{ echo "&nbsp;";}?></td>
    <td><? if(!empty($position)){ echo $position;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($ratchakarn)){ echo $ratchakarn;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($age)){ echo $age;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($gender)){ echo $gender;}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($dxptright)){ echo $dxptright;}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['weight'])){ echo $arr1['weight'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['height'])){ echo $arr1['height'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($bmi)){ echo $bmi;}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['waist'])){ echo $arr1['waist'];}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['bp1'])){ echo substr($arr1['bp1'],0,3);}else{ echo "&nbsp;";}?></td>
    <td align="right"><? if(!empty($arr1['bp1'])){ echo substr($arr1['bp1'],4,2);}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['xray']==""){ echo "0";}else if($arr1['xray']=="ปกติ"){ echo "1";}else if($arr1['xray']=="ผิดปกติ"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['xray_detail'])){ echo $arr1['xray_detail'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['ua_lab']==""){ echo "0";}else if($arr1['ua_lab']=="ปกติ"){ echo "1";}else if($arr1['ua_lab']=="ผิดปกติ"){ echo "2";}else{ echo "0";}?></td>
    <td align="center"><? if($arr1['ua_lab']==""){ echo "0";}else if($arr1['ua_lab']=="ปกติ"){ echo "1";}else if($arr1['ua_lab']=="ผิดปกติ"){ echo "2";}else{ echo "0";}?></td>
    <td align="center"><? if($arr1['ua_bloodu']=="1+" || $arr1['ua_bloodu']=="2+" || $arr1['ua_bloodu']=="3+" || $arr1['ua_bloodu']=="4+"){ echo "2";}else{ echo "1";}?></td>
    <td><? if(!empty($arr1['reason_ua'])){ echo $arr1['reason_ua'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if($arr1['cbc_lab']==""){ echo "0";}else if($arr1['cbc_lab']=="ปกติ"){ echo "1";}else if($arr1['cbc_lab']=="ผิดปกติ"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['reason_wbc'])){ echo $arr1['reason_wbc'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? echo $arr1['glu_result'];?></td>
    <td align="center"><? echo $arr1['chol_result'];?></td>
    <td align="center"><? echo $arr1['trig_result'];?></td>
    <td align="center"><? echo $arr1['hdl_result'];?></td>
    <td align="center"><? echo $arr1['ldl_result'];?></td>
    <td align="center"><? echo $arr1['bun_result'];?></td>
    <td align="center"><? echo $arr1['crea_result'];?></td>
    <td align="center"><? echo $arr1['uric_result'];?></td>
    <td align="center"><? echo $arr1['ast_result'];?></td>
    <td align="center"><? echo $arr1['alt_result'];?></td>
    <td align="center"><? if($arr1['pap']==""){ echo "0";}else if($arr1['pap']=="ปกติ"){ echo "1";}else if($arr1['pap']=="ผิดปกติ"){ echo "2";}else{ echo "0";}?></td>
    <td><? if(!empty($arr1['reason_pap'])){ echo $arr1['reason_pap'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? if(!empty($arr1['prawat'])){ echo $arr1['prawat'];}else{ echo "0";}?></td>
    <td><? if($arr1['prawat']==6){ echo $arr1['congenital_disease'];}else{ echo "&nbsp;";}?></td>
    <td align="center"><? echo $arr1['cigarette'];?></td>
    <td align="center"><? echo $arr1['alcohol'];?></td>
    <td align="center"><? echo $arr1['exercise'];?></td>
  </tr>
  <? } ?>
</table>
</div>
<?
}
?>
