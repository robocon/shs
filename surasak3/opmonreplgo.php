<?php
session_start();
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" H:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
    print "บัญชีรายรับผู้ป่วยนอก จ่ายตรง อปท. ของวันที่ $repdate ";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";

    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$rowid = array("row_id");
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
    <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>ราคา</th>

  <th bgcolor=6495ED>ชำระโดย</th>
    
  <th bgcolor=6495ED>ราคาเบิก</th>
  <th bgcolor=6495ED>จนท.เก็บเงิน</th>
  <th bgcolor=6495ED>วันที่ปรับปรุง</th>
  </tr>

<?php
    include("connect.inc");

session_unregister("credit_1");
session_unregister("credit_2");
session_unregister("credit_3");
session_unregister("credit_4");
session_unregister("credit_5");
session_unregister("credit_6");
session_unregister("credit_7");
session_unregister("credit_8");

$credit_1=" ";
$credit_2=" ";
$credit_3=" ";
$credit_4=" ";
$credit_5=" ";
$credit_6=" ";
$credit_7=" ";
$credit_8=" ";


session_register("credit_1");
session_register("credit_2");
session_register("credit_3");
session_register("credit_4");
session_register("credit_5");
session_register("credit_6");
session_register("credit_7");
session_register("credit_8");



    $query = "SELECT * FROM opacc WHERE date LIKE '$today%' and credit = 'จ่ายตรง อปท.'  ";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      
	array_push($rowid,$row->row_id);
    array_push($aDate,$row->date);
	  array_push($atxDate,$row->txdate);
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paidcscd);
	array_push($aCredit,$row->credit);
    array_push($aPtright,$row->ptright);
	array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);
	array_push($aPaidcscd,$row->paidcscd);
	array_push($aVn,$row->vn);
	array_push($aLastupdate,$row->lastupdate);

if ($row->depart=="PHAR"){
	        array_push($aPhar,$row->price);  
            array_push($aPharpaid,$row->paidcscd);
            array_push($aEssd,$row->essd);
            array_push($aNessdy,$row->nessdy);
         //   array_push($aNessdn,$row->nessdn);
            array_push($aDPY,$row->dpy);
            array_push($aDPN,$row->dpn); 
            array_push($aDSY,$row->dsy);  
            array_push($aDSN,$row->dsn);
            }   
if ($row->depart=="PATHO"){
            array_push($aLabo,$row->price);  
            array_push($aLabopaid,$row->paidcscd);
            } 
if ($row->depart=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aXraypaid,$row->paidcscd);
            } 
if ($row->depart=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aSurgpaid,$row->paidcscd);
            } 
if ($row->depart=="EMER"){
            array_push($aEmer,$row->price);  
            array_push($aEmerpaid,$row->paidcscd);
            } 
if ($row->depart=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aDentpaid,$row->paidcscd);
            } 
if ($row->depart=="PHYSI"){
            array_push($aPhysi,$row->price);  
            array_push($aPhysipd,$row->paidcscd);
			            } 
if ($row->depart=="NID"){
            array_push($aNid,$row->price);  
            array_push($aNidpd,$row->paidcscd);
            } 
if ($row->depart=="HEMO"){
            array_push($aHemo,$row->price);  
            array_push($aHemopd,$row->paidcscd);
            } 
if ($row->depart=="OTHER"){
            array_push($aOther,$row->price);  
            array_push($aOtherpd,$row->paidcscd);
            } 
if ($row->depart=="WARD"){
            array_push($aWard,$row->price);  
            array_push($aWardpd,$row->paidcscd);
            } 
