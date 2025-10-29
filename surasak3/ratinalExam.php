<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_opcard.php';
include_once dirname(__FILE__).'/class_file/class_opd.php';

if(empty($_SESSION['sOfficer'])){
    include_once 'pageNotFound.php';
    exit;
}

$opcard = new Opcard();
$opd = new Opd();

$action = $_GET['action'];
if($action == 'getOpd'){

    $items = $opd->last3MonthsFromHn('53-9604');
    if(!empty($items)){
        foreach ($items as $a) {
            ?>
            <tr>
                <td><a href="javascript:void(0);" class="mr-2" onclick=""><?=substr($a['thidate'],0,10);?></a>&nbsp;&nbsp;</td>
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
    <title>Ratinal Exam</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
        #opdTb tr th{
            background-color: #13795b;
            color:#ffffff;
        }
        label:hover{
            cursor: pointer;
        }
        fieldset{
            border: 1px solid red;
        }
    </style>
    <nav class="navbar navbar-expand-lg" id="" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm">🏠</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">รายชื่อ</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <div>
        <h3>ฟอร์มกรอกข้อมูล Ratinal Exam</h3>
        <form class="row g-3 col-lg-12 mt-2" action="ratinalExam.php" method="POST">
            <div class="mb-2 row">
                <label for="hn" class="col-sm-4 col-md-3 col-form-label fw-bold">ค้นหาจาก HN</label>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="hn" name="hn">
                        <button class="btn btn-secondary" type="submit">ค้นหา</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="page" value="search">
        </form>
    </div>
    
    <?php
    $page = sprintf("%s", $_POST['page']);
    if(!empty($page) && $page==="search"){
        $opc = $opcard->getByHn($_POST['hn'],array('`hn`','`ptright`'));
        if($opc!==false){
        ?>
        <div class="mt-4">
        <form class="row g-3 col-lg-12" action="ratinalExam.php" method="post">
            <div class="mb-2 row">
                <label for="date" class="col-sm-4 col-md-3 col-form-label fw-bold">ข้อมูลเบื้องต้น</label>
                <div class="col-auto">
                    <table>
                        <tr>
                            <td class="text-end"><strong>HN: </strong></td>
                            <td><?=$opc['hn'];?></td>
                            <td class="text-end"><strong>ชื่อ-สกุล: </strong></td>
                            <td><?=$opc['ptname'];?></td>
                        </tr>
                        <tr>
                            <td class="text-end"><strong>สิทธิ: </strong></td>
                            <td><?=$opc['ptright'];?></td>
                            <td class="text-end"><strong>อายุ: </strong></td>
                            <td><?=$opc['age'];?>ปี</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="date" class="col-sm-4 col-md-3 col-form-label fw-bold">วันที่มารับบริการ</label>
                <div class="col-auto">
                    <div class="input-group">
                        <input type="text" class="form-control" id="date" name="date">
                        <button class="btn btn-secondary" type="button" onclick="selectDate()">เลือกวันที่</button>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label class="col-sm-4 col-md-3 col-form-label fw-bold">ข้อมูลซักประวัติ</label>
                <div class="col-sm-6 col-md-7">
                    <div class="form-floating ">
                        <input type="email" class="form-control" id="height" placeholder="ส่วนสูง">
                        <label for="height">ส่วนสูง</label>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label class="col-sm-4 col-md-3 col-form-label fw-bold">Retina Exam</label>
                <div class="col-sm-6 col-md-7 border-bottom">
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal1" value="No DR">
                        <label for="retinal1" class="form-check-label">No DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal2" value="Mind DR">
                        <label for="retinal2" class="form-check-label">Mind DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal3" value="Moderate DR">
                        <label for="retinal3" class="form-check-label">Moderate DR</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal4" value="Severe DR">
                        <label for="retinal4" class="form-check-label">Severe DR</label>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="date" class="col-sm-4 col-md-3 col-form-label fw-bold">การรักษา</label>
                <div class="col-sm-8 col-md-5">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow1" value="ติดตามอาการ">
                        <label for="follow1" class="form-check-label">ติดตามอาการ</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow2" value="Laser">
                        <label for="follow2" class="form-check-label">Laser</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow3" value="other">
                        <div class="input-group">
                            <div>
                                <label for="follow3" class="form-check-label">Other</label>
                            </div>
                            &nbsp;<input type="text" class="form-control form-control-sm" name="followText" id="followText">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
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
                                <th>มาใช้บริการ</th>
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
                const hn = '<?=$_POST['hn'];?>';
                const response = await fetch('ratinalExam.php?action=getOpd&hn='+hn);
                if (!response.ok) {
                }
                const body = await response.text();
                return body;
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