<?php 
include '../bootstrap.php';
include 'head.php';

$db = Mysql::load();

$id = input('id');
// dump($id);
$sql = "SELECT a.*,b.`discharge`
FROM `43newborn` AS a 
LEFT JOIN `gyn_newborn` AS b ON a.`gyn_id` = b.`id` 
WHERE `gyn_id` = '$id' ";

// dump($sql);

$db->select($sql);
$item = $db->get_item();

// dump($item);

?>
<form action="editFormNewborn.php" method="post">

<table>
    <tr>
        <td>����ʶҹ��ԡ�� : </td>
        <td><input type="text" name="HOSPCODE" value="<?=$item['HOSPCODE'];?>"></td>
    </tr>
    <tr>
        <td>����¹�ؤ���� : </td>
        <td></td>
    </tr>
    <tr>
        <td>�Ţ���ѵû�ЪҪ� : </td>
        <td></td>
    </tr>
    <tr>
        <td>����¹�ؤ����� : </td>
        <td></td>
    </tr>
    <tr>
        <td>������� : </td>
        <td></td>
    </tr>
    <tr>
        <td>���ؤ��������ͤ�ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>�ѹ���-���Ҥ�ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>ʶҹ����ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>�ӴѺ���ͧ��á����ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>�Ըա�ä�ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>���������Ӥ�ʹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>���˹ѡ�á��ʹ : </td>
        <td>����</td>
    </tr>
    <tr>
        <td>���С�âҴ�͡��ਹ : </td>
        <td></td>
    </tr>
    <tr>
        <td>���Ѻ VIT K : </td>
        <td></td>
    </tr>
    <tr>
        <td>���Ѻ��õ�Ǩ TSH : </td>
        <td></td>
    </tr>
    <tr>
        <td>�š�õ�Ǩ TSH</td>
        <td></td>
    </tr>
    <tr>
        <td colspan="2">
            <button type="submit"></button>
        </td>
    </tr>
</table>

</form>