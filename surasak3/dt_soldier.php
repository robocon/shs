<?php 
session_start();

include "connect.inc";
include "checklogin.php";

?>

<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}
.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.font3 {
	font-size: 18px;
}
</style>

<?php
include "dt_menu.php";
include "dt_patient.php";


$types = array(
    1 => '�ä���ͤ����Դ���Ԣͧ��',
    'items' => array(
        '�' => '�Ң�ҧ㴢�ҧ˹�觺Դ ���������ѡ���������µҴ�����蹵����ǡ���ͧ����ѧ������дѺ��ӡ��� 3/60 �����ҹ��µ��������᤺���� 10 ͧ��',
        '�' => '',
        '�' => '',
        '�' => '',
        '�' => '',
        '�' => '',
        '�' => '',
        '�' => '',
    ),
    99 => '',
    'items' => array(
        '�' => '',
        '�' => '',
        '�' => '',
        'attributes' => array(
            1 => '',
            2 => '',
            3 => ''
        )
    )
);
?>
<select name="" id="">
    <option value="">���͡������ ����з�ǧ</option>
    <option value="">1 (�)</option>
    <option value="">1 (�)</option>
    <option value="">1 (�)</option>
</select>