<?php
session_start();
include("connect.inc");

$foodContainer = (!empty($_POST['food_container'])) ? sprintf("%s", $_POST['food_container']) : '';
$foodContainerText = "ไม่ต้องการแยกภาชนะ";
if($foodContainer=="1"){
	$foodContainerText = "แยกภาชนะ";
}

// $addfood=jschars($_POST['addfood']);
$addfood = htmlspecialchars($_POST['addfood'], ENT_QUOTES);
$food = $_POST['food'];

$regisdate = (date("Y") + 543) . date("-m-d H:i:s");
$sOfficer = $_SESSION["sOfficer"];
$chgcode = "Food";

$bedcode = sprintf("%s", $_POST['bedcode']);


$foodin = $food . ' ' . $addfood.' '.$foodContainerText;
// $cBedcode
$query = "UPDATE bed SET food='$foodin' WHERE bedcode='$bedcode' ";
$result = mysql_query($query) or die("Query failed bed");


$sql_food = "INSERT INTO `ward_log` 
( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` ,  `lastcall` , `office` ) 
VALUES 
( '" . $regisdate . "', '" . $_POST['an'] . "', '" . $_POST['hn'] . "', '" . $_POST['ward'] . "', '" . $_POST['bedcode'] . "','" . $chgcode . "', '" . $_POST['food_old'] . "', '$foodin', '" . $_POST['lastcall'] . "',  '" . $sOfficer . "')";
$result_food = mysql_query($sql_food) or die(mysql_error());
if (!$result) {
    echo "new food fail <br>";
    echo mysql_errno() . ": " . mysql_error() . "\n";
} else {
    print " แก้ไขอาหารใหม่เป็น : $foodin <br>";
    // print "  ปิดหน้าต่างนี้   แล้ว Refresh หน้าต่างหอผู้ป่วยเพื่อทำข้อมูลให้เป็นปัจจุบัน";
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
<?php
include("unconnect.inc");
session_unregister('cBedcode');
session_register("Bedcode");
////
?>