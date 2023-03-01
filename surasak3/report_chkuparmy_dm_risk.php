<?
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?
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
		$nPrefix2="25".$nPrefix;
?>
<p align="center" style="margin-top: 20px;"><strong>รายงานผลการตรวจสุขภาพประจำปีกองทัพบก กลุ่มที่มีน้ำตาลในเลือดสูงผิดปกติ</strong></p>	
<form name="form1" method="post" action="report_chkuparmy_dm_risk.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">ปีงบประมาณ&nbsp;&nbsp;
    <? 
			   $Y=date("Y")+543;
			   $Y=$Y;
			   $date=date("Y")+543;
			  
				$dates=range(2560,$date+1);
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
	&nbsp;&nbsp;หน่วย :
        <label>      
        <select name="camp" id="camp" class="txtsarabun">
          <option value="all" selected>ทุกหน่วย</option>
		 <?
		 $sql="select distinct(camp) as camp from condxofyear_so where `yearcheck` = '$nPrefix2' and camp NOT LIKE 'M07%'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=$rows["camp"];
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <span style="margin-left:5px;"><input type="submit" name="button" id="button" class="txtsarabun" value="ดูรายงาน"></span>
        </label></td>
    </tr>
  </table>
</form>	
<?php
if($_POST["act"]=="show"){
	if($_POST["camp"]=="all"){
		$sql="select * from condxofyear_so where yearcheck='".$_POST["year1"]."' and (stat_bs ='ผิดปกติ') and camp NOT LIKE 'M07%' group by hn order by camp, age, row_id desc";
	}else{
		$sql="select * from condxofyear_so where yearcheck='".$_POST["year1"]."' and (stat_bs ='ผิดปกติ')  and camp NOT LIKE 'M07%' and camp='".$_POST["camp"]."' group by hn order by camp, age, row_id desc";
	}
	//echo $sql;
	$query=mysql_query($sql);	
?>	
<p align="center" style="margin-top: 20px;"><strong>รายงานผลการตรวจสุขภาพประจำปีกองทัพบก กลุ่มที่มีน้ำตาลในเลือดสูงผิดปกติ ปี <?=$_POST["year1"];?></strong></p>
<div align="center">
<table width="95%" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor="#000000">

  <tr>
    <td width="3%" align="center"><strong>ลำดับ</strong></td>
    <td width="3%" align="center"><strong>HN</strong></td>
    <td width="15%" align="center"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="6%" align="center"><strong>สังกัด/หน่วย</strong></td>
    <td width="4%" align="center"><strong>อายุ</strong></td>
    <td width="9%" align="center"><strong>ประวัติโรคประจำตัว</strong></td>
	<td width="9%" align="center"><strong>น้ำตาลในเลือด (BS)</strong></td>
	<td width="5%" align="center"><strong>วันที่นัดพบแพทย์</strong></td>
	<td width="5%" align="center"><strong>รายละเอียด</strong></td>	
  </tr>
  
<?
$i=0;
while($rows=mysql_fetch_array($query)){



if($rows["prawat"]=="0"){ $prawat="ไม่มีโรคประจำตัว";}else if($rows["prawat"]=="1"){ $prawat="ความดันโลหิตสูง";}else if($rows["prawat"]=="2"){ $prawat="เบาหวาน";}else if($rows["prawat"]=="3"){ $prawat="โรคหัวใจและหลอดเลือด";}else if($rows["prawat"]=="4"){ $prawat="ไขมันในเลือดสูง";}else if($rows["prawat"]=="5"){ $prawat="โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}else if($rows["prawat"]=="6"){ $prawat="โรคประจำตัวอื่นๆ";}else if($rows["prawat"]=="7"){ $prawat="โรคเก๊าท์";}else if($rows["prawat"]=="8"){ $prawat="โรคถุงลมโป่งพอง";}





				

	$thidate=substr($rows["thidate"],0,10);
	list($y,$m,$d)=explode("-",$thidate);
	$y=$y+543;
	$chkdate="$y-$m-$d";
	
	$opsql="select appdate,detail2 from appoint where date LIKE '$chkdate%' and hn='$rows[hn]' and apptime !='ยกเลิกการนัด'  order by row_id desc limit 1 ";
	//echo $opsql."<br>";
	$opquery=mysql_query($opsql);
	list($appdate,$detail2)=mysql_fetch_row($opquery);	
	
		$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["camp"];?></td>
    <td><?=$rows["age"];?></td>
	<td><?=$prawat;?></td>
	<td align="center"><?=$rows["bs"];?></td>
	<td align="center"><?=$appdate;?></td>	
	<td align="center"><?=$detail2;?></td>	
  </tr>
  <?
  }
  ?>
</table>

</div>
<?php
	}
?>
