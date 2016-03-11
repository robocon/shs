<?php
session_start();
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" H:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
    print "บัญชีรายรับผู้ป่วยนอก ของวันที่ $repdate ";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";

    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$rowid = array("row_id");
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
	<th bgcolor=6495ED>เลขที่</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>จนท.เก็บเงิน</th>
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



    $query = "SELECT * FROM opacc WHERE date LIKE '$today%' ";
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
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paid);
	array_push($aCredit,$row->credit);
    array_push($aPtright,$row->ptright);
	array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);
	  array_push($aBillno,$row->billno);


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
if (!empty($row->credit)){
            array_push($aCreditpaid,$row->paid);  
				
				switch($row->credit){
					case "เงินสด" : $_SESSION["credit_1"]=$_SESSION["credit_1"]+$row->paid; break;
					case "กรุงเทพ" : $_SESSION["credit_2"]=$_SESSION["credit_2"]+$row->paid; break;
					case "ทหารไทย" : $_SESSION["credit_3"]=$_SESSION["credit_3"]+$row->paid; break;
					case "จ่ายตรง" : $_SESSION["credit_4"]=$_SESSION["credit_4"]+$row->paid; break;
					case "ประกันสังคม" : $_SESSION["credit_5"]=$_SESSION["credit_5"]+$row->paid; break;
					case "30บาท" : $_SESSION["credit_6"]=$_SESSION["credit_6"]+$row->paid; break;
					case "เงินเชื่อ" : $_SESSION["credit_7"]=$_SESSION["credit_7"]+$row->paid; break;
					case "อื่นๆ" : $_SESSION["credit_8"]=$_SESSION["credit_8"]+$row->paid; break;
						case "HD" : $_SESSION["credit_9"]=$_SESSION["credit_9"]+$row->paid; break;
				}

            } 
$x++;
       }
// include("unconnect.inc");

print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
//   $x++;
   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
		
$color="#F5DEB3";		 //init

if($aCredit[$n]==""){
	$color="#FF0000";	
	}else{
	$color="#F5DEB3";	
	}
		
		/////////chk error
		if($aCredit[$n]=="จ่ายตรง"){
			$Nquery = "Select hn, status From cscddata where hn = '$aHn[$n]' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($Nquery)) > 0){
				if($aPaid[$n]>0){
					$color="#F5DEB3";	
				}else{
					$color="#FF0000";	
				}
			}else{
				$color="#FF0000";	
			}
		}elseif($aCredit[$n]=="ประกันสังคม"){
			$idc = "select idcard from opcard where hn = '$aHn[$n]'";
			list($idcard)= mysql_query($idc) or die("Query failed");
			$Nquery = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($Nquery)) > 0){
				if($aPaid[$n]>0){
					$color="#F5DEB3";	
				}else{
					$color="#FF0000";	
				}
			}else{
				$color="#FF0000";	
			}
		}
		////////////////
		
        print("<tr>\n".
                "<td bgcolor=$color><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$time</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aHn[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aAn[$n]</td>\n".    
                "<td bgcolor=$color><font face='Angsana New'>$aDepart[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aDetail[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aPrice[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'><A HREF=\"edit_cash.php?id=$rowid[$n]\" target='_blank'>$aPaid[$n]</A></td>\n".  
                "<td bgcolor=$color><font face='Angsana New'><A HREF=\"edit_cash.php?id=$rowid[$n]\" target='_blank'>$aCredit[$n]</A></td>\n".  
				"<td bgcolor=$color><font face='Angsana New'>$aCredit_d[$n]</td>\n".
		  	    "<td bgcolor=$color><font face='Angsana New'>$aBillno[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aPtright[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aIdname[$n]</td>\n".  
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

<br/>
<hr />
<h5>รายการที่ ซ้ำ</h5>

<table>
 <tr bgcolor=6495ED>
  <th>#</th>
  <th>เวลา</th>
  <th>HN</th>
  <th>AN</th>
  <th>แผนก</th>
  <th>รายการ</th>
  <th>ราคา</th>
  <th>จ่ายเงิน</th>
  <th>ชำระโดย</th>
  <th>รายละเอียด</th>
  <th>เลขที่</th>
  <th>สิทธิ</th>
  <th>จนท.เก็บเงิน</th>
  </tr>
<?
 include("connect.inc");

$sql2="SELECT *, COUNT( * ) AS a
FROM opacc
WHERE DATE
LIKE  '$today%'
GROUP BY txdate, hn,detail,price,credit
HAVING a >1 ";
$query2 = mysql_query($sql2);
$n=1;
while($result2 = mysql_fetch_array($query2)){
?>
  <tr bgcolor="#FFCCCC">
  <th><?=$n;?></th>
  <th><?=$result2['txdate']?></th>
  <th><?=$result2['hn']?></th>
  <th><?=$result2['an']?></th>
  <th><?=$result2['depart']?></th>
  <th align="left"><?=$result2['detail']?></th>
  <th><?=$result2['price']?></th>
  <th><?=$result2['paid']?></th>
  <th><?=$result2['credit']?></th>
 <th align="left"><?=$result2['detail']?></th>
 <th><?=$result2['credit_detail']?></th>
  <th align="left"><?=$result2['ptright']?></th>
  <th align="left"><?=$result2['idname']?></th>
  </tr>
  <?
  $n++;
}
  ?>
  </table>
    <br><a target=_BLANK href="opmchk.php">ตรวจสอบเงินรายรับผู้ป่วยนอกทั้งหมด(ทุกสิทธิ)</a>
    
   
 <br><a target=_self  href='../nindex.htm'><-----------ไปเมนู </a>