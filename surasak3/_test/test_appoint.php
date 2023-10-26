<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_appoint.php';

$app = new Appoint();
$date = '2566-10-10';
// $date = '';
// $res = $app->getDisAppoint($date);

$page = $_REQUEST['page'];
if($page==='loadCalendar'){ 
    $doctorCode = '12891';
    $today=$_REQUEST['today'];
    $dfMonth=$_REQUEST['dfMonth'];
    $dfYear=$_REQUEST['dfYear'];
    $app->getCalendar($doctorCode,$today,$dfMonth,$dfYear);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div id="test_calendar_main">
    <?php
    $doctorCode = '12891';
    $app->getCalendar($doctorCode);
    ?>
    </div>
    <script>
        function request_calendar(selector, path) { 
            var request = new XMLHttpRequest();
            request.open('GET', path, true);
            request.onreadystatechange = function () {
                if (this.readyState === 4) {
                    if (this.status >= 200 && this.status < 400) {
                        document.getElementById(selector).innerHTML = request.responseText;
                    } else {
                        // Error :(
                    }
                }
            };
            request.send();
        }
        function show_carlendar(url){
            request_calendar('test_calendar_main','test_appoint.php?page=loadCalendar&'+url);
        }
    </script>
</body>
</html>
