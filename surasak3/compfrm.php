<?php
if(isset($_GET["action"]) && $_GET["action"] == "comcode"){
	include("connect.inc");
	
	$sql = "Select comcode,comname from company  where  comcode like '%".$_GET["search1"]."%' or comname like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:800px; height:430px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>���ʺ���ѷ</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>���ͺ���ѷ</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["comcode"]),"';document.getElementById('list').innerHTML ='';\">",$se["comcode"],"</A></td><td>".$se['comname']."</td><td>&nbsp;</td></tr>";
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

			url = 'compfrm.php?action=comcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}

function chkfrm(){
	if(document.getElementById('ponum').value==""){
		alert("��س�����Ţ������觫��ʹ��¤��");
		document.getElementById('ponum').focus();
		return false;
	}else{ return true;}
}
</script>

<?
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ�ͧ����ѷ ���͡����觫���<br> ";
	
?>
  <form method="post" action="compseek.php" onsubmit="return chkfrm();"><Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
<font face="Angsana New"><a target=_BLANK href="comcode.php">���ʺ���ѷ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="comcode" size="10" onkeypress="searchSuggest(this.value,2,'comcode');"></font>
&nbsp;<font face="Angsana New">�Ţ���觫���
<input type="text" name="ponum" size="10" id="ponum"/>
</font>&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font>
</form>




