<?php
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


<style>
	.font_tr{ font-family:"Angsana New"; font-size:20px; background-color:"#F5DEB3"; }
	.font_hd{ font-family:"Angsana New"; font-size:20px; background-color:"#CD853F"; }
</style>

<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ª��ͼ���Ң���Ѻ�ͧ��ࡳ�����</p>
<form name="ff1" method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>


<TR id="row2" >
	<TD align="right">������ѹ��� :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php if(isset($_POST["start_day"])) echo $_POST["start_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			if($_POST["start_month"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["start_month"]) && date("m") == $value){ echo " Selected ";}
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php if(isset($_POST["start_year"])) echo $_POST["start_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4">
	</TD>
</TR>
<TR id="row3">
	<TD align="right">�֧�ѹ��� :</TD>
	<TD><INPUT TYPE="text" NAME="end_day" value="<?php if(isset($_POST["end_day"])) echo $_POST["end_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if($_POST["end_month"] == $value){ echo " Selected ";}
			 else if( !isset($_POST["end_month"]) && date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php if(isset($_POST["end_year"])) echo $_POST["end_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
</TR>
</TABLE>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <INPUT TYPE="button" value="Print" Onclick="window.open('mc_soldier_print.php?sd='+document.ff1.start_year.value+'-'+document.ff1.start_month.value+'-'+document.ff1.start_day.value+'&ed='+document.ff1.end_year.value+'-'+document.ff1.end_month.value+'-'+document.ff1.end_day.value+'');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a target=_self  href='../nindex.htm'><<�����</a></p>
</form>
<style type="text/css">
	table, tr, td, th{
		border: 1px solid black;
	}
	table{
		border-collapse: collapse; 
		border-spacing: 0; 
	}
	
</style>
<table style="">
	<tr class="font_hd">
		<th width="2%">�ӴѺ</th>
		<th width="15%">����-ʡ��</th>
		<th>�ä����Ǩ��</th>
		<th width="15%">�������ǧ��Ѻ��� �� �.�. ����<br />
		��Щ�Ѻ��䢷�� �� �.�. ����</th>
		<th width="12%">���ᾷ�����Ǩ</th>
		<th width="15%">�������ҷ���</th>
		<th width="5%">�.�.�. ����Ѻ��õ�Ǩ</th>
		<th>����/��䢢�����</th>
	</tr>
<?php
$num=0;
if( !empty($B1) ){
	include("connect.inc");
	$ymd_start = $_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"];
	$ymd_end = $_POST["end_year"]."-".$_POST["end_month"]."-".$_POST["end_day"];
	
	$where = " AND (a.thidate between '$ymd_start 00:00:00' AND '$ymd_end 23:59:59' ) ";
	$sql = "
		SELECT a.row_id, date_format(a.thidate,'%d-%m-%Y'), a.hn, a.ptname, a.organ, a.dx_mc_soldier, a.dr1_mc_soldier, a.dr2_mc_soldier, a.dr3_mc_soldier, a.address, a.thdatehn, a.rule 
		, b.idcard
	FROM opd AS a
	LEFT JOIN opcard AS b ON b.hn = a.hn 
	WHERE (
		( a.organ LIKE '%�Ѻ�ͧ%' AND a.organ LIKE '%����%' AND a.organ LIKE '%ࡳ%' ) 
		OR ( a.organ LIKE '%�Ѻ�ͧ%' AND a.organ LIKE '%���͡����%' ) 
		OR a.toborow like 'EX30%'
	) 
	".$where." ORDER BY thidate ASC ";
	
	$result = mysql_query($sql) or die("Query failed ".mysql_error());
	
	$notPassed = 0;
	while (list ($row_id, $date,$hn,$ptname,$organ, $dx_mc_soldier, $dr1_mc_soldier, $dr2_mc_soldier, $dr3_mc_soldier,$address1,$thdatehn,$rule,$idcard) = mysql_fetch_row ($result)) 
	{
		$Total = $Total+$amount; 
		list($address) = mysql_fetch_row(mysql_query("Select concat(address,' ', tambol,' ',  ampur,' ',  changwat  ) From opcard where hn = '".$hn."' limit 0,1 "));
		$thdatehn = substr($thdatehn,0,10);
		$num++;
		
		$dr1 = preg_replace('/MD\d+\s/', '', $dr1_mc_soldier);
		$dr2 = preg_replace('/MD\d+\s/', '', $dr2_mc_soldier);
		$dr3 = preg_replace('/MD\d+\s/', '', $dr3_mc_soldier);
		
		if( empty($dx_mc_soldier) ){
			$notPassed++;
		}
		
		?>
		<tr class="font_tr">
			<td align="center"><?php echo $num;?></td>
			<td><?php echo $ptname;?><br><?php echo $idcard;?></td>
			<td><?php echo $dx_mc_soldier;?></td>
			<td><?php echo $rule;?></td>
			<td><?php echo $dr1."<br>".$dr2."<br>".$dr3;?></td>
			<td><?php echo $address1;?></td>
			<td><?php echo $thdatehn;?></td>
			<td><a href="edit_report_mc.php?id=<?php echo $row_id;?>" target="_blank">����/��䢢�����</a></td>
		</tr>
		<?php
	}
	include("unconnect.inc");
}
?>
</table>
<?php
if( $num > 0 ){
$passed = $num - $notPassed;
?>
<h3>��ػ�ʹ</h3>
<p>�ӹǹ��������Ѻ¡���ࡱ�����  <?php echo $passed;?> ��</p>
<p>�ӹǹ�����������Ѻ¡���ࡱ�����  <?php echo $notPassed;?> ��</p>
<?php
}
?>