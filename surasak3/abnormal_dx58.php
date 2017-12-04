<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="font1">
  <tr>
    <td width="6%" align="center">ลำดับ</td>
    <td width="20%" align="center">ยศ - ชื่อ</td>
    <td width="12%" align="center">อายุ</td>
    <td width="5%" align="center">น้ำหนัก</td>
    <td width="5%" align="center">ส่วนสูง</td>
    <td width="5%" align="center">รอบอก</td>
     <td width="5%" align="center">BMI</td>
    <td width="40%" align="center">อาการโรคที่ตรวจพบหรือ<br />
    สภาพความไม่สมบูรณ์ของร่างกาย<br />คำแนะนำปฏิบัติของแพทย์</td>
  </tr>
 <?
 include("connect.inc");
	 if($_POST['camp']==''||$_POST['camp']=='ทุกหน่วย'){
			//$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and   ";
			//$query2 = "select a.ptname,a.age,a.height,a.weight,a.diag from condxofyear_so as a,chkup_solider AS b  where a.status_dr='Y' and a.yearcheck='".$_POST['year']."' AND b.hn = a.hn and a.diag != '' and substr(left(a.camp,3),2) between '02' and '10'";
		}else{
			//$query2 = "select a.ptname,a.age,a.height,a.weight,a.diag from condxofyear_so as a,chkup_solider AS b  where a.status_dr='Y' and a.camp like '%".$_POST['camp']."%' and a.yearcheck='".$_POST['year']."' AND b.hn = a.hn and a.diag != '' ";
			
$query2 = "select 
ptname,age,height,weight,round_,bmi,anemia,cirrhosis,hepatitis,cardiomegaly,allergy,gout,waistline,asthma,muscle,ihd,thyroid,heart ,	emphysema,herniated,conjunctivitis,cystitis,epilepsy,fracture,cardiac,spine,dermatitis,degeneration,alcoholic,copd,bph,kidney,pterygium,tonsil,paralysis,blood,conanemia,ht from condxofyear_so where  camp1 like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."'  and (anemia != '' or cirrhosis != '' or hepatitis != '' or cardiomegaly != '' or allergy != '' or gout != '' or waistline != '' or asthma != '' or muscle != '' or ihd != '' or thyroid != '' or heart  != '' or 	emphysema != '' or herniated != '' or conjunctivitis != '' or cystitis != '' or epilepsy != '' or fracture != '' or cardiac != '' or spine != '' or dermatitis != '' or degeneration != '' or alcoholic != '' or copd != '' or bph != '' or kidney != '' or pterygium != '' or tonsil != '' or paralysis != '' or blood != '' or conanemia != '' or ht != '') ";			
			
	//echo $query2;		
			
		}
 	//$query2 = "select ptname,age,height,weight,diag from condxofyear_so where status_dr='Y' and camp like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."' and diag != '' ";
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	while(list($ptname,$age,$height,$weight,$round_,$bmi,$anemia,$cirrhosis,$hepatitis,$cardiomegaly,$allergy,$gout,$waistline,$asthma,$muscle,$ihd,$thyroid,$heart ,$emphysema,$herniated,$conjunctivitis,$cystitis,$epilepsy,$fracture,$cardiac,$spine,$dermatitis,$degeneration,$alcoholic,$copd,$bph,$kidney,$pterygium,$tonsil,$paralysis,$blood,$conanemia,$ht) = mysql_fetch_array($aa2)){
		$m++;
		
if($anemia=='Y'){$anemia='โลหิตจาง (Anemia)';};
if($cirrhosis=='Y'){$cirrhosis='ตับแข็ง (Cirrhosis)';};
if($hepatitis=='Y'){$hepatitis='โรคตับอักเสบ (Hepatitis)';};
if($cardiomegaly=='Y'){$cardiomegaly='หัวใจโต';};
if($allergy=='Y'){$allergy='ภูมิแพ้ ';};
if($gout=='Y'){$gout='โรคเก๊าท์ ';};
if($waistline=='Y'){$waistline='รอบเอวเกิน ';};
if($asthma=='Y'){$asthma='หอบหืด (Asthma) ';};
if($muscle=='Y'){$muscle='กล้ามเนื้ออักเสบ';};
if($ihd=='Y'){$ihd=' โรคหัวใจขาดเลือดเรื้อรัง (IHD)';};
if($thyroid=='Y'){$thyroid='ไทรอยด์';};
if($heart =='Y'){$heart='โรคหัวใจ ';};
if($emphysema=='Y'){$emphysema='ถุงลมโป่งพอง';};
if($herniated=='Y'){$herniated='หมอนรองกระดูกทับเส้นประสาท';};
if($conjunctivitis=='Y'){$conjunctivitis='เยื่อบุตาอักเสบ (Conjunctivitis)';};
if($cystitis=='Y'){$cystitis='กระเพาะปัสสาวะอักเสบ (Cystitis) ';};
if($epilepsy=='Y'){$epilepsy='ลมชัก (Epilepsy)';};
if($fracture=='Y'){$fracture='กระดูกหักเลื่อน';};
if($cardiac=='Y'){$cardiac='หัวใจเต้นผิดจังหวะ (Cardiac arrhythmia)';};
if($spine=='Y'){$spine='กระดูกสันหลัง (อก) คด';};
if($dermatitis=='Y'){$dermatitis='ผิวหนังอักเสบ';};
if($degeneration=='Y'){$degeneration='หัวเข่าเสื่อม';};
if($alcoholic=='Y'){$alcoholic='ความผิดปกติจากแอลกอฮอล์';};
if($copd=='Y'){$copd='COPD';};
if($bph=='Y'){$bph='BPH';};
if($kidney=='Y'){$kidney='ไตผิดปกติ';};
if($pterygium=='Y'){$pterygium='ต้อเนื้อ';};
if($tonsil=='Y'){$tonsil='ต่อมทอนซิลโต';};
if($paralysis=='Y'){$paralysis='อัมพาตซีกซ้าย/ขวา ';};
if($blood=='Y'){$blood='เม็ดเลือดผิดปกติ ';};
if($conanemia=='Y'){$conanemia='ภาวะซีด';};
if($ht=='Y'){$ht='ความดันโลหิตสูง ';};
		
		
		
		
	$diag=$anemia.''.$cirrhosis.''.$hepatitis.''.$cardiomegaly.''.$allergy.''.$gout.''.$waistline.''.$asthma.''.$muscle.''.$ihd.''.$thyroid.''.$heart .''.$emphysema.''.$herniated.''.$conjunctivitis.''.$cystitis.''.$epilepsy.''.$fracture.''.$cardiac.''.$spine.''.$dermatitis.''.$degeneration.''.$alcoholic.''.$copd.''.$bph.''.$kidney.''.$pterygium.''.$tonsil.''.$paralysis.''.$blood.''.$conanemia.''.$ht;
 ?>
  <tr>
    <td align="center"><?=$m?></td>
    <td>&nbsp;<?=$ptname?></td>
    <td>&nbsp;<?=$age?></td>
    <td align="center">&nbsp;<?=$weight?></td>
    <td align="center">&nbsp;<?=$height?></td>
    <td align="center">&nbsp;<?=$round_?></td>
       <td align="center">&nbsp;<?=$bmi?></td>
    <td><?=$diag?></td>
  </tr>
  <?
	}
  ?>
</table>


</body>
</html>