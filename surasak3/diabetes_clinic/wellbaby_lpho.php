<?php 

include '../bootstrap.php';


?>

<style>
/* ���ҧ */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK";
    font-size: 13pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
label{
    cursor: pointer;
}

@media print{
    .div-hide{
        display: none;
    }
}
</style>

<form action="wellbaby_lpho.php" method="post">

</form>




<table>
    <tr>
        <td>Ẻ�红���������ҡ������Ѥ�չ�� 0-5 �� ˹��º�ԡ�� <span>�ç��Һ�Ť�������ѡ��������</span></td>
    </tr>
    <tr>
        <td>����ʡ�źԴ� <input type="text" name="father" id=""> ID <input type="text" name="fatherId" id=""></td>
    </tr>
    <tr>
        <td>����ʡ����ô� <input type="text" name="mother" id=""> ID <input type="text" name="motherId" id=""></td>
    </tr>
    <tr>
        <td>�ѹ�֡��á�á�Դ <input type="radio" name="prefix" id="prefix1" value="�.�."> <label for="prefix1">�.�.</label> <input type="radio" name="prefix" id="prefix2" value="�.�."> <label for="prefix2">�.�.</label> ����-ʡ�� <input type="text" name="" id=""> ID <input type="text" name="" id=""></td>
    </tr>
    <tr>
        <td>������� <input type="text" name="" id=""> �����÷��Դ����� <input type="text" name="" id=""></td>
    </tr>
    <tr>
        <td>
            Ǵ�.�Դ <input type="text" name="" id=""> ���� <input type="text" name="" id=""> �. ���˹ѡ�á�Դ <input type="text" name="" id="">����
        </td>
    </tr>
    <tr>
        <td>
            ������� <input type="text" name="" id="">��. ����ͺ����� <input type="text" name="" id="">��. ����ͺ͡ <input type="text" name="" id="">��.
        </td>
    </tr>
    <tr>
        <td>
            APGAR SCORE(1�ҷ�) <input type="text" name="" id=""> (5�ҷ�) <input type="text" name="" id=""> �����Դ��������Դ <input type="radio" name="" id=""><label for="">�����</label> <input type="radio" name="" id=""><label for="">��</label> �к� <input type="text" name="" id="">
        </td>
    </tr>
    <tr>
        <td>
            ������آ�Ҿ�á�Դ <input type="radio" name="" id=""><label for="">���ç��</label> <input type="radio" name="" id=""><label for="">�Դ����</label> �к� <input type="text" name="" id="">
        </td>
    </tr>
    <tr>
        <td>
            �ѹ����˹��� <input type="text" name="" id=""> ���˹ѡ�ѹ����˹��� <input type="text" name="" id=""> �Ե��Թ� <input type="radio" name="" id=""><label for="">�մ</label> <input type="radio" name="" id=""><label for="">���մ</label>
        </td>
    </tr>
    <tr>
        <td>
            ��õ�Ǩ����о��ͧ���´�������� <input type="radio" name="" id=""><label for="">����</label> <input type="radio" name="" id=""><label for="">�Դ����</label>
        </td>
    </tr>
    <tr>
        <td>
            ��õ�Ǩ PKU <input type="radio" name="" id=""><label for="">����</label> <input type="radio" name="" id=""><label for="">�Դ����</label>
        </td>
    </tr>
</table>
<table class="chk_table">
    <tr>
        <td rowspan="2">�Ѥ�չ������</td>
        <td rowspan="2">���ط�����Ѻ</td>
        <td colspan="3">�ѹ��͹�շ�����Ѻ�Ѥ�չ</td>
    </tr>
    <tr>
        <td>���駷��1</td>
        <td>���駷��2</td>
        <td>���駷��3</td>
    </tr>
</table>