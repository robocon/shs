<?php
session_start();

include("connect.inc");



$today=date("d-m-").(date("Y")+543);	
$today1=(date("Y")+543).date("-m-d");	
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
 if(isset($_POST["cTdatehn"])){

	 $cTdatehn = $today.$_POST["cTdatehn"];
    $cTdatehn1 =$_POST["cTdatehn"];

$sql = "Select row_id,pharin,kewphar,item,ptname,hn,tvn,pharout From dphardep WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%' limit 1 ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 0){
		list($id,$pharin,$kewphar,$item,$ptname,$hn,$tvn,$pharout) = Mysql_fetch_row($result);



    if(empty($pharout)){

		$query ="update dphardep SET pharout ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");

	

$today=date("d-m-").(date("Y")+543);	
$todaytime=date("H:i:s");	

$starttime = $pharin;
	$lasttime = $todaytime;
	if($lasttime!="" and $starttime!="" ){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}




//	echo "<body Onload='window.print();'>";
		//echo "<center>จ่ายยา <br></FONT>";
	    // echo "โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง<br>";
	   	//echo " $today&nbsp;&nbsp;$todaytime<br>"; 
	    //echo "<font face='Angsana New' size='20'><b>ชื่อ &nbsp;$ptname <br> <font face='Angsana New' size='4'>&nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
	   	//echo " <font face='Angsana New' size='20'>$kewphar<BR>";
		// echo " <font face='Angsana New' size='15'>**ใช้เวลารอรับยา**";
		//echo " <font face='Angsana New' size='15'>$time3</center>";
		echo "<div align='center' style='font-family:Tahoma; font-size:64px; margin-top:40px;'><strong>จ่ายยาผู้ป่วยนอก</strong></div>";
		echo "<div align='center' style='font-family:Tahoma; font-size:64px; margin-top:30px;'><strong>$hn</strong></div>";	
		echo "<div align='center' style='font-family:Tahoma; font-family:Tahoma; font-size:64px; margin-top:30px;'><strong>$ptname</strong></div>";


		$query11 = "INSERT INTO soundpha(kew,status,hn)VALUES('$kewphar','n','$hn');";
		$result = mysql_query($query11) or die("Query failed,cannot insert into soundpha");


		///// ส่งค่าไปแจ้งเตือน Line OA
		$page = 'phar.php';
		$url = 'http://192.168.131.220/exten_sm3_notify_pt_manual/'.$page.'?id='.$id.'&hn='.$hn;
		$ch = curl_init($url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);

		if (curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
		} else {
			echo $response;
		}

		curl_close($ch);	

	   }else{


	$query ="update dphardep SET pharout1 ='".date("H:i:s")."' WHERE hn = '".$cTdatehn1."' AND  date LIKE '$today1%'  ";
		$result = mysql_query($query) or die("Query failed,update thaywin");
		//echo "<font face='Angsana New' size='6'><center><b>ชื่อ &nbsp;$ptname <br> &nbsp;HN:$hn&nbsp;VN:$tvn</b><br>";
		//echo "<font face='Angsana New' size='15'><center>ได้รับยาไปเรียบร้อย<br>"; 
        //echo "เวลา $pharout</center>"; 
		echo "<div align='center' style='font-family:Tahoma; font-size:64px; margin-top:40px;'><strong>จ่ายยาผู้ป่วยนอก</strong></div>";
		echo "<div align='center' style='font-family:Tahoma; font-size:64px; margin-top:30px;'><strong>$hn</strong></div>";	
		echo "<div align='center' style='font-family:Tahoma; font-family:Tahoma; font-size:64px; margin-top:30px;'><strong>$ptname</strong></div>";
		echo "<div align='center' style='font-family:Tahoma; font-family:Tahoma; font-size:32px; margin-top:30px;color:red;'>***** เคยลงเวลาจ่ายยาไปแล้ว *****</div>";



}

	}else{
		echo "<font face='Angsana New' size='15'><center>ไม่มีหมายเลขรับยานี้</center>"; 
		echo "<embed src=''soundkewpha/001.wma' width='0' height='0' ></embed>";	

	}

	echo $refresh;
	exit();

}



