<?
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
	include("connect.inc");
	
	$sql = "Select drugcode,tradname,genname from druglst  where  drugcode like '%".$_GET["search1"]."%' or tradname like '%".$_GET["search1"]."%' or genname like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:600px; height:450px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>������</strong></font></td><td  align='center'><font style=\"color: #FFFFFF;\"><strong>������(��ä��)</strong></font></td><td  align='center'><font style=\"color: #FFFFFF;\"><strong>������(���ѭ)</strong></font></td><td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td></tr>";


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
  print "<font face='Angsana New' size='3'>���,���� : ����͹, �Ը���, �觡���������úѭ��<br>";
//  print "<font face='Angsana New'>�ѹ�����§ҹ : $Thaidate";
?><Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">������ ?</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="10" onKeyPress="searchSuggest(this.value,2,'drugcode');">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="  ��ŧ  " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����Ը���</th>
  <th bgcolor=6495ED><font face='Angsana New'>������úѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����͹�������</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���</th>
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
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"drugedit.php? Dgcode=$drugcode\">���</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>



