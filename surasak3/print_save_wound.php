<?php
 include("connect.inc");
 
 function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
 

$sql = "Select * From `inhale_wound` where hn = '".$_GET["hn"]."' and date like '".$_GET["date"]."%' order by startdate  asc";


//echo $sql;

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$name = $arr["yot"]." ".$arr["name"];
$sname = $arr["sname"];

$date_nows = explode("-",$arr["startdate"]);
$start = $date_nows[2]."/".$date_nows[1]."/".$date_nows[0];
$date_now = explode("-",$arr["enddate"]);
$end = $date_now[2]."/".$date_now[1]."/".$date_now[0];

$hn = $arr["hn"];

$size_wound = $arr["size_wound"];
$detail = $arr["detail"];
$total_day = $arr["total_day"];
$remark = $arr["remark"];
$remark2 = $arr["remark2"];
$detail2 = $arr["detail2"];

$sql = "Select ptright, idcard From opcard where hn = '".$hn."'  limit 0,1 ";

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$ptright = $arr["ptright"];
$idcard = $arr["idcard"];

$sql = "Select name From `inputm` where row_id = ".$_GET["row_id"]." limit  0,1 ";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
$inhaler = "ห้องฉุกเฉิน";
Mysql_free_result($result);
unset($arr);


$sql2= "Select startdate AS date From `inhale_wound` where hn = '".$_GET["hn"]."' and date like '".$_GET["date"]."%' order by startdate asc";

$result2 = Mysql_Query($sql2);

include("unconnect.inc");

?>
<HTML>
<HEAD>
<TITLE> ออกใบนัดทำแผล </TITLE>
</HEAD>

<BODY leftmargin="0" topmargin="0">
<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
<TR>
	<TD>
<TABLE border="0">
<TR>
	<TD valign="top">
	
	<TABLE border="0" style="font-family: 'TH SarabunPSK'; font-size: 18px;">
	<TR>
		<TD><B>ใบนัดทำแผลห้องฉุกเฉิน<BR>รพ.ค่ายสุรศักดิ์มนตรี</B></TD>
		<TD align="center">
			<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
			<TR>
				<TD style="font-family: 'TH SarabunPSK'; font-size: 18px;" align="center">
			&nbsp;<U>ขนาดแผล</U>&nbsp;<BR><B><?php echo $size_wound;?></B>
				</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD colspan="2">ชื่อ<U>&nbsp;<?php echo $name;?>&nbsp;<?php echo $sname;?></U></TD>
	</TR>
	<TR>
		<TD>ตั้งแต่<U>&nbsp;<?php echo $start;?></U></TD>
		<TD>ถึง<U>&nbsp;<?php echo $end;?></U></TD>
	</TR>
	<TR>
		<TD><FONT style="font-family: 'TH SarabunPSK'; font-size: 24px;">HN<U>&nbsp;<?php echo $hn;?></U></FONT></TD>
		<TD><FONT style="font-family: 'TH SarabunPSK'; font-size: 24px;">ID<U>&nbsp;<?php echo $idcard;?></U></FONT></TD>
	</TR>
	<TR>
		<TD colspan="2">ผู้นัด&nbsp;:&nbsp;<?php echo $inhaler;?></U>&nbsp; สิทธิ์&nbsp;:&nbsp;<B><?php echo $ptright;?></B></U></TD>
	</TR>
	<TR>
		<TD colspan="2"></TD>
	</TR>
	<TR>
		<TD colspan="2">บริเวณ<U>&nbsp;<?php echo $detail;?></U>&nbsp;&nbsp;
        	
      
        </TD>
	</TR>
	<TR>
	  <TD colspan="2">
      <?php if($remark != ""){
		
			if($remark == "Case Study" && count(explode("+",$remark2)) == 2){
				$xxx  = explode("+",$remark2);
				$remark = "Case Study ที่ ".$xxx[0];
				$remark2 = " ตัดไหมวันที่ ".$xxx[1];

			}
			}
		
	?> 
    <FONT SIZE="2" ><B><?php 
		$remark = str_replace(" ","&nbsp;",$remark);
		echo $remark,"&nbsp;&nbsp;<U>&nbsp;&nbsp;&nbsp;",displaydate($remark2),"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>";?></B></FONT>
      </TD>
	  </TR>

	<TR>
		<TD colspan="2">หมายเหตุ : <?=$detail2;?></TD>
	</TR>
	<TR>
		<TD colspan="2">
		
