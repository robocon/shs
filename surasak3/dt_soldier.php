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
    1 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '�Ң�ҧ㴢�ҧ˹�觺Դ ���������ѡ���������µҴ�����蹵����ǡ���ͧ����ѧ������дѺ��ӡ��� 3/60 �����ҹ��µ��������᤺���� 10 ͧ��',
            '�' => '��µ���軡�� ���������ѡ���������µҴ���������� ����ͧ����ѧ������дѺ 6/24 ���͵�ӡ��ҷ���ͧ��ҧ',
            '�' => '��µ�����ҡ���� 8 ��ͻ���� ������µ�����ҡ���� 5 ��ͻ���� ����ͧ��ҧ',
            '�' => '�����ǵҷ���ͧ��ҧ (Bilateral Cataract)',
            '�' => '����Թ (Glaucoma)',
            '�' => '�ä���ǻ���ҷ����������� 2 ��ҧ (Optic Atrophy)',
            '�' => '���ǻ���ҷ���ѡ�ʺ������ѧ���͢�蹷���ͧ��ҧ',
            '�' => '����ҷ�������͹����١�����ӧҹ�٭�������ҧ���� (Cranial never 3 , 4 , 6)'
        )
    ),
    2 => array(
        'title' => '�ä���ͤ����Դ���Ԣͧ��',
        'items' => array(
            '�' => '��˹ǡ����ͧ��ҧ ��͵�ͧ�����§㹪�ǧ���蹤������ 500-2,000 �ͺ����Թҷ������Թ���� 55 ഫ��� �֧�����Թ����ͧ��ҧ',
            '�' => '�٪�鹡�ҧ�ѡ�ʺ������ѧ����ͧ��ҧ',
            '�' => '���������ٷ��ط���ͧ��ҧ'
        )
    ),
    3 => array(
        'title' => '�ä�ͧ���������ʹ���ʹ',
        'items' => array(
            '�' => '����������ʹ���ʹ�ԡ�����ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '������㨾ԡ��',
            '�' => '����鹢ͧ���㨼Դ�������ҧ���� ���Ҩ�Դ�ѹ���������ç',
            '�' => '�ä�ͧ������������㨹Դ����������ö�ѡ�������¢Ҵ������Ҩ���ѹ����',
            '�' => '��ʹ���ʹᴧ�˭��觾ͧ',
            '�' => '��ʹ���ʹ���㹡����š������觾ͧ���ͼԴ���Ԫ�Դ����Ҩ���ѹ����'
        )
    )





    99 => array(
        'title' => '',
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
    )
);
?>
<select name="" id="">
    <option value="">���͡������ ����з�ǧ</option>
    <option value="">1 (�)</option>
    <option value="">1 (�)</option>
    <option value="">1 (�)</option>
</select>