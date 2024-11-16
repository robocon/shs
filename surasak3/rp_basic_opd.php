<?php
include("connect.inc");  
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
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
              <option value="11" <? if(date("m")=="11"){ echo" Selected "; }?> >พฤศจิกายน</option>
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
		print " <option value='EX25' ".($_POST["case"] =="EX25"?"Selected":"")." >ผู้ป่วยจักษุ</option>";
		print " <option value='EX50' ".($_POST["case"] =="EX50"?"Selected":"")." >คลินิกโรคทางเดินหายใจ</option>";
		print " <option value='EX55' ".($_POST["case"] =="EX55"?"Selected":"")." >ผู้ป่วยกรณี OP Self Isolation</option>";
		print " <option value='EX56' ".($_POST["case"] =="EX56"?"Selected":"")." >ผู้ป่วยกรณี Home Isolation</option>";
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
		<td width="40">Repeat BP</td>
		<td width="40">Pain Score</td>
		<td width="40">CV Risk ไม่มีผลเลือด </td>
		<td width="40">CV Risk มีผลเลือด</td>
		<td width="40" bgcolor="#F5B7B1">CV Risk ไม่มีผลเลือด <br>ระบบคำนวณ</td>
		<td width="40" bgcolor="#F5B7B1">โคเรสเตอรอลรวม<br>Cholesterol</td>
		<td width="40" bgcolor="#F5B7B1">CV Risk มีผลเลือด<br>ระบบคำนวณ</td>
		<td width="100">ประเภท</td>
		<td width="220">อาการ</td>
        <td width="169">แพทย์</td>
        <td width="169">จนท.</td>
		<?
		if($_POST["case"]=="EX55"){
		?>
        <td width="169">วันที่ประเมินอาการ<br>ครบ 48 ชั่วโมง</td>
        <td width="169">วันที่ประเมินอาการ<br>หลัง 48 ชั่วโมง</td>		
		<?
		}
		?>
        </tr>
		<?php
		if(empty($_POST["search"])){
			$search_date = date('d-m-').(date("Y")+543);
		}else{
			$search_date = $_POST["day"].'-'.$_POST["month"].'-'.$_POST["year"];
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

			$sql = "Select thidate, hn, ptname,  temperature,  pause,  rate,  weight, height,  bp1,  bp2 ,  bp3,  bp4 ,  doctor , officer, date_format(thidate,'%d-%m-%Y'), organ, painscore,thdatehn,waist,cigarette,cvriskscore,cvriskscore_lab  From opd where thdatehn like '".$search_date."%' $where_doctor  $where_toborow ORDER BY row_id ASC";

			$result = Mysql_Query($sql);
			$no=1;
			$j=1;
			while(list($thidate,$hn,$ptname,$temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$bp3,$bp4,$doctor,$officer,$thidate2,$organ,$painscore,$thdatehn,$waist,$cigarette,$cvriskscore,$cvriskscore_lab) = mysql_fetch_row($result) ){

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
				
				// if(!empty($bp3) && $bp3 !="....."){
				// 	$sbp=$bp3;
				// 	$repeatbp="$bp3/$bp4";
				// }else{
				// 	$sbp=$bp1;
				// }	
								
				
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
				
				
				$waist=$waist*2.54;
				
				//--------- ไม่มีผลเลือด -----------//
				$fullscore=(0.079*$age)+(0.128*$sex)+(0.019350987*$sbp)+(0.58454*$diabetes)+(3.512566*($waist/$height))+(0.459*$smoke);
								
				$y=$fullscore-7.720484;	
				$x=0.978296;
				
				$y=exp($y);
				$z=pow($x,$y);
				
				$final=(1-$z)*100;
				
				$pfullscore=number_format($final,2);
				if($pfullscore >=30 && $pfullscore < 40){
					$pfullscore="$pfullscore<br><strong style='color:red;'> >30%</strong>";
				}else if($pfullscore >=40){
					$pfullscore="$pfullscore<br><strong style='color:red;'> >40%</strong>";
				}else{
					$pfullscore=$pfullscore;
				}						
				
				//---------------จบ-----------------//
				
				
				//--------- มีผลเลือด -----------//
				$date_now=date("Y-m-d");
				$sql1 = "Select b.result From (Select * From resulthead where hn='".$hn."' AND orderdate like '".$date_now."%' ) as a INNER JOIN resultdetail as b ON a.autonumber = b.autonumber WHERE b.labcode='CHOL' group by a.profilecode  Order by  a.testgroupname ASC, b.seq ASC";
				//echo $sql1."<br>";
				$result1 = mysql_query($sql1);	
				$num1=mysql_num_rows($result1);	
				
				if($num1 > 0){
					list($chol)=mysql_fetch_array($result1);
					$fullscore_lab=(0.08183*$age)+(0.39499*$sex)+(0.02084*$sbp)+(0.69974*$diabetes)+(0.00212*$chol)+(0.459*$smoke);
									
					$yy=$fullscore_lab-7.04423;	
					$xx=0.978296;
					
					$yy=exp($yy);
					$zz=pow($xx,$yy);
					
					$final_lab=(1-$zz)*100;
					
					$pfullscore_lab=number_format($final_lab,2);
					if($pfullscore_lab >=30 && $pfullscore_lab < 40){
						$pfullscore_lab="$pfullscore_lab<br><strong style='color:red;'> >30%</strong>";
					}else if($pfullscore_lab >=40){
						$pfullscore_lab="$pfullscore_lab<br><strong style='color:red;'> >40%</strong>";
					}else{
						$pfullscore_lab=$pfullscore_lab;
					}		
				}else{
					$chol="";
					$pfullscore_lab="";
				}		
				//---------------จบ-----------------//
				
				//exp(x) สำหรับหาค่าเอ็กโปรเนเชียล (exponential) เช่น exp(23)
				

				
		
		$d=substr($thidate,8,2);
		$m=substr($thidate,5,2); 
		$y=substr($thidate,0,4)-543;
		$yy=substr($thidate,0,4); 
		$thidate="$d/$m/$yy ".substr($thidate,10);
		
		
		$strStartDate="$y-$m-$d";
		$strNewDate1 = date ("Y-m-d", strtotime("+2 day", strtotime($strStartDate)));
		$strNewDate2 = date ("Y-m-d", strtotime("+6 day", strtotime($strStartDate)));

		$d1=substr($strNewDate1,8,2);
		$m1=substr($strNewDate1,5,2); 
		$y1=substr($strNewDate1,0,4)+543; 
		$strNewDate1="$d1/$m1/$y1";

		$d2=substr($strNewDate2,8,2);
		$m2=substr($strNewDate2,5,2); 
		$y2=substr($strNewDate2,0,4)+543; 
		$strNewDate2="$d2/$m2/$y2";
		
		
		?>
      <tr class="data_show<?php echo $j;?>">
        <td align="center"><?php echo $no;?></td>
        <td align="center"><?php echo $thidate;?></td>
        <td align="center"><A HREF="stk_basic_opd.php?dthn=<?php echo $thdatehn;?>" target="_blank"><?php echo $hn;?></A></td>
        <td><a href="stk_basic_opd2.php?dthn=<?php echo $thdatehn;?>" target="_blank"><?php echo $ptname;?></a></td>
        <td width="40" align="center"><?php echo $temperature;?></td>
        <td width="40" align="center"><?php echo $pause;?></td>
        <td width="40" align="center"><?php echo $rate;?></td>
        <td width="40" align="center"><?php echo $weight;?></td>
        <td width="40" align="center"><?php echo $bp1.'/'.$bp2;?></td>
		<td width="40" align="center"><?=(!empty($bp3) && !empty($bp4)) ? $bp3.'/'.$bp4 : '' ;?></td>
		<td width="40" align="center"><?php echo $painscore;?></td>
		<td width="40" align="center"><?php echo $cvriskscore;?></td>
		<td width="40" align="center"><?php echo $cvriskscore_lab;?></td>
		<td width="40" align="center" bgcolor="#F5B7B1"><?php echo $pfullscore;?></td>
		<td width="40" align="center" bgcolor="#F5B7B1"><?php echo $chol;?></td>
		<td width="40" align="center" bgcolor="#F5B7B1"><?php echo $pfullscore_lab;?></td>		
		<td width="100" align="center"><?php if($rows3['opdtype']=="SI"){ echo "OP Self Isolation";}else if($rows3['opdtype']=="OP"){echo "ผู้ป่วยทั่วไป";}else{echo "ไม่ระบุ";} ?></td>
		<td align="left"><?php echo $organ;?></td>
        <td align="left"><?php echo $doctor;?></td>
        <td align="left"><?php echo $officer;?></td>
		<?
		if($_POST["case"]=="EX55"){
		?>
        <td align="center"><?php echo $strNewDate1;?></td>
        <td align="center"><?php echo $strNewDate2;?></td>
		<?
		}
		?>
        </tr>
		<?php 
		$no++; 
	} 
	?>
    </table>
	</td>
  </tr>
</table>
<?php 
include("unconnect.inc");
?>
</body>
</html>
