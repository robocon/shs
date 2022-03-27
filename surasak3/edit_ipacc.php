<?php 
require_once 'bootstrap.php';
error_reporting(1);

if (empty($_SESSION["sOfficer"])) {
    redirect('login_page.php', 'Login หมดอายุ กรุณาเข้าใช้งานใหม่อีกครั้ง');
    exit;
}

// $dbi = new mysqli(HOST,USER,PASS,DB);
$dbi = new mysqli('192.168.131.250', 'remoteuser', '', 'smdb');
// $dbi = new mysqli('localhost', 'root', '12345678', 'smdb');

$action = $_REQUEST['action'];
$page = $_REQUEST['page'];

if($action === 'add')
{
    $item_code = trim($_POST['code']);
    if($item_code!="21401" AND $item_code!="21501" AND $item_code!="NCARE" AND $item_code!="045002")
    {
        echo "รายการไม่ถูกต้อง กรุณาตรวจสอบข้อมูลอีกครั้ง";
        exit;
    }

    $an = trim($_POST['an']);
    if(preg_match('/\d{2}\/\d+/', $an, $matchs)==0)
    {
        echo "ไม่พบ AN กรุณาตรวจสอบข้อมูลอีกครั้ง";
        exit;
    }
    

    $staff = $_POST['staff'];
    $fix_date = $_POST['fix_date'];
    if(preg_match('/\d{4}\-\d{2}\-\d{2}/', $fix_date)==0)
    {
        echo "รูปแบบวันที่ไม่ถูกต้อง กรุณาตรวจสอบข้อมูลอีกครั้ง";
        exit;
    }

    $amount = $_POST['amount'];

    if(!empty($fix_date))
    {
        $date_now = $fix_date.date(' H:i:s');
    }
    else
    {
        // $date_now = (date('Y')+543).date('-m-d H:i:s');
    }

    require_once 'class_file/PatientLab.php';

    // $ptlab = new PatientLab();
    // $ptlab->data_input = array(
    //     'an' => $an,
    //     'lab_code' => $item_code,
    //     'amount' => $amount,
    //     'fix_date' => $fix_date,
    //     'sOfficer' => $_SESSION["sOfficer"]
    // );
    
    // $test = $ptlab->SaveExpense();
    // dump($test);
    // exit;
    
    $sql = "SELECT `hn`,`an`,`ptname`,`doctor`,`diag`,`ptright` FROM `ipcard` WHERE `an` = '$an' ";
    $ipcard_q = $dbi->query($sql);
    if($ipcard_q->num_rows == 0)
    {
        echo "ไม่พบ AN";
        exit;
    }

    $ipcard = $ipcard_q->fetch_assoc();
    $doctor = $ipcard['doctor'];
    $ptname = $ipcard['ptname'];
    $hn = $ipcard['hn'];
    $an = $ipcard['an'];
    $diag = $ipcard['diag'];
    $ptright = $ipcard['ptright'];

    if($item_code=="21401" OR $item_code=="21501" OR $item_code=="045002")
    {
        $sql = "SELECT `row_id`,`depart`,`part`,`code`,`detail`,`price`,`yprice` FROM `labcare` WHERE `code` = '$item_code' ";
        $lab_q = $dbi->query($sql);
        $labcare = $lab_q->fetch_assoc();

        $depart = $labcare['depart'];
        $part = $labcare['part'];
        
        $code = $labcare['code'];
        $detail = $labcare['detail'];
        $price = $labcare['price'] * $amount;
        $yprice = $labcare['yprice'] * $amount;
        $nprice = ($labcare['nprice'] == '') ? '0.00' : $labcare['nprice'] * $amount;
        $idname = $staff;

        $dbi->query("LOCK TABLES `runno` READ;");
        $runno_q = $dbi->query("SELECT * FROM `runno` WHERE `title` = 'depart' ");
        $runno_item = $runno_q->fetch_assoc();
        $number = $runno_item['runno']+1;
        $dbi->query("UNLOCK TABLES;");

        $dbi->query("LOCK TABLES `runno` WRITE;");
        $runno_q = $dbi->query("UPDATE runno SET runno = '$number' WHERE title = 'depart';");
        $dbi->query("UNLOCK TABLES;");

        
        $depart_insert = "INSERT INTO `depart` (
            `row_id`, `chktranx`, `date`, `ptname`, `hn`, `an`, 
            `doctor`, `depart`, `item`, `detail`, `price`, `sumyprice`, 
            `sumnprice`, `paid`, `idname`, `diag`, `accno`, `tvn`, 
            `ptright`, `lab`, `cashok`, `detailbydr`, `status`, `priority`, 
            `patient_from`, `staf_massage`
        ) VALUES (
            NULL, '$number', '$date_now', '$ptname', '$hn', '$an', 
            '$doctor', '$depart', '1', '$detail', '$price', '$yprice', 
            '$nprice', '0.00', '$idname', '$diag', '1', '$an', 
            '$ptright', NULL, NULL, '', 'Y', '', 
            '', ''
        );";
        dump($depart_insert);
        $depart_id = NULL;
        if($dbi->query($depart_insert)===true)
        {
            $depart_id = $dbi->insert_id;
            echo "depart บันทึกเรียบร้อย <br>";
        }
        else
        {
            echo $dbi->error;
            exit;
        }

        $patdata_insert = "INSERT INTO `patdata` (
            `row_id`, `date`, `hn`, `an`, `ptname`, `copy`, 
            `doctor`, `item`, `code`, `detail`, `amount`, `price`, 
            `yprice`, `nprice`, `paid`, `depart`, `labcode`, `report`, 
            `part`, `idno`, `picture`, `ptright`, `film_size`, `status`, 
            `priority`, `tranipacc`
        ) VALUES (
            NULL, '$date_now', '$hn', '$an', '$ptname', NULL, 
            '$doctor', '1', '$code', '$detail', '$amount', '$price', 
            '$yprice', '$nprice', NULL, '$depart', NULL, NULL, 
            '$part', '$depart_id', NULL, '$ptright', NULL, 'Y', 
            '', ''
        );";
        dump($patdata_insert);
        if($dbi->query($patdata_insert)===true)
        {
            echo "patdata บันทึกเรียบร้อย <br>";
        }
        else
        {
            dump($dbi->error);
        }
        

        $ipacc_insert = "INSERT INTO `ipacc` (
            `row_id`, `date`, `an`, `code`, `depart`, `detail`, 
            `amount`, `price`, `paid`, `part`, `yprice`, `nprice`, 
            `idname`, `accno`, `idno`, `startdatetime`, `enddatetime`, `status`, 
            `billno`, `officemon`, `ptright`
        ) VALUES (
            NULL, '$date_now', '$an', '$code', '$depart', '$detail', 
            '$amount', '$price', NULL, '$part', '$yprice', '$nprice', 
            '$idname', '1', '$depart_id', NULL, NULL, '', 
            NULL, NULL, '$ptright'
        );";
        dump($ipacc_insert);
        if($dbi->query($ipacc_insert)===true)
        {
            echo "ipacc บันทึกเรียบร้อย <br>";
        }
        else
        {
            dump($dbi->error);
        }

    }
    else if($item_code=="NCARE")
    {
        $depart = "WARD";
        $part = "NCARE";
        $code = "NCARE";
        $detail = "(55010)ค่าบริการพยาบาลทั่วไป (IPD)";
        $price = "300.00";
        $yprice = "0.00";
        $nprice = "0.00";
        $idname = "คอมพิวเตอร์";
        $ptright = ""; 

        $ipacc_insert = "INSERT INTO `ipacc` (
            `row_id`, `date`, `an`, `code`, `depart`, `detail`, 
            `amount`, `price`, `paid`, `part`, `yprice`, `nprice`, 
            `idname`, `accno`, `idno`, `startdatetime`, `enddatetime`, `status`, 
            `billno`, `officemon`, `ptright`
        ) VALUES (
            NULL, '$date_now', '$an', '$code', '$depart', '$detail', 
            '1', '$price', NULL, '$part', '$yprice', '$nprice', 
            '$idname', '1', '$depart_id', NULL, NULL, '', 
            NULL, NULL, '$ptright'
        );";
        if($dbi->query($ipacc_insert)===true)
        {
            echo "ipacc บันทึกเรียบร้อย <br>";
        }
        else
        {
            dump($dbi->error);
        }

    }

    redirect('edit_ipacc.php', 'ดำเนินการเรียบร้อย');
    exit;
}
elseif ($action=='soft_remove') 
{
    /**
     * @readme
     * ในเงื่อนไขนี้คือเฉพาะตัวที่ ipacc มี depart แบบ one to one
     */
    $ipacc_id = trim($_GET['ipacc_id']);
    if(empty($ipacc_id))
    {
        redirect('edit_ipacc.php', 'ข้อมูลไม่ถูกต้อง');
        exit;
    }

    exit;
    
    $sql_ipacc = "SELECT * FROM `ipacc` WHERE `row_id` = '$ipacc_id' ";
    $q_ipacc = $dbi->query($sql_ipacc);
    $an = '';
    if($q_ipacc->num_rows > 0)
    {
        $ipacc = $q_ipacc->fetch_assoc();
        $ipacc_id = $ipacc['row_id'];
        $ipacc_idno = $ipacc['idno'];
        $an = $ipacc['an'];
        
        // UPDATE ipacc
        $sql_update_ipacc = "UPDATE `ipacc` SET `price` = '0', `paid` = '0' WHERE `row_id` = '$ipacc_id' ";
        $dbi->query($sql_update_ipacc);
        // UPDATE ipacc

        $sql_depart = "SELECT * FROM `depart` WHERE `row_id` = '$ipacc_idno' ";
        $q_depart = $dbi->query($sql_depart);
        if($q_depart->num_rows > 0)
        {
            // UPDATE depart
            $sql_update_depart = "UPDATE `depart` SET `price` = '0', `paid` = '0' WHERE `row_id` = '$ipacc_idno' ";
            $dbi->query($sql_update_depart);
            // UPDATE depart

            $sql_patdata = "SELECT * FROM `patdata` WHERE `idno` = '$ipacc_idno' ";
            $q_patdata = $dbi->query($sql_patdata);
            // UPDATE patdata
            $sql_update_patdata = "UPDATE `patdata` SET `price` = '0' WHERE `idno` = '$ipacc_idno' ";
            $dbi->query($sql_update_patdata);
            // UPDATE patdata
        }
    }

    redirect('edit_ipacc.php?page=search&an='.$an, 'แก้ไขข้อมูลเรียบร้อย');
    exit;
}
elseif ($action=='save_from_edit') 
{ 
    $ipacc_id = $_POST['ipacc_id'];

    $depart = $_POST['depart'];
    $part = $_POST['part'];
    $detail = $_POST['detail'];
    $amount = $_POST['amount'];
    $price = $_POST['price'];
    $yprice = $_POST['yprice'];
    $nprice = $_POST['nprice'];
    $ptright = $_POST['ptright'];
    $an = $_POST['an'];

    $msg = "บันทึกข้อมูลเรียบร้อย";
    $ipacc_sql = "SELECT * FROM `ipacc` WHERE `row_id` = '$ipacc_id' ";
    $q_ipacc = $dbi->query($ipacc_sql);
    if($q_ipacc->num_rows > 0)
    {
        $err_msg = "";

        $ipacc = $q_ipacc->fetch_assoc();
        $ipacc_idno = $ipacc['idno'];
        $ipacc_update_sql = "UPDATE `ipacc` SET 
        `depart` = '$depart',
        `part` = '$part',
        `detail` = '$detail',
        `amount` = '$amount',
        `price` = '$price',
        `yprice` = '$yprice',
        `nprice` = '$nprice',
        `ptright` = '$ptright'
        WHERE `row_id` = '$ipacc_id' ";
        $update_ipacc = $dbi->query($ipacc_update_sql);
        if(!empty($dbi->error))
        {
            $err_msg .= $dbi->error."<br>";
        }

        // DEPART 
        $depart_update_sql = "UPDATE `depart` SET 
        `depart` = '$depart', 
        `detail` = '$detail', 
        `price` = '$price', 
        `sumyprice` = '$yprice', 
        `sumnprice` = '$nprice',
        `ptright` = '$ptright'
        WHERE `row_id` = '$ipacc_idno'";
        $update_depart = $dbi->query($depart_update_sql);
        if(!empty($dbi->error))
        {
            $err_msg .= $dbi->error."<br>";
        }

        // PATDATA
        $patdata_update_sql = "UPDATE `patdata` SET 
        `code` = '$code', 
        `detail` = '$detail', 
        `price` = '$price', 
        `yprice` = '$yprice', 
        `nprice` = '$nprice',
        `depart` = '$depart', 
        `part` = '$part', 
        `ptright` = '$ptright'
        WHERE `idno` = '$ipacc_idno' ";
        $update_patdata = $dbi->query($patdata_update_sql);
        if(!empty($dbi->error))
        {
            $err_msg .= $dbi->error."<br>";
        }

        if(!empty($err_msg)){
            $msg = $err_msg;
        }

    }

    redirect('edit_ipacc.php?page=search&an='.$an, $msg);
    exit;
}

