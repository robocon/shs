<?php 

include '../bootstrap.php';

$action = input_post('action');
if($action === 'save'){
    
    dump($_POST);
    exit;
}
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

<form action="wellbaby_lpho.php" method="post">

    <table>
        <tr>
            <td>
               <h3>แบบเก็บข้อมูลโภชนาการและวัคซีนเด็ก 0-5 ปี หน่วยบริการ <span>โรงพยาบาลค่ายสุรศักดิ์มนตรี</span></h3>
            </td>
        </tr>
        <tr>
            <td>
                ชื่อสกุลบิดา <input type="text" name="father" id=""> ID <input type="text" name="fatherId" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                ชื่อสกุลมารดา <input type="text" name="mother" id=""> ID <input type="text" name="motherId" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                บันทึกทารกแรกเกิด <input type="radio" name="prefix" id="prefix1" value="ด.ช."> <label for="prefix1">ด.ช.</label> 
                <input type="radio" name="prefix" id="prefix2" value="ด.ญ."> <label for="prefix2">ด.ญ.</label> 
                ชื่อ-สกุล <input type="text" name="name" id=""> ID <input type="text" name="idcard" id="" size="12">
            </td>
        </tr>
        <tr>
            <td>
                ที่อยู่ <input type="text" name="address" id=""> 
                เบอร์โทรที่ติดต่อได้ <input type="text" name="phone" id="">
            </td>
        </tr>
        <tr>
            <td>
                วดป.เกิด <input type="text" name="dateBorn" id=""> 
                เวลา <input type="text" name="timeBorn" id="" size="10"> 
                น. น้ำหนักแรกเกิด <input type="text" name="weight" id="" size="5">กรัม
            </td>
        </tr>
        <tr>
            <td>
                ความยาว <input type="text" name="height" id="" size="5">ซม. 
                เส้นรอบศรีษะ <input type="text" name="head" id="" size="5">ซม. 
                เส้นรอบอก <input type="text" name="breast" id="" size="5">ซม.
            </td>
        </tr>
        <tr>
            <td>
                APGAR SCORE(1นาที) <input type="text" name="apgar1" id="" size="5"> 
                (5นาที) <input type="text" name="apgar5" id="" size="5"> 
                ความผิดปกติแต่กำเนิด <input type="radio" name="disorder" id="disorder1" value="ไม่มี"><label for="disorder1">ไม่มี</label> 
                <input type="radio" name="disorder" id="disorder2" value="มี"><label for="disorder2">มี</label> 
                ระบุ <input type="text" name="disorderDetail" id="">
            </td>
        </tr>
        <tr>
            <td>
                สภาวะสุขภาพแรกเกิด <input type="radio" name="health" id="health1" value="แข็งแรงดี"><label for="health1">แข็งแรงดี</label> 
                <input type="radio" name="health" id="health2" value="ผิดปกติ"><label for="health2">ผิดปกติ</label> 
                ระบุ <input type="text" name="healthDetail" id="">
            </td>
        </tr>
        <tr>
            <td>วันที่จำหน่าย <input type="text" name="discharge" id="" size="10"> 
                น้ำหนักวันที่จำหน่าย <input type="text" name="weightDischarge" id="" size="5"> 
                วิตามินเค <input type="radio" name="vitamink" id="vitamink1" value="ฉีด"><label for="vitamink1">ฉีด</label> 
                <input type="radio" name="vitamink" id="vitamink2" value="ไม่ฉีด"><label for="vitamink2">ไม่ฉีด</label>
            </td>
        </tr>
        <tr>
            <td>การตรวจสภาวะพร่องไทรอยด์ฮอร์โมน <input type="radio" name="thyroid" id="thyroid1" value="ปกติ"><label for="thyroid1">ปกติ</label> 
                <input type="radio" name="thyroid" id="thyroid2" value="ผิดปกติ"><label for="thyroid2">ผิดปกติ</label>
            </td>
        </tr>
        <tr>
            <td>การตรวจPKU <input type="radio" name="pku" id="pku1" value="ปกติ"><label for="pku1">ปกติ</label> 
                <input type="radio" name="pku" id="pku2" value="ผิดปกติ"><label for="pku2">ผิดปกติ</label>
            </td>
        </tr>
    </table>
    <div>
        <button type="submit">บันทึกข้อมูล</button>
        <input type="hidden" name="action" value="save">
    </div>
</form>

<?php 


?>

<!-- 
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
-->