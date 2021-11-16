<?php 
include 'bootstrap.php';

/*
เลือก hn
เลือก วันที่มารับบริการ
เลือก แพทย์
พิมพ์ ใบรับรอง
*/

$dbi = new mysqli('192.168.131.250','remoteuser','',DB);

$view = $_REQUEST['view'];
if($view == 'hn_lists')
{
    $hn = $_REQUEST['hn'];

    $last_3_months = strtotime("-3 months");
    $str_3_months = (date('Y')+543).date('-m-d');
    $sql = "SELECT `row_id`,`date`,`doctor`,`diag` FROM `depart` WHERE `hn` = '$hn' AND `date` >= '$str_3_months' AND depart = 'PHYSI' ";
    
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
        ?>
        <h2>เลือกแพทย์</h2>
        <form action="physi_certificate.php" method="post" id="form_print_pdf" class="w3-container" target="_blank">
            <p>
                <select class="w3-select w3-border" name="option">
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
?>


<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

<div class="w3-top">
    <div class="w3-bar w3-teal">
        <a href="#" class="w3-bar-item w3-button">หน้าหลัก ร.พ.</a>
    </div>
</div>

<form action="physi_certificate.php" method="post" id="form_search_hn" class="w3-container" style="margin-top: 46px;">

    <p>
        <label for="hn">HN : </label>
        <input type="text" name="form_hn" id="form_hn" class="w3-input w3-border">
    </p>

    <p>
        <button class="w3-button w3-teal" id="btn-Search" type="submit">ค้นหาการมาใช้บริการ</button>
    </p>
    
</form>

<div class="w3-container" id="response-form"></div>
<div class="w3-container" id="response-form-2"></div>

<script>
    // event listener support IE8
    function addEventListener(el, eventName, handler) {
        if (el.addEventListener) {
            el.addEventListener(eventName, handler);
        } else {
            el.attachEvent('on' + eventName, function(){
                handler.call(el);
            });
        }
    }

    // ajax with GET method
    function xmlHttpGET(url, functionName){
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

        var form_hn = document.getElementById('form_hn').value;
        xmlHttpGET("physi_certificate.php?hn="+form_hn+"&view=hn_lists", display_patient_list);

    });

    function display_patient_list(xhttp){
        document.getElementById("response-form").innerHTML = xhttp.responseText;

        // ถ้ามีการคลิกจากคลาส next_select_doctor
        var edit_items = document.getElementsByClassName("next_select_doctor");
        if(edit_items.length > 0)
        {
            for (let index = 0; index < edit_items.length; index++) {
                edit_items[index].addEventListener("click", open_select_doctor);
            }
        }
    }

    function open_select_doctor(){ 
        var get_href = this.getAttribute("data-href");
        xmlHttpGET(get_href, display_select_doctor);
    }

    function display_select_doctor(xhttp){
        document.getElementById("response-form-2").innerHTML = xhttp.responseText;
    }

    
    document.getElementById("btn-print-pdf").addEventListener("submit", function(ev) {

        // ev.preventDefault();

        // var form_hn = document.getElementById('form_hn').value;
        // xmlHttpGET("physi_certificate.php?hn="+form_hn+"&view=hn_lists", display_patient_list);

    });

</script>