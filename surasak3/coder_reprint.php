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
<title>ลงรหัสโรคผู้ป่วยนอก</title>
<?php
	
    $today=date("d-m-").(date("Y")+543);
    print "<strong class=\"txtsarabun\" style='font-size:28px;'>รายการใบตรวจโรคผู้ป่วยนอก</strong>";
	print "<strong class=\"txtsarabun\" style='margin-left:20px;font-size:28px;'>วันที่ $today</strong>";
    $today=(date("Y")+543)."-".date("m-d");	
?>
<div style="margin-left:50px; margin-top: 30px;">
<form method="post" action="coder_reprint.php">
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
<? if($_POST["act"]=="show"){
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
  <th bgcolor="#16A085">ชื่อ</th>
  <th bgcolor="#16A085" width="10%">HN</th>
  <th bgcolor="#16A085">VN</th>
  <th bgcolor="#16A085">AN</th>
  <th bgcolor="#16A085">รหัสโรค ICD10</th>  
  <th bgcolor="#16A085">ชื่อโรค</th> 
  <th bgcolor="#16A085">สิทธิ</th>
  <th bgcolor="#16A085">การมาโรงพยาบาล</th>
  <th bgcolor="#16A085">แพทย์</th>
  <th bgcolor="#16A085">คลินิก</th>
  <th bgcolor="#16A085">การคืน OPD</th>
  <th bgcolor="#16A085">ผู้บันทึกล่าสุด</th>
  <!--<th bgcolor="#16A085">วันที่ลงรหัส</th>-->
 </tr>

<?php
    $num=0;
	if(!empty($_POST["hn"])){
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' and hn='".$_POST["hn"]."' and thidate LIKE '$today%' and (toborow NOT LIKE 'EX05%' && toborow NOT LIKE 'EX13%') ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจาก HN ผู้ป่วย</div>";
	}else if(!empty($_POST["case"])){
		$case=substr($_POST["case"],0,4);
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' and toborow LIKE '".$case."%' and thidate LIKE '$today%' and (toborow NOT LIKE 'EX05%' && toborow NOT LIKE 'EX13%') ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลที่ค้นหาจากประเภทการมาโรงพยาบาล</div>";
	}else{
		$query = "SELECT thidate,thdatehn,ptname,hn,ptright,doctor,vn,clinic,toborow,an,icd10,diag,dxgroup,goup,okopd,officer2 FROM opday WHERE thidate like '$date%' and (toborow NOT LIKE 'EX05%' && toborow NOT LIKE 'EX13%') ORDER BY row_id ASC ";
		echo "<div style='font-size:22px;'>ข้อมูลทั้งหมดที่ลงทะเบียนวันนี้</div>";
	}	
	//echo $query;
	$result = mysql_query($query)
        or die("Query failed");


    while (list ($thidate,$thdatehn,$ptname,$hn,$ptright,$doctor,$vn,$clinic,$toborow,$an,$icd10,$diag,$dxgroup,$goup,$okopd,$office) = mysql_fetch_row ($result)) {
        $num++;
        $time=substr($thidate,11);		


	/*$sql112 = "Select office,regisdate From diag where hn = '".$hn."' and regisdate_en LIKE '$date%' order by row_id desc limit 1 ";
	$result112 = Mysql_Query($sql112);
	$numapp=mysql_num_rows($result112);
	list($office,$regisdate) = Mysql_fetch_row($result112);*/


if($icd10==""){
	$statusicd10="#F5B7B1";
}else{
	if($office=="ศิริวรรณ ปันทะรส" || $office=="ศรินทร รัตนชมภู" || $office=="อัญชัญ  ฉิมทิม"  || $office=="ทิพย์วรรณ จันทราช"){
		$statusicd10="#76D7C4";
	}else{
		$statusicd10="#EAEDED";
	}	
}	
        print (" <tr BGCOLOR='$statusicd10'>\n".
           "  <td align='center'>$num</td>\n".
           "  <td>$time</td>\n".
           "  <td>$ptname</td>\n".
           "  <td align='center'><a  href=\"dxopedit.php? cTdatehn=".urlencode($thdatehn)."&cPtname=".urlencode($ptname)."&cHn=".urlencode($hn)."&cGoup=".urlencode($goup)."&cDxg=".urlencode($dxgroup)."&cIcd10=".urlencode($icd10)."&cVn=".urlencode($vn)."\" target=\"_BLANK\" >$hn</a></td>\n".
           "  <td align='center'>$vn</td>\n".
		   "  <td>$an</td>\n".
		   "  <td align='center'><strong>$icd10</strong></td>\n".		   
		   "  <td>$diag</td>\n".
		   "  <td>$ptright</td>\n".
		   "  <td>$toborow</td>\n".
   		   "  <td>$doctor</td>\n".
		   "  <td>$clinic</td>\n".
		   "  <td align='center'>$okopd</td>\n".
		   "  <td>$office</td>\n".
		  /* "  <td>$regisdate</td>\n".	*/	   
		   " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>
</div>
<?
}
?>