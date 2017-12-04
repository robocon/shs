<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
include("../connect.inc");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form action="<? $PHP_SELF; ?>" method="post" name="form1" id="form1">
    <tr>
      <td align="right" valign="bottom"><span>หน่วยงาน :</span>
        <select  name="txtcamp">
         <option value="0">---------- เลือก ----------</option>
          <option value="M02">ร.17 พัน2</option>
          <option value="M04">ร.พ.ค่ายสุรศักดิ์มนตรี</option>
          <option value="M05">ช.พัน4</option>
          <option value="M06">ร้อยฝึกรบพิเศษประตูผา</option>
          <option value="M0301">บก.มทบ.32</option>
          <option value="M0302">กกพ.มทบ.32</option>
          <option value="M0303">กขว.,ฝผท.มทบ.32</option>
          <option value="M0304">กยก.มทบ.32</option>
          <option value="M0305">กกบ.มทบ.32</option>
          <option value="M0306">กกร.มทบ.32</option>
          <option value="M0307">ฝคง.มทบ.32</option>
          <option value="M0308">ฝกง.มทบ.32</option>
          <option value="M0309">ฝสก.มทบ.32</option>
          <option value="M0311">ผพธ.มทบ.32</option>
          <option value="อก.ศาล">อก.ศาล มทบ.32</option>
          <option value="ฝสวส">ฝสวส.มทบ.32</option>
          <option value="M0314">ฝธน.มทบ.32</option>
          <option value="M0315">อศจ.มทบ.32</option>
          <option value="M0316">ร้อย.มทบ.32</option>
          <option value="M0317">สขส.มทบ.32</option>
          <option value="รจ">รจ.มทบ.32</option>
          <option value="M0318">ผยย.มทบ.32</option>
          <option value="M0319">ฝสส.มทบ.32</option>
          <option value="M0320">ฝสห.มทบ.32</option>
          <option value="M0321">ร้อย.สห.มทบ.32</option>
          <option value="M0322">มว.ดย.มทบ.32</option>
          <option value="M0323">ผสพ.มทบ.32</option>
          <option value="M0324">สรรพกำลัง มทบ.32</option>
          <option value="M0325">ศฝ.นศท.มทบ.32</option>
          <option value="ศาล.มทบ.32">ศาล.มทบ.32</option>
          <option value="M0327">ศูนย์โทรศัพท์ มทบ.32</option>
          <option value="M0328">ผปบ.มทบ.32</option>
          <option value="M08">สัสดีจังหวัดลำปาง</option>
        </select>
        &nbsp;ปี :
        <select name="year" id="yr">
          <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
          <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
          <?php }?>
        </select>
        <input type="submit" class="formbutton" name="submit" value="ค้นหาข้อมูล" />
        <input type="hidden" name="page" value="1" /></td>
    </tr>
  </form>
</table>
<?
		$sqlcamp="SELECT *
		FROM condxofyear_so
		WHERE camp
		LIKE  '%$_POST[txtcamp]%'";		
		$querycamp=mysql_query($sqlcamp);
		$rowsc=mysql_fetch_array($querycamp);
		$camp = $rowsc["camp"];
?>
<p>&nbsp;</p>
<p><span><strong>จำนวนผู้รับบริการตรวจร่างกายที่พบความผิดปกติอื่นๆ</strong></span> <strong>หน่วยที่มารับการตรวจ
    <? if($_POST["txtcamp"]=="0"){ echo "รวมทุกหน่วย"; }else{ echo $camp; }?>
