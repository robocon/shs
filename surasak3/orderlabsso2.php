<?php 
require_once 'bootstrap.php';
require_once 'class_file/opday.php';
require_once 'class_file/opcard.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = $_POST['hn'];
$toborow = $_POST['toborow'];
$extra = $_POST['extra'];

// หาใน opday ก่อนว่าวันนี้ออก VN แล้วรึยัง
$opday = new Opday();
$op = $opday->getThisDay($hn);
if($op===false) // ยังไม่มี VN ก็ออก VN ใหม่
{
    $opday->ptright = 'R42 ตรวจสุขภาพลูกจ้างประจำปี';
    $opday->toborow = $toborow; //EX46 ตรวจสุขภาพประกันสังคม
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
        @media screen and (max-width: 800px){
            .dataTable{
                width: 100%!important;
            }
        }
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
            line-height: 40px;
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
        <div class="clearfix">
            <div style="float:left; width:50%;">
                <fieldset>
                    <legend><h3>รายการตรวจ X-Ray</h3></legend>
                    <form action="orderlabsso3.php" method="post" target="_blank" id="formIDXray">

                        <div style="width: 100%; margin-bottom: 8px;" class="clearfix dataTable">
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
                            <a href="javascript:void(0);" class="aButton" onclick="onXrayPrint()">สติ๊กเกอร์ X-Ray</a>

                        </div>
                        
                    </form>
                </fieldset>
                <script>
                    function onXrayPrint(){
                        window.open(" xraystk.php<?=$xraystklink;?>", "popupXrayPrint","width=600,height=400");
                    }
                </script>
                    
            </div>
            <div style="float:left; width:50%;">
                <fieldset>
                    <legend><h3>เพิ่มรายการแลป</h3></legend>
                    <div>
                        <input type="text" name="labSearch" id="labSearch" onkeyup="onSearchLabCode(this.value)" placeholder="พิมพ์โค้ดที่ต้องการค้นหา">
                    </div>
                    <div id="resLabSearch" style="margin-top:8px;"></div>
                </fieldset>
                <script>
                    async function onSearchLabCode(v){
                        if(v.length>=2){
                            
                            // labcare/getLabitem?depart=PATHO&part=LAB&code=
                            const res = await fetch("<?=LARAVEL_API_HOST;?>labcare/getLabitem?depart=PATHO&part=LAB&code="+v);
                            const content = await res.json();

                            if(content.count>0){

                                document.getElementById('resLabSearch').innerHTML = '';

                                const table = document.createElement("table");
                                table.setAttribute("class", "chk_table");

                                const trTitle = document.createElement("tr");
                                const colTitle = document.createElement("th");
                                colTitle.append("Code");
                                trTitle.appendChild(colTitle);

                                const col2Title = document.createElement("th");
                                col2Title.append("Detail");
                                trTitle.appendChild(col2Title);

                                const col3Title = document.createElement("th");
                                col3Title.append("ราคา");
                                trTitle.appendChild(col3Title);

                                const col4Title = document.createElement("th");
                                trTitle.appendChild(col4Title);

                                table.appendChild(trTitle);
                                
                                let html = '';
                                for (let index = 0; index < content.count; index++) {
                                    const element = content.list[index];

                                    const tr1 = document.createElement("tr");
                                    const col1 = document.createElement("td");
                                    col1.append(element.code);
                                    tr1.appendChild(col1);

                                    const col2 = document.createElement("td");
                                    col2.append(element.detail);
                                    tr1.appendChild(col2);

                                    const col3 = document.createElement("td");
                                    col3.setAttribute("align","right");
                                    col3.append(element.price);
                                    tr1.appendChild(col3);

                                    const col4 = document.createElement("td");
                                    const aLink = document.createElement("a");
                                    aLink.setAttribute("href", "javascript:void(0);");
                                    aLink.setAttribute("onclick", "addXrayItem('"+element.code+"')");
                                    aLink.append("เพิ่ม");
                                    col4.appendChild(aLink);
                                    tr1.appendChild(col4);

                                    table.appendChild(tr1);

                                }
                                
                                document.getElementById('resLabSearch').appendChild(table);
                                // 
                            }else{
                                document.getElementById('resLabSearch').innerHTML = '<b>ไม่พบข้อมูลที่ต้องการ</b>';
                            }
                        }
                        
                    }

                    function addXrayItem(code){
                        console.log(code);
                    }
                </script>
            </div>
        </div>
       <?php
        }

        if($_SESSION['smenucode']=='ADMLAB' OR $_SESSION['smenucode']=='ADM'){ 
        ?>
        <fieldset>
            <legend><h3>รายการตรวจ Lab</h3></legend>

            <form action="orderlabsso3.php" method="post" target="_blank" id="formIDLab">
                <div style="position: relative; width:50%;" class="clearfix dataTable">
                    <div>
                        <?php 
                        $b = new OpdReceive();
                        $b->hn = $hn;
                        $b->vn = $vn;
                        if($b->findOrderLab()!==false)
                        {
                            ?><p style="color:red; font-weight:bold;">มีการคิดค่า LAB ตรวจสุขภาพลูกจ้างแล้วในวันนี้</p><?php
                        }

                        $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'LIPID');
                        ?>
                        <table width="100%" class="chk_table">
                            <tr>
                                <th>รหัส</th>
                                <th>รายละเอียด</th>
                                <th>ราคา(บาท)</th>
                                <th></th>
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
                                    <td align="right">
                                        <?=$l['price'];?>
                                        <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);" onclick="removeLabItem('<?=$code;?>')">ลบ</a>
                                    </td>
                                </tr>
                                <?php
                                $price += $l['price'];
                            }
                            ?>
                            <tr>
                                <td colspan="2" align="center"><b>รวมเงิน</b></td>
                                <td align="right"><span id="labprice"><?=number_format($price, 2);?></span></td>
                                <td></td>
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
                    <a href="orderlabsso_stk.php?hn=<?=$hn;?>&type=all" target="_blank" class="aButton">สติกเกอร์ทั้งหมด</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?hn=<?=$hn;?>&type=chem" target="_blank" class="aButton">สติกเกอร์ CHEM</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?hn=<?=$hn;?>&type=cbc" target="_blank" class="aButton">สติกเกอร์ CBC</a>&nbsp;|&nbsp;
                    <a href="orderlabsso_stk.php?hn=<?=$hn;?>&type=ua" target="_blank" class="aButton">สติกเกอร์ UA</a>
                </div>
            </div>
        </fieldset>
        <script>
            function removeLabItem(code){
                document.getElementById(code).remove();
            }
        </script>
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