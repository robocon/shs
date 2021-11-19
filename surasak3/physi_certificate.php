<?php 
include 'bootstrap.php';

if(empty($_SESSION['sRowid']))
{
    $_SESSION['refer'] = 'physi_certificate.php';
    redirect('login_page.php');
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);

$view = $_REQUEST['view'];
if($view == 'hn_lists')
{
    $hn = $_REQUEST['hn'];

    $last_3_months = strtotime("-3 months");
    $str_3_months = (date('Y', $last_3_months)+543).date('-m-d', $last_3_months);
    $sql = "SELECT `row_id`,`date`,`doctor`,`diag` 
    FROM `depart` 
    WHERE `hn` = '$hn' 
    AND `date` >= '$str_3_months' 
    AND `depart` = 'PHYSI' 
    AND `staf_massage` = '' 
    ORDER BY `row_id` DESC";
    $data_checker = false;
    if(!empty($hn))
    {
        $q = $dbi->query($sql);
        if($q->num_rows > 0)
        {
            $data_checker = true;

            ?>
            <h2>เลือกวันที่ตรวจ</h2>
            <table class="w3-table-all">
                <tr>
                    <th>วันที่มาใช้บริการ</th>
                    <th>แพทย์</th>
                    <th>Diag</th>
                </tr>
                <?php 
                while ($item = $q->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td><a href="javascript:void(0);" data-href="physi_certificate.php?view=display_doctor&dep_id=<?=$item['row_id'];?>" class="next_select_doctor" ><?=$item['date'];?></a></td>
                        <td><?=$item['doctor'];?></td>
                        <td><?=$item['diag'];?></td>
                    </tr>
                    <?php
                }
                ?>
                
            </table>
            <?php
        }
    }

    if($data_checker === false)
    {
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
    exit;
}
elseif($view=='display_doctor')
{
    $dep_id = $_REQUEST['dep_id'];
    $sql = "SELECT * FROM `depart` WHERE `row_id` = '$dep_id' ";
    $q = $dbi->query($sql);

    if($q->num_rows > 0)
    {
        $item = $q->fetch_assoc();

        $physi_dt_list = array(
            '3023' => 'พ.ต.สุทัศน์ เครือแก้ว', 
            '10399' => 'ร.ท.หญิงปุณนาพร อินทรรักษ์', 
            '9927' => 'นางสาววรางคณา ธาตุรักษ์', 
            '12560' => 'นางสาววรดา เตจะน้อย' 
        );
        ?>
        <h2>เลือกแพทย์</h2>
        <form action="physi_certificate_print.php" method="post" id="form_print_pdf" target="_blank">
            <p>
                <select class="w3-select w3-border" name="physi_dt">
                    <option value="3023">พ.ต.สุทัศน์ เครือแก้ว</option>
                    <option value="10399">ร.ท.หญิงปุณนาพร อินทรรักษ์</option>
                    <option value="9927">นางสาววรางคณา ธาตุรักษ์</option>
                    <option value="12560">นางสาววรดา เตจะน้อย</option>
                </select>
            </p>
            <p>
                <button class="w3-button w3-teal" id="btn-print-pdf" type="submit">พิมพ์ใบรับรองแพทย์</button>
                <input type="hidden" name="id" value="<?=$item['row_id'];?>">
            </p>
        </form>
        <?php
    }
    else
    {
        ?>
        <p>ไม่พบข้อมูล</p>
        <?php
    }
    exit;
}
elseif ($view == 'load_edit_list') {

    $date = $_REQUEST['selected_date'];
    $sql = "SELECT * FROM `physi_cert_history` WHERE `date_save` = '$date' ";
    $q = $dbi->query($sql);
    if($q->num_rows > 0)
    {
        ?>
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <table class="w3-table-all">
            <tr>
                <th>เล่มที่</th>
                <th>วันที่ออกใบรับรอง</th>
                <th>แพทย์</th>
                <th>ผู้มารับบริการ</th>
                <th>Diag</th>
                <th></th>
            </tr>
        
        <?php
        while ($item = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$item['number'];?></td>
                <td><?=$item['date'];?></td>
                <td><?=$item['physi_dt_name'];?></td>
                <td><?=$item['ptname']."(".$item['hn'].")";?></td>
                <td><?=$item['diag'];?></td>
                <td><a href="physi_certificate_reprint.php?id=<?=$item['id'];?>" title="Print" target="_blank"><i class="material-icons">print</i></a></td>
            </tr>
            <?Php
        }
        ?>
        </table>
        <div>&nbsp;</div>
        <?php
    }
    else
    {
        ?><p>ไม่พบข้อมูล</p><?php
    }
    
    exit;
}
?>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    #epoch_popup_calendar{
        z-index: 4;
    }
