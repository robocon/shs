<?php 

include '../bootstrap.php';

$action = input_post('action');
if($action === 'save'){
    
    dump($_POST);
    exit;
}
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

<form action="wellbaby_lpho.php" method="post">

    <table>
        <tr>
            <td>
               <h3>Ẻ�红���������ҡ������Ѥ�չ�� 0-5 �� ˹��º�ԡ�� <span>�ç��Һ�Ť�������ѡ��������</span></h3>
            </td>
        </tr>
        <tr>
            <td>
                ����ʡ�źԴ� <input type="text" name="father" id=""> ID <input type="text" name="fatherId" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                ����ʡ����ô� <input type="text" name="mother" id=""> ID <input type="text" name="motherId" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                �ѹ�֡��á�á�Դ <input type="radio" name="prefix" id="prefix1" value="�.�."> <label for="prefix1">�.�.</label> 
                <input type="radio" name="prefix" id="prefix2" value="�.�."> <label for="prefix2">�.�.</label> 
                ����-ʡ�� <input type="text" name="name" id=""> ID <input type="text" name="idcard" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                ������� <input type="text" name="address" id=""> 
                �����÷��Դ����� <input type="text" name="phone" id="">
            </td>
        </tr>
        <tr>
            <td>
                Ǵ�.�Դ <input type="text" name="dateBorn" id=""> 
                ���� <input type="text" name="timeBorn" id="" size="10"> 
                �. ���˹ѡ�á�Դ <input type="text" name="weight" id="" size="5">����
            </td>
        </tr>
        <tr>
            <td>
                ������� <input type="text" name="height" id="" size="5">��. 
                ����ͺ����� <input type="text" name="head" id="" size="5">��. 
                ����ͺ͡ <input type="text" name="breast" id="" size="5">��.
            </td>
        </tr>
        <tr>
            <td>
                APGAR SCORE(1�ҷ�) <input type="text" name="apgar1" id="" size="5"> 
                (5�ҷ�) <input type="text" name="apgar5" id="" size="5"> 
                �����Դ��������Դ <input type="radio" name="disorder" id="disorder1" value="�����"><label for="disorder1">�����</label> 
                <input type="radio" name="disorder" id="disorder2" value="��"><label for="disorder2">��</label> 
                �к� <input type="text" name="disorderDetail" id="">
            </td>
        </tr>
        <tr>
            <td>
                ������آ�Ҿ�á�Դ <input type="radio" name="health" id="health1" value="���ç��"><label for="health1">���ç��</label> 
                <input type="radio" name="health" id="health2" value="�Դ����"><label for="health2">�Դ����</label> 
                �к� <input type="text" name="healthDetail" id="">
            </td>
        </tr>
        <tr>
            <td>�ѹ����˹��� <input type="text" name="discharge" id="" size="10"> 
                ���˹ѡ�ѹ����˹��� <input type="text" name="weightDischarge" id="" size="5"> 
                �Ե��Թ� <input type="radio" name="vitamink" id="vitamink1" value="�մ"><label for="vitamink1">�մ</label> 
                <input type="radio" name="vitamink" id="vitamink2" value="���մ"><label for="vitamink2">���մ</label>
            </td>
        </tr>
        <tr>
            <td>��õ�Ǩ����о��ͧ���´�������� <input type="radio" name="thyroid" id="thyroid1" value="����"><label for="thyroid1">����</label> 
                <input type="radio" name="thyroid" id="thyroid2" value="�Դ����"><label for="thyroid2">�Դ����</label>
            </td>
        </tr>
        <tr>
            <td>��õ�ǨPKU <input type="radio" name="pku" id="pku1" value="����"><label for="pku1">����</label> 
                <input type="radio" name="pku" id="pku2" value="�Դ����"><label for="pku2">�Դ����</label>
            </td>
        </tr>
    </table>
    <div>
        <button type="submit">�ѹ�֡������</button>
        <input type="hidden" name="action" value="save">
    </div>
</form>

<?php 


?>

<!-- 
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
-->