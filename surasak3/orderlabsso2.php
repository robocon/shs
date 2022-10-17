<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

global $cHn, $aDgcode;
$_SESSION['aDgcode'] = array();

$cHn = $hn = $_POST['hn'];
$toborow = $_POST['toborow'];
$extra = $_POST['extra'];

// หาใน opday ก่อนว่าวันนี้ออก VN แล้วรึยัง
$opday = new Opday();
$op = $opday->getThisDay($hn);
if($op===false) // ยังไม่มี VN ก็ออก VN ใหม่
{
    $opday->ptright = 'R42 ตรวจสุขภาพลูกจ้างประจำปี';
    $opday->toborow = $toborow;
    $opday->sOfficer = $_SESSION['sOfficer'];
    $op = $opday->createOpday($hn);
}

$vn = $op['vn'];
$ptname = $op['ptname'];

// หาค่าบริการผู้ป่วยนอก 50.-
$a = new OpdReceive();
$a->hn = $hn;
if($a->findOther()===false) // ถ้ายังไม่มีก็เพิ่มเข้าไป
{
    $a->vn = $vn; 
    $a->sOfficer = $_SESSION['sOfficer'];
    $a->insertOther();
}

// ทะเบียนไม่ไม่ยอมติ๊ก ไม่ยอมใส่รายละเอียดก็ตั้งค่าแม่งเองละกัน
$guardian = 'ลูกจ้าง';
if($extra=='hemo'){
    $guardian = 'ไตเทียม';
}elseif($extra=='pt'){
    $guardian = 'นวดแผนไทย';
}

