<?php
session_start();
include("connect.inc");



?>
<html>
<head>
<title>รายงานสรุปยอดเวร</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</head>
<body>

<?php
	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		$select_day2 = (date("Y",mktime(0,0,0,date("m"),date("d")+1,date("Y")))+543).date("-m-d",mktime(0,0,0,date("m"),date("d")+1,date("Y")));

		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
	
	$_SESSION["name_trauma_word"] = "concisely_trun".$day_now.$month_now.$year_now;
	
?>
<SCRIPT LANGUAGE="JavaScript">

	function wprint(){
		document.getElementById("form_01").style.display = 'none';
		window.print();

	}

</SCRIPT>
	<TABLE id="form_01">
	<TR>
		<TD>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<p>วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='4' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'></font></p>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<input type='submit' name="submit" value='     ตกลง     ' >&nbsp;&nbsp;&nbsp; <INPUT TYPE="button" value="Print" onClick="wprint();">
	&nbsp;&nbsp;&nbsp; <INPUT TYPE="button" value="Word" onClick="window.open('trauma_word.php?file_name=<?php echo $_SESSION["name_trauma_word"];?>');">

	</form>
	</TD>
	</TR>
	</TABLE>


<TABLE>
<TR align="center">
	<TD>เช้า</TD>
	<TD>บ่าย</TD>
	<TD>ดึก</TD>
</TR>
<TR>
	<TD>
	<!-- เช้า -->
	<?php

$sql = "Select row_id, hn, list_ptright,  type_wounded, type_wounded2, cure, trauma, obs From trauma where date_in = '".$select_day."' AND ( time_in >= '07:31:00' AND time_in < '15:31:00')";	

$result = Mysql_Query($sql);
$sum_ptright = array();
$sum_ptright2 = array();
$sum_type_wounded = array();
$Observe = 0;
$v=0;
$m=0;
$ekg=0;
$dtx=0;
$sum_labcare=0;
$admit=0;
$refer=0;
$no=0;
$trauma=0;
$ds = 0;




while($arr = Mysql_fetch_assoc($result)){
	
	if($arr["list_ptright"] != ""){
		$sum_ptright[$arr["list_ptright"]]++;
			switch($arr["cure"]){
				case "admit" : $sum_ptright2["A"][$arr["list_ptright"]]++; break;
				case "refer" : $sum_ptright2["R"][$arr["list_ptright"]]++; break;
			}
	}

	if($arr["type_wounded"] != ""){
		if($arr["type_wounded2"] == "" ){
			$sum_type_wounded[$arr["type_wounded"]]++;
		}else{
			$sum_type_wounded[$arr["type_wounded2"]]++;
		}
		
	}
	
	if($arr["obs"] == "1"){
		$Observe++;
	}
	
	if($arr["trauma"] == "trauma"){
		$trauma++;
		$sum_ptright2["T"][$arr["list_ptright"]]++;
	}

	switch($arr["cure"]){
		case "admit":  $admit++; break;
		case "refer":  $refer++; break;
		case "no":  $no++; break;

	}

		$sql = "Select lst_labcare, amount From trauma_lst_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND lst_labcare != '' AND lst_labcare != 'L01' ";
		$result2 = Mysql_Query($sql);
		while($arr2 = Mysql_fetch_assoc($result2)){
			switch($arr2["lst_labcare"]){
				//case "L30":  $v = $v+$arr2["amount"]; break;
				//case "L29":  $m = $m+$arr2["amount"]; break;
				case "L06":  $ekg = $ekg+$arr2["amount"]; break;
				case "L15":  $dtx = $dtx+$arr2["amount"]; break;
			}
			$sum_labcare = $sum_labcare+$arr2["amount"];
		}

		
		$sql = "Select sum(amount) as amount2 From trauma_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND labcare != ''  ";
		$result2 = Mysql_Query($sql);
		list($sum) = Mysql_fetch_row($result2);
		$sum_labcare = $sum_labcare+$sum;

}

