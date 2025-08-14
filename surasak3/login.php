<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>เข้าสู่ระบบ</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');

	body {
	  margin: 0;
	  padding: 0;
	  background-color: #006666; /* เขียวกองทัพบก */
	  font-family: 'Sarabun', 'TH SarabunPSK', sans-serif;
	  color: #ffffff;

	  display: flex;
	  justify-content: center; /* กึ่งกลางแนวนอน */
	  align-items: flex-start; /* ชิดด้านบน */
	  min-height: 100vh;       /* ให้เต็มหน้าจอ */
	  padding-top: 15px;       /* ห่างจากขอบบน 20px */
	}

    .login-container {
      background-color: #008080;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 6px 16px rgba(0,0,0,0.25);
      max-width: 320px;
      width: 100%;
    }

    .login-container h2 {
      text-align: center;
      margin-bottom: 16px;
      font-size: 22px;
      color: #00FFFF;
    }

    .form-group {
      margin-bottom: 16px;
    }

    label {
      display: block;
      font-size: 16px;
      margin-bottom: 4px;
      color: #ffffff;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 8px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
    }

    input[type="submit"] {
      width: 100%;
      padding: 8px;
      background-color: #FDC745;
      color: #000;
      border: none;
      border-radius: 5px;
      font-size: 18px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #20B2AA;
    }

    .forgot-password {
      margin-top: 8px;
      text-align: center;
    }

    .forgot-password a {
      color: #FDC745;
      text-decoration: none;
      font-size: 14px;
    }

    .forgot-password a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

<div class="login-container">
  <h2>เข้าสู่ระบบ</h2>
  <form method="POST" action="forlogin.php" autocomplete="off">
    <div class="form-group">
      <label for="username">ชื่อผู้ใช้</label>
      <input type="text" id="username" name="username" placeholder="กรอกชื่อผู้ใช้" required>
    </div>
    <div class="form-group">
      <label for="password">รหัสผ่าน</label>
      <input type="password" id="password" name="password" placeholder="กรอกรหัสผ่าน" required autocomplete="new-password">
    </div>
    <input type="submit" value="เข้าสู่ระบบ" name="B2">
    <div class="forgot-password">
      <a target="_blank" href="showAdmin.php">ลืมรหัสผ่าน?</a>
    </div>
  </form>
</div>

</body>
</html>
