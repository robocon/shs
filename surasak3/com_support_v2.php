<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$dbi=new mysqli(HOST,USER,PASS,DB);

$action = $_REQUEST['action'];
if ($action === 'search_user') {
    $code = $_GET['code'];
    $sql = "SELECT `row_id`,`name`,`status` FROM `inputm` WHERE `menucode` = '$code' AND `status` = 'Y' ";
    $q = $dbi->query($sql);
    $users = array();
    while ($user = $q->fetch_assoc()) {
        $user['name'] = iconv("TIS-620","UTF-8",$user['name']);
        $users[] = $user;
    }
    echo $json->encode($users);
    exit;

}elseif ($action === 'find_phone') {
    $name = $_REQUEST['name'];
    $sql = "SELECT `phone` FROM `com_support` WHERE `user` = '$name'";
    $q = $dbi->query($sql);
    $user = $q->fetch_assoc();
    echo $json->encode(array('phone'=>$user['phone']));
    exit;

}elseif ($action==='save') {

    $depart = $_POST['depart'];
    $head = $_POST['head'];
    $detail = $_POST['detail'];
    $user = $_POST['user'];
    $date = $_POST['date'];
    $programmer = $_POST['programmer'];
    $phone = $_POST['phone'];
    $dateend = $_POST['dateend'];
    $p_edit = $_POST['p_edit'];
    $ignore = $_POST['ignore'];

    $sql = "INSERT INTO `com_support` (
        `row`, `depart`, `head`, `detail`, `datetime`, `status`, 
        `user`, `date`, `programmer`, `phone`, `user1`, `p_edit`, 
        `dateend`, `hold`, `jobtype`,`ignore`
    ) VALUES ( 
        NULL, '$depart', '$head', '$detail', '', 'n', 
        '$user', '$date', '$programmer', '$phone', '$user', '$p_edit', 
        '$dateend', '0', 'software', '$ignore' 
    );";
    $save = $dbi->query($sql);
    $msg = "บันทึกข้อมูลเรียบร้อย";
    if($save===false)
    {
        $msg = $dbi->error;
    }
    redirect("com_support_v2.php", $msg);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<style>
    form{
        /* display: flex;
        justify-content: space-between; */
        width: 400px;
    }
    input[type=text],select,.input_text{
        width: 100%;
        padding: 4px;
        border-width: 1px;
    }
    div{
        /* display: inline-block; */
        width: 100%;
        /* display: flex;
        justify-content: space-between; */
        padding: 8px;
        margin-bottom: 8px;
    }
    div span{
        display: block;
        font-weight: bold;
    }
    input:read-only{
        background:#bbb;
    }
    textarea{
        width: 400px;
        height: 100px;
    }
    button[type=submit]{
        width: 100%;
        height: 35px;
        font-size: 1em;
    }
    input[type=checkbox]:hover,label{
        cursor: pointer;
    }
    .notify{
        padding:8px;
        border: 1px solid red;
    }
</style>
<?php 
if(!empty($_SESSION['x-msg'])){
    ?><p class="notify"><?=$_SESSION['x-msg'];?></p><?php
    $_SESSION['x-msg'] = null;
}
?>
<h3>คีย์งานแบบบันทึกเอง</h3>
<form action="com_support_v2.php" method="post" id="adminForm">
    <div>
        <?php 
        $departs = array(
            'ADMDEN' => 'กองทันตกรรม',
            'ADMER' => 'ห้องฉุกเฉิน',
            'ADMEYE' => 'ห้องตรวจตา',
            'ADMFOD' => 'โภชนาการ',
            'ADMHEADWARD' => 'พยาบาล',
            'ADMHEM' => 'ห้องไตเทียม',
            'ADMHMIS' => 'ศูนย์พัฒนาคุณภาพ',
            'ADMICU' => 'หอผู้ป่วยหนัก',
            // 'ADMINOPD' => 'รับป่วยผู้ป่วยใน',
            'ADMLAB' => 'แผนกพยาธิวิทยา',
            'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
            'ADMNID' => 'ฝังเข็ม',
            'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
            'ADMPH' => 'ห้องยา',
            'ADMPHA' => 'ห้องยา',
            'ADMPHARX' => 'เภสัช',
            'ADMPT' => 'กายภาพบำบัด',
            // 'ADMSUB' => 'NCR',
            'ADMSUR' => 'ห้องผ่าตัด',
            'ADMVIP' => 'หอผู้ป่วยพิเศษ',
            'ADMWF' => 'หอผู้ป่วยรวม',
            'ADMXR' => 'แผนกรังสีกรรม',
            'ADMLIBRARY' => 'เวชกรรมป้องกัน',
            'ADMCMS' => 'ห้องจ่ายกลาง',
            'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
            'ADMMON' => 'ส่วนเก็บเงินรายได้'
        );
        $start = $end = (date('Y')+543).date('-m-d H:i:s');
        ?>
        <span>แผนก</span>
        <select name="depart" id="depart" >
            <option value="">เลือกแผนก</option>
        <?php
        foreach($departs AS $key => $depart){
            ?>
            <option value="<?=$depart;?>" data-key="<?=$key;?>"><?=$depart;?></option>
            <?php
        }
        ?>
        </select>
    </div>
    <div>
        <span>ประเภทงาน</span>
        <input type="text" name="jobtype" id="jobtype" value="software" readonly>
    </div>
    <div>
        <span>หัวข้อ</span>
        <input type="text" name="head" id="head">
    </div>
    <div>
        <span>รายละเอียด</span>
        <textarea name="detail" id="detail"></textarea>
    </div>
    <div>
        <span>ผู้แจ้ง</span>
        <span id="input_text"></span>
    </div>
    <div>
        <span>โทรศัพท์ภายใน</span>
        <input type="text" name="phone" id="phone">
    </div>
    <div>
        <span>ผู้รับผิดชอบ</span>
        <input type="text" name="programmer" id="programmer" value="กฤษณะศักดิ์  กันธรส" readonly>
    </div>
    <div>
        <span>เริ่ม</span>
        <input type="text" name="date" id="date" value="<?=$start;?>">
    </div>
    <div>
        <span>สิ้นสุด</span>
        <input type="text" name="dateend" id="dateend" value="<?=$end;?>">
    </div>
    <div>
        <span>การทำเนินการ</span>
        <textarea name="p_edit" id="p_edit">ดำเนินการแก้ไขเรียบร้อย</textarea>
    </div>
    <div>
        <input type="checkbox" name="ignore" id="ignore" value="1"> <label for="ignore">Ignore</label>
    </div>
    <div>
        <button type="submit">บันทึก</button>
        <input type="hidden" name="action" value="save">
    </div>