if (!empty($row->credit)){
            array_push($aCreditpaid,$row->paidcscd);  
				
				switch($row->credit){
					case "เงินสด" : $_SESSION["credit_1"]=$_SESSION["credit_1"]+$row->paid; break;
					case "กรุงเทพ" : $_SESSION["credit_2"]=$_SESSION["credit_2"]+$row->paid; break;
					case "ทหารไทย" : $_SESSION["credit_3"]=$_SESSION["credit_3"]+$row->paid; break;
					case "จ่ายตรง" : $_SESSION["credit_4"]=$_SESSION["credit_4"]+$row->paid; break;
					case "ประกันสังคม" : $_SESSION["credit_5"]=$_SESSION["credit_5"]+$row->paid; break;
					case "30บาท" : $_SESSION["credit_6"]=$_SESSION["credit_6"]+$row->paid; break;
					case "เงินเชื่อ" : $_SESSION["credit_7"]=$_SESSION["credit_7"]+$row->paid; break;
					case "อื่นๆ" : $_SESSION["credit_8"]=$_SESSION["credit_8"]+$row->paid; break;
				}

            } 
$x++;
       }
 //include("unconnect.inc");

print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
//   $x++;
   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
		 $time2=substr($atxDate[$n],11,5);
		 
		 $Nquery = "Select hn, status From cscddata where hn = '$aHn[$n]' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($Nquery)) > 0){
				if($aPaidcscd[$n]>0){
					$color="#F5DEB3";	
				}else{
					$color="#FF0000";	
				}
			}else{
				$color="#FF0000";	
			}
			
        print("<tr>\n".
                "<td bgcolor=$color><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aDate[$n]</td>\n".
			"<td bgcolor=$color><font face='Angsana New'>$atxDate[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aHn[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aAn[$n]</td>\n".   
			 "<td bgcolor=$color><font face='Angsana New'>$aVn[$n]</td>\n".    
                "<td bgcolor=$color><font face='Angsana New'>$aDepart[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aDetail[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aPrice[$n]</td>\n".  
          //      "<td bgcolor=$color><font face='Angsana New'>$aPaid[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'><A HREF=\"edit_cashlgo.php?id=$rowid[$n]\" target='_blank'>$aCredit[$n]</A></td>\n".  
		  //	   "<td bgcolor=$color><font face='Angsana New'>$aCredit_d[$n]</td>\n".
				  	   "<td bgcolor=$color><font face='Angsana New'>$aPaid[$n]</td>\n".
            //    "<td bgcolor=$color><font face='Angsana New'>$aPtright[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aIdname[$n]</td>\n".  
					  "<td bgcolor=$color><font face='Angsana New'>$aLastupdate[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

//แสดงรายการคืนเงิน
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'><br>แสดงรายการคืนเงิน<br></th>";
    print "</table>";

   print "<table>";
   print "<tr>";
  print "<th bgcolor=9999CC>#</th>";
  print "<th bgcolor=9999C>เวลา</th>";
  print "<th bgcolor=9999C>HN</th>";
 print " <th bgcolor=9999C>AN</th>";
  print "<th bgcolor=9999C>แผนก</th>";
 print " <th bgcolor=9999C>รายการ</th>";
  print "<th bgcolor=9999C>ราคา</th>";
 print " <th bgcolor=9999C>จ่ายเงิน</th>";
 print " <th bgcolor=9999C>บัตรเครดิต</th>";
 print " <th bgcolor=9999C>สิทธิ</th>";
  print "<th bgcolor=9999C>จนท.เก็บเงิน</th>";
  print "</tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        if ($aPaid[$n]<0){
           print("<tr>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$num</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$time</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aHn[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aAn[$n]</td>\n". 
			    "<td bgcolor=99CCCC><font face='Angsana New'>$aVn[$n]</td>\n". 
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDepart[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDetail[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPrice[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPaid[$n]</td>\n".  
                 "<td bgcolor=99CCCC><font face='Angsana New'>$aCredit[$n]</td>\n".  
                 "<td bgcolor=99CCCC><font face='Angsana New'>$aPtright[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aIdname[$n]</td>\n".  
                   " </tr>\n");
          $num++;
		     }       
		        }
?>
</table>
    <br><a target=_BLANK href="#">ตรวจสอบเงินรายรับผู้ป่วยนอกจ่ายตรง อปท.</a>
    
   
 <br>&nbsp;&nbsp;&nbsp; <a target=_self  href='../nindex.htm'><< ไปเมนู> </a>


