<style type="text/css">
.angsana{
	font-family:"Angsana New";
	font-size:18px;
}
</style>
<?
include("connect.inc");

$strSQL2 = "SELECT  * FROM accrued as a , opcard as b  WHERE a.hn=b.hn and a.hn='".$_GET['hn']."' and status_pay='n' ";
$objQuery2 = mysql_query($strSQL2) or die ("Error Query [".$strSQL2."]");
$rows2=mysql_num_rows($objQuery2);


 echo "<font size='+2' class='angsana'>�ʴ���¡�÷���ҧ����</font>";
 print "&nbsp;&nbsp<a target=_self  href='../nindex.htm' class='angsana'><<�����</a>"; ?>
<br>
<br>

<table  border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse"  bordercolor="#000000" class="angsana"  width="100%">
  <tr bgcolor="#ADDFFF" onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">

    <th align="center">�ӴѺ</th>
    <th align="center">�ѹ����Ѻ��ԡ��</th>
    <th align="center">�ѹ���ѹ�֡������</th>
    <th align="center">VN</th>
    <th align="center">HN</th>
    <th align="center">����-ʡ��</th>
    <th align="center">��¡��</th>
    <th align="center">�Է��</th>
    <th align="center">�ӹǹ�Թ���</th>
    <th>�Թ��ҧ����</th>
	<!--<th align="center">ź</th>-->
    <th>ź</th>
  </tr>
<?
$i=1;
while($objResult2 = mysql_fetch_array($objQuery2))
{
	
	$ptname=$objResult2['yot'].$objResult2['name'].' '.$objResult2['surname'];
	
	if($objResult2["depart"]=='PHAR'){
	$link="<a href='acc_phardetail.php?pdate=$objResult2[txdate]&phn=$objResult2[hn]' target='_blank'>$objResult2[detail]</a>";	
	}else{
	$link="<a href='acc_hudthakandetail.php?pdate=$objResult2[txdate]&phn=$objResult2[hn]' target='_blank'>$objResult2[detail]</a>";		
	}
	$date1=explode(" ",$objResult2["txdate"]);
	$date=explode("-",$date1[0]);
	$yr=$date[0];
	$m=$date[1];
	$d=$date[2];
	
?>
  <tr  onmouseover="this.style.backgroundColor='#ADDFFF'" onmouseout="this.style.backgroundColor=''">

    <td align="center"><?=$i;?></td>
    <td><?=$objResult2["txdate"];?></td>
    <td><?=$objResult2["date"];?></td>
    <td align="center"><a href="opcashvn.php?vn=<?=$objResult2["vn"];?>&d=<?=$d;?>&m=<?=$m;?>&yr=<?=$yr;?>" target="_blank"><?=$objResult2["vn"];?></a></td>
    <td align="center"><?=$objResult2["hn"];?></td>
    <td align="left"><?=$ptname;?></td>
    <td align="left"><?=$link?></td>
    <td align="left"><?=$objResult2["ptright"];?></td>
   <td align="right"><?=$objResult2["price"];?></td>
   <td align="right"><? if($objResult2["money_trust"] <= 0){ echo "����բ�����";}else{ echo $objResult2["money_trust"];}?></td>
   <!--<td align="center"><a href="JavaScript:if(confirm('�׹�ѹ��ê����Թ��ҧ����?')==true){ window.location='accrued_delete.php?row_id=<?//=$objResult2[0];?>';}">ź</a></td>-->
  <td align="center"><a href="JavaScript:if(confirm('�׹�ѹ��ê����Թ��ҧ����?')==true){ window.location='accrued_delete.php?row_id=<?=$objResult2[0];?>';}">ź</a></td>
  </tr>
<?
$i++;
}
?>
</table>
