<?php
session_start();
include("connect.inc");


if($_GET["action"] == "add"){
	
	$sql = "Select count(row_id) as crow_id From druglst where drugcode = '".$_POST["drugcode"]."' ";
	list($count_drug) = Mysql_fetch_row(Mysql_Query($sql));


	$sql = "Select count(row_id) as crow_id From drugslip where slcode = '".$_POST["slcode"]."' ";
	$result = Mysql_Query($sql);
	list($crow_id) = Mysql_fetch_row($result);
	
	if($count_drug==0){
		echo "����������� ".$_POST["drugcode"];
	}else if($crow_id ==0){
		echo "����������Ը��� ".$_POST["slcode"];
	}else{
		

		$sql = "Select part, salepri, freepri, tradname From druglst where drugcode = '".$_POST["drugcode"]."' limit 1";
		list($part, $salepri, $freepri, $tradname) = Mysql_fetch_row(Mysql_Query($sql));
		
		$sql = "Select item, hn From ddrugrx where idno='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1 ";
		list($item,$hn) = Mysql_fetch_row(Mysql_Query($sql));
		
		switch($part){
				case "DDL": $update = ",essd=essd+".($salepri*$_POST["amount"]);break;
				case "DDY": $update = ",nessdy=nessdy+".($salepri*$_POST["amount"]); break;
				case "DDN": $update = ",nessdn=nessdn+".($salepri*$_POST["amount"]); break;
				case "DPY": $update = ",dpy=dpy+".($salepri*$_POST["amount"]); break;
				case "DPN": $update = ",dpn=dpn+".($salepri*$_POST["amount"]); break;
				case "DSY": $update = ",dsy=dsy+".($salepri*$_POST["amount"]); break;
				case "DSN": $update = ",dsn=dsn+".($salepri*$_POST["amount"]); break;

		}
		

	

		$sql = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri ,office) VALUES ('".$_GET["sDate"]."','".$hn."','".$_POST["drugcode"]."','".$tradname."', '".$_POST["amount"]."','".( $_POST["amount"] * $salepri)."','".$item."','".$_POST["slcode"]."','".$part."','".$_GET["nRow_id"]."','".$salepri."','".$freepri."','".$_SESSION["sOfficer"]."');";
		$result1 = Mysql_Query($sql) or die("�Դ�����Դ��Ҵ��к� ��س� �����˹�Ҩ͹������������������٤�Ѻ<BR> ".Mysql_error());
		
		$sql = "update ddrugrx set item = item+1 where idno='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."'  ;";
		if($result1==true)
			$result2 = Mysql_Query($sql) or die("�Դ�����Դ��Ҵ��к� ��س� �����˹�Ҩ͹������������������٤�Ѻ<BR> ".Mysql_error());

		$sql = "update dphardep set item = item+1,price=price+".($salepri*$_POST["amount"])." ".$update."  where row_id='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1; ";
		if($result2==true)
			$result3 = Mysql_Query($sql) or die("�Դ�����Դ��Ҵ��к� ��س� �����˹�Ҩ͹������������������٤�Ѻ<BR> ".Mysql_error());

		
		if($result1==true && $result2==true && $result3 == true){
			echo "�ѹ�֡���������º��������<BR><A HREF=\"drxadddruger.php?sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">������</A><BR>�ҡ����������������Դ˹�ҹ����¤�Ѻ
			<SCRIPT LANGUAGE=\"JavaScript\">
				
				opener.location.reload();
				setTimeout(\"window.location.href='drxadddruger.php?sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."';\",5000);

			</SCRIPT>
			";
		}
		exit();

	}




}

?>

<FORM METHOD=POST ACTION="">
<TABLE>
<TR>
	<TD>���˹�ҷ��</TD>
	<TD><?php echo $_SESSION["sOfficer"];?></TD>
</TR>
<TR>
	<TD>������</TD>
	<TD><INPUT TYPE="text" NAME="drugcode"></TD>
</TR>
<TR>
	<TD>�ӹǹ</TD>
	<TD><INPUT TYPE="text" NAME="amount" ></TD>
</TR>
<TR>
	<TD>�Ը��� HD ��ҹ��</TD>
	<TD><INPUT TYPE="hidden" NAME="slcode" value="HD"></TD>
</TR>
<TR>
	<TD><INPUT TYPE="submit" name="submit" value="��ŧ"></TD>
</TR>
</TABLE>
</FORM>

<?php
If(isset($_POST["submit"])){

echo "
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
 <th bgcolor=6495ED><font face='Angsana New'>��ͧ����</th>
 <th bgcolor=6495ED><font face='Angsana New'>��ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>
 </tr>";




    $query = "SELECT drugcode,tradname,genname,salepri ,stock,mainstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

$i=1;
    while (list ($drugcode, $tradname,$genname,$salepri,$stock,$mainstk) = mysql_fetch_row ($result)) {
        print (" <FORM name= \"form".$i."\" METHOD=POST ACTION=\"drxadddrughd.php?action=add&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\"><tr>\n".
           "  <td BGCOLOR=66CDAA><a  href=\"#\" onclick=\"form".$i.".submit();\"><font face='Angsana New'>$drugcode</a></td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>
		   <INPUT TYPE=\"hidden\" NAME=\"drugcode\" value=\"".$drugcode."\">
		   <INPUT TYPE=\"hidden\" NAME=\"amount\" value=\"".$_POST["amount"]."\">
			<INPUT TYPE=\"hidden\" NAME=\"slcode\" value=\"".$_POST["slcode"]."\">
           </FORM>\n");
		   $i++;
          }

   echo"</table>";
}

?>



<?php

include("unconnect.inc");
?>