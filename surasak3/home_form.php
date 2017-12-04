<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<? 
include("connect.inc");
 ?>
<script language = "JavaScript">

		//**** List Province (Start) ***//
		function List1(SelectValue)
		{
			
			frmMain.ddlAmphur.length = 0
			frmMain.ddlTambon.length = 0
			
			//*** Insert null Default Value ***//
			var myOption = new Option('','')  
			frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption
			
			<?
			$intRows = 0;
			$strSQL = "SELECT * FROM amphur_new ORDER BY  AMPHUR_CODE ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
			$intRows++;
			?>			
				x = <?=$intRows;?>;
				mySubList = new Array();
				
				strGroup = <?=$objResult["PROVINCE_ID"];?>;
				strValue = "<?=$objResult["AMPHUR_ID"];?>";
				strItem = "<?=$objResult["AMPHUR_NAME"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])  
					frmMain.ddlAmphur.options[frmMain.ddlAmphur.length]= myOption					
				}
			<?
			}
			?>																	
		}
		//**** List Province (End) ***//

		
		//**** List Amphur (Start) ***//
		function List2(SelectValue)
		{
			frmMain.ddlTambon.length = 0

			//*** Insert null Default Value ***//
			var myOption = new Option('','')  
			frmMain.ddlTambon.options[frmMain.ddlTambon.length]= myOption
			
			<?
			$intRows = 0;
			$strSQL = "SELECT * FROM district_new ORDER BY DISTRICT_CODE ASC ";
			$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
			$intRows = 0;
			while($objResult = mysql_fetch_array($objQuery))
			{
			$intRows++;
			?>
				x = <?=$intRows;?>;
				mySubList = new Array();
				
				strGroup = <?=$objResult["AMPHUR_ID"];?>;
				strValue = "<?=$objResult["DISTRICT_ID"];?>";
				strItem = "<?=$objResult["DISTRICT_NAME"];?>";
				mySubList[x,0] = strItem;
				mySubList[x,1] = strGroup;
				mySubList[x,2] = strValue;
							
				if (mySubList[x,1] == SelectValue){
					var myOption = new Option(mySubList[x,0], mySubList[x,2])  
					frmMain.ddlTambon.options[frmMain.ddlTambon.length]= myOption					
				}
			<?
			}
			?>																	
		}
		//**** List Amphur (End) ***//

</script>

<form id="frmMain" name="frmMain" method="post" action="">
  <table border="1">
    <tr>
      <td>รหัสสถานบริการ</td>
      <td><label for="pcucode"></label>
      <input name="pcucode" type="text" id="pcucode" value="11512" /></td>
    </tr>
    <tr>
      <td>รหัสบ้าน</td>
      <td><input type="text" name="hid" id="hid" /></td>
    </tr>
    <tr>
      <td>รหัสบ้านตามกรมการปกครอง</td>
      <td><input type="text" name="house_id" id="house_id" /></td>
    </tr>
    <tr>
      <td>บ้านเลขที่</td>
      <td><input type="text" name="house" id="house" /></td>
    </tr>
    <tr>
      <td>หมู่ที่</td>
      <td><input type="text" name="vilage" id="vilage" /></td>
    </tr>
    <tr>
      <td>ถนน (ถ้ามี)</td>
      <td><input type="text" name="road" id="road" /></td>
    </tr>
    <tr>
      <td>จังหวัด</td>
      <td><select id="ddlProvince" name="ddlProvince" onChange = "List1(this.value)">
	<option selected value=""></option>
	<?
	$strSQL = "SELECT * FROM province_new ORDER BY PROVINCE_CODE ASC ";
	$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]");
	while($objResult = mysql_fetch_array($objQuery))
	{
	?>
	<option value="<?=$objResult["PROVINCE_ID"];?>"><?=$objResult["PROVINCE_NAME"];?></option>
	<?
	}
	?>
	</select>
