<?php

set_time_limit(3);
include("connect.inc");
$month_now=date("m");
$year_now=(date("Y")+543);
?>
<style>
/* ====== ส่วน body ทั้งหน้าเว็บ ====== */
body {
    font-family: "Angsana New", sans-serif;
    font-size: 24px;
    background-color: #f5f7fa; /* เพิ่มพื้นหลังให้อ่านง่าย */
    color: #333;
    margin: 0;
    padding: 10px;
}

/* ====== สไตล์เฉพาะตาราง ====== */
table {
    border-collapse: collapse;
    width: 100%;
    margin: 15px 0;
    font-family: "Angsana New", sans-serif;
    font-size: 20px;
}

th, td {
    padding: 8px 10px;
    border: 1px solid #ddd;
}

/* ====== หัวตาราง ====== */
.tb_head {
    background-color: #0046D7;
    color: #FFFFCA;
    font-weight: bold;
    text-align: center;
    font-size: 22px;
}

/* ====== แถวข้อมูล ====== */
.tb_detail {
    background-color: #FFFFC1;
    font-size: 20px;
}

/* ====== เมนู ====== */
.tb_menu {
    background-color: #FFFFC1;
    font-weight: bold;
    font-size: 20px;
}

/* ====== ฟอนต์ย่อย ====== */
.font3 {
    font-size: 18px;
}

  .btn{
    cursor:pointer;
    background: linear-gradient(180deg,#22c55e,#16a34a);
    color:white;
    font-weight:700;
    border:none;
    transition: transform .1s ease, box-shadow .1s ease, filter .1s ease;
  }
  .btn:hover{ filter:brightness(1.05); transform: translateY(-1px); }
  .btn:active{ transform: translateY(0); }

  .btn-secondary{
    background: linear-gradient(180deg,#a78bfa,#7c3aed);
  }
</style>
<form method='POST' action='report_sur01.php'>	
<div>เดือน&nbsp; <input type='text' name='month' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	พ.ศ. <input type='text' name='year' size='8' value='<?php echo $year_now;?>'><span style='margin-left:20px;'><input type='submit' name="submit" value='     ตกลง     ' ></span></div>
	</form>


<?php
if(isset($_POST["month"]) && isset($_POST["year"])){

	$l = date("",mktime(0,0,0,$_POST["month"],1,$_POST["year"]-543));
$list = array();
for($i=1;$i<= 31 ;$i++){
	
	if(checkdate($_POST["month"],$i,$_POST["year"]-543)){
		$w = date("w",mktime(0,0,0,$_POST["month"],$i,$_POST["year"]-543));
		if($w == 0 || $w == 6){
			array_push($list,$_POST["year"]."-".sprintf("%02d",$_POST["month"])."-".sprintf("%02d",$i));
			
		}

	}
}

$sql = "Select date_holiday From holiday where date_holiday like '".$_POST["year"]."-".sprintf("%02d",$_POST["month"])."%' ";
$result = mysql_query($sql);
while($arr = mysql_fetch_assoc($result)){
	array_push($list,$arr["date_holiday"]);
}

if(count($list) > 0){
	$where = " (thaidate in ('".implode("','",$list)."')) OR ";
}

$sql = "Select hn,date_format(thaidate,'%d/%m/%Y') as dt2, ptname, doctor, diag, opertion, timein, timeout  From memo_sur where ".$where." (thaidate like '".($_POST["year"])."-".sprintf("%02d",$_POST["month"])."%' AND ( (timein >= '16:00:00' AND timein <= '23:59:59') OR (timein >= '00:00:00' AND timein < '08:00:00') OR (thaidate like '".($_POST["year"])."-".sprintf("%02d",$_POST["month"])."%' AND ((timeout >= '16:00:00' AND timeout <= '23:59:59') OR (timeout >= '00:00:00' AND timeout < '08:00:00'))) ))";
//echo $sql;
$result = mysql_query($sql);
echo "<TABLE border='1' bordercolor=\"#000000\" style=\"font-size: 14px; font-family: 'MS Sans Serif'; BORDER-COLLAPSE: collapse;\" cellpadding=\"2\">";
echo "<TR align=\"center\">
<TD>No.</TD>
<TD>ว/ด/ป</TD>
<TD>ชื่อ-สกุล</TD>
<TD>แพทย์</TD>
<TD>Dx</TD>
<TD>Opertion</TD>
<TD>เวลา</TD>
</TR>";
$i=1;
while($arr = mysql_fetch_assoc($result)){
if($arr["hn"] != "49-6677"){


echo "<TR>
				<TD>".$i.".</TD>
				<TD>".$arr["dt2"]."</TD>
				<TD>".$arr["ptname"]."</TD>
				<TD>".$arr["doctor"]."</TD>
				<TD>".$arr["diag"]."</TD>
				<TD>".$arr["opertion"]."</TD>
				<TD>".$arr["timeout"]."</TD>
			</TR>";
$i++;
}
}
}

include("unconnect.inc");
?>


