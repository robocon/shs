<?
session_start();
include("connect.inc");	
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบลงทะเบียนผู้ป่วยโควิด</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	background-color:#b2dfdb;
	font-size: 24px;
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

.button-blue {
  background-color: #008CBA; /* blue */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
}

#color1 {
  accent-color: green;
  width:19px;
  height:19px;  
}
#color2 {
  accent-color: yellow;
  width:19px;
  height:19px;  
}
#color3 {
  accent-color: red;
  width:19px;
  height:19px;
}

</style>

<script LANGUAGE="JavaScript">
function checkForm(){
	
	if(document.frm.color1.checked == false && document.frm.color2.checked == false && document.frm.color3.checked == false){
		alert('กรุณาระบุกลุ่มอาการด้วยครับ');
		return false;
	}else{
		return true;
	}
}
</script>
<?
$thdatehn=$_GET["thidatehn"];
$hn=$_GET["hn"];
$query = "SELECT * FROM opday WHERE hn = '".$_GET["hn"]."' and thdatehn='$thdatehn' limit 1"; 
//echo $query;
$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}

	$cVn=$row->vn;
	$cHn=$row->hn;
	$cPtname=$row->ptname;
	$cPtright=$row->ptright;
	$cPtright=$cPtright;
	$cAge =$row->age;
	
	
	$sql111 = "Select idcard,phone,congenital_disease From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($idcard,$phone,$opcard_congenital_disease) = Mysql_fetch_row($result111);
	
	if($opcard_congenital_disease==""){
		$congenital_disease="ปฎิเสธโรคประจำตัว";
	}else{
		if( strstr( $opcard_congenital_disease, "HIV" ) || strstr( $opcard_congenital_disease, "hiv" ) || strstr( $opcard_congenital_disease, "B24" ) || strstr( $opcard_congenital_disease, "b24" ) || strstr( $opcard_congenital_disease, "เชื้อราในสมอง" )) {
			$sql113 = "Select napnumber From hiv where hn='".$hn."' ";
			$result113 = Mysql_Query($sql113);
			list($napnumber) = Mysql_fetch_row($result113);		
			if(!empty($napnumber)){
				$congenital_disease=$napnumber;		
			}else{
				$pos = strrpos($congenital_disease, "B24");
				if ($pos === false) { 
					$congenital_disease="ปฎิเสธ";
				}else{
					$congenital_disease=$congenital_disease;
				}	
			}	
		}else{
			$congenital_disease=$opcard_congenital_disease;
		}		
	}	
?>
<body>
<div class="">
<div align="center" style="margin-top:50px;"><img src="images/covid-test.png" width="96px" height="96px"></div>
 <h1 align="center">ระบบลงทะเบียนผู้ป่วยโควิด OP Self Isolation</h1>
<form name="frm" id="frm" method="POST" action="opselfisolation_home.php" Onsubmit="return checkForm();">
<input type="hidden" name="act" value="add">
<input type="hidden" name="type" value="SI">
<input type="hidden" name="hn" value="<?=$hn;?>">
<input type="hidden" name="thdatehn" value="<?=$thdatehn?>">
<h3 align="center">HN : <?=$cHn;?>&nbsp;&nbsp;&nbsp;VN : <?=$cVn;?>&nbsp;&nbsp;&nbsp;ชื่อ-นามสกุล : <?=$cPtname;?>&nbsp;&nbsp;&nbsp;เลขบัตรประชาชน : <?=$idcard;?><br>
อายุ : <?=$cAge;?>&nbsp;&nbsp;&nbsp;สิทธิการรักษา : <?=$cPtright;?><br>
โรคประจำตัว : <?=$congenital_disease;?>
</h3>
<h2 align="center"><strong>ระบุกลุ่มอาการของผู้ป่วย</strong></h2>
<div align="center">
<input type="radio" name="color" id="color1" value="green"><label for="color1">ผู้ป่วยกลุ่มอาการสีเขียว</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="color" id="color2" value="yellow"><label for="color2">ผู้ป่วยกลุ่มอาการสีเหลือง</label>&nbsp;&nbsp;&nbsp;
<input type="radio" name="color" id="color3" value="red"><label for="color3">ผู้ป่วยกลุ่มอาการสีแดง</label>
<p><button name="submit" type="submit" class="button-blue" value="submit" /><img src="images/data-storage.png" height="22px" width="22px" /><span style="margin-left:10px;">ลงทะเบียนผู้ป่วยโควิด</span></button></p>
</div>
</form> 
</div>

