<?php 

include 'bootstrap.php';

$db = Mysql::load();

// $db->set_charset("TIS620");
?>

<style>
body{
    margin: 0;
    padding: 0;
}
*{
    font-family: "TH Sarabun New", "TH SarabunPSK";
    font-size: 11pt;
}
p{
    margin: 0;
    padding: 0;
}
.tb_normal_line td{
    line-height: 11pt;
}
.tb_info td{
    font-size: 14pt;
    line-height: 14pt;
}
@media print{
    .form_container{
        display: none;
    }
}
</style>

<?php 

$an = input('an');
$sql = "SELECT a.*,b.`yot`,b.`name`,b.`surname`,b.`idcard`,b.`dbirth`,b.`ptright` AS `ptright2` 
FROM `ipcard` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`an` = '$an' ";
$db->select($sql);

$item = $db->get_item();

$ptname = $item['yot'].$item['name'].' '.$item['surname'];

$match = preg_match('/(�ҧ|˭ԧ|�.�|�.�|ms|mis)/', $item['yot'], $matchs);
$gender = '���';
if( $match > 0 ){
    $gender = '˭ԧ';
}

function create_dot($dot_num){ 
    $dot_txt = '';
    for ($i=0; $i < $dot_num; $i++) { 
        $dot_txt .= '.';
    }
    return $dot_txt;
}

?>

<div style="position: relative; padding: 10px;">
    <div style="text-align: center; font-size: 16pt;">Clinical  Summary</div>
    <div style="text-align: center; font-size: 16pt;">�ç��Һ�Ť�������ѡ��������  �ѧ��Ѵ�ӻҧ</div>

    <div style="position: absolute; top: 10px; right: 10px;">MR � IPD - 002 (2)</div>
    <div style="position: absolute; top: 24px; right: 10px;">������� �ѹ��� 4 ��.�. 62</div>
    <div>&nbsp;</div>
    <div>
        <table style="width: 100%;" class="tb_info">
            <tr>
                <td width="35%">Name: <?=$ptname;?></td>
                <td width="40%">HN: <?=$item['hn'];?></td>
                <td width="10%">AN: <?=$item['an'];?></td>
                <td width="15%">Sex: <?=$gender;?></td>
            </tr>
            <tr>
                <td>�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: <?=$item['idcard'];?></td>
                <td>�Է�ԡ���ѡ��: <?=$item['ptright2'];?></td>
                <td>&nbsp;</td>
                <td>DOB: <?=$item['dbirth'];?></td>
            </tr>
        </table>
    </div>
    <div>
        <p style="word-wrap: break-word;">Principle  Diagnosis <?=create_dot(280);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div><p>Lab <?=create_dot(308);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div><p>Treatment  &  Operation <?=create_dot(271);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div><p>Home Medication <?=create_dot(282);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(316);?></p>
    </div>
    <div>&nbsp;</div>
    <div style="text-align: right;">ᾷ�����ѡ��..............................................................................</div>
    <div style="text-align: right;">(...........................................................................)</div>
</div>
<script>
window.onload = function(){
    window.print();
}
</script>