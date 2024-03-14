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
        $dbirthEn = bc_to_ad($pt['dbirth']);
        $dateNow = date('Y-m-d');
        // dump($dbirthEn);
        // dump($dateNow);

        $diff = abs(strtotime($dateNow)-strtotime($dbirthEn));
        $yearOnly = floor($diff / (365*60*60*24));
        // dump($yearOnly);

        $age = findPtAge($pt['dbirth']);
        ?>
        <fieldset>
            <legend>ข้อมูลเบื้องต้นผู้มารับบริการ</legend>
            <table>
                <tr>
                    <td align="right" width="25%"><b>ชื่อ-สกุล:</b></td>
                    <td width="25%"><?=$pt['yot'].$pt['name'].' '.$pt['surname'];?></td>
                    <td align="right" width="25%"><b>สิทธิ:</b></td>
                    <td width="25%"><?=$pt['ptright'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>HN:</b></td>
                    <td><?=$pt['hn'];?></td>
                    <td align="right"><b>ออก OPD CARD:</b></td>
                    <td><?=$toborow;?></td>
                </tr>
                <tr>
                    <td align="right"><b>VN:</b></td>
                    <td><?=$op['vn'];?></td>
                    <td align="right"><b>ประเภทสิทธิ:</b></td>
                    <td><?=$pt['ptrightdetail'];?></td>
                </tr>
                <tr>
                    <td align="right"><b>อายุ:</b></td>
                    <td><?=$age;?></td>
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
                            </table>
                            <div style="text-align:right;">
                                <b>รวมเงิน &nbsp;&nbsp;<?=number_format($price, 2);?> บาท</b>
                            </div>
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
            <div style="float:left; width:50%;"></div>
        </div>
        <?php
        }

        if($_SESSION['smenucode']=='ADMLAB' OR $_SESSION['smenucode']=='ADM'){ 
        ?>
        <div class="clearfix">
            <div style="float:left; width: 50%;">
                <fieldset>
                    <legend><h3>รายการตรวจ Lab</h3></legend>
                    <form action="orderlabsso3.php" method="post" target="_blank" id="formIDLab">
                        <div style="position: relative; width:100%;" class="clearfix dataTable">
                            <div>
                                <?php 
                                $b = new OpdReceive();
                                $b->hn = $hn;
                                $b->vn = $vn;
                                $orderLabId = $b->findOrderLab();
                                if($orderLabId!==false)
                                {
                                    ?><p style="color:red; font-weight:bold;">มีการคิดค่า LAB ตรวจสุขภาพลูกจ้างแล้วในวันนี้ <a href="javascript:void(0);" onclick="window.open('invdetail1.php?sDate=<?=(date('Y')+543).date('-m-d');?>&gRow_id=<?=$orderLabId;?>','','width=800,height=800')">ดูค่าใช้จ่าย</a></p><?php
                                }

                                // ปี 67 
                                // 'HDL-sso','HBSAG','STOCB-sso',
                                $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'TRI','LDL');
                                if($yearOnly < 35){
                                    $chkList = array('CBC-sso', 'UA-sso');
                                }

                                $sql = "SELECT * FROM lab67 WHERE hn = '$hn' AND lab != '' ";
                                $q = $dbi->query($sql);
                                if($q->num_rows>0){
                                    $lab67 = $q->fetch_assoc();
                                    $exlab = explode(',', $lab67['lab']);
                                    foreach ($exlab as $key => $value) {
                                        if(in_array($value, $chkList)===false){
                                            $chkList[] = $value;
                                        }
                                    }
                                }
                                
                                // ปี 66 
                                // $chkList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'LIPID');
                                ?>
                                <table width="100%" class="chk_table">
                                    <thead>
                                        <tr>
                                            <th>รหัส</th>
                                            <th>รายละเอียด</th>
                                            <th>ราคา(บาท)</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody id="labMainTable">
                                    <?php 
                                    $price = 0;
                                    foreach ($chkList as $key => $code) { 

                                        $key = rand(1000,9999);
                                        $keyCode = $key.$code;

                                        $q = $dbi->query("SELECT `detail`,`price` FROM `labcare` WHERE `code` = '$code'");
                                        $l = $q->fetch_assoc();
                                        ?>
                                        <tr id="<?=$keyCode;?>">
                                            <td><?=$code;?></td>
                                            <td><?=$l['detail'];?></td>
                                            <td align="right">
                                                <?=$l['price'];?>
                                                <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                            </td>
                                            <td align="center">
                                                <a href="javascript:void(0);" onclick="removeLabItem('<?=$keyCode;?>','<?=$l['price'];?>')">ลบ</a>
                                            </td>
                                        </tr>
                                        <?php
                                        $price += $l['price'];
                                    }
                                    ?>
                                    </tbody>
                                </table>
                                <div style="text-align:right;">
                                    <b>รวมเงิน &nbsp;&nbsp;<span id="totalLabPrice"><?=number_format($price, 2);?></span> บาท</b>
                                </div>
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
                            <a href="javascript:void(0);" class="aButton" onclick="window.open('orderlabsso_stk.php?hn=<?=$hn;?>&type=all','allSticker','width=800,height=600')">สติกเกอร์ทั้งหมด</a>&nbsp;|&nbsp;
                            <a href="javascript:void(0);" class="aButton" onclick="window.open('orderlabsso_stk.php?hn=<?=$hn;?>&type=chem','stkChem','width=800,height=600')">สติกเกอร์ CHEM</a>&nbsp;|&nbsp;
                            <a href="javascript:void(0);" class="aButton" onclick="window.open('orderlabsso_stk.php?hn=<?=$hn;?>&type=cbc','stkCbc','width=800,height=600')">สติกเกอร์ CBC</a>&nbsp;|&nbsp;
                            <a href="javascript:void(0);" class="aButton" onclick="window.open('orderlabsso_stk.php?hn=<?=$hn;?>&type=ua','stkUa','width=800,height=600')">สติกเกอร์ UA</a>
                        </div>
                    </div>
                </fieldset>
            </div>
            <div style="float:left; width:50%;">
                <fieldset>
                    <legend><h3>เพิ่มรายการแลป</h3></legend>
                    <div>
                        <table width="100%" class="chk_table">
                            <thead>
                                <tr>
                                    <th>รหัส</th>
                                    <th>รายละเอียด</th>
                                    <th>ราคา(บาท)</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $quickList = array('CBC-sso', 'UA-sso', 'CR-sso', 'BS', 'TRI','LDL','HDL-sso','CHOL-sso','HBSAG','STOCB-sso');
                                foreach ($quickList as $key => $code) { 

                                    $key = rand(1000,9999);
                                    $keyCode = $key.$code;

                                    $q = $dbi->query("SELECT `detail`,`price` FROM `labcare` WHERE `code` = '$code'");
                                    $l = $q->fetch_assoc();
                                    ?>
                                    <tr id="<?=$keyCode;?>">
                                        <td><?=$code;?></td>
                                        <td><?=$l['detail'];?></td>
                                        <td align="right">
                                            <?=$l['price'];?>
                                            <input type="hidden" name="labSelect[]" value="<?=$code;?>">
                                        </td>
                                        <td align="center">
                                            <a href="javascript:void(0);" onclick="addLabItem('<?=$code;?>','<?=$l['detail'];?>','<?=$l['price'];?>')">เพิ่ม</a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div>&nbsp;</div>
                    <div>
                        <input type="text" name="labSearch" id="labSearch" onkeyup="onSearchLabCode(this.value)" placeholder="พิมพ์โค้ดที่ต้องการค้นหา">
                    </div>
                    <div id="resLabSearch" style="margin-top:8px;"></div>
                    
                </fieldset>
                <script>
                    async function onSearchLabCode(v){
                        if(v.length>=2){
                            
                            await fetch("orderlabsso_query.php?action=findlab&depart=PATHO&part=LAB&code="+v).then((res)=>{
                                
                                if (res.status >= 400 && res.status < 600) {
                                    throw new Error("Bad response from server");
                                }

                                res.json().then((data)=>{
                                
                                    if(data.count>0){

                                        document.getElementById('resLabSearch').innerHTML = '';

                                        const table = document.createElement("table");
                                        table.setAttribute("class", "chk_table");
                                        table.setAttribute("width", "100%");

                                        const trTitle = document.createElement("tr");
                                        const colTitle = document.createElement("th");
                                        colTitle.append("รหัส");
                                        trTitle.appendChild(colTitle);

                                        const col2Title = document.createElement("th");
                                        col2Title.append("รายละเอียด");
                                        trTitle.appendChild(col2Title);

                                        const col3Title = document.createElement("th");
                                        col3Title.append("ราคา(บาท)");
                                        trTitle.appendChild(col3Title);

                                        const col4Title = document.createElement("th");
                                        trTitle.appendChild(col4Title);

                                        table.appendChild(trTitle);

                                        let html = '';
                                        for (let index = 0; index < data.count; index++) {
                                            const element = data.list[index];

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
                                            col4.setAttribute("align", "center");
                                            aLink.setAttribute("href", "javascript:void(0);");
                                            aLink.setAttribute("onclick", "addLabItem('"+element.code+"','"+element.detail+"','"+element.price+"')");
                                            aLink.append("เพิ่ม");
                                            col4.appendChild(aLink);
                                            tr1.appendChild(col4);

                                            table.appendChild(tr1);

                                        }

                                        document.getElementById('resLabSearch').appendChild(table);

                                    }else{
                                        document.getElementById('resLabSearch').innerHTML = '<b>ไม่พบข้อมูลที่ต้องการ</b>';
                                    }
                                });

                            }).catch((error) => {
                                // Your error is here!
                                document.getElementById('resLabSearch').innerHTML = 'ERROR 400 เซิฟเวอร์ไม่พร้อมใช้งาน';
                            });

                        }
                        
                    }

                    function getRandomInt(max) {
                        return Math.floor(Math.random() * max);
                    }

                    function addLabItem(code, detail, price){
                        let newPrice = parseInt(price);

                        var key = getRandomInt(9999);
                        var keyCode = key.toString()+code;

                        const table = document.getElementById("labMainTable");

                        const tr1 = document.createElement("tr");
                        const col1 = document.createElement("td");
                        tr1.setAttribute("id", keyCode);
                        col1.append(code);
                        tr1.appendChild(col1);

                        const col2 = document.createElement("td");
                        col2.append(detail);
                        tr1.appendChild(col2);

                        const col3 = document.createElement("td");
                        col3.setAttribute("align","right");
                        col3.append(parseInt(price).toFixed(2));

                        let col3Input = document.createElement("input");
                        col3Input.setAttribute("type","hidden");
                        col3Input.setAttribute("name","labSelect[]");
                        col3Input.setAttribute("value",code);
                        col3.appendChild(col3Input);

                        tr1.appendChild(col3);
                        
                        const col4 = document.createElement("td");
                        const aLink = document.createElement("a");
                        aLink.setAttribute("href", "javascript:void(0);");
                        aLink.setAttribute("onclick", "removeLabItem('"+keyCode+"','"+price+"')");
                        aLink.append("ลบ");
                        col4.setAttribute("align", "center");
                        col4.appendChild(aLink);
                        tr1.appendChild(col4);

                        table.appendChild(tr1);

                        const labPrice = parseInt(document.getElementById('totalLabPrice').innerHTML);

                        let totalLabPrice = (labPrice+newPrice).toFixed(2);
                        newPrice = totalLabPrice;
                        
                        document.getElementById('totalLabPrice').innerHTML = totalLabPrice;
                        // 
                    }
                </script>
            </div>
        </div>
        
        <script>
            function removeLabItem(code,price){
                document.getElementById(code).remove();
                const totalLabPrice = document.getElementById('totalLabPrice').innerHTML;
                const newPrice =parseInt(price);
                const newTotalLabPrice =parseInt(totalLabPrice);

                document.getElementById('totalLabPrice').innerHTML = (newTotalLabPrice-newPrice).toFixed(2);
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