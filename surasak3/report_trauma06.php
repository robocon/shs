<?php
session_start();
include("connect.inc");

?>
<html>
<head>
<title>��ª��ͼ����� Refer</title>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
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
</head>
<body>

<?php
	
	
	$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "���� (�)";
	$list_ptright["P03"] = "���� (��)";
	$list_ptright["P04"] = "���� (���)";
	$list_ptright["P05"] = "��ͺ����";
	$list_ptright["P06"] = "�.��";
	$list_ptright["P07"] = "�.";
	$list_ptright["P08"] = "��Сѹ�ѧ��";
	$list_ptright["P09"] = "30�ҷ";
	$list_ptright["P10"] = "30�ҷ�ء�Թ";
	$list_ptright["P11"] = "�ú.";
	$list_ptright["P12"] = "��.44";
	
	$take_care_value["1"] = " - ���Ѻ��ô��ŷѹ��<BR>";
	$doc_refer_value["1"] = " - � Refer<BR>";
	$nurse_value["1"] = " - ��Һ��<BR>";
	$assistant_nurse_value["1"] = " - ������<BR>";
	$estimate_value["1"] = " - Ẻ�����Թ þ.�ӻҧ ";
	$cradle_value["1"] = " - ��<BR>";
	$doc_txt_value["1"] = " - 㺺ѹ�֡��ͤ���<BR>";

	$suggestion_value["1"] = "- �����й�<BR>";

