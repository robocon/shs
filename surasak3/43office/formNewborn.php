<?php 

include '../bootstrap.php';

if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','ชื่อผู้ใช้งานไม่ถูกต้อง');
    exit;
}


$action = input_post('action');
if($action === 'save'){
    
    $db = Mysql::load();

    // dump($_POST);
    $mpid = input_post('motherId');
    $idcard = input_post('idcard');
    $bhosp = $hospcode = '11512';
    $garvida = input_post('gravida');
    $ga = input_post('ga');
    $bdate = input_post('dateBorn');
    $btime = input_post('timeBorn');

    $bdate = bc_to_ad($bdate);
    $bdate = str_replace('-','', $bdate);

    $btime = str_replace('.','', $btime);
    $btime = $btime.'00';

    $bplace = input_post('bplace'); //สถานที่เกิด
    $birthno = input_post('birthNo');
    $btype = input_post('btype');
    $bdoctor = input_post('bdoctor');
    $bweight = input_post('weight');
    $asphyxia = input_post('asphyxia');
    $vitk = input_post('vitk');
    $tsh = input_post('tsh');
    $tshresult = input_post('thyroidResult');
    $d_update = date('YmdHis');

    

    exit;

    /*
    father
    fatherId
    mother
    address
    phone // เบอร์โทร
    lborn // คนที่
    head // รอบหัว
    breast // รอบอก
    apgar5 // แอพการ์ที่ 5นาที
    apgar10

    disorder // ความผิดปกติแต่กำเนิด -> BCARERESULT
    disorderDetail
    health // สภาวะสุขภาพแรกเกิด
    healthDetail

    food // อาหารที่รับประทาน
    pku // การตรวจPKU

    bcgDate // วันที่ได้รับ bcg
    hbDate // วันที่ได้รับ hb

    discharge // dc
    weightDischarge
    // $xxx = input_post('');
    */

    $sql = "INSERT INTO `43newborn` ( 
        `id`, `HOSPCODE`, `PID`, `MPID`, `GRAVIDA`, `GA`, 
        `BDATE`, `BTIME`, `BPLACE`, `BHOSP`, `BIRTHNO`, `BTYPE`, 
        `BDOCTOR`, `BWEIGHT`, `ASPHYXIA`, `VITK`, `TSH`, `TSHRESULT`, 
        `D_UPDATE`, `date_added`, `owner`) 
    VALUES (
        NULL, '$hospcode', '$idcard', '$mpid', '$garvida', '$ga', 
        '$bdate', '$btime', '$bplace', '$bhosp', '$birthno', '$btype', 
        '$bdoctor', '$bweight', '$asphyxia', '$vitk', '$tsh', '$tshresult', 
        '$d_update', NOW(), 
    );";
    $save = $db->insert($sql);
    dump($sql);
    dump($save);

    /**
     * @toto
     * SEQ ไปเอา vn จาก opday
     * BCARE ไปเอา date จากใน ipcard
     * PROVIDER เอาจาก doctor ใน ipcard
     */
    $bcareresult = input_post('disorder');
    $food = input_post('food');

    $sql = "INSERT INTO `43newborncare` (
        `id`, `HOSPCODE`, `PID`, `SEQ`, `BDATE`, `BCARE`, 
        `BCPLACE`, `BCARERESULT`, `FOOD`, `PROVIDER`, `D_UPDATE`
    ) VALUES (
        NULL, '$hospcode', '$idcard', NULL, '$bdate', NULL, 
        '$hospcode', '$bcareresult', '$food', NULL, '$d_update'
    );";
    $save = $db->insert($sql);
    dump($sql);
    dump($save);
    exit;
}

include 'head.php';

$apgarList = array(
    0 => 0,1,2,3,4,5,6,7,8,9,10,
    99 => 'ไม่ทราบ'
);

$gravidaList = array(1 => 1,2,3,4,5,6,7,8,9,10);

?>
<fieldset>
    <legend>ค้นหาข้อมูลตาม AN</legend>
    <form action="formNewborn.php" method="post">
        <div>
            AN : <input type="text" name="an" id="an">
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="page" value="searchAn">
        </div>
    </form>
