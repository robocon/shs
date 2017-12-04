<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานประจำวัน</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.forntsarabun1 {	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>
</head>
<?
$d=date('d');
$m=date('m');
?>
<body>
<? include('xray_menu.php'); ?>
<div align="center">
<p align="center"><strong>รายงานประจำวัน</strong></p>
<form action="xray_reportday.php" method="post" name="form1">
<input name="act" type="hidden" value="show" />
วันที่ : <input name="d_start" type="text" class="forntsarabun" id="d_start" value="<?=$d;?>" size="3" />
เดือน : <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select> 
ปี : <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       <input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>
       <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
</form>
<hr />
<?
if($_POST["act"]=="show"){
include("../Connections/connect.inc.php"); 
$date=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
$showdate=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
$date1=$_POST["y_start"]."-".$_POST["m_start"]."-".($_POST["d_start"]-1);
$sqltmp="CREATE TEMPORARY TABLE  tmpxray  SELECT * FROM xray_stat
WHERE (date  between '$date 00:00:00' and '$date 23:59:00') and cancle ='0'";
$querytmp = mysql_query($sqltmp); 
?>
<p><strong>รายงานวันที่ <?=$showdate;?></strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>แยกตาม</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>เวรเช้า</strong><br />
      08.00 - 16.00</td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>เวรบ่าย</strong><br />16.00 - 24.00</td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>เวรดึก</strong><br />
      24.00 - 08.00</td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>รวมทั้งสิ้น</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>เวรเสริมเช้า</strong><br />
      10.00 - 15.00</td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>เวรเสริมบ่าย</strong><br />
      16.00 - 20.00</td>
    <td width="16%" align="center" bgcolor="#FF9999"><strong>รวมทั้งสิ้น</strong></td>
  </tr>
  
  <tr>
    <td align="left">จำนวนคน</td>
    <?
	$sql1=mysql_query("select  distinct(hn) from tmpxray where `date` between  '$date 08:00:00' and  '$date 15:59:59'");
	$num1=mysql_num_rows($sql1);
	?>
    <td align="center"><?=$num1;?></td>
    <?
	$sql2=mysql_query("select  distinct(hn) from tmpxray where `date` between  '$date 16:00:00' and  '$date 23:59:59'");
	$num2=mysql_num_rows($sql2);
	?>
    <td align="center"><?=$num2;?></td>
    <?
	$sql3=mysql_query("select  distinct(hn) from tmpxray where `date` between  '$date 00:00:00' and  '$date 07:59:59'");
	$num3=mysql_num_rows($sql3);
	?>
    <td align="center"><?=$num3;?></td>
    <?
	$totalnum=$num1+$num2+$num3;
	?>
    <td align="center" bgcolor="#FFFFCC"><strong>
      <?=$totalnum;?>
    </strong></td>
    <?
	$sql11=mysql_query("select  distinct(hn) from tmpxray where `date` between  '$date 10:00:00' and  '$date 14:59:59'");
	$num11=mysql_num_rows($sql11);
	?>
    <td align="center"><?=$num11;?></td>
    <?
	$sql22=mysql_query("select  distinct(hn) from tmpxray where `date` between  '$date 16:00:00' and  '$date 21:59:59'");
	$num22=mysql_num_rows($sql22);
	?>
    <td align="center"><?=$num22;?></td>
    <?
	$totalnum1=$num11+$num22;
	?>    
    <td align="center" bgcolor="#FFCC99"><strong>
      <?=$totalnum1;?>
    </strong></td>
  </tr>
  <tr>
    <td align="left">จำนวนครั้ง</td>
    <?
	$sql5=mysql_query("select count(hn) as counthn5 from tmpxray where `date` between  '$date 08:00:00' and  '$date 15:59:59'");
	list($counthn5)=mysql_fetch_row($sql5);
	?>    
    <td align="center"><?=$counthn5;?></td>
    <?
	$sql6=mysql_query("select count(hn) as counthn6 from tmpxray where `date` between  '$date 16:00:00' and  '$date 23:59:59'");
	list($counthn6)=mysql_fetch_row($sql6);
	?>    
    <td align="center"><?=$counthn6;?></td>
    <?
	$sql7=mysql_query("select count(hn) as counthn7 from tmpxray where `date` between  '$date 00:00:00' and  '$date 07:59:59'");
	list($counthn7)=mysql_fetch_row($sql7);
	?>    
    <td align="center"><?=$counthn7;?></td>
    <?
	$totalcount=$counthn5+$counthn6+$counthn7;
	?>
    <td align="center" bgcolor="#FFFFCC"><strong>
      <?=$totalcount;?>
    </strong></td>
    <?
	$sql55=mysql_query("select count(hn) as counthn55 from tmpxray where `date` between  '$date 10:00:00' and  '$date 14:59:59'");
	list($counthn55)=mysql_fetch_row($sql55);
	?>    
    <td align="center"><?=$counthn55;?></td>
    <?
	$sql66=mysql_query("select count(hn) as counthn66 from tmpxray where `date` between  '$date 16:00:00' and  '$date 21:59:59'");
	list($counthn66)=mysql_fetch_row($sql66);
	?>    
    <td align="center"><?=$counthn66;?></td>
    <?
	$totalcount1=$counthn55+$counthn66;
	?>    
    <td align="center" bgcolor="#FFCC99"><strong>
      <?=$totalcount1;?>
    </strong></td>
  </tr>
</table>
<?
}
?>
<br />
<br />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>เวรเช้า 08.00-16.00 น. วันที่ <?=$showdate;?></strong>
    <table width="100%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
      <tr>
        <td width="7%" align="center" bgcolor="#999999"><strong>ลำดับที่</strong></td>
        <td width="24%" align="center" bgcolor="#999999"><strong>เวลา</strong></td>
        <td width="21%" align="center" bgcolor="#999999"><strong>HN</strong></td>
        <td width="42%" align="center" bgcolor="#999999"><strong>ชื่อ - นามสกุล</strong></td>
      </tr>
    <?
        $tbsql=mysql_query("select  * from tmpxray where `date` between  '$date 08:00:00' and  '$date 15:59:59'");
        if(mysql_num_rows($tbsql) < 1){
        	echo "<tr><td align='center' colspan='4' style='color:red;'>--------------------- ไม่มีข้อมูล ---------------------</td></tr>";
        }else{
            $i=0;
            while($tbrows=mysql_fetch_array($tbsql)){
            $i++;
    ?>  
      <tr>
        <td align="center"><?=$i;?></td>
        <td><?=substr($tbrows["date"],10,9);?></td>
        <td align="left"><?=$tbrows["hn"];?></td>
        <td align="left"><?=$tbrows["ptname"];?></td>
      </tr>
    <?
            }
        }
    ?>  
    </table>
	</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <strong>เวรบ่าย 16.00-24.00 น. วันที่ <?=$showdate;?></strong>
    <table width="100%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
      <tr>
        <td width="7%" align="center" bgcolor="#999999"><strong>ลำดับที่</strong></td>
        <td width="24%" align="center" bgcolor="#999999"><strong>เวลา</strong></td>
        <td width="21%" align="center" bgcolor="#999999"><strong>HN</strong></td>
        <td width="42%" align="center" bgcolor="#999999"><strong>ชื่อ - นามสกุล</strong></td>
      </tr>
    <?
        $tbsql=mysql_query("select  * from tmpxray where `date` between  '$date 16:00:00' and  '$date 23:59:59'");
        if(mysql_num_rows($tbsql) < 1){
        	echo "<tr><td align='center' colspan='4' style='color:red;'>--------------------- ไม่มีข้อมูล ---------------------</td></tr>";
        }else{
            $i=0;
            while($tbrows=mysql_fetch_array($tbsql)){
            $i++;
    ?>  
      <tr>
        <td align="center"><?=$i;?></td>
        <td><?=substr($tbrows["date"],10,9);?></td>
        <td align="left"><?=$tbrows["hn"];?></td>
        <td align="left"><?=$tbrows["ptname"];?></td>
      </tr>
    <?
            }
        }
    ?>  
    </table>    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
    <strong>เวรดึก 00.00-08.00 น. วันที่ <?=$showdate;?></strong>
    <table width="100%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
      <tr>
        <td width="7%" align="center" bgcolor="#999999"><strong>ลำดับที่</strong></td>
        <td width="24%" align="center" bgcolor="#999999"><strong>เวลา</strong></td>
        <td width="21%" align="center" bgcolor="#999999"><strong>HN</strong></td>
        <td width="42%" align="center" bgcolor="#999999"><strong>ชื่อ - นามสกุล</strong></td>
      </tr>
    <?
        $tbsql=mysql_query("select  * from tmpxray where `date` between  '$date 00:00:00' and  '$date 07:59:59'");
        if(mysql_num_rows($tbsql) < 1){
        	echo "<tr><td align='center' colspan='4' style='color:red;'>--------------------- ไม่มีข้อมูล ---------------------</td></tr>";
        }else{
            $i=0;
            while($tbrows=mysql_fetch_array($tbsql)){
            $i++;
    ?>  
      <tr>
        <td align="center"><?=$i;?></td>
        <td><?=substr($tbrows["date"],10,9);?></td>
        <td align="left"><?=$tbrows["hn"];?></td>
        <td align="left"><?=$tbrows["ptname"];?></td>
      </tr>
    <?
            }
        }
    ?>  
    </table>    
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
</div>
</body>
</html>
