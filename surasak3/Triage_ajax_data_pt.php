<?php
 
if (isset($_POST['hn'])) {

    $hn = $_POST['hn'];
 
    echo '
        <div class="form-group">
            <input type="hidden" class="form-control" id="name" >
            <table width="100%">
                <tr>
                    <td width="200px"><b>ชื่อ-นามสกุล</b> </td>
                    <td align="left"><font color=blue>string1</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group"> 
            <input type="hidden" class="form-control" id="age" >
            <table width="100%">
                <tr>
                    <td width="200px"><b>อายุ</b></td>
                    <td align="left"><font color=blue>string2 ปี</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group"> 
            <input type="hidden" class="form-control" id="disease" >
            <table width="100%">
                <tr>
                    <td width="200px"><b>โรคประจำตัว</b></td>
                    <td align="left"><font color=blue>string3</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group"> 
            <input type="hidden" class="form-control" id="rights" >
            <table width="100%">
                <tr>
                    <td width="200px"><b>สิทธิการรักษา</b></td>
                    <td align="left"><font color=blue>string4</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group"> 
            <!--input type="date" class="form-control" id="date" required-->
            <table width="100%">
                <tr>
                    <td width="200px"><b>วันที่</b></td>
                    <td align="left"><font color=blue>00-00-0000</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group"> 
            <!--input type="time" class="form-control" id="time" required-->
            <table width="100%">
                <tr>
                    <td width="200px"><b>เวลา</b></td>
                    <td align="left"><font color=blue>00:00 น.</font></td>
                </tr>
            </table>
        </div>
        <div class="form-group">
            <b>เหตุผลการเข้ารักษา</b><br>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="reason" id="disease" value="disease" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="disease">เจ็บป่วยด้วยโรคต่างๆ</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="reason" id="accident" value="accident" style="width: 30px;height: 30px;">
                <label class="form-check-label" for="accident">บาดเจ็บหรืออุบัติเหตุ</label>
            </div>
        </div>
        <div class="form-group">
            <b>CC</b>
            <textarea class="form-control" id="cc" rows="3" placeholder="CC"></textarea>
        </div>
        <button type="button" class="btn btn-primary btn-block" onclick="f2_pt_basic_show();">ถัดไป</button>
    ';
     
}//end if
?>
