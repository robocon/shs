<?php

include 'bootstrap.php';

define('RDU_TEST', '1');

global $in6_result;

$db = Mysql::load();

$def_date = (date('Y') + 543).date('-m');

$date = input_post('date', $def_date);

?>

<style>
/* ���ҧ */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<form action="rdu.php" method="post">

    <div>
        ���͡��͹ <input type="text" name="date" id="" value="<?=$date;?>">
    </div>

    <div>
        <button type="submit">�ʴ���</button>
        <input type="hidden" name="action" value="load">
    </div>

</form>

<?php
// special char
// w3schools.com/charsets/ref_utf_math.asp
$action = input_post('action');

if ( $action == 'load' ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>��Ǫ���Ѵ���</th>
            <th>���͵�Ǫ���Ѵ</th>
            <th>�������</th>
            <th>�.�.�����</th>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>�����С�����һ�Ԫ�ǹ���ä�Դ���ͷ���к�������㨪�ǧ�������ʹ���ѡ�ʺ��º��ѹ㹼����¹͡</td>
        
            <?php
            include 'rdu_in6.php';
            ?>
            <td>&le; ������ 20</td>
            <td><?=number_format($in6_result, 2);?></td>
            
        </tr>
    </table>
    <?php
}