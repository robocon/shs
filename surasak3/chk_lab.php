<?php 

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';
require_once dirname(__FILE__).'/class_file/class_orderhead.php';


require_once dirname(__FILE__).'/includes/JSON.php';

// require_once dirname(__FILE__).'/class_file/class_orderdetail.php';
// phpinfo();
$page = input('page');

$db = Mysql::load();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
if( $action == 'saveCinicalinfo' ){

    $labnumber = sprintf("%s", $_POST['labnumber']);
    $clinicalinfo = trim(sprintf("%s", $_POST['clinicalinfo']));

    $sqlUpdate = "UPDATE resulthead SET clinicalinfo = '$clinicalinfo' WHERE labnumber = '$labnumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "labnumber": "'.$labnumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }
    echo $res;
    exit;
}elseif( $action == 'saveLabnumber' ){

    $oldLabnumber = sprintf("%s", $_POST['oldLabnumber']);
    $newLabnumber = trim(sprintf("%s", $_POST['newLabnumber']));

    $part = trim(sprintf("%s", $_POST['part']));
    $hn = trim(sprintf("%s", $_POST['hn']));

    $sqlUpdate = "UPDATE `opcardchk` SET `exam_no` = '$newLabnumber' WHERE `part` = '$part' AND `hn` = '$hn' ";
    $save = $db->update($sqlUpdate);

    $sqlUpdate = "UPDATE resulthead SET labnumber = '$newLabnumber' WHERE labnumber = '$oldLabnumber' ";
    $save = $db->update($sqlUpdate);
    if($save===true){
        $res = '{"status":200, "labnumber": "'.$newLabnumber.'", "message":"บันทึกข้อมูลเรียบร้อย"}';
    }else{
        $res = '{"status":400, "message": " ไม่สามารถบันทึกข้อมูลได้"}';
    }
    echo $res;
    exit;

}elseif($action == 'saveLabnumberManual'){

    $hn = sprintf("%s", $_POST['hn']);
    $labnumber = sprintf("%s", $_POST['labnumber']);
    $labcode = sprintf("%s", $_POST['labcode']);
    $labcodeItem = explode(',', $labcode);

    $id = sprintf("%s", $_POST['id']);
    
    $msg = 'ข้อมูลไม่ถูกต้อง';
    if(!empty($labcode)){

        $yearChk = get_year_checkup();

        $msg = 'บันทึกข้อมูลเรียบร้อย';
    
        $opc = new Opcard();
        $user = $opc->getByHn($hn);
        $sex = ($user=='ญ') ? 'F' : 'M' ;
        $dob = bc_to_ad($user['dbirth']);

        $oh = new Orderhead();
        $data = array(
            'hn' => $hn,
            'patientname' => $user['ptname'],
            'sex' => $sex,
            'dob' => $dob,
            'clinicalinfo' => 'ตรวจสุขภาพประจำปี'.$yearChk
        );
        $insertOrderhead = $oh->insertOrderhead($data);
        if(!$insertOrderhead['error']){
            $data['labnumber'] = $insertOrderhead['labnumber'];
            $data['labitems'] = $labcodeItem;
            $insertOrderdetail = $oh->insertOrderdetail($data);

            $msg .= ' Labnumber: '.$insertOrderdetail['labnumber'];
        }
    }

    redirect('chk_lab.php?page=form&id='.$id, $msg);
    exit;
}elseif($action==='findLabcare'){

    $json = new Services_JSON();
    $code = sprintf("%s", $_GET['code']);
    $oh = new Orderhead();
    $res = $oh->getLabcares($code, true);
    if($res['error']===true){
        $res = '{"status":400, "message": "ไม่พบข้อมูล"}';
    }else{

        $data = array();
        foreach ($res['data'] as $key => $value) {
            $data[] = $value;
        }
        $res = $json->encode(array('count'=>count($data), 'data'=>$data));
        
    }
    echo $res;
    exit;
}


