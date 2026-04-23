<?php
session_start();
if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}
include("connect.php"); 

$an = sprintf("%s", $_POST['an']);

$query = "SELECT row_id,my_food FROM ipcard where an = '$an' ";
$result = mysql_query($query);
$rows = Mysql_num_rows($result);

$result2 = mysql_fetch_array($result);
if ($rows == 0) {
    echo "ไม่มีหมายเลข AN ที่ท่านระบุ กรุณาลองใหม่อีกครั้ง <BR><BR><input type=button onclick='history.back()' value='&lt;&lt; กลับไป'>";
    exit();

} elseif ($result2['my_food'] == "") {
    echo "ยังไม่ได้ระบุสิทธิของผู้ป่วย ให้ผู้ป่วยผ่านส่วนเก็บเงินรายได้ก่อน<BR><BR><input type=button onclick='history.back()' value='&lt;&lt; กลับไป'><br>";
    exit();

}

$cAdmitd = "";
$cHn = "";
$cAn = $an;
$cYot = "";
$cName = "";
$cSurname = "";
$cPtright = "";
$cGoup = "";
$cCamp = "";

$cIdcard = "";
$cAge = "";
$cAddress = "";
$cMuang = "";

session_register("cAdmitd");
session_register("cHn");
session_register("cAn");
session_register("cYot");
session_register("cName");
session_register("cSurname");
session_register("cPtright");
session_register("cGoup");
session_register("cCamp");
session_register("cIdcard");
session_register("cAge");
session_register("cAddress");
session_register("cMuang");

?>
<style>
    fieldset {
        border: 1px solid red;
    }
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    h3{
        font-size: 24px;
        padding:0;
        margin:0;
    }
    h2{
        font-size: 28px;
    }
    legend {
        padding: 0.2em 0.5em;

        color: black;
        font-size: 100%;
        text-align: right;
        font-family: Th Niramit AS;
        font-size: 18px;
    }
    input[type=radio],label{
        cursor: pointer;
    }
    #noti_food_container{
        color:red;
    }

    #bed_detail{
        border-collapse: collapse;
    }
    
    #bed_detail td{
        padding-bottom: 8px;
    }
</style>
<?php
//
function calcage($birth)
{
    $today = getdate();
    $nY = $today['year'];
    $nM = $today['mon'];
    $bY = substr($birth, 0, 4) - 543;
    //$bY=substr($birth,0,4);
    $bM = substr($birth, 5, 2);
    $ageY = $nY - $bY;
    $ageM = $nM - $bM;
    if ($ageM < 0) {
        $ageY = $ageY - 1;
        $ageM = 12 + $ageM;
    }
    if ($ageM == 0) {
        $pAge = "$ageY ปี";
    } else {
        $pAge = "$ageY ปี $ageM เดือน";
    }
    return $pAge;
}
//


///////
$query = "SELECT ptname,an FROM bed WHERE an = '$an'";
$result = mysql_query($query) or die("Query failed ".mysql_error());

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}

