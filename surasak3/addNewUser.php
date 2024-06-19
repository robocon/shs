<?php 
include_once __DIR__.'/bootstrap.php';
// include_once __DIR__.'/includes/JSON.php';

// $json = new Services_JSON();

if($_SESSION['sIdname']!=='krit')
{
    echo "Invalid";
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
$action = $_REQUEST['action'];
if($action==='save'){
    
    $msg = "บันทึกข้อมูลเรียบร้อย";

    $sql = "INSERT INTO `inputm` ( 
        `row_id`, `name`, `idname`, `pword`, `menucode`, `status`, 
        `codedoctor`, `mdcode`, `id`, `room_app`, `date_pword`, `level`, 
        `report_tnb`,`last_login`, `idcard`, `level_eopd`) 
    VALUES ( 
        NULL, ?, ?, ?, ?, 'Y', 
        NULL, NULL, '', '', ?, ?, 
        '', '', '', 'y'
    );";
    
    $thDate = date('Y-m-d H:i:s');

    $stmt = $dbi->prepare($sql);
    $stmt->bind_param("ssssss", $_POST['name'], $_POST['idname'], $_POST['pword'], $_POST['depart'], $thDate, $_POST['level']);
    $stmt->execute();
    
    if(!empty($stmt->error))
    {
        $msg = $stmt->error;
    }
    
    redirect('addNewUser.php', $msg);
    exit;
}elseif($action==='finduser'){
    
    $idname = $_REQUEST['idname'];
    $sql = "SELECT `row_id`,`idname` FROM `inputm` WHERE `idname`='$idname' ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        $data = array('rows' => 1);
    }else{
        $data = array('rows' => 0);
    }
    echo json_encode($data);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>เพิ่มผู้ใช้งานมาใหม่</title>
