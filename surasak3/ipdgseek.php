<?php
 session_start();
 echo "HN : $cHn, $cPtname, AN : $tvn , �Է��� : $cPtright <br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">

  <TABLE style="font-family: Angsana New;">
  <TR>
	<TD align="right"><a target=_BLANK href="ipdgcode.php">����/���� ��</a>&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="drugcode" size="8"></TD>
  </TR>
  <TR>
	<TD align="right">��������&nbsp;:&nbsp;</TD>
	<TD><SELECT NAME="drugtype">
		<OPTION VALUE="" >���͡������</OPTION>
		<OPTION VALUE="1" >�����</OPTION>
		<OPTION VALUE="2" >�ҩմ</OPTION>
		<OPTION VALUE="3" >������</OPTION>
		<OPTION VALUE="4" >�ҷ�</OPTION>
		<OPTION VALUE="5" >�ҹ��</OPTION>
		<OPTION VALUE="6" >����ʹ</OPTION>
		<OPTION VALUE="7" >�Ҿ�</OPTION>
	</SELECT></TD>
  </TR>
  <TR>
	<TD align="right">�ӹǹ&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="amount" size="4"></TD>
  </TR>
  <TR>
	<TD align="right"><a target=_BLANK href="ipslicode.php">�Ը���</a>&nbsp;:&nbsp;</TD>
	<TD><input type="text" name="slipcode" size="8"></TD>
  </TR>
  <TR>
	<TD colspan="2"  align="center"><input type="submit" value="    ��ŧ    " name="B1"></TD>
  </TR>
  </TABLE>




</font>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

	$sql = "Select row_id From drugslip where slcode = '".$_POST["slipcode"]."' ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) == 0){
		echo "������Ը��� ".$_POST["slipcode"];
		exit();
	}

    $query = "SELECT drugcode,tradname,genname,salepri FROM druglst WHERE ((drugcode LIKE '$drugcode%') OR (tradname LIKE '$drugcode%')) AND drugcode LIKE '".$_POST["drugtype"]."%' Order by drugcode ASC , tradname ASC ";

    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"ipinfo.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\"><font face='Angsana New'>$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>
