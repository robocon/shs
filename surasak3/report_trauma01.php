<?php
session_start();
include("connect.inc");

?>
<html>
<head>
<title>��ػ</title>
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
	
	function echo_ka($time){
		

		if($time >= "07:31" && $time < "15:31"){
			$ka = "���";
		}else if($time >= "15:31" && $time < "23:31"){
			$ka = "����";
		}else if($time >= "23:31" && $time <= "23:59"){
			$ka = "�֡";
		}else if($time >= "00:00" && $time < "07:31"){
			$ka = "�֡";
		}
		
		return $ka;

	}


	if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		

		$day_now = $_POST["d"];
		$month_now = $_POST["m"];
		$year_now = $_POST["yr"];

	}else{
		$select_day = (date("Y")+543).date("-m-d");
		
		$day_now = date("d");
		$month_now = date("m");
		$year_now = (date("Y")+543);

	}
?>
	<SCRIPT LANGUAGE="JavaScript">
	
		function wprint(){

			document.getElementById("form_01").style.display='none';
			window.print();

		}
	
	</SCRIPT>
	<form method='POST' action='report_trauma01.php'>
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
		<TD>trauma : <SELECT NAME="trauma" >
			<Option value="">�ٷ�����</Option>
			<Option value="trauma" <?php if($_POST["trauma"] == "trauma") echo "Selected"; ?>>Trauma</Option>
			<Option value="nontrauma" <?php if($_POST["trauma"] == "nontrauma") echo "Selected"; ?>>Non Trauma</Option>
			<Option value="opd" <?php if($_POST["trauma"] == "opd") echo "Selected"; ?>>OPD</Option>
	</SELECT></TD>
	</TR>
	<TR>
		<TD>������ : <SELECT NAME="type_wounded">
			<Option value="">�ٷ�����</Option>
			<Option value="1" <?php if($_POST["type_wounded"] == "1") echo " Selected ";?>>1</Option>
			<Option value="2" <?php if($_POST["type_wounded"] == "2") echo " Selected ";?>>2</Option>
			<Option value="3" <?php if($_POST["type_wounded"] == "3") echo " Selected ";?>>3</Option>
			<Option value="4" <?php if($_POST["type_wounded"] == "4") echo " Selected ";?>>4</Option>
            <Option value="5" <?php if($_POST["type_wounded"] == "5") echo " Selected ";?>>5</Option>
	</SELECT></TD>
	</TR>
	<TR>
		<TD>�š���ѡ�� : <SELECT NAME="cure" >
			<Option value="">�ٷ�����</Option>
			<Option value="admit" <?php if($_POST["cure"] == "admit") echo "Selected"; ?> >Admit</Option>
			<Option value="d/c" <?php if($_POST["cure"] == "d/c") echo "Selected"; ?>>D/c</Option>
			<Option value="refer" <?php if($_POST["cure"] == "refer") echo "Selected"; ?>>Refer</Option>
			<Option value="death" <?php if($_POST["cure"] == "death") echo "Selected"; ?>>Death</Option>
			<Option value="no" <?php if($_POST["cure"] == "no") echo "Selected"; ?>>������Ѻ��ԡ��</Option>
	</SELECT></TD>
	</TR>
	<TR>
		<TD>ᾷ�� : <select size="1" name="doctor">
			<option value="" selected>�ٷ�����</option>
			<?php

	$sql = "Select name From doctor where status = 'y' AND row_id != '0' Order by name ASC ";
	$result = Mysql_Query($sql);
	
	while(list($name) = Mysql_fetch_row($result)){
		echo "<option value=\"".$name."\" ";
			if($arr["doctor"] == $name) echo " Selected ";
		echo ">".$name."</option>";
	}
?>
		</select></TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="checkbox" NAME="repeat" value="1"> ���͡੾���ҵ�Ǩ���</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onClick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
<?php

if(isset($_POST["submit"])){

		$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$select_day3 = $_POST["d"]."-".$_POST["m"]."-".$_POST["yr"];

		if(!empty($_POST["d"])){
			$select_day2 = (date("Y",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543))+543).date("-m-d",mktime(0,0,0,$_POST["m"],$_POST["d"]+1,$_POST["yr"]-543));
		
			$where = " AND ((date_in = '".$select_day."' AND (time_in >= '07:31:00' AND time_in <= '23:59:59' )) OR (date_in = '".$select_day2."' AND (time_in >= '00:00:00' AND time_in < '07:31:00' ))) ";
		}else{
			
			$where = " AND `date_in` like '".$select_day."%' ";

		}


		if($_POST["trauma"] != ""){
			$where .= " AND `trauma` = '".$_POST["trauma"]."'";
		}

		if($_POST["cure"] != ""){
			$where .= " AND `cure` = '".$_POST["cure"]."'";
		}

		if($_POST["doctor"] != ""){
			$where .= " AND `doctor` = '".$_POST["doctor"]."'";
		}

		if(isset($_POST["repeat"]) && $_POST["repeat"] == "1" ){
			$where .= " AND `repeat` = '1' ";
		}

		if(isset($_POST["type_wounded"]) && $_POST["type_wounded"] != "" ){
			$where .= " AND `type_wounded` = '".$_POST["type_wounded"]."' ";
		}
		

				$sql = "SELECT a.`row_id` , a.`vn` , a.`hn` , a.`an` , a.`dx` , a.`organ` , a.`maintenance` , a.`doctor` , CONCAT( b.`yot` , ' ', b.`name` , ' ', b.`surname` ) AS `full_name` , `age` , `list_ptright` , left( `time_in` , 5 ) AS `left2in` , left( `time_out` , 5 ) AS `left2` , `cure` , `admit_ward` , `refer_hospital` , CONCAT( a.`time_in` , ' ', date_format( a.`date` , '%H:%i:%s' ) ) AS `h_date` , `time_in` , left( `time_diag` , 5 ) AS `time_diag2` , date_format( `date_in` , '%d/%m/%Y' ) AS `date_in2` , `type_wounded` , `type_wounded2` , `repeat`, `to_or`,  `to_lr`,  `to_etc`,  `to_hpt_lp`  FROM `trauma` AS a, `opcard` AS b WHERE a.`hn` = b.`hn` ".$where." ORDER BY a.`date_in` ASC , `h_date` ASC";

		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		?>
