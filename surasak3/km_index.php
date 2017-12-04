<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>ศูนย์ข้อมูลองค์ความรู้</title>
<style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	color: #FF0000;
	font-weight: bold;
}
.style3 {font-size: 16px}
.style4 {font-size: 16}
-->
</style></head>

<body>
<?
include("connect.inc");
if($_GET["act"]=="view"){
$sql=mysql_query("select * from kmcounter where name='counter'");
$result=mysql_fetch_array($sql);
$counter=$result["runno"]+1;
$add=mysql_query("update kmcounter set runno='$counter' where row_id='".$result["row_id"]."'");
}
$type1="องค์ความรู้ทางทหาร";
$sql1="select * from km where type='$type1'";	
$query1=mysql_query($sql1) or die ("Error Query [".$sql1."]");
$count1=mysql_num_rows($query1);

$type2="องค์ความรู้ด้านวิชาชีพ";
$sql2="select * from km where type='$type2'";	
$query2=mysql_query($sql2) or die ("Error Query [".$sql2."]");
$count2=mysql_num_rows($query2);

$type3="องค์ความรู้แนวทางในการปฏิบัติทาง";
$sql3="select * from km where type='$type3'";	
$query3=mysql_query($sql3) or die ("Error Query [".$sql3."]");
$count3=mysql_num_rows($query3);

$type4="องค์ความรู้บทเรียนจากการปฏิบัติงาน/การรบ";
$sql4="select * from km where type='$type4'";	
$query4=mysql_query($sql4) or die ("Error Query [".$sql4."]");
$count4=mysql_num_rows($query4);

$type5="องค์ความรู้ภูมิปัญญา";
$sql5="select * from km where type='$type5'";	
$query5=mysql_query($sql5) or die ("Error Query [".$sql5."]");
$count5=mysql_num_rows($query5);

