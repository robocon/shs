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
<?
		$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		$showyear="25".$nPrefix;
?>		
<form method="POST" action="show_labhncoder.php">
<input name="act" type="hidden" value="show">
<b>ข้อมูลกำลังพลที่มาเจาะเลือดตรวจสุขภาพประจำปี <?=$$showyear;?></b>       <a target=_self  href='../nindex.htm'><< ไปเมนูหลัก </a>
<Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
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
  	$startdate=$_POST["y_start"]."-".$_POST["m_start"]."-".$_POST["d_start"];
	$enddate=$_POST["y_end"]."-".$_POST["m_end"]."-".$_POST["d_end"];
	
  	$startksdate=($_POST["y_start"]-543)."-".$_POST["m_start"]."-".$_POST["d_start"];
	$endksdate=($_POST["y_end"]-543)."-".$_POST["m_end"]."-".$_POST["d_end"];
		
	$showstart=$_POST["d_start"]."/".$_POST["m_start"]."/".$_POST["y_start"];
	$showend=$_POST["d_end"]."/".$_POST["m_end"]."/".$_POST["y_end"];	
	$tbsql="select  * from chkup_solider where lab between '$startdate 00:00:00' and '$enddate 23:59:59' and yearchkup='$nPrefix' order by camp asc";
	//echo $tbsql;
	$tbquery=mysql_query($tbsql);
	$tbnum=mysql_num_rows($tbquery);
?> 
<div align="center"><b>ข้อมูลกำลังพลที่มาเจาะเลือดตรวจสุขภาพ</b><b>ประจำปี
    <?=$showyear;?>
</b> </div>
<div align="center"></div>
<div align="center"><strong>ช่วงระหว่างวันที่ </strong>
  <?=$showstart." <strong>ถึงวันที่</strong> ".$showend;?>
</div>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="21%" align="center" bgcolor="#66CC99"><strong>ชื่อ</strong></td>
    <td width="23%" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="22%" align="center" bgcolor="#66CC99"><strong>ตำแหน่ง</strong></td>
  </tr>
  <?
	if($tbnum < 1){
		echo "<tr><td colspan='11' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$i=0;
		while($tbrows=mysql_fetch_array($tbquery)){
		$i++;
		$chkdate=substr($tbrows["lab"],0,10);
		$sql="select vn from opday where hn='$tbrows[hn]' and thidate like '$chkdate%' ";
		//echo $sql;
		$query=mysql_query($sql);
		list($vn)=mysql_fetch_array($query);
?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$tbrows["lab"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$vn;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["yot"]." ".$tbrows["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["camp"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows["position"];?></td>
  </tr>
  <?
	  	}
	}
  ?>
</table>
<br />
<p align="center"><strong>รายชื่อทหารที่มาเจาะเลือด โดยไม่ได้ผ่านโปรแกรมการสั่ง LAB ตรวจสุขภาพประจำปี</strong></p>
<?
	$tbsql1="SELECT DISTINCT (a.hn) AS hn, a.`orderdate`, b.yot, b.ptname, b.camp, b.position FROM resulthead AS a INNER JOIN chkup_solider AS b ON a.hn = b.hn WHERE a.hn !='47-9999' AND (b.lab = '' AND b.qlab='') AND a.orderdate between '$startksdate 00:00:00' and '$endksdate 23:59:59' and a.clinicalinfo='ตรวจสุขภาพประจำปี58' and b.yearchkup='$nPrefix'";
	//echo $tbsql1;
	$tbquery1=mysql_query($tbsql1);
	$tbnum1=mysql_num_rows($tbquery1);
?>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="12%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="21%" align="center" bgcolor="#66CC99"><strong>ชื่อ</strong></td>
    <td width="23%" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="22%" align="center" bgcolor="#66CC99"><strong>ตำแหน่ง</strong></td>
  </tr>
  <?
	if($tbnum1 < 1){
		echo "<tr><td colspan='11' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
	}else{
		$n=0;
		while($tbrows1=mysql_fetch_array($tbquery1)){
		$n++;
		$date1=substr($tbrows1["orderdate"],0,10);
		//echo $date1;
		list($yy,$mm,$dd)=explode("-",$date1);
		$year=$yy+543;
		$orderdate="$year-$mm-$dd";
		$sql="select vn from opday where hn='$tbrows1[hn]' and thidate like '$orderdate%' ";
		//echo $sql;
		$query=mysql_query($sql);
		list($vn)=mysql_fetch_array($query);
?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$n;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$orderdate;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows1["hn"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$vn;?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows1["yot"]." ".$tbrows1["ptname"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows1["camp"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$tbrows1["position"];?></td>
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