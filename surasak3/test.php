<html>
<head>
<title>ThaiCreate.Com Tutorial</title>
<script language="javascript">
	function fncCreateElement(){
		
	   var mySpan = document.getElementById('mySpan');

	   var myLine = document.getElementById('hdnLine');
	   myLine.value++;

	   var myElement1 = document.createElement('input');
	   myElement1.setAttribute('type',"text");
	   myElement1.setAttribute('name',"txtSiteName[]");
	   myElement1.setAttribute('id',"txt"+myLine.value);
	   mySpan.appendChild(myElement1);	
	   
		
       // Create <br>
	   var myElement2 = document.createElement('<br>');
	   myElement2.setAttribute('id',"br"+myLine.value);
	   mySpan.appendChild(myElement2);
	   
	   		
	}

	function fncDeleteElement(){

		var mySpan = document.getElementById('mySpan');

		var myLine = document.getElementById('hdnLine');
		
		if(myLine.value > 1 )
		{

			// Remove Text
			var deleteEle = document.getElementById("txt"+myLine.value);
			mySpan.removeChild(deleteEle);

			// Remove <br>
			var deleteBr = document.getElementById("br"+myLine.value);
			mySpan.removeChild(deleteBr);

			myLine.value--;
		}
	}
</script>
</head>
<body>
	<form action="php_create_textbox2.php" method="post" name="form1">
	  <input type="text" id ="txt1" name="txtSiteName[]">
	  <input name="btnButton" type="button" value="+" onClick="JavaScript:fncCreateElement();">
	  <input name="btnButton" type="button" value="-" onClick="JavaScript:fncDeleteElement();"><br>
	  <span id="mySpan"></span>
	  <input id="hdnLine" name="hdnLine" type="hidden" value="1">
	  <input name="btnSubmit" type="submit" value="Submit">
	</form>
    
    
    
  <?
  $DateResultNow=date("Y-m-d", mktime(date("m"), date("d")+7, date("Y")));
  
 // $dd = mktime(0,0,0,$m,$d+7,$y);
 // $start=(date("Y")+543).date("-m-d",$dd);
  echo $DateResultNow;
  echo "<br>";
//  echo $start;
    ?>
</body>
</html>