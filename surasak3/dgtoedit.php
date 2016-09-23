<?
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname,genname from druglst  where  drugcode like '%".$_GET["search1"]."%' or tradname like '%".$_GET["search1"]."%' or genname like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:600px; height:450px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>รหัสยา</strong></font></td><td  align='center'><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(การค้า)</strong></font></td><td  align='center'><font style=\"color: #FFFFFF;\"><strong>ชื่อยา(สามัญ)</strong></font></td><td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".trim($se["drugcode"])."';document.getElementById('list').innerHTML ='';\">&nbsp;",$se["drugcode"],"</A></td><td>&nbsp;".$se['tradname']."</td><td>&nbsp;".$se['genname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>


<script>
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

			url = 'dgtoedit.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<?php
//  $Thaidate=date("d-m-").(date("Y")+543)."  ".date("G:i:s");
  print "<font face='Angsana New' size='3'>แก้ไข,เพิ่ม : คำเตือน, วิธีใช้, แบ่งกลุ่มตามสารบัญยา<br>";
//  print "<font face='Angsana New'>วันที่รายงาน : $Thaidate";
?><Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา ?</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="10" onKeyPress="searchSuggest(this.value,2,'drugcode');">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="  ตกลง  " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อการค้า</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัสวิธีใช้</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัสสารบัญ</th>
  <th bgcolor=6495ED><font face='Angsana New'>คำเตือนการใช้ยา</th>
  <th bgcolor=6495ED><font face='Angsana New'>ประเภท</th>
  <th bgcolor=6495ED><font face='Angsana New'>แก้ไข</th>
 </tr>

<?php
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,unit,slcode,bcode,drugnote,drugtype FROM druglst WHERE drugcode LIKE '$drugcode%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$unit,$slcode,$bcode,$drugnote,$drugtype) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$slcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugnote</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugtype</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"drugedit.php? Dgcode=$drugcode\">แก้ไข</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>