</fieldset>
<script>
window.onload = function(){
    document.getElementById("an").focus();
}
</script>

<?php 
$page = input_post('page');
if( $page === 'searchAn' ){ 

    $db = Mysql::load();
    $db->exec("SET NAMES TIS620");

    $an = input_post('an');
    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an'";
    $db->select($sql);

    if( $db->get_rows() > 0 ){
        $item = $db->get_item();

        $hn = $item['hn'];

        $db->select("SELECT * FROM `opcard` WHERE `hn`= '$hn'");
        $opcard = $db->get_item();

        if( $opcard['yot'] == 'ด.ช.' ){
            $sex = '1';
        }elseif ( $opcard['yot'] == 'ด.ญ.' ) {
            $sex = '2';
        }
        
        $address = $opcard['address'].' ต.'.$opcard['tambol'].' อ.'.$opcard['ampur'].' จ.'.$opcard['changwat'];

        ?>
        <fieldset>
            <legend>ข้อมูลเบื้องต้นวันที่มารับบริการ</legend>
            <table>
                <tr>
                    <td><b>AN : </b><?=$item['an'];?> <b>HN : </b><?=$item['hn'];?> <b>ชื่อ-สกุล : </b><?=$item['ptname'];?></td>
                </tr>
                <tr>
                    <td><b>วันที่รับบริการ : </b><?=$item['date'];?></td>
                </tr>
            </table>
        </fieldset>
        <form action="formNewborn.php" method="post">
            <fieldset>
                <legend>ข้อมูลพื้นฐาน</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">ชื่อสกุลบิดา <input type="text" name="father" id="" value="<?=trim($opcard['father']);?>"></span>
                            <span class="sRow">ID <input type="text" name="fatherId" size="12"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">ชื่อสกุลมารดา <input type="text" name="mother" id="" value="<?=trim($opcard['mother']);?>"></span>
                            <span class="sRow">ID <input type="text" name="motherId" class="important" size="12"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">บันทึกทารกแรกเกิด <input type="radio" name="prefix" id="prefix1" value="ด.ช." <?=($sex==1?'checked="checked"':'');?> > <label for="prefix1">ด.ช.</label> 
                            <input type="radio" name="prefix" id="prefix2" value="ด.ญ." <?=($sex==2?'checked="checked"':'');?>> <label for="prefix2">ด.ญ.</label></span>

                            <span class="sRow">ชื่อ-สกุล <input type="text" name="name" id="" value="<?=$opcard['name'].' '.$opcard['surname'];?>"></span>
                            <span class="sRow">ID <input type="text" name="idcard" id="" size="12" value="<?=$opcard['idcard'];?>"></span>

                            <input type="hidden" name="sex" value="<?=$sex;?>">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">ที่อยู่ <input type="text" name="address" id="" value="<?=$address;?>" size="40"></span>
                            <span class="sRow">เบอร์โทรที่ติดต่อได้ <input type="text" name="phone" id="" value="<?=$opcard['phone'];?>"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">วดป.เกิด <input type="text" name="dateBorn" class="important" id="dateBorn" value="<?=$opcard['dbirth'];?>"></span>
                            <span class="sRow">เวลา <input type="text" name="timeBorn" class="important" id="" size="10"> น.</span>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <fieldset>
                <legend>ข้อมูลการคลอด</legend>
                <table>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">ครรภ์ที่ <select name="gravida">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>
                            
                            <span class="sRow">อายุครรภ์ <input type="text" name="ga" class="important" size="3">สัปดาห์</span>

                            <!-- LABOR -->
                            <span class="sRow">คนที่ <select name="lborn" id="">
                            <?php 
                                foreach ($gravidaList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                            ?>
                            </select></span>

                            <!-- LABOR -->
                            <span class="sRow">สถานที่ <select name="bplace" id="">
                            <?php 
                            $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                            
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <!-- LABOR -->
                            <span class="sRow">
                                วิธีการคลอด <select name="btype" id="">
                                    <?php 
                                    $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                                    $bdoctorLists = $db->get_items();
                                    foreach ($bdoctorLists as $key => $bdoc) {
                                        ?>
                                        <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </span>

                            <span class="sRow">
                                ประเภทผู้ทำคลอด <select name="bdoctor" id="">
                                <?php 
                                $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                                $bdoctorLists = $db->get_items();
                                foreach ($bdoctorLists as $key => $bdoc) {
                                    ?>
                                    <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">น้ำหนักแรกเกิด <input type="text" name="weight" id="" size="5" class="important">กรัม </span>
                            <span class="sRow">ความยาว <input type="text" name="height" id="" size="5" class="important">ซม. </span>
                            <span class="sRow">เส้นรอบศรีษะ <input type="text" name="head" id="" size="5" class="important">ซม. </span>
                            <span class="sRow">เส้นรอบอก <input type="text" name="breast" id="" size="5">ซม. </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">

                            <span class="sRow">APGAR SCORE</span>
                            
                            <span class="sRow">(1นาที) <select name="asphyxia" id="" class="important">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">(5นาที) <select name="apgar5" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">(10นาที) <select name="apgar10" id="">
                                <?php 
                                foreach ($apgarList as $key => $value) {
                                    ?><option value="<?=$key;?>"><?=$value;?></option><?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">
                                <input type="checkbox" name="asphyxia" id="noAsphyxia" value="99"> <label for="noAsphyxia">ไม่ทราบ</label>
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ความผิดปกติแต่กำเนิด<span style="color: red;">*</span> <input type="radio" name="disorder" id="disorder1" value="1"><label for="disorder1">ไม่มี</label> 
                            <input type="radio" name="disorder" id="disorder2" value="2"><label for="disorder2">มี</label> 
                            ระบุ <input type="text" name="disorderDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            สภาวะสุขภาพแรกเกิด <input type="radio" name="health" id="health1" value="แข็งแรงดี"><label for="health1">แข็งแรงดี</label> 
                            <input type="radio" name="health" id="health2" value="ผิดปกติ"><label for="health2">ผิดปกติ</label> 
                            ระบุ <input type="text" name="healthDetail" id="">
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">ลำดับที่ของทารก <select name="birthNo" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborn_18_pp`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>

                            <span class="sRow">อาหารที่รับประทาน <select name="food" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborncare_197`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            ได้รับ VIT K หรือไม่<span style="color: red;">*</span> 
                            <select name="vitk" class="important">
                            <?php 
                            $db->select("SELECT * FROM `f43_newborn_193`");
                            $bdoctorLists = $db->get_items();
                            foreach ($bdoctorLists as $key => $bdoc) {
                                ?>
                                <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">ได้รับการตรวจ TSH หรือไม่<span style="color: red;">*</span> 
                                <select name="tsh" class="important">
                                <?php 
                                $db->select("SELECT * FROM `f43_newborn_194`");
                                $bdoctorLists = $db->get_items();
                                foreach ($bdoctorLists as $key => $bdoc) {
                                    ?>
                                    <option value="<?=$bdoc['code'];?>"><?=$bdoc['detail'];?></option>
                                    <?php
                                }
                                ?>
                                </select>
                            </span>
                            <span class="sRow">ผลการตรวจไทรอยด์ <input type="text" name="thyroidResult" id="" size="5" class="important">mU/L</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">การตรวจPKU <input type="radio" name="pku" id="pku1" value="ปกติ"><label for="pku1">ปกติ</label> 
                            <input type="radio" name="pku" id="pku2" value="ผิดปกติ"><label for="pku2">ผิดปกติ</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <input type="text" name="bcgDate" id="bcg" size="10"> วดป. ที่ได้ฉีดวัคซีนป้องกันโรค(BCG)
                            <input type="text" name="hbDate" id="hb" size="10"> วดป. ที่ได้ฉีดวัคซีนป้องกันโรคตับอักเสบบี(HB)
                        </td>
                    </tr>
                    <tr>
                        <td class="tdRow">
                            <span class="sRow">วันที่จำหน่าย <input type="text" name="discharge" id="dischargeDate" size="10"> </span>
                            <span class="sRow">น้ำหนักวันที่จำหน่าย <input type="text" name="weightDischarge" id="" size="5">กรัม</span>
                        </td>
                    </tr>
                </table>
            </fieldset>
            <div>
                <div>&nbsp;</div>
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
}
include 'footer.php';
?>