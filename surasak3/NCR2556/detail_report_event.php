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
		<TD  rowspan="2" >NCR</TD>
		<TD  rowspan="2">หน่วยงาน/ทีม</TD>
		<TD rowspan="2" align="center">เหตุการณ์</TD>
		<?php
		if( $_SESSION['Namencr'] === 'ชาตรี แสงประสาร' ){
			?>
			<td rowspan="2" width="20%">ปัญหาที่พบ/สาเหตุ</td>
			<?php
		}
		?>
		<TD  align="center">ความรุนแรง</TD>
		<TD rowspan="2"  align="center">ความเสี่ยง</TD>
		<TD  rowspan="2" >วันที่</TD>
		<TD  rowspan="2">เวลา</TD>
		<TD  rowspan="2">View</TD>
	</TR>
	<TR align="center" bgcolor="#3366FF" style="color:#FFFFFF;font-weight: bold;">
	  <TD >Clinic</TD>
	  <!--<TD >Non-Clinic</TD>-->
	  </TR>
	<?php
	if(isset($_GET['until'])){
	$where="AND ".$_GET['topic']." = '1' AND  until = '".$_GET['until']."' ";	
	}else if(isset($_GET['topicdetail'])){
	$where="AND ".$_GET['topicdetail']." !='' ";	
	}else{
	$where="AND ".$_GET['topic']." = '1'";
	}

		$sql = "Select date_format(nonconf_date,'%d/%m/%Y')as nonconf_date, left(nonconf_time,5)as nonconf_time ,a.*  From  ncr2556 as a  where nonconf_date like '".$_GET["y"]."%'  $where  Order by nonconf_id DESC ";
		$result = mysql_query($sql) or die(mysql_error());
		$i=0;
		
