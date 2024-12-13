<?php
session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
	<META NAME="Generator" CONTENT="EditPlus">
	<META NAME="Author" CONTENT="">
	<META NAME="Keywords" CONTENT="">
	<META NAME="Description" CONTENT="">
	<style type="text/css">
		body,
		td,
		th {
			font-family: Angsana New;
			font-size: 24px;
		}
		.tb_head {
			background-color: #0046D7;
			color: #FFFFCA;
			font-weight: bold;
			text-align: center;
		}
		.tb_detail {
			background-color: #FFFFC1;
		}
		.tb_menu {
			background-color: #FFFFC1;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript">
		var inum = 1;
		function display_page(xx) {
			if (xx == '2') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = '';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = 'none';
			} else if(xx=='1') {
				document.getElementById('display_ly1').style.display = '';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = 'none';
			}else if(xx=='3') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = '';
				document.getElementById('display_ly4').style.display = 'none';
			}else if(xx=='4') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = '';
			}
		}
		function OnClick_add_xray(xxx) {

			parent.frames[1].document.getElementById("cXraydetail").innerHTML += "<div id='dv" + inum +
				"'>&nbsp;&nbsp;&nbsp;<a href=\"javascript:void(0);\" Onclick=\"document.getElementById('dv" + inum +
				"').style.display='none';document.getElementById('dv" + inum + "').innerHTML='';\">" + xxx +
				"</a><INPUT TYPE=\"hidden\" name=\"xraydetail[]\" value=\"" + xxx + "\"></div>";
			inum++;
		}
	</SCRIPT>
</HEAD>

