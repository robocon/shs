<?php 
$arg = ( $hn !== false ) ? "?hn=$hn" : '' ;   
?>
<div class="col width-1of4">
    <div class="cell menu">
        <span class="tiny">เมนูย่อย - เภสัช</span>
        <ul class="left nav links">
            <li class="active"><a href="drugreact_test.php<?php echo $arg; ?>">จัดการผู้ป่วยแพ้ยา</a></li>
            <li><a href="manage_interaction.php<?php echo $arg; ?>">จัดการแพ้ยาข้ามกลุ่ม</a></li>
        </ul>
    </div>
</div>