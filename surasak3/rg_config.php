<?php
include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action === 'save' ){

    $prefix = input_post('book_id');
    $runno = input_post('number_id');

    $sql = "UPDATE `runno` SET 
    `prefix` = '$prefix',
    `runno` = '$runno',
    `startday` = NOW()
    WHERE `title` = 'rg_sol';";
    $update = $db->update($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $update !== true ){
		$msg = errorMsg('update', $update['id']);
    }

    redirect('rg_config.php', $msg);
    exit;
}

include 'rg_menu.php';

$sql = "SELECT * FROM `runno` WHERE `title` = 'rg_sol' ";
$db->select($sql);
$runno = $db->get_item();
$book_id = $runno['prefix'];
$number_id = sprintf('%03d', ($runno['runno']) );

?>
<div class="claearfix">
    <h3>ตั้งค่า เล่มที่ เลขที่ สำหรับแบบฟอร์มบันทึกข้อมูล ตรช.</h3>
    <div>
        <form action="rg_config.php" method="post">
            <table>
                <tr>
                    <td>เล่มที่ : </td>
                    <td>
                        <input type="text" name="book_id" id="" value="<?=$book_id;?>">
                    </td>
                </tr>
                <tr>
                    <td>เลขที่ : </td>
                    <td>
                    <input type="text" name="number_id" id="" value="<?=$number_id;?>">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">บันทึกข้อมูล</button>
                        <input type="hidden" name="action" value="save">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
