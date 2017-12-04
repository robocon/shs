<?php
// session_start();

// function dump($text){
//     echo "<pre>";
//     print_r($text);
//     echo "</pre>";
// }
include 'bootstrap.php';

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

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
$yr = $_GET['yr'];
$m = $_GET['m'];
$d = $_GET['d'];
$doctor = $_GET['doctor1'];

$today = "$d-$m-$yr";
$repdate = $today;   
 
	 
// include("connect.inc");	 
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
$result = mysql_query($query) or die("Query failed");
		
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }
        if(!($row = mysql_fetch_object($result)))
        continue;
}
$nPrefix=$row->prefix;
$chkup="CHKUP$nPrefix";
  
$today="$yr-$m-$d";
$chkdate=("$yr-$m-$d").date(" H:i:s"); 

$prow_id = array("prow_id");
// $query = "SELECT * FROM opacc WHERE   date LIKE '$today%' and credit = '$doctor'  ORDER  BY date  ";
$query = "SELECT * 
FROM `opacc` 
WHERE `date` LIKE '2559-10%'";
$result = mysql_query($query) or die( mysql_error() );

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if(!($row = mysql_fetch_object($result)))
        continue;   

    array_push($prow_id,$row->row_id);
    array_push($aDate,$row->date);
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paid);
    array_push($aCredit,$row->credit);
    array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);

    array_push($aBillno,$row->billno);
    array_push($aPaidcscd,$row->paidcscd);
    array_push($aVn,$row->vn);

    if ($row->depart=="PHAR"){
        array_push($aPhar,$row->price);  
        array_push($aPharpaid,$row->paid);
        array_push($aEssd,$row->essd);
        array_push($aNessdy,$row->nessdy);
        array_push($aNessdn,$row->nessdn);
        array_push($aDPY,$row->dpy);
        array_push($aDPN,$row->dpn); 
        array_push($aDSY,$row->dsy);  
        array_push($aDSN,$row->dsn);
    }else if ($row->depart=="PATHO"){
                array_push($aLabo,$row->price);  
                array_push($aLabopaid,$row->paid);
    }else if($row->depart=="XRAY"){
                array_push($aXray,$row->price);  
                array_push($aXraypaid,$row->paid);
    }else if ($row->depart=="SURG"){
                array_push($aSurg,$row->price);  
                array_push($aSurgpaid,$row->paid);
    }else if($row->depart=="EMER"){
                array_push($aEmer,$row->price);  
                array_push($aEmerpaid,$row->paid);
    }else if ($row->depart=="DENTA"){
                array_push($aDent,$row->price);  
                array_push($aDentpaid,$row->paid);
    }else if ($row->depart=="PHYSI"){
                array_push($aPhysi,$row->price);  
                array_push($aPhysipd,$row->paid);
    }else if ($row->depart=="HEMO"){
                array_push($aHemo,$row->price);  
                array_push($aHemopd,$row->paid);
    }else if ($row->depart=="OTHER"){

        $paid = (int)$row->paid;
        if( strpos($row->ptright, 'R03') !== false && $paid == 30 ){
            
            array_push($aOther,$row->price);  
            array_push($aOtherpd,$row->paid);

        }else{
            
            array_push($medical_service, $row->paid);
        }
        
    }else if($row->depart=="NID"){
        array_push($aNid,$row->price);  
        array_push($aNidpd,$row->paid);
    }else if($row->depart=="EYE"){
        array_push($aEye,$row->price);  
        array_push($aEyepd,$row->paid);
    }else if($row->depart=="WARD"){
        array_push($aWard,$row->price);  
        array_push($aWardpd,$row->paid);
    }

    // dump($row->credit);
    if($row->credit=="เงินสด"){
        array_push($aCredit_1,$row->price);  
        array_push($aCredit_1pd,$row->paid);
    }else if($row->credit=="กรุงเทพ"){
        array_push($aCredit_2,$row->price);  
        array_push($aCredit_2pd,$row->paid);
    }else if($row->credit=="ทหารไทย"){
        array_push($aCredit_3,$row->price);  
        array_push($aCredit_3pd,$row->paid);
    }else if($row->credit=="จ่ายตรง"){
        array_push($aCredit_4,$row->price);  
        array_push($aCredit_4pd,$row->paid);
    }else if($row->credit=="ประกันสังคม"){
        array_push($aCredit_5,$row->price);  
        array_push($aCredit_5pd,$row->paid);
    }else if($row->credit=="30บาท"){
        array_push($aCredit_6,$row->price);  
        array_push($aCredit_6pd,$row->paid);
    }else if($row->credit=="เงินเชื่อ"){
        array_push($aCredit_7,$row->price);  
        array_push($aCredit_7pd,$row->paid);
    }else if($row->credit=="อื่นๆ"){
        array_push($aCredit_8,$row->price);  
        array_push($aCredit_8pd,$row->paid);
    } 

    $x++;

} // End for

