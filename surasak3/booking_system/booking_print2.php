<?php
// header('Content-Type: text/html; charset=tis-620');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
	<title>�����㺨ͧ��§</title>
	<script type="text/javascript">
		window.onload = function(){
			window.print();
		}
	</script>
	<style type="text/css">
	
	@font-face{
		font-family: "THSarabunNew";
		src: url("../fonts/THSarabunNew.ttf") format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	
	body{
		font-family: "TH SarabunPSK";
	}
	b{
		font-weight: bold;
	}
	.fc1-0, 
	.fc1-1, 
	.fc1-3{
		color: #000000;
		font-weight: normal;
	}
	.fc1-0 { font-size: 34px; }
	.fc1-1 { font-size: 27px; }
	.fc1-3 { font-size: 21px; }
	div { 
		position:absolute; 
		z-index:25; 
		height: 34px;
	}
	</style>
</head>

<body>
<?php

function calcage($birth){

	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ��";
	}else{
		$pAge = "$ageY �� $ageM ��͹";
	}

	return $pAge;
}

include("../includes/connect.php"); 

$row_id = trim($_GET['row_id']);
$sql = "SELECT * FROM  booking  WHERE  row_id ='".$row_id."' ";
$query = mysql_query($sql); 
$dbarr = mysql_fetch_array($query);
$age = calcage($dbarr['bdate']);
	
///1
print "<div style='left:80px;top:15px;width:700px;'><span class='fc1-3'>�ͧ/Ἱ�/��ǹ �ٹ��������  �͡��������Ţ FR-IPC-001/3  ��䢤��駷�� 00  �ѹ����ռźѧ�Ѻ�� 28 �.�.44</span></div>";
print "<div style='left:300px;top:30px;width:500px;'><span class='fc1-0'>㺨ͧ��§</span></div>";	

//2
print "<div style='left:190px;top:60px;width:800px;'><span class='fc1-1'>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ</span></div>";	


//3
print "<div style='left:80px;top:85px;width:500px;'><span class='fc1-1'>����-ʡ��</span></div>";	
print "<div style='left:150px;top:85px;width:500px;'><span class='fc1-1'>$dbarr[ptname]</span></div>";	
print "<div style='left:330px;top:85px;width:500px;'><span class='fc1-1'>����</span></div>";	
print "<div style='left:400px;top:85px;width:500px;'><span class='fc1-1'>$age</span></div>";

/////2
print "<div style='left:80px;top:110px;width:500px;'><span class='fc1-1'>HN</span></div>";	
print "<div style='left:150px;top:110px;width:500px;'><span class='fc1-1'>$dbarr[hn]</span></div>";	
print "<div style='left:330px;top:110px;width:500px;'><span class='fc1-1'>�Ѻ���������</span></div>";	
print "<div style='left:430px;top:110px;width:500px;'><span class='fc1-1'>$dbarr[date_in]</span></div>";
	
//3
print "<div style='left:80px;top:135px;width:500px;'><span class='fc1-1'>DX</span></div>";	
print "<div style='left:150px;top:135px;width:500px;'><span class='fc1-1'>$dbarr[diag]</span></div>";	
print "<div style='left:330px;top:135px;width:500px;'><span class='fc1-1'>ᾷ��</span></div>";	
print "<div style='left:400px;top:135px;width:500px;'><span class='fc1-1'>$dbarr[doctor]</span></div>";	


//4
print "<div style='left:80px;top:160px;width:500px;'><span class='fc1-1'>�ͼ�����</span></div>";
print "<div style='left:150px;top:160px;width:500px;'><span class='fc1-1'>$dbarr[ward]</span></div>";
print "<div style='left:330px;top:160px;width:500px;'><span class='fc1-1'>��§/��ͧ</span></div>";
print "<div style='left:400px;top:160px;width:500px;'><span class='fc1-1'>$dbarr[bed]</span></div>";


//5
print "<div style='left:80px;top:185px;width:500px;'><span class='fc1-1'>�Է�ԡ���ѡ�� $dbarr[ptright]</span></div>";

//5
print "<div style='left:80px;top:210px;width:500px;'><span class='fc1-1'>���ͧ.........................</span></div>";	
print "<div style='left:250px;top:210px;width:500px;'><span class='fc1-1'>����Ѻ�ͧ.....................</span></div>";	

print "<div style='left:400px;top:210px;width:500px;'><span class='fc1-1'>�ѹ���ͧ</span></div>";
print "<div style='left:470px;top:210px;width:500px;'><span class='fc1-1'>$dbarr[date_regis]</span></div>";

//6
print "<div style='left:80px;top:235px;width:500px;'><span class='fc1-3'><b>���й�������ա�èͧ��§�����Ѻ�͹�ç��Һ��</b></span></div>";	

//7
print "<div style='left:80px;top:255px;width:500px;'><span class='fc1-3'>1.����ҵԴ���Ἱ�����¹����ѹ-���ҷ���к��㺹Ѵ���ͷ��͡��á���Ѻ����</span></div>";	

//8
print "<div style='left:80px;top:275px;width:500px;'><span class='fc1-3'>2.���Ӻѵû�Шӵ�ǻ�ЪҪ��ͧ�������Ҵ�����ѹ������ҹ͹�ç��Һ��</span></div>";

//9
print "<div style='left:80px;top:295px;width:800px;'><span class='fc1-3'><b>3.�óըͧ��ͧ�������� �ç��Һ�Ũ����Ǩ��§��͹�ѹ�͹ 1 �ѹ  �ҡ��ͧ����������ҧ�е�ͧ�͹��ͧ�����͹</b></span></div>";

//10
print "<div style='left:90px;top:315px;width:800px;'><span class='fc1-3'><b>��������ͧ����ɨ���ҧ�֧���������᷹�� ��е�ͧ�դ��͹��ҵ�ʹ 24 ��.</b></span></div>";
//11
print "<div style='left:80px;top:335px;width:500px;'><span class='fc1-3'>4.�ͺ��������š�èͧ��§��ǧ˹���� 1 �ѹ ��͹����ҹ͹�ç��Һ��</span></div>";

//12
print "<div style='left:90px;top:355px;width:500px;'><span class='fc1-3'><b>��������� <u>054-839305 ��� 1120-1121</u></b></span></div>";

//13
print "<div style='left:80px;top:375px;width:500px;'><span class='fc1-3'>5.�ҡ��ҹ����ҵ���Ѵ <b>�Թ���� 14.00 �.</b> �ҧ�ç��Һ�Ţ�ʧǹ�Է���¡��ԡ��èͧ��§/��ͧ</span></div>";

//14
print "<div style='left:90px;top:395px;width:500px;'><span class='fc1-3'>���ͺ�������§����Ѻ�����������蹵���</span></div>";

//15
print "<div style='left:80px;top:415px;width:500px;'><span class='fc1-3'>.................................. ��鷺�ǹ</span></div>";
//16
print "<div style='left:230px;top:415px;width:500px;'><span class='fc1-3'>.................................. ������/�ҵ�</span></div>";
//17
print "<div style='left:400px;top:415px;width:500px;'><span class='fc1-3'>......../........../.........</span></div>";
?>

</body>
</html>