if ( $page === 'form' ) { 

    $id = input_get('id');
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>แก้ไขข้อมูลแลป</title>
    </head>
    <body>
    <?php

    $start_date = (!empty($_POST['start_date'])) ? sprintf("%s", $_POST['start_date']) : date('Y-m-d') ;
    $end_date = (!empty($_POST['end_date'])) ? sprintf("%s", $_POST['end_date']) : date('Y-m-d') ;

    $whereDateResultHead = "AND orderdate >= '".date('Y-m-01')." 00:00:00'";
    $action = (!empty($_POST['action'])) ? sprintf("%s", $_POST['action']) : '' ;
    if($action==='searchByDate'){
        $whereDateResultHead = " AND (orderdate >= '$start_date 00:00:00' AND orderdate <= '$end_date 23:59:59') ";
    }

    $db->select("SELECT *,`HN` AS `hn` FROM `opcardchk` WHERE `row` = '$id' ");
    $user = $db->get_item();
    $user_hn = $user['hn'];
    $user_part = $user['part'];
    if(empty($user_hn)){
        echo "ไม่พบข้อมูล HN กรุณาตรวจสอบข้อมูลอีกครั้ง";
        exit;
    }

    $db->select("SELECT SUBSTRING(`yearchk`, 3, 2) AS `yearchk` FROM `chk_company_list` WHERE `code` = '$user_part' ");
    $chk_company = $db->get_item();

    $sql = "SELECT `labnumber`,`autonumber`,`orderdate`,`clinicalinfo`,GROUP_CONCAT(`profilecode`) `profilecode`
    FROM `resulthead` 
    WHERE `hn` = '$user_hn' 
    $whereDateResultHead 
    GROUP BY `labnumber`,`clinicalinfo`";
    $db->select($sql);
    $lab_rows = $db->get_rows();
    $items = $db->get_items();

    include 'chk_menu.php';

    ?>

    <link href="js/vanilla-calendar/vanilla-calendar.min.css" rel="stylesheet">
    <script src="js/vanilla-calendar/vanilla-calendar.min.js" defer></script>
    <script src="sweetalert/sweetalert2@11.js"></script>

    <div>
        <a href="chk_show_user.php?part=<?=$user['part'];?>" class="button">&lt;&lt;&nbsp;กลับไปหน้ารายชื่อ</a>
        <a href="javascript:void(0);" class="button" onclick="document.getElementById('containerAddLabManual').style.display = '';document.getElementById('labcode').focus();">เพิ่ม Lab manual</a>
    </div>

    <style>
        .labTable tr:hover{
            background-color:#c5c5c5!important;
        }
        #containerAddLabManual{
            position: absolute;
            width: 80%;
            height: auto;
            top : 5%;
            left: 0;
            right: 0;
            margin: auto;
            background-color: #ffffff;
            padding: 8px;
            border: 4px solid #888888;
        }
        #contentAddLabManual{
            position: relative;
        }
        #htmlLabSearch{
            margin-top:8px;
        }
        #htmlLabSearch a {
            text-decoration: none;
        }
        #htmlLabSearch a:hover {
            text-decoration: underline;
        }
    </style>
    <h3>แก้ไขข้อมูลแลป</h3>
    <fieldset style="margin-bottom:8px; width:40%;" class="clearfix">
        <legend>ข้อมูลเบื้องต้น</legend>
        <table>
            <tr>
                <td align="right"><strong>Exam no : </strong></td>
                <td><?=$user['exam_no'];?></td>
            </tr>
            <tr>
                <td align="right"><b>HN : </b></td>
                <td><?=$user['hn'];?></td>
            </tr>
            <tr>
                <td align="right"><b>ชื่อ-สกุล : </b></td>
                <td><?=$user['name'];?> <?=$user['surname'];?></td>
            </tr>
            <tr>
                <td align="right"><b>บริษัท : </b></td>
                <td><?=$user['part'];?></td>
            </tr>
            
        </table>
    </fieldset>
    <fieldset style="width:50%; margin-bottom:8px;">
        <legend><b>ค้นหาตามวันที่</b></legend>
        <form action="chk_lab.php?page=form&id=<?=$id;?>" method="post">
            <table>
                <tr valign="top">
                    <td>
                        <label for="start_date">เริ่มวันที่
                            <input type="text" id="start_date" name="start_date" value="<?=$start_date;?>">
                        </label>
                        <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_start"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <label for="end_date">ถึงวันที่
                            <input type="text" id="end_date" name="end_date" value="<?=$end_date;?>">
                        </label>
                        <div style="position:relative;">
                            <div style="position: absolute;">
                                <div id="calendar_end"></div>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div style="background-color: #ffff90; padding: 0 8px;">ESC เพื่อยกเลิกการแสดงผลของปฏิทิน</div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">ค้นหา</button>
                        <input type="hidden" name="action" value="searchByDate">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>

    <div id="containerAddLabManual" style="display: none;">
        <div id="contentAddLabManual">
            <h1>เพิ่ม Lab Manual</h1>
            <form action="chk_lab.php" method="post">
                <table>
                    <tr valign="top">
                        <td>รายการตรวจ : </td>
                        <td>
                            <input type="text" name="labcode" id="labcode"><br>
                            <?php 
                            $labItems = array('CBC','UA','ST อปท','C-ST','BS','CHOL','TRI','BUN','CR','SGOT','SGPT','ALK','URIC','HDL','LDL','CEA');
                            foreach($labItems as $l){
                                ?>
                                <a href="javascript:void(0);" onclick="addLabItem('<?=$l;?>')" style="margin-right:4px;"><?=$l;?></a>
                                <?php
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>ค้นหารายการ : </td>
                        <td>
                            <input type="text" name="search" id="search" onkeyup="inputSearchLab(this.value.trim())">
                            <div id="htmlLabSearch"></div>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td colspan="2">
                            <button type="submit">บันทึก</button>
                            <input type="hidden" name="action" value="saveLabnumberManual">
                            <input type="hidden" name="hn" value="<?=$user_hn;?>">
                            <!-- opcardchk->id -->
                            <input type="hidden" name="id" value="<?=$id;?>">

                            <div>
                                <span style="background-color: #ffff90; padding: 0 8px;">ESC เพื่อปิดหน้าต่าง</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <script>

    function inputSearchLab(v){
        
        if(v.length>=2){
            searchLab(v).then((res)=>{
                if(res.count > 0){

                    document.getElementById('htmlLabSearch').innerHTML = '';
                    let div1 = document.createElement("div");

                    for (let index = 0; index < res.count; index++) {
                        const element = res.data[index];
                       
                        let div2 = document.createElement("div");
                        
                        let a = document.createElement("a");
                        a.href = 'javascript:void(0)';
                        a.setAttribute("onclick", "htmlLabSearchSelected('"+element.code+"')");
                        a.text = element.code+' [ '+element.detail+' ]';
                        a.title = element.detail;

                        div2.append(a);

                        div1.append(div2);
                    }
                    document.getElementById('htmlLabSearch').append(div1);
                }else{
                    document.getElementById('htmlLabSearch').innerHTML = res.message;
                }
                document.getElementById('htmlLabSearch').style.display = '';
            });
        }else{
            document.getElementById('htmlLabSearch').style.display = 'none';
        }
        
    }

    function htmlLabSearchSelected(v){
        let labcodeLength = document.getElementById('labcode').value.length;
        if(labcodeLength>0){
            document.getElementById('labcode').value+=','+v;
        }else{
            document.getElementById('labcode').value=v;
        }
        
        document.getElementById('search').value='';
        document.getElementById('htmlLabSearch').style.display = 'none';
    }

    async function searchLab(v){
        const response = await fetch('chk_lab.php?action=findLabcare&code='+v);
        const data = await response.json();
        return data;
    }

    function showAddLabManual(){
        document.getElementById('containerAddLabManual').style.display = '';
    }

    function updateLabnumber(v){
        document.getElementById('labnumber').value = v;
    }
    function addLabItem(v){
        let labcode = document.getElementById('labcode');
        if(labcode.value==''){
            labcode.value = v;
        }else{
            labcode.value += ','+v;
        }
        
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        document.addEventListener("keydown", (event) => {
            if (event.isComposing || event.keyCode === 27) {
                document.getElementById('calendar_start').style.display = 'none';
                document.getElementById('calendar_end').style.display = 'none';

                document.getElementById('containerAddLabManual').style.display = 'none';
                
            }
        });

        document.getElementById('start_date').onclick=function(){ 
            document.getElementById('calendar_start').style.display = '';
            const calendar = new VanillaCalendar('#calendar_start',{
                settings: {
                    lang: 'th',
                    iso8601: false,
                },
                actions: {
                    clickDay(event, self) {
                        document.getElementById('start_date').value = self.selectedDates[0];
                        document.getElementById('calendar_start').style.display = 'none';
                    },
                },
            });
            calendar.init();
        }

        document.getElementById('end_date').onclick=function(){ 
            document.getElementById('calendar_end').style.display = '';
            const calendar = new VanillaCalendar('#calendar_end',{
                settings: {
                    lang: 'th',
                    iso8601: false,
                },
                actions: {
                    clickDay(event, self) {
                        document.getElementById('end_date').value = self.selectedDates[0];
                        document.getElementById('calendar_end').style.display = 'none';
                    },
                },
            });
            calendar.init();
        }
    });
    </script>
    <br>
    <?php
    if( $lab_rows === 0 ){
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }else {
        $items = $db->get_items();
        ?>
        <table class="chk_table" width="100%">
            <tr>
                <th>ID</th>
                <th>วันที่</th>
                <th>Lab Number</th>
                <th>รายการตรวจ</th>
                <th>สถานะแลป</th>
            </tr>
            <?php
            foreach ($items as $key => $item) {
                $autonumber = $item['autonumber'];
            ?>
            <tr>
                <td><?=$item['autonumber'];?></td>
                <td width="150"><?=$item['orderdate'];?></td>
                <td>
                    <a href="javascript:void(0);" onclick="editLabnumber('<?=$item['labnumber'];?>')"><?=$item['labnumber'];?></a>
                </td>
                <td>
                    <a href="chk_edit_lab_item.php?labnumber=<?=$item['labnumber'];?>" title="แก้ไขรายตัว" target="_blank"><?=$item['profilecode'];?></a>
                </td>
                <td>
                    <?php 
                    $inputClinicalinfo = $item['clinicalinfo'];
                    if(empty($item['clinicalinfo'])){
                        $item['clinicalinfo'] = 'คลิกเพื่อแก้ไข';
                    }
                    ?>
                    <a href="javascript:void(0);" title="แก้ไขสถานะ" onclick="showInput('<?=$item['labnumber'];?>','<?=$inputClinicalinfo;?>')"><?=$item['clinicalinfo'];?></a>
                </td>
            </tr>
            <?php
            }
            ?>
        </table>
        <script>
            async function showInput(labnumber,clinicalinfo){ 
                const inputValue = clinicalinfo;
                const { value: clinicalinfoInput } = await Swal.fire({
                    title: "ปรับสถานะแลป",
                    input: "text",
                    inputLabel: "สถานะแลปปัจจุบัน",
                    inputValue,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ข้อมูลให้ถูกต้อง";
                        }
                    },
                    confirmButtonText: "บันทึกข้อมูล",
                    cancelButtonText: "ยกเลิก",
                });
                if (clinicalinfoInput) {
                    
                    let data = [];
                    data.push(encodeURIComponent('action')+"="+encodeURIComponent('saveCinicalinfo'));
                    data.push(encodeURIComponent('labnumber')+"="+encodeURIComponent(labnumber));
                    data.push(encodeURIComponent('clinicalinfo')+"="+encodeURIComponent(clinicalinfoInput));
                    let dataPost = data.join("&");
                    
                    let response = await fetch('chk_lab.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    const body = await response.json();
                    
                    Swal.fire({
                        icon: "success",
                        title: "บันทึกข้อมูลเรียบร้อย",
                        showConfirmButton: false,
                        timer: 1000
                    }).then(()=>{
                        location.reload(true);
                    });
                }
            }

            async function editLabnumber(labnumber){
                const inputValue = labnumber;
                const { value: labnumberInput } = await Swal.fire({
                    title: "แก้ไข Labnumber",
                    input: "text",
                    inputLabel: "เลขที่แลปปัจจุบัน",
                    inputValue,
                    showCancelButton: true,
                    inputValidator: (value) => {
                        if (!value) {
                            return "กรุณาใส่ข้อมูลให้ถูกต้อง";
                        }
                    },
                    confirmButtonText: "บันทึกข้อมูล",
                    cancelButtonText: "ยกเลิก",
                });
                if (labnumberInput) {
                    
                    let data = [];
                    data.push(encodeURIComponent('action')+"="+encodeURIComponent('saveLabnumber'));
                    data.push(encodeURIComponent('oldLabnumber')+"="+encodeURIComponent(labnumber));
                    data.push(encodeURIComponent('newLabnumber')+"="+encodeURIComponent(labnumberInput));
                    data.push(encodeURIComponent('part')+"="+encodeURIComponent('<?=$user['part'];?>'));
                    data.push(encodeURIComponent('hn')+"="+encodeURIComponent('<?=$user['hn'];?>'));
                    let dataPost = data.join("&");
                    
                    let response = await fetch('chk_lab.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        body: dataPost
                    });
                    
                    const body = await response.json();
                    if(body.status==200){
                        Swal.fire({
                            icon: "success",
                            title: "บันทึกข้อมูลเรียบร้อย",
                            showConfirmButton: false,
                            timer: 1000
                        }).then(()=>{
                            location.reload(true);
                        });
                    }
                }
            }
        </script>
        <?php
    }
    ?>
    </body>
    </html>
    <?php
}