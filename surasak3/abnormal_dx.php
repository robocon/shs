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
    <td width="23%" align="center">ยศ - ชื่อ</td>
    <td width="12%" align="center">อายุ</td>
    <td width="8%" align="center">น้ำหนัก</td>
    <td width="8%" align="center">ส่วนสูง</td>
    <td width="7%" align="center">รอบอก</td>
    <td width="36%" align="center">อาการโรคที่ตรวจพบหรือ<br />
    สภาพความไม่สมบูรณ์ของร่างกาย<br />คำแนะนำปฏิบัติของแพทย์</td>
  </tr>
 <?
	 if($_POST['camp']==''||$_POST['camp']=='ทุกหน่วย'){
			//$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and   ";
			$query2 = "select a.ptname,a.age,a.height,a.weight,a.diag from condxofyear_so as a,chkup_solider AS b  where a.status_dr='Y' and a.yearcheck='".$_POST['year']."' AND b.hn = a.hn and a.diag != '' and substr(left(a.camp,3),2) between '02' and '10'";
		}else{
			$query2 = "select a.ptname,a.age,a.height,a.weight,a.diag from condxofyear_so as a,chkup_solider AS b  where a.status_dr='Y' and a.camp like '%".$_POST['camp']."%' and a.yearcheck='".$_POST['year']."' AND b.hn = a.hn and a.diag != '' ";
		}
 	//$query2 = "select ptname,age,height,weight,diag from condxofyear_so where status_dr='Y' and camp like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."' and diag != '' ";
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	while(list($ptname,$age,$height,$weight,$diag) = mysql_fetch_array($aa2)){
		$m++;
 ?>
  <tr>
    <td align="center"><?=$m?></td>
    <td>&nbsp;<?=$ptname?></td>
    <td>&nbsp;<?=$age?></td>
    <td align="center">&nbsp;<?=$weight?></td>
    <td align="center">&nbsp;<?=$height?></td>
    <td>&nbsp;</td>
    <td><?=$diag?></td>
  </tr>
  <?
	}
  ?>
</table>


</body>
</html>