//	echo $sql;
		while($arr = mysql_fetch_array($result)){	
		$i++;
		
		
		$sqld="SELECT name FROM `departments` where code='$arr[until]' ";
		$queryd=mysql_query($sqld);
		$arrd = mysql_fetch_assoc($queryd);

		$clinic=$arr['clinic'];
		//$nonclinic=$arr['nonclinic'];
		
		$nonconf_date=$arr[0];
		$nonconf_time=$arr[1];
		
		////////// เหตุการณ์ //////////
		// topic
		if($arr['topic1_1'] || $arr['topic1_2']|| $arr['topic1_3'] ||$arr['topic1_4'] ||$arr['topic1_5'] ||$arr['topic1_6']==1 || $arr['topic1_7']!=''){
			$topic1="1.ความปลอดภัย/ตก/หกล้ม ,";
		}else{
			$topic1="";
		}
		if($arr['topic2_1'] || $arr['topic2_2']|| $arr['topic2_3'] ||$arr['topic2_4'] ||$arr['topic2_5'] ||$arr['topic2_6']==1 || $arr['topic2_7']!=''){
			$topic2="2.การติดต่อสื่อสาร ,";
		}else{
			$topic2="";
		}
		if($arr['topic3_1'] || $arr['topic3_2']|| $arr['topic3_3'] ==1 ||$arr['topic3_4']!=''){
			$topic3="3.เลือด ,";
		}else{
			$topic3="";
		}
		if($arr['topic4_1'] || $arr['topic4_2']|| $arr['topic4_3'] ||$arr['topic4_4'] ||$arr['topic4_5']==1 || $arr['topic4_6']!=''){
			$topic4="4.เครื่องมือ ,";
		}else{
			$topic4="";
		}
		if($arr['topic5_1'] || $arr['topic5_2']|| $arr['topic5_3'] ||$arr['topic5_4'] ||$arr['topic5_5'] ||$arr['topic5_6'] || $arr['topic5_7'] || $arr['topic5_8'] || $arr['topic5_9'] || $arr['topic5_10']==1 || $arr['topic5_11']!=''){
			$topic5="5.การวินิจฉัย / รักษา ,";
		}else{
			$topic5="";
		}
		if($arr['topic6_1'] || $arr['topic6_2']|| $arr['topic6_3'] ||$arr['topic6_4']==1 || $arr['topic6_5']!=''){
			$topic6="6.การคลอด ,";
		}else{
			$topic6="";
		}
		if($arr['topic7_1'] || $arr['topic7_2']|| $arr['topic7_3'] ||$arr['topic7_4'] ||$arr['topic7_5'] ||$arr['topic7_6']==1 || $arr['topic7_7']!=''){
			$topic7="7.การผ่าตัด /วิสัญญี ,";
		}else{
			$topic7="";
		}
		if($arr['topic8_1'] || $arr['topic8_2']|| $arr['topic8_3'] ||$arr['topic8_4'] ||$arr['topic8_5'] ||$arr['topic8_6'] || $arr['topic8_7'] || $arr['topic8_8'] || $arr['topic8_9'] || $arr['topic8_10']==1 || $arr['topic8_11']!=''){
			$topic8="8.อื่นๆ ,";
		}else{
			$topic8="";
		}
		
		//1.
		if($arr['topic1_1']==1){
		$topic1_1="ล้ม ,";
		}else{
		$topic1_1="";
		}
		if($arr['topic1_2']==1){
		$topic1_2="พบว่านอนอยู่บนพื้น ,";
		}else{
		$topic1_2="";
		}
		if($arr['topic1_3']==1){
		$topic1_3="ตกจากเตียง/เก้าอี้ /โต๊ะ,";
		}else{
		$topic1_3="";
		}
		if($arr['topic1_4']==1){
		$topic1_4="เครื่องรัดตึงหลุด,";
		}else{
		$topic1_4="";
		}
		
		if($arr['topic1_5']==1){
		$topic1_5="ปีนข้ามไม้กั้นเตียง,";
		}else{
		$topic1_5="";
		}
		
		if($arr['topic1_6']==1){
		$topic1_6="พลัดตกระหว่างการเคลื่อนย้าย,";
		}else{
		$topic1_6="";
		}
		$topic1_7=$arr['topic1_7'];
		
		//2.
		if($arr['topic2_1']==1){
		$topic2_1="ไม่มีรายงานผล lab / Film X-ray ด่วนหรือผิดปกติ,";
		}else{
		$topic2_1="";
		}
		if($arr['topic2_2']==1){
		$topic2_2="ไม่รายงานแพทย์/แพทย์ไม่ตอบ,";
		}else{
		$topic2_2="";
		}
		
		if($arr['topic2_3']==1){
		$topic2_3="ปฏิบัติไม่ถูกต้องตามคำสั่ง,";
		}else{
		$topic2_3="";
		}
		if($arr['topic2_4']==1){
		$topic2_4="เวชระเบียนไม่สมบูรณ์,";
		}else{
		$topic2_4="";
		}
		if($arr['topic2_5']==1){
		$topic2_5="ใบยินยอมไม่ตรงกับหัตถการ,";
		}else{
		$topic2_5="";
		}
		if($arr['topic2_6']==1){
		$topic2_6="ทำหัตถการโดยไม่มีใบยินยอม,";
		}else{
		$topic2_6="";
		}
		$topic2_7=$arr['topic2_7'];
	
		//3.
		if($arr['topic3_1']==1){
		$topic3_1="ผิดคน,";
		}else{
		$topic3_1="";
		}
		if($arr['topic3_2']==1){
		$topic3_2="ภาวะแทรกซ้อนจากการให้เลือด,";
		}else{
		$topic3_2="";
		}
		if($arr['topic3_3']==1){
		$topic3_3="แพ้เลือด,";
		}else{
		$topic3_3="";
		}
		$topic3_4=$arr['topic3_4'];
		
		//4.
		if($arr['topic4_1']==1){
		$topic4_1="ผู้ป่วยถูกลวก /ไหม้,";
		}else{
		$topic4_1="";
		}
		if($arr['topic4_2']==1){
		$topic4_2="ตกใส่ผู้ป่วย ,";
		}else{
		$topic4_2="";
		}
		if($arr['topic4_3']==1){
		$topic4_3="ไม่ทำงาน / ทำงานผิดปกติ ,";
		}else{
		$topic4_3="";
		}
		if($arr['topic4_4']==1){
		$topic4_4="ไม่มีเครื่องมือใช้ ,";
		}else{
		$topic4_4="";
		}
		if($arr['topic4_5']==1){//
		$topic4_5="ลิฟท์ไม่ทำงาน ,";
		}else{
		$topic4_5="";
		}
		$topic4_6=$arr['topic4_6'];

		//5.
		if($arr['topic5_1']==1){
		$topic5_1="รับ admit ซ้ำโดยโรคเดิมใน 7วัน ,";
		}else{
		$topic5_1="";
		}
		if($arr['topic5_2']==1){
		$topic5_2="ไม่สามารถวินิจฉัยโรคที่ต้อง admit หรือมา er ซ้ำ ,";
		}else{
		$topic5_2="";
		}
		if($arr['topic5_3']==1){
		$topic5_3="อ่านผลเอ็กซ์เรย์ผิด,";
		}else{
		$topic5_3="";
		}
		if($arr['topic5_4']==1){
		$topic5_4="ล่าช้าในการรักษาผู้ป่วยที่ทรุดลง,";
		}else{
		$topic5_4="";
		}
		if($arr['topic5_5']==1){
		$topic5_5="ภาวะแทรกซ้อนจากหัตถการ,";
		}else{
		$topic5_5="";
		}
		if($arr['topic5_6']==1){
		$topic5_6="การทำ diag proc ซ้ำโดยไม่มีแผน,";
		}else{
		$topic5_6="";
		}
		if($arr['topic5_7']==1){
		$topic5_7="การเฝ้าระวังไม่เพียงพอ,";
		}else{
		$topic5_7="";
		}
		if($arr['topic5_8']==1){
		$topic5_8="ใส่ Cath / Tube /Drain ไม่ถูก,";
		}else{
		$topic5_8="";
		}
		if($arr['topic5_9']==1){
		$topic5_9="ดูแล Cath / Tube /Drain,";
		}else{
		$topic5_9="";
		}
		if($arr['topic5_10']==1){
		$topic5_10="ย้ายผู้ป่วยเข้า ICU โดยไม่มีแผน,";
		}else{
		$topic5_10="";
		}
		$topic5_11=$arr['topic5_11'];
		
		//6. 
		if($arr['topic6_1']==1){
		$topic6_1="ไม่พบ Fetal distress ทันท่วงที,";
		}else{
		$topic6_1="";
		}
		if($arr['topic6_2']==1){
		$topic6_2="ผ่าตัดคลอดช้าเกินไป,";
		}else{
		$topic6_2="";
		}
		if($arr['topic6_3']==1){
		$topic6_3="ภาวะแทรกซ้อนจากการคลอด,";
		}else{
		$topic6_3="";
		}
		if($arr['topic6_4']==1){
		$topic6_4="บาดเจ็บจากการคลอด,";
		}else{
		$topic6_4="";
		}
		$topic6_5=$arr['topic6_5'];
		
		//7.
		if($arr['topic7_1']==1){
		$topic7_1="ภาวะแทรกซ้อนทางวิสัญญี,";
		}else{
		$topic7_1="";
		}
		if($arr['topic7_2']==1){
		$topic7_2="ผ่าตัดผิดคน/ผิดข้าง/ผิดตำแหน่ง,";
		}else{
		$topic7_2="";
		}if($arr['topic7_3']==1){
		$topic7_3="ตัดอวัยวะออกโดยไม่ได้วางแผน,";
		}else{
		$topic7_3="";
		}
		if($arr['topic7_4']==1){
		$topic7_4="เย็บซ่อมอวัยวะที่บาดเจ็บ,";
		}else{
		$topic7_4="";
		}
		if($arr['topic7_5']==1){
		$topic7_5="ทิ้งเครื่องมือ / ก๊อสไว้ในผู้ป่วย,";
		}else{
		$topic7_5="";
		}
		if($arr['topic7_6']==1){
		$topic7_6="กลับมาผ่าตัดซ้ำ,";
		}else{
		$topic7_6="";
		}
		$topic7_7=$arr['topic7_7'];
		
		//8.
		if($arr['topic8_1']==1){
		$topic8_1="ผู้ป่วย/ญาติ ไม่พึงพอใจ,";
		}else{
		$topic8_1="";
		}
		if($arr['topic8_2']==1){
		$topic8_2="ไม่สมัครใจอยู่ รพ. ,";
		}else{
		$topic8_2="";
		}if($arr['topic8_3']==1){
		$topic8_3="มีการทำร้ายร่างกาย ผู้ป่วย/ญาติ/เจ้าหน้าที่ ,";
		}else{
		$topic8_3="";
		}if($arr['topic8_4']==1){
		$topic8_4="ผู้ป่วยพยายามฆ่าตัวตาย/ทำร้ายร่างกายตัวเอง ,";
		}else{
		$topic8_4="";
		}if($arr['topic8_5']==1){
		$topic8_5="โจรกรรม/ลักขโมย ,";
		}else{
		$topic8_5="";
		}
		if($arr['topic8_6']==1){
		$topic8_6="การคุกคาม/ข่มขู่ ,";
		}else{
		$topic8_6="";
		}
		if($arr['topic8_7']==1){
		$topic8_7="สิ่งแวดล้อมเป็นอันตราย/ปนเปื้อน ,";
		}else{
		$topic8_7="";
		}
		if($arr['topic8_8']==1){
		$topic8_8="อุบัติเหตุไฟไหม้ ,";
		}else{
		$topic8_8="";
		}
		if($arr['topic8_9']==1){
		$topic8_9="จนท.บาดเจ็บจากการทำงาน ,";
		}else{
		$topic8_9="";
		}
		if($arr['topic8_10']==1){
		$topic8_10="ไม่ได้เรียกเก็บค่าใช้จ่าย ,";
		}else{
		$topic8_10="";
		}
		$topic8_11=$arr['topic8_11'];
		
		/*if($arr['topic2_1'] || $arr['topic2_2'] || $arr['topic2_3'] || $arr['topic2_4'] || $arr['topic2_5'] || $arr['topic2_6'] =='1'){
			
			$topic2="การติดต่อสื่อสาร";
			
		}
		*/
		///////////////
		
		

		///////// clinic //////////
		if($clinic=='A'){
			$clinic="A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน";
		}elseif($arr['clinic']=='B'){
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
	///////////////// non - clinic ///////////	
		if($nonclinic=='N1'){
			$nonclinic="Near miss หรือระดับ 1 - เกือบพลาด ไม่เกิดความเสียหาย";
		}elseif($nonclinic=='N2'){
			$nonclinic="Low หรือระดับ 2  - มูลค่าความเสียหายต่ำกว่า 10,000";
		}elseif($nonclinic=='N3'){
			$nonclinic="Intermediate หรือระดับ 3  - มูลค่าความเสียหายตั่งแต่ 10,000 ถึงน้อยกว่า 50,000 บาท <br>
			- เกิดอัคคีภัยในขั้นเริ่มต้น";
		}elseif($nonclinic=='N4'){
			$nonclinic="High  หรือระดับ 4  - มูลค่าความเสียหายตั่งแต่ 50,000 ขึ้นไป  
			- เกิดอัคคีภัยในที่มากกว่าขั้นเริ่มต้น <br> - Sentinel Event";
		}else{
			$nonclinic= "";
		}
		////////////////////
		
		if($arr['risk1']=="1"){	
		$showrisk1="Clinical Risk , ";
		}else{
		$showrisk1="";
		}
		if($arr['risk2']=="1"){
		$showrisk2="Infection control Risk , ";	
		}else{
		$showrisk2="";
		}
		if($arr['risk3']=="1"){
		$showrisk3="Medication Risk , ";
		}else{
		$showrisk3="";
		}
		if($arr['risk4']=="1"){
		$showrisk4="Medical Equipment Risk , ";
		}else{
		$showrisk4="";
		}
		if($arr['risk5']=="1"){
		$showrisk5="Safety and Environment Risk , ";	
		}else{
		$showrisk5="";
		}
		if($arr['risk6']=="1"){
		$showrisk6="Customer Complaint Risk , ";	
		}else{
		$showrisk6="";
		}
		if($arr['risk7']=="1"){
		$showrisk7="Financial Risk ,";	
		}else{
		$showrisk7="";
		}
		if($arr['risk8']=="1"){
		$showrisk8="Utilization Management Risk , ";
		}else{
		$showrisk8="";
		}
		if($arr['risk9']=="1"){
		$showrisk9="Information Risk , ";	
		}else{
		$showrisk9="";
		}
		
	

		if($i % 2 ==0)
			$bgcolor="#FFFFFF";
		else
			$bgcolor="#FFFFDD";
	echo "<TR bgcolor='".$bgcolor."'>";
		echo "<TD>".$i.".</TD>";
		echo "<TD align='right'>".$arr['ncr']."&nbsp;&nbsp;&nbsp;</TD>";
		echo "<TD>".$arrd['name']."</TD>";
		echo "<TD valign='top'>
		<b>$topic1</b>".$topic1_1.$topic1_2.$topic1_3.$topic1_4.$topic1_5.$topic1_6.$topic1_7."
		<b>$topic2</b>".$topic2_1.$topic2_2.$topic2_3.$topic2_4.$topic2_5.$topic2_6.$topic2_7."
		<b>$topic3</b>".$topic3_1.$topic3_2.$topic3_3.$topic3_4."
		<b>$topic4</b>".$topic4_1.$topic4_2.$topic4_3.$topic4_4.$topic4_5.$topic4_6."
		<b>$topic5</b>".$topic5_1.$topic5_2.$topic5_3.$topic5_4.$topic5_5.$topic5_6.$topic5_7.$topic5_8.$topic5_9.$topic5_10.$topic5_11."
		<b>$topic6</b>".$topic6_1.$topic6_2.$topic6_3.$topic6_4.$topic6_5."
		<b>$topic7</b>".$topic7_1.$topic7_2.$topic7_3.$topic7_4.$topic7_5.$topic7_6.$topic7_7."
		<b>$topic8</b>".$topic8_1.$topic8_2.$topic8_3.$topic8_4.$topic8_5.$topic8_6.$topic8_7.$topic8_8.$topic8_9.$topic8_10.$topic8_11."
		
		</TD>";
		if( $_SESSION['Namencr'] === 'ชาตรี แสงประสาร' ){
			?>
			<td><?=$arr['problem'];?></td>
			<?php
		}
		echo "<TD>".$clinic."</TD>";
		echo "<TD>".$showrisk1.$showrisk2.$showrisk3.$showrisk4.$showrisk5.$showrisk6.$showrisk7.$showrisk8.$showrisk9."</TD>";
		echo "<TD align='center'>".$nonconf_date.($arr['nonconf_date2'])."</TD>";
		echo "<TD align='center'>".$nonconf_time."</TD>";
		echo "<TD align='center'><A HREF=\"ncf_print.php?ncr_id=".$arr['nonconf_id']."\" target=\"_blank\">View</A></TD>";
	echo "</TR>";
 } ?>
  </TABLE>
	
		</TD>
</TR>
</TABLE>

</BODY>
</HTML>