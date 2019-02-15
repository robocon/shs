<?php 

include 'bootstrap.php';

//$shs_configs
$db = Mysql::load();
// $hn = input_post('hn');

// $db->select("SET NAMES UTF8");


$action = input_post('action');
if( $action == 'save' ){

    $disabid = input_post('disabid');
    $id = input_post('id');

    $icf = input_post('icf');
    $disabtype = input_post('disabtype');
    $disabcause = input_post('disabcause');
    $diagcode = input_post('test_icd');
    $d_update = date('Ymdhis');

    $sql = "SELECT *,
    thDateToEn(SUBSTRING(`thidate`, 1, 10)) AS `date_serv`
    FROM `opday` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $test_opday = $db->get_rows();
    if ( $test_opday > 0 ) {

        $opday_id = $item['row_id'];
        $pid = $item['hn'];
        $cid = trim($item['idcard']);
        $date_serv = $item['date_serv'];
        $seq = $item['date_serv'].sprintf("%03d", $item['vn']);

        if( preg_match('/^(MD\d+)/', $item['doctor'], $matchs) > 0 ){ 

            $pre_doc = $matchs['1'];
            $q2 = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$pre_doc%'") or die( mysql_error() );
            if ( mysql_num_rows($q2) > 0 ) {
                $dt = mysql_fetch_assoc($q2);
                $code = sprintf("%05d", $dt['doctorcode']);
            }else{

                $code = '00000';
            }

        }else{

            $test_match = preg_match('/(\d+){4,5}/', $item['doctor'], $match);
            if( $test_match > 0 ){
                $code = $match['1'];
            }

        }

        $provider = $seq.$code;
        
        $sql = "SELECT `id` FROM `icf43` WHERE `opday_id` = '$opday_id' ";
        $db->select($sql);
        $test_icf = $db->get_rows();
        if ( $test_icf > 0 ) {

            $icf_item = $db->get_item();
            $icf_id = $icf_item['id'];

            $sql = "UPDATE `icf43` SET 
            `disabid`='$disabid', 
            `pid`='$pid', 
            `seq`='$seq', 
            `date_serv`='$date_serv', 
            `icf`='$icf', 
            `provider`='$provider', 
            `d_update`='$d_update', 
            `cid`='$cid' 
            WHERE (`id`='$icf_id');";
            $db->update($sql);

        }else{
            $sql = "INSERT INTO `icf43` (
                `id`, `hospcode`, `disabid`, `pid`, `seq`, `date_serv`, 
                `icf`, `qualifier`, `provider`, `d_update`, `cid`, `opday_id`
            ) VALUES (
                NULL, '11512', '$disabid', '$pid', '$seq', '$date_serv', 
                '$icf', NULL, '$provider', '$d_update', '$cid', '$opday_id'
            );";
            $db->insert($sql);
        }

        
        $sql = "SELECT `id` FROM `disability43` WHERE `opday_id` = '$opday_id' ";
        $db->select($sql);
        $test_dis = $db->get_rows();
        if ( $test_dis > 0 ) {

            $dis_item = $db->get_item();
            $dis_id = $dis_item['id'];

            // update
            $sql = "UPDATE `disability43` SET 
            `disabid`='$disabid', 
            `pid`='$pid', 
            `disabtype`='$disabtype', 
            `disabcause`='$disabcause', 
            `diagcode`='$diagcode', 
            `d_update`='$d_update', 
            `cid`=' $cid' 
            WHERE (`id`='$dis_id');";
            $db->update($sql);

        }else {
            // 
            $sql = "INSERT INTO `disability43` (
                `id`, `hospcode`, `disabid`, `pid`, `disabtype`, `disabcause`, 
                `diagcode`, `date_detect`, `date_disab`, `d_update`, `cid`, `opday_id`
            ) VALUES (
                NULL, '11512', '$disabid', '$pid', '$disabtype', '$disabcause', 
                '$diagcode', '$date_serv', '$date_serv', '$d_update', '$cid', '$opday_id'
            );";
            $db->insert($sql);
        }
        

    }

    redirect('icf_form.php','�ѹ�֡���������º����');
    exit;

}

