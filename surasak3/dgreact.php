<?php
//��¡������
   session_start();
   include("connect.inc");

   $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$cHn' ";
   $result = mysql_query($query)
        or die("Query drugreact failed!");
   print "<font face='AngsanaUPC' size='4'><b>$cPtname,HN:$cHn,�Է��:$cPtright</b></font>";

   if(mysql_num_rows($result)){
	    print "<font face='AngsanaUPC' size='4'><b>$cPtname,HN:$cHn, �Է��:$cPtright</b></font>";

		print"<table>";
		print"<tr>
		  <td width='80%'><br>�ѹ�֡�������";
			while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                "  <td BGCOLOR=FF6347><font face='cordia New'  size=3>$tradname...$advreact($asses)</td>\n".
                " </tr>\n");
  						    }
		  print"	</td>";
		print"</tr>";
		print"</table>";
		print"<font face='AngsanaUPC' size='2'>(1=����͹,2=��Ҩ���,3=�Ҩ����,4=ʧ���)";
   }
   else {
		print"<br><br>����պѹ�֡�������";
   }
//����¡������

   include("unconnect.inc");
?>