?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head >
    <title>แสดงผลคิวรับยา</title>
    <script type="text/javascript" >
        function date_time(id) {
            date = new Date;
            year = date.getFullYear();
            month = date.getMonth();
            months = new Array('มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน', 'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม');
            d = date.getDate();
            day = date.getDay();
            days = new Array('อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสดี', 'ศุกร์', 'เสาร์');
            h = date.getHours();
            if (h < 10) {
                h = "0" + h;
            }
            m = date.getMinutes();
            if (m < 10) {
                m = "0" + m;
            }
            s = date.getSeconds();
            if (s < 10) {
                s = "0" + s;
            }
            result = '' + days[day] + ' ' + d + ' ' + months[month] + ' ' + year + ' ' + h + ':' + m + ':' + s;
            document.getElementById(id).innerHTML = result;
            setTimeout('date_time("' + id + '");', '1000');
            return true;
        }
      
    </script>
</head>
<body>   
           <span id="date_time" style="color: #000000; font-size: x-medium;"></span>
         <script type="text/javascript"> window.onload = date_time('date_time');</script>
  
 
</body>
</html>
<html>
<head>
<title>ลงเวลารับยาด้วย  HN ผู้ป่วย</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="30;URL=<?php echo $_SERVER['PHP_SELF'];?>">
</head>
<style>
body,td,th {
	font-family:Tahoma;
	font-size: 36px;
	font-weight:bold;	
}
table {
  border-collapse: collapse;
  width: 98%;
}

th, td {
  text-align: left;
  padding: 20px;
}
		
