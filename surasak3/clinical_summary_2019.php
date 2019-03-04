<?php 

include 'bootstrap.php';

$db = Mysql::load();

?>

<style>
*{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 14pt;
}
p{
    margin: 0;
    padding: 0;
}
@media print{
    .form_container{
        display: none;
    }
}
</style>

<?php 

$an = input('an');
$sql = "SELECT a.*,b.`yot`,b.`idcard`,b.`dbirth` 
FROM `ipcard` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`an` = '$an' ";
$db->select($sql);

$item = $db->get_item();

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

<div style="position: relative; padding: 3px;">
    <div style="text-align: center; font-size: 16pt;">Clinical  Summary</div>
    <div style="text-align: center; font-size: 16pt;">�ç��Һ�Ť�������ѡ��������  �ѧ��Ѵ�ӻҧ</div>

    <div style="position: absolute; top: 0; right: 0;">MR � IPD - 002 (2)</div>
    <div style="position: absolute; top: 14pt; right: 0;">������� �ѹ��� 4 ��.�. 62</div>
    <div>&nbsp;</div>
    <div>
        <table style="width: 100%;">
            <tr>
                <td>Name: <?=$item['ptname'];?></td>
                <td>HN: <?=$item['hn'];?></td>
                <td>AN: <?=$item['an'];?></td>
                <td>Sex: <?=$gender;?></td>
            </tr>
            <tr>
                <td>�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: <?=$item['idcard'];?></td>
                <td>�Է�ԡ���ѡ��: <?=$item['ptright'];?></td>
                <td>&nbsp;</td>
                <td>DOB: <?=$item['dbirth'];?></td>
            </tr>
        </table>
    </div>
    <div>
        <p style="word-wrap: break-word;">Principle  Diagnosis <?=create_dot(195);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div><p>Lab <?=create_dot(223);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div><p>Treatment  &  Operation <?=create_dot(186);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div><p>Home Medication <?=create_dot(197);?></p></div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
    </div>
    <div>
        <p style="word-wrap: break-word;"><?=create_dot(231);?></p>
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