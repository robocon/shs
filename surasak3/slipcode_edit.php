
<a target=_self  href='../nindex.htm'><< �����</a>
<?php
    session_start();
    echo "��䢨ӹǹ����Ը����� 1 �ѹ";
?>

<form name="formedit" method="post" action="<? $_SERVER['PHP_SELF']?>">
<table >
 <tr >
  <th bgcolor=#CC9900><font face='Angsana New'>����</th>
  <th bgcolor=#CC9900><font face='Angsana New'>�ӹǹ���1�ѹ</th>
  <th bgcolor=#CC9900><font face='Angsana New'>�Ը���</th>
  <th bgcolor=#CC9900><font face='Angsana New'>�Ը���</th>
  <th bgcolor=#CC9900><font face='Angsana New'>�Ը���</th>
  <th bgcolor=#CC9900><font face='Angsana New'>�Ը���</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT row_id,slcode,detail1,detail2,detail3,detail4,amount FROM drugslip where slcode!='' ORDER BY slcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($row,$slcode, $detail1, $detail2,$detail3,$detail4,$amount) = mysql_fetch_row ($result)) {
		$k++;
        print (" <tr>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'><b>$slcode</b></td>\n".
		   "  <td BGCOLOR=#CCCC00><font face='Angsana New'><input name='ch$k' type='text' size='5' value='$amount'><input name='rowid$k' type='hidden' value='$row'></td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$detail1</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$detail2</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$detail3</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$detail4</td>\n".
           " </tr>\n");
         }
		 echo "<input name='sum' type='hidden' value='$k'>";
    include("unconnect.inc");
	?>
<tr>
<td BGCOLOR='#CCCC00' colspan='6'><input type='submit' value=' ��ŧ ' name='ok' onclick='return confirm("�׹�ѹ�����䢨ӹǹ?");'></td>
</tr>

</table>
</form>
<?
include("connect.inc");
if(isset($_POST['ok'])){
	for($p=1;$p<$_POST['sum'];$p++){
		$sql = "update drugslip set amount = '".$_POST['ch'.$p]."' where row_id='".$_POST['rowid'.$p]."' ";
		mysql_query($sql);
	}
	?>
		<script>
        	window.location.href='slipcode_edit.php';
        </script>
	<?
}
?>
