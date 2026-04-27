<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

$content = file_get_contents('php://input');
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$data = $json->decode($content);

$action = $data['action'];
if ($action === 'search_user') {

    $whereMenucode = "`menucode` = '%s'";
    if(strpos($data['code'],',')!==false){
        $codeLists = explode(',', $data['code']);
        $items = array();
        foreach ($codeLists as $code) {
            $items[] = "'".$code."'";
        }
        $newItems = implode(',', $items);
        $whereMenucode = "`menucode` IN ($newItems)";
    }

    $sql = sprintf("SELECT `row_id`,`name`,`status` FROM `inputm` WHERE $whereMenucode AND `status` = 'Y' ", $dbi->real_escape_string($data['code']));
    $q = $dbi->query($sql);
    $users = array();
    while ($user = $q->fetch_assoc()) {
        $users[] = $user;
    }
    echo $json->encode($users);
    exit;
}elseif ($action === 'getUserPhone') {

    $sql = sprintf("SELECT `phone` FROM `com_support` WHERE `user` = '%s' ORDER BY `row` DESC LIMIT 1", $dbi->real_escape_string($data['user']));
    $q = $dbi->query($sql);
    if($q->num_rows>0){
        $user = $q->fetch_assoc();
    }else{
        $user = '';
    }
    
    echo $json->encode($user);
    exit;

}elseif ($action === 'save') {

    $date = ad_to_bc(date('Y-m-d H:i:s', strtotime($data['date'])));
    $dateend = ad_to_bc(date('Y-m-d H:i:s', strtotime($data['dateend'])));

    $sql = sprintf("SELECT * FROM `departments` WHERE `menucode`='%s'", $dbi->real_escape_string($data['depart']));
    $q = $dbi->query($sql);
    $dep = $q->fetch_assoc();
    $departName = $dep['name'];

    $sql = sprintf("INSERT INTO `com_support` (
        `row`, `depart`, `head`, `detail`, `datetime`, `status`, 
        `user`, `date`, `programmer`, `phone`, `user1`, `p_edit`, 
        `dateend`, `hold`, `jobtype`,`ignore`,`software_type`
    ) VALUES ( 
        NULL, '%s', '%s', '%s', '', 'n', 
        '%s', '%s', '%s', '%s', '%s', '%s', 
        '%s', '0', '%s', '','%s'
    );",
    $dbi->real_escape_string($departName),
    $dbi->real_escape_string($data['head']),
    $dbi->real_escape_string($data['detail']),

    $dbi->real_escape_string($data['user']),
    $dbi->real_escape_string($date),
    $dbi->real_escape_string($data['programmer']),
    $dbi->real_escape_string($data['phone']),
    $dbi->real_escape_string($data['user']),
    $dbi->real_escape_string($data['p_edit']),
    
    $dbi->real_escape_string($dateend),
    $dbi->real_escape_string($data['jobtype']),
    $dbi->real_escape_string($data['software_type'])
    );
    $q = $dbi->query($sql);
    if($q!==false){
        $res = array('status'=>200, 'msg'=>'บันทึกข้อมูลเรียบร้อย','id'=>$dbi->insert_id);
    }else{
        $res = array('status'=>400, 'msg'=>'ไม่สามารถบันทึกข้อมูลได้', 'error'=>$dbi->error);
    }
    echo $json->encode($res);
    exit;
}

$start = $end = date('Y-m-d H:i');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>คีย์งานเอง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://npmcdn.com/flatpickr/dist/flatpickr.min.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/th.js"></script>
</head>
<body>
<div class="container">
    <style>
        label:hover{
            cursor: pointer;
        }
        .title{
            text-align: right;
        }
        .title::after{
            content: "\00a0";
        }
        table{
            width:100%;
        }
        table tr{
            vertical-align: top;
        }
    </style>
