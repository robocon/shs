<?php if( !defined('WARD_STAT') ) die('Access denied'); ?>
<h3>��¡��Ẻ�����</h3>
<table>
    <tr>
        <th>#</th>
        <th>��Ш���͹</th>
        <th>���ѹ�֡</th>
        <th>�ѹ���ѹ�֡</th>
        <th>�Ѵ���</th>
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
            <a href="ward_stat.php?page=form_acu<?=$section;?>&id=<?=$item['id'];?>">[���]</a>&nbsp;
            <a class="remove_link" href="ward_stat.php?action=delete_acu&id=<?=$item['id'];?>">[ź]</a>
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
                var c = confirm('�׹�ѹ����ź������?');
                if( c === false ){
                    return false;
                }
            });
        }
    });
</script>