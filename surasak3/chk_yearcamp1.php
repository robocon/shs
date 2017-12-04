<?php    
session_start();
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
</style>
<?
$appd=$appdate.' '.$appmo.' '.$thiyr;
$appd1=$thiyr.'-'.$appmo.'-'.$appdate;
    print "<font face='TH SarabunPSK'><b>รายชื่อผู้ที่มาตรวจสุขภาพประจำปี $year</b><br>";
	print ".........<input type=button class='forntsarabun' onclick='history.back()' value=' << กลับไป '>";
print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a> ";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" class="textcash" style="border-collapse:collapse">
<tr>
<td width="4%" align="center" class="textcash"><strong>ลำดับ</strong></td>
  <td width="30%" align="center" class="textcash"><strong>หน่วย</strong></td>
<td width="6%" align="center" class="textcash"><strong>ทั้งหมด</strong></td>
<td width="6%" align="center" class="textcash"><strong>มาตรวจ</strong></td>
<td width="10%" align="center" class="textcash"><strong>คิดเป็น %</strong></td>
<td width="2%" align="center" class="textcash"><strong></strong></td>

<td width="7%" align="center" class="textcash"><strong>สัญญาบัตร</strong></td>
<td width="7%" align="center" class="textcash"><strong>ประทวน</strong></td>
<td width="7%" align="center" class="textcash"><strong>ลูกจ้าง</strong></td>
<td width="2%" align="center" class="textcash"><strong></strong></td>
<td width="7%" align="center" class="textcash"><strong>กลุ่มปกติ</strong></td>
<td width="7%" align="center" class="textcash"><strong>กลุ่มเสี่ยง</strong></td>
<td width="7%" align="center" class="textcash"><strong>กลุ่มป่วย</strong></td>
</tr>


<?php
    include("connect.inc");
   $query="SELECT  camp,COUNT(*) AS duplicate FROM chkup_solider  WHERE yearchkup = '$year'   GROUP BY camp HAVING duplicate > 0 ORDER BY camp";
   $result = mysql_query($query);
     $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
	 
	 $numchunyot1='0';
		$numchunyot2='0';
		$numchunyot3='0';
		$dx1='0';
		$dx2='0';
		$dx3='0';
	 
	 
	 
	 $count='0';
	 
	 
	 
