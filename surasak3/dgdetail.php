<?php
    session_start();
    session_unregister("sPtname");
    session_unregister("cTrad");
    session_unregister("cAmt");
    session_unregister("sPharow");
    session_register("dDate");

    $sPtname = '';
    $sPharow = $nRow_id;
    $dDate=$sDate;
    session_register("sPtname");
    session_register("sPharow");
    session_register("dDate");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id' "; 
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
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;

    print "*คืนยาแต่ละตัวให้คลิกชื่อยา, คืนยาทั้งใบคลิกคืนยาทั้งหมด <br><br>";
	echo "<A HREF=\"dgdate.php\">&lt;&lt;กลับหน้าคืนยา</A>&nbsp;&nbsp;";
	echo "<A HREF=\"../nindex.htm\">&lt;&lt;ไปเมนู</A><BR><BR>";
?>
<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		stat = false;

		for (i=1;i<eval(document.getElementById('total').value) ;i++ )
		{
			if(document.getElementById('list_rows'+i).checked == true){
				stat = true;
				break;
			}
		}
		
		if(stat == false)
			alert("กรุณาเลือกรายการยาที่ต้องการคืนยาอย่างน้อย 1 รายการ ด้วยการเช็คเครื่องหมายถูกด้านหย้าชื่อยา");
		
		if(stat == true){
			
			for (i=1;i<eval(document.getElementById('total').value) ;i++ )
			{
				if(document.getElementById('list_rows'+i).checked == true && (eval(document.getElementById('amount'+i).value) ==0 || document.getElementById('amount'+i).value =="")){
					alert("มีบางรายการที่ต้องการคืนยา แต่กลับใส่จำนวนเป็น 0 หรือ ไม่ได้ใส่จำนวน กรุณาเช็คความถูกต้องด้วยครับ");
					stat = false;
					break;
				}
			}


		}
		
		if(document.getElementById('an').value == ""){
			alert("ระบบคืนยาบางรายการ สามารถคือได้เฉพาะผู้ป่วยในเท่านั้นครับ");
			stat  = false;
		}
		return stat;
	}
	
	function check_number() {
	e_k=event.keyCode
		if (e_k != 47 && e_k != 46 && (e_k < 48) || (e_k > 57)) {
			event.returnValue = false;
			alert("กรุณากรอกเป็นตัวเลขเท่านั้นครับ");
			return false;
		}else{
			return true;
		}
	}

</SCRIPT>
<FORM METHOD=POST ACTION="drug_back.php" target="_blank" Onsubmit="return checkForm();">
<table>
 <tr>
	<th bgcolor=CD853F>&nbsp;</th>
  <th bgcolor=CD853F>รายการ</th>
  <th bgcolor=CD853F>จำนวน</th>
  <th bgcolor=CD853F>ราคา</th>
  <th bgcolor=CD853F>วิธีใช้</th>
  <th bgcolor=CD853F>PART</th>
  <th bgcolor=CD853F>คืนยา</th>
 </tr>

<?php
    $query = "SELECT drugcode,tradname,amount,price,slcode,row_id,part, statcon,reject FROM drugrx WHERE idno = '$sPharow' AND date = '".$_GET["sDate"]."'";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "วันที่ $d/$m/$y<br>";
    print "$sPtname, HN: $sHn<br> ";
    print "โรค: $sDiag<br>";
//    print "แพทย์ :$sDoctor<br><br>";

$i=1;
    while (list ($drugcode,$tradname,$amount,$price,$slcode,$row_id,$part, $statcon,$reject) = mysql_fetch_row ($result)) {
        print (" <tr height=\"30\">\n".
			"<td BGCOLOR=F5DEB3><INPUT TYPE=\"checkbox\" NAME=\"list_rows".$i."\" value=\"".$row_id."\" onclick=\"if(document.getElementById('amount".$i."').style.display=='none'){document.getElementById('amount".$i."').style.display='';document.getElementById('amount_value".$i."').style.display='none';}else{document.getElementById('amount".$i."').style.display='none';document.getElementById('amount_value".$i."').style.display='';}\"></td>\n".
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"dgrestk.php? cTradname=$tradname&cAmount=$amount&cRowdgrx=$row_id\">$tradname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><span id=\"amount_value".$i."\">$amount</span>
		   <INPUT style=\"display:none\" TYPE=\"text\" ID=\"amount".$i."\" NAME=\"amount".$i."\" value=\"".$amount."\" size=\"3\" onkeypress=\"check_number();\">
		   </td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
			     "  <td BGCOLOR=F5DEB3>$part</td>\n".
				 "  <td BGCOLOR=F5DEB3>$reject</td>\n".
           " </tr>\n");

		  print "<INPUT TYPE=\"hidden\" name=\"money".$i."\" value=\"".$price."\">";
		  print "<INPUT TYPE=\"hidden\" name=\"part".$i."\" value=\"".$part."\">";
		  print "<INPUT TYPE=\"hidden\" name=\"slcode".$i."\" value=\"".$slcode."\">";
		  print "<INPUT TYPE=\"hidden\" name=\"drugcode".$i."\" value=\"".$drugcode."\">";
		  print "<INPUT TYPE=\"hidden\" name=\"statcon".$i."\" value=\"".$statcon."\">";

$i++;
      }

    include("unconnect.inc");
?>
<tr><td colspan="5">
<?
if($_GET["nAccno"]=="1"){
?>
<INPUT TYPE="submit" value="คืนยาบางรายการ">
<?
}
?>
</td></tr>
</table>
<INPUT TYPE="hidden" id="an" name="pAn" value="<?php echo $sAn;?>">
<INPUT TYPE="hidden" name="pHn" value="<?php echo $sHn;?>">
<INPUT TYPE="hidden" id="total" name="total" value="<?php echo $i;?>">
<INPUT TYPE="hidden" name="row_id" value="<?php echo $_GET["nRow_id"];?>">
</FORM>
<?php
    print "รวมเงิน  $sNetprice บาท<br>";
    print "แพทย์ :$sDoctor<br>";
?>	
    &nbsp;&nbsp;&nbsp;<a target=_BLANK  href='rxrestk.php?nRow_id=<?=$_GET["nRow_id"]?>' onclick="return confirm('ยืนยันการคืนยา\nกรุณารอจนกว่าจะคืนยาเรียบร้อย')">คืนยาทั้งหมด</a>



