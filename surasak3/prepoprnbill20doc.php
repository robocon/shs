<style>
.f1{
	font-family: "TH SarabunPSK";
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}
</style>
<?php
///function convert to float number �ȹ��� 2���˹�
function vat($nVArabic){
    $nVArabic = number_format($nVArabic, 2, '.', ''); 
    $cTarget = Ltrim($nVArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1);

$cRtnum=$cRtnum/100;
$cRtnum=intval($cRtnum);
$vat=$nVArabic+$cRtnum;
return $vat;
	}
///end of function convert to float number �ȹ��� 2���˹�

    include("connect.inc");

	///Load offisers
    $aMancode=array("aMancode"); 
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';

	for ($n=1; $n<=10; $n++){

		$query = "SELECT * FROM officers WHERE mancode = '$aMancode[$n]'";
		$result = mysql_query($query)
			or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
				 }

			if(!($row = mysql_fetch_object($result)))
				continue;
				 }
		$aYot[$n]	=$row->yot; 
		$aFname[$n] =$row->fullname; 
		$aPost[$n]  =$row->position; 
		$aPost2[$n] =$row->position2; 
							}
///////End Load offisers

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id' ";
    $result = mysql_query($query) or die("Query pocompany fail");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }

//31
	$cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	
		$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
		$result1 = mysql_query($query1)or die("Query failed");
		$row1 = mysql_fetch_array($result1);
		if($row1){
		$fax="(  ".$row1['fax']."  )";
		}

//�ӹǹ��ҵ�ҧ�
   $nVat=$nNetprice - ($nNetprice /1.07);
///  $nVat=number_format($nVat,2,'.',''); //convert to string �ȹ��� 2 ���˹� �Ѵ���
///  $nVat=floatval ($nVat);// convert to float-number
$nNetprice=$nNetprice-$nVat;
 $nVat=vat($nVat);//use function vat

  $nPriadvat=$nNetprice+$nVat;

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');



print "<head>";
print"<STYLE>";
 print"A {text-decoration:none}";
 print"A IMG {border-style:none; border-width:0;}";
 print"DIV {position:absolute; z-index:25;}";
print".fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:BOLD;}";
print".fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:THSarabunPSK;FONT-WEIGHT:NORMAL;}";
print".ad1-0 {border:0PX none 000000; }";
print".ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }";
print".ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }";
print".ad1-3 {border:1PX dashed 000000; }";
print"</STYLE>";
///// po31.php///
print "<HTML>";
print "<script>";
 print "ie4up=nav4up=false;";
 print "var agt = navigator.userAgent.toLowerCase();";
 print "var major = parseInt(navigator.appVersion);";
 print "if ((agt.indexOf('msie') != -1) && (major >= 4))";
   print "ie4up = true;";
 print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";
   print "nav4up = true;";
print "</script>";

print "<STYLE>";
 print "A {text-decoration:none}";
 print "A IMG {border-style:none; border-width:0;}";
 print "DIV {position:absolute; z-index:25;}";
print "</STYLE>";
print "<TITLE>Crystal Report Viewer</TITLE>";
print "<BODY BGCOLOR='FFFFFF'LEFTMARGIN=0 TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0>";
print "<DIV style='z-index:0'> &nbsp; </div>";
print "<DIV style='left:88PX;top:110PX;width:697PX;height:30PX;'><span class='fc1-4'>��ǹ�Ҫ���&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:329PX;top:49PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:88PX;top:139PX;width:333PX;height:30PX;'><span class='fc1-5'>��� �� 0483.63.4/$cPrepono</span></DIV>";
//print "<DIV style='left:418PX;top:139PX;width:32PX;height:30PX;'><span class='fc1-5'>�ѹ���</span></DIV>";
print "<DIV style='left:418PX;top:110PX;width:257PX;height:30PX;'><span class='fc1-5'>$cPrepodate</span></DIV>";
print "<DIV style='z-index:15;left:88PX;top:27PX;width:73PX;height:80PX;'><img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'></DIV>";
print "<DIV style='left:88PX;top:169PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:88PX;top:198PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:138PX;top:198PX;width:283PX;height:30PX;'><span class='fc1-5'>��.þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:88PX;top:227PX;width:36PX;height:30PX;'><span class='fc1-5'>��ҧ�֧</span></DIV>";
print "<DIV style='left:138PX;top:227PX;width:617PX;height:30PX;'><span class='fc1-5'>��§ҹ�ʹͤ�����ͧ���  $cDepart  ���  $cDepartno  ŧ�ѹ���  $cDepartdate </span></DIV>";

