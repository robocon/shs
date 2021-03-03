<?php
session_start();
include("connect.inc");


function calcage($birth){

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

?>
<html>
<head>
<title>ยืนยันการฉีดยา</title>
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
$url = "";
if($_GET['forOpd']==1)
{
	$url = "?forOpd=1";
}
?>
<A HREF="report_inject.php<?=$url;?>" target="_blank">รายชื่อผู้มาฉีดยาที่ยืนยันแล้ว</A>
<?php
if(isset($_POST["hn"]) && $_POST["hn"] != "")
{
	for($i=1;$i<$_POST["max"];$i++)
	{
		list($hn,$datetime) = explode("[]",$_POST["list".$i]);
		$sql = "Select CONCAT(yot,' ',name,' ',surname) as full_name, ptright, dbirth From opcard where hn = '".$hn."' limit 1 ";
		list($ptname,$ptright, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));
		$age = calcage($dbirth);
		if($datetime != "")
		{ 
			$opd = NULL;
			if($_SESSION['smenucode']=="ADMMAINOPD")
			{
				$opd = "'1'";
			}
			$sql = "INSERT INTO `trauma_inject` (  `thidate` , `thidate_regis` , `hn` , `ptname` , `age` , `ptright`, `type`, `drugcode`, `tradname`, `number` ,`opd` ) VALUES ( '".(date("Y")+543).date("-m-d H:i:s")."', '".$datetime."', '".$hn."', '".$ptname."', '".$age."', '".$ptright."', '".$_POST["type".$i]."', '".$_POST["drugcode".$i]."', '".$_POST["tradname".$i]."', '".$_POST["number".$i]."', $opd);";
			Mysql_Query($sql);
		}
	}
	echo "<meta http-equiv=\"REFRESH\" content=\"0;url=confirn_inject.php\">";
	exit();
}

	


	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='confirn_inject.php'>
	<TABLE id="form_01">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</form>

<SCRIPT LANGUAGE="JavaScript">

function checkForm(){

	if(confirm("ผู้ป่วยได้มาฉีดยาจริงใช่หรือไม่?"))
		return true;
	else
		return false;

}

</SCRIPT>
<TABLE width="600" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000">
<TR align="center">
	<TD>#</TD>
	<TD>HN</TD>
	<TD>ยาที่รับ</TD>
	<TD>เวลาจ่ายยา</TD>
	<TD>&nbsp;</TD>
	<TD>&nbsp;</TD>
</TR>
<?php
		$whereOpd = "";
		if($_SESSION['smenucode']=="ADMMAINOPD")
		{
			$whereOpd = " AND `opd` = 1 ";
		}

		$list_count = array();
		$sql = " Select thidate_regis, hn From `trauma_inject` where thidate_regis like '".$select_day."%' $whereOpd ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		while(list($thidate_regis, $hn) = Mysql_fetch_row($result)){
			$list_count[$thidate_regis.$hn] = true;
		}


		//$sql = "Select  distinct a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name , right(a.date,8), b.ptright, a.date, b.dbirth, a.slcode From drugrx2 as a, opcard as b  where a.hn = b.hn Order by date DESC ";

		$sql = "Select  a.hn,  right(a.date,8), a.date,  a.slcode, a.tradname, a.drugcode From drugrx as a where date like '".$select_day."%' AND left(drugcode,1) in ('2','0')  AND right(left(drugcode,2),1) not in ('0','1','2','3','4','5','6','7','8','9') AND drugcode not in ('2SYNV*@','2GOON','2HYRU') AND (an is null OR an = '' ) Group by a.hn, a.slcode, a.drugcode Having sum(a.amount) > 0 Order by date DESC  ";

		$echoka = "";
		$echoka1 = "";
		$i=1;

		$result = Mysql_Query($sql) or die(Mysql_Error());

		echo "<FORM METHOD=POST ACTION=\"confirn_inject.php\" Onsubmit=\"return checkForm();\">";
		//while(list( $hn, $ptname, $time, $ptright, $date, $dbirth, $slcode) = Mysql_fetch_row($result)){
		
		while(list( $hn,  $time,  $date,  $slcode, $tradname, $drugcode) = Mysql_fetch_row($result)){
		
		if (array_key_exists($date.$hn ,   $list_count))
			continue;

		$slcode = strtoupper($slcode);
		
		$lenght1 = strlen($slcode);

		$lenght2 = strlen(str_replace("IV","",$slcode));
		$lenght3 = strlen(str_replace("IM","",$slcode));
		$lenght4 = strlen(str_replace("SC","",$slcode));

		if($lenght1 != $lenght2){
			$selected1 = " Selected ";
		}else if($lenght1 != $lenght3){
			$selected2 = " Selected ";
		}else if($lenght1 != $lenght4){
			$selected3 = " Selected ";
		}

		echo "
		<TR>
						<TD align=\"center\"><INPUT TYPE=\"checkbox\" NAME=\"list".$i."\" value=\"".$hn."[]".$date."\"></TD>
						<TD align=\"center\">".$hn."</TD>
						<TD align=\"center\">".$tradname."</TD>
						<TD align=\"center\">&nbsp;".$time."</TD>
						<TD align=\"center\">
							วิธีฉีด <SELECT NAME=\"type".$i."\">
								<Option value=\"V\" ".$selected1.">V</Option>
								<Option value=\"M\" ".$selected2.">M</Option>
								<Option value=\"SC\" ".$selected3.">SC</Option>
								<Option value=\"NO\" >ไม่นับ</Option>
							</SELECT>&nbsp;&nbsp;
		<INPUT TYPE=\"hidden\" name=\"drugcode".$i."\" value=\"".$drugcode."\">
		<INPUT TYPE=\"hidden\" name=\"tradname".$i."\" value=\"".$tradname."\">
		</TD>
		<TD align=\"center\">
							เข็มที่ <SELECT NAME=\"number".$i."\">
								<Option value=\"1\" >1</Option>
								<Option value=\"2\" >2</Option>
								<Option value=\"3\" >3</Option>
								<Option value=\"4\" >4</Option>
								<Option value=\"5\" >5</Option>
								<Option value=\"6\" >6</Option>
								<Option value=\"7\" >7</Option>
							</SELECT>&nbsp;&nbsp;
		<INPUT TYPE=\"hidden\" name=\"drugcode".$i."\" value=\"".$drugcode."\">
		<INPUT TYPE=\"hidden\" name=\"tradname".$i."\" value=\"".$tradname."\">
		</TD>
							";
		echo "</TR>";

$i++;

		}
		echo "<TR><TD colspan=\"6\"><INPUT TYPE=\"submit\" name=\"hn\" value=\"ยืนยันการฉีดยา\"></TD></TR><INPUT TYPE=\"hidden\" value=\"".$i."\" name=\"max\"></FORM>";
		//echo $text;
?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>