<?php
session_start();
$today = date("d-m-Y");   
$d = substr($today,0,2);
$m = substr($today,3,2);
$yr = substr($today,6,4) +543;  

print "�ѹ���&nbsp;&nbsp;$d/$m/$yr&nbsp;&nbsp;�Ţ�����ԡ&nbsp;&nbsp;".$_SESSION["cBillno"]."<br>";
print "��¡���ԡ�ҡ��ѧ���˭�� $cDepcode<br>";
?>
<br>
<style type="text/css">
    *{
        font-family: 'TH SarabunPSK';
        font-size: 16px;
    }
    p{
        line-height: 1.5em;
        overflow-wrap: break-word;
    }
    table td{
        vertical-align: top;
    }
    </style>
<div>
    <table style="width: 100%;">
        <thead>
            <tr>
                <th>#</th>
                <th>����</th>
                <th>��¡��</th>
                <th>Exp.</th>
                <th>�ԡ</th>
                <th>˹���</th>
                <th>㹤�ѧ</th>
                <th>���ͧ����</th>
                <th>�ع</th>
                <th>��Ť���ԡ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no=0;
            $total_ream = 0;
            for( $n=1; $n<=$x; $n++ ){
                if( !empty($aDgcode[$n]) ){
                    $no++;

                    $price_ream = ( $aUnitpri[$n] * $aStkcut[$n] );
                    $total_ream += $price_ream;
                    ?>
                    <tr>
                        <td><?=$no;?></td>
                        <td><?=$aDgcode[$n];?></td>
                        <td><?=$aTrade[$n];?></td>
                        <td><?=$aExpdate[$n];?></td>
                        <td align="right"><?=number_format($aStkcut[$n]);?></td>
                        <td><?=$aUnit[$n];?></td>
                        <td align="right"><?=number_format($aMainstk[$n]);?></td>
                        <td align="right"><?=number_format($aStock[$n]);?></td>
                        <td align="right"><?=$aUnitpri[$n];?></td>
                        <td align="right"><?=number_format($price_ream, 2);?></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr>
                <td colspan="10">&nbsp;</td>
            </tr>
            <tr>
                <td colspan="9" align="right"><b>��Ť���ԡ���</b></td>
                <td align="right"><b><?=number_format($total_ream, 2);?></b></td>
            </tr>
            <tr>
                <td colspan="10">&nbsp;</td>
            </tr>
        </tbody>
    </table>
    <table style="width: 100%;">
        <tr>
            <td width="50%" colspan="2">
                <p>
                    ��Ǩ���������� .............................................................................................................<br>
                    .........................................................................................................................................
                </p>
            </td>
            <td width="50%" colspan="2">
                <p>
                    ���ԡ����ػ�ó�������к����㹪�ͧ"�ӹǹ�ԡ"��Т��ͺ���<br>
                    ...........................................................................................�繼���Ѻ᷹
                </p>
            </td>
        </tr>
        <tr>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
            <td align="center" width="25%">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ŧ���) ����Ǩ�ͺ</td>
            <td align="center">�ѹ ��͹ ��</td>
            <td align="center">(ŧ���) ����ԡ</td>
            <td align="center">�ѹ ��͹ ��</td>
        </tr>
        <tr>
            <td width="50%" colspan="2">
                <p>͹��ѵ���������੾�����¡����Шӹǹ������Ǩ�ͺ�ʹ�</p>
            </td>
            <td width="50%" colspan="2">
                <p>���Ѻ����ػ�ó�����¡����Шӹǹ��������㹪�ͧ "���¨�ԧ"</p>
            </td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ŧ���) �����觨���</td>
            <td align="center">�ѹ ��͹ ��</td>
            <td align="center">(ŧ���) ����Ѻ</td>
            <td align="center">�ѹ ��͹ ��</td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ŧ���) ������</td>
            <td align="center">�ѹ ��͹ ��</td>
            <td align="center">(ŧ���) ���.��ǹ�Ǻ����ҧ�ѭ��</td>
            <td align="center">�ѹ ��͹ ��</td>
        </tr>
    </table>
</div>