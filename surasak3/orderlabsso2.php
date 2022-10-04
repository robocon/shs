<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_POST['hn'];
$toborow = $_POST['toborow'];
$extra = (int)$_POST['extra'];

$opday = new Opday();
$op = $opday->getThisDay($hn);
if($op===false){
    $op = $opday->createOpday($hn);

}

if ($extra==1) {
    $item_update = array('toborow' => $toborow, 'ptright' => 'R01 เงินสด', 'employee' => 'y');

}else{
    $item_update = array('toborow' => $toborow);

} 

$opday->update($op['row_id'], $item_update);

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
        .chk_table{
            border-collapse: collapse;
        }

        .chk_table th, .chk_table td{
            border: 1px solid black;
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
                    <td><?=$toborow;?></td>
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
                        $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'HBSAG-sso', 'LIPID');
                        if($_SESSION['smenucode']=='ADMXR'){
                            $chkList = array('41001');
                        }
                        ?>
                        <p><b>รายการตรวจที่เลือก</b></p>
                        <table width="100%" class="chk_table">
                            <tr>
                                <th>code</th>
                                <th>detail</th>
                                <th>price</th>
                                <!-- <th></th> -->
                            </tr>
                            <?php 
                            $price = 0;
                            foreach ($chkList as $key => $code) { 
                                $q = $dbi->query("SELECT `detail`,`price` FROM `labcare` WHERE `code` = '$code'");
                                $l = $q->fetch_assoc();
                                ?>
                                <tr id="<?=$code;?>">
                                    <td><?=$code;?></td>
                                    <td><?=$l['detail'];?></td>
                                    <td align="right"><?=$l['price'];?></td>
                                    <!-- <td>
                                        <a href="javascript:void(0);" onclick="document.getElementById('<?=$code;?>').outerHTML='';">[ลบ]</a>
                                        <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                    </td> -->
                                </tr>
                                <?php
                                $price += $l['price'];
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center">รวม</td>
                                <td align="right"><span id="labprice"><?=$price;?></span>บาท</td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                    <div style="width: 50%; float: left;" class="clearfix">
                        
                    </div>
                </div>
                <div>
                    คลิกนี่ก่อนให้มีข้อมูลใน depart
                    <button type="submit" style="padding:8px;">บันทึกค่าใช้จ่าย(หมดรายการใบแจ้งหนี้)</button>
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="vn" value="<?=$op['vn'];?>">
                </div>
            </form>
            <div>
                <div>
                    <br>
                    แล้วค่อยคลิกสติกเกอร์
                    <!-- http://192.168.131.250/sm3/surasak3/labslip4bc_chkup_solider.php -->
                    <button onclick="print_sticker('n')">พิมพ์สติกเกอร์</button>
                    <!-- http://192.168.131.250/sm3/surasak3/labslip4cbc_chkup_solider.php -->
                    <button onclick="print_sticker('cbc')">สติกเกอร์ CBC</button>
                    <!-- http://192.168.131.250/sm3/surasak3/labslip4ua_chkup_solider.php -->
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