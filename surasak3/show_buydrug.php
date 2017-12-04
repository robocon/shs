<?
	include("connect.inc");
	$d=date('d');
	$m=date('m');
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
</style>
<?
if(isset($_GET["action"]) && $_GET["action"] == "dgcode"){	
	$sql = "Select  comcode,comname,tel from company  where   comcode  like '%".$_GET["search1"]."%' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:800px; height:430px; overflow:auto; \">";

		echo "<table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\">
		<tr align=\"center\" bgcolor=\"#333333\">
		<td><strong>&nbsp;</strong></td>
		<td><font style=\"color: #FFFFFF;\"><strong>รหัสบริษัท</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>ชื่อบริษัท</strong></font></td>
		<td><font style=\"color: #FFFFFF;\"><strong>เบอร์โทร</strong></font></td>
		<td><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">ปิด</font></A></strong></td>
		</tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr>
		<td valign=\"top\"></td>
		<td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value='",trim($se["comcode"]),"';document.getElementById('list').innerHTML ='';\">",$se["comcode"],"</A></td><td>".$se['comname']."</td><td>".$se['tel']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>
<script>
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

			url = 'show_buydrug.php?action=dgcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<form method="POST" action="show_buydrug.php">
<input name="act" type="hidden" value="show">
<b>ข้อมูลการจัดซื้อยา</b>       <a target=_self  href='../nindex.htm'><< ไปเมนูหลัก </a>
<Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
  <p><strong>รหัสบริษัท : </strong>
    <input name="dgcode" type="text" class="forntsarabun"  id="dgcode" onKeyPress="searchSuggest(this.value,2,'dgcode');" size="7">
    </b></font>  </p>
  <p><strong>ช่วงระหว่างวันที่ 
    <input name="d_start" type="text" class="forntsarabun" id="d_start" value="<?=$d;?>" size="3" /> เดือน :</strong> 
    <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select> 
    <strong>ปี :</strong> 
    <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
  <?
				}
				echo "<select>";
				?> 
  <strong>ถึง</strong> <strong>วันที่
  <input name="d_end" type="text" class="forntsarabun" id="d_end" value="<?=$d;?>" size="3" />
เดือน :</strong>
  <select name="m_end" class="forntsarabun" id="m_end">
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
    <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
    <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
    <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
    <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
    <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
    <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
    <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
    <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
    <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
    <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
    <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
  </select>
  <strong>ปี :</strong>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_end' class='forntsarabun'>";
				foreach($dates as $i){

				?>
  <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
  <?=$i;?>
  </option>
  <?
				}
				echo "<select>";
				?>
  </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="B1" type="Submit" class="forntsarabun" value="ตกลง">
  </p>
  </form>
<?
if($_POST["act"]=="show"){
echo "<div align='center'>";
echo "<hr>";
  	$startdate=($_POST["y_start"]-543)."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=($_POST["y_end"]-543)."-".$_POST["m_end"]."-".$_POST["d_end"];
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];	
	$tbsql="select  * from combill where comcode='".$_POST["dgcode"]."' and (date between '$startdate 00:00:00' and '$enddate 23:59:59')";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
	
	$sql=mysql_query("select  * from combill where comcode='".$_POST["dgcode"]."' and (date between '$startdate 00:00:00' and '$enddate 23:59:59')");
	$rows=mysql_fetch_array($sql);
?> 
<div align="center"><strong>ข้อมูลการจัดซื้อยา</strong></div>
<div align="center"><strong>บริษัท </strong>
  <?="(".$rows["comcode"].")".$rows["comname"];?>
</div>
<div align="center"><strong>ช่วงระหว่างวันที่ </strong>
  <?=$showstart." ถึงวันที่ ".$showend;?>
</div>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>date</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>billno</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>billdate</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>drugcode</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>tradname</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>genname</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>lotno</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>amount</strong></td>
    <td width="7%" align="center" bgcolor="#66CC99"><strong>unit/price</strong></td>
    <td width="9%" align="center" bgcolor="#66CC99"><strong>price</strong></td>
  </tr>
  <?
	if($tbnum < 1){
		echo "<tr><td colspan='11' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$tbrows["date"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["billno"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["billdate"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["drugcode"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["tradname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["genname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["lotno"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$tbrows["amount"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$tbrows["unitpri"];?></td>
    <td align="right" bgcolor="#CCFFCC"><?=$tbrows["price"];?></td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<?
echo "</div>";
}
?>