tr:nth-child(even) {
  background-color: #FDEDEC;
} 
.txt {
	font-family: TH SarabunPSK;
	font-size: 20px;
} 
</style>
<body onLoad="document.getElementById('cTdatehn').focus();" onclick="document.getElementById('cTdatehn').focus();">
<?php    
$today=(date("Y")+543).date("-m-d");
$N='N';
$todaytime=date("H:i:s");	
?>
<FORM METHOD=POST ACTION="<?php echo $_SERVER['PHP_SELF'];?>">
<div align="right" style="margin-right:20px;font-size:20px;">HN : <INPUT ID="cTdatehn" TYPE="text" NAME="cTdatehn" class="txt"></div>
</FORM>
<?php
$tk='ทค';
    $query = "SELECT chktranx,date,ptname,hn,an,price,tvn,ptright,kew,pharout,doctor,pharin,pharout1,kewphar FROM dphardep WHERE date LIKE '$today1%' and pharout <> ''  and kewphar <> '' and stkcutdate <> '' and kewphar like '$tk%'  and dr_cancle 	is null order by pharout DESC  limit 3";
    //echo $query;
	$result = mysql_query($query) or die("Query failed1111");
	if(Mysql_num_rows($result) > 0){		
?>
<div style="margin-top:-70px;">
<table  align="center" cellpadding="10">
 <tr>
	<th bgcolor="ffffff" colspan="9"  ><strong style='font-size:40px; color:#ff0000;'><?php echo "รายชื่อผู้รับบริการที่กำลังจ่ายยาขณะนี้  ";?> </strong></th>
  </tr> 
 <tr>
	<th width="10%" bgcolor="#16A085">คิว</th>	
	<th width="10%" bgcolor="#16A085">ใบที่</th>	
	<th bgcolor="#16A085">ชื่อ-สกุล <strong style='margin-left:30px;font-size:40px;color:#E74C3C;text-shadow: #FDEDEC 0.1em 0.1em 0.1em;background-color:#FFFFFF;border:3px solid #FFFFFF;'><i>&nbsp;&nbsp;คิวทหาร/ครอบครัว&nbsp;&nbsp;</i></strong></th>
	<th width="10%" bgcolor="#16A085">เวลารอ</th>
  </tr>

<?php

     $j=0;
	$countavg = 0;
    while (list ($chktranx,$date,$ptname,$hn,$an,$price,$tvn,$ptright,$kew,$pharout,$doctor,$pharin,$pharout1,$kewphar) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

		list($yot,$name,$surname)=explode(" ",$ptname);
		$ptname=$yot."".$name." xxxxx";
/*	if($pharout != ""){

$subtime = explode(":",$pharin);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($pharout) - $rt;
if($stringtime > 600){
	$pharout = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($pharin);
					$stringtime2 = strtime($pharout);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/

$starttime = $pharin;
	$lasttime = $pharout;
	if($lasttime!=""and $starttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}

        print (
		" <tr>\n".
		"  <td BGCOLOR=ffffff><b>$kewphar</b></td>\n".	
		"  <td BGCOLOR=fffffff>$kew</td>\n".
		"  <td BGCOLOR=fffffff><b>$ptname</b></td>\n".
		"  <td BGCOLOR=fffffff><b>$time3</b></td>\n".
		" </tr>\n");
       }
	
?>


</table>
</div>

<?php
	}
?>

<?php
/*
function strtime($time){

		$subtime = explode(":",$time);
		$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));

	return  $rt;
}
*/






    $query = "SELECT chktranx,date,ptname,hn,an,price,tvn,ptright,kew,pharout,doctor,pharin,pharout1,kewphar FROM dphardep WHERE date LIKE '$today1%' and pharout <> ''  and kewphar <> '' and stkcutdate <> ''and kewphar NOT LIKE  '%ทค%'  and dr_cancle 	is null order by pharout DESC  limit 3";
	//echo $query;
    $result = mysql_query($query) or die("Query failed222");
	if(Mysql_num_rows($result) > 0){
		
		
		
?>
<table  align="center"> 
<tr>
	<th width="10%" bgcolor="6495ED">คิว</th>	
	<th width="10%" bgcolor="6495ED">ใบที่</th>	
	<th bgcolor="6495ED">ชื่อ-สกุล <strong style='width:500px;margin-left:30px;font-size:40px;color:#E74C3C;text-shadow: #FDEDEC 0.1em 0.1em 0.1em;background-color:#FFFFFF;border:3px solid #FFFFFF;'><i>&nbsp;&nbsp;คิวบุคคลทั่วไป/อื่นๆ &nbsp;&nbsp;</i></strong></th>
	<th width="10%" bgcolor="6495ED">เวลารอ</th>
  </tr>

<?php

     $j=0;
	$countavg = 0;
    while (list ($chktranx,$date,$ptname,$hn,$an,$price,$tvn,$ptright,$kew,$pharout,$doctor,$pharin,$pharout1,$kewphar) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);

		list($yot,$name,$surname)=explode(" ",$ptname);
		$ptname=$yot."".$name." xxxxx";
/*	if($pharout != ""){

$subtime = explode(":",$pharin);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($pharout) - $rt;
if($stringtime > 600){
	$pharout = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($pharin);
					$stringtime2 = strtime($pharout);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/

$starttime = $pharin;
	$lasttime = $pharout;
	if($lasttime!=""and $starttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}

        print (
		" <tr>\n".
		"  <td BGCOLOR=ffffff><b>$kewphar</b></td>\n".	
		"  <td BGCOLOR=fffffff>$kew</td>\n".
		"  <td BGCOLOR=fffffff><b>$ptname</b></td>\n".
		"  <td BGCOLOR=fffffff><b>$time3</b></td>\n".
		" </tr>\n");
       }
	
?>


</table>


<?php
	}
	$query3 = "select newpha from newpha  ";
	$row3 = mysql_query($query3);
	list($newpha) = mysql_fetch_array($row3);
	
    include("unconnect.inc");
?>
</body>
<MARQUEE><STRONG><SPAN  <font color=#ffffff><font size="9"  face="THSarabunPSK"  color="#000099"> 
***<?php echo $newpha ?> ***</FONT></FONT></SPAN></STRONG></MARQUEE>
</html>

<BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR><BR>
<?php
/*
function strtime($time){

		$subtime = explode(":",$time);
		$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));

	return  $rt;
}
*/


include("connect.inc");



    $query = "SELECT chktranx,date,ptname,hn,an,price,tvn,ptright,kew,pharout,doctor,pharin,pharout1,kewphar FROM dphardep WHERE date LIKE '$today1%' and pharout <> ''  and kewphar <> ''  and dr_cancle 	is null order by pharout DESC";
	
    $result = mysql_query($query) or die("Query failed");
	if(Mysql_num_rows($result) > 0){
?>
<table  align="center">
 <tr>
	<th bgcolor="ffffff" colspan="9"  ><font size='5' color='#ff0000'><B><?php echo "รายชื่อผู้ป่วยที่จ่ายยาแล้ว  ";?> </B></th>
  </tr>
 <tr>
 <th width="10%" bgcolor="#EC7063">คิว</th>	
 <th width="5%" bgcolor="#EC7063">##</th>	
 <th bgcolor="#EC7063">เวลาเรียก</th>	
 <th bgcolor="#EC7063">##</th>	
 <th bgcolor="#EC7063">ใบที่</th>
 <th bgcolor="#EC7063">##</th>	
 <th bgcolor="#EC7063">ชื่อ-สกุล</th>
 <th bgcolor="#EC7063">##</th>
 <th bgcolor="#EC7063">เวลารอ</th>
  </tr>

<?php

     $j=0;
	$countavg = 0;
    while (list ($chktranx,$date,$ptname,$hn,$an,$price,$tvn,$ptright,$kew,$pharout,$doctor,$pharin,$pharout1,$kewphar) = mysql_fetch_row ($result)) {
        $time=substr($thidate,11);
		list($yot,$name,$surname)=explode(" ",$ptname);
		$ptname=$yot."".$name." xxxxx";		

/*	if($pharout != ""){

$subtime = explode(":",$pharin);
$rt = mktime($subtime[0],$subtime[1],$subtime[2],date("m"),date("d"),date("Y"));
$stringtime = strtime($pharout) - $rt;
if($stringtime > 600){
	$pharout = date("H:i:s",mktime($subtime[0],$subtime[1]+5,$subtime[2]+rand(1,60),date("m"),date("d"),date("Y")));
}
					$stringtime1 = strtime($pharin);
					$stringtime2 = strtime($pharout);
					$stringtime3 = $stringtime2-$stringtime1;
					$time3 = date("i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					$countavg = $countavg+$stringtime3;
					$j++;
				}else{
					$time3 = "";
				}
*/

$starttime = $pharin;
	$lasttime = $pharout;
	if($lasttime!=""and $starttime!=""){
		$stringtime3=strtotime($lasttime) - strtotime($starttime);
		$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));	
	}else{
		$time3 = "&nbsp;";
	}

        print (
		" <tr>\n".
		"  <td BGCOLOR=ffffff><b>$kewphar</b></td>\n".
		"  <td BGCOLOR=fffffff></td>\n".	
		"  <td BGCOLOR=ffffff><b>$pharout</b></td>\n".	
		"  <td BGCOLOR=fffffff></td>\n".
		"  <td BGCOLOR=fffffff>$kew</td>\n".
		"  <td BGCOLOR=fffffff></td>\n".
		"  <td BGCOLOR=fffffff><b>$ptname</b></td>\n".
		"  <td BGCOLOR=fffffff></td>\n".
		"  <td BGCOLOR=fffffff><b>$time3</b></td>\n".
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