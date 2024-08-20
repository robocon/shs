<?php 
$menuCode = sprintf("%s", $_GET["menucode"]);
?>
<style type="text/css">
	* {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	table.table th, #comNav{
		background-color: #13795b; 
		color: #ffffff;
	}
</style>
<nav class="navbar navbar-expand-lg" id="comNav" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            ผู้ใช้งาน
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="showuser.php">รายชื่อทั้งหมด &#128195;</a>
            </li>
            <li>
              <a class="dropdown-item" href="adduser.php">เพิ่มผู้ใช้ &#128118;</a>
            </li>
            <li>
              <a class="dropdown-item" href="disableuser.php">รายชื่อปิดใช้งาน 🗑️</a>
            </li>
            <li>
              <a class="dropdown-item" href="user_register_request.php">ตรวจสอบรายชื่อขอใช้ระบบโรงบาล 🏨</a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showAdmin.php" target="_blank">ดูรายชื่อ Admin แผนก &#128587;&#128591;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="doctor_register.php">ขอเพิ่มชื่อแพทย์ 👨🏽‍⚕️</a>
        </li>
      </ul>
    </div>
  </div>
</nav>