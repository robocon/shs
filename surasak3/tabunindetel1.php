<?php
include("connect.inc");

$arrptright["R01"]="�Թʴ";
$arrptright["R02"]="�ԡ��ѧ�ѧ��Ѵ";
$arrptright["R03"]="�ç����ԡ���µç";
$arrptright["R04"]="�Ѱ����ˡԨ";   
$arrptright["R05"]="����ѷ(��Ҫ�)";
$arrptright["R06"]="�.�.�.������ͧ�����ʺ��¨ҡö";
$arrptright["R07"]="��Сѹ�ѧ��";
$arrptright["R08"]="�.�.44(�Ҵ��㹧ҹ)";
$arrptright["R09"]="��Сѹ�آ�Ҿ��ǹ˹��";
$arrptright["R10"]="��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)";
$arrptright["R11"]="��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)";
$arrptright["R12"]="��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡/���ԡ��)";
$arrptright["R13"]="��Сѹ�آ�Ҿ��ǹ˹��(㹨ѧ��Ѵ�ء�Թ)";
$arrptright["R14"]="��Сѹ�آ�Ҿ��ǹ˹��(�͡�ѧ��Ѵ�ء�Թ)";
$arrptright["R15"]="��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)";
$arrptright["R16"]="�֡�Ҹԡ��(����͡��)";
$arrptright["R17"]="�ŷ���";
$arrptright["R18"]="�ç����ѡ���ä� (HD)";
$arrptright["R19"]="�ç��ù��(NAPA)";
$arrptright["R20"]="��Сѹ�ѧ���óդ�ʹ�ص�";
$arrptright["R21"]="ͧ��û���ͧ��ǹ��ͧ���";
$arrptright["R22"]="��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��";
$arrptright["R23"]="�ѡ���¹/�ѡ�֡�ҷ���";

$query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$yrmonth%'  AND ( date_format( `date`, '%H:%i:%s' ) between '08:00:00' AND '16:00:00')";
$result = mysql_query($query) or die("Query failed,ipcard");

$query="CREATE TEMPORARY TABLE ipcard2 SELECT * FROM ipcard WHERE date LIKE '$yrmonth%'  AND ( date_format( `date`, '%H:%i:%s' ) not between '08:00:00' AND '16:00:00')";
$result = mysql_query($query) or die("Query failed,ipcard");

$query="SELECT  left(ptright,3) ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY left(ptright,3) HAVING duplicate > 0 ORDER BY ptright";
$result = mysql_query($query);
$n=0;
$sum = 0;
$sum1 = 0;

print "<table><tr><td colspan=\"4\">��§ҹ��Ш�  $yrmonth (������Ҫ���) <a target=_self  href='../nindex.htm'>&lt;&lt;�����</a></td></tr>";
	while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
		if(trim($ptright) !=""){
		$n++;
		
		print (" <tr>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbindetel.php? ptright=$ptright&yrmonth=$yrmonth\">".$arrptright[$ptright]."&nbsp;&nbsp;</a></td>\n".
 
		//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ = $duplicate</td>\n".
		" </tr>\n");
		$sum = $sum + $duplicate;
		}
	}
print "<tr BGCOLOR=66CDAA><td colspan='3' align='center'><font face='Angsana New'>���</td><td><font face='Angsana New'>".$sum."</td></tr>";
print "</table>";

$query="SELECT  left(ptright,3) ,COUNT(*) AS duplicate FROM ipcard2 GROUP BY left(ptright,3) HAVING duplicate > 0 ORDER BY ptright";
$result = mysql_query($query);
$n=0;

$sum1 = $sum1 + $sum;
print "<table><tr><td colspan=\"4\">��§ҹ��Ш�  $yrmonth (�͡�����Ҫ���) <a target=_self  href='../nindex.htm'>&lt;&lt;�����</a></td></tr>";
	while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
		if(trim($ptright) !=""){
		$n++;
		print (" <tr>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbindetel.php? ptright=$ptright&yrmonth=$yrmonth\">".$arrptright[$ptright]."&nbsp;&nbsp;</a></td>\n".

		//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ = $duplicate</td>\n".
		" </tr>\n");
		$sum2 = $sum2 + $duplicate;
		}
	}
$sum1 = $sum1 + $sum2;
print "<tr BGCOLOR=66CDAA><td colspan='3' align='center'><font face='Angsana New'>���</td><td><font face='Angsana New'>".$sum2."</td></tr>";
print "</table>";
print "��������� : ".$sum1;
include("unconnect.inc");
?>


