<?php
include 'bootstrap.php';

$def_month_start = ( date('Y')+543 ).'-'.date('m');

$action = input_post('action');
$month_start = input_post('month_start', $def_month_start);
$month_end = input_post('month_end', $def_month_start);

?>
<style type="text/css">
@media print{
    #userForm{
        display: none;
    }
}
table {
    border-collapse: collapse;
}
table, th, td {
    border: 1px solid black;
    padding: 2px;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt; ˹����ѡþ.</a>
</div>
<h3>��§ҹ�����ż������ Refer �����͹</h3>
<form action="refer_months.php" method="post" id="userForm">
    <div>
        ���͡��͹ <input type="text" name="month_start" value="<?=$month_start;?>">
        �֧��͹ <input type="text" name="month_end" value="<?=$month_end;?>">
        <br>
        <span>������ҧ �ٻẺ��������͹ �� 2560-02</span>
    </div>
    <div>
        <button type="submit">��ŧ</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<?php
if ( $action === 'show' ) {

    $sections = array(
		'opd' => 'OPD', 
		'opd_obg' => '�ٵ�', 
		'opd_eye' => '��ͧ��', 
		'ER' => '��ͧ�ء�Թ',
		'Ward42' => 'Ward ���',
		'Ward43' => 'Ward �ٵ�',
		'Ward44' => 'Ward ICU',
		'Ward45' => 'Ward �����',
	);

    $db = Mysql::load();
    $sql = "SELECT *, CONCAT(`name`,' ',`sname`) AS `ptname` 
    FROM `refer` 
    WHERE `an` != '' 
    AND ( `dateopd` >= '$month_start' AND `dateopd` <= '$month_end' ) ";
    $db->select($sql);
    $items = $db->get_items();
    if( count($items) > 0 ){
        ?>
        <table>
            <thead>
                <tr>
                    <th>�ŢRefer</th>
                    <th>AN</th>
                    <th>HN</th>
                    <th>����-ʡ��</th>
                    <th>�ѹ��� Refer</th>
                    <th>�ҡ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($items as $key => $item) {
                
                $ward = $item['ward'];

                if( preg_match('/^Ward(\d{2,})/', $ward, $match) > 0 ){
                    $ward_key = $match['0'];
                    $by = $sections[$ward_key];
                }else{
                    switch($ward){
                        case "opd" : $by = "��ͧ��Ǩ�ä"; break;  
                        case "opd_eye" : $by = "�ѡ��"; break;
                        case "opd_obg" : $by = "�ٵ�"; break;
                        case "ER" : $by = "ER"; break;
                    }
                }

                $refer_no = $item['refer_runno'];
                $an = $item['an'];
                $hn = $item['hn'];
                $ptname = $item['ptname'];
                $dateopd = $item['dateopd'];
                
                ?>
                <tr>
                    <td><a href="ward_follow_refer_detail.php?id=<?=urlencode($refer_no);?>" target="_blank"><?=$refer_no;?></a></td>
                    <td><?=$an;?></td>
                    <td><?=$hn;?></td>
                    <td><?=$ptname;?></td>
                    <td><?=$dateopd;?></td>
                    <td><?=$by;?></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }else{
        ?>
        <p>��辺�����ŷ���ͧ��ä���</p>
        <?php
    }
}