$oc = new Opcard();
$update = $oc->update($hn, array('employee' => 'y','guardian' => $guardian));

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บันทึกรายการตรวจ VN <?=$vn.' '.$ptname;?></title>
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
        p{
            margin: 0;
            padding: 0;
        }
        .aButton{
            border: 1px solid #585858;
            padding: 6px 10px;
            background-color: #f1f1f1;
            text-decoration: none;
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
        
        <?php 
        if($_SESSION['smenucode']=='ADMXR' OR $_SESSION['smenucode']=='ADM'){ 
        ?>
        <fieldset>
            <legend><h3>รายการตรวจ X-Ray</h3></legend>
            <form action="orderlabsso3.php" method="post" target="_blank" id="formIDXray">

                <div style="width: 50%; margin-bottom: 8px;" class="clearfix">
                    <?php 

                    if($a->findXray() !== false){
                        
                        ?><p style="color:red; font-weight:bold;">มีการคิดค่า XRAY ตรวจสุขภาพลูกจ้างแล้วในวันนี้</p><?php
                        
                    }

                    $xrayList = array('41001-CHK');
                    ?>
                    <table width="100%" class="chk_table">
                        <tr>
                            <th>รหัส</th>
                            <th>รายละเอียด</th>
                            <th>ราคา</th>
                        </tr>
                        <?php 
                        $price = 0;
                        foreach ($xrayList as $key => $code) { 
                            $q = $dbi->query("SELECT `detail`,`price` FROM `labcare` WHERE `code` = '$code'");
                            $l = $q->fetch_assoc();
                            ?>
                            <tr id="<?=$code;?>">
                                <td><?=$code;?></td>
                                <td><?=$l['detail'];?></td>
                                <td align="right">
                                    <?=$l['price'];?>
                                    <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                </td>
                            </tr>
                            <?php
                            $price += $l['price'];
                        }
                        ?>
                        <tr>
                            <td colspan="2" align="center"><b>รวมเงิน(บาท)</b></td>
                            <td align="right"><span id="labprice"><?=number_format($price, 2);?></span></td>
                        </tr>
                    </table>
                </div>

                <div>
                    1. บันทึกค่าใช้จ่าย
                    <button type="submit" style="padding:8px;">บันทึกค่าใช้จ่าย X-Ray</button>
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="vn" value="<?=$op['vn'];?>">
                    <input type="hidden" name="type" value="xray">
                </div>
                <div>
                    <?php 
                    $thaiDate = (date('Y')+543).date('-m-d');
                    $xraystklink = "?date=$thaiDate&name=".rawurlencode($ptname)."&hn=".rawurlencode($hn)."&detail=".rawurlencode('1.CHEST CHECK UP');
                    ?>
                    <br>
                    2. พิมพ์สติกเกอร์
                    <a target="_blank" href="xraystk.php<?=$xraystklink;?>" class="aButton">สติ๊กเกอร์ X-Ray</a>

                </div>
                
            </form>
        </fieldset>
        <?php
        }

        if($_SESSION['smenucode']=='ADMLAB' OR $_SESSION['smenucode']=='ADM'){ 
        ?>
        <fieldset>
            <legend><h3>รายการตรวจ Lab</h3></legend>

            <form action="orderlabsso3.php" method="post" target="_blank" id="formIDLab">
                <div style="position: relative;" class="clearfix">
                    <div style="width: 50%; ">
                        <?php 
                        $b = new OpdReceive();
                        $b->hn = $hn;
                        $b->vn = $vn;
                        if($b->findOrderLab()!==false)
                        {
                            ?><p style="color:red; font-weight:bold;">มีการคิดค่า LAB ตรวจสุขภาพลูกจ้างแล้วในวันนี้</p><?php
                        }

                        $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'LIPID');
                        if($_SESSION['smenucode']=='ADMXR'){
                            $chkList = array('41001');
                        }
                        ?>
                        <table width="100%" class="chk_table">
                            <tr>
                                <th>รหัส</th>
                                <th>รายละเอียด</th>
                                <th>ราคา</th>
                            </tr>
                            <?php 
                            $price = 0;
                            foreach ($chkList as $key => $code) { 

                                $_SESSION['aDgcode'][] = $code;

                                $q = $dbi->query("SELECT `detail`,`price` FROM `labcare` WHERE `code` = '$code'");
                                $l = $q->fetch_assoc();
                                ?>
                                <tr id="<?=$code;?>">
                                    <td><?=$code;?></td>
                                    <td><?=$l['detail'];?></td>
                                    <td align="right">
                                        <?=$l['price'];?>
                                        <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                    </td>
                                </tr>
                                <?php
                                $price += $l['price'];
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center"><b>รวมเงิน(บาท)</b></td>
                                <td align="right"><span id="labprice"><?=number_format($price, 2);?></span></td>
                            </tr>
                        </table>
                        <br>
                        
                    </div>
                    <div style="width: 50%;" class="clearfix"></div>
                </div>
                <div>
                    1. บันทึกค่าใช้จ่าย
                    <button type="submit" style="padding:8px;">บันทึกค่าใช้จ่ายแลป</button>
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="vn" value="<?=$op['vn'];?>">
                    <input type="hidden" name="type" value="lab">
                </div>
            </form>
            <div>
                <div>
                    <br>
                    2. พิมพ์สติกเกอร์
                    <a href="orderlabsso_stk.php?cHn=<?=$cHn;?>&type=all" target="_blank" class="aButton">สติกเกอร์ทั้งหมด</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?cHn=<?=$cHn;?>&type=chem" target="_blank" class="aButton">สติกเกอร์ CHEM</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?cHn=<?=$cHn;?>&type=cbc" target="_blank" class="aButton">สติกเกอร์ CBC</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?cHn=<?=$cHn;?>&type=ua" target="_blank" class="aButton">สติกเกอร์ UA</a>



                    <!-- http://192.168.131.250/sm3/surasak3/labslip4bc_chkup_solider.php -->
                    
                    <!-- <button onclick="print_sticker('n')">พิมพ์สติกเกอร์</button> -->
                    <!-- <a href="labslip4bc_chkup.php?cHn=<?=$cHn;?>" target="_blank" class="aButton">พิมพ์สติกเกอร์</a>&nbsp;|&nbsp; -->
                    

                    <!-- http://192.168.131.250/sm3/surasak3/labslip4cbc_chkup_solider.php -->
                    <!-- <button onclick="print_sticker('cbc')">สติกเกอร์ CBC</button> -->
                    <!-- <a href="labslip4cbc_chkup.php?cHn=<?=$cHn;?>" target="_blank" class="aButton">สติกเกอร์ CBC</a>&nbsp;|&nbsp; -->

                    <!-- http://192.168.131.250/sm3/surasak3/labslip4ua_chkup_solider.php -->
                    <!-- <button onclick="print_sticker('ua')">สติกเกอร์ UA</button> -->
                    <!-- <a href="labslip4ua_chkup_employee.php?cHn=<?=$cHn;?>" target="_blank" class="aButton">สติกเกอร์ UA</a> -->
                </div>
            </div>
        </fieldset>
        <?php
        }
        ?>

        <div>
            <div>
                <br>
                <p><a href="orderlabsso.php">&lt;&lt;&nbsp;กลับไปหน้าแรก</a></p>
            </div>
        </div>

        
        <script>

            var myFormXray = document.getElementById('formIDXray');
            myFormXray.onsubmit = function() {
                var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left = 312,top = 234');
                this.target = 'Popup_Window';
            };

            var myFormLab = document.getElementById('formIDLab');
            myFormLab.onsubmit = function() {
                var w = window.open('about:blank','Popup_Window','toolbar=0,scrollbars=0,location=0,statusbar=0,menubar=0,resizable=0,width=400,height=300,left = 312,top = 234');
                this.target = 'Popup_Window';
            };

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