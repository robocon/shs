<?
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["drugcode"]),"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td>
		<td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>
<?php
    session_start();
    session_unregister("dcode");
    session_unregister("nmainstk");
    session_unregister("ntotalstk");
    session_unregister("aLot");
    session_unregister("x");

    $dcode="";
    $nmainstk="";
    $ntotalstk="";
    $aLot="";
    $x=0;
    session_register("x");
    session_register("dcode");
    session_register("aLot");
    session_register("nmainstk");
    session_register("ntotalstk");
    print  "ตรวจสอบยาเวชภัณฑ์ในคลังยาตาม Lot.No และวันหมดอายุ<br> ";
?>

<script>
 function checkm(etext){
	if(etext=='t'){
		if(confirm('ยามีอายุน้อยกว่า 3 เดือนต้องการทำรายการต่อหรือไม่')){
			return true;
		}else{
			return false;
		}
	}else if(etext=='f'){
		return true;
	}
}

//////// เรียกดูรหัสยา ////////
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
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'stkchk.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
  <form method="post" action="stklist.php">
  <font face="Angsana New"><a target=_BLANK href="drugcode.php">&#3619;&#3627;&#3633;&#3626;&#3618;&#3634;?</a>
   &nbsp;&nbsp;&nbsp;&nbsp;<Div id="list" style="left:15px; top:92px; position:absolute;"></Div><input type="text" name="drugcode" size="10" onKeyPress="searchSuggest(this.value,2,'drugcode');" id="drugcode"></font>
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
   </form>


