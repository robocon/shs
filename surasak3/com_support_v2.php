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

}
?>
<style>
    form{
        /* display: flex;
        justify-content: space-between; */
        width: 400px;
    }
    input[type=text],select,.input_text{
        width: 100%;
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
</style>
<form action="com_support_v2.php" method="post">
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
        <input type="text" name="jobtype" value="software" readonly>
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
        <input type="text" name="programmer" value="กฤษณะศักดิ์  กันธรส" readonly>
    </div>
    <div>
        <input type="checkbox" name="ignore" id="ignore" value="1"> <label for="ignore">Ignore</label>
    </div>
    <div>
        <button type="submit">บันทึก</button>
    </div>
</form>
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



    document.getElementById("depart").onchange = function(){
        var depart = this.value;
        var code = this.options[this.selectedIndex].getAttribute('data-key');

        xmlHttpGET("com_support_v2.php?action=search_user&code="+code, createSelectOption);

        // หลังจากที่สร้าง user
        

    }
    
    async function createSelectOption(xhttp){
        var data_list = JSON.parse(xhttp.responseText);
        await createHtmlOption(data_list)
        .then(
            document.getElementById('user').onchange = function(){
                console.log(this.value)
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
                // option.value = element.row_id;
                option.value = element.name;
                option.text = element.name;
                // option.setAttribute("data-id", item.id);
                // option.setAttribute("data-color", item.data().color);
                selectList.appendChild(option);
                
            }

            document.getElementById('input_text').appendChild(selectList);

        })
    }

    async function createPhone(xhttp){
        var data_list = JSON.parse(xhttp.responseText);
        // console.log(data_list);
        document.getElementById('phone').value = data_list.phone;
    }
    
</script>