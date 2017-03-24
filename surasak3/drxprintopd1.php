<body Onload="window.print();">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
</Script>




<?php
    session_start();
    include("connect.inc");
  
  Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}

    $query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' "; 
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
    $dRxdate=$row->date;
    $rxHn=$row->hn;
    $rxPtname=$row->ptname;
    $rxDoctor=$row->doctor;
    $rxNetprice=$row->price;
    $rxDiag=$row->diag;
     $rxPtright=$row->ptright;
 $rxvn=$row->tvn;
  $rxpharin=$row->pharin;

  $phakew=$row->kew;
   $kewphar=$row->kewphar;
	   $Essd   =$row->essd;  //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy =$row->nessdy;     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn =$row->nessdn;    //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =$row->dsy;   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN    =$row->dsn;   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY    =$row->dpy;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =$row->dpn;   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;


	   $d=substr($dRxdate,8,2);
    $m=substr($dRxdate,5,2);
    $y=substr($dRxdate,0,4);

	  $t=substr($dRxdate,11,8);
  

	$sql = "Select dbirth From opcard where hn='".$rxHn."' limit 1";
	list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));
	
	$age = calcage($dbirth);
//  print "<font face='Angsana New' size= 4 ><b><CENTER>ใบรายการยากลับบ้าน</CENTER></b></font>";
    print "<TR  style=\"line-height: 14px;\"> <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ใบรายการยา</b></font></td>\n";
    print " <td><font face='Angsana New' size='1' >&nbsp;$d/$m/$y&nbsp;&nbsp;$t</td>\n<BR>";
    print " <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ชื่อ&nbsp;$rxPtname</b> &nbsp;HN:&nbsp;$rxHn</td>\n<BR>";
//	print "<font face='Angsana New' size=1 >&nbsp;&nbsp<b>อายุ&nbsp;$age</b>&nbsp;&nbsp; ";
    print " <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;โรค: $rxDiag</font></td>\n<BR>";
	$num1='0';
 $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$rxHn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");
/*
   if(mysql_num_rows($result)){

	print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>ประวัติการแพ้ยา</b></u>";
  while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
	  $num1++;
	     print (" <tr>\n".
             
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b><u>$num1</b></u></font ></td>\n".
                " </tr>\n");
            print (" <tr>\n".
             
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>$tradname...$advreact($asses)</b></u></font ></td>\n".
                " </tr>\n");
  						    }

print "</div>";

  }
*/
?>

<table>
 <tr>
  
 </tr>

<?php

 

$num='0';
    $query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_slip, a.drug_inject_type,a.drug_inject_etc,a.office,c.unit FROM ddrugrx as a, drugslip as b,druglst as c WHERE a.slcode = b.slcode AND a.idno = '$sRow_id'   AND a.date = '$dRxdate' AND a.drugcode = c.drugcode ";
    $result = mysql_query($query)
        or die("Query failed");

  
	
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part,  $detail1, $detail2, $detail3, $detail4,$dia,$dis,$dit,$die,$office,$unit) = mysql_fetch_row ($result)) {
		$num++;

        print (" <TR  style=\"line-height: 14px;\">\n".
			  "  <td><font face='Angsana New'  size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$num.</td>\n".
			  //  "  <td><font face='Angsana New' style='line-height:15px; size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$drugcode</td>\n".
           "  <td><font face='Angsana New'  size='1'><b>&nbsp;$tradname</b>&nbsp;[$unit]</td>\n".
           "  <td align='right'><font face='Angsana New' size='1'>&nbsp;<b>(&nbsp;$amount&nbsp;)</b></td>\n".
        "  <td align='right'><font face='Angsana New'  size='1'><B>$slcode</B></td>\n".
		//	  "  <td align='right'><font face='Angsana New'  size='1'><B>วิธีใช้</B></td>\n".
      //     "  <td><font face='Angsana New' size='1'>&nbsp;$detail1 &nbsp; $detail2 &nbsp; $detail3 &nbsp; $detail4&nbsp;&nbsp;$dia&nbsp;$dis&nbsp;$dit&nbsp;$die &nbsp;$office</td>\n".
           " </tr>\n");
		if($num == 10){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}else if($num == 20){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}
      }
   
?>
</table>
<?php

 print "<font face='Angsana New' style='line-height:15px; size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แพทย์ :$rxDoctor &nbsp;&nbsp;&nbsp;";
   // print "<font face='Angsana New'>(<b>เบิกได้&nbsp;$netfree&nbsp;บาท</b>&nbsp;&nbsp;&nbsp;เบิกไม่ได้&nbsp;$netpay  &nbsp;บาท)&nbsp;&nbsp; <font face='Angsana New' size='4'>รวมเงิน  $rxNetprice  บาท</font><br>";
	//  print "<font face='Angsana New' size='1'>บัญชียาหลัก เบิกได้&nbsp;$Essd &nbsp;</font>";
   // print "<font face='Angsana New' size='1'>นอกบัญชียาหลักเบิกได้ &nbsp;$Nessdy &nbsp;&nbsp;เบิกไม่ได้&nbsp; $Nessdn &nbsp;</font>";
    //print "<font face='Angsana New' size='1'>ค่าเวชภัณฑ์เบิกได้ &nbsp;$DSY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DSN &nbsp;</font>";
  //  print "<font face='Angsana New' size='1'>ค่าอุปกรณ์เบิกได้  &nbsp;$DPY &nbsp;&nbsp;เบิกไม่ได้&nbsp;$DPN <br></font>";
	
	    
   

	//print "<font face='Angsana New' size='2'>สำหรับห้องยา&nbsp;&nbsp;ผู้พิมพ์.................ผู้จัด..................";
//	print "<font face='Angsana New'>ผู้ตรวจสอบ...................................ผู้จ่าย................................<br>";


 $thdatevn1 = $d.'-'.$m.'-'.$y.$rxHn;
  $thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
$thdatevn3 = $y.'-'.$m.'-'.$d;

 $timedate = date("H:i:s"); 
 $sql = "SELECT time1 FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";

   list($timestd) = mysql_fetch_row(Mysql_Query($sql));


   // print "<font face='Angsana New' size='2'>เวลา&nbsp;ผู้ป่วยลงทะเบียน&nbsp;$timestd &nbsp; แพทย์สั่งยา&nbsp$t&nbsp  รับใบสั่งยา&nbsp;$rxpharin...บันทึกข้อมูล&nbsp;$timedate&nbsp; จัดยา........... ตรวจสอบยา...........  จ่ายยา.............";

$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$rxHn."' AND  date LIKE '$today1%' and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
	//echo "<br><font face='Angsana New' size='5'><center>***ผู้ป่วยมีใบรายยามากกว่า 1 ใบ*** </center></FONT>";
	}
	 include("unconnect.inc");
?>

