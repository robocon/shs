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
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="showuser.php">รายชื่อ &#128195;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="adduser.php">เพิ่มผู้ใช้ &#128118;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="disableuser.php">รายชื่อปิดใช้งาน 🗑️</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="showAdmin.php" target="_blank">ดูรายชื่อ Admin แผนก &#128587;&#128591;</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="user_register_request.php">ตรวจสอบรายชื่อขอใช้ระบบโรงบาล 🏨</a>
        </li>
        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>