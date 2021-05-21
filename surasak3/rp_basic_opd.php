<?php

include("connect.inc");  
session_start();


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--

.data_show{ 
	font-family: TH SarabunPSK;
	font-size:18px; 
	color:#000000;
	}
.data_show1{ 
	font-family: TH SarabunPSK;
	font-size:18px; 
	color:#000000;
	}
.data_show2{ 
	font-family: TH SarabunPSK;
	font-size:18px; 
	color:#000000;
	background-color:#CCFFCC;
	}
.data_drugreact{ 
	font-family: TH SarabunPSK;
	font-size:18px; 
	color:#FF0000;
	
	}
.data_title{ 
	font-family: TH SarabunPSK;
	font-size:20px; 
	color:#FFFFFF;
	font-weight:bold;
	background-color:#339999;
	}
body,td,th {
	font-family: TH SarabunPSK;
	font-size:18px;
}

.txtsarabun{ 
	font-family: "TH SarabunPSK";
	font-size:16px; 
	font-weight:bold;
	}
-->
</style>
</head>

<body>
<p align="center" style="font-size: 22px;"><strong>แสดงข้อมูลผู้ป่วยที่มารับบริการ</strong></p>
<form id="form1" name="form1" method="post" action="">
  <table width="40%" border="5" align="center" cellpadding="5" cellspacing="5" bordercolor="#339999">
    <tr>
      <td><table width="100%" border="0" align="center" cellpadding="5" cellspacing="0">
        <tr class="data_show">
          <td align="right">วันที่ :</td>
          <td width="41"><select name="day" id="day" class="txtsarabun">
              <?php
	  for($i=1;$i<=31;$i++){
	  	echo '<option value="'.sprintf ("%02d",$i).'" ';
			if($i == date("d")) echo ' Selected ';
		echo '>'.$i.'</option>';
	  }
	  ?>
          </select></td>
          <td align="right">เดือน :</td>
          <td width="42"><select size="1" name="month" class="txtsarabun">
              <option value="01" <? if(date("m")=="01"){ echo" Selected "; }?> >มกราคม</option>
              <option value="02" <? if(date("m")=="02"){ echo" Selected "; }?> >กุมภาพันธ์</option>
              <option value="03" <? if(date("m")=="03"){ echo" Selected "; }?> >มีนาคม</option>
              <option value="04" <? if(date("m")=="04"){ echo" Selected "; }?> >เมษายน</option>
              <option value="05" <? if(date("m")=="05"){ echo" Selected "; }?> >พฤษภาคม</option>
              <option value="06" <? if(date("m")=="06"){ echo" Selected "; }?> >มิถุนายน</option>
              <option value="07" <? if(date("m")=="07"){ echo" Selected "; }?> >กรกฎาคม</option>
              <option value="08" <? if(date("m")=="08"){ echo" Selected "; }?> >สิงหาคม</option>
              <option value="09" <? if(date("m")=="09"){ echo" Selected "; }?> >กันยายน</option>
              <option value="10" <? if(date("m")=="10"){ echo" Selected "; }?> >ตุลาคม</option>
              <option value="11" <? if(date("m")=="11"){ echo" Selected "; }?> >พฤษจิกายน</option>
              <option value="12" <? if(date("m")=="12"){ echo" Selected "; }?> >ธันวาคม</option>
          </select></td>
          <td align="right">ปี :</td>
          <td width="78"><select name="year" id="year" class="txtsarabun">
              <?php
	  for($i=(date("Y")+543)-5;$i<=(date("Y")+543)+5;$i++){
	  	echo '<option value="'.$i.'" ';
			if($i == (date("Y")+543)) echo ' Selected ';
		echo '>'.$i.'</option>';
	  }
	  ?>
          </select></td>
        </tr>
        <tr class="data_show">
          <td align="right">แพทย์ : </td>
          <td colspan="5"><select name="doctor" id="doctor" class="txtsarabun">
              <?php 
		echo "<option value='' >---เรียกดูทั้งหมด----</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
            </select>
          </td>
        </tr>
        <tr class="data_show">
          <td align="right">ประเภท : </td>
          <td colspan="5"><?php 
		print " <select  id='case1' name='case' class='txtsarabun'>";
		print " <option value='' >---เรียกดูทั้งหมด----</option>";
		print " <option value='EX01' ".($_POST["case"] =="EX01"?"Selected":"")." >รักษาโรคทั่วไปในเวลาราชการ</option>";
		print " <option value='EX02' ".($_POST["case"] =="EX02"?"Selected":"")." >ผู้ป่วยฉุกเฉิน</option>";
		print " <option value='EX04' ".($_POST["case"] =="EX04"?"Selected":"")." >ผู้ป่วยนัด</option>";
		print " <option value='EX11' ".($_POST["case"] =="EX11"?"Selected":"")." >รักษาโรคนอกเวลาราชการ</option>";
		print " </select>";
		?>
          </td>
        </tr>
        <tr class="data_show">
          <td>&nbsp;</td>
          <td colspan="5"><input name="search" type="submit" id="search" value="  ค้นหาข้อมูล  " class="txtsarabun" /></td>
        </tr>
      </table></td>
    </tr>
  </table>