$def_an = (substr((date('Y')+543),2)).'/';
// $sql_def = "SELECT `prefix` FROM `runno` WHERE `title` = 'AN' ";
// $q_def = $dbi->query($sql_def);
// if (!empty($dbi->error))
// {
//     dump($dbi->error);
// }
// else
// {
//     $run = $q_def->fetch_assoc();
//     $def_an = $run['prefix'];
// }

$an_def = ($_REQUEST['an']) ? $_REQUEST['an'] : $def_an ;
$fix_date_def = ($_POST['fix_date']) ? $_POST['fix_date'] : (date('Y')+543).date('-m') ;

?>
<style>
.clearfix::after {
    content: "";
    clear: both;
    display: table;
}
*{
    /* font-family: 'TH Sarabun New','TH SarabunPSK'; */
    /* font-size: 17px; */
}
h3{font-size: 23px;}
.chk_table{
    border-collapse: collapse;
}

.chk_table th,
.chk_table td{
    border: 1px solid black;
    /* font-size: 16pt; */
    padding: 3px;
}


</style>
<div class="clearfix">

<?php 
if($_SESSION['x-msg'])
{
    ?><div style="border: 2px solid #c3d001;padding: 4px;background-color: #f8ffbd;"><?=$_SESSION['x-msg'];?></div><?php 
    $_SESSION['x-msg']=null;
}
?>

