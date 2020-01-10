<?php 

include '../bootstrap.php';


?>

<style>
/* ตาราง */
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
        <td>แบบเก็บข้อมูลโภชนาการและวัคซีนเด็ก 0-5 ปี หน่วยบริการ <span>โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></td>
    </tr>
    <tr>
        <td>ชื่อสกุลบิดา  ID </td>
    </tr>
    <tr>
        <td>ชื่อสกุลมารดา  ID </td>
    </tr>
    <tr>
        <td>บันทึกทารกแรกเกิด ชื่อ-สกุล ด.ช./ ด.ญ. ID</td>
    </tr>
    <tr>
        <td>ที่อยู่ เบอร์โทรที่ติดต่อได้</td>
    </tr>
    <tr>
        <td>วดป.เกิด</td>
    </tr>
    <tr>
        <td>ความยาว</td>
    </tr>
    <tr>
        <td>APGAR SCORE</td>
    </tr>
    <tr>
        <td>สภาวะสุขภาพแรกเกิด</td>
    </tr>
    <tr>
        <td>วันที่จำหน่าย</td>
    </tr>
    <tr>
        <td>การตรวจสภาวะพร่อง</td>
    </tr>
</table>
<table class="chk_table">
    <tr>
        <td rowspan="2">วัคซีนที่ให้</td>
        <td rowspan="2">อายุที่ควรรับ</td>
        <td colspan="3">วันเดือนปีที่ได้รับวัคซีน</td>
    </tr>
    <tr>
        <td>ครั้งที่1</td>
        <td>ครั้งที่2</td>
        <td>ครั้งที่3</td>
    </tr>
</table>