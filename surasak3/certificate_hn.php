<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สมุดทะเบียนใบรับรองแพทย์</title>
<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:20px;
}
.font2 {
	font-family: "TH Niramit AS";
	font-size:16px;
}
</style>
<link type="text/css" href="datepicker/dateopd/jquery-ui-1.8.10.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="datepicker/dateopd/jquery-1.4.4.min.js"></script>
		<script type="text/javascript" src="datepicker/dateopd/jquery-ui-1.8.10.offset.datepicker.min.js"></script>
		<script type="text/javascript">
		  $(function () {
		    var d = new Date();
		    var toDay = d.getDate() + '/' + (d.getMonth() + 1) + '/' + (d.getFullYear() + 543);


		    $("#thaidate").datepicker({ dateFormat: 'dd/mm/yy', isBuddhist: true, defaultDate: toDay, dayNames: ['อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์'],
              dayNamesMin: ['อา.','จ.','อ.','พ.','พฤ.','ศ.','ส.'],
              monthNames: ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'],
              monthNamesShort: ['ม.ค.','ก.พ.','มี.ค.','เม.ย.','พ.ค.','มิ.ย.','ก.ค.','ส.ค.','ก.ย.','ต.ค.','พ.ย.','ธ.ค.']});

			});
		</script>
		<style type="text/css">

			.demoHeaders { margin-top: 2em; }
			#dialog_link {padding: .4em 1em .4em 20px;text-decoration: none;position: relative;}
			#dialog_link span.ui-icon {margin: 0 5px 0 0;position: absolute;left: .2em;top: 50%;margin-top: -8px;}
			ul#icons {margin: 0; padding: 0;}
			ul#icons li {margin: 2px; position: relative; padding: 4px 0; cursor: pointer; float: left;  list-style: none;}
			ul#icons span.ui-icon {float: left; margin: 0 4px;}
			ul.test {list-style:none; line-height:30px;}
		</style>
</head>
<script language="javascript">
function fncSubmit(){
	if(document.form1.cHn.value==""){
		
		alert("กรุณาระบุ HN ด้วยครับ");
		document.form1.cHn.focus();
		return false;
	}
	document.form1.submit();
}

function fncSubmit2(){
	if(document.form2.doctor.value==""){
		
		alert("กรุณาเลือกชื่อ doctor");
		document.form2.doctor.focus();
		return false;
	}
	document.form2.submit();
}


function chkvalue(){
	
	var name=document.getElementById('doctor').value;
	
	document.getElementById('name').value=name ;
	
}

</script>

<body>
<h1 class="font1">สมุดทะเบียนใบรับรองแพทย์</h1>

<fieldset class="font1" style="width:50%">
  <legend>ระบุ HN </legend><form id="form1" name="form1" method="post" >
  <table border="0" align="center">
    <tr>
      <td>HN:</td>
      <td>
      <input name="cHn" type="text" class="font1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
    </td>
    </tr>
    <tr>
      <td colspan="2" align="center">  <a target=_self  href='../nindex.htm'> ไปเมนู </a> &nbsp;&nbsp;&nbsp; <a href='certificate_report.php' class='font1' target="_blank">สมุดทะเบียนใบรองแพทย์</a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />

<?

if($_POST['button']=='ตกลง'){
	
include("connect.inc");


	
	$sql="select * from opcard where hn='".$_POST['cHn']."' ";
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	$arr=mysql_fetch_array($query);
	

	?>
    
<fieldset class="font1" style="width:100%">
  <legend>สมุดทะเบียนใบรับรองแพทย์</legend>
  <form id="form2" name="form2" method="post" onSubmit="JavaScript:return fncSubmit2();">
<? 	//if($numrow){ ?>
<table border="0" align="center">
  <tr>
    <td align="right">เล่มที่</td>
    <td><label for="bookid"></label>
      <input name="bookid" type="text" class="font1" id="bookid" size="10" /></td>
    </tr>
  <tr>
    <td align="right">เลขที่</td>
    <td><input name="noid" type="text" class="font1" id="noid" size="10" /></td>
  </tr>
  <tr>
    <td align="right">ชื่อ-สกุล</td>
    <td><input name="ptname" type="text" class="font1" id="ptname" value="<?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>" size="40" readonly="readonly" /></td>
  </tr>
  <tr>
    <td align="right">HN</td>
    <td><input name="hn" type="text" class="font1" id="hn"  value="<?=$arr['hn'];?>" readonly="readonly"/></td>
  </tr>
  <tr>
    <td align="right">การวินิจฉัย</td>
    <td><textarea name="diag" cols="45" rows="2" class="font1" id="diag"></textarea></td>
  </tr>
  <tr>
    <td align="right" valign="top">ความคิดเห็น</td>
    <td><label for="comment"></label>
      <textarea name="comment" cols="45" rows="5" class="font1" id="comment"></textarea></td>
  </tr>
  <tr>
    <td align="right">แพทย์</td>
    <td><select name="doctor" id="doctor">
      <?php 
		echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
		echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
    </select></td>
  </tr>
  <tr>
    <td align="right">วัน/เดือน/ปี ที่ออกใบรับรองแพทย์</td>
    <td><input name="thaidate" type="text" class="font1" />
    เช่น *09/09/2555*</td>
  </tr>
  <tr>
    <td colspan="2" align="center" class="font1"><input name="button2" type="submit" class="font1" id="button2" value="ตกลง" /></td>
  </tr>
  </table>
  <? //} else{
	 /* echo "<br>";
	  echo "<div class=\"font1\">ไม่พบ HN :  ".$_POST['cHn']."  ในระบบ</div>";
	  echo "<br>";*/
 // }
  ?>

  </form>
</fieldset>
<?
 }
 
if($_POST['button2']){
 
 include("connect.inc");
 $thidate = (date("Y")+543).date("-m-d H:i:s"); 
 


	$str="INSERT INTO `certificate` ( `bookid` , `noid` , `hn` , `ptname` , `diag` , `doctor` , `comment` , `thaidate` , `regisdate`,status )
VALUES ('".$_POST['bookid']."','".$_POST['noid']."', '".$_POST['hn']."', '".$_POST['ptname']."', '".$_POST['diag']."','".$_POST['doctor']."', '".$_POST['comment']."', '".$_POST['thaidate']."', '".$thidate."','Y')";
			$strq=mysql_query($str)or die (mysql_error());
			
		//	$id=mysql_insert_id();
			
			
			if($strq){
				
				//echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_print.php?id=$id'>";
			 echo "<div align='center' class='font1'>บันทึกข้อมูลเรียบร้อยแล้ว  ตรวจสอบข้อมูลได้ที่ <a href='certificate_report.php' class='font1' target='_blank'>สมุดใบรองแพทย์</a></div>";

			}else{
				
				echo "ไม่สามารถบันทึกข้อมูลได้";
			}
			
}
?>
</body>
</html>