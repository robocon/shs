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
<div style='margin-top:50px;'>
<FORM name="form2" METHOD="POST" ACTION="ipd_drugslip_template.php" Onsubmit="return checkForm();">
<input type="hidden" name="act" id="act" value="add">
<input type="hidden" name="idno" id="idno" value="<?=$getid;?>">
<input type="hidden" name="an" id="an" value="<?=$getan;?>">
<input type="hidden" name="hn" id="hn" value="<?=$gethn;?>">
<input type="hidden" name="drugcode" id="drugcode" value="<?=$drugcode;?>">
<input type="hidden" name="tradname" id="tradname" value="<?=$tradname;?>">
<input type="hidden" name="slcode" id="slcode" value="<?=$slcode;?>">
<input type="hidden" name="nurse1" id="nurse1" value="<?=$sOfficer;?>">
<input type="hidden" name="register_time" id="register_time" value="<?=date("H:i:s");?>">
<TABLE bgcolor="#e0f2f1" width="80%" align="center" border="3" bordercolor="#009688" cellpadding="5" cellspacing="5" >
<TR>
	<TD>

<TABLE width="60%" cellpadding="3" cellspacing="3" style="font-size: 28px;" align="center">
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
        document.getElementById('ranktime1').style.display = '';
        document.getElementById('ranktime2').style.display = '';
        document.getElementById('ranktime3').style.display = '';
      }
    }
  </script>
	</TD>
</TR>
<TR>
	<TD width="30%" align="right">ช่วงเวลาที่ [1]: </TD>
	<TD >
	<select name="ranktime1" id="ranktime1" class="sarabun" style="width:250px; display:none;">
      <option value="0" selected>----- เลือกข้อมูล -----</option>
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
	<TD width="30%" align="right">ช่วงเวลาที่ [2]: </TD>
	<TD >
	<select name="ranktime2" id="ranktime2" class="sarabun" style="width:250px; display:none;">
      <option value="0" selected>----- เลือกข้อมูล -----</option>
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
	<TD width="30%" align="right">ช่วงเวลาที่ [3]: </TD>
	<TD >
	<select name="ranktime3" id="ranktime3" class="sarabun" style="width:250px; display:none;">
      <option value="0" selected>----- เลือกข้อมูล -----</option>
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