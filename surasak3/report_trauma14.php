<?php
session_start();
include("connect.inc");
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";
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
	<TR >
	<TD align="right">������ѹ��� :</TD>
	<TD>
		<INPUT TYPE="text" NAME="d" value="<?php if(isset($_POST["d"])) echo $_POST["d"]; else echo "1";?>" size="2" maxlength="2"> / 
		<SELECT NAME="m">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			if($_POST["m"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["m"]) && date("m") == $value){ echo " Selected ";}
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<SELECT NAME="yr">
		<?php
		for($i=date("Y");$i>date("Y")-5;$i--){
			echo "<OPTION VALUE=\"",$i+543,"\" ";
			if($_POST["yr"] == $i){ echo " Selected ";}
			 else if( !isset($_POST["yr"]) && date("Y") == $i){ echo " Selected ";}
			echo ">",$i+543;
			
			}	?>
			
		</SELECT>

	</TD>
</TR>
<TR >
	<TD align="right">�֧�ѹ��� :</TD>
	<TD><INPUT TYPE="text" NAME="d2" value="<?php if(isset($_POST["d2"])) echo $_POST["d2"]; else echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="m2">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if($_POST["m2"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["m2"]) && date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<SELECT NAME="yr2">
		<?php
		for($i=date("Y");$i>date("Y")-5;$i--){
			echo "<OPTION VALUE=\"",$i+543,"\" ";
			if($_POST["yr2"] == $i){ echo " Selected ";}
			 else if( !isset($_POST["yr2"]) && date("Y") == $i){ echo " Selected ";}
			echo ">",$i+543;
			
			}	?>
			
		</SELECT>
		</TD>
</TR>
	<TR>
		<TD colspan="2" align="center"><input type='submit' name="submit" value='     ��ŧ     ' > <INPUT TYPE="button" value="print" onclick="wprint();"></TD>
	</TR>
	</TABLE>
	</form>
<?php

if(isset($_POST["submit"])){

		//$select_day = $_POST["yr"]."-".$_POST["m"]."-".$_POST["d"];
		
		

		$where = "  ( `date_in`  between '".$select_day." 00:00:00' AND '".$select_day2." 23:59:59' ) AND `cure` = 'admit' AND type_wounded2 in ('1', '2')";
		

		$sql = "Select   a.`row_id`, a.`vn`, a.`hn`, a.`an`, a.`dx`, a.`organ`, a.`maintenance`, a.`doctor`, CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) as `full_name`, `age`, `list_ptright`, left(`time_in`,5) as `left2in`, left(`time_out`, 5) as `left2`, `cure`, `admit_ward`, `refer_hospital`, CONCAT(a.`time_in`,' ',date_format(a.`date`,'%H:%i:%s')) as `h_date`, `time_in`, left(`time_diag`,5) as `time_diag2`, date_format(`date_in`,'%d/%m/%Y') as `date_in2`, `type_wounded2`, `repeat`, `type_patient`, `cause_refer`, `doc_refer`,  `nurse`,  `assistant_nurse`,  `estimate`,  `cradle`, `doc_txt`,  `no_estimate`, b.`phone`, a.`consult`, `er_tell`, `suggestion` , `comment_admit`   , `admit_ward`
		From (
						SELECT * 
						FROM `trauma` 
						WHERE ".$where."
					) AS `a`, 
		`opcard` as `b` 
		where a.`hn` = b.`hn`  
		Order by `date_in` ASC, `h_date` ASC ";
	//	echo $sql;
		$echoka = "";
		$echoka1 = "";
		$i=0;

		$result = Mysql_Query($sql) or die("<!-- ".Mysql_error()." -->");
		$rows = Mysql_num_rows($result);
		?>
�ӹǹ�����ŷ�����  <?php echo $rows;?>
<TABLE cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse' width="950">

<TR>
	<TD align="center">�ӴѺ</TD>
	<TD align="center">�.�.�.</TD>
	<TD align="center">���������ͧ��Ǩ</TD>
	<TD align="center">����admit</TD>
	<TD align="center">HN</TD>
	<TD align="center">AN</TD>
	<TD>�Ȫ���-ʡ��</TD>
	<TD align="center">������</TD>
	<TD align="center">�ѧ�Ѵ</TD>
	<TD align="center">�ҡ��</TD>
	<TD align="center">Dx.</TD>
	<TD align="center">����ѡ��</TD>
	<TD align="center">Ward</TD>
	<TD align="center">�š�õԴ���</TD>
</TR>


<?php



		while(list($row_id, $vn,$hn,$an,$dx,$organ, $maintenance, $doctor, $fullname, $age, $list_ptright2, $time_in, $time_out, $cure, $admit_ward, $refer_hospital, $h_date, $time_in, $time_diag, $date_in, $type_wounded2, $repeat, $type_patient,$cause_refer, $doc_refer, $nurse, $assistant_nurse, $estimate, $cradle,$doc_txt,$no_estimate, $phone,$consult, $er_tell, $suggestion, $comment_admit, $admit_ward ) = Mysql_fetch_row($result)){

$bgcolor= "#FFFFFF";	

$i++;
/*<TD align=\"center\">",$phone,"</TD>
						<TD>",$age,"</TD>*/

		echo "<TR bgcolor=\"".$bgcolor."\">
						<TD align=\"center\">",$i,"</TD>
						<TD>",$date_in,"</TD>
						<TD>",$time_in,"</TD>
						<TD>",$time_out,"</TD>
						<TD width='80'>",$hn,"</TD>
						<TD width='80'>",$an,"</TD>
						<TD width='120'>",$fullname,"</TD>
						<TD align='center'>",$type_wounded2,"</TD>
						<TD width='100'>",$list_ptright[$list_ptright2],"</TD>
						<TD>",$organ,"</TD>
						<TD>",$dx,"</TD>
						<TD>",$maintenance,"</TD>
						<TD>",$admit_ward,"</TD>
						<TD><A HREF=\"trauma_edit.php?title_name=".urlencode("�š�� Admit")."&fn=comment_admit&row_id=".$row_id."\" target=\"_blank\">",($comment_admit==''?'�ѹ�֡�š�õԴ���':$comment_admit),"</A></TD>";
						

			echo "</TR>";

		}

	

?>
</TABLE>


<?php }?>
</body>
</html>





<?php include("unconnect.inc");?>