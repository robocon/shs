<?php

include 'bootstrap.php';
define('RDU_TEST', '1');


$db = Mysql::load($rdu_configs);
$quarter = input_post('quarter');
if( $quarter == 1 ){
    $month_range['min'] = '10';
    $month_range['max'] = '12'; //��
    
}else if( $quarter == 2 ){
    $month_range['min'] = '01';
    $month_range['max'] = '03'; //��
    
}else if( $quarter == 3 ){
    $month_range['min'] = '04';
    $month_range['max'] = '06';
    
}else if( $quarter == 4 ){
    $month_range['min'] = '07';
    $month_range['max'] = '09';
    
}
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

<?php
$default_year = date('Y');
$year = input_post('year', $default_year);
$year_range = array(2017,2018);

$quarter_range = array(
    1 => '����ʷ�� 1(�.�. - �.�.)',
    '����ʷ�� 2(�.�. - ��.�.)',
    '����ʷ�� 3(��.�. - ��.�.)',
    '����ʷ�� 4(�.�. - �.�.)'
);
?>

<form action="rdu.php" method="post">

    <fieldset>
        <legend>RDU Indicator</legend>
    

        <div>
            ���͡�է�����ҳ 
            <select name="year" id="">
                <?php
                foreach ($year_range as $year_en) {

                    $selected = ( $year_en == $year ) ? 'selected="selected"' : '' ;

                    ?>
                    <option value="<?=$year_en;?>" <?=$selected;?>><?=($year_en + 543);?></option>
                    <?php
                }
                ?>
            </select>

            ���͡��ǧ����� 
            <select name="quarter" id="">
                <?php
                foreach ($quarter_range as $key => $quarter_item) {

                    $selected = ( $key == $quarter ) ? 'selected="selected"' : '' ;
                    
                    ?>
                    <option value="<?=$key;?>" <?=$selected;?> ><?=$quarter_item;?></option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="action" value="load">
        </div>

    </fieldset>

</form>

<?php 



// special char
// w3schools.com/charsets/ref_utf_math.asp
// &le; <=
// &ge; >=
$action = input_post('action');

if ( $action == 'load' ) {
    
    $year_for_title = $year;
    
    // ���������á�ѡ�1��
    if( $quarter == 1 ){
        $year = $year - 1;
    }

    $last_day = date('t', $year.'-'.$month_range['max'].'-01');

    $year = $year + 543;
    $date_min = $year.'-'.$month_range['min'].'-01 00:00:00';
    $date_max = $year.'-'.$month_range['max'].'-'.$last_day.' 23:59:59';

    ?>
    <h3>��§ҹ�š�ô��Թ�ҹ�����Ǫ���Ѵ RDU �է�����ҳ <?=$year_for_title + 543;?> ��鹷��2 (����� <?=$quarter;?>) </h3>
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
            <td>�����Тͧ��¡���ҷ���������㹺ѭ������ѡ��觪ҵ�</td>
            <td>þ.�дѺ A &ge; 75%<br>S &ge; 80%<br>M1-M2 &ge; 85%<br>F1-F3 &ge; 90%</td>
            <?php
            include 'rdu_in1.php';
            ?>
            <td align="right"><?=number_format($in1a);?></td>
            <td align="right"><?=number_format($in1b);?></td>
            <td align="right"><?=number_format($in1_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">2</td>
            <td>����Է�Լš�ô��Թ�ҹ�ͧ��С������ PTC 㹡�ê����������<br>�������������͹����������ç��Һ�������������������ҧ���˵ؼ�</td>
            <td>�дѺ 3</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">3</td>
            <td>��ô��Թ�ҹ㹡�èѴ�ө�ҡ���ҵðҹ ��ҡ������� ����͡��â�������� 13����� �������������´�ú��ǹ</td>
            <td>��¡���� 13�����</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">4</td>
            <td>��¡���ҷ���þԨ�óҵѴ�͡ 8��¡�� ����ѧ��������㹺ѭ����¡���Ңͧ�ç��Һ��</td>
            <td>&le; 1��¡��</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">5</td>
            <td>��ô��Թ�ҹ��������������¸���㹡�èѴ����������������â����</td>
            <td>�дѺ 3</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right">-</td>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>�����С�����һ�Ԫ�ǹ���ä�Դ���ͷ���к�������㨪�ǧ�������ʹ���ѡ�ʺ��º��ѹ㹼����¹͡</td>
            <?php 
            include 'rdu_in6.php';
            $url_in6 = "date_max=".urlencode($date_max)."&date_min=".urlencode($date_min)."&quarter=$quarter";
            ?>
            <td>&le; ������ 20</td>
            <td align="right">
                <a href="rdu_in6_a.php?<?=$url_in6;?>"><?=number_format($in6a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in6_b.php?<?=$url_in6;?>"><?=number_format($in6b);?></a>
            </td>
            <td align="right"><?=number_format($in6_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>�����С�����һ�Ԫ�ǹ���ä�ب������ǧ��º��ѹ</td>
            <?php 
            include 'rdu_in7.php';
            $url_in7 = "date_max=".urlencode($date_max)."&date_min=".urlencode($date_min)."&quarter=$quarter";
            ?>
            <td>&le; ������ 20</td>
            <td align="right">
                <a href="rdu_in7_a.php?<?=$url_in7;?>" target="_blank"><?=number_format($in7a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in7_b.php?<?=$url_in7;?>"><?=number_format($in7b);?></a>
            </td>
            <td align="right"><?=number_format($in7_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td>�����С�����һ�Ԫ�ǹ�㹺Ҵ��ʴ�ҡ�غѵ��˵�</td>
            <?php
            include 'rdu_in8.php';
            $url_in8 = "date_max=".urlencode($date_max)."&date_min=".urlencode($date_min)."&quarter=$quarter";
            ?>
            <td>&le; ������ 40</td>
            <td align="right">
                <a href="rdu_in8_a.php?<?=$url_in8;?>"><?=number_format($in8a);?></a>
            </td>
            <td align="right">
                <a href="rdu_in8_b.php?<?=$url_in8;?>"><?=number_format($in8b);?></a>
            </td>
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
            include 'rdu_in10.php';
            ?>
            <td>������ 0</td>
            <td align="right" title="�ӹǹ visit �����¤����ѹ���ʹ�٧������Ѻ���������ҡ���� RAS Blockage &ge;2��Դ"><?=number_format($in10a);?></td>
            <td align="right" title="�ӹǹ visit �����¤����ѹ���ʹ�٧������Ѻ���������ҡ���� RAS Blockage ���ҧ����1��Դ"><?=number_format($in10b);?></td>
            <td align="right"><?=number_format($in10_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">11</td>
            <td>�����Тͧ�����·������ glibenclamide 㹼����·���������ҡ���� 65 ��<br>
            ������ eGFR ���¡��� 60 ��./�ҷ�/1.73 ���ҧ����</td>
            <?php
            include 'rdu_in11.php';
            ?>
            <td>&le; ������ 5</td>
            <td align="right"><?=number_format($in11a);?></td>
            <td align="right"><?=number_format($in11b);?></td>
            <td align="right"><?=number_format($in11_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">12</td>
            <td>�����Тͧ����������ҹ������� metformin ���Ҫ�Դ�������������Ѻ��������ͤǺ����дѺ��ӵ�� ������բ��������</td>
            <?php
            // include 'rdu_in12.php';
            ?>
            <td>&ge; ������ 80</td>
            <td align="right"><?=number_format($in12a);?></td>
            <td align="right"><?=number_format($in12b);?></td>
            <td align="right"><?=number_format($in12_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">13</td>
            <td>�����Тͧ�����¹͡����ա�����ҡ���� NSAIDs ��ӫ�͹</td>
            <?php
            include 'rdu_in13.php';
            ?>
            <td>&le; ������ 5</td>
            <td align="right"><?=number_format($in13a);?></td>
            <td align="right"><?=number_format($in13b);?></td>
            <td align="right"><?=number_format($in13_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">14</td>
            <td>�����Тͧ�������ä�������ѧ�дѺ 3 ���价�����Ѻ�� NSAIDs</td>
            <?php
            include 'rdu_in14.php';
            ?>
            <td>&le; ������ 10</td>
            <td align="right"><?=number_format($in14a);?></td>
            <td align="right"><?=number_format($in14b);?></td>
            <td align="right"><?=number_format($in14_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">15</td>
            <td>�����м������ä�״������ѧ������Ѻ�� inhaled corticosteroid</td>
            <?php
            include 'rdu_in15.php';
            ?>
            <td>&ge; ������ 80</td>
            <td align="right"><?=number_format($in15a);?></td>
            <td align="right"><?=number_format($in15b);?></td>
            <td align="right"><?=number_format($in15_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">16</td>
            <td>�����м����¹͡�٧���� ������ҡ���� long-acting benzodiazepine ���� chlordiazepoxide, diazepam, dipotassium chlorazepate</td>
            <?php
            // include 'rdu_in16.php';
            ?>
            <td>&le; ������ 5</td>
            <td align="right"><?=number_format($in16a);?></td>
            <td align="right"><?=number_format($in16b);?></td>
            <td align="right"><?=number_format($in16_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">17</td>
            <td>�ӹǹʵ�յ�駤���������Ѻ�ҷ�������� ���� �� Warfarin/Statins/Ergot ����������ҵ�駤��������</td>
            <?php
            include 'rdu_in17.php';
            ?>
            <td>0 ��</td>
            <td align="right">-</td>
            <td align="right">-</td>
            <td align="right"><?=$in17_result;?></td>
        </tr>
        <tr>
            <td align="center">18</td>
            <td>�����Тͧ�������� ������Ѻ����ԹԨ������ä�Դ���ͧ͢�ҧ�Թ���� (��ͺ�����ä������� ICD10 ��� RUA-URI) ������Ѻ����ʵ��չ��Դ non-sedating</td>
            <?php
            include 'rdu_in18.php';
            ?>
            <td>&le; ������ 20</td>
            <td align="right"><?=number_format($in18a);?></td>
            <td align="right"><?=number_format($in18b);?></td>
            <td align="right"><?=number_format($in18_result, 2);?></td>
        </tr>
    </table>
    <?php
}