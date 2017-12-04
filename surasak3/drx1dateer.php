
<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='GET' action='drxlister.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ต้องการดูรายการใบสั่งยา ของวันที่ ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";

	print "<p><font face='Angsana New'>VN&nbsp;&nbsp; ";
    print "<input type='text' name='vn' size='4' ></font></p>";

    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ตกลง     ' >&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>";
    print "</form>";

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

	function echo_ka($time){
		

		if($time >= "07:31:00" && $time < "15:31:00"){
			$ka = "เช้า";
		}else if($time >= "15:31:00" && $time < "23:31:00"){
			$ka = "บ่าย";
		}else if($time >= "23:3:001" && $time <= "23:59:00"){
			$ka = "ดึก";
		}else if($time >= "00:00:00" && $time < "07:31:00"){
			$ka = "ดึก";
		}
		
		return $ka;

	}

?>
<BR><BR>รายการยาขอคืนห้องฉุกเฉิน
<form method='POST' action='<?php echo $_SERVER["PHP_SELF"]?>'>
	<TABLE id="form_01" style="font-family:  MS Sans Serif; font-size: 14 px;">
	<TR>
		<TD>
		วันที่&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	เดือน&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	
	<TR>
		<TD><input type='submit' name="submit" value='     ตกลง     ' > <INPUT TYPE="button" value="print" onclick="wprint();">&nbsp;<a target=_self  href='../nindex.htm'> &lt;&lt; ไปเมนู</a></TD>
	</TR>
	</TABLE>
	</form>
	<BR>
<?php

if(isset($_POST["submit"])){
include("connect.inc");
		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));

		$sql = "SELECT a.drugcode , a.tradname , a.amount, b.ptname, date_format( a.date, '%H:%i:%s' )   FROM ( SELECT drugcode , tradname , amount, idno, date  FROM ddrugrx where  ( date between '".$select_day." 07:31:00' AND '".$select_day2." 07:30:59' )AND slcode = 'ER' ) as a INNER JOIN (Select ptname, row_id From dphardep where date between '".$select_day." 07:31:00' AND '".$select_day2." 07:30:59' ) as b ON a.idno = b.row_id Order by a.date ASC ";


		$echoka = "";
		$echoka1 = "";
		$i=0;
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		?>
<FONT style="font-family:  MS Sans Serif; font-size: 14 px;">จำนวนข้อมูลทั้งหมด  <?php echo $rows;?></FONT>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse' style="font-family:  MS Sans Serif; font-size: 14 px;">
<TR>
	<TD align="center">ชื่อผู้ป่วย</TD>
	<TD align="center">ชื่อยา</TD>
	<TD align="center">จำนวน</TD>
</TR>
<?php

		while(list($drugcode , $tradname , $amount, $ptname, $time_in) = Mysql_fetch_row($result)){

if($i%2==0)
	$bgcolor= "#FFFFFF";	
else
	$bgcolor= "#FFFFB7";

		$i++;
		
		$echoka = echo_ka($time_in);

		if($echoka != $echoka1 && !empty($_POST["d"])){
		echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"3\">&nbsp;&nbsp;<B>วันที่ ".$date_in." เวร ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
		
	}

		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD>",$ptname,".</TD>
						<TD>",$tradname,".</TD>
						<TD>",$amount,"</TD>";
		echo "</TR>";

		}

	}
 include("unconnect.inc");
?>
</TABLE>


