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
        <td>ชื่อสกุลบิดา <input type="text" name="father" id=""> ID <input type="text" name="fatherId" id=""></td>
    </tr>
    <tr>
        <td>ชื่อสกุลมารดา <input type="text" name="mother" id=""> ID <input type="text" name="motherId" id=""></td>
    </tr>
    <tr>
        <td>บันทึกทารกแรกเกิด <input type="radio" name="prefix" id="prefix1" value="ด.ช."> <label for="prefix1">ด.ช.</label> <input type="radio" name="prefix" id="prefix2" value="ด.ญ."> <label for="prefix2">ด.ญ.</label> ชื่อ-สกุล <input type="text" name="" id=""> ID <input type="text" name="" id=""></td>
    </tr>
    <tr>
        <td>ที่อยู่ <input type="text" name="" id=""> เบอร์โทรที่ติดต่อได้ <input type="text" name="" id=""></td>
    </tr>
    <tr>
        <td>
            วดป.เกิด <input type="text" name="" id=""> เวลา <input type="text" name="" id=""> น. น้ำหนักแรกเกิด <input type="text" name="" id="">กรัม
        </td>
    </tr>
    <tr>
        <td>
            ความยาว <input type="text" name="" id="">ซม. เส้นรอบศรีษะ <input type="text" name="" id="">ซม. เส้นรอบอก <input type="text" name="" id="">ซม.
        </td>
    </tr>
    <tr>
        <td>
            APGAR SCORE(1นาที) <input type="text" name="" id=""> (5นาที) <input type="text" name="" id=""> ความผิดปกติแต่กำเนิด <input type="radio" name="" id=""><label for="">ไม่มี</label> <input type="radio" name="" id=""><label for="">มี</label> ระบุ <input type="text" name="" id="">
        </td>
    </tr>
    <tr>
        <td>
            สภาวะสุขภาพแรกเกิด <input type="radio" name="" id=""><label for="">แข็งแรงดี</label> <input type="radio" name="" id=""><label for="">ผิดปกติ</label> ระบุ <input type="text" name="" id="">
        </td>
    </tr>
    <tr>
        <td>
            วันที่จำหน่าย <input type="text" name="" id=""> น้ำหนักวันที่จำหน่าย <input type="text" name="" id=""> วิตามินเค <input type="radio" name="" id=""><label for="">ฉีด</label> <input type="radio" name="" id=""><label for="">ไม่ฉีด</label>
        </td>
    </tr>
    <tr>
        <td>
            การตรวจสภาวะพร่องไทรอยด์ฮอร์โมน <input type="radio" name="" id=""><label for="">ปกติ</label> <input type="radio" name="" id=""><label for="">ผิดปกติ</label>
        </td>
    </tr>
    <tr>
        <td>
            การตรวจ PKU <input type="radio" name="" id=""><label for="">ปกติ</label> <input type="radio" name="" id=""><label for="">ผิดปกติ</label>
        </td>
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