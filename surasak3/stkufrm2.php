<?php
session_start();
include("connect.inc");

    session_unregister("acstkcut");
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aExpdate");
    session_unregister("aLotno");
    session_unregister("aAmount");
    session_unregister("aUnitpri");
    session_unregister("aUnit");
    session_unregister("aDglotno");
    session_unregister("aStkcut");
    session_unregister("aNetlot");
    session_unregister("cTotal");
    session_unregister("cRestkcut");
    session_unregister("cCompany");
    session_unregister("aTotalstk");
    session_unregister("aMainstk");
    session_unregister("aStock");
    session_unregister("aPart");

    session_unregister("cBillno");
    session_unregister("cDepcode"); 
//    $cBilldate=$billdate;


    session_register("acstkcut");
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aExpdate");
    session_register("aLotno");
    session_register("aAmount");
    session_register("aUnitpri");
    session_register("aUnit");
    session_register("aDglotno");
    session_register("aStkcut");
    session_register("aNetlot");
    session_register("cTotal");
    session_register("cRestkcut");
    session_register("cCompany");
    session_register("aTotalstk");
    session_register("aMainstk");
    session_register("aStock");
    session_register("aPart");
    session_register("cBillno");
    session_register("cDepcode"); 

$sql = "Select bring_no, row_id From bring where row_id = '".$_GET["id"]."' limit 1";
	$result = Mysql_Query($sql);
	list($bring_no,$bring_id) = Mysql_fetch_row($result);

    $cBillno=$bring_no;
    $cDepcode="ห้องจ่ายยา";
    $acstkcut=0; //accumulate Stkcut ในแต่ละdrugcode
    $x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aExpdate = array("  วันหมดอายุ");
    $aLotno = array(" Lot.No");
    $aAmount = array("  amount");
    $aUnitpri  = array("ราคาทุน");
    $aUnit = array(" หน่วย");
    $aDglotno = array(" dgexplot");
    $aStkcut = array("  เบิก");
    $aNetlot = array("เหลือในLot");
    $cTotal=0;
    $cRestkcut="";
    $cCompany="";
    $aTotalstk = array("  totalstk");
    $aMainstk = array("  mainstk");
    $aStock = array("  stock");
    $aPart = array("part");

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<SCRIPT LANGUAGE="JavaScript">
	function check_number() {
	e_k=event.keyCode
	if (e_k != 13 && e_k != 45 && (e_k < 48) || (e_k > 57)) {
	event.returnValue = false;
	alert("กรุณากรอกเป็นตัวเลขเท่านั้น");
	}
	}

	function add_target(file,url,total){
		
		file = file+url+'&cTotal='+total;
		//window.location.frames["top"].href="index.php";
		window.top.frames[0].location.href=file;

	}

</SCRIPT>


</HEAD>

<BODY>
<?php
	
	

?>
<A HREF="..\nindex.htm" target="_top">&lt;&lt; เมนู</A> &nbsp;|&nbsp;<A HREF="stkrx.php"  target="_top">&lt;&lt;กลับ</A>

<FONT style="font-family:  MS Sans Serif; font-size: 14 px;">
เลขที่ใบเบิก : <?php echo $bring_no;?><BR><BR>
รายการยาที่เบิก


<?php
	$i=0;
	$sql = "Select bring_detail.drugcode, bring_detail.bring_amount, druglst.tradname  From bring_detail LEFT JOIN druglst ON bring_detail.drugcode = druglst.drugcode where bring_detail.bring_id = '".$_GET["id"]."' ";
	$result = Mysql_Query($sql);
	while(list($drugcode, $bring_amount, $tradname) = Mysql_fetch_row($result)){
		$i++;
		$drugcode = trim($drugcode);
		$query = "SELECT stock,mainstk,totalstk, part FROM druglst WHERE drugcode = '".$drugcode."' limit 1";
		list($stock, $mainstk, $totalstk, $part) = mysql_fetch_row(mysql_query($query));

		

		 $query = "SELECT drugcode,tradname,expdate,lotno,unitpri,amount,unit,dgexplot FROM combill  WHERE dgexplot LIKE '".$drugcode."%' and amount >0 ORDER BY dgexplot ASC";

		 $result2 = mysql_query($query) or die("Query failed");
		 echo "<FORM METHOD=POST ACTION=\"\" Name=\"f$i\">";
		 echo "<BR>",$i,". เบิกยา [<B>".$drugcode."</B>] <B>",$tradname."</B> ต้องการเบิกจำนวน <B><INPUT TYPE=\"text\" NAME=\"total$i\" Size=\"3\" value=\"".$bring_amount."\"></B> หน่วย มีทั้งหมด <B>$totalstk</B>, ในคลัง <B>$mainstk</B>, ในห้องจ่าย <B>$stock</B>";
		  echo "<table width='700'>
		 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>
  <th bgcolor=6495ED><font face='Angsana New'>Exp.Date</th>
  <th bgcolor=6495ED><font face='Angsana New'>Lot.No</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>
  <th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>เบิก</th>
 </tr>
			 ";
		  $j=1;
		  while (list ($drugcode, $tradname,$expdate,$lotno,$unitpri,$amount,$unit,$dgexplot) = mysql_fetch_row ($result2)) {
			
			if($bring_amount <= 0 ){

				$bring_amount2 = 0;

			}elseif($amount <= $bring_amount){

				$bring_amount2 = $amount;
				$bring_amount = $bring_amount-$amount;

			}else {

				$bring_amount2 = $bring_amount;
				$bring_amount = 0;
			}

			

			print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$expdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><a  href=\"javascript:void(0);\" Onclick=\"add_target('stkinfo2.php','? cExpdate=$expdate&cLotno=$lotno&cDglotno=$dgexplot&cDgcode=$drugcode&cUnitpri=$unitpri&cAmount=$amount& cTrade=$tradname&cUnit=$unit&vTotalstk=$totalstk&vMainstk=$mainstk&vStock=$stock&vPart=$part',document.f$i.total$i.value);\"><font face='Angsana New'>เบิก</a></td>\n".
           " </tr>\n");
		  
		   $j++;
		  }
		  echo "<table>
		  </FORM>";

   
	}
?>
</FONT>

</BODY>
</HTML>

<?php
include("unconnect.inc");  
?>
