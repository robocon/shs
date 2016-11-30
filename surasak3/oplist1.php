<?php
session_start();

// ตรวจสอบชื่อผู้ใช้งานก่อน
if( !isset($_SESSION['sOfficer']) && $_SESSION['sOfficer'] == '' ){
    echo 'หมดเวลาใช้งาน<br><a href="../nindex.htm">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง';
    exit;
}
?>
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<script type="text/javascript">
    function timedMsg() { 
        setTimeout("count();",1000) ;
    } 

    function count(){
        if(eval(document.all['mysdiv'].innerHTML) == 1){
            window.location.reload();
        }else{
            document.all['mysdiv'].innerHTML = eval(document.all['mysdiv'].innerHTML)-1;
            timedMsg();
        }
    }

    window.onload = function(){
        timedMsg();
    }
</script> 
</head>
    นับถอยหลังเพื่อ refresh ในอีก  <span id="mysdiv">15</span> วินาที
    <BR>
<?php

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;
$today="$d-$m-$yr";
print "วันที่ $today  รายชื่อผู้ป่วยรอค้นบัตรเรียงตามลำดับเวลาก่อนหลัง";
print "<a target=_self  href='../nindex.htm'><<ไปเมนู............</a><br> ";

$today="$yr-$m-$d";
$N='X';
$ex='EX0';
?>
<table>
    <tr>
        <th bgcolor=6495ED>VN</th>
        <th bgcolor=6495ED>คิว</th>
        <th bgcolor=6495ED>เวลา</th>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>พิมพ์ใบสั่งยา</th>
        <th bgcolor=6495ED>AN</th>
        <th bgcolor=6495ED>สิทธิ</th>
        <th bgcolor=6495ED><font face='Angsana New'>พิมพ์ใบตรวจโรค</th>
        <th bgcolor=6495ED><font face='Angsana New'>พิมพ์ใบต่อ</th>
        <th bgcolor=6495ED><font face='Angsana New'>ผู้ยืม</th>
        <th bgcolor=6495ED><font face='Angsana New'>ผู้บันทึก</th>
    </tr>
<?php
$detail="ค่ายา";
include("connect.inc");

$query="CREATE TEMPORARY TABLE opday1 SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%' ";
$result = mysql_query($query) or die("Query failed,opdoplis");

$query = "SELECT a.vn,a.thdatehn,a.thidate,a.hn,a.ptname,a.an,a.diag,a.ptright,a.doctor,a.okopd,a.toborow,a.borow,a.goup,a.officer,a.kew,a.phaok,b.idcard FROM opday1 as a,opcard as b WHERE a.hn=b.hn and a.thidate LIKE '$today%'and a.phaok='$N' ";
$result = mysql_query($query) or die("Query failed");

while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok,$idcard) = mysql_fetch_row ($result)) {
    $color='66CDAA';

    if(substr($ptright,0,3)=='R07' && !empty($idcard)){
        $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
        if(Mysql_num_rows(Mysql_Query($sql)) > 0){
            $color = "#CCFF00";
        }else{
            $color = "FF8C8C";
        }
    }else if(substr($ptright,0,3)=='R03'){
        $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
        if(Mysql_num_rows(Mysql_Query($sql)) > 0){
            $color = "99CC00";
        }else{
            $color = "FF8C8C";
        }
    }else{
        $color = "66CDAA";
    }


    if(!empty($idcard)){
        $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
        if(Mysql_num_rows(Mysql_Query($sql)) > 0){
            $detel="ผู้ป่วยมีสิทธิประกันสังคม";
        }else{
            $detel="";
        }
    }else{
        $detel="";
    }


    if(!empty($hn)){
        $sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
        if(Mysql_num_rows(Mysql_Query($sql)) > 0){
            $detel1='ผู้ป่วยมีสิทธิจ่ายตรง';
        }else{
            $detel1="";
        }
    }else{
        $detel1="";
    }

    $time=substr($thidate,11);
    print (" <tr>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$vn</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$kew</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a  href=\"rxform2.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptname</a></td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxform2.5.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptright</a></td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
    //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxform2.1.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$toborow</a></td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"opdcard_reg.php?cHn=$hn&cVn=$vn\">$hn</a></td>\n".  
    "  <td BGCOLOR=$color><font face='Angsana New'>$borow</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
    "  <td BGCOLOR=#FF0000><font face='Angsana New'>$detel$detel1</td>\n".
    " </tr>\n");
}
include("unconnect.inc");
?>
</table>

