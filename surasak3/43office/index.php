<?php 
include 'head.php';
include '../bootstrap.php';
if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','���ͼ����ҹ���١��ͧ');
    exit;
}
?>
<h1>���ͺ�к��ѹ�֡������43���</h1>
<!--[if lt IE 9]>
<div>
�������ͧ��ҹ����ͧ�Ѻ��÷ӧҹ ��س��Դ��ҹ���� <a href="https://www.google.com/chrome/" target="_blank">Google Chrome</a>, <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Firefox</a> ���� <a href="https://www.microsoft.com/en-us/edge" target="_blank">Microsoft Edge</a>
</div>
<![endif]-->

<?php
include 'footer.php';
?>