if (mysql_num_rows($result)) {
    die("AN: $an  ชื่อ $row->ptname <br>กำลังนอนป่วยอยู่ในโรงพยาบาล  ไม่สามารถรับป่วยใหม่ในเตียงนี้ได้<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< กลับไป'>");
}
//////
$query = "SELECT date,an,hn,dcdate,status_log FROM ipcard WHERE an = '$an'";
$result = mysql_query($query) or die("Query failed".mysql_error());
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}
if ($result) {
    $cHn = $row->hn;
    $cAdmitd = $row->date;
    $cDcmitd = $row->dcdate;
    $status_log = $row->status_log;
    if ($cDcmitd != '0000-00-00 00:00:00') {
        echo "<FONT SIZE='3' COLOR='#FF0000'>คำเตือน ผู้ป่วยได้ทำการจำหน่ายเรียบร้อยแล้ว<BR> กรุณาตรวจสอบ AN ก่อนการ ADMIT </FONT><br>";
    }
    ;
    //
    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query) or die("Query failed".mysql_error());

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if (!($row = mysql_fetch_object($result)))
            continue;
    }

    if ($result) {
        $cHn = $row->hn;
        $cYot = $row->yot;
        $cName = $row->name;
        $cSurname = $row->surname;
        $cPtright = $row->ptright;
        $cGoup = $row->goup;
        $cCamp = $row->camp;
        $cIdcard = $row->idcard;
        $cAge = $row->dbirth;
        $cAddress = $row->address;
        $cMuang = "ต. $row->tambol  อ. $row->ampur  จ. $row->changwat";
        $cAge = calcage($cAge);
        echo "<h3></h3>";
        ?>
        <style>
            .title-size{
                font-size:22px;
            }
        </style>
        <fieldset style="display:inline-table; width: 50%; border:1px solid #000000;">
            <legend style="text-align:left; border: 1px solid #000000;">
                <h3>ตรวจสอบชื่อและANผู้ป่วย<br>เพื่อความถูกต้องก่อนรับป่วยทุกครั้ง</h3>
            </legend>
            <table>
                <tr>
                    <td align="right"><b class="title-size">HN: </b></td>
                    <td class="title-size"><?=$cHn;?></td>
                    <td rowspan="2">&nbsp;&nbsp;</td>
                    <td align="right" class="title-size"><b>AN: </b></td>
                    <td style="color:red;"><b class="title-size"><?=$an;?></b></td>
                </tr>
                <tr>
                    <td align="right"><b class="title-size">ชื่อ-สกุล: </b></td>
                    <td style="color:red;"><b class="title-size"><?="$cYot   $cName  $cSurname";?></b></td>
                    <td align="right"><b class="title-size">สิทธิการรักษา: </b></td>
                    <td style="color:red;"><b class="title-size"><?=$cPtright;?></b></td>
                </tr>
                <tr>
                    <td align="right"><b class="title-size">อายุ</b></td>
                    <td style="color:red;"><b class="title-size"><?=$cAge;?></b></td>
                    <td align="right"></td>
                    <td class="title-size"></td>
                </tr>				
            </table>
            
        </fieldset>
        
        <?php 
        // echo "<FONT SIZE='4' COLOR='#FF0000'>HN : $cHn, <B>AN:$an</B></FONT> <BR><FONT SIZE='4' COLOR=''> ชื่อ: $cYot   $cName  $cSurname,  สิทธิการรักษา : $cPtright </FONT><br>";
    } else {
        echo "ไม่พบ HN : $hn ";
    }
} else {
    echo "ไม่พบ AN  in ipcard table : $an ";
}



/////////////

