<?php 
require dirname(__FILE__).'/newBootstrap.php';
$json = new Services_JSON();

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    header('Location: login_page.php');
    exit;
}

$q = $dbi->query("SELECT `row_id`,`name` FROM `doctor` ORDER BY `row_id` ASC ");
$doctorList = array();
while ($a = $q->fetch_assoc()) {
    $key = $a['row_id'];
    $doctorList[$key] = $a;
}

function getDigitalOpcard($url){ 
    global $json;
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 3);

    $result = curl_exec( $ch );
    $items = $json->decode($result);
    return $items;
}

$action = sprintf("%s", $_REQUEST['action']);
if($action==='delete'){
    $row_id = sprintf("%s", $_GET['row_id']);
    if(empty($row_id)){
        echo "Row id can not empty";
        exit;
    }
    $sql = "DELETE FROM digital_opcard WHERE row_id = '$row_id' LIMIT 1 ";
    $save = $dbi->query($sql);
    if($save===true){
        $res = array('status'=>200,'msg'=>'แก้ไขข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>404,'msg'=>'Error: '.$dbi->error);
    }
    
    echo $json->encode($res);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลบ digital opdcard</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        body{
            font-family: "TH SarabunPSK";
            font-size:16pt;
        }
        label:hover, input[type="checkbox"]:hover{
            cursor: pointer;
        }
        #myBtn {
            position: fixed; /* Fixed/sticky position */
            bottom: 20px; /* Place the button at the bottom of the page */
            right: 30px; /* Place the button 30px from the right */
            z-index: 9; /* Make sure it does not overlap */
            
            cursor: pointer; /* Add a mouse pointer on hover */

            font-size: 18px; /* Increase font size */
        }
    </style>
    <div class="m-2">
    <?php 
    if (!empty($_SESSION['x-msg'])) {
        ?>
        <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }

    $hn = sprintf("%s", ($_POST['hn'] ? $_POST['hn'] : ''));
    $date = sprintf("%s", ($_POST['date'] ? $_POST['date'] : date('Y-m-d')));
    ?>
        <h3>ลบ digital opdcard</h3>
        <div class="row">
            <div class="col-md-3">
                <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
                    <div class="col-auto">
                        <label for="hn" class="visually-hidden">HN</label>
                        <input type="input" class="form-control form-control-sm" name="hn" id="hn" placeholder="ค้นหาจาก HN" value="<?=$hn;?>">
                    </div>
                        <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3 btn-sm">ค้นหา</button>
                        <input type="hidden" name="page" value="search">
                    </div>
                </form>
            </div>
            <div class="col">
                <form action="digital_opd_manage.php" method="post" id="submitForm" class="row g-3">
                    <div class="col-auto">
                        <label for="date" class="col-form-label col-form-label-sm">วันที่อัพโหลด</label>
                    </div>
                    <div class="col-auto">
                        <input type="date" class="form-control form-control-sm" name="date" id="date" placeholder="เช่น 2024-11-31" value="<?=$date;?>">
                    </div>
                    <div class="col-md-2">
                        <?php 
                        $sql = "SELECT `row_id`,`name` FROM `doctor` WHERE `status` = 'y' AND `doctorcode` <> '' ORDER BY `row_id` ";
                        $q = $dbi->query($sql);
                        ?>
                        <select name="doctor" id="doctor" class="form-select form-select-sm">
                            <option value="">แสดงทุกแพทย์</option>
                            <?php 
                            while ($a = $q->fetch_assoc()) { 
                                $selected = ($a['row_id']==$_POST['doctor']) ? 'selected="selected"' : '' ;
                                ?>
                                <option value="<?=$a['row_id'];?>" <?=$selected;?> ><?=$a['name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <?php 
                        $sql = "SELECT * FROM `clinic`";
                        $q = $dbi->query($sql);
                        ?>
                        <select name="clinic" id="clinic" class="form-select form-select-sm">
                            <option value="">แสดงทุกคลินิก</option>
                            <?php 
                            while ($a = $q->fetch_assoc()) { 
                                $selected = ($a['detail']==$_POST['clinic']) ? 'selected="selected"' : '' ;
                                ?>
                                <option value="<?=$a['detail'];?>" <?=$selected;?> ><?=$a['detail'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <?php 
                        $sql = "SELECT * FROM `sub_clinic` WHERE `status` = 'y' ";
                        $q = $dbi->query($sql);
                        ?>
                        <select name="sub_clinic" id="sub_clinic" class="form-select form-select-sm">
                            <option value="">แสดงทุกคลินิกย่อย</option>
                            <?php 
                            $subClinic = array();
                            while ($a = $q->fetch_assoc()) {
                                $key = $a['row_id'];
                                $subClinic[$key] = $a['clinic_name'];

                                $selected = ($a['row_id']==$_POST['sub_clinic']) ? 'selected="selected"' : '' ;
                                
                                ?>
                                <option value="<?=$a['row_id'];?>" <?=$selected;?> ><?=$a['clinic_name'];?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="col-auto">
                    <?php
                    $sql = "SELECT `name` FROM `inputm` WHERE `status` = 'y' AND `menucode` IN ('ADMOPD','ADMER') ";
                    $q = $dbi->query($sql);
                    ?>
                        <select name="officer" id="officer" class="form-select form-select-sm">
                            <option value="">เลือกตามชื่อเจ้าหน้าที่</option>
                        <?php
                        while ($a = $q->fetch_assoc()) {
                            ?><option value="<?=$a['name'];?>" ><?=$a['name'];?></option><?php
                        }
                        ?>
                        </select>
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-primary mb-3 btn-sm">ค้นหา</button>
                        <input type="hidden" name="page" value="search">
                    </div>
                </form>
            </div>
        </div>
        
        <?php 
        $page = sprintf("%s", $_POST['page']);
        if($page==='search'){
            $hn = sprintf("%s", $_POST['hn']);
            if(!empty($hn)){
                $content = file_get_contents(LARAVEL_API_HOST.'getopcard?opcard_id='.$hn);
                $items = $json->decode($content);
            }

            $date = sprintf("%s", $_POST['date']);
            if(!empty($date)){
                
                $doctor = sprintf("%s", $_POST['doctor']);
                $clinic = sprintf("%s", $_POST['clinic']);
                $sub_clinic = sprintf("%s", $_POST['sub_clinic']);
                $officer = sprintf("%s", $_POST['officer']);
                $sqlDt = '';
                if(!empty($doctor)){
                    $sqlDt .= " AND `doctor` = '$doctor'";
                }
                if(!empty($clinic)){
                    $sqlDt .= " AND `clinic` = '$clinic'";
                }
                if(!empty($sub_clinic)){
                    $sqlDt .= " AND `sub_clinic` = '$sub_clinic'";
                }
                if(!empty($officer)){
                    $sqlDt .= " AND `officer` = '$officer'";
                }
                $items = new stdClass;
                $sql = "SELECT a.*,b.`hn`,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` FROM ( 
                    SELECT * FROM `digital_opcard` WHERE `last_update` LIKE '$date%' $sqlDt 
                ) AS a 
                LEFT JOIN `opcard` AS b ON a.`opcard_id` = b.`row_id`
                ";
                $q = $dbi->query($sql);
                while ($a = $q->fetch_assoc()) {
                    $a['thumbnail'] = 'http://192.168.131.240:8081/storage/thumbnail_'.$a['file_name'];
                    $a['original'] = 'http://192.168.131.240:8081/storage/'.$a['file_name'];
                    $a['upload_date'] = $a['last_update'];
                    $a['type'] = $a['upload_type'];
                    $items->list[] = (object)$a;
                }
            }

            if(!empty($items->list)){
            ?>
            <form action="javascript:void(0);" method="post" id="formPostEdit">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" name="CheckAllBtn" id="CheckAllBtn" title="เลือกทั้งหมด">
                            </th>
                            <th>วันที่เข้ารับการรักษา<br>actual_date</th>
                            <th>HN</th>
                            <th>วันที่บันทึก<br>upload_date</th>
                            <th>clinic</th>
                            <th></th>
                            <th>doctor</th>
                            <th>type</th>
                            <th>officer</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($items->list as $key => $v) {
                        $doctorId = $v->doctor;
                        $row_id = $v->row_id;
                        ?>
                        <tr id="item-<?=$row_id;?>">
                            <td>
                                <input type="checkbox" class="checkboxItem" name="id[]" id="id<?=$row_id;?>" value="<?=$row_id;?>">
                            </td>
                            <td><label for="id<?=$row_id;?>"><?=$v->actual_date;?></label></td>
                            <td><?=$v->hn;?><br><?=$v->ptname;?></td>
                            <td><?=$v->upload_date;?></td>
                            <td><?=$v->clinic;?><br><?=$subClinic[$v->sub_clinic];?></td>
                            <td>
                                <a href="<?=$v->original;?>" target="_blank"><img src="<?=$v->thumbnail;?>" alt="digital opd" height="120"></a>
                            </td>
                            <td><?=$doctorList[$doctorId]['name'];?></td>
                            <td><?=$v->type;?></td>
                            <td><?=$v->officer;?></td>
                            <td>
                                <a href="javascript:void(0);" class="btn btn-primary" onclick="return confirmDelete('<?=$row_id;?>');">ลบ</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary mb-3" id="changeDate">เปลี่่ยนวันที่เข้ารับการรักษา</button>
                        <button type="button" class="btn btn-primary mb-3" id="changeDoctor">เปลี่ยนชือแพทย์</button>
                        <button type="button" class="btn btn-primary mb-3" id="changeClinic">เปลี่ยนคลินิก</button>
                        <input type="hidden" name="date" value="<?=$date;?>" >
                        <input type="hidden" name="doctor" value="<?=$doctor;?>" >
                        <input type="hidden" name="clinic" value="<?=$clinic;?>" >
                        <input type="hidden" name="sub_clinic" value="<?=$sub_clinic;?>" >
                    </div>
                </div>
            </form>
            <?php
            }else{
                ?>
                <div>
                    <p><strong>ไม่พบข้อมูล</strong></p>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <div>
        <button onclick="topFunction()" id="myBtn" title="Go to top" class="btn btn-sm btn-outline-primary" style="font-size:28px;"><i class="bi bi-arrow-up-square-fill"></i></button>
    </div>
    <script src="bootstrap/js/bootstrap.bundle.js"></script>
    <script>
        // Get the button:
        let mybutton = document.getElementById("myBtn");

        // When the user scrolls down 20px from the top of the document, show the button
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }

        window.onload=function(){
            document.getElementById('hn').focus();
        }
        var apiHost = '<?=LARAVEL_API_HOST;?>';
        function confirmDelete(row_id){
            var c = confirm("ยืนยันที่จะลบข้อมูล?");
            if (c===true) {
                deleteDigitalOpcard(row_id)
                // window.location = 'digital_opd_manage.php?action=delete&row_id='+row_id;
            }
            return c;
        }

        async function deleteDigitalOpcard(id){
            // 192.168.131.240:8081
            const response = await fetch(apiHost+'deleteDigitalOpcard/'+id,{method:'DELETE'});
            // const response = await fetch('digital_opd_manage.php?action=delete&row_id='+id);
            const data = await response.json();
            if(data.status===200){ 
                alert('ลบข้อมูลเรียบร้อย');
                document.getElementById('item-'+id).remove();
            }else if(data.status===404){
                alert(data.message);
            }
        }

        document.getElementById('CheckAllBtn').onchange = function(){
            let checkboxItems = document.getElementsByClassName('checkboxItem');
            for (let index = 0; index < checkboxItems.length; index++) {
                const element = checkboxItems[index];
                element.checked = this.checked;
            }
        }

        document.getElementById('changeDate').onclick = function(){
            document.getElementById('formPostEdit').action = 'digital_opd_manage2.php';
            document.getElementById('formPostEdit').submit();
        }

        document.getElementById('changeDoctor').onclick = function(){
            document.getElementById('formPostEdit').action = 'digital_opd_manage_select_doctor.php';
            document.getElementById('formPostEdit').submit();
        }

        document.getElementById('changeClinic').onclick = function(){
            document.getElementById('formPostEdit').action = 'digital_opd_select_clinic.php';
            document.getElementById('formPostEdit').submit();
        }
    </script>
</body>
</html>