�ӹǹ�����ŷ�����  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD align="center">No.</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	
	<TD>�Ȫ���-ʡ��</TD>
	<TD align="center">����</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">Dr.</TD>
	<TD align="center">��������� 1</TD>
	<TD align="center">��������� 2</TD>
	<TD align="center">�ҡ��</TD>
	<TD align="center">����ѡ��</TD>
	<TD align="center">�������</TD>
	<TD align="center">���ҵ�Ǩ</TD>
	<TD align="center">��ǧ����1</TD>
	<TD align="center">D/C</TD>
	<TD align="center">��ǧ����2</TD>
	<TD align="center">�����˵�</TD>
</TR>
<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded, $type_wounded2, $repeat, $to_or, $to_lr,$to_etc, $to_hpt_lp) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	

	$echoka = echo_ka($time_in);

	if($echoka != $echoka1 && !empty($_POST["d"])){
		echo "<TR bgcolor=\"#FFFFCC\"><TD colspan=\"17\">&nbsp;&nbsp;<B>�ѹ��� ".$select_day3." ��� ".$echoka."</B></TD></TR>";
		$echoka1 = $echoka;
		$i=0;
	}

		if($type_wounded2 != "" && $type_wounded != $type_wounded2 )
			$bgcolor = "#B8FF88";
		else
		if($time_diag != "00:00" && $time_diag != ""){
			
			if(substr($time_in,0,2) == "23"  && substr($time_diag,0,2) == "00"){
				
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ",mktime('0','0','0',date("m"),date("d")+1,date("Y"))).$time_diag.":00");

			}else{
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ").$time_diag.":00");
			}
			$sec_between1 = ($yyy - $xxx)/60 ;

			if(($type_wounded == "1" && $sec_between1 > 4) || ($type_wounded == "2" && $sec_between1 > 20)){
				$bgcolor= "#FFAAAA";
			}

			if($sec_between1 < 0)
				$sec_between1 = "N/A";
			else
				$sec_between1 .= " �ҷ�";
			
			

		}else{
			$sec_between1 = "&nbsp;";
		}

		if(substr($time_in,0,2) == "23"  && substr($time_out,0,2) == "00"){
			$xxx = strtotime(date("Y-m-d ").$time_in.":00");
			$yyy = strtotime(date("Y-m-d ",mktime('0','0','0',date("m"),date("d")+1,date("Y"))).$time_out.":00");
		}else{
			$xxx = strtotime(date("Y-m-d ").$time_in.":00");
			$yyy = strtotime(date("Y-m-d ").$time_out.":00");
		}

			$sec_between2 = ($yyy - $xxx)/60 ;

			if($sec_between2 < 0)
				$sec_between2 = "N/A";
			else
				$sec_between2 .= " �ҷ�";
		


		if(empty($_POST["d"])){
			$time_in = $date_in."<BR>".$time_in;
		}

		$i++;
		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD>",$i,".</TD>
						<TD>",$hn,"</TD>
						<TD>&nbsp;",$an,"</TD>
						
						<TD>",$fullname,"</TD>
						<TD>",$age,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("DX")."&fn=dx&row_id=".$row_id."\" target=\"_blank\">",$dx,"</A></TD>
						<TD>",substr($doctor,5),"</TD>
						<TD align=\"center\">",$type_wounded,"</TD>
						<TD align=\"center\">",$type_wounded2,"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("�ҡ��")."&fn=organ&row_id=".$row_id."\" target=\"_blank\">",$organ,"</A></TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("����ѡ��")."&fn=maintenance&row_id=".$row_id."\" target=\"_blank\">",$maintenance,"</A></TD>
						<TD align=\"center\">",$time_in,"</TD>
						<TD>&nbsp;",($time_diag=='00:00' ? '&nbsp;':$time_diag),"</TD>
						<TD align=\"center\">".$sec_between1."</TD>
						<TD>",$time_out,"</TD>
						<TD align=\"center\">".$sec_between2."</TD>
						";
			if($cure == "admit")
				$remark = "Admit �ͼ����� ".$admit_ward."<BR> ";
			else if($cure == "refer")
				$remark = "Refer ".$refer_hospital."<BR> ";
			else if($cure == "no")
				$remark = "������Ѻ��ԡ��<BR> ";
			else
				$remark = "&nbsp;";
			
			if($repeat == "1"){
				$remark .= " (�ҵ�Ǩ���)<BR>";
			}
			if($to_or == "1"){
				$remark .= " �觵�� OR<BR>";
			}
			if($to_lr == "1"){
				$remark .= " �觵�� LR<BR>";
			}
			if($to_etc != "" && $to_etc != "---------"){
				$remark .= $to_etc." <BR>";
			}
			if($to_hpt_lp == "1"){
				$remark .= " �й��ѡ�ҵ��þ.�ӻҧ<BR>";
			}

			echo "<TD>".$remark."</TD>";

			echo "</TR>";

		}

	}

?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>