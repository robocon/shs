<?php
session_start();
$today = date("d-m-Y");   
$d = substr($today,0,2);
$m = substr($today,3,2);
$yr = substr($today,6,4) +543;  

print "วันที่&nbsp;&nbsp;$d/$m/$yr&nbsp;&nbsp;เลขที่ใบเบิก&nbsp;&nbsp;".$_SESSION["cBillno"]."<br>";
print "รายการเบิกจากคลังยาใหญ่ไป $cDepcode<br>";
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
                <th>รหัส</th>
                <th>รายการ</th>
                <th>Exp.</th>
                <th>เบิก</th>
                <th>หน่วย</th>
                <th>ในคลัง</th>
                <th>ในห้องจ่าย</th>
                <th>ทุน</th>
                <th>มูลค่าเบิก</th>
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
                <td colspan="9" align="right"><b>มูลค่าเบิกรวม</b></td>
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
                    ตรวจแล้วเห็นว่า .............................................................................................................<br>
                    .........................................................................................................................................
                </p>
            </td>
            <td width="50%" colspan="2">
                <p>
                    ขอเบิกสิ่งอุปกรณ์ตามที่ระบุไว้ในช่อง"จำนวนเบิก"และขอมอบให้<br>
                    ...........................................................................................เป็นผู้รับแทน
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
            <td align="center">(ลงนาม) ผู้ตรวจสอบ</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) ผู้เบิก</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
        <tr>
            <td width="50%" colspan="2">
                <p>อนุมัติให้จ่ายได้เฉพาะในรายการและจำนวนที่ผู้ตรวจสอบเสนอ</p>
            </td>
            <td width="50%" colspan="2">
                <p>ได้รับสิ่งอุปกรณ์ตามรายการและจำนวนที่แจ้งไว้ในช่อง "จ่ายจริง"</p>
            </td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ลงนาม) ผู้สั่งจ่าย</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) ผู้รับ</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
        <tr>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
            <td align="center">.....................................................</td>
        </tr>
        <tr>
            <td align="center">(ลงนาม) ผู้จ่าย</td>
            <td align="center">วัน เดือน ปี</td>
            <td align="center">(ลงนาม) จนท.ส่วนควบคุมทางบัญชี</td>
            <td align="center">วัน เดือน ปี</td>
        </tr>
    </table>
</div>