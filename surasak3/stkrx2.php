<?php
session_start();
include("connect.inc");  


if(isset($_POST["save_rx"])){
	
	$j = 0;
	$count = count($_POST["bring_amount"]);
	for($i=0;$i<$count;$i++)
		if(trim($_POST["bring_amount"][$i]) !="")
			$j++;
	
	if($j > 0){
	$sql = "INSERT INTO `bring` (`bring_no` ,`bring_date` ,`office` )VALUES ( '".$_POST["bring_no"]."', '".(date("Y")+543).date("-m-d")."', '".$_SESSION["sIdname"]."'); ";
	$result = Mysql_Query($sql) or die(Mysql_Error()); 
	$idno=mysql_insert_id();

	
	if($result){
	for($i=0;$i<$count;$i++){
		
		if(trim($_POST["bring_amount"][$i]) !=""){

		$sql = "INSERT INTO `bring_detail` (`row_id` ,`bring_id` ,`drugcode` ,`bring_amount` )VALUES (NULL , '".$idno."', '".$_POST["drugcode"][$i]."', '".$_POST["bring_amount"][$i]."');";
		$result = Mysql_Query($sql) or die(Mysql_Error()); 
		}

	}
	echo "<BR>
	<CENTER>ส่งใบเบิกเรียบร้อยแล้ว</CENTER>
	";
	}else{
	echo "<BR>
	<CENTER>ส่งใบเบิกไม่ได้</CENTER>
	";
	}
	
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"5;URL=stkrx2.php\">";
	}else{
		echo "
		<SCRIPT LANGUAGE=\"JavaScript\">

			alert('กรุณาพิมพ์ จำนวนยาที่ต้องการเบิกอยากน้อย 1 รายการ');		

		</SCRIPT>
		";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=stkrx2.php\">";
	}


exit();

}

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> เบิกยาและเวชภัณฑ์ </TITLE>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 16 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 16 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
<SCRIPT LANGUAGE="JavaScript">
	function check_number() {
	e_k=event.keyCode
	if (e_k != 13 && e_k != 45 && (e_k < 48) || (e_k > 57)) {
	event.returnValue = false;
	alert("กรุณากรอกเป็นตัวเลขเท่านั้น");
	return false;
	}
	}
</SCRIPT>
</HEAD>
<BODY>

