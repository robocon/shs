<?php 
$part = sprintf("%s", $_GET['part']);
?>
<nav class="navbar navbar-expand-lg" data-bs-theme="dark" style="background-color: #13795b;">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
      <a class="navbar-brand" href="manual_expense.php?part=<?=$part;?>">อปท.</a>
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="manual_expense_config.php?part=<?=$part;?>">ตั้งค่า</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="manual_expense_insert.php?part=<?=$part;?>">นำเข้าข้อมูล</a>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" aria-disabled="true">Disabled</a>
        </li> -->
      </ul>
    </div>
  </div>
</nav>