if(isset($_POST["submit"])){

		$_POST["d"] = sprintf('%02d',$_POST["d"]);

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

		$select_day2 = $_POST["yr2"]."-".$_POST["m2"]."-".$_POST["d2"];
		

		$day_now2 = $_POST["d2"];
		$month_now2 = $_POST["m2"];
		$year_now2 = $_POST["yr2"];

	}else{

		$select_day = (date("Y")+543).date("-m-d");
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

		$select_day2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543).date("-m-d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));

		$day_now2 = date("d",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$month_now2 = date("m",mktime(0,0,0,$month_now,$day_now+1,$year_now-543));
		$year_now2 = (date("Y",mktime(0,0,0,$month_now,$day_now+1,$year_now-543))+543);


	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='<?php echo $_SERVER["PHP_SELF"];?>'>
	<TABLE id="form_01">
	<TR>
		<TD>
		�ѹ���&nbsp;&nbsp; 
	<input type='text' name='d' size='2' value='<?php echo $day_now;?>'>&nbsp;&nbsp;
	��͹&nbsp; <input type='text' name='m' size='4' value='<?php echo $month_now;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr' size='8' value='<?php echo $year_now;?>'>
		</TD>
	</TR>
	<TR>
		<TD>
		�֧ �ѹ���&nbsp;&nbsp; 
	<input type='text' name='d2' size='2' value='<?php echo $day_now2;?>'>&nbsp;&nbsp;
	��͹&nbsp; <input type='text' name='m2' size='4' value='<?php echo $month_now2;?>'>&nbsp;&nbsp;&nbsp;
	�.�. <input type='text' name='yr2' size='8' value='<?php echo $year_now2;?>'>
		</TD>
	</TR>
	<TR>
		<TD>
			<TABLE>
			<TR>
				<TD><INPUT TYPE="checkbox" NAME="doc_refer" value="1" <?php if($_POST["doc_refer"] == "1") echo " Checked ";?>></TD>
				<TD>� Refer</TD>
				<TD><INPUT TYPE="checkbox" NAME="nurse" value="1" <?php if($_POST["nurse"] == "1") echo " Checked ";?>></TD>
				<TD>��Һ��</TD>
				<TD><INPUT TYPE="checkbox" NAME="assistant_nurse" value="1" <?php if($_POST["assistant_nurse"] == "1") echo " Checked ";?>></TD>
				<TD>������</TD>
				<TD><INPUT TYPE="checkbox" NAME="suggestion" value="1" <?php if($_POST["suggestion"] == "1") echo " Checked ";?>></TD>
				<TD>�����й�</TD>
			</TR>
			<TR valign="top">
				<TD><INPUT TYPE="checkbox" NAME="estimate" value="1" <?php if($_POST["estimate"] == "1") echo " Checked ";?>></TD>
				<TD>Ẻ�����Թ þ.�ӻҧ</TD>
				<TD><INPUT TYPE="checkbox" NAME="cradle" value="1" <?php if($_POST["cradle"] == "1") echo " Checked ";?>></TD>
				<TD>��</TD>
				<TD><INPUT TYPE="checkbox" NAME="doc_txt" value="1" <?php if($_POST["doc_txt"] == "1") echo " Checked ";?>></TD>
				<TD>㺺ѹ�֡��ͤ���</TD>
				<TD>&nbsp;</TD>
				<TD>&nbsp;</TD>
			</TR>
			<TR valign="top">
				<TD><INPUT TYPE="checkbox" NAME="coder" value="1" <?php if($_POST["coder"] == "1") echo " Checked ";?>></TD>
				<TD>����� Coder</TD>
			</TR>
			</TABLE>
		</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>

	</TABLE>
	</form>
<?php

if(isset($_POST["submit"])){

		//$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		
		

		$where = "  ( `date_in`  between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND `cure` = 'refer' ";
		
		if($_POST["doc_refer"] == "1"){ $where .= " AND doc_refer = '1' "; }
		if($_POST["nurse"] == "1"){ $where .= " AND nurse = '1' "; }
		if($_POST["assistant_nurse"] == "1"){ $where .= " AND assistant_nurse = '1' "; }
		if($_POST["estimate"] == "1"){ $where .= " AND estimate = '1' "; }
		if($_POST["cradle"] == "1"){ $where .= " AND cradle = '1' "; }
		if($_POST["doc_txt"] == "1"){ $where .= " AND doc_txt = '1' "; }
		if($_POST["consult"] == "1"){ $where .= " AND consult = '1' "; }
		if($_POST["suggestion"] == "1"){ $where .= " AND suggestion = '1' "; }

		$sql = "Select   a.`row_id`, a.`vn`, a.`hn`, a.`an`, a.`dx`, a.`organ`, a.`maintenance`, a.`doctor`, CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) as `full_name`, `age`, `list_ptright`, left(`time_in`,5) as `left2in`, left(`time_out`, 5) as `left2`, `cure`, `admit_ward`, `refer_hospital`, CONCAT(a.`time_in`,' ',date_format(a.`date`,'%H:%i:%s')) as `h_date`, `time_in`, left(`time_diag`,5) as `time_diag2`, date_format(`date_in`,'%d/%m/%Y') as `date_in2`, `type_wounded`, `repeat`, `type_patient`, `cause_refer`, `doc_refer`,  `nurse`,  `assistant_nurse`,  `estimate`,  `cradle`, `doc_txt`,  `no_estimate`, b.`phone`, a.`consult`, `er_tell`, `suggestion`  
		From (
						SELECT * 
						FROM `trauma` 
						WHERE ".$where."
					) AS `a`, 
		`opcard` as `b` 
		where a.`hn` = b.`hn`  
		Order by `date_in` ASC, `h_date` ASC ";
		//echo $sql;
		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql) or die("<!-- ".Mysql_error()." -->");
		$rows = Mysql_num_rows($result);
		?>
�ӹǹ�����ŷ�����  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<?php if($_POST["coder"] == "1"){?>

<TR>
	<TD align="center">�ӴѺ</TD>
	<TD align="center">�.�.�.</TD>
	<TD align="center">HN</TD>
	<TD>�Ȫ���-ʡ��</TD>
	<TD align="center">����</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	<TD align="center">Dx.</TD>
</TR>

<?php }else{?>
<TR>
	<TD align="center">�ӴѺ</TD>
	<TD align="center">�.�.�.</TD>
	<TD align="center">���������ͧ��Ǩ</TD>
	<TD align="center">����refer</TD>
	<TD align="center">HN</TD>
	<TD>�Ȫ���-ʡ��</TD>
	<TD>������</TD>
	<TD align="center">����</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	<TD align="center">�ҡ��</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">����ѡ��</TD>
	<TD align="center">���˵ء�� Refer</TD>
	<TD align="center">ʶҹ��� Refer</TD>
	<TD align="center">ᾷ���� Refer</TD>
	<TD align="center">ᾷ���� Consult</TD>
	<TD align="center">�����˵�</TD>
</TR>
<?}?>

<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded, $repeat, $type_patient,$cause_refer, $doc_refer, $nurse, $assistant_nurse, $estimate, $cradle,$doc_txt,$no_estimate, $phone,$consult, $er_tell, $suggestion ) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	

	
		if($no_estimate == 0)
			$no_estimate = "";
		else 
			$no_estimate .= "<BR>";
		$i++;

		if($er_tell != "")
			$phone .= "<BR>����<BR>".$er_tell;
		
		if($_POST["coder"] == "1"){
		
		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD align=\"center\">",$i,"/",$type_wounded,"<BR>",$type_patient,"</TD>
						<TD>",$date_in,"</TD>
						<TD>",$hn,"</TD>
						<TD>",$fullname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("DX")."&fn=dx&row_id=".$row_id."\" target=\"_blank\">",$dx,"</A></TD>";
		echo "</TR>";

		}else{

		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD align=\"center\">",$i,"/",$type_wounded,"<BR>",$type_patient,"</TD>
						<TD>",$date_in,"</TD>
						<TD>",$time_in,"</TD>
						<TD>",$time_out,"</TD>
						<TD>",$hn,"</TD>
					
						<TD>",$fullname,"</TD>
						<TD align=\"center\">",$phone,"</TD>
						<TD>",$age,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("�ҡ��")."&fn=organ&row_id=".$row_id."\" target=\"_blank\">",$organ,"</A></TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("DX")."&fn=dx&row_id=".$row_id."\" target=\"_blank\">",$dx,"</A></TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("����ѡ��")."&fn=maintenance&row_id=".$row_id."\" target=\"_blank\">",$maintenance,"</A></TD>
						<TD>",$cause_refer,"</TD>
						<TD>",$refer_hospital,"</TD>
						<TD>",substr($doctor,5),"</TD>
						<TD>",$consult,"</TD>
						<TD>".$doc_refer_value[$doc_refer]." ".$nurse_value[$nurse]." ".$assistant_nurse_value[$assistant_nurse]." ".$estimate_value[$estimate]." ".$no_estimate." ".$cradle_value[$cradle]." ".$doc_txt_value[$doc_txt]." ".$suggestion_value[$suggestion]."</TD>";

			echo "</TR>";
		}

		}

	

?>
</TABLE>

<BR>
<TABLE width="300" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD>�������ͧ����</TD>
	<TD>�ӹǹ</TD>
</TR>

<?php

$sql = "	
SELECT type_patient, count(hn) as c_hn
FROM `trauma` 
WHERE ".$where."
Group by type_patient 
";

$result = Mysql_Query($sql);
while(list($type_patient, $c_hn) = Mysql_fetch_row($result)){

echo"
<TR>
	<TD>".$type_patient."</TD>
	<TD>".$c_hn."</TD>
</TR>";

}

?>

</TABLE>
<?php }?>
</body>
</html>





<?php include("unconnect.inc");?>