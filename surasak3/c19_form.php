<?php 
/*

CREATE TABLE `c19_vaccine` (
`id`  int(11) NOT NULL AUTO_INCREMENT,
`date`  datetime NULL DEFAULT NULL ,
`hn`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`ptname`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`age`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`doctor`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`staff`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`vaccine_name`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`lot_no`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`serial_no`  varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`vaccine_plant_no`  int(11) NULL DEFAULT NULL ,
PRIMARY KEY (`id`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=DYNAMIC
;


ALTER TABLE `c19_vaccine` ADD `toborow` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD `status_c19` VARCHAR( 5 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD `countdown_c19` datetime NULL DEFAULT NULL ;

*/
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

    return $pAge;
}


$action = $_POST['action'];
if($action=="test_hn")
{
    $hn = $_POST['hn'];

    $sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ";
    $opcard_q = $dbi->query($sql);
    if($opcard_q->num_rows > 0)
    {
        $opcard = $opcard_q->fetch_assoc();
        
        $th_date_hn = date('d-m-').(date('Y')+543).$opcard['hn'];
        $opday_q = $dbi->query("SELECT `toborow` FROM `opday` WHERE `thdatehn` = '$th_date_hn' AND `toborow` LIKE 'EX52%' ");
        if ($opday_q->num_rows > 0) 
        {
            $opday = $opday_q->fetch_assoc();
            echo $opcard['ptname'].' '.$opday['toborow'];
        }
        else
        {
            echo $dbi->error." ผู้ป่วยยังไม่ได้ลงทะเบียน EX52 ฉีดวัคซีนโควิด 19";
        }
    }
    else
    {
        echo $dbi->error." ไม่พบ HN กรุณาตรวจสอบข้อมูลอีกครั้ง";
    }
    
    exit;
}elseif ($action=='save') {

    $hn = $_POST['hn'];
    $sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`ptright1`,`dbirth` FROM `opcard` WHERE `hn` = '$hn' ";
    $op_q = $dbi->query($sql);
    $item = $op_q->fetch_assoc();

    $th_date_hn = date('d-m-').(date('Y')+543).$item['hn'];
    $opday_q = $dbi->query("SELECT `toborow` FROM `opday` WHERE `thdatehn` = '$th_date_hn' AND `toborow` LIKE 'EX52%' ");
    if ($opday_q->num_rows > 0) 
    {
        $opday = $opday_q->fetch_assoc();
        // echo $opcard['ptname'].' '.$opday['toborow'];
    }

    dump($item);
    dump($opday);

    $doctor = $_POST['doctor'];
    $vaccine_name = $_POST['vaccine_name'];
    $lot_no = $_POST['lot_no'];
    $serial_no = $_POST['serial_no'];
    $vaccine_plan_no = $_POST['vaccine_plan_no'];

    $staff = $_SESSION['sOfficer'];
    $age = calcage($item['dbirth']);
    $date = date('Y-m-d H:i:s');
    $ptname = trim($item['ptname']);
    $toborow = trim($opday['toborow']);
    $status_c19 = 'n';
    $countdown_c19 = date('Y-m-d H:i:s', strtotime("+30 minutes"));

    $sql = "INSERT INTO `c19_vaccine` (
        `id`, `date`, `hn`, `ptname`, `age`, `doctor`, 
        `staff`, `vaccine_name`, `lot_no`, `serial_no`, `vaccine_plant_no`, `toborow`, 
        `status_c19`, `countdown_c19`
    ) VALUES (
        NULL, '$date', '$hn', '$ptname', '$age', '$doctor', 
        '$staff', '$vaccine_name', '$lot_no', '$serial_no', '$vaccine_plan_no', '$toborow', 
        '$status_c19', '$countdown_c19');";
    $test = $dbi->query($sql);
    if($test==false)
    {
        echo $dbi->error;
    }
    dump($test);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฟอร์มบันทึกข้อมูลการฉีดวัคซีนโควิด19</title>

    <link rel="stylesheet" href="w3.css">
