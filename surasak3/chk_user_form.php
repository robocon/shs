<?php
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$companyId = $_GET['company_id'];
$sql = sprintf("SELECT `id`,`name`,`code` FROM `chk_company_list` WHERE `id` = '%s' ", $dbi->real_escape_string($companyId));
$q = $dbi->query($sql);
if($q->num_rows == 0){
    echo "ไม่พบข้อมูล";
    exit;
}
$com = $q->fetch_assoc();
$companyCode = $com['code'];

$userId = $_GET['user_id'];

if(empty($userId)){
    $userType='new';
    $examNoReadonly = '';
    
    $qRow = $dbi->query("SELECT `row` FROM `opcardchk` ORDER BY `row` DESC LIMIT 1;");
    $chkRow = $qRow->fetch_assoc();
    $userRowId = $chkRow['row']+1;
    
    $qPid = $dbi->query("SELECT `pid` FROM `opcardchk` WHERE `part` = '$companyCode' ORDER BY `pid` DESC LIMIT 1;");
    $chkPid = $qPid->fetch_assoc();
    $pid = $chkPid['pid']+1;

}else{
    $examNoReadonly = 'readonly';
    $userType='old';
    $sql = sprintf("SELECT `exam_no`,`row`,`pid`,`HN` AS `hn`,`yot`,`name`,`surname`,`idcard`,`agey`,SUBSTRING(`dbirth`,1,10) AS `dbirth`,`datechkup`,`course` FROM `opcardchk` WHERE `row` = '%s' LIMIT 1;", $dbi->real_escape_string($userId));
    $qOpcardchk = $dbi->query($sql);
    $user = $qOpcardchk->fetch_assoc();
    $userRowId = $user['row'];
    $pid = $user['pid'];
}

?>
<h3>ฟอร์มรายชื่อ : <?=$com['name'];?></h3>
<form action="javascript:void(0);" method="post" id="chkUserForm" onsubmit="chkUserFormSubmit()">
    <table>
        <tr>
            <td align="right">ID : </td>
            <td>
                <input type="text" name="id" id="id" value="<?=$userRowId;?>" readonly>
                <input type="hidden" name="pid" id="pid" value="<?=$pid;?>">
            </td>
            <td align="right">Lab Number : </td>
            <td>
                <input type="text" name="exam_no" id="exam_no" value="<?=$user['exam_no'];?>" <?=$examNoReadonly;?> >*
            </td>
        </tr>
        <tr>
            <td align="right">HN : </td>
            <td>
                <input type="text" name="hn" id="hn" value="<?=$user['hn'];?>">*<button type="button" onclick="checkUser()">🕵ดึงข้อมูล</button>
            </td>
            <td align="right">ชื่อ : </td>
            <td><input type="text" name="name" id="name" value="<?=$user['name'];?>">*</td>
        </tr>
        <tr>
            <td align="right">สกุล : </td>
            <td><input type="text" name="surname" id="surname" value="<?=$user['surname'];?>">*</td>
            
            <td align="right">บัตรประชาชน : </td>
            <td><input type="text" name="idcard" id="idcard" value="<?=$user['idcard'];?>">*</td>
        </tr>
        <tr>
            <td align="right">วดป.เกิด</td>
            <td><input type="text" name="dbirth" id="dbirth" value="<?=$user['dbirth'];?>"></td>
            <td align="right">อายุ : </td>
            <td><input type="text" name="agey" id="agey" value="<?=$user['agey'];?>">*</td>
            
        </tr>
        <tr>
            <td align="right">โปรแกรมตรวจ : </td>
            <td><input type="text" name="course" id="course" value="<?=$user['course'];?>"></td>
            <td align="right">วันที่ตรวจ : </td>
            <td><input type="text" name="datechkup" id="datechkup" value="<?=$user['datechkup'];?>"></td>
        </tr>
        <tr>
            <td></td>
            <td colspan="3">
                <button type="submit">บันทึก</button>
                <input type="hidden" name="action" value="saveUser">
                <input type="hidden" name="userType" value="<?=$userType;?>">
                <input type="hidden" name="companyId" value="<?=$com['id'];?>">
                <input type="hidden" name="part" value="<?=$companyCode;?>">
            </td>
        </tr>
    </table>
</form>
<?php
