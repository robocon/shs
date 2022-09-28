<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_POST['hn'];
$toborow = $_POST['toborow'];
$extra = (int)$_POST['extra'];

ต้องลองหาเคสมาสัก 1 คนว่าถ้าเป็น ไตเทียม สิทธิที่ขึ้นจะเป็นยังไง
ลอง hn พี่ใจห้องไต

$opday = new Opday();
$op = $opday->getThisDay($hn);
if($op===false){
    $op = $opday->createOpday($hn);

}

if ($extra==1) {
    $opday->update($op['row_id'], array('toborow' => $toborow, 'ptright' => 'R01 เงินสด'));

}else{
    $opday->update($op['row_id'], array('toborow' => $toborow));

}

$oc = new Opcard();
$update = $oc->update($hn, array('employee' => 'y'));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายการตรวจ</title>
</head>
<body>
    <style>
        *{
            font-family: "TH Sarabun New","TH SarabunPSK";
            font-size: 20px;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <div>
        <a href="orderlabsso.php">&lt;&lt;&nbsp;กลับหน้าแรก</a>
    </div>
    <?php 
    
    $pt = $oc->getByHn($hn);
    if(!empty($pt)){
        
        $age = findPtAge($pt['dbirth']);
        ?>
        <fieldset>
            <legend>ข้อมูลเบื้องต้นผู้มารับบริการ</legend>
            <table>
                <tr>
                    <td align="right"><b>ชื่อ-สกุล:</b></td>
                    <td><?=$pt['yot'].$pt['name'].' '.$pt['surname'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>HN:</b></td>
                    <td><?=$pt['hn'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>VN:</b></td>
                    <td><?=$op['vn'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>อายุ:</b></td>
                    <td><?=$age;?></td>
                </tr>
                <tr>
                    <td align="right"><b>สิทธิ:</b></td>
                    <td><?=$pt['ptright'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>ออก OPD CARD:</b></td>
                    <td><?=$op['toborow'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>ประเภทสิทธิ:</b></td>
                    <td><?=$pt['ptrightdetail'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>รพ.ต้นสังกัด:</b></td>
                    <td><?=$pt['hospcode'];?></td>
                </tr>
            </table>
        </fieldset>
        
        <fieldset>
            <legend><h3>รายการตรวจ</h3></legend>
            <form action="orderlabsso3.php" method="post">
            
                <div style="position: relative;" class="clearfix">
                    <div style="width: 50%; float: left;">
                        <?php 
                        // แสดงรายการที่คิดเงินไปแล้วเป็นสีแดงด้านล่าง
                        // $sql = "SELECT * FROM `orderhead` WHERE `hn` = '$hn' AND `date` LIKE '%' AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี' ";

                        // แยก ptright ออกมาเป็น2ตัวให้เห็นว่าคนนี้ จ่ายเป็นเงินสดกี่บาท เบิกเข้าเป็นประกันสังคมกี่บาท
                        // $sql = "SELECT * FROM `depart` WHERE `hn` = '' ";
                        // 
                        ?>
                        <p><b>รายการที่เลือก</b></p>
                        แก้ตรงนี้ให้แยกรายการมาเลย
                        <ol id="itemSelected"></ol>
                    </div>
                    <div style="width: 50%; float: left;" class="clearfix">
                        <p><b>ชุดตรวจ</b></p>
                        <style>
                            .labItem li{
                                display: inline-block;
                                border: 1px solid #e3e3e3;
                                height: auto;
                                text-align: center;
                                box-shadow: 2px 2px 4px #787878;
                                
                            }
                            .labItem li a{
                                padding: 10px 30px;
                                display: table-cell;
                                background-color: #ffffff;
                            }
                            .labItem li a:hover{
                                background-color: #e3e3e3;
                            }
                        </style>

                        <?php 

                        // เอารายการแลปไปยืนยันกับพี่สมยศอีกทีว่ารายการแต่ละตัวถูกต้องตามสิทธิประกันสังคม
                        
                        $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'CHOL-sso', 'STOCB-sso', 'HBSAG-sso', '41001');
                        ?>
                        <ul style="margin:0; padding:0; list-style-type:none;" class="labItem">
                            <?php 
                            foreach ($chkList as $key => $labChk) {
                                ?>
                                <li><a href="javascript:void(0);" onclick="addToOrder('<?=$labChk;?>')"><?=$labChk;?></a></li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div>
                    <button type="submit" style="padding:8px;">บันทึกค่าใช้จ่าย(หมดรายการใบแจ้งหนี้)</button>
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="vn" value="<?=$op['vn'];?>">
                </div>
            </form>
            <div>
                <div>
                    <br>
                    <button onclick="print_sticker('n')">พิมพ์สติกเกอร์</button>
                    <button onclick="print_sticker('cbc')">สติกเกอร์ CBD</button>
                    <button onclick="print_sticker('ua')">สติกเกอร์ UA</button>
                </div>
            </div>
        </fieldset>
        <script>
            function addToOrder(code){ 
                var htmlTxt = '<li id="'+code+'">'+code+' <a href="javascript:void(0);" onclick="document.getElementById(\''+code+'\').outerHTML=\'\';"> [ลบ]</a><input type="hidden" name="labSelect[]" value="'+code+'"></li>';
                document.getElementById('itemSelected').innerHTML += htmlTxt;
            }

            function print_sticker(sticker_type){
                window.open("orderlabsso_sticker.php?type="+sticker_type, _blank);
            }
        </script>
        <?php
    }else{
        ?><p>ไม่พบ HN <?=$hn;?> ตรวจสอบข้อมูลอีกครั้ง</p><?php
    }
    ?>
</body>
</html>