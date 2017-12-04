<?php
session_start();
include("connect.inc");

$list_labcare["L01"] = "-------";
$list_labcare["L28"] = "ป้ายตา / ปิดตา";
$list_labcare["L29"] = "ฉีดยาใน ER / IM";
$list_labcare["L30"] = "ฉีดยาใน ER / IV";
$list_labcare["L31"] = "ฉีดยาใน ER / SC";
$list_labcare["L15"] = "เจาะ DTX";
$list_labcare["L16"] = "เจาะเลือด / เก็บ specimen";
$list_labcare["L32"] = "เตรียมฉีดยาเข่า (Synvise / GO-ON / KA / Hyruan)";
$list_labcare["L33"] = "เตรียมฉีด Needle puncture";
$list_labcare["L34"] = "เตรียมฉีด KA";
$list_labcare["L35"] = "เตรียม Aspirate cyst";
$list_labcare["L52"] = "Anterior nasal packing";
$list_labcare["L54"] = "Accupunture";
$list_labcare["L60"] = "Abdominal Tapping";
$list_labcare["L47"] = "aspirate Nail/Aspirate knee/Aspirate hematoma";
$list_labcare["L45"] = "Cold compression";
$list_labcare["L58"] = "CPR";
$list_labcare["L67"] = "Close Reduction";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L66"] = "Drip ยา";
$list_labcare["L06"] = "EKG 12 Lead";
$list_labcare["L26"] = "Eye irrigation";
$list_labcare["L65"] = "FHS";
$list_labcare["L57"] = "Hold ambu-bag";
$list_labcare["L20"] = "I & D";
$list_labcare["L50"] = "Irrigate bladder";
$list_labcare["L61"] = "LP ( lumbar puncture)";
$list_labcare["L04"] = "Nebulizer";
$list_labcare["L46"] = "Nail out/ Partial nail out";
$list_labcare["L22"] = "NG lavage";
$list_labcare["L49"] = "NG-feeding";
$list_labcare["L02"] = "On Oxygen";					
$list_labcare["L03"] = "On 02 – Sat.";					
$list_labcare["L05"] = "On EKG Monitor";
$list_labcare["L07"] = "On BP Monitor";
$list_labcare["L36"] = "On defibrillator";
$list_labcare["L08"] = "On Slab";
$list_labcare["L37"] = "Off Slab";
$list_labcare["L09"] = "On Cast";
$list_labcare["L38"] = "Off Cast";
$list_labcare["L10"] = "On Splint / FS";
$list_labcare["L39"] = "Off Splint / FS";
$list_labcare["L40"] = "Off wire";
$list_labcare["L41"] = "Off gauze bandage";
$list_labcare["L42"] = "On hard collar/ on soft collar/ on philladellphia";
$list_labcare["L43"] = "On jones ’bandage";
$list_labcare["L44"] = "On skin traction";
$list_labcare["L11"] = "Off Cast"; 
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L48"] = "Off NG-Tube";
$list_labcare["L23"] = "On Foley’s catheter";
$list_labcare["L51"] = "Off Foley’s catheter";
$list_labcare["L56"] = "On ET-Tube/ on TT-Tube";
$list_labcare["L53"] ="Pack gauze";
$list_labcare["L63"] ="PR";
$list_labcare["L64"] ="PV";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches – off";
$list_labcare["L24"] = "Single catheter / intermittent cath";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L55"] ="Suction";
$list_labcare["L59"] ="Thoracentesis/ thoracocentesis";
$list_labcare["L62"] ="Throat Swab";
$list_labcare["L68"] ="Xylocaine block";

