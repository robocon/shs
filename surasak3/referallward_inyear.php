<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
}
.font2 {
	font-size: 24px;
}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
window.open(theURL,winName,features);
}
//-->
</script>
<form name="form1" method="post" action="">
<a target=_self  href='../nindex.htm'><<ไปเมนู</a>
  <table width="80%" border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td height="35" class="font1"><strong class="font2">รายงานสถิติการ Refer ผู้ป่วย (ทหาร/ครอบครัว)</strong></td>
    </tr>
    <tr>
      <td height="50" class="font1"> 
      ปี 
      <select name="yr">
        <?
        for($i=date("Y")+538;$i<=date("Y")+548;$i++){
		?>
        <option value="<?=$i?>" <? if($i==date("Y")+543) echo "selected"; ?>>
          <?=$i?>
          </option>
        <?
		}
		?>
      </select>
      </td>
    </tr>
    <tr>
      <td height="38" class="font1">
        <input type="submit" name="search" id="search" value="    ค้นหา    ">
      </td>
    </tr>
  </table>
</form>
<span class="font1">
<?
include("connect.inc");
if(isset($_POST['search'])){
	
	$year = $_POST['yr'];
  
	$date1=$_POST['yr'].'-'.$_POST['mon'].'-'.'01 00:00:00';
	$date2=$_POST['yr2'].'-'.$_POST['mon2'].'-'.'31 23:59:59';
	?>
</span>

<?php 
  // $sql = "select * from refer where dateopd  between  '$date1' and '$date2'  and ward like '".$_POST['position']."%' order by dateopd asc,refer_runno asc ";
  $sql = "
  SELECT a.*
  FROM `refer` AS a 
  LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
  WHERE a.`dateopd` LIKE '$year%' 
  AND b.`typeservice` LIKE 'TS01%' 
  ORDER BY a.`dateopd` ASC , a.`refer_runno` ASC
  ";
  $rows = mysql_query($sql);
  
  $num_rows = mysql_num_rows($rows);
  if( $num_rows === 0 ){
    echo "ปี $year ที่เลือก ยังไม่มีข้อมูลผู้ป่วย refer กรุณาเลือกปีในการแสดงผลใหม่อีกครั้ง";
    exit;
  }
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0"><tr>
  <td width="3%" align="center" class="font1"><strong>ลำดับ</strong></td>
  <td width="7%" align="center" class="font1"><strong>เลขที่ส่งต่อ</strong></td>
  <td width="9%" align="center" class="font1"><strong>วัน-เวลา</strong></td>
  <td width="8%" align="center" class="font1"><strong>HN</strong></td>
  <td width="15%" align="center" class="font1"><strong>ชื่อ - สกุล</strong></td>
  <td width="11%" align="center" class="font1"><strong>อายุ</strong></td>
  <td width="21%" align="center" class="font1"><strong>Diag</strong></td>
  <td width="15%" align="center" class="font1"><strong>สาเหตุ</strong></td>
  <td width="11%" align="center" class="font1"><strong>ส่งต่อโรงพยาบาล</strong></td>
  </tr>
  <?
	while($result = mysql_fetch_array($rows)){
		$k++;
		?>
  <tr><td align="center" class="font1">
    <?=$k?>
    </td>
    <td align="center" class="font1">
     <a href="javascript:MM_openBrWindow('refer_detail.php?runno=<?=$result['refer_runno']?>','','width=700,height=700')"><?=$result['refer_runno']?></a>&nbsp;
    </td>
    <td class="font1">
      <?=$result['dateopd']?>
    </td>
    <td class="font1">
      <?=$result['hn']?>
    </td>
    <td class="font1">
      <?=$result['name']." ".$result['sname']?>
    </td>
    <td class="font1">
      <?=$result['age']?>
    </td>
    <td class="font1">
      <?=substr($result['diag'],2)?>
    </td>
    <td class="font1"><?=$result['exrefer']?></td>
    <td class="font1">
      <?=$result['referh']?>
    </td>
    </tr>
  <?
	}
	?>
</table>
<span class="font1">
<?
}
?>
</span>