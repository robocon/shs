<?php

include 'bootstrap.php';
$db = Mysql::load();

$part = input_get('part'); 


$sql = "SELECT * FROM `out_result_chkup` WHERE `part` = '$part' ";
$db->select($sql);
$items = $db->get_items();

// ��һէ�
$db->select($sql." LIMIT 1 ORDER BY `row_id`");
$get_year = $db->get_item();
$test_year_chk = $get_year['year_chk'];

// ��� labcode �ͧ lab ���� �������� UA �Ѻ CBC
$sql = "SELECT e.`labcode`,e.`labname`  
FROM ( 
    SELECT MAX(b.`autonumber`) AS `latest_id`, b.`profilecode` 
    FROM ( 

        SELECT * FROM `opcardchk` WHERE `part` = '$part' 

    ) AS a 
    LEFT JOIN `resulthead` AS b 
        ON b.`hn` = a.`hn` 
    WHERE b.`clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$test_year_chk' 
    AND ( b.`profilecode` != 'UA' AND b.`profilecode` != 'CBC' ) 
    GROUP BY b.`profilecode`
) AS c 
LEFT JOIN `resulthead` AS d ON d.`autonumber` = c.`latest_id` 
LEFT JOIN `resultdetail` AS e ON e.`autonumber` = c.`latest_id` 
ORDER BY e.`labcode` ASC";

$db->select($sql);
$get_headers = $db->get_items();

?>

<style>
*{
    font-family: TH SarabunPSK;
    font-size: 12pt;
}

.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<table class="chk_table" style="width: 300%">
    <tr>
        <th>HN</th>
        <th>����-ʡ��</th>
        <th>����</th>
        <th>���˹ѡ</th>
        <th>��ǹ�٧</th>
        <th>BMI</th>
        <th>SYS</th>
        <th>DIA</th>
        <th>T</th>
        <th>P</th>
        <th>R</th>
        <th>�ŵ�Ǩ</th>

        <th>WBC Result</th>
        <th>WBC Range</th>
        <th>WBC ��ػ</th>

        <th>NEU Result</th>
        <th>NEU Range</th>
        <th>NEU ��ػ</th>

        <th>LYMP Result</th>
        <th>LYMP Range</th>
        <th>LYMP ��ػ</th>

        <th>EO Result</th>
        <th>EO Range</th>
        <th>EO ��ػ</th>

        <th>HCT Result</th>
        <th>HCT Range</th>
        <th>HCT ��ػ</th>

        <th>PLTC Result</th>
        <th>PLTC Range</th>
        <th>PLTC ��ػ</th>

        <th>SPGR Result</th>
        <th>SPGR Range</th>
        <th>SPGR ��ػ</th>

        <th>PRO Result</th>
        <th>PRO Range</th>
        <th>PRO ��ػ</th>

        <th>GLU Result</th>
        <th>GLU Range</th>
        <th>GLU ��ػ</th>

        <th>WBC Result</th>
        <th>WBC Range</th>
        <th>WBC ��ػ</th>

        <th>RBC Result</th>
        <th>RBC Range</th>
        <th>RBC ��ػ</th>

        <?php 
        $etc_where_txt = array();
        $etc_all_labcode = array();
        foreach ($get_headers as $key => $head) { 
            $etc_where_txt[] = "c.`labcode` = '".$head['labcode']."'";
            $etc_all_labcode[] = $head['labcode'];

            ?>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> Result</th>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> Range</th>
            <th><?=$head['labcode'].' ('.$head['labname'].')';?> ��ػ</th>
            <?php
        }
        ?>
    </tr>

<?php

foreach ($items as $key => $item) {

    $hn = $item['hn'];
    $year_chk = $item['year_chk'];

    // ��Ǩ��ҧ��·���� //
    // �Ѫ����š��
    $ht = $item['height']/100;
	$bmi = number_format($item['weight'] /($ht*$ht),2);
    $bmi_txt = false;
    if($bmi == '0.00' ){
        $bmi_txt = "������Ѻ��õ�Ǩ";
    } else if($bmi >= 18.5 && $bmi <= 22.99){
        $bmi_txt = "�չ��˹ѡ���ࡳ��";
    }else{
        if($bmi < 18.5){ $bmi_txt = "�չ��˹ѡ��ӡ���ࡳ��";}
        if($bmi >= 23 && $bmi <= 24.99){ $bmi_txt = "������չ��˹ѡ�Թࡳ��";}
        if($bmi >= 25 && $bmi <= 29.99){ $bmi_txt = "�չ��˹ѡ�Թࡳ��";}
        if($bmi >= 30 && $bmi <= 34.99){ $bmi_txt = "��������ǹ��͹��ҧ�ҡ";}
        if($bmi >= 35){ $bmi_txt = "��������ǹ�ҡ";}
    }

    // �����ѹ���Ե
    $bp1 = ( empty($item['bp3']) ) ? $item['bp1'] : $item['bp3'];
    $bp2 = ( empty($item['bp4']) ) ? $item['bp2'] : $item['bp4'];
    $bp_txt = false;
    if($bp1 =='NO'){
        $bp_txt = "������Ѻ��õ�Ǩ";
    }else  if($bp1 <= 130){
        $bp_txt = "����";
    }else{
        if($bp1 >=140){ 
            $bp_txt = "�դ����ѹ���Ե�٧ ����͡���ѧ���ҧ�������� Ŵ����÷��������� ���;�ᾷ�����ͷӡ���ѡ��";
        }else if($bp1 >=131 && $bp1 < 140){
            $bp_txt = "����������Ф����ѹ���Ե�٧ ����͡���ѧ������ҧ��������";
        }
    }

    $body_res = '�Ѫ����š�� '.$bmi_txt.' / �����ѹ���Ե '.$bp_txt;
    // ��Ǩ��ҧ��·���� //


    // CBC // 
    $sql = " SELECT c.* 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `profilecode` = 'CBC' 
        AND `hn` = '$hn' 
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_chk' 
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 
    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    WHERE ( 
		c.labcode = 'WBC' 
		|| c.labcode ='EOS' 
		|| c.labcode ='HCT' 
		|| c.labcode ='PLTC' 
		|| c.labcode ='NEU' 
		|| c.labcode ='LYMP' 
	) 
    ORDER BY a.`autonumber` ASC, c.`seq` ASC";
    $cbc_query = mysql_query($sql) or die( mysql_error() );
    
    
    // UA // 
    $sql = " SELECT c.* 
    FROM ( 
        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `profilecode` = 'UA' 
        AND `hn` = '$hn' 
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_chk' 
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 
    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    WHERE ( 
		c.labcode ='SPGR' 
		|| c.labcode ='PHU' 
		|| c.labcode ='GLUU' 
		|| c.labcode ='PROU' 
		|| c.labcode ='WBCU' 
		|| c.labcode ='RBCU' 
	) 
    ORDER BY a.`autonumber` ASC, c.`seq` ASC";
    $ua_query = mysql_query($sql) or die( mysql_error() );

    
    // Lab ���� �������͡�˹�ͨҡ CBC ��� UA
    $etc_where = 'WHERE ( '.implode(' || ', $etc_where_txt).' )';
    
    $sql = "SELECT c.* 
    FROM ( 

        SELECT *, MAX(`autonumber`) AS `latest_id`  
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_chk' 
        AND ( `profilecode` != 'UA' AND `profilecode` != 'CBC' )
        GROUP BY `profilecode` 
        ORDER BY `autonumber` ASC 

    ) AS a 
    LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
    LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
    $etc_where 
    ORDER BY c.`labcode` ASC";
    $db->select($sql);
    $etc_lab = $db->get_items();

    $etc_all_result = array();
    foreach ($etc_lab as $key => $value) {
        $key = $value['labcode'];

        $etc_all_result[$key] = array(
            'result' => $value['result'], 
            'normalrange' => $value['normalrange'], 
            'flag' => $value['flag']
        );
    }
    
        
    ?>
    <tr>

        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['weight'];?></td>
        <td><?=$item['height'];?></td>
        <td><?=$bmi;?></td>
        <td><?=$bp1;?></td>
        <td><?=$bp2;?></td>
        <td><?=$item['temp'];?></td>
        <td><?=$item['p'];?></td>
        <td><?=$item['rate'];?></td>
        <td><?=$body_res;?></td>
        
        <?php
        while( $cbc = mysql_fetch_assoc($cbc_query) ) {

            $flag = '����';
            if( $cbc['flag'] != 'N' ){
                $flag = '�Դ����';
            }

            ?>
            <td><?=$cbc['result'];?></td>
            <td><?=$cbc['normalrange'];?></td>
            <td><?=$flag;?></td>
            <?php
        }
        ?>

        <?php
        while( $ua = mysql_fetch_assoc($ua_query) ) {

            $flag = '����';
            if( $ua['flag'] != 'N' ){
                $flag = '�Դ����';
            }

            ?>
            <td><?=$ua['result'];?></td>
            <td><?=$ua['normalrange'];?></td>
            <td><?=$flag;?></td>
            <?php
        }
        ?>

        <?php
        
        foreach( $etc_all_labcode AS $key => $etc_item ){
            
            // dump($key);

            $etc = $etc_all_result[$etc_item];
            $app = '';

            if( $etc_item == 'GLU'){
                if( $etc["result"] >= 74 && $etc["result"] <= 106 ){
                    $app="�дѺ��ӵ������ʹ�դ�������ࡳ�컡��";
                }else if( $etc["result"] > 106 && $etc["result"] <= 125 ){
                    $app="�дѺ��ӵ������ʹ�դ���٧�Դ����";
                }else if( $etc["result"] > 125 ){
                    $app="�дѺ��ӵ������ʹ�դ���٧�ҡ�Դ����";	
                }else if( $etc["result"] < 74 ){
                    $app="�дѺ��ӵ������ʹ�դ�ҵ�ӼԴ����";	
                }
            }

            if($etc_item == 'BUN'){
                if($etc["result"]>18){
                    $app="�Դ���� ��äǺ�������÷����������٧ ����������٧ �� �� ������ʧ �ͧ����ء��Դ";	
                }else if($etc["result"]>=7 && $etc["result"]<=18){
                    $app="��÷ӧҹ�ͧ��դ�������ࡳ�컡��";	
                }else if($etc["result"]<7 ){
                    $app="�Դ���� ��÷ӧҹ�ͧ䵵�ӡ��һ���";	
                }
                
            }

            if($etc_item == 'CREA'){
                if($etc["result"]>1.3){
                    $app="�Դ���� ��äǺ�������÷����������٧ ����������٧ �� �� ������ʧ �ͧ����ء��Դ";	
                }else if($etc["result"]>=0.6 && $etc["result"]<=1.3){
                    $app="��÷ӧҹ�ͧ��դ�������ࡳ�컡��";	
                }else if($etc["result"]<0.6){
                    $app="�Դ���� ��÷ӧҹ�ͧ䵵�ӡ��һ���";	
                }
            }

            if($etc_item == 'URIC'){
                if($etc["result"]>7.2){
                    $app="�Դ���� ��ç�����ͧ�����������š����� ����ͧ��ѵ�� �ѵ��ա";	
                }else if($etc["result"] >=2.6 && $etc["result"] <=7.2){
                    $app="�дѺ�ô���Ԥ�դ�������ࡳ�컡��";	
                }else if($etc["result"] > 0 && $etc["result"]<2.6){
                    $app="�Դ���� �дѺ�ô���Ԥ��ӡ��һ���";	
                }
            }


            if($etc_item == 'CHOL'){
                if($etc["result"]<=200){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>200){
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }else	if($etc["result"]>300){
                    $app="�Դ���� �дѺ��ѹ����ʹ�٧�ҡ�Դ���� ��û�֡��ᾷ��";	
                }
            }

            if($etc_item == 'HDL'){
                if($etc["result"]>=40 && $etc["result"]<=60){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>60){  //�٧��
                    $app="������дѺ HDL �٧ �з����Ŵ��������§����ä������ʹ���㨵պ";	
                }else	if($etc["result"]<40){  //�������
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }
            }

            if($etc_item == 'TRIG'){
                if($etc["result"]<=150){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>150 && $etc["result"]<250){
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }else	if($etc["result"]>250){
                    $app="�Դ���� �дѺ��ѹ����ʹ�٧�ҡ�Դ���� ��û�֡��ᾷ��";	
                }
            }

            if($etc_item == '10001'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>100){
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }
            }

            if($etc_item == 'LDL'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>100){
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }
            }

            if($etc_item == 'LDLC'){
                if($etc["result"]>=0 && $etc["result"]<=100){
                    $app="�дѺ��ѹ����ʹ�դ�������ࡳ�컡��";	
                }else	if($etc["result"]>100){
                    $app="�Դ���� ��û�Ѻ�ĵԡ�������Ѻ��зҹ����� ����͡���ѧ������ҧ��������";	
                }
            }

            if($etc_item == 'AST'){  //SGOT
                if($etc["result"]>=15 && $etc["result"]<=37){
                    $app="��÷ӧҹ�ͧ�Ѻ����";	
                }else	if($etc["result"]>37){
                    $app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
                }else	if($etc["result"]<15){
                    $app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
                }
            }
            if($etc_item == 'ALT'){  //SGPT
                if($etc["result"]>=0 && $etc["result"]<=50){
                    $app="��÷ӧҹ�ͧ�Ѻ����";		
                }else{
                    $app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
                }
            }

            if($etc_item == 'ALP'){  //ALK
                if($etc["result"]>=46 && $etc["result"]<=116){
                    $app="��÷ӧҹ�ͧ�Ѻ����";	
                }else	if($etc["result"]>116){
                    $app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
                }else	if($etc["result"]<46){
                    $app="��÷ӧҹ�ͧ�Ѻ�Դ����";	
                }
            }

            if($etc_item == 'HBSAG'){  //HBSAG
                if($etc["result"]=="Negative"){
                    $app="����";	
                }else if($etc["result"]=="Positive"){
                    $app="��Ǩ����õԴ��������ʵѺ�ѡ�ʺ��Դ";	
                }
            }

            if($etc_item == 'ANTIHB'){  //HBSAB
                if($etc["result"]=="Negative"){
                    $app="����";	
                }else if($etc["result"]=="Positive"){
                    $app="�Դ����";	
                }
            }

            if($etc_item == 'OCCULT'){  //STOCB
                if($etc["result"]=="Negative"){
                    $app="����";	
                }else if($etc["result"]=="Positive"){
                    $app="�Դ����";	
                }
            }

            if($etc_item == 'METAMP'){  //METAMP
                if($etc["result"]=="Negative"){
                    $app="����";	
                }else if($etc["result"]=="Positive"){
                    $app="�Դ����";	
                }
            }
            

            ?>
            <td><?=$etc['result'];?></td>
            <td><?=$etc['normalrange'];?></td>
            <td><?=$app;?></td>
            <?php
        }
        ?>

    </tr>
    <?php

    // echo "<hr>";
}
?>
</table>