?>
<style>
	*{
		font-family: 'TH Sarabun New','TH SarabunPSK';
		font-size: 18px;
	}
	input[readonly]{
		background-color: #d8d8d8;
	}
    input[type='radio'],
    label.radio{
        cursor: pointer;
    }

    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
        font-size: 16pt;
    }

    .icf_code{
        color: blue;
    }
    .icf_code:hover{
        text-decoration: underline;
        cursor: pointer;
    }
    .close-icf:hover{
        cursor: pointer;
    }
</style>

<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;�����</a>
</div>

<div>
    <div>�ѹ�֡������ ICF & DISABILITY</div>
</div>

<?php 

if($_SESSION['x-msg']){
    ?>
    <div style="border: 1px solid #abab00; background-color: #ffffce; padding: 4px;"><?=$_SESSION['x-msg'];?></div>
    <?php
    $_SESSION['x-msg'] = NULL;
}

?>

<div>
    <fieldset>
        <legend>���Ҩҡ HN</legend>
        <form action="icf_form.php" method="post">
            <div>
                <input type="text" name="hn" id="" value="<?=$hn;?>">
            </div>
            <div>
                <button type="submit">����</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </fieldset>
</div>

<?php 

$page = input('page');

if ( $page == 'search' ) {
    
    $hn = input_post('hn');
    $sql = "SELECT `row_id`,`thidate`,`hn`,`ptname`,`vn`,`toborow`,`icd10` FROM `opday` WHERE `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 100";
    $db->select($sql);
    $items = $db->get_items();

    ?>
    <div>
        <p>�ѹ��������ԡ��</p>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>�ѹ���</th>
                <th>HN</th>
                <th>����ʡ��</th>
                <th>VN</th>
                <th>�͡OPD Card</th>
                <th>ICD10</th>
            </tr>
            <?php 
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><a href="icf_form.php?page=form&id=<?=$item['row_id'];?>"><?=$item['thidate'];?></a></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['vn'];?></td>
                    <td><?=$item['toborow'];?></td>
                    <td><?=$item['icd10'];?></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php

}elseif ( $page == 'form' ) {
    
    $id = input_get('id');

    $sql = "SELECT * FROM `opday` WHERE `row_id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $opday_id = $item['row_id'];

    $sql = "SELECT * FROM `icf43` WHERE `opday_id` = '$opday_id' ";
    $db->select($sql);
    $icf = $db->get_item();

    $sql = "SELECT * FROM `disability43` WHERE `opday_id` = '$opday_id' ";
    $db->select($sql);
    $dis = $db->get_item();

    $disabtype = $dis['disabtype'];
    $disabcause = $dis['disabcause'];

    $disabtype_list = array(
        1 => '�����ԡ�÷ҧ������',
        2 => '�����ԡ�÷ҧ������Թ���͡�����ͤ�������',
        3 => '�����ԡ�á������͹������ͷҧ��ҧ���',
        4 => '�����ԡ�÷ҧ�Ե����;ĵԡ��������ͷ�ʵԡ',
        5 => '�����ԡ�÷ҧʵԻѭ��',
        6 => '�����ԡ�÷ҧ������¹���',
        7 => '�����ԡ�÷ҧ�ͷ�ʵԡ'
    );

    $disabcause_list = array(
        1 => '�����ԡ������Դ',
        2 => '�����ԡ�èҡ��úҴ��',
        3 => '�����ԡ�èҡ�ä'
    );
    ?>
    <form action="icf_form.php" method="post" id="userForm">
    <div>
        <fieldset>
            <legend>������ѹ�֡������</legend>

            <fieldset>
                <legend>���������ͧ��</legend>
                <div>
                    <b>HN:</b> <?=$item['hn'];?> <b>VN:</b> <?=$item['vn'];?> <b>����-ʡ��:</b> <?=$item['ptname'];?> <b>�Ţ���ѵû��:</b> <?=$item['idcard'];?>
                    <b>��Ǩ�ѹ���:</b> <?=$item['thidate'];?>
                </div>
                <div>
                    �Ţ����¹���ԡ��(DISABID): <input type="text" name="disabid" id="disabid" value="<?=$icf['disabid'];?>">
                </div>
            </fieldset>

            <fieldset>
                <legend>ICF</legend>
                <div>
                    ����������آ�Ҿ(ICF): <input type="text" name="icf" id="icf" value="<?=$icf['icf'];?>">
                </div>
                <div id="icf_res" style="position:relative;"></div>
            </fieldset>

            <fieldset>
                <legend>Disability</legend>
                <div>
                    �����������ԡ��(DISABTYPE): <select name="disabtype" id="">
                    <?php
                    foreach ($disabtype_list as $key => $dis) {

                        $selected = ( $key == $disabtype ) ? 'selected="selected"' : '';

                        ?>
                        <option value="<?=$key;?>" <?=$selected;?> ><?=$key.'.'.$dis;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div>
                    ���˵ؤ����ԡ��(DISABCAUSE): <select name="disabcause" id="">
                    <?php
                    foreach ($disabcause_list as $key => $dis) {

                        $selected = ( $key == $disabcause ) ? 'selected="selected"' : '';

                        ?>
                        <option value="<?=$key;?>" <?=$selected;?> ><?=$key.'.'.$dis;?></option>
                        <?php
                    }
                    ?>
                    </select>
                </div>
                <div>
                    �����ä���͡�úҴ�纷�������˵آͧ�����ԡ��: 
                    <?php 
                    if( empty($item['icd10']) ){
                        echo '<span style="background-color: red;">����ա��ŧ������</span>';
                    }else{
                        echo $item['icd10'];
                    }
                    ?>
                </div>
            </fieldset>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?=$item['row_id'];?>">
                <input type="hidden" name="test_icd" id="test_icd" value="<?=$item['icd10'];?>">
            </div>
        </fieldset>
    </div>
    </form>
    <script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {

            var icf_list = [];

            <?php 
            $sql = "SELECT * FROM `icf_icf`";
            $db->select($sql);
            $icf_list = $db->get_items();
            $i = 0; 

            foreach( $icf_list as $key => $item ){

                ?>
                var myObj = new Object();
                myObj.code = '<?=$item['id'];?>';
                myObj.detail = '<?=$item['detail'];?>';
                icf_list[<?=$i;?>] = myObj; 
                <?php
                $i++;
            }
            ?>

            $(document).on('keypress', '#icf', function(){
                var search_txt = $(this).val();

                if( search_txt.length > 3 ){

                    var regex1 = new RegExp(search_txt,'g');

                    var htm = '';
                    htm += '<div class="close-icf" style="text-align: center; background-color: #ffb3b3;"><b>[�Դ]</b></div>';
                    htm += '<div style="position: absolute; background-color: #ffffff; border: 1px solid #000000; width: 100%;">';
                    htm += '<table class="chk_table" style="width: 100%;">';
                    htm += '<tr>';
                    htm += '<th>����</th>';
                    htm += '<th>��������´</th>';
                    htm += '</tr>';

                    for (let index = 0; index < icf_list.length; index++) {

                        var icf_item = icf_list[index];
                        const element = icf_item.detail;
                        const icf_code = icf_item.code;

                        if( regex1.test(element) == true ){
                            htm += '<tr>';
                            htm += '<td class="icf_code" item-data="'+icf_code+'">'+icf_code+'</td>';
                            htm += '<td>'+element+'</td>';
                            htm += '</tr>';
                        }
                    }

                    htm += '</table>';
                    htm += '</div>';

                    $("#icf_res").html(htm);

                }

            });

            
            $(document).on('click', '.close-icf', function(){ 
                $('#icf_res').hide();
            });

            $(document).on('click', '.icf_code', function(){
                var code = $(this).attr('item-data');
                $('#icf').val(code);
                $('#icf_res').hide();
            });

            $(document).on('submit', '#userForm', function(){

                if( $('#test_icd').val() == '' ){

                    var c = confirm("�ѧ����ա��ŧ������ ICD10 �Ҩ���������� 43��� ���ú��ǹ\n�׹�ѹ���кѹ�֡�������������");
                    if( c==false ){
                        return false;
                    }

                }

            });
            
        });
        })(jQuery);
    </script>
    <?php

}