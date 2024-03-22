<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

dump($_POST);

$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
$Thaidate = date("d-m-") . (date("Y") + 543) . "  " . date("H:i:s");

$an = sprintf("%s", $_POST['an']);
$sql = "SELECT * FROM `ipcard` WHERE `an` = '$an' ";
$q = $dbi->query($sql);
$ipcard = false;
$hn = false;
if($q->num_rows>0){
    $ipcard = $q->fetch_assoc();
    $hn = $ipcard['hn'];
    $ptname = $ipcard['ptname'];
    $bed = $ipcard['bed'];
}

$total_item = 0;
for ($i=0; $i < count($_POST["Amount"]); $i++) { 
    if($_POST["Amount"][$i] > 0){
        $total_item += 1;
    }
}

$item = count($_POST["Drugcode"]);
$_SESSION["druglot_new"] = '';
$j = 1;

for ($i = 0; $i < $item; $i++) {
    if (($_POST["Statcon"][$i] != "OLD" && $_POST["Amount"][$i] > 0) || $_POST["Statcon"][$i] == "OLD") {

        $detail1 = '';
        $detail2 = '';
        $detail3 = '';
        $sql = "SELECT `detail1`,`detail2`,`detail3` FROM `drugslip` WHERE `slcode` = '" . $_POST["Slipcode"][$i] . "'  ";
        $result = $dbi->query($sql);
        if ($result->num_rows > 0) {
            list($detail1, $detail2, $detail3) = $result->fetch_row();
        }

        if($i>0){
            $_SESSION["druglot_new"] .= '<div style="page-break-before: always;"></div>';
        }

        $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><center><b>" . $ptname . "</b><br></font>";

        $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'>" . $Thaidate . "&nbsp;(AN:" . $an . ")&nbsp;HN:" . $hn . ".&nbsp;&nbsp;NO." . $j . "/" . $total_item . " <br></font>";

        $Trade = substr($_POST["Tradname"][$i], 0, 22);

        $_SESSION["druglot_new"] .= "<font  style='line-height:14px;' face='Angsana New' size='2'><b>$Trade</b>&nbsp;&nbsp;(" . $_POST["Drugcode"][$i] . ")&nbsp;=<B>&nbsp;" . $_POST["Amount"][$i] . "</B><br></font>";


        // $sql = "Select drugname,drugnote,drug_nature,drug_properties From druglst  where drugcode = '" . $_POST["Drugcode"][$i] . "' limit 0,1 ";
// $result = Mysql_Query($sql);
// list($drugname, $drugnote, $drug_nature, $drug_properties) = Mysql_fetch_row($result);
// $chkdrugname = trim($drugname);
// $lendrugname = strlen($chkdrugname);
        $_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>" . $detail1 . "</b></font><br>";
        $_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>" . $detail2 . "</b></font><br>";

        if ($j == $total_item) {
            if ($detail3 != "")
                $_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>" . $detail3 . "</b></font><br>";
            if ($drug_properties != "")  //ถ้ามีสรรพคุณ
                $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>" . $drug_properties . "</u></b></font><br>";

            if ($drugnote != "")  //ถ้ามีคำเตือน
                $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>" . $drugnote . "</b></font>";

        } else {
            if ($detail3 != "")
                $_SESSION["druglot_new"] .= "<font style='line-height:16px;' face='Angsana New' size='2'><b>" . $detail3 . "</b></font><br>";  //br 2 อัน
            if ($drug_properties != "")  //ถ้ามีสรรพคุณ
                $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b><u>" . $drug_properties . "</u></b></font><br>";
            if ($drugnote != "")  //ถ้ามีคำเตือน
                $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='1'><b>" . $drugnote . "</b></font>";
        }

        $j++;

    }
}

for ($i = 0; $i < $item; $i++) {

    $drugcode2 = $_POST["Drugcode"][$i];
    if (($drugcode2[0] == "0" || $drugcode2[0] == "2") && !(ord($drugcode2[1]) >= 48 && ord($drugcode2[1]) <= 57)) {

        $drugslipHTML = '';
        $sql = "SELECT `detail1`,`detail2`,`detail3` FROM `drugslip` WHERE `slcode` = '" . $_POST["Slipcode"][$i] . "'  ";
        $result = Mysql_Query($sql);
        if (mysql_num_rows($result) > 0) {
            list($lotnew_detail1, $lotnew_detail2, $lognew_detail3) = Mysql_fetch_row($result);

            if (!empty ($lotnew_detail1)) {
                $drugslipHTML .= "<font style='line-height:16px; font-size:13px;' face='Angsana New'><b>" . $lotnew_detail1 . "</b></font><br>";
            }
            if (!empty ($lotnew_detail2)) {
                $drugslipHTML .= "<font style='line-height:16px; font-size:13px;' face='Angsana New'><b>" . $lotnew_detail2 . "</b></font><br>";
            }
            if (!empty ($lognew_detail3)) {
                $drugslipHTML .= "<font style='line-height:14px; font-size:13px;' face='Angsana New'><b>" . $lognew_detail3 . "</b></font><br>";
            }

        }

        for ($j = 0; $j < $_POST["stiker"][$i]; $j++) {
            if ($j % 2 == 0) {
                $_SESSION["druglot_new"] .= "<div style=\"page-break-before: always;\"></div>";
            } else {
                $_SESSION["druglot_new"] .= "<hr>";
            }
            $_SESSION["druglot_new"] .= "<font style='line-height:14px;' face='Angsana New' size='2'><B>" . $Thaidate . "<BR>" . $hn . "  " . $ptname . " เตียง" . $bed . "  <br>" . $_POST["Tradname"][$i] . "&nbsp;&nbsp;(" . $_POST["Drugcode"][$i] . ")</B></font>";
            $_SESSION["druglot_new"] .= "<br>";

            if (!empty ($drugslipHTML)) {
                $_SESSION["druglot_new"] .= $drugslipHTML;
            }

            $_SESSION["druglot_new"] .= "<div style=\"text-align:center;\">
				<div style=\"font-size: 13px; font-family:'Angsana New'; line-height:14px;\">เวลาที่ให้....................น.&nbsp;&nbsp;&nbsp;rate....................ml/hr</div>
				<div style=\"font-size: 13px; font-family:'Angsana New'; line-height:14px;\">ผู้เตรียม.................... ผู้ให้....................</div>
			</div>";

            // $_SESSION["druglot_new"] .= '<table style="font-size: 13px;font-family:Angsana New;border-collapse: collapse;">
            // <tr><td style="line-height: 14px;">เวลาที่ให้....................น.</td><td style="line-height: 14px;">rate....................ml/hr</td></tr>
            // <tr><td style="line-height: 14px;">ผู้เตรียม....................</td><td style="line-height: 14px;">ผู้ให้....................</td></tr>
            // </table>';
        }
    }
}

echo $_SESSION["druglot_new"];