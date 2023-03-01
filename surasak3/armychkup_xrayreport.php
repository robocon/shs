<?
session_start();
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
		$oPrefix=$nPrefix-1;
		$newPrefix="25".$nPrefix;
		$oldPrefix="25".$nPrefix-1;
		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<title>รายงานสรุปตรวจร่างกายทหารประจำปี</title>
<p align="center"><strong>รายงานสรุปตรวจร่างกายทหารประจำปี <?=$newPrefix;?></strong></p>
<form name="form1" method="post" action="<? $PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center"><strong>สังกัด/หน่วย :
          <label>          </label>
      </strong>
        <label><select name="camp" id="camp" class="txtsarabun">
        <option value="all">ทั้งหมดทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from condxofyear_so where yearcheck='$newPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value=" ดูรายงาน " class="txtsarabun">
        </label>&nbsp;&nbsp;<input type="button" name="button" id="button" value=" กลับหน้าหลัก " onclick="window.location='../nindex.htm' " class="txtsarabun"></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){ $showcamp="ทุกหน่วย";}else{ $showcamp=$_POST["camp"];}
$camp=$_POST["camp"];
$chkcamp=substr($camp,0,3);
?>
<div align="center"><strong>รายงานผลตรวจสุขภาพทหารประจำปี 2561</strong></div>
<div align="center"><strong>หน่วย : <?=$showcamp;?></strong></div>
<div style="page-break-after: always"></div>
<div style="page-break-after: always"></div>


<div style="page-break-after: always"></div>

<div style="margin-left:30px;"><strong>การตรวจทางรังสีกรรม</strong></div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="6%" rowspan="2" align="center" bgcolor="#009999"><strong>ลำดับ</strong></td>
    <td width="21%" rowspan="2" align="center" bgcolor="#009999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="7%" rowspan="2" align="center" bgcolor="#009999"><strong>อายุ</strong></td>
    <td width="17%" rowspan="2" align="center" bgcolor="#009999"><strong>สังกัด</strong></td>
    <td align="center" bgcolor="#009999"><strong>ผลการตรวจ</strong></td>
  </tr>
  <tr>
    <td width="49%" align="center" bgcolor="#009999"><strong>รายละเอียดความผิกปกติ</strong></td>
  </tr>
<?
if($_POST["camp"]=="all"){
		$sql2 = "select * from condxofyear_so where yearcheck='$newPrefix' and camp !='' AND cxr !='ปกติ' order by camp asc, age desc";
}else{
		$sql2 = "select * from condxofyear_so where camp='".$camp."' and yearcheck='$newPrefix' and camp !=''  AND cxr !='ปกติ' order by camp asc, age desc";
}		
		//echo $sql;
		$query2 = mysql_query($sql2);  		
		$i=0;
		while($result2=mysql_fetch_array($query2)){
		$i++;
		$ptname2=$result2["yot"]." ".$result2["ptname"];
		$age2=$result2["age"];														
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;"><?=$ptname2;?></div></td>
    <td align="center"><?=$age2;?></td>
    <td align="center"><?=substr($result2['camp'],4);?></td>
    <td align="left"><?=$result2['reason_cxr'];?></td>
  </tr>
<?
}
?>  
</table>
<br>
<div style="page-break-after: always"></div>
<? } ?>
