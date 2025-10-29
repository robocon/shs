<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_xray.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$action = sprintf("%s", $_REQUEST['action']);
if($action === 'save'){
    $xray = new Xray();
    $hn_list = $_POST['hn'];
    $save_status = true;
    foreach ($hn_list as $hn) {
        $xray->officer = $_SESSION['sOfficer'];
        $save = $xray->addXrayOnlyItem($hn, $_POST['xraydetail']);
        

        if($save['data']['resInsertXrayDoctor']['errors']){
            $save_status = false;
        }

        if($save['data']['resInsertXrayStat']['errors']){
            $save_status = false;
        }
    }

    if($save_status===true){
        ?>
        <p>บันทึกข้อมูลเรียบร้อย</p>
        <p>&lt;&lt;&nbsp;&nbsp;<a href="xray_one2.php">กลับไปหน้าบันทึก</a></p>
        <?php
    }else{
        ?>
        <p><?=$save['data']['resInsertXrayDoctor']['errors']['detail'];?></p>
        <p><?=$save['data']['resInsertXrayStat']['errors']['detail'];?></p>
        <?php
    }

    exit;
}elseif ($action==='load') { 

    $company = sprintf("%s", $_GET['company']);
    if(empty($company)){
        $res = array('status'=>400,'detail'=>'Invalid value');
        exit;
    }

    $json = new Services_JSON();
    $sql = "SELECT * FROM opcardchk WHERE part = '$company' ";
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $items = array();
        while ($a = $q->fetch_assoc()) {
            $a['ptname'] = $a['yot'].$a['name'].' '.$a['surname'];
            $items[] = $a;
        }
        $res = array('status'=>200,'data'=>$items,'count'=>count($items));
    }else{
        $res = array('status'=>400,'detail'=>'Can not find company');
    }
    echo $json->encode($res);
    exit;
}
?>
<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script src="sweetalert/sweetalert2@11.js"></script>
</head>
<body>
    <style>
        p{
            margin:0;
        }
        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }
        .companyUser {
            padding-top: 6px;
        }
    </style>
