<?php
session_start();

include("connect.inc");
$today=date("d-m-").(date("Y")+543);	

    $month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";

$refresh = "<meta http-equiv=\"refresh\" content=\"1;URL=".$_SERVER['PHP_SELF']."\">";

$sql = "Select time1 From opday where thdatehn = '".$_GET["cTdatehn"]."' AND vn = '".$_GET["cVn"]."' ";
$result = Mysql_Query($sql);
list($time1) = Mysql_fetch_row($result);

$subtime = explode(":",$time1);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = time() - $rt;

//if($stringtime > 600){
//	$time2 = date("G:i:s",($rt+300));
//}else{
	$time2 = date("H:i:s");
//}


if(isset($_GET["page"]) && $_GET["page"] == "rxform3bc"){
		
		
		$query ="update opday SET phaok='Y',time2='".$time2."' ,opdreg='y' WHERE thdatehn = '".$_GET["cTdatehn"]."' AND vn = '".$_GET["cVn"]."' ";
        $result = Mysql_Query($query)  or die("Query failed,update opday");

   If (!$result)
        echo "insert into opday fail";
   else
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย ส่งข้อมูลเรียบร้อย";
   
	echo $refresh;
	exit();

}else if(isset($_GET["page"]) && $_GET["page"] == "rxform31bc"){

        $query ="Update opday SET phaok='X',time2='".$time2."',opdreg='x' WHERE thdatehn = '".$_GET["cTdatehn"]."' AND vn = '".$_GET["cVn"]."' ";
        $result = Mysql_Query($query) or die("Query failed,update opday");

   If (!$result)
        echo "insert into opday fail";
   else
        echo "บันทึกแก้ไขข้อมูลเรียบร้อย ส่งข้อมูลเรียบร้อย";
   
	echo $refresh;
	exit();

}else if(isset($_POST["cTdatehn"])){

	$cTdatehn = $today.$_POST["cTdatehn"];
	
	$sql = "Select vn From opday WHERE thdatehn = '".$cTdatehn."' Order by row_id DESC limit 0,1 ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 0){
		list($cVn) = Mysql_fetch_row($result);

		$query ="update opday SET opdreg='Y',time2='".$time2."',phaok='Y' WHERE thdatehn = '".$cTdatehn."' AND vn = '".$cVn."' ";
		$result = mysql_query($query) or die("Query failed,update opday");
	 
	   If (!$result)
			echo "insert into opday fail";
	   else
			echo "บันทึกแก้ไขข้อมูลเรียบร้อย ส่งข้อมูลเรียบร้อย";
	}else{
		echo "insert into opday fail"; 
	}

	echo $refresh;
	exit();
}
?>
<html>
<head>
<title>จ่าย OPD Card ด้วย บาร์โค้ด</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="30;URL=<?php echo $_SERVER['PHP_SELF'];?>">
</head>
<body onLoad="document.getElementById('cTdatehn').focus();" onclick="document.getElementById('cTdatehn').focus();">
<?php

    echo "วันที่ ".date("d")." ".$month[date("m")]." ".(date("Y")+543)." ";
    echo "<BR> <a target=_self  href='oplistexbc1.php'>ไปดูรายการที่ค้างอยู่ในระบบ<br> <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู............</a><br> ";
    
$today=(date("Y")+543).date("-m-d");
$N='X';

?>

<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
	<TABLE>
		<TR>
			<TD>Barcode&nbsp;:&nbsp;</TD>
			<TD><INPUT ID="cTdatehn" TYPE="text" NAME="cTdatehn"></TD>
		</TR>
	</TABLE>
</FORM>

<?php

    $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,ptright,doctor,okopd,toborow,borow,goup,officer,kew,phaok FROM opday WHERE thidate LIKE '$today%'and opdreg='$N' ";

    $result = mysql_query($query) or die("Query failed");
	if(Mysql_num_rows($result) > 0){
?>
<table  align="center" style="font-family: Angsana New; font-size: 25px;">
 <tr>
	<th bgcolor="6495ED" colspan="9"><B><?php echo "รายชื่อคนไข้เรียงตามลำดับเวลาก่อนหลัง บันทึกการส่งจุดคัดแยก";?></B></th>
  </tr>
 <tr>
	<th bgcolor="6495ED">VN</th>
	<th bgcolor="6495ED">คิว</th>
	<th bgcolor="6495ED">เวลา</th>
	<th bgcolor="6495ED">HN</th>
	<th bgcolor="6495ED">กดส่งคัดแยก</th>
	<th bgcolor="6495ED">สิทธิ</th>
	<th bgcolor="6495ED">กดส่งกลับไปค้น</th>
	<th bgcolor="6495ED">ผู้ยืม</th>
	<th bgcolor="6495ED">ผู้บันทึก</th>
  </tr>

<?php


    while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$ptright,$doctor,$okopd,$toborow,$borow,$goup,$officer,$kew,$phaok) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

if(substr($ptright,0,3)=='R07'){
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



        print (
					" <tr>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$vn</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$kew</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$time</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$hn</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'><a   href=\"".$_SERVER['PHP_SELF']."?page=rxform3bc&cTdatehn=$thdatehn&cVn=$vn\">$ptname</a></td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$ptright</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'><a  href=\"".$_SERVER['PHP_SELF']."?page=rxform31bc&cTdatehn=$thdatehn&cVn=$vn\" >$toborow</a></td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$borow</td>\n".
					"  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
					" </tr>\n");
       }

?>

</table>

<?php
	}
    include("unconnect.inc");
?>
</body>
</html>