$sql = "Select count(hn) From trauma_ds where ( thidate between '".$select_day." 07:31:00' AND '".$select_day." 15:30:59' ) AND type = 'P' ";

list($ds) = mysql_fetch_row(Mysql_Query($sql));

$inject = array();
$sql = "Select type, count(distinct hn) From trauma_inject   where ( thidate between '".$select_day." 07:31:00' AND '".$select_day." 15:30:59' ) AND type in ('V','M','SC') group by type ";

$result = Mysql_Query($sql);
while(list($type, $count) = mysql_fetch_row($result)){
	$inject[$type] = $count;
}

?>
<TABLE width="300" border="1" bordercolor="#000000" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="120" colspan="2">สิทธิ์</TD>
	<TD width="10">A</TD>
	<TD width="10">R</TD>
	<TD width="10">T</TD>
	<TD width="58">รวม</TD>
	<TD width="78">ประเภท</TD>
</TR>
<TR>
	<TD rowspan="3"> ทหาร</TD>
	<TD>น <?php echo $sum_ptright["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P02"];?></TD>
	<TD rowspan="3" align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]);?></TD>
	<TD>1= <?php echo $sum_type_wounded["1"];?></TD>
</TR>
<TR>
	<TD>นส <?php echo $sum_ptright["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P03"];?></TD>
	<TD>2= <?php echo $sum_type_wounded["2"];?></TD>
</TR>
<TR>
	<TD>พลฯ <?php echo $sum_ptright["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P04"];?></TD>
	<TD>3= <?php echo $sum_type_wounded["3"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">ครอบครัว</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P05"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P05"];?>&nbsp;</TD>
	<TD>4= <?php echo $sum_type_wounded["4"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.ต้น</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P06"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P06"];?>&nbsp;</TD>
	<TD>5= <?php echo $sum_type_wounded["5"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P07"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P07"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">ประกันสังคม</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P08"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P08"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาท</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P09"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P09"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาทฉุกเฉิน</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P10"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P10"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">พรบ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P11"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P11"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">กท.44</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P12"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P12"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">รวม</TD>
	<TD align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]+$sum_ptright["P05"]+$sum_ptright["P06"]+$sum_ptright["P07"]+$sum_ptright["P08"]+$sum_ptright["P09"]+$sum_ptright["P10"]+$sum_ptright["P11"]+$sum_ptright["P12"])?></TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">D/S&nbsp;<?php echo $ds;?>&nbsp;&nbsp;&nbsp;Observe <?php echo $Observe;?></TD>
	<TD colspan="2">Admit <?php echo $admit;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">ฉีดยา&nbsp;( V=<?php echo $inject["V"];?> , M=<?php echo $inject["M"];?> , SC=<?php echo $inject["SC"];?>)</TD>
	<TD colspan="2">อุบัติเหตุ <?php echo $trauma;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">EKG <?php echo $ekg;?> ,DTX <?php echo $dtx;?></TD>
	<TD colspan="2">Refer <?php echo $refer;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">หัตถการ <?php echo $sum_labcare;?></TD>
	<TD colspan="2">ไม่รอรับบริการ <?php echo $no;?></TD>
</TR>
</TABLE>
	<!--End เช้า  -->
	</TD>
	<TD><!-- บ่าย -->
	<?php

$sql = "Select row_id, hn, list_ptright,  type_wounded, type_wounded2, cure, trauma, obs From trauma where date_in = '".$select_day."' AND ( time_in >= '15:31:00' AND time_in < '23:31:00')";	

$result = Mysql_Query($sql);
$sum_ptright = array();
$sum_ptright2 = array();
$sum_type_wounded = array();
$Observe = 0;
$v=0;
$m=0;
$ekg=0;
$dtx=0;
$sum_labcare=0;
$admit=0;
$refer=0;
$no=0;
$trauma=0;
$ds=0;


