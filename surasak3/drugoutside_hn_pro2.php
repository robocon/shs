<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สั่งซื้อยาและสั่งทำหัตถการนอกโรงพยาบาล</title>
<style type="text/css">
.font1 {
	font-family:Tahoma, Geneva, sans-serif;
	font-size:18px;
}
</style>
</head>
<script language="javascript">
function fncSubmit2(){
	if(document.form1.cHn.value=="" && document.form1.cAn.value==""){
		
		alert("กรุณาระบุ HN หรือ AN ครับ");
		document.form1.cHn.focus();
		return false;
	}
	document.form1.submit();
}

/*function fncSubmit2(){
	if(document.form2.doctor.value==""){
		
		alert("กรุณาเลือกชื่อ doctor");
		document.form2.doctor.focus();
		return false;
	}
	document.form2.submit();
}*/



/*function togglediv(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else{ 
		//document.getElementById(divid).style.display = 'none'; 
	} 
} 
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		//sss
	}
}*/


function chkvalue(){
	
	var name=document.getElementById('yot').value+''+document.getElementById('doctor').value.substring(5)
	
	//alert(name);
	
	document.getElementById('name').value=name;
	
}

</script>

<body>

<fieldset class="font1" style="width:100%">
  <legend>เลือกประเภท</legend><form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();">
<div align="center">
<input name="rdo2" type="radio" value="Y" onClick="javaScript:if(this.checked){document.all.chk1.style.display=''; document.all.chk2.style.display='none'; }">
ผู้ป่วยนอก
<input name="rdo2" type="radio" value="N" onClick="javaScript:if(this.checked){document.all.chk2.style.display=''; document.all.chk1.style.display='none';}">
ผู้ป่วยใน
</div>
<br>
<span id="chk1" style="display:none">
  <table border="0" align="center">
    <tr>
      <td>HN:</td>
      <td>
      <input name="cHn" type="text" class="font1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" /><a target=_self  href='../nindex.htm'> ไปเมนู</a>&nbsp;&nbsp;</td>
    </tr>
  </table>
  </span>
  <span id="chk2" style="display:none">
  <table border="0" align="center">
    <tr>
      <td>AN:</td>
      <td>
      <input name="cAn" type="text" class="font1" id="cAn" value="<?=$_POST['cAn'];?>" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" /><a target=_self  href='../nindex.htm'> ไปเมนู</a>&nbsp;&nbsp;</td>
    </tr>
  </table>
  </span>
  
</form>
</fieldset>
<br />

<?

