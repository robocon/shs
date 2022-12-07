<?php 
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$dbi=new mysqli(HOST,USER,PASS,DB);
$dbi->set_charset('utf8');

$action = $_REQUEST['action'];
if ($action === 'search_user') {
    $code = $_GET['code'];
    $sql = "SELECT `row_id`,`name`,`status` FROM `inputm` WHERE `menucode` = '$code' AND `status` = 'Y' ";
    $q = $dbi->query($sql);
    $users = array();
    while ($user = $q->fetch_assoc()) {
        $user['name'] = $user['name'];
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


$page = $_REQUEST['page'];
if($page==='load25page'){ 

    $sql = "SELECT * FROM `com_support` WHERE `programmer` LIKE 'กฤษณะศักดิ์%' ORDER BY `dateend` DESC LIMIT 80";
    $q = $dbi->query($sql);
    $items = array();
    while ($item = $q->fetch_assoc()) {
        $id = $item['row_id'];

        $item['depart'] = $item['depart'];
        $item['head'] = $item['head'];
        $item['detail'] = $item['detail'];
        $item['user'] = $item['user'];
        $item['programmer'] = $item['programmer'];
        $item['user1'] = $item['user1'];
        $item['p_edit'] = $item['p_edit'];

        $items[] = $item;

    }

    $sql_sub = "SELECT * FROM `com_support_details` WHERE `editor` LIKE 'กฤษณะศักดิ์%' ORDER BY `dateend` DESC LIMIT 50 ";
    $q_sub = $dbi->query($sql_sub);
    if($q_sub->num_rows > 0){
        while ($s = $q_sub->fetch_assoc()) { 
            $id = $s['com_id'];

            $sql = "SELECT * FROM `com_support` WHERE `row` = '$id' ";
            $q = $dbi->query($sql);
            $i = $q->fetch_assoc();

            $is['depart'] = $i['depart'];
            $is['head'] = $i['head'];
            $is['detail'] = nl2br($s['detail']);

            $is['user'] = $i['user'];
            $is['programmer'] = $i['programmer'];
            $is['user1'] = $i['user1'];
            $is['p_edit'] = '';
            $is['date'] = $i['date'];
            $items[] = $is;
        }
    }

    echo $json->encode($items);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คีย์งานแบบบันทึกเอง</title>
</head>
<body>

<style>
    form{
        width: 400px;
    }
    input[type=text],select,.input_text{
        width: 100%;
        padding: 4px;
        border-width: 1px;
    }
    div{
        margin-bottom: 16px;
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
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
    #resPageContainer{
        background: #ffffff;
        position: absolute; 
        top:0; 
        left:0; 
        font-size: 18px;
        font-family: "TH SarabunPSK";
    }
    #resPageClose{
        text-align: center;
        background: #b8b8b8;
        padding: 8px;
    }
    #resPageClose:hover{
        cursor: pointer;
    }
    #resPage {
        position: relative;
    }
    ul.nav{
        padding: 0;
        margin: 0;
    }
    ul.nav > li{
        list-style-type: none;
        display: inline-block;
    }
    ul.nav > li > a{
        padding: 8px;
        background: #8b8b8b;
        color: #fff;
        text-decoration: none;
    }
</style>
<div>
    <ul class="nav">
        <li>
            <a href="javascript:void(0)" onclick="get25Page()">50 รายการล่าสุด</a>
        </li>
    </ul>
</div>
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
            'ADMER' => 'ห้องฉุกเฉิน',
            'ADMOPD' => 'ห้องทะเบียน',
            'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
            'ADMDEN' => 'กองทันตกรรม',
            'ADMEYE' => 'ห้องตรวจตา',
            'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
            'ADMMON' => 'ส่วนเก็บเงินรายได้',
            'ADMPH' => 'ห้องยา-เก่า',
            'ADMPHA' => 'ห้องยา',
            'ADMPHARX' => 'เภสัช',
            'ADMSUR' => 'ห้องผ่าตัด',
            'ADMXR' => 'แผนกรังสีกรรม',
            'ADMLAB' => 'แผนกพยาธิวิทยา',
            'ADMNID' => 'ฝังเข็ม',
            'ADMPT' => 'กายภาพบำบัด',
            'ADMFOD' => 'โภชนาการ',
            'ADMHEM' => 'ห้องไตเทียม',
            'ADMHEADWARD' => 'กองการพยาบาล',
            'ADMHMIS' => 'ศูนย์พัฒนาคุณภาพ',
            'ADMLIBRARY' => 'เวชกรรมป้องกัน',
            'ADMNHSO' => 'หลักประกันสุขภาพ',
            'ADMSSO' => 'ห้องประกันสังคม',
            'ADMSTD' => 'ห้องลงรหัสโรค',
            'ADMCMS' => 'ห้องจ่ายกลาง',
            'ADMICU' => 'หอผู้ป่วยหนัก',
            'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
            'ADMVIP' => 'หอผู้ป่วยพิเศษ',
            'ADMWF' => 'หอผู้ป่วยรวม',
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
<div id="resPageContainer" style="display:none;">
    <div id="resPageClose">[ ปิด ]</div>
    <div id="resPage"></div>
</div>
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

    async function get25Page(){
        var res = load25Page();
    }

    function load25Page(){
        return new Promise(function(resolve){
            xmlHttpGET("com_support_v2.php?page=load25page", function(xhttp){
                var dataObj = JSON.parse(xhttp.responseText);
                
                var preHtml = '<table class="chk_table">';
                preHtml += '<tr><td>วันที่</td><td>หัวข้อ</td><td width="40%">รายละเอียด</td><td>ผู้ร้องขอ</td><td>แผนก</td><td>ผู้ปฏิบัติ</td></tr>';
                for (var index = 0; index < dataObj.length; index++) {
                    var element = dataObj[index];
                    preHtml += '<tr>';
                    preHtml += '<td>'+element.dateend+'</td>';
                    preHtml += '<td>'+element.head+'</td>';
                    preHtml += '<td>'+element.detail+'</td>';
                    preHtml += '<td>'+element.user+'</td>';
                    preHtml += '<td>'+element.depart+'</td>';
                    preHtml += '<td>'+element.programmer+'</td>';
                    preHtml += '</td>';
                }
                preHtml += '</table>';

                document.getElementById('resPage').innerHTML = preHtml;
                document.getElementById('resPageContainer').style.display = '';
                
            });

            resolve(true);

        })
    }

    var clostTab = document.getElementById('resPageClose');
    if(clostTab!==null)
    {
        // clostTab.style.display = 'none';
        clostTab.onclick = function(){
            document.getElementById('resPageContainer').style.display = 'none';
        }
    }
    
</script>

</body>
</html>