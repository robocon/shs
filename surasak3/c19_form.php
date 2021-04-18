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
ROW_FORMAT=DYNAMIC;

ALTER TABLE `c19_patients` ADD `toborow` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD `countdown_c19` datetime NULL DEFAULT NULL ;

ALTER TABLE `c19_patients` ADD `staff_edit` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
ADD `date_edit` datetime NULL DEFAULT NULL ;

*/
require_once 'bootstrap.php'; 

if(empty($_SESSION['sOfficer']))
{
    echo '������ء����ҹ ��س�<a href="../nindex.htm">Login</a>�ա����';
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES tis620");
function calcage($birth)
{

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
}
elseif ($action=='save') 
{
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
    $form_type = $_POST['form_type'];

    if($form_type=='save')
    {
        $sql = "INSERT INTO `c19_patients` (
            `id`, `date`, `hn`, `ptname`, `age`, `doctor`, 
            `staff`, `vaccine_name`, `lot_no`, `serial_no`, `vaccine_plant_no`, `toborow`, 
            `countdown_c19`
        ) VALUES (
            NULL, '$date', '$hn', '$ptname', '$age', '$doctor', 
            '$staff', '$vaccine_name', '$lot_no', '$serial_no', '$vaccine_plan_no', '$toborow', 
            '$countdown_c19');";
        
    }
    elseif ($form_type=='edit') 
    {
        $c19_id = (int) $_POST['id'];

        $sql = "UPDATE `c19_patients` SET 
        `hn`='$hn', 
        `ptname`='$ptname', 
        `age`='$age', 
        `doctor`='$doctor', 
        `vaccine_name`='$vaccine_name', 
        `lot_no`='$lot_no', 
        `serial_no`='$serial_no', 
        `vaccine_plant_no`='$vaccine_plan_no',
        `staff_edit` = '$staff',
        `date_edit` = '$date'
        WHERE ( `id`='$id' );";
        
    }

    $save = $dbi->query($sql);
    if($save==false)
    {
        $msg = "�ѹ�֡�������������� Error: ".$dbi->error;
    }
    
    redirect('c19_form.php', $msg);
    exit;
}