<?php
	
	switch($_SESSION["sIdname"]){
		//1
		case "พรรณี": 
			$where[0] = "Drugcode in ('1DIGO','1ENDO*', '1COUM-C3', '1COUM-C5', '1MTX', '2ADRE', '2ATR0.6~', '2CA', '2DOBU-C', '2DOPA', '2HEPA5', '2KCL', '2LANO', '2MGS10', '2MGS50', '2SODB', '2SODN', '2STRE') ";
			
		break;
		//2
		case "ชฎาพร": 
			$where[0] = "Drugcode in ('1D2', '1DAFL', '1DALA-C', '1DANA', '1DANZ-C', '1DAPS', '1DDI250*', '1DEAN', '1DELT', '1DEPA5C', '1DETSR', '1DEXT', '1DIAB-C', '1DIAM-MR', '1DIC250', '1DIC500', '1DIFL200$', '1DIL625', '1DIL625-C', '1DILA', '1DILAT*', '1DISMR', '1DIUT') ";
			
			$where[1] = "Drugcode in ('1DOQ500', '1DOXY', '1DRAM', '1DUXA*', '1DYAZ-C', '1EBIX', '1ENCE', '1EPIV*', '1EPIV-C*', '1ERYT', '1ESSE', '1ESTR', '1EUGL-C', '1EZET', '1EXFO', '1FBC', '1FLEM', '1FOLI', '1FUL500', '1GANA', '1GASM', '1GLUC') ";

			$where[2] = "Drugcode in ('1GPO30*', '1HALO.5', '1HAR0.4', '1HCTZ', '1HERB', '1HYDE-C', '1HYDEF', '1HYPE', '1IMDU', '1IMOD', '1INDE10-C', '1INDE40-C', '1INDO', '1INH', '1INVI', '1ISMO', '1ISOPSR', '1ISOR10', '1ISOR5', '1JANU.', '1JUME-C', '1KALE*', '1KLA500-C*', '1KREM')";

			break;
//3
			case "รุ่งทิวา": 
			
$where[0] = "Drugcode in ('AIR0', 'AIR00', 'AIR1', 'AIR2', 'AIR3', 'AIR4', 'AIR5', 'ARML-L', 'ARML-M', 'ARML-S', 'BLSET', 'BLUE', 'CLAL', 'CLAM', 'CLAS', 'CLAXL', 'COLDH', 'COLL', 'COLM', 'COLOF3', 'COLOF4', 'COLS', 'COND', 'CONT-E', 'CONT-N', 'CONU', 'CONY11/9', 'COT0.35', 'COT1.4', 'COT1LB', 'COTS', 'CRUTL', 'CRUTM', 'CRUTS', 'CRUTXL', 'CRUTXXL', 'CUT4.5', 'EB3')";

$where[1] = "Drugcode in ('EB4', 'EB6', 'ET2.0', 'ET2.5', 'ET3.0', 'ET3.5', 'ET4.0', 'ET4.5', 'ET5.0', 'ET5.5', 'ET6.0', 'ET6.5', 'ET7.0', 'ET7.5', 'ET8.0', 'EXT18', 'FMAS-E', 'FOL2W12', 'FOL2W14', 'FOL2W16', 'FOL2W18', 'FOL2W22', 'FOL2W24', 'FOL3W16', 'FOL3W18', 'FS-G', 'GBS3', 'GSYR50C', 'INJP', 'IVC16', 'IVC18', 'IVC20', 'IVC22', 'IVC24', 'IVC24J', 'IVS', 'IVSP', 'KNSPL', 'KNSPM', 'KNSPXL', 'KNSPXXL', 'LSL', 'LSM', 'LSXL', 'LSXXL')";


$where[2] = "Drugcode in ('LSXXXL', 'MEDIL1.5', 'MEDIL3.0', 'MEDIT1.8', 'MEDIT3.0', 'MIC1', 'MICRD', 'NEBP', 'NEBS', 'M-JS@', 'NG14', 'NG16', 'NG18', 'OCAN', 'OMASA', 'OMASB', 'OMASP', 'OTUB', 'REDOV400', 'REDT12', 'SKINA', 'SKINC', 'SOLU', 'SPIN18', 'SPIN21', 'SPIN22', 'SPIN23', 'SPLI', 'SUCT10', 'SUCT12', 'SUCT14', 'SUCT16', 'SUCT18', 'SUCT5', 'SUCT6', 'SUCT8', 'SYR10', 'SYR1I', 'SYR20', 'SYR3', 'SYR5', 'TEGAL', 'TEGAS', 'THOR28', 'THOR32', 'THREW', 'TRAM-A')";

$where[3] = "Drugcode in ('TRAT7.0', 'TRAT7.5', 'TRAT8', 'TRAT9', 'TS1', 'TTSIL6', 'TTSIL8', 'TTSIL9', 'URINB', 'URINC', 'URINO', 'WALK1', 'WALK3', 'WALK4', 'WRSL', 'WRSS')";
			break;

			case "นวลนภา": 
			$where[0] = "Drugcode in ('1ACA2', '1ACTI*', '1ACTOS*', '1ADA10-C', '1ADA20-C', '1ADA5-C', '1AERI', '1AGGR', '1AIR', '1ALUV', '1ALDA100', '1ALDA25', '1ALDO250', '1ALLO3', '1ALUM')";

			$where[1] = "Drugcode in ('1AMLO10', '1AMAR', '1AMOX250', '1AMOX500', '1AMOX625', '1APRE25', '1APRO', '1ARIC*', '1ARTE', '1ASA1', '1ASA100', '1ASA5', '1ATAR-C', '1AUGM1', '1AVAN*', '1AVEL', '1AVOD', '1AZT100-C*', '1B1612', '1BAMB', '1BETA-C', '1BISO-C', '1BLOP16*')";


			$where[2] = "Drugcode in ('1BRI2.5', '1BRIN', '1BRU400', '1BUS-C', '1CAFE-C', '1CARD', '1CARXL', '1CEPH', '1CHLO', '1CINN', '1CIPR-C', '1CLAR-C', '1CLAS', '1CLOT', '1CODI160', '1CODIC')";

			$where[3] = "Drugcode in ('1CODI', '1COLC-C', '1COLO', '1COMB', '1CONC', '1CONT40', '1CORD*', '1COTR4', '1COTR8', '1COUM-C3', '1COUM-C5', '1COVE', '1CPM', '1CRAV*', '1CRES20', '1CRIX', '1CYPR')";

			break;

			case "อภิระดี": 

$where[0] = "Drugcode in ('1RANI', '1RASI', '1RENI20-C', '1RENI5-C', '1RIF300', '1RIF450', '1RIV0.5', '1RIV2', '1ROPE', '1ROWA*', '1RUL150-C', '1SALA', '1SDZ', '1SEBI', '1SENO', '1SER30*', '1SERC', '1SIBE-C', '1SINE100')";

$where[1] = "Drugcode in ('1SINE250', '1SING', '1SINU', '1SIRD', '1SODA', '1SPAS', '1SPOR-C$', '1STABL*', '1STO600', '1SUDO', '1SULF', '1SUPR*', '1T5-C', '1TANZ', '1TAPA', '1TAR300', '1TARI-C', '1TEG_CR', '1TELF180', '1THEO2-C', '1THYR', '1TOPA')";

$where[2] = "Drugcode in ('1TRAM100', '1TRAN*', '1TREN*??', '1TRIT5', '1TRIV', '1TRYP10', '1UCHO*', '1ULTR', '1UNAT', '1URA', '1UTMO', '1VAS35', '1VESI', '1VIRE', '1VITBCO', '1VITC100', '1VOL-C', '1VOLSR')";

$where[3] = "Drugcode in ('1XA.5-C', '1XANXR' '1XAT10', '1XENI*', '1XYZA', '1ZANI', '1ZEBE', '1ZER30-C*', '1ZITH*', '1ZOCO10', '1ZOCO40-C*', '1ZOLO', '1ZOV200-C', '1ZOV800-C', '1ZYRT-C')";
			

			break;

			case "คมพยนตร์": 

$where[0] = "Drugcode in ('5AERI', '5AIRX', '5ALUM', '5AMOX', '5AMOX250', '5AUG35', '5BERC', '5BISO', '5BRON', '5BRU', '5CAR180', '5CEFS')";

$where[1] = "Drugcode in ('5CLOX', '5COTR', '5CPM', '5DUPH100', '5ERY', '5FLUI2', '5FLUI2', '5FYBO', '5GAVI', '5HYDRO', '5KCL', '5KCL', '5KIDD', '5LEVO')";

$where[2] = "Drugcode in ('5MEPT', '5MOM', '5MOTI-C', '5MTV', '5ORED', '5ORS', '5PAR250', '5PARD', '5PARS')";
 
$where[3] = "Drugcode in ('5SINU', '5SMEC', '5TUS180', '5ZEBE', '5ZITH*$', '5ZMAX', '5ZYR')";

			break;

			case "เพ็ชรรัตน์": 

$where[0] = "Drugcode in ('4ACYC5', '4ALC450', '4ALC60', '4BENZ', '4BET', '4BETS', '4CALA60', '4CAPS', '4CLIM*', '4CLOT', '4COAL', '4CURI', '4DAIV*$', '4DERO', '4DIPO', '4DMV100', '4DMV5')";

$where[1] = "Drugcode in ('4DUOF', '4ELME', '4ELOC$', '4ELOL$', '4EXEL', '4FUCI5', '4LACT', '4MEBO', '4MET25', '4MICO', '4NIZO', '4PLAI', '4POLYL', '4POVI60', '4SARN', '4SIL25', '4TA1', '4TA2')";

$where[2] = "Drugcode in ('4TAS', '4URE30', '4VOLT-C', '4ZINC', '6CHLEYE10', '6CHLOO', '6DEXA', '6HIST', '6OP100', '6TARI*', '6WAXE', '7BERF', '7BERSO', '7BERSP', '7BUDE', '7DIFF', '7ILI25')";

$where[3] = "Drugcode in ('7ILI5', '7KAMI', '7KENA', '7NASA', '7NASON', '7PULR', '7PULT', '7SERE50', '7SPI*', '7SPI+H*', '7SYMB', '7VENI', '7VENN')";

$where[4] = "Drugcode in ('7XYV125', '8COT5', '8DULA', '8GYNE-C', '8OEST*', '8SCHEO', '8SCHES', '8UNIM', '9ULTR', '11KETO*', '11NEPH', '11DLC-J')";


			break;

			case "ดวงพร": 

$where[0] = "Drugcode in ('0EB1.0', '0FAVI', '0MMR', '0TT_B', '0VERO', '2AUGM', '2ESPO', '2FUNG', '2HUMUN', '2LANT', '2MERC', '2NALA', '2RECO', '2STRE', '2OCTE', '2PEGA', '3ALBU25', '7MIAC')";

			break;

			case "นาฏยา": 

$where[0] = "Drugcode in ('1ACT35', '1ARCO', '1ARA20', '1BONV', '1BREX', '1CALC', '1CALTR', '1CELE200*', '1CELV*', '1CALSG', '1CHAL', '1FOS70', '1LOXO')";

 $where[1] = "Drugcode in ('1MECO', '1MUCT', '1MYDO-C', '1NEUT100$', '1NEUT300$', '1NEX40', '1NID', '1NORF', '1ORKE', '1OSSO', '1PARI', '5VIAT-C', '1VIAT500', '5PROT', '5VIAT', '5FLEX')";


			break;

			case "สุทธาทิพย์": 

$where[0] = "Drugcode in ('1LAMI*', '1LARG', '1LAS40-C', '1LAS500-C', '1LEGA', '1LESC80*??', '1LEX400-C', '1LEXA', '1LEXE', '1LIBR-C', '1LIOR', '1LIPI*??', '1LITH', '1LIVI*', '1LONI', '1LOP900')";

$where[1] = "Drugcode in ('1LOPI-C', '1MADI', '1MADO125', '1MADO250', '1MAGE', '1MAI', '1MEIA', '1MEP25', '1MEP50', '1MERI', '1MET850', '1METAD', '1METF', '1METR', '1MEVA40*?', '1MICA40', '1MINI1-C', '1MINID', '1MIRA')";


$where[2] = "Drugcode in ('1MOBI', '1MODU-C', '1MOTI-C', '1MTV', '1MULT', '1MYAM-C', '1MYBA', '1MYON', '1NAC-LO', '1NATR', '1NEOT*!', '1NEU300-C', '1NICO', '1NIZO-C', '1NORVA10*', '1NORVA5*', '1NORVI*', '1NOTE', '1NOVO', '1OBIM', '1OLME40', '1OMNI$')";


$where[3] = "Drugcode in ('1PARA325', '1PARA500', '1PENV250', '1PER4', '1PERM', '1PHEN60', '1PLAQ', '1PLAS-C', '1PLAV*', '1PLAV*-C', '1PLEN10', '1PLEN5', '1PLET*', '1PONS', '1PRED', '1PREV', '1PRIM15', '1PROV10', '1PROZ-C$', '1PTU', '1PYRI', '1PZA', '1QUIN')";


			break;

	}

