<style>
    *{
        font-family: "TH Sarabun New", "TH SarabunPSK";
        font-size:18px;
    }
    h1{
        font-size: 2em;
    }
    button[type=submit]{
        padding: 8px 16px;
    }
    .nav ul {
        list-style-type: none;
        margin: 0;
        padding: 0;
        overflow: hidden;
        background-color: #009688;
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
        background-color: #ccc;
        color:#000000;
    }
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
    .chk_table th{
        font-size: 20px;
        background-color: #009688;
        color: #ffffff;
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
    <div style="background-color:#ffffcc;border: 1px solid #cccccc; padding: 8px;">
        <?=$_SESSION['x-msg'];?>
    </div>
    <?php
    $_SESSION['x-msg'] = null;
}