<?php
 session_start();
 echo "HN : $cPtname, AN : $tvn , �Է��� : $cPtright <br> ";
?>
<SCRIPT LANGUAGE="JavaScript">
function check_number() {
e_k=event.keyCode
if (e_k != 13 && e_k != 46 && e_k != 47 && e_k != 45  && (e_k < 48) || (e_k > 57)) {
	event.returnValue = false;
alert("��سҡ�͡�繵���Ţ��ҹ�鹤��");
}
}
</script>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<TABLE>
<TR>
	<TD align="right"><font face="Angsana New"><a target=_BLANK href="dgicode.php">������</a> : </font></TD>
	<TD><input type="text" name="drugcode" size="8"></TD>
	<TD>&nbsp;</TD>
</TR>
<TR>
	<TD align="right"><font face="Angsana New">�ӹǹ : </font></TD>
	<TD><input type="text" name="amount" size="4" onkeypress="return check_number();"></TD>
	<TD>&nbsp;</TD>
</TR>
<TR>
	<TD align="right"><font face="Angsana New"><a target=_BLANK href="slicode.php">�Ը���</a> : </font></TD>
	<TD><input type="text" name="slipcode" size="8"></TD>
	<TD><input type="submit" value="    ��ŧ    " name="B1"></TD>
</TR>
</TABLE>

</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
 <th bgcolor=6495ED><font face='Angsana New'>��ͧ����</th>
 <th bgcolor=6495ED><font face='Angsana New'>��ѧ</th>
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
		echo "����������Ը��� <FONT COLOR=\"#FF0000\">".$_POST["slipcode"]."</FONT>";
	}else{

    $query = "SELECT drugcode,tradname,genname,salepri,stock,mainstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri,$stock,$mainstk) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target='right'  href=\"infoip.php? Dgcode=$drugcode& Amount=$amount& Trade=$tradname & Price=$salepri & Slcode=$slipcode\"><font face='Angsana New'>$drugcode</a></td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
	}
   include("unconnect.inc");
          }
?>

</table>
