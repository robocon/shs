<?php
include_once dirname(__FILE__) . '/bootstrap.php';
include_once dirname(__FILE__) . '/includes/JSON.php';
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
// $json = json_decode($input, true);

$data = $json->decode($input);

$action = $data['action'];
if ($action==='udpateTime') {
    
    $id = $data['id'];
    $date = $data['date'];
    $time = $data['time'];

    $sql = sprintf("UPDATE `com_support` SET `dateend` = '%s %s' WHERE `row` = '%s'", 
        $dbi->real_escape_string($date),
        $dbi->real_escape_string($time),
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }

    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/sweetalert2.all.min.js"></script>
    <title>รายงานประจำเดือน</title>
    <style type="text/css">
        .font1 {font-family: "TH SarabunPSK";font-size: 22px;}
        .font1 {font-family: "TH SarabunPSK";}
        .style1 {font-family: "TH SarabunPSK";font-size: 22px;font-weight: bold;}
        body,td,th {font-family: "TH SarabunPSK";font-size: 22px;}
        .style3 {font-family: "TH SarabunPSK";font-size: 22px}
        .forntsarabun {font-family: "TH SarabunPSK";font-size: 22px;}
        a:link {text-decoration: none;}
        a:visited {text-decoration: none;}
        a:hover {text-decoration: none;}
        a:active {text-decoration: none;}
        label:hover {cursor: pointer;}
    </style>
</head>
<body>
    <?php
    print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_support.php'><font size='4' class='forntsarabun'>ดูข้อมูลแจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
    print "<hr>";
    if (!isset($_POST['search'])) {
    ?>
        <form action="<? $_SERVER['PHP_SELF'] ?>" name="f1" method="post" target="_blank">
            <table width="80%">
                <tr>
                    <td align="center" class="font1">
                        <strong>รายงานประจำเดือน</strong>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="style1">
                        <table>
                            <tr>
                                <td align="right">
                                    <strong>ประเภทงาน&nbsp;</strong>
                                </td>
                                <td>
                                    <select name="jobtype" id="jobtype" class="forntsarabun" onchange="jobTypeChange(this.value)">
                                        <option value="0" selected>เลือกงานทั้งหมด</option>
                                        <option value="hardware">งานซ่อมอุปกรณ์คอมพิวเตอร์/ระบบเครือข่าย</option>
                                        <option value="software">งานแก้ไข/พัฒนาโปรแกรมโรงพยาบาล</option>
                                    </select>
                                </td>
                            </tr>
                            <tr id="swTypeContain" style="display:none;">
                                <td align="right">
                                    <b>ประเภทงานพัฒนา</b>
                                </td>
                                <td>
                                    <?php
                                    $softwareTypeList = array(
                                        'software_type1' => 'แก้ไขโปรแกรม/ข้อมูล',
                                        'software_type2' => 'พัฒนาโปรแกรม'
                                    );
                                    foreach ($softwareTypeList as $swKey => $swType) {
                                    ?>
                                        <input type="radio" name="software_type" id="<?= $swKey; ?>" value="<?= $swType; ?>"><label for="<?= $swKey; ?>"><?= $swType; ?></label>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td align="right">
                                    <strong>ผู้รับผิดชอบ&nbsp;</strong>
                                </td>
                                <td>
                                    <select name="programmer" class="forntsarabun">
                                        <option value="0" selected>== เลือกผู้รับผิดชอบ ==</option>
                                        <option value="เทวิน  ศรีแก้ว">เทวิน ศรีแก้ว</option>
                                        <option value="กฤษณะศักดิ์  กันธรส">กฤษณะศักดิ์ กันธรส</option>
                                        <option value="จักรพันธ์  รุ่งเรืองศรี">จักรพันธ์ รุ่งเรืองศรี</option>
                                        <option value="ฐานพัฒน์  นิลคำ">ฐานพัฒน์ นิลคำ</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td align="right"><strong>เดือน&nbsp;</strong></td>
                                <td>
                                    <select name="m" class="forntsarabun">
                                        <?
                                        $m = date("m");
                                        $month = array('0', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
                                        for ($a = 1; $a < 13; $a++) {
                                            if ($a < 10) $ss = "0";
                                            else $ss = '';
                                        ?>
                                            <option value="<?= $ss ?><?= $a ?>" <? if ($m == $a) echo "selected='selected'" ?>><?= $month[$a] ?></option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                    <strong>ปี&nbsp;</strong>
                                    <select name="yr" class="forntsarabun">
                                        <?
                                        $year = date("Y") + 543;
                                        for ($a = ($year - 5); $a < ($year + 5); $a++) {
                                        ?>
                                            <option value="<?= $ss ?><?= $a ?>" <? if ($year == $a) echo "selected='selected'" ?>>
                                                <?= $a ?>
                                            </option>
                                        <?
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>หรือ</td>
                            </tr>
                            <tr>
                                <td>ค้นหาตามแผนก</td>
                                <td>
                                    <select name="depart" id="depart" class="forntsarabun">
                                        <option value=""> == เลือกแผนก == </option>
                                        <?php
                                        $sql = "select * from departments where status='y' order by id asc";
                                        $result = mysql_query($sql);
                                        while ($a = mysql_fetch_assoc($result)) {
                                        ?>
                                            <option value="<?= $a['name']; ?>"><?= $a['name']; ?></option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td align="center" class="font1">
                        <input name="search" type="submit" class="forntsarabun" value="  ค้นหา  " style="font:TH SarabunPSK" />
                    </td>
                </tr>
            </table>
        </form>
        <script>
            function jobTypeChange(v) {
                if (v === 'software') {
                    document.getElementById('swTypeContain').style.display = '';
                } else {
                    document.getElementById('swTypeContain').style.display = 'none';
                }
            }
        </script>
    <?php
    }
    if (isset($_POST['search'])) {
        $month = array('0', 'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');

        $sql = "select * from com_support where date like '" . $_POST['yr'] . "-" . $_POST['m'] . "%' and dateend != '0000-00-00 00:00:00'";

        if ($_POST['jobtype'] == "0") {
            if ($_POST['programmer'] == "0") {
                // $sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00'";
            } else {
                // $sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00' and programmer LIKE '".$_POST['programmer']."'";
                $sql .= " and programmer LIKE '" . $_POST['programmer'] . "'";
            }
        } else {
            if ($_POST['programmer'] == "0") {
                // $sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00' and jobtype='".$_POST['jobtype']."'";
                $sql .= " and jobtype='" . $_POST['jobtype'] . "' ";
            } else {
                // $sql = "select * from com_support where date like '".$_POST['yr']."-".$_POST['m']."%' and dateend != '0000-00-00 00:00:00' and jobtype='".$_POST['jobtype']."' and programmer LIKE'".$_POST['programmer']."'";		
                $sql .= " and jobtype='" . $_POST['jobtype'] . "' and programmer LIKE'" . $_POST['programmer'] . "'";
            }
        }

        $software_type = sprintf("%s", $_POST['software_type']);
        if (!empty($software_type) && $_POST['jobtype'] === 'software') {
            $sql .= " AND software_type = '$software_type' ";
        }

        $depart = sprintf("%s", $_POST['depart']);
        if (!empty($depart)) {
            $sql .= " AND depart = '$depart' ";
        }
        $sql .= "ORDER BY `dateend` DESC";

        $row = mysql_query($sql);
        $num = mysql_num_rows($row);

    ?>
        <center>
            <span class="style1">รายงานการแจ้งซ่อมอุปกรณ์ทางคอมพิวเตอร์ และแก้ไขปรับปรุงโปรแกรมโรงพยาบาล<br />
                ประจำเดือน
                <?= $month[$_POST['m'] + 0] ?> ปี <?= $_POST['yr'] ?>
            </span>
        </center>
        <table width="100%" border="1" cellpadding="5" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse; font-size: 14px;">
            <tr>
                <td width="3%" align="center" valign="top" class="font1"><strong>ลำดับ</strong></td>
                <td width="7%" align="center" valign="top" class="style1">วันที่แจ้ง</td>
                <td width="7%" align="center" valign="top" class="style1">เลขที่ใบงาน</td>
                <td width="7%" align="center" valign="top" class="style1">แผนก</td>
                <td width="10%" align="center" valign="top" class="style1">ผู้ร้องขอ</td>
                <td width="10%" align="center" valign="top" class="style1">หัวข้อ</td>
                <td width="28%" align="center" valign="top" class="style1">รายละเอียด</td>
                <td width="20%" align="center" valign="top" class="style1">ผลการดำเนินการ</td>
                <td width="6%" align="center" valign="top" class="style1">ผู้รับผิดชอบ</td>
                <td width="7%" align="center" valign="top" class="style1">วันที่ดำเนินการ</td>
                <td width="7%" align="center" valign="top" class="style1">ระยะเวลา/วัน</td>
            </tr>
            <?
            if ($num < 1) {
                echo "<tr><td colspan='11' align='center'>----------------------------------------------- ไม่มีข้อมูลในระบบ -----------------------------------------------</td></tr>";
            } else {
                while ($result = mysql_fetch_array($row)) {
                    $i++;

                    list($dateEnd, $timeEnd) = explode(' ', $result['dateend']);
                    $id = $result['row'];
                ?>
                    <tr>
                        <td align="center" valign="top" class="font1">
                            <?= $i ?>
                        </td>
                        <td valign="top" class="font1"><?= $result['date'] ?> </td>
                        <td align="center" valign="top" class="font1">
                            <a href="comdetail.php?row=<?= $result['row']; ?>" target="_blank" title="คลิกเพื่อดูรายละเอียดงาน"><?= $result['row'] ?></a>
                        </td>
                        <td valign="top" class="font1"><?= $result['depart'] ?> </td>
                        <td valign="top" class="font1"><?= $result['user1'] ?> </td>
                        <td valign="top" class="font1"><?= $result['head'] ?> </td>
                        <td valign="top" class="font1"><?= html_entity_decode($result['detail']) ?> </td>
                        <td valign="top" class="font1"><?= $result['p_edit'] ?> </td>
                        <td valign="top" class="font1"><?= $result['programmer'] ?> </td>
                        <td valign="top" class="font1"><!-- วันที่ดำเนินการ -->
                            <?php
                            if($_SESSION['sIdname']==='dan' || $_SESSION['smenucode']==='ADM'){
                                ?><a href="javascript:void(0)" onclick="editDateTime('<?=$id;?>','<?=$dateEnd;?>','<?=$timeEnd;?>')"><?= $result['dateend'] ?></a><?
                            }else{
                                echo $result['dateend'];
                            }
                            ?>
                        </td>
                        <td align="center" valign="top" class="font1"><?= $result['hold'] ?></td>
                    </tr>
                <?php
                } // end while
            } // end if
            ?>
        </table>
        <script>
            async function editDateTime(id, d, t){
                let { value: formValues } = await Swal.fire({
                    title: "แก้ไข วัน-เวลา ปิดงาน",
                    html: `<div>
                        <div>
                            วัน <input type="date" id="swal-input1" class="swal2-input" value="${d}" lang="th-TH">
                        </div>
                        <div>
                            เวลา <input type="time" id="swal-input2" class="swal2-input" value="${t}">
                        </div>
                    </div>
                    `,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    confirmButtonText: "บันทึก",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "ยกเลิก",
                    focusConfirm: false,
                    preConfirm: () => {
                        return { 
                            "id": id,
                            "date": document.getElementById("swal-input1").value, 
                            "time": document.getElementById("swal-input2").value
                        };
                    }
                });
                if (formValues) {
                    doUpdateEditTime(formValues).then((res)=>{
                        if(res.status==200){
                            Swal.fire({
                                icon: 'success',
                                title: 'บันทึกข้อมูลเรียบร้อย'
                            }).then((res)=>{
                                location.reload();
                            });
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'ไม่สามารถบันทึกข้อมูลได้',
                                text: res.message
                            });
                        }
                    });
                }
            }

            async function doUpdateEditTime(data){
                data.action = 'udpateTime';
                const response = await fetch('com_month.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                    },
                    body: JSON.stringify(data)
                });
                const content = await response.json();
                return content;
            }
        </script>
    <?php
    }
    ?>
</body>
</html>