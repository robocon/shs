<?php
include("connect.php");
$cRow = $_GET['cRow'];
$query = sprintf("UPDATE appoint SET apptime = 'ยกเลิกการนัด' WHERE  row_id = '%s' LIMIT 1;", mysql_real_escape_string($cRow));
$result = mysql_query($query) or die("Query failed");
if ($result) {
    echo "ยกเลิกการนัดเรียบร้อย<br>";
    echo "ปิดหน้าต่างนี้";
}else{
    echo "ยกเลิกนัดไม่สำเร็จ ".mysql_error();
}
?>
<input type="hidden" id="checkClose" value="1">
<script>
    window.onload = function(){
        document.getElementById('checkClose').focus();
        // ทำงานหลังจาก window.onload
        window.onbeforeunload = function(){ 

            parent.window.opener.doRefresh();
            return '';

        }
    }
</script>