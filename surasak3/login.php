<?php
session_start();
session_destroy();
header('Content-Type: text/html; charset=tis-620');
?>
<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
	<form method="POST" action="forlogin.php">
		<table border="0" width="100%">
			<tr>
				<td width="20%">&nbsp;</td>
				<td width="80%">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>
					<font face="THSarabunPSK">
						���ͼ����:<br>
						<input type="text" name="username" size="12"><br>
						���ʼ�ҹ :<br>
						<input type="password" name="password" size="12">
					</font>
					<p>
						<font face="THSarabunPSK">
							<input type="submit" value="����к�" name="B2">
						</font>
					</p>
				</td>
			</tr>
		</table>
	</form>
	<font face="THSarabunPSK">.......<a target=_parent  href='../index.htm'>�Թ���๷</a></font>
</body>

