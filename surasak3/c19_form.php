<?php 
/*

CREATE TABLE `c19_patients` (
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


ALTER TABLE `c19_patients` ADD `toborow` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD `countdown_c19` datetime NULL DEFAULT NULL ;

*/
include 'bootstrap.php'; 

if(empty($_SESSION['sOfficer']))
{
    echo '������ء����ҹ ��س�<a href="../nindex.htm">Login</a>�ա����';
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES tis620");
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

    return $pAge;
}


$action = $_POST['action'];
if($action=="test_hn")
{
    $hn = $_POST['hn'];

    $sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`dbirth` FROM `opcard` WHERE `hn` = '$hn' ";
    $opcard_q = $dbi->query($sql);
    if($opcard_q->num_rows > 0)
    {
        $opcard = $opcard_q->fetch_assoc();
        
        $th_date_hn = date('d-m-').(date('Y')+543).$opcard['hn'];
        $opday_q = $dbi->query("SELECT `toborow` FROM `opday` WHERE `thdatehn` = '$th_date_hn' AND `toborow` LIKE 'EX52%' ");
        if ($opday_q->num_rows > 0) 
        {
            $opday = $opday_q->fetch_assoc();
            echo $opcard['ptname'].' ����:'.calcage($opcard['dbirth']).' OPD CARD:'.$opday['toborow'];
        }
        else
        {
            echo $dbi->error." �������ѧ�����ŧ����¹ EX52 �մ�Ѥ�չ��Դ 19";
        }
    }
    else
    {
        echo $dbi->error." ��辺 HN ��سҵ�Ǩ�ͺ�������ա����";
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
    }

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
    $countdown_c19 = date('Y-m-d H:i:s', strtotime("+30 minutes"));

    $msg = "�ѹ�֡���������º����";
    $sql = "INSERT INTO `c19_patients` (
        `id`, `date`, `hn`, `ptname`, `age`, `doctor`, 
        `staff`, `vaccine_name`, `lot_no`, `serial_no`, `vaccine_plant_no`, `toborow`, 
        `countdown_c19`
    ) VALUES (
        NULL, '$date', '$hn', '$ptname', '$age', '$doctor', 
        '$staff', '$vaccine_name', '$lot_no', '$serial_no', '$vaccine_plan_no', '$toborow', 
        '$countdown_c19');";
    $save = $dbi->query($sql);
    if($save==false)
    {
        $msg = "�ѹ�֡�������������� Error: ".$dbi->error;
    }
    
    redirect('c19_form.php', $msg);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>������ѹ�֡�����š�éմ�Ѥ�չ��Դ19</title>

    <link rel="stylesheet" href="w3.css">
</head>
<body>
    <style>
        label:hover{
            cursor: pointer;
        }
    </style>
    <div class="w3-container w3-teal w3-bar">
        <h2 class="w3-bar-item" style="text-shadow: 2px 2px 2px #444;">������ѹ�֡�����š�éմ�Ѥ�չ��Դ 19</h2>
    </div>

    <?php 
    if(!empty($_SESSION['x-msg']))
    {
        ?>
        <div class="w3-panel w3-yellow w3-border">
        <p><?=$_SESSION['x-msg'];?></p>
        </div>
        <?php 
        $_SESSION['x-msg'] = null;
    }
    ?>
    
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
                <p class="w3-large w3-text-teal" id="display-name-text">��·��ͺ ���ͧ</p>
            </div>
            <p>      
                <label class="w3-text"><b>����ᾷ��</b></label>
                <select class="w3-select w3-border" id="doctor" name="doctor">
                    <option value="" disabled selected>���͡ᾷ��</option>
                    <?php 
                    $sql = "SELECT * FROM `doctor` WHERE `status` = 'y' AND `name` LIKE 'MD%' AND (`doctorcode` NOT LIKE '0000%' AND `doctorcode` REGEXP '[0-9]{5}')  ";
                    $dt_q = $dbi->query($sql);
                    while ($dt = $dt_q->fetch_assoc()) {
                        ?><option value="<?=trim($dt['name']);?>"><?=$dt['name'];?></option><?php 
                    }
                    ?>
                </select>
            </p>

            <p><b>�Ѥ�չ��Դ 19</b></p>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_name_1" name="vaccine_name" value="AstraZeneca">
                    <label for="vaccine_name_1">AstraZeneca</label>
                </div>
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_name_2" name="vaccine_name" value="Sinovac Life Sciences" checked>
                    <label for="vaccine_name_2">Sinovac Life Sciences</label>
                </div>
            </div>

            <p><b>Lot ��� Serial</b></p>
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

            <p><b>������</b></p>
            <div class="w3-row-padding">
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_plan_no_1" name="vaccine_plan_no" value="1" checked>
                    <label for="vaccine_plan_no_1">������ 1</label>
                </div>
                <div class="w3-third">
                    <input class="w3-radio" type="radio" id="vaccine_plan_no_2" name="vaccine_plan_no" value="2" >
                    <label for="vaccine_plan_no_2">������ 2</label>
                </div>
            </div>

            <p>
                <a href="../nindex.htm" class="w3-btn w3-teal w3-round">&lt;&lt;&nbsp;��Ѻ˹����ѡ</a>
                <button class="w3-btn w3-teal" type="submit">�ѹ�֡������</button>
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
                alert("��س���� HN");
                id_hn.focus();
                ev.preventDefault();
            }
            else if( id_doctor.value.trim() == '' )
            {
                alert("��س����͡ᾷ��");
                ev.preventDefault();
            }
            else if( lot_no.value.trim() == '' )
            {
                alert("��س���� Lot Number");
                lot_no.focus();
                ev.preventDefault();
            }
            else if( serial_no.value.trim() == '' )
            {
                alert("��س���� Serial Number");
                serial_no.focus();
                ev.preventDefault();
            }

            return false;
        });


    </script>
</body>
</html>