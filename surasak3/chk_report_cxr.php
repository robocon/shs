<?php 

include 'bootstrap.php';

$db = Mysql::load();
$action = input_post('action');
$officer = $_SESSION['sOfficer'];

include 'chk_menu.php';
?>

<fieldset>
    <legend>���ҡ�úѹ�֡�� X-Ray �������ѷ</legend>
    <form action="chk_report_cxr.php" method="post">
        <div>
            <?php 
            $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC");
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
        <label for="orderby1"><input type="radio" name="orderby" id="orderby1" value="hn" checked>���§����ŢHN</label>&nbsp;
        <label for="orderby2"><input type="radio" name="orderby" id="orderby2" value="number">���§����ӴѺ���˹�</label>
        </div>
        <div>
            <button type="submit">�ʴ���ª���</button>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
</fieldset>

<?php 

$page = input_post('page');

if ( $page === 'search' ) {

    $part = input_post('part');
    $order = input_post('orderby');

    $db->select("SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$part'");
    $company = $db->get_item();

    $db->select("SELECT `hn`,`ptname`,`cxr`,`detail` FROM `chk_cxr` WHERE `part` = '$part' ");

    if ( $db->get_rows() == 0 ) {
        echo "�ѧ�����ŧ��";
        exit;
    }
    $items = $db->get_items();

    if( $order == 'hn' ){

        $pre_items = array();
        foreach ($items as $key => $item) {
            
            list($year, $number) = explode('-', $item['hn']);
            $number = sprintf('%05d', $number);
            $key = $year.$number;

            $pre_items[$key] = $item;

        }
        ksort($pre_items); 

        $items = $pre_items;

    }

    ?>
    <h3>�š�õ�Ǩ�ѧ�պ���ѷ <?=$company['name'];?></h3>
    <table class="chk_table">
        <thead>
            <tr>
                <th>�ӴѺ</th>
                <th>HN</th>
                <th>����ʡ��</th>
                <th>�š�õ�Ǩ</th>
                <th>��������´</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $i = 1;
            foreach ($items as $key => $value) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$value['hn'];?></td>
                <td><?=$value['ptname'];?></td>
                <td><?=$value['cxr'];?></td>
                <td><?=$value['detail'];?></td>
            </tr>
            <?php 
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php

    exit;
}