<?php
include("connect.inc");  
session_start();
?>
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
    font-size: 20px;
    }
.txtsarabun {
font-family:"TH SarabunPSK";
font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 20px;
	}
	
a:link{
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  width: 5em;  
  
}

a:visited {
  background-color: #229954;
  color: white;
  border: 2px solid #229954;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #85C1E9;
  color: #000000;
  font-weight:bold;
}
	
</style>
<title>แสกนประวัติผู้ป่วยนอก</title>
<?php
	
    $today=date("d-m-").(date("Y")+543);
    print "<strong class=\"txtsarabun\" style='font-size:28px;'>ข้อมูลป่วยนอกที่มารับบริการ</strong>";
	print "<strong class=\"txtsarabun\" style='margin-left:20px;font-size:28px;'>วันที่ $today</strong>";
    $today=(date("Y")+543)."-".date("m-d");	
?>
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="report_scan_opday.php">
<input type="hidden" name="act" value="show">
    <p style="font-size:24px;"><b>ค้นหาจาก</b></p>
	<p>
	<strong>วันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txtsarabun">
    <strong>เดือน : </strong><select size="1" name="month1" class="txtsarabun">
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
  <strong>พ.ศ. : </strong>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
	</p>
	
	
	
    <div>HN ผู้ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="hn" type="text" class="txtsarabun" id="aLink"  size="50" height="40">
    </div>
	<div>หรือ</div>
    <div>ประเภท&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="case" id="case" class="txtsarabun">
              <?php 
		echo "<option value='' >------------เลือกดูข้อมูล------------</option>";
		$sql = "select type_name from typeopcard";
		$result = mysql_query($sql);
		while(list($typename) = mysql_fetch_row($result)){
		
		echo "<option value='".$typename."' >".$typename."</option>";
		
		}
		?>
            </select>
    </div> 
	<div>หรือ</div>
    <div>คลินิก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <select name="clinic" id="clinic" class="txtsarabun">
              <?php 
		echo "<option value='' >------------เลือกดูข้อมูล------------</option>";
		$sql = "select detail from clinic";
		$result = mysql_query($sql);
		while(list($detail) = mysql_fetch_row($result)){
		
		echo "<option value='".$detail."' >".$detail."</option>";
		
		}
		?>
            </select>
    </div>	
    <p style="margin-left:100px;">
    <input name="B1" type="submit" class="txtsarabun" value="     ค้นหา     ">
    &nbsp;&nbsp;&nbsp;&nbsp; <input name="B2" type="reset" class="txtsarabun" value="     ยกเลิก     ">
	&nbsp;&nbsp;&nbsp;&nbsp; <input type="button" name="button" id="button" value="   กลับหน้าหลัก   " onclick="window.location='../nindex.htm'" class="txtsarabun" />
    </p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
