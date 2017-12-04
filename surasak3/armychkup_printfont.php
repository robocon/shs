<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
include("connect.inc");
		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
?>
<style type="text/css">
<!--
body,td,th {
	font-size: 20px;
	font-family:"TH SarabunPSK";
}

@media print{
	#none_print { display:none;}
}

-->
</style>
<title>พิมพ์ปกตรวจสุขภาพทหารประจำปีแบบกลุ่ม</title>
<div id="none_print">
<p align="center"><strong>พิมพ์หน้าปกตรวจสุขภาพทหารประจำปี 2560</strong></p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">หน่วย :
        <label>      
        <select name="camp" id="camp">
		 <?
		 $sql="select distinct(camp) as camp from armychkup where yearchkup = '$nPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="พิมพ์รายงาน">
        </label></td>
    </tr>
  </table>
</form>
</div>
<?
if($_POST["act"]=="show"){

$camp=$_POST["camp"];
$chkcamp=substr($camp,0,3);
$select = "select * from armychkup where camp='".$camp."' and yearchkup='$nPrefix' order by chunyot asc, age desc";
//echo $select;
$row = mysql_query($select);
while($result = mysql_fetch_array($row)){
?>
<table height="100%" width="100%" border="0">
  <tr height="50%">
    <td width="50%">&nbsp;</td>
    <td width="50%" valign="top"><div align="center" style="margin-top: 88px; margin-left: 40px; font-weight:bold;">ชื่อ-นามสกุล : <?=$result['yot']." ".$result['ptname']?><br />หน่วย : <?= substr($result['camp'],4)?>
    </div></td>
  </tr>
</table>
<?
	echo "<div style='page-break-after : always;'></div>";
	}
}
?>


