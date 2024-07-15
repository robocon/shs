<?php
    session_start();
    session_destroy();
?>
<style>
th, td {
  padding:3px;
}
font, .txt{
	font-family:"TH SarabunPSK";
	font-size:20px;	
}	
</style>
<body bgcolor='#008080' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>
<form method="POST" action="forlogin.php">
  <table border="0" width="100%">
    <tr>
      <td width="2%"></td>
      <td width="98%">&nbsp;&nbsp;</td>
    </tr>
    <tr>
      <td width="2%"></td>
      <td width="98%">

        <font face="THSarabunPSK"><span><strong>ชื่อผู้ใช้ :</strong></span><br>
        <input type="text" name="username" class="txt"></font>
        <br><br>

        <font face="THSarabunPSK"><span><strong>รหัสผ่าน :</strong></span> <br>
        <input type="password" name="password" class="txt"></font>

        <p><input type="submit" value="เข้าสู่ระบบ" name="B2" class="txt"></p>
      </td>
    </tr>
    <tr>
      <td width="2%"></td>
      <td width="98%">
        <div style="text-align:left;">
          <a target="_parent" href="javascript:void(0);" class="txt">ลืมรหัสผ่าน?</a>
        </div>
      </td>
    </tr>
    
  </table>
</form>
<!-- <font face="THSarabunPSK"><a target="_parent"  href='../index.htm'>อินทราเนท</a></font> -->

<?php 
$ua = strtolower($_SERVER['HTTP_USER_AGENT']);
$isMob = is_numeric(strpos($ua, "mobile"));
if($isMob === true)
{
  ?>
  <p>
    <a target="_parent" href='login_mobile.php'>Mobile Version</a>
  </p>
  <?php
}
?>
</body>