?>

<A HREF="..\nindex.htm">&lt;&lt; เมนู</A>&nbsp;|&nbsp;<A HREF="list_stkrx2.php" target="_blank">รายการเบิกยา</A>

<SCRIPT LANGUAGE="JavaScript">

	function checkForm(){
		if(document.f1.bring_no.value ==""){
			alert("กรุณากรอกเลขที่ใบเบิก");
			return false;
		}else{
			return true;
		}
	}

</SCRIPT>

<FORM METHOD=POST ACTION="" name="f1" Onsubmit="return checkForm();">
<TABLE  border="1" bordercolor="#3366FF">
<TR>
	<TD>
เลขที่ใบเบิก : <INPUT TYPE="text" NAME="bring_no"><BR>
<?php
$count = count($where);

echo "<TABLE width='800' border='1' bordercolor='#000000' style='BORDER-COLLAPSE: collapse'>
<TR align='center' bgcolor='#3366FF' class='font_title'>
	<TD>No.</TD>
	<TD>DRUGCODE</TD>
	<TD>รายการ</TD>
	<TD>Max</TD>
	<TD>ขอเบิก</TD>
</TR>";
$j=0;
for($i=0; $i<$count ;$i++){
$sql = "Select drugcode, tradname, (case when(bring_max != 0) then bring_max else 999999 end) as bring_max  From druglst where ".$where[$i]." Order by Drugcode ASC";

$result = Mysql_Query($sql);

while($arr = Mysql_fetch_assoc($result)){
echo "<TR>
	<TD align='center'>",++$j,"</TD>
	<TD>&nbsp;",$arr[drugcode],"</TD>
	<TD>&nbsp;",$arr[tradname],"</TD>
	<TD>&nbsp;";

	if($arr[bring_max]!=999999) echo $arr[bring_max];

	echo "</TD>
	<TD align='center'>จำนวน : <INPUT TYPE=\"text\" NAME=\"bring_amount[]\" size='5' onKeypress=\"check_number(); if ( (e_k >= 48) && (e_k <= 57))if(eval(this.value+String.fromCharCode(event.keyCode))>".$arr["bring_max"]."){ alert('ยาตัวนี้เบิกได้ไม่เกิน ".$arr["bring_max"]." ครับ');return false; }\">
		<INPUT TYPE=\"hidden\" name=\"drugcode[]\" value=\"",$arr[drugcode],"\">
	</TD>
</TR>";

}

}

echo "<TR>
	<TD align='center' colspan='5'><INPUT TYPE=\"submit\" name=\"save_rx\" value=\" บันทึก \"></TD>
</TR>";
echo "</TABLE>";
?></TD>
</TR>
</TABLE>
</FORM>
</BODY>
</HTML>
<?php
include("unconnect.inc");
?>
