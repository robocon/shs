<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>���ͺ���ŧ�������к�43���</title>

    <link type="text/css" href="assets/menu.css" rel="stylesheet" />
    <link type="text/css" href="assets/epoch_styles.css" rel="stylesheet" />
    <script type="text/javascript" src="assets/epoch_classes.js"></script>
    
    <script type="text/javascript" src="assets/jquery.js"></script>
    <script type="text/javascript" src="assets/menu.js"></script>

</head>
<body>

<div id="no_print">
	<div id="menu">
        <ul class="menu">
            <li><a href="index.php" class="parent" title="˹����ѡ �.�."><span>&#127968;</span></a></li>
            <li>
                <a href="javascript: void(0);"><span>���á�Դ</span></a>
                <ul>
                    <li><a href="formNewborn.php"><span>�������á�á�Դ</span></a></li>
                    <li><a href="reportNewborn.php"><span>��§ҹ��á�á�Դ</span></a></li>
                    <li><a href="formNewborncare.php"><span>�������á��ѧ��ʹ</span></a></li>
                    <li><a href="reportNewborncare.php"><span>��§ҹ��á��ѧ��ʹ</span></a></li>
                    <li><a href="reportPolicy.php"><span>��§ҹ����ͺ�����</span></a></li>
                    <!-- EPI
                    NUTRITION -->
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);"><span>˭ԧ��駤����</span></a>
                <ul>
                    <li><a href="prenatal.php"><span>����ѵԵ�駤���� PRENATAL</span></a></li>
                    <li><a href="reportPrenatal.php"><span>��§ҹ PRENATAL</span></a></li>
                    <li><a href="anc.php"><span>��ԡ�ýҡ����� ANC</span></a></li>
                    <li><a href="anc_view.php"><span>��§ҹ ANC</span></a></li>
                    <li><a href="labor.php"><span>����ѵԡ�ä�ʹ LABOR</span></a></li>
                    <li><a href="reportLabor.php"><span>��§ҹ LABOR</span></a></li>
                    <li><a href="postnatal.php"><span>������ô���ѧ��ʹ POSTNATAL</span></a></li>
                    <li><a href="reportPostnatal.php"><span>��§ҹ POSTNATAL</span></a></li>
                    <li><a href="women.php"><span>˭ԧ��ԭ�ѹ�� WOMEN</span></a></li>
                    <li><a href="reportWomen.php"><span>��§ҹ WOMEN</span></a></li>
                    <li><a href="fp.php"><span>�ҧἹ��ͺ���� FP</span></a></li>
                    <li><a href="reportFp.php"><span>��§ҹ FP</span></a></li>
                    <!-- 
                    DENTAL 
                    -->
                </ul>
            </li>
            <li>
                <a href="javascript: void(0);"><span>�Ѥ�չ</span></a>
                <ul>
                <li><a href="epi.php"><span>�Ѥ�չ�� EPI</span></a></li>
                </ul>
            </li>
        </ul>
	</div>
	<div style="visibility: hidden"><a href="http://apycom.com/">a</a></div>
</div>

<style>
/* ���ҧ */
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

<?php 
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>