<?php
    session_start();
include("connect.inc");


    session_unregister("sRow_id");
	session_unregister("sChktranx");
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("cPtname");
	session_unregister("session_Date");

	session_register("sRow_id");
	session_register("sChktranx");
    session_register("x");	
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aAmount");
    session_register("aSlipcode");
	session_register("session_Date");
    session_register("cPtname");
	
	$_SESSION["sRow_id"]=$_GET["nRow_id"];
    $dDate=$_GET["sDate"];
	$_SESSION["aDgcode"] = array("รหัสยา");
    $_SESSION["aTrade"]  = array("      ชื่อการค้า");
    $_SESSION["aAmount"] = array("        จำนวน   ");
    $_SESSION["aSlipcode"] = array("        วิธีใช้   ");
	$_SESSION["cPtname"] = '';
	$_SESSION["x"] = 0;
  

    $query = "SELECT * FROM dphardep WHERE row_id = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."'"; 
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    $sHn=$row->hn;
    $sAn=$row->an;
    $_SESSION["cPtname"] = $row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;
	$_SESSION["session_Date"] = $row->date;
	  $sPtright=$row->ptright;
	  $stkcutdate_now = $row->stkcutdate;

?>

<table>
 <tr >
 <th bgcolor=CD853F><font face='Angsana New'>#</th>
 <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>วิธีใช้</th>
    
 </tr>

<?php
    //$query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office,detail1,detail2, detail3, detail4 FROM ddrugrx ,WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
	$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode,a.row_id, a.part,a.office, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_unit, a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_etc FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."'   AND a.date = '".$_GET["sDate"]."' ";

    $result = mysql_query($query) or die("Query failed");
$n='0';
    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "<font face='Angsana New'>วันที่ $d/$m/$y&nbsp;&nbsp;";
    print $_SESSION["cPtname"].", <font face='Angsana New'>HN: $sHn, <B>สิทธิ:$sPtright</B><br> ";
    print "<font face='Angsana New'>โรค: $sDiag <br>";
	print "<font face='Angsana New' size=5 color=FF0000>แพ้ยา: ";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$sHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
		echo $tradname."...".$advreact."(".$asses.") ";
	}
	print "</font>";
//    print "แพทย์ :$sDoctor<br><br>";
	
	$count_row = mysql_num_rows($result);
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$row_id,$part,$office,$detail1,$detail2,$detail3,$detail4,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_slip,$drug_inject_etc) = mysql_fetch_row ($result)) {
        $x++;
		$n++;
        $_SESSION["aDgcode"][$x]=$drugcode;
        $_SESSION["aTrade"][$x]=$tradname;
        $_SESSION["aSlipcode"][$x]=$slcode;        
        $_SESSION["aAmount"][$x]=$amount;
	
		if($_SESSION["aDgcode"][$x]=='1DILA' || $_SESSION["aDgcode"][$x]=='1GPO30*'  || $_SESSION["aDgcode"][$x]=='20SGPO30'  || $_SESSION["aDgcode"][$x]=='20SGPO30' || $_SESSION["aDgcode"][$x]=='1COTR4' || $_SESSION["aDgcode"][$x]=='1ALLO3'){

$color="#00CCFF";
}else{
$color="F5DEB3";
}

			$c1 = substr($drugcode,0,1);
			$c2 = substr($drugcode,0,2);

        print (" <tr BGCOLOR=$color>\n".
		   "  <td><font face='Angsana New'>$n</td>\n".
		   "  <td><font face='Angsana New'>$drugcode</td>\n".
           "  <td><font face='Angsana New'>$tradname</td>\n".
           "  <td><font face='Angsana New'><span id=\"amount_value".$x."\">$amount</span>
		   <input type=\"text\" style=\"display:none\" name=\"amount".$x."\" value=\"".$amount."\" id=\"amount".$x."\" size=\"5\"></td>\n".
           "  <td><font face='Angsana New'>$price</td>");
		if($c2!='20'&&($c1=='2'||$c1=='0')){
echo "  <td><font face='Angsana New'>$drug_inject_amount $drug_inject_unit $drug_inject_amount2 $drug_inject_unit2 $drug_inject_time $drug_inject_etc</td>";	
		}else{
echo "  <td><font face='Angsana New'>$slcode $detail1 $detail2 $detail3 $detail4</td>";
		}	
           " </tr>";
      }
    
?>
</table>
<?php
	
    print "<font face='Angsana New'>รวมงิน  ".$sNetprice." บาท&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<font face='Angsana New'>แพทย์ :".$sDoctor."<br>";

 	print "<font face='Angsana New'><a href=\"tranfer_notsk.php? sDate=$sDate&nRow_id=$nRow_id&nAccno=$nAccno&sPtright=$sPtright&hn=$sHn\">ตัดยอดค้างจ่าย</a>";
	print "&nbsp;&nbsp;&nbsp;&nbsp;<font face='Angsana New'><a href=\"drxlist_not.php?hn_drx=$sHn\"><<กลับ</a>";
include("unconnect.inc");
?>
