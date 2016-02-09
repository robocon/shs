<?php
session_start();
?>
<body>
<html>
<head>
<title>㺹Ѵ������ þ.��������ѡ��������</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

<script type="text/javascript">
window.onload = function(){
	window.print();
	// opener.location.href='hnappoi1.php';
	// window.close();
}
</script>
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


/* Your CSS is below */
html{
    font-family: 'TH SarabunPSK'!important;
    font-size: 16pt;
}
u{
    border-bottom: 2px solid #000000;
    text-decoration: none;
}
b{ font-weight: bold; }
.size1{
    font-size: 8pt;
    line-height: 12pt;
}
.size2{
    font-size: 12pt;
    line-height: 16pt;
}
.size3{
    font-size: 16pt;
    line-height: 20pt;
}
.size4{
    font-size: 17pt;
    line-height: 21pt;
}
.size5{
    font-size: 24pt;
    line-height: 28pt;
}
.center{
    text-align: center;
}
</style>

</head>
<?php
function jschars($str){
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

include("connect.inc");

$sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright, a.labextra From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_GET["row_id"]."'  limit 1 ";
list($row_id, $date, $officer1, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright,$labextra) = Mysql_fetch_row(Mysql_Query($sql));

$exm = explode(" ",$appd);

$d1 = $exm[0]; 
$m1 = trim($exm[1]); 
$y1 = $exm[2]-543; 

$arr1 = array("���Ҥ�" => "01" ,"����Ҿѹ��" => "02", "�չҤ�" => "03" , "����¹" => "04" ,"����Ҥ�" => "05" ,"�Զع�¹" => "06" , "�á�Ҥ�" => "07" , "�ԧ�Ҥ�" => "08" , "�ѹ��¹" => "09" , "���Ҥ�"  => "10" , "��Ȩԡ�¹" => "11" ,  "�ѹ�Ҥ�" => "12" );
$appday = $y1.'-'.$arr1[$m1].'-'.$d1;

$DayOfWeek = date("w", strtotime($appday));

switch ($DayOfWeek) {
    case "0":
        $day="�ҷԵ��";
        break;
    case "1":
        $day="�ѹ���";
        break;
    case "2":
        $day="�ѧ���";
        break;
    case "3":
        $day="�ظ";
        break;
    case "4":
        $day="����ʺ��";
        break;
    case "5":
        $day="�ء��";
        break;
    case "6":
        $day="�����";
        break;
}

if (isset($cHn )){

    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 

//�����㺹Ѵ
    $doctor=substr($doctor,5);
    $depcode=substr($depcode,4);
    ?>
    <p class="size5 center"><b>㺹Ѵ������ �ç��Һ�Ť�������ѡ�������� �ӻҧ</b></p>
    <p class="size2 center">FR-NUR-003/2,04, 25 �.�. 54</p>
    <p class="size4"><b>����:</b> <?=$cPtname;?> <b>HN:</b> <?=$cHn;?> <b>����:</b> <?=$cAge;?> <b>�Է��:</b> <?=$cptright;?></p>
    <p class="size3"><b>�����˵�: <u><?=$cidguard;?></u></b></p>
    <p class="size5" style="line-height: 36px;"><b><u>�Ѵ��: �ѹ<?=$day;?> ��� <?=$appd;?> ����: <?=$capptime;?></u></b></p>
    <p class="size4"><b><u>���㺹Ѵ���: <?=$room;?></u></b>&nbsp;<b>����:</b> <?=$detail;?><?=( $detail2 != "" ? "($detail2)" : "" );?></p>
    <?php
    if ($detail != 'NA') { 
        ?><p class="size3"><b>ᾷ����Ѵ:</b> <?=$cdoctor;?></p><?php
    }

    if ($advice != 'NA') {
        print "<p><b>����й�:</b> $advice</p>";
    }
    
    if (trim($patho) != 'NA') {
        print "<p><b>��Ǩ��Ҹ�:</b> $patho</p>";
    }
    
    if (!empty($labextra)) { 
        print "<p><b>����觾����:</b> $labextra</p>";
    }
    
    if (trim($xray) != 'NA') {
        print "<p><b>��Ǩ�͡�����:</b> $xray</p>";
    }
    
    if (!empty($other)) { 
        print "<p><b>����:</b> $other</p>";
    }

    print "<p><b>����͡㺹Ѵ:</b> $officer1, $depcode <b>�ѹ������ҷ���͡㺹Ѵ:</b> $Thaidate</p>";
    
    if ($detail =='FU01 ��Ǩ����Ѵ' ){ 
        print "1. ��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ</b> ������㺹Ѵ���Ἱ�����¹ &nbsp; <br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125"; 
        
    } else  if  ($detail =='FU02 ����ŵ�Ǩ' ){ 
        print "1. ��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ</b> ���㺹Ѵ���Ἱ�����¹ &nbsp; <br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125"; 
    
    } else  if  ($detail =='FU03 �͹�ç��Һ��') { 
        print "1. �����¹Ѵ�͹�ç��Һ��������㺹Ѵ���Ἱ�����¹ ��س��ҵç����ѹ������ҹѴ<br>
        2. ������͡��÷���ͧ����ç��Һ�� �� ���Һѵû�Шӵ�� , ˹ѧ����Ѻ�ͧ�Է�Ե�ҧ�<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125";  
    
    } else if ($detail =='FU04 �ѹ�����') { 
        print "1. �����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ����� <br>
        2. ��س��ҵç����ѹ������ҹѴ <b>��ҼԴ�Ѵ</b> ���㺹Ѵ���Ἱ�����¹<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� �� 054-839305-6 ��� 1230"; 
    
    } else if  ($detail =='FU05 ��ҵѴ') { 
        print "1. �����¹Ѵ��Ǩ��ҵѴ������㺹Ѵ���Ἱ�����¹<br>
        2. ��س��ҵç����ѹ������ҹѴ<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100, 1125"; 
    
    } else if  ($detail =='FU06 �ٵ�') { 
        print "1. �����¹Ѵ��Ǩ�ٵ�������㺹Ѵ���Ἱ�����¹<br>
        2. ��س��ҵç����ѹ������ҹѴ<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� �� 054-839305-6 ��� 5111"; 
    
    } else  if ($detail =='FU07 ��չԡ�ѧ���'){ 
        print "1. �����¹Ѵ��Ǩ��չԡ�ѧ���������㺹Ѵ���Ἱ�����¹<br>
        2. ��س��ҵç����ѹ������ҹѴ<br>
        3. �Ӥ������Ҵ��ҧ���������º����<br>
        4. �Ѻ��зҹ������������� <br>
        5. �������ͼ�ҷ������Ѵ�� ����������ᢹ������͡ҧࡧ�������ö�ٴ����˹��������дǡ<br>
        6. �����ͧ��� �������������º���¡�͹�����������Դ�ҡ�ûǴ������Т�нѧ���<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ���  �� 054-839305-6 ��� 2111";  
    
    } else  if ($detail =='FU08 Echo'){ 
        print "1. �����¹Ѵ��Ǩ Echo ������㺹Ѵ���ش�Ѵ<br>
        2. ��س��ҵç����ѹ������ҹѴ <b>��ҼԴ�Ѵ</b> ���㺹Ѵ���Ἱ�����¹<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125";  
    
    } else  if ($detail =='FU09 ��š�д١'){ 
        print "1. �����¹Ѵ��Ǩ��š�д١������㺹Ѵ���ش�Ѵ<br>
        2. ��س��ҵç����ѹ������ҹѴ <b>��ҼԴ�Ѵ</b> ���㺹Ѵ���Ἱ�����¹<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125";  
    
    } else  if ($detail =='FU12 �ǴἹ��'){ 
        print "1. �óչѴ���� �ҡ�Ҫ���Թ 10 �ҷ� ���������駢�ʧǹ�Է���������Ѻ��ԡ�÷�ҹ������Ѻ��ԡ�á�͹<br>
        2. �ҡ��ҹ���ҡ�� �� �纤� �� ��͹���� ��駴��ùǴ<br>
        3. �ҧ�ç��Һ���������ö�Ѻ�Դ�ͺ��觢ͧ�դ�Ңͧ��ҹ��<br>
        <b>�ó�����͹�Ѵ</b> �������Ţ���Ѿ�� 054-839305-6 ��� 8002
        ";  
    
    } else  { 
        print "1. �����¹Ѵ��Ǩ������㺹Ѵ���Ἱ�����¹ <br>
        2. ��س��ҵç����ѹ������ҹѴ <b>��ҼԴ�Ѵ</b> ���㺹Ѵ���Ἱ�����¹<br>
        <b>�ó�����͹�Ѵ</b> ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ�� ��ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305 ��� 1100 , 1125
        ";
    
    }

    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cAge");

} else {
    
    $doctor = substr($doctor,5);
    $depcode = substr($depcode,4);
    print "&nbsp;&nbsp;<b>>>>>>>>>㺹Ѵ������<<<<<<<<</b><br>";
    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;********FR-OPD-004/1,02, 23 �.�. 49 ********<br>";
    print ">>>>�ç��Һ�Ť�������ѡ��������  �ӻҧ  �� 054 - 839305 - 6 <<<<<br>";
    print "<b>����:</b> $cPtname  &nbsp;&nbsp;&nbsp;<b>HN:</b> $cHn &nbsp;<b>����:</b> $cAge&nbsp;<b>�Է��:$cptright<u>$cidguard</u></font></b><br>";
    print "<b><FONT SIZE=4><U>�Ѵ��: �ѹ$day ��� $appd&nbsp;&nbsp;&nbsp;</U> </FONT></b><b> ����:</b> $capptime<br>";
    print "<b>�Ѵ�ҷ����ͧ:</b>&nbsp; $room";
    print "&nbsp;&nbsp;&nbsp;<b>ᾷ����Ѵ:</b>&nbsp; $cdoctor<br>";
    
    if($detail !='NA') { 
        print "<b>����:</b>&nbsp; $detail";
    }
    
    if(!empty($detail2)) { 
        print "<b>:</b>&nbsp; $detail2<br>";
    }
    
    if($advice != 'NA') {
        print "<b>����й�:</b> &nbsp;$advice<br>";
    }
    
    if($patho != 'NA') {
        print "<b>��Ǩ��Ҹ�:</b>&nbsp; $patho<br>";
    }
    
    if($xray != 'NA') {
        print "<b>��Ǩ�͡�����:</b>&nbsp; $xray<br>";
    }
    
    if(!empty($other)) { 
        print "<b>��Ǩ:</b>&nbsp; $other<br>";
    }
    
    print "<b>����͡㺹Ѵ:</b>&nbsp; $sOfficer,&nbsp; $depcode "; 
    print "&nbsp;&nbsp;<b>�ѹ������ҷ���͡㺹Ѵ&nbsp;:</b>$Thaidate<br>"; 
    print "1.�����¹Ѵ��Ǩ���㺹Ѵ���ش��ԡ�ùѴ &nbsp;&nbsp;2.��س��ҵç����ѹ������ҹѴ&nbsp;<b>��ҼԴ�Ѵ</b> ������Ἱ�����¹ &nbsp; </b><br>3.�����¹Ѵ��ҵѴ �͹ ����ٵ� ������㺹Ѵ���Ἱ�����¹  &nbsp;&nbsp;4.�����¹Ѵ�ѹ����� ������㺹Ѵ���Ἱ��ѹ�����<br>5.5.�ó�����͹�Ѵ ��ͧ�Դ�����ǧ˹�����ҧ���� 2 �ѹ�ӡ����ѹ�����Ҫ��� ���� 13.30 �. - 15.00 �. �� 054-839305-6 ��� 1100 , 1125 "; 

}
include("unconnect.inc");
?>