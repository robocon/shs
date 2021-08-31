<?php 

require_once 'bootstrap.php';

if (empty($_SESSION["sOfficer"])) {
    redirect('login_page.php', 'Login หมดอายุ กรุณาเข้าใช้งานใหม่อีกครั้ง');
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$page = $_REQUEST['page'];
if($page === 'save')
{
    $patdata_id = $_POST['patdata_id'];

    $sql = "SELECT * FROM `patdata` WHERE `row_id` = '$patdata_id' ";
    $pat_q = $dbi->query($sql);
    if ($pat_q->num_rows > 0) { 
        $msg = "ดำเนินการแก้ไขเรียบร้อย";

        $pat = $pat_q->fetch_assoc();
        $row_id = $pat['row_id'];
        $id_no = $pat['idno'];
        $hn = $pat['hn'];

        $pat_date = $pat['date'];

        list($date, $time) = explode(' ', $pat['date']);

        $newDate = ($_POST['to_years']+543).'-'.$_POST['to_months'].'-'.$_POST['to_day'];

        $newPatdataDate = $newDate.' '.$time;
        
        $pat_update_sql = "UPDATE `patdata` SET `date` = '$newPatdataDate' WHERE `row_id` = '$row_id' ";
        $dbi->query($pat_update_sql);
        $dep_update_sql = "UPDATE `depart` SET `date` = '$newPatdataDate' WHERE `row_id` = '$id_no' ";
        $dbi->query($dep_update_sql);

        $sql_opacc = "SELECT `row_id`, `date` FROM `opacc` WHERE `txdate` = '$pat_date' AND `hn` = '$hn' ";
        $opacc_q = $dbi->query($sql_opacc);
        if($opacc_q->num_rows > 0)
        {
            $opacc = $opacc_q->fetch_assoc();
            $opaccId = $opacc['row_id'];

            list($opaccDate, $opaccTime) = explode(' ',$opacc['date']);
            // list($opaccTxDate, $opaccTxTime) = explode(' ',$opacc['txdate']);

            $newOpaccDate = $newPatdataDate.' '.$opaccTime;

            $opacc_update_sql = "UPDATE `opacc` SET `date` = '$newOpaccDate', `txdate` = '$newPatdataDate'  WHERE `row_id` = '$opaccId' ";
            $dbi->query($opacc_update_sql);
        }
    }
    else
    {
        $msg = "ไม่พบข้อมูล";
    }

    redirect('lab_update_date.php', $msg);
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
    
    <style>body,h1,h2,h3,h4,h5,h6 {font-family: Sarabun, sans-serif;}</style>
    <title>แก้ไขวันที่เฉพาะตรวจคัดกรองเชิงรุก</title>
</head>
<body>
<style>
    @font-face {
    font-family: 'Sarabun';
    src: 
        url('fonts/Sarabun-Light.ttf')  format('truetype') /* Legacy iOS */
    }
    *{
        font-family: Sarabun;
    }
    label:hover{
        cursor: pointer;
    }
</style>
<div class="w3-bar w3-dark-grey">
    <a href="../nindex.htm" class="w3-bar-item w3-button w3-mobile w3-green">หน้าหลัก รพ.</a>
    <a href="lab_checkup_c19.php" class="w3-bar-item w3-button w3-mobile w3-green">คิดเงินตรวจโควิดเชิงรุก</a>
    <a href="lab_update_date.php" class="w3-bar-item w3-button w3-mobile w3-green">แก้ไขคิดเงินตรวจเชิงรุก</a>
</div>
<div>
    <?php 
    if($_SESSION['x-msg'])
    {
        ?>
        <div class="w3-panel w3-pale-yellow">
        <p><?=$_SESSION['x-msg'];?></p>
        </div>
        <?php 
        $_SESSION['x-msg'] = NULL;
    }
    ?>
    <div class="w3-container">
        <h3>LAB :: แก้ไขวันที่เฉพาะตรวจคัดกรองเชิงรุก</h3>
    </div>
    <div class="w3-container">
        <form action="lab_update_date.php" method="post">
            <p>
                <div>
                    วันที่บันทึก : 
                    <?php 
                    $def_d = !empty($_REQUEST['day']) ? $_REQUEST['day'] : date('d');
                    getDateList('day', $def_d);
                    ?>

                    เดือน : 
                    <?php 
                    $def_m = !empty($_REQUEST['months']) ? $_REQUEST['months'] : date('m');
                    getMonthList('months', $def_m);
                    ?>

                    ปี : 
                    <?php
                    $def_y = !empty($_REQUEST['years']) ? $_REQUEST['years'] : date('Y');
                    $years = range('2021', date('Y'));
                    getYearList('years', true, $def_y, $years);
                    ?>
                </div>
            </p>
            <p>
                <div>
                    HN : <input type="text" name="hn" id="hn" value="<?=$_REQUEST['hn'];?>">
                </div>
            </p>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search">
            </div>
        </form>
    </div>

<?php 

if($page === 'search')
{
    $hn = $_REQUEST['hn'];
    $day = $_REQUEST['day'];
    $month = $_REQUEST['months'];
    $year = $_REQUEST['years'];

    $date_from = "$year-$month-$day";

    $date = ($year+543)."-$month-$day";

    $sql_patdata = "SELECT * FROM `patdata` WHERE `date` LIKE '$date%' AND `hn` = '$hn' AND `code` LIKE 'AgCG%' ";
    $q_pat = $dbi->query($sql_patdata);
    if($q_pat->num_rows>0)
    {
        
        $patdata = $q_pat->fetch_assoc();
        $row_id = $patdata['row_id'];
        ?>
        <div class="w3-container">
            <form action="lab_update_date.php" method="post" onsubmit="return test_form_confirm()">
                <table>
                    <tr>
                        <td align="right"><b>วันที่เพิ่มค่าใช้จ่าย : </b></td>
                        <td><?=$patdata['date'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>HN : </b></td>
                        <td><?=$patdata['hn'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>ชื่อ-สกุล : </b></td>
                        <td><?=$patdata['ptname'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Code : </b></td>
                        <td><?=$patdata['code'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>Detail : </b></td>
                        <td><?=$patdata['detail'];?></td>
                    </tr>
                    <tr>
                        <td align="right"><b>เลือกวันที่ ที่ต้องการแก้ไข</b></td>
                        <td>
                            <?php 
                            getDateList('to_day', $def_d);
                            getMonthList('to_months', $def_m);
                            $years = range('2021', date('Y'));
                            getYearList('to_years', true, $def_y, $years);
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: center;">
                            <label for="confirm_data"><input type="checkbox" name="confirm_data" id="confirm_data" onclick="alertForNoti()"> ยืนยันการแก้ไขข้อมูล</label>
                            <br><button type="submit">ดำเนินการแก้ไข</button>

                            <input type="hidden" name="page" value="save">
                            <input type="hidden" name="patdata_id" value="<?=$row_id;?>">

                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <script>
        function alertForNotif()
        {
            var c=confirm("");
        }

        function test_form_confirm()
        {
            var checkbox_confirm = document.getElementById("confirm_data").checked;
            if(checkbox_confirm === true)
            {
                return true;
            }
            else
            {
                alert("กรุณายืนยันการแก้ไขข้อมูล");
            }

            var date_from = '<?=$date_from;?>';
            var date_to = document.getElementById("to_years").value+'-'+document.getElementById("to_months").value+'-'+document.getElementById("to_day").value;

            if(date_from == date_to)
            {
                alert("คำเตือน! วันที่แก้ไขซ้ำกัน กรุณาเลือกวันที่ต้องการแก้ไขอีกครั้ง");
            }
            
            return false;
        }
        </script>
        <?php
    }
    else
    {
        ?>
        <div class="w3-container">
            <p>ไม่พบข้อมูล</p>
        </div>
        <?php
    }
    
}
?>
</div>
</body>
</html>