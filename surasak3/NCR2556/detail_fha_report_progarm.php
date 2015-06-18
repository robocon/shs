<?php
session_start();

include("connect.inc");
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>ใบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</TITLE>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family: "TH SarabunPSK";
	font-size: 16 px;
}

.font_title{
	font-family: "TH SarabunPSK";
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>

</HEAD>
<BODY>
<BR>

<TABLE width="100%" align="center" border="1" bordercolor="#3366FF" cellpadding="0" cellspacing="0">
<TR>
	<TD>
	
	<TABLE border="1" style="border-collapse:collapse" bordercolor="#FFFFFF" cellpadding="0" cellspacing="0" width="100%">
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
		<TD  rowspan="2">No.</TD>
		<TD  rowspan="2">หน่วยงาน/ทีม</TD>
		<TD  rowspan="2">สถานที่เกิดเหตุ</TD>
		<TD rowspan="2" align="center">ชนิดความคลาดเคลื่อนทางยา</TD>
		<TD  align="center">ความรุนแรง</TD>
		<TD  rowspan="2" >วันที่</TD>
		<TD  rowspan="2">เวลา</TD>
		<TD  rowspan="2">View</TD>
	</TR>
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
	  <TD >Clinic</TD>
	  <!--<TD >Non-Clinic</TD>-->
	  </TR>
	<?php
	if(isset($_GET['depart'])){
	$where="AND  depart = '".$_GET['depart']."' ";	
	}else{
	$where="";
	}

		$sql = "Select date_format(fha_date,'%d/%m/%Y')as fha_date2, left(fha_time,5)as fha_time2 ,a.*  From  drug_fail_2  as a  where fha_date like '".$_GET["y"]."-".$_GET["m"]."%'  $where  Order by row_id DESC ";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		
		while($arr = mysql_fetch_array($result)){
		$i++;
		
		
		$sqld="SELECT name FROM `departments` where code='$arr[depart]'";
		$queryd=mysql_query($sqld);
		$arrd = mysql_fetch_assoc($queryd);
		
		$sqla="SELECT name FROM `departments` where code='$arr[area]'";
		$querya=mysql_query($sqla);
		$arra = mysql_fetch_assoc($querya);
		
		$clinic=$arr['level_vio'];
		//$nonclinic=$arr['nonclinic'];
		
		$fha_date=$arr[0];
		$fha_time=$arr[1];
		
		////////// เหตุการณ์ //////////
		// topic
		if($arr['p1'] || $arr['p2']|| $arr['p3'] || $arr['p4'] || $arr['p5'] || $arr['p6'] || $arr['p7'] || $arr['p8'] || $arr['p9'] || $arr['p10'] || $arr['p11'] || $arr['p12'] || $arr['p13'] || $arr['p14'] || $arr['p15']==1 || $arr['p_detail']!=''){
			$topic1="การสั่งยา(Prescribing error) , ";
		}else{
			$topic1="";
		}
		if($arr['d1'] || $arr['d2']|| $arr['d3'] || $arr['d4'] || $arr['d5'] || $arr['d6'] || $arr['d7'] || $arr['d8'] || $arr['d9']==1 || $arr['d_detail']!=''){
			$topic2="การจ่ายยา(Dispensing error) , ";
		}else{
			$topic2="";
		}
		if($arr['t1'] || $arr['t2']|| $arr['t3'] || $arr['t4'] || $arr['t5'] || $arr['t6'] || $arr['t7'] || $arr['t8'] || $arr['t9']==1 || $arr['t_detail']!=''){
			$topic3="การคัดลอกคำสั่ง(Transcribing error) , ";
		}else{
			$topic3="";
		}
		if($arr['a1'] || $arr['a2'] || $arr['a3'] || $arr['a4'] || $arr['a5'] || $arr['a6'] || $arr['a7'] || $arr['a8'] ||$arr['a9'] ||$arr['a10'] ||$arr['a11'] ||$arr['a12']==1 || $arr['a_detail']!=''){
			$topic4="การบริหารยา(Administration error) , ";
		}else{
			$topic4="";
		}
		if($arr['c1'] || $arr['c2']==1 || $arr['c_detail']!=""){
			$topic5="การใช้ยาของผู้ป่วย(Compliance Error) , ";
		}else{
			$topic5="";

		}
		
		//1.
		if($arr['p1']==1){
		$topic1_1="สั่งยาโดยไม่มีข้อบ่งใช้ ,";
		}else{
		$topic1_1="";
		}
		if($arr['p2']==1){
		$topic1_2="สั่งยาโดยไม่มีข้อห้ามใช้ ,";
		}else{
		$topic1_2="";
		}
		if($arr['p3']==1){
		$topic1_3="สั่งยาที่ผู้ป่วยมีประวัติแพ้,";
		}else{
		$topic1_3="";
		}
		if($arr['p4']==1){
		$topic1_4="สั่งยาที่เกิดปฏิกิริยาต่อกัน,";
		}else{
		$topic1_4="";
		}
		if($arr['p5']==1){
		$topic1_5="สั่งยาในขนาดสูงเกินไป,";
		}else{
		$topic1_5="";
		}
		if($arr['p6']==1){
		$topic1_6="สั่งยาในขนาดต่ำเกินไป,";
		}else{
		$topic1_6="";
		}
		if($arr['p7']==1){
		$topic1_7="อื่นๆ,";
		}else{
		$topic1_7="";
		}
		if($arr['p8']==1){
		$topic1_8="ไม่ระบุความแรง/วิธีใช้/จำนวน,";
		}else{
		$topic1_8="";
		}
		if($arr['p9']==1){
		$topic1_9="ผิดชื่อยา/ชนิดยา,";
		}else{
		$topic1_9="";
		}
		if($arr['p10']==1){
		$topic1_10="ผิดความแรง,";
		}else{
		$topic1_10="";
		}
		if($arr['p11']==1){
		$topic1_11="ผิดรูปแบบยา,";
		}else{
		$topic1_11="";
		}					
		if($arr['p12']==1){
		$topic1_12="ผิดวิธีใช้,";
		}else{
		$topic1_12="";
		}
		if($arr['p13']==1){
		$topic1_13="ผิดปริมาณ/จำนวนยา,";
		}else{
		$topic1_13="";
		}
		if($arr['p14']==1){
		$topic1_14="สั่งยาซ้ำซ้อน,";
		}else{
		$topic1_14="";
		}
		if($arr['p15']==1){
		$topic1_15="สั่งจ่ายยาไม่ตรงกับผู้ป่วย,";
		}else{
		$topic1_15="";
		}		
		$p_detail=$arr['p_detail'];
		
		//2.
		if($arr['d1']==1){
		$topic2_1="จ่ายยาไม่ตรงกับผู้ป่วย,";
		}else{
		$topic2_1="";
		}
		if($arr['d2']==1){
		$topic2_2="จ่ายยาผิดชนิด/ชื่อยา,";
		}else{
		$topic2_2="";
		}
		if($arr['d3']==1){
		$topic2_3="ผิดขนาด,";
		}else{
		$topic2_3="";
		}
		if($arr['d4']==1){
		$topic2_4="ผิดความแรง,";
		}else{
		$topic2_4="";
		}
		if($arr['d5']==1){
		$topic2_5="ผิดจำนวน/ปริมาณ,";
		}else{
		$topic2_5="";
		}
		if($arr['d6']==1){
		$topic2_6="ผิดรูปแบบ,";
		}else{
		$topic2_6="";
		}
		if($arr['d7']==1){
		$topic2_7="จ่ายยาหมดอายุ/เสื่อมสภาพโดยสภาพเก็บไม่เหมาะสม,";
		}else{
		$topic2_7="";
		}
		if($arr['d8']==1){
		$topic2_8="ยาขาด Stock ไม่สามารถจัดยาได้ตามใบสั่งขณะนั้น,";
		}else{
		$topic2_8="";
		}
		if($arr['d9']==1){
		$topic2_9="อื่นๆ,";
		}else{
		$topic2_9="";
		}
		$d_detail=$arr['d_detail'];
	
		//3.
		if($arr['t1']==1){
		$topic3_1="ผิดชื่อยา/ชนิดยา,";
		}else{
		$topic3_1="";
		}
		if($arr['t2']==1){
		$topic3_2="ผิดความแรง,";
		}else{
		$topic3_2="";
		}
		if($arr['t3']==1){
		$topic3_3="ผิดรูปแบบยา,";
		}else{
		$topic3_3="";
		}
		if($arr['t4']==1){
		$topic3_4="ผิดวิธีใช้,";
		}else{
		$topic3_4="";
		}
		if($arr['t5']==1){
		$topic3_5="ผิดปริมาณ/จำนวนยาซ้ำซ้อน,";
		}else{
		$topic3_5="";
		}
		if($arr['t6']==1){
		$topic3_6="ยาไม่ตรงกับชื่อผู้ใช้,";
		}else{
		$topic3_6="";
		}
		if($arr['t7']==1){
		$topic3_7="ยาที่แพทย์ไม่ได้สั่ง,";
		}else{
		$topic3_7="";
		}
		if($arr['t8']==1){
		$topic3_8="อื่นๆ,";
		}else{
		$topic3_8="";
		}
		$t_detail=$arr['t_detail'];
		
		//4.
		if($arr['a1']==1){
		$topic4_1="ไม่จ่ายยาในเวลาที่กำหนด/ลืมให้ยา,";
		}else{
		$topic4_1="";
		}
		if($arr['a2']==1){
		$topic4_2="ผิดขนาด/ความแรง ,";
		}else{
		$topic4_2="";
		}
		if($arr['a3']==1){
		$topic4_3="ผิดชื่อยา/ชนิดยา ,";
		}else{
		$topic4_3="";
		}
		if($arr['a4']==1){
		$topic4_4="ผิดอัตราการให้ยา/สารละลาย ,";
		}else{
		$topic4_4="";
		}
		if($arr['a5']==1){//
		$topic4_5="ผิดตำแหน่ง/วิถีทาง/รูปแบบ ,";
		}else{
		$topic4_5="";
		}
		if($arr['a6']==1){//
		$topic4_6="ผิดคน ,";
		}else{
		$topic4_6="";
		}
		if($arr['a7']==1){//
		$topic4_7="อื่นๆ ,";
		}else{
		$topic4_7="";
		}
		if($arr['a8']==1){//
		$topic4_8="ให้ยาไม่ครบรายการ(ขาด/เกิน) ,";
		}else{
		$topic4_8="";
		}
		if($arr['a9']==1){//
		$topic4_9="ให้ยามากกว่า/น้อยกว่าจำนวนครั้งที่สั่ง ,";
		}else{
		$topic4_9="";
		}
		if($arr['a10']==1){//
		$topic4_10="เตรียม/ผสมยาผิด ,";
		}else{
		$topic4_10="";
		}
		if($arr['a11']==1){//
		$topic4_11="เก็บรักษายาผิด(ยาค้าง stock/เก็บยาอันตรายในรถฉุกเฉิน เก็บยาไม่เหมาะสม เช่นนอกตู้เย็น ไม่ป้องกันแสง ,";
		}else{
		$topic4_11="";
		}
		if($arr['a12']==1){//
		$topic4_12="ให้ยาหมดอายุ/เสื่อมสภาพ ,";
		}else{
		$topic4_12="";
		}
		$a_detail=$arr['a_detail'];

		//5.
		if($arr['c1']==1){
		$topic5_1="ผู้ป่วยไม่ได้รับประทานยาตามแพทย์สั่ง ,";
		}else{
		$topic5_1="";
		}
		if($arr['c2']==1){
		$topic5_2="อื่นๆ ,";
		}else{
		$topic5_2="";
		}
	$c_detail=$arr['c_detail'];
		////////////////////
		
	if($clinic=='A'){
			$clinic="A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน";
		}elseif($clinic=='B'){
			$clinic="B เกิดความคลาดเคลื่อนขึ้นแต่ยังไม่ถึงตัวผู้ป่วย";
		}elseif($clinic=='C'){
			$clinic="C เกิดความคลาดเคลื่อนกับผู้ป่วย ไม่เกิดอันตราย ไม่มีการรักษา";
		}elseif($clinic=='D'){
			$clinic="D เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องเฝ้าระวังอาการเพราะมีโอกาสเกิดอันตรายได้ ไม่เกิดอันตรายต่อผู้ป่วย";
		}elseif($clinic=='E'){
			$clinic="E เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาเพิ่มมากขึ้นจากเหตุการณ์นั้น เกิดอันตราย/พิการเพียงชั่วคราวต่อผู้ป่วย";
		}elseif($clinic=='F'){
			$clinic="F เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษา เกิดอันตราย/พิการ เพียงชั่วคราว ผู้ป่วยต้องอยู่ รพ.นานขึ้น";
		}elseif($clinic=='G'){
			$clinic="G เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษา เกิดความพิการถาวร";
		}elseif($clinic=='H'){
			$clinic="H เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาทำการกู้ชีวิต/เกือบเสียชีวิต";
		}elseif($clinic=='I'){
			$clinic="I เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องให้การรักษาถึงแก่ชีวิต";
		}else{
			$clinic="";
		}
	

		if($i % 2 ==0)
			$bgcolor="#FFFFFF";
		else
			$bgcolor="#FFFFDD";
	echo "<TR bgcolor='".$bgcolor."'>";
		echo "<TD>".$i.".</TD>";
		echo "<TD>".$arrd['name']."</TD>";
		echo "<TD>".$arra['name']."</TD>";
		echo "<TD valign='top'>
		<b>$topic1</b>".$topic1_1.$topic1_2.$topic1_3.$topic1_4.$topic1_5.$topic1_6.$topic1_7.$topic1_8.$topic1_9.$topic1_10.$topic1_11.$topic1_12.$topic1_13.$topic1_14.$topic1_15.$p_detail."
		<b>$topic2</b>".$topic2_1.$topic2_2.$topic2_3.$topic2_4.$topic2_5.$topic2_6.$topic2_7.$topic2_8.$topic2_9.$d_detail."
		<b>$topic3</b>".$topic3_1.$topic3_2.$topic3_3.$topic3_4.$topic3_5.$topic3_6.$topic3_7.$topic3_8.$topic3_8.$t_detail."
		<b>$topic4</b>".$topic4_1.$topic4_2.$topic4_3.$topic4_4.$topic4_5.$topic4_6.$topic4_7.$topic4_8.$topic4_9.$topic4_10.$topic4_11.$topic4_12.$a_detail."
		<b>$topic5</b>".$topic5_1.$topic5_2.$c_detail."
		</TD>";
		echo "<TD>".$clinic."</TD>";
		echo "<TD align='center'>".$fha_date."</TD>";
		echo "<TD align='center'>".$fha_time."</TD>";
		echo "<TD align='center'><A HREF=\"fha_report.php?row_id=".$arr['row_id']."\" target=\"_blank\">View</A></TD>";
	echo "</TR>";
 } ?>
  </TABLE>
	
		</TD>
</TR>
</TABLE>

</BODY>
</HTML>