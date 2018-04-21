<?php
// session_start();
include 'bootstrap.php';
$db = Mysql::load();

// echo "Hello ลูกจ้าง ปกส.";

// echo "<br>";

// echo "<pre>";
// var_dump($GLOBALS);
// var_dump($_SESSION);
// echo "</pre>";

$sql = "SELECT a.*, b.`agey`
FROM `lab_pretest` AS a 
LEFT JOIN `opcardchk` AS b ON b.`HN` = a.`hn` 
WHERE b.`part` = 'ลูกจ้าง61' 
AND a.`hn` = '$cHn' 
AND a.`checked` IS NULL OR a.`checked` = '' ";
$db->select($sql);
$item = $db->get_item();

echo "HN : $cHn, <b> VN:</b>$tvn, ชื่อ-สกุล : $cPtname<br> 
สิทธิ : $cPtright, อายุ : ".$item['agey']." ปี <br> ";



/*
?>
<p>HN : 58-2733, VN:1  นาย กฤษณะศักดิ์ กันธรส</p>
<p>สิทธิ: R07 ประกันสังคม, (ลูกจ้าง รพ.ค่ายฯ)</p>
<?php
*/
?>

<form method="POST" action="/sm3/surasak3/labseek.php"> <font face="Angsana New">
    <a target="_BLANK" href="codehlp.php">รหัส</a>
    <div id="list" style="left: 9px; top: 121px; position: absolute;"></div>&nbsp;&nbsp;&nbsp;

    <input type="text" name="code" size="8" id="aLink" value="" onkeypress="searchSuggest(this.value,2,'code');">

    * <input type="text" name="amount" size="4" value="1">&nbsp;
    </font>
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Angsana New">
    <input type="submit" value="ตกลง" name="B1" style="height:40px; width:110px; font-size:16px;"></font><p></p>

    <script type="text/javascript">
        document.getElementById('aLink').focus();

        function newXmlHttp(){
            var xmlhttp = false;

                try{
                    xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
                }catch(e){
                try{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                    }catch(e){
                        xmlhttp = false;
                    }
                }

                if(!xmlhttp && document.createElement){
                    xmlhttp = new XMLHttpRequest();
                }
            return xmlhttp;
        }

        function searchSuggest(str,len,getto) {
	
            str = str+String.fromCharCode(event.keyCode);

            if(str.length >= len){

                url = 'labseek.php?action=code&search1=' + str+'&getto=' + getto;

                xmlhttp = newXmlHttp();
                xmlhttp.open("GET", url, false);
                xmlhttp.send(null);

                document.getElementById("list").innerHTML = xmlhttp.responseText;
            }
        }

    </script>

</form>

<?php

$sso_list = array();
if( !empty($item['cbc']) ){
    $sso_list[] = 'cbc';
}
if( !empty($item['ua']) ){
    $sso_list[] = 'ua';
}
if( !empty($item['bs']) ){
    $sso_list[] = 'bs';
}
if( !empty($item['cr']) ){
    $sso_list[] = 'cr';
}
if( !empty($item['chol']) ){
    $sso_list[] = 'chol';
}
if( !empty($item['hdl']) ){
    $sso_list[] = 'hdl';
}
if( !empty($item['hbsag']) ){
    $sso_list[] = 'hbsag';
}
if( !empty($item['fobt']) ){
    $sso_list[] = 'stocb';
}
if( !empty($item['cxr']) ){
    $sso_list[] = 'cxr';
}
sort($sso_list); // เรียงตัวอักษรใหม่

$shs_list = array('cbc','ua');
if( $item['agey'] >= 35 ){
    $shs_list = array('cbc','ua','bs','ldl','hdl','bun','cr','sgot','sgpt','alk');
}
sort($shs_list); // เรียงตัวอักษรใหม่

// ถ้ามีรายการตรวจซ้ำซ้อนกับของ ปกส จะลบออกจากรายการ
foreach( $shs_list AS $key => $shs_item ){
    if( in_array($shs_item, $sso_list) === true ){
        unset($shs_list[$key]);
    }
}


?>

<form action="labsso_save.php" target="right" method="post">
    <?php
    if( count($sso_list) > 0 ){
        ?>
        <p style="margin-bottom: 0;"><b>รายการตรวจตามสิทธิประกันสังคม</b></p>
        <div>
            <table border="1">
                <tr>
                    <th>รหัส</th>
                    <th>รายการ</th>
                    <th>ราคา</th>
                    <th>แก้ไข</th>
                </tr>
                <?php
                foreach ($sso_list as $key => $item) {
                    
                    $sql = "SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$item-sso'";
                    $db->select($sql);
                    $lab = $db->get_item();
                    ?>
                        <tr>
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);">ลบ</a>
                                <input type="hidden" name="sso_list[]" value="<?=$lab['code'];?>">
                            </td>
                        </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
    
    if( count($shs_list) > 0 ){
        ?>
        <p style="margin-bottom: 0;"><b>รายการตรวจตาม รพ.ค่ายฯ</b></p>
        <div>
            <table border="1">
                <tr>
                    <th>รหัส</th>
                    <th>รายการ</th>
                    <th>ราคา</th>
                    <th>แก้ไข</th>
                </tr>
                <?php
                foreach ($shs_list as $key => $item) {
                    
                    $sql = "SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$item'";
                    $db->select($sql);
                    $lab = $db->get_item();
                    ?>
                        <tr>
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);">ลบ</a>
                                <input type="hidden" name="shs_list[]" value="<?=$lab['code'];?>">
                            </td>
                        </tr>
                    <?php
                }
                ?>
            </table>
        </div>
        <?php
    }
    ?>
    <br>
    <div>
        <button type="submit" style="font-size: 16px; font-weight: bold; padding: 8px;">บันทึกข้อมูล</button>
        <br>
        <span style="color: red;">กรุณาตรวจสอบข้อมูลให้ดีก่อนทำการบันทึก</span>
    </div>
</form>

