<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
.forntsarabun {	
	font-family: "TH SarabunPSK";
	font-size: 14pt;
}
.forntsarabun2 {	
	font-family: "TH SarabunPSK";
	font-size: 18pt;
	font-weight:bold;
}
.forntsarabun3 {	
	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
</style>
<body onload="window.print();">
<? 
include("connect.inc");
$cHn=$_GET['cHn'];

$sql="SELECT concat(yot,name,' ',surname)as ptname ,idcard,hn,dbirth  FROM opcard WHERE hn='$cHn' ";
$result = mysql_query($sql)or die("Query failed opcard");
$arr=mysql_fetch_array($result);


Function calcage($birth){

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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

$cAge=calcage($arr['dbirth']);
?>
<table width="100%" border="1" style="border-collapse:collapse;" bordercolor="#000000" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><table width="100%" border="0">
      <tr>
        <td align="center" class="forntsarabun">�ͧ/Ἱ�/��ǹ �ٹ��������  �͡��������Ţ FR-IPC-001/8  ��䢤��駷�� 02  �ѹ����ռźѧ�Ѻ�� 01,01,52</td>
        </tr>
      <tr class="forntsarabun2">
        <td align="center">Ẻ����Ѻ�͹�ѡ�ҵ�� þ.��������ѡ��������</td>
        </tr>
      <tr >
        <td align="right" class="forntsarabun3">�ѹ���...................................��͹..................................��...............................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">����-ʡ�ż�����...<?=$arr['ptname']?>...����..<?=$cAge?>&nbsp;�ä..............................................................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">ᾷ�����ѡ��...........................................................................�Է�ԡ��ѡ��.....<span class="forntsarabun31">
          <?=$arr['ptright']?>
        </span></td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">�Ѻ�͹����ͼ�����............................................��ͧ/��§................................�/�/�................................����..................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">��س����ҡ�ü����·ҧ���Ѿ�����Һ���ͼ����� ��.0-5483-9305-6 ���.....................................</td>
      </tr>
      <tr >
        <td align="left" class="forntsarabun3">�ҡ��˹��¼����¡�Ѻ��ҹ ��س��駭ҵ����Դ���Ἱ�����¹ ��.0-5483-9305-6 ��� 1120</td> 
      </tr>
      <tr >
        <td align="right" class="forntsarabun3">����Ѻ����ͧ......................................................................</td>
      </tr>
      <tr >
        <td align="right" class="forntsarabun3">���˹�......................................................................</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html>