<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_opcard.php';
include_once dirname(__FILE__).'/class_file/class_opd.php';

/**
 * api/Opd.php?action=saveRetinal
 */

if(empty($_SESSION['sOfficer'])){
    include_once 'pageNotFound.php';
    exit;
}

$opcard = new Opcard();
$opd = new Opd();

$action = $_GET['action'];
// สร้างรายการจาก opd 3เดือนย้อนหลัง
if($action == 'getOpd'){

    $items = $opd->last3MonthsFromHn($_GET['hn']);
    if(!empty($items)){
        foreach ($items as $a) {

            list($y,$m,$d) = explode('-', substr($a['thidate'],0,10));
            $thaiDate = $d.' '.$def_month_th[$m].' '.$y;
            $enDate = ($y-543)."-$m-$d";
            ?>
            <tr>
                <td>
                    <a href="javascript:void(0);" 
                    class="mr-2" 
                    opd-id="<?=$a['row_id'];?>"
                    t-date="<?=$enDate;?>"
                    t-height="<?=$a['height'];?>"
                    t-weight="<?=$a['weight'];?>"
                    t-waist="<?=$a['waist'];?>"
                    t-temp="<?=$a['temp'];?>"
                    t-pulse="<?=$a['pulse'];?>"
                    t-rate="<?=$a['rate'];?>"
                    t-bmi="<?=$a['bmi'];?>"
                    t-bp1="<?=$a['bp1'];?>"
                    t-bp2="<?=$a['bp2'];?>"
                    t-vn="<?=$a['vn'];?>"
                    t-doctor="<?=$a['doctor'];?>"
                    onclick="selectOpd(this,'<?=$thaiDate;?>')"><?=$thaiDate;?>
                    </a>
                </td>
                <td>&nbsp;&nbsp;<?=$a['vn'];?></td>
                <td>&nbsp;&nbsp;<?=$a['doctor'];?></td>
                <td>&nbsp;&nbsp;<?=$a['toborow'];?></td>
            </tr>
            <?php
        }
    }else{
        ?>
        <tr>
            <td colspan="4"><h3>ไม่พบข้อมูล</h3></td>
        </tr>
        <?php
    }
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Retinal Exam</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16pt;
    }
    #navMenu, #opdTb tr th, .swal2-html-container table tr th{
        background-color: #13795b;
        color:#ffffff;
    }
    label:hover{
        cursor: pointer;
    }
