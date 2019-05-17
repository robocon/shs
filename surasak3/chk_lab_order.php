<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

$def_month_en = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12' 
);

$def_month_th = array(
    '���Ҥ�' => '01',
    '����Ҿѹ��' => '02',
    '�չҤ�' => '03',
    '����¹' => '04',
    '����Ҥ�' => '05',
    '�Զع�¹' => '06',
    '�á�Ҥ�' => '07',
    '�ԧ�Ҥ�' => '08',
    '�ѹ��¹' => '09',
    '���Ҥ�' => '10',
    '��Ȩԡ�¹' => '11',
    '�ѹ�Ҥ�' => '12' 
);

/**
 * @dob String
 */
function set_date($dob){

    global $def_month_en, $def_month_th;

    $dob = trim($dob);

    // �ٻẺ �ѹ/��͹/��
    // �»� �ͧ�Ѻ �.�. �.�.
    $match = preg_match('/\d+\/\d+\/\d+/', $dob, $matchs);
    if ( $match > 0 ) {
        list($dd, $mm, $yy) = explode('/', $dob);

        if($yy > 2100){
            $yy = $yy - 543;
        }

        $dd = sprintf('%02d', $dd);
        $mm = sprintf('%02d', $mm);
        
        $dob = "$yy-$mm-$dd 00:00:00";
    }

    // �ٻẺ ��-��͹-�ѹ
    $match_ad = preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/', $dob, $matchs);
    if ( $match_ad > 0 ) {
        list($yy, $mm, $dd) = explode('-', $dob);
        $dd = sprintf('%02d', $dd);
        $mm = sprintf('%02d', $mm);
        
        $dob = "$yy-$mm-$dd 00:00:00";
    }

    // �ٻẺ �ѹ ��͹(�ѧ���/��) ��(�.�.)
    $match_mix = preg_match('/\d{1,2}\s(.+)\s\d{4}/', $dob, $matchs);
    if ( $match_mix > 0 ) {

        list($dd, $mm_txt, $yy) = explode(' ', $dob);
        $dd = sprintf('%02d', $dd);
        $yy = ( $yy - 543 );

        if( !empty($def_month_en[$mm_txt]) ){
            $mm = $def_month_en[$mm_txt];
        }elseif ( !empty($def_month_th[$mm_txt]) ) {
            $mm = $def_month_th[$mm_txt];
        }
        
        $dob = "$yy-$mm-$dd 00:00:00";

    }

    return $dob;
}