$Netprice = array_sum($aPrice);
$Netpaid = array_sum($aPaid);

$Phar      = array_sum($aPhar);
$Pharpaid= array_sum($aPharpaid); 
$Essd    = array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
$Nessdy = array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
$Nessdn = array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
$DSY     = array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
$DSN     = array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
$DPY     = array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
$DPN     = array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

$Labo         = array_sum($aLabo);
$Labopaid  = array_sum($aLabopaid);
$Xray         = array_sum($aXray);
$Xraypaid  = array_sum($aXraypaid);
$Surg         = array_sum($aSurg);
$Surgpaid  = array_sum($aSurgpaid);
$Emer         = array_sum($aEmer);

$Emerpaid  =array_sum($aEmerpaid);
$Dent          =array_sum($aDent);
$Dentpaid   =array_sum($aDentpaid);
$Physi        =array_sum($aPhysi);
$Physipd   =array_sum($aPhysipd);
$Hemo       =array_sum($aHemo);
$Hemopd    =array_sum($aHemopd);
$Other        =array_sum($aOther);
$Otherpd   =array_sum($aOtherpd);
$Ward        =array_sum($aWard);
$Wardpd   =array_sum($aWardpd);
$Nid        =array_sum($aNid);
$Nidpd   =array_sum($aNidpd);
$Eye        =array_sum($aEye);
$Eyepd   =array_sum($aEyepd);
$Creditpaid      =array_sum($aCreditpaid);
$aPaidcscd      =array_sum($aPaidcscd);
$credit1   =array_sum($aCredit_1pd);
$credit2   =array_sum($aCredit_2pd);
$credit3   =array_sum($aCredit_3pd);
$credit4   =array_sum($aCredit_4pd);
$credit5   =array_sum($aCredit_5pd);
$credit6   =array_sum($aCredit_6pd);
$credit7   =array_sum($aCredit_7pd);
$credit8   =array_sum($aCredit_8pd);

$sum_med_service = array_sum($medical_service);

