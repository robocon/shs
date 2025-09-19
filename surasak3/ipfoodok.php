<?php
include dirname(__FILE__).'/bootstrap.php';

$foodContainer = (!empty($_POST['food_container'])) ? sprintf("%s", $_POST['food_container']) : '';
$foodContainerText = "ไม่ต้องการแยกภาชนะ";
if($foodContainer=="1"){
	$foodContainerText = "แยกภาชนะ";
}

$addfood = htmlspecialchars($_POST['addfood'], ENT_QUOTES);
$food = $_POST['food'];

$regisdate = (date("Y") + 543) . date("-m-d H:i:s");
$sOfficer = $_SESSION["sOfficer"];
$chgcode = "Food";

$bedcode = sprintf("%s", $_POST['bedcode']);

$foodin = $food . ' ' . $addfood.' '.$foodContainerText;

$query = "UPDATE bed SET food='$foodin' WHERE bedcode='$bedcode' ";
$result = $dbi->query($query);
if($result===false){
    echo 'Error ['.$dbi->errno."] ".$dbi->error . "<br>";
}


$sql_food = "INSERT INTO `ward_log` 
( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` ,  `lastcall` , `office` ) 
VALUES 
( '$regisdate', '" . $_POST['an'] . "', '" . $_POST['hn'] . "', '" . $_POST['ward'] . "', '" . $_POST['bedcode'] . "','$chgcode', '" . $_POST['food_old'] . "', '$foodin', '" . $_POST['lastcall'] . "',  '$sOfficer')";
$result_food = $dbi->query($sql_food);
if (!$result_food) {
    echo "ward_log Error: <br>";
    echo '['.$dbi->errno."] ".$dbi->error . "<br>";
} else {
    echo " แก้ไขอาหารใหม่เป็น : $foodin <br>";
}

?>
<script type="text/javascript">
    function timedMsg() {
        setTimeout("count();", 1000);
    }

    function count() {

        if (eval(document.all['mysdiv'].innerHTML) == 1) {
            window.close();
            window.opener.location.reload();
        } else {
            document.all['mysdiv'].innerHTML = eval(document.all['mysdiv'].innerHTML) - 1;
            timedMsg();
        }

    }

    window.onload = function () {
        timedMsg();
    }
</script>
<br />
<br />
ระบบปิดหน้าต่างใน <span id="mysdiv">5</span> วินาที