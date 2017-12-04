<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนแพทย์ตรวจต่อเดือน เดือน $appd</b>";
	

    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
    include("connect.inc");
	
	
	$query="CREATE TEMPORARY TABLE phardep1 SELECT  *  FROM phardep  WHERE date LIKE '$appd%' and an is null  and cashok is not null  ORDER BY doctor ASC";
   $result = mysql_query($query) or die("CREATE TEMPORARY TABLE phardep fail2");

	
	
	//echo $query;
	
	$sql = "Select doctor,sum(price), date_format(date, '%Y-%m-%d' ) AS date2,count(distinct(hn)) as hnnumf From  phardep1  INNER JOIN inputm ON  phardep1.doctor = inputm.name  AND inputm.report_tnb  =''    group by doctor ORDER by sum(price) ";
$result = Mysql_Query($sql) or die(Mysql_Error());
//echo $sql;

           $aDoctor=array("aDoctor"); 
		   $aDate=array("aDate"); 
		 $x=0;
while(list($doctor,$sumpricefull,$date,$hnnumf) = Mysql_fetch_row($result)){
	
//	echo $doctor,$sumpricefull .'<br>';
	
	//echo $date;
		
             $x++;
             array_push($aDoctor,$doctor); 
			      array_push($aDate,$date); 
               }
/////////นับยาที่ใช้
		 $aPrice=array("aprice"); 
	
		 
		
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>#</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>แพทย์</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>01</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>02</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>03</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>04</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>05</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>06</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>07</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>08</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>09</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>10</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>11</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>12</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>13</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>14</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>15</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>16</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>17</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>18</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>19</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>20</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>21</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>22</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>23</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>24</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>25</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>26</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>27</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>28</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>29</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>30</th>";	
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>31</th>";
	print " <th  bgcolor=FF6699><font face='Angsana New' size='2'>แพทย์</th>";	
	print " <th bgcolor=FF6699><font face='Angsana New' size='2'>จำนวนคน</th>";	
	print " <th bgcolor=FF6699><font face='Angsana New' size='2'>จำนวนเงิน</th>";	

	