?>
<h3>ผู้ป่วยนอก</h3>
<table>
    <tr>
        <td>1. เภสัชกรรม</td>
        <td><?=$Pharpaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>.......1.1 ค่ายาในบัญชียาหลักแห่งชาติ</td>
        <td></td>
        <td><?=$Essd;?></td>
    </tr>
    <tr>
        <td>.......1.2 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้</td>
        <td></td>
        <td><?=$Nessdy;?></td>
    </tr>
    <tr>
        <td>.......1.3 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้</td>
        <td></td>
        <td><?=$Nessdn;?></td>
    </tr>
    <tr>
        <td>.......1.4 ค่าเวชภัณฑ์ ส่วนที่เบิกได้</td>
        <td></td>
        <td><?=$DSY;?></td>
    </tr>
    <tr>
        <td>.......1.5 ค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้ </td>
        <td></td>
        <td><?=$DSN;?></td>
    </tr>
    <tr>
        <td>.......1.6 ค่าอุปกรณ์ ส่วนที่เบิกได้</td>
        <td></td>
        <td><?=$DPY;?></td>
    </tr>
    <tr>
        <td>.......1.7 ค่าอุปกรณ์ ส่วนที่เบิกไม่ได้ </td>
        <td></td>
        <td><?=$DPN;?></td>
    </tr>
    <tr>
        <td>2. พยาธิ</td>
        <td><?=$Labopaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>3. เอกซเรย์</td>
        <td><?=$Xraypaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>4. ห้องผ่าตัด</td>
        <td><?=$Surgpaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>5. ห้องฉุกเฉิน</td>
        <td><?=$Emerpaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>6. ทันตกรรม</td>
        <td><?=$Dentpaid;?></td>
        <td></td>
    </tr>
    <tr>
        <td>7. กายภาพบำบัด</td>
        <td><?=$Physipd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>8. ไตเทียม</td>
        <td><?=$Hemopd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>9. หอผู้ป่วย</td>
        <td><?=$Wardpd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>10. อื่นๆ</td>
        <td><?=$Otherpd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>11. ฝังเข็ม</td>
        <td><?=$Nidpd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>12. คลีนิกตา</td>
        <td><?=$Eyepd;?></td>
        <td></td>
    </tr>
    <tr>
        <td>13. ค่าบริการทางการแพทย์</td>
        <td><?=$sum_med_service;?></td>
        <td></td>
    </tr>
    <tr>
        <td>รวม</td>
        <td><?=$Netpaid;?></td>
        <td></td>
    </tr>
</table>
<?php

/* 
// ค่ายา+เวชภัณฑ์
// บริการทางการแพทย์
// ค่าห้อง
// ค่าอาหาร
// ค่าอุปกรณ์

SELECT (SUM(`ddl`)+SUM(`ddy`)+SUM(`ddn`)+SUM(`dsy`)+SUM(`dsn`)) AS `phar`,
(SUM(`lab`)+SUM(`xray`)+SUM(`sinv`)+SUM(`surg`)+SUM(`ncare`)+SUM(`denta`)+SUM(`pt`)+SUM(`stx`)+SUM(`mc`)+SUM(`tool`)) AS `service`,
SUM(`bfy`) AS `room`,
SUM(`bfn`) AS `food`,
(SUM(`dpy`)+SUM(`dpn`)) AS `part`
FROM smdb.`ipmonrep` 
where `date` like '2559-10%' 
order by `row_id` desc;
*/
// ผู้ป่วยใน

/*
SELECT (
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'PHAR'
) AS `phar`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'PATHO'
) AS `patho`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'XRAY'
) AS `xray`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'SURG'
) AS `surg`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'EMER'
) AS `emer`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'DENTA'
) AS `denta`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'PHYSI'
) AS `physi`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'HEMO'
) AS `hemo`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'OTHER'
) AS `other`,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'NID'
) AS `nid` ,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'EYE'
) AS `eye` ,(
	SELECT SUM(`paid`)  
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
	AND `depart` = 'WARD'
) AS `ward`,(
	SELECT SUM(`paid`)
	FROM `opacc` 
	WHERE `date` LIKE '2559-10%' 
) AS `total`
*/

/*
# ผู้ป่วยใน
SELECT `credit`,
(SUM(`ddl`) + SUM(`ddy`) + SUM(`ddn`)) AS `phar`,
(SUM(`dsy`) + SUM(`dsn`)) AS `supply`,
(SUM(`bfy`) + SUM(`bfn`)) AS `room`, 
(SUM(`blood`) + SUM(`sinv`) + SUM(`surg`) + SUM(`ncare`) + SUM(`denta`) + SUM(`pt`) + SUM(`stx`) + SUM(`mc`) + SUM(`lab`) + SUM(`xray`)) AS `service`, 
(SUM(`dpy`) + SUM(`dpn`)) AS `part`
FROM `ipmonrep` 
WHERE `dcdate` LIKE '2559-10%' 
GROUP BY `credit`

# ค่าอาหาร
SELECT `credit`,SUM(IF(( CONVERT(`bfy`, SIGNED INTEGER) / `days`) = '400.0000', 150, 200)) AS `food`
FROM `ipmonrep` 
WHERE `dcdate` LIKE '2559-10%' 
GROUP BY `credit`
*/