</style>

<div class="w3-top">
    <div class="w3-bar w3-teal">
        <a href="../nindex.htm" class="w3-bar-item w3-button" style="text-shadow: 2px 2px 2px #444;">หน้าหลัก ร.พ.</a>
        <a href="javascript:void(0);" class="w3-bar-item w3-button" onclick="open_history()" style="text-shadow: 2px 2px 2px #444;">ข้อมูลย้อนหลัง</a>
    </div>
</div>

<form action="physi_certificate.php" method="post" id="form_search_hn" class="w3-container" style="margin-top: 46px;">
    <h2>พิมพ์ใบรับรองแพทย์กายภาพบำบัด</h2>
    <p>
        <label for="hn">HN : </label>
        <input type="text" name="form_hn" id="form_hn" class="w3-input w3-border">
        
    </p>

    <p>
        <button class="w3-button w3-teal" id="btn-Search" type="submit">ค้นหาการมาใช้บริการ</button>
        <span id="loading" style="display: none;">Loading <i class="fa fa-refresh fa-spin"></i></span>
    </p>
    
</form>

<div class="w3-container" id="response-form"></div>
<div class="w3-container" id="response-form-2"></div>

<script type="text/javascript" src="epoch_classes.js"></script>

<!-- The Modal -->
<div id="id01" class="w3-modal">
    <div class="w3-modal-content w3-animate-top">
        <div class="w3-container">
            <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
            <p>
                <label for="hn">ค้นหาตามวันที่ : </label>
                <input type="text" name="selected_date" id="selected_date" class="w3-input w3-border">
                <button type="button" class="w3-button w3-teal" onclick="load_edit_items()">ค้นหา</button>
            </p>
            <div id="edit_main_container"></div>
        </div>
    </div>
</div>

<script>

    window.onload = function () {
		var selected_date  = new Epoch('epoch_popup','popup',document.getElementById('selected_date'));
	};

    // Start to lern vanilla.js here ==> https://youmightnotneedjquery.com/ <==
    // event listener support IE8
    function addEventListener(el, eventName, handler) 
    {
        if (el.addEventListener) {
            el.addEventListener(eventName, handler);
        } else {
            el.attachEvent('on' + eventName, function(){
                handler.call(el);
            });
        }
    }

    // ajax with GET method
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

    document.getElementById("form_search_hn").addEventListener("submit", function(ev) {
        ev.preventDefault();
        document.getElementById('loading').style.display = '';

        var form_hn = document.getElementById('form_hn').value;
        xmlHttpGET("physi_certificate.php?hn="+form_hn+"&view=hn_lists", display_patient_list);

    });
    
    function disable_loading(){
        document.getElementById('loading').style.display = 'none';
    }

    function display_patient_list(xhttp)
    {
        xhttp.onload = function(){
            disable_loading();
        }
        
        document.getElementById("response-form").innerHTML = xhttp.responseText;

        // ถ้ามีการคลิกจากคลาส next_select_doctor
        var edit_items = document.getElementsByClassName("next_select_doctor");
        if(edit_items.length > 0)
        {
            for (let index = 0; index < edit_items.length; index++) 
            {
                edit_items[index].addEventListener("click", open_select_doctor);
            }
        }
    }

    function open_select_doctor()
    { 
        var get_href = this.getAttribute("data-href");
        xmlHttpGET(get_href, display_select_doctor);
    }

    function display_select_doctor(xhttp)
    {
        document.getElementById("response-form-2").innerHTML = xhttp.responseText;
    }

    function open_history()
    {
        document.getElementById('id01').style.display='block';
    }

    function load_edit_items()
    {
        var selected_date = document.getElementById('selected_date').value;
        xmlHttpGET('physi_certificate.php?view=load_edit_list&selected_date='+selected_date, function(xhttp){
            
            document.getElementById("edit_main_container").innerHTML = xhttp.responseText;
        });
    }

</script>