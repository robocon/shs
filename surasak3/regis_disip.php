<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

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
    $user = $_SESSION['sIdname'];

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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>ระบบยกเลิกผู้ป่วยใน</title>
</head>
<body>
    <div class="w3-bar w3-teal">
        <a href="../nindex.htm" class="w3-bar-item w3-button">หน้าหลัก</a>
    </div>
    <div class="w3-container w3-margin-top">
        <div><h3>ยกเลิกสถานะผู้ป่วยใน</h3></div>
        <form action="regis_disip.php" method="post" class="row">
            <div class="w3-col s8 m4">
                <p>
                    <label for="hn">HN </label>
                    <input type="text" name="hn" id="hn" class="w3-input">
                </p>
                <p>
                    <button type="submit" class="w3-btn w3-round w3-teal" >ค้นหาข้อมูล</button>
                    <input type="hidden" name="page" value="search">
                </p>
            </div>
        </form>
    </div>
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
            <div class="w3-container">
                <p><b>ไม่สามารถยกเลิกได้ เนื่องจากผู้ป่วยยังอยู่ใน<u class="w3-text-red"><?=getWardName($b['bedcode']);?></u></b></p>
                <p><b>AN: </b><?=$b['an'];?></p>
                <p><b>ชื่อ-สกุล: </b><?=$b['ptname'];?></p>
                <p><b>เตียง: </b><?=$b['bed'];?></p>
                <p><b>อายุ: </b><?=$b['age'];?></p>
            </div>
            <?php
        }else{
            $sql = "SELECT * FROM `ipcard` WHERE `hn` = '$hn' AND `dcdate` = '0000-00-00 00:00:00' ORDER BY `row_id` DESC LIMIT 1";
            $q2 = $dbi->query($sql);
            $ipRows = $q2->num_rows;
            $ipUser = array();
            if ($ipRows>0) {
                $ipUser = $q2->fetch_assoc();
                $myHn = $ipUser['hn'];
            }
            if($ipRows>0){
                ?>
                <div class="w3-container">
                    <p><b>ข้อมูลผู้ป่วยในค้างในระบบ</b></p>
                    <p><b>AN: </b><?=$ipUser['an'];?></p>
                    <p><b>วันที่บันทึก: </b><?=$ipUser['date'];?></p>
                    <p>
                        <a href="javascript:void(0);" class="w3-btn w3-red w3-round" onclick="return cancelIpcard('<?=$myHn;?>', '<?=$ipUser['row_id'];?>')">คลิกที่นี่เพื่อยืนยันการยกเลิก</a>
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
                                        document.getElementById('response').innerHTML = '<span class="w3-orange">รหัสผ่านของท่านไม่ถูกต้อง กรุณาลองใหม่อีกครั้ง</span>';
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
                                        var msg = '<span class="w3-green">บันทึกข้อมูลเรียบร้อย</span>';
                                    }else{
                                        var msg = '<span class="w3-orange">'+d.message+'</span>';
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
                <div class="w3-container">
                    <p><b>ผู้ป่วยได้ D/C ไปแล้วเมื่อวันที่ <?=$dcDate;?> เวลา <?=$dcTime;?></b></p>
                </div>
                <?php
            }else{
                ?>
                <div class="w3-container"><p><b>ไม่พบข้อมูล</b></p></div>
                <?php
            }

        }
    }
    ?>
</body>
</html>