<BODY>
	<table cellpadding="2" cellspacing="0">
		<tr>
			<td bgcolor="#005500" style="color:#00FFFF;">
				<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('1');">First Page</A>
			</td>
			<td>&nbsp;</td>
			<td bgcolor="#004080" style="color:#00FFFF;">
				<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('2');">EXTREMITIES</A>
			</td>
			<td>&nbsp;</td>
			<td bgcolor="#004080" style="color:#00FFFF;">
				<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('3');">LOWER EXTREMITY</A>
			</td>
			<td>&nbsp;</td>
			<td bgcolor="#004080" style="color:#00FFFF;">
				<A HREF="javascript:void(0);" style="color:#00FFFF;" Onclick="display_page('4');">ULTRASOUND</A>
			</td>
			<td>&nbsp;</td>
			<td>
				<? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
				Other : <INPUT id="idother" TYPE="text" NAME="" size="10" value="BMD">
				<? }else{ ?>
				Other : <INPUT id="idother" TYPE="text" NAME="" size="10">
				<? } ?>
				<INPUT TYPE="button" value="Add" Onclick="OnClick_add_xray(document.getElementById('idother').value);">
			</td>
		</tr>
	</table>
	<?php
	include("connect.php");
	// $r = 2;
	$sql = "Select concat(xraycode,' ',xraysub) as xraydetail From xraylist where xraytype = '0' OR xraytype = '4' ";
	$result = mysql_query($sql);
	// $count = mysql_num_rows($result);
	?>
	<TABLE id="display_ly1" width="100%" border="1" bordercolor="#005500" cellpadding="4" cellspacing="0">
		<TR>
			<TD>
				<TABLE border="0" width="100%">
					<TR>
						<?php
						$i = 1;
						while ($arr = mysql_fetch_assoc($result)) {
							$bgcolor = "#95FF95";
							$detail = str_replace("'", "\'", $arr["xraydetail"]);
							echo "<TD width=\"50%\" style=\"font-family:'Angsana New'; font-size:22px;\" bgcolor=\"" . $bgcolor . "\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('" . $detail . "');\" style=\"text-decoration:none; color:#000099;\">" . $arr["xraydetail"] . "</A></TD>";
							if ($i % $r == 0)
								echo "</TR><TR>";
							$i++;
						}
						?>
					</TR>
				</TABLE>
				<TABLE border="0" width="100%" cellpadding="4" cellspacing="0">
					<?php
					$i = 1;
					$sql = "Select xraycode , xraysub From xraylist  where xraytype = '3' ";
					$result = mysql_query($sql);
					$count = mysql_num_rows($result);
					echo "<TR>";
					while ($arr = mysql_fetch_assoc($result)) {
						$bgcolor = "#95FF95";
						echo "<TD>";
						echo "<TABLE width=\"100%\" bgcolor=\"" . $bgcolor . "\"><TR><TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">" . $arr["xraycode"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD><TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('" . $arr["xraycode"] . " RT. " . $arr["xraysub"] . "');\" style=\"text-decoration:none; color:#000099;\">RT. " . $arr["xraysub"] . "</A></TD>";
						echo "</TR>";
						echo "<TD align=\"right\"><A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('" . $arr["xraycode"] . " LT. " . $arr["xraysub"] . "');\" style=\"text-decoration:none; color:#000099;\">LT. " . $arr["xraysub"] . "</A></TD></TABLE>";
						echo "</TD>";
						if ($i % 2 == 0)
							echo "</TR><TR  >";
						$i++;
					}
					?>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
	<!-- EXTREMITIES -->
	<?php
	$r = 2;
	$sql = "Select xraycode , xraysub From xraylist  where xraytype = '1' ";
	$result = mysql_query($sql);
	?>
	<TABLE id="display_ly2" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<TR>
			<TD>
				<TABLE border="0" width="100%" cellpadding="4" cellspacing="0">
					<?php
					$i = 1;
					while ($arr = mysql_fetch_assoc($result)) {
						if ($i % 2 != 0) {
							echo "<TR>";
						}
						echo "<TD>";
						echo "<TABLE width=\"100%\" bgcolor=\"#95FF95\">
								<TR>
									<TD  style=\"font-family:'Angsana New'; font-size:20px;\" rowspan=\"2\">" . $arr["xraycode"] . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
									<TD align=\"right\">
										<A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('" . $arr["xraycode"] . " RT. " . $arr["xraysub"] . "');\" style=\"text-decoration:none; color:#000099;\">RT. " . $arr["xraysub"] . "</A>
									</TD>";
						echo "</TR>";
						echo "<TR>";
						echo "<TD align=\"right\">
						<A HREF=\"javascript:void(0);\" Onclick=\"OnClick_add_xray('" . $arr["xraycode"] . " LT. " . $arr["xraysub"] . "');\" style=\"text-decoration:none; color:#000099;\">LT. " . $arr["xraysub"] . "</A>
						</TD>";
						echo "<td></TD>
						</tr>
						</table>";
						echo "</TD>";
						if ($i % 2 == 0) {
							echo "</TR>";
						}
						$i++;
					}
					?>
				</TABLE>
			</TD>
		</TR>
		<?php 
		$sql = "Select xraycode , xraysub From xraylist  where xraytype = '2' ";
		$q = mysql_query($sql);
		while ($a = mysql_fetch_assoc($q)) {
			$text = $a['xraycode'] . ' ' . $a['xraysub'];
			?>
			<tr>
			<td>
				<table width="100%" bgcolor="#95FF95">
					<tr>
						<td>
						<a href="javascript:void(0);" onclick="OnClick_add_xray('<?=$text;?>');" style="text-decoration:none; color:#000099;"><?=$text;?></a>
						</td>
					</tr>
				</table>
			
			</td>
			</tr>
			<?php
		}
		?>
	</TABLE>
	<table id="display_ly3" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<tr>
			<td>3</td>
		</tr>
	</table>
	<table id="display_ly4" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<?php
		$sql = "SELECT * FROM `xraylist` WHERE `page` = '4' ORDER BY `sort` ASC";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			while ($a = mysql_fetch_assoc($q)) {
				?>
				<tr>
					<td style="background-color: #95FF95;">
						<a href="javascript:void(0);" onclick="OnClick_add_xray('<?=$a['xraycode'];?>');" style="text-decoration:none; color:#000099;"><?=$a['xraycode'];?></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
		
	</table>
</BODY>

</HTML>