<?php
session_start();
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

	  $detail2="$detail1";  
    print "บัญชีรายรับผู้ป่วยนอก ของวันที่ $repdate  ";
    print "เจ้าหน้าที่ $doctor&nbsp;&nbsp;ประเภท&nbsp;$detail2 ";
    $today="$yr-$m-$d";

    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
?>
<table>
 <tr>
    <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>แผนก</th>
  <th bgcolor=6495ED>รายการ</th>
  <th bgcolor=6495ED>ราคา</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  <th bgcolor=6495ED>ชำระโดย</th>
  <th bgcolor=6495ED>รายละเอียด</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>จนท.เก็บเงิน</th>
  </tr>

<?php
    include("connect.inc");
if($detail1=="ทั้งหมด"){$where = " '' ";} else { $where = "AND credit ='$detail1' ";};


 $query = "SELECT * FROM opacc WHERE   date LIKE '$today%' and idname LIKE '%$doctor%' ".$where ;

    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      

    array_push($aDate,$row->date);
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paid);
	   array_push($aCredit,$row->credit);
	    array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);
	   array_push($aPtright,$row->ptright);

if ($row->depart=="PHAR"){
	        array_push($aPhar,$row->price);  
            array_push($aPharpaid,$row->paid);
            array_push($aEssd,$row->essd);
            array_push($aNessdy,$row->nessdy);
            array_push($aNessdn,$row->nessdn);
            array_push($aDPY,$row->dpy);
            array_push($aDPN,$row->dpn); 
            array_push($aDSY,$row->dsy);  
            array_push($aDSN,$row->dsn);
            }   
if ($row->depart=="PATHO"){
            array_push($aLabo,$row->price);  
            array_push($aLabopaid,$row->paid);
            } 
if ($row->depart=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aXraypaid,$row->paid);
            } 
if ($row->depart=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aSurgpaid,$row->paid);
            } 
if ($row->depart=="EMER"){
            array_push($aEmer,$row->price);  
            array_push($aEmerpaid,$row->paid);
            } 
if ($row->depart=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aDentpaid,$row->paid);
            } 
if ($row->depart=="PHYSI"){
            array_push($aPhysi,$row->price);  
            array_push($aPhysipd,$row->paid);
            } 
if ($row->depart=="HEMO"){
            array_push($aHemo,$row->price);  
            array_push($aHemopd,$row->paid);
            } 
if ($row->depart=="OTHER"){
            array_push($aOther,$row->price);  
            array_push($aOtherpd,$row->paid);
            } 
if ($row->depart=="WARD"){
            array_push($aWard,$row->price);  
            array_push($aWardpd,$row->paid);
  } 
if ($row->credit=="เงินสด"){
            array_push($aCredit_1,$row->price);  
            array_push($aCredit_1pd,$row->paid);
  } 
if ($row->credit=="กรุงเทพ"){
            array_push($aCredit_2,$row->price);  
            array_push($aCredit_2pd,$row->paid);
			  } 
if ($row->credit=="ทหารไทย"){
            array_push($aCredit_3,$row->price);  
            array_push($aCredit_3pd,$row->paid);
			  } 
if ($row->credit=="จ่ายตรง"){
            array_push($aCredit_4,$row->price);  
            array_push($aCredit_4pd,$row->paid);
			  } 
if ($row->credit=="ประกันสังคม"){
            array_push($aCredit_5,$row->price);  
            array_push($aCredit_5pd,$row->paid);
			  } 
if ($row->credit=="30บาท"){
            array_push($aCredit_6,$row->price);  
            array_push($aCredit_6pd,$row->paid);
			  } 
if ($row->credit=="เงินเชื่อ"){
            array_push($aCredit_7,$row->price);  
            array_push($aCredit_7pd,$row->paid);
			  } 
if ($row->credit=="อื่นๆ"){
            array_push($aCredit_8,$row->price);  
            array_push($aCredit_8pd,$row->paid);



            } 
$x++;
       }
 include("unconnect.inc");

print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
//   $x++;
   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        print("<tr>\n".
                 "<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$time</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aHn[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAn[$n]</td>\n".    
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDepart[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDetail[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPaid[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aCredit[$n]</td>\n".  
			   "<td bgcolor=F5DEB3><font face='Angsana New'>$aCredit_d[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPtright[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aIdname[$n]</td>\n".  
                " </tr>\n");


       $num++;
       }       
		      
?>
</table>
      <br><a href="opmchkuser1.php">ตรวจสอบเงินรายรับ</a>
    

