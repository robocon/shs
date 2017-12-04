<SCRIPT LANGUAGE="JavaScript">
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

function searchSuggest3(str,len,getto1,getto2) {
	
		str = str+String.fromCharCode(event.keyCode);
	//	alert(getto2);

		if(str.length >= len){
			url = 'doctor_editlst.php?action=yot&search2=' + str+'&getto1=' + getto1+'&getto2='+getto2;
			//alert(url);

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list4").innerHTML = xmlhttp.responseText;
		}
}

</SCRIPT>
<?php
include("connect.inc");
if(isset($_GET["action"]) && $_GET["action"] == "yot"){
	 
	 
	$sql = "SELECT *  FROM   prename WHERE  detail1   like '".$_GET["search2"]."%' or detail2 like '".$_GET["search2"]."%' and status ='Y' ";
	
	$result = mysql_query($sql)or die(mysql_error());
//mysql_error()."5555"

	if(mysql_num_rows($result) > 0){
		echo "<br><Div style=\"position: absolute;text-align: left; width:650px; height:300px; overflow:auto; \">";
	
		echo "<TABLE border=\"1\" bordercolor=\"#336600\" cellpadding=\"0\" cellspacing=\"0\"width=\"100%\">
		<TR>
			<TD>
			<table bgcolor=\"#FFFFCC\" width=\"100%\" border=\"0\" cellpadding=\"2\" cellspacing=\"0\">
			<tr  bgcolor=\"#336600\">
				<td align=\"center\"><font style=\"color: #FFFFFF\"><strong>รหัส</strong></font></td>
				<td align=\"center\"><font style=\"color: #FFFFFF\"><strong>ยศ:ย่อ</strong></font></td>
				<td ><font style=\"color: #FFFFFF\"><strong>ยศ:เต็ม</strong></font></td>
				<td width=\"50\" bgcolor=\"#FF0000\"><font style=\"color: #000000\"><strong><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('list4').innerHTML ='';\">ปิด</A></strong></font></td>
			</tr>";

		$i=1;
		while($arr = mysql_fetch_assoc($result)){
				
			

				if($i%2==0)
					$bgcolor="#FFFFFF";
				else
					$bgcolor="#FFFFCC";

echo "<tr bgcolor=\"$bgcolor\" >
						<td align=\"center\">".$arr["code"]."</td>
						<td  align=\"center\"><A HREF=\"javascript:void(0);\" onclick=\"document.getElementById('$_GET[getto1]').value = '".$arr['detail1']."';document.getElementById('list4').innerHTML ='';\">",$arr['detail1'],"</A></td>
					<td>".$arr['detail2']."</td>	
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					
				</tr>
			";

		$i++;
		}
		echo "</TABLE></TD>
		</TR>
		</TABLE></Div>";
	}
		exit();
	
}
////
?>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>


<?
print "<a target=_self  href='../nindex.htm' class='forntsarabun'><------ ไปเมนู</a>&nbsp;&nbsp;";
//print"<a target=_self  href='doctoradd.php' class='forntsarabun'>เพื่มแพทย์ใหม่</a><br>";



 $Thaidate=date("d-m-").(date("Y")+543);

$num ="Y";
    include("connect.inc");
    $query = "SELECT  row_id,name,doctorcode,menucode,yot,position2 FROM doctor   WHERE status ='$num' ORDER BY row_id  ";
    $result = mysql_query($query)or die("Query failed111");

   if(mysql_num_rows($result)){
        print "<div class='forntsarabun'>แพทย์ปัจจุบัน</div>";
		?>
     <form name="f1" method="post" action="doctor_edit_save.php" target="_blank">
      <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
    <th>#</th>
        	<th>ชื่อ</th>
        	<th>รหัส ว.</th>
       	    <th>ยศ</th>
       	    <!--<th>ยศเต็ม</th>-->
       	    <th>ตำแหน่ง</th>
        </tr>
       <?
	   $i=1;
        while (list ($row,$name,$doctorcode,$menucode,$yot,$position2) = mysql_fetch_row ($result)) {
    	?>
  <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td><?=$i;?></td>
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
				<td valign="top"><input name="yot<?=$i;?>" type="text" class="forntsarabun" id="yot1<?=$i;?>" value="<?=$yot;?>" size="15"/></td>
                <td valign="top"><input type="text" name="position2<?=$i;?>"  id="position2<?=$i;?>" class="forntsarabun" value="<?=$position2;?>" /></td>
	  <!--<td valign="top"><input name="position2<?//=$i;?>" type="text" class="forntsarabun" value="<?//=$position2;?>"/>-->
                <input type="hidden" name="row_id<?=$i;?>"  value="<?=$row;?>"/>
                <input type="hidden" name="max"  value="<?=$i;?>">
</td>
			</tr>
  <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td colspan="6" ><div id="list4" style="position: absolute;"></div></td>
    </tr>

            <?
			$i++;
  		 }
		?>
          <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
    <td colspan="6" align="center">
 
    <input type="submit" name="button" id="button" value="บันทึกข้อมูล"  class="forntsarabun"/></td>
    </tr>
        </table>
        </form>
       <?

	   
	   
			}
 include("unconnect.inc");  

print "<br><br><div class='forntsarabun'>แพทย์เก่า</div><br>";
 $Thaidate=date("d-m-").(date("Y")+543);
$num = N;
    include("connect.inc");
    $query = "SELECT  row_id,name,doctorcode,menucode FROM doctor   WHERE status ='$num' ORDER BY row_id  ";
    $result = mysql_query($query)or die("Query failed111");

   if(mysql_num_rows($result)){
      //  print"ข่าวสาร";
	  ?>
        <table class="forntsarabun" bordercolor="#000000">
  <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
       		<th>ชื่อ</th>
        	<th>รหัส ว.</th>
       	    <th>แผนก</th>
            <th>ใช้งาน</th>

         </tr>
        <?
        while (list ($row,$name,$doctorcode,$menucode) = mysql_fetch_row ($result)) {
		?>
           <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
				<td>	<?=$menucode;?></td>
 				 <td><a  href="doctordele1.php? row=<?=$row;?>">เปิดใช้งาน</a></td>
            </tr>
            <?
  		 }
		?>
        </table>
        <?
			}
 include("unconnect.inc");  
?>