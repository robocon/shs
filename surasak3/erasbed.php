<?php
    print "<br>ź�������͡�ҡ��§㹡ó� <br><b><u>�Ѻ���¼Դ �����Ѻ admit �Դ</u></b><br>";
    print "<br>";
    print "<b style='color: red;'>���� D/C �����¼�ҹ���ٹ�� ���Шз������ǹ���Թ��������������ö�Դ�Թ��������</b><br>";
    print "<br><a id='move_confirm' target='_self' href='javascript:void(0)' onclick='return check_confirm()'>�׹�ѹź�����Ũҡ��§������</a>";
?>
<script type="text/javascript">
    function check_confirm(){
        var con = confirm("�׹�ѹ���ź�����Ũҡ��§������");
        if( con !== false ){
            document.getElementById('move_confirm').href = 'wardchg.php';
        }else{
            return false;
        }
    }
</script>