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
		
		if($_POST["check_time_diag"] == "1")
			$check_time_diag_value = "Checked";


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
		<TD>������ : <SELECT NAME="type_wounded">
			<Option value="">�ٷ�����</Option>
			<Option value="1" <?php if($_POST["type_wounded"] == "1") echo " Selected ";?>>1</Option>
			<Option value="2" <?php if($_POST["type_wounded"] == "2") echo " Selected ";?>>2</Option>
			<Option value="3" <?php if($_POST["type_wounded"] == "3") echo " Selected ";?>>3</Option>


	</SELECT></TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="checkbox" NAME="check_time_diag" value="1" <?php echo $check_time_diag_value;?>> �ʴ������ŷ��ѹ�֡���ҵ�Ǩ�ͧᾷ��</TD>
	</TR>
	<TR>
		<TD><input type='submit' name="submit" value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
<?php

if(isset($_POST["submit"])){

		//$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		$where = "";
		if(isset($_POST["type_wounded"]) && $_POST["type_wounded"] != "" ){
			$where .= " AND `type_wounded` = '".$_POST["type_wounded"]."' ";
		}else{
			$where .= " AND `type_wounded` in ('1','2','3') ";
		}

		$where .= " AND ( `date_in`  between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) ";
		
		if($_POST["check_time_diag"] == "1")
			$where .=" AND  (`time_diag` is not null ) ";

		$sql = "Select   a.`row_id`, a.`vn`, a.`hn`, a.`an`, a.`dx`, a.`organ`, a.`maintenance`, a.`doctor`, CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) as `full_name`, `age`, `list_ptright`, left(`time_in`,5) as `left2in`, left(`time_out`,5) as `left2`, `cure`, `admit_ward`, `refer_hospital`, CONCAT(a.`time_in`,' ',date_format(a.`date`,'%H:%i:%s')) as `h_date`, `time_in`, left(`time_diag`,5) as `time_diag2`, date_format(`date_in`,'%d/%m/%Y') as `date_in2`, `type_wounded`, `repeat`, `type_patient`, `cause_refer`, `doc_refer`,  `nurse`,  `assistant_nurse`,  `estimate`,  `cradle`, `doc_txt`,  `no_estimate`, b.`ptffone`  From `trauma` as a, `opcard` as b where a.`hn` = b.`hn` AND time_in <> '00:00:00' AND time_out <> '00:00:00' AND time_diag <> '00:00:00' ".$where." Order by `date_in` ASC, `h_date` ASC ";
		
		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
		?>

<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR>
	<TD align="center">No.</TD>
	<TD align="center">�.�.�.</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	
	<TD>�Ȫ���-ʡ��</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">Dr.</TD>
	<TD align="center">������</TD>
	<TD align="center">�ҡ��</TD>
	<TD align="center">����ѡ��</TD>
	<TD align="center">�������</TD>
	<TD align="center">���ҵ�Ǩ</TD>
	<TD align="center">��ǧ����1</TD>
	<TD align="center">D/C</TD>
	<TD align="center">��ǧ����2</TD>
</TR>
<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded, $repeat, $type_patient,$cause_refer, $doc_refer, $nurse, $assistant_nurse, $estimate, $cradle,$doc_txt,$no_estimate, $ptffone ) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	

	
		if($time_diag != "00:00" && $time_diag != ""){
			
			if(substr($time_in,0,2) == "23"  && substr($time_diag,0,2) == "00"){
				
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ",mktime('0','0','0',date("m"),date("d")+1,date("Y"))).$time_diag.":00");

			}else{
				$xxx = strtotime(date("Y-m-d ").$time_in.":00");
				$yyy = strtotime(date("Y-m-d ").$time_diag.":00");
			}
			$sec_between1 = ($yyy - $xxx)/60 ;

			if(($type_wounded == "1" && $sec_between1 > 10) || ($type_wounded == "2" && $sec_between1 > 20) || ($type_wounded == "3" && $sec_between1 > 30)){
				
				if($_POST["check_time_diag"] != "1")
					$bgcolor= "#FFAAAA";
			}else{
				continue;
				exit();
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
		echo "<TR bgcolor=\"#FFFFFF\">
						<TD>",$i,".</TD>
						<TD>",$date_in,"</TD>
						<TD>",$hn,"</TD>
						<TD>&nbsp;",$an,"</TD>
						
						<TD>",$fullname,"</TD>
						<TD>",$list_ptright[$list_ptright2],"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("DX")."&fn=dx&row_id=".$row_id."\" target=\"_blank\">",$dx,"</A></TD>
						<TD>",substr($doctor,5),"</TD>
						<TD align=\"center\">",$type_wounded,"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("�ҡ��")."&fn=organ&row_id=".$row_id."\" target=\"_blank\">",$organ,"</A></TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("����ѡ��")."&fn=maintenance&row_id=".$row_id."\" target=\"_blank\">",$maintenance,"</A></TD>
						<TD align=\"center\">",$time_in,"</TD>
						<TD>&nbsp;",($time_diag=='00:00' ? '&nbsp;':$time_diag),"</TD>
						<TD align=\"center\">".$sec_between1."</TD>
						<TD>",$time_out,"</TD>
						<TD align=\"center\">".$sec_between2."</TD>
						";

			echo "</TR>";

		}

	}

?>
</TABLE>

</body>
</html>





<?php include("unconnect.inc");?>