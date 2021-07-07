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

    $msg = '�ѹ�֡���������º����';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }
    redirect('postnatal.php',$msg);
    exit;
}

include 'head.php';
?>
<div class="clearfix">
    <h1 style="margin:0;">POSTNATAL</h1> <span>�����Ż���ѵԡ�ô�����ô���ѧ��ʹ</span>
</div>
<fieldset>
    <legend>��� : POSTNATAL</legend>
    <form action="postnatal.php" method="post">
        <table>
            <tr>
                <td>���ҵ�� HN : </td>
                <td><input type="text" name="hn" id=""></td>
            </tr>
            <tr>
                <td colspan="2">
                    <button type="submit">����</button>
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
            <th>�ѹ������Ѻ��ԡ��</th>
            <th>Diag</th>
            <th>ᾷ��</th>
            <th>������</th>
            <th>�Ѵ��â�����</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['thidate'];?></td>
            <td><?=$item['diag'];?></td>
            <td><?=$item['doctor'];?></td>
            <td><?=$item['toborow'];?></td>
            <td><a href="postnatal.php?page=form&opday_id=<?=$item['row_id'];?>">�ѹ�֡</a></td>
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
        <legend>������ѹ�֡ PRENATAL</legend>
        <form action="postnatal.php" method="post">
            <table>
                <tr>
                    <td colspan="2"> 
                    <b>HN : </b><?=$user['hn'];?> <b>����-ʡ�� : </b><?=$user['ptname'];?> <b>�ѹ������Ѻ��ԡ�� : </b><?=$user['thidate'];?>
                    </td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��ԡ�� : </td>
                    <td><input type="text" name="HOSPCODE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">����¹�ؤ�� : </td>
                    <td><input type="text" name="hn" value="<?=$user['hn'];?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�ӴѺ��� : </td>
                    <td><input type="text" name="seq" value="<?=$seq;?>" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">������� : </td>
                    <td><input type="text" name="GRAVIDA" id="GRAVIDA" value="<?=$GRAVIDA;?>" >(������ 0 ��˹���� 1,2,10)</td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ��ʹ/����ش��õ�駤���� : </td>
                    <td><input type="text" name="BDATE" id="BDATE" value="<?=$BDATE;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">�ѹ��������� : </td>
                    <td><input type="text" name="PPCARE" id="PPCARE" value="<?=$PPCARE;?>"></td>
                </tr>
                <tr>
                    <td class="txtRight">����ʶҹ��Һ�ŷ�������� : </td>
                    <td><input type="text" name="PPPLACE" value="11512" readonly></td>
                </tr>
                <tr>
                    <td class="txtRight">�š�õ�Ǩ��ô���ѧ��ʹ : </td>
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
                    <td class="txtRight">�Ţ���������ԡ�� : </td>
                    <td>
                        <?php 
                        if( empty($dr['PROVIDER']) && !empty($PROVIDER) ){ 
                            $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
                            $providerLists = $db->get_items();
                            ?>
                            <select name="PROVIDER" id="">
                                <option value="">��س����͡�������ԡ��</option>
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
                    <td class="txtRight">�Ţ�ѵû�ЪҪ� : </td>
                    <td><input type="text" name="CID" value="<?=$user['idcard'];?>" readonly></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <button type="submit">�ѹ�֡</button>
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