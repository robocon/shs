<?php

include 'bootstrap.php';
define('RDU_TEST', '1');
global $in6_result;

// 仴֧�����Ũҡ�Կ����� .13 ����Ŵ�����Կ�������ѡ 
$configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'superadmin',
    'pass' => ''
);

$db = Mysql::load($configs);
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

<div>
    <a href="../nindex.htm">��Ѻ˹����ѡ �.�.</a>
</div>

<h3>RDU Indicator</h3>
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
            <th>A</th>
            <th>B</th>
            <th>�.�.�����</th>
        </tr>
        <tr>
            <td align="center">1</td>
            <td>-</td>
            <td>-</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>-</td>
            <td>-</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>-</td>
            <td>-</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>-</td>
            <td>-</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>-</td>
            <td>-</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>�����С�����һ�Ԫ�ǹ���ä�Դ���ͷ���к�������㨪�ǧ�������ʹ���ѡ�ʺ��º��ѹ㹼����¹͡</td>
            <?php
            // include 'rdu_in6.php';
            ?>
            <td>&le; ������ 20</td>
            <td align="right"><?=$in6a;?></td>
            <td align="right"><?=$in6b;?></td>
            <td align="right"><?=number_format($in6_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>�����С�����һ�Ԫ�ǹ���ä�ب������ǧ��º��ѹ</td>
            <?php
            // include 'rdu_in7.php';
            ?>
            <td>&le; ������ 20</td>
            <td align="right"><?=$in7a;?></td>
            <td align="right"><?=$in7b;?></td>
            <td align="right"><?=number_format($in7_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td>�����С�����һ�Ԫ�ǹ�㹺Ҵ��ʴ�ҡ�غѵ��˵�</td>
            <?php
            // include 'rdu_in8.php';
            ?>
            <td>&le; ������ 40</td>
            <td align="right"><?=$in8a;?></td>
            <td align="right"><?=$in8b;?></td>
            <td align="right"><?=number_format($in8_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">9</td>
            <td>�����С�����һ�Ԫ�ǹ��˭ԧ��ʹ���Ԥú��˹��ҧ��ͧ��ʹ</td>
            <td>&le; ������ 10</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td align="center">10</td>
            <td>�����Тͧ�����¤����ѹ���ʹ�٧����� ����ա���� RAS blockage (ACEIs/ARBs/Renin inhibitor) <br>
            2��Դ�����ѹ 㹡���ѡ�����Ф����ѹ���ʹ�٧</td>
            <?php
            // include 'rdu_in10.php';
            ?>
            <td>= ������ 10</td>
            <td align="right"><?=$in10a;?></td>
            <td align="right"><?=$in10b;?></td>
            <td align="right"><?=number_format($in10_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">11</td>
            <td>�����Тͧ�����·������ glibenclamide 㹼����·���������ҡ���� 65 ��<br>
            ������ eGFR ���¡��� 60 ��./�ҷ�/1.73 ���ҧ����</td>
            <?php
            // include 'rdu_in11.php';
            ?>
            <td>&le; ������ 5</td>
            <td align="right"><?=$in11a;?></td>
            <td align="right"><?=$in11b;?></td>
            <td align="right"><?=number_format($in11_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">12</td>
            <td>�����Тͧ����������ҹ������� metformin ���Ҫ�Դ�������������Ѻ��������ͤǺ����дѺ��ӵ�� ������բ��������</td>
            <?php
            include 'rdu_in12.php';
            ?>
            <td>>= ������ 80</td>
            <td align="right"><?=$in12a;?></td>
            <td align="right"><?=$in12b;?></td>
            <td align="right"><?=number_format($in12_result, 2);?></td>
        </tr>
    </table>
    <?php
}