while($arr = Mysql_fetch_assoc($result)){
	if($arr["list_ptright"] != ""){
		$sum_ptright[$arr["list_ptright"]]++;
		switch($arr["cure"]){
				case "admit" : $sum_ptright2["A"][$arr["list_ptright"]]++; break;
				case "refer" : $sum_ptright2["R"][$arr["list_ptright"]]++; break;
			}
		
	}
	

	if($arr["type_wounded"] != ""){

		if($arr["type_wounded2"] == "" ){
			$sum_type_wounded[$arr["type_wounded"]]++;
		}else{
			$sum_type_wounded[$arr["type_wounded2"]]++;
		}
		
	}
	
	if($arr["obs"] == "1"){
		$Observe++;
	}
	
	if($arr["trauma"] == "trauma"){
		$trauma++;
		$sum_ptright2["T"][$arr["list_ptright"]]++;
	}

	switch($arr["cure"]){
		case "admit":  $admit++; break;
		case "refer":  $refer++; break;
		case "no":  $no++; break;

	}

		$sql = "Select lst_labcare, amount From trauma_lst_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND lst_labcare != ''  AND lst_labcare != 'L01' ";
		$result2 = Mysql_Query($sql);
		while($arr2 = Mysql_fetch_assoc($result2)){
			switch($arr2["lst_labcare"]){
				//case "L30":  $v = $v+$arr2["amount"]; break;
				//case "L29":  $m = $m+$arr2["amount"]; break;
				case "L06":  $ekg = $ekg+$arr2["amount"]; break;
				case "L15":  $dtx = $dtx+$arr2["amount"]; break;
			}
			$sum_labcare = $sum_labcare+$arr2["amount"];
		}

		
		$sql = "Select sum(amount) as amount2 From trauma_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND labcare != ''  ";
		$result2 = Mysql_Query($sql);
		list($sum) = Mysql_fetch_row($result2);
		$sum_labcare = $sum_labcare+$sum;

}

$sql = "Select count(hn) From trauma_ds where ( thidate between '".$select_day." 15:31:00' AND '".$select_day." 23:30:59' )  AND type = 'P' ";
list($ds) = mysql_fetch_row(Mysql_Query($sql));

$inject = array();
$sql = "Select type, count(distinct hn) From trauma_inject   where ( thidate between '".$select_day." 15:31:00' AND '".$select_day." 23:30:59' ) AND type in ('V','M','SC') group by type ";
$result = Mysql_Query($sql);
while(list($type, $count) = mysql_fetch_row($result)){
	$inject[$type] = $count;
}

	?>
	<TABLE width="300" border="1" bordercolor="#000000" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="120" colspan="2">สิทธิ์</TD>
	<TD width="10">A</TD>
	<TD width="10">R</TD>
	<TD width="10">T</TD>
	<TD width="58">รวม</TD>
	<TD width="78">ประเภท</TD>
</TR>
<TR>
	<TD rowspan="3"> ทหาร</TD>
	<TD>น <?php echo $sum_ptright["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P02"];?></TD>
	<TD rowspan="3" align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]);?></TD>
	<TD>1= <?php echo $sum_type_wounded["1"];?></TD>
</TR>
<TR>
	<TD>นส <?php echo $sum_ptright["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P03"];?></TD>
	<TD>2= <?php echo $sum_type_wounded["2"];?></TD>
</TR>
<TR>
	<TD>พลฯ <?php echo $sum_ptright["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P04"];?></TD>
	<TD>3= <?php echo $sum_type_wounded["3"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">ครอบครัว</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P05"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P05"];?>&nbsp;</TD>
	<TD>4= <?php echo $sum_type_wounded["4"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.ต้น</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P06"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P06"];?>&nbsp;</TD>
	<TD>5= <?php echo $sum_type_wounded["5"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P07"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P07"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">ประกันสังคม</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P08"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P08"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาท</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P09"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P09"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาทฉุกเฉิน</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P10"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P10"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">พรบ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P11"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P11"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">กท.44</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P12"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P12"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">รวม</TD>
	<TD align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]+$sum_ptright["P05"]+$sum_ptright["P06"]+$sum_ptright["P07"]+$sum_ptright["P08"]+$sum_ptright["P09"]+$sum_ptright["P10"]+$sum_ptright["P11"]+$sum_ptright["P12"])?></TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">D/S&nbsp;<?php echo $ds;?>&nbsp;&nbsp;&nbsp;Observe <?php echo $Observe;?></TD>
	<TD colspan="2">Admit <?php echo $admit;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">ฉีดยา&nbsp;( V=<?php echo $inject["V"];?> , M=<?php echo $inject["M"];?> , SC=<?php echo $inject["SC"];?>)</TD>
	<TD colspan="2">อุบัติเหตุ <?php echo $trauma;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">EKG <?php echo $ekg;?> ,DTX <?php echo $dtx;?></TD>
	<TD colspan="2">Refer <?php echo $refer;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">หัตถการ <?php echo $sum_labcare;?></TD>
	<TD colspan="2">ไม่รอรับบริการ <?php echo $no;?></TD>
