<?php
    session_start();
	include("connect.inc");
	
//-------------------------เช็ค druginteraction	
	$csql = "SELECT a.drugcode FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."'   AND a.date = '".$_GET["sDate"]."' ";
	//echo $csql;
	$cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
	while($crows=mysql_fetch_array($cquery)){
		$cdrugcode=$crows["drugcode"];
		$fsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
		//echo $fsql;
		$fquery=mysql_query($fsql);
		$fnum=mysql_num_rows($fquery);
		if($fnum > 0){
			//echo "<script>alert('ยา $cdrugcode เกิด INTERACTION กับยาดังต่อไปนี้ ";
				while($frows=mysql_fetch_array($fquery)){
					$bdrugcode=$frows["between_drugcode"];
					echo "$bdrugcode,";
				}
			echo "');</script>";
		}else if($fnum < 1){
			$bsql="select first_drugcode, between_drugcode from drug_interaction where first_drugcode='$cdrugcode'";
			//echo $bsql;
			$bquery=mysql_query($bsql);
			$bnum=mysql_num_rows($bquery);		
			if($bnum > 0){
				//echo "<script>alert('ยา $cdrugcode เกิด INTERACTION กับยาดังต่อไปนี้ ";
					while($frows=mysql_fetch_array($fquery)){
						$fdrugcode=$frows["first_drugcode"];
						echo "$fdrugcode,";
					}
				echo "');</script>";	
			}else{
				//echo "<script>alert('ยา $cdrugcode ไม่เกิด DRUGINTERACTION กับยาอื่นๆ";
					while($frows=mysql_fetch_array($fquery)){
						echo "";
					}
				echo "</script>";				
			}	//close if $bnum
		} //close if $fnum
	}  //close while $crows
//----------------------------จบเช็ค druginteraction

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
  
  $query = "SELECT title,prefix,runno FROM runno WHERE title = 'phardep'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $_SESSION["sChktranx"]=$row->runno;
    $_SESSION["sChktranx"]++;

    $query ="UPDATE runno SET runno = ".$_SESSION["sChktranx"]." WHERE title='phardep'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx

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


//----------------------------เช็คแพ้ยา
$rsql= "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$sHn."' ";
$rquery = mysql_query($rsql);
$rnum=mysql_num_rows($rquery);		
if($rnum > 0){
	echo "<script>alert('ผู้ป่วย HN : $sHn มีประวัติแพ้ยาดังต่อไปนี้ ";
	while($rrows= mysql_fetch_array($rquery)){
			$tradname=$rrows["tradname"];
			$advreact=$rrows["advreact"];
			$asses=$rrows["asses"];
			echo "$tradname...$advreact($asses), ";			
	}
	echo "');</script>";	
}else{
	//echo "<script>alert('ผู้ป่วย HN : $sHn ไม่มีประวัติแพ้ยา');</script>";
}
//----------------------------จบเช็คแพ้ยา
?>
<script>
function chkin(){
	if(document.getElementById('cut2').style.display=='none'){
		document.getElementById('cut2').style.display='block';
		document.getElementById('cut1').style.display='none';
	}
	else if(document.getElementById('cut2').style.display=='block'){
		document.getElementById('cut2').style.display='none';
		document.getElementById('cut1').style.display='block';
	}
}
</script>
<table>
 <tr >
 <th bgcolor=CD853F><font face='Angsana New'>#</th>
 <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>
  <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>
    <th bgcolor=CD853F><font face='Angsana New'>part</th>
  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>
  <th bgcolor=CD853F><font face='Angsana New'>วิธีใช้</th>
  <th bgcolor=CD853F><font face='Angsana New'>แก้ไขวิธีใช้</th>
<!--  <th bgcolor=CD853F><font face='Angsana New'>ลบ</th>-->
   <th bgcolor=CD853F><font face='Angsana New'>#</th>
  <th bgcolor=CD853F><font face='Angsana New'>ค้างจ่าย</th>
   <th bgcolor=CD853F><font face='Angsana New'>เจ้าหน้าที่</th>
   <th bgcolor=CD853F><font face='Angsana New'>แก้ไขจำนวน</th>
    
 </tr>

