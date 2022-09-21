<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $dbi->escape_string($_POST['hn']);
$toborow = $dbi->escape_string($_POST['toborow']);

$opday = new Opday();
$op = $opday->getThisDay($hn);
if($op===false){
    $op = $opday->createOpday($hn, $toborow);
}else{
    $opday->updateToborow($hn, $toborow);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
    </style>
    <?php 
    $oc = new Opcard();
    $pt = $oc->getOpcard($hn);
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
                    <p><b>รายการที่เลือก</b></p>
                    <ul id="itemSelected"></ul>
                </div>
                <div style="width: 50%; float: left;" class="clearfix">
                    <p><b>ชุดตรวจ</b></p>
                    <style>
                        .labItem li{
                            display: inline-block;
                            border: 1px solid red;
                            height: auto;
                            text-align: center;
                        }
                        .labItem li a{
                            padding: 10px 30px;
                            display: table-cell;
                        }
                        .labItem li a:hover{
                            background-color: #e3e3e3;
                        }
                    </style>
                    <ul style="margin:0; padding:0; list-style-type:none;" class="labItem">
                    <!-- CBC-sso
                    UA-sso
                    CR-sso
                    BS
                    CHOL-sso+HDL-sso
                    STOCB-sso
                    HBSAG-sso
                    41001 -->
                        <li><a href="javascript:void(0);" onclick="addToOrder('CBC-sso')">CBC</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('UA-sso')">UA</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('CR-sso')">Cr</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('BS')">FBS</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('CHOL-sso')">Chol&HDL</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('STOCB-sso')">FOBT</a></li>
                        <li><a href="javascript:void(0);" onclick="addToOrder('HBSAG-sso')">HBsAg</a></li>
                        <li><a href="javascript:void(0);">x-ray</a></li>
                    </ul>
                </div>
            </div>
            <div>
                <button type="submit">บันทึกค่าใช้จ่าย</button>
            </div>
            </form>
        </fieldset>
        <script>
            function addToOrder(code){ 
                var htmlTxt = '<li id="'+code+'">'+code+' <a href="javascript:void(0);" onclick="document.getElementById(\''+code+'\').outerHTML=\'\';"> [ลบ]</a><input type="hidden" name="labSelect[]" value="'+code+'"></li>';
                document.getElementById('itemSelected').innerHTML += htmlTxt;
                // itemSelected
            }
        </script>
        <?php
    }else{
        ?><p>ไม่พบ HN <?=$hn;?> ตรวจสอบข้อมูลอีกครั้ง</p><?php
    }
    ?>
</body>
</html>