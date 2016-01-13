<?php

    $today="$d-$m-$yr";

    print "วันที่ $today  รายชื่อคนไข้ค้างคืนบัตรเรียงตามลำดับเวลาก่อนหลัง";

    print "<input type=button onclick='history.back()' value='<< กลับไป'>";

    $today="$yr-$m-$d";

?>

<table>

 <tr>

  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED>วัน - เวลา</th>

  <th bgcolor=6495ED>HN</th>

  <th bgcolor=6495ED>ชื่อ</th>

  <th bgcolor=6495ED>AN</th>

  <th bgcolor=6495ED>โรค</th>

  <th bgcolor=6495ED>แพทย์</th>

  <th bgcolor=6495ED><font face='Angsana New'>คืนOPD</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>ออกโดย</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>ยืม</th>

 

 </tr>



<?php

    $detail="ค่ายา";

    include("connect.inc");

  

    $query = "SELECT vn,thdatehn, date_format(thidate, '%d/%m/%Y %H:%i:%s'),hn,ptname,an,diag,doctor,okopd,toborow,borow FROM opday WHERE okopd='N'and thidate LIKE '$today%' ";

    $result = mysql_query($query)

        or die("Query failed");


$opd = 0;
    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$okopd,$toborow,$borow) = mysql_fetch_row ($result)) {

        //$time=substr($thidate,11);
	$num++;
		
		if(substr($toborow,0,4) == "EX15"){
			$bg="FFCC99";
		}else if(substr($toborow,0,4) == "EX12"){
			$bg="FFCC99";
		}else if(substr($toborow,0,4) == "EX19"){
			$bg="FFCC99";
		}else if(substr($toborow,0,5) == "EX 91"){
			$bg="FFCC99";
		}else if($toborow == "ออก VN โดย LAB"){
			$bg="FFCC99";
		}else{
			$bg="66CDAA";
			$opd++;
		}



        print (" <tr>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$num</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$thidate</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$hn</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'><a target=_BLANK  href=\"chkopd.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&cVn=$vn\">$ptname</a></td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$an</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$diag</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$doctor</td>\n".

           "  <td BGCOLOR=$bg><font face='Angsana New'>$okopd</td>\n".

      
  "  <td BGCOLOR=$bg><font face='Angsana New'>$toborow</td>\n".

   
  "  <td BGCOLOR=$bg><font face='Angsana New'>$borow</td>\n".

   
     " </tr>\n");

       }

    include("unconnect.inc");

?>
<tr>
	<td colspan="10" align="right">
		จำนวน OPDCard สูญหาย : <?php echo $opd;?>
	</td>
</tr>
</table>