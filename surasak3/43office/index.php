<?php 
include 'head.php';
include '../bootstrap.php';
if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','���ͼ����ҹ���١��ͧ');
    exit;
}

?>
<h1>���ͺ�к��ѹ�֡������43���</h1>
<?php
include 'footer.php';
?>
