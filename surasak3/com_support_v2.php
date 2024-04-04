<?php 
include_once 'bootstrap.php';
// include_once 'includes/JSON.php';
// $json = new Services_JSON();

$dbi=new mysqli(HOST,USER,PASS,DB);
// $dbi->set_charset('utf8');
$dbi->query("SET NAMES UTF8");

$action = $_REQUEST['action'];
if ($action === 'search_user') {
    $code = sprintf("%s", $_GET['code']);
    $sql = "SELECT `row_id`,`name`,`status` FROM `inputm` WHERE `menucode` = '$code' AND `status` = 'Y' ";
    $q = $dbi->query($sql);
    $users = array();
    while ($user = $q->fetch_assoc()) {
        $users[] = $user;
    }
    echo json_encode($users);
    exit;

}elseif ($action === 'find_phone') {
    $name = $_REQUEST['name'];
    $sql = "SELECT `phone` FROM `com_support` WHERE `user` = '$name'";
    $q = $dbi->query($sql);
    $user = $q->fetch_assoc();
    echo json_encode(array('phone'=>$user['phone']));
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
    $row = $_POST['row'];
    $software_type = '';
	if(!empty($_POST['software_type'])){
		$software_type = sprintf("%s", $_POST['software_type']);
	}

    if(empty($row)){
        $sql = "INSERT INTO `com_support` (
            `row`, `depart`, `head`, `detail`, `datetime`, `status`, 
            `user`, `date`, `programmer`, `phone`, `user1`, `p_edit`, 
            `dateend`, `hold`, `jobtype`,`ignore`,`software_type`
        ) VALUES ( 
            NULL, '$depart', '$head', '$detail', '', 'n', 
            '$user', '$date', '$programmer', '$phone', '$user', '$p_edit', 
            '$dateend', '0', 'software', '$ignore','$software_type'
        );";
    }else {
        // update
        $sql = "UPDATE `com_support` SET 
        `depart`='$depart', 
        `head`='$head', 
        `detail`='$detail', 
        `datetime`='', 
        `status`='n', 
        `user`='$user', 
        `date`='$date', 
        `programmer`='$programmer', 
        `phone`='$phone', 
        `user1`='$user', 
        `p_edit`='$p_edit', 
        `dateend`='$dateend',
        `software_type`='$software_type'
        WHERE (`row`='$row');";
    }
    
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

    $sql = "SELECT * FROM `com_support` WHERE `programmer` LIKE 'กฤษณะศักดิ์%' ORDER BY `dateend` DESC LIMIT 100";
    $q = $dbi->query($sql);
    $items = array();
    while ($item = $q->fetch_assoc()) {
        $id = $item['row_id'];

        $item['detail'] = strip_tags(html_entity_decode($item['detail']));
        $items[] = $item;

    }

    $sql_sub = "SELECT * FROM `com_support_details` WHERE `editor` LIKE 'กฤษณะศักดิ์%' ORDER BY `date` DESC LIMIT 100 ";
    $q_sub = $dbi->query($sql_sub);
    if($q_sub->num_rows > 0){
        while ($s = $q_sub->fetch_assoc()) { 
            $id = $s['com_id'];

            $sql = "SELECT * FROM `com_support` WHERE `row` = '$id' ";
            $q = $dbi->query($sql);
            $i = $q->fetch_assoc();

            $is['depart'] = $i['depart'];
            $is['head'] = $i['head'];
            $is['detail'] = strip_tags(html_entity_decode($s['detail']));

            $is['user'] = $i['user'];
            $is['programmer'] = $i['programmer'];
            $is['user1'] = $i['user1'];
            $is['p_edit'] = '';
            $is['date'] = $i['date'];
            $items[] = $is;
        }
    }

    echo json_encode($items);
    exit;
}elseif ($page==='loadOrderPage') {

    $thYear = date('Y')+543;
    $q = $dbi->query("SELECT * FROM `com_support` where `programmer` IS NULL AND `date` LIKE '$thYear%';");
    $items = array();
    if($q->num_rows > 0){
        while ($a = $q->fetch_assoc()) {
            $items[] = $a;
        }
    }
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
        width: 600px;
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
        <li>
            <a href="javascript:void(0)" onclick="getOrderPage()">ORDER</a>
        </li>
    </ul>
</div>
<?php 
if(!empty($_SESSION['x-msg'])){
    ?><p class="notify"><?=$_SESSION['x-msg'];?></p><?php
    $_SESSION['x-msg'] = null;
}

$form_action = sprintf("%s", $_GET['form_action']);
$s = array();
if($form_action==='edit'){

    $id = sprintf("%s", $_GET['id']);
    $qs=$dbi->query("SELECT * FROM `com_support` WHERE `row` = '$id'");
    $s = $qs->fetch_assoc();

}
?>
<h3>คีย์งานแบบบันทึกเอง</h3>
<form action="com_support_v2.php" method="post" id="adminForm" style="width:100%;">
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
            'ADMPHARX' => 'กองเภสัชกรรม',
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
            'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
        );
        $start = $end = (date('Y')+543).date('-m-d H:i:s');
        ?>
        <span>แผนก</span>
        <select name="depart" id="depart" >
            <option value="">เลือกแผนก</option>
        <?php 
        $key_selected = '';
        foreach($departs AS $key => $depart){ 

            $selected = '';
            if($depart==$s['depart']){
                $selected = 'selected="selected"';
                $key_selected = $key;
            }

            ?>
            <option value="<?=$depart;?>" data-key="<?=$key;?>" <?=$selected;?>><?=$depart;?></option>
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
        <span>ลักษณะงาน</span>
        <input type="radio" name="software_type" id="software_type1" value="แก้ไขโปรแกรม/ข้อมูล">
        <label for="software_type1">แก้ไขโปรแกรม/ข้อมูล</label>

        <input type="radio" name="software_type" id="software_type2" value="พัฒนาโปรแกรม">
        <label for="software_type2">พัฒนาโปรแกรม</label>
    </div>
    <div>
        <span>หัวข้อ</span>
        <input type="text" name="head" id="head" value="<?=$s['head'];?>" >
    </div>
    <div>
        <span>รายละเอียด</span>

        <!-- https://www.tiny.cloud/get-tiny/custom-builds/ -->
        <!-- https://www.tiny.cloud/docs-4x/general-configuration-guide/basic-setup/#toolbarmenuconfiguration -->
        <script src="js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
        <script>
            tinymce.init({
                selector: 'textarea#detail',
                toolbar: false, // ปิดใช้งาน toolbar
                menubar: false, // ปิดใช้งาน menubar
                forced_root_block : '' // ไม่ต้องใช้ tag p เมื่อเริ่มต้นใช้งาน tinymce
            });
        </script>

        <textarea name="detail" id="detail" rows="4" cols="100"><?=$s['detail'];?></textarea>
    </div>
    <div>
        <span>ผู้แจ้ง</span>
        <?php 
        $inputHtml = '';
        if(!empty($key_selected)){
            $qInput = $dbi->query("SELECT * FROM `inputm` WHERE `menucode` = '$key_selected' ");
            $inputHtml = '<select name="user" id="user">';
            while ($a = $qInput->fetch_assoc()){ 
                $selected = ($a['name'] == $s['user']) ? 'selected="selected"' : '';
                $inputHtml .= '<option value="'.$a['name'].'" '.$selected.'>'.$a['name'].'</option>';
            }
            $inputHtml .= '</select>';
        }
        ?>
        <span id="input_text"><?=$inputHtml;?></span>
    </div>
    <div>
        <span>โทรศัพท์ภายใน</span>
        <input type="text" name="phone" id="phone" value="<?=$s['head'];?>" >
    </div>
    <div>
        <span>ผู้รับผิดชอบ</span>
        <input type="text" name="programmer" id="programmer" value="กฤษณะศักดิ์  กันธรส" readonly>
    </div>
    <div>
        <span>เริ่ม</span>
        <?php 
        if($s['date']){
            $start = $s['date'];
        }
        ?>
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
        <input type="hidden" id="formAction" name="action" value="save">
        <?php 
        if ($s['row']) {
            ?>
            <input type="hidden" name="row" id="row" vlaue="<?=$s['row'];?>">
            <?php
        }
        ?>
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
    

    function getOrderPage(){
        loadOrderPage();
    }

    async function loadOrderPage(){
        const response = await fetch('com_support_v2.php?page=loadOrderPage');
        const body = await response.text();
        var dataObj = JSON.parse(body);
                
        var preHtml = '<table class="chk_table">';
        preHtml += '<tr><td>วันที่</td><td>หัวข้อ</td><td width="40%">รายละเอียด</td><td>ผู้ร้องขอ</td><td>แผนก</td><td>ผู้ปฏิบัติ</td></tr>';
        for (var index = 0; index < dataObj.length; index++) {
            var element = dataObj[index];
            preHtml += '<tr>';
            preHtml += '<td>'+element.date+'</td>';
            preHtml += '<td>'+element.head+'</td>';
            preHtml += '<td>'+element.detail+'</td>';
            preHtml += '<td>'+element.user+'</td>';
            preHtml += '<td>'+element.depart+'</td>';
            preHtml += '<td><a href="com_support_v2.php?form_action=edit&id='+element.row+'">แก้ไข</a></td>';
            preHtml += '</td>';
        }
        preHtml += '</table>';

        document.getElementById('resPage').innerHTML = preHtml;
        document.getElementById('resPageContainer').style.display = '';
    }
</script>

</body>
</html>