$year1='25'.''.$year;	 
	 $query1="SELECT  camp1,COUNT(*) AS duplicate FROM condxofyear_so   WHERE yearcheck = '$year1' and  camp1='$camp'  GROUP BY camp1 HAVING duplicate > 0 ";
   $result1 = mysql_query($query1);
   	list($camp1,$count)=mysql_fetch_array($result1);
	
	
		
		if($count>0){
		
		 $query2="SELECT  chunyot1,COUNT(*) AS duplicate FROM condxofyear_so   WHERE yearcheck = '$year1' and chunyot1='CH01 นายทหารชั้นสัญญาบัตร' and camp1='$camp'  GROUP BY chunyot1 HAVING duplicate > 0 ";
		// echo $query2;
   $result2 = mysql_query($query2);
   	list($chunyot,$numchunyot1)=mysql_fetch_array($result2);


	
	
	
	
	
	 $query3="SELECT  chunyot1,COUNT(*) AS duplicate FROM condxofyear_so   WHERE yearcheck = '$year1' and chunyot1='CH02 นายทหารชั้นประทวน' and camp1='$camp'  GROUP BY chunyot1 HAVING duplicate > 0 ";
		// echo $query2;
   $result3 = mysql_query($query3);
   	list($chunyot,$numchunyot2)=mysql_fetch_array($result3);
		
	
	
	 $query4="SELECT  chunyot1,COUNT(*) AS duplicate FROM condxofyear_so   WHERE yearcheck = '$year1' and chunyot1='CH04 ลูกจ้างประจำ' and camp1='$camp'  GROUP BY chunyot1 HAVING duplicate > 0 ";
		// echo $query2;
   $result4 = mysql_query($query4);
   	list($chunyot,$numchunyot3)=mysql_fetch_array($result4);
		
	
	
	 $query5="SELECT hn FROM condxofyear_so   WHERE yearcheck = '$year1'  and camp1='$camp' and sum1='ปกติ (ไม่พบความเสี่ยง)' and sum2='' and sum3='' and sum4 ='' and  sum5='' ";
		// echo $query2;
   $result5 = mysql_query($query5);
 $dx1 = mysql_num_rows($result5);
	
	
		 $query6="SELECT hn from condxofyear_so   WHERE yearcheck = '$year1'  and camp1='$camp' and (sum2 !='' or sum3 !='' or sum4 !='')  and sum5 =''  ";
		 //echo $query6;
   $result6 = mysql_query($query6);
$dx2= mysql_num_rows($result6);
	
	

	 $query7="SELECT hn FROM condxofyear_so   WHERE yearcheck = '$year1'  and camp1='$camp' and sum5 !=''    ";
		 //echo $query7;
   $result7 = mysql_query($query7);
$dx3= mysql_num_rows($result7);
	
		}else {
			//$duplicate='0';
			$count='0';
		$numchunyot1='0';
		$numchunyot2='0';
		$numchunyot3='0';
		$dx1='0';
		$dx2='0';
		$dx3='0';
		
		
		
		
		
		
		  };
		
		$count_p =number_format(($count*100)/$duplicate);
	
            $n++;
	$duplicateall=$duplicate+$duplicateall;
	$countall=$count+$countall;

	$numchunyot1all=$numchunyot1+$numchunyot1all;
	$numchunyot2all=$numchunyot2+$numchunyot2all;
	$numchunyot3all=$numchunyot3+$numchunyot3all;
	$dx1all=$dx1+$dx1all;
	$dx2all=$dx2+$dx2all;
	$dx3all=$dx3+$dx3all;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td align='center'><font face='TH SarabunPSK'>$n</td>\n".
              "  <td ><font face='TH SarabunPSK'>$camp</td>\n".
         "  <td align='center' ><font face='TH SarabunPSK'>$duplicate </td>\n".
		  "  <td align='center' ><font face='TH SarabunPSK'>$count </td>\n".
		    "  <td align='center' ><font face='TH SarabunPSK'>$count_p %</td>\n".
			   "  <td align='center' ><font face='TH SarabunPSK'></td>\n".
		    "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot1</td>\n".
			  "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot2</td>\n".
			    "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot3</td>\n".
				   "  <td align='center' ><font face='TH SarabunPSK'></td>\n".
				 "  <td align='center' ><font face='TH SarabunPSK'>$dx1</td>\n".
				  "  <td align='center' ><font face='TH SarabunPSK'>$dx2</td>\n".
				   "  <td align='center' ><font face='TH SarabunPSK'>$dx3</td>\n".
		  
               " </tr>\n");
               }
			   	$count_pall=number_format((($countall*100)/$duplicateall),2);
			   
 print (" <tr>\n".
               "  <td align='center'><font face='TH SarabunPSK'></td>\n".
              "  <td ><font face='TH SarabunPSK'>รวม</td>\n".
         "  <td align='center' ><font face='TH SarabunPSK'>$duplicateall </td>\n".
		  "  <td align='center' ><font face='TH SarabunPSK'>$countall </td>\n".
		    "  <td align='center' ><font face='TH SarabunPSK'>$count_pall </td>\n".
			   "  <td align='center' ><font face='TH SarabunPSK'></td>\n".
		    "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot1all</td>\n".
			  "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot2all</td>\n".
			    "  <td align='center' ><font face='TH SarabunPSK'>$numchunyot3all</td>\n".
				   "  <td align='center' ><font face='TH SarabunPSK'></td>\n".
				 "  <td align='center' ><font face='TH SarabunPSK'>$dx1all</td>\n".
				  "  <td align='center' ><font face='TH SarabunPSK'>$dx2all</td>\n".
				   "  <td align='center' ><font face='TH SarabunPSK'>$dx3all</td>\n".
		  
               " </tr>\n");			   


   include("unconnect.inc");

?>

</table>