$type6="องค์ความรู้อื่นๆ";
$sql6="select * from km where type='$type6'";	
$query6=mysql_query($sql6) or die ("Error Query [".$sql6."]");
$count6=mysql_num_rows($query6);
?>
<p align="center"><span class="style1">ศูนย์ข้อมูลองค์ความรู้<br />
โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</span><br />
</p>
<table width="80%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center"><div><a href="km_list.php?type=<?=$type1;?>"><img src="images/bt01.jpg" width="180" height="120" border="0" /></a><br />
    </div>
      <table width="40%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="49%" align="right"><span class="style3">จำนวน</span></td>
          <td width="5%" align="left"><span class="style3"></span></td>
          <td width="46%" align="left"><span class="style3">
            <?=$count1;?> 
          เรื่อง</span></td>
        </tr>
        <tr>
          <td align="right"><span class="style3">ผู้อ่าน</span></td>
          <td align="left"><span class="style3"></span></td>
          <?
		    $sql1=mysql_query("select * from kmcounter where name='read1'");
  			$result1=mysql_fetch_array($sql1);
  			$read1=$result1["runno"];
		  ?>
          <td align="left"><span class="style3">
            <?=$read1;?> 
          คน</span></td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
    </table>      </td>
    <td align="center"><div><a href="km_list.php?type=<?=$type2;?>"><img src="images/bt02.jpg" width="180" height="120" border="0" /></a><br />
    </div>
      <table width="40%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="49%" align="right" class="style3">จำนวน</td>
          <td width="5%" align="left" class="style3">&nbsp;</td>
          <td width="46%" align="left" class="style3"><?=$count2;?>
            เรื่อง</td>
        </tr>
        <tr>
          <td align="right" class="style3">ผู้อ่าน</td>
          <td align="left" class="style3">&nbsp;</td>
          <?
		    $sql2=mysql_query("select * from kmcounter where name='read2'");
  			$result2=mysql_fetch_array($sql2);
  			$read2=$result2["runno"];
		  ?>          
          <td align="left" class="style3"><?=$read2;?>
            คน</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
    </table>      </td>
  </tr>
  <tr>
    <td align="center"><div><a href="km_list.php?type=<?=$type3;?>"><img src="images/bt03.jpg" width="180" height="120" border="0" /></a><br />
    </div>
      <table width="40%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="49%" align="right" class="style3">จำนวน</td>
          <td width="5%" align="left" class="style3">&nbsp;</td>
          <td width="46%" align="left" class="style3"><?=$count3;?>
            เรื่อง</td>
        </tr>
        <tr>
          <td align="right" class="style3">ผู้อ่าน</td>
          <td align="left" class="style3">&nbsp;</td>
          <?
		    $sql3=mysql_query("select * from kmcounter where name='read3'");
  			$result3=mysql_fetch_array($sql3);
  			$read3=$result3["runno"];
		  ?>          
          <td align="left" class="style3"><?=$read3;?>
            คน</td>
        </tr>
        <tr>
          <td align="right">&nbsp;</td>
          <td align="left">&nbsp;</td>
          <td align="left">&nbsp;</td>
        </tr>
    </table>      </td>
    <td align="center"><div><a href="km_list.php?type=<?=$type4;?>"><img src="images/bt04.jpg" width="180" height="120" border="0" /></a><br />
    </div>
        <table width="40%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="49%" align="right" class="style3">จำนวน</td>
            <td width="5%" align="left" class="style3">&nbsp;</td>
            <td width="46%" align="left" class="style3"><?=$count4;?>
              เรื่อง</td>
          </tr>
          <tr>
            <td align="right" class="style3">ผู้อ่าน</td>
            <td align="left" class="style3">&nbsp;</td>
          <?
		    $sql4=mysql_query("select * from kmcounter where name='read4'");
  			$result4=mysql_fetch_array($sql4);
  			$read4=$result4["runno"];
		  ?>            
            <td align="left" class="style3"><?=$read4;?>
              คน</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
    </table>        </td>
  </tr>
  <tr>
    <td align="center"><div><a href="km_list.php?type=<?=$type5;?>"><img src="images/bt05.jpg" width="180" height="120" border="0" /></a><br />
    </div>
        <table width="40%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="49%" align="right" class="style3">จำนวน</td>
            <td width="5%" align="left" class="style3">&nbsp;</td>
            <td width="46%" align="left" class="style3"><?=$count5;?>
              เรื่อง</td>
          </tr>
          <tr>
            <td align="right" class="style3">ผู้อ่าน</td>
            <td align="left" class="style3">&nbsp;</td>
          <?
		    $sql5=mysql_query("select * from kmcounter where name='read5'");
  			$result5=mysql_fetch_array($sql5);
  			$read5=$result5["runno"];
		  ?>            
            <td align="left" class="style3"><?=$read5;?>
              คน</td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
    </table>        </td>
    <td align="center"><div><a href="km_list.php?type=<?=$type6;?>"><img src="images/bt06.jpg" width="180" height="120" border="0" /></a><br />
    </div>
        <table width="40%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="49%" align="right" class="style3"><span class="style4">จำนวน</span></td>
            <td width="5%" align="left" class="style3">&nbsp;</td>
            <td width="46%" align="left" class="style3"><span class="style4">
            <?=$count6;?>
            เรื่อง</span></td>
          </tr>
          <tr>
            <td align="right" class="style3"><span class="style4">ผู้อ่าน</span></td>
            <td align="left" class="style3">&nbsp;</td>
          <?
		    $sql6=mysql_query("select * from kmcounter where name='read6'");
  			$result6=mysql_fetch_array($sql6);
  			$read6=$result6["runno"];
		  ?>            
            <td align="left" class="style3"><span class="style4">
            <?=$read6;?>
            คน</span></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left">&nbsp;</td>
            <td align="left">&nbsp;</td>
          </tr>
    </table>        </td>
  </tr>
  <tr>
  <?
  $sql=mysql_query("select * from kmcounter where name='counter'");
  $result=mysql_fetch_array($sql);
  $counter=$result["runno"];
  ?>
    <td colspan="2" align="center">จำนวนผู้เยี่ยมชม : <span class="style2"><?=$counter;?></span> คน</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><a href="../nindex.htm" class="forntsarabun"> << กลับเมนูหลัก >> </a></td>
  </tr>
</table>
</body>
</html>
