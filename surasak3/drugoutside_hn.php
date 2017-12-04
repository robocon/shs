<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>สั่งซื้อยาและสั่งทำหัตถการนอกโรงพยาบาล</title>
<style type="text/css">
/*.font1 {
	font-family:Tahoma, Geneva, sans-serif;
	font-size:18px;
}*/
</style>
</head>
<script language="javascript">
function fncSubmit(){
	if(document.form1.cHn.value=="" && document.form1.cAn.value==""){
		
		alert("กรุณาระบุ HN หรือ AN ด้วยครับ");
		/*document.form1.cHn.focus();*/
		return false;
	}
	if(document.form1.cHn.value!="" && document.form1.cAn.value!=""){
		
		alert("กรุณาระบุ HN หรือ AN อย่างใดอย่างหนึ่งครับ");
		/*document.form1.cHn.focus();*/
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
	
	var name=document.getElementById('yot').value+''+document.getElementById('doctor').value.substring(5)
	
	//alert(name);
	
	document.getElementById('name').value=name ;
	
}

///////////////////////////////////////
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function searchSuggest(str,len,number) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'drugoutside_hn.php?action=dgdrug&search=' + str+'&num=' + number;

			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>


<?
if(isset($_GET["action"]) && $_GET["action"] =="dgdrug"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname,genname,unit,part from druglst  where  drugcode like '%".$_GET["search"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:800px; height:430px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(สามัญ)</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>หน่วย</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>ประเภท</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


	if(isset($_GET['num'])){
		$_GET["getto"]="textfield".$_GET['num'];
		
		}


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",(trim($se["drugcode"]).'&nbsp;&nbsp;&nbsp;/'.trim($se['tradname']).'&nbsp;&nbsp;&nbsp;('.trim($se['genname']).') &nbsp;&nbsp;&nbsp;จำนวน&nbsp;&nbsp;เม็ด'),"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>".$se['genname']."</td><td>".$se['unit']."</td><td>".$se['part']."</td>
		<td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>

<body>


<fieldset class="font1" style="width:100%">
  <legend>ระบุ HN </legend><form id="form1" name="form1" method="post"  onSubmit="JavaScript:return fncSubmit();">
  <table border="0" align="center">
    <tr>
      <td>HN :</td>
      <td>
      <input name="cHn" type="text" class="font1" id="cHn" value="<?=$_POST['cHn'];?>" /></td>
      <td>ผู้ป่วยนอก</td>
    </tr>
    <tr>
      <td>AN :</td>
      <td><input name="cAn" type="text" class="font1" id="cAn" value="<?=$_POST['cAn'];?>" /></td>
      <td>ผู้ป่วยใน</td>
    </tr>
    <tr>
      <td colspan="3" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
      <a target=_self  href='../nindex.htm'> ไปเมนู</a>&nbsp;&nbsp;<a href="report_drugoutside.php" target="_blank">รายงาน </a>  &nbsp;<a href="report_hn_drugoutside.php" target="_blank">พิมพ์ใบสั่งซื้อยา ย้อนหลัง </a></td>
    </tr>
  </table>
</form>
</fieldset>
<br />

<?

if($_POST['button']=='ตกลง'){
	
include("connect.inc");


	if($_POST['cHn']!=''){
	$sql="select * from opcard where hn='".$_POST['cHn']."' ";
	$query=mysql_query($sql) or die (mysql_error());
	$arr=mysql_fetch_array($query);
	
	$ptname=$arr['yot'].$arr['name'].' '.$arr['surname'];
	$showtype="&nbsp;&nbsp;&nbsp;&nbsp;HN  : $arr[hn]";
	
	$typeopd="ผู้ป่วยนอก";
	$ptright=$arr['ptright'];
	

	}elseif($_POST['cAn']!=''){
		
$sql="select * from ipcard where an='".$_POST['cAn']."' ";

$query=mysql_query($sql) or die (mysql_error());
$arr=mysql_fetch_array($query);

$ptname=$arr['ptname'];
$myward=$arr['myward'];
$showtype="&nbsp;&nbsp;&nbsp;&nbsp;HN  : $arr[hn]";

$typeopd="ผู้ป่วยใน";

$an=$arr['an'];
$ptright=$arr['ptright'];
	
	}
	
$numrow=mysql_num_rows($query);
	?>
    
<fieldset class="font1" style="width:100%">
  <legend>สั่งซื้อยา/สั่งทำหัตถการ นอกโรงพยาบาล </legend>
  <form id="form2" name="form2" method="post" onSubmit="JavaScript:return fncSubmit2();">

<? if($numrow){ ?>
<table border="0" align="center">
  <tr>
    <td width="231">ข้าพเจ้า</td>
    <td colspan="2">ยศ 
      <select name="yot" id="yot"> 
      <option value="พ.อ.หญิง">พันเอกหญิง</option>
      <option value="พ.อ.">พันเอก</option>
      <option value="พ.ท.หญิง">พันโทหญิง</option>
      <option value="พ.ท.">พันโท</option>
      <option value="พ.ต.หญิง">พันตรีหญิง</option>
      <option value="พ.ต.">พันตรี</option>
      <option value="ร.อ.หญิง">ร้อยเอกหญิง</option>
      <option value="ร.อ.">ร้อยเอก</option>
      <option value="ร.ท.หญิง">ร้อยโทหญิง</option>
       <option value="ร.ท.">ร้อยโท</option>
      <option value="ร.ต.หญิง">ร้อยตรีหญิง</option>
      <option value="ร.ต.">ร้อยตรี</option>
      <option value="น.พ.">นายแพทย์</option>
      <option value="พ.ญ.">แพทย์หญิง</option>
      </select>
      </td>
    <td width="117" class="font1">ชื่อ-สกุล
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
    <td colspan="2"><input name="type" type="radio" id="type1" value="นายแพทย์ผู้รักษา" checked="checked" />
      นายแพทย์ผู้รักษา  
        <input type="radio" name="type" id="type2" value="หัวหน้าสถานพยาบาล" />
      หัวหน้าสถานพยาบาล</td>
    </tr>
  <tr>
    <td>แห่งโรงพยาบาล</td>
    <td colspan="5"><input name="textfieldhost" type="text"  class="font1" id="textfieldhost" value="โรงพยาบาลค่ายสุรศักดิ์มนตรี"/>      จังหวัด      
      <input name="textfieldchg" type="text"  class="font1" id="textfieldchg" value="ลำปาง"/>      &nbsp;&nbsp;&nbsp;&nbsp;ขอรับรองว่า</td>
    </tr>
  <tr>
    <td colspan="6" class="font1"><input type="hidden" name="ptname" value="<?=$ptname;?>" /><?=$ptname;?><?=$showtype;?><input type="hidden" name="hn" value="<?=$arr['hn'];?>" /> <input type="hidden" name="ptright" value="<?=$ptright;?>" />
      &nbsp;&nbsp;&nbsp;&nbsp;ซึ่งป่วยเป็นโรค
<input type="text" name="diag" id="diag"  class="font1"/></td>
    </tr>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
    <td width="398">&nbsp;</td>
  </tr>
  <tr>
    <td class="font1"><input name="action" type="radio" id="action" value="A" checked="checked" />
      ก.จำเป็นต้องใช้</td>
    <td width="98" class="font1">&nbsp;</td>
    <td width="134" class="font1"><input name="action_detail" type="radio" id="action_detail2" value="ยา" checked="checked" />
      ยา</td>
    <td colspan="2" class="font1">&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="4" class="font1"><input type="radio" name="action_detail" id="action_detail3" value="เลือดและส่วนประกอบของเลือดหรือสารทดแทน" />
      เลือดและส่วนประกอบของเลือดหรือสารทดแทน </td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="4" class="font1"><input type="radio" name="action_detail" id="action_detail4" value="อ๊อกซิเจน" />
      อ๊อกซิเจน</td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="4" class="font1"><input type="radio" name="action_detail" id="action_detail5" value="อวัยวะเทียม" />
      อวัยวะเทียม</td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="4" class="font1"><input type="radio" name="action_detail" id="action_detail6" value="อุปกรณ์ในการบำบัดรักษาโรค" />
      อุปกรณ์ในการบำบัดรักษาโรค</td>
    </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ตามรายการข้างล่างนี้ ซึ่ง </td>
    </tr>
  <tr>
    <td colspan="6" align="center" class="font1"><input name="typedoc" type="radio" id="typedoc1" value="N" checked="checked" />
      ไม่มีจำหน่ายในโรงพยาบาล 
        <input type="radio" name="typedoc" id="typedoc2" value="Y" /> 
        มีจำหน่ายในโรงพยาบาลแต่ขาดคราว</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td class="font1"><input type="radio" name="action" id="action" value="B" /> 
      ข.จำเป็นต้องเข้ารับการตรวจ</td>
    <td class="font1">&nbsp;</td>
    <td colspan="3" class="font1"><input type="radio" name="action_detail" id="action_detail7" value="ทางห้องทดลอง" />
      ทางห้องทดลอง</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="3" class="font1"><input type="radio" name="action_detail" id="action_detail" value="เอ๊กซเรย์" />
      เอ๊กซเรย์ </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ตามรายการข้างล่างนี้ ซึ่งไม่มีจำหน่ายในโรงพยาบาลหรือสถานพยาบาลแห่งนี้ไม่สามารถให้บริการได้</td>
    </tr>
  <tr>
    <td colspan="6" class="font1"></td>
    
  </tr>
  <tr>
    <td colspan="6" class="font1">ระบุ รายการ/จำนวน</td>
  </tr>
  
  <tr>
    <td colspan="6" align="center" class="font1"><Div id="list" style="left: 153px; top: 563px; position: absolute;"></Div>1. 
      <input name="textfield1" type="text"  class="font1" id="textfield1" size="70" onKeyPress="searchSuggest(this.value,3,'1');"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">2.
      <input name="textfield2" type="text"  class="font1" id="textfield2" size="70" onKeyPress="searchSuggest(this.value,3,'2');"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">3.
      <input name="textfield3" type="text"  class="font1" id="textfield3" size="70" onKeyPress="searchSuggest(this.value,3,'3');"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">4.
      <input name="textfield4" type="text"  class="font1" id="textfield4" size="70" onKeyPress="searchSuggest(this.value,3,'4');"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">5.
      <input name="textfield5" type="text"  class="font1" id="textfield5" size="70" onKeyPress="searchSuggest(this.value,3,'5');"/></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1">&nbsp;</td>
    <td colspan="3" align="center" class="font1">ลงชื่อ 
      <input name="name" type="text"  class="font1" id="name" size="40"/></td>
    </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1">&nbsp;</td>
    <td colspan="3" align="center" class="font1"><!--ตำแหน่ง 
      <input name="position" type="text"  class="font1" id="position" size="40"/>-->เภสัชกร 
      <input name="name2" type="text"  class="font1" id="name2" value="พ.ท.หญิง อรัญญา ชาวไชย" size="40"/></td>
    </tr>
  <tr>
    <td align="center" class="font1">
    <input name="myward" type="hidden" id="myward" value="<?=$myward;?>" />
   <input name="an" type="hidden" id="an" value="<?=$an;?>" />
   <input name="typeopd" type="hidden" id="typeopd" value="<?=$typeopd;?>" />
    </td>
    <td colspan="2" align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td width="4" align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1"><input name="button2" type="submit" class="font1" id="button2" value="ตกลง" /></td>
    </tr>
  </table>
  
  <? } else{
	  echo "<br>";
	  echo "<div class=\"font1\">ไม่พบข้อมูล</div>";
	  echo "<br>";
  }
	  ?>

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
			
			
			
			$str="INSERT INTO `drugoutside` ( `runno` , `regisdate` , `doctor` , `type`, `yot` , `ptname` , `hn` ,`an`,ptright , `diag` , `action` , `action_detail` ,  `name` , `name2` ,`position`, 	typeopd ,typedoc)
VALUES (
'$nRunno', '". $thidate."', '". $_POST['doctor']."', '". $_POST['type']."', '". $_POST['yot']."', '". $_POST['ptname']."', '". $_POST['hn']."', '". $_POST['an']."', '". $_POST['ptright']."', '". $_POST['diag']."', '". $_POST['action']."', '". $_POST['action_detail']."', '". $_POST['name']."' , '". $_POST['name2']."', '".$_POST['position']."', '".$_POST['typeopd']."' , '".$_POST['typedoc']."')";
			$strq=mysql_query($str) or die (mysql_error());
			
			$id=mysql_insert_id();
			
			for($i=1;$i<=5;$i++){
			
			if($_POST['textfield'.$i]!=''){
				
			$str2="INSERT INTO `drugoutside_list` (`ref_id` , `list_detail` ) VALUES ('$id' , '".$_POST['textfield'.$i]."')";
			$str2=mysql_query($str2) or die (mysql_error());
			}
			}
			
			if($strq && $str2){
				
				echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_print.php?id=$id'>";

			}else{
				
				echo "<meta HTTP-EQUIV='REFRESH' CONTENT='2; URL=drugoutside_hn.php";
			}
			
}
?>
</body>
</html>