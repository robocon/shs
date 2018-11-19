<?
session_start();
include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?
if(!isset($_POST['search'])){
?>

<form action="<? $_SERVER['PHP_SELF']?>" name="f1" method="post" target="_blank">
<table width="100%">
	<tr><td align="center" class="font1"><strong>รายงานประจำเดือน</strong></td>
	</tr>
    <tr>
      <td align="center" class="style1">
      ปี
      <select name="yr" class="forntsarabun">
            <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
            <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
            <?=$a?>
            </option>
            <?
	}
	?>
          </select>
          &nbsp;&nbsp; <span class="font1">
          <input name="search" type="submit" class="forntsarabun" value="  ตกลง  " style="font:TH SarabunPSK"/>
          </span></td>
</tr>
      <tr>
  <td align="center" class="font1">&nbsp;</td>
</tr> 
</table>
</form>
<hr />
<?
}
?>
<div align="center"><strong>รายงานผลการปฏิบัติงานของศูนย์บริการคอมพิวเตอร์</strong></div>
<div align="center">เริ่มโปรแกรมเมื่อวันที่ 1 เดือนมิถุนายน พ.ศ.2561</div>
<table width="90%" border="1" align="center" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="11%" rowspan="2" align="center" bgcolor="#66CC99"><strong>เดือน/ปี</strong></td>
    <td colspan="3" align="center" bgcolor="#66CC99"><strong>ใบงานทั้งหมด</strong></td>
    <td colspan="2" align="center" bgcolor="#66CC99"><strong>รอดำเนินการ</strong></td>
    <td colspan="2" align="center" bgcolor="#66CC99"><strong>อยู่ระหว่างดำเนินการ</strong></td>
    <td colspan="2" align="center" bgcolor="#66CC99"><strong>เสร็จสิ้น</strong></td>
  </tr>
  <tr>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>Hardware</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>Software</strong></td>
    <td width="14%" align="center" bgcolor="#66CC99"><strong>รวมทั้งสิ้น</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>ร้อยละ</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ร้อยละ</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>ร้อยละ</strong></td>
  </tr>
<?
$sql="select date from  com_support where date like '".$_POST['yr']."%' group by substring(date,1,7)";
//echo $sql;
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
$year=substr($rows["date"],0,4);
$mount=substr($rows["date"],5,2);
$thaidate=$mount."/".$year;
$chkdate=$year."-".$mount;
?>  

  <tr>
    <td align="center"><?=$thaidate;?></td>
	<?
    $rsql="select * from  com_support where jobtype='hardware' and date like '$chkdate%' and (status !='c' and status !='w')";
    $rquery=mysql_query($rsql);
	$rnum=mysql_num_rows($rquery);
    ?>    
	<td align="center"><?=$rnum;?></td>
	<?
    $dsql="select * from  com_support where jobtype='software' and date like '$chkdate%' and (status !='c' and status !='w')";
    $dquery=mysql_query($dsql);
	$dnum=mysql_num_rows($dquery);
    ?>       
	<td align="center"><?=$dnum;?></td>
	<?
    $csql="select * from  com_support where date like '$chkdate%' and (status !='c' and status !='w')";
    $cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
    ?>         
    <td align="center"><?=$cnum;?></td>    
	<?
    $ysql="select * from  com_support where date like '$chkdate%' and status ='y'";
    $yquery=mysql_query($ysql);
	$ynum=mysql_num_rows($yquery);
	$yper=$ynum*100/$cnum;
	$yper=number_format($yper,2);	
    ?>     
    <td align="center"><?=$ynum;?></td>
	<td align="center"><?=$yper;?></td>
	<?
    $asql="select * from  com_support where date like '$chkdate%' and programmer !='เพลิงพายุ' and status ='a'";
    $aquery=mysql_query($asql);
	$anum=mysql_num_rows($aquery);
	$aper=$anum*100/$cnum;
	$aper=number_format($aper,2);	
    ?>     
    <td align="center"><?=$anum;?></td>
	<td align="center"><?=$aper;?></td>
	<?
    $nsql="select * from  com_support where date like '$chkdate%' and status ='n'";
	//echo $nsql;
    $nquery=mysql_query($nsql);
	$nnum=mysql_num_rows($nquery);
	$nper=$nnum*100/$cnum;
	$nper=number_format($nper,2);
    ?>     
    <td align="center"><?=$nnum;?></td>
    <td align="center"><?=$nper;?></td>
    <?
	$total=(($anum+$nnum)*100)/$cnum;
	//echo "$anum+$nnum/$cnum";
	?>
  </tr>
<?
}
?>  
</table>
