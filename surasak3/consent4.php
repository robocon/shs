<?php

session_start();
include("connect.inc");

$list_labcare["L01"] = "-------";
$list_labcare["L28"] = "���µ� / �Դ��";
$list_labcare["L29"] = "�մ��� ER / IM";
$list_labcare["L30"] = "�մ��� ER / IV";
$list_labcare["L31"] = "�մ��� ER / SC";
$list_labcare["L15"] = "��� DTX";
$list_labcare["L16"] = "������ʹ / �� specimen";
$list_labcare["L32"] = "������մ����� (Synvise / GO-ON / KA / Hyruan)";
$list_labcare["L33"] = "������մ Needle puncture";
$list_labcare["L34"] = "������մ KA";
$list_labcare["L35"] = "����� Aspirate cyst";
$list_labcare["L52"] = "Anterior nasal packing";
$list_labcare["L54"] = "Accupunture";
$list_labcare["L60"] = "Abdominal Tapping";
$list_labcare["L47"] = "aspirate Nail/Aspirate knee/Aspirate hematoma";
$list_labcare["L45"] = "Cold compression";
$list_labcare["L58"] = "CPR";
$list_labcare["L67"] = "Close Reduction";
$list_labcare["L17"] = "Dressing wound";
$list_labcare["L66"] = "Drip ��";
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
$list_labcare["L03"] = "On 02 � Sat.";					
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
$list_labcare["L43"] = "On jones �bandage";
$list_labcare["L44"] = "On skin traction";
$list_labcare["L11"] = "Off Cast"; 
$list_labcare["L12"] = "On IVF";
$list_labcare["L13"] = "On Plug / Lock";
$list_labcare["L14"] = "On Blood";
$list_labcare["L21"] = "On NG tube";
$list_labcare["L48"] = "Off NG-Tube";
$list_labcare["L23"] = "On Foley�s catheter";
$list_labcare["L51"] = "Off Foley�s catheter";
$list_labcare["L56"] = "On ET-Tube/ on TT-Tube";
$list_labcare["L53"] ="Pack gauze";
$list_labcare["L63"] ="PR";
$list_labcare["L64"] ="PV";
$list_labcare["L27"] = "Remove FB";
$list_labcare["L18"] = "Suture"; 
$list_labcare["L19"] = "Stitches � off";
$list_labcare["L24"] = "Single catheter / intermittent cath";
$list_labcare["L25"] = "Sponge bath";
$list_labcare["L55"] ="Suction";
$list_labcare["L59"] ="Thoracentesis/ thoracocentesis";
$list_labcare["L62"] ="Throat Swab";
$list_labcare["L68"] ="Xylocaine block";

$list_witness = array();
$list_witness2 = array();

array_push($list_witness,''); array_push($list_witness2,'**********  ��ͧ�ء�Թ ************');
//array_push($list_witness,'��ժ���ó �Թ��͹ (GN)'); array_push($list_witness2,'�.�.˭ԧ��ժ���ó �Թ��͹ (GN)');
//array_push($list_witness,'�ҷԵ�� �ҡû�� (GN)'); array_push($list_witness2,'�.�.˭ԧ�ҷԵ�� �ҡû�� (GN)');
array_push($list_witness,'����ó� ����ѵ�� (GN)'); array_push($list_witness2,'����ó� ����ѵ�� (GN)');
//array_push($list_witness,'�����ó� ��ǧ�� (GN)'); array_push($list_witness2,'�.�.˭ԧ�����ó� ��ǧ�� (GN)');
array_push($list_witness,'�ѹ��� �Թ�ü١ (GN)'); array_push($list_witness2,'�ѹ��� �Թ�ü١ (GN)');
array_push($list_witness,'�ѭ�ѵ� ����á��ǧ�� (PN)'); array_push($list_witness2,'�ѭ�ѵ� ����á��ǧ�� (PN)');
array_push($list_witness,'�ѹ����� ������ش (PN)'); array_push($list_witness2,'�ѹ����� ������ش (PN)');
array_push($list_witness,'���� ������ (PN)'); array_push($list_witness2,'���� ������ (PN)');
array_push($list_witness,'ȡعԪ�� 㨡�� (PN)'); array_push($list_witness2,'ȡعԪ�� 㨡�� (PN)');
array_push($list_witness,'�����ѵ�� �ӻ����� (PN)'); array_push($list_witness2,'�����ѵ�� �ӻ����� (PN)');
array_push($list_witness,'�ѹ�ʪ�� ������ͧ (PN)'); array_push($list_witness2,'�ѹ�ʪ�� ������ͧ (PN)');
//array_push($list_witness,'�ŭ� � ��� (PN)'); array_push($list_witness2,'�ҧ��Ǵŭ� � ��� (PN)');
//array_push($list_witness,'����ѵ�� ��蹨ѹ��� (GN)'); array_push($list_witness2,'�.�.˭ԧ ����ѵ�� ��蹨ѹ��� (GN)');
array_push($list_witness,'�Ծ����ó �ѹ��Ҫ (PN)'); array_push($list_witness2,' �Ծ����ó �ѹ��Ҫ (PN)');
array_push($list_witness,'������� ������ (GN)'); array_push($list_witness2,' ������� ������ (GN)');
array_push($list_witness,'�Ѩ����ó� ������ͤ� (GN)'); array_push($list_witness2,'�Ѩ����ó� ������ͤ� (GN)');
array_push($list_witness,'෾Թ��� ���Ծ��Ѳ�С��  (GN)'); array_push($list_witness2,'෾Թ��� ���Ծ��Ѳ�С��  (GN)');
array_push($list_witness,'������ó ��տͧ (GN)'); array_push($list_witness2,'������ó ��տͧ (GN)');
array_push($list_witness,'�Ѱ�ĵ� ����ѹ (GN)'); array_push($list_witness2,'�Ѱ�ĵ� ����ѹ (GN)');
array_push($list_witness,'��ԭ�� ˹����ͧ ');
array_push($list_witness2,'��ԭ�� ˹����ͧ ');
array_push($list_witness,'�ٹ��Ѿ�� 㨤��آ '); 
array_push($list_witness2,'�ٹ��Ѿ�� 㨤��آ ');
array_push($list_witness,'���ź� ��¾� '); 
array_push($list_witness2,'���ź� ��¾� ');