<?php

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;
$today="$d-$m-$yr";
print "วันที่ $today  รายชื่อผู้ป่วยที่ออก VN  โดยอัตโนมัติ กรุณาตรวจสอบสิทธิการรักษา  ถ้ามีปัญหาแจ้งหน่วยผู้ออกทันที";
print "<a target=_self  href='../nindex.htm'><<ไปเมนู............</a><br> ";

$today="$yr-$m-$d";
$N='p';
$ex='EX0';
?>

<table>
    <tr>
        <th bgcolor=6495ED>VN</th>
        <th bgcolor=6495ED>คิว</th>
        <th bgcolor=6495ED>เวลา</th>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>ชื่อ</th>
        <th bgcolor=6495ED>AN</th>
        <th bgcolor=6495ED>พิมพ์ใบตรวจสิทธิ</th>
        <th bgcolor=6495ED><font face='Angsana New'>ยืนยันสิทธิ</th>
    </tr>
    <?php
    $detail="ค่ายา";
    include("connect.inc");

    $query="CREATE TEMPORARY TABLE opday1 SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%' ";
    $result = mysql_query($query) or die("Query failed,opdoplis");

    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday1 WHERE thidate LIKE '$today%' and phaok='$N' ";
    $result = mysql_query($query)
    or die("Query failed");

    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok) = mysql_fetch_row ($result)) {

        if(substr($ptright,0,3)=='R07' && !empty($idcard)){
            $sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
            if(Mysql_num_rows(Mysql_Query($sql)) > 0){
                $color = "#CCFF00";
            }else{
                $color = "FF8C8C";
            }
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}

        $time=substr($thidate,11);
        print (" <tr>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$vn</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$kew</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</a></td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
        // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxform2.3.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptright</a></td>\n".
        // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
        //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
        // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'><a  href=\"rxform2.2.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$toborow</a></td>\n".
        " </tr>\n");
    }

?>
</table>
<?php

$today = date("d-m-Y");   
$d=substr($today,0,2);
$m=substr($today,3,2);
$yr=substr($today,6,4) +543;
$today="$d-$m-$yr";
print "วันที่ $today  รายชื่อผู้ป่วยเรียงตามลำดับเวลาก่อนหลัง";

$today="$yr-$m-$d";
$Y='Y';
$ex='EX0';
?>

<table>
    <tr>
        <th bgcolor=6495ED>VN</th>
        <th bgcolor=6495ED>คิว</th>
        <th bgcolor=6495ED>เวลา</th>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>พิมพ์ใบสั่งยา</th>
        <th bgcolor=6495ED>AN</th>
        <th bgcolor=6495ED>สิทธิ</th>
        <th bgcolor=6495ED><font face='Angsana New'>พิมพ์ใบตรวจโรค</th>
        <th bgcolor=6495ED><font face='Angsana New'>พิมพ์ใบต่อ</th>
    </tr>
<?php
$query = "SELECT a.vn,a.thdatehn,a.thidate,a.hn,a.ptname,a.an,a.diag,a.ptright,a.doctor,a.okopd,a.toborow,a.borow,a.goup,a.officer,a.kew,a.phaok,b.idcard FROM opday as a,opcard as b WHERE a.hn=b.hn and a.thidate LIKE '$today%' order by a.thidate desc ";
$result = mysql_query($query) or die("Query failed");

while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok,$idcard) = mysql_fetch_row ($result)) {
    $color='66CDAA';
    $time=substr($thidate,11);

    print (" <tr>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$vn</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$kew</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
    //  "  <td BGCOLOR=$color><font face='Angsana New'><a  href=\"rxform2.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptname</a></td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'>$an</td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxform2.5.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$ptright</a></td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$goup</td>\n".
    //"  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
    // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$okopd</td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"rxform2.1.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&ctoborow=$toborow&cVn=$vn\">$toborow</a></td>\n".
    "  <td BGCOLOR=$color><font face='Angsana New'><a target=_BLANK  href=\"opdcard_reg.php?cHn=$hn&cVn=$vn\">$hn</a></td>\n".  
    // "  <td BGCOLOR=$color><font face='Angsana New'>$borow</td>\n".
    //  "  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
    //   "  <td BGCOLOR=#FF0000><font face='Angsana New'>$detel$detel1</td>\n".
    " </tr>\n");
}
include("unconnect.inc");
?>
</table>