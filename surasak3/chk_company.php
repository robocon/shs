<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == false ){
    include 'chk_menu.php';

    $id = input_get('id', 0);
    $company = $company_code = $date_checkup = '';
    $read_only = false;
    if( $id > 0 ){
        $sql = "SELECT * FROM `chk_company_list` WHERE `id` = '$id' ";
        $db->select($sql);
        $item = $db->get_item();

        $name = $item['name'];
        $code = $item['code'];
        $date_checkup = $item['date_checkup'];
        
        $read_only = 'readonly="readonly"';
    }
    ?>
    <fieldset>
        <legend>��������ѷ����</legend>
        <form action="chk_company.php" method="post">
            <div>
                ���ͺ���ѷ : <input type="text" name="company" value="<?=$name;?>" style="width: 40%; ">
            </div>
            <div>
                ���ʺ���ѷ : <input type="text" name="company_code" value="<?=$code;?>" <?=$read_only;?>>
            </div>
            <div>
                �ѹ����Ǩ : <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
                <span style="color: red;"><u>* ��㹡���ʴ����㺾����ŵ�Ǩ�آ�Ҿ��Шӻ�</u></span>
                <div>
                    <span style="color: red;">������ҧ�� 5-20 ���Ҥ� 2560</span>
                </div>
            </div>
            <div>
                <button type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="id" value="<?=$id;?>">
            </div>
        </form>
    </fieldset>
    <br>
    <fieldset>
        <legend>���ҵ���է�����ҳ</legend>
        <form action="chk_company.php" method="post">
            <div> ���͡�� : 
                <?php 
                $year_range = range('2018',get_year_checkup(true, true));
                getYearList('year_selected', true, 'selected', $year_range);
                ?>
            </div>

            <div>
                <button type="submit">�ʴ���</button>
                <input type="hidden" name="views" value="search">
            </div>
        </form>
    </fieldset>

    <?php 
    $action = input_post('views');
    if ( $action == 'search' ) {
    ?>
    <div>
        <?php 
        $year_selected = input_post('year_selected');
        $year_selected += 543;

        $sql = "SELECT * FROM `chk_company_list` 
        WHERE `yearchk` = '$year_selected' AND `status` = '1' 
        ORDER BY `id` ASC";
        $db->select($sql);

        $items = $db->get_items();
        ?>
        <h3>��ª��ͺ���ѷ</h3>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>���ͺ���ѷ</th>
                <th>���������������</th>
                <th>��ǧ���ҷ���Ǩ</th>
                <th>�ͺ�է�����ҳ</th>
                <th>ŧ��/������</th>
                <th></th>
                <th></th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {

                $report = ( !empty($item['report']) ) ? $item['report'].'?camp='.$item['code'] : 'javascript:void(0);' ;
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><a href="chk_show_user.php?part=<?=$item['code'];?>"><?=$item['name'];?></a></td>
                    <td><?=$item['code'];?></td>
                    <td><?=$item['date_checkup'];?></td>
                    <td align="center"><?=$item['yearchk'];?></td>
                    <td>
                        <ol>
                            <li><a href="out_result.php?part=<?=$item['code'];?>" target="_blank">ŧ�����ūѡ����ѵ�</a></li>
                            <li><a href="<?=$report;?>" target="_blank">�ŵ�Ǩ��ºؤ��</a></li>
                            <li><a href="chk_report_all.php?camp=<?=$item['code'];?>" target="_blank">��ػ�ŵ�Ǩ</a></li>
                            <li><a href="dx_ofyear_out.php" target="_blank">�ѡ����ѵ�(�Է�� ���.)</a></li>
                            <li><a href="chk_cross_sso.php?camp=<?=$item['code'];?>" target="_blank">��ػ��(�Է�� ���.)</a></li>
                        </ol>
                    </td>
                    <td><a href="chk_all_lab.php?part=<?=$item['code'];?>">�� Lab ������</a></td>
                    <td><a href="chk_company.php?id=<?=$item['id'];?>">���</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td></td>
                <td>��Ǩ�آ�Ҿ �ͺ���Ǩ 61</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <ol>
                        <li>
                            <a href="out_result.php?part=�ͺ���Ǩ60" target="_blank">ŧ�����ūѡ����ѵ�</a>
                        </li>
                        <li>
                        <a href="chk_report_police60.php" target="_blank">�����ŵ�Ǩ</a>
                        </li>
                    </ol>
                </td>
                <td></td>
            </tr>
        </table>
        <?php
        ?>
    </div>
    <?php
    }

} else if( $action == 'save' ) {
    
    $company = input_post('company');
    $id = input_post('id');
    $company_code = input_post('company_code');
    $date_checkup = input_post('date_checkup');
    $year = get_year_checkup(true);

    $msg = '�ѹ�֡���������º����';

    if( empty($company) OR empty($company_code) ){
        $msg = '��س��������� ���ͺ���ѷ ��� ���ʺ���ѷ���١��ͧ';
    }else{

        if( $id > 0 ){
            $sql = "UPDATE `chk_company_list`
            SET
            `name` = '$company',
            `code` = '$company_code',
            `date_checkup` = '$date_checkup'
            WHERE `id` = '$id';";
            $save = $db->update($sql);

            if( $save !== true ){
                $msg = errorMsg('save', $save['id']);
            }

        }else{

            $sql = "SELECT `id` FROM `chk_company_list` WHERE `code` = '$company_code'";
            $db->select($sql);
            $chk_row = $db->get_rows();

            // $msg = "���ʺ���ѷ��ӫ�͹�������ö�ѹ�֡��������";
            $msg = "�ѹ�֡���������º����";

            if( $chk_row == 0 ){
                $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status` ) 
                VALUES (
                NULL,'$company','$company_code','$date_checkup','$year','1'
                );";
                $save = $db->insert($sql);

                if( $save !== true ){
                    $msg = errorMsg('save', $save['id']);
                }
            }
            
        }

    }

    redirect('chk_company.php', $msg);
    exit;
}
?>
