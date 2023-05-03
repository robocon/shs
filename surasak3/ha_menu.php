<style>
    *{
        font-family: "TH Sarabun New", "TH SarabunPSK";
        font-size:18px;
    }
    h1{
        font-size: 2em;
    }
    .nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #333;
    }

    .nav li {
        float: left;
    }

    .nav li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    /* Change the link color to #111 (black) on hover */
    .nav li a:hover {
        background-color: #111;
    }
</style>
<div class="nav">
    <ul>
        <li><a href="ha_index.php">หน้าหลัก</a></li>
        <li><a href="ha_main.php">จัดการตัวชี้วัด</a></li>
        <li><a href="ha_report.php">รายงาน</a></li>
    </ul>
</div>
<?php 
if($_SESSION['x-msg']){
    ?>
    <div>
        <?=$_SESSION['x-msg'];?>
    </div>
    <?php
    $_SESSION['x-msg'] = null;
}