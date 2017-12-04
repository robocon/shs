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
<p><strong>รายงานนายพลที่มารับบริการประจำเดือน</strong></p>
<form action="report_opdaychunyot.php" method="post">
<input name="act" type="hidden" value="show">
เลือกเดือน : <select name="m_start" class="forntsarabun">
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
เลือกปี : <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2550,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
&nbsp;&nbsp;
<input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>     
<a href="../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>           
</form>
<?
include("connect.inc");
if($_POST["act"]=="show"){
$date=$_POST["y_start"]."-".$_POST["m_start"];
$showdate=$_POST["m_start"]."/".$_POST["y_start"];
$sql="select * from opday as a inner join opcard as b on a.hn=b.hn where (b.yot='พลตรี' || b.yot='พล.ต.' || b.yot='พลโท' || b.yot='พล.ท.' || b.yot='พลเอก' || b.yot='พล.อ.') and a.thidate like '$date%'";
$query=mysql_query($sql);
?>
<p align="center"><strong>รายงานนายพลที่มารับบริการประจำเดือน <?=$showdate;?></strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="2%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99">date</td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>ยศ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>ptright</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>goup</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>camp</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>toborow</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>diag</strong></td>
  </tr>
<?
$num=mysql_num_rows($query);
if($num < 1){
	echo "<tr align='center'><td colspan='6'>---------------------------------- ไม่พบข้อมูล ----------------------------------</td></tr>";
}
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["thidate"];?></td>
    <td><?=$rows["yot"];?></td>
    <td><?=$rows["name"]."  ".$rows["surname"];?></td>
    <td><?=$rows["ptright"];?></td>
    <td><?=$rows["goup"];?></td>
    <td><?=$rows["camp"];?></td>
    <td><?=$rows["toborow"];?></td>
    <td><?=$rows["diag"];?></td>
  </tr>
<?
}
?>  
</table>


<?
}
?>