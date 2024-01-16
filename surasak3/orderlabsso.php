<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';

if(authen()===false){
    redirect("login_page.php");
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$chk_year = get_year_checkup();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสุขภาพลูกจ้างประจำปี <?=$chk_year;?></title>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="sweetalert/sweetalert2@11.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH Sarabun New","TH SarabunPSK";
            font-size: 20px;
        }
    </style>
    <div>
        <h3>ตรวจสุขภาพลูกจ้างประจำปี <?=$chk_year;?></h3>
    </div>
    <div>
        <fieldset>
            <legend>ค้นหาจาก HN</legend>
            <form action="orderlabsso.php" method="post">
                <div>
                    HN: <input type="text" name="hn" id="hn">
                </div>
                <div>
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="action" value="search">
                </div>
            </form>
        </fieldset>
    </div>
    <?php 
    $action = $_POST['action'];
    if ($action == 'search') {
        $hn = $_POST['hn'];

        $oc = new Opcard();
        $pt = $oc->getByHn($hn);
        if(!empty($pt)){

            $opday = new Opday();
            $op = $opday->getThisDay($hn);
            if(!empty($op)){ 
                ?>
                <p style="color: red;"><b>วันนี้ผู้ป่วยมีการออก VN(<?=$op['vn'];?>) เรียบร้อยแล้ว กรุณาตรวจสอบความถูกต้องอีกครั้งก่อนดำเนินการต่อไป</b></p>
                <?php
            }

            $age = findPtAge($pt['dbirth']);
            ?>
            
            
            <form action="orderlabsso2.php" method="post" id="submitForm">
                <fieldset>
                    <legend><h3>ข้อมูลเบื้องต้นผู้มารับบริการ</h3></legend>
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
                            <td align="right"><b>อายุ:</b></td>
                            <td><?=$age;?></td>
                        </tr>
                        <tr>
                            <td align="right"><b>สิทธิ:</b></td>
                            <td><b style="color:red;"><?=$pt['ptright'];?></b></td>
                        </tr>
                        <tr>
                            <td align="right"><b>ประเภทสิทธิ:</b></td>
                            <td><?=$pt['ptrightdetail'];?></td>
                        </tr>
                        <tr>
                            <td align="right"><b>รพ.ต้นสังกัด:</b></td>
                            <td><b style="color:red;"><?=$pt['hospcode'];?></b></td>
                        </tr>
                        <tr>
                            <td align="right"><b>ออก OPD CARD:</b></td>
                            <td>
                                <?php 
                                $toborow_list = array('EX46 ตรวจสุขภาพประกันสังคม');
                                ?>
                                <select name="toborow" id="toborow">
                                    <?php 
                                    foreach ($toborow_list as $key => $value) { 
                                        ?>
                                        <option value="<?=$value;?>"><?=$value;?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <table>
                    <tr>
                        <td colspan="2">
                            <b style="color:orangered;"><u>กรณีเป็นเจ้าหน้าที่ <span style="font-size:32px;">นวดแผนไทย</span> กับ <span style="font-size:32px;">ไตเทียม</span> รบกวนเลือกข้อมูลด้านล่างให้หน่อยครับ</u></b><br>
                            <input type="radio" name="extra" id="hemo" value="hemo"> <label for="hemo" style="cursor:pointer;">จนท.ไตเทียม</label><br>
                            <input type="radio" name="extra" id="pt" value="pt"> <label for="pt" style="cursor:pointer;">จนท.นวดแผนไทย</label><br>
                            <a href="javascript:void(0);" onclick="cancelPtHemo()">[ ยกเลิก ]</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <button type="button" style="padding:8px;" onclick="confirmForm()">ดำเนินการออก VN ต่อไป &gt;&gt;</button>
                            <input type="hidden" name="hn" id="hn" value="<?=$hn;?>" >
                        </td>
                    </tr>
                </table>
            </form>
            <script>
                function cancelPtHemo(){
                    document.getElementById('hemo').checked = false;
                    document.getElementById('pt').checked = false;
                }

                function confirmForm(){
                    Swal.fire({
                        title: "ยืนยันว่าเป็นลูกจ้าง รพ.ค่ายสุรศักดิ์มนตรี?",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "ใช่",
                        cancelButtonText: "ยกเลิก",
                    }).then((result) => { 
                        if (result.isConfirmed) {
                            document.getElementById('submitForm').submit();
                        }
                    });
                }
            </script>
            <?php
            
        }else{
            ?><p>ไม่พบ HN <?=$hn;?> ตรวจสอบข้อมูลอีกครั้ง</p><?php
        }
    }
?>
</body>
</html>