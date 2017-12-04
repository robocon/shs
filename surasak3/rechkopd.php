<?php
session_start();
set_time_limit(30);
include("connect.inc");

echo "<A HREF=\"../nindex.htm\">&lt; &lt; เมนู</A>";

	$start_year = 2547;
	$end_year = date("Y")+543;
?>
<html>
<head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }

-->
</style>
<style media="print">
	#div_form {display:none;}
</style>
</head>
<body>
<div id="div_form">
<FORM METHOD=POST ACTION="">
<TABLE cellpadding='1' cellspacing='0'>
<TR>
	<TD colspan="2" class="tb_head">รายงาน RE-CHK</TD>
</TR>
<TR class="tb_detail">
	<TD align="right" >opdcard ปี : </TD>
	<TD>
		<SELECT NAME="opcard_year">
		<?php
			for($i = $start_year;$i<=$end_year;$i++){
				echo "<Option value='".substr($i,2)."' ";
					if($_POST["opcard_year"] == substr($i,2)) echo " Selected ";
				echo ">".substr($i,2)."</Option>";
			}
		?>
		</SELECT>
	</TD>
</TR>
<TR class="tb_detail">
	<TD align="right">ช่วงตั้งแต่ : </TD>
	<TD>
		<INPUT TYPE="text" NAME="hn_first" size="5"> ถึง <INPUT TYPE="text" NAME="hn_last" size="5">
	</TD>
</TR>
<TR >
	<TD colspan="2" class="tb_detail"><INPUT TYPE="submit" value="ตกลง"></TD>
</TR>
</TABLE>
</FORM>
</div>
<?php
	if(isset($_POST["opcard_year"]) && $_POST["opcard_year"] != "" && $_POST["hn_first"] != "" && $_POST["hn_last"] != ""){
		
		if($sOfficer == "ชาตรี แสงประสาร"){
			$mktime = mktime(0,0,0,date("m"),date("d")-15,date("Y"));
			$date_start = (date("Y",$mktime)+543).date("-m-d 00:00:00",$mktime);
			$sql = "CREATE TEMPORARY TABLE opday_2 Select row_id, hn, okopd,thidate From opday where thidate > '".$date_start."' order by row_id DESC ";
			$result = mysql_query($sql) or die(mysql_error());

			$sql = "Select hn, okopd, date_format(thidate,'%d-%m-%Y') as thidate2 From opday_2 group by hn order by row_id DESC ";
			$result = mysql_query($sql) or die(mysql_error());

			$okopd = array();
			while($arr = mysql_fetch_assoc($result)){
				if($arr["okopd"] =='N')
					$okopd[$arr["hn"]] = $arr["thidate2"];
				else
					$okopd[$arr["hn"]] = $arr["okopd"];
			}
		}

		$sql = "Create temporary table opcard_now (row_id int, hn varchar(15), hn_first int, hn_last int, fullname varchar(80), idguard varchar(45) , lastupdate datetime) Select row_id , hn, SUBSTRING(hn,1,2) as hn_first, SUBSTRING(hn,4) as hn_last, concat(yot,' ',name,' ',surname) as fullname, left(idguard,4) as idguard, lastupdate From opcard where hn like '".$_POST["opcard_year"]."%' ";

		$result = Mysql_Query($sql) or die(mysql_error());

		/*$sql = "Create temporary table opday_now  Select phaok, thidate, hn From opday where hn in (Select hn From opcard_now where hn_last BETWEEN ".$_POST["hn_first"]." AND ".$_POST["hn_last"]." AND idguard not in ('MX04','MX05')) ";
		$result = Mysql_Query($sql) or die(mysql_error());*/
		
		$sql = "Select hn, fullname, date_format(lastupdate,'%d/%m/%Y') From opcard_now where hn_last BETWEEN ".$_POST["hn_first"]." AND ".$_POST["hn_last"]." AND idguard not in ('MX04','MX05') Order by hn_last ASC ";

		$result = Mysql_Query($sql) or die(mysql_error());
		$i=1;
		while(list($hn, $fullname, $lastupdate) = mysql_fetch_row($result)){
			
			/*$sql = "Select phaok, date_format(thidate,'%d/%m/%Y') From opday where hn='".$hn."' Order by thidate DESC limit 1 ";
			list($phaok, $date) = mysql_fetch_row(mysql_query($sql));*/

			if($i==1 || $i==29){
				if($i==29){
					echo "</table><DIV style=\"page-break-after:always\"></DIV>
					";
				}
			echo "<table width=\"587\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\" bordercolor=\"#000000\">
					  <tr align=\"center\">
						<td colspan=\"5\">แบบรายงานการ RE-CHK OPDCARD ที่ไม่พบ</td>
					  </tr>
					  <tr align=\"center\">
						<td width=\"84\">HN</td>
						<td width=\"193\">ชื่อ - สกุล</td>
						<td width=\"112\">มาครั้งสุดท้าย</td>
						<td width=\"65\">สถานะ</td>
						<td width=\"99\">หมายเหตุ</td>
					  </tr>";
			 $i=1;
			}

			echo "<tr>
							<td>&nbsp<a target=\"_blank\"  href=\"opdedit.php?cHn=".$hn."\">".$hn."</a></td>
							<td>&nbsp;&nbsp;".$fullname."</td>
							<td align=\"center\">&nbsp;".$lastupdate."&nbsp;</td>
							<td align=\"center\">&nbsp;";
			if($sOfficer == "ชาตรี แสงประสาร" && empty($okopd[$hn])){
							echo "Y";
			}else if($sOfficer == "ชาตรี แสงประสาร" && !empty($okopd[$hn])){
							echo $okopd[$hn];
			}

			echo "&nbsp;</td>
							<td>&nbsp;</td>
						  </tr>";
$i++;
		}


	}

include("unconnect.inc");
?>
</body>
</html>

