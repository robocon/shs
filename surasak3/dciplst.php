<?php
session_start();
include("connect.inc");

print "�����·���˹���㹢ͧ��͹ $mo-$thiyr  �Է���ԡ���µç";
print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
$yrmo="$thiyr-$mo";
?>
<table>
    <tr bgcolor="#999966">
        <th>#</th>
        <th>ADMIT</th>
        <th>D/C</th>
        <th>�ѹ�͹</th>
        <th>HN</th>
        <th>AN</th>
        <th>ICD10</th>
        <th>ICD9CM</th>
        <th>���ͼ�����</th>
        <th>�ԹԨ����ä</th>
        <th>�������¨�ԧ</th>
        <th>AjRw</th>
        <th>��Ѵ���</th>
        <th>��ǹ��ҧ</th>
    </tr>
    <?php
    $num=0;
    // include("connect.inc");

    $query = "SELECT date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode,price,ajrw,priceajrw,ptright FROM ipcard WHERE dcdate LIKE '$yrmo%'  and  ptright LIKE 'R03%' ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode,$price,$ajrw,$priceajrw,$ptright) = mysql_fetch_row ($result)) {
        $num++;
        $ajrw1 =  $ajrw1 + $ajrw ;
        $priceajrw = $ajrw * 11810;
        $profit = $price - $priceajrw ;
        print (" <tr>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcdate</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$days</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$icd10</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dxicd9lst.php? cHn=$hn&cAn=$an\">�� ICD</a></td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"ajrwipedit.php? cHn=$hn&cAn=$an\">$ptname</a></td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diag</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ajrw</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$priceajrw</td>\n".
        "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$profit</td>\n".
        " </tr>\n");
    }
    // include("unconnect.inc");
    ?>
</table>
<?php
// session_start();
print "�����·���˹���㹢ͧ��͹ $mo-$thiyr  �Է���ԡ��ѧ�ѧ��Ѵ";
print "&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
$yrmo="$thiyr-$mo";
?>
<table>
    <tr>
        <th bgcolor=#999966>#</th>
        <th bgcolor=#999966><font face='Angsana New'>ADMIT</th>
        <th bgcolor=#999966><font face='Angsana New'>D/C</th>
        <th bgcolor=#999966><font face='Angsana New'>�ѹ�͹</th>
        <th bgcolor=#999966><font face='Angsana New'>HN</th>
        <th bgcolor=#999966><font face='Angsana New'>AN</th>
        <th bgcolor=#999966><font face='Angsana New'>ICD10</th>
        <th bgcolor=#999966><font face='Angsana New'>ICD9CM</th>
        <th bgcolor=#999966><font face='Angsana New'>���ͼ�����</th>
        <th bgcolor=#999966><font face='Angsana New'>�ԹԨ����ä</th>
        <th bgcolor=#999966><font face='Angsana New'>�������¨�ԧ</th>
        <th bgcolor=#999966><font face='Angsana New'>AjRw</th>
        <th bgcolor=#999966><font face='Angsana New'>��Ѵ���</th>
        <th bgcolor=#999966><font face='Angsana New'>��ǹ��ҧ</th>
    </tr>
<?php
$query = "SELECT date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode,price,ajrw,priceajrw,ptright FROM ipcard WHERE dcdate LIKE '$yrmo%'  and  ptright LIKE 'R02%' ";
$result = mysql_query($query) or die("Query failed");
while (list ($date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode,$price,$ajrw3,$priceajrw,$ptright) = mysql_fetch_row ($result)) {
    $num++;
    //    $adm=substr($date,8,8);
    //    $dc=substr($dcdate,8,8);
    $ajrw2 =  $ajrw2 + $ajrw3 ;
    $priceajrw = $ajrw * 11810;
    $profit = $price - $priceajrw ;
    print (" <tr>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$dcdate</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$days</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$hn</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$an</td>\n".
    //"  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$icd10</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dxicd9lst.php? cHn=$hn&cAn=$an\">�� ICD</a></td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"ajrwipedit.php? cHn=$hn&cAn=$an\">$ptname</a></td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diag</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ajrw3</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$priceajrw</td>\n".
    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$profit</td>\n".
    " </tr>\n");
}
// include("unconnect.inc");
$ajrw4 = $ajrw1 +  $ajrw2 ;
$cmi = $ajrw4 / $num ;
$cmi1 = 1.236 - $cmi ;
print "<br>�ӹǹ�������������˹���  =  $num �� <br> ";
print " AjRwb ���  =  $ajrw1 +  $ajrw2 = $ajrw4 <br>";
print "��� CMI   =  1.236 <br>";
print "��� CMI �Ѩ�غѹ  = $ajrw4 / $num =  $cmi <br>";
print "�Թྴҹ?    =  $cmi1 <br><br><br>";
?>
</table>



