<?php

include 'bootstrap.php';
include 'includes/JSON.php';

$action = input('action');
$db = Mysql::load();

if ($action==='findWithYear') {

    $year = sprintf("%s", $_GET['year'])+543;
    $json = new Services_JSON();
    $items = array();
    $db->select("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `yearchk` = '$year' AND `status` = '1' ORDER BY `id` DESC ");
    $itemCount = $db->get_rows();
    if($itemCount > 0){
        $items = $db->get_items();
        $res = array(
            'count' => $itemCount,
            'data' => $items,
            'status' => 200
        );
    }else{
        $res = array(
            'count' => $itemCount,
            'data' => $items,
            'status' => 400
        );
    }

    echo $json->encode($res);
    exit;
}elseif($action==='check_company'){
    $json = new Services_JSON();
    $code = $_GET['name'];

    $db->select("SELECT id FROM `chk_company_list` WHERE `code` = '$code' LIMIT 1");
    $row = $db->get_rows();
    if($row > 0){
        $res = array('status' => 400);
    }else{
        $res = array('status' => 200);
    }
    echo $json->encode($res);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <title>ระบบจัดการข้อมูล ตรวจสุขภาพ</title>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php
include 'chk_menu.php';
?>

<button onclick="formAddCompany()">+ เพิ่มบริษัท</button>

<div id="myModal" class="modal" style="display:none;">
    <div id="myModalContainer">
        <div class="clearfix">
            <div id="myModalHeader"><a href="javascript:void(0);" onclick="closeFormAdd()"><span class="close">&times; ปิด</span></a></div>
        </div>
        <div id="resFormAddCompany"></div>
    </div>
</div>

<br>
<div class="clearfix">
    <fieldset style="float:left;">
        <legend>ค้นหาตามปีงบประมาณ</legend>
        <form action="chk_company.php" method="post">
            <div> เลือกปี : 
                <?php 
                $year_selected = input_post('year_selected', date('Y') );
                $year_range = range('2018',get_year_checkup(true, true)+1);
                getYearList('year_selected', true, $year_selected, $year_range,false, 'getCompany');
                ?>
            </div>
            <div>
                <span>เลือกบริษัท : </span>
                <?php 
                $db->select("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `yearchk` = '".($year_selected+543)."' AND `status` = '1' ORDER BY `id` DESC ");
                if($db->get_rows()>0){
                    ?>
                    <span id="selectYearResponse">
                        <select name="companySelected" id="companySelected">
                            <option value="">-- แสดงทั้งหมด --</option>
                            <?php 
                            $companyItems = $db->get_items();
                            foreach ($companyItems as $companyItem) {
                                ?><option value="<?=$companyItem['id'];?>"><?=$companyItem['code'];?></option><?php
                            }
                            ?>
                        </select>
                    </span>
                    <?php
                }else{
                    ?><div>ไม่มีข้อมูลในปี <?= ($year_selected+543); ?></div><?php
                }
                ?>
            </div>
            <div>
                <button type="submit">แสดงผล</button>
                <input type="hidden" name="views" value="search">
            </div>
        </form>
    </fieldset>
    <fieldset style="float:left;">
        <legend>ค้นหาจากชื่อบริษัท</legend>
        <form action="chk_company.php" method="post">
            <table>
                <tr>
                    <td><strong>ชื่อ :</strong></td>
                    <td>
                        <input type="text" name="company_name" id="company_name" required>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <button type="submit">แสดงผล</button>
                        <input type="hidden" name="views" value="search">
                    </td>
                </tr>
            </table>
        </form>
    </fieldset>
</div>
<script>

    function formAddCompany(){
        loadFormAddCompany().then((res)=>{ 
            document.getElementById('resFormAddCompany').innerHTML = res;
            document.getElementById('myModal').style.display = '';
        });
    }

    async function loadFormAddCompany(id=0){
        const response = await fetch('chk_form_company.php?id='+id);
        const body = await response.text();
        return body;
    }

    function btnEditCompany(id){
        loadFormAddCompany(id).then((res)=>{ 
            document.getElementById('resFormAddCompany').innerHTML = res;
            document.getElementById('myModal').style.display = '';
        });
    }

    function closeFormAdd(){
        document.getElementById('myModal').style.display = 'none';
    }

    function getCompany(){
        let yearSelected = document.getElementById('year_selected').value;
        getComapnyAsync(yearSelected).then((response)=>{
            let res = JSON.parse(response);
            if(res.count>0){
                
                document.getElementById('companySelected').innerHTML = '';

                let companyTxt = '<option value="">-- แสดงทั้งหมด --</option>';
                for( let i=0; i<res.count; i++){
                    const com = res.data[i];
                    companyTxt += '<option value="'+com.id+'">'+com.code+'</option>';
                }

                document.getElementById('companySelected').innerHTML = companyTxt;
            }
        });
    }
    async function getComapnyAsync(year){
        const response = await fetch('chk_company.php?action=findWithYear&year='+year);
        if (!response.ok) {
        }
        const body = await response.text();
        return body;
    }

    function showGenVn(){
        let genVnChecked = document.getElementById('genVn');
        if(genVnChecked.checked===true){
            document.getElementById('genVnContainer').style.display = '';
        }else{
            document.getElementById('genVnContainer').style.display = 'none';
            document.getElementById('job_date_run').value = '';
        }
    }
    
    function formAddCompanySubmit(){
        event.preventDefault();

        let company = document.getElementById('company').value.trim();
        let company_code = document.getElementById('company_code').value.trim();

        let genVn = document.getElementById('genVn').checked;
        let job_date_run = document.getElementById('job_date_run').value;

        let formValue = true;
        if(company==''){
            Swal.fire("กรุณากรอก ชื่อบริษัท");
            formValue = false;
        }else if(company_code==''){
            Swal.fire("กรุณากรอก รหัสบริษัท");
            formValue = false;
        }else if(genVn===true){
            
            if(job_date_run==''){
                Swal.fire("กรุณาเลือกวันที่ในการออก VN");
                formValue = false;
            }else{

                const jobDate = new Date(job_date_run);
                const dateNow = new Date("<?=date('Y-m-d');?>");
                if(jobDate.getTime() <= dateNow.getTime()){
                    Swal.fire({
                        title: "กรุณาเลือกวันที่ของงานที่จะเกิดขึ้นในอนาคต",
                        icon: "warning"
                    });
                    formValue = false;
                }
            }
        }

        if(formValue===true){
            
            let form = document.getElementById('formAddCompany');
            let formData = {};
            for (let index = 0; index < form.elements.length; index++) {
                const element = form.elements[index];
                if(element.type!=="submit" && element.value !== ''){
                    formData[element.name] = element.value;
                }
            }
            doSaveForm(formData).then((res)=>{
                if(res.status===200){
                    Swal.fire("บันทึกข้อมูลเรียบร้อย").then((fResult)=>{
                        location.reload();
                    });
                }else{
                    Swal.fire(res.message);
                }
            });
        }
    }

    async function doSaveForm(formData){
        let response = await fetch('chk_subapi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const res = await response.json();
        return res;
    }

    /**
     * ปุ่มตรวจสอบ รหัสบริษัท
     */
    function onCheckCompany(){
        let company_code = document.getElementById('company_code').value.trim();
        if(company_code==''){
            Swal.fire("กรุณากรอก รหัสบริษัท ก่อนที่จะตรวจสอบ");
        }else{
            doCheckCompany(company_code).then((res)=>{
                if(res.status==400){
                    Swal.fire({
                        title: "มีการใช้รหัสบริษัทนี้ไปแล้ว กรุณาเปลี่ยนใหม่อีกครั้ง",
                        icon: "warning"
                    });
                }else if(res.status==200){
                    Swal.fire({
                        title: "สามารถใช้รหัสนี้ได้",
                        icon: "success"
                    });
                }
            });
        }
    }

    async function doCheckCompany(name){
        const response = await fetch('chk_company.php?action=check_company&name='+name);
        const data = await response.json();
        return data;
    }

    function confirmDelCompany(companyId){
        Swal.fire({
            title: "คุณมั่นใจที่จะลบข้อมูล",
            text: "การลบข้อมูลนี้จะไม่สามารถกู้ข้อมูลคืนมาได้อีก",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "ใช่ ลบข้อมูลได้เลย",
            cancelButtonText: "ยกเลิก"
        }).then((result) => {
            if (result.isConfirmed) {
                doDelCompany(companyId).then((res)=>{
                    if(res.status==400){
                        Swal.fire({
                            title: "ไม่สามารถลบข้อมูลได้",
                            text: res.message,
                            icon: "warning"
                        });
                    }else if(res.status==200){
                        Swal.fire({
                            title: "ลบข้อมูลเรียบร้อย",
                            icon: "success"
                        }).then((fResult)=>{
                            window.location = 'chk_company.php';
                        });
                    }
                });
            }
        });
    }

    async function doDelCompany(companyId){
        let formData = {
            "id": companyId,
            "action": "delCompany"
        };
        let response = await fetch('chk_subapi.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });
        const res = await response.json();
        return res;
    }
</script>
<?php 
$views = input_post('views');
if ( $views == 'search' ) {
?>
<div>
    <?php 
    $company_name = $_POST['company_name'];

    $year_selected += 543; 

    $companySelected = sprintf($_POST['companySelected']);
    $whereCompany = '';
    if(!empty($companySelected)){
        $whereCompany = "AND `id` = '$companySelected' ";
    }

    if(empty($company_name)){
        $sql = "SELECT * FROM `chk_company_list` 
        WHERE `yearchk` = '$year_selected' $whereCompany AND `status` = '1' 
        ORDER BY `id` DESC";
    }else{
        $sql = "SELECT * FROM `chk_company_list` WHERE `name` LIKE '%$company_name%' ORDER BY `id` DESC";
    }
    
    $db->select($sql);
    $items = $db->get_items();
    if(count($items)>0){
    ?>
    <h3>รายชื่อบริษัท</h3>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th style="width: 15%;">ชื่อบริษัท</th>
            <th style="width: 20%;">รหัสเชื่อมข้อมูล</th>
            <th>ช่วงเวลาที่ตรวจ</th>
            <th>ปีงบ</th>
            <th>ลงผล/พิมพ์ผล</th>
            <th>พิมพ์ผล ปกส.</th>
        </tr>
        <?php
        $i = 1;

        // เปิดให้ใช้งานในเมนู manual_expense เพื่อเพิ่มค่าใช้จ่าย
        // เทศบาลเมืองพิชัย 67
        // $expense_list = array('องค์การบริหารส่วนจังหวัดลำปาง 68');
        $expense_list = array('แขวงทางหลวงลำปางที่ 2 มี.ค. 69');
        foreach ($items as $key => $item) {

            $companyCode = $item['code']; 
            $db->select("SELECT COUNT(`HN`) AS `rows` FROM `opcardchk` WHERE `part` = '$companyCode' ");
            $op = $db->get_item();
            $userRows = $op['rows'];

            $report = ( !empty($item['report']) ) ? $item['report'].'?camp='.$item['code'] : 'javascript:void(0);' ;

            $reportAllFile = (!empty($item['report_all'])) ? $item['report_all'] : 'chk_report_all.php' ;

            $reportAll = $reportAllFile.'?camp='.$item['code'];
            ?>
            <tr style="vertical-align:top;">
                <td><?=$i;?></td>
                <td><a href="chk_show_user.php?part=<?=urlencode($item['code']);?>" target="_blank" title="ดูรายชื่อทั้งหมด"><?=$item['name'];?></a></td>
                <td>
                    <a href="javascript:void(0);" onclick="btnEditCompany('<?=$item['id'];?>')">✏️ <?=$item['code'];?> <b></a>(<?=$userRows;?>ราย)</b>
                    <?php
                    if(!empty($item['job_date_run']) && $item['job_status']==='r'){
                        ?>
                        <div><a href="pre_vn.php?id=<?= $item['id']; ?>" target="_blank">⚙️ ตั้งค่าออกVN</a></div>
                        <?php
                    }
                    ?>
                </td>
                <td><?=$item['date_checkup'];?></td>
                <td align="center"><?=$item['yearchk'];?></td>
                <td style="vertical-align: top;">
                    <ol class="itemMenu">
                        <li><a href="out_result.php?part=<?=$item['code'];?>" target="_blank">ลงข้อมูลซักประวัติ</a></li>
                        <li><a href="<?=$report;?>" target="_blank">ผลตรวจรายบุคคล</a></li>
                        <li><a href="<?=$reportAll;?>" target="_blank">สรุปผลตรวจ</a></li>
                        <!-- <li><a href="chk_all_lab.php?part=<?=$item['code'];?>" target="_blank">ผล Lab ทั้งหมด</a></li> -->
                        <li><a href="chk_lab_sticker.php?part=<?=$item['code'];?>" target="_blank">พิมพ์สติกเกอร์ LAB</a></li>
                        <!-- <li><a href="chk_report_all_money.php?camp=<?=$item['code'];?>" target="_blank">ทดสอบ ค่าใช้จ่ายจากรายการแลป (ตรวจนอกรพ.)</a></li> -->
                        <li>
                            <a href="chk_print_xray.php?id=<?=$item['id'];?>" target="_blank">พิมพ์ใบนำทาง X-Ray</a>
                        </li>
                        <!-- <li>
                            <a href="chk_load_lab.php?id=<?=$item['id'];?>" target="_blank">พิมพ์ผลแลป METAMP</a>
                        </li> -->
                        <?php 
                        if(in_array($item['code'], $expense_list)===true){
                            ?>
                            <li>
                                <a href="manual_expense.php?part=<?=$item['code'];?>" target="_blank" style="border: 1px solid #1e8958; background-color: #0a3622; border-radius: 4px; padding: 0 2px; color: #ffffff;">&#128073; บันทึกค่าใช้จ่าย อปท.</a>
                            </li>
                            <?php
                        }
                        if(preg_match('/(ตำรวจ)/',$item['code'])!==false){
                            ?>
                            <li>
                                <a href="checkup/PoliceCbcUa.php?part=<?=$item['code'];?>" target="_blank">ผลตรวจห้องปฏิบัติการ</a>
                            </li>
                            <li>
                                <a href="checkup/PoliceEtc.php?part=<?=$item['code'];?>" target="_blank">ผลการตรวจร่างกายทั่วไป</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ol>
                </td>
                <td style="vertical-align: top;">
                    <ol class="itemMenu">
                        <li><a href="chk_cross_sso.php?camp=<?=$item['code'];?>" target="_blank">สรุปผลรวม</a></li>
                        <li><a href="chk_print_all_sso.php?part=<?=rawurlencode($item['code']);?>" target="_blank">พิมพ์ผลตามแบบฟอร์มประกันสังคม</a></li>
                        <li><a href="chk_money_sso.php?part=<?=$item['code'];?>" target="_blank">พิมพ์ค่าใช้จ่าย</a></li>
                    </ol>
                </td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    }else{
        ?><div><p><strong>ไม่พบข้อมูล</strong></p></div><?php
    }
    ?>
</div>
<button onclick="topFunction()" id="myBtn" title="Go to top">Top</button>
<script>
    // Get the button:
    let mybutton = document.getElementById("myBtn");

    // When the user scrolls down 20px from the top of the document, show the button
    window.onscroll = function() {scrollFunction()};

    function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
            mybutton.style.display = "block";
        } else {
            mybutton.style.display = "none";
        }
    }

    // When the user clicks on the button, scroll to the top of the document
    function topFunction() {
        document.body.scrollTop = 0; // For Safari
        document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
    }
</script>
<?php
}
?>
</body>
</html>