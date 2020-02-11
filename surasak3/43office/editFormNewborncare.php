<?php 
include '../bootstrap.php';

$db = Mysql::load();

$action = input_post('action');
if ($action === 'save') {

    $id = input_post('id');
    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('PID');
    $CID = input_post('CID');
    $SEQ = input_post('SEQ');
    $BDATE = input_post('BDATE');
    $BDATE = bc_to_ad($BDATE);
    $BDATE = str_replace('-','', $BDATE);

    $BCARE = input_post('BCARE');
    $BCARE = bc_to_ad($BCARE);
    $BCARE = str_replace('-','', $BCARE);

    $BCPLACE = input_post('BCPLACE');
    $BCARERESULT = input_post('BCARERESULT');
    $FOOD = input_post('FOOD');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = input_post('D_UPDATE');

    $sql = "UPDATE `43newborncare` SET 
    `HOSPCODE`='$HOSPCODE', 
    `PID`='$PID', 
    `SEQ`='$SEQ', 
    `BDATE`='$BDATE', 
    `BCARE`='$BCARE', 
    `BCPLACE`='$BCPLACE', 
    `BCARERESULT`='$BCARERESULT', 
    `FOOD`='$FOOD', 
    `PROVIDER`='$PROVIDER', 
    `D_UPDATE`='$D_UPDATE', 
    `CID`='$CID' 
    WHERE (`id`='$id');";

    $save = $db->update($sql);
    $msg = "บันทึกข้อมูลเรียบร้อย";
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('editFormNewborncare.php?id='.$id, $msg);

    exit;
}

include 'head.php';
$id = input('id');
$sql = "SELECT * FROM `43newborncare` WHERE `id` = '$id' ";
$db->select($sql);
$item = $db->get_item();

$bdate = ( substr($item['BDATE'],0,4) + 543).'-'.substr($item['BDATE'],4,2).'-'.substr($item['BDATE'],6,2);
$bcare = ( substr($item['BCARE'],0,4) + 543).'-'.substr($item['BCARE'],4,2).'-'.substr($item['BCARE'],6,2);

?>
<div class="clearfix">
    <h1 style="margin:0;">NEWBORNCARE</h1> <span>ดูแลทารกหลังคลอดของหญิงตั้งครรภ์</span>
</div>

<fieldset>
    <legend>ฟอร์ม NEWBORNCARE</legend>
    <form action="editFormNewborncare.php" method="post">
        <table>
            <tr>
                <td class="txtRight">รหัสสถานบริการ : </td>
                <td><input type="text" name="HOSPCODE" value="<?=$item['HOSPCODE'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">ทะเบียนบุคคล (เด็ก) : </td>
                <td><input type="text" name="PID" value="<?=$item['PID'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">เลขที่บัตรประชาชน : </td>
                <td><input type="text" name="CID" value="<?=$item['CID'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">ลำดับที่ : </td>
                <td><input type="text" name="SEQ" value="<?=$item['SEQ'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">วันที่คลอด : </td>
                <td><input type="text" name="BDATE" id="BDATE" value="<?=$bdate;?>"></td>
            </tr>
            <tr>
                <td class="txtRight">วันที่ดูแลลูก : </td>
                <td><input type="text" name="BCARE" id="BCARE" value="<?=$bcare;?>"></td>
            </tr>
            <tr>
                <td class="txtRight">รหัสสถานพยาบาลที่ดูแลลูก : </td>
                <td><input type="text" name="BCPLACE" value="<?=$item['BCPLACE'];?>"></td>
            </tr>
            <tr>
                <td class="txtRight">ผลการตรวจทารกหลังคลอด : </td>
                <td>
                
                
                    <?php 
                    $db->select("SELECT * FROM `f43_newborncare_196`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $list) { 
                        $checked = ($item['BCARERESULT'] == $list['code']) ? 'checked="checked"' : ''; 
                        ?>
                        <input type="radio" name="BCARERESULT" id="bresult<?=$i;?>" value="<?=$list['code'];?>" <?=$checked;?> ><label for="bresult<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">อาหารที่รับประทาน : </td>
                <td>
                    <?php 
                    $db->select("SELECT * FROM `f43_newborncare_197`");
                    $ppLists = $db->get_items();
                    $i = 1;
                    foreach ($ppLists as $key => $list) { 
                        $selected = ($item['FOOD'] == $list['code']) ? 'checked="checked"' : ''; 
                        ?>
                        <input type="radio" name="FOOD" id="food<?=$i;?>" value="<?=$list['code'];?>" <?=$selected;?> ><label for="food<?=$i;?>"><?=$list['detail'];?></label>
                        <?php
                        $i++;
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td class="txtRight">เลขที่ผู้ให้บริการ : </td>
                <td>
                    <select name="PROVIDER" id="">
                    <?php 
                    $sql = "SELECT a.`PROVIDER`,CONCAT(b.`abbreviations`,a.`NAME`,' ',a.`LNAME`) AS `PROVIDER_NAME` 
                    FROM `tb_provider_9` AS a 
                    LEFT JOIN `f43_person_1` AS b ON b.`code` = a.`PRENAME` 
                    ORDER BY a.`PROVIDERTYPE` ASC ";
                    $db->select($sql);
                    $providerList = $db->get_items();

                    foreach ($providerList as $key => $pv) {
                        ?>
                        <option value="<?=$pv['PROVIDER'];?>"><?=$pv['PROVIDER_NAME'];?></option>
                        <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="txtRight">วันเดือนปีที่ปรับปรุง : </td>
                <td><input type="text" name="D_UPDATE" value="<?=$item['D_UPDATE'];?>"></td>
            </tr>
            <tr>
				<td colspan="2" align="center">
					<input name="conbtn" type="submit" value=" บันทึกข้อมูล " />
					<input type="hidden" name="id" value="<?=$item['id'];?>">
					<input type="hidden" name="action" value="save">
				</td>
			</tr>
        </table>
    </form>
</fieldset>
<script>
var popup1, popup2;
window.onload = function() {
    popup1 = new Epoch('popup1','popup',document.getElementById('BDATE'),false);
    popup2 = new Epoch('popup2','popup',document.getElementById('BCARE'),false);
};
</script>