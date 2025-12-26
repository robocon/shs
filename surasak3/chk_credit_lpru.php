<?php 
require_once dirname(__FILE__).'/bootstrap.php';

session_unregister("x");
session_unregister("aDate");
session_unregister("chkdate");
session_unregister("repdate");
session_unregister("doctor");
session_unregister("aHn");
session_unregister("aAn");
session_unregister("aIdname");
session_unregister("aDepart");
session_unregister("aDetail");
session_unregister("aPrice");
session_unregister("aPaid");
session_unregister("aPhar");  
session_unregister("aPharpaid");    
session_unregister("aEssd");
session_unregister("aNessdy");
session_unregister("aNessdn");
session_unregister("aDDL");
session_unregister("aDDY");
session_unregister("aDDN");
session_unregister("aDPY");
session_unregister("aDPN");
session_unregister("aDSY");
session_unregister("aDSN");
session_unregister("aLabo");
session_unregister("aLabopaid");
session_unregister("aXray");
session_unregister("aXraypaid");  
session_unregister("aSurg");    
session_unregister("aSurgpaid");
session_unregister("aEmer");
session_unregister("aEmerpaid");
session_unregister("aDent");
session_unregister("aDentpaid");
session_unregister("aPhysi");
session_unregister("aPhysipd");
session_unregister("aHemo");
session_unregister("aHemopd");
session_unregister("aOther");
session_unregister("aOtherpd");
session_unregister("aWard");
session_unregister("aWardpd");
session_unregister("aNid");
session_unregister("aNidpd");
session_unregister("aEye");
session_unregister("aEyepd");
session_unregister("aCredit_d");
session_unregister("aCredit");
session_unregister("aCredit_1");
session_unregister("aCredit_2");
session_unregister("aCredit_3");
session_unregister("aCredit_4");
session_unregister("aCredit_5");
session_unregister("aCredit_6");
session_unregister("aCredit_7");
session_unregister("aCredit_8");
session_unregister("aCredit_1pd");
session_unregister("aCredit_2pd");
session_unregister("aCredit_3pd");
session_unregister("aCredit_4pd");
session_unregister("aCredit_5pd");
session_unregister("aCredit_6pd");
session_unregister("aCredit_7pd");
session_unregister("aCredit_8pd");
session_unregister("aBillno");
session_unregister("aPaidcscd");
session_unregister("aVn");
session_unregister("ptname");

$x            =0;
$aDate     =array("time");
$chkdate="";   
$repdate="";
$doctor="";
$aHn        =array("hn");
$aAn         =array("an");  
$aIdname  =array("idname");
$Netprice  ="";   
$Netpaid   ="";
$aDepart   =array("depart");
$aDetail    = array("detail");
$aPrice   =array("price");
$aPaid    = array("paid");
$aPhar      =array("phar");
$aPharpaid=array("pharpaid"); 
$aEssd     =array("DDL");
$aNessdy =array("DDY");
$aNessdn =array("DDN");
$aDPY      =array("DPY");
$aDPN      =array("DPN");   
$aDSY      =array("DSY");
$aDSN      =array("DSN");   
$aLabo        =array("labo");
$aLabopaid  =array("labopaid");
$aXray         =array("xray");
$aXraypaid =array("xraypaid");
$aSurg        =array("surg");
$aSurgpaid =array("surgpaid");
$aEmer        =array("emer");
$aEmerpaid  =array("emerpaid");
$aDent          =array("dent");
$aDentpaid  =array("dentpaid");
$aPhysi       =array("physi");
$aPhysipd  =array("physipd");
$aHemo       =array("hemo");
$aHemopd  =array("hemopd");
$aOther      =array("other");
$aOtherpd  =array("otherpd");
$medical_service  =array("medical_service");
$aWard      =array("Ward");
$aWardpd  =array("Wardpd");
$aNid      =array("Nid");
$aNidpd  =array("Nidpd");
$aEye      =array("Eye");
$aEyepd  =array("Eyepd");
$aCredit_d =array("credit_detail");
$aCredit =array("credit");
$aCredit_1 =array("credit_1");
$aCredit_1pd =array("credit_1pd");
$aCredit_2 =array("credit_2");
$aCredit_2pd =array("credit_2pd");
$aCredit_3 =array("credit_3");
$aCredit_3pd =array("credit_3pd");
$aCredit_4 =array("credit_4");
$aCredit_4pd =array("credit_4pd");
$aCredit_5 =array("credit_5");
$aCredit_5pd =array("credit_5pd");
$aCredit_6 =array("credit_6");
$aCredit_6pd =array("credit_6pd");
$aCredit_7 =array("credit_7");
$aCredit_7pd =array("credit_7pd");
$aCredit_8 =array("credit_8");
$aCredit_8pd =array("credit_8pd");
$aBillno   =array("billno");
$aPaidcscd   =array("paidcscd");
$aVn   =array("vn");
$ptname = array("ptname");


