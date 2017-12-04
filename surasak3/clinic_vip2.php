<?php
	/*** By Weerachai Nukitram ***/
	/***  http://www.ThaiCreate.Com ***/	
?>
<html>
<head>
<title>คลินิกพิเศษนอกเวลาราชการ</title>
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
	   
	   
	   
 function addRow3()
{ 
var count_row3=document.getElementById('tbExp1').rows.length-1 ;

	if(count_row3<25){
		var _table = document.getElementById('tbExp1').insertRow(count_row3);
		var cell0 = _table.insertCell(0);
		var cell1 = _table.insertCell(1); 
		var cell2 = _table.insertCell(2);
		var cell3 = _table.insertCell(3);
		
/*		var getto = "complica"+count_row3;
		var getto2 = "comdetail"+count_row3;*/
		
cell0.align= "right";

cell1.innerHTML = '<input type="text" name="thn'+(count_row3)+'"  id="thn'+(count_row3)+'" OnChange="doCallAjax(thn'+(count_row3)+',tptname'+(count_row3)+');">';
cell2.innerHTML = '<input name="tptname'+(count_row3)+'"  type="text" id="tptname'+(count_row3)+'">';
cell3.innerHTML = '<input name="ttan'+(count_row3)+'"  type="text" id="ttan'+(count_row3)+'">';
		//cell6.innerHTML=  '&nbsp;';
		
		alert(cell1.innerHTML);
		alert(cell2.innerHTML);
		
		//alert('thn'+(count_row3)+'  '+'tptname'+(count_row3));
	}
}

	</script>
<body>
<h1>คลินิกพิเศษนอกเวลาราชการ</h1>
<form name="frmMain">
<table width="421" border="0">
  <tr>
    <th width="143" >HN</th>
    <th width="145">ชื่อ-สกุล</th>
    <th width="119">an</th>
  </tr>
 <!-- <tr>
    <th>
      <div align="center">
        <input type="text" name="thn0" id="thn0" OnChange="JavaScript:doCallAjax('thn0','tptname0');">
      </div></th>
    <th><input type="text" name="tptname0" id="tptname0" size="40"></th>
    <th><input type="text" name="ttan0" id="ttan0" size="20"></th>
  </tr>-->
</table>
<table id="tbExp1">
  <tr>
    <TD  align="right" valign="middle"><input name="thn0" type="text" id="thn0" value="" OnChange="JavaScript:doCallAjax('thn0','tptname0');"></TD>
    <TD  valign="middle"><input name="tptname0" type="text" id="dt_diag_morbidity0" value=""></TD>
    <TD  valign="middle"><input type="text" name="ttan0" id="ttan0" size="20"></TD>
  </tr>
  <tr>
    <TD colspan="4"  align="center" valign="middle"></TD>
  </tr>
</table>
<input type="button" name="input" value="+ เพิ่ม +" onClick="addRow3();" >
</form>
</body>
</html>