//	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>ประเภท</th>";
	print " </tr>";
	$num=0;
	$aPrice=0;
	$sumalldoctor1=0;
	$hnnumfff1=0;

	for ($n=1; $n<=$x; $n++){
		
		
		
		
		
			$query = "SELECT sum(price),date_format(date, '%Y-%m-%d' ) AS date2 ,count(distinct(hn)) as hnnumf FROM phardep1 WHERE date LIKE '$appd%' and  doctor='$aDoctor[$n]' group by date2   ";
			//echo $query;
			
			$result = mysql_query($query) or die("Query failed5");
		
			
			
			
			// $aDoctor[$n]='';
			 $aPrice[$n]=0;
			 $aDate[$n]=0;
			$sumprice01='';
			$sumprice02='';
			$sumprice03='';
			$sumprice04='';
			$sumprice05='';
			$sumprice06='';
			$sumprice07='';
			$sumprice08='';
			$sumprice09='';
			$sumprice10='';
			$sumprice11='';
			$sumprice12='';
			$sumprice13='';
			$sumprice14='';
			$sumprice15='';
			$sumprice16='';
			$sumprice17='';
			$sumprice18='';
			$sumprice19='';
			$sumprice20='';
			$sumprice21='';
			$sumprice22='';
			$sumprice23='';
			$sumprice24='';
			$sumprice25='';
			$sumprice26='';
			$sumprice27='';
			$sumprice28='';
			$sumprice29='';
			$sumprice30='';
			$sumprice31='';
			$sumalldoctor='';
			$hnnumfff='';
			
			 $hnnumf01=''; $hnnumf02=''; $hnnumf03=''; $hnnumf04=''; $hnnumf05=''; $hnnumf06=''; $hnnumf=''; $hnnumf=''; $hnnumf=''; $hnnumf=''; $hnnumf=''; $hnnumf=''; $hnnumf07=''; $hnnumf08=''; $hnnumf09=''; $hnnumf10=''; $hnnumf11=''; $hnnumf12=''; $hnnumf13=''; $hnnumf14=''; $hnnumf15=''; $hnnumf16=''; $hnnumf17=''; $hnnumf18=''; $hnnumf19=''; $hnnumf20=''; $hnnumf21=''; $hnnumf22=''; $hnnumf23=''; $hnnumf24=''; $hnnumf25=''; $hnnumf26=''; $hnnumf27=''; $hnnumf28=''; $hnnumf29=''; $hnnumf30=''; $hnnumf31='';
			 
			 
		   while (list ($sumprice,$date,$hnnumf) = mysql_fetch_row ($result)) {
			   
			
			   	$ddd=substr($date,8,2);
			//echo $ddd;
			
			
			if($ddd=='01'){$sumprice01=$sumprice; $hnnumf01="($hnnumf HN)";};
			if($ddd=='02'){$sumprice02=$sumprice; $hnnumf02="($hnnumf HN)";};
			if($ddd=='03'){$sumprice03=$sumprice;  $hnnumf03="($hnnumf HN)";};
			if($ddd=='04'){$sumprice04=$sumprice;  $hnnumf04="($hnnumf HN)";};
			if($ddd=='05'){$sumprice05=$sumprice;  $hnnumf05="($hnnumf HN)";};
			if($ddd=='06'){$sumprice06=$sumprice;  $hnnumf06="($hnnumf HN)";};
			if($ddd=='07'){$sumprice07=$sumprice;  $hnnumf07="($hnnumf HN)";};
			if($ddd=='08'){$sumprice08=$sumprice;  $hnnumf08="($hnnumf HN)";};
			if($ddd=='09'){$sumprice09=$sumprice;  $hnnumf09="($hnnumf HN)";};
			if($ddd=='10'){$sumprice10=$sumprice;  $hnnumf10="($hnnumf HN)";};
			if($ddd=='11'){$sumprice11=$sumprice;  $hnnumf11="($hnnumf HN)";};
			if($ddd=='12'){$sumprice12=$sumprice;  $hnnumf12="($hnnumf HN)";};
			if($ddd=='13'){$sumprice13=$sumprice;  $hnnumf13="($hnnumf HN)";};
			if($ddd=='14'){$sumprice14=$sumprice;  $hnnumf14="($hnnumf HN)";};
			if($ddd=='15'){$sumprice15=$sumprice;  $hnnumf15="($hnnumf HN)";};
			if($ddd=='16'){$sumprice16=$sumprice;  $hnnumf16="($hnnumf HN)";};
			if($ddd=='17'){$sumprice17=$sumprice;  $hnnumf17="($hnnumf HN)";};
			if($ddd=='18'){$sumprice18=$sumprice;  $hnnumf18="($hnnumf HN)";};
			if($ddd=='19'){$sumprice19=$sumprice;  $hnnumf19="($hnnumf HN)";};
			if($ddd=='20'){$sumprice20=$sumprice;  $hnnumf20="($hnnumf HN)";};
			if($ddd=='21'){$sumprice21=$sumprice;  $hnnumf21="($hnnumf HN)";};
			if($ddd=='22'){$sumprice22=$sumprice;  $hnnumf22="($hnnumf HN)";};
			if($ddd=='23'){$sumprice23=$sumprice;  $hnnumf23="($hnnumf HN)";};
			if($ddd=='24'){$sumprice24=$sumprice;  $hnnumf24="($hnnumf HN)";};
			if($ddd=='25'){$sumprice25=$sumprice;  $hnnumf25="($hnnumf HN)";};
			if($ddd=='26'){$sumprice26=$sumprice;  $hnnumf26="($hnnumf HN)";};
			if($ddd=='27'){$sumprice27=$sumprice;  $hnnumf27="($hnnumf HN)";};
			if($ddd=='28'){$sumprice28=$sumprice;  $hnnumf28="($hnnumf HN)";};
			if($ddd=='29'){$sumprice29=$sumprice;  $hnnumf29="($hnnumf HN)";};
			if($ddd=='30'){$sumprice30=$sumprice;  $hnnumf30="($hnnumf HN)";};
			if($ddd=='31'){$sumprice31=$sumprice;  $hnnumf31="($hnnumf HN)";};
			
			
			
				
		
			$sumalldoctor=$sumalldoctor+$sumprice;
			$hnnumfff=$hnnumfff+$hnnumf;
			
			 $sumalldoctor1=$sumalldoctor1+$sumalldoctor;
			 $hnnumfff1=$hnnumfff1+$hnnumfff;
			 
			 
			
				
				
	/*			

  $sql111 = "Select price From labcare where code='$aCode[$n]' ";
	$result111 = Mysql_Query($sql111);
	list($pricefull) = Mysql_fetch_row($result111);
	*/		   
		   }
		   $num++;
		   
		   $thiyr=substr($aDate[$n],0,4);
		   $appmo=substr($aDate[$n],5,2);
		   $appdate=substr($aDate[$n],8,2);
		   
		   
		    $sumpriceall01=$sumpriceall01+$sumprice01;   
			   $sumpriceall02=$sumpriceall02+$sumprice02;
			   $sumpriceall03=$sumpriceall03+$sumprice03;
			   $sumpriceall04=$sumpriceall04+$sumprice04;
			   $sumpriceall05=$sumpriceall05+$sumprice05;
			   $sumpriceall06=$sumpriceall06+$sumprice06;
			   $sumpriceall07=$sumpriceall07+$sumprice07;
			   $sumpriceall08=$sumpriceall08+$sumprice08;
			   $sumpriceall09=$sumpriceall09+$sumprice09;
			   $sumpriceall10=$sumpriceall10+$sumprice10;
			   $sumpriceall11=$sumpriceall11+$sumprice11;
			   $sumpriceall12=$sumpriceall12+$sumprice12;
			   $sumpriceall13=$sumpriceall13+$sumprice13;
			   $sumpriceall14=$sumpriceall14+$sumprice14;
			   $sumpriceall15=$sumpriceall15+$sumprice15;
			   $sumpriceall16=$sumpriceall16+$sumprice16;
			   $sumpriceall17=$sumpriceall17+$sumprice17;
			   $sumpriceall18=$sumpriceall18+$sumprice18;
			   $sumpriceall19=$sumpriceall19+$sumprice19;
			   $sumpriceall20=$sumpriceall20+$sumprice20;
			   $sumpriceall21=$sumpriceall21+$sumprice21;
			   $sumpriceall22=$sumpriceall22+$sumprice22;
			   $sumpriceall23=$sumpriceall23+$sumprice23;
			   $sumpriceall24=$sumpriceall24+$sumprice24;
			   $sumpriceall25=$sumpriceall25+$sumprice25;
			   $sumpriceall26=$sumpriceall26+$sumprice26;
			   $sumpriceall27=$sumpriceall27+$sumprice27;
			   $sumpriceall28=$sumpriceall28+$sumprice28;
			   $sumpriceall29=$sumpriceall29+$sumprice29;
			   $sumpriceall30=$sumpriceall30+$sumprice30;
			   $sumpriceall31=$sumpriceall31+$sumprice31;  
				
		   
		   $sumalldoctor=number_format($sumalldoctor,0,'.',',');
		     $sumprice01=number_format($sumprice01,0,'.',',');
			 $sumprice02=number_format($sumprice02,0,'.',','); 
			 $sumprice03=number_format($sumprice03,0,'.',','); 
			 $sumprice04=number_format($sumprice04,0,'.',','); 
			 $sumprice05=number_format($sumprice05,0,'.',','); 
			 $sumprice06=number_format($sumprice06,0,'.',','); 
			 $sumprice07=number_format($sumprice07,0,'.',','); 
			 $sumprice08=number_format($sumprice08,0,'.',','); 
			 $sumprice09=number_format($sumprice09,0,'.',','); 
			 $sumprice10=number_format($sumprice10,0,'.',','); 
			 $sumprice11=number_format($sumprice11,0,'.',','); 
			 $sumprice12=number_format($sumprice12,0,'.',','); 
			 $sumprice13=number_format($sumprice13,0,'.',',');
			  $sumprice14=number_format($sumprice14,0,'.',','); 
			  $sumprice15=number_format($sumprice15,0,'.',','); 
			  $sumprice16=number_format($sumprice16,0,'.',','); 
			  $sumprice17=number_format($sumprice17,0,'.',','); 
			  $sumprice18=number_format($sumprice18,0,'.',','); 
			  $sumprice19=number_format($sumprice19,0,'.',','); 
			  $sumprice20=number_format($sumprice20,0,'.',','); 
			  $sumprice21=number_format($sumprice21,0,'.',','); 
			  $sumprice22=number_format($sumprice22,0,'.',','); 
			  $sumprice23=number_format($sumprice23,0,'.',','); 
			  $sumprice24=number_format($sumprice24,0,'.',','); 
			  $sumprice25=number_format($sumprice25,0,'.',','); 
			  $sumprice26=number_format($sumprice26,0,'.',','); 
			  $sumprice27=number_format($sumprice27,0,'.',','); 
			  $sumprice28=number_format($sumprice28,0,'.',','); 
			  $sumprice29=number_format($sumprice29,0,'.',','); 
			  $sumprice30=number_format($sumprice30,0,'.',','); 
			  $sumprice31=number_format($sumprice31,0,'.',',');
			  
			  
		
			  
			  
			  
				
			  
			  
			  if($sumprice01=='0'){$sumprice01='';};
			  if($sumprice02=='0'){$sumprice02='';};
			  if($sumprice03=='0'){$sumprice03='';};
			  if($sumprice04=='0'){$sumprice04='';};
			  if($sumprice05=='0'){$sumprice05='';};
			  if($sumprice06=='0'){$sumprice06='';};
			  if($sumprice07=='0'){$sumprice07='';};
			  if($sumprice08=='0'){$sumprice08='';};
			  if($sumprice09=='0'){$sumprice09='';};
			  if($sumprice10=='0'){$sumprice10='';};
			  if($sumprice11=='0'){$sumprice11='';};
			  if($sumprice12=='0'){$sumprice12='';};
			  if($sumprice13=='0'){$sumprice13='';};
			  if($sumprice14=='0'){$sumprice14='';};
			  if($sumprice15=='0'){$sumprice15='';};
			  if($sumprice16=='0'){$sumprice16='';};
			  if($sumprice17=='0'){$sumprice17='';};
			  if($sumprice18=='0'){$sumprice18='';};
			  if($sumprice19=='0'){$sumprice19='';};
			  if($sumprice20=='0'){$sumprice20='';};
			  if($sumprice21=='0'){$sumprice21='';};
			  if($sumprice22=='0'){$sumprice22='';};
			  if($sumprice23=='0'){$sumprice23='';};
			  if($sumprice24=='0'){$sumprice24='';};
			  if($sumprice25=='0'){$sumprice25='';};
			  if($sumprice26=='0'){$sumprice26='';};
			  if($sumprice27=='0'){$sumprice27='';};
			  if($sumprice28=='0'){$sumprice28='';};
			  if($sumprice29=='0'){$sumprice29='';};
			  if($sumprice30=='0'){$sumprice30='';};
			  if($sumprice31=='0'){$sumprice31='';};
			
		//  $sumprice =number_format($sumprice01 ,2,'.',',');$sumprice02 =number_format($sumprice02 ,2,'.',',');$sumprice03 =number_format($sumprice03 ,2,'.',',');$sumprice04 =number_format($sumprice04 ,2,'.',',');$sumprice05 =number_format($sumprice05 ,2,'.',',');$sumprice06 =number_format($sumprice06 ,2,'.',',');$sumprice07 =number_format($sumprice07 ,2,'.',',');$sumprice08 =number_format($sumprice08 ,2,'.',',');$sumprice09 =number_format($sumprice09 ,2,'.',',');$sumprice10 =number_format($sumprice10 ,2,'.',',');$sumprice11 =number_format($sumprice11 ,2,'.',',');$sumprice12 =number_format($sumprice12 ,2,'.',',');$sumprice13 =number_format($sumprice13 ,2,'.',',');$sumprice14 =number_format($sumprice14 ,2,'.',',');$sumprice15 =number_format($sumprice15 ,2,'.',',');$sumprice16 =number_format($sumprice16 ,2,'.',',');$sumprice17 =number_format($sumprice17,2,'.',',');$sumprice18 =number_format($sumprice18 ,2,'.',',');$sumprice19 =number_format($sumprice19 ,2,'.',',');$sumprice20 =number_format($sumprice20 ,2,'.',',');$sumprice21 =number_format($sumprice21 ,2,'.',',');$sumprice22 =number_format($sumprice22 ,2,'.',',');$sumprice23 =number_format($sumprice23 ,2,'.',',');$sumprice24 =number_format($sumprice24 ,2,'.',',');$sumprice25 =number_format($sumprice25,2,'.',',');$sumprice26 =number_format($sumprice26 ,2,'.',',');$sumprice27 =number_format($sumprice27,2,'.',',');$sumprice28 =number_format($sumprice28 ,2,'.',',');$sumprice29 =number_format($sumprice29 ,2,'.',',');$sumprice30 =number_format($sumprice30 ,2,'.',',');$sumprice31 =number_format($sumprice31 ,2,'.',',');
		   
		   
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3 align=center><font face='Angsana New' size='2'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3 align=center><font face='Angsana New' size='2'>$aDoctor[$n]</td>\n".
		   	
		     "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice01 <br>$hnnumf01</td>\n". 
			 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice02<br>$hnnumf02</td>\n". 
			 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice03<br>$hnnumf03</td>\n". 
			 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice04<br>$hnnumf04</td>\n".
			  "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice05<br>$hnnumf05</td>\n". 
			  "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice06<br>$hnnumf06</td>\n".
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice07<br>$hnnumf07</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice08<br>$hnnumf08</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice09<br>$hnnumf09</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice10<br>$hnnumf10</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice11<br>$hnnumf11</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice12<br>$hnnumf12</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice13<br>$hnnumf13</td>\n". 
			   "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice14<br>$hnnumf14</td>\n".
			    "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice15<br>$hnnumf15</td>\n". 
				"  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice16<br>$hnnumf16</td>\n". 
				"  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice17<br>$hnnumf17</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice18<br>$hnnumf18</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice19<br>$hnnumf19</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice20<br>$hnnumf20</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice21<br>$hnnumf21</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice22<br>$hnnumf22</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice23<br>$hnnumf23</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice24<br>$hnnumf24</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice25<br>$hnnumf25</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice26<br>$hnnumf26</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice27<br>$hnnumf27</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice28<br>$hnnumf28</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice29<br>$hnnumf29</td>\n". 
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice30<br>$hnnumf30</td>\n".
				 "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$sumprice31<br>$hnnumf31</td>\n". 
				   "  <td BGCOLOR=FF6699 align=center><font face='Angsana New' size='2'>$aDoctor[$n]</td>\n".
				 "  <td  bgcolor=FF6699 align=center><font face='Angsana New' size='2'>$hnnumfff <br>HN</td>\n".
				 "  <td  bgcolor=FF6699 align=center><font face='Angsana New' size='2'>$sumalldoctor</td>\n".
				
			 
			   " </tr>\n");
			   
		 
			
	}
	$nYprinet=number_format($nYprinet,2,'.',',');
	$nNprinet=number_format($nNprinet,2,'.',',');
	$nTotalpri=number_format($nTotalpri,2,'.',',');
	$aPrice1t =number_format($aPrice1t ,2,'.',',');
	$aPrice2t =number_format($aPrice2t ,2,'.',',');
	$sumalldoctor1 =number_format($sumalldoctor1,2,'.',',');
	
	
		   $sumpriceall01=number_format($sumpriceall01,0,'.',','); 
		   $sumpriceall02=number_format($sumpriceall02,0,'.',','); 
		   $sumpriceall03=number_format($sumpriceall03,0,'.',','); 
		   $sumpriceall04=number_format($sumpriceall04,0,'.',','); 
		   $sumpriceall05=number_format($sumpriceall05,0,'.',','); 
		   $sumpriceall06=number_format($sumpriceall06,0,'.',','); 
		   $sumpriceall07=number_format($sumpriceall07,0,'.',','); 
		   $sumpriceall08=number_format($sumpriceall08,0,'.',','); 
		   $sumpriceall09=number_format($sumpriceall09,0,'.',','); 
		   $sumpriceall10=number_format($sumpriceall10,0,'.',','); 
		   $sumpriceall11=number_format($sumpriceall11,0,'.',','); 
		   $sumpriceall12=number_format($sumpriceall12,0,'.',','); 
		   $sumpriceall13=number_format($sumpriceall13,0,'.',','); 
		   $sumpriceall14=number_format($sumpriceall14,0,'.',','); 
		   $sumpriceall15=number_format($sumpriceall15,0,'.',','); 
		   $sumpriceall16=number_format($sumpriceall16,0,'.',','); 
		   $sumpriceall17=number_format($sumpriceall17,0,'.',','); 
		   $sumpriceall18=number_format($sumpriceall18,0,'.',','); 
		   $sumpriceall19=number_format($sumpriceall19,0,'.',','); 
		   $sumpriceall20=number_format($sumpriceall20,0,'.',','); 
		   $sumpriceall21=number_format($sumpriceall21,0,'.',','); 
		   $sumpriceall22=number_format($sumpriceall22,0,'.',','); 
		   $sumpriceall23=number_format($sumpriceall23,0,'.',','); 
		   $sumpriceall24=number_format($sumpriceall24,0,'.',','); 
		   $sumpriceall25=number_format($sumpriceall25,0,'.',','); 
		   $sumpriceall26=number_format($sumpriceall26,0,'.',','); 
		   $sumpriceall27=number_format($sumpriceall27,0,'.',','); 
		   $sumpriceall28=number_format($sumpriceall28,0,'.',',');
		   $sumpriceall29=number_format($sumpriceall29,0,'.',','); 
		   $sumpriceall30=number_format($sumpriceall30,0,'.',',');
		   $sumpriceall31=number_format($sumpriceall31,0,'.',',');
		   
		   
		   
			  if($sumpriceall01=='0'){$sumpriceall01='';}; 
			  if($sumpriceall02=='0'){$sumpriceall02='';}; 
			  if($sumpriceall03=='0'){$sumpriceall03='';}; 
			  if($sumpriceall04=='0'){$sumpriceall04='';}; 
			  if($sumpriceall05=='0'){$sumpriceall05='';}; 
			  if($sumpriceall06=='0'){$sumpriceall06='';}; 
			  if($sumpriceall07=='0'){$sumpriceall07='';}; 
			  if($sumpriceall08=='0'){$sumpriceall08='';}; 
			  if($sumpriceall09=='0'){$sumpriceall09='';}; 
			  if($sumpriceall10=='0'){$sumpriceall10='';}; 
			  if($sumpriceall11=='0'){$sumpriceall11='';}; 
			  if($sumpriceall12=='0'){$sumpriceall12='';}; 
			  if($sumpriceall13=='0'){$sumpriceall13='';}; 
			  if($sumpriceall14=='0'){$sumpriceall14='';}; 
			  if($sumpriceall15=='0'){$sumpriceall15='';}; 
			  if($sumpriceall16=='0'){$sumpriceall16='';}; 
			  if($sumpriceall17=='0'){$sumpriceall17='';}; 
			  if($sumpriceall18=='0'){$sumpriceall18='';}; 
			  if($sumpriceall19=='0'){$sumpriceall19='';}; 
			  if($sumpriceall20=='0'){$sumpriceall20='';};
			    if($sumpriceall21=='0'){$sumpriceall21='';};  
				if($sumpriceall22=='0'){$sumpriceall22='';};  
				if($sumpriceall23=='0'){$sumpriceall23='';};  
				if($sumpriceall24=='0'){$sumpriceall24='';};  
				if($sumpriceall25=='0'){$sumpriceall25='';};  
				if($sumpriceall26=='0'){$sumpriceall26='';};  
				if($sumpriceall27=='0'){$sumpriceall27='';};  
				if($sumpriceall28=='0'){$sumpriceall28='';};  
				if($sumpriceall29=='0'){$sumpriceall29='';};  
				if($sumpriceall30=='0'){$sumpriceall30='';};
				if($sumpriceall31=='0'){$sumpriceall31='';};
	

			   
		   print (" <tr>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> </td>\n".
		    "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> <center>รวมเงินทั้งสิ้น </center></td>\n".
			
			 


           "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall01</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall02</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall03</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall04</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall05</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall06</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall07</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall08</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall09</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall10</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall11</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall12</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall13</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall14</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall15</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall16</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall17</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall18</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall19</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall20</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall21</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall22</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall23</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall24</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall25</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall26</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall27</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall28</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall29</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall30</b></td>\n".
		              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumpriceall31</b></td>\n".	
					   "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b><center>สรุป<center></b></td>\n".	             
					  "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><center><b>$hnnumfff1<br>HN</b></center></td>\n".	
    	              "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$sumalldoctor1</b></td>\n".
		   
	   
		   
	           " </tr>\n");

	print "</table>";
	
	/*
	 //$query1 = "SELECT DISTINCT hn FROM lbperday1 where an = '' ";
   // $result1 = mysql_query($query1) or die("Query failed8");
		$num1=mysql_num_rows($result1);
		
			// $query2 = "SELECT DISTINCT an FROM lbperday1 where an != ''  ";
    $result2 = mysql_query($query2) or die("Query failed8");
		$num2=mysql_num_rows($result2);
	
	print "<table>";
	print "<tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>จำนวนผู้ป่วยนอก/HN</th>";
	print " <th  bgcolor=CCFF00><font face='Angsana New' size='2'>จำนวนผู้ป่วยใน/AN</th>";
	print "<tr>"; 
	print "<tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>$num1</th>";
	print " <th bgcolor=CCFF00><font face='Angsana New' size='2'>$num2</th>";
	print "<tr>"; 
	print "</table>";
*/
 //   print "&nbsp;&nbsp;<a target=_self  href='ptperday_tnb.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

   include("unconnect.inc");
?>
