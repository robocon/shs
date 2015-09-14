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
        <span class="tiny">เมนูย่อย - เภสัช</span>
        <ul class="left nav links">
            <li class="<?php echo $active_menu1;?>"><a href="drugreact_test.php<?php echo $arg; ?>">จัดการผู้ป่วยแพ้ยา</a></li>
            <li class="<?php echo $active_menu2;?>"><a href="manage_interaction.php<?php echo $arg; ?>">จัดการแพ้ยาข้ามกลุ่ม</a></li>
        </ul>
    </div>
</div>