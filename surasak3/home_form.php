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
      <td>����ʶҹ��ԡ��</td>
      <td><label for="pcucode"></label>
      <input name="pcucode" type="text" id="pcucode" value="11512" /></td>
    </tr>
    <tr>
      <td>���ʺ�ҹ</td>
      <td><input type="text" name="hid" id="hid" /></td>
    </tr>
    <tr>
      <td>���ʺ�ҹ��������û���ͧ</td>
      <td><input type="text" name="house_id" id="house_id" /></td>
    </tr>
    <tr>
      <td>��ҹ�Ţ���</td>
      <td><input type="text" name="house" id="house" /></td>
    </tr>
    <tr>
      <td>������</td>
      <td><input type="text" name="vilage" id="vilage" /></td>
    </tr>
    <tr>
      <td>��� (�����)</td>
      <td><input type="text" name="road" id="road" /></td>
    </tr>
    <tr>
      <td>�ѧ��Ѵ</td>
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
      <td>�����</td>
      <td><select id="ddlAmphur" name="ddlAmphur" style="width:200px" onChange = "List2(this.value)"></select></td>
    </tr>
    <tr>
      <td>�Ӻ�</td>
      <td><select id="ddlTambon" name="ddlTambon" style="width:120px"></select></td>
    </tr>
    <tr>
      <td>�ӹǹ��ͺ����</td>
      <td><input type="text" name="nfamily" id="nfamily" /></td>
    </tr>
    <tr>
      <td>�����</td>
      <td><select name="locatype">
      <option value="1">�ࢵ�Ⱥ��</option>
      <option value="2">�͡ࢵ�Ⱥ��</option>
      </select>
    </td>
    </tr>
    <tr>
      <td>���� ���.</td>
      <td><input type="text" name="vhvid" id="vhvid" /></td>
    </tr>
    <tr>
      <td>������Һ�ҹ</td>
      <td><input type="text" name="headid" id="headid" /></td>
    </tr>
    <tr>
      <td>���������</td>
      <td><select name="toilet">
      <option value="0">�����</option>
      <option value="1">��</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>������Ҵ��§��</td>
      <td><select name="water">
      <option value="0">�����</option>
      <option value="1">��§��</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>���������觹�Ӵ������Ҵ</td>
      <td><select name="wattype">
      <option value="1">��ӽ�</option>
      <option value="2">��ӻ�л�</option>
      <option value="3">��ӺҴ��</option>
      <option value="4">��͹�ӵ��</option>
      <option value="5">��й�� �����</option>
      <option value="6">��Ӻ�è�����</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>�ԸաӨѴ���</td>
      <td><select name="garbage">
      <option value="1">�ѧ</option>
      <option value="2">��</option>
      <option value="3">��ѡ�ӻ���</option>
      <option value="4">��仡ӨѴ������</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>��èѴ��ҹ�١��ѡ</td>
      <td><select name="hcare">
      <option value="0">���١</option>
      <option value="1">�١</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>��������</td>
      <td><select name="durable">
      <option value="0">��褧��</option>
      <option value="1">����</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>�������Ҵ</td>
      <td><select name="clean">
      <option value="0">������Ҵ</option>
      <option value="1">���Ҵ</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>����к���ҡ��</td>
      <td><select name="ventila">
      <option value="0">����к��</option>
      <option value="1">�к��</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>�ʧ���ҧ</td>
      <td><select name="light">
      <option value="0">�����§��</option>
      <option value="1">��§��</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>��áӨѴ�������</td>
      <td><select name="watertm">
      <option value="0">���ӨѴ</option>
      <option value="1">�ӨѴ</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>��û�ا��㹤���</td>
      <td><select name="mfood">
      <option value="0">�����</option>
      <option value="1">��</option>
      <option value="9">����Һ</option>
      </select>
      </td>
    </tr>
    <tr>
      <td>��äǺ�����ŧ���ä</td>
      <td><select name="bctrl">
      <option value="0">���Ǻ���</option>
      <option value="1">�Ǻ���</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>��äǺ����ѵ����ä</td>
      <td><select name="actrl">
      <option value="0">���Ǻ���</option>
      <option value="1">�Ǻ���</option>
      <option value="9">����Һ</option>
      </select></td>
    </tr>
    <tr>
      <td>���������ҹ</td>
      <td><input type="text" name="vhid" id="vhid" /></td>
    </tr>
    <tr>
      <td>�ѹ��͹�շ���Ѻ��ا������</td>
      <td><input type="text" name="d_update" id="d_update" /></td>
    </tr>
    <tr>
      <td colspan="2" align="center"><input type="submit" name="b1" id="b1" value="�ѹ�֡" /></td>
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
	
	echo "�������������º��������";
	
}else{
	
	echo "�������ö������������";
}
	
	
}


?>




</body>
</html>