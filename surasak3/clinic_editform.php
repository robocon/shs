<html>
<head>
<title>แก้ไขข้อมูล</title>
<style type="text/css">
.font1 {	font-family: "TH Niramit AS";
	font-size:20px;
}
</style>
</head>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(thn,tptname) {
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

		  var url = 'clinic_vipgetfill.php';
		  var pmeters = "strHn=" + encodeURI( document.getElementById(thn).value);
		  
		 

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
						document.getElementById(tptname).value = myArr[0];
						<!--document.getElementById(ttan).value = myArr[1];-->
					}
				}
				
			}

	   }
	   
	</script>
<body>
<form action="clinic_saveedit.php?row_id=<?=$_GET["row_id"];?>" name="frmEdit" method="post">
<?
include("connect.inc");

$strSQL = "SELECT * FROM  clinic_vip   WHERE row_id = '".$_GET["row_id"]."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
if(!$objResult)
{
	echo "Not found row_id=".$_GET["row_id"];
}
else
{
?>
<table width="100%"  border="1" align="center">
  <tr>
    <th> <div align="center">HN</div></th>
    <th> <div align="center">ชื่อ - สกุล</div></th>
    <th><div align="center">AN</div></th>
  </tr>
  <tr>
    <td align="center"><input name="thn" type="text" class="font1" id="thn" value="<?=$objResult["hn"];?>" size="20" OnChange="JavaScript:doCallAjax('thn','tptname');"></td>
    <td align="center"><input name="tptname" type="text" class="font1" id="tptname" value="<?=$objResult["ptname"];?>" size="20"></td>
    <td align="center"><input name="ttan" type="text" class="font1" id="ttan"  value="<?=$objResult["an"];?>"/></td>
  </tr>
  </table>
  <input type="submit" name="submit" value="submit">
  <?
  }

  ?>
  </form>
</body>
</html>