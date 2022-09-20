<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = $_REQUEST['action'];
if($action==='search'){

    $code = $dbi->escape_string($_GET['code']);
    $items = array();
    $q = $dbi->query("SELECT `code`,`detail` FROM `labcare` WHERE `code` LIKE '%$code%' OR `detail` LIKE '$code%' OR `olddetail` LIKE '$code%' ");
    if($q->num_rows > 0){
        while ($a = $q->fetch_assoc()) {
            $items[] = $a;
        }
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($items);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค้นหาหัตถการจากแพทย์</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <script src="https://kit.fontawesome.com/1b08157ef3.js" crossorigin="anonymous"></script>
</head>
<body>

<style>
    *{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-size: 18px;
    }
    h3,h4{
        font-family: "TH Sarabun New","TH SarabunPSK";
        font-weight: bold;
    }
    label,legend{
        font-weight: bold;
    }
</style>

<?php 
$page = $_REQUEST['page'];
if($page == ''){

?>


<div class="w3-bar w3-light-grey">
        <a href="#" class="w3-bar-item w3-button" title="หน้าหลัก"><i class="fa-solid fa-house"></i></a>
        <!-- <a href="#" class="w3-bar-item w3-button">Link 1</i></a>
        <div class="w3-dropdown-hover">
            <button class="w3-button">Dropdown <i class="fa-solid fa-caret-down"></i></button>
            <div class="w3-dropdown-content w3-bar-block w3-card-4">
            <a href="#" class="w3-bar-item w3-button">Link 1</a>
            <a href="#" class="w3-bar-item w3-button">Link 2</a>
            <a href="#" class="w3-bar-item w3-button">Link 3</a>
            </div>
        </div> -->
    </div>
<div id="w3-container">

    <form action="dt_operation.php" method="post" class="w3-container" width="60%">
        <h3>ค้นหาหัตถการแพทย์จากรหัส</h3>

        <fieldset>
            <legend><h4>ฟอร์มค้นหา</h4></legend>

            <p>
                <label>เลือกวันที่: </label>
                <input class="w3-input" type="text" name="date" value="<?=(date('Y')+543).date('-m');?>">
            </p>

            <p>
                <select class="w3-select w3-border" name="doctor">
                    <option value="">เลือกแพทย์</option>
                    <?php 
                    $q = $dbi->query("SELECT * FROM `doctor` WHERE `status` = 'y' AND `doctorcode` IS NOT NULL");
                    while ($a = $q->fetch_assoc()) {
                        ?>
                        <option value="<?=$a['name'];?>"><?=$a['name'];?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>

            <p>
                <label>เลือกหัตถการตามรหัส: </label>
                <input class="w3-input" type="text" name="code" id="code" value="" onkeyup="findCode(this.value)" placeholder="พิมพ์เพื่อค้นหาข้อมูล">
                <div style="position: relative;">
                    <div id="resCode" style="background-color: #fff; position: absolute; top:0; left: 0;"></div>
                    <div id="resSelected"></div>
                </div>
            </p>
            
            <p>
                <button type="submit">ค้นหาข้อมูล</button>
                <input type="hidden" name="page" value="findDepart">
            </p>

        </fieldset>
        
    </form>

</div>
<script>
    function findCode(code){

        if(code.length < 2){
            return false;
        }

        var request = new XMLHttpRequest();
        request.open('GET', 'dt_operation.php?action=search&code='+code, true);

        request.onload = function () {
        if (this.status >= 200 && this.status < 400) {
            
            var data = JSON.parse(this.response);
            var html = '<ul class="w3-ul w3-hoverable w3-card-4" id="selectDataContain">';
            for (var index = 0; index < data.length; index++) {
                const el = data[index];
                html += '<li class="w3-display-container"><a href="javascript:void(0);" onclick="selectData(\''+el.code+'\',\''+el.detail+'\')" data-code="'+el.code+'" >'+el.code+' - '+el.detail+'</a></li>';
            }
            html += '</ul>';
            document.getElementById('resCode').innerHTML = html;
        } else {
            // We reached our target server, but it returned an error
        }
        };

        request.onerror = function () {
        // There was a connection error of some sort
        };

        request.send();

    }

    function selectData(code, detail){
        document.getElementById('selectDataContain').style.display = 'none';
        document.getElementById('resSelected').innerHTML += '<div>'+code+' - '+detail+'<input type="hidden" name="labcare[]" value="'+code+'"> <a href="javascript:void(0);" onclick="this.parentElement.remove();" style="color: red;">[ลบ]</a></div>';
    }
</script>

<?php
}elseif ($page === 'findDepart') {
    # code...
    var_dump($_REQUEST);
    exit;
}
?>


</body>
</html>