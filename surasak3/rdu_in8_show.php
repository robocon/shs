<?php 
include dirname(__FILE__).'/bootstrap.php';
define('RDU_TEST', '1');

$db = Mysql::load();
$db->exec("SET NAMES UTF8");

$dateStartTh = $_GET['date_start'];
$dateEndTh = $_GET['date_end'];

$date_start = bc_to_ad($dateStartTh);
$date_end = bc_to_ad($dateEndTh);

include dirname(__FILE__).'/rdu_tb_diag.php';
include dirname(__FILE__).'/rdu_tb_drugrx.php';
include dirname(__FILE__).'/rdu_tb_trauma.php';
include dirname(__FILE__).'/rdu_tb_opday.php';
include dirname(__FILE__).'/rdu_in8.php';

?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 20px;
}
h3{
    margin: 0;
    padding: 0;
}
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
#table1, #table2{
    padding: 4px;
}
#table1:hover, #table2:hover{
    cursor: pointer;
    background-color: #888888;
    color: white;
}
</style>

<table>
    <tr>
        <td><b>ตัวชี้วัดที่ 8</b></td>
        <td>ร้อยละการใช้ยาปฏิชีวนะในบาดแผลสดจากอุบัติเหต</td>
    </tr>
    <tr>
        <td><b>ตัวตั้ง</b></td>
        <td><a href="#table1">จำนวนครั้งของผู้ป่วยนอกบาดแผลสดจากอุบัติเหตุที่ได้รับยาปฏิชีวนะ</a></td>
    </tr>
    <tr>
        <td><b>ตัวหาร</b></td>
        <td><a href="#table2">จำนวนครั้งของผู้ป่วยนอกบาดแผลสดจากอุบัติเหตุทั้งหมด</a></td>
    </tr>
    <tr>
        <td><b>เป้าหมาย</b></td>
        <td>น้อยกว่าหรือเท่ากับร้อยละ 40</td>
    </tr>
</table>


<p id="table1"><b>ตัวตั้ง</b> จำนวนครั้งของผู้ป่วยนอกบาดแผลสดจากอุบัติเหตุที่ได้รับยาปฏิชีวนะ <span title="Expand">↕️</span></p>
<table class="chk_table" id="table1_detail" style="display: none;">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>Diag</th>
        <th>ICD-10</th>
        <th>Drug code</th>
        <th>จำนวน</th>
        <th>แพทย์</th>
    </tr>
<?php 
$i = 1;
foreach ($items_in8_a as $key => $item) {
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['diag'];?></td>
        <td><?=$item['icd10'];?></td>
        <td><?=$item['drugcode'];?></td>
        <td><?=$item['amount'];?></td>
        <td><?=$item['doctor'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>

<div>&nbsp;</div>

<p id="table2"><b>ตัวหาร</b> จำนวนครั้งของผู้ป่วยนอกบาดแผลสดจากอุบัติเหตุทั้งหมด <span title="Expand">↕️</span></p>
<table class="chk_table" style="margin-top:8px;" id="table2_detail">
    <tr>
        <th>#</th>
        <th style="width:80px;">วันที่</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>ชื่อแพทย์</th>
        <th style="width:650px;">อาการ</th>
    </tr>
    <?php 
    $doctorList = array();
    $i = 1;
    foreach ($items_in8_b as $key => $item) {
        $key = $item['doctor'];
        if(!$doctorList[$key]){
            $doctorList[$key] = 1;
        }else{
            $doctorList[$key]++;
        }
        ?>
        <tr valign="top">
            <td><?=$i;?></td>
            <td><?=$item['date'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['organ'];?></td>
        </tr>
        <?php
        $i++;
    }
    ?>
</table>
<button onclick="topFunction()" id="myBtn" title="Go to top" style="position: fixed;right: 8px;bottom: 8px;">Top</button>
<script>
    function toggle(el) {
        if (el.style.display == 'none') {
            el.style.display = '';
        } else {
            el.style.display = 'none';
        }
    }

    document.getElementById('table1').addEventListener("click", function(){
        const tb = document.getElementById('table1_detail');
        toggle(tb);
    });

    document.getElementById('table2').addEventListener("click", function(){
        const tb = document.getElementById('table2_detail');
        toggle(tb);
    });

    // Get the button:
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>