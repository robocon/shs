<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
    #ptReh{
        background-color: #13795b;
        color:#ffffff;
    }
    #calendar_start{
        z-index: 9;
    }
</style>
<nav class="navbar navbar-expand-lg" id="ptReh" data-bs-theme="dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">Home</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pt_reh_reprint.php">รายชื่อ</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="pt_reh_setup.php">ตั้งค่า</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
<?php 
if(!empty($_SESSION['x-msg'])){
    ?>
    <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
    <?php
    $_SESSION['x-msg'] = null;
}
?>