<?php 
session_start();
include("connect.inc");
?>
<html>
<head>
	<title>�ԹԨ����ä Manual</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<style type="text/css">
	body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
	}
	.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
	.tb_detail {background-color: #FFFFC1;  }
	.tb_detail2 {background-color: #FFFFFF;  }
	</style>
	<script type="text/javascript">
	window.onload = function(){
		document.form_vn.vn_now.focus();
	}
	</script>
</head>

</body>
	<a href='../nindex.htm'>&lt;&lt;�����</a>
	<BR>
	<table width="100%" border="0">
		<tr>
			<td>
				<FORM name="form_vn" METHOD=POST ACTION="dt_manual_index.php">
					<input name="act" type="hidden" value="show">
					<TABLE width="319">
						<TR>
							<TD>
								<TABLE>
									<TR>
										<TD width="65"><strong>HN : </strong></TD>
										<TD width="160"><INPUT TYPE="text" NAME="hn_now"></TD>
										<TD width="70">&nbsp;</TD>
									</TR>
									<TR>
										<TD><strong>ᾷ�� : </strong></TD>
										<TD>
											<?php
											$strSQL = "SELECT name FROM doctor WHERE status='y' ORDER BY name "; 
											$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
											?>
											<select name="doctor" id="doctor"> 
												<option value="MD041  ���Է�� ǧ�����" selected="selected">MD041  ���Է�� ǧ�����</option>
												<?php
												while($objResult = mysql_fetch_array($objQuery)) {
													/*if($app1['doctor'] == $objResult["name"]){
														?>
														<option value="<?=$objResult["name"]?>" selected="selected"><?=$objResult["name"]?></option>
														<?php
													}else{*/
														?>
														<option value="<?=$objResult["name"];?>" ><?=$objResult["name"];?></option>    
														<?php
													/*}*/
												}
												?>
											</select>
										</TD>
										<TD>&nbsp;</TD>
									</TR>
									<TR>
										<TD>&nbsp;</TD>
										<TD><INPUT TYPE="submit" value="��ŧ"></TD>
										<TD>&nbsp;</TD>
									</TR>
								</TABLE>
							</TD>
						</TR>
					</TABLE>
				</FORM>
			</td>
			<td align="right">&nbsp;</td>
		</tr>
	</table>
<?php
if($_POST["act"]=="show"){
	$sql="select * from dxofyear_out where hn='".$_POST["hn_now"]."'";
	$query=mysql_query($sql);
	?>
	<table width="60%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
	<tr>
		<td width="6%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
		<td width="19%" align="center" bgcolor="#66CC99"><strong>�ѹ/��͹/��</strong></td>
		<td width="14%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
		<td width="29%" align="center" bgcolor="#66CC99"><strong>����ʡ��</strong></td>
		<td width="32%" align="center" bgcolor="#66CC99"><strong>����˹��§ҹ</strong></td>
	</tr>
	<?php
	if(mysql_num_rows($query) < 1){
		echo "<tr><td colspan='5' align='center'>----------------------------- ����բ����� -----------------------------</td></tr>";
	}
	
	$i=0;
	while($rows=mysql_fetch_array($query)){
		$i++;
		?>  
		<tr>
			<td align="center"><?=$i;?></td>
			<td align="center"><?=$rows["thidate"];?></td>
			<td align="center"><a href="dxdr_ofyearout_dr_manual.php?hn_now=<?=$rows["hn"];?>&doctor=<?=$_POST["doctor"];?>&thidate=<?=$rows["thidate"];?>"><?=$rows["hn"];?></a></td>
			<td><?=$rows["ptname"];?></td>
			<td><?=$rows["camp"];?></td>
		</tr>
		<?php
	}
	?>
	</table>
	<?php
}
?>
</body>
<?php include("unconnect.inc");?>
</html>