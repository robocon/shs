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

$list_witness = array();
$list_witness2 = array();

array_push($list_witness,''); array_push($list_witness2,'**********  ห้องฉุกเฉิน ************');
//array_push($list_witness,'ปรีชาวรรณ อินอ่อน (GN)'); array_push($list_witness2,'พ.ต.หญิงปรีชาวรรณ อินอ่อน (GN)');
//array_push($list_witness,'อาทิตยา อากรปรุ (GN)'); array_push($list_witness2,'พ.ต.หญิงอาทิตยา อากรปรุ (GN)');
array_push($list_witness,'วราภรณ์ ศรีรัตนา (GN)'); array_push($list_witness2,'วราภรณ์ ศรีรัตนา (GN)');
//array_push($list_witness,'จิราภรณ์ คำวงสา (GN)'); array_push($list_witness2,'ร.ต.หญิงจิราภรณ์ คำวงสา (GN)');
array_push($list_witness,'จันทนา อินทรผูก (GN)'); array_push($list_witness2,'จันทนา อินทรผูก (GN)');
array_push($list_witness,'บัญญัติ ศรีวรกุลวงค์ (PN)'); array_push($list_witness2,'บัญญัติ ศรีวรกุลวงค์ (PN)');
array_push($list_witness,'จันทร์เพ็ญ ยศแก้วอุด (PN)'); array_push($list_witness2,'จันทร์เพ็ญ ยศแก้วอุด (PN)');
array_push($list_witness,'พยอม สมศิริ (PN)'); array_push($list_witness2,'พยอม สมศิริ (PN)');
array_push($list_witness,'ศกุนิชญ์ ใจการ (PN)'); array_push($list_witness2,'ศกุนิชญ์ ใจการ (PN)');
array_push($list_witness,'สุรีรัตน์ คำปาเชื้อ (PN)'); array_push($list_witness2,'สุรีรัตน์ คำปาเชื้อ (PN)');
array_push($list_witness,'วันัสชฎา ชื่นเมือง (PN)'); array_push($list_witness2,'วันัสชฎา ชื่นเมือง (PN)');
//array_push($list_witness,'ดลญา ณ นคร (PN)'); array_push($list_witness2,'นางสาวดลญา ณ นคร (PN)');
//array_push($list_witness,'จรีรัตน์ ถิ่นจันทร์ (GN)'); array_push($list_witness2,'ร.อ.หญิง จรีรัตน์ ถิ่นจันทร์ (GN)');
array_push($list_witness,'ทิพย์วรรณ จันทราช (PN)'); array_push($list_witness2,' ทิพย์วรรณ จันทราช (PN)');
array_push($list_witness,'อภิรมย์ ศรีมูล (GN)'); array_push($list_witness2,' อภิรมย์ ศรีมูล (GN)');
array_push($list_witness,'อัจฉราภรณ์ สายเครือคำ (GN)'); array_push($list_witness2,'อัจฉราภรณ์ สายเครือคำ (GN)');
array_push($list_witness,'เทพินทร์ ศิริพรวัฒนะกุล  (GN)'); array_push($list_witness2,'เทพินทร์ ศิริพรวัฒนะกุล  (GN)');
array_push($list_witness,'วิลาวรรณ ศรีฟอง (GN)'); array_push($list_witness2,'วิลาวรรณ ศรีฟอง (GN)');
array_push($list_witness,'ณัฐกฤตา มหาวัน (GN)'); array_push($list_witness2,'ณัฐกฤตา มหาวัน (GN)');
array_push($list_witness,'ปริญญา หนูเมือง ');
array_push($list_witness2,'ปริญญา หนูเมือง ');
array_push($list_witness,'พูนทรัพย์ ใจคำสุข '); 
array_push($list_witness2,'พูนทรัพย์ ใจคำสุข ');
array_push($list_witness,'นิโลบล อวยพร '); 
array_push($list_witness2,'นิโลบล อวยพร ');

array_push($list_witness,'ปิยธิดา ลัดดี '); 
array_push($list_witness2,'ปิยธิดา ลัดดี ');

array_push($list_witness,'พัชรีญา ริยาพันธ์'); 
array_push($list_witness2,'พัชรีญา ริยาพันธ์');


array_push($list_witness,''); array_push($list_witness2,'**********  ห้องจักษุ ************');
array_push($list_witness,'ศิริลักษณ์ เหมืองทอง'); array_push($list_witness2,'พท.หญิงศิริลักษณ์ เหมืองทอง');
array_push($list_witness,'พยอม สมศิร'); array_push($list_witness2,'จสอ.หญิง พยอม สมศิริ');
array_push($list_witness,'กนกพร ไชยโส'); array_push($list_witness2,'นางสาว กนกพร ไชยโส');

$count_list_witness = count($list_witness);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ใบยินยอม </TITLE>
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
</HEAD>

<BODY>

