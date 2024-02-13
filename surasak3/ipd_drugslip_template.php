<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>กำหนดเวลาการให้ยา</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#e1f5fe;
	font-size: 28px;
 }	
.sarabun {	font-family: TH SarabunPSK;
	font-size: 28px;
} 
@media print{
	#no-print{ display: none; }
	#sticker-contain{ padding: 0; }
}
a:link, a:visited {
  background-color: white;
  color: black;
  border: 2px solid #2980B9;
  padding: 10px 20px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-weight:bold;
}

a:hover, a:active {
  background-color: #2980B9;
  color: white;
}
</style>
<body>
<?
if($_POST["act"]=="add"){
	$row_id=$_POST["row_id"];
	$an=$_POST["an"];
	$hn=$_POST["hn"];
	$getmonth=$_POST["month"];
	$getyear=$_POST["year"];
	$getdate=$_POST["date"];	
	
	$add="UPDATE dgprofile set ranktime='".$_POST["ranktime"]."',
								ranktime1='".$_POST["ranktime1"]."',
								ranktime2='".$_POST["ranktime2"]."',
								ranktime3='".$_POST["ranktime3"]."' where row_id='$row_id'";
	//echo $add;							
	if($query=mysql_query($add)){		
		echo "<script>alert('บันทึกเวลาการให้ยาผู้ป่วย AN:$an ในระบบเรียบร้อย');window.location='ipd_drugchk.php?an=$an&hn=$hn&month=$getmonth&year=$getyear&date=$getdate';</script>";
	}else{
		echo "<script>alert('ผิดพลาด ไม่สามารถบันทึกเวลาการให้ยาผู้ป่วย AN:$an ในระบบได้');window.location='ipd_drugslip_template.php?an=$an&hn=$hn&month=$getmonth&year=$getyear&date=$getdate';</script>";
	}	
}	
$getid=$_GET["row_id"];
$getan=$_GET["an"];
$gethn=$_GET["hn"];
$getmonth=$_GET["month"];
$getyear=$_GET["year"];
$getdate=$_GET["date"];

	$sql3 = "Select drugcode,tradname,slcode,statcon,ranktime,ranktime1,ranktime2,ranktime3 From dgprofile where row_id = '$getid'";
	//echo $sql3;
	$query3 = mysql_query($sql3);
	$result3 = mysql_fetch_array($query3);
	$dgprofile_rows = mysql_num_rows($result3);
	$drugcode=$result3["drugcode"];
	$tradname=$result3["tradname"];
	$slcode=$result3["slcode"];
	$showranktime=$result3["ranktime"];
	$ranktime1=$result3["ranktime1"];
	$ranktime2=$result3["ranktime2"];
	$ranktime3=$result3["ranktime3"];
	
	if($showranktime=="iv q 8 hr (กำหนดเอง)"){
			$textranktime="$ranktime1, $ranktime2, $ranktime3";
	}else if($showranktime=="iv OD (กำหนดเอง)"){
			$textranktime="$ranktime1";
	}else{
	$list1 = array();
	$sql = "Select  ranktime From drugslip_ipd  where slcode = '".$showranktime."'";
	$result = Mysql_Query($sql);
	$drugslip_rows = mysql_num_rows($result);
		if($drugslip_rows>0){
			while($arr = Mysql_fetch_assoc($result)){
				array_push($list1 ,$arr["ranktime"]);
			}
			$list_drugslip1 = implode(", ",$list1);
			$textranktime .= $list_drugslip1;
		}	
	}		
	
	$sql4 = "SELECT slcode,detail1,detail2,detail3,detail4 FROM drugslip WHERE slcode = '$slcode' ";
	$query4 = mysql_query($sql4);
	$result4 = mysql_fetch_array($query4);
	$textslcode=$result4["detail1"]." ".$result4["detail2"]." ".$result4["detail3"]." ".$result4["detail4"];
	

