<?php
session_start();
global $thiyr, $mo;
$yrmo = "$thiyr-$mo";
?>
<p>������㹨�˹��¢ͧ��͹ <?php echo $mo-$thiyr;?></p>
&nbsp;&nbsp;&nbsp;&nbsp<a target=_self  href="../nindex.htm"><<�����</a>
<table>
    <tr>
        <th bgcolor=#999966>#</th>
        <th bgcolor=#999966><font face='Angsana New'>�Ţ���</th>
        <th bgcolor=#999966><font face='Angsana New'>ADMIT</th>
        <th bgcolor=#999966><font face='Angsana New'>D/C</th>
        <th bgcolor=#999966><font face='Angsana New'>HN</th>
        <th bgcolor=#999966><font face='Angsana New'>AN</th>
        <th bgcolor=#999966><font face='Angsana New'>���ͼ�����</th>
        <th bgcolor=#999966><font face='Angsana New'>�ԹԨ����ä</th>
        <th bgcolor=#999966><font face='Angsana New'>�ͼ�����</th>
        <th bgcolor=#999966><font face='Angsana New'>ʶҳ�</th>
    </tr>
<?php
$num=0;
include("connect.inc");

$query = "SELECT dcnumber,date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode FROM ipcard WHERE dcdate LIKE '$yrmo%' order by dcdate ";
$result = mysql_query($query)or die("Query failed");

while (list ($dcnumber,$date,$dcdate,$days,$hn,$an,$icd10,$goup,$camp,$ptname,$diag,$bedcode) = mysql_fetch_row ($result)) {
    $num++;
    $icd10sql="SELECT status FROM `dcstatus` WHERE `an` = '$an'  Order by date DESC limit 1 ";
    $result11 = Mysql_Query($icd10sql);
    list($status) = Mysql_fetch_row($result11);
    ?>
    <tr>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $num;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $dcnumber;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $date;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $dcdate;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $hn;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><a href="dcstatus.php?an=<?php echo $an;?>" target="_blank"><?php echo $an;?></a></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $ptname;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $diag;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $bedcode;?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $status;?></td>
    </tr>
    <?php
}
?>
</table>