print "<DIV style='left:167PX;top:321PX;width:317PX;height:30PX;'><span class='fc1-5'>�֧���¹�����͡�سҾԨ�ó�</span></DIV>";
print "<DIV style='left:391PX;top:364PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:403PX;top:393PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:88PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:459PX;top:492PX;width:228PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:97PX;top:563PX;width:43PX;height:30PX;'><span class='fc1-5'>��Ť��</span></DIV>";
print "<DIV style='left:88PX;top:592PX;width:313PX;height:30PX;'><span class='fc1-5'>- ��繤�þԨ�ó�͹��ѵ���ШѴ�Ҩҡ�Թ������Ѻ�</span></DIV>";
print "<DIV style='left:470PX;top:592PX;width:238PX;height:30PX;'><span class='fc1-5'>�����Թ������Ѻʶҹ��Һ��</span></DIV>";
print "<DIV style='left:459PX;top:534PX;width:324PX;height:30PX;'><span class='fc1-5'>- ���.��. þ.����� ��Ǩ�ͺ�������ԹʹѺʹع��</span></DIV>";
print "<DIV style='left:128PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[4]</span></DIV>";
print "<DIV style='left:128PX;top:803PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:450PX;top:623PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[5]</span></DIV>";
print "<DIV style='left:143PX;top:563PX;width:237PX;height:30PX;'><span class='fc1-5'><B>$nPriadvat</B> �ҷ</span></DIV>";
print "<DIV style='left:133PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[4])</span></DIV>";
print "<DIV style='left:479PX;top:652PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
print "<DIV style='left:133PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[4] $aPost2[4]</span></DIV>";
print "<DIV style='left:123PX;top:832PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
print "<DIV style='left:479PX;top:681PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
print "<DIV style='left:133PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
print "<DIV style='left:148PX;top:769PX;width:55PX;height:30PX;'><span class='fc1-5'>͹��ѵ�</span></DIV>";
print "<DIV style='left:123PX;top:890PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";
print "<DIV style='left:433PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";
print "<DIV style='left:123PX;top:861PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1]</span></DIV>";
print "<DIV style='left:479PX;top:710PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:479PX;top:731PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............../.............../..............</span></DIV>";

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>��͹��ѵԨѴ���Ǫ�ѳ�� $cDepart</span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>�ͧ���Ѫ���� þ.����� ��͹��ѵԨѴ���Ǫ�ѳ�� ������㹡���ѡ�Ҿ�Һ�ż������纷�������</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>�Ѻ����ѡ�Ҿ�Һ��� þ.��������ѡ�������� �ӹǹ $nItems ��¡�� �ѧ����¡�õ����觷�����Ҵ�������</span></DIV>";
print "<DIV style='left:88PX;top:534PX;width:292PX;height:30PX;'><span class='fc1-5'>- �ͧ���Ѫ����� ��͹��ѵԨѴ���Ǫ�ѳ��</span></DIV>";
print "<DIV style='left:459PX;top:563PX;width:324PX;height:30PX;'><span class='fc1-5'>- ��繤��͹��ѵԨѴ���Ǫ�ѳ�����ʹ�</span></DIV>";
print "<BR>";
print "</BODY></HTML>";



?>