<h3>คีย์งานแบบบันทึกเอง</h3>
<form action="com_support_v3.php" method="post" id="adminForm" style="width:100%;">
    <table>
        <tr>
            <td class="title">แผนก: </td>
            <td>
                <?php
                $sql = "SELECT * FROM `departments` WHERE `status`='y' AND `menucode` <> '' ORDER BY `id` ASC";
                $q = $dbi->query($sql);
                ?>
                <select name="depart" id="depart" class="form-select w-auto mb-2" onchange="getUserDepart()" required="required">
                    <option value="">เลือก</option>
                <?php 
                $key_selected = '';
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <option value="<?=$a['menucode'];?>" data-key="<?=$a['menucode'];?>" ><?=$a['name'];?></option>
                    <?php
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title">ประเภทงาน: </td>
            <td>
                <?php 
				$jobType = array('hardware'=>'งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย', 'software'=>'งานแก้ไขโปรแกรม/พัฒนาระบบสารสนเทศ');
				?>
				<select name="jobtype" id="jobtype" class="form-select w-auto mb-2" onchange="selectType(this.value)" required="required">
					<option value="0" selected>เลือก</option>
					<?php 
					foreach ($jobType as $type => $typeValue) {
						?>
						<option value="<?=$type;?>" ><?=$typeValue;?></option>
						<?php
					}
					?>
				</select>
            </td>
        </tr>
        <tr style="display:none" id="swTypeContain">
            <td class="title">ประเภทย่อย: </td>
            <td>
                <select name="software_type" id="software_type" class="form-select w-auto mb-2">
                <?php 
                $softwareTypeList = array('software_type1' => 'แก้ไขโปรแกรม/ข้อมูล','software_type2' => 'พัฒนาโปรแกรม');
                foreach ($softwareTypeList as $swKey => $swType) {
                    ?>
                    <option value="<?=$swType;?>"><?=$swType;?></option>
                    <?php
                }
                ?>
                </select>
            </td>
        </tr>
        <tr>
            <td class="title">หัวข้อ: </td>
            <td><input type="text" name="head" id="head" class="form-control w-auto mb-2" required="required"></td>
        </tr>
        <tr>
            <td class="title">รายละเอียด: </td>
            <td>
                <textarea name="detail" id="detail" class="form-control mb-2" rows="4" required="required"></textarea>
            </td>
        </tr>
        <tr>
            <td class="title">ผู้แจ้ง: </td>
            <td>
                <div id="informer" class="mb2">เลือกจากแผนก</div>
            </td>
        </tr>
        <tr>
            <td class="title">โทรศัพท์ภายใน: </td>
            <td>
                <input type="text" name="phone" id="phone" class="form-control w-auto mb-2" required="required">
            </td>
        </tr>
        <tr>
            <td class="title">ผู้รับผิดชอบ: </td>
            <td>
                <input type="text" name="programmer" id="programmer" class="form-control w-auto mb-2" value="<?= $_SESSION['sOfficer'] ?>">
            </td>
        </tr>
        <tr>
            <td class="title">เริ่ม: </td>
            <td>
                <?php 
                if($s['date']){
                    $start = $s['date'];
                }
                ?>
                <input type="text" name="date" id="date" class="form-control w-auto mb-2" value="<?=$start;?>">
            </td>
        </tr>
        <tr>
            <td class="title">สิ้นสุด: </td>
            <td>
                <input type="text" name="dateend" id="dateend" class="form-control w-auto mb-2" value="<?=$end;?>">
            </td>
        </tr>
        <tr>
            <td class="title">การทำเนินการ: </td>
            <td>
                <textarea name="p_edit" class="form-control mb-4" id="p_edit">ดำเนินการแก้ไขเรียบร้อย</textarea>
            </td>
        </tr>
        <tr>
            <td colspan="2">
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="submit">บันทึก</button>
                </div>
                <input type="hidden" id="formAction" name="action" value="save">
            </td>
        </tr>
    </table>
