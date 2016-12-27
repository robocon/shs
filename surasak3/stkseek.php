<?php
//drugcode,tradname,expdate,lotno,amount,unit
/*
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

    $cTotal="";
    $cRestkcut="";
    $cCompany="";

    $aTotalstk = array("  totalstk");
    $aMainstk = array("  mainstk");
    $aStock = array("  stock");
    $aPart = array("part");

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
*/
    session_start();
    
	
	
	
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"25\"><strong>&nbsp;</strong></td><td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td width=\"30\"><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '",$se["drugcode"],"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>
<? print  "เบิกยาเวชภัณฑ์จากคลังยาใหญ่ ไป$cDepcode <br> ";  ?>
<script>
 function checkm(etext){
	if(etext=='t'){
		if(confirm('ยามีอายุน้อยกว่า 3 เดือนต้องการทำรายการต่อหรือไม่')){
			return true;
		}else{
			return false;
		}
	}else if(etext=='f'){
		return true;
	}
}

//////// เรียกดูรหัสยา ////////
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
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'stkseek.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New">&#3619;&#3627;&#3633;&#3626;&#3618;&#3634;&nbsp;&nbsp;
<Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div><input type="text" name="drugcode" size="10" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode');">&nbsp;&nbsp;&nbsp;&nbsp;
  จำนวน  <input type="text" name="total" size="10">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="    ตกลง    " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href="drugcode.php">รหัสยา?</a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>
  <th bgcolor=6495ED><font face='Angsana New'>Exp.Date</th>
  <th bgcolor=6495ED><font face='Angsana New'>Lot.No</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาทุน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาขาย</th>
  <th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>เบิก</th>
 </tr>

<?php
If (!empty($drugcode) and !empty($total)){
    include("connect.inc");
	
	///***3month***///
	$datenow1 = date("Y-m-d");
	$info1 = cal_days_in_month( CAL_GREGORIAN , date("m")+1 , 2011 ) ;
	$info2 = cal_days_in_month( CAL_GREGORIAN , date("m")+2 , 2011 ) ;
	$info3 = cal_days_in_month( CAL_GREGORIAN , date("m")+3 , 2011 ) ;
	$info =  $info1+$info2+$info3;
	$tomorrow = mktime(date("H"),date("i"),date("s"),date("m"),date("d")+$info,date("Y")); 
	$date3month = date("Y-m-d",$tomorrow);
	///***3month***///
	
	$drugcode = trim($drugcode);
    $query = "SELECT drugcode,tradname,genname,stock,mainstk,totalstk,part, salepri FROM druglst WHERE drugcode = '$drugcode' ";
    $result = mysql_query($query) or die("Query failed");

	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }

    if(mysql_num_rows($result)){
                $dcode=$row->drugcode;
	$tname=$row->tradname;
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	
	$npart=$row->part;	
	$nsalepri=$row->salepri;
                    }
    else {
           die("ไม่พบรหัส $drugcode หรือไม่ใส่จำนวนเบิก");
           }

    $cTotal=$total;
	$query1 = "SELECT drugcode,tradname,expdate,lotno,unitpri,amount,unit,dgexplot FROM combill  WHERE drugcode = '$drugcode' and expdate < '$datenow1' and amount >0 ORDER BY expdate DESC";//DESC
	//echo "1)".$query1."</br>";
    $query = "SELECT drugcode,tradname,expdate,lotno,unitpri,amount,unit,dgexplot FROM combill  WHERE drugcode = '$drugcode' and expdate > '$datenow1' and amount >0 ORDER BY expdate DESC";//DESC
	//echo "2)".$query."</br>";

    $result = mysql_query($query) or die("Query failed");

    print "<font face='Angsana New'>$drugcode,$tname มีทั้งหมด $ntotalstk, ในคลัง $nmainstk, ในห้องจ่าย $nstock<br>";
    print "ต้องการเบิก $total หน่วย (ให้เลือก Lot.No ที่ใกล้หมดอายุก่อน)<br>";
    while (list ($drugcode, $tradname,$expdate,$lotno,$unitpri,$amount,$unit,$dgexplot) = mysql_fetch_row ($result)) {
		if($expdate<=$date3month){
			$mon3="t"; //ถ้าอายุน้อยกว่า 3 เดือน
		}else{
			$mon3="f"; //ถ้าอายุมากกว่า 3 เดือน
		}
        echo " <tr>".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$expdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$nsalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
		   "  <td BGCOLOR=66CDAA><a target='top' href=\"stkinfo.php? cExpdate=$expdate&cLotno=$lotno&cDglotno=$dgexplot&cDgcode=$drugcode&cUnitpri=$unitpri&cTotal=$total&cAmount=$amount&cUnit=$unit&vTotalstk=$ntotalstk&vMainstk=$nmainstk&vStock=$nstock&vPart=$npart&cTrade=$tradname\" onclick=\"return checkm('$mon3')\"><font face='Angsana New'>เบิก</a></td>\n".
				   " </tr>";
          }
		  
		  
    $result1 = mysql_query($query1) or die("Query failed");

    //print "หมดอายุแล้ว<br>";
    while (list ($drugcode, $tradname,$expdate,$lotno,$unitpri,$amount,$unit,$dgexplot) = mysql_fetch_row ($result1)) {
        echo " <tr>".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$expdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$nsalepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
		   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target='top' href=\"stkinfo.php? cExpdate=$expdate&cLotno=$lotno&cDglotno=$dgexplot&cDgcode=$drugcode&cUnitpri=$unitpri&cTotal=$total&cAmount=$amount&cUnit=$unit&vTotalstk=$ntotalstk&vMainstk=$nmainstk&vStock=$nstock&vPart=$npart&cTrade=$tradname\" onclick=\"return checkm('$mon3')\"><font face='Angsana New'>เบิก(หมดอายุ)</a></td>\n".
				   " </tr>";
          }
   include("unconnect.inc");
          }
?>

</table>

