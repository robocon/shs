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

		.xray-item:hover{
			background-color: #04AA6D;
		}
		.xray-item:hover a{
			color: #ffffff!important;
		}
		
		#xray-header a.activeTab{
			background-color: #04AA6D;
			color: #ffffff!important;
		}
		#xray-header a:hover{
			text-decoration: underline;
			background-color: #04AA6D;
			color: #ffffff!important;
		}
		#xray-header a{
			text-decoration: none;
			border-left: 6px solid #ccc !important;
			padding: 0 4px;
		}
	</style>
	<SCRIPT LANGUAGE="JavaScript">
		var inum = 1;
		function display_page(xx) {
			if(xx=='1') {
				document.getElementById('display_ly1').style.display = '';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = 'none';

				document.getElementById('xray').classList.add('activeTab');
				document.getElementById('upper').classList.remove('activeTab');
				document.getElementById('lower').classList.remove('activeTab');
				document.getElementById('ultrasound').classList.remove('activeTab');

			} else if (xx == '2') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = '';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = 'none';

				document.getElementById('xray').classList.remove('activeTab');
				document.getElementById('upper').classList.add('activeTab');
				document.getElementById('lower').classList.remove('activeTab');
				document.getElementById('ultrasound').classList.remove('activeTab');


			} else if(xx=='3') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = '';
				document.getElementById('display_ly4').style.display = 'none';

				document.getElementById('xray').classList.remove('activeTab');
				document.getElementById('upper').classList.remove('activeTab');
				document.getElementById('lower').classList.add('activeTab');
				document.getElementById('ultrasound').classList.remove('activeTab');


			}else if(xx=='4') {
				document.getElementById('display_ly1').style.display = 'none';
				document.getElementById('display_ly2').style.display = 'none';
				document.getElementById('display_ly3').style.display = 'none';
				document.getElementById('display_ly4').style.display = '';

				document.getElementById('xray').classList.remove('activeTab');
				document.getElementById('upper').classList.remove('activeTab');
				document.getElementById('lower').classList.remove('activeTab');
				document.getElementById('ultrasound').classList.add('activeTab');
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
	<table cellpadding="2" cellspacing="0" id="xray-header">
		<tr>
			<td border="1" bordercolor="#004080">
				<a href="javascript:void(0);" onclick="display_page('1');" id="xray">X-RAY</a>
			</td>
			<td>&nbsp;</td>
			<td>
				<a href="javascript:void(0);" onclick="display_page('2');" id="upper">UPPER EXTREMITY</a>
			</td>
			<td>&nbsp;</td>
			<td>
				<a href="javascript:void(0);" onclick="display_page('3');" id="lower">LOWER EXTREMITY</a>
			</td>
			<td>&nbsp;</td>
			<td>
				<a href="javascript:void(0);" onclick="display_page('4');" id="ultrasound">ULTRASOUND</a>
			</td>
			<td>&nbsp;</td>
			<td>
				<?php if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
				Other : <INPUT id="idother" TYPE="text" NAME="" size="10" value="BMD">
				<?php }else{ ?>
				Other : <INPUT id="idother" TYPE="text" NAME="" size="10">
				<?php } ?>
				<INPUT TYPE="button" value="Add" onclick="OnClick_add_xray(document.getElementById('idother').value);">
			</td>
		</tr>
	</table>
	<?php
	include("connect.php");
	?>
	<table id="display_ly1" width="100%" style="" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<?php
		$sql = "SELECT * FROM `xraylist` WHERE `page` = '1' ORDER BY `sort` ASC";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			while ($a = mysql_fetch_assoc($q)) {
				?>
				<tr>
					<td style="" class="xray-item">
						<a href="javascript:void(0);" onclick="OnClick_add_xray('<?=$a['xraycode'];?>');" style="text-decoration:none; color:#000099;"><?=$a['xraycode'];?></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
	<!-- EXTREMITIES -->
	<table id="display_ly2" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<?php
		$sql = "SELECT * FROM `xraylist` WHERE `page` = '2' ORDER BY `sort` ASC";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			while ($a = mysql_fetch_assoc($q)) {
				?>
				<tr>
					<td style="" class="xray-item">
						<a href="javascript:void(0);" onclick="OnClick_add_xray('<?=$a['xraycode'];?>');" style="text-decoration:none; color:#000099;"><?=$a['xraycode'];?></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
	<table id="display_ly3" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<?php
		$sql = "SELECT * FROM `xraylist` WHERE `page` = '3' ORDER BY `sort` ASC";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			while ($a = mysql_fetch_assoc($q)) {
				?>
				<tr>
					<td style="" class="xray-item">
						<a href="javascript:void(0);" onclick="OnClick_add_xray('<?=$a['xraycode'];?>');" style="text-decoration:none; color:#000099;"><?=$a['xraycode'];?></a>
					</td>
				</tr>
				<?php
			}
		}
		?>
	</table>
	<table id="display_ly4" width="100%" style="display:none" border="1" bordercolor="#004080" cellpadding="4" cellspacing="0">
		<?php
		$sql = "SELECT * FROM `xraylist` WHERE `page` = '4' ORDER BY `sort` ASC";
		$q = mysql_query($sql);
		if(mysql_num_rows($q)>0){
			while ($a = mysql_fetch_assoc($q)) {
				?>
				<tr>
					<td style="" class="xray-item">
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