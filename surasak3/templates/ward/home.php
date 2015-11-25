<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( isset($_SESSION['x-msg']) ){
    ?><div class="notify-warning"><?php echo $_SESSION['x-msg'];?></div><?php
    unset($_SESSION['x-msg']);
}
?>

<h3>รายการแบบฟอร์ม</h3>
<table>
    <tr>
        <th>#</th>
        <th>หอผู้ป่วย</th>
        <th>ประจำเดือน</th>
        <th>วันที่บันทึก</th>
        <th>จัดการ</th>
    </tr>
    <?php
    $i = 1;
    foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><?php echo $i;?></td>
        <td>
            <?php
            $section = '';
            if( $item['type'] === 'obgyn' ) $section = '&view=obgyn';
            ?>
            <a href="ward_stat.php?page=detail<?=$section;?>&id=<?=$item['id'];?>"><?=$item['department'];?></a>
        </td>
        <td><?=$item['date_write'];?></td>
        <td><span title="บันทึกข้อมูลโดย <?=$item['author'];?>"><?=$item['date_add'];?></span></td>
        <td>
            <a href="ward_stat.php?page=form<?=$section;?>&id=<?=$item['id'];?>">[แก้ไข]</a>&nbsp;
            <a class="remove_link" href="ward_stat.php?action=delete&id=<?=$item['id'];?>">[ลบ]</a>
        </td>
    </tr>
    <?php
    $i++;
    }
    ?>
</table>
<script type="text/javascript">
    $(function(){
        if( $('.remove_link').length > 0 ){
            $(document).on('click', '.remove_link', function(){
                var c = confirm('ยืนยันที่จะลบข้อมูล?');
                if( c === false ){
                    return false;
                }
            });
        }
    });
</script>