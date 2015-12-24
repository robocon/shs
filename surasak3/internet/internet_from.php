<html>
<head>
<title>โปรแกรมให้รหัส Internet</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<style type="text/css">
#fonth {
	color: #FFF;
}
</style>
</head>
<h1>บันทึกข้อมูล  การใช้งานอินเตอร์เน็ต</h1>
<script language="JavaScript">
	   var HttPRequest = false;

	   function doCallAjax(Sort) {
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
	
			var url = 'internet_countlist.php';
			var pmeters = 'mySort='+Sort;
			HttPRequest.open('POST',url,true);

			HttPRequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
			HttPRequest.setRequestHeader("Content-length", pmeters.length);
			HttPRequest.setRequestHeader("Connection", "close");
			HttPRequest.send(pmeters);
			
			
			HttPRequest.onreadystatechange = function()
			{

				 if(HttPRequest.readyState == 3)  // Loading Request
				  {
				   document.getElementById("mySpan").innerHTML = "Now is Loading...";
				  }

				 if(HttPRequest.readyState == 4) // Return Request
				  {
				   document.getElementById("mySpan").innerHTML = HttPRequest.responseText;
				  }
				
			}

	   }
	</script>
<script language="javascript">


	function CreateNewRow()
	{
		var intLine = parseInt(document.frmMain.hdnMaxLine.value);
		intLine++;
			
		var theTable = document.all.tbExp
		var newRow = theTable.insertRow(theTable.rows.length)
		newRow.id = newRow.uniqueID

		var newCell
		
		//*** Column 1 ***//
		newCell = newRow.insertCell(0);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"15\" NAME=\"user_"+intLine+"\"  ID=\"user_"+intLine+"\" VALUE=\"\"></center>";

		//*** Column 2 ***//
		newCell = newRow.insertCell(1);
		newCell.id = newCell.uniqueID;
		newCell.setAttribute("className", "css-name");
		newCell.innerHTML = "<center><INPUT TYPE=\"TEXT\" SIZE=\"15\" NAME=\"pass_"+intLine+"\" ID=\"pass_"+intLine+"\"  VALUE=\"\"></center>";
		

		
		
		document.frmMain.hdnMaxLine.value = intLine;
	}
	
	function RemoveRow()
	{
		intLine = parseInt(document.frmMain.hdnMaxLine.value);
		if(parseInt(intLine) > 0)
		{
				theTable = document.getElementById("tbExp");				
				theTableBody = theTable.tBodies[0];
				theTableBody.deleteRow(intLine);
				intLine--;
				document.frmMain.hdnMaxLine.value = intLine;
		}	
	}	

	function GenerateRow()
	{
		var intRows = parseInt(document.frmMain.txtCount.value);
		for(i=0;i<intRows;i++)
		{
			CreateNewRow();
		}
	}

</script>

<body Onload="JavaScript:doCallAjax('count');">
<form name="frmMain" method="post" action="internet_add.php">
<input type="hidden" name="hdnMaxLine" value="0">
<input type="text" name="txtCount" value="1" size="5"><input name="btnCreate" type="button" id="btnCreate" value="&nbsp;&nbsp;+&nbsp;&nbsp;" onClick="GenerateRow();">
<input name="btnDel" type="button" id="btnDel" value="&nbsp;&nbsp;-&nbsp;&nbsp;" onClick="RemoveRow();"> (<a  class="font2" target="_top" href="../../nindex.htm">&lt;&lt; เลิกทำ,ไปเมนู</a>)


<table width="445" border="1" id="tbExp" style="border-collapse:collapse;" bordercolor="#000000">
  <tr>
    <td colspan="2" align="center">กรุณาเลือก:
      <select name="type_net">
    <option value="1day">1 วัน</option>
    <option value="7day">7 วัน</option>
    </select></td>
    </tr>
  <tr id="fonth">
    <td bgcolor="#0099FF"><div align="center">USERNAME</div></td>
    <td bgcolor="#0099FF"><div align="center">PASSWORD</div></td>
    </tr>
</table>
<input type="submit" name="submit" value="&nbsp;&nbsp;บันทึก&nbsp;&nbsp;">
</form>


<hr>

<span id="mySpan"></span>
</body>
</html>
