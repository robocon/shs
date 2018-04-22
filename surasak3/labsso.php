<?php

include 'bootstrap.php';
$db = Mysql::load();

$action = input_post('action');
if( $action == 'search_lab' ){

    include 'includes/JSON.php';
    $json = new Services_JSON();

    $code = input_post('code');
    $db->select("SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$code' ");
    
    $rows = $db->get_rows();

    if( $rows > 0 ){
        $item = $db->get_item();
        // echo '{"code":"'.$item['code'].'","detail":"'.$item['detail'].'","price":"'.$item['price'].'"}';


        $output = $json->encode(array('code'=>$item['code'],'detail'=>$item['detail'],'price'=>$item['price']));
        echo $output;
    }

    exit;
}

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

?>

<form method="POST" action="labsso.php" id="formCode"> 
    
    <a target="_BLANK" href="codehlp.php">รหัส</a>
    <div id="list" style="left: 9px; top: 121px; position: absolute;"></div>&nbsp;&nbsp;&nbsp;

    <input type="text" name="code" size="8" id="code" value="" onkeypress="searchSuggest(this.value,2,'code');">
    
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    
    <input type="submit" value="ตกลง" name="B1" style="height:40px; width:110px; font-size:16px;">

</form>

<script type="text/javascript">
    document.getElementById('code').focus();

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
    // $sso_list[] = 'cxr';
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
<style>
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<form action="labsso_save.php" target="right" method="post">

    <p style="margin-bottom: 0;"><b>รายการตรวจตามสิทธิประกันสังคม</b></p>
    <div>
        <table id="sso_tb" class="chk_table" style="font-size: 12px;">
            <tr style="background-color: #e8e8e8;">
                <th>รหัส</th>
                <th>รายการ</th>
                <th>ราคา</th>
                <th>แก้ไข</th>
            </tr>
            <?php
            if( count($sso_list) > 0 ){
                foreach ($sso_list as $key => $item) {
                    
                    $sql = "SELECT `code`,`detail`,`price` FROM `labcare` WHERE `code` LIKE '$item-sso'";
                    $db->select($sql);
                    $lab = $db->get_item();
                    ?>
                        <tr class="c<?=$lab['code'];?>">
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);" data-item="c<?=$lab['code'];?>" class="rm_item">ลบ</a>
                                <input type="hidden" name="sso_list[]" value="<?=$lab['code'];?>">
                            </td>
                        </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    <?php
    
    if( count($shs_list) > 0 ){
        ?>
        <p style="margin-bottom: 0;"><b>รายการตรวจตาม รพ.ค่ายฯ</b></p>
        <div>
            <table id="shs_tb" class="chk_table" style="font-size: 12px;">
                <tr style="background-color: #e8e8e8;">
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
                        <tr class="c<?=$lab['code'];?>">
                            <td><?=$lab['code'];?></td>
                            <td><?=$lab['detail'];?></td>
                            <td><?=$lab['price'];?></td>
                            <td align="center">
                                <a href="javascript: void(0);" data-item="c<?=$lab['code'];?>" class="rm_item">ลบ</a>
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
        <span style="color: red;">กรุณาตรวจสอบรายการอีกครั้ง ก่อนทำการบันทึก</span>
    </div>
</form>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){ 

    $(document).on('click', '.rm_item', function(){
        var c = confirm('ยืนยันที่จะลบข้อมูล?');
        if( c === false ){
            return false;
        }

        var className = $(this).attr('data-item');
        $('.'+className).remove();
    });

    $(document).on('submit', '#formCode', function(){
        var lCode = $('#code').val();

        if( lCode == '' ){
            return false;
        }
        
        var thisReg = new RegExp('.+\-sso');
        var codeType = 'shs_tb';
        var typeList = 'shs_list';
        if( thisReg.test(lCode) === true ){
            codeType = 'sso_tb';
            typeList = 'sso_list';
        }

        $.ajax({
            url: 'labsso.php',
            type: 'POST',
            data: {'code': lCode, 'action': 'search_lab'},
            dataType: 'json',
            success: function(txt){

                var test_int = Math.floor(Math.random() * 100);
                
                var txt_tb = '<tr class="'+test_int+txt.code+'">';
                txt_tb += '<td>'+txt.code+'</td>';
                txt_tb += '<td>'+txt.detail+'</td>';
                txt_tb += '<td>'+txt.price+'</td>';
                txt_tb += '<td align="center">';
                txt_tb += '<a href="javascript: void(0);" data-item="'+test_int+txt.code+'" class="rm_item">ลบ</a>';
                txt_tb += '<input type="hidden" name="'+typeList+'[]" value="'+txt.code+'">';
                txt_tb += '</td>';
                txt_tb += '</tr>';

                $('#'+codeType).append(txt_tb);

                $('#code').val('');
            }
        });

        return false;
    });

});
</script>