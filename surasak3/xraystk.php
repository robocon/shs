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
<p><b>�ѹ����͡�����</b> : <?=$date;?></p>
<p><b>HN</b> : <?=$hn;?> <b>����-ʡ��</b> : <?=$name;?></p>
<p><b>����͡�����</b> : <?=$detail;?></p>
<script>
window.onload = function(){
    window.print();
}
</script>