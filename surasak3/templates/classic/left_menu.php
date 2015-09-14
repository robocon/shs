<?php 
$arg = ( $hn !== false ) ? "?hn=$hn" : '' ;

$info = new SplFileInfo($_SERVER['PHP_SELF']);
$file_name = $info->getFilename();
$active_menu1 = $active_menu2 = '';

if( $file_name === 'drugreact_test.php' ){
    $active_menu1 = 'active';
}elseif ( $file_name === 'manage_interaction.php' ) {
    $active_menu2 = 'active';
}

?>
<div class="col width-1of4">
    <div class="cell menu">
        <span class="tiny">�������� - ���Ѫ</span>
        <ul class="left nav links">
            <li class="<?php echo $active_menu1;?>"><a href="drugreact_test.php<?php echo $arg; ?>">�Ѵ��ü���������</a></li>
            <li class="<?php echo $active_menu2;?>"><a href="manage_interaction.php<?php echo $arg; ?>">�Ѵ������Ң��������</a></li>
        </ul>
    </div>
</div>