if ($status_log == "จำหน่าย") {
    print "<script>alert('ผู้ป่วย an: $an ได้จำหน่ายออกจากโรงพยาบาลแล้ว เมื่อวันที่ $cDcmitd    หากต้องการเปลี่ยนแปลงค่าใช้จ่ายกรุณาติดต่อส่วนเก็บเงินรายได้')</script>";
    print "<a target=_self  href='../nindex.htm'><-----ไปเมนู</a>";

} else {

    ?>
    <SCRIPT LANGUAGE="JavaScript">
        function checkForm() {
            var ff = document.f1;
            var txt = "";
            var stat = true;

            var fc1 = document.getElementById('food_container1').checked;
            var fc2 = document.getElementById('food_container2').checked;
            document.getElementById('noti_food_container').style.display = 'none';
            
            if (ff.diag.value == "ระบุโรคเบื้องต้น" || ff.diag.value == "") {
                stat = false;
                txt += "- กรุณากรอกชื่อโรคของผู้ป่วย\n";
                ff.diag.focus();

            }else if(fc1===false && fc2===false){
                stat = false;
                txt += "- กรุณาเลือกภาชนะ";

                document.getElementById('noti_food_container').style.display = '';
            }
            <?php 
            if ($_SESSION['cBedcode'] == "42R5" || $_SESSION['cBedcode'] == "42R8") {
            ?>
            else if (ff.price.value == "") {
                stat = false;
                txt += "- กรุณาเลือกราคาค่าห้อง\n";
            }
            <?php 
            }
            ?>

            if (stat == false) {
                alert(txt);
            }
            return stat;
        }

        function chkother() {
            if (document.getElementById('rep').value == "other") {
                document.getElementById('hosother').style.display = '';
            } else {
                document.getElementById('hosother').style.display = 'none';
            }
        }

    </SCRIPT>
    <?php
    $query11 = "SELECT * FROM ipcard WHERE an = '$an'";
    $result11 = mysql_query($query11);
    $rows11 = mysql_num_rows($result11);
    $arr = mysql_fetch_array($result11);


    if ($arr['diag'] == '') {
        // $diag = "ระบุโรคเบื้องต้น";
    } else {
        $diag = $arr['diag'];
    }

    if ($cDcmitd == '0000-00-00 00:00:00') {
        $action = "ipregis.php?do=first&an=".$arr['an']."&hn=".$arr['hn'].'&Bcode='.$arr['bedcode'];
    } else {
        $action = "ipregis.php?do=second&an=".$arr['an']."&hn=".$arr['hn'].'&Bcode='.$arr['bedcode'];
    }

    ?>

    <form name="f1" method="POST" action="<?= $action; ?>" onsubmit="return checkForm();">
        <h2>โปรดลงข้อมูลต่อไปนี้</h2>
        <table id="bed_detail">
            <tr valign="top">
                <td align="right"><b>น้ำหนักแรกรับ :</b></td>
                <td>
                    <input type="text" name="weight" size="30" />&nbsp;&nbsp; ตัวอย่าง 60.00&nbsp;&nbsp;&nbsp;<br><span style="color:#FF0000;">* เด็กแรกเกิดระบุน้ำหนักเป็นทศนิยม 3 ตำแหน่ง เช่น 3.000</span>
                </td>
            </tr>
            <tr>
                <td align="right"><b>ประเภทการรับ Admit :</b></td>
                <td>
                    <select name="typeadmit" id="typeadmit">
                        <option value="A">accident</option>
                        <option value="E">emergency</option>
                        <option value="C">elective</option>
                        <option value="L">labor & delivery</option>
                        <option value="N">newborn</option>
                        <option value="U">urgent</option>
                        <option value="O">all other</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>รับผู้ป่วยจาก :</b></td>
                <td>
                    <select name="rep" id="rep" onchange="chkother()">
                        <option value="er">ER</option>
                        <option value="opd">OPD</option>
                        <option value="other">โรงพยาบาลอื่น</option>
                        <option value="ห้องผ่าตัด">ห้องผ่าตัด</option>
                        <option value="ห้องคลอด">ห้องคลอด</option>
                    </select>
                    <input name="hosother" type="text" id="hosother" size="40" style="display:none">
                </td>
            </tr>
            <tr>
                <td align="right"><b>วินิจฉัยโรค :</b></td>
                <td><input type="text" name="diag" size="50" value="<?= $diag; ?>" placeholder="กรุณาระบุโรคเบื้องต้น"></td>
            </tr>
            <tr>
                <td align="right"><b>โรคประจำตัว :</b></td>
                <td><input type="text" name="diag1" size="50" value="ไม่มี"></td>
            </tr>
            <tr>
                <td align="right"><b>อาหาร :</b></td>
                <td>
                    <select size="1" name="food">
                        <option value="อาหารปกติ" selected="selected">อาหารปกติ</option>
                        <option value="อาหารอ่อน">อาหารอ่อน</option>
                        <option value="อาหารเหลว">อาหารเหลว</option>
                        <option value="NPO (งดอาหาร, น้ำ)">NPO (งดอาหาร, น้ำ)</option>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <td align="right"><b>ต้องการแยกภาชนะ :</b></td>
                <td>
                    <input type="radio" name="food_container" id="food_container1" value="0"><label for="food_container1">ไม่แยก</label>
                    <input type="radio" name="food_container" id="food_container2" value="1"><label for="food_container2">แยก</label>
                    <div style="display:none;" id="noti_food_container">กรุณาเลือกภาชนะ</div>
                </td>
            </tr>
            <tr>
                <td align="right"><b>อาหารสั่งเพิ่ม :</b></td>
                <td>
                    <input type="text" name="addfood" size="70">
                </td>
            </tr>
            
            <tr>
                <td align="right"><b>แพทย์ :</b></td>
                <td>
                    <?php
                    $sql = "Select menucode From inputm where idname = '" . $_SESSION["sIdname"] . "' ";
                    list($menucode) = Mysql_fetch_row(Mysql_Query($sql));
                    if ($menucode == "ADMMAINOPD") {
                        $strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name";
                        $objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
                        ?>
                        <select name="doctor">
                            <?
                            while ($objResult = mysql_fetch_array($objQuery)) {
                                ?>
                                <option value="<?= $objResult["name"]; ?>" <? if ($arr['doctor'] == $objResult["name"]) {
                                    echo "selected";
                                } ?>>
                                    <?= $objResult["name"]; ?>
                                </option>
                                <?
                            }
                            ?>
                        </select>
                    <?php } else { ?>
                        <?
                        $strSQL = "SELECT name FROM doctor where status='y'  order by name";
                        $objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
                        ?>
                        <select name="doctor">
                            <?
                            while ($objResult = mysql_fetch_array($objQuery)) {
                                ?>
                                <option value="<?= $objResult["name"]; ?>" <? if ($arr['doctor'] == $objResult["name"]) {
                                    echo "selected";
                                } ?>>
                                    <?= $objResult["name"]; ?>
                                </option>
                                <?
                            }
                            ?>
                        </select>
                        <?php

                        if ($cDcmitd == '0000-00-00 00:00:00') {
                        } else {
                            echo "&nbsp;<BR><BR><FONT SIZE='3' COLOR='#FF0000'>คำเตือน ผู้ป่วยได้ทำการจำหน่ายเรียบร้อยแล้ว<BR> กรุณาตรวจสอบ AN ก่อนการ ADMIT  <B>AN:$an</B> </FONT><br>";
                        }
                    } ?>
                </td>
            </tr>
            <?php
            if ($_SESSION['cBedcode'] == "42R5" || $_SESSION['cBedcode'] == "42R8") {  //R5 ห้องเด็ก R8 ห้องแยกโรค  แก้ไขเมื่อ 25/07/2559
                ?>
                <tr>
                    <td colspan="2">
                    <fieldset>
                        <legend>ค่าห้อง</legend>
                        <p>&nbsp;&nbsp;ให้ระบุค่าห้องของผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <select name="price" id="price">
                                <option value="">-เลือกราคาค่าห้อง-</option>
                                <option value="400">400</option>
                                <option value="1000">1000</option>
                                <option value="1500">ค่าห้องโควิด 1500</option>
                                <option value="2500">ค่าห้องโควิด 2500</option>
                                <option value="3000">ค่าห้องโควิด 3000</option>
                                <option value="7500">ค่าห้องโควิด 7500</option>
                            </select>&nbsp;&nbsp;บาท
                        </p>
                        <br />
                    </fieldset>
                    </td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td></td>
                <td>
                    <input type="submit" value="  &#3605;&#3585;&#3621;&#3591;  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="reset" value="  &#3649;&#3585;&#3657;&#3652;&#3586;  " name="B2">

                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                    <input type="hidden" name="hn" value="<?=$xxxx;?>">
                </td>
            </tr>
        </table>
    </form>
<? } ?>