</head>
<body>
    <style>
        label:hover{
            cursor: pointer;
        }
    </style>
    <?php 
    // dump($_SESSION);
    ?>
    <div class="w3-container w3-teal w3-bar">
        <h2 class="w3-bar-item">ฟอร์มบันทึกข้อมูลการฉีดวัคซีนโควิด19</h2>
    </div>
    
    <div class="w3-card-4">
        <!-- <div class="w3-container w3-teal">
            <h2>Input Colors</h2>
        </div> -->
        <form class="w3-container" id="c19_form" method="POST" action="c19_form.php">
            <p>      
                <label class="w3-text"><b>HN</b></label>
                <input class="w3-input w3-border w3-light-grey" id="hn" name="hn" type="text">
            </p>
            <div id="display-name" style="display: none;">
                <p class="w3-large w3-text-teal" id="display-name-text">นายทดสอบ ทดลอง</p>
            </div>
            <p>      
                <label class="w3-text"><b>ชื่อแพทย์</b></label>
                <select class="w3-select w3-border" id="doctor" name="doctor">
                    <option value="" disabled selected>เลือกแพทย์</option>
                    <?php 
                    $sql = "SELECT * FROM `doctor` WHERE `status` = 'y' AND `name` LIKE 'MD%' AND `menucode` = 'ADM' ";
                    $dt_q = $dbi->query($sql);
                    while ($dt = $dt_q->fetch_assoc()) {
                        ?><option value="<?=trim($dt['name']);?>"><?=$dt['name'];?></option><?php 
                    }
                    ?>
                </select>
            </p>

            <p><b>วัคซีน</b></p>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_name_1" name="vaccine_name" value="AstraZeneca">
                    <label for="vaccine_name_1">AstraZeneca</label>
                </div>
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_name_2" name="vaccine_name" value="Sinovac" checked>
                    <label for="vaccine_name_2">Sinovac Life Sciences</label>
                </div>
            </div>

            <p><b>Lot และ Serial</b></p>
            <div class="w3-row-padding">
                <div class="w3-half">
                    <label>Lot.No.</label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="lot_no" name="lot_no">
                </div>
                <div class="w3-half">
                    <label>Serial No.</label>
                    <input class="w3-input w3-border w3-light-grey" type="text" id="serial_no" name="serial_no">
                </div>
            </div>

            <p><b>เข็มที่</b></p>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_plan_no_1" name="vaccine_plan_no" value="1" checked>
                    <label for="vaccine_plan_no_1">เข็มที่ 1</label>
                </div>
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_plan_no_2" name="vaccine_plan_no" value="2" >
                    <label for="vaccine_plan_no_2">เข็มที่ 2</label>
                </div>
            </div>

            <p>
                <button class="w3-btn w3-teal" type="submit">บันทึกข้อมูล</button>
                <input type="hidden" name="action" value="save">
            </p>
        </form>
    </div>
    <script>
        function addEventListener(el, eventName, handler) {
            if (el.addEventListener) {
                el.addEventListener(eventName, handler);
            } else {
                el.attachEvent('on' + eventName, function(){
                    handler.call(el);
                });
            }
        }

        document.getElementById("hn").addEventListener("blur", function() {
            
            var request = new XMLHttpRequest();
            request.open('POST', 'c19_form.php', true);
            request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded; charset=UTF-8');
            request.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {

                        document.getElementById("display-name-text").innerHTML = this.responseText;
                        document.getElementById("display-name").style.display = '';

                    } else {
                        // Error :(
                    }
                }
            };
            request.send("action=test_hn&hn="+this.value);

        });

        document.getElementById("c19_form").addEventListener("submit", function(ev) { 
            var id_hn = document.getElementById("hn");
            var id_doctor = document.getElementById("doctor");
            var lot_no = document.getElementById("lot_no");
            var serial_no = document.getElementById("serial_no");

            if(id_hn.value.trim() == '')
            {
                alert("กรุณาใส่ HN");
                id_hn.focus();
                ev.preventDefault();
            }
            else if( id_doctor.value.trim() == '' )
            {
                alert("กรุณาเลือกแพทย์");
                ev.preventDefault();
            }
            else if( lot_no.value.trim() == '' )
            {
                alert("กรุณาใส่ Lot Number");
                lot_no.focus();
                ev.preventDefault();
            }
            else if( serial_no.value.trim() == '' )
            {
                alert("กรุณาใส่ Serial Number");
                serial_no.focus();
                ev.preventDefault();
            }

            return false;
        });


    </script>
</body>
</html>