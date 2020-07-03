<?php 
$date = urldecode($_GET['date']);
$name = urldecode($_GET['name']);
$hn = urldecode($_GET['hn']);
$detail = urldecode($_GET['detail']);
?>
<style>
*{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 13pt;
}
body,p{
    margin: 0;
    padding: 0;
}
</style>
<p><b>วันที่เอกซเรย์</b> : <?=$date;?></p>
<p><b>HN</b> : <?=$hn;?> <b>ชื่อ-สกุล</b> : <?=$name;?></p>
<p><b>ท่าเอกซเรย์</b> : <?=$detail;?></p>
<script>
window.onload = function(){
    window.print();
}
</script>