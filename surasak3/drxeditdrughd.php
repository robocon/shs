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
		echo "ไม่มีรหัสยา ".$_POST["drugcode"];
	}if($crow_id ==0){
		echo "ไม่มีรหัสวิธีใช้ ".$_POST["slcode"];
	}else{
		

		$sql = "Select part, salepri, freepri, tradname From druglst where drugcode = '".$_POST["drugcode"]."' limit 1";
		list($part, $salepri, $freepri, $tradname) = Mysql_fetch_row(Mysql_Query($sql));
		
		$sql = "Select item, hn From ddrugrx where idno='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1 ";
		list($item,$hn) = Mysql_fetch_row(Mysql_Query($sql));
		
		$update= "";

		switch($part){
				case "DDL": $update .= ",essd=essd+".($salepri*$_POST["amount"]);break;
				case "DDY": $update .= ",nessdy=nessdy+".($salepri*$_POST["amount"]); break;
				case "DDN": $update .= ",nessdn=nessdn+".($salepri*$_POST["amount"]); break;
				case "DPY": $update .= ",dpy=dpy+".($salepri*$_POST["amount"]); break;
				case "DPN": $update .= ",dpn=dpn+".($salepri*$_POST["amount"]); break;
				case "DSY": $update .= ",dsy=dsy+".($salepri*$_POST["amount"]); break;
				case "DSN": $update .= ",dsn=dsn+".($salepri*$_POST["amount"]); break;

		}

		switch($_POST["drug_part"]){
				case "DDL": $update .= ",essd=essd-".($_POST["drug_salepri"]*$_POST["drug_amount"]);break;
				case "DDY": $update .= ",nessdy=nessdy-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;
				case "DDN": $update .= ",nessdn=nessdn-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;
				case "DPY": $update .= ",dpy=dpy-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;
				case "DPN": $update .= ",dpn=dpn-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;
				case "DSY": $update .= ",dsy=dsy-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;
				case "DSN": $update .= ",dsn=dsn-".($_POST["drug_salepri"]*$_POST["drug_amount"]); break;

		}
		
		
		$sql = "Delete From ddrugrx where row_id = '".$_POST["drug_row_id"]."' limit 1";
		$result = Mysql_Query($sql);

		$sql = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri,office ) VALUES ('".$_GET["sDate"]."','".$hn."','".$_POST["drugcode"]."','".$tradname."', '".$_POST["amount"]."','".( $_POST["amount"] * $salepri)."','".$item."','".$_POST["slcode"]."','".$part."','".$_GET["nRow_id"]."','".$salepri."','".$freepri."','".$_SESSION["sOfficer"]."');";
		$result1 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรุณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());
		
		
		$sql = "update dphardep set price=price+".(($salepri*$_POST["amount"])-($_POST["drug_salepri"]*$_POST["drug_amount"]))." ".$update."  where row_id='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1; ";

		if($result1==true)
			$result3 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());

		
		if($result1==true && $result3 == true){
			echo "แก้ไขข้อมูลเรียบร้อยแล้ว กรุณาปิดหน้านี้ด้วยครับ
			<SCRIPT LANGUAGE=\"JavaScript\">
				
				opener.location.reload();
				setTimeout(\"window.close()';\",1000);

			</SCRIPT>
			";
		}
		exit();

	}




}

$sql="Select drugcode, slcode, amount, salepri, part From ddrugrx where row_id = '".$_GET["grow_id"]."' AND date = '".$_GET["sDate"]."'  limit 1";
$result = Mysql_Query($sql);
list($drugcode, $slcode, $amount, $salepri, $part) = Mysql_fetch_row(Mysql_Query($sql));

if(isset($_POST["drugcode"])){
	$drugcode = $_POST["drugcode"];
}

if(isset($_POST["amount"])){
	$amount = $_POST["amount"];
}

if(isset($_POST["slcode"])){
	$slcode = $_POST["slcode"];
}

?>

<FORM METHOD=POST ACTION="">
<TABLE>
<TR>
	<TD>ต้องการเปลี่ยนสถานะเป็นของคืน ไตเทียม </TD>
	<TD></TD>
</TR>
<TR>
	<TD>รหัสยา<?php echo $drugcode;?></TD>
	<TD><INPUT TYPE="hidden" NAME="drugcode" value="<?php echo $drugcode;?>"></TD>
</TR>
<TR>
	<TD>จำนวน<?php echo $amount;?></TD>
	<TD><INPUT TYPE="hidden" NAME="amount" value="<?php echo $amount;?>"></TD>
</TR>
<TR>
	<TD>วิธีใช้ เป็น ไตเทียม เท่านั้น</TD>
	<TD><INPUT TYPE="text" NAME="slcode" value="HD" ></TD>
</TR>
<TR>
	<TD><INPUT TYPE="submit" name="submit" value="ตกลง"></TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" name="drug_salepri" value="<?php echo $salepri;?>">
<INPUT TYPE="hidden" name="drug_amount" value="<?php echo $amount;?>">
<INPUT TYPE="hidden" name="drug_part" value="<?php echo $part;?>">
<INPUT TYPE="hidden" name="drug_row_id" value="<?php echo $_GET["grow_id"];?>">
</FORM>

<?php
If(isset($_POST["submit"])){

echo "
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
 <th bgcolor=6495ED><font face='Angsana New'>ห้องจ่าย</th>
 <th bgcolor=6495ED><font face='Angsana New'>คลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา</th>
 </tr>";




    $query = "SELECT drugcode,tradname,genname,salepri ,stock,mainstk FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

$i=1;
    while (list ($drugcode, $tradname,$genname,$salepri,$stock,$mainstk) = mysql_fetch_row ($result)) {
        print (" <FORM name= \"form".$i."\" METHOD=POST ACTION=\"drxeditdrughd.php?action=add&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\"><tr>\n".
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
			<INPUT TYPE=\"hidden\" name=\"drug_salepri\" value=\"".$_POST["drug_salepri"]."\">
			<INPUT TYPE=\"hidden\" name=\"drug_amount\" value=\"".$_POST["drug_amount"]."\">
			<INPUT TYPE=\"hidden\" name=\"drug_part\" value=\"".$_POST["drug_part"]."\">
			<INPUT TYPE=\"hidden\" name=\"drug_row_id\" value=\"".$_POST["drug_row_id"]."\">
           </FORM>\n");
		   $i++;
          }

   echo"</table>";
}

?>

<?php

include("unconnect.inc");
?>