</form>
<script>

    window.addEventListener('load', (event) => {
        flatpickr("#date", {
            locale: "th", // ใช้ภาษาไทย (จ. อ. พ. ...)
            dateFormat: "Y-m-d H:i", // รูปแบบวันที่เก็บใน Database (ค.ศ.)
            enableTime: true,
            time_24hr: true,
            defaultDate: "<?= date('Y-m-d H:i') ?>"
        });
        flatpickr("#dateend", {
            locale: "th", // ใช้ภาษาไทย (จ. อ. พ. ...)
            dateFormat: "Y-m-d H:i", // รูปแบบวันที่เก็บใน Database (ค.ศ.)
            enableTime: true,
            time_24hr: true,
            defaultDate: "<?= date('Y-m-d H:i') ?>"
        });
    });

    /**
     * บันทึกข้อมูล
     */
    document.getElementById("adminForm").addEventListener("submit", function(event){
        event.preventDefault();
        const formData = {
            "action": "save",
            "depart" : document.getElementById('depart').value,
            "jobtype" : document.getElementById('jobtype').value,
            "head" : document.getElementById('head').value,
            "detail" : document.getElementById('detail').value,
            "user" : document.getElementById('informerUser').value,
            "phone" : document.getElementById('phone').value,
            "programmer" : document.getElementById('programmer').value,
            "date" : document.getElementById('date').value,
            "dateend" : document.getElementById('dateend').value,
            "software_type" : document.getElementById('software_type').value,
            "p_edit" : document.getElementById('p_edit').value
        };

        sendForm(formData).then((res)=>{
            if(res.status===200){
                Swal.fire({
                    icon:'success',
                    title:res.msg,
                    html:`<a href="comdetail.php?row=${res.id}" target="_blank">คลิกที่นี่</a> เพื่อดูรายละเอียดที่บันทึก`
                }).then((res)=>{
                    if(res.isConfirmed){
                        location.reload();
                    }
                });
            }else{
                Swal.fire({
                    icon:'error',
                    title:res.msg,
                    html:`<b>Error: </b>${res.error}<br>เหมือนโปรแกรมจะมีปัญหา ถ่ายภาพหน้าจอแล้วแจ้งซ่อม ได้เลยครับ`
                });
            }
        });
        
    });

    async function sendForm(formData){
        const res = await sendPost(formData);
        return res;
    }

    function selectType(v){
        if(v==='software'){
            document.getElementById('swTypeContain').style.display = '';
        }else{
            document.getElementById('swTypeContain').style.display = 'none';
        }
    }

    async function getUserDepart(){
        const menuCode = document.getElementById('depart').value.trim();
        // ล้างค่าเบอร์โทรถ้าเมื่อเปลี่ยนแผนก
        document.getElementById('phone').value='';
        if(menuCode===""){
            document.getElementById('informer').innerHTML = 'เลือกจากแผนก';
        }else{
        
            doGetUserDepart(menuCode).then((resUsers)=>{
                
                // สร้าง select
                let setSelect = document.createElement('select');
                setSelect.setAttribute('name','informerUser');
                setSelect.setAttribute('id','informerUser');
                setSelect.setAttribute('onchange','findPhone(this.value)');
                setSelect.className = "form-select w-auto mb2";

                // default option เป็นให้เลือก
                let defOption = document.createElement('option');
                defOption.value = '';
                defOption.innerText = 'เลือกผู้แจ้ง';
                setSelect.appendChild(defOption);

                for (let index = 0; index < resUsers.length; index++) {
                    const user = resUsers[index];

                    let setOption = document.createElement('option');
                    setOption.value = user.name;
                    setOption.innerText = user.name;
                    setSelect.appendChild(setOption);
                    
                }
                
                document.getElementById('informer').innerHTML = '';
                document.getElementById('informer').appendChild(setSelect);
            });

        }
    }

    async function doGetUserDepart(menuCode){
        
        const formData = {
            "code": menuCode,
            "action": "search_user"
        };

        const res = await sendPost(formData);
        return res;
    }

    async function findPhone(v){
        doFindPhone(v).then((res)=>{
            if(typeof res.phone !== 'undefined'){
                document.getElementById('phone').value=res.phone;
            }
        });
    }

    async function doFindPhone(username){
        const formData = {
            "user": username,
            "action": "getUserPhone"
        };
        
        const res = await sendPost(formData);
        return res;
    }

    async function sendPost(formData){
        const response = await fetch('com_support_v3.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        const responseData = await response.json();
        return responseData;
    }
</script>

</div>
</body>
</html>