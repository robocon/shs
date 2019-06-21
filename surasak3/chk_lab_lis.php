<?php 

include 'bootstrap.php';

$db = Mysql::load();

$action = input('action');
if ($action == 'insert') {
    
    $part = input_get('part');

    $db->select("SELECT SUBSTRING(`yearchk`,3,2) AS `yearchk` FROM `chk_company_list` WHERE `code` = '$part'");
    $company = $db->get_item();
    $year = $company['yearchk'];

    $sql = "SELECT * 
    FROM `chk_lab_items` 
    WHERE `part` = '$part' 
    AND `status` = 'N' 
    ORDER BY `id` ASC ";
    $db->select($sql);
    
    if( $db->get_rows() > 0 ){
        $items = $db->get_items();
        $msg = "�ѹ�֡���������º����";
        foreach ($items as $key => $item) {

            $id = $item['id'];

            $hn = $item['hn'];
            $ptname = $item['ptname'];
            $labnumber = $item['labnumber'];
            $dob = $item['dob'];
            $sex = $item['sex'];

            if( $item['item_sso'] == 'bs' ){
                $lab_sso_items = array($item['item_sso']);
            }else{
                $lab_sso_items = explode(',',  $item['item_sso']);
            }

            $clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�$year";

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
            ////////////////////////
            // ORDER DETAIL
            ////////////////////////
            
            $sql = "UPDATE `chk_lab_items` SET `status` = 'Y' WHERE `id` = '$id'";
            $db->update($sql);
            
        }// end for
    }
    redirect('chk_lab_lis.php', $msg);
    exit;
}elseif ($action == 'showlab') {
    
    $code = input_get('part');

    $sql = "SELECT `name` FROM `chk_company_list` WHERE `code` = '$part' ";
    $db->select($sql);
    $company = $db->get_item();

    $sql = "SELECT * FROM `chk_lab_items` WHERE `part` = '$part' ORDER BY `id` ASC ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <div>
        <div>
            <h3>��¡�� Lab ���е�Ǩ <?=$company['name'];?></h3>
        </div>
        <div>
            <table class="chk_table">
                <tr>
                    <th>HN</th>
                    <th>����-ʡ��</th>
                    <th>Lab Nubmer</th>
                    <th>��¡�õ�Ǩ</th>
                </tr>
                <?php 
                foreach ($items as $key => $item) {
                    ?>
                    <tr>
                        <td><?=$item['hn'];?></td>
                        <td><?=$item['ptname'];?></td>
                        <td><?=$item['labnumber'];?></td>
                        <td><?=$item['item_sso'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
    <?php

}
?>

<!DOCTYPE html>
<html>
<head></head>
<body>
<?php

include 'chk_menu.php';

?>
<div>
    <h3>��� Lab �������ͧ LIS</h3>
</div>
<fieldset>
    <legend>���ҵ���է�����ҳ</legend>
    <form action="chk_lab_lis.php" method="post">
        <div> ���͡�� : 
            <?php 
            $year_selected = input_post('year_selected', date('Y') );
            $year_range = range('2018',get_year_checkup(true, true));
            getYearList('year_selected', true, $year_selected, $year_range);
            ?>
        </div>
        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="views" value="search">
        </div>
    </form>
</fieldset>
<?php 

$view = input('views');
if( $view == 'search' ){

    $year_selected = input_post('year_selected');
    $year_selected += 543;

    $sql = "SELECT * FROM `chk_company_list` 
    WHERE `yearchk` = '$year_selected' AND `status` = '1' 
    ORDER BY `id` DESC";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <h3>�� <?=$year_selected;?></h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>���ͺ���ѷ</th>
                <th>ʶҹ�</th>
                <th>�觢�������� LIS</th>
                <th>��Ǩ������</th>
            </tr>
        <?php
        $i = 0;
        foreach ($items as $key => $item) {
            ++$i;

            $code = $item['code'];

            // N ����ѧ�����մ��� LIS
            // Y ��ʹմ��� LIS ���º��������
            $sql = "SELECT COUNT(a.`hn`) AS `rows` 
            FROM ( 
                SELECT `hn`,`part` FROM `chk_lab_items` WHERE `part` = '$code'  AND `status` = 'N' GROUP BY `hn` 
            ) AS a";
            $db->select($sql);
            $test_rows = $db->get_item();
            $rows_n = (int) $test_rows['rows'];

            $sql = "SELECT COUNT(a.`hn`) AS `rows` 
            FROM ( 
                SELECT `hn`,`part` FROM `chk_lab_items` WHERE `part` = '$code'  AND `status` = 'Y' GROUP BY `hn` 
            ) AS a";
            $db->select($sql);
            $test_rows = $db->get_item();
            $rows_y = (int) $test_rows['rows'];

            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['name'];?></td>
                <td align="center">
                    <?php 
                    $show_link = true;
                    if( $rows_n > 0 ){ 
                        echo "�ͺѹ�֡��� LIS";
                    }elseif ($rows_y > 0) {
                        echo "�ѹ�֡��������� LIS ���º����";
                    }else{
                        $show_link = false;
                        echo "����բ�����";
                    }
                    ?>
                </td>
                <td align="center">
                    <?php 
                    if ( $show_link == true ) { 
                        // 
                        ?>
                        <a href="chk_lab_lis.php?part=<?=$code;?>&action=insert" onclick="return chk_confirm()">�ѹ�֡������</a>
                        <?php
                    } 
                    ?>
                </td>
                <td>
                    <?php 
                    if ( $show_link == true ) {
                        ?>
                        <a href="chk_lab_lis.php?action=showlab&part=<?=$code;?>" target="_blank">��Ǩ�ͺ������</a>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
        }
        ?>
        </table>
    </div>
    <script>
        function chk_confirm(){
            var c=confirm("�׹�ѹ�����觢�������� LIS");
            return c;
        }
    </script>
    <?php

}
?>

</body>
</html>