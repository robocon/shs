<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="font1">
  <tr>
    <td width="6%" align="center">�ӴѺ</td>
    <td width="20%" align="center">�� - ����</td>
    <td width="12%" align="center">����</td>
    <td width="5%" align="center">���˹ѡ</td>
    <td width="5%" align="center">��ǹ�٧</td>
    <td width="5%" align="center">�ͺ͡</td>
     <td width="5%" align="center">BMI</td>
    <td width="40%" align="center">�ҡ���ä����Ǩ������<br />
    ��Ҿ�����������ó�ͧ��ҧ���<br />���йӻ�ԺѵԢͧᾷ��</td>
  </tr>
 <?
 include("connect.inc");
	 if($_POST['camp']==''||$_POST['camp']=='�ء˹���'){
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
		
if($anemia=='Y'){$anemia='���Ե�ҧ (Anemia)';};
if($cirrhosis=='Y'){$cirrhosis='�Ѻ�� (Cirrhosis)';};
if($hepatitis=='Y'){$hepatitis='�ä�Ѻ�ѡ�ʺ (Hepatitis)';};
if($cardiomegaly=='Y'){$cardiomegaly='�����';};
if($allergy=='Y'){$allergy='������ ';};
if($gout=='Y'){$gout='�ä��ҷ� ';};
if($waistline=='Y'){$waistline='�ͺ����Թ ';};
if($asthma=='Y'){$asthma='�ͺ�״ (Asthma) ';};
if($muscle=='Y'){$muscle='����������ѡ�ʺ';};
if($ihd=='Y'){$ihd=' �ä���㨢Ҵ���ʹ������ѧ (IHD)';};
if($thyroid=='Y'){$thyroid='���´�';};
if($heart =='Y'){$heart='�ä���� ';};
if($emphysema=='Y'){$emphysema='�ا���觾ͧ';};
if($herniated=='Y'){$herniated='��͹�ͧ��д١�Ѻ��鹻���ҷ';};
if($conjunctivitis=='Y'){$conjunctivitis='����ͺص��ѡ�ʺ (Conjunctivitis)';};
if($cystitis=='Y'){$cystitis='�����л�������ѡ�ʺ (Cystitis) ';};
if($epilepsy=='Y'){$epilepsy='���ѡ (Epilepsy)';};
if($fracture=='Y'){$fracture='��д١�ѡ����͹';};
if($cardiac=='Y'){$cardiac='�����鹼Դ�ѧ��� (Cardiac arrhythmia)';};
if($spine=='Y'){$spine='��д١�ѹ��ѧ (͡) ��';};
if($dermatitis=='Y'){$dermatitis='���˹ѧ�ѡ�ʺ';};
if($degeneration=='Y'){$degeneration='������������';};
if($alcoholic=='Y'){$alcoholic='�����Դ���Ԩҡ��š�����';};
if($copd=='Y'){$copd='COPD';};
if($bph=='Y'){$bph='BPH';};
if($kidney=='Y'){$kidney='䵼Դ����';};
if($pterygium=='Y'){$pterygium='�������';};
if($tonsil=='Y'){$tonsil='�����͹����';};
if($paralysis=='Y'){$paralysis='����ҵ�ա����/��� ';};
if($blood=='Y'){$blood='������ʹ�Դ���� ';};
if($conanemia=='Y'){$conanemia='���Ыմ';};
if($ht=='Y'){$ht='�����ѹ���Ե�٧ ';};
		
		
		
		
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