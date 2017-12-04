<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>แบบสำรวจภาวะสุขภาพบุตรกำลังพล ตามโครงการเด็กไทยไม่อ้วน ของกองทัพบก</title>
</head>
<?php
   session_start();
   if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
   }
include("connect.inc");
   if(isset($_GET["action"]) && $_GET["action"] == "survey"){
	
	$sql = "SELECT idcard,yot,name,surname,dbirth ,address,tambol ,ampur,changwat,father,mother,ptffone,hn FROM opcard  WHERE name like '%".$_GET['search']."%' ";
	
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr align=\"center\" bgcolor=\"#336600\">
				<td ><font style=\"color: #FFFFFF\"><strong>ชื่อ-สกุล</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ที่อยู่</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list2').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";


		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto1"]."').value = '",$arr["idcard"],"';document.getElementById('".$_GET["getto2"]."').value = '",$arr["yot"],"';document.getElementById('".$_GET["getto3"]."').value = '",$arr["name"],"';document.getElementById('".$_GET["getto4"]."').value = '",$arr["surname"],"';document.getElementById('".$_GET["getto5"]."').value = '",$arr["dbirth"],"';document.getElementById('".$_GET["getto6"]."').value = '",$arr["address"],"';document.getElementById('".$_GET["getto7"]."').value = '",$arr["tambol"],"';document.getElementById('".$_GET["getto8"]."').value = '",$arr["ampur"],"';document.getElementById('".$_GET["getto9"]."').value = '",$arr["changwat"],"';document.getElementById('".$_GET["getto10"]."').value = '",$arr["father"],"';document.getElementById('".$_GET["getto11"]."').value = '",$arr["mother"],"';document.getElementById('".$_GET["getto12"]."').value = '",$arr["ptffone"],"';document.getElementById('".$_GET["getto13"]."').value = '",$arr["hn"],"';document.getElementById('list2').innerHTML ='';\">",$arr["yot"].$arr["name"].' '.$arr["surname"],"</A></td>

					<td  align=\"center\">",$arr["address"]," ต.",$arr["tambol"],"&nbsp;อ.",$arr["ampur"],"&nbsp;จ.",$arr["changwat"],"</A></td>
					<td></td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
}
?>
<body>

       <script language="javascript">
/*function checkID(id)
{
if(id.length != 13) return false;
for(i=0, sum=0; i < 12; i++)
sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))

return false; 
return true;
}	   
	*/   
	   
	   
function fncSubmit()
{
	/*if(document.form1.idcard.value == "")
	{
		alert('กรุณาใส่หมายเลขประจำตัวประชาชน');
		document.form1.idcard.focus();
		return false;
	}	
	if(!checkID(document.form1.idcard.value)){
alert('รหัสประชาชนไม่ถูกต้อง');

document.form1.idcard.focus();
return false;
	}
	*/
	if(document.form1.yot.value == "" && document.form1.name.value == "" && document.form1.surname.value == "")
	{
		alert('กรุณาใส่ชื่อ-นามสกุล');
		document.form1.ptname.focus();		
		return false;
	}	
	
	document.form1.submit();
}

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

function searchSuggest(str,len,getto1,getto2,getto3,getto4,getto5,getto6,getto7,getto8,getto9,getto10,getto11,getto12,getto13) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'survey_add.php?action=survey&search=' + str+'&getto1=' + getto1+'&getto2=' + getto2+'&getto3=' + getto3+'&getto4=' + getto4+'&getto5=' + getto5+'&getto6=' + getto6+'&getto7=' + getto7+'&getto8=' + getto8+'&getto9=' + getto9+'&getto10=' + getto10+'&getto11=' + getto11+'&getto12=' + getto12+'&getto13=' + getto13;


			//alert(url);
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list2").innerHTML = xmlhttp.responseText;
		}
}

</script>


