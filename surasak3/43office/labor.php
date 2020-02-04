<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $GRAVIDA = input_post('GRAVIDA');

    $LMP = input_post('LMP');
    $LMP = bc_to_ad($LMP);
    $LMP = str_replace('-','', $LMP);

    $EDC = input_post('EDC');
    $EDC = bc_to_ad($EDC);
    $EDC = str_replace('-','', $EDC);

    $BDATE = input_post('BDATE');
    $BDATE = bc_to_ad($BDATE);
    $BDATE = str_replace('-','', $BDATE);

    $BRESULT = input_post('BRESULT');
    $BPLACE = input_post('BPLACE');
    $BHOSP = input_post('BHOSP');
    $BTYPE = input_post('BTYPE');
    $BDOCTOR = input_post('BDOCTOR');
    $LBORN = (int) $_POST['LBORN'];
    $SBORN = (int) $_POST['SBORN'];
    $D_UPDATE = date('YmdHis');
    $CID = input_post('CID');
    $ipcard_id = input_post('ipcard_id');

    $sql = "INSERT INTO `43labor` ( 
        `id`, `HOSPCODE`, `PID`, `GRAVIDA`, `LMP`, `EDC`, 
        `BDATE`, `BRESULT`, `BPLACE`, `BHOSP`, `BTYPE`, `BDOCTOR`, 
        `LBORN`, `SBORN`, `D_UPDATE`, `CID`, `ipcard_id` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$GRAVIDA', '$LMP', '$EDC', 
        '$BDATE', '$BRESULT', '$BPLACE', '$BHOSP', '$BTYPE', '$BDOCTOR', 
        '$LBORN', '$SBORN', '$D_UPDATE', '$CID', '$ipcard_id' 
    );";
    
    $save = $db->insert($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    
    redirect('labor.php', $msg);
    exit;
}

include 'head.php';
?>
<fieldset>
    <legend>แฟ้ม : LABOR</legend>
    <form action="labor.php" method="post">
        <table>
            <tr>
                <td>ค้นหาตาม AN : </td>
                <td><input type="text" name="an" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
<?php
$page = input('page');
if ( $page === 'search' ) {
    $an = input_post('an');

    $sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' ";
    $db->select($sql);
    $ipcard = $db->get_item();

    $hn = $ipcard['hn'];
    $sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn'";
    $db->select($sql);
    $opcard = $db->get_item();
    
    ?>
    <fieldset>
        <legend>ฟอร์มบันทึก LABOR</legend>
        <form action="labor.php" method="post">
            <table>
                <tr>
                    <td colspan="2">
                    <b>AN : </b> <?=$ipcard['an'];?> <b>ชื่อ-สกุล : </b> <?=$ipcard['ptname'];?> <b>วันที่มารับบริการ : </b> <?=$ipcard['date'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานบริการ : </td>
                    <td>
                        <input type="text" name="HOSPCODE" value="11512" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ทะเบียนบุคคล : </td>
                    <td>
                        <input type="text" name="PID" value="<?=$ipcard['hn'];?>" readonly>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ครรภ์ที่ : </td>
                    <td><input type="text" name="GRAVIDA" id="">(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">วันแรกของการมีประจำเดือนครั้งสุดท้าย : </td>
                    <td><input type="text" name="LMP" id="LMP"></td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่กำหนดคลอด : </td>
                    <td><input type="text" name="EDC" id="EDC"></td>
                </tr>
                <tr>
                    <td class="txtRight">วันคลอด/วันสิ้นสุดการตั้งครรภ์ : </td>
                    <td><input type="text" name="BDATE" id="BDATE"></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลสิ้นสุดการตั้งครรภ์ : </td>
                    <td><input type="text" name="BRESULT" id="BRESULT">รหัสโรค ICD - 10 TM <span id="labor181" style="position: relative;"></div></td>
                </tr>
                <tr>
                    <td class="txtRight">สถานที่คลอด : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_182_newborn_187`");
                        $labor182Lists = $db->get_items();
                        $i = 1;
                        foreach ($labor182Lists as $key => $item) {
                            ?>
                            <input type="radio" name="BPLACE" id="bplace<?=$i;?>" value="<?=$item['code'];?>"><label for="bplace<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานพยาบาลที่คลอด : </td>
                    <td><input type="text" name="BHOSP" value="11512"></td>
                </tr>
                <tr>
                    <td class="txtRight">วิธีการคลอด/สิ้นสุดการตั้งครรภ์ : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_184_newborn_190`");
                        $btypeLists = $db->get_items();
                        $i = 1;
                        foreach ($btypeLists as $key => $item) {
                            ?>
                            <input type="radio" name="BTYPE" id="btype<?=$i;?>" value="<?=$item['code'];?>"><label for="btype<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">ประเภทของผู้ทำคลอด : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_labor_185_newborn_191`");
                        $hivLists = $db->get_items();
                        $i = 1;
                        foreach ($hivLists as $key => $item) {
                            ?>
                            <input type="radio" name="BDOCTOR" id="bdoctor<?=$i;?>" value="<?=$item['code'];?>"><label for="bdoctor<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนเกิดมีชีพ : </td>
                    <td><input type="text" name="LBORN" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนตายคลอด : </td>
                    <td><input type="text" name="SBORN" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">เลขที่บัตรประชาชน : </td>
                    <td><input type="text" name="CID" value="<?=$opcard['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">บันทึก</button>
                        <input type="hidden" name="ipcard_id" value="<?=$ipcard['row_id'];?>">
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </form>
    </fieldset>
    <?php
    include 'assets/ajax.php';
    ?>
    <script type="text/javascript">
        var popup1, popup2, popup3;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('LMP'),false);
            popup2 = new Epoch('popup2','popup',document.getElementById('EDC'),false);
            popup3 = new Epoch('popup2','popup',document.getElementById('BDATE'),false);
        };


        var btnBRESULT = document.getElementById("BRESULT");
        btnBRESULT.addEventListener('keyup', function(event) {

            var newSm = new SmHttp();
            newSm.ajax(
                'labor181.php', 
                { 'word': btnBRESULT.value }, 
                function(res){
                    document.getElementById('labor181').innerHTML = res;

                    /* https://clubmate.fi/detect-click-with-pure-javascript/ */
                    var el = document.getElementsByClassName('icd10');
                    for (var i=0; i < el.length; i++) {
                        // Here we have the same onclick
                        el.item(i).onclick = function(){

                            document.getElementById('BRESULT').value = this.getAttribute('data');
                            document.getElementById('labor181').innerHTML = '';
                        };
                    }

                    // ปุ่มปิด
                    var btnClose = document.getElementById("btnLaborClose");
                    btnClose.addEventListener('click', function(event) { 
                        document.getElementById('labor181').innerHTML = '';
                    });

                }
            );
        });


    </script>
    <?php

}