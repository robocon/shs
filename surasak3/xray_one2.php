<?php
include_once 'bootstrap.php';
include_once 'class_file/class_xray.php';

$action = sprintf("%s", $_POST['action']);
if($action === 'save'){
    dump($_POST);

    /**
     * @todo 
     * [] 
     * []
     */

    $xray = new Xray();
    // $xrayNumber = $xray->getXrayRunno();
    // $newXrayNumber = $xrayNumber++;

    // $xray->updateXrayRunno($newXrayNumber);

    $hn_list = $_POST['hn'];
    // $i = 0;
    foreach ($hn_list as $hn) {
        
        $xray->addXrayOnlyItem($hn, $_POST['xraydetail']);

        // $i++;
    }
    
    
	// $sql = "Select xn From xrayno where hn = '".$cHn."' Order by row_id DESC limit 0,1 ";
	// list($xn) = mysql_fetch_row(mysql_query($sql));

	// $sql = "Select dbirth From opcard where hn = '".$cHn."' limit 0,1 ";
	// list($dbirth) = mysql_fetch_row(mysql_query($sql));
	
	// $age = "-";
	// 	if(!empty($dbirth))
			// $age = calcage($dbirth);
	// $count = array();
	// $stat_digital = 0;
	// $stat_10_12 = 0;
	// $stat_14_17 = 0;
	// $stat_none = 0;

	// foreach ($aFilmsize as $key => $value){
		
	// 	//echo $value," ",strlen($value),"<BR>";
	// 	switch($value){
	// 		case 'DIGITAL': $stat_digital++; break;
	// 		case '10*12': $stat_10_12++; break;
	// 		case '14*17': $stat_14_17++; break;
	// 		case 'NONE': $stat_none++; break;
	// 	}

	// }
	//echo substr($xn,-2)," - ",substr(date("Y")+543,-2);
	// if(substr($xn,-2) == substr(date("Y")+543,-2)){
	// 	$xn_new = $xn;
	// 	$xn = "";
	// }

	// $sql = "INSERT INTO `xray_stat` 
    // (
    // `date` ,`hn` ,`xn` ,`xn_new` ,`ptname` ,`age` ,
    // `ptright` ,`patient_from` ,`detail` ,`doctor` ,`digital` ,`10_12` ,
    // `14_14` ,`NONE` ,`office` ,`idno`,`remark` 
    // )VALUES ( 
    // '".$Thidate."', '".$cHn."', '".$xn."', '".$xn_new."', '".$cPtname."', '".$age."', 
    // '".$cPtright."', '".$patient_from."', '".$_SESSION["cXraydetail"]."', '".$cDoctor."', '".$stat_digital."', '".$stat_10_12."', 
    // '".$stat_14_17."', '".$stat_none."', '".$sOfficer."', '".$nRunno."', '".$Netprice."');";
	// $result = mysql_query($sql);


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
            cell2.innerHTML = '<input type="text" name="hn[]" class="hn" onblur="showHnDetail(this.value,this.parentElement)">';
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