<TABLE  border="1" bordercolor="#3366FF">
	<TR>
		<TD>
		<FORM METHOD=GET ACTION="print_consent.php" target="_blank">
		<TABLE >
		<TR>
			<TD class="font_title" align="center" bgcolor="#3366FF" colspan="2">
		<B>ใบยินยอม</B>
		</TD>
		</TR>
		<TR>
			<TD valign="top" align="right">
				สถานะการยินยอม&nbsp;:&nbsp;
			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="permit" value="ยินยอม" Checked>&nbsp;ยินยอม<BR>
				<INPUT TYPE="radio" NAME="permit" value="ไม่ยินยอม">&nbsp;ไม่ยินยอม<BR>
				<INPUT TYPE="radio" NAME="permit" value="ผู้ป่วยไม่รู้สึกตัวและมีความจำเป็นต้องรักษาในขั้นด่วน">&nbsp;ผู้ป่วยไม่รู้สึกตัวและมีความจำเป็นต้องรักษาในขั้นด่วน
			</TD>
		</TR>
		<TR>
			<TD valign="top" align="right">
				ผู้ลงชื่อ&nbsp;:&nbsp;
			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="pt" value="ผู้ป่วย" Checked>&nbsp;ผู้ป่วย <BR><INPUT TYPE="radio" NAME="pt" value="ผู้แทน">&nbsp;ผู้แทน&nbsp;<INPUT TYPE="text" NAME="pt_val" size="10">
			</TD>
		</TR>
		<?php if($_GET["id"] != ""){?>
		<TR>
			<TD valign="top" align="right">
			หัตภการ&nbsp;:&nbsp;
			</TD>
			<TD>
				<?php
					
					$sql = "Select lst_labcare From trauma_lst_labcare where for_id = '".$_GET["id"]."' ";
					$result = Mysql_Query($sql);
					while($arr = Mysql_fetch_assoc($result)){
						echo "<INPUT TYPE=\"checkbox\" NAME=\"list_lab[]\" value=\"".$list_labcare[$arr["lst_labcare"]]."\">&nbsp;".$list_labcare[$arr["lst_labcare"]]."<BR>";
					}

					$sql = "Select labcare From trauma_labcare  where for_id = '".$_GET["id"]."' AND amount > 0 AND labcare !='' ";
					$result = Mysql_Query($sql);
					while($arr = Mysql_fetch_assoc($result)){
						echo "<INPUT TYPE=\"checkbox\" NAME=\"list_lab[]\" value=\"".$arr["labcare"]."\">&nbsp;".$arr["labcare"]."<BR>";
					}

				?>
			</TD>
		</TR>
		<?php } ?>
		<TR>
			<TD align="right">
			HN&nbsp;:&nbsp;
			</TD>
			<TD>
			<INPUT TYPE="text" NAME="hn" value="<?php echo $_GET["hn"]?>">
			</TD>
		</TR>
		<TR>
			<TD align="right">
			แพทย์&nbsp;:&nbsp;
			</TD>
			<TD>
			<INPUT TYPE="text" NAME="doctor" id="doctor">
			<?php
			echo "&nbsp;&nbsp;ตัวช่วย&nbsp;:&nbsp;";
				echo "<Select name=\"doctor2\" onchange=\"document.getElementById('doctor').value = this.value;\">";
				echo "<Option value='                         '>เว้นว่าง</Option>";
				$sql = "Select name From doctor where status = 'y' and erstatus='y' AND row_id > 0";
				$result = Mysql_Query($sql);
				$i=1;
				while($arr = Mysql_fetch_assoc($result)){
					echo "<Option value=\"".substr($arr["name"],6)."\" ";
						if($_GET["doctor"] == $arr["name"]) echo " Selected ";
					echo ">".substr($arr["name"],5)."</Option>";
				}
				echo "</Select>";
			
			?>
			</TD>
		</TR>
		<TR>
			<TD align="right">
			พยานผู้ป่วย&nbsp;:&nbsp;
			</TD>
			<TD>
			<INPUT TYPE="text" NAME="witness_pt" id="witness_pt">
			<?php
			echo "&nbsp;&nbsp;ตัวช่วย&nbsp;:&nbsp;";
			echo "<Select Name=\"witness_pt2\" onchange=\"document.getElementById('witness_pt').value = this.value;\">";
			echo "<Option value='                         '>เว้นว่าง</Option>";
			echo "<Option value='ผู้ป่วยมาคนเดียว'>ผู้ป่วยมาคนเดียว</Option>";
			for($i=0;$i<$count_list_witness;$i++){
			echo "<Option value='".$list_witness[$i]."'>".$list_witness2[$i]."</Option>";
			}
			
			echo "</Select>";
			?>
			</TD>
		</TR>
		<TR>
			<TD align="right">
			พยานแพทย์&nbsp;:&nbsp;
			</TD>
			<TD>
			<?php
			echo "<Select Name=\"witness_dc\">";
			echo "<Option value='                         '>เว้นว่าง</Option>";
			for($i=0;$i<$count_list_witness;$i++){
			echo "<Option value='".$list_witness[$i]."'>".$list_witness2[$i]."</Option>";
			}
			echo "</Select>";
			?>
			</TD>
		</TR>
		<TR>
			<TD colspan="2" align="center">
				<INPUT TYPE="submit" value=" ตกลง ">
			</TD>
		</TR>

		</TABLE>
		</FORM>

</BODY>
</HTML>