<?
if($_POST["act"]=="add"){

$thdatehn=$_POST["thdatehn"];
$hn=$_POST["hn"];

	$sql ="UPDATE opday SET opdtype='".$_POST["type"]."', opdcolor='".$_POST["color"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
	$result = Mysql_Query($sql) or die(Mysql_Error());
	
		$sql = "Select vn,ptname,age,ptright From opday where thdatehn = '".$thdatehn."'  limit 1";
		$arr = mysql_fetch_assoc(mysql_query($sql));
		
		$sql1 = "Select phone From opcard where hn = '".$hn."' limit 1";
		$query1=mysql_query($sql1);
		$arr1 = mysql_fetch_assoc($query1);
		
		$registerdate=date("Y-m-d");
		$officer_date=date("Y-m-d H:i:s");
		
		$plandate1 = date ("Y-m-d", strtotime("+2 day", strtotime($registerdate)));
		$plandate2 = date ("Y-m-d", strtotime("+6 day", strtotime($registerdate)));

		$sql2 = "Select thdatehn,status_day1,status_day2 From opselfisolation where hn = '".$hn."' order by row_id desc limit 1";
		//echo $sql2."<br>";
		$query2=mysql_query($sql2);
		$num2=mysql_num_rows($query2);
		$arr2 = mysql_fetch_assoc($query2);
		//echo "==>".$num2."<br>";
		//echo "==>".$arr2["thdatehn"];
		
		if($num2 > 0){  //ถ้ามีข้อมูลผู้ป่วย
			if($arr2["thdatehn"]==$thdatehn){  //ถ้าตรงกับวันเดียวกัน ปรับปรุงข้อมูล
				$add ="UPDATE opselfisolation SET vn='".$arr["vn"]."', ptname='".$arr["ptname"]."',age='".$arr["age"]."',ptright='".$arr["ptright"]."',phone='".$arr1["phone"]."'  WHERE  thdatehn='".$thdatehn."'";   // แก้ไขข้อมูลตาราง opday
				//echo $add;
				if(mysql_query($add)){
					echo "<script>window.open('opselfisolation_printstk.php?hn=$hn','mywin','width=1100,height=800');</script>";
					echo "<script>alert('บันทึกลงทะเบียนผู้ป่วยโควิดเรียบร้อย');window.location='opselfisolation_register.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}else{
					echo "<script>alert('ผิดพลาด...บันทึกลงทะเบียนผู้ป่วยโควิดไม่สำเร็จ');window.location='opselfisolation_home.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}			
			}else{  //ป่วยซ้ำ
				$add="insert into opselfisolation set registerdate='$registerdate',
													  thdatehn='$thdatehn',
													  hn='".$hn."',
													  vn='".$arr["vn"]."',
													  ptname='".$arr["ptname"]."',
													  age='".$arr["age"]."',
													  ptright='".$arr["ptright"]."',
													  phone='".$arr1["phone"]."',
													  plandate1='$plandate1',
													  plandate2='$plandate2',
													  status_day1='n',
													  status_day2='n',
													  officer = '".$_SESSION["sOfficer"]."',
													  officer_date='$officer_date'";
				//echo $add;									  
				if(mysql_query($add)){
					echo "<script>window.open('opselfisolation_printstk.php?hn=$hn','mywin','width=1100,height=800');</script>";
					echo "<script>alert('บันทึกลงทะเบียนผู้ป่วยโควิดเรียบร้อย');window.location='opselfisolation_register.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}else{
					echo "<script>alert('ผิดพลาด...บันทึกลงทะเบียนผู้ป่วยโควิดไม่สำเร็จ');window.location='opselfisolation_home.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}		
			}
		}else{  //ถ้าไม่มีข้อมูลผู้ป่วย ป่วยใหม่
				$add="insert into opselfisolation set registerdate='$registerdate',
													  thdatehn='$thdatehn',
													  hn='".$hn."',
													  vn='".$arr["vn"]."',
													  ptname='".$arr["ptname"]."',
													  age='".$arr["age"]."',
													  ptright='".$arr["ptright"]."',
													  phone='".$arr1["phone"]."',
													  plandate1='$plandate1',
													  plandate2='$plandate2',
													  status_day1='n',
													  status_day2='n',
													  officer = '".$_SESSION["sOfficer"]."',
													  officer_date='$officer_date'";
				//echo $add;									  
				if(mysql_query($add)){
					echo "<script>window.open('opselfisolation_printstk.php?hn=$hn','mywin','width=1100,height=800');</script>";
					echo "<script>alert('บันทึกลงทะเบียนผู้ป่วยโควิดเรียบร้อย');window.location='opselfisolation_register.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}else{
					echo "<script>alert('ผิดพลาด...บันทึกลงทะเบียนผู้ป่วยโควิดไม่สำเร็จ');window.location='opselfisolation_home.php?hn=$hn&thidatehn=$thdatehn';</script>";
				}					
		}
		
}
?>


</body>
</html>