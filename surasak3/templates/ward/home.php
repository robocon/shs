<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( isset($_SESSION['x-msg']) ){
    ?><div class="notify-warning"><?php echo $_SESSION['x-msg'];?></div><?php
    unset($_SESSION['x-msg']);
}
?>

<h3>��¡��Ẻ�����</h3>
<table>
    <tr>
        <th>#</th>
        <th>�ͼ�����</th>
        <th>��Ш���͹</th>
        <th>�ѹ���ѹ�֡</th>
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
            <a href="ward_stat.php?page=form<?=$section;?>&id=<?=$item['id'];?>"><?=$item['department'];?></a>
        </td>
        <td><?=$item['date_write'];?></td>
        <td><?=$item['date_add'];?></td>
    </tr>
    <?php
    $i++;
    }
    ?>
</table>
