<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>�����㺨ͧ��§</title>
<style type="text/css">
.forntsarabun {	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
</head>

<body onload="JavaScript:window.print();">
<?
print "<script>"; 
print "ie4up=nav4up=false;"; 
print "var agt = navigator.userAgent.toLowerCase();"; 
print "var major = parseInt(navigator.appVersion);"; 
print "if ((agt.indexOf('msie') != -1) && (major >= 4))";   
print "ie4up = true;"; 
print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";   
print "nav4up = true;";
print "</script>";
print "<head>";
print "<STYLE>"; 
print "A {text-decoration:none}"; 
print "A IMG {border-style:none; border-width:0;}";
print "DIV {position:absolute; z-index:25;}";
print ".fc1-0 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-2 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".fc1-9 { COLOR:000000;FONT-SIZE:12PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}";
print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "</head>";
print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

include("../Connections/connect.inc.php"); 

	$row_id=trim($_GET['row_id']);
	
	$sql="SELECT * FROM  booking  WHERE  row_id ='".$row_id."' ";
    $query = mysql_query($sql); 
	$dbarr=mysql_fetch_array($query);
	
	
	$age=calcage($dbarr['bdate']);
///1
print "<DIV style='left:80PX;top:15PX;width:500PX;height:30PX;'><span class='fc1-3'>�ͧ/Ἱ�/��ǹ �ٹ��������  �͡��������Ţ FR-IPC-001/3  ��䢤��駷�� 00  �ѹ����ռźѧ�Ѻ�� 28 �.�.44</span></DIV>";
print "<DIV style='left:300PX;top:30PX;width:500PX;height:30PX;'><span class='fc1-0'>㺨ͧ��§</span></DIV>";	

//2
print "<DIV style='left:190PX;top:60PX;width:800PX;height:30PX;'><span class='fc1-1'>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ</span></DIV>";	


//3
print "<DIV style='left:80PX;top:85PX;width:500PX;height:30PX;'><span class='fc1-1'>����-ʡ��</span></DIV>";	
print "<DIV style='left:150PX;top:85PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[ptname]</span></DIV>";	
print "<DIV style='left:330PX;top:85PX;width:500PX;height:30PX;'><span class='fc1-1'>����</span></DIV>";	
print "<DIV style='left:400PX;top:85PX;width:500PX;height:30PX;'><span class='fc1-1'>$age</span></DIV>";

/////2
print "<DIV style='left:80PX;top:110PX;width:500PX;height:30PX;'><span class='fc1-1'>HN</span></DIV>";	
print "<DIV style='left:150PX;top:110PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[hn]</span></DIV>";	
print "<DIV style='left:330PX;top:110PX;width:500PX;height:30PX;'><span class='fc1-1'>�Ѻ���������</span></DIV>";	
print "<DIV style='left:430PX;top:110PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[date_in]</span></DIV>";
	
//3
print "<DIV style='left:80PX;top:135PX;width:500PX;height:30PX;'><span class='fc1-1'>DX</span></DIV>";	
print "<DIV style='left:150PX;top:135PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[diag]</span></DIV>";	
print "<DIV style='left:330PX;top:135PX;width:500PX;height:30PX;'><span class='fc1-1'>ᾷ��</span></DIV>";	
print "<DIV style='left:400PX;top:135PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[doctor]</span></DIV>";	


//4
print "<DIV style='left:80PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-1'>�ͼ�����</span></DIV>";
print "<DIV style='left:150PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[ward]</span></DIV>";
print "<DIV style='left:330PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-1'>��§/��ͧ</span></DIV>";
print "<DIV style='left:400PX;top:160PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[bed]</span></DIV>";


//5
print "<DIV style='left:80PX;top:185PX;width:500PX;height:30PX;'><span class='fc1-1'>�Է�ԡ���ѡ�� $dbarr[ptright]</span></DIV>";

//5
print "<DIV style='left:80PX;top:210PX;width:500PX;height:30PX;'><span class='fc1-1'>���ͧ.........................</span></DIV>";	
print "<DIV style='left:250PX;top:210PX;width:500PX;height:30PX;'><span class='fc1-1'>����Ѻ�ͧ.....................</span></DIV>";	

print "<DIV style='left:400PX;top:210PX;width:500PX;height:30PX;'><span class='fc1-1'>�ѹ���ͧ</span></DIV>";
print "<DIV style='left:470PX;top:210PX;width:500PX;height:30PX;'><span class='fc1-1'>$dbarr[date_regis]</span></DIV>";

//6
print "<DIV style='left:80PX;top:235PX;width:500PX;height:30PX;'><span class='fc1-3'><b>���й�������ա�èͧ��§�����Ѻ�͹�ç��Һ��</b></span></DIV>";	

//7
print "<DIV style='left:80PX;top:255PX;width:500PX;height:30PX;'><span class='fc1-3'>1.����ҵԴ���Ἱ�����¹����ѹ-���ҷ���к��㺹Ѵ���ͷ��͡��á���Ѻ����</span></DIV>";	

//8
print "<DIV style='left:80PX;top:275PX;width:500PX;height:30PX;'><span class='fc1-3'>2.���Ӻѵû�Шӵ�ǻ�ЪҪ��ͧ�������Ҵ�����ѹ������ҹ͹�ç��Һ��</span></DIV>";

//9
print "<DIV style='left:80PX;top:295PX;width:800PX;height:30PX;'><span class='fc1-3'><b>3.�óըͧ��ͧ�������� �ç��Һ�Ũ����Ǩ��§��͹�ѹ�͹ 1 �ѹ  �ҡ��ͧ����������ҧ�е�ͧ�͹��ͧ�����͹</b></span></DIV>";

//10
print "<DIV style='left:90PX;top:315PX;width:800PX;height:30PX;'><span class='fc1-3'><b>��������ͧ����ɨ���ҧ�֧���������᷹�� ��е�ͧ�դ��͹��ҵ�ʹ 24 ��.</b></span></DIV>";
//11
print "<DIV style='left:80PX;top:335PX;width:500PX;height:30PX;'><span class='fc1-3'>4.�ͺ��������š�èͧ��§��ǧ˹���� 1 �ѹ ��͹����ҹ͹�ç��Һ��</span></DIV>";

//12
print "<DIV style='left:90PX;top:355PX;width:500PX;height:30PX;'><span class='fc1-3'><b>��������� <u>054-839305 ��� 1120-1121</u></b></span></DIV>";

//13
print "<DIV style='left:80PX;top:375PX;width:500PX;height:30PX;'><span class='fc1-3'>5.�ҡ��ҹ����ҵ���Ѵ <b>�Թ���� 14.00 �.</b> �ҧ�ç��Һ�Ţ�ʧǹ�Է���¡��ԡ��èͧ��§/��ͧ</span></DIV>";

//14
print "<DIV style='left:90PX;top:395PX;width:500PX;height:30PX;'><span class='fc1-3'>���ͺ�������§����Ѻ�����������蹵���</span></DIV>";

//15
print "<DIV style='left:80PX;top:415PX;width:500PX;height:30PX;'><span class='fc1-3'>.................................. ��鷺�ǹ</span></DIV>";
//16
print "<DIV style='left:230PX;top:415PX;width:500PX;height:30PX;'><span class='fc1-3'>.................................. ������/�ҵ�</span></DIV>";
//17
print "<DIV style='left:400PX;top:415PX;width:500PX;height:30PX;'><span class='fc1-3'>......../........../.........</span></DIV>";
?>



</body>
</html>