<?php
// include '../includes/functions.php';

$ncr_items = array(
    1 => array(
        'title' => '������ʹ��� / ��/ ˡ���',
        'items' => array(
            'topic1_1' => '���', 
            'topic1_2' => '����ҹ͹���躹���', 
            'topic1_3' => '���ҡ��§/������/���', 
            'topic1_4' => '����ͧ�Ѵ��֧��ش', 
            'topic1_5' => '�չ�����������§', 
            'topic1_6' => '��Ѵ�������ҧ�������͹����', 
            'topic1_7' => '����'
        )
    ),
    2 => array(
        'title' => '��õԴ����������',
        'items' => array(
            'topic2_1' => '�������§ҹ�� Lab/Film X-ray ��ǹ ���� �Դ����', 
            'topic2_2' => '�������§ҹᾷ��/ᾷ�����ͺ', 
            'topic2_3' => '��Ժѵ����١��ͧ��������', 
            'topic2_4' => '�Ǫ����¹�������ó�', 
            'topic2_5' => '��Թ������ç�Ѻ�ѵ����', 
            'topic2_6' => '���ѵ�������������Թ���', 
            'topic2_7' => '����'
        )
    ),
    3 => array(
        'title' => '��õԴ����������',
        'items' => array(
            'topic3_1' => '�Դ��',
            'topic3_2' => '�����á��͹�ҡ���������ʹ',
            'topic3_3' => '�����ʹ',
            'topic3_4' => '����'
        )
    ),
    4 => array(
        'title' => '����ͧ���',
        'items' => array(
            'topic4_1' => '�����¶١�ǡ / ����',
            'topic4_2' => '����������',
            'topic4_3' => '���ӧҹ / �ӧҹ�Դ����',
            'topic4_4' => '���������ͧ��� ��',
            'topic4_5' => '�Կ�����ӧҹ',
            'topic4_6' => '����'
        )
    ),
    5 => array(
        'title' => '����ԹԨ��� / �ѡ��',
        'items' => array(
            'topic5_1' => '�Ѻ Admit ������ä���� 7 �ѹ',
            'topic5_2' => '�������ö�ԹԨ����ä����ͧ admit ������ ER ���',
            'topic5_3' => '��ҹ����硫�����Դ',
            'topic5_4' => '��Ҫ��㹡���ѡ�Ҽ����·���شŧ',
            'topic5_5' => '�����á��͹�ҡ�ѵ����',
            'topic5_6' => '�� Diag Proc ����������Ἱ',
            'topic5_7' => '���������ѧ�����§��',
            'topic5_8' => '��� Cath / Tube / Drain ���١',
            'topic5_9' => '���� Cath / Tube / Drain',
            'topic5_10' => '���¼�������� ICU �������Ἱ',
            'topic5_11' => '����'
        )
    ),
    6 => array(
        'title' => '��ä�ʹ',
        'items' => array(
            'topic6_1' => '��辺 Fetal distress �ѹ��ǧ��',
            'topic6_2' => '��ҵѴ��ʹ����Թ�',
            'topic6_3' => '�����á��͹�ҡ��ä�ʹ',
            'topic6_4' => '�Ҵ�纨ҡ��ä�ʹ',
            'topic6_5' => '����'
        )
    ),
    7 => array(
        'title' => '��ü�ҵѴ / ���ѭ��',
        'items' => array(
            'topic7_1' => '�����á��͹�ҧ���ѭ��',
            'topic7_2' => '��ҵѴ�Դ�� / �Դ��ҧ / �Դ���˹�',
            'topic7_3' => '�Ѵ�������͡��������ҧἹ',
            'topic7_4' => '��纫��������з��Ҵ��',
            'topic7_5' => '�������ͧ��� / ���� ���㹼�����',
            'topic7_6' => '��Ѻ�Ҽ�ҵѴ���',
            'topic7_7' => '����'
        )
    ),
    8 => array(
        'title' => '��� �',
        'items' => array(
            'topic8_1' => '������ / �ҵ� ���֧���',
            'topic8_2' => '�����Ѥ������ þ.',
            'topic8_3' => '�ա�÷�������ҧ��� ������ / �ҵ� / ���˹�ҷ��',
            'topic8_4' => '�����¾�������ҵ�ǵ�� / ��������ҧ��µ���ͧ',
            'topic8_5' => '�á��� / �ѡ����',
            'topic8_6' => '��äء��� / ������',
            'topic8_7' => '����Ǵ�������ѹ���� / �����͹',
            'topic8_8' => '�غѵ��˵������',
            'topic8_9' => '���. �Ҵ�纨ҡ��÷ӧҹ ',
            'topic8_10' => '��������¡�纤�������',
            'topic8_11' => '����'
        )
    )
);

$con = mysql_connect('localhost','root','1234');
mysql_select_db('dbconform', $con);

$year_select = ( !empty($_POST['year_select']) ) ? $_POST['year_select'] : date('Y')+543 ;

?>
<h3>Top 10 ��������§�����9</h3>
<fieldset style="width: 30%;">
    <legend>���͡��ä���</legend>
    <form action="topProgram9.php" method="post">
        <div>
            �� <select name="year_select" id="">
                <?php
                foreach ( range(2004, date('Y')) as $key => $value) {
                    $year_th = $value + 543;

                    $selected = ( $year_th == $year_select ) ? 'selected="selected"' : '' ;
                    ?>
                    <option value="<?=$year_th;?>" <?=$selected;?>><?=$year_th;?></option>
                    <?php
                }
                ?>
            </select>
        </div>
        <div>
            <button type="submit">�ʴ���</button>
            <input type="hidden" name="show" value="1">
        </div>
    </form>