session_register("x");
session_register("aDate");
session_register("chkdate");
session_register("repdate");
session_register("doctor");
session_register("aHn");
session_register("aAn");
session_register("aIdname");
session_register("aDepart");
session_register("aDetail");
session_register("aPrice");
session_register("aPaid");
session_register("aPhar");  
session_register("aPharpaid");    
session_register("aEssd");
session_register("aNessdy");
session_register("aNessdn");
session_register("aDDL");
session_register("aDDY");
session_register("aDDN");
session_register("aDPY");
session_register("aDPN");
session_register("aDSY");
session_register("aDSN");
session_register("aLabo");
session_register("aLabopaid");
session_register("aXray");
session_register("aXraypaid");  
session_register("aSurg");    
session_register("aSurgpaid");
session_register("aEmer");
session_register("aEmerpaid");
session_register("aDent");
session_register("aDentpaid");
session_register("aPhysi");
session_register("aPhysipd");
session_register("aHemo");
session_register("aHemopd");
session_register("aOther");
session_register("aOtherpd");
session_register("aWard");
session_register("aWardpd");
session_register("aNid");
session_register("aEyepd");
session_register("aEye");
session_register("aNidpd");
session_register("aCredit_d");
session_register("aCredit");
session_register("aCredit_1");
session_register("aCredit_1pd");
session_register("aCredit_2");
session_register("aCredit_2pd");
session_register("aCredit_3");
session_register("aCredit_3pd");
session_register("aCredit_4");
session_register("aCredit_4pd");
session_register("aCredit_5");
session_register("aCredit_5pd");
session_register("aCredit_6");
session_register("aCredit_6pd");
session_register("aCredit_7");
session_register("aCredit_7pd");
session_register("aCredit_8");
session_register("aCredit_8pd");
session_register("aBillno");
session_register("aPaidcscd");
session_register("aVn");
session_register("ptname");
session_register("medical_service");

$repdate = urldecode($_GET['repdate']); 
$type = urldecode($_GET['type']); 
$part = urldecode($_GET['part']);
$appd1 = sprintf('%s', $_GET['appd1']);

$date = $_GET['date'];
$doctor='ตรวจสุขภาพ';

// $sql = "SELECT a.`hn`,a.`ptname`,b.`vn`,b.`ptright`,b.`thdatehn` 
// FROM (
// 	SELECT * FROM `manual_expense` WHERE `part` IN ('มหาวิทยาลัยราชภัฏลำปาง 68','คณะพยาบาลศาสตร์ มหาวิทยาลัยราชภัฏลำปาง 68 ธ.ค.')
// ) AS a LEFT JOIN (
// 	SELECT * FROM `pre_vn` WHERE `chk_company_id` IN ('900','901')
// ) AS b ON a.`hn` = b.`hn` 
// WHERE b.`thdatehn` LIKE '$date%' ";

$sql = "SELECT a.*, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`, b.`ptright`, c.`vn` 
FROM (
    SELECT * FROM `manual_expense` WHERE `part` = 'มหาวิทยาลัยราชภัฏลำปาง 68' 
) AS a LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn`
LEFT JOIN (
    SELECT `row_id`,`thidate`,`hn`,`vn`,`ptname`,`toborow` 
    FROM `opday` 
    WHERE `thidate` LIKE '$appd1%' 
) AS c ON a.`hn` = c.`hn` 
WHERE c.`row_id` IS NOT NULL
ORDER BY a.`id` ASC";

$q = $dbi->query($sql);
$users = array();
while ($aPre = $q->fetch_assoc()) {
    $key = $aPre['hn'];
    $users[$key] = $aPre['ptname'];
}

$q2 = $dbi->query("SELECT * FROM `opacc` WHERE `date` LIKE '$appd1%' AND `credit` = 'SSOCHECKUP68'");
$opaccRows = $q2->num_rows;
?>
<style>
*{
    font-family: "Angsana New";
    font-size: 18px;
}
</style>
<p>บัญชีรายรับผู้ป่วยนอก ของวันที่ <?=$repdate;?> รับชำระโดยตรวจสุขภาพ</p>
<p>จำนวนทั้งสิ้น <?=$opaccRows;?> รายการ ดังนี้</p>
<table>
    <tr bgcolor="6495ED">
        <th>#</th>
        <th>เวลา</th>
        <th>HN</th>
        <th>ชื่อ-สกุล</th>
        <th>รายการ</th>
        <th>จ่ายเงิน</th>
        <th>เลขที่</th>
        <th>จนท.</th>
        <th>ประเภท</th>
    </tr>
<?php 
$i = 1;

while ($aOpacc = $q2->fetch_assoc()) {
    
    $hn = $aOpacc['hn'];

    if(empty($users[$hn])){
        continue;
    }
    
    $time = substr($aOpacc['date'],11,5);
    ?>
    <tr bgcolor="F5DEB3">
        <td><?=$i;?></td>
        <td><?=$time;?></td>
        <td><?=$hn;?></td>
        <td><?=$users[$hn];?></td>
        <td><?=$aOpacc['detail'];?></td>
        <td><?=$aOpacc['price'];?></td>
        <td></td>
        <td><?=$aOpacc['idname'];?>.</td>
        <td><?=$aOpacc['depart'];?></td>
    </tr>
    <?php 
    array_push($medical_service, $aOpacc['paid']);
    array_push($aPaid,$aOpacc['paid']);

    $i++;
}
$_SESSION['medical_service'] = $medical_service;
?>
</table>
<br>
<a href="opmchkuser.php">ตรวจสอบเงินรายรับ</a>