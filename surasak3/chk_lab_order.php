<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

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
                    <td>Lab Number</td>
                    <td>HN</td>
                    <td>����</td>
                    <td>ʡ��</td>
                    <td>��</td>
                    <td>�ѹ�Դ <span style="color: red;">�ͧ�Ѻ��û�͹������ DD/MM/YYYY Ẻ�վ.�.</span></td>
                    <td>��¡�õ�Ǩ ��Сѹ�ѧ��</td>
                    <td>��¡�õ�Ǩ �Թʴ</td>
                </tr>
            </table>
            <br>
            <div>
                <table class="chk_table" style="font-size: 13px;">
                    <tr>
                        <th colspan="2" align="center">��͸Ժ��</th>
                    </tr>
                    <tr>
                        <td>Labnumber</td>
                        <td>�ٻẺ ��(�ͧ��ѡ)��͹�ѹ ����������� lab �� 610524301 �·�� <br>61 ��ͻ� <br>05 �����͹ <br>24 ����ѹ <br>301 �������lab���§�����</td>
                    </tr>
                    <tr>
                        <td>HN</td>
                        <td>���ʼ������Ѻ��ԡ��</td>
                    </tr>
                    <tr>
                        <td>����-ʡ��</td>
                        <td>�ٻẺ �ӹ�˹�Ҫ��ͪ��� ʡ�� �� ��¤� �ح��</td>
                    </tr>
                    <tr>
                        <td>��</td>
                        <td>M : �����, F : ���˭ԧ</td>
                    </tr>
                    <tr>
                        <td>�ѹ�Դ</td>
                        <td>���ٻẺ ��-��͹-�ѹ ��  1985-12-25 �繵�</td>
                    </tr>
                    <tr>
                        <td>��¡�õ�Ǩ</td>
                        <td>������¡�õ�Ǩ��蹴��� Comma(,) �� CBC,UA,BUN �繵� �ͧ�Ѻ�����ҹ @ �� @stool</td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <div>
        <div><b>������ҧ��èѴ������</b></div>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
    <?php

} else if ( $action === 'import' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    
    // @todo
    // - check condition

    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = '�ѹ�֡�������������º����';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $name, $surname, $sex, $dob, $lab_sso, $lab_cash) = explode(',', $item,7);

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
                $year = get_year_checkup();
                $ptname = $name.' '.$surname;
                $clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�$year";

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
                    $msg = errorMsg('delete', $insert['id']);
                }

                $lab_sso = str_replace('"', '', $lab_sso);
                $lab_sso_items = explode(',', $lab_sso);

                $lab_cash = str_replace('"', '', $lab_cash);
                $lab_cash_items = explode(',', $lab_cash);

                // ������¡��������������͹��§ҹ����Թ
                $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                    `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `item_cash`, `part`
                ) VALUES (
                    NULL, '$hn', '$ptname', '$labnumber', '$lab_sso', '$lab_cash', ''
                );";
                $db->insert($sql_chk_lab_items);
                
                ////////////////////////
                // ��¡�õ�Ǩ ���
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
                                        $msg .= errorMsg('delete', $insert_detail['id']);
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
                                $msg .= errorMsg('delete', $insert['id']);
                            }

                        }

                    }
                    
                }

                ////////////////////////
                // ��¡�õ�Ǩ �Թʴ
                ////////////////////////
                foreach( $lab_cash_items as $lab_key => $lab_item ){
                    
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
                                        $msg .= errorMsg('delete', $insert_detail['id']);
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
                                $msg .= errorMsg('delete', $insert['id']);
                            }

                        }

                    }
                    
                }

            } 

            $i++;
        }

    }else{
        $msg = '��س������������١��ͧ';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}


