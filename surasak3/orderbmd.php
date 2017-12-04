<?
session_start();
include("connect.inc");
$style_menu=2;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
<?php include("dt_menu.php");?><BR>
<?php include("dt_patient.php");?>
<script>
	function frmcheck3(){
		 if(document.getElementById('ch1').checked==false&&document.getElementById('ch2').checked==false&&document.getElementById('ch3').checked==false&&document.getElementById('ch4').checked==false&&document.getElementById('ch5').checked==false&&document.getElementById('ch6').checked==false&&document.getElementById('ch7').checked==false&&document.getElementById('ch8').checked==false){
			alert("กรุณาเลือกข้อบ่งชี้การส่งตรวจด้วยคะ");
			return false;
		}
		else if(document.getElementById('typep2').selectedIndex==0){
			alert("กรุณาเลือกประเภทการตรวจด้วยคะ");
			return false;
		}
		else{
			return true;
		}
	}
</script>
<?
if(isset($_POST['okbtn'])){
	$ptname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
	$datenow = (date("Y")+543)."-".date("m-d H:i:s");
	
	if($_POST['datey']==""){
		if($_POST['radio1']=="Others"){
			$_POST['radio1']=$_POST['others'];
		}
		if($_POST['ch2']==""){
			$_POST['radio2']="";
		}
		
		if($_POST['ch4']==""){
			$_POST['txt1']="";
		}
		
		if($_POST['ch5']==""){
			$_POST['txt2']="";
		}
		
		if($_POST['ch7']==""){
			$_POST['txt3']="";
		}
		
		if($_POST['ch8']==""){
			$txt45="";
			$_POST['radio3']="";
		}elseif($_POST['radio3']=="1"){
			$_POST['radio3']="Disease associated with secondary osteoporosis";
			$txt45=$_POST['txt4'];
		}elseif($_POST['radio3']=="2"){
			$_POST['radio3']="Drug-induced bone loss";
			$txt45=$_POST['txt5'];
		}
		$type="กรณีส่งตรวจเป็นครั้งแรก";
	}else{
		$type="กรณีส่งตรวจเพื่อติดตามผล (ไม่เร็วกว่า 1 ปี)";
	}
	$sql = "insert into orderbmd (date,hn,ptname,age,ptright,doctor,partbmd,headsub,sub1,sub2,detail_sub2,sub3,sub4,detail_sub4,sub5,detail_sub5,sub6,sub7,detail_sub7,sub8,detail_sub8,detail_sub81,lastchk,status) values ('".$datenow."','".$_SESSION['hn_now']."','".$ptname."','".$_SESSION['age_now']."','".$_SESSION["ptright_now"]."','".$_SESSION['dt_doctor']."','".$_POST['radio1']."','".$type."','".$_POST['ch1']."','".$_POST['ch2']."','".$_POST['radio2']."','".$_POST['ch3']."','".$_POST['ch4']."','".$_POST['txt1']."','".$_POST['ch5']."','".$_POST['txt2']."','".$_POST['ch6']."','".$_POST['ch7']."','".$_POST['txt3']."','".$_POST['ch8']."','".$_POST['radio3']."','".$txt45."','".$_POST['datey']."','N')";
	$result = mysql_query($sql);
	$idno = mysql_insert_id($result);
	if($result){
		$idno = mysql_insert_id();
		$query = "select prefix,runno from runno where title = 'depart' ";
		$row = mysql_query($query);
		list($prefix,$runno) = mysql_fetch_array($row);
		
		$runno2=++$runno;
		$query2 = "update runno set runno='$runno2' where title='depart' ";
		mysql_query($query2);
		
		//$sql2 ="insert into depart (chktranx,date,ptname,hn,an,doctor,depart,item,detail,price,sumyprice,	sumnprice,paid,idname,diag,accno,tvn,ptright,lab,detailbydr,status,priority,patient_from) values ('".$runno2."','".$datenow."','".$ptname."','".$_SESSION['hn_now']."','','".$_SESSION['dt_doctor']."','OTHER','1','ค่าบริการทางการแพทย์','650.00','650.00','0.00','0.00','".$_SESSION['dt_doctor']."','ปวดเข่า','0','".$_SESSION['vn_now']."','".$_SESSION["ptright_now"]."','','','Y','','')";
		if($_POST['typep2']=="ตรวจวิเคราะห์เพื่อการรักษา"){
			$sql2 ="insert into dorderbmd (thidate,hn,ptname,age,doctor,code,item,detail,price,sumyprice,	sumnprice,tvn,ptright,idno,status) values ('".$datenow."','".$_SESSION['hn_now']."','".$ptname."','".$_SESSION['age_now']."','".$_SESSION['dt_doctor']."','42702','2','(42702
)Bone density: X-rays 1 part','2000.00','2000.00','0.00','".$_SESSION['vn_now']."','".$_SESSION["ptright_now"]."','".$idno."','N')";
		}else{
			$sql2 ="insert into dorderbmd (thidate,hn,ptname,age,doctor,code,item,detail,price,sumyprice,	sumnprice,tvn,ptright,idno,status) values ('".$datenow."','".$_SESSION['hn_now']."','".$ptname."','".$_SESSION['age_now']."','".$_SESSION['dt_doctor']."','42702','2','(42702
)Bone density: X-rays 1 part','2000.00','0.00','2000.00','".$_SESSION['vn_now']."','".$_SESSION["ptright_now"]."','".$idno."','N')";
		}
		$result = mysql_query($sql2);
	}
	echo "<br><br><center><font style='font-size:30px'><a href='orderbmd_ok.php?id=$idno'>Print Stricker BMD</a></font></center>";
}
else{
?>
<form name="form1" method="post" action="orderbmd.php" onsubmit="return frmcheck3();">
  <table width="100%" border="0" cellpadding="0" >
    <tr>
      <td><u><strong>กรุณาเลือกข้อบ่งชี้ในการส่งตรวจ BMD ด้วยเครื่อง axial DXA </strong></u><br />
        <input type="radio" name="radio1" id="radio8" value="hip" />
        Hip 
        <input type="radio" name="radio1" id="radio9" value="Spine" />
        Spine 
        <input type="radio" name="radio1" id="radio10" value="Others" />
        Others ระบุ
        <input type="text" name="others" />
        <br />
        <strong>** กรณีส่งตรวจเป็นครั้งแรก</strong><br />
<input type="checkbox" name="ch1" id="ch1" value="ผู้หญิงอายุตั้งแต่ 65 ปีขึ้นไป และผู้ชายอายุตั้งแต่ 70 ปีขึ้นไป"> ผู้หญิงอายุตั้งแต่ 65 ปีขึ้นไป และผู้ชายอายุตั้งแต่ 70 ปีขึ้นไป<br />
<input type="checkbox" name="ch2" id="ch2" value="สำหรับผู้หญิงที่มีอายุต่ำกว่า 65 ปี และผู้ชายที่มีอายุต่ำกว่า 70 ปีที่มีปัจจัยเสี่ยงต่อไปนี้อย่างน้อย 1 ข้อ">
สำหรับผู้หญิงที่มีอายุต่ำกว่า 65 ปี และผู้ชายที่มีอายุต่ำกว่า 70 ปีที่มีปัจจัยเสี่ยงต่อไปนี้อย่างน้อย 1 ข้อ<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio2" id="radio" value="Menopause < 45 Yr. (early menopause) include Bilateral Oophorectomy" />

Menopause &lt; 45 Yr. (early menopause) include Bilateral Oophorectomy<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio2" id="radio2" value="Estrogen deficiency before menopause >= 1 Yr. except pregnancy or lactation" />
Estrogen deficiency before menopause &gt;= 1 Yr. except pregnancy or lactation<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio2" id="radio3" value="Received glucocorticoid (>= Prednisolone 5 mg/d or equivalence for >= 3 Mo.)" />
Received glucocorticoid (&gt;= Prednisolone 5 mg/d or equivalence for &gt;= 3 Mo.)<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio2" id="radio4" value="Parental (mother,father) history of hip fracture" />
Parental (mother,father) history of hip fracture<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio2" id="radio5" value="Postmenopausal women with BMI < 19 kg/m^2" />
Postmenopausal women with BMI &lt; 19 kg/m^2
<br />
<input type="checkbox" name="ch3" id="ch3" value="Radiographic osteopenia and /or vertebral deformity by x-ray"> 
Radiographic osteopenia and /or vertebral deformity by x-ray<br />
<input type="checkbox" name="ch4" id="ch4" value="History of low-energy trauma fracture"> 
History of low-energy trauma fracture ระบุ
<input type="text" name="txt1" id="txt1" />
<br />
<input type="checkbox" name="ch5" id="ch5" value="Signification height loss">
Signification height loss ระบุ
<input type="text" name="txt2" id="txt2" />
<br />
<input type="checkbox" name="ch6" id="ch6" value="Postmenopausal women who has Intermediate risk from Risk Assessment Tool,such as OSTA score,KKOS SCORE or Nomogram > 0.3">
Postmenopausal women who has Intermediate risk from Risk Assessment Tool,such as OSTA score,KKOS SCORE or Nomogram &gt; 0.3
<br />
<input type="checkbox" name="ch7" id="ch7" value="Clinical risk factors (CRF)">
Clinical risk factors (CRF) ระบุ
<input type="text" name="txt3" id="txt3" />
<br />
<input type="checkbox" name="ch8" id="ch8" value="Risk of secondary osteoporosis">
Risk of secondary osteoporosis <br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio3" id="radio6" value="1" />
Disease associated with secondary osteoporosis ระบุ
<input type="text" name="txt4" id="txt4" />
<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="radio3" id="radio7" value="2" />
Drug-induced bone loss ระบุ
<input type="text" name="txt5" id="txt5" />
<br />
<?
$rQuery = "select * from patdata where hn='".$_SESSION['hn_now']."' and code = '42702' order by date desc";
$reps = mysql_query($rQuery);
$rresult = mysql_fetch_array($reps);
?>
<strong>** กรณีส่งตรวจเพื่อติดตามผล (ไม่เร็วกว่า 1 ปี) </strong><br />
ตรวจเมื่อวันที่
<input type="text" name="datey" id="datey" value="<?=substr($rresult,0,10)?>" /></td>
    </tr>
    <tr align="center">
      <td bgcolor="#FFCCCC"><strong>ประเภทการตรวจ :</strong>
        <select name="typep2" id="typep2">
          <option value="">- กรุณาเลือก -</option>
          <option value="ตรวจวิเคราะห์เพื่อการรักษา">ตรวจวิเคราะห์เพื่อการรักษา</option>
          <option value="ตรวจสุขภาพ">ตรวจสุขภาพ</option>
        </select></td>
    </tr>
    <tr align="center">
      <td>&nbsp;</td>
    </tr>
    <tr align="center">
      <td><input name="okbtn" type="submit" value=" ตกลง " /></td>
    </tr>
  </table>
</form>
<?
}
?>