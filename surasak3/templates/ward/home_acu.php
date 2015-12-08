<?php if( !defined('WARD_STAT') ) die('Access denied'); ?>
<h3>รายการแบบฟอร์ม</h3>
<table>
    <tr>
        <th>#</th>
        <th>ประจำเดือน</th>
        <th>ผู้บันทึก</th>
        <th>วันที่บันทึก</th>
        <th>จัดการ</th>
    </tr>
    <?php
    $i = 1;
    foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><?php echo $i;?></td>
        <td><a href="ward_stat.php?page=detail_acu&id=<?=$item['id'];?>"><?=$item['date_write'];?></a></td>
        <td><?=$item['auther'];?></td>
        <td><?=$item['date_add'];?></span></td>
        <td>
            <a href="ward_stat.php?page=form_acu<?=$section;?>&id=<?=$item['id'];?>">[แก้ไข]</a>&nbsp;
            <a class="remove_link" href="ward_stat.php?action=delete_acu&id=<?=$item['id'];?>">[ลบ]</a>
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