<fieldset style="float: left; width: 50%;">
    <legend>เพิ่มรายการผู้ป่วยในย้อนหลัง</legend>
    <form action="edit_ipacc.php" method="post">
        <table>
            <tr>
                <td align="right">AN : </td>
                <td><input type="text" name="an" id="an" value="<?=$an_def;?>"></td>
            </tr>
            <tr>
                <td>วันที่ต้องการเพิ่ม : </td>
                <td><input type="text" name="fix_date" id="fix_date" value="<?=$fix_date_def;?>">2564-04-28</td>
            </tr>
            <tr>
                <td align="right">CODE : </td>
                <td>
                    <select name="code" id="code">
                        <option value="21401">21401 ค่าห้องควบคุมผู้ป่วย COVID ใน รพ.</option>
                        <option value="21501">21501 ค่าบริการและดูแลผู้ป่วยกรณีพักรอก่อนเข้ารักษา (รวมอาหาร 3 มื้อ)</option>
                        <option value="NCARE">NCARE</option>
                        <option value="045002">045002 ค่าชุด PPE เจ้าหน้าที่ป้องกันส่วนบุคคล</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right">จำนวน : </td>
                <td>
                    <input type="text" name="amount" id="amount" value="1">
                </td>
            </tr>
            <tr>
                <td align="right">ผู้บันทึก : </td>
                <td><input type="text" name="staff" id="staff" value="บุณฑริกา ใหม่แก้ว">บุณฑริกา ใหม่แก้ว</td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">เพิ่ม</button>
                    <input type="hidden" name="action" value="add">
                </td>
            </tr>
        </table>
    </form>
