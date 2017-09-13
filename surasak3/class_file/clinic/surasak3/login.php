<?php
    session_start();
    session_destroy();
?>
<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<form method="POST" action="forlogin.php">
  <table border="0" width="23%">
    <tr>
      <td width="32%"></td>
      <td width="68%">&nbsp;
        <p>&nbsp;</td>
    </tr>
    <tr>
      <td width="32%"></td>
      <td width="68%"><font face="THSarabunPSK">&nbsp&nbsp;&nbsp;&nbsp; ชื่อผู้ใช้
        :<br>
        &nbsp;&nbsp;&nbsp <input type="text" name="username" size="12"><br>
        &nbsp;&nbsp;&nbsp;&nbsp รหัสผ่าน :<br>
        &nbsp;&nbsp;&nbsp <input type="password" name="password" size="12"></font>
        <p><font face="THSarabunPSK">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp <input type="submit" value="เข้าระบบ" name="B2"></font></td>
    </tr>
  </table>
</form>
<font face="THSarabunPSK">.......<a target=_parent  href='../index.htm'>อินทราเนท</a></font>
</body>