</form>
<script>
    var SmHttp = function(){}
    SmHttp.prototype = {
        ajax: function(url, data, callback){
            try{
                xHttp = new ActiveXObject("Msxml2.XMLHTTP");
            }catch(e){
                try{
                    xHttp = new ActiveXObject("Microsoft.XMLHTTP");
                }catch(e){
                    xHttp = false;
                }
            }
            if(!xHttp && document.createElement){
                xHttp = new XMLHttpRequest();
            }
            
            xHttp.onreadystatechange = function(){
                if( xHttp.readyState == 4 && xHttp.status == 200 ){
                    callback(xHttp.responseText);
                }
            };
            xHttp.open("POST", url, true);
            xHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded; charset=TIS-620");
            data = this.objToStr(data);
            xHttp.send(data);
        },
        objToStr: function(data){
            
            if( data === null ){
                return null;
            }
            
            test_str = [];
            for(var p in data){
                test_str.push(encodeURIComponent(p)+"="+encodeURIComponent(data[p]));
            }
            return test_str.join("&");
        }
    }

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

    document.getElementById("depart").onchange = function(){
        var depart = this.value;
        var code = this.options[this.selectedIndex].getAttribute('data-key');
        xmlHttpGET("com_support_v2.php?action=search_user&code="+code, createSelectOption);
    }
    
    async function createSelectOption(xhttp){
        var data_list = JSON.parse(xhttp.responseText);
        await createHtmlOption(data_list)
        .then(
            document.getElementById('user').onchange = function(){
                xmlHttpGET("com_support_v2.php?action=find_phone&name="+this.value, createPhone);
            }
        );
    }

    function createHtmlOption(data_list){

        return new Promise(function(resolve,reject){
            
            document.getElementById('input_text').innerHTML = '';

            var selectList = document.createElement("select");
            selectList.setAttribute("class", "w3-select w3-border w3-round");
            selectList.setAttribute("name", "user");
            selectList.setAttribute("id", "user");

            var option = document.createElement("option");
            option.value = '';
            option.text = 'เลือกรายการ';
            selectList.appendChild(option);

            for (var index = 0; index < data_list.length; index++) {
                const element = data_list[index];

                var option = document.createElement("option");
                option.value = element.name;
                option.text = element.name;
                selectList.appendChild(option);
            }
            document.getElementById('input_text').appendChild(selectList);

        })
    }

    async function createPhone(xhttp){
        var data_list = JSON.parse(xhttp.responseText);
        document.getElementById('phone').value = data_list.phone;
    }

    document.getElementById('adminForm').onsubmit = function(){ 
        var resAlert = false;
        var user = document.getElementById('user');

        if(user===null){
            var message = "กรุณาระบุแผนกและเลือกผู้แจ้ง";
            resAlert = true;

        }else if(user.value === ''){
            var message = "กรุณาเลือกผู้แจ้ง";
            resAlert = true;
        }

        if(resAlert === true){
            event.preventDefault();
            alert(message);
            return;
        }
    }
    
</script>

</body>
</html>