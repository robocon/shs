<?php
session_start();
include("connect.inc");

?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>โรงพยาบาลค่าสุรศักดิ์มนตรี</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th { 
	font-family:"MS Sans Serif";
	font-size:14px;
}

.font_title{
	font-family:  "MS Sans Serif"; font-size:14px;
	
	color:#000000;
	font-weight: bold;
	

}
.style1 {font-size: 16px}
</style>

<body onload="window.print();">
<?php
  
 		
		if(isset($_REQUEST["appdate2"]) && $_REQUEST["appdate2"] != ""){
			$day3 = $_REQUEST["appdate2"];
		}else{	
			$day3 = date("d");
		}
		
		if(isset($_REQUEST["appmo2"]) && $_REQUEST["appmo2"] != ""){
			$month3 = $_REQUEST["appmo2"];
		}else{	
			$month3 = date("m");
			
	if(  date("m") == "01"){$month3 = "มกราคม" ; }
    else if( date("m") == "02"){ $month3 = "กุมภาพันธ์" ; }
    else if( date("m") == "03"){$month3 = "มีนาคม"  ; }
    else if(  date("m") == "04"){ $month3 = "เมษายน"; }
    else if(  date("m") == "05"){ $month3 = "พฤษภาคม"; }
    else if(  date("m") == "06"){ $month3 = "มิถุนายน"; }
    else if(  date("m") == "07"){ $month3 = "กรกฎาคม"; }
    else if(  date("m") == "08"){ $month3 = "สิงหาคม"; }
    else if( date("m") == "09"){ $month3 = "กันยายน" ; }
    else if( date("m") == "10"){$month3 = "ตุลาคม"  ; }
    else if(  date("m") == "11"){ $month3 = "พฤศจิกายน"; }
    else if(  date("m") == "12"){$month3 = "ธันวาคม" ; }

		}
		
		if(isset($_REQUEST["thiyr2"]) && $_REQUEST["thiyr2"] != ""){
			$year3 = $_REQUEST["thiyr2"];
		}else{	
			$year3 = date("Y")+543;
		}
		
		$appd2=$day3.' '.$month3.' '.$year3;
		$i=1;
?>
<br />
<br />
<table width="670" border="0" align="center" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
            <tr align="center" >
              <td align="center"><strong><span class="style1">ผู้ป่วยไม่มาตามนัด วันที่ <?php echo $appd2;?></span>
                  <br />
                <br />
              </strong></td>
            </tr>
</table>
<table width="703" border="1" align="center" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
            <tr align="center" class="font_title">
              <td width="53" align="center">No.</td>
              <td width="80">HN</td>
              <td width="147">ชื่อ-สกุล</td>
              <td width="153" >โรค</td>
              <td width="126" >แพทย์</td>
              <td width="104">หมายเหตุ</td>
            </tr>
<?php 
	$sql = "Select * From appoint where appdate = '".$appd2."' AND diag is not NULL and diag !='' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
	$xxx = explode(" ",$arr["appdate"]);
	$arr["doctor"] = substr($arr["doctor"],5);
?>			
            <tr>
              <td width="53" align="center"><?php echo $i; $i++;?></td>
              <td width="80"><?php echo $arr["hn"];?></td>
              <td width="147"><?php echo $arr["ptname"];?></td>
              <td><?php echo $arr["diag"];?></td>
              <td><?php echo $arr["doctor"] ;?></td>
              <td width="104"><?php echo $arr["remark"];?></td>
            </tr>
<?php } ?>
</table>
		  
</body>
</html>
