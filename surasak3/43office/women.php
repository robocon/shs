<?php 
include '../bootstrap.php';
include 'libs/functions.php';
$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $FPTYPE = input_post('FPTYPE');
    $NOFPCAUSE = input_post('NOFPCAUSE');
    $TOTALSON = input_post('TOTALSON');
    $NUMBERSON = input_post('NUMBERSON');
    $ABORTION = input_post('ABORTION');
    $STILLBIRTH = input_post('STILLBIRTH');
    $D_UPDATE = date('YmdHis');
    $CID = input_post('CID');

    $sql = "INSERT INTO `43women` ( 
        `id`, `HOSPCODE`, `PID`, `FPTYPE`, `NOFPCAUSE`, `TOTALSON`, 
        `NUMBERSON`, `ABORTION`, `STILLBIRTH`, `D_UPDATE`, `CID` 
    ) VALUES ( 
        NULL, '$HOSPCODE', '$PID', '$FPTYPE', '$NOFPCAUSE', '$TOTALSON', 
        '$NUMBERSON', '$ABORTION', '$STILLBIRTH', '$D_UPDATE', '$CID');";

    $save = $db->insert($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    
    redirect('women.php', $msg);
    exit;


    exit;
}


include 'head.php';

?>
<div class="clearfix">
    <h1 style="margin:0;">WOMEN</h1> <span>ข้อมูลหญิงวัยเจริญพันธุ์ที่อยู่กินกับสามี</span>
</div>

<fieldset>
    <legend>แฟ้ม : PRENATAL</legend>
    <form action="women.php" method="post">
        <table>
            <tr>
                <td>ค้นหาตาม HN : </td>
                <td><input type="text" name="hn" id=""></td>
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

$page = input_post('page');

if ($page === 'search') {
    
    $hn = input_post('hn');

    $sql = "SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ";
    $db->select($sql);
    $user = $db->get_item();

    ?>

    <form action="women.php" method="post">
        <fieldset>
            <legend>ฟอร์มบันทึก WOMEN</legend>
            <table>
                <tr>
                    <td class="txtRight">ชื่อ-สกุล : </td>
                    <td><?=$user['ptname'];?></td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานบริการ : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ทะเบียนบุคคล : </td>
                    <td><input type="text" name="PID" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">เลขที่บัตร : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">วิธีคุมกำเนิด : </td>
                    <td>
                        <?php 
                        $db->select("SELECT * FROM `f43_fp_63_women_172`");
                        $labor182Lists = $db->get_items();
                        $i = 1;
                        foreach ($labor182Lists as $key => $item) {
                            ?>
                            <input type="radio" name="FPTYPE" id="fptype<?=$i;?>" value="<?=$item['code'];?>"><label for="fptype<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">สาเหตุที่ไม่คุมกำเนิด : </td>
                    <td>
                        <?php 
                        $nofpcauseList = array(1 => 'ต้องการมีบุตร','หมันธรรมชาติ','อื่น ๆ');
                        $i = 1;
                        foreach ($nofpcauseList as $key => $item) {
                            ?>
                            <input type="radio" name="NOFPCAUSE" id="nofpcause<?=$i;?>" value="<?=$key;?>"><label for="nofpcause<?=$i;?>"><?=$item;?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">บุตรทั้งหมดที่เคยมี : </td>
                    <td><input type="text" name="TOTALSON" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">บุตรที่มีชีวิต : </td>
                    <td><input type="text" name="NUMBERSON" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนแท้งบุตร : </td>
                    <td><input type="text" name="ABORTION" value="0"></td>
                </tr>
                <tr>
                    <td class="txtRight">จำนวนทารกตายในครรภ์ หรือตายคลอด : </td>
                    <td><input type="text" name="STILLBIRTH" value="0"></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">บันทึก</button>
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php
}


include 'footer.php';