</form>
<p align="center" style="font-size: 22px;"><hr style="border-color:#339999;"/></p>
<table width="95%" border="5" align="center" cellpadding="5" cellspacing="0" bordercolor="#339999">
  <tr>
    <td><table width="100%" border="0" cellpadding="2" cellspacing="2">
      <tr align="center" class="data_title">
        <td width="33">No.</td>
        <td width="133">วัน/เวลา</td>
        <td width="82">HN</td>
        <td width="164">ชื่อ-สกุล</td>
        <td width="40">T</td>
        <td width="40">P</td>
        <td width="40">R</td>
        <td width="40">นน.</td>
        <td width="40">BP</td>
		<td width="40">Pain Score</td>
		<td width="40">CV Risk ไม่มี TC</td>
		<td width="220">อาการ</td>
        <td width="169">แพทย์</td>
        <td width="169">จนท.</td>
        </tr>
		<?php
		if(empty($_POST["search"])){
			$search_date = (date("Y")+543).date("-m-d");
		}else{
			$search_date = $_POST["year"]."-".$_POST["month"]."-".$_POST["day"];
		}

		$where_doctor = "";
		if(!empty($_POST["doctor"]))
		{
			$where_doctor = " AND doctor like '".$_POST["doctor"]."%' ";
		}
		
		$where_toborow = "";
		if(!empty($_POST["case"]))
		{
			$where_toborow = " AND toborow like '".$_POST["case"]."%' ";
		}

			$sql = "Select thidate, hn, ptname,  temperature,  pause,  rate,  weight, height,  bp1,  bp2 ,  doctor , officer, date_format(thidate,'%d-%m-%Y'), organ, painscore,thdatehn,waist,cigarette  From opd where thidate like '".$search_date."%' $where_doctor  $where_toborow ";

			$result = Mysql_Query($sql);
			$no=1;
			$j=1;
			while(list($thidate,$hn,$ptname,$temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$doctor,$officer,$thidate2,$organ,$painscore,$thdatehn,$waist,$cigarette) = mysql_fetch_row($result) ){

				if($j==1){
					$j = 2;
				}else{
					$j = 1;
				}
				
				if($cigarette=="1"){
					$smoke=1;
				}else{
					$smoke=0;
				}
				
				$sbp=$bp1;
								
				
				$sql1 = "SELECT *  FROM opcard WHERE hn = '".$hn."' limit 1";
	    		$query1 = mysql_query($sql1) or die("Query failed");
				$rows=mysql_fetch_array($query1);
				
				if($rows["sex"]=="ช"){
					$sex=1;
				}else{
					$sex=0;
				}
							
				
				$waist=$waist*0.39370;
				$waist=round($waist);
				
				$height=floor($height);
				$whtr=$waist/$height;
				$finalwhtr=$whtr*100;
				
				
				$sql2= "SELECT * FROM `diabetes_clinic` WHERE `hn` = '$hn'";	
	    		$query2 = mysql_query($sql2) or die("Query failed");
				$numdm=mysql_num_rows($query2);
				if($numdm > 0){
					$diabetes=1;
				}else{
					$diabetes=0;
				}
				
				$sql3 = "SELECT *  FROM opday WHERE thdatehn = '".$thdatehn."' limit 1";
				
	    		$query3 = mysql_query($sql3) or die("Query failed");
				$rows3=mysql_fetch_array($query3);
				$age=substr($rows3["age"],0,2);
				//echo $age."<br>";				
				$fullscore=0;
				//if(!empty($age) && !empty($sex) && !empty($age) && !empty($sbp) && !empty($diabetes) && !empty($whtr) && !empty($smoke)){
					//$fullscore=(0.0794420169146399*$age)+(0.127658073818733*$sex)+(0.0193509871323239*$sbp)+(0.584543504554125*$diabetes)+(0.0351256637183026*$finalwhtr)+(0.459312425773018*$smoke);	

													
					//$fullscore = (0.0794420169146399 * $age) + (0.127658073818733 * $sex) + (0.019350987 * $sbp) + (0.58454 * $diabetes) + (3.512566 * ($waist / $height)) + (0.459 * $smoke);
				/*}else{
					$fullscore="";
				}*/
				
				
/*FullScore = (0.0794420169146399*age) +
(0.127658073818733*sex) + (0.0193509871323239*sbp) +
(0.584543504554125*diabetes) +
(0.0351256637183026*whtr*100) + (0.459312425773018*smoke)


o PFullScore= 1 - (0.964588)exp(FullScore-7.712325)			*/	
				
				
				
				if($hn=="50-313"){
					//echo $fullscore."<br>";
				//print("$waist=$waist*0.39370<br>");
				$waist=round($waist);
				
/*				$height=floor($height);
				$whtr=$waist/$height;*/
				$whtr=$waist*100;
									
//print("$whtr=$waist*100<br>");

$fullscore=(0.0794420169146399*$age)+(0.127658073818733*$sex)+(0.0193509871323239*$sbp)+(0.584543504554125*$diabetes)+(0.0351256637183026*$whtr)+(0.459312425773018*$smoke);						
print("<br>");
print("คำนวณหาค่า CV risk <br>");
print("อายุ : 70<br>");
print("เพศหญิง : 0<br>");
print("ความดันโลหิต : 110<br>");
print("รอบเอว : 35<br>");
print("ไม่สูบบุหรี่ : 0<br>");
print("<hr>");
					
				print("FullScore = (0.0794420169146399*age) +
(0.127658073818733*sex) + (0.0193509871323239*sbp) +
(0.584543504554125*diabetes) +
(0.0351256637183026*whtr*100) + (0.459312425773018*smoke) <br>");
					
print("แทน Fullscore ด้วย $fullscore=(0.0794420169146399*$age)+(0.127658073818733*$sex)+(0.0193509871323239*$sbp)+(0.584543504554125*$diabetes)+(0.0351256637183026*$whtr)+(0.459312425773018*$smoke)"."<br>");
					
				print("<hr>");				
				$y=$fullscore-7.712325;
				//echo "$y=$fullscore-7.712325";
					
				$x=0.964588;
				print("ค่า Fullscore : $fullscore <br>");
				print("ค่า X : $x <br>");
				print("ค่า Y : $y <br>");
				print("<hr>");
				print("ใช้สูตร PFullScore= 1 - (0.964588)exp(FullScore-7.712325) <br>");
				print("แทนค่าด้วย PFullScore= 1 - ($x)exp($fullscore-7.712325) <br>");
				$z=pow($x,$y);
				print("หาค่า X ยกกำลัง Y ได้ = $z<br>");
				print("ค่า Z : $z <br>");
				print("<hr>");
				print("นำเอา 1-ผลลัพธ์จากยกกำลัง = 1-$z<br>");
				$final=1-$z;
				print("ผลลัพธ์1-$z คือ $final<br>");				
				print("ค่า Full Final : $final <br>");
				//$pfullscore1=1-0.978296;
				//$pfullscore2=$fullscore-7.720484;
				
				//$fullfinall=$finall*100;
				$fullfinal=number_format($final,2);
				
				//echo "$fullfinall <br>";
				
				//echo pow(2,5) ;

				
				}else{
				$fullfinall="";
				}
				
		?>
      <tr class="data_show<?php echo $j;?>">
        <td align="center"><?php echo $no;?></td>
        <td align="center"><?php echo $thidate;?></td>
        <td align="center"><A HREF="stk_basic_opd.php?dthn=<?php echo $thdatehn;?>" target="_blank"><?php echo $hn;?></A></td>
        <td><A HREF="stk_basic_opd2.php?dthn=<?php echo $thdatehn;?>" target="_blank"><?php echo $ptname;?></A></td>
        <td width="40" align="center"><?php echo $temperature;?></td>
        <td width="40" align="center"><?php echo $pause;?></td>
        <td width="40" align="center"><?php echo $rate;?></td>
        <td width="40" align="center"><?php echo $weight;?></td>
        <td width="40" align="center"><?php echo $bp1,'/',$bp2;?></td>
		<td width="40" align="center"><?php echo $painscore;?></td>
		<td width="40" align="center"><?php echo $fullfinall;?></td>
		<td align="left"><?php echo $organ;?></td>
        <td align="left"><?php echo $doctor;?></td>
        <td align="left"><?php echo $officer;?></td>
        </tr>
		<?php $no++;} ?>
    </table></td>
  </tr>
</table>
<?php 
include("unconnect.inc");
?>
</body>
</html>