if($_POST['button']=='ตกลง'){
	
include("connect.inc");

?>
    
<fieldset class="font1" style="width:100%">
  <legend>แบบสั่งซื้อยา/เวชภัณฑ์ นอกโรงพยาบาล </legend>
  <form id="form2" name="form2" method="post" onSubmit="JavaScript:return fncSubmit2();">


<table border="0" align="center">
  <tr>
    <td colspan="6" class="font1">วัน/เดือน/ปี : 
    
    <? 
	 $y=date('Y')+543;
	 $dm=date('d-m-');
	
	
	?>
      <input type="text" name="dateadd" id="dateadd"  class="font1" value="<?=$dm.$y;?>"/></td>
  </tr>
  <tr>
    <td colspan="6" class="font1">
	<? 
if($_POST['rdo2']=='Y'){ 
	
	$sql="select * from opcard where hn='".$_POST['cHn']."' ";
	$query=mysql_query($sql) or die (mysql_error());
	$numrow=mysql_num_rows($query);
	$arr=mysql_fetch_array($query);
	
	if($numrow){
	?>
	ผู้ป่วยนอก   ชื่อ-สกุล : <?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>  HN : <?=$arr['hn'];?>
    
    <input type="hidden" name="ptname" value="<?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>" />
     <input type="hidden" name="hn" value="<?=$arr['hn'];?>" />
	<?
		}else{
		echo "<font color='#FFFFFF' style='background-color:red'>HN ไม่ถูกต้อง ระบุใหม่</font>";	
		}
		
		
	}else if($_POST['rdo2']=='N'){
		
	$sql1="select * from  ipcard where an='".$_POST['cAn']."' ";
	$query1=mysql_query($sql1) or die (mysql_error());	
	$numrow1=mysql_num_rows($query1);
	$arr1=mysql_fetch_array($query1);
		if($numrow1){
	?>
     ผู้ป่วยใน   ชื่อ-สกุล : <?=$arr1['ptname'];?>  AN :  <?=$arr1['an'];?>  หอผู้ป้วย  : <?=$arr1['my_ward'];?>
     
     <input type="hidden" name="ptname" value="<?=$arr1['ptname'];?>" />
     <input type="hidden" name="an" value="<?=$arr1['an'];?>" />
	<?
	
			}else{
		echo "<font color='#FFFFFF' style='background-color:red'>AN ไม่ถูกต้อง ระบุใหม่</font>";
		}
	}
	?></td>
  </tr>
  <tr>
    <td colspan="6" class="font1">ซึ่งป่วยเป็นโรค
  <input type="text" name="diag" id="diag"  class="font1"/></td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
    <td width="398">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="font1">ระบุ รายการ/จำนวน วิธีใช้ยา</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">1. 
      <input name="textfield1" type="text"  class="font1" id="textfield1" size="70"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">2.
      <input name="textfield2" type="text"  class="font1" id="textfield2" size="70"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">3.
      <input name="textfield3" type="text"  class="font1" id="textfield3" size="70"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">4.
      <input name="textfield4" type="text"  class="font1" id="textfield4" size="70"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">5.
      <input name="textfield5" type="text"  class="font1" id="textfield5" size="70"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td width="231" align="center" class="font1">&nbsp;</td>
    <td width="134" colspan="2" align="center" class="font1">&nbsp;</td>
    <td colspan="3" align="center" class="font1">เภสัชกร 
      <label for="name2"></label>
      <input type="text" name="name2" id="name2" /></td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1">&nbsp;</td>
    <td colspan="3" align="center" class="font1">แพทย์      
      <select name="doctor" id="doctor"  onchange="chkvalue();">
        <?php 
		 echo "<option value=''>-- กรุณาเลือกแพทย์ --</option>";
		$sql = "Select name From doctor where status = 'y' ";
		$result = mysql_query($sql);
		while(list($name) = mysql_fetch_row($result)){
		
		echo "<option value='".$name."' >".$name."</option>";
		
		}
		?>
      </select></td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1">&nbsp;</td>
    <td width="117" align="center" class="font1">&nbsp;</td>
    <td width="4" align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
  </tr>

  <tr>
    <td colspan="6" align="center" class="font1"><input name="button2" type="submit" class="font1" id="button2" value="ตกลง" /></td>
    </tr>
  </table>

  </form>
</fieldset>
<?
 }
 
if($_POST['button2']){
 
 include("connect.inc");
 $thidate = (date("Y")+543).date("-m-d H:i:s"); 
 
			$query = "SELECT title,runno FROM runno WHERE title = 'drugout'";
			$result = mysql_query($query)
				or die("Query failed");
		
			for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
				if (!mysql_data_seek($result, $i)) {
					echo "Cannot seek to row $i\n";
					continue;
				}
		
				if(!($row = mysql_fetch_object($result)))
					continue;
				 }
		
			$nRunno=$row->runno;
			$nRunno++;
		
			$query ="UPDATE runno SET runno = $nRunno WHERE title='drugout'";
			$result = mysql_query($query) or die("Query failed");
			
			
			
			$str="INSERT INTO `drugoutside` ( `runno` , `regisdate` ,`dateadd`, `ptname` , `hn` , `an`, `diag` ,  `name` ,`name2`)
VALUES (
'$nRunno', '". $thidate."', '".$_POST['dateadd']."', '". $_POST['ptname']."', '".$_POST['hn']."', '".$_POST['an']."', '".$_POST['diag']."', '".$_POST['doctor']."', '".trim($_POST['name2'])."')";
			$strq=mysql_query($str);
			//echo $str;
			$id=mysql_insert_id();
			
			for($i=1;$i<=5;$i++){
			
			if($_POST['textfield'.$i]!=''){
				
			$str2="INSERT INTO `drugoutside_list` (`ref_id` , `list_detail` ) VALUES ('$id' , '".$_POST['textfield'.$i]."')";
			$str2=mysql_query($str2);	
			}
			}
			
			if($strq && $str2){
				
				echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_print_pro2.php?id=$id'>";

			}else{
				
				echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_hn_pro2.php";
			}
			
}
?>
</body>
</html>