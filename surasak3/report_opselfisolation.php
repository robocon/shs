<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
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
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>ข้อมูลผู้ป่วยโควิด เข้ารับการรักษากรณี OP Self Isolation (ผู้ป่วยนอก)</strong></div>
<div align="center"><strong>ข้อมูลเฉพาะที่มีการคิดค่ารักษาพยาบาลแบบเหมาจ่าย 1000 บาท/300 บาท</strong></div>


<div align="center">
<form method="POST" action="report_opselfisolation.php">
<input type="hidden" name="act" value="show" />
<p><strong>เลือกจำนวนเงิน : </strong>
	<select size="1" name="typeprice" class="txt">
    <option value="all" selected>---------------------เลือก---------------------</option>
	<option value="1000">ค่ารักษาพยาบาลแบบเหมาจ่าย 1000 บาท</option>
	<option value="600">ค่ารักษาพยาบาลแบบเหมาจ่าย 600 บาท</option>
    <option value="300">ค่าติดตามอาการหลัง 48 ชั่วโมง 300 บาท</option>
	</select> </p>
	<strong>ระหว่างวันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month1" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>ถึงวันที่</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month2" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
       &nbsp;&nbsp;
       <input type="button" value="ไปเมนูหลัก" name="B2"  class="txt" onclick="window.location='../nindex.htm' " />
</form>
</div>
<?
if($_POST["act"]=="show"){
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<hr />
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลผู้ป่วยโควิด เข้ารับการรักษากรณี OP Self Isolation (ผู้ป่วยนอก)</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="2%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ชื่อผู้ป่วย</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
	<td width="30%" align="center" bgcolor="#66CC99"><strong>ค่ารักษาพยาบาลแบบเหมาจ่าย</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ผู้บันทึก<br>ค่ารักษาพยาบาล</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>ลูกหนี้กองทุน</strong></td>
	<td width="10%" align="center" bgcolor="#66CC99"><strong>ผู้บันทึก<br>ลูกหนี้กองทุน</strong></td>
	<td width="5%" align="center" bgcolor="#66CC99"><strong>ประเภทผู้ป่วย</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ผู้บันทึก<br>ประเภทผู้ป่วย</strong></td>
  </tr>
<?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";

//$sql="select * from opday where (thidate >= '$chkdate1' and thidate <='$chkdate2') and opdtype='SI' order by thidate asc";
if($_POST["typeprice"]=="1000"){
	$sql="SELECT date, hn, ptname, code, detail, sum(amount) as amount,sum(price) as price,idno from patdata where (date >= '$chkdate1' and date <='$chkdate2') and (code='COVR22' || code='9902') and price=1000 and amount >0 and price >0 group by idno order by date,hn,code asc";
}else if($_POST["typeprice"]=="600"){
	$sql="SELECT date, hn, ptname, code, detail, sum(amount) as amount,sum(price) as price,idno from patdata where (date >= '$chkdate1' and date <='$chkdate2') and (code='COVR22' || code='9902') and price=600 and amount >0 and price >0 group by idno order by date,hn,code asc";
}else if($_POST["typeprice"]=="300"){
	$sql="SELECT date, hn, ptname, code, detail, sum(amount) as amount,sum(price) as price,idno from patdata where (date >= '$chkdate1' and date <='$chkdate2') and (code='COVR23' || code='55080') and amount >0 and price >0 group by idno order by date,hn,code asc";
}else{
	$sql="SELECT date, hn, ptname, code, detail, sum(amount) as amount,sum(price) as price,idno from patdata where (date >= '$chkdate1' and date <='$chkdate2') and (code='COVR22' || code='COVR23' || code='9902' || code='55080') and amount >0 and price >0 group by idno order by date,hn,code asc";
}
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
	$i++;
	$hn=$rows["hn"];
	$ptname=$rows["ptname"];
	$date=$rows["date"];
	$chkdate=substr($rows["date"],0,10);
	$idno=$rows["idno"];
	
	
$sql102 = "Select vn,ptright,opdtype From opday where hn = '$hn' and thidate like '$chkdate%' limit 1";
//echo $sql102."<br>" ;
$result102 = Mysql_Query($sql102);
list($vn,$ptright,$opdtype) = Mysql_fetch_row($result102);

$sql103 = "Select idname From depart where hn = '$hn' and date like '$chkdate%' and row_id='$idno' limit 1";
//echo $sql103."<br>" ;
$result103 = Mysql_Query($sql103);
list($idname) = Mysql_fetch_row($result103);

$sql104 = "Select officer From opd where hn = '$hn' and thidate like '$chkdate%' limit 1";
//echo $sql104."<br>" ;
$result104 = Mysql_Query($sql104);
list($officer) = Mysql_fetch_row($result104);

$sql105 = "Select credit,idname From opacc where hn = '$hn' and txdate ='$date' order by row_id desc limit 1";
//echo $sql105."<br>" ;
$result105 = Mysql_Query($sql105);
list($credit,$idnamemon) = Mysql_fetch_row($result105);

?>  
  <tr bgcolor="<?=$bg;?>">
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["date"]?></td>
    <td align="center"><?=$vn;?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td><?=$ptname;?></td>
	<td align="center"><?=$ptright;?></td>
	<td align="left">
	<?
		$sql1="select code,detail,sum(amount) as amount,sum(price) as price from patdata where hn='$hn' and date like '$chkdate%' and (code='COVR22' || code='COVR23' || code='9902' || code='55080') group by code HAVING sum(amount) > 0 order by code  asc";

		//echo $sql1;
		$query1=mysql_query($sql1);
		$j=0;
		while($rows1=mysql_fetch_array($query1)){
			$j++;
			if($rows1["price"]==1000){
				$margin="margin-left:20px;";
			}else{
				//echo $price;
				$margin="margin-left:90px;";
			}
			$code=$rows1["code"];
			$detail=$rows1["detail"];
			$price=$rows1["price"];
			echo "<div>$code : $detail <span style='$margin'>$price</span></div>";
		}
	?>
	</td>	
	<td align="center"><?=$idname;?></td>
	<td align="center"><?=$credit;?></td>
	<td align="center"><?=$idnamemon;?></td>
	<td align="center"><?=$opdtype;?></td>
	<td align="center"><?=$officer;?></td>	
  </tr>
<?
}
?>  
<?
}

?>