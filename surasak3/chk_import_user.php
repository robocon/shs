<?php

include 'bootstrap.php';
$action = input('action');
$db = Mysql::load();

if( empty($action) ){
    include_once 'chk_menu.php';

    ?>
    <h3>�������ª��ͼ���Ǩ�آ�Ҿ�������к��ç��Һ��</h3>
    <div>
        
        <div class="clearfix" style="height: 105px;">
            <div class="chk_menu clearfix">
                <ul>
                    <li>
                        <a href="chk_test_hn.php" target="_blank">��Ǩ�ͺ��ª��ͨҡ HN</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <form action="chk_import_user.php" method="post" enctype="multipart/form-data">
        <div>
            <?php
            $sql = "SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC";
            $db->select($sql);
            $items = $db->get_items();
            ?>
            ���͡����ѷ : 
            <select name="part" id="">
                <option value="">-- ��ª��ͺ���ѷ --</option>
                <?php
                foreach ($items as $key => $item) {
                    ?><option value="<?=$item['code'];?>"><?=$item['name'].' ('.$item['code'].')';?></option><?php
                }
                ?>
            </select>
        </div>
        <div>
            ������� : <input type="file" name="file">
            <div>
                <span style="color: red; font-size: 14px;">
                <b><u>���й� ��Т�ͤ�����ѧ</u></b><br>
                - ��سҵ�Ǩ�ͺ�����š�͹�����<br>
                - �к��ͧ�Ѻ੾����� .csv<br>
                - �к��ͧ�Ѻ����������ª��ͼ���������
                </span>
            </div>
        </div>
        <div>
            <button type="submit">�����</button>
            <input type="hidden" name="action" value="import">
        </div>
    </form>
    <div>
        <p><b>�ٻẺ�����š�͹���������к�</b></p>
        <table class="chk_table">
            <tr>
                <td>�ӴѺ</td>
                <td>Lab Number</td>
                <td>HN</td>
                <td>�Ţ�ѵû�ЪҪ�</td>
                <td>����</td>
                <td>ʡ��</td>
                <td>����</td>
                <td>�ѹ�Դ</td>
                <td>���������Ǩ �� �����1 �����2</td>
                <td>�ѹ����Ǩ��ԧ</td>
                <td>Ἱ�</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <b><u>�ѹ�Դ</u></b> �ͧ�Ѻ��÷ӧҹ�� 2�ٻẺ ���<br>
        1.) �ٻẺ�ѧ���(DD/MM/YYYY) �·�� DD ����ѹ��� MM �����͹ YYYY ��ͻդ.�. ������ҧ�� <u>01/02/1985</u><br>
        2.) �ٻẺ��(�ѹ��� ��͹ ��) ������ҧ�� <u>18 ���Ҥ� 2561</u><br>
    </div>
    <br>
    <div>
        <div>
            <div><b>������ҧ��èѴ������</b></div>
            <img src="images/sso-import-user.png" alt="">
        </div>
    </div>
    <?php
} else if ( $action === 'import' ) {
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $part = input_post('part');
    $msg = '��辺�����Ź���� ����������͡���ͺ���ѷ';

	if( $content !== false && $part !== false ){
	
        $items = explode("\r\n", $content);

        $sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
		$db->select($sql);
		$chk = $db->get_item();
		$last_id = (int) $chk['lastrow'];

        $i = 0;
        $idcard = $exam_no = $date_birth = '';
        
        foreach ($items as $key => $item) {
            
            ++$i;
            ++$last_id;

            list($pid, $exam_no, $hn, $idcard, $fname, $lname, $age, $date_birth, $course, $date_chkup, $branch ) = explode(',', $item);


            if( !empty($pid) ){ 

                $date_birth = trim($date_birth);

                // �ٻẺ dd/mm/yyyy 
                $match = preg_match('/\d+\/\d+\/\d+/', $date_birth, $matchs);
                if ( $match > 0 ) {
                    list($dd, $mm, $yy) = explode('/', $date_birth);

                    if($yy > 2100){
                        $yy = $yy - 543;
                    }

                    $dd = sprintf('%02d', $dd);
                    $mm = sprintf('%02d', $mm);
                    
                    $date_birth = "$yy-$mm-$dd 00:00:00";
                }
                
                // ����¹�ٻẺ �.�. �� �.�. �� 18 ���Ҥ� 2561 �� 2018-01-11 
                $match_thdate = preg_match('/(\d+)\s([�-�].+)\s(\d+)/', $date_birth, $matchs);
                if ( $match_thdate > 0 ) {

                    $dd = $matchs['1'];
                    $mm = $matchs['2'];
                    $yy = $matchs['3'];

                    if($yy > 2100){
                        $yy = $yy - 543;
                    }

                    $month_number = array_keys($def_fullm_th, $mm);
                    $date_birth = $yy."-".$month_number['0']."-$dd 00:00:00";
                    
                }

                if( !empty($idcard) ){
                    $idcard = str_replace(array('-', ' '), '', $idcard);
                }

                if( empty($idcard) ){
                    $sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ";
                    $db->select($sql);
                    $item = $db->get_item();
                    $idcard = $item['idcard'];
                }


                // $fullname = preg_replace('/\s+/', ' ', $fullname);
                // list($name, $surname) = explode(' ',$fullname);
                $name = trim($fname);
                $surname = trim($lname);
    
                $sql = "INSERT INTO `opcardchk`
                (`HN`,
                `row`,
                `exam_no`,
                `pid`,
                `idcard`,
                `name`,
                `surname`,
                `dbirth`,
                `agey`,
                `part`,
                `branch`,
                `course`,
                `datechkup`,
                `active`)
                VALUES (
                '$hn',
                '$last_id',
                '$exam_no',
                '$pid',
                '$idcard',
                '$name',
                '$surname',
                '$date_birth',
                '$age',
                '$part',
                '$branch',
                '$course',
                '$date_chkup',
                'y');";

                $insert = $db->insert($sql);

            }
            
        }

        $msg = '����Ң��������º����';
    }

    redirect('chk_import_user.php', $msg);
    exit;
}
?>