</fieldset>

<fieldset class="">
    <legend>แก้ไข/ยกเลิก ค่าห้อง</legend>
    <form action="edit_ipacc.php" method="post">
        <table>
            <tr>
                <td align="right">AN : </td>
                <td>
                    <input type="text" name="an" id="an" value="<?=$an_def;?>">
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="page" value="search">
                </td>
            </tr>
        </table>
    </form>
</fieldset>
</div>
<?php 
if ($page=='search')
{ 
    $an = $_REQUEST['an'];
    // $ipc = new InPatient();
    // $ipc->an = $an;
    // $data = $ipc->getIpcard();
    // $where = "WHERE `an` = '$an' AND ( `code` = '21401' OR `code` = 'NCARE' OR `code` = '045002' ) ORDER BY `date` ASC";
    // $data = $ipc->getIpacc($where);

    #AND ( `part` = 'NCARE' OR `part` = 'BFY' ) 
    $sql_ipacc = "SELECT * FROM `ipacc` WHERE `an` = '$an'";
    $q_ipacc = $dbi->query($sql_ipacc);
    if($dbi->error)
    {
        var_dump($dbi->error);
    }

    if($q_ipacc->num_rows > 0)
    {
        $ipcard_sql = "SELECT `hn`,`ptname`,`bedcode`,`ptright` FROM `ipcard` WHERE `an` = '$an' ";
        $q_ipcard = $dbi->query($ipcard_sql);
        $ipcard = $q_ipcard->fetch_assoc();

        $ward_list = array(
            '42' => 'หอผู้ป่วยรวม',
            '44' => 'หอผู้ป่วย ICU',
            '43' => 'หอผู้ป่วยสูติ',
            '45' => 'หอผู้ป่วยพิเศษ'
        );
        
        $ward_code = substr($ipcard['bedcode'],0,2);
        $bed_number = substr($ipcard['bedcode'],2,strlen($ipcard['bedcode']));
        ?>
        <div style="clear: left;">
            <p>&nbsp;</p>
            <p>
                <b>AN : </b><?=$an;?> <b>HN : </b><?=$ipcard['hn'];?><br>
                <b>ชื่อ-สกุล : </b><?=$ipcard['ptname'];?><br>
                <b>สิทธิ : </b><?=$ipcard['ptright'];?><br>
                <b>หอผู้ป่วย : </b><?=$ward_list[$ward_code];?> <b>เตียง : </b><?=$bed_number;?>
            </p>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>ID NO</th>
                    <th>วันที่</th>
                    <th>code</th>
                    <th>depart</th>
                    <th>detail</th>
                    <th>price</th>
                    <th></th>
                    <th></th>
                </tr>
                <?php 
                $i = 1;
                while ($item = $q_ipacc->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['row_id'];?></td>
                        <td><?=$item['idno'];?></td>
                        <td><?=$item['date'];?></td>
                        <td><?=$item['code'];?></td>
                        <td><?=$item['depart'];?></td>
                        <td><?=$item['detail'];?></td>
                        <td align="right"><?=$item['price'];?></td>
                        <?php 
                        // $link = '<a href="edit_ipacc.php?action=soft_remove&ipacc_id='.$item['row_id'].'" onclick="return confirm(\'ยืนยันการลบข้อมูล\')">ยกเลิก</a>'; 
                        // if($item['price']==0)
                        // {
                            $link = 'ยกเลิก'; 
                        // }
                        ?>
                        <td><?=$link;?></td>
                        <?php 
                        $bfy_link = 'edit_ipacc.php?page=edit_page&ipacc_id='.$item['row_id'];
                        ?>
                        <td><a href="<?=$bfy_link;?>">แก้ไข</a></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </table>
        </div>
        <?php
    } // end num rows ipacc
    else
    {
        ?>
        <div style="clear: left;"><h3>ไม่พบข้อมูล</h3></div>
        <?php
    }
}
elseif ($page === 'edit_page') {

    $ipacc_id = $_GET['ipacc_id'];
    $ipacc_sql = "SELECT * FROM `ipacc` WHERE `row_id` = '$ipacc_id' ";
    $q_ipacc = $dbi->query($ipacc_sql);
    $ipacc = $q_ipacc->fetch_assoc();

    $old_code = $ipacc['code'];
    $an = $ipacc['an'];

    $ipcard_sql = "SELECT `an`,`hn`,`ptname`,`ptright`,`age` FROM `ipcard` WHERE `an` = '$an' ";
    $q_ipcard = $dbi->query($ipcard_sql);
    $ip = $q_ipcard->fetch_assoc();

    ?>
    <p>
        <b>AN: </b><?=$ip['an'];?><br/>
        <b>HN: </b><?=$ip['hn'];?><br/>
        <b>ชื่อ-สกุล: </b><?=$ip['ptname'];?><br/>
        <b>สิทธิ์: </b><?=$ip['ptright'];?><br/>
        <b>อายุ: </b><?=$ip['age'];?><br/>
    </p>
    <form action="edit_ipacc.php" method="post" style="clear: left;">
        <table>
            <tr>
                <td>Depart:</td>
                <td><input type="text" name="depart" id="depart" value="<?=$ipacc['depart'];?>"></td>
            </tr>
            <tr>
                <td>Part:</td>
                <td><input type="text" name="part" id="part" value="<?=$ipacc['part'];?>"></td>
            </tr>
            <tr>
                <td>Detail:</td>
                <td><input type="text" name="detail" id="detail" value="<?=$ipacc['detail'];?>"></td>
            </tr>
            <tr>
                <td>Amount:</td>
                <td><input type="text" name="amount" id="amount" value="<?=$ipacc['amount'];?>"></td>
            </tr>
            <tr>
                <td>Price:</td>
                <td><input type="text" name="price" id="price" value="<?=$ipacc['price'];?>"></td>
            </tr>
            <tr>
                <td>YPrice:</td>
                <td><input type="text" name="yprice" id="yprice" value="<?=$ipacc['yprice'];?>"></td>
            </tr>
            <tr>
                <td>NPrice:</td>
                <td><input type="text" name="nprice" id="nprice" value="<?=$ipacc['nprice'];?>"></td>
            </tr>
            <tr>
                <td>PTRight:</td>
                <td><input type="text" name="ptright" id="ptright" value="<?=$ip['ptright'];?>"></td>
            </tr>
        </table>
        <div>
            <button type="submit">บันทึก</button>
            <input type="hidden" name="action" value="save_from_edit">
            <input type="hidden" name="ipacc_id" value="<?=$ipacc_id;?>">
            <input type="hidden" name="an" value="<?=$an;?>">
        </div>
    </form>
    <?php
    exit;
}