</TR>
</TABLE>
	<!--End บ่าย  --></TD>
	<TD>
	<!-- ดึก -->
	<?php

$sql = "Select row_id, hn, list_ptright,  type_wounded, type_wounded2, cure, trauma, obs From trauma where (date_in = '".$select_day2."' AND ( time_in >= '00:00:00' AND time_in <= '07:30:59')) OR (date_in = '".$select_day."' AND ( time_in >= '23:31:00' AND time_in <= '23:59:59')) ";	

$result = Mysql_Query($sql);
$sum_ptright = array();
$sum_ptright2 = array();
$sum_type_wounded = array();
$Observe = 0;
$v=0;
$m=0;
$ekg=0;
$dtx=0;
$sum_labcare=0;
$admit=0;
$refer=0;
$no=0;
$trauma=0;
$ds=0;


while($arr = Mysql_fetch_assoc($result)){
	if($arr["list_ptright"] != ""){
		$sum_ptright[$arr["list_ptright"]]++;
		switch($arr["cure"]){
				case "admit" : $sum_ptright2["A"][$arr["list_ptright"]]++; break;
				case "refer" : $sum_ptright2["R"][$arr["list_ptright"]]++; break;
			}
	}

	if($arr["type_wounded"] != ""){
		if($arr["type_wounded2"] == "" ){
			$sum_type_wounded[$arr["type_wounded"]]++;
		}else{
			$sum_type_wounded[$arr["type_wounded2"]]++;
		}
		
	}
	
	if($arr["obs"] == "1"){
		$Observe++;
	}
	
	if($arr["trauma"] == "trauma"){
		$trauma++;
		$sum_ptright2["T"][$arr["list_ptright"]]++;
	}

	switch($arr["cure"]){
		case "admit":  $admit++; break;
		case "refer":  $refer++; break;
		case "no":  $no++; break;

	}

		$sql = "Select lst_labcare, amount From trauma_lst_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND lst_labcare != ''  AND lst_labcare != 'L01' ";
		$result2 = Mysql_Query($sql);
		while($arr2 = Mysql_fetch_assoc($result2)){
			switch($arr2["lst_labcare"]){
				//case "L30":  $v = $v+$arr2["amount"]; break;
				//case "L29":  $m = $m+$arr2["amount"]; break;
				case "L06":  $ekg = $ekg+$arr2["amount"]; break;
				case "L15":  $dtx = $dtx+$arr2["amount"]; break;
			}
			$sum_labcare = $sum_labcare+$arr2["amount"];
		}

		
		$sql = "Select sum(amount) as amount2 From trauma_labcare where for_id = '".$arr["row_id"]."' AND  hn = '".$arr["hn"]."' AND labcare != ''  ";
		$result2 = Mysql_Query($sql);
		list($sum) = Mysql_fetch_row($result2);
		$sum_labcare = $sum_labcare+$sum;

}

$sql = "Select count(hn) From trauma_ds where ( thidate between '".$select_day." 23:31:00' AND '".$select_day." 23:59:59' )  AND type = 'P' ";
list($ds) = mysql_fetch_row(Mysql_Query($sql));

