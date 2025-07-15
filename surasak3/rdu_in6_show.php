<?php 
include dirname(__FILE__).'/bootstrap.php';
define('RDU_TEST', '1');
$db = Mysql::load();

$dateStartTh = $_GET['date_start'];
$dateEndTh = $_GET['date_end'];

$date_start = bc_to_ad($dateStartTh);
$date_end = bc_to_ad($dateEndTh);

include dirname(__FILE__).'/rdu_core.php';
include dirname(__FILE__).'/rdu_in6.php';

$items = $items_a;
?> 
<style>
/* ตาราง */
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
        <td><b>ตัวชี้วัดที่ 6</b></td>
        <td>ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</td>
    </tr>
    <tr>
        <td><b>ตัวตั้ง</b></td>
        <td><a href="#table1">จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลัน ที่ได้รับยาปฏิชีวน</a></td>
    </tr>
    <tr>
        <td><b>ตัวหาร</b></td>
        <td><a href="#table2">จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันทั้งหมด</a></td>
    </tr>
    <tr>
        <td><b>เป้าหมาย</b></td>
        <td>น้อยกว่าหรือเท่ากับร้อยละ 20</td>
    </tr>
</table>

<p id="table1"><b>ตัวตั้ง</b> จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลัน</p>
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
    $doctorList = array();
    foreach ($items as $key => $item) {

        $doctorKey = $item['doctor'];
        if(!$doctorList[$doctorKey]){
            $doctorList[$doctorKey] = 1;
        }else{
            $doctorList[$doctorKey]++;
        }
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
<?php 
arsort($doctorList);
?>
<table class="chk_table" style="margin-top:8px;">
    <tr>
        <th>ชื่อแพทย์</th>
        <th>จำนวน</th>
    </tr>
    <?php 
    foreach ($doctorList as $key => $value) {
        ?>
        <tr>
            <td><?=$key;?></td>
            <td><?=$value;?></td>
        </tr>
        <?php
    }
    ?>
</table>
<?php 
$items = $items_b;
?>
<p id="table2"><b>ตัวหาร</b> จำนวนครั้งที่มารับบริการของผู้ป่วยนอกโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันทั้งหมด</p>
<table class="chk_table" style="margin-top:8px; display:none;" id="table2_detail">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>Diag1</th>
        <th>ICD-10</th>
        <th>แพทย์</th>
    </tr>
    <?php 
    $i = 1;
    $doctorList = array();
    foreach ($items as $key => $item) {
        $doctorKey = $item['doctor'];
        if(!$doctorList[$doctorKey]){
            $doctorList[$doctorKey] = 1;
        }else{
            $doctorList[$doctorKey]++;
        }
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['svdate'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['icd10'];?></td>
            <td><?=$item['doctor'];?></td>
        </tr>
        <?php 
        $i++;
    }
    ?>
</table>
<?php 
arsort($doctorList);
?>
<table class="chk_table" style="margin-top:8px;">
    <tr>
        <th>ชื่อแพทย์</th>
        <th>จำนวน</th>
    </tr>
    <?php 
    foreach ($doctorList as $key => $value) {
        ?>
        <tr>
            <td><?=$key;?></td>
            <td><?=$value;?></td>
        </tr>
        <?php
    }
    ?>
</table>

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
</script>

<button onclick="topFunction()" id="myBtn" title="Go to top" style="position: fixed;right: 8px;bottom: 8px;">Top</button>
<script>
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

