<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$allow = array('ADM', 'ADMOPD');
if(!in_array($_SESSION['smenucode'], $allow)){
    echo "Invalid data";
    exit;
}

function getWardName($bedcode){
    $lbedcode=substr($bedcode,0,2);
    if($lbedcode=='42'){
        $wardname="หอผู้ป่วยรวม";	
    }elseif($lbedcode=='43'){
        $wardname="หอผู้ป่วยสูติ";	
    }elseif($lbedcode=='44'){
        $wardname="หอผู้ป่วยICU";	
    }elseif($lbedcode=='45'){
        $wardname="หอผู้ป่วยพิเศษ";	
    }elseif($lbedcode=='46'){
        $wardname="หอผู้ป่วย Cohort Ward";	
    }elseif($lbedcode=='47'){
        $wardname="หอผู้ป่วย Home Isolation";	
    }elseif($lbedcode=='48'){
        $wardname="หอผู้ป่วย รพ.สนาม";	
    }
    return $wardname;
}

$action = sprintf("%s", $_GET['action']);
if ($action==='checkpass') {

    $json = new Services_JSON();

    $pass = sprintf("%s", $_GET['pass']);
    $user = sprintf("%s", $_SESSION['sIdname']);

    $q = $dbi->query("SELECT `row_id` FROM `inputm` WHERE `idname`='$user' AND `pword`='$pass'");
    if($q->num_rows>0){
        $res = array('status'=>200);
    }else {
        $res = array('status'=>400);
    }
 
    echo $json->encode($res);
    exit;

}elseif ($action==='updateIpcard') {

    $hn = sprintf("%s", $_GET['hn']);
    $id = sprintf("%s", $_GET['id']);

    $json = new Services_JSON();

    $thDate = (date('Y')+543).date('-m-d H:i:s');
    $q = $dbi->query("UPDATE `ipcard` SET `dcdate` = '$thDate' WHERE `row_id` = '$id' AND `hn` = '$hn' ");
    if(!$dbi->error){
        $res = array('status'=>200);

    }else{
        $res = array('status'=>400,'message'=>$dbi->error);
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
    <title>ระบบยกเลิกผู้ป่วยใน</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    
<style>
    #navMenu{
        background-color: #13795b;
        color:#ffffff;
    }
</style>
<nav class="navbar navbar-expand-lg" id="navMenu" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="regis_disip.php">ยกเลิกสถานะ</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="regis_disip_list.php">รายชื่อทั้งหมดที่ไม่ได้ยกเลิก</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<?php 
$getHn = sprintf("%s", (!empty($_GET['hn']) ? $_GET['hn'] : '' ) );
?>
<div class="container mt-4">
    <h3>ยกเลิกสถานะผู้ป่วยใน</h3>
    <form action="regis_disip.php" method="post" class="">
        <div class="">
            <div class="mb-3 col-md-3">
                <label for="hn" class="form-label">HN : </label>
                <input type="text" class="form-control" id="hn" name="hn" value="<?=$getHn;?>">
            </div>
            <div class="mb-3 col-md-3">
                <button type="submit" class="btn btn-primary" >ค้นหาข้อมูล</button>
                <input type="hidden" class="" name="page" value="search">
            </div>
        </div>
    </form>
    
    <script>
        function newXmlHttp(){
            var xmlhttp = false;
            try{
                xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                try{
                    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){
                    xmlhttp = false;
                }
            }
            if(!xmlhttp && document.createElement){
                xmlhttp = new XMLHttpRequest();
            }
            return xmlhttp;
        }
    </script>
    <?php 
    $page = sprintf("%s", $_POST['page']);
    if ($page==='search') { 

        $hn = sprintf("%s", $_POST['hn']);
        $q = $dbi->query("SELECT * FROM `bed` WHERE `hn` = '$hn' AND `an` != '' ");
        if($q->num_rows > 0){
            $b = $q->fetch_assoc();
            ?>
            <div class="mt-4">
                <h3>ไม่สามารถยกเลิกได้ เนื่องจากผู้ป่วยยังอยู่ใน  <span class="badge text-bg-warning"><?=getWardName($b['bedcode']);?></span></h3>
                <p><b>AN: </b><?=$b['an'];?></p>
                <p><b>ชื่อ-สกุล: </b><?=$b['ptname'];?></p>
                <p><b>เตียง: </b><?=$b['bed'];?></p>
                <p><b>อายุ: </b><?=$b['age'];?></p>
                <p><b>แพทย์ผู้ดูแล: </b><?=$b['doctor'];?></p>
            </div>
            <?php
        }else{
            $sql = "SELECT * FROM `ipcard` WHERE `hn` = '$hn' AND `dcdate` = '0000-00-00 00:00:00' ORDER BY `row_id` DESC LIMIT 1";
            $q2 = $dbi->query($sql);
            $ipRows = $q2->num_rows;
            $ipUser = array();
            
            if($ipRows>0){

                $ipUser = $q2->fetch_assoc();
                $myHn = $ipUser['hn'];

                ?>
                <div class="mt-4">
                    <h3>ข้อมูลผู้ป่วยในค้างในระบบ</h3>
                    <p><strong>HN: </strong><?=$ipUser['hn'];?></p>
                    <p><b>AN: </b><?=$ipUser['an'];?></p>
                    <p><b>วันที่บันทึก: </b><?=$ipUser['date'];?></p>
                    <p id="btnConfirmDel">
                        <a href="javascript:void(0);" class="btn btn-danger" onclick="return cancelIpcard('<?=$myHn;?>', '<?=$ipUser['row_id'];?>')">คลิกที่นี่เพื่อยืนยันการยกเลิก</a>
                    </p>
                    <p><b id="response"></b></p>
                </div>
                <script>
                    function cancelIpcard(hn,id){
                        var checkPass=prompt("กรุณาใส่รหัสผ่านของท่านเพื่อยืนยันการยกเลิก");
                        if(checkPass===null){
                            return false;
                        }

                        document.getElementById('response').innerHTML = '';

                        var request = new newXmlHttp();
						request.open('GET', 'regis_disip.php?action=checkpass&pass='+checkPass, false);
						request.onreadystatechange = function () {
							if (request.readyState === 4) {
								if (request.status >= 200 && request.status < 400) { 
									var d = JSON.parse(request.responseText);
                                    if(d.status===200){ 
                                        updateIpcard(hn,id);
                                    }else{
                                        document.getElementById('response').innerHTML = '<span class="badge text-bg-warning">รหัสผ่านของท่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</span>';
                                    }
								} else {
									// Error :(
									
								}
							} 
						};
						request.send();

                        
                    }

                    function updateIpcard(hn,id){
                        var request = new newXmlHttp();
                        request.open('GET', 'regis_disip.php?action=updateIpcard&hn='+hn+'&id='+id, false);
						request.onreadystatechange = function () {
							if (request.readyState === 4) {
								if (request.status >= 200 && request.status < 400) { 
									var d = JSON.parse(request.responseText);
                                    if(d.status===200){ 
                                        var msg = '<span class="badge text-bg-success">บันทึกข้อมูลเรียบร้อย</span>';
                                        document.getElementById('btnConfirmDel').remove();
                                    }else{
                                        var msg = '<span class="badge text-bg-warning">'+d.message+'</span>';
                                    }

                                    document.getElementById('response').innerHTML = msg;
								} else {
									// Error :(
									
								}
							} 
						};
						request.send();
                    }
                </script>
                <?php
            }elseif($ipRows==1){
                list($dcDate, $dcTime) = explode(' ', $ipUser['dcdate']);
                ?>
                <div class="mt-4">
                    <div class="alert alert-danger" role="alert">ผู้ป่วยได้ D/C ไปแล้วเมื่อวันที่ <?=$dcDate;?> เวลา <?=$dcTime;?></div>
                </div>
                <?php
            }else{
                ?>
                <div class="mt-4"><div class="alert alert-danger" role="alert">ไม่พบข้อมูล</div></div>
                <?php
            }

        }
    }
    ?>

</div>
</body>
</html>