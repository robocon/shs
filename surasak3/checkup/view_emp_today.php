<?php 
include '../bootstrap.php';

/**
 * @todo
 * - ����¹
 * - lab 
 * - �ѡ����ѵ�
 * - ᾷ��
 */

$shs_configs = array(
    'host' => '192.168.1.13',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'dottow',
    'pass' => ''
);

$db = Mysql::load($shs_configs);
// $db->exec("SET NAMES UTF8");

$sql = "SELECT z.`HN` AS `pre_hn`, CONCAT(z.`name`,' ',z.`surname`) AS `pre_name`, 
b.`row_id`,b.`thidate`,z.`HN` AS `hn`, CONCAT(z.`name`,' ',z.`surname`) AS `ptname`,b.`vn`,z.`agey` AS `age` ,b.`toborow`,
CONCAT(SUBSTRING(b.`thidate`,1,10),b.`hn`) AS `date_hn_bc`,
CONCAT((SUBSTRING(b.`thidate`,1,4) - 543),SUBSTRING(b.`thidate`,5,6),b.`hn`) AS `date_hn_ad`,
d.`employee`,
c.`camp`,c.`yearchk`,c.`weight`,c.`height`,c.`bmi`,c.`bp1`,c.`bp2`,
e.`date_chk`,e.`doctor`,
e.`cxr`,e.`res_cbc`,e.`res_ua`,e.`res_glu`,e.`res_crea`,e.`res_chol`,e.`res_hdl`,e.`res_hbsag`, 
e.`conclution`,e.`normal_suggest`,e.`normal_suggest_date`,e.`abnormal_suggest`,e.`abnormal_suggest_date`,e.`diag` 
FROM (
	SELECT * FROM `opcardchk` WHERE `part` = '�١��ҧ62' 
) AS z 

LEFT JOIN ( 

	SELECT y.`row_id`,y.`thidate`,y.`thdatehn`,y.`hn`,y.`vn`,y.`thdatevn`,y.`ptname`,y.`age`,y.`ptright`,y.`idcard`,
	y.`toborow`,y.`officer`
	FROM ( 
		SELECT MAX(`row_id`) AS `row_id` 
		FROM `opday` 
		WHERE `thidate` >= '2562-04-01 00:00:00' AND `thidate` <= '2562-05-10 23:23:59' 
		AND ( `toborow` LIKE 'EX16%' OR `toborow` LIKE 'EX46%' ) 
		GROUP BY `hn` 

	) AS x 
	LEFT JOIN `opday` AS y ON x.`row_id` = y.`row_id` 
	
) AS b ON b.`hn` = z.`HN` 

LEFT JOIN `opcard` AS d ON d.`hn` = z.`HN` 
LEFT JOIN `dxofyear_out` AS c ON c.`thdatehn` = CONCAT((SUBSTRING(b.`thidate`,1,4) - 543),SUBSTRING(b.`thidate`,5,6),z.`HN`) 
LEFT JOIN ( 
	SELECT * FROM `chk_doctor` WHERE `date_chk` >= '2019-04-01 00:00:00' AND `date_chk` <= '2019-05-10 23:23:59' 
) AS e ON e.`hn` = z.`HN` 
ORDER BY z.`row` ASC ";

$db->select($sql);
$items = $db->get_items();

?>

<style>
*{
    font-family:"TH Sarabun New","TH SarabunPSK";
    font-size: 12pt;
}

.chk_table{
    border-collapse: collapse;
}

.chk_table th{
    text-align: center;
}

.chk_table, th, td{
    border: 1px solid black;
    padding: 3px;
}
</style>