<form id="form1" name="form1" method="post" action="survey_add2.php?action=ADD" onSubmit="JavaScript:return fncSubmit();" target="_blank">
<table border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse: collapse; font-family: 'Angsana New'; font-size: 16px;">
  <tr>
    <td colspan="4" align="center" bgcolor="#00CCFF">แบบสำรวจภาวะสุขภาพบุตรกำลังพล ตามโครงการเด็กไทยไม่อ้วน ของกองทัพบก</td>
    </tr>
  <tr>
    <td>หมายเลขประจำตัวประชาชน</td>
    <td>
      <!--OnChange="JavaScript:doCallAjax('idcard','yot','name','surname','bdate','address','district','amphur','province','father','mother','phone1');"-->
      <input type="text" name="idcard" id="idcard" />   
    </td>
    <td>HN</td>
    <td><input type="text" name="hn" id="hn" /><div id="list2" style="position: absolute;"></div></td>
    </tr>
  <tr>
    <td>คำนำหน้า-ชื่อ-นามสกุล</td>
    <td><input name="yot" type="text" id="yot" size="10"/>
     
      <input type="text" name="name" id="name" onKeyPress="searchSuggest(this.value,3,'idcard','yot','name','surname','bdate','address','district','amphur','province','father','mother','phone1','hn');"  />
      
      <input type="text" name="surname" id="surname" /></td>
    <td>วันเกิด</td>
    <td><input type="text" name="bdate" id="bdate" />
    รูปแบบ 2556-01-01</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    </tr>
  <tr>
    <td>บิดาชื่อ</td>
    <td><input type="text" name="father" id="father" /></td>
    <td>สังกัด/ที่ทำงาน</td>
    <td>
      <SELECT NAME="addwork1" id="addwork1">
        <option value="" selected><-เลือก-></option>
        <? 
		  $sqlcamp="SELECT * FROM `camp` order by row_id";
		  $querycamp=mysql_query($sqlcamp)or die (mysql_error());
		  while($arrcamp=mysql_fetch_array($querycamp)){
		  ?>
        <option value="<?=$arrcamp['name']?>">
          <?=$arrcamp['name']?>
          </option>
        <? 
		  }
	  ?>
      </select></td>
  </tr>
  <tr>
    <td>โทรศัพท์ที่ทำงาน</td>
    <td><input type="text" name="tell1" id=" tell1" /></td>
    <td>โทรศัพท์มือถือ</td>
    <td><input type="text" name="phone1" id="phone1" /></td>
  </tr>
  <tr>
    <td>มารดาชื่อ</td>
    <td><input type="text" name="mother" id="mother" /></td>
    <td>โทรศัพท์มือถือ/บ้าน</td>
    <td><input type="text" name="phone2" id="phone2" /></td>
  </tr>
  <tr>
    <td>ที่อยู่ที่ติดต่อได้ บ้านเลขที่</td>
    <td colspan="3">
      <input name="address" type="text" id="address" size="5" />
      
      ถนน
      <input type="text" name="street" id="street" />
      ตำบล
      <input type="text" name="district" id="district" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3">อำเภอ
      <input type="text" name="amphur" id="amphur" /> 
      จังหวัด
      <input type="text" name="province" id="province" /></td>
  </tr>
  <tr>
    <td colspan="4" bgcolor="#00CCFF">สภาพร่างกายทั่วไป</td>
    </tr>
  <tr>
    <td colspan="4">น้ำหนัก 
      <input type="text" name="weight" id="weight" />
      กก. 
      สูง
      <input type="text" name="height" id="height" />
      ซม. รอบเอว
      <input type="text" name="waistline" id="waistline" />
      ซม.</td>
  </tr>
  <tr>
    <td colspan="4">BMI      
      <input type="text" name="bmi" id="bmi" /> 
      BP 
      <input type="text" name="bp" id="bp" />
      mmhg โรคประจำตัว 
      <input name="diag" type="text" id="diag" size="40" /></td>
  </tr>
  <tr>
    <td colspan="4">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="4" align="center"><input type="submit" name="button" id="button" value="บันทึกข้อมูล" /> <a target=_self  href='../nindex.htm' class="forntsarabun"><------ ไปเมนู</a></td>
  </tr>
</table>

</form>

<br>

 <TABLE width="30%" class="forntsarabun" style="font-family: 'Angsana New'; font-size: 16px;">
<TR>
	<TD colspan="2" bgcolor="#CCCCCC" align="center">สังกัด</TD>
</TR>
<?php 
$sql2 = "SELECT addwork1,count(*) as count FROM survey_nofat Group by addwork1 Order by count DESC";
	
$result2 = Mysql_Query($sql2);
$sum2=0;
while(list($addwork1,$count2) = Mysql_fetch_row($result2)){
?>
<TR>
	<TD width="40%"><a href="survey_list_detail.php?addwork=<?php echo $addwork1;?>" target="_blank"><?php echo $addwork1;?></a></TD>
	<TD width="5%" align="center"><?php echo $count2;?></TD>
</TR>
<?php 
$sum2+=$count2;
}

?>

<TR>
	<TD bgcolor="#CCCCCC">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;รวม</TD>
	<TD align="center" bgcolor="#CCCCCC"><?php echo $sum2;?></TD>
</TR>

</TABLE> 
<br />

</body>
</html>