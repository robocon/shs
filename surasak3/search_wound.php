<?php
set_time_limit(180);
 include("connect.inc");

$month['01'] = "มกราคม";
$month['02'] = "กุมภาพันธ์";
$month['03'] = "มีนาคม";
$month['04'] = "เมษายน";
$month['05'] = "พฤษภาคม";
$month['06'] = "มิถุนายน";
$month['07'] = "กรกฏาคม";
$month['08'] = "สิงหาคม";
$month['09'] = "กันยายน";
$month['10'] = "ตุลาคม";
$month['11'] = "พฤศจิกายน";
$month['12'] = "ธันวาคม";

?>
<style>
	.border_color{ border:inherit; border-color:#009900;}
	.left_title{ font-family:"MS Sans Serif"; font-size:16px; font-weight:bold; color:#FFFFFF; text-align:center; background-color:#009900}
	.left_td{ font-family:"MS Sans Serif"; font-size:16px; }
	.left_detail{ font-family:"MS Sans Serif"; font-size:16px; }
	.left_detail2{ font-family:"MS Sans Serif"; font-size:16px; background-color:#FFFFCC; }
	.left_detail3{ font-family:"MS Sans Serif"; font-size:16px; background-color:#FFB7B7 }
</style>

<a target=_top  href="../nindex.htm">&lt;&lt; เมนู</a>

<?
if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

		$select_day2 = $_POST["yr2"]."-".$_POST["m2"]."-".$_POST["d2"];
		

		$day_now2 = $_POST["d2"];
		$month_now2 = $_POST["m2"];
		$year_now2 = $_POST["yr2"];
		


	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = "01";
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543).date("-m-d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));

		$day_now2 = date("d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$month_now2 = date("m",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$year_now2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543);


	}
?>
<form method='POST' action='search_wound.php'>
<TABLE class="border_color" border="1" cellpadding="0" cellspacing="0">
<TR>
	<TD class="left_title">ค้นหา</TD>
</TR>
<TR>
	<TD>
	<TABLE id="form_01">
	<TR>
		<TD class="left_td" align="right">
		วันที่&nbsp;&nbsp;
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; 
	<select name="m">
		<?foreach($month as $key => $value){
				
				echo "<option value=\"".$key."\" ";
					if($key ==$month_now) echo " Selected ";
				echo ">".$value."</option>";
				
		}?>
	</select>
	&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>		
	</TD>
	</TR>
	<TR>
		<TD class="left_td"  align="right">
		ถึง วันที่&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	เดือน&nbsp; 
	<select name="m2">
		<?foreach($month as $key => $value){
				
				echo "<option value=\"".$key."\" ";
					if($key ==$month_now2) echo " Selected ";
				echo ">".$value."</option>";
				
		}?>
	</select>
	&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>		
		</TD>
	</TR>
	<TR>
		<TD class="left_td">
		รหัส : <INPUT TYPE="text" NAME="code" size="7" value="<?php echo $_POST["code"];?>">
		</TD>
	</TR>
	<TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' ></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</form>
	
	<?php
		if(empty($_POST["submit"]) || trim($_POST["code"]) == "")
			exit();

		$sdate = sprintf("%04d",$_POST["yr"])."-".sprintf("%02d",$_POST["m"])."-".sprintf("%02d",$_POST["d"]). " 00:00:00";
		$edate  = sprintf("%04d",$_POST["yr2"])."-".sprintf("%02d",$_POST["m2"])."-".sprintf("%02d",$_POST["d2"]). " 23:59:59";
		$codes = trim($_POST["code"]);
	?>

<TABLE align="center"  class="border_color" border="1" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE align="center" width="755">
<TR class="left_title">
	<TD  >No.</TD>
	<TD >วันที่</TD>
	<TD  >HN</TD>
	<TD  >ชื่อ-สกุล</TD>
	<TD  >จำนวน</TD>
	<TD  >แพทย์</TD>
	<TD >ชำระเงิน</TD>
</TR>

<?
	
	$sql = "Create temporary table sub_opacc Select date, hn, credit From opacc where  (date between '{$sdate}' AND '{$edate}' )";
	$result = mysql_query($sql);

//$codes="";
	$sql = "Select date_format(date,'%d/%m/%Y') as date2, date_format(date,'%Y-%m-%d') as date3, hn, ptname, doctor, sum(amount) From patdata  where amount <> 0 AND (date between '{$sdate}' AND '{$edate}' ) AND code ='{$codes}' Group by date2,hn,ptname,doctor Order by date, amount DESC ";
	//echo $sql;
//
	$result = mysql_query($sql) or die(mysql_error());
	$i=1;
	$x=$y=0;
	while(list($date, $date2,$hn,$ptname,$doctor, $amount) = mysql_fetch_row($result)){
		
		 if($amount <= 0){
			$class = "left_detail3";
		}else if($i%2==0){
			$class = "left_detail2";
		}else{
			$class = "left_detail";
		}
		$create = "";
		list($create) = mysql_fetch_row(mysql_query("Select credit From sub_opacc where hn='{$hn}' AND date like '{$date2}%' limit 1"));
		echo "<TR  class=\"",$class,"\">
						<TD align=\"center\">",$i,".</TD>
						<TD>",$date,"</TD>
						<TD>",$hn,"</TD>
						<TD>",$ptname,"</TD>
						<TD align=\"center\">",$amount,"</TD>
						<TD>",$doctor,"</TD>
						<TD>{$create}</TD>
					</TR>";
		$i++;


			$y+=$amount;

	}

	?>
</TABLE>
</TD>
</TR>
<TR>
	<TD class="left_title">จำนวน ทั้งหมด : <?php echo $y-$x;?></TD>
</TR>
</TABLE>

<?php
	 include("unconnect.inc");
?>