<div>
    <h3>��ػ�ŵ�Ǩ�آ�Ҿ�١��ҧ���Ǥ��� ��2562 (��ǧ���ͺ)</h3>
    <div style="border: 2px solid #7e7e00; background-color: #fefed3; padding: 4px; margin: 4px;">
        <p>!!! READ ME !!!</p>
        <ul>
            <li><span style="color: red;"><b><u>��ᴧ</u></b></span> �ѧ�������ػ�Ũҡᾷ��</li>
            <li><span style="color: yellow;"><b><u>������ͧ</u></b></span> ����ա��ŧʶҹ�<u>�١��ҧ</u>�ҡ����¹ ���ա�õ�Ǩ�آ�Ҿ�١��ҧ</li>
            <li><span><b><u>ʶҹ��١��ҧ</u></b></span> y: �ա���׹�ѹʶҹШҡ����¹ n: �ѧ����ա���׹�ѹ�ҡ����¹</li>
            <li><span><b><u>ᾷ��</u></b></span> ��� ᾷ������ػ�ŵ�Ǩ</li>
        </ul>
    </div>
    <table class="chk_table">
        <tr>
            <th rowspan="2">#</th>
            <th rowspan="2">HN</th>
            <th rowspan="2">����-ʡ��</th>
            <th rowspan="2">����</th>
            <th rowspan="2">���˹ѡ</th>
            <th rowspan="2">��ǹ�٧</th>
            <th rowspan="2">BMI</th>
            <th width="5%" rowspan="2">BP</th>
            <th colspan="14">��¡�õ�Ǩ</th>
            <th width="8%" rowspan="2">��ػ�š�õ�Ǩ</th>
            <th rowspan="2">���й�</th>
            <th rowspan="2">diag</th>
            <th rowspan="2">�ѹ���ŧ����¹</th>
            <th rowspan="2">VN</th>
            <th rowspan="2">�͡ VN ����</th>
            <th rowspan="2">ʶҹ��١��ҧ</th>
            <th rowspan="2">CAMP</th>
            <th rowspan="2">ᾷ��</th>
        </tr>
        <tr>
            <th>X-RAY</th>
            <th>CBC</th>
            <th>UA</th>
            <th>GLU</th>
            <th>CR</th>
            <th>CHOL</th>
            <th>HDL</th>
            <th>HBsAg</th>
            <th>FOBT</th>
            <th>LDL</th>
            <th>BUN</th>
            <th>SGOT</th>
            <th>SGPT</th>
            <th>ALK</th>
        </tr>
        <?php 

        $i = 1;
        foreach ($items as $key => $item) { 

            $style = '';
            $regis_warn = '';

            $test_camp = preg_match('/(�١��ҧ|��Ǩ�آ�Ҿ)/', $item['camp'], $matchs);
            
            // ���ʶҹ�������١��ҧ���ա�õ�Ǩ
            if( $item['employee'] == 'n' && $test_camp > 0 ){
                $regis_warn = 'style="background-color: #fffea7;"';

            }
            
            if( ( $item['employee'] == 'y' OR empty($item['employee']) ) && is_null($item['doctor']) ){
                $style = 'style="background-color: red;"';
            }

            $age = substr($item['age'], 0, 2);

            $bp1 = $item['bp1'];
            $bp2 = $item['bp2'];

            if( !empty($item['bp21']) && $item['bp21'] != '-' ){
                $bp1 = $item['bp21'];
            } 
            if( !empty($item['bp22']) && $item['bp22'] != '-' ){
                $bp2 = $item['bp22'];
            }

            // dump($item['hn']);

            // ��ػ�Ũҡ conclution ���ᾷ��ŧ
            $conclution = $item['conclution'];
            $suggest_date = '';
            if( $conclution == 1 ){
                $suggest_list = array(
                    1 => '����������й�', 
                    '�й�����Ѻ��õ�Ǩ������ͧ ���駵���'
                );

                $suggest = $item['normal_suggest'];
                $suggest_date = ( $item['normal_suggest_date'] != NULL && $item['normal_suggest_date'] != "0000-00-00" ) ? '��ѹ��� '.$item['normal_suggest_date'] : '' ;

                // dump($item['normal_suggest_date']);
                
            }else{
                $suggest_list = array(
                    1 => '����������й�', 
                    '�����й�㹡�õ�Ǩ�Դ���/��Ǩ��� ���駵���', 
                    '�����й�����Ѻ����ѡ�ҡó��纻����¹Ѵ����Ѻ��ԡ��', 
                    '�����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ'
                );

                $suggest = $item['abnormal_suggest'];
                $suggest_date = ( $item['abnormal_suggest_date'] != NULL && $item['abnormal_suggest_date'] != "0000-00-00" ) ? '��ѹ��� '.$item['abnormal_suggest_date'] : '' ;
                
                // dump($item['abnormal_suggest_date']);
            }

            // echo "<hr>";

            $suggest_detail = $suggest_list[$suggest];
            $conclution_detail = $suggest_detail.$suggest_date;

            $yearchk = $item['yearchk'];
            $hn = $item['hn'];
            // �ŵ�Ǩ�������
            $sql = "SELECT b.* 
            FROM ( 

                SELECT MAX(`autonumber`) AS `latest_number` 
                FROM `resulthead` 
                WHERE `hn` = '$hn' 
                AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
                AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�62' 
                GROUP BY `profilecode` 
                ORDER BY `autonumber` ASC 

            ) AS a 
                RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
            WHERE b.`autonumber` = a.`latest_number` 
            AND ( 
                b.`labcode` = 'GLU' 
                OR b.`labcode` = 'CREA' 
                OR b.`labcode` = 'CHOL' 
                OR b.`labcode` = 'HDL' 
                OR b.`labcode` = 'HBSAG' 
                OR b.`labcode` = 'OCCULT' 
                OR b.`labcode` = '38302' 
                OR b.`labcode` = 'LDL' 
                OR b.`labcode` = 'BUN' 
                OR b.`labcode` = 'CR' 
                OR b.`labcode` = 'AST' 
                OR b.`labcode` = 'ALT' 
                OR b.`labcode` = 'ALP' 
            ) 
            ORDER BY b.seq ASC ";

            $db->select($sql);
            $etc_items = $db->get_items();
            
            $etc = array();
            foreach ($etc_items as $key => $lab_item) {
                $labcode = strtolower($lab_item['labcode']);
                $etc[$labcode] = array(
                    'result' => $lab_item['result'], 
                    'normalrange' => $lab_item['normalrange'],
                    'flag' => $lab_item['flag']
                );
            }

            ?>
            <tr <?=$style;?>>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>

                <td><?=$age;?></td>
                <td><?=$item['weight'];?></td>
                <td><?=$item['height'];?></td>
                <td><?=$item['bmi'];?></td>
                <td><?=$bp1.'/'.$bp2;?></td>

                <td><?=( $item['cxr'] == '1' ? '����' : '�Դ����' );?></td>
                <td>
                    <?php
                    if( $item['res_cbc'] == '1' ){
                        echo "����";
                    }else if( $item['res_cbc'] == '2' ){
                        echo "�Դ����";
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $item['res_ua'] == '1' ){
                        echo "����";
                    }else if( $item['res_ua'] == '2' ){
                        echo "�Դ����";
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['glu']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['glu']['normalrange'];?>"><?=$etc['glu']['result'];?></span>
                    </td>
                    <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['crea']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['crea']['normalrange'];?>"><?=$etc['crea']['result'];?></span>
                </td>
                <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['chol']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['chol']['normalrange'];?>"><?=$etc['chol']['result'];?></span>
                </td>
                <td align="right">
                    <?php 
                    $style = '';
                    if( $etc['hdl']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['hdl']['normalrange'];?>"><?=$etc['hdl']['result'];?></span> 
                </td>
                <td>
                    <?php
                    if( $etc['hbsag']['result'] == 'Negative' ){
                        echo '��辺����';
                    }elseif ( $etc['hbsag']['result'] == 'Positive' ) {
                        echo '������';
                    }
                    ?>
                </td>
                <td>
                    <?php
                    if( $etc['occult']['result'] == 'Negative' ){
                        echo '��辺���ʹ';
                    }elseif ( $etc['occult']['result'] == 'Positive' ) {
                        echo '�����ʹ';
                    }
                    ?>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['ldl']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['ldl']['normalrange'];?>"><?=$etc['ldl']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['bun']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['bun']['normalrange'];?>"><?=$etc['bun']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['ast']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['ast']['normalrange'];?>"><?=$etc['ast']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['alt']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['alt']['normalrange'];?>"><?=$etc['alt']['result'];?></span>
                </td>
                <td>
                    <?php 
                    $style = '';
                    if( $etc['alp']['flag'] != 'N' ){
                        $style = 'style="font-weight: bold; color: red;"';
                    }
                    ?>
                    <span <?=$style;?> title="Normal: <?=$etc['alp']['normalrange'];?>"><?=$etc['alp']['result'];?></span>
                </td>

                <td><?=( $item['conclution'] == '1' ? '����' : ( $item['conclution'] == '2' ? '�Դ����' : '' ) );?></td>
                <td><?=$conclution_detail;?></td>

                <td><?=$item['diag'];?></td>
                <td><?=$item['thidate'];?></td>
                <td><?=$item['vn'];?></td>
                <td><?=$item['toborow'];?></td>
                <td <?=$regis_warn;?>><?=$item['employee'];?></td>
                <td><?=$item['camp'];?></td>
                <td><?=$item['doctor'];?></td>
            </tr>


            <?php 
            $i++;
        }
        ?>
    </table>
</div>
<?php 