<div class="clearfix">
    <div style="float:left; width:40%;">
        <form action="xray_one2.php" method="post" id="myForm" onsubmit="return checkForm()">
            <table id="myTable">
                <tr>
                    <td colspan="3">
                        <h3>ตรวจสุขภาพ ผู้ป่วยนอก</h3>
                        <p><b>รายชื่อผู้เข้ารับการตรวจ</b></p>
                    </td>
                </tr>
                <tr id="main_hn">
                    <td>HN : </td>
                    <td><input type="text" onblur="showHnDetail(this.value,this.parentElement)" style="width:120px;"></td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="3">
                        <a href="javascript:void(0);" onclick="insertRow()">+ เพิ่มแถว</a>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <div><h3>ท่าตรวจ</h3></div>
                        <div id="cXraydetail">
                            <div id="dv1">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="document.getElementById('dv1').style.display='';">CHEST CHECK UP </a><input type="hidden" name="xraydetail[]" value="CHEST CHECK UP "></div>
                            <!-- <div id="dv2">&nbsp;&nbsp;&nbsp;<a href="javascript:void(0);" onclick="document.getElementById('dv2').style.display='';">USWHOLE ABDOMEN</a><input type="hidden" name="xraydetail[]" value="USWHOLE ABDOMEN"></div> -->
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <button type="submit" style="padding: 8px 16px;">บันทึกข้อมูล</button>
                        <input type="hidden" name="action" value="save">
                        <div></div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div style="float:left;">
        <table>
            <tr>
                <td>
                    <span>เลือกบริษัท</span>
                    <?php
                    $yearchk = get_year_checkup(true);
                    $sql = "SELECT * FROM chk_company_list WHERE yearchk = '$yearchk' AND report != '' ORDER BY id DESC";
                    $q = $dbi->query($sql);
                    if($q->num_rows > 0){
                        ?>
                        <select name="company" id="company" style="width:200px;" onchange="showUserInCompany(this.value)">
                            <option value=""> ==== เลือกบริษัท ==== </option>
                            <?php 
                            while ($a = $q->fetch_assoc()) {
                                ?>
                                <option value="<?=$a['code'];?>"><?=$a['name'];?></option>
                                <?php
                            }
                            ?>
                            
                        </select>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <div><b>รายชื่อผู้เข้ารับการตรวจ</b></div>
                    <div id="responseCompany"></div>
                </td>
            </tr>
        </table>
        <script>
            async function showUserInCompany(company){
                const response = await fetch('xray_one2.php?action=load&company='+company);
                const res = await response.json();
                if(res.status==400){
                    document.getElementById('responseCompany').innerHTML = '<div style="color:red;">ไม่พบข้อมูล</div>';
                }else{
                    let html = '';
                    for (let  i= 0; i < res.count; i++) {
                        const item = res.data[i];
                        html += '<div class="companyUser"><a href="javascript:void(0);" onclick="toLeftSide(\''+item.HN+'\')">'+item.HN+'</a> '+item.ptname+'</div>';
                    }
                    document.getElementById('responseCompany').innerHTML = html;
                }
                
            }
            function toLeftSide(hn){
                var table = document.getElementById("myTable");
                var row = table.insertRow(2);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                var cell3 = row.insertCell(2);
                cell1.innerHTML = "HN : ";
                cell2.innerHTML = '<input type="text" class="hn" name="hn[]" value="'+hn+'" style="width:120px;"> <a href="javascript:void(0);" title="ลบ" onclick="this.parentElement.parentElement.remove()">[X]</a>';
                cell3.innerHTML = "";
            }
        </script>
    </div>
</div>
    <script>

        // ตรวจสอบ hn 
        function showHnDetail(hn,tn){
            if(hn!==''){
                findHn(hn).then((op)=>{
                    if(!op.errors){
                        var res = 'ชื่อ-สกุล: <span style="color:green;">'+op.ptname+'</span><input type="hidden" name="hn[]" value="'+op.hn+'">';
                        next(tn).innerHTML = res;
                    }else{
                        next(tn).innerHTML = '<b style="color:red">'+op.errors.detail+'</b>';
                    }
                });
            }
        }

        // ดึงค่าจาก api
        async function findHn(hn){
            const response = await fetch('<?=LARAVEL_API_HOST;?>getOpcardFromHn?hn='+hn);
            const data = await response.json();
            return data;
        }

        // เพิ่มแถวแทรกเข้าไปในแถวที่ 2
        function insertRow(){
            var table = document.getElementById("myTable");
            var row = table.insertRow(2);
            var cell1 = row.insertCell(0);
            var cell2 = row.insertCell(1);
            var cell3 = row.insertCell(2);
            cell1.innerHTML = "HN : ";
            // onblur="showHnDetail(this.value,this.parentElement)"
            cell2.innerHTML = '<input type="text" class="hn" style="width:120px;" onblur="showHnDetail(this.value,this.parentElement)" > <a href="javascript:void(0);" title="ลบ" onclick="this.parentElement.parentElement.remove()">[X]</a>';
            cell3.innerHTML = "";
        }

        // ค้นหา tag name ตัวถัดไป
        // https://youmightnotneedjquery.com/#next
        function next(el, selector) {
            const nextEl = el.nextElementSibling;
            if (!selector || (nextEl && nextEl.matches(selector))) {
                return nextEl;
            }
            return null;
        }

        // เช็กฟอร์มก่อน submit
        function checkForm(){

            let returnForm = false;
            
            let countHn = false;
            let hnItems = document.getElementsByName("hn[]");
            for (let index = 0; index < hnItems.length; index++) {
                const element = hnItems[index];
                if(element.value!==''){
                    countHn = true;
                }
            }
            
            let countXraydetail = false;
            let xraydetailItems = document.getElementsByName("xraydetail[]");
            for (let index = 0; index < xraydetailItems.length; index++) {
                const element = xraydetailItems[index];
                if(element.value!==''){
                    countXraydetail = true;
                }
            }

            returnForm = false;

            if(countHn===false || countXraydetail===false){
                Swal.fire("กรุณาตรวจสอบข้อมูล HN และท่าตรวจให้ถูกต้อง");
            }else{
                Swal.fire({
                    title: "ท่านยืนยันว่าข้อมูลดังกล่าวถูกต้องและครบถ้วนสมบูรณ์?",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "ใช่",
                    cancelButtonText: "ยกเลิก",
                }).then((result) => { 
                    if(result.isConfirmed===true){
                        document.getElementById('myForm').submit();
                    }
                });
            }
            return false;
        }
    </script>
</body>
</html>