Function calcage($birth){

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
<title>ออกใบยินยอม</title>

</head>
<body leftmargin="0" topmargin="0">

<?php 

	$comma = "";
	$sql = "Select concat(yot,' ',name,' ',surname) as fullname, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1 ";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	list($fullname, $dbirth) = Mysql_fetch_row($result);

	$sql = "Select doctor From trauma where row_id = '".$_GET["id"]."' limit 1 ";

	$result = Mysql_Query($sql) or die(Mysql_Error());
	list($doctor) = Mysql_fetch_row($result);
	$doctor = substr($doctor,5);

?>
<SCRIPT LANGUAGE="JavaScript">

	//window.onload = function(){
		
	//	window.print();

	//}

		function checkit(){

		if(document.getElementById("title_head").innerHTML== "ยินยอม"){
			document.getElementById("title_head").innerHTML = "ไม่ยินยอม";
		}else{
			document.getElementById("title_head").innerHTML="ยินยอม";
		}
		}

</SCRIPT>
<TABLE style="font-family:'MS Sans Serif'; font-size:10px;" border="0" width="270" cellpadding="0" cellspacing="0">
<TR  style='line-height:15px;'>
	<TD colspan="2">
<A HREF="javascript:void(0);" style="text-decoration: none;color:#000000;" Onclick="window.print();">ข้าพเจ้า</A>(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>  HN<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>  อายุ <U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR>
<B><SPAN ID="title_head" style="CURSOR: pointer" Onclick="checkit();">ยินยอม</SPAN></B> ทำ 
<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR>
<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U>
	</TD>
</TR>
<TR  style='line-height:15px;'>
	<TD colspan="2">
&nbsp;&nbsp;
ข้าพเจ้าได้รับคำอธิบายจนเข้าใจตลอดแล้ว<BR>จึงลงลายมือชื่อไว้เป็นหลักฐาน
	</TD>
</TR>
<TR style='line-height:10px;' valign="top">
	<TD width="50%" align="center"><BR>
<font style="font-family:'MS Sans Serif'; font-size:10px;">	ผู้ป่วย/ผู้แทน<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR><BR>
		(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR><BR>
	
	พยานผู้ป่วย<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR><BR>
		(<span id="pa1" style="CURSOR: pointer" Onclick="if(document.getElementById('menu').style.display==''){ document.getElementById('menu').style.display='none'; name_pa='pa1';}else{ document.getElementById('menu').style.display='';name_pa=''; }">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>)
		<SCRIPT LANGUAGE="JavaScript">
			var name_pa = "";
		function add_span(xx){
			
			document.getElementById('pa1').innerHTML = xx;
			document.getElementById('menu').style.display='none';
		}

		function add_span2(xx){
			
			document.getElementById('pa2').innerHTML = xx;
			document.getElementById('menu2').style.display='none';
		}


		</SCRIPT>
		<DIV id="menu" bgcolor="#FFFFFF" style="position: absolute; display:none; ">
			<TABLE width="300" bgcolor="#FFFFFF" style="font-family:'MS Sans Serif'; font-size:14px;">
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');">เว้นว่าง</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('ปรีชาวรรณ อินอ่อน');">พ.ต.หญิงปรีชาวรรณ อินอ่อน</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('อาทิตยา อากรปรุ');">พ.ต.หญิงอาทิตยา อากรปรุ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('วราภรณ์ ศรีรัตนา');">ร.ท.หญิงวราภรณ์ ศรีรัตนา</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('จิราภรณ์ คำวงสา');">ร.ต.หญิงจิราภรณ์ คำวงสา</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('จันทนา อินทรผูก');">นางสาวจันทนา อินทรผูก</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('บัญญัติ ศรีวรกุลวงค์');">จ.ส.อ.บัญญัติ ศรีวรกุลวงค์</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('จันทร์เพ็ญ ยศแก้วอุด');">จ.ส.อ.หญิงจันทร์เพ็ญ ยศแก้วอุด</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('พยอม สมศิริ');">จ.ส.อ.หญิงพยอม สมศิริ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('ศกุนิชญ์ ใจการ');">จ.ส.อ.หญิงศกุนิชญ์ ใจการ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('สุรีรัตน์ คำปาเชื้อ');">ส.อ.หญิงสุรีรัตน์ คำปาเชื้อ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('วันัสชฎา ชื่นเมือง');">ส.อ.หญิงวันัสชฎา ชื่นเมือง</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('ดลญา ณ นคร');">นางสาวดลญา ณ นคร</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('จรีรัตน์ ถิ่นจันทร์');">ร.อ.หญิง จรีรัตน์ ถิ่นจันทร์</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('ทิพย์วรรณ จันทราช');">จ.ส.อ.หญิง ทิพย์วรรณ จันทราช</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span('อภิรมย์ ศรีมูล');">ร.ท.หญิง อภิรมย์ ศรีมูล</A></TD>
			</TR>
			</TABLE>
		</DIV>
</font>
	</TD >
	<TD width="50%" align="center"><BR>
<font style="font-family:'MS Sans Serif'; font-size:10px;">
		แพทย์<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR><BR>
		(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR><BR>
		พยานแพทย์<U>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</U><BR><BR>
		(<span id="pa2" style="CURSOR: pointer" Onclick="if(document.getElementById('menu2').style.display==''){ document.getElementById('menu2').style.display='none'; name_pa='pa2';}else{ document.getElementById('menu2').style.display='';name_pa=''; }"><?php echo $_SESSION["sOfficer"];?></span>)

		<DIV id="menu2" bgcolor="#FFFFFF" style="position: absolute; display:none; ">
			<TABLE width="300" bgcolor="#FFFFFF" style="font-family:'MS Sans Serif'; font-size:14px;">
			<TR>
			<TD><a href="javascript:void(0);" Onclick="add_span2('<?php echo $_SESSION["sOfficer"];?>');">ผู้ login</A></TD>
			</TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');">เว้นว่าง</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('ปรีชาวรรณ อินอ่อน');">พ.ต.หญิงปรีชาวรรณ อินอ่อน</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('อาทิตยา อากรปรุ');">พ.ต.หญิงอาทิตยา อากรปรุ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('วราภรณ์ ศรีรัตนา');">ร.ท.หญิงวราภรณ์ ศรีรัตนา</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('จิราภรณ์ คำวงสา');">ร.ต.หญิงจิราภรณ์ คำวงสา</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('จันทนา อินทรผูก');">นางสาวจันทนา อินทรผูก</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('บัญญัติ ศรีวรกุลวงค์');">จ.ส.อ.บัญญัติ ศรีวรกุลวงค์</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('จันทร์เพ็ญ ยศแก้วอุด');">จ.ส.อ.หญิงจันทร์เพ็ญ ยศแก้วอุด</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('พยอม สมศิริ');">จ.ส.อ.หญิงพยอม สมศิริ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('ศกุนิชญ์ ใจการ');">จ.ส.อ.หญิงศกุนิชญ์ ใจการ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('สุรีรัตน์ คำปาเชื้อ');">ส.อ.หญิงสุรีรัตน์ คำปาเชื้อ</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('วันัสชฎา ชื่นเมือง');">ส.อ.หญิงวันัสชฎา ชื่นเมือง</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('ดลญา ณ นคร');">นางสาวดลญา ณ นคร</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('จรีรัตน์ ถิ่นจันทร์');">ร.อ.หญิง จรีรัตน์ ถิ่นจันทร์</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('ทิพย์วรรณ จันทราช');">จ.ส.อ.หญิง ทิพย์วรรณ จันทราช</A></TD>
			</TR>
			<TR>
				<TD><a href="javascript:void(0);" Onclick="add_span2('อภิรมย์ ศรีมูล');">ร.ท.หญิง อภิรมย์ ศรีมูล</A></TD>
			</TR>
			</TABLE>
		</DIV>


</font>
	</TD>
</TR>
<TR  style='line-height:15px;'>
		<TD colspan="1" align="center"><?php echo date("d/m/").(date("Y")+543)?>
	</TD>
	<TD colspan="1" align="center"><?php echo date("d/m/").(date("Y")+543)?>
	</TD>
</TR>


</TABLE>

</body>
</html>
<?php include("unconnect.inc");?>