</head>
<body>
    <?php 
    if(!empty($_SESSION['x-msg']))
    {
        ?><div class="w3-panel w3-amber"><?=$_SESSION['x-msg'];?></div><?php
        $_SESSION['x-msg'] = null;
    }
    
    ?>
    <div class="w3-container">
        <form action="addNewUser.php" method="post" class="w3-col m6 l4" id="adminForm">
            <p>
                <label for="name">ชื่อ-สกุล</label>
                <input class="w3-input w3-border w3-round-large" type="text" id="name" name="name" value="" placeholder="บุญมี นะจ๊ะ">
            </p>
            <p>
                <label for="name">ชื่อผู้ใช้งาน</label>
                <input class="w3-input w3-border w3-round-large" type="text" id="idname" name="idname" value="" placeholder="myusername">
                <button type="button" onclick="checkUsername()"><i class="fa fa-search"></i> ตรวจสอบ</button><span id="resCheckUsername"></span>
            </p>
            <p>
                <label for="name">รหัสผ่าน</label>
                <input class="w3-input w3-border w3-round-large" type="password" id="pword" name="pword" value="">
            </p>
            <p>
                <label for="depart">แผนก</label>
                <select name="depart" id="depart" class="w3-select w3-border w3-round-large">
                    <option value="">เลือกข้อมูล</option>
                    <?php 
                    $departs = array(
                        'ADMDEN' => 'กองทันตกรรม',
                        'ADMER' => 'ห้องฉุกเฉิน',
                        'ADMEYE' => 'ห้องตรวจตา',
                        'ADMFOD' => 'โภชนาการ',
                        'ADMHEADWARD' => 'กองการพยาบาล',
                        'ADMOPD' => 'ห้องทะเบียน',
                        'ADMHEM' => 'ห้องไตเทียม',
                        'ADMHMIS' => 'ศูนย์พัฒนาคุณภาพ',
                        'ADMICU' => 'หอผู้ป่วยหนัก',
                        'ADMLAB' => 'แผนกพยาธิวิทยา',
                        'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
                        'ADMNID' => 'ฝังเข็ม',
                        'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
                        'ADMPHA' => 'ห้องยา',
                        'ADMPHARX' => 'เภสัช',
                        'ADMPT' => 'กายภาพบำบัด',
                        'ADMSUR' => 'ห้องผ่าตัด',
                        'ADMVIP' => 'หอผู้ป่วยพิเศษ',
                        'ADMWF' => 'หอผู้ป่วยรวม',
                        'ADMXR' => 'แผนกรังสีกรรม',
                        'ADMLIBRARY' => 'เวชกรรมป้องกัน',
                        'ADMCMS' => 'ห้องจ่ายกลาง',
                        'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
                        'ADMMON' => 'ส่วนเก็บเงินรายได้',
                        'ADMSTD' => 'ห้องลงรหัสโรค'
                    );
                    foreach ($departs as $key => $data) {
                        ?>
                        <option value="<?=$key;?>"><?=$data;?></option>
                        <?php
                    }
                    ?>
                </select>
            </p>
            <p>
                <label for="level">ระดับ</label>
                <select name="level" id="level" class="w3-select w3-border w3-round-large">
                    <option value="user">ผู้ใช้งานทั่วไป</option>
                    <option value="admin">หัวหน้ากอง/แผนก</option>
                </select>
            </p>
            <p>
                <button class="w3-button w3-round-large w3-teal" type="submit">บันทึกข้อมูล</button>
                <span id="resForm"></span>
                <input type="hidden" name="action" value="save">
            </p>
        </form>
    </div>
    <script>
        function xmlHttpGET(url, functionName)
        {
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
        
        async function checkUsername()
        {
            var idname = document.getElementById('idname');
            var resCheck = document.getElementById('resCheckUsername');
            if(idname.value.trim()==='')
            {
                resCheck.innerHTML = 'กรุณาใส่ username';
                return;
            }
            idname = idname.value.toLowerCase();
            var position = idname.search(/(admin|administrator)/);
            if(position >= 0)
            {
                resCheck.innerHTML = 'ฮั่นแน่ จะทำอะไร';
                return;
            }
            var test = await getUsername(idname);
            console.log(test);
        }

        function getUsername(idname){
            return new Promise(function(res){
                xmlHttpGET('addNewUser.php?action=finduser&idname='+idname, function(xhttp){
                    
                    var data = JSON.parse(xhttp.responseText);
                    var resCheck = document.getElementById('resCheckUsername');

                    if(data.rows > 0){
                        resCheck.innerHTML = '<i class="w3-red">Username นี้มีคนใช้งานแล้ว</i>';
                    }else{
                        resCheck.innerHTML = 'ใช้งาน Username นี้ได้ <i class="fa fa-check-circle-o" style="color:green;"></i><input type="hidden" id="testUsername" value="checked">';
                    }

                    res(true);

                });
                
            });
        }

        document.getElementById('adminForm').onsubmit = function(){
            var name = document.getElementById('name').value.trim();
            var idname = document.getElementById('idname').value.trim();
            var pword = document.getElementById('pword').value.trim();
            var depart = document.getElementById('depart').value;
            var level = document.getElementById('level').value;
            var resForm = document.getElementById('resForm');
            var testUser = document.getElementById('testUsername');
            resForm.innerHTML = '';

            var testForm = true;
            if(!name)
            {
                resForm.innerHTML = '<span class="w3-red w3-tag">กรุณาใส่ชื่อ-สกุลให้ครบถ้วน</span>';
                testForm = false;
            }
            else if(!idname)
            {
                resForm.innerHTML = '<span class="w3-red w3-tag">กรุณาใส่ชื่อผู้ใช้งาน</span>';
                testForm = false;
            }
            else if(!pword)
            {
                resForm.innerHTML = '<span class="w3-red w3-tag">กรุณาใส่รหัสผ่าน</span>';
                testForm = false;
            }
            else if(!depart)
            {
                resForm.innerHTML = '<span class="w3-red w3-tag">กรุณาเลือกแผนก</span>';
                testForm = false;
            }
            else if(!testUser)
            {
                resForm.innerHTML = '<span class="w3-red w3-tag">กรุณากดตรวจสอบชื่อผู้ใช้ก่อนบันทึก</span>';
                testForm = false;
            }

            if(testForm===false)
            {
                event.preventDefault();
                return;
            }
            
        }


    </script>
</body>
</html>