<?php
 session_start();
include("connect.inc");
 if(isset($_GET["action"]) && $_GET["action"] == "drug_interaction"){
	
	header("content-type: application/x-javascript; charset=TIS-620");
	$j=0;
	$list = "'";
	 for ($n=1; $n<=$x; $n++){
		if($aDgcode[$n] != ""){
			$list .= $aDgcode[$n]."','";
			$j++;
		}
	 }
	
	$list = substr($list,0,-2);
	
	if($j == 0){

		echo "0";
		exit();
	}

	$sql = "SELECT first_drugcode, between_drugcode, effect, action, follow, onset, violence, referable  FROM drug_interaction  where (first_drugcode = '".$_GET["drugcode"]."' AND between_drugcode in (".$list.") ) OR (between_drugcode = '".$_GET["drugcode"]."' AND first_drugcode in (".$list.") ) ";

	
	$result = Mysql_Query($sql);
	$rows = Mysql_num_rows($result);
		if($rows == 0){
			echo "0";
		}else{
			$arr = Mysql_fetch_assoc($result);
			$i=0;
			$sql = " Select genname From  druglst where drugcode in ('".$arr["first_drugcode"]."','".$arr["between_drugcode"]."') ";
			$result = Mysql_Query($sql);
			while($arr2 = Mysql_fetch_assoc($result)){
				$druglist[$i] = $arr2["genname"];
				$i++;
			}

			echo " �Դ Drug Interaction �����ҧ�� ".$druglist[0]." �Ѻ�� ".$druglist[1]." \n �š�з� : ".$arr["effect"]." \n ��䡷���Դ : ".$arr["action"]." \n ��õԴ��� : ".$arr["follow"]." \n onset : ".$arr["onset"]." \n �����ع�ç : ".$arr["violence"]." \n ��ѡ�ҹ : ".$arr["referable"]." \n ��ҹ�ѧ��ͧ��è������������? ";
		}
	
	exit();
}

 echo "HN : $cPtname,  �Է��� : $cPtright VN:$tvn<br> ";
?>
<SCRIPT LANGUAGE="JavaScript">
function check_number() {
e_k=event.keyCode
if (e_k != 13 && e_k != 46 && e_k != 47 && e_k != 45  && (e_k < 48) || (e_k > 57)) {
	event.returnValue = false;
alert("��سҡ�͡�繵���Ţ��ҹ�鹤��");
}
}

function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function drug_interaction(drugcode,amount,trand,price,slcode){
	
	var return_drug_interaction;

	xmlhttp = newXmlHttp();
	url = 'dgseek.php?action=drug_interaction&drugcode='+ drugcode+'&amount='+amount+'&trand='+trand+'&price='+price+'&slcode=' +slcode;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	return_drug_interaction = xmlhttp.responseText;
	return_drug_interaction = return_drug_interaction.substr(4);
		
	if(return_drug_interaction == "0"){
		top.frames['right'].location.href = 'info.php? Dgcode='+ drugcode+'& Amount='+amount+'& Trade='+trand+' & Price='+price+'& Slcode='+slcode;
	}else if(return_drug_interaction != "0"){
		if(confirm(return_drug_interaction))
			top.frames['right'].location.href = 'info.php? Dgcode='+ drugcode+'& Amount='+amount+'& Trade='+trand+' & Price='+price+'& Slcode='+slcode;
	}

}

</script>
  <form method="post" action="<?php echo $PHP_SELF ?>">

<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
<TABLE>
<TR>
	<TD align="right"><font face="Angsana New"><a target=_BLANK href="dgcode.php">������</a> : </TD>
	<TD><input type="text" name="drugcode" size="8" id="aLink"></TD>
	<TD>&nbsp;</TD>
</TR>
<TR>
	<TD align="right"><font face="Angsana New">�ӹǹ : </font></TD>
	<TD><input type="text" name="amount" size="4" onkeypress="return check_number();"></TD>
	<TD>&nbsp;</TD>
</TR>
<TR>
	<TD align="right"><font face="Angsana New"><a target=_BLANK href="slcode.php">�Ը���</a> : </TD>
	<TD><input type="text" name="slipcode" size="8"></TD>
	<TD><input type="submit" value="   ��ŧ   " name="B1"></TD>
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
    
	
	$sql = "Select row_id From drugslip where slcode = '".$_POST["slipcode"]."' ";
	$result = Mysql_Query($sql);
	if(Mysql_num_rows($result) == 0){
		echo "����������Ը��� <FONT COLOR=\"#FF0000\">".$_POST["slipcode"]."</FONT>";

	}else{

    $query = "SELECT drugcode,tradname,genname,salepri ,stock,mainstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$salepri,$stock,$mainstk) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a   href=\"#\" Onclick=\"drug_interaction('$drugcode','$amount','$tradname','$salepri','$slipcode');\"><font face='Angsana New'>$drugcode</a></td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           " </tr>\n");
          }
	}
 
          }
		    include("unconnect.inc");
?>

</table>