</strong></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="3" align="center" valign="middle"><strong>ลำดับ</strong></td>
    <td width="31%" rowspan="3" align="center" valign="middle"><strong>รพ.ทบ.</strong></td>
    <td colspan="4" align="center" valign="middle"><strong>จำนวนผู้รับบริการตรวจร่างกายที่พบโรคอื่นๆ (ราย)</strong></td>
  </tr>
  <tr>
    <td width="22%" rowspan="2" align="center" valign="middle"><strong>อายุไม่เกิน ๓๕ ปีบริบูรณ์</strong></td>
    <td width="21%" rowspan="2" align="center" valign="middle"><strong>อายุมากกว่า ๓๕ ปีบริบูรณ์</strong></td>
    <td colspan="2" align="center" valign="middle"><strong>จำนวนทั้งหมด</strong></td>
  </tr>
  <tr>
    <td width="13%" align="center" valign="middle"><strong>จำนวน (ราย)</strong></td>
    <td width="8%" align="center" valign="middle"><strong>ร้อยละ</strong></td>
  </tr>
  <tr>
    <td align="center" valign="middle">1</td>
    <td align="left" valign="middle">ความดันโลหิตสูง (HT)<br>
      (BP &gt; 140/90 mm/Hg)</td>
    <td align="center" valign="middle">
    <?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (bp1 >= 140 AND bp2 >= 90)";		
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (bp1 >= 140 AND bp2 >= 90)";		
	}
		$query=mysql_query($sql);
		$numht1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numht1 += $personal;	
			}
		}
		echo $numht1;	
	?>    </td>
    <td align="center" valign="middle">
        <?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bp1 >= 140 AND bp2 >= 90)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bp1 >= 140 AND bp2 >= 90)";		
		}
		$query=mysql_query($sql);
		$numht2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numht2 +=  $personal;
						
			}
		}
		echo $numht2;
	?>    </td>
    <td align="center" valign="middle">
         <?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bp1 >= 140 AND bp2 >= 90)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bp1 >= 140 AND bp2 >= 90)";		
		}
		$query=mysql_query($sql);
		$numht=mysql_num_rows($query);
		echo $numht;
	?>    </td>
    <td align="center" valign="middle">
        <?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num1=mysql_num_rows($query);
		$sum1=$numht*100/$num1;
		echo number_format($sum1,2);
		?>    </td>
  </tr>
  <tr>
    <td align="center" valign="middle">2</td>
    <td align="left" valign="middle">เบาหวาน (DM)<br>
      (FBS &gt;= 126 mg%)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (bs >125)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (bs >125)";		
	}
		$query=mysql_query($sql);
		$numbs1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numbs1 += $personal;	
			}
		}
		echo $numbs1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bs >125)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bs >125)";
		}
		$query=mysql_query($sql);
		$numbs2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numbs2 +=  $personal;
						
			}
		}
		echo $numbs2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bs >125)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bs >125)";
		}
		$query=mysql_query($sql);
		$numbs=mysql_num_rows($query);
		echo $numbs;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num2=mysql_num_rows($query);
		$sum2=$numbs*100/$num2;
		echo number_format($sum2,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">3</td>
    <td align="left" valign="middle">ไขมันในเลือดสูง<br>
      3.1 Chol &gt;= 240</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (chol >239)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (chol >239)";		
	}
		$query=mysql_query($sql);
		$numchol1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numchol1 += $personal;	
			}
		}
		echo $numchol1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (chol >239)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (chol >239)";
		}
		$query=mysql_query($sql);
		$numchol2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numchol2 +=  $personal;
						
			}
		}
		echo $numchol2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (chol >239)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (chol >239)";
		}
		$query=mysql_query($sql);
		$numchol=mysql_num_rows($query);
		echo $numchol;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num3=mysql_num_rows($query);
		$sum3=$numchol*100/$num3;
		echo number_format($sum3,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">3.2 TG &gt;= 200</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (tg >199)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (tg >199)";		
	}
		$query=mysql_query($sql);
		$numtg1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numtg1 += $personal;	
			}
		}
		echo $numtg1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (tg >199)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (tg >199)";
		}
		$query=mysql_query($sql);
		$numtg2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numtg2 +=  $personal;
						
			}
		}
		echo $numtg2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (tg >199)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (tg >199)";
		}
		$query=mysql_query($sql);
		$numtg=mysql_num_rows($query);
		echo $numtg;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num4=mysql_num_rows($query);
		$sum4=$numtg*100/$num4;
		echo number_format($sum4,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">3.3 Chol &gt;= 240 และ TG &gt;= 200</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (chol >239 AND tg >199)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (chol >239 AND tg >199)";		
	}
		$query=mysql_query($sql);
		$numchtg1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numchtg1 += $personal;	
			}
		}
		echo $numchtg1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (chol >239 AND tg >199)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (chol >239 AND tg >199)";
		}
		$query=mysql_query($sql);
		$numchtg2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numchtg2 +=  $personal;
						
			}
		}
		echo $numchtg2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (chol >239 AND tg >199)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (chol >239 AND tg >199)";
		}
		$query=mysql_query($sql);
		$numchtg=mysql_num_rows($query);
		echo $numchtg;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num5=mysql_num_rows($query);
		$sum5=$numchtg*100/$num5;
		echo number_format($sum5,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">4</td>
    <td align="left" valign="middle">โลหิตจาง (Anemia)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (anemia ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (anemia ='Y')";		
	}
		$query=mysql_query($sql);
		$numcirr1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcirr1 += $personal;	
			}
		}
		echo $numcirr1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (anemia ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (anemia ='Y')";
		}
		$query=mysql_query($sql);
		$numcirr2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcirr2 +=  $personal;
						
			}
		}
		echo $numcirr2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (anemia ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (anemia ='Y')";
		}
		$query=mysql_query($sql);
		$numcirr=mysql_num_rows($query);
		echo $numcirr;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num6=mysql_num_rows($query);
		$sum6=$numcirr*100/$num6;
		echo number_format($sum6,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">5</td>
    <td align="left" valign="middle">ตับแข็ง (Cirrhosis)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (cirrhosis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (cirrhosis ='Y')";		
	}
		$query=mysql_query($sql);
		$numcirr1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcirr1 += $personal;	
			}
		}
		echo $numcirr1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cirrhosis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cirrhosis ='Y')";
		}
		$query=mysql_query($sql);
		$numcirr2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcirr2 +=  $personal;
						
			}
		}
		echo $numcirr2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cirrhosis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cirrhosis ='Y')";
		}
		$query=mysql_query($sql);
		$numcirr=mysql_num_rows($query);
		echo $numcirr;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num7=mysql_num_rows($query);
		$sum7=$numcirr*100/$num7;
		echo number_format($sum7,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">6</td>
    <td align="left" valign="middle">โรคตับอักเสบ (Hepatitis)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (hepatitis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (hepatitis ='Y')";		
	}
		$query=mysql_query($sql);
		$numhep1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numhep1 += $personal;	
			}
		}
		echo $numhep1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (hepatitis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (hepatitis ='Y')";
		}
		$query=mysql_query($sql);
		$numhep2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numhep2 +=  $personal;
						
			}
		}
		echo $numhep2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (hepatitis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (hepatitis ='Y')";
		}
		$query=mysql_query($sql);
		$numhep=mysql_num_rows($query);
		echo $numhep;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num8=mysql_num_rows($query);
		$sum8=$numhep*100/$num8;
		echo number_format($sum8,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">7</td>
    <td align="left" valign="middle">การทำงานของตับผิดปกติ<br />
    7.1 SGOT &gt;= 80 u/l</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (sgot >79)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (sgot >79)";		
	}
		$query=mysql_query($sql);
		$numsgot1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numsgot1 += $personal;	
			}
		}
		echo $numsgot1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgot >79)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgot >79)";
		}
		$query=mysql_query($sql);
		$numsgot2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numsgot2 +=  $personal;
						
			}
		}
		echo $numsgot2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgot >79)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgot >79)";
		}
		$query=mysql_query($sql);
		$numsgot=mysql_num_rows($query);
		echo $numsgot;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num9=mysql_num_rows($query);
		$sum9=$numsgot*100/$num9;
		echo number_format($sum9,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">7.2 SGPT &gt;= 80 u/l</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (sgpt >79)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (sgpt >79)";		
	}
		$query=mysql_query($sql);
		$numsgpt1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numsgpt1 += $personal;	
			}
		}
		echo $numsgpt1;	
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgpt >79)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgpt >79)";
		}
		$query=mysql_query($sql);
		$numsgpt2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numsgpt2 +=  $personal;
						
			}
		}
		echo $numsgpt2;
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgpt >79)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgpt >79)";
		}
		$query=mysql_query($sql);
		$numsgpt=mysql_num_rows($query);
		echo $numsgpt;
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num10=mysql_num_rows($query);
		$sum10=$numsgpt*100/$num10;
		echo number_format($sum10,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="left" valign="middle">7.3 SGOT &gt;= 80 u/l และ SGPT &gt;= 80 u/l</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (sgot >79 AND sgpt >79)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (sgot >79 AND sgpt >79)";		
	}
		$query=mysql_query($sql);
		$numotpt1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numotpt1 += $personal;	
			}
		}
		echo $numotpt1;	
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgot >79 AND sgpt >79)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgot >79 AND sgpt >79)";
		}
		$query=mysql_query($sql);
		$numotpt2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numotpt2 +=  $personal;
						
			}
		}
		echo $numotpt2;
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (sgot >79 AND sgpt >79)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (sgot >79 AND sgpt >79)";
		}
		$query=mysql_query($sql);
		$numotpt=mysql_num_rows($query);
		echo $numotpt;
	?></td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num11=mysql_num_rows($query);
		$sum11=$numotpt*100/$num11;
		echo number_format($sum11,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">8</td>
    <td align="left" valign="middle">หัวใจโต</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (cardiomegaly ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (cardiomegaly ='Y')";		
	}
		$query=mysql_query($sql);
		$numcar1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcar1 += $personal;	
			}
		}
		echo $numcar1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cardiomegaly ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cardiomegaly ='Y')";
		}
		$query=mysql_query($sql);
		$numcar2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcar2 +=  $personal;
						
			}
		}
		echo $numcar2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cardiomegaly ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cardiomegaly ='Y')";
		}
		$query=mysql_query($sql);
		$numcar=mysql_num_rows($query);
		echo $numcar;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num12=mysql_num_rows($query);
		$sum12=$numcar*100/$num12;
		echo number_format($sum12,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">9</td>
    <td align="left" valign="middle">ภูมิแพ้</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (allergy ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (allergy ='Y')";		
	}
		$query=mysql_query($sql);
		$numalle1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numalle1 += $personal;	
			}
		}
		echo $numalle1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (allergy ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (allergy ='Y')";
		}
		$query=mysql_query($sql);
		$numalle2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numalle2 +=  $personal;
						
			}
		}
		echo $numalle2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (allergy ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (allergy ='Y')";
		}
		$query=mysql_query($sql);
		$numalle=mysql_num_rows($query);
		echo $numalle;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num13=mysql_num_rows($query);
		$sum13=$numalle*100/$num13;
		echo number_format($sum13,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">10</td>
    <td align="left" valign="middle">โรคเก๊าท์ (Gout)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (gout ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (gout ='Y')";		
	}
		$query=mysql_query($sql);
		$numgout1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numgout1 += $personal;	
			}
		}
		echo $numgout1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (gout ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (gout ='Y')";
		}
		$query=mysql_query($sql);
		$numgout2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numgout2 +=  $personal;
						
			}
		}
		echo $numgout2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (gout ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (gout ='Y')";
		}
		$query=mysql_query($sql);
		$numgout=mysql_num_rows($query);
		echo $numgout;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num14=mysql_num_rows($query);
		$sum14=$numgout*100/$num14;
		echo number_format($sum14,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">11</td>
    <td align="left" valign="middle">น้ำหนักเกิน (BMI 25.1-29.9)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (bmi >25 AND bmi <30)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (bmi >25 AND bmi <30)";		
	}
		$query=mysql_query($sql);
		$numbmi1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numbmi1 += $personal;	
			}
		}
		echo $numbmi1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bmi >25 AND bmi <30)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bmi >25 AND bmi <30)";
		}
		$query=mysql_query($sql);
		$numbmi2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numbmi2 +=  $personal;
						
			}
		}
		echo $numbmi2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bmi >25 AND bmi <30)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bmi >25 AND bmi <30)";
		}
		$query=mysql_query($sql);
		$numbmi=mysql_num_rows($query);
		echo $numbmi;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num15=mysql_num_rows($query);
		$sum15=$numbmi*100/$num15;
		echo number_format($sum15,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">12</td>
    <td align="left" valign="middle">โรคอ้วน (Obesity) (BMI &gt; 30)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (bmi >30)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (bmi >30)";		
	}
		$query=mysql_query($sql);
		$numobes1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numobes1 += $personal;	
			}
		}
		echo $numobes1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bmi >30)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bmi >30)";
		}
		$query=mysql_query($sql);
		$numobes2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numobes2 +=  $personal;
						
			}
		}
		echo $numobes2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bmi >30)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bmi >30)";
		}
		$query=mysql_query($sql);
		$numobes=mysql_num_rows($query);
		echo $numobes;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num16=mysql_num_rows($query);
		$sum16=$numobes*100/$num16;
		echo number_format($sum16,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">13</td>
    <td align="left" valign="middle">รอบเอวเกิน<br />
      (ชาย &gt; 90 ซ.ม., หญิง &gt; 80 ซ.ม.)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (round_ >90)";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (round_ >90)";		
	}
		$query=mysql_query($sql);
		$numround1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numround1 += $personal;	
			}
		}
		echo $numround1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (round_ >90)";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (round_ >90)";
		}
		$query=mysql_query($sql);
		$numround2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numround2 +=  $personal;
						
			}
		}
		echo $numround2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (round_ >90)";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (round_ >90)";
		}
		$query=mysql_query($sql);
		$numround=mysql_num_rows($query);
		echo $numround;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num17=mysql_num_rows($query);
		$sum17=$numround*100/$num17;
		echo number_format($sum17,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">14</td>
    <td align="left" valign="middle">หอบหืด (Asthma)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (asthma ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (asthma ='Y')";		
	}
		$query=mysql_query($sql);
		$numasth1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numasth1 += $personal;	
			}
		}
		echo $numasth1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (asthma ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (asthma ='Y')";
		}
		$query=mysql_query($sql);
		$numasth2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numasth2 +=  $personal;
						
			}
		}
		echo $numasth2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (asthma ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (asthma ='Y')";
		}
		$query=mysql_query($sql);
		$numasth=mysql_num_rows($query);
		echo $numasth;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num18=mysql_num_rows($query);
		$sum18=$numasth*100/$num18;
		echo number_format($sum18,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">15</td>
    <td align="left" valign="middle">กล้ามเนื้ออักเสบ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (muscle ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (muscle ='Y')";		
	}
		$query=mysql_query($sql);
		$nummusc1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$nummusc1 += $personal;	
			}
		}
		echo $nummusc1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (muscle ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (muscle ='Y')";
		}
		$query=mysql_query($sql);
		$nummusc2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$nummusc2 +=  $personal;
						
			}
		}
		echo $nummusc2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (muscle ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (muscle ='Y')";
		}
		$query=mysql_query($sql);
		$nummusc=mysql_num_rows($query);
		echo $nummusc;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num19=mysql_num_rows($query);
		$sum19=$nummusc*100/$num19;
		echo number_format($sum19,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">16</td>
    <td align="left" valign="middle">โรคหัวใจขาดเลือดเรื้อรัง (IHD)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (ihd ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (ihd ='Y')";		
	}
		$query=mysql_query($sql);
		$numihd1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numihd1 += $personal;	
			}
		}
		echo $numihd1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (ihd ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (ihd ='Y')";
		}
		$query=mysql_query($sql);
		$numihd2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numihd2 +=  $personal;
						
			}
		}
		echo $numihd2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (ihd ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (ihd ='Y')";
		}
		$query=mysql_query($sql);
		$numihd=mysql_num_rows($query);
		echo $numihd;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num20=mysql_num_rows($query);
		$sum20=$numihd*100/$num20;
		echo number_format($sum20,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">17</td>
    <td align="left" valign="middle">ไทรอยด์</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (thyroid ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (thyroid ='Y')";		
	}
		$query=mysql_query($sql);
		$numthy1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numthy1 += $personal;	
			}
		}
		echo $numthy1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (thyroid ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (thyroid ='Y')";
		}
		$query=mysql_query($sql);
		$numthy2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numthy2 +=  $personal;
						
			}
		}
		echo $numthy2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (thyroid ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (thyroid ='Y')";
		}
		$query=mysql_query($sql);
		$numthy=mysql_num_rows($query);
		echo $numthy;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num21=mysql_num_rows($query);
		$sum21=$numthy*100/$num21;
		echo number_format($sum21,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">18</td>
    <td align="left" valign="middle">โรคหัวใจ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (heart ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (heart ='Y')";		
	}
		$query=mysql_query($sql);
		$numheart1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numheart1 += $personal;	
			}
		}
		echo $numheart1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (heart ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (heart ='Y')";
		}
		$query=mysql_query($sql);
		$numheart2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numheart2 +=  $personal;
						
			}
		}
		echo $numheart2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (heart ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (heart ='Y')";
		}
		$query=mysql_query($sql);
		$numheart=mysql_num_rows($query);
		echo $numheart;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num22=mysql_num_rows($query);
		$sum22=$numheart*100/$num22;
		echo number_format($sum22,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">19</td>
    <td align="left" valign="middle">ถุงลมโป่งพอง</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (emphysema ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (emphysema ='Y')";		
	}
		$query=mysql_query($sql);
		$numemph1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numemph1 += $personal;	
			}
		}
		echo $numemph1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (emphysema ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (emphysema ='Y')";
		}
		$query=mysql_query($sql);
		$numemph2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numemph2 +=  $personal;
						
			}
		}
		echo $numemph2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (emphysema ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (emphysema ='Y')";
		}
		$query=mysql_query($sql);
		$numemph=mysql_num_rows($query);
		echo $numemph;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num23=mysql_num_rows($query);
		$sum23=$numemph*100/$num23;
		echo number_format($sum23,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">20</td>
    <td align="left" valign="middle">หมอนรองกระดูกทับเส้นประสาท</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (conjunctivitis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (conjunctivitis ='Y')";		
	}
		$query=mysql_query($sql);
		$numconj1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numconj1 += $personal;	
			}
		}
		echo $numconj1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (conjunctivitis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (conjunctivitis ='Y')";
		}
		$query=mysql_query($sql);
		$numconj2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numconj2 +=  $personal;
						
			}
		}
		echo $numconj2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (conjunctivitis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (conjunctivitis ='Y')";
		}
		$query=mysql_query($sql);
		$numconj=mysql_num_rows($query);
		echo $numconj;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num24=mysql_num_rows($query);
		$sum24=$numconj*100/$num24;
		echo number_format($sum24,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">21</td>
    <td align="left" valign="middle">เยื่อบุตาอักเสบ (Conjunctivitis)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";		
	}
		$query=mysql_query($sql);
		$numcys1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcys1 += $personal;	
			}
		}
		echo $numcys1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";
		}
		$query=mysql_query($sql);
		$numcys2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcys2 +=  $personal;
						
			}
		}
		echo $numcys2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";
		}
		$query=mysql_query($sql);
		$numcys=mysql_num_rows($query);
		echo $numcys;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num25=mysql_num_rows($query);
		$sum25=$numcys*100/$num25;
		echo number_format($sum25,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">22</td>
    <td align="left" valign="middle">กระเพาะปัสสาวะอักเสบ (Cystitis)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";		
	}
		$query=mysql_query($sql);
		$numcys1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcys1 += $personal;	
			}
		}
		echo $numcys1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";
		}
		$query=mysql_query($sql);
		$numcys2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcys2 +=  $personal;
						
			}
		}
		echo $numcys2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cystitis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cystitis ='Y')";
		}
		$query=mysql_query($sql);
		$numcys=mysql_num_rows($query);
		echo $numcys;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num26=mysql_num_rows($query);
		$sum26=$numcys*100/$num26;
		echo number_format($sum26,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">23</td>
    <td align="left" valign="middle">เจ็บป่วยจากอุบัติเหตุ</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="center" valign="middle">24</td>
    <td align="left" valign="middle">ลมชัก (Epilepsy)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (epilepsy ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (epilepsy ='Y')";		
	}
		$query=mysql_query($sql);
		$numepil1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numepil1 += $personal;	
			}
		}
		echo $numepil1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (epilepsy ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (epilepsy ='Y')";
		}
		$query=mysql_query($sql);
		$numepil2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numepil2 +=  $personal;
						
			}
		}
		echo $numepil2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (epilepsy ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (epilepsy ='Y')";
		}
		$query=mysql_query($sql);
		$numepil=mysql_num_rows($query);
		echo $numepil;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num28=mysql_num_rows($query);
		$sum28=$numepil*100/$num28;
		echo number_format($sum28,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">25</td>
    <td align="left" valign="middle">กระดูกหักเลื่อน</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (fracture ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (fracture ='Y')";		
	}
		$query=mysql_query($sql);
		$numfrac1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numfrac1 += $personal;	
			}
		}
		echo $numfrac1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (fracture ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (fracture ='Y')";
		}
		$query=mysql_query($sql);
		$numfrac2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numfrac2 +=  $personal;
						
			}
		}
		echo $numfrac2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (fracture ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (fracture ='Y')";
		}
		$query=mysql_query($sql);
		$numfrac=mysql_num_rows($query);
		echo $numfrac;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num29=mysql_num_rows($query);
		$sum29=$numfrac*100/$num29;
		echo number_format($sum29,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">26</td>
    <td align="left" valign="middle">หัวใจเต้นผิดจังหวะ (Cardiac arrhythmia)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (cardiac ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (cardiac ='Y')";		
	}
		$query=mysql_query($sql);
		$numcard1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcard1 += $personal;	
			}
		}
		echo $numcard1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cardiac ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cardiac ='Y')";
		}
		$query=mysql_query($sql);
		$numcard2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcard2 +=  $personal;
						
			}
		}
		echo $numcard2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (cardiac ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (cardiac ='Y')";
		}
		$query=mysql_query($sql);
		$numcard=mysql_num_rows($query);
		echo $numcard;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num30=mysql_num_rows($query);
		$sum30=$numcard*100/$num30;
		echo number_format($sum30,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">27</td>
    <td align="left" valign="middle">กระดูกสันหลัง (อก) คด</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (spine ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (spine ='Y')";		
	}
		$query=mysql_query($sql);
		$numspin1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numspin1 += $personal;	
			}
		}
		echo $numspin1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (spine ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (spine ='Y')";
		}
		$query=mysql_query($sql);
		$numspin2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numspin2 +=  $personal;
						
			}
		}
		echo $numspin2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (spine ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (spine ='Y')";
		}
		$query=mysql_query($sql);
		$numspin=mysql_num_rows($query);
		echo $numspin;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num31=mysql_num_rows($query);
		$sum31=$numspin*100/$num31;
		echo number_format($sum31,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">28</td>
    <td align="left" valign="middle">ผิวหนังอักเสบ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (dermatitis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (dermatitis ='Y')";		
	}
		$query=mysql_query($sql);
		$numderm1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numderm1 += $personal;	
			}
		}
		echo $numderm1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (dermatitis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (dermatitis ='Y')";
		}
		$query=mysql_query($sql);
		$numderm2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numderm2 +=  $personal;
						
			}
		}
		echo $numderm2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (dermatitis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (dermatitis ='Y')";
		}
		$query=mysql_query($sql);
		$numderm=mysql_num_rows($query);
		echo $numderm;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num32=mysql_num_rows($query);
		$sum32=$numderm*100/$num32;
		echo number_format($sum32,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">29</td>
    <td align="left" valign="middle">หัวเข่าเสื่อม</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (degeneration ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (degeneration ='Y')";		
	}
		$query=mysql_query($sql);
		$numdege1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numdege1 += $personal;	
			}
		}
		echo $numdege1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (degeneration ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (degeneration ='Y')";
		}
		$query=mysql_query($sql);
		$numdege2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numdege2 +=  $personal;
						
			}
		}
		echo $numdege2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (degeneration ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (degeneration ='Y')";
		}
		$query=mysql_query($sql);
		$numdege=mysql_num_rows($query);
		echo $numdege;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num33=mysql_num_rows($query);
		$sum33=$numdege*100/$num33;
		echo number_format($sum33,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">30</td>
    <td align="left" valign="middle">ความผิดพลาดจากแอลกอฮอล์ (Alcoholic)</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (alcoholic ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (alcoholic ='Y')";		
	}
		$query=mysql_query($sql);
		$numalco1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numalco1 += $personal;	
			}
		}
		echo $numalco1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (alcoholic ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (alcoholic ='Y')";
		}
		$query=mysql_query($sql);
		$numalco2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numalco2 +=  $personal;
						
			}
		}
		echo $numalco2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (alcoholic ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (alcoholic ='Y')";
		}
		$query=mysql_query($sql);
		$numalco=mysql_num_rows($query);
		echo $numalco;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num34=mysql_num_rows($query);
		$sum34=$numalco*100/$num34;
		echo number_format($sum34,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">31</td>
    <td align="left" valign="middle">COPD</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (copd ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (copd ='Y')";		
	}
		$query=mysql_query($sql);
		$numcopd1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcopd1 += $personal;	
			}
		}
		echo $numcopd1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (copd ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (copd ='Y')";
		}
		$query=mysql_query($sql);
		$numcopd2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcopd2 +=  $personal;
						
			}
		}
		echo $numcopd2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (copd ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (copd ='Y')";
		}
		$query=mysql_query($sql);
		$numcopd=mysql_num_rows($query);
		echo $numcopd;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num35=mysql_num_rows($query);
		$sum35=$numcopd*100/$num35;
		echo number_format($sum35,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">32</td>
    <td align="left" valign="middle">BPH</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (bph ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (bph ='Y')";		
	}
		$query=mysql_query($sql);
		$numbph1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numbph1 += $personal;	
			}
		}
		echo $numbph1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bph ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bph ='Y')";
		}
		$query=mysql_query($sql);
		$numbph2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numbph2 +=  $personal;
						
			}
		}
		echo $numbph2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (bph ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (bph ='Y')";
		}
		$query=mysql_query($sql);
		$numbph=mysql_num_rows($query);
		echo $numbph;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num36=mysql_num_rows($query);
		$sum36=$numbph*100/$num36;
		echo number_format($sum36,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">33</td>
    <td align="left" valign="middle">ไตผิดปกติ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (kidney ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (kidney ='Y')";		
	}
		$query=mysql_query($sql);
		$numkidn1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numkidn1 += $personal;	
			}
		}
		echo $numkidn1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (kidney ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (kidney ='Y')";
		}
		$query=mysql_query($sql);
		$numkidn2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numkidn2 +=  $personal;
						
			}
		}
		echo $numkidn2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (kidney ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (kidney ='Y')";
		}
		$query=mysql_query($sql);
		$numkidn=mysql_num_rows($query);
		echo $numkidn;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num37=mysql_num_rows($query);
		$sum37=$numkidn*100/$num37;
		echo number_format($sum37,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">34</td>
    <td align="left" valign="middle">ต้อเนื้อ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (pterygium ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (pterygium ='Y')";		
	}
		$query=mysql_query($sql);
		$numptery1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numptery1 += $personal;	
			}
		}
		echo $numptery1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (pterygium ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (pterygium ='Y')";
		}
		$query=mysql_query($sql);
		$numptery2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numptery2 +=  $personal;
						
			}
		}
		echo $numptery2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (pterygium ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (pterygium ='Y')";
		}
		$query=mysql_query($sql);
		$numptery=mysql_num_rows($query);
		echo $numptery;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num38=mysql_num_rows($query);
		$sum38=$numptery*100/$num38;
		echo number_format($sum38,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">35</td>
    <td align="left" valign="middle">ต่อมทอนซิลโต</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (tonsil ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (tonsil ='Y')";		
	}
		$query=mysql_query($sql);
		$numton1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numton1 += $personal;	
			}
		}
		echo $numton1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (tonsil ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (tonsil ='Y')";
		}
		$query=mysql_query($sql);
		$numton2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numton2 +=  $personal;
						
			}
		}
		echo $numton2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (tonsil ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (tonsil ='Y')";
		}
		$query=mysql_query($sql);
		$numton=mysql_num_rows($query);
		echo $numton;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num39=mysql_num_rows($query);
		$sum39=$numton*100/$num39;
		echo number_format($sum39,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">36</td>
    <td align="left" valign="middle">อัมพาตซีกซ้าย/ขวา</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (paralysis ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (paralysis ='Y')";		
	}
		$query=mysql_query($sql);
		$numpara1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numpara1 += $personal;	
			}
		}
		echo $numpara1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (paralysis ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (paralysis ='Y')";
		}
		$query=mysql_query($sql);
		$numpara2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numpara2 +=  $personal;
						
			}
		}
		echo $numpara2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (paralysis ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (paralysis ='Y')";
		}
		$query=mysql_query($sql);
		$numpara=mysql_num_rows($query);
		echo $numpara;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num40=mysql_num_rows($query);
		$sum40=$numpara*100/$num40;
		echo number_format($sum40,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">37</td>
    <td align="left" valign="middle">เม็ดเลือดผิดปกติ</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (blood ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (blood ='Y')";		
	}
		$query=mysql_query($sql);
		$numblood1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numblood1 += $personal;	
			}
		}
		echo $numblood1;	
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (blood ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (blood ='Y')";
		}
		$query=mysql_query($sql);
		$numblood2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numblood2 +=  $personal;
						
			}
		}
		echo $numblood2;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (blood ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (blood ='Y')";
		}
		$query=mysql_query($sql);
		$numblood=mysql_num_rows($query);
		echo $numblood;
	?>    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num41=mysql_num_rows($query);
		$sum41=$numblood*100/$num41;
		echo number_format($sum41,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">38</td>
    <td align="left" valign="middle">ภาวะซีด</td>
    <td align="center" valign="middle"><?
	if($_POST["txtcamp"]=="0"){
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]'  AND (conanemia ='Y')";	
	}else{
		$sql="SELECT *
		FROM condxofyear_so
		WHERE yearcheck =  '$_POST[year]' AND camp
		LIKE  '%$_POST[txtcamp]%' AND (conanemia ='Y')";		
	}
		$query=mysql_query($sql);
		$numcona1=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
			//echo $age.",";
				$personal=count($age);
				$numcona1 += $personal;	
			}
		}
		echo $numcona1;	
	?>
    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (conanemia ='Y')";
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (conanemia ='Y')";
		}
		$query=mysql_query($sql);
		$numcona2=0;
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
		//echo $age.",";
			if($age > 35){
				$personal=count($age);
				$numcona2 +=  $personal;
						
			}
		}
		echo $numcona2;
	?>
    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'  AND (conanemia ='Y')";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' AND (conanemia ='Y')";
		}
		$query=mysql_query($sql);
		$numcona=mysql_num_rows($query);
		echo $numcona;
	?>
    </td>
    <td align="center" valign="middle"><?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%' ";		
		}
		$query=mysql_query($sql);
		$num42=mysql_num_rows($query);
		$sum42=$numcona*100/$num42;
		echo number_format($sum42,2);
		?></td>
  </tr>
  <tr>
    <td align="center" valign="middle">39</td>
    <td align="left" valign="middle">โรคอื่นๆ (โปรดระบุ)</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
    <td align="center" valign="middle">-</td>
  </tr>
  <tr>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle"><strong>รวมทั้งสิ้น</strong></td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
  </tr>
</table>

