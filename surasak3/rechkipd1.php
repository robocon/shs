<?php
session_start();
// global $thiyr, $mo;

$year = isset($_GET['thiyr']) ? $_GET['thiyr'] : false ;
$month = isset($_GET['mo']) ? $_GET['mo'] : false ;
$yrmo = "$year-$month";
include("connect.inc");

?>
<p><a target=_self  href="../nindex.htm">&lt;&lt;&nbsp;�����</a> || <a href="rechkipd.php">�˹�����͡�ѹ���</a></p>
<p>������㹨�˹��¢ͧ��͹ <?php echo "$month-$year";?></p>

<form action="dcstatus.php" method="post">
    <button type="submit">��䢢��������� AN</button>
    <input type="hidden" name="back" value="<?php echo $yrmo;?>">
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
$num = 0;

$query = "SELECT dcnumber,date,dcdate,days,hn,an,icd10,goup,camp,ptname,diag,bedcode 
FROM ipcard 
WHERE dcdate LIKE '$yrmo%' 
order by dcdate ";

$result = mysql_query($query)or die("Query failed");

while ($item = mysql_fetch_assoc($result)) {
    
    $num++;
    $icd10sql="SELECT `status` FROM `dcstatus` WHERE `an` = '".$item['an']."'  Order by date DESC limit 1 ";
    $result11 = Mysql_Query($icd10sql);
    $dc = mysql_fetch_assoc($result11);
    ?>
    <tr>
        <td bgcolor="F5DEB3"><font face='Angsana New'>
            <label for="<?php echo $num;?>">
                <input type="checkbox" name="an[]" id="<?php echo $num;?>" value="<?php echo $item['an'];?>">
                <?php echo $num;?>
            </label>
        </td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['dcnumber'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['date'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['dcdate'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['hn'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><a href="dcstatus.php?an=<?php echo $item['an'];?>&back=<?php echo $yrmo;?>"><?php echo $item['an'];?></a></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['ptname'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['diag'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $item['bedcode'];?></td>
        <td bgcolor="F5DEB3"><font face='Angsana New'><?php echo $dc['status'];?></td>
    </tr>
    <?php
}
?>
</table>
</form>