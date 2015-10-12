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
      <td height="35" class="font1"><strong class="font2">รายงานสถิติการ Refer ผู้ป่วย</strong></td>
    </tr>
    <tr>
      <td height="50" class="font1">เดือน 
      
      <select name="mon">
        <option value="01" <? if(date("m")=="01") echo "selected"; ?>>มกราคม</option>
        <option value="02" <? if(date("m")=="02") echo "selected"; ?>>กุมภาพันธ์</option>
        <option value="03" <? if(date("m")=="03") echo "selected"; ?>>มีนาคม</option>
        <option value="04" <? if(date("m")=="04") echo "selected"; ?>>เมษายน</option>
        <option value="05" <? if(date("m")=="05") echo "selected"; ?>>พฤษภาคม</option>
        <option value="06" <? if(date("m")=="06") echo "selected"; ?>>มิถุนายน</option>
        <option value="07" <? if(date("m")=="07") echo "selected"; ?>>กรกฎาคม</option>
        <option value="08" <? if(date("m")=="08") echo "selected"; ?>>สิงหาคม</option>
        <option value="09" <? if(date("m")=="09") echo "selected"; ?>>กันยายน</option>
        <option value="10" <? if(date("m")=="10") echo "selected"; ?>>ตุลาคม</option>
        <option value="11" <? if(date("m")=="11") echo "selected"; ?>>พฤศจิกายน</option>
        <option value="12" <? if(date("m")=="12") echo "selected"; ?>>ธันวาคม</option>
      </select> 
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
      ถึง 
      <select name="mon2">
        <option value="01" <? if(date("m")=="01") echo "selected"; ?>>มกราคม</option>
        <option value="02" <? if(date("m")=="02") echo "selected"; ?>>กุมภาพันธ์</option>
        <option value="03" <? if(date("m")=="03") echo "selected"; ?>>มีนาคม</option>
        <option value="04" <? if(date("m")=="04") echo "selected"; ?>>เมษายน</option>
        <option value="05" <? if(date("m")=="05") echo "selected"; ?>>พฤษภาคม</option>
        <option value="06" <? if(date("m")=="06") echo "selected"; ?>>มิถุนายน</option>
        <option value="07" <? if(date("m")=="07") echo "selected"; ?>>กรกฎาคม</option>
        <option value="08" <? if(date("m")=="08") echo "selected"; ?>>สิงหาคม</option>
        <option value="09" <? if(date("m")=="09") echo "selected"; ?>>กันยายน</option>
        <option value="10" <? if(date("m")=="10") echo "selected"; ?>>ตุลาคม</option>
        <option value="11" <? if(date("m")=="11") echo "selected"; ?>>พฤศจิกายน</option>
        <option value="12" <? if(date("m")=="12") echo "selected"; ?>>ธันวาคม</option>
      </select> 
      ปี 
      <select name="yr2">
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
       หน่วยงาน 
       <select name="position">
         <option value="ER">ER</option>
         <option value="opd">OPD</option>
         <option value="Ward42">หอผู้ป่วยรวม</option>
         <option value="Ward45">หอผู้ป่วยพิเศษ</option>
         <option value="Ward44">หอผู้ป่วยหนัก</option>
         <option value="Ward43">หอผู้ป่วยสูติ</option>
      </select></td>
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
	
	
	$date1=$_POST['yr'].'-'.$_POST['mon'].'-'.'01 00:00:00';
	$date2=$_POST['yr2'].'-'.$_POST['mon2'].'-'.'31 23:59:59';
	?>
</span>
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
	$sql = "select * from refer where dateopd  between  '$date1' and '$date2'  and ward like '".$_POST['position']."%' order by dateopd asc,refer_runno asc ";
	$rows = mysql_query($sql);
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