$sql = "Select count(hn) From trauma_ds where ( thidate between '".$select_day2." 00:00:00' AND '".$select_day2." 07:30:59' )  AND type = 'P' ";
list($ds2) = mysql_fetch_row(Mysql_Query($sql));

$ds = $ds+$ds2;

$inject = array();
$sql = "Select type, count(distinct hn) From trauma_inject   where (( thidate between '".$select_day." 23:31:00' AND '".$select_day." 23:59:59' ) OR ( thidate between '".$select_day2." 00:00:00' AND '".$select_day2." 07:30:59' ) ) AND type in ('V','M','SC') group by type ";
$result = Mysql_Query($sql);
while(list($type, $count) = mysql_fetch_row($result)){
	$inject[$type] = $count;
}

	?>
	<TABLE width="300" border="1" bordercolor="#000000" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="120" colspan="2">สิทธิ์</TD>
	<TD width="10">A</TD>
	<TD width="10">R</TD>
	<TD width="10">T</TD>
	<TD width="58">รวม</TD>
	<TD width="78">ประเภท</TD>
</TR>
<TR>
	<TD rowspan="3"> ทหาร</TD>
	<TD>น <?php echo $sum_ptright["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P02"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P02"];?></TD>
	<TD rowspan="3" align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]);?></TD>
	<TD>1= <?php echo $sum_type_wounded["1"];?></TD>
</TR>
<TR>
	<TD>นส <?php echo $sum_ptright["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P03"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P03"];?></TD>
	<TD>2= <?php echo $sum_type_wounded["2"];?></TD>
</TR>
<TR>
	<TD>พลฯ <?php echo $sum_ptright["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P04"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P04"];?></TD>
	<TD>3= <?php echo $sum_type_wounded["3"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">ครอบครัว</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P05"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P05"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P05"];?>&nbsp;</TD>
	<TD>4= <?php echo $sum_type_wounded["4"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.ต้น</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P06"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P06"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P06"];?>&nbsp;</TD>
	<TD>5= <?php echo $sum_type_wounded["5"];?></TD>
</TR>
<TR>
	<TD align="center" colspan="2">พ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P07"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P07"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P07"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">ประกันสังคม</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P08"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P08"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P08"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาท</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P09"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P09"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P09"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">30บาทฉุกเฉิน</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P10"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P10"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P10"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">พรบ.</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P11"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P11"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P11"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="2">กท.44</TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["A"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["R"]["P12"];?></TD>
	<TD width="10">&nbsp;<?php echo $sum_ptright2["T"]["P12"];?></TD>
	<TD align="center"><?php echo $sum_ptright["P12"];?>&nbsp;</TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">รวม</TD>
	<TD align="center"><?php echo ($sum_ptright["P02"]+$sum_ptright["P03"]+$sum_ptright["P04"]+$sum_ptright["P05"]+$sum_ptright["P06"]+$sum_ptright["P07"]+$sum_ptright["P08"]+$sum_ptright["P09"]+$sum_ptright["P10"]+$sum_ptright["P11"]+$sum_ptright["P12"])?></TD>
	
</TR>
<TR>
	<TD align="center" colspan="5">D/S&nbsp;<?php echo $ds;?>&nbsp;&nbsp;&nbsp;Observe <?php echo $Observe;?></TD>
	<TD colspan="2">Admit <?php echo $admit;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">ฉีดยา&nbsp;( V=<?php echo $inject["V"];?> , M=<?php echo $inject["M"];?> , SC=<?php echo $inject["SC"];?>)</TD>
	<TD colspan="2">อุบัติเหตุ <?php echo $trauma;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">EKG <?php echo $ekg;?> ,DTX <?php echo $dtx;?></TD>
	<TD colspan="2">Refer <?php echo $refer;?></TD>
</TR>
<TR>
	<TD align="center" colspan="5">หัตถการ <?php echo $sum_labcare;?></TD>
	<TD colspan="2">ไม่รอรับบริการ <?php echo $no;?></TD>
</TR>
</TABLE>
	<!--End ดึก  -->
	</TD>
</TR>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>