/*
DROP TABLE IF EXISTS `chk_lab_items`;
CREATE TABLE `chk_lab_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `labnumber` varchar(255) DEFAULT NULL,
  `item_sso` varchar(255) DEFAULT NULL,
  `item_cash` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

if( $action == false ){
    include 'chk_menu.php';
    ?>

    <h3>����Ң����� Order Lab</h3>
    <form action="chk_lab_order.php" method="post" enctype="multipart/form-data">
        <div>
            ������� : <input type="file" name="file">
        </div>
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
            </select> <span>&lt;&lt;&lt;&nbsp;����������͡����ѷ��͹����Ң�����</span>
        </div>
        <div>
            <span style="color: red; font-size: 14px;">
            <b><u>���й� ��Т�ͤ�����ѧ</u></b><br>
            - �繡�ù����੾�С�õ�Ǩ�آ�Ҿ��Шӻ���ҹ��<br>
            - ��سҵ�Ǩ�ͺ�����š�͹�����<br>
            - �к��ͧ�Ѻ੾����� .csv<br>
            </span>
        </div>
        <div>
            <button type="submit">�����</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>�ٻẺ�����š�͹���������к�</b></p>
            <table class="chk_table">
                <tr>
                    <th>Lab Number</th>
                    <th>HN</th>
                    <th>����</th>
                    <th>ʡ��</th>
                    <th>��</th>
                    <th>�ѹ�Դ</th>
                    <th>��¡�õ�Ǩ ��Сѹ�ѧ��</th>
                </tr>
                <tr>
                    <td>
                        �ٻẺ ��(�ͧ��ѡ)��͹�ѹ ����������� lab �� 610524301 �·�� <br>
                        61 ��ͻ� <br>
                        05 �����͹ <br>
                        24 ����ѹ <br>
                        301 �������lab���§�����
                    </td>
                    <td>���ʼ������Ѻ��ԡ��</td>
                    <td>�ٻẺ �ӹ�˹�Ҫ��ͪ��� ʡ�� �� ��¤� �ح��</td>
                    <td></td>
                    <td>M : �����, F : ���˭ԧ</td>
                    <td>
                    ����ö��ҹ�� 2�ٻẺ ���<br> 
                    1. ��-��͹-�ѹ Ẻ �.�. �� 1985-12-25<br> 
                    2. �ѹ/��͹/�� Ẻ �.�. �� 25/12/2550<br> 
                    </td>
                    <td>������¡�õ�Ǩ��蹴��� Comma(,) �� CBC,UA,BUN �繵� �ͧ�Ѻ�����ҹ @ �� @stool</td>
                </tr>
            </table>
            <br>
            
        </div>
    </form>
    <div>
        <div>
            <p><b>������ҧ��èѴ������</b></p>
        </div>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
    <div>
        <div>
            <p><b>������ҧ��õ�駤����� Excel ��͹���й���Ң�����</b></p>
        </div>
        <iframe src="images/excel-pre-import.pdf" frameborder="0" width="800" height="600"></iframe>
    </div>
    <?php

} else if ( $action === 'import' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $part = input_post('part');
    
    // ��������Ѻ�Ţ bs
    $sql = "SELECT `exam_no` FROM `opcardchk` WHERE `part` = '$part' ORDER BY `row` DESC LIMIT 1";
    $db->select($sql);
    $test_chk = $db->get_item();

    // �Ѵ�Ţ 6����á����� yymmdd
    $first_lab_number = substr($test_chk['exam_no'],0,6);
    $pre_bs_number = substr($test_chk['exam_no'],6);
    $bs_number = (int) $pre_bs_number;

    // �Ѻ digi ����������� sprintf ����ѧ ���кҧ����ѷ����ѡ����������ѡ�ѹ�����ҡѹ
    $number_digi = strlen($pre_bs_number);
    

    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = '�ѹ�֡�������������º����';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $name, $surname, $sex, $dob, $lab_sso) = explode(',', $item,7);

                $dob = set_date($dob);
                $clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�$year";

                $year = get_year_checkup();
                $ptname = $name.' '.$surname;
                $lab_sso = strtolower(str_replace(array('"',' '), '', $lab_sso));
                $lab_sso_items = explode(',', $lab_sso);
                $find_bs = false;

                $test_bs = preg_match('/\,bs\,/', $lab_sso);
                if( $test_bs > 0 ){

                    $find_bs = true;
                    $lab_sso = str_replace(',bs,',',', $lab_sso);

                    ++$bs_number;

                    $lab_bs_number = $first_lab_number.sprintf('%0'.$number_digi.'d', $bs_number);

                }


                // ������¡��������������͹��§ҹ����Թ
                $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                    `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `part`
                ) VALUES (
                    NULL, '$hn', '$ptname', '$labnumber', '$lab_sso', '$part'
                );";
                $insert = $db->insert($sql_chk_lab_items);
                if( $insert !== true ){
                    $msg = errorMsg(NULL, $insert['id']);
                }

                if( $find_bs === true ){

                    
                    $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                        `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `part`
                    ) VALUES (
                        NULL, '$hn', '$ptname', '$lab_bs_number', 'bs', '$part'
                    );";
                    $insert = $db->insert($sql_chk_lab_items);
                    if( $insert !== true ){
                        $msg = errorMsg(NULL, $insert['id']);
                    }

                }
                // ������¡��������������͹��§ҹ����Թ

                
                ////////////////////////
                // ORDER HEAD
                ////////////////////////
                $orderhead_sql = "INSERT INTO `orderhead` ( 
                    `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                    `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                    `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
                ) VALUES ( 
                    '', NOW(), '$labnumber', '$hn', 'OPD', 
                    '$ptname', '$sex', '$dob', '', '', 
                    '','', 'MD022 (����Һᾷ��)', 'R', '$clinicalinfo'
                );";
                $insert = $db->insert($orderhead_sql);
                if( $insert !== true ){
                    $msg = errorMsg(NULL, $insert['id']);
                }

                if( $find_bs === true ){
                    $orderhead_sql = "INSERT INTO `orderhead` ( 
                        `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                        `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                        `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
                    ) VALUES ( 
                        '', NOW(), '$lab_bs_number', '$hn', 'OPD', 
                        '$ptname', '$sex', '$dob', '', '', 
                        '','', 'MD022 (����Һᾷ��)', 'R', '$clinicalinfo'
                    );";
                    $insert = $db->insert($orderhead_sql);
                    if( $insert !== true ){
                        $msg = errorMsg(NULL, $insert['id']);
                    }
                }
                ////////////////////////
                // ORDER HEAD
                ////////////////////////


                ////////////////////////
                // ORDER DETAIL
                ////////////////////////
                foreach( $lab_sso_items as $lab_key => $lab_item ){
                    
                    $find_suit = strstr($lab_item,'@');
                    if( $find_suit != false ){

                        // ������¡�û��������������� labsuit
                        $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '$lab_item'";
                        $db->select($sql_at);
                        $suit_list = $db->get_items();

                        if( count($suit_list) > 0 ){

                            foreach ($suit_list as $key => $suit_item) {
                                
                                $suit_code = $suit_item['code'];
                                $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                                FROM `labcare` 
                                WHERE `code` = '$suit_code' 
                                LIMIT 1 ";
                                $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                                $test_row = mysql_num_rows($q);
                                if ( $test_row > 0 ) {
                                    
                                    list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                                
                                    $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                                        `labnumber` , `labcode`, `labcode1` , `labname` 
                                    ) VALUES ( 
                                        '$labnumber', '$code', '$oldcode', '$detail'
                                    );";
                                    $insert_detail = $db->insert($orderdetail_sql);

                                    if( $insert_detail !== true ){
                                        $msg .= errorMsg(NULL, $insert_detail['id']);
                                    }

                                }
                                
                            }

                        }

                    }else{

                        // �ó���¡�� lab ����
                        $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                        FROM `labcare` 
                        WHERE `code` = '$lab_item' 
                        LIMIT 1 ";
                        $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                        $num = mysql_num_rows($q);
                        if( $num > 0 ){
                            list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                        
                            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                                `labnumber` , `labcode`, `labcode1` , `labname` 
                            ) VALUES ( 
                                '$labnumber', '$code', '$oldcode', '$detail'
                            );";
                            $insert = $db->insert($orderdetail_sql);
                            if( $insert !== true ){
                                $msg .= errorMsg(NULL, $insert['id']);
                            }

                        }

                    }
                    
                }

                if( $find_bs === true ){

                    $sql_detail = "SELECT `code`,`oldcode`,`detail` FROM `labcare` WHERE `code` = 'bs' LIMIT 1 ";
                    $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                    $num = mysql_num_rows($q);
                    if( $num > 0 ){
                        list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                    
                        $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                            `labnumber` , `labcode`, `labcode1` , `labname` 
                        ) VALUES ( 
                            '$lab_bs_number', '$code', '$oldcode', '$detail'
                        );";
                        $insert = $db->insert($orderdetail_sql);
                        if( $insert !== true ){
                            $msg .= errorMsg(NULL, $insert['id']);
                        }

                    }
                    
                }
                ////////////////////////
                // ORDER DETAIL
                ////////////////////////
                

            } // End ���������� not empty 

            $i++;

        } // End excel �������

    }else{
        $msg = '��س������������١��ͧ';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}