</div>
<? 
$chkdate=date("Y-m-d");	
if($_POST["act"]=="show"){
	$date=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"];
	$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
	
	$year=$_POST["year1"]-543;
	$regisdate_en=$year."-".$_POST["month1"]."-".$_POST["date1"];
	
?>
<p style="font-size:24px;"><b>วันที่เลือกดูข้อมูล  <?=$showdate1;?></b></p>
<div style="margin-left:50px;">
<table width="90%" bordercolor="#000000" cellpadding="5">
 <tr>
  <th bgcolor="#16A085">#</th>
  <th bgcolor="#16A085">เวลา</th>
  <th bgcolor="#16A085">opcard_id</th>
  <th bgcolor="#16A085">opday_id</th>
  <th bgcolor="#16A085">ชื่อ</th>
  <th bgcolor="#16A085" width="10%">HN</th>
  <th bgcolor="#16A085">VN</th>
  <th bgcolor="#16A085">AN</th>
  <th bgcolor="#16A085">อายุ</th>
  <th bgcolor="#16A085">สิทธิ</th>
  <th bgcolor="#16A085">การมาโรงพยาบาล</th>
  <th bgcolor="#16A085">แพทย์</th>
  <th bgcolor="#16A085">คลินิก</th>
  <th bgcolor="#16A085">การคืน OPD</th>
  <th bgcolor="#16A085">จำนวนไฟล์</th>
  <th bgcolor="#16A085">วันที่่อัพโหลดล่าสุด</th>
  <!--<th bgcolor="#16A085">วันที่ลงรหัส</th>-->
 </tr>

<?php
    $num=0;
	$num_scan=0;
	$num_noscan=0;
	$num_summaryscan=0;
	if(!empty($_POST["hn"])){
		$query = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' and hn='".$_POST["hn"]."' and thidate LIKE '$today%'  ORDER BY toborow,thidate ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจาก HN ผู้ป่วย</div>";
	}else if(!empty($_POST["case"])){
		$case=substr($_POST["case"],0,4);
		$subcase=$_POST["case"];
		$query = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2,age FROM opday WHERE thidate like '$date%' and toborow LIKE '".$case."%' ORDER BY toborow,thidate ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากประเภทการมาโรงพยาบาล $subcase</div>";
	}else if(!empty($_POST["clinic"])){
		$clinic=$_POST["clinic"];
		$query = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2,age FROM opday WHERE thidate like '$date%' and clinic LIKE '".$clinic."%' ORDER BY toborow,thidate ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากคลินิก $clinic</div>";	
	}else{
		$query = "SELECT row_id,thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2,age FROM opday WHERE thidate like '$date%' ORDER BY thidate ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียนวันนี้</div>";
	}	
	//echo $query;
	$result = mysql_query($query)
        or die("Query failed");


    while (list ($row_id,$thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd,$office,$age) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($thidate,11);		


	$sql111 = "Select row_id From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($opcard_id) = Mysql_fetch_row($result111);

	$sql112 = "Select last_update,opday_id From digital_opcard where opcard_id='$opcard_id' and last_update LIKE '$regisdate_en%' order by opday_id desc limit 1 ";
	//echo "Pt: $hn==>".$sql112."<br>";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($last_update,$opday_id) = Mysql_fetch_row($result112);
	
	$sql113 = "Select count(row_id) as countfile From digital_opcard where opcard_id='$opcard_id' and last_update LIKE '$regisdate_en%'";
	//echo "Pt: $hn==>".$sql113."<br>";
	$result113 = Mysql_Query($sql113);
	$numapp=mysql_num_rows($result113);
	list($countfile) = Mysql_fetch_row($result113);	

		

if($opday_id==0 && $countfile ==0){  //ไม่ได้สแกน
	$num_noscan++;
	$last_update="<strong style='color:red;'>$last_update</strong>";
	$statusicd10="#F5B7B1";
	$countcolor="red";
}else if($opday_id==0 && $countfile > 0){  //เป็นใบ summary
	$num_summaryscan++;
	$last_update="<strong style='color:blue;'>$last_update</strong>";
	$statusicd10="#D0ECE7";  //สีเขียว
	$countcolor="blue";
}else{
	$num_scan++;
	$last_update="<strong style='color:green;'>$last_update</strong>";	
	$statusicd10="#EAEDED";	
	$countcolor="blue";
}
        print (" <tr BGCOLOR='$statusicd10'>\n".
           "  <td align='center'>$num</td>\n".
           "  <td>$time</td>\n".
           "  <td>$opcard_id</td>\n".
		   "  <td>$opday_id</td>\n".
		   "  <td>$ptname</td>\n".
           "  <td align='center'><a href='dt_paperLess.php?hn=$hn' target='_blank'><img src='images/views.png' height='28px' width='28px' style='margin-top:5px;' /><div style='margin-top:5px;'>ประวัติการรักษา<br>$hn</div></a></td>\n".
           "  <td align='center'>$vn</td>\n".
		   "  <td>$an</td>\n".
		   "  <td>$age</td>\n".
		   "  <td>$ptright</td>\n".
		   "  <td>$toborow</td>\n".
   		   "  <td>$doctor</td>\n".
		   "  <td>$clinic</td>\n".
		   "  <td align='center'>$okopd</td>\n".
		   "  <td align='center'><strong style='color:$countcolor;font-size:28px;'>$countfile</strong></td>\n".
		   "  <td>$last_update</td>\n".
		  /* "  <td>$regisdate</td>\n".	*/	   
		   " </tr>\n");
       }
?>
</table>

</div>
<hr>
<?
	
	$sql113 = "Select row_id From digital_opcard where last_update LIKE '$regisdate_en%' group by opcard_id";  //นับเป็นรายบุคคล
	//echo $sql113;
	$result113 = mysql_query($sql113);
	$numscan_today=mysql_num_rows($result113);


	$numother=$numscan_today-$num_scan-$num_summaryscan;
	$total_scan=$num_scan+$num_summaryscan;
	//echo "==>".$_POST["case"];
echo "<div align='center' style='margin-top:20px; color:black; font-weight:bold; font-size:28px;'> เอกสารที่ถูกอัพโหลดเข้าในระบบในวันที่ $showdate1 จำนวน $numscan_today ราย</div>";
echo "<div align='center' style='margin-top:20px; color:black; font-weight:bold; font-size:28px;'> เป็นเอกสารของผู้ป่วยวันนี้ จำนวน $total_scan ราย เป็นเอกสารของวันอื่นๆ จำนวน $numother ราย</div>";	
echo "<div style='margin-left: 150px; margin-top:20px; color: blue; font-weight:bold; font-size:28px;'>- จำนวนผู้ป่วยในวันนี้ $num ราย</div>";
echo "<div style='margin-left: 150px; margin-top:20px; color: green; font-weight:bold; font-size:28px;'>- จำนวนที่สแกนเป็นประเภทใบตรวจโรค เข้าระบบ $num_scan ราย  <a href='report_digital_scan.php?getdate=$date' target='_blank'>ดูรายชื่อ <img src='images/detail-green.png' height='28px' width='28px' /></a></div>";
echo "<div style='margin-left: 150px; margin-top:20px; color: #F39C12; font-weight:bold; font-size:28px;'>- จำนวนที่สแกนเป็นประเภทใบสรุปประวัติ (Summary) เข้าระบบ $num_summaryscan ราย  <a href='report_digital_summaryscan.php?getdate=$date' target='_blank'>ดูรายชื่อ <img src='images/detail-orange.png' height='28px' width='28px' /></a></div>";
echo "<div style='margin-left: 150px; margin-top:20px; margin-bottom: 50px;  color: red; font-weight:bold; font-size:28px;'>- จำนวนที่ไม่ได้สแกนเข้าระบบ $num_noscan ราย  <a href='report_digital_noscan.php?getdate=$date' target='_blank'>ดูรายชื่อ <img src='images/detail-red.png' height='28px' width='28px' /></a></div>";

}
?>