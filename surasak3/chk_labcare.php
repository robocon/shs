<?php
include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

include 'chk_menu.php';

if ( empty($page) ) {
    
    $sql = "SELECT * FROM `labcare` WHERE `chkup` = 'chk' AND `lab_list` IS NULL ";
    $db->select($sql);

    $items = $db->get_items();
    ?>
    <div>
        <a href="chk_labcare.php?page=form">���ҧ����</a>
    </div>
    <div>
        <h3>�к��Ѵ�����¡�� Lab ����Ѻ��õ�Ǩ�آ�Ҿ</h3>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>����Lab</th>
                <th>��������´</th>
                <th>�Ҥ�</th>
                <th>�ԡ��</th>
                <th>�ԡ�����</th>
                <th>������</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=dump($item);?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
            }
            ?>
        </table>
    </div>
    <?php
} elseif ( $page == 'form' ) {
    ?>
    <div>
        <h3>������ѹ�֡</h3>
    </div>
    <div>
        <form action="chk_labcare.php" method="post">
            <div>
                ����Lab: <input type="text" name="" id="">
            </div>
            <div>
                ��������´: <input type="text" name="" id="">
            </div>
            <div>
                Part: <input type="text" name="" id=""> 
            </div>
            <div>
                �Ҥ����: <input type="text" name="" id=""> �ҷ
            </div>
            <div>
                �ԡ��: <input type="text" name="" id=""> �ҷ
            </div>
            <div>
                �ԡ�����: <input type="text" name="" id=""> �ҷ
            </div>
            <div>
                ������Lab: <input type="radio" name="" id=""> �þ. <input type="radio" name="" id=""> �͡þ.
            </div>
            <!--
            @todo
            [] labcareeditrow.php lab�͡�պ���ѷ������͡
            -->
            <div>
                <button type="submit">�ѹ�֡������</button>
            </div>
        </form>
    </div>
    <?php
}
?>