<?php
$inject = false;
    //$query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office,detail1,detail2, detail3, detail4 FROM ddrugrx ,WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
	
	$query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode,a.row_id, a.part,a.office, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_unit, a.drug_inject_amount2,a.drug_inject_unit2,a.drug_inject_time,a.drug_inject_slip,a.drug_inject_etc,a.injno FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.idno = '".$_GET["nRow_id"]."'   AND a.date = '".$_GET["sDate"]."' ";
    $result = mysql_query($query) or die("Query failed");
$n='0';
    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
	$sqlopday = "select toborow,diag_thai from opday where hn='$sHn' and thidate like '$y-$m-$d%'";
	$res= mysql_query($sqlopday) or die("Query failed");
	list($toborow,$thai) = mysql_fetch_row($res);
	$tob = substr($toborow,0,4);
	
    print "<font face='Angsana New'>วันที่ $d/$m/$y&nbsp;&nbsp;";
    print $_SESSION["cPtname"].", <font face='Angsana New'>HN: $sHn, <B>สิทธิ:$sPtright</B><br> ";
    print "<font face='Angsana New'>โรค: $sDiag<br>";
	print "<font face='Angsana New' size=5 color=FF0000>แพ้ยา: ";
	$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$sHn."' ";
    $result12 = mysql_query($query12) or die("Query failed");
	while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
		echo $tradname."...".$advreact."(".$asses.") ";
	}
	print "</font>";
//    print "แพทย์ :$sDoctor<br><br>";
	
	$count_row = mysql_num_rows($result);
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$row_id,$part,$office,$detail1,$detail2,$detail3,$detail4,$drug_inject_amount,$drug_inject_unit,$drug_inject_amount2,$drug_inject_unit2,$drug_inject_time,$drug_inject_slip,$drug_inject_etc,$injno) = mysql_fetch_row ($result)) {
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

		if($count_row ==1)
		$onclick= "<A HREF='#' onclick=\"alert('กรุณา เหลือรายการยาไว้อย่างน้อย 1 รายการครับ');\">";
	else
		$onclick= "<A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>";

			$c1 = substr($drugcode,0,1);
			$c2 = substr($drugcode,0,2);
			if($injno!=""){ $injectno = "($injno)";}
			
        print (" <tr BGCOLOR=$color>\n".
		   "  <td><font face='Angsana New'>$n</td>\n".
		   "  <td><font face='Angsana New'>$drugcode</td>\n".
           "  <td><font face='Angsana New'>$tradname $injectno</td>\n".
			        "  <td><font face='Angsana New'>$part</td>\n".
           "  <td><font face='Angsana New'><span id=\"amount_value".$x."\">$amount</span>
		   <input type=\"text\" style=\"display:none\" name=\"amount".$x."\" value=\"".$amount."\" id=\"amount".$x."\" size=\"5\"></td>\n".
           "  <td><font face='Angsana New'>$price</td>");
		if($c2!='20'&&($c1=='2'||$c1=='0')){
			if($tob!="EX10"){$inject=true; }
			//$inject=true;
echo "  <td><font face='Angsana New'>$drug_inject_slip $drug_inject_amount $drug_inject_unit $drug_inject_amount2 $drug_inject_unit2 $drug_inject_time $drug_inject_etc</td>";	
		}else{
echo "  <td><font face='Angsana New'>$slcode $detail1 $detail2 $detail3 $detail4</td>";
		}
        echo "  <td><font face='Angsana New'><a target=_blank  href=\"drxeditdrug.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('ยืนยันการแก้ไขวิธีใช้')\">แก้ไขวิธีใช้</a></td>\n".
			//"<td><font face='Angsana New'>".$onclick."ลบ</A></td>\n".
  "  <td>#</td>\n".
  
			"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\" onclick=\"return confirm('ยืนยันการค้างจ่าย')\">ค้างจ่าย</a></td>\n".
			
			    //"  <td><font face='Angsana New'><a target=_blank  href=\"drxremain.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">ไม่ตัด</a></td>\n".
					
// "  <td><font face='Angsana New'><a target=_blank  href=\"drxremain1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">ตัด</a></td>\n".
			   "  <td><font face='Angsana New'>$office</td>\n".		
			   "  <td><font face='Angsana New'><a href=\"#\" onclick=\"window.open('upd_cdrug.php?nrow=$row_id',null,'height=300,width=320,scrollbars=0')\">แก้ไขจำนวน</a></td>\n".
		//			  "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxek1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">แก้ข้อมูล</a></td>\n".
		//	"<td BGCOLOR=F5DEB3>".$onclick."ลบ</A></td>\n".
		
           " </tr>";
      }
    