$load_page = $_GET['load_page'];
if ($load_page=='load_edit_list') 
{
    $now = date('Y-m-d');
    $sql = "SELECT * FROM `c19_patients` WHERE `date` LIKE '$now%' ORDER BY `id` DESC ";
    $qpt = $dbi->query($sql);
    if($qpt->num_rows > 0)
    {
        ?>
        <p>&nbsp;</p>
        <table class="w3-table-all">
            <tr>
                <th>�ѹ���</th>
                <th>HN</th>
                <th>����-ʡ��</th>
                <th>���</th>
            </tr>
            <?php 
            while ($item = $qpt->fetch_assoc()) 
            {
                ?>
                <tr>
                    <td><?=$item['date'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><a class="load_edit_form" data-id="<?=$item['id'];?>" href="#"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
                </tr>
                <?php
            }
            ?>
        </table>
        <p>&nbsp;</p>
        <?php 
    }
    else
    {
        ?><p>�ѧ����բ�����</p><?php
    }
    exit;
}
elseif ($load_page=='load_edit_form') 
{
    
    $id = (int)$_GET['id'];
    if(!empty($id))
    {
        $query = $dbi->query("SELECT * FROM `c19_patients` WHERE `id` = '$id' ");
        $pt = $query->fetch_assoc();
        $form_type = 'edit';
        require_once 'c19_form_layout.php';
        // dump($pt);
        ?>

        <?php
    }
    else
    {
        echo "��辺������";
    }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <style>
        label:hover{
            cursor: pointer;
        }
    </style>
    <div class="w3-container w3-teal w3-bar w3-xlarge">
        <a href="../nindex.htm" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;" title="��Ѻ˹����ѡ"><i class="fa fa-home" aria-hidden="true"></i></a>
        <a href="javascript:void(0);" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;">������ѹ�֡�����š�éմ�Ѥ�չ��Դ 19</a>
        <a href="javascript:void(0);" onclick="edit_patient_load()" class="w3-bar-item w3-right w3-button" style="text-shadow: 2px 2px 2px #444;">���</a>
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
        <form class="w3-container" id="c19_admin_form" method="POST" action="c19_form.php">
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
                <?php 
                $manufacturer_lists = array(
                    '1' => 'AstraZeneca', '7' => 'Sinovac Life Sciences'
                );
                foreach ($manufacturer_lists as $key => $fac) { 
                    $checked = ('Sinovac Life Sciences'==$fac) ? 'checked="checked"' : '' ;
                    ?>
                    <div class="w3-third">
                        <label><input class="w3-radio" type="radio" name="vaccine_name" value="<?=$fac;?>" <?=$checked;?> > <?=$fac;?></label>
                    </div>
                    <?php
                }
                ?>
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

                <?php 
                $plan_count_list = array(1,2);
                foreach ($plan_count_list as $key => $plan) {
                    $plan_checked = (1==$plan) ? 'checked="checked"' : '';
                    ?>
                    <div class="w3-third">
                        <label><input class="w3-radio" type="radio" name="vaccine_plan_no" value="<?=$plan;?>" <?=$plan_checked;?> > ������ <?=$plan;?></label>
                    </div>
                    <?php
                }
                ?>
            </div>

            <p>
                <button class="w3-btn w3-teal" type="submit">�ѹ�֡������</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="form_type" value="save">
            </p>
        </form>

        <!-- The Modal -->
        <div id="id01" class="w3-modal">
            <div class="w3-modal-content w3-animate-top">

                <header class="w3-container w3-teal">
                    <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
                    <h2>��¡�÷���ͧ������</h2>
                </header>
                <!-- load data from ajax -->
                <div class="w3-container" id="form_load_data"></div>
            </div>
        </div>

    </div>
    <script>
        // event listener support IE8
        function addEventListener(el, eventName, handler) {
            if (el.addEventListener) {
                el.addEventListener(eventName, handler);
            } else {
                el.attachEvent('on' + eventName, function(){
                    handler.call(el);
                });
            }
        }

        // ajax with GET method
        function xmlHttpGET(url, functionName){
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        // Success!
                        functionName(this);
                    } else {
                        // Error :(
                    }
                }
            };
            xhttp.open('GET', url, true);
            xhttp.send();
            xhttp = null;
        }

        /**
         * onblur �е�Ǩ�ͺ�����Ũҡ HN �����ʴ�������͹
         */
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
        
        /**
         * �ʴ���ª��ͷ������
         */
        function edit_patient_load()
        {
            xmlHttpGET("c19_form.php?load_page=load_edit_list", display_patient_list);
        }
        function display_patient_list(xhttp){
            document.getElementById("form_load_data").innerHTML = xhttp.responseText;

            // open modal
            document.getElementById('id01').style.display='block';

            var edit_items = document.getElementsByClassName("load_edit_form");
            if(edit_items.length > 0)
            {
                for (let index = 0; index < edit_items.length; index++) {
                    edit_items[index].addEventListener("click", open_patient_edit);
                }
            }
        }
        
        /**
         * �Դ˹�ҿ�������
         */
        var open_patient_edit = function()
        {
            var patient_id = this.getAttribute("data-id");
            xmlHttpGET("c19_form.php?load_page=load_edit_form&id="+patient_id, load_data_form);
        };
        function load_data_form(xhttp)
        {
            document.getElementById("form_load_data").innerHTML = xhttp.responseText;
        }
        
        /**
         * ��Ǩ�ͺ��������ѹ�֡������
         */
        document.getElementById("c19_admin_form").addEventListener("submit", function(ev) { 
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
        });

    </script>
</body>
</html>