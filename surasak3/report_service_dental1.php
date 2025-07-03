<?
session_start();
include("connect.inc");

$showdate=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$doctor=$_POST["doctor"];
$type=$_POST["type"];
if($type=="in_opd"){
	$showtype="ในเวลาราชการ";
}else{
	$showtype="นอกเวลาราชการ";
}

$sqld="select name,doctorcode from doctor where name='$doctor'";
//echo $sqld."<br>";
$queryd=mysql_query($sqld);
list($doctorname,$doctorcode)=mysql_fetch_array($queryd);
$subname=substr($name,0,5);

$sqlm="select name from inputm where codedoctor = '$doctorcode'";
//echo $sqlm;
$querym=mysql_query($sqlm);
list($inputname)=mysql_fetch_array($querym);
//echo $inputname;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>รายงานอัตราค่าบริการทางการแพทย์ ประเภท <?=$showtype;?></strong></div>
<div align="center"><strong>แพทย์ : <?=$doctor;?></strong></div>
<div align="center">วันที่ <?=$showdate;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse: collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
	<td width="7%" align="center" bgcolor="#66CC99"><strong>เวลา</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>รหัส</strong></td>
    <td width="20%" align="center" bgcolor="#66CC99"><strong>รายการ</strong></td>
    <td width="5%" align="center" bgcolor="#85C1E9"><strong>ราคาเต็ม</strong></td>
	<td width="5%" align="center" bgcolor="#82E0AA"><strong>เบิกได้</strong></td>
	<td width="5%" align="center" bgcolor="#F7DC6F"><strong>เบิกไม่ได้</strong></td>
	<td width="8%" align="center" bgcolor="#F1948A"><strong>ค่า DF</strong></td>
  </tr>
<?
$chkdate=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);
$datenum=ceil(($end-$start)/86400)+1;
//echo $datenum;

if($type=="in_opd"){
$sql="select * from depart where (date >= '$chkdate 08:00:00' and date <='$chkdate 15:59:59') and (doctor = '$doctorname' OR doctor = '$inputname') and (an ='' OR an is null) order by date";
}else{
$sql="select * from depart where (date >= '$chkdate 16:00:00' and date <='$chkdate 23:59:59') and (doctor = '$doctorname' OR doctor = '$inputname') and (an !='' OR an is not null) order by date";
}
//echo $sql;
$query=mysql_query($sql);
$i=0;
$sumprice=0;
$sumyprice=0;
$sumnprice=0;
$sumdf=0;
while($rows=mysql_fetch_array($query)){
$i++;
list($date,$time)=explode(" ",$rows["date"]);
?>  
  <tr bgcolor="#ebedef">
    <td align="center" valign="top"><?=$i;?></td>
	<td align="center" valign="top"><?=$time;?></td>
    <td align="center" valign="top"><?=$rows["hn"]?></td>
    <td valign="top"><?=$rows["ptname"]?></td>
    <td valign="top"><?=$rows["ptright"]?></td>
	<td valign="top" align="center" colspan='6'></td>
  </tr>
		<?
		$sql1="select * from patdata where idno='".$rows["row_id"]."'";
		//echo $sql;
		$query1=mysql_query($sql1);	
		$j=0;	
		while($result=mysql_fetch_array($query1)){
			$j++;
			
			$sumdepart=$sumdepart+$result["price"];
			$code=$result["code"];

			$sqllb = "select doctor_free  from labcare where code = '".$code."'";
			//echo $sqllb."<br>";
			$querylb = mysql_query($sqllb);
			list($doctor_free)=mysql_fetch_array($querylb);
			if($doctor_free > 0){
				$df=$doctor_free*$result["amount"];
			}else{
				$df=0;	
			}
							
		?>  
		  <tr>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td valign="top" width="5%" align="center"><?=$result["code"]?></td>
			<td valign="top" width="20%" align="left"><?=$result["detail"]?></td>
			<td valign="top" width="5%" align="right"><?=number_format($result["price"],2);?></td>
			<td valign="top" width="5%" align="right"><?=number_format($result["yprice"],2);?></td>
			<td valign="top" width="5%" align="right"><?=number_format($result["nprice"],2);?></td>
			<td valign="top" width="8%" align="right"><strong><?=number_format($df,2);?></strong></td>
		  </tr> 
		<?
			$sumdf=$sumdf+$df;	
			$sumprice=$sumprice+$result["price"];
			$sumyprice=$sumyprice+$result["yprice"];
			$sumnprice=$sumnprice+$result["nprice"];			
		}
		?>
<?
}
?> 
  <tr>
    <td colspan="7" align="right"><strong>รวมเป็นเงินทั้งสิน</strong></td>
    <td align="right"><?=number_format($sumprice,2);?></td>
	<td align="right"><?=number_format($sumyprice,2);?></td>
	<td align="right"><?=number_format($sumnprice,2);?></td>
	<td align="right"><strong><?=number_format($sumdf,2);?></strong></td>
  </tr> 
</table>