array_push($list_witness,'��¸Դ� �Ѵ�� '); 
array_push($list_witness2,'��¸Դ� �Ѵ�� ');

array_push($list_witness,'�Ѫ�խ� ���Ҿѹ��'); 
array_push($list_witness2,'�Ѫ�խ� ���Ҿѹ��');


array_push($list_witness,''); array_push($list_witness2,'**********  ��ͧ�ѡ�� ************');
array_push($list_witness,'�����ѡɳ� ����ͧ�ͧ'); array_push($list_witness2,'��.˭ԧ�����ѡɳ� ����ͧ�ͧ');
array_push($list_witness,'���� �����'); array_push($list_witness2,'���.˭ԧ ���� ������');
array_push($list_witness,'����� ����'); array_push($list_witness2,'�ҧ��� ����� ����');

$count_list_witness = count($list_witness);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> ��Թ��� </TITLE>
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
		<B>��Թ���</B>
		</TD>
		</TR>
		<TR>
			<TD valign="top" align="right">
				ʶҹС���Թ���&nbsp;:&nbsp;
			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="permit" value="�Թ���" Checked>&nbsp;�Թ���<BR>
				<INPUT TYPE="radio" NAME="permit" value="����Թ���">&nbsp;����Թ���<BR>
				<INPUT TYPE="radio" NAME="permit" value="�������������֡�������դ������繵�ͧ�ѡ��㹢�鹴�ǹ">&nbsp;�������������֡�������դ������繵�ͧ�ѡ��㹢�鹴�ǹ
			</TD>
		</TR>
		<TR>
			<TD valign="top" align="right">
				���ŧ����&nbsp;:&nbsp;
			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="pt" value="������" Checked>&nbsp;������ <BR><INPUT TYPE="radio" NAME="pt" value="���᷹">&nbsp;���᷹&nbsp;<INPUT TYPE="text" NAME="pt_val" size="10">
			</TD>
		</TR>
		<?php if($_GET["id"] != ""){?>
		<TR>
			<TD valign="top" align="right">
			�ѵ����&nbsp;:&nbsp;
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
			ᾷ��&nbsp;:&nbsp;
			</TD>
			<TD>
			<INPUT TYPE="text" NAME="doctor" id="doctor">
			<?php
			echo "&nbsp;&nbsp;��Ǫ���&nbsp;:&nbsp;";
				echo "<Select name=\"doctor2\" onchange=\"document.getElementById('doctor').value = this.value;\">";
				echo "<Option value='                         '>�����ҧ</Option>";
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
			��ҹ������&nbsp;:&nbsp;
			</TD>
			<TD>
			<INPUT TYPE="text" NAME="witness_pt" id="witness_pt">
			<?php
			echo "&nbsp;&nbsp;��Ǫ���&nbsp;:&nbsp;";
			echo "<Select Name=\"witness_pt2\" onchange=\"document.getElementById('witness_pt').value = this.value;\">";
			echo "<Option value='                         '>�����ҧ</Option>";
			echo "<Option value='�������Ҥ�����'>�������Ҥ�����</Option>";
			for($i=0;$i<$count_list_witness;$i++){
			echo "<Option value='".$list_witness[$i]."'>".$list_witness2[$i]."</Option>";
			}
			
			echo "</Select>";
			?>
			</TD>
		</TR>
		<TR>
			<TD align="right">
			��ҹᾷ��&nbsp;:&nbsp;
			</TD>
			<TD>
			<?php
			echo "<Select Name=\"witness_dc\">";
			echo "<Option value='                         '>�����ҧ</Option>";
			for($i=0;$i<$count_list_witness;$i++){
			echo "<Option value='".$list_witness[$i]."'>".$list_witness2[$i]."</Option>";
			}
			echo "</Select>";
			?>
			</TD>
		</TR>
		<TR>
			<TD colspan="2" align="center">
				<INPUT TYPE="submit" value=" ��ŧ ">
			</TD>
		</TR>

		</TABLE>
		</FORM>

</BODY>
</HTML>
