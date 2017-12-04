<?php
session_start();
    session_unregister("x");
    session_unregister("aDate");
 session_unregister("atxDate");
    session_unregister("chkdate");
    session_unregister("repdate");

    session_unregister("aHn");
    session_unregister("aAn");
    session_unregister("aIdname");
    session_unregister("aDepart");
    session_unregister("aDetail");
    session_unregister("aPrice");
    session_unregister("aPaid");
    session_unregister("aPhar");  
    session_unregister("aPharpaid");    
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aPtright");
    session_unregister("aCredit");
    session_unregister("aCreditpaid");
    session_unregister("aLabo");
    session_unregister("aLabopaid");
    session_unregister("aXray");
    session_unregister("aXraypaid");  
    session_unregister("aSurg");    
    session_unregister("aSurgpaid");
    session_unregister("aEmer");
    session_unregister("aEmerpaid");
    session_unregister("aDent");
    session_unregister("aDentpaid");
    session_unregister("aPhysi");
    session_unregister("aPhysipd");
	 session_unregister("aNid");
    session_unregister("aNidpd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
    session_unregister("aCredit");
	session_unregister("aCredit_d");
	session_unregister("aPaidcscd");
	session_unregister("aVn");
		session_unregister("aLastupdate");
		session_unregister("acredit_detail"); 
//
//
    $x            =0;
    $aDate     =array("time");
     $atxDate     =array("time2");
    $chkdate="";   
    $repdate="";

    $aHn        =array("hn");
    $aAn         =array("an");  
    $aIdname  =array("idname");
    $Netprice  ="";   
    $Netpaid   ="";
    $aDepart   =array("depart");
    $aDetail    = array("detail");
    $aPrice   =array("price");
    $aPaid    = array("paid");
    $aPhar      =array("phar");
    $aPharpaid=array("pharpaid"); 
    $aEssd     =array("DDL");
    $aNessdy =array("DDY");
    $aNessdn =array("DDN");
    $aDPY      =array("DPY");
    $aDPN      =array("DPN");   
    $aDSY      =array("DSY");
    $aDSN      =array("DSN");   
	$aPtright   =array("ptright");  
	$aCredit   =array("credit");  
	$aCreditpaid  =array("creditpaid");  
    $aLabo        =array("labo");
    $aLabopaid  =array("labopaid");
    $aXray         =array("xray");
    $aXraypaid =array("xraypaid");
    $aSurg        =array("surg");
    $aSurgpaid =array("surgpaid");
    $aEmer        =array("emer");
    $aEmerpaid  =array("emerpaid");
    $aDent          =array("dent");
    $aDentpaid  =array("dentpaid");
    $aPhysi       =array("physi");
	$aPhysipd       =array("physipd");
	$aNid       =array("nid");
    $aNidpd  =array("nidpd");
    $aHemo       =array("hemo");
    $aHemopd  =array("hemopd");
    $aOther      =array("other");
    $aOtherpd  =array("otherpd");
    $aWard      =array("Ward");
    $aWardpd  =array("Wardpd");
	$aCredit     =array("Credit");
	$aCredit_d     =array("Credit_detail");
	$aPaidcscd     =array("paidcscd");
$aVn     =array("vn");
$aLastupdate     =array("lastupdate");
$acredit_detail =array("credit_detail");

    session_register("x");
    session_register("aDate");
  session_register("atxDate");
    session_register("chkdate");
    session_register("repdate");

    session_register("aHn");
    session_register("aAn");
    session_register("aIdname");
    session_register("aDepart");
    session_register("aDetail");
    session_register("aPrice");
    session_register("aPaid");
    session_register("aPhar");  
    session_register("aPharpaid");    
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aPtright");
    session_register("aCredit");
    session_register("aCreditpaid");
    session_register("aLabo");
    session_register("aLabopaid");
    session_register("aXray");
    session_register("aXraypaid");  
    session_register("aSurg");    
    session_register("aSurgpaid");
    session_register("aEmer");
    session_register("aEmerpaid");
    session_register("aDent");
    session_register("aDentpaid");
    session_register("aPhysi");
    session_register("aPhysipd");
	  session_register("aNid");
    session_register("aNidpd");
    session_register("aHemo");
    session_register("aHemopd");
    session_register("aOther");
    session_register("aOtherpd");
    session_register("aWard");
    session_register("aWardpd");
    session_register("aCredit");
	   session_register("aCredit_d");
	      session_register("aPaidcscd");
		   session_register("aVn");
		     session_register("aLastupdate");
			     session_register("acredit_detail");

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" H:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today; 
    print "<p>ติด C จ่ายตรง || <a href='opmonreplgoc.php'>ติด C จ่ายตรง อปท.</a></p>";      	
    print "บัญชีรายรับผู้ป่วยนอก จ่ายตรง ที่ติด C ";
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
    <th bgcolor=6495ED>รหัสที่ติด</th>
    
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



    $query = "SELECT * FROM opacc WHERE  credit = 'ติดC' order by credit_detail  ";
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
		array_push($acredit_detail,$row->credit_detail);


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
                "<td bgcolor=$color><font face='Angsana New'><A HREF=\"edit_cashcscd1.php?id=$rowid[$n]\" target='_blank'>$aCredit[$n]</A></td>\n".  
					       "<td bgcolor=$color><font face='Angsana New'>$acredit_detail[$n]</td>\n".  
		  //	   "<td bgcolor=$color><font face='Angsana New'>$aCredit_d[$n]</td>\n".
				  	   "<td bgcolor=$color><font face='Angsana New'>$aPaidcscd[$n]</td>\n".
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
    <br><a target=_BLANK href="opmchkcscd.php">ตรวจสอบเงินรายรับผู้ป่วยนอกจ่ายตรง</a>
    
   
 <br>&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู> </a>


<br>- CheckCode: แสดงเฉพาะเมื่อมี ข้อผิดพลาด/เตือน <br>
11  ไม่ระบุ InvNo<br>
12  InvNo ซ้ำ<br>
16  ไม่ระบุ AuthCode<br>
17  Authcode ไม่ถูกต้อง<br>
21  ไม่ระบุ HN ในรายการ<br>
22  HN ไม่อยู่ในทะเบียนผู้มีสิทธิ<br>
26  ไม่ระบุ MemberNo หรือ Member No ไม่ตรงกับ HN<br>
27  MemberNo ไม่อยู่ในทะเบียนผู้มีสิทธิ<br>
28  MemberNo ถูกระงับสิทธิทำธุรกรรม<br>
31  ไม่มีข้อมูลลายนิ้วมือส่งไป<br>
32  ข้อมูลลายนิ้วมือไม่ถูกต้อง<br>
33  ข้อมูลลายนิ้วมือไม่ตรงกับทะเบียน<br>
41  เลขอนุมัติไม่มีหรือใช้ไม่ได้(กรณีฉุกเฉิน)<br>
42  เลขอนุมัตินี้ถูกใช้แล้วใช้ซ้ำไม่ได้(กรณีฉุกเฉิน)<br>
43  ขอเลขอนุมัติเกินเวลาที่กำหนด (กรณีฉุกเฉิน) -- ยังไม่ใช้<br>
44  ส่งเบิกค่ารักษาฯ เกินระยะเวลาที่กำหนด(กรณีฉุกเฉิน) -- ยังไม่ใช้<br>
45  ผู้ใช้สิทธิไม่มีสิทธิเบิกจ่ายตรงกับกรมบัญชีกลาง เช่น มีสิทธิ กทม., กสทช. เป็นต้น (กรณีฉุกเฉิน)<br>
51  ไม่ระบุ Station<br>
52  DTTran วันที่ไม่อยู่ในเกณฑ์ที่กำหนด<br>
53  DTTran อยู่นอกช่วงมีสิทธิเบิก<br>
54  DTTran อยู่นอกช่วงการอนุมัติขอใช้ยาควบคุมเฉพาะ (OCPA/RDPA/DDPA)<br>
55  มีการส่งเบิกค่ารักษาฯ ซ้ำซ้อนใน รพ.เดียวกัน (ส่งเบิกต่างวันกัน)<br>
56  มีการส่งเบิกค่ารักษาฯ ซ้ำซ้อนใน รพ.เดียวกัน (ส่งเบิกในวันเดียวกัน)<br>
57  ส่งเบิกค่ารักษาฯ ซ้ำซ้อนกับการเบิกเหมาจ่ายค่าฟอกเลือดล้างไต (HD)<br>
61  Amount ไม่ใช่ข้อมูลชนิดตัวเลข, เป็น 0 หรือ ติดลบ<br>
62  ไม่มีรายการ OPBills ของ BillTran นี้ (ใช้ InvNo เป็น key)<br>
63  มีรายการ OPBills ของ InvNo นี้ใช้รหัสหมวดไม่ถูกต้อง<br>
64  ยอดรวม Amount, Paid ของ InvNo นี้ไม่ตรงกับที่แจ้งใน OPBills<br>
65  รายการ OPBills นี้ไม่มี BillTran กำกับมาด้วย<br>
66  ไม่ระบุ BillNo กรณี Paid > 0<br>
67  Paid มากกว่า Amount<br>
70  รอตรวจสอบ/รอส่งข้อมูลใหม่<br>
71  ไม่แจ้งผลการพิจารณาสิทธิการฟอกไตจาก ปกส. (ผป.สิทธิซ้ำซ้อน)<br>
72  มีการเบิกค่าห้องเกินอัตราที่กำหนด(100 บาท/วัน)<br>
73  มีการเบิกค่ารักษาอื่นที่ไม่เกี่ยวข้องกับการรักษา<br>
90  Dispense ID ซ้ำ กับที่เคยส่งมาแล้ว<br>
91  Dispense ID ใน Dispensing link ไม่ได้กับ DispensedItems / จำนวนไม่เท่ากับ Items Count ที่ระบุ<br>
92  Dispense ID ใน DispensedItems link ไม่ได้กับ Dispensing<br>
93  ยอดเบิกของ Dispensing และ DispensedItems ไม่ตรงกัน<br>
94  ขาดข้อมูลที่กำหนดว่าต้องมี (required)<br>
95  ใน BillTran มีการเบิกค่ายา แต่ขาดข้อมูลยาใน BillDisp<br>
96  มีข้อมูลยาใน BillDisp  แต่ไม่มีการเบิกค่ายาใน BillTran<br>
97  ยอดเบิกยาใน Billtran ไม่เท่ากับ Dispensing<br>
98  จำนวนเงินที่ขอเบิกไม่ถูกต้อง (charge # claim+paid+other)<br>
99  ไม่พบรหัสยาในรายการยาที่ รพ. แจ้งไว้ (ยังไม่ใช้)<br>
9A  เลข ว. แพทย์ไม่ถูกต้องตามรูปแบบที่กำหนด<br>
9B  มีรายการยาที่ห้ามเบิกในระบบจ่ายตรง (Glucosamine)<br>