</fieldset>
<?php

$show = $_POST['show'];
if( !empty($show) && $show === '1' ){

    $year_start = $_POST['year_select'];
    $year_end = $year_start + 1;

    $sql = "SELECT SUM(`topic1_1`) AS `topic1_1`,SUM(`topic1_2`) AS `topic1_2`,SUM(`topic1_3`) AS `topic1_3`,SUM(`topic1_4`) AS `topic1_4`,SUM(`topic1_5`) AS `topic1_5`,SUM(`topic1_6`) AS `topic1_6`,SUM(`topic1_7`) AS `topic1_7`,
    SUM(`topic2_1`) AS `topic2_1`,SUM(`topic2_2`) AS `topic2_2`,SUM(`topic2_3`) AS `topic2_3`,SUM(`topic2_4`) AS `topic2_4`,SUM(`topic2_5`) AS `topic2_5`,SUM(`topic2_6`) AS `topic2_6`,COUNT(`topic2_7`) AS `topic2_7`,
    SUM(`topic3_1`) AS `topic3_1`,SUM(`topic3_2`) AS `topic3_2`,SUM(`topic3_3`) AS `topic3_3`,
    SUM(`topic4_1`) AS `topic4_1`,SUM(`topic4_2`) AS `topic4_2`,SUM(`topic4_3`) AS `topic4_3`,SUM(`topic4_4`) AS `topic4_4`,SUM(`topic4_5`) AS `topic4_5`,SUM(`topic4_6`) AS `topic4_6`,
    SUM(`topic5_1`) AS `topic5_1`,SUM(`topic5_2`) AS `topic5_2`,SUM(`topic5_3`) AS `topic5_3`,SUM(`topic5_4`) AS `topic5_4`,SUM(`topic5_5`) AS `topic5_5`,SUM(`topic5_6`) AS `topic5_6`,SUM(`topic5_7`) AS `topic5_7`,SUM(`topic5_8`) AS `topic5_8`,SUM(`topic5_9`) AS `topic5_9`,SUM(`topic5_10`) AS `topic5_10`,SUM(`topic5_11`) AS `topic5_11`,
    SUM(`topic6_1`) AS `topic6_1`,SUM(`topic6_2`) AS `topic6_2`,SUM(`topic6_3`) AS `topic6_3`,SUM(`topic6_4`) AS `topic6_4`,SUM(`topic6_5`) AS `topic6_5`,
    SUM(`topic7_1`) AS `topic7_1`,SUM(`topic7_2`) AS `topic7_2`,SUM(`topic7_3`) AS `topic7_3`,SUM(`topic7_4`) AS `topic7_4`,SUM(`topic7_5`) AS `topic7_5`,SUM(`topic7_6`) AS `topic7_6`,SUM(`topic7_7`) AS `topic7_7`,
    SUM(`topic8_1`) AS `topic8_1`,SUM(`topic8_2`) AS `topic8_2`,SUM(`topic8_3`) AS `topic8_3`,SUM(`topic8_4`) AS `topic8_4`,SUM(`topic8_5`) AS `topic8_5`,SUM(`topic8_6`) AS `topic8_6`,SUM(`topic8_7`) AS `topic8_7`,SUM(`topic8_8`) AS `topic8_8`,SUM(`topic8_9`) AS `topic8_9`,SUM(`topic8_10`) AS `topic8_10`,SUM(`topic8_11`) AS `topic8_11` 
    FROM `ncr2556` 
    WHERE `nonconf_date` LIKE '$year_start%' 
    GROUP BY `type`";
    $q = mysql_query($sql) or die ( mysql_error() );
    $t1_1 = 0;

    $items = array();
    foreach ( mysql_fetch_assoc($q) as $key => $value) {
        $items[$key] = (int) $value;
    }

    arsort($items);

    $i = 0;

    ?>
    <h3>Top 10 ��������§�����9 �� <?=$year_start;?></h3>
    <table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse; border-color: #000;">
        <thead>
            <tr>
                <th>�ӴѺ</th>
                <th>��Ǣ��</th>
                <th>����ͧ</th>
                <th>�ӹǹ</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $i = 0;
        foreach ($items as $key => $value) {
            ++$i;
            if( $i > 10 ){
                continue;
            }

            $match = preg_match('/topic(\d)/', $key, $matchs);
            if( $match > 0 ){
                $main_key = $matchs['1'];
            }

            $topic = $ncr_items[$main_key]['title'];
            $detail = $ncr_items[$main_key]['items'][$key];
            ?>
            <tr>
                <td align="right"><?=$i;?></td>
                <td><?=$topic;?></td>
                <td><?=$detail.' '.$key;?></td>
                <td align="right"><a href="NCR2556/detail_report_event.php?y=<?=$year_start;?>&topicdetail=<?=$key;?>" target="_blank"><?=$value;?></a></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <?php

}


// var_dump($items);


/*
$sql = "SELECT `clinic`, COUNT(`clinic`) AS `row` 
FROM `ncr2556` 
WHERE `nonconf_date` >= '2558-10-01' AND `nonconf_date` <= '2559-09-30' 
AND `clinic` != '' 
GROUP BY `clinic`;";
$q = mysql_query($sql) or die ( mysql_error() );
while ( $item = mysql_fetch_assoc($q) ) {
    var_dump($item);
}
*/