<?php
session_start();
include_once dirname(__FILE__).'/connect.php';

// global $cBed,$cPtname,$cHn,$cPtright,$cDiag,$cDoctor;
$cBedcode = $_GET['Bed'];
$query = "SELECT * FROM bed WHERE bedcode = '$cBedcode'";
$result = mysql_query($query) or die("Query failed bed");
$row = mysql_fetch_object($result);
$cDate = $row->date;
$cBedcode = $row->bedcode;
$cBed = $row->bed;
$cPtname = $row->ptname;
$cAge = $row->age;
$cPtright = $row->ptright;
$cDoctor = $row->doctor;
$cHn = $row->hn;
$cAn = $row->an;
$cDiag = $row->diagnos;
$cBedpri = $row->bedpri;
$cChgdate = $row->chgdate;
$cBedname = $row->bedname;
$cAccno = $row->accno;
?>
<div>
    <a href="javascript:void(0);" onclick="window.history.back();">&lt;&lt;&nbsp;กลับไปเมนู</a><br><br>
</div>
<style>
    #ipaccContainer{
        position: absolute;
        background: #ffffff;
        box-shadow: 2px 2px 7px #000000;
        border: 1px solid #000000;
        padding: 8px;
        top: 0;
        right: 0;
    }
    .itemDatail{
        padding-left: 20px;
    }
</style>
<div>
    <table>
        <tr>
            <td align="right"><b>เตียง : </b></td>
            <td><?=$cBed;?></td>
        </tr>
        <tr>
            <td align="right"><b>ชื่อ : </b></td>
            <td><?=$cPtname;?></td>
        </tr>
        <tr>
            <td align="right"><b>HN : </b></td>
            <td><?=$cHn;?> <b>AN :</b> <?=$cAn;?></td>
        </tr>
        <tr>
            <td align="right"><b>สิทธิการรักษา : </b></td>
            <td><?=$cPtright;?></td>
        </tr>
        <tr>
            <td align="right"><b>โรค : </b></td>
            <td><?=$cDiag;?></td>
        </tr>
        <tr>
            <td align="right"><b>แพทย์ : </b></td>
            <td><?=$cDoctor;?></td>
        </tr>
    </table>
</div>
<div style="position:relative;">
    <div>
        <p><button type="button" onclick="showIpacc();" style="padding: 8px 32px;">ดูรายการค่ารักษาพยาบาล</button></p>
    </div>
    <div id="ipaccContainer" style="display:none;">
        <div onclick="closeBtn()" style="text-align:center; color:blue; cursor:pointer; text-decoration:underline;">[ ปิด ]</div>
        <div id="ipaccContent"></div>
    </div>
</div>
<script>
    function showIpacc(){
        loadIpacc();
    }
    function closeBtn(){
        document.getElementById('ipaccContainer').style.display = 'none';
    }
    async function loadIpacc(){
        let data = await fetch('ipacc.php');
        const body = await data.text();
        document.getElementById('ipaccContainer').style.display = '';
        document.getElementById('ipaccContent').innerHTML = body;
    }
</script>
<form method="POST" action="ippaid.php">
    <table>
        <tr>
            <td colspan="2"><b>ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา(เบิกไม่ได้)</b></td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าไฟฟ้า</td>
            <td><input type="text" name="electric" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าโทรศัพท์</td>
            <td><input type="text" name="phone" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าสิ่งอุปกรณ์เสียหาย </td>
            <td><input type="text" name="loss" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่ารถพยาบาล</td>
            <td><input type="text" name="ambulance" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าอาหาร</td>
            <td><input type="text" name="food" size="10"> บาท</td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2"><b>กรณีเสียชีวิต : </b></td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าบริการศพ (300บาท)</td>
            <td><input type="text" name="death" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าฉีดยาศพ (ขวดละ120บาท)</td>
            <td><input type="text" name="preserve" size="10"> บาท</td>
        </tr>
        <tr>
            <td class="itemDatail">ค่าตราสังข์</td>
            <td><input type="text" name="robe" size="10"> บาท</td>
        </tr>
    </table>
    <p style="background-color: #fd7e14;padding: 8px; display: inline-block;">การยกเลิกรายการ สามารถคีย์ติดลบเข้าไปได้ เช่น<br> คิดค่าตราสังฃ์ไปแล้ว 1000 เวลายกเลิกก็ให้คีย์ -1000 เป็นต้น</p>
    <p>
        <font face="Angsana New">
            <input type="submit" value="บันทึกค่าใช้จ่าย" name="B1" style="padding: 8px 32px;">
        </font>
    </p>
</form>