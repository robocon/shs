<?php
    print "<br>ลบข้อมูลออกจากเตียงในกรณี <br><b><u>รับย้ายผิด หรือรับ admit ผิด</u></b><br>";
    print "<br>";
    print "<b style='color: red;'>ห้าม D/C ผู้ป่วยผ่านเมนูนี้ เพราะจะทำให้ส่วนเก็บเงินผู้ป่วยในไม่สามารถคิดเงินผู้ป่วยได้</b><br>";
    print "<br><a id='move_confirm' target='_self' href='javascript:void(0)' onclick='return check_confirm()'>ยืนยันลบข้อมูลจากเตียงผู้ป่วย</a>";
?>
<script type="text/javascript">
    function check_confirm(){
        var con = confirm("ยืนยันการลบข้อมูลจากเตียงผู้ป่วย");
        if( con !== false ){
            document.getElementById('move_confirm').href = 'wardchg.php';
        }else{
            return false;
        }
    }
</script>