?>
</table>
<?php
    print "<font face='Angsana New'>รวมงิน  ".$sNetprice." บาท&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<font face='Angsana New'>แพทย์ :".$sDoctor."<br>";
	if($stkcutdate_now !=""){
		$inject=false;
	}
if($inject){
?>
<input name="chkinject" value="1" type="checkbox" checked="checked" onclick="chkin();" /> คิดราคาค่าฉีดยา 20 บาท<br />
<?php 
}
echo "<table><tr>";
		if($stkcutdate_now ==""){
	?>
    <a target="_blank" href="drxadddrug.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>"><font face='Angsana New'>เพิ่มยา</font></a>&nbsp;&nbsp;
   
	<A HREF="drxadddiag.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" ><font face='Angsana New'>แก้ไขชื่อโรค</font></A><BR> 
    <td>
    <div id='cut1' style="display:block"><a target="_blank" href="drxstkcut.php?inject" <? if($inject==true){ ?> onclick="return confirm('ยืนยันการคิดค่าฉีดยา'); "<? }?>>ตัดสต๊อกยา</a></div><div id='cut2' style="display:none"><a target="_blank" href="drxstkcut.php">ตัดสต๊อกยา</a></div>
    </td>
	<?php }else{ ?>
	<td><FONT COLOR="#FF0000"><B>เคยตัดสต๊อกแล้ว</B></FONT>&nbsp;&nbsp;&nbsp;</td>
	<?php }?>
    </td>
    <td><a target="_blank" href="drxprint.php"><font face='Angsana New'>พิมพ์ใบสั่งยา</a></td>
    <td><a target="_blank" href="slipprntest1.php"><font face='Angsana New'>พิมพ์สลากยารุ่นใหม่</a></td>
	<td><a target="_blank" href="drxprintopd.php"><font face='Angsana New'>พิมพ์ใบรายการยากลับบ้าน</a></td>
	<td><a target="_blank" href="drxprintopd1.php"><font face='Angsana New'>พิมพ์สติกเกอร์ติด	OPD</a></td>
    <td><a target="_blank" href="appoilst_inj.php?Thn=<?=$sHn?>"><font face='Angsana New'>ออกใบนัดฉีดยา</a></td>
	<td><a target=_blank  href="sticker_drx.php?hn=<?=$sHn?>&sDate=<?=$_GET["sDate"]?>">สติ๊กเกอร์ค้างจ่ายติดOPD</a></td>
 </tr></table>
<?php
	$strsql="select * from accrued where hn = '$sHn' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);
	
	if($strrow>0){
		echo "<script>alert('ผู้ป่วยมียอดค้างชำระ  กรุณาติดต่อส่วนเก็บเงินรายได้') </script>";
		//echo "&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hnid'>ดูยอดค้างชำระ</a></b></font>";

	}


$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$sHn."' AND  date LIKE '$today1%'  and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
		echo "<br><br><font face='Angsana New' size='5' color='#FF0066'><center>***ผู้ป่วยมีใบรายยามากกว่า 1 ใบ*** </center></FONT>";
	}

include("unconnect.inc");
?>
