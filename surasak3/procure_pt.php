<?php
    session_start();
    session_unregister("cStkno");
    session_unregister("cDocno"); 
    session_unregister("cBillno");
    session_unregister("cBilldate"); 
    session_unregister("cGetdate");
    session_unregister("cComcode"); 
    session_unregister("cComname"); 
    session_unregister("cMainstk"); 
    session_unregister("cTotalstk");

    session_unregister("cPacking");
    session_unregister("cPackamt");
    session_unregister("cPackpri");
    session_unregister("nNetprice");
    session_unregister("nItem");

    $cStkno=""; 	
    $cDocno="";
    $cBillno="";
    $cBilldate="200-/--/--";
    $cGetdate="200-/--/--";
    $cComcode="";
    $cComname="";

    $cMainstk="";
    $cTotalstk="";

    $cPacking="";
    $cPackamt="";
    $cPackpri="";
    $nNetprice=0;
    $nItem=0;

    session_register("cStkno");
    session_register("cDocno"); 
    session_register("cBillno");
    session_register("cBilldate"); 
    session_register("cGetdate");
    session_register("cComcode"); 
    session_register("cComname"); 
    session_register("cMainstk"); 
    session_register("cTotalstk");

    session_register("cPacking");
    session_register("cPackamt");
    session_register("cPackpri");
    session_register("nNetprice");
    session_register("nItem");
?>
<?
if(isset($_GET["action"]) && $_GET["action"] == "dgcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname,genname,unit,part from druglst_pt  where  drugcode like '%".$_GET["search1"]."%' limit 10 ";
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


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["drugcode"]),"';document.getElementById('list').innerHTML ='';\">",$se["drugcode"],"</A></td><td>".$se['tradname']."</td><td>".$se['genname']."</td><td>".$se['unit']."</td><td>".$se['part']."</td>
		<td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
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

			url = 'procure_pt.php?action=dgcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<form method="POST" action="dgprocure_pt.php">
  <p><font face="Angsana New"><b>ซื้อสินค้าเข้าคลังยาเวชภัณฑ์ PT</b></font></p>
  <p><font face="Angsana New"><b>&nbsp;&nbsp;&nbsp;&nbsp;ใบส่งสินค้าใบใหม่ รายการที่ 1</b></font></p>
  <p><font face="Angsana New"><b>&#3619;&#3627;&#3633;&#3626;&nbsp;&nbsp;<Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div><input type="text" name="dgcode"  id="dgcode" size="15" onKeyPress="searchSuggest(this.value,2,'dgcode');">&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='drugcode_pt.php'>(ดูรหัส)</a>&nbsp;&nbsp; </b></font></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="Submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1"></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>
</form>

