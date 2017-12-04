<?php
session_start();
include("connect.inc");

if(isset($_POST["submit"])){
	
	//$sql = "Select count(row_id) as crow_id From druglst where drugcode = '".$_POST["drugcode"]."' ";
	//list($count_drug) = Mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select count(row_id) as crow_id From drugslip where slcode = '".$_POST["slcode"]."' ";
	$result = Mysql_Query($sql);
	list($crow_id) = Mysql_fetch_row($result);

	/*if($count_drug==0){
		echo "ไม่มีรหัสยา ".$_POST["drugcode"];
	}else*/
		
	if($crow_id ==0){
		echo "ไม่มีรหัสวิธีใช้ ".$_POST["slcode"];
	}else{
		
		if(isset($_POST['amountsl'])){
		$sql = "Update ddrugrx set drug_inject_amount='".$_POST["amountsl"]."',drug_inject_unit='".$_POST["unitsl"]."',drug_inject_amount2='".$_POST["amountsl2"]."',drug_inject_unit2='".$_POST["unitsl2"]."',drug_inject_time='".$_POST["timesl"]."',drug_inject_etc='".$_POST["etcsl"]."'  where row_id = '".$_POST["drug_row_id"]."' limit 1";
		$result = mysql_query($sql);
		}else{
		$sql = "Update ddrugrx set slcode='".$_POST["slcode"]."'  where row_id = '".$_POST["drug_row_id"]."' limit 1";
		$result = mysql_query($sql);
		}


/*		$sql = "Select part, salepri, freepri, tradname From druglst where drugcode = '".$_POST["drugcode"]."' limit 1";
		list($part, $salepri, $freepri, $tradname) = Mysql_fetch_row(Mysql_Query($sql));
		
		$sql = "Select item, hn From ddrugrx where idno='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1 ";
		list($item,$hn) = Mysql_fetch_row(Mysql_Query($sql));
		
		$update= "";

		$sql = "Delete From ddrugrx where row_id = '".$_POST["drug_row_id"]."' limit 1";
		$result = Mysql_Query($sql);

		$sql = "INSERT INTO ddrugrx(date,hn,drugcode,tradname,amount,price,item,slcode,part,idno, salepri, freepri,office ) VALUES ('".$_GET["sDate"]."','".$hn."','".$_POST["drugcode"]."','".$tradname."', '".$_POST["amount"]."','".( $_POST["amount"] * $salepri)."','".$item."','".$_POST["slcode"]."','".$part."','".$_GET["nRow_id"]."','".$salepri."','".$freepri."','".$_SESSION["sOfficer"]."');";
		$result1 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรุณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());
		
		$sql = "Select sum(price) From ddrugrx where hn='".$hn."' AND idno = '".$_GET["nRow_id"]."' ";
		list($sum_pri) = Mysql_fetch_row(Mysql_Query($sql));
		
		$sql = "Select part , sum(price) From ddrugrx where hn='".$hn."' AND idno = '".$_GET["nRow_id"]."' Group by part ";
		$result = Mysql_Query($sql);
		while(list($part1,$sum1) = Mysql_fetch_row($result)){

			switch($part1){
				case "DDL": $update .= ",essd=".($sum1);break;
				case "DDY": $update .= ",nessdy=".($sum1); break;
				case "DDN": $update .= ",nessdn=".($sum1); break;
				case "DPY": $update .= ",dpy=".($sum1); break;
				case "DPN": $update .= ",dpn=".($sum1); break;
				case "DSY": $update .= ",dsy=".($sum1); break;
				case "DSN": $update .= ",dsn=".($sum1); break;
*/
		//}

		//}
		
		//$sql1 = "update dphardep set essd=0, nessdy=0,nessdn=0, dpy=0, dpn=0,dsy=0,dsn=0 where row_id='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' limit 1; ";

		//$sql = "update dphardep set price=".$sum_pri." ".$update."  where row_id='".$_GET["nRow_id"]."' AND date = '".$_GET["sDate"]."' //limit 1; ";


		//if($result1==true){
			//$result3 = Mysql_Query($sql1) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());
			//$result3 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());
		//}
		
		//if($result1==true && $result3 == true){
			if($result==true){
			echo "แก้ไขข้อมูลวิธีใช้เรียบร้อยแล้ว กรุณาปิดหน้านี้ด้วยครับ
			<SCRIPT LANGUAGE=\"JavaScript\">
				
				opener.location.reload();
				setTimeout(\"window.close()';\",1000);

			</SCRIPT>
			";
		}
		exit();

	}




}

$sql="Select drugcode, slcode, amount, salepri, part,drug_inject_amount,drug_inject_unit,drug_inject_amount2,drug_inject_unit2,drug_inject_time,drug_inject_etc,drug_inject_slip From ddrugrx where row_id = '".$_GET["grow_id"]."' AND date = '".$_GET["sDate"]."'  limit 1";

$result = Mysql_Query($sql);
list($drugcode, $slcode, $amount, $salepri, $part,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_etc,$drug_inject_slip) = Mysql_fetch_row(Mysql_Query($sql));

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
<!-- <TR>
	<TD>รหัสยา</TD>
	<TD><INPUT TYPE="text" NAME="drugcode" value="<?php echo $drugcode;?>"></TD>
</TR>
<TR>
	<TD>จำนวน</TD>
	<TD><INPUT TYPE="text" NAME="amount" value="<?php echo $amount;?>"></TD>
</TR> -->
<? 
$codeslip = substr($drugcode,0,1);
$codeslip2 = substr($drugcode,0,2);
if($codeslip2=="20"||$codeslip!="2"){
?>
<TR>
	<TD>วิธีใช้</TD>
	<TD><INPUT TYPE="text" NAME="slcode" value="<?php echo $slcode;?>"></TD>
</TR>
<?
}elseif($codeslip=="2"){
?>
<TR>
	<TD>ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="amountsl" value="<?php echo $drug_inject_amount;?>"></TD>
</TR>
<TR>
	<TD>หน่วย : </TD>
	<TD><INPUT TYPE="text" NAME="unitsl" value="<?php echo $drug_inject_unit;?>"></TD>
</TR>
<? 
if($drug_inject_slip=="2ins"){
?>
<TR>
	<TD>ฉีด : </TD>
	<TD><INPUT TYPE="text" NAME="amountsl2" value="<?php echo $drug_inject_amount2;?>"></TD>
</TR>
<TR>
	<TD>หน่วย : </TD>
	<TD><INPUT TYPE="text" NAME="unitsl2" value="<?php echo $drug_inject_unit2;?>"></TD>
</TR>
<?
}
?>
<TR>
	<TD>เวลา : </TD>
	<TD><INPUT TYPE="text" NAME="timesl" value="<?php echo $drug_inject_time;?>"></TD>
</TR>
<TR>
	<TD>คำสั่งพิเศษ : </TD>
	<TD><INPUT TYPE="text" NAME="etcsl" value="<?php echo $drug_inject_etc;?>"></TD>
</TR>
<?
}
?>
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
/*
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
        print (" <FORM name= \"form".$i."\" METHOD=POST ACTION=\"drxeditdrug.php?action=add&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\"><tr>\n".
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
*/
?>

<?php

include("unconnect.inc");
?>