?>
<div style='margin-top:50px;'>
<div align="center"><strong>กำหนดเวลาการให้ยาผู้ป่วย</strong></div>
<FORM name="form2" METHOD="POST" ACTION="ipd_drugslip_template.php" Onsubmit="return checkForm();">
<input type="hidden" name="act" id="act" value="add">
<input type="hidden" name="row_id" id="row_id" value="<?=$getid;?>">
<input type="hidden" name="an" id="an" value="<?=$getan;?>">
<input type="hidden" name="hn" id="hn" value="<?=$gethn;?>">
<input type="hidden" name="month" id="month" value="<?=$getmonth;?>">
<input type="hidden" name="year" id="year" value="<?=$getyear;?>">
<input type="hidden" name="date" id="date" value="<?=$getdate;?>">
<TABLE bgcolor="#e0f2f1" width="50%" align="center" border="3" bordercolor="#009688" cellpadding="5" cellspacing="5" >
<TR>
	<TD>

<TABLE width="100%" cellpadding="3" cellspacing="3" style="font-size: 28px;" align="center">
<TR>
	<TD width="30%" align="right">รหัสยา : </TD>
	<TD ><?php echo $drugcode;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">ชื่อยา : </TD>
	<TD ><?php echo $tradname;?></TD>
</TR>
<TR>
	<TD width="30%" align="right">วิธีใช้ยา : </TD>
	<TD ><?=$slcode." ($textslcode)";?></TD>
</TR>
<TR>
	<TD width="30%" align="right">เวลาการให้ยาล่าสุด : </TD>
	<TD ><?=$showranktime." ($textranktime)";?></TD>
</TR>
<TR>
	<TD width="30%" align="right">ช่วงเวลาที่ต้องให้ยา : </TD>
	<TD >
    <select name="ranktime" id="ranktime" class="sarabun" style="width:250px;" onchange="show_tr()">
	<option value="0">----- เลือกข้อมูล -----</option>	
	<?
		$sql="select * from drugslip_ipd group by slcode order by slcode";
		$query = mysql_query($sql);
		while($result = mysql_fetch_array($query)){
		echo '<option value="'.$result['slcode'].'">'.$result['slcode'].' </option>';
		} 
	?>
	</select>	
  <script>
    function show_tr(){
      var ranktime = document.getElementById('ranktime');
      if(ranktime.value=='iv q 8 hr (กำหนดเอง)'){
        document.getElementById('rank1').style.display = '';
        document.getElementById('rank2').style.display = '';
        document.getElementById('rank3').style.display = '';
      }
	  
      if(ranktime.value=='iv OD (กำหนดเอง)'){
        document.getElementById('rank1').style.display = '';
        document.getElementById('rank2').style.display = 'none';
        document.getElementById('rank3').style.display = 'none';
      }	  
    }
  </script>
	</TD>
</TR>
<TR id="rank1" style="display:none;">
	<TD width="30%" align="right">ช่วงเวลาที่ [1]: </TD>
	<TD >
	<select name="ranktime1" id="ranktime1" class="sarabun" style="width:250px;">
      <option value="" selected>----- เลือกข้อมูล -----</option>
      <option value="01:00">01.00 น.</option>
      <option value="02:00">02.00 น.</option>
      <option value="03:00">03.00 น.</option>
	  <option value="04:00">04.00 น.</option>
      <option value="05:00">05.00 น.</option>
      <option value="06:00">06.00 น.</option>
      <option value="07:00">07.00 น.</option>
      <option value="08:00">08.00 น.</option>
      <option value="09:00">09.00 น.</option>
      <option value="10:00">10.00 น.</option>
      <option value="11:00">11.00 น.</option>
      <option value="12:00">12.00 น.</option>
      <option value="13:00">13.00 น.</option>
      <option value="14:00">14.00 น.</option>
      <option value="15:00">15.00 น.</option>
      <option value="16:00">16.00 น.</option>
      <option value="17:00">17.00 น.</option>
      <option value="18:00">18.00 น.</option>
      <option value="19:00">19.00 น.</option>	  
      <option value="20:00">20.00 น.</option>
      <option value="21:00">21.00 น.</option>
      <option value="22:00">22.00 น.</option>
      <option value="23:00">23.00 น.</option>
      <option value="24:00">24.00 น.</option>	  
        </select>	
	</TD>
