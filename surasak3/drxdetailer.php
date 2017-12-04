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
  
  function echo_ka($time){
		

		if($time >= "07:31:00" && $time < "15:31:00"){
			$ka = "เช้า";
		}else if($time >= "15:31:00" && $time < "23:31:00"){
			$ka = "บ่าย";
		}else if($time >= "23:3:001" && $time <= "23:59:00"){
			$ka = "ดึก";
		}else if($time >= "00:00:00" && $time < "07:31:00"){
			$ka = "ดึก";
		}
		
		return $ka;

	}

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
?>

<TABLE style="font-family:  Angsana New; font-size: 24 px;" width="100%">
<TR>
	<TD valign="top">
<table  style="font-family:  Angsana New; font-size: 24 px;">
 <tr >
 <th bgcolor=CD853F>รหัส</th>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=CD853F>วิธีใช้</th>
   <th bgcolor=CD853F>##</th>
     <th bgcolor=CD853F>แก้วิธีใช้</th>
 </tr>

<?php
    $query = "SELECT tradname,amount,price,slcode,drugcode,row_id,office FROM ddrugrx WHERE idno = '".$_GET["nRow_id"]."'  AND date = '".$_GET["sDate"]."' ";
    $result = mysql_query($query) or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "วันที่ $d/$m/$y<br>";
    print $_SESSION["cPtname"].", HN: $sHn, สิทธิ:$sPtright<br> ";
    print "โรค: $sDiag<br>";
//    print "แพทย์ :$sDoctor<br><br>";
	
	$count_row = mysql_num_rows($result);
	
    while (list ($tradname,$amount,$price,$slcode,$drugcode,$row_id,$office) = mysql_fetch_row ($result)) {
        $x++;
        $_SESSION["aDgcode"][$x]=$drugcode;
        $_SESSION["aTrade"][$x]=$tradname;
        $_SESSION["aSlipcode"][$x]=$slcode;        
        $_SESSION["aAmount"][$x]=$amount;


		

if ($slcode==('ER') ){
	$slcode="ของคืนER";
	$onclick= "<A HREF='drxdeldrug.php?action=del&grow_id2=".$_GET["nRow_id"]."&grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."' target='_blank'>ลบ</A>";
}else
	{$slcode=$slcode;
		$onclick = "ลบไม่ได้";
}

        print (" <tr>\n".
			    "  <td BGCOLOR=F5DEB3>$drugcode</td>\n".
           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
			 
  "  <td BGCOLOR=F5DEB3>".$onclick."</td>\n".
 "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxeditdruger.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">คืนของER</a></td>\n".
		
    "  <td BGCOLOR=F5DEB3>$office</td>\n".
			///////////////////////////////////**/////////////////////

				 // "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"drxek1.php?grow_id=".$row_id."&sDate=".urlencode($_GET["sDate"])."&nRow_id=".urlencode($_GET["nRow_id"])."\">แก้ข้อมูล</a></td>\n".
		//	"<td BGCOLOR=F5DEB3>".$onclick."ลบ</A></td>\n".
           " </tr>\n");
      }
    
?>
</table>
<?php
    print "รวมงิน  ".$sNetprice." บาท<br>";
    print "แพทย์ :".$sDoctor."<br><br>";
	print "เจ้าหน้าที่:".$sOfficer."<br><br>";
?>
	<a target="_blank" href="drxadddruger.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>">เพิ่มยา</a>&nbsp;&nbsp;<A HREF="drxadddiag.php?sDate=<?php echo urlencode($_GET["sDate"]);?>&nRow_id=<?php echo urlencode($_GET["nRow_id"]);?>" target="_blank" >แก้ไขชื่อโรค</A><BR>


<?php
$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$sHn."' AND  date LIKE '$today1%'  and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
		echo "<br><br><font face='Angsana New' size='5' color='#FF0066'><center>***ผู้ป่วยมีใบรายยามากกว่า 1 ใบ*** </center></FONT>";
	}
?>

</TD>
	<TD valign="top"  width="300"><BR><BR><BR>
	<?php

		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);
		$select_day = $year_now."-".$month_now."-".$day_now;

		$select_day2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543).date("-m-d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));

		$sql = "SELECT a.row_id, a.drug_return , a.drugcode , a.tradname , a.amount, b.ptname, date_format( a.date, '%H:%i:%s' )   FROM ( SELECT row_id, drug_return, drugcode , tradname , amount, idno, date  FROM ddrugrx where  ( date between '".$select_day." 07:31:00' AND '".$select_day2." 07:30:59' )AND slcode = 'ER' AND drug_return = '0' ) as a INNER JOIN (Select ptname, row_id From dphardep where date between '".$select_day." 07:31:00' AND '".$select_day2." 07:30:59' ) as b ON a.idno = b.row_id Order by a.date ASC ";


		$echoka = "";
		$echoka1 = "";
		$i=0;
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		?>
<FONT style="font-family:  MS Sans Serif; font-size: 14 px;">จำนวนข้อมูลทั้งหมด  <?php echo $rows;?></FONT>
<FORM METHOD=POST ACTION="cf_dg_return.php" target="_blank">
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse' style="font-family:  MS Sans Serif; font-size: 14 px;">
<TR>
	<TD align="center">&nbsp;</TD>
	<TD align="center">ชื่อผู้ป่วย</TD>
	<TD align="center">ชื่อยา</TD>
	<TD align="center">จำนวน</TD>
</TR>
<?php

		while(list($row_id, $drug_return, $drugcode , $tradname , $amount, $ptname, $time_in) = Mysql_fetch_row($result)){

if($i%2==0)
	$bgcolor= "#FFFFFF";	
else
	$bgcolor= "#FFFFB7";

		$i++;
		
		$echoka = echo_ka($time_in);

		if($echoka != $echoka1 && !empty($_POST["d"])){
		echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"3\">&nbsp;&nbsp;<B>วันที่ ".$date_in." เวร ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
		
	}
		
		echo "<TR bgcolor=\"".$bgcolor."\">";
			echo "<TD align='center'><INPUT TYPE=\"checkbox\" NAME=\"list[]\" value=\"",$row_id,"\"></TD>";
			echo "<TD>",$ptname,".</TD>
						<TD>",$tradname,".</TD>
						<TD>",$amount,"</TD>";
		echo "</TR>";

		}

		echo "<TR>";
		echo "<TD colspan=\"4\" ><INPUT TYPE=\"submit\" value=\"ยืนยันได้รับคืนแล้ว\"></TD>";
		echo "</TR>";
	?>
	</TD>
</TR>
</TABLE>
</FORM>

<?
include("unconnect.inc");
?>
