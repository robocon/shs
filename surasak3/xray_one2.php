<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_xray.php';

$action = sprintf("%s", $_POST['action']);
if($action === 'save'){
    $xray = new Xray();
    $hn_list = $_POST['hn'];
    $save_status = true;
    foreach ($hn_list as $hn) {
        $save = $xray->addXrayOnlyItem($hn, $_POST['xraydetail']);
        if($save['data']['resInsertXrayDoctor']!==true){
            $save_status = false;
        }

        if($save['data']['resInsertXrayStat']!==true){
            $save_status = false;
        }
    }

    if($save_status===true){
        ?>
        <p>บันทึกข้อมูลเรียบร้อย</p>
        <p>&lt;&lt;&nbsp;&nbsp;<a href="xray_one2.php">กลับไปหน้าบันทึก</a></p>
        <?php
    }

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
    <form action="xray_one2.php" method="post" id="myForm" onsubmit="return checkForm()">
        <table id="myTable">
            <tr>
                <td colspan="3"><b>ตรวจสุขภาพ ผู้ป่วยนอก</b></td>
            </tr>
            <tr id="main_hn">
                <td>HN : </td>
                <td><input type="text" onblur="showHnDetail(this.value,this.parentElement)"></td>
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
                    <div id="cXraydetail"></div>
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
            cell2.innerHTML = '<input type="text" class="hn" onblur="showHnDetail(this.value,this.parentElement)">';
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