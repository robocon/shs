<html>
<head>
	<meta http-equiv="Content-Language" content="en-us">
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	<meta name="GENERATOR" content="Microsoft FrontPage 4.0">
	<meta name="ProgId" content="FrontPage.Editor.Document">
	<title>&#3614;&#3636;&#3617;&#3614;&#3660;&nbsp; HN&nbsp;
		&#3588;&#3609;&#3652;&#3586;&#3657;&#3607;&#3637;&#3656;&#3605;&#3657;&#3629;&#3591;&#3585;&#3634;&#3619;&#3592;&#3656;&#3634;&#3618;&#3618;&#3634;
	</title>
	<?php
	if ($_GET["get_hn"] != "") {
		?>
		<SCRIPT LANGUAGE="JavaScript">
			window.onload = function () {
				document.f1.an.value = '<?php echo $_GET["get_hn"] ?>';
				document.f1.submit();
			}
		</SCRIPT>
		<?php
	}
	?>
</head>
<body>
	<form method="POST" name="f1" action="preilab.php">
		<p>
			<font face="Angsana New">
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</font>
			<font size="4">&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3651;&#3609;<b>&nbsp;&nbsp;</b></font>
		</p>
		<p>&nbsp;&nbsp;&nbsp;AN&nbsp;&nbsp;&nbsp;<input type="text" name="an" size="8"></p>
		<?php
		if ($_COOKIE['labtranxStatus'] && $_COOKIE['labtranXAn']) {
			?>
			<div style="border: 2px solid #717100;background-color: #f9f9cf;padding: 24px 8px 4px 8px; position:relative;" id="cookieContainer">
				<div style="position:absolute; top:0; right:0;"><a href="javascript:void(0);" onclick="delCookie()" style="color:blue;" title="ปิด">[ ปิด ]</a></div>
				ผู้ป่วย AN: <?= $_COOKIE['labtranXAn']; ?> ที่ทำรายการก่อนหน้านี้ <u style="color:red;">ยังไม่ได้บันทึก<strong>หมดรายการ/ใบแจ้งหนี้</strong></u> มีรายละเอียดดังนี้ <br> <?= $_COOKIE['labtranxStatus']; ?>
			</div>
			<?php
		}
		?>
		<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1"></p>
	</form>
	<script>
		function setCookie(cname, cvalue, exdays) {
			const d = new Date();
			d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
			let expires = "expires="+d.toUTCString();
			document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
		}

		function delCookie(){
			console.log('on del cookie');
			setCookie('labtranxStatus', '', 0);
			setCookie('labtranXAn', '', 0);

			document.getElementById('cookieContainer').remove();
		}
	</script>
</body>

</html>