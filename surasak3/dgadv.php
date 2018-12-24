<?php
   session_start();
if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}
include("connect.inc");
///////////////////////////////
if(isset($_GET["action"]) && $_GET["action"] == "drugreact"){
	
	$sql = "Select drugcode,tradname from druglst where tradname like '%".$_GET["search"]."%' or drugcode like '%".$_GET["search"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td width=\"25\"><strong>&nbsp;</strong></td>
		<td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>Drugcode</strong></font></td>
		<td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>Tradname</strong></font></td>
		<td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" 
		Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".$se["drugcode"]."';
		document.getElementById('".$_GET["getto2"]."').value = '".$se["tradname"]."';
		document.getElementById('list').innerHTML ='';\">".$se["drugcode"]."</A></td>
		<td>".$se['tradname']."</td>
		<td>&nbsp;</td>
		</tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
///////////////////////////////
    $sHn="";
    $sPtname="";
    $sPtright="";
    session_register("sHn");
    session_register("sPtname");
    session_register("sPtright");
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
function searchSuggest(str,len,getto,getto2) {
	
    console.log(str);
    console.log(len);
    console.log(getto);
    console.log(getto2);

    // str = str+String.fromCharCode(event.keyCode);

    if(str.length >= len){
        url = 'dgadv.php?action=drugreact&search='+ str+'&getto='+ getto+'&getto2='+ getto2;

        xmlhttp = newXmlHttp();
        xmlhttp.open("GET", url, false);
        xmlhttp.send(null);

        document.getElementById("list").innerHTML = xmlhttp.responseText;
    }
}
</script>
<?
if(isset($_POST['C1'])){
	
	for($no=1; $no<=$nrow; $no++){
     $sql = "update drugreact SET drugcode='".trim($_POST['drugc'.$no])."', tradname='".$_POST['tradn'.$no]."', advreact='".$_POST['advr'.$no]."' ,asses='".$_POST['asses'.$no]."' where row_id='".$_POST['row_id'.$no]."' ";
      //echo $sql;
	  $result = mysql_query($sql);
	  if($result){
		 ?>
		 <script>
         window.location.href='dgadv.php?cHn=<?=$_GET['hn']?>';
         </script>
         <?
		 }
	}
}
else{
    //$Thaidate=date("d-m-").(date("Y")+543);
    $Thaidate=(date("Y")+543).date("-m-d H:i:s");
    $query = "SELECT hn,yot,name,surname,ptright FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed");
 
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   if(mysql_num_rows($result)){
      $sPtname= $row->yot."  ".$row->name."  ".$row->surname;
      $sPtright = $row->ptright;
      $sHn = $row->hn;

    echo"<font face='Angsana New'>ชื่อ: $sPtname,HN: $sHn, ";  
    echo "สิทธิ: $sPtright<br>";
           }  
   else {
    die("ไม่พบ HN : $hn <br><br>
            <a target=_self  href='../nindex.htm'><<ไปเมนู</a>");
           }   

    $query = "SELECT row_id,drugcode,tradname,advreact,asses,officer FROM drugreact WHERE  hn = '$cHn' ";
    $result = mysql_query($query)
        or die("Query failed");

   if(mysql_num_rows($result)){
        print"ประวัติการแพ้ยา";
        print"<form action =\"dgadv.php?hn=$cHn\" method=\"post\"><table>";
        print" <tr>";

        print"  <th bgcolor=\"CD853F\">ลำดับ</th>";
		print"  <th bgcolor=\"CD853F\">รหัสยา</th>";
        print"  <th bgcolor=\"CD853F\">ชื่อยา</th>";
        print"  <th bgcolor=\"CD853F\">อาการแพ้</th>";
        print"  <th bgcolor=\"CD853F\">ประเมิน</th>";
		print"  <th bgcolor=\"CD853F\">แก้ไข</th>";
        print"  <th bgcolor=\"CD853F\">ลบ</th>";
        print"  <th bgcolor=\"CD853F\">ชื่อผู้บันทึก</th>";

        print" </tr>";
        while (list ($row_id,$drugcode,$tradname,$advreact,$asses,$officer) = mysql_fetch_row ($result)) {
            $n_row++;
			print (" <tr>\n".
				"  <td BGCOLOR=F5DEB3>$n_row</td>\n".
				"  <td BGCOLOR=F5DEB3>
				<span id=\"drugcode_value".$n_row."\">$drugcode</span>
				<INPUT style=\"display:none\" TYPE=\"text\" ID=\"drugc".$n_row."\" NAME=\"drugc".$n_row."\" value=\"".$drugcode."\" size=\"10\" onKeyPress=\"searchSuggest(this.value,2,'drugc".$n_row."','tradn".$n_row."');\"></td>\n".
                "  <td BGCOLOR=F5DEB3>
				<span id=\"tradname_value".$n_row."\">$tradname</span>
				<input type=\"text\" style=\"display:none\" name=\"tradn".$n_row."\" value=\"".$tradname."\" id=\"tradn".$n_row."\" readonly></td>\n".
                "  <td BGCOLOR=F5DEB3>
				<span id=\"advr_value".$n_row."\">$advreact</span>
				<input type=\"text\" style=\"display:none\" name=\"advr".$n_row."\" value=\"".$advreact."\" id=\"advr".$n_row."\"></td>\n".
                "  <td BGCOLOR=F5DEB3>
				<span id=\"asses_value".$n_row."\">$asses</span>
				<input type=\"text\" style=\"display:none\" name=\"asses".$n_row."\" value=\"".$asses."\" id=\"asses".$n_row."\"></td>\n".
				"  <td BGCOLOR=F5DEB3><a  href=\"#\" onclick=\"if(document.getElementById('drugc".$n_row."').style.display=='none'){
					document.getElementById('drugc".$n_row."').style.display='';
					document.getElementById('drugcode_value".$n_row."').style.display='none';
					document.getElementById('tradn".$n_row."').style.display='';
					document.getElementById('tradname_value".$n_row."').style.display='none';
					document.getElementById('advr".$n_row."').style.display='';
					document.getElementById('advr_value".$n_row."').style.display='none';
					document.getElementById('asses".$n_row."').style.display='';
					document.getElementById('asses_value".$n_row."').style.display='none';
					document.getElementById('ok').style.display='';}\">แก้ไข</td>\n".
                "  <td BGCOLOR=F5DEB3><a  href=\"agadvdele.php? row_id=$row_id\">ลบ</td>
                <td bgcolor=\"F5DEB3\">$officer</td>
                <input type=\"hidden\" name=\"row_id".$n_row."\" value=\"".$row_id."\" >\n".
                " </tr>\n");
  						    }
		print "<tr><td colspan='5'><input id=\"ok\" type='submit' value=' บันทึกรายการที่แก้ไข ' name='C1' style=\"display:none\"></td></tr>";
		print "<input type=\"hidden\" name=\"nrow\" value=\"".$n_row."\" >";
        print "</table></form>";
			}
 include("unconnect.inc");  
?>
<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font size='4'>บันทึกการแพ้ยา </font>

<br>&nbsp;...&nbsp;<input type='text' name='drugcode10' size='10' value='รหัสยา'>
<input type='text' name='tradname10' size='20' value='ชื่อการค้า'>
<input type='text' name='advreact10' size='10' value='อาการแพ้'>
<input type='text' name='asses10' size='2' value='*'>
<input type='text' name='reporter10' size='10' value='ผู้รายงาน'>
<input type='text' name='repdate10' size='20' value='วันที่รายงาน'>

<font face='Angsana New'>
<form method='POST' action='dgadvadd.php'>
  <Div id="list" style="left:200PX;top:30PX;position:absolute;"></Div>
  1.&nbsp;
  <input type='text' name='drugcode1' size='10' id="drugcode1" onKeyPress="searchSuggest(this.value,2,'drugcode1','tradname1');">
  <input type='text' name='tradname1' size='20' id="tradname1" onKeyPress="searchSuggest(this.value,2,'drugcode1','tradname1');">
  <input type='text' name='advreact1' size='10'>
  <input type='text' name='asses1' size='2'>
  <input type='text' name='reporter1' size='10' value='OPD'>
  <input type='text' name='repdate1' size='20' value='<?=$Thaidate?>'><br>
  2.&nbsp; <input type='text' name='drugcode2' size='10' id="drugcode2" onKeyPress="searchSuggest(this.value,2,'drugcode2','tradname2');">
<input type='text' name='tradname2' size='20' id="tradname2" onKeyPress="searchSuggest(this.value,2,'drugcode2','tradname2');">
<input type='text' name='advreact2' size='10'>
  <input type='text' name='asses2' size='2'>
  <input type='text' name='reporter2' size='10' value='OPD'>
  <input type='text' name='repdate2' size='20' value='<?=$Thaidate?>'><br>
  3.&nbsp; <input type='text' name='drugcode3' size='10' id="drugcode3" onKeyPress="searchSuggest(this.value,2,'drugcode3','tradname3');">
<input type='text' name='tradname3' size='20' id="tradname3" onKeyPress="searchSuggest(this.value,2,'drugcode3','tradname3');">
<input type='text' name='advreact3' size='10'>
  <input type='text' name='asses3' size='2'>
  <input type='text' name='reporter3' size='10' value='OPD'>
  <input type='text' name='repdate3' size='20'  value='<?=$Thaidate?>'><br>
  4.&nbsp; <input type='text' name='drugcode4' size='10' id="drugcode4" onKeyPress="searchSuggest(this.value,2,'drugcode4','tradname4');">
<input type='text' name='tradname4' size='20' id="tradname4" onKeyPress="searchSuggest(this.value,2,'drugcode4','tradname4');">
<input type='text' name='advreact4' size='10'>
  <input type='text' name='asses4' size='2'>
  <input type='text' name='reporter4' size='10' value='OPD'>
  <input type='text' name='repdate4' size='20' value='<?=$Thaidate?>'><br>
  5.&nbsp; <input type='text' name='drugcode5' size='10' id="drugcode5" onKeyPress="searchSuggest(this.value,2,'drugcode5','tradname5');">
 <input type='text' name='tradname5' size='20' id="tradname5" onKeyPress="searchSuggest(this.value,2,'drugcode5','tradname5');">
 <input type='text' name='advreact5' size='10'>
  <input type='text' name='asses5' size='2'>
  <input type='text' name='reporter5' size='10' value='OPD'>
  <input type='text' name='repdate5' size='20' value='<?=$Thaidate?>'><br>
  6.&nbsp; <input type='text' name='drugcode6' size='10' id="drugcode6" onKeyPress="searchSuggest(this.value,2,'drugcode6','tradname6');">
<input type='text' name='tradname6' size='20' id="tradname6" onKeyPress="searchSuggest(this.value,2,'drugcode6','tradname6');">
<input type='text' name='advreact6' size='10'>
  <input type='text' name='asses6' size='2'>
  <input type='text' name='reporter6' size='10' value='OPD'>
  <input type='text' name='repdate6' size='20' value='<?=$Thaidate?>'><br>
  7.&nbsp; <input type='text' name='drugcode7' size='10' id="drugcode7" onKeyPress="searchSuggest(this.value,2,'drugcode7','tradname7');">
<input type='text' name='tradname7' size='20' id="tradname7" onKeyPress="searchSuggest(this.value,2,'drugcode7','tradname7');">
<input type='text' name='advreact7' size='10'>
  <input type='text' name='asses7' size='2'>
  <input type='text' name='reporter7' size='10' value='OPD'>
  <input type='text' name='repdate7' size='20' value='<?=$Thaidate?>'><br>
&nbsp;&nbsp;&nbsp;*การประเมิน :&nbsp; &nbsp;1=แน่นอน(certain), 2=น่าจะใช่(probable), 3=เป็นไปได้(possible), 4=ไม่ใช่(unlikely) 5=ไม่สามารถจำแนกได้(unclassified)&nbsp;<br>  
** การใส่รหัสยาจะช่วยเพิ่มความสมบูรณ์ของ43แฟ้มไฟล์<br>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type='submit' value='          บันทึก          ' name='B1'>
  <br />
<a href="drugreact_book.php">แพ้ยาตามกลุ่ม</a>
</form>
<?
}
?>