</TR>
<TR id="rank2" style="display:none;">
	<TD width="30%" align="right">ช่วงเวลาที่ [2]: </TD>
	<TD >
	<select name="ranktime2" id="ranktime2" class="sarabun" style="width:250px;">
      <option value="" selected>----- เลือกข้อมูล -----</option>
      <option value="01:00">01.00 น.</option>
      <option value="02:00">02.00 น.</option>
      <option value="03:00">03.00 น.</option>
	  <option value="04:00">04.00 น.</option>
      <option value="05:00">05.00 น.</option>
      <option value="06:00">06.00 น.</option>
      <option value="07:00">07.00 น.</option>
      <option value="08:00">08.00 น.</option>
      <option value="09:00">09.00 น.</option>
      <option value="10:00">10.00 น.</option>
      <option value="11:00">11.00 น.</option>
      <option value="12:00">12.00 น.</option>
      <option value="13:00">13.00 น.</option>
      <option value="14:00">14.00 น.</option>
      <option value="15:00">15.00 น.</option>
      <option value="16:00">16.00 น.</option>
      <option value="17:00">17.00 น.</option>
      <option value="18:00">18.00 น.</option>
      <option value="19:00">19.00 น.</option>	  
      <option value="20:00">20.00 น.</option>
      <option value="21:00">21.00 น.</option>
      <option value="22:00">22.00 น.</option>
      <option value="23:00">23.00 น.</option>
      <option value="24:00">24.00 น.</option>	  
        </select>	
	</TD>
</TR>
<TR id="rank3" style="display:none;">
	<TD width="30%" align="right">ช่วงเวลาที่ [3]: </TD>
	<TD >
	<select name="ranktime3" id="ranktime3" class="sarabun" style="width:250px;">
      <option value="" selected>----- เลือกข้อมูล -----</option>
      <option value="01:00">01.00 น.</option>
      <option value="02:00">02.00 น.</option>
      <option value="03:00">03.00 น.</option>
	  <option value="04:00">04.00 น.</option>
      <option value="05:00">05.00 น.</option>
      <option value="06:00">06.00 น.</option>
      <option value="07:00">07.00 น.</option>
      <option value="08:00">08.00 น.</option>
      <option value="09:00">09.00 น.</option>
      <option value="10:00">10.00 น.</option>
      <option value="11:00">11.00 น.</option>
      <option value="12:00">12.00 น.</option>
      <option value="13:00">13.00 น.</option>
      <option value="14:00">14.00 น.</option>
      <option value="15:00">15.00 น.</option>
      <option value="16:00">16.00 น.</option>
      <option value="17:00">17.00 น.</option>
      <option value="18:00">18.00 น.</option>
      <option value="19:00">19.00 น.</option>	  
      <option value="20:00">20.00 น.</option>
      <option value="21:00">21.00 น.</option>
      <option value="22:00">22.00 น.</option>
      <option value="23:00">23.00 น.</option>
      <option value="24:00">24.00 น.</option>	  
        </select>	
	</TD>
</TR>
<TR>
	<TD width="30%" align="right"></TD>
	<TD ><input name="B1" type="submit" class="sarabun" value="    บันทึกข้อมูล    ">
&nbsp;&nbsp;&nbsp;&nbsp;<!--<input type="button" name="button" id="button" value="    ข้อมูลยาเพิ่มเติม    " onclick="window.open('ipd_drugorder_detail.php') " class="sarabun" />-->
	</TD>
</TR>
</TABLE>
<br>
</TD>
</TR>
</TABLE>
</FORM>
</div>
</body>
</html>