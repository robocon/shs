<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date');

if( isset($_SESSION['x-msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px; text-align: center;"><?=$_SESSION['x-msg'];?></p><?php
    unset($_SESSION['x-msg']);
}

?>
<div style="text-align: center; padding: 10px;">
    <a href="chk_doctor_sticker.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">�����ʵԡ����Դ OPD</a> | 
    <a href="chk_doctor_print.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">��������§ҹ�ŵ�Ǩ�آ�Ҿ</a>
</div>
<div style="text-align: center; padding: 10px;">
    <a href="dt_emp_manual_index.php">��Ѻ�˹�� ��Ǩ�آ�Ҿ�١��ҧ þ.����� ��61(Ẻ����ͧ�� VN)</a>
</div>