<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-family: 'TH SarabunPSK'; font-size: 18px;">
<TR align="center">
	<TD width="25%">ว/ด/ป</TD>
	<TD width="25%">เวลารับ<br>บัตรคิว</TD>
	<td width="25%">เวลาเริ่ม<br>ทำแผล</td>
	<TD width="25%">ผู้ทำแผล</TD>
</TR>
<?php while($arr2 = Mysql_fetch_assoc($result2)){
	$show="";
	if($arr2['date']==$remark2){	
	$show="*";
	}else{
	$show="";
	}
	
	echo "<TR>
			<TD align=\"center\">";echo displaydate($arr2['date']).' '.$show."</TD>
					<TD>&nbsp;</TD> 
					<TD>&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>";
		}
	?>
</TABLE>

		</TD>
	</TR>
	</TABLE>
	
	
	</TD>
	<TD>&nbsp;&nbsp;</TD>
	<TD valign="top">
	
	
	<CENTER>
	<B>
	<FONT style="font-family: 'TH SarabunPSK'; font-size: 22px;">
	ข้อควรปฏิบัติสำหรับผู้ป่วย
	</FONT></B><BR>
	</CENTER>

	<FONT style="font-family: 'TH SarabunPSK'; font-size: 18px;">
	1. ต้องทำแผลวันละ 1 ครั้งที่รพ.หรือสถานพยาบาลใกล้บ้าน<BR>
	2. ห้ามแผลโดนน้ำ, ป้องกันไม่ให้แผลติดเชื้อ<BR>
	3. รับประทานยาแก้อักเสบตามเวลาที่แพทย์สั่ง<BR>
	4. ประคบน้ำแข็งในกรณีที่แผลฟกช้ำภายใน 24 ชม. แรกที่<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;ประสบอุบัติเหตุต่อไปใช้น้ำอุ่นประคบ<BR>
	5. ยกส่วนที่มีการอักเสบให้สูงกว่าระดับหัวใจเพื่อลดอาการ<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;บวมและลดอาการอักเสบ&nbsp;ถ้ามีไข้&nbsp;ปวดบริเวณที่เย็บแผล<BR>
	&nbsp;&nbsp;&nbsp;&nbsp;สามารถบรรเทาด้วยการรับประทานยาแก้ปวดลดไข้ตามแพทย์กำหนด<BR>
	6. รับประทานอาหารที่มีโปรตีนสูง<BR>
	7. ห้ามสูบบุหรี่, ดื่มสุรา ของ หมักดอง<BR>
	* ถ้าท่านมีอาการ ไข้สูง บาดแผลมีบวมแดงร้อน,<BR> แผลเย็บแยก, แผลมีหนองและมีกลิ่นเหม็น ควรมาพบแพทย์
	
	</FONT>
	<TABLE  style="font-family: 'TH SarabunPSK'; font-size: 20px;">
			<TR>
		<TD colspan='2' align="center" ><b><u>เวลาทำแผล</u></b></TD>
	</TR>
		<TR>
		<TD >ทุกวันไม่เว้นวันหยุดราชการ</TD>
		<TD>08.30-12.00 น. , 13.00-16.00 น.</TD>
	</TR>
	<TR>
	  <TD  colspan= '2' align="center" ><u><b>*** กรุณามาทำแผลตามเวลาทำการ ***</b></u></TD>
	  </TR>
	</TABLE>
	
	</TD>
</TR>
<TR>
	<TD colspan="3" align="center" style="font-family: 'TH SarabunPSK'; font-size: 14px;">
	เอกสารหมายเลข FR-OPD-003/4
	แก้ไขครั้งที่ 02 มีผลบังคับใช้ 9 มิ.ย. 51
		
	</TD>
<TR>
</TABLE>
</TD>
</TR>
</TABLE>
</body>
</html>
