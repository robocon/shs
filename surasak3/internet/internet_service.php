<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(fidcard,fptname,fphone) {
		  HttPRequest = false;
		  if (window.XMLHttpRequest) { // Mozilla, Safari,...
			 HttPRequest = new XMLHttpRequest();
			 if (HttPRequest.overrideMimeType) {
				HttPRequest.overrideMimeType('text/html');
			 }
		  } else if (window.ActiveXObject) { // IE
			 try {
				HttPRequest = new ActiveXObject("Msxml2.XMLHTTP");
			 } catch (e) {
				try {
				   HttPRequest = new ActiveXObject("Microsoft.XMLHTTP");
				} catch (e) {}
			 }
		  } 
		  
		  if (!HttPRequest) {
			 alert('Cannot create XMLHTTP instance');
			 return false;
		  }

		  var url = 'internet_getfill.php';
		  var pmeters = "stridcard=" + encodeURI( document.getElementById(fidcard).value);
		  
		 

			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				//if(HttPRequest.readyState == 3)  // Loading Request
				//{
					//document.getElementById(fProductName).innerHTML = "..";
				//}

				if(HttPRequest.readyState == 4) // Return Request
				{
					var myProduct = HttPRequest.responseText;
					if(myProduct != "")
					{
						var myArr = myProduct.split("|");
						document.getElementById(fptname).value = myArr[0];
						document.getElementById(fphone).value = myArr[1];
					}
				}
				
			}

	   }
	   
	   </script>
       <script language="javascript">
function checkID(id)
{
if(id.length != 13) return false;
for(i=0, sum=0; i < 12; i++)
sum += parseFloat(id.charAt(i))*(13-i); if((11-sum%11)%10!=parseFloat(id.charAt(12)))

return false; 
return true;
}	   
	   
	   
	   
function fncSubmit()
{
	if(document.form1.idcard.value == "")
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
	
	if(document.form1.ptname.value == "")
	{
		alert('กรุณาใส่ชื่อ-นามสกุล');
		document.form1.ptname.focus();		
		return false;
	}	
	if(document.form1.phone.value == "")
	{
		alert('กรุณาใส่เบอร์โทรศัพท์');
		document.form1.phone.focus();		
		return false;
	}	
	
		if(document.form1.type_net.value == "")
	{
		alert('กรุณาระบุวันหมดอายุ 1 วัน หรือ 7วัน');
		document.form1.type_net.focus();		
		return false;
	}	
	document.form1.submit();
}


</script>


<body>

<? 

/*if(date("H") >='17' ||  date("H") <='08'){
	
	echo "ปิดการให้บริการ เวลา 17.00  เปิดให้บริการ 08.00";
	
	
}else{*/
	
	

?>
<form name="form1" action="internet_service_print.php" method="post" onSubmit="JavaScript:return fncSubmit();">

<? 

 include("../connect.inc");
$strSQL = "SELECT count(*) as count ,type_net  FROM internet WHERE idcard='' and date_service ='' Group by type_net Order by count  asc";
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");

$NumRow=mysql_num_rows($objQuery);


?>
<table border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td colspan="2" align="center">ระบบให้บริการอินเตอร์เน็ต </td>
    </tr>
    
  <tr>
    <td colspan="2" align="center">
		<? 
		if($NumRow==0){

					echo "--------ยังไม่มีรหัสในระบบ----------<br>กรุณาแจ้งศูนย์คอมพิวเตอร์ โทร 6203";	
			}else{

		
		
		while($objResult = mysql_fetch_array($objQuery)){
			
			if($objResult['type_net']=='1day'){ 
			$type_net= "1 วัน"; 
				$count1=$objResult["count"];	
			
			}else if($objResult['type_net']=='7day'){ 
			$type_net="7 วัน"; 
			
				$count2=$objResult["count"];	
				
			}
			
			
		
		?>
<div align="center" style="font-family:'Angsana New'; font-size:14pt; background-color:#FF9"><?=$type_net;?> :: จำนวนคงเหลือ    <b><?=$objResult["count"];?></b>   user</div>
        
        <?
		}

				if($count1<10 && $count2<10){
					
					$text= "<div  style='background-color:#F9C;'> รหัสการใช้งานแบบ 1 วัน และ 7วัน เหลือน้อยกว่า 10 user  <br>กรุณาแจ้งศูนย์คอมพิวเตอร์ โทร 6203 เพื่อเพิ่มรหัสการใช้งานอินเตอร์เน็ต</div>";
				}else if($count1<10){
					$text= "<div  style='background-color:#F9C;'>รหัสการใช้งานแบบ 1 วัน เหลือน้อยกว่า 10 user <br>กรุณาแจ้งศูนย์คอมพิวเตอร์ โทร 6203 เพื่อเพิ่มรหัสการใช้งานอินเตอร์เน็ต</div>";
				}else	if($count2<10){
					$text= "<div  style='background-color:#F9C;'>รหัสการใช้งานแบบ 7 วัน เหลือน้อยกว่า 10 user <br>กรุณาแจ้งศูนย์คอมพิวเตอร์ โทร 6203 เพื่อเพิ่มรหัสการใช้งานอินเตอร์เน็ต</div>";
			}
			
			
		//}////////////////
		echo $text;
		?>
<hr />
<br />
        </td>
  </tr>

  <tr>
    <td>
    รหัสบัตรประจำตัวประชาชน</td>
    <td>
      <input type="text" name="idcard" id="idcard" OnChange="JavaScript:doCallAjax('idcard','ptname','phone');"/></td>
  </tr>
  <tr>
    <td>ชื่อ-สกุล</td>
    <td><input type="text" name="ptname" id="ptname" /></td>
  </tr>
  <tr>
    <td>เบอร์โทรศัพท์</td>
    <td><input type="text" name="phone" id="phone" /></td>
  </tr>
  <tr>
    <td>อายุการใช้งาน</td>
    <td><select name="type_net">
     <option value="" >กรุณาเลือก</option>
      <option value="1day">1 วัน</option>
      <option value="7day">7 วัน</option>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="submit" name="button" id="button" value="ตกลง" /> (<a  class="font2" target="_top" href="../../nindex.htm">&lt;&lt; เลิกทำ,ไปเมนู</a>) </td>
    </tr>
    <? } ?>
</table>
</form>
<? //} ?>

<?php
$last = date("Y-m-d H:i:s",strtotime("-1 weeks"));

$sql = "SELECT `ptname`,COUNT(`idcard`) AS `row` 
FROM `internet` 
WHERE `date_service` >= '$last' 
AND `date_service` != '' 
AND `type_net` = '7day' 
GROUP BY `idcard` 
ORDER BY COUNT(`idcard`) DESC 
LIMIT 10";
$query = mysql_query($sql);

?>

<h3>สถิติผู้มาขอใช้อินเตอร์เน็ตในอาทิตย์ที่ผ่านมา</h3>
<table>
	<tr>
		<td align="center">อินเตอร์เน็ต 7วัน</td>
		<td align="center">อินเตอร์เน็ต 1วัน</td>
	</tr>
	<tr>
		<td valign="top">
			<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<tr>
					<td>ชื่อ</td>
					<td>จำนวนครั้งที่ขอใช้</td>
				</tr>
				<?php
				while( $item = mysql_fetch_assoc($query) ){
					?>
					<tr>
						<td><?=$item['ptname'];?></td>
						<td align="center"><?=$item['row'];?></td>
					</tr>
					<?php
				}
				?>
				
			</table>
		</td>
		<td valign="top">
			<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<tr>
					<td>ชื่อ</td>
					<td>จำนวนครั้งที่ขอใช้</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

</body>
</html>