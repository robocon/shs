<?php
include_once 'bootstrap.php';
$dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);
/**
 * ตัวตั้งต้นใน opday
 * -> เอาไปหาใน opacc2 ก่อนว่ามี depart อะไรบ้าง
 *      ->ถ้าเป็น LAB(PATHO) ไปหาใน resulthead ได้ว่ามี lab อะไรที่สั่งไปบ้าง
 *      ->ถ้าเป็น ค่ายา(PHAR) ไปที่หน้าฟอร์ม
 * 

R23 นักเรียน/นักศึกษาทหาร
R07 ประกันสังคม
R04 รัฐวิสาหกิจ
R09 ประกันสุขภาพถ้วนหน้า
R16 ศึกษาธิการ(ครูเอกชน)
R06 พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
R12 ประกันสุขภาพถ้วนหน้า(ผู้พิการ)
R22 ตรวจสุขภาพประจำปีกองทัพบก
R48 ธนาคารแห่งประเทศไทย
R47 ธนาคารออมสิน
 */

$page = $_REQUEST['page'];
if(empty($page)){
    $sql = "select `thidate`,`thdatehn`,`hn`,`vn`,`ptname`,`ptright` 
    from opday 
    where thdatehn like '23-03-2565%' 
    and ( thidate >= '2565-03-23 03:00:00' and thidate <= '2565-03-23 10:00:00' ) 
    and ( 
        ptright not like 'R03%' 
        and ptright not like 'R01%' 
        and ptright not like 'R33%' 
        and ptright not like 'R02%' 
        and ptright not like 'R49%' 
    ) 
    order by thidate asc 
    limit 500 ";
    $q = $dbi->query($sql);
    ?>
    <table border="1">
        <tr>
            <th></th>
            <th>thidate</th>
            <th>hn</th>
            <th>vn</th>
            <th>ptright</th>
            <th>depart</th>
        </tr>
    <?php
    $numi = 1;
    while ($it = $q->fetch_assoc()) {
        $hn = $it['hn'];
        $vn = $it['vn'];
        $thidate = $it['thidate'];

        ?>
        <tr>
            <td><?=$numi;?></td>
            <td><a href="hotfix23.php?page=findopacc&hn=<?=$hn;?>&date=<?=$thidate;?>"><?=$it['thidate'];?></a></td>
            <td><?=$it['hn'];?></td>
            <td><?=$it['vn'];?></td>
            <td><?=$it['ptname'];?></td>
            <td><?=$it['ptright'];?></td>
        </tr>
        <?php
        $numi++;
    }
    ?>
    </table>
    <?php
}elseif ($page==='findopacc') {

    $hn = $_REQUEST['hn'];
    list($date, $time) = explode(' ', $_REQUEST['date']);

    $sql = "SELECT * FROM `opacc2` WHERE `date` LIKE '$date%' AND `hn` = '$hn' GROUP BY `price`,`depart` ";
    $q = $dbi->query($sql);
    ?>
    <h3>ข้อมูลจาก OPACC2</h3>
    <table>
        <tr>
            <td>date</td>
            <td>depart</td>
            <td>detail</td>
            <td>price</td>
            <td>paid</td>
        </tr>
    <?php
    while($a = $q->fetch_assoc()){
        ?>
        <tr>
            <td><?=$a['date'];?></td>
            <td><?=$a['depart'];?></td>
            <td><?=$a['detail'];?></td>
            <td><?=$a['price'];?></td>
            <td><?=$a['paid'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <hr>
    <h3>ข้อมูลจาก OPACC</h3>
    <?php 
    $sql = "SELECT * FROM `opacc` WHERE `date` LIKE '$date%' AND `hn` = '$hn' ";
    $q = $dbi->query($sql);
    ?>
    <table>
        <tr>
            <td>date</td>
            <td>depart</td>
            <td>detail</td>
            <td>price</td>
            <td>paid</td>
        </tr>
    <?php
    while($a = $q->fetch_assoc()){
        ?>
        <tr>
            <td><?=$a['date'];?></td>
            <td><?=$a['depart'];?></td>
            <td><?=$a['detail'];?></td>
            <td><?=$a['price'];?></td>
            <td><?=$a['paid'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <hr>
    <h3>depart</h3>
    <?php 
    $sql = "SELECT * FROM `depart` WHERE `date` LIKE '$date%' AND `hn` = '$hn' ";
    $q=$dbi->query($sql);
    ?>
    <table>
    <?php
    while($a=$q->fetch_assoc()){
        ?>
        <tr>
            <td><?=$a['depart'];?></td>
            <td><?=$a['detail'];?></td>
            <td><?=$a['amount'];?></td>
            <td><?=$a['price'];?></td>
        </tr>
        <?php

    }
    ?>
    </table>
    <?php
}
