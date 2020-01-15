<?php 

include '../bootstrap.php';

$action = input_post('action');
if($action === 'save'){
    
    dump($_POST);
    exit;
}

include 'head.php';
?>

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 13pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
label{
    cursor: pointer;
}

@media print{
    .div-hide{
        display: none;
    }
}
</style>

<fieldset>
    <legend>ค้นหาข้อมูลตาม HN</legend>
    <form action="wellbaby_lpho.php" method="post">
        <div>
            HN : <input type="text" name="hn" id="hn">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchHn">
        </div>
    </form>
</fieldset>
<script>
window.onload = function(){
    document.getElementById("hn").focus();
}
</script>

<?php 

$page = input_post('page');
if( $page === 'searchHn' ){ 

    $db = Mysql::load();
    $hn = input_post('hn');
    $sql = "SELECT * FROM `ipcard` WHERE `hn` = '$hn'";
    $db->select($sql);

    if( $db->get_rows() > 0 ){
        $item = $db->get_item();

        // dump($item);
        // echo "<hr>";

        $db->select("SELECT * FROM `opcard` WHERE `hn`= '$hn'");
        $opcard = $db->get_item();

        // dump($opcard);
        // echo "<hr>";

        if( $opcard['yot'] == 'ด.ช.' ){
            $sex = '1';
        }elseif ( $opcard['yot'] == 'ด.ญ.' ) {
            $sex = '2';
        }
        

        $address = $opcard['address'].' ต.'.$opcard['tambol'].' อ.'.$opcard['ampur'].' จ.'.$opcard['changwat'];

        ?>
        <fieldset>
            <legend>ข้อมูลเบื้องต้น</legend>
            <table>
                <tr>
                    <td><b>AN : </b><?=$item['an'];?> <b>HN : </b><?=$item['hn'];?> <b>ชื่อ-สกุล : </b><?=$item['ptname'];?></td>
                </tr>
                <tr>
                    <td>วันที่รับบริการ : <?=$item['date'];?></td>
                </tr>
            </table>
        </fieldset>
        
        <form action="wellbaby_lpho.php" method="post">

            <table>
                <tr>
                    <td>
                    <h3>แบบเก็บข้อมูลโภชนาการและวัคซีนเด็ก 0-5 ปี หน่วยบริการ <span>โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></h3>
                    </td>
                </tr>
                <tr>
                    <td>
                        ชื่อสกุลบิดา <input type="text" name="father" id="" value="<?=trim($opcard['father']);?>"> ID <input type="text" name="fatherId" id="" size="12">
                    </td>
                </tr>
                <tr>
                    <td>
                        ชื่อสกุลมารดา <input type="text" name="mother" id="" value="<?=trim($opcard['mother']);?>"> ID <input type="text" name="motherId" id="" size="12">
                    </td>
                </tr>
                <tr>
                    <td>
                        บันทึกทารกแรกเกิด <input type="radio" name="prefix" id="prefix1" value="ด.ช." <?=($sex==1?'checked="checked"':'');?> > <label for="prefix1">ด.ช.</label> 
                        <input type="radio" name="prefix" id="prefix2" value="ด.ญ." <?=($sex==2?'checked="checked"':'');?>> <label for="prefix2">ด.ญ.</label> 

                        ชื่อ-สกุล <input type="text" name="name" id="" value="<?=$opcard['name'].' '.$opcard['surname'];?>"> ID <input type="text" name="idcard" id="" size="12" value="<?=$opcard['idcard'];?>">
                        <input type="hidden" name="sex" value="<?=$sex;?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        ที่อยู่ <input type="text" name="address" id="" value="<?=$address;?>" size="40"> 
                        เบอร์โทรที่ติดต่อได้ <input type="text" name="phone" id="" value="<?=$opcard['phone'];?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        วดป.เกิด <input type="text" name="dateBorn" id="dateBorn" value="<?=$opcard['dbirth'];?>"> 
                        เวลา <input type="text" name="timeBorn" id="" size="10"> 
                        น. น้ำหนักแรกเกิด <input type="text" name="weight" id="" size="5">กรัม
                    </td>
                </tr>
                <tr>
                    <td>
                        ความยาว <input type="text" name="height" id="" size="5">ซม. 
                        เส้นรอบศรีษะ <input type="text" name="head" id="" size="5">ซม. 
                        เส้นรอบอก <input type="text" name="breast" id="" size="5">ซม.
                    </td>
                </tr>
                <tr>
                    <td>
                        APGAR SCORE(1นาที) <select name="apgar1" id="">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="99">99</option>
                        </select>
                        (5นาที) <select name="apgar5" id="">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="99">99</option>
                        </select>
                        (10นาที) <select name="apgar10" id="">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="99">99</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>
                        ความผิดปกติแต่กำเนิด <input type="radio" name="disorder" id="disorder1" value="ไม่มี"><label for="disorder1">ไม่มี</label> 
                        <input type="radio" name="disorder" id="disorder2" value="มี"><label for="disorder2">มี</label> 
                        ระบุ <input type="text" name="disorderDetail" id="">
                    </td>
                </tr>
                <tr>
                    <td>
                        สภาวะสุขภาพแรกเกิด <input type="radio" name="health" id="health1" value="แข็งแรงดี"><label for="health1">แข็งแรงดี</label> 
                        <input type="radio" name="health" id="health2" value="ผิดปกติ"><label for="health2">ผิดปกติ</label> 
                        ระบุ <input type="text" name="healthDetail" id="">
                    </td>
                </tr>
                <tr>
                    <td>
                        ลำดับที่ของทารก <select name="birthNo" id="">
                            <option value="1">คลอดเดี่ยว</option>
                            <option value="2">เป็นแฝดลำดับที่ 1</option>
                            <option value="3">เป็นแฝดลำดับที่ 2</option>
                            <option value="4">เป็นแฝดลำดับที่ 3</option>
                            <option value="5">เป็นแฝดลำดับที่ 4</option>
                        </select>

                        อาหารที่รับประทาน <select name="" id="">
                            <option value="1">นมแม่อย่างเดียว</option>
                            <option value="2">นมแม่และน้ำ</option>
                            <option value="3">นมแม่และนมผสม</option>
                            <option value="4">นมผสมอย่างเดียว</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>วันที่จำหน่าย <input type="text" name="discharge" id="dischargeDate" size="10"> 
                        น้ำหนักวันที่จำหน่าย <input type="text" name="weightDischarge" id="" size="5"> 
                        วิตามินเค <input type="radio" name="vitamink" id="vitamink1" value="ฉีด"><label for="vitamink1">ฉีด</label> 
                        <input type="radio" name="vitamink" id="vitamink2" value="ไม่ฉีด"><label for="vitamink2">ไม่ฉีด</label>
                    </td>
                </tr>
                <tr>
                    <td>การตรวจสภาวะพร่องไทรอยด์ฮอร์โมน <input type="radio" name="thyroid" id="thyroid1" value="ปกติ"><label for="thyroid1">ปกติ</label> 
                        <input type="radio" name="thyroid" id="thyroid2" value="ผิดปกติ"><label for="thyroid2">ผิดปกติ</label>
                    </td>
                </tr>
                <tr>
                    <td>การตรวจPKU <input type="radio" name="pku" id="pku1" value="ปกติ"><label for="pku1">ปกติ</label> 
                        <input type="radio" name="pku" id="pku2" value="ผิดปกติ"><label for="pku2">ผิดปกติ</label>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="bcgDate" id="bcg" size="10"> วดป. ที่ได้ฉีดวัคซีนป้องกันโรค(BCG)
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type="text" name="hbDate" id="hb" size="10"> วดป. ที่ได้ฉีดวัคซีนป้องกันโรคตับอักเสบบี(HB)
                    </td>
                </tr>
            </table>
            <div>
                <button type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
            </div>
        </form>
        <script type="text/javascript">
            var popup1, popup2, popup3, popup4;
            window.onload = function() {
                popup1 = new Epoch('popup1','popup',document.getElementById('dateBorn'),false);
                popup2 = new Epoch('popup2','popup',document.getElementById('dischargeDate'),false);
                popup3 = new Epoch('popup2','popup',document.getElementById('bcg'),false);
                popup4 = new Epoch('popup2','popup',document.getElementById('hb'),false);
            };
        </script>
        <?php

    }else{
        ?>
        <h1>ไม่พบข้อมูล</h1>
        <?php
    }
    ?>
    <?php
}
?>



<?php 

include 'footer.php';
?>

<!-- 
<table class="chk_table">
    <tr>
        <td rowspan="2">วัคซีนที่ให้</td>
        <td rowspan="2">อายุที่ควรรับ</td>
        <td colspan="3">วันเดือนปีที่ได้รับวัคซีน</td>
    </tr>
    <tr>
        <td>ครั้งที่1</td>
        <td>ครั้งที่2</td>
        <td>ครั้งที่3</td>
    </tr>
</table>
-->