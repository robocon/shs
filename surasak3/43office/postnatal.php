<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();
$action = input_post('action');
if( $action === 'save' ){

    $HOSPCODE = input_post('HOSPCODE');
    $PID = input_post('hn');
    $SEQ = input_post('seq');
    $GRAVIDA = input_post('GRAVIDA');
    $BDATE = input_post('BDATE');
    $PPCARE = input_post('PPCARE');
    $PPPLACE = input_post('PPPLACE');
    $PPRESULT = input_post('PPRESULT');
    $PROVIDER = input_post('PROVIDER');
    $D_UPDATE = date('YmdHis');
    $CID = input_post('CID');
    $opday_id = input_post('opday_id');
    $postnatal_id = input_post('postnatal_id');

    $BDATE = bc_to_ad($BDATE);
    $BDATE = str_replace('-','', $BDATE);

    $PPCARE = bc_to_ad($PPCARE);
    $PPCARE = str_replace('-','', $PPCARE);

    if(empty($postnatal_id))
    {
        $sql = "INSERT INTO `43postnatal` ( 
            `id`, `HOSPCODE`, `PID`, `SEQ`, `GRAVIDA`, `BDATE`, 
            `PPCARE`, `PPPLACE`, `PPRESULT`, `PROVIDER`, `D_UPDATE`, `CID`, 
            `opday_id` 
        ) VALUES ( 
            NULL, '$HOSPCODE', '$PID', '$SEQ', '$GRAVIDA', '$BDATE', 
            '$PPCARE', '$PPPLACE', '$PPRESULT', '$PROVIDER', '$D_UPDATE', '$CID', 
            '$opday_id' 
        );";
        $save = $db->insert($sql);
    }
    else
    {
        $sql = "UPDATE `43postnatal` SET 
        `SEQ`='$SEQ', 
        `GRAVIDA`='$GRAVIDA', 
        `BDATE`='$BDATE', 
        `PPCARE`='$PPCARE', 
        `PPPLACE`='$PPPLACE', 
        `PPRESULT`='$PPRESULT', 
        `PROVIDER`='$PROVIDER', 
        `D_UPDATE`='$D_UPDATE' 
        WHERE (`id`='$postnatal_id');";
        $save = $db->insert($sql);
    }

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('postnatal.php',$msg);
    exit;
}

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">POSTNATAL</h1> <span>ข้อมูลประวัติการดูแลมารดาหลังคลอด</span>
</div>
<fieldset>
    <legend>แฟ้ม : POSTNATAL</legend>
    <form action="postnatal.php" method="post">
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
$page = input('page');
if ( $page === 'search' ) {
    $hn = input_post('hn');

    $gettime = strtotime("-2 YEARS");
    $lastdate = (date('Y', $gettime)+543).date('-m-d', $gettime);

    $sql = "SELECT * FROM `opday` WHERE `hn` = '$hn' AND `thidate` >= '$lastdate' ORDER BY `row_id` DESC";
    $db->select($sql);
    $itemPop = $items = $db->get_items();

    $user = array_pop($itemPop);
    ?>
    <div>HN : <?=$user['ptname'];?></div>
    <table class="chk_table">
        <tr>
            <th>วันที่มารับบริการ</th>
            <th>Diag</th>
            <th>แพทย์</th>
            <th>มาเพื่อ</th>
            <th>จัดการข้อมูล</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['toborow'];?></td>
            <td><a href="postnatal.php?page=form&opday_id=<?=$item['row_id'];?>">บันทึก</a></td>
        </tr>
        <?php
    }
    ?>
    </table>
    
    <?php
}elseif ($page === 'form') {

    $opday_id = input_get('opday_id');
    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$opday_id' LIMIT 1";
    $db->select($sql);
    $user = $db->get_item();

    $doctorcode = false;
	if( preg_match('/MD\d+/', $user['doctor']) > 0 ){
		$prefixMd = substr($user['doctor'],0,5);

		$sql = "SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$prefixMd%' ";
		$db->select($sql);
		$dr = $db->get_item();
		$doctorcode = $dr['doctorcode'];

	}elseif ( preg_match('/(\d+){4,5}/', $user['doctor'], $matchs) ) {
		$doctorcode = $matchs['0'];

	}

	$dr = false;
	if( $doctorcode !== false ){
		$sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
		$db->select($sql);
		$dr = $db->get_item();
	}

    $date_bc = bc_to_ad($user['thidate']);
    $seq = genSEQ($date_bc, $user['hn']);

    $postnatal_id = input('postnatal_id');
    $postnatal_id = $PROVIDER = '';
    if(!empty($postnatal_id))
    {
        $db->select("SELECT * FROM `43postnatal` WHERE `id` = '$postnatal_id' ");
        $post = $db->get_item();
        $postnatal_id = $post['id'];
        $GRAVIDA = $post['GRAVIDA'];
        $BDATE = $post['BDATE'];
        $PPCARE = $post['PPCARE'];
        $PPRESULT = $post['PPRESULT'];
        $GRAVIDA = $post['GRAVIDA'];

        $dr['PROVIDER'] = $PROVIDER = $post['PROVIDER'];
        
    }
    
    ?>
    <fieldset>
        <legend>ฟอร์มบันทึก PRENATAL</legend>
        <form action="postnatal.php" method="post">
            <table>
                <tr>
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>ชื่อ-สกุล : </b><?=$user['ptname'];?> <b>วันที่มารับบริการ : </b><?=$user['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานบริการ : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ทะเบียนบุคคล : </td>
                    <td><input type="text" name="hn" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ลำดับที่ : </td>
                    <td><input type="text" name="seq" value="<?=$seq;?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ครรภ์ที่ : </td>
                    <td><input type="text" name="GRAVIDA" id="GRAVIDA" value="<?=$GRAVIDA;?>" >(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">วันคลอด/สิ้นสุดการตั้งครรภ์ : </td>
                    <td><input type="text" name="BDATE" id="BDATE" value="<?=$BDATE;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">วันที่ดูแลแม่ : </td>
                    <td><input type="text" name="PPCARE" id="PPCARE" value="<?=$PPCARE;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">รหัสสถานพยาบาลที่ดูแลแม่ : </td>
                    <td><input type="text" name="PPPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">ผลการตรวจมารดาหลังคลอด : </td>
                    <td>
                    
                        <?php 
                        $db->select("SELECT * FROM `f43_postnatal_186`");
                        $ppLists = $db->get_items();
                        $i = 1;
                        foreach ($ppLists as $key => $item) { 

                            $checked = ($PPRESULT==$item['code']) ? 'checked="checked"' : '' ;
                            ?>
                            <input type="radio" name="PPRESULT" id="pp<?=$i;?>" value="<?=$item['code'];?>" <?=$checked;?> ><label for="pp<?=$i;?>"><?=$item['detail'];?></label>
                            <?php
                            $i++;
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">เลขที่ผู้ให้บริการ : </td>
                    <td>
                        <?php 
                        if( empty($dr['PROVIDER']) && !empty($PROVIDER) ){ 
                            $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
                            $providerLists = $db->get_items();
                            ?>
                            <select name="PROVIDER" id="">
                                <option value="">กรุณาเลือกผู้ให้บริการ</option>
                                <?php 
                                foreach ($providerLists as $key => $pv) {
                                    
                                    $dr_no = '';
                                    if( $pv['REGISTERNO'] ){
                                        $dr_no = '('.$pv['REGISTERNO'].')';
                                    }
                                
                                ?>
                                <option value="<?=$pv['PROVIDER'];?>"><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="PROVIDER" value="<?=$dr['PROVIDER'];?>" readonly>
                            <?php
                        }
                        ?>
                        
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">เลขบัตรประชาชน : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">บันทึก</button>
                        <input type="hidden" name="action" value="save">
                        <input type="hidden" name="opday_id" value="<?=$user['row_id'];?>">
                        <input type="hidden" name="postnatal_id" value="<?=$postnatal_id;?>">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
    <script type="text/javascript">
        var popup1, popup2;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('BDATE'),false);
            popup2 = new Epoch('popup2','popup',document.getElementById('PPCARE'),false);
        };
    </script>
    <?php
}