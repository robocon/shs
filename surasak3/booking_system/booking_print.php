<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>�����㺨ͧ��§</title>
	<style type="text/css">
	/* CSS Rest */
	/* http://meyerweb.com/eric/tools/css/reset/
	v2.0 | 20110126
	License: none (public domain)
	*/

	html, body, div, span, applet, object, iframe,
	h1, h2, h3, h4, h5, h6, p, blockquote, pre,
	a, abbr, acronym, address, big, cite, code,
	del, dfn, em, img, ins, kbd, q, s, samp,
	small, strike, strong, sub, sup, tt, var,
	b, u, i, center,
	dl, dt, dd, ol, ul, li,
	fieldset, form, label, legend,
	table, caption, tbody, tfoot, thead, tr, th, td,
	article, aside, canvas, details, embed,
	figure, figcaption, footer, header, hgroup,
	menu, nav, output, ruby, section, summary,
	time, mark, audio, video {
		margin: 0;
		padding: 0;
		border: 0;
		font-size: 100%;
		font: inherit;
		vertical-align: baseline;
	}
	/* HTML5 display-role reset for older browsers */
	article, aside, details, figcaption, figure,
	footer, header, hgroup, menu, nav, section {
		display: block;
	}
	body {
		line-height: 1;
	}
	ol, ul {
		list-style: none;
	}
	blockquote, q {
		quotes: none;
	}
	blockquote:before, blockquote:after,
	q:before, q:after {
		content: '';
		content: none;
	}
	table {
		border-collapse: collapse;
		border-spacing: 0;
	}
	/*TH SarabunPSK*/
	/* Your Style */
	
	
	@font-face{
		font-family: "THSarabunNew";
		src: url("fonts/webfont/THSarabunNew.eot");
		src: url("fonts/webfont/THSarabunNew.eot#iefix"),
		url("fonts/webfont/THSarabunNew.woff") format('embedded-opentype'),
		url("fonts/webfont/THSarabunNew.ttf") format('truetype'),
		url("fonts/webfont/THSarabunNew.svg#ludger_duvernayregular") format('svg');
		font-weight: normal;
		font-style: normal;
	}
	
	
	body{
		/*font-family: 'THSarabunNew';*/
		font-family: "THSarabunNew";
		/*TH SarabunPSK*/
	}
	b{
		font-weight: bold;
	}
	
	
	
	.fc1-0 { color: #000000; font-size: 30px; font-weight: normal;}
	.fc1-1 { color: #000000; font-size: 23px; font-weight: normal;}
	.fc1-3 { color: #000000; font-size: 17px; font-weight: normal;}
	div {position:absolute; z-index:25;}
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
print "<div style='left:80px;top:15px;width:500px;height:30px;'><span class='fc1-3'>�ͧ/Ἱ�/��ǹ �ٹ��������  �͡��������Ţ FR-IPC-001/3  ��䢤��駷�� 00  �ѹ����ռźѧ�Ѻ�� 28 �.�.44</span></div>";
print "<div style='left:300px;top:30px;width:500px;height:30px;'><span class='fc1-0'>㺨ͧ��§</span></div>";	

//2
print "<div style='left:190px;top:60px;width:800px;height:30px;'><span class='fc1-1'>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ</span></div>";	


//3
print "<div style='left:80px;top:85px;width:500px;height:30px;'><span class='fc1-1'>����-ʡ��</span></div>";	
print "<div style='left:150px;top:85px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[ptname]</span></div>";	
print "<div style='left:330px;top:85px;width:500px;height:30px;'><span class='fc1-1'>����</span></div>";	
print "<div style='left:400px;top:85px;width:500px;height:30px;'><span class='fc1-1'>$age</span></div>";

/////2
print "<div style='left:80px;top:110px;width:500px;height:30px;'><span class='fc1-1'>HN</span></div>";	
print "<div style='left:150px;top:110px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[hn]</span></div>";	
print "<div style='left:330px;top:110px;width:500px;height:30px;'><span class='fc1-1'>�Ѻ���������</span></div>";	
print "<div style='left:430px;top:110px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[date_in]</span></div>";
	
//3
print "<div style='left:80px;top:135px;width:500px;height:30px;'><span class='fc1-1'>DX</span></div>";	
print "<div style='left:150px;top:135px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[diag]</span></div>";	
print "<div style='left:330px;top:135px;width:500px;height:30px;'><span class='fc1-1'>ᾷ��</span></div>";	
print "<div style='left:400px;top:135px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[doctor]</span></div>";	


//4
print "<div style='left:80px;top:160px;width:500px;height:30px;'><span class='fc1-1'>�ͼ�����</span></div>";
print "<div style='left:150px;top:160px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[ward]</span></div>";
print "<div style='left:330px;top:160px;width:500px;height:30px;'><span class='fc1-1'>��§/��ͧ</span></div>";
print "<div style='left:400px;top:160px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[bed]</span></div>";


//5
print "<div style='left:80px;top:185px;width:500px;height:30px;'><span class='fc1-1'>�Է�ԡ���ѡ�� $dbarr[ptright]</span></div>";

//5
print "<div style='left:80px;top:210px;width:500px;height:30px;'><span class='fc1-1'>���ͧ.........................</span></div>";	
print "<div style='left:250px;top:210px;width:500px;height:30px;'><span class='fc1-1'>����Ѻ�ͧ.....................</span></div>";	

print "<div style='left:400px;top:210px;width:500px;height:30px;'><span class='fc1-1'>�ѹ���ͧ</span></div>";
print "<div style='left:470px;top:210px;width:500px;height:30px;'><span class='fc1-1'>$dbarr[date_regis]</span></div>";

//6
print "<div style='left:80px;top:235px;width:500px;height:30px;'><span class='fc1-3'><b>���й�������ա�èͧ��§�����Ѻ�͹�ç��Һ��</b></span></div>";	

//7
print "<div style='left:80px;top:255px;width:500px;height:30px;'><span class='fc1-3'>1.����ҵԴ���Ἱ�����¹����ѹ-���ҷ���к��㺹Ѵ���ͷ��͡��á���Ѻ����</span></div>";	

//8
print "<div style='left:80px;top:275px;width:500px;height:30px;'><span class='fc1-3'>2.���Ӻѵû�Шӵ�ǻ�ЪҪ��ͧ�������Ҵ�����ѹ������ҹ͹�ç��Һ��</span></div>";

//9
print "<div style='left:80px;top:295px;width:800px;height:30px;'><span class='fc1-3'><b>3.�óըͧ��ͧ�������� �ç��Һ�Ũ����Ǩ��§��͹�ѹ�͹ 1 �ѹ  �ҡ��ͧ����������ҧ�е�ͧ�͹��ͧ�����͹</b></span></div>";

//10
print "<div style='left:90px;top:315px;width:800px;height:30px;'><span class='fc1-3'><b>��������ͧ����ɨ���ҧ�֧���������᷹�� ��е�ͧ�դ��͹��ҵ�ʹ 24 ��.</b></span></div>";
//11
print "<div style='left:80px;top:335px;width:500px;height:30px;'><span class='fc1-3'>4.�ͺ��������š�èͧ��§��ǧ˹���� 1 �ѹ ��͹����ҹ͹�ç��Һ��</span></div>";

//12
print "<div style='left:90px;top:355px;width:500px;height:30px;'><span class='fc1-3'><b>��������� <u>054-839305 ��� 1120-1121</u></b></span></div>";

//13
print "<div style='left:80px;top:375px;width:500px;height:30px;'><span class='fc1-3'>5.�ҡ��ҹ����ҵ���Ѵ <b>�Թ���� 14.00 �.</b> �ҧ�ç��Һ�Ţ�ʧǹ�Է���¡��ԡ��èͧ��§/��ͧ</span></div>";

//14
print "<div style='left:90px;top:395px;width:500px;height:30px;'><span class='fc1-3'>���ͺ�������§����Ѻ�����������蹵���</span></div>";

//15
print "<div style='left:80px;top:415px;width:500px;height:30px;'><span class='fc1-3'>.................................. ��鷺�ǹ</span></div>";
//16
print "<div style='left:230px;top:415px;width:500px;height:30px;'><span class='fc1-3'>.................................. ������/�ҵ�</span></div>";
//17
print "<div style='left:400px;top:415px;width:500px;height:30px;'><span class='fc1-3'>......../........../.........</span></div>";
?>

</body>
</html>