</td>
    </tr>
    <tr>
      <td>อำเภอ</td>
      <td><select id="ddlAmphur" name="ddlAmphur" style="width:200px" onChange = "List2(this.value)"></select></td>
    </tr>
    <tr>
      <td>ตำบล</td>
      <td><select id="ddlTambon" name="ddlTambon" style="width:120px"></select></td>
    </tr>
    <tr>
      <td>จำนวนครอบครัว</td>
      <td><input type="text" name="nfamily" id="nfamily" /></td>
    </tr>
    <tr>
      <td>ที่ตั้ง</td>
      <td><select name="locatype">
      <option value="1">ในเขตเทศบาล</option>
      <option value="2">นอกเขตเทศบาล</option>
      </select>
    </td>
    </tr>
    <tr>
      <td>รหัส อสม.</td>
      <td><input type="text" name="vhvid" id="vhvid" /></td>
    </tr>
    <tr>
      <td>รหัสเจ้าบ้าน</td>
      <td><input type="text" name="headid" id="headid" /></td>
    </tr>
    <tr>
      <td>การมีส้วม</td>
      <td><select name="toilet">
      <option value="0">ไม่มี</option>
      <option value="1">มี</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>น้ำสะอาดเพียงพอ</td>
      <td><select name="water">
      <option value="0">ไม่มี</option>
      <option value="1">เพียงพอ</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>ประเภทแหล่งน้ำดื่มสะอาด</td>
      <td><select name="wattype">
      <option value="1">น้ำฝน</option>
      <option value="2">น้ำประปา</option>
      <option value="3">น้ำบาดาล</option>
      <option value="4">บ่อน้ำตื้น</option>
      <option value="5">สระน้ำ แม่น้ำ</option>
      <option value="6">น้ำบรรจุเสร็จ</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>วิธีกำจัดขยะ</td>
      <td><select name="garbage">
      <option value="1">ฝัง</option>
      <option value="2">เผา</option>
      <option value="3">หมักทำปุ๋ย</option>
      <option value="4">ส่งไปกำจัดที่อื่น</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>การจัดบ้านถูกหลัก</td>
      <td><select name="hcare">
      <option value="0">ไม่ถูก</option>
      <option value="1">ถูก</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>ความคงทน</td>
      <td><select name="durable">
      <option value="0">ไม่คงทน</option>
      <option value="1">คงทน</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>ความสะอาด</td>
      <td><select name="clean">
      <option value="0">ไม่สะอาด</option>
      <option value="1">สะอาด</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>การระบายอากาศ</td>
      <td><select name="ventila">
      <option value="0">ไม่ระบาย</option>
      <option value="1">ระบาย</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>แสงสว่าง</td>
      <td><select name="light">
      <option value="0">ไม่เพียงพอ</option>
      <option value="1">เพียงพอ</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>การกำจัดน้ำเสีย</td>
      <td><select name="watertm">
      <option value="0">ไม่กำจัด</option>
      <option value="1">กำจัด</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>สารปรุงแต่งในครัว</td>
      <td><select name="mfood">
      <option value="0">ไม่ใช้</option>
      <option value="1">ใช้</option>
      <option value="9">ไม่ทราบ</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>การควบคุมแมลงนำโรค</td>
      <td><select name="bctrl">
      <option value="0">ไม่ควบคุม</option>
      <option value="1">ควบคุม</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>การควบคุมสัตว์นำโรค</td>
      <td><select name="actrl">
      <option value="0">ไม่ควบคุม</option>
      <option value="1">ควบคุม</option>
      <option value="9">ไม่ทราบ</option>
      </select></td>
    </tr>
    <tr>
      <td>รหัสหมู่บ้าน</td>
      <td><input type="text" name="vhid" id="vhid" /></td>
    </tr>
    <tr>
      <td>วันเดือนปีที่ปรับปรุงข้อมูล</td>
      <td><input type="text" name="d_update" id="d_update" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="b1" id="b1" value="บันทึก" /></td>
    </tr>
  </table>
</form>

<? 
if(isset($_POST['b1'])){
	
	
	
	$d_update=date("Y-m-d H:i:s");
	
	echo $_POST['ddlProvince'];
	echo "<br>";
	echo $_POST['ddlAmphur'];
	echo "<br>";
	echo $_POST['ddlTambon'];
	echo "<br>";
	
$sql="INSERT INTO `home` ( `pcucode` , `hid` , `house_id` , `house` , `village` , `road` , `tambon` , `ampur` , `changwat` , `nfamily` , `locatype` , `vhvid` , `headid` , `toillet` , `water` , `wattype` , `garbage` , `hcare` , `durable` , `clean` , `ventila` , `light` , `watertm` , `mfood` , `bctrl` , `actrl` , `vhid` , `d_update` )
VALUES ( '".$_POST['pcucode']."', '".$_POST['hid']."', '".$_POST['house_id']."', '".$_POST['house']."', '".$_POST['village']."', '".$_POST['road']."', '".$_POST['tambon']."', '".$_POST['ampur']."', '".$_POST['changwat']."', '".$_POST['nfamily']."', '".$_POST['locatype']."', '".$_POST['vhvid']."', '".$_POST['headid']."', '".$_POST['toillet']."', '".$_POST['water']."', '".$_POST['wattype']."', '".$_POST['garbage']."', '".$_POST['hcare']."', '".$_POST['durable']."', '".$_POST['clean']."', '".$_POST['ventila']."', '".$_POST['light']."', '".$_POST['watertm']."', '".$_POST['mfood']."', '".$_POST['bctrl']."', '".$_POST['actrl']."', '".$_POST['vhid']."', '".$_POST['d_update']."'
)";
//$result=mysql_query($sql) or die (mysql_error());




if($result){
	
	echo "เพิ่มข้อมูลเรียบร้อยแล้ว";
	
}else{
	
	echo "ไม่สามารถเพิ่มข้อมูลได้";
}
	
	
}


?>




</body>
</html>