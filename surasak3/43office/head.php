<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ทดสอบระบบบันทึกข้อมูล43แฟ้ม</title>

    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <![endif]-->

    <link type="text/css" href="assets/epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/epoch_classes.js"></script>
    
    <!-- <script type="text/javascript" src="assets/jquery.js"></script> -->

    <style>
    /* Menu Pure CSS : */
    nav {
        /* margin: 100px auto; 
        text-align: center; */
    }
    nav ul ul {
        display: none;
    }
    nav ul li:hover > ul {
        display: block;
    }
    nav ul {
        background: #006781; 
        background: linear-gradient(top, #00a4ce 0%, #006781 100%);  
        background: -moz-linear-gradient(top, #00a4ce 0%, #006781 100%); 
        background: -webkit-linear-gradient(top, #00a4ce 0%,#006781 100%); 
        box-shadow: 0px 0px 9px rgba(0,0,0,0.15);
        padding: 0 20px;
        /* border-radius: 10px;   */
        list-style: none;
        position: relative;
        display: inline-table;
    }
    nav ul:after {
        content: ""; clear: both; display: block;
    }
    nav ul li {
        float: left;
    }
    nav ul li:hover {
        background: #4b545f;
        background: linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -moz-linear-gradient(top, #4f5964 0%, #5f6975 40%);
        background: -webkit-linear-gradient(top, #4f5964 0%,#5f6975 40%);
    }
    nav ul li:hover a {
        color: #fff;
    }
    nav ul li a {
        display: block; 
        padding: 10px 15px;
        color: #ffffff; text-decoration: none;
    }
    nav ul ul {
        background: #5f6975; border-radius: 0px; padding: 0;
        position: absolute; top: 100%;
    }
    nav ul ul li {
        float: none; 
        border-top: 1px solid #6b727c;
        border-bottom: 1px solid #575f6a; position: relative;
    }
    nav ul ul li a {
        padding: 10px 15px;
        color: #fff;
        width: 200px;
    }	
    nav ul ul li a:hover {
        background: #4b545f;
    }
    nav ul ul ul {
        position: absolute; left: 100%; top:0;
    }
    /* Menu Pure CSS : */


    /* ตาราง */
    body, button{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 14pt;
    }
    input:-moz-read-only{
    background-color: #bbbbbb;
    }
    input:read-only{
    background-color: #bbbbbb;
    }
    .clearfix::after {
    content: "";
    clear: both;
    display: table;
    }

    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th{background-color: #ddd6ce;}
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }

    fieldset{
        border: 2px solid #656565;
        padding: 4px;
    }
    legend{
        margin-left: 10px;
    }

    label{
        cursor: pointer;
    }
    .tdRow{
        padding-bottom: 6px;
        height: 32px;
    }
    .sRow{
        padding-right: 15px;
    }
    .important{
        border: 1px solid red;
    }
    .warning{
        background-color: yellow;
    }

    .txtRight{
        text-align: right;
        font-weight: bold;
    }

    @media print{
        .div-hide{
            display: none;
        }
    }
    </style>
</head>
<body>
<div id="no_print">
    <nav>
        <ul>
            <li>
                <a href="index.php" title="หน้าหลัก ร.พ.">Home</a>
            </li>
            <li>
                <a href="javascript: void(0);">เด็กแรกเกิด</a>
                <ul>
                    <li>
                        <a href="formNewborn.php">ฟอร์มทารกแรกเกิด</a>
                        <ul>
                            <li><a href="reportNewborn.php">รายงาน NEWBORN</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="formNewborncare.php">ฟอร์มทารกหลังคลอด</a>
                        <ul>
                            <li><a href="reportNewborncare.php">รายงาน NEWBORNCARE</a></li>
                        </ul>
                    <li><a href="reportPolicy.php">รายงาน POLICY</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);">หญิงตั้งครรภ์</a>
                <ul>
                    <li>
                        <a href="prenatal.php">ประวัติตั้งครรภ์ PRENATAL</a>
                        <ul>
                            <li><a href="reportPrenatal.php">รายงาน PRENATAL</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="anc.php">บริการฝากครรภ์ ANC</a>
                        <ul>
                            <li><a href="anc_view.php">รายงาน ANC</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="labor.php">ประวัติการคลอด LABOR</a>
                        <ul>
                            <li><a href="reportLabor.php">รายงาน LABOR</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="postnatal.php">ดูแลมารดาหลังคลอด POSTNATAL</a>
                        <ul>
                            <li><a href="reportPostnatal.php">รายงาน POSTNATAL</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="women.php">หญิงเจริญพันธ์ WOMEN</a>
                        <ul>
                            <li><a href="reportWomen.php">รายงาน WOMEN</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="fp.php">วางแผนครอบครัว FP</a>
                        <ul>
                            <li><a href="reportFp.php">รายงาน FP</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="dental.php">สภาวะทันต DENTAL</a>
                        <ul>
                            <li><a href="reportDental.php">รายงาน DENTAL</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);">วัคซีนและโภชนาการ</a>
                <ul>
                    <li>
                        <a href="epi.php">วัคซีนเด็ก EPI</a>
                        <ul>
                            <li><a href="reportEpi.php">รายงาน EPI</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="nutrition.php">ระดับโภชนาการ NUTRITION</a>
                        <ul>
                            <li><a href="reportNutrition.php">รายงาน NUTRITION</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a href="reportPerson.php">แฟ้มบุคคล</a>
            </li>
        </ul>
    </nav>
</div>
<?php 
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>