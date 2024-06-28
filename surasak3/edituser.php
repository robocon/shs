<?php
session_start();
include("connect.inc");

$act = sprintf("%s", $_GET["act"]);
if ($act == "edit") {

  $txtname = sprintf("%s", $_POST["txtname"]);
  $row_id = sprintf("%s", $_POST["row_id"]);
  $menucode = sprintf("%s", $_POST["menucode"]);
  $add = "UPDATE `inputm` SET `name`='$txtname' WHERE `row_id`='$row_id'";
  if (mysql_query($add)) {
    echo "<script>alert('แก้ไขข้อมูลคุณ $txtname เรียบร้อยแล้ว');window.location='showuser.php?menucode=$menucode';</script>";
  } else {
    echo "<script>alert('!!! ผิดพลาดไม่สามารถแก้ไขข้อมูลได้');window.location='edituser.php?menucode=$menucode&id=$row_id';</script>";
  }

  exit;
} elseif ($act == "updatePass") {

  $password = sprintf("%s", $_POST["password"]);

  $add = "UPDATE `inputm` SET `pword`='$password' WHERE `row_id`='$row_id'";
  if (mysql_query($add)) {
    echo "<script>alert('แก้ไขข้อมูลคุณ $txtname เรียบร้อยแล้ว');window.location='showuser.php?menucode=$menucode';</script>";
  } else {
    echo "<script>alert('!!! ผิดพลาดไม่สามารถแก้ไขข้อมูลได้');window.location='edituser.php?menucode=$menucode&id=$row_id';</script>";
  }

  exit;
}



$id = sprintf("%s", $_GET["id"]);
$menucode = sprintf("%s", $_GET["menucode"]);
?>
<style type="text/css">
  body,
  td,
  th {
    font-family: "TH SarabunPSK";
    font-size: 20px;
  }

  .forntsarabun {
    font-family: "TH SarabunPSK";
    font-size: 20px;
  }
</style>
<div>
  <a href="showuser.php?menucode=<?= $menucode; ?>">&lt;&lt;&nbsp;กลับไปหน้าจัดการผู้ใช้งาน</a>
</div>
<div align="center">
  <p><strong>แก้ไขข้อมูลผู้ใช้งานระบบ</strong></p>
  <?php
  $sql = "SELECT * FROM inputm WHERE row_id='$id' and menucode='$menucode'";
  $query = mysql_query($sql);
  $num = mysql_num_rows($query);
  if ($num === 0) {
    echo "ไม่พบข้อมูล";
    exit;
  }
  $rows = mysql_fetch_array($query);
  ?>
  <form action="edituser.php?act=edit" method="post" name="form1">
    <input name="act" type="hidden" value="edit">
    <input name="row_id" type="hidden" value="<?= $id; ?>">
    <input name="menucode" type="hidden" value="<?= $menucode; ?>">
    <table width="50%" border="0" cellspacing="0" cellpadding="5">
      <tr>
        <td width="34%" align="right" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล : </strong></td>
        <td width="66%" bgcolor="#FFCCCC"><label>
            <input name="txtname" type="text" class="forntsarabun" id="txtname" size="25" value="<?= $rows["name"]; ?>">
          </label></td>
      </tr>
      <tr>
        <td bgcolor="#FF9999">&nbsp;</td>
        <td bgcolor="#FF9999"><label>
            <input type="submit" name="button" id="button" class="forntsarabun" value="แก้ไขข้อมูล">
          </label></td>
      </tr>
    </table>
  </form>
  <div>
    <form action="edituser.php?act=updatePass" method="post" name="form1" onsubmit="return checkPassword()">

      <table width="50%" border="0" cellspacing="0" cellpadding="5">
        <tr>
          <td width="34%" align="right" bgcolor="#FF9999"><strong><label for="password">ตั้งรหัสผ่านใหม่ : </label></strong></td>
          <td width="66%" bgcolor="#FFCCCC">
            <input name="password" type="password" class="forntsarabun" id="password" size="25" value="">
          </td>
        </tr>
        <tr>
          <td width="34%" align="right" bgcolor="#FF9999"><strong><label for="password2">ยืนยันรหัสผ่านใหม่ : </label></strong></td>
          <td width="66%" bgcolor="#FFCCCC">
            <input name="password2" type="password" class="forntsarabun" id="password2" size="25" value="">
          </td>
        </tr>
        <tr>
          <td width="34%" align="right" bgcolor="#FF9999"></td>
          <td bgcolor="#FFCCCC">
            <strong>คำแนะนำในการตั้งรหัสผ่าน</strong>
            <ol>
              <li>ควรมีจำนวน 6 ตัวอักษรขึ้นไป</li>
              <li>ควรใช้อักขระ พิมพ์เล็ก พิมพ์ใหญ่ ตัวเลข และอักษรพิเศษ(!@#$%^&*_+) ผสมเข้าด้วยกัน</li>
            </ol>
          </td>
        </tr>
        <tr>
          <td bgcolor="#FF9999">&nbsp;</td>
          <td bgcolor="#FF9999"><label>
              <input type="submit" name="button" id="button" class="forntsarabun" value="แก้ไขข้อมูล">
            </label>
            <input name="act" type="hidden" value="updatePass">
            <input name="row_id" type="hidden" value="<?= $id; ?>">
            <input name="menucode" type="hidden" value="<?= $menucode; ?>">
          </td>
        </tr>
      </table>
    </form>
    <script>
      function checkPassword() {
        let res = true;
        let p1 = document.getElementById('password').value;
        let p2 = document.getElementById('password2').value;
        if (p1 != p2) {

          alert('รหัสผ่านไม่ตรงกัน');
          res = false;
        } else if (p1 == '' || p2 == '') {
          alert('รหัสผ่านไม่ควรเป็นค่าว่าง');
          res = false;
        }
        return res;
      }
    </script>
  </div>
  <div>
    <form action="edituser.php?act=updateLevel" method="post">
      <div class="mb-3 row">
        <label for="inputUserlevel" class="col-sm-2 col-form-label">ระดับผู้ใช้งาน</label>
        <div class="col-sm-10">
          <select name="userlevel" id="userlevel">
            <option value="">Admin</option>
            <option value="">User</option>
          </select>
        </div>
      </div>
      <div class="mb-3 row">
        <label for="inputUserlevel" class="col-sm-2 col-form-label">ระดับผู้ใช้งาน</label>
        <div class="col-sm-10">
          <button type="submit">บันทึก</button>
        </div>
      </div>
    </form>
  </div>
</div>