</style>
<nav class="navbar navbar-expand-lg" id="navMenu" data-bs-theme="dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">🏠</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-3 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="retinalExam.php">Retinal Exam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="retinalExamReport.php">Report</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
<div class="container">
    <h3 class="mt-3">ฟอร์มกรอกข้อมูล Retinal Exam</h3>
    <form class="row mt-3 mb-3" action="retinalExam.php" method="POST">
        <div class="col-sm-8 col-md-6 col-lg-4">
            <label for="hn" class="form-label fw-bold">ค้นหาจาก HN</label>
            <div class="input-group">
                <input type="text" class="form-control" id="hn" name="hnSearch">
                <button class="btn btn-secondary" type="submit">ค้นหา</button>
            </div>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
    
    <?php
    $page = sprintf("%s", $_POST['page']);
    if(!empty($page) && $page==="search"){
        $opc = $opcard->getByHn($_POST['hnSearch'],array('`hn`','`ptright`'));
        if($opc!==false){
        ?>
        <hr>
        <div class="row mb-3 mt-3">
        <form class="" id="userForm" action="retinalExam.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label class="form-label fw-bold">ข้อมูลเบื้องต้น</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-auto">
                    <label class="form-label fw-bold">HN: </label>
                    <?=$opc['hn'];?>
                </div>
                <div class="col-auto">
                    <label class="form-label fw-bold">ชื่อ-สกุล: </label>
                    <?=$opc['ptname'];?>
                    <input type="hidden" name="ptname" value="<?=$opc['ptname'];?>">
                </div>
                <div class="col-auto">
                    <label class="form-label fw-bold">สิทธิ: </label>
                    <?=$opc['ptright'];?>
                </div>
                <div class="col-auto">
                    <label class="form-label fw-bold">อายุ: </label>
                    <?=$opc['age'];?>ปี
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <label for="date" class="form-label fw-bold">วันที่มารับบริการ</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="date" name="date">
                        <button class="btn btn-secondary" type="button" onclick="selectDate()">เลือกวันที่</button>
                    </div>
                    <input type="hidden" name="page" value="search">
                </div>
            </div>
            
            <div class="row mb-3">
                <div class="col-12 fw-bold">ข้อมูลซักประวัติ <span id="afterSelectOpd" style="color: red;"></span></div>
                <div class="col-auto mb-2">
                    <label for="height" class="form-label fw-bold">ส่วนสูง</label>
                    <div class="form-text" id="showHeight">-</div>
                    <input type="hidden" class="form-control" id="height" name="height">
                </div>
                <div class="col-auto">
                    <label for="weight" class="form-label fw-bold">น้ำหนัก</label>
                    <div class="form-text" id="showWeight">-</div>
                    <input type="hidden" class="form-control" id="weight" name="weight">
                </div>
                <div class="col-auto mb-2">
                    <label for="waist" class="form-label fw-bold">รอบเอว</label>
                    <div class="form-text" id="showWaist">-</div>
                    <input type="hidden" class="form-control" id="waist" name="waist">
                </div>
                <div class="col-auto">
                    <label for="temp" class="form-label fw-bold">อุณหภูมิ</label>
                    <div class="form-text" id="showTemp">-</div>
                    <input type="hidden" class="form-control" id="temp" name="temp">
                </div>
                <div class="col-auto mb-2">
                    <label for="pulse" class="form-label fw-bold">Pulse</label>
                    <div class="form-text" id="showPulse">-</div>
                    <input type="hidden" class="form-control" id="pulse" name="pulse">
                </div>
                <div class="col-auto">
                    <label for="rate" class="form-label fw-bold">Rate</label>
                    <div class="form-text" id="showRate">-</div>
                    <input type="hidden" class="form-control" id="rate" name="rate">
                </div>
                <div class="col-auto mb-2">
                    <label for="bmi" class="form-label fw-bold">BMI</label>
                    <div class="form-text" id="showBmi">-</div>
                    <input type="hidden" class="form-control" id="bmi" name="bmi">
                </div>
                <div class="col-auto">
                    <label for="bp1" class="form-label fw-bold">BP</label>
                    <div class="input-group">
                        <div class="form-text" id="showBp1">-</div>
                        <div class="form-text"> / </div>
                        <div class="form-text" id="showBp2">-</div>
                    </div>
                    <input type="hidden" class="form-control" id="bp1" name="bp1">
                    <input type="hidden" class="form-control" id="bp2" name="bp2">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-8 col-md-6 col-lg-4">
                    <label for="retinal_date" class="form-label fw-bold">วันที่ได้รับการตรวจตา</label>
                    <input type="date" class="form-control" id="retinal_date" name="retinal_date" placeholder="เซนติเมตร">
                </div>
            </div>
            
            <div class="row mb-3">
                <label class="form-label fw-bold">Retina Exam</label>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input retina-exam" name="retinal" id="retinal1" value="No DR">
                        <label for="retinal1" class="form-check-label">No DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input retina-exam" name="retinal" id="retinal2" value="Mind DR">
                        <label for="retinal2" class="form-check-label">Mind DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input retina-exam" name="retinal" id="retinal3" value="Moderate DR">
                        <label for="retinal3" class="form-check-label">Moderate DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input retina-exam" name="retinal" id="retinal4" value="Severe DR">
                        <label for="retinal4" class="form-check-label">Severe DR</label>
                    </div>
                </div>
            </div>

            <div class="mb-3 row">
                <label class="form-label fw-bold">การรักษา</label>
                <div class="col-auto">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input treatment" name="follow" id="follow1" value="ติดตามอาการ">
                        <label for="follow1" class="form-check-label">ติดตามอาการ</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input treatment" name="follow" id="follow2" value="Laser">
                        <label for="follow2" class="form-check-label">Laser</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input treatment" name="follow" id="follow3" value="other">
                        <div class="input-group">
                            <div>
                                <label for="follow3" class="form-check-label">Other</label>
                            </div>
                            &nbsp;<input type="text" class="form-control form-control-sm" name="followText" id="followText">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="opd_id" id="opd_id" value="">
                <input type="hidden" name="doctor" id="doctor" value="">
                <input type="hidden" name="hn" id="hn" value="<?=$opc['hn'];?>">
                <input type="hidden" class="form-control" id="vn" name="vn">
            </div>
        </form>
        </div>
        <script>
            function selectDate(){
                loadOpday();
            }

            async function loadOpday(){
                await onLoadOpday().then((resHtml)=>{
                    Swal.fire({
                        theme: 'bootstrap-5',
                        title:`เลือกวันที่`,
                        html: `
                            <table width="100%">
                            <tr>
                                <th>วันที่</th>
                                <th>VN</th>
                                <th>แพทย์</th>
                                <th>การมาโรงพยาบาล</th>
                            </tr>
                            ${resHtml}
                            </table>
                        `,
                        focusConfirm: false,
                        showCancelButton: true,
                        cancelButtonColor: "#d33",
                        cancelButtonText: `ปิด`,
                        showConfirmButton: false,
                        // confirmButtonColor: "#3085d6",
                        // confirmButtonText: "Yes, delete it!",
                        allowOutsideClick: false
                    });
                });
            }

            async function onLoadOpday(){
                const hn = '<?=$_POST['hnSearch'];?>';
                const response = await fetch('retinalExam.php?action=getOpd&hn='+hn);
                if (!response.ok) {
                }
                const body = await response.text();
                return body;
            }

            /**
             * fill data to input form
             */
            function selectOpd(t, thaiDate){
                document.getElementById('afterSelectOpd').innerHTML = `( <b>VN:</b> ${t.getAttribute("t-vn")} <b>วันที่</b> ${thaiDate} )`;
                document.getElementById('showHeight').innerHTML = `${t.getAttribute("t-height")} ซม.`;
                document.getElementById('showWeight').innerHTML = `${t.getAttribute("t-weight")} กก.`;
                document.getElementById('showWaist').innerHTML = `${t.getAttribute("t-waist")} ซม.`;
                document.getElementById('showTemp').innerHTML = t.getAttribute("t-temp");
                document.getElementById('showPulse').innerHTML = t.getAttribute("t-pulse");
                document.getElementById('showRate').innerHTML = t.getAttribute("t-rate");
                document.getElementById('showBmi').innerHTML = t.getAttribute("t-bmi");
                document.getElementById('showBp1').innerHTML = t.getAttribute("t-bp1");
                document.getElementById('showBp2').innerHTML = t.getAttribute("t-bp2");

                document.getElementById('opd_id').value = t.getAttribute("opd-id");
                document.getElementById('date').value = t.getAttribute("t-date");
                document.getElementById('retinal_date').value = t.getAttribute("t-date");
                document.getElementById('height').value = t.getAttribute("t-height");
                document.getElementById('weight').value = t.getAttribute("t-weight");
                document.getElementById('waist').value = t.getAttribute("t-waist");
                document.getElementById('temp').value = t.getAttribute("t-temp");
                document.getElementById('pulse').value = t.getAttribute("t-pulse");
                document.getElementById('rate').value = t.getAttribute("t-rate");
                document.getElementById('bmi').value = t.getAttribute("t-bmi");
                document.getElementById('bp1').value = t.getAttribute("t-bp1");
                document.getElementById('bp2').value = t.getAttribute("t-bp2");
                document.getElementById('doctor').value = t.getAttribute("t-doctor");
                
                Swal.close();
            }

            /** ให้โฟกัส input ถ้าคลิกที่ Other */
            document.getElementById('follow3').addEventListener('click', function(){
                document.getElementById('followText').focus();
            });

            /** ถ้าคลิกตัวอื่นให้ลบค่าใน Other */
            let itemTreatment = document.getElementsByClassName('treatment');
            for (let index = 0; index < itemTreatment.length; index++) {
                const el = itemTreatment[index];
                el.onclick = function(){
                    if(itemTreatment[index].value!=='other'){
                        document.getElementById('followText').value = '';
                    }
                }
            }

            /**
             * onsubmit
             */
            let userForm = document.getElementById('userForm');
            userForm.addEventListener('submit',(ev)=>{
                
                ev.preventDefault();

                let dateValue = document.getElementById('date').value;
                let retinalDateValue = document.getElementById('retinal_date').value;

                if(retinalDateValue==''){
                    Swal.fire({
                        title: "กรุณาเลือก วันที่ได้รับการตรวจตา",
                        didClose: ()=>{
                            document.getElementById('retinal_date').focus();
                        }
                    });
                    return false;
                }

                let examItem = document.getElementsByClassName('retina-exam');
                let examTest = false;
                let treatmentItem = document.getElementsByClassName('treatment');
                let treatmentTest = false;

                /** เช็กว่าติ๊กช่องในส่วนของ Retinal แล้วรึยัง */
                let i = 0;
                let examValue = '';
                while (examItem[i]) {
                    if(examItem[i].checked===true){
                        examTest = true;
                        examValue = examItem[i].value;
                    }
                    i++;
                }
                if(examTest===false){
                    Swal.fire({
                        title: "กรุณาเลือกตัวเลือก Retinal Exam"
                    });
                    return false;
                }

                /** เช็กว่าติ๊กในช่อง การรักษาแล้วรึยัง */
                let ii = 0;
                let treatmentValue = '';
                while (treatmentItem[ii]) {
                    if(treatmentItem[ii].checked===true){
                        treatmentTest = true;
                        treatmentValue = treatmentItem[ii].value;
                    }
                    ii++;
                }
                if(treatmentTest===false){
                    Swal.fire({
                        title: "กรุณาเลือกตัวเลือก การรักษา"
                    });
                    return false;
                }
                
                /** 
                 * รวมข้อมูลในฟอร์ม 
                 * @param {Object} formData
                 */
                let formData = {};
                for (let index = 0; index < userForm.elements.length; index++) {
                    const element = userForm.elements[index];
                    if(element.type!=="submit" && element.value !== '' && element.type!=='radio'){
                        formData[element.name] = element.value;
                    }else if(element.type==='radio' && element.checked===true){
                        formData[element.name] = element.value;
                    }
                }
                
                onSave(formData).then((res)=>{
                    if(res.status===200){
                        Swal.fire("บันทึกข้อมูลเรียบร้อย").then(()=>{
                            window.location='retinalExam.php';
                        });
                    }else{
                        Swal.fire({html:`<div><b>Message</b>: ไม่สามารถบันทึกข้อมูลได้</div><div><b>Error</b>: ${res.error.message}</div>`});
                    }
                });
                
                return false;
            });

            async function onSave(formData){
                const response = await fetch('api/Opd.php?action=saveRetinal', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(formData)
                });
                const data = await response.json();
                return data;
            }
        </script>
        <?php
        }else{
        ?>
        <div>
            <div class="alert alert-warning" role="alert">ไม่พบข้อมูล</div>
        </div>
        <?php
        }
    }
    ?>
</div>
</body>
</html>