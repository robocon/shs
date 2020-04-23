<?php 
require_once 'bootstrap.php';

$db = Mysql::load();
$action = input_get('action');
$cHn = input_get('cHn');
$dateTh = (date('Y')+543).date('-m-d');

if ($action == 'update') {

    $id = input_get('id');
    $hn = input_get('cHn');
    $msg = '�ѹ�֡���������º����';
    $sql = "UPDATE `ipcard` SET `dcdate` = '$dateTh 00:00:00' WHERE `row_id` = '$id' ";
    $update = $db->update($sql);
    redirect('remove_admit.php?cHn='.$hn, $msg);
    exit;
}

$sql = "SELECT * FROM `ipcard` WHERE `hn` = '$cHn' ORDER BY `row_id` DESC";
$db->select($sql);
$items = $db->get_items();

?>
<style>
/* ���ҧ */
body, button{font-family: "TH Sarabun New", "TH SarabunPSK";font-size: 16pt;}
.chk_table{border-collapse: collapse;}
.chk_table th, .chk_table td{padding: 3px;border: 1px solid black;font-size: 16pt;}
</style>
<div>
    <h1>¡��ԡ�������</h1>
</div>
<?php 
if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}
?>
<table class="chk_table">
    <tr>
        <th>�ѹ���</th>
        <th>AN</th>
        <th>D/C</th>
        <th>HN</th>
        <th>����-ʡ��</th>
        <th>�ͼ�����/��§</th>
        <th>Diag</th>
        <th>ᾷ��</th>
        <th>�Ѵ���</th>
    </tr>
<?php
foreach ($items as $key => $item) { 
    $color = $onclick = '';
    $id = $item['row_id'];
    $hn = $item['hn'];
    if ( !empty($item['bedcode']) ) {
        $color = 'style="background-color: yellow;"';
        $onclick = 'onclick="return alertNoti();"';
    }
    ?>
    <tr <?=$color;?> >
        <td><?=$item['date'];?></td>
        <td><?=$item['an'];?></td>
        <td><?=$item['dcdate'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['bedcode'];?></td>
        <td><?=$item['diag'];?></td>
        <td><?=$item['doctor'];?></td>
        <td><a href="remove_admit.php?action=update&id=<?=$id;?>&cHn=<?=$hn;?>" <?=$onclick;?> >¡��ԡ</a></td>
    </tr>
    <?php
}
?>
</table>
<script>
function alertNoti(){
    alert("�����¶١�Ӣ����§���º�������� ��سһ���ҹ�������ͷӡ�� D/C");
    return false;
}
</script>
<?php 

// exit;
// if( $item['bedcode'] === NULL ){
//     $sql = "UPDATE `ipcard` SET `dcdate` = '$dateTh 00:00:00' WHERE `hn` = '$hn' AND `an` = '$an' ";
// }elseif ($item['bedcode'] !== NULL) {
//     echo "�����¶١�Ӣ����§���º�������� ��سһ���ҹ�������ͷӡ�� D/C";
// }
