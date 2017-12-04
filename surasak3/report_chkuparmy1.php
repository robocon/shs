<?php
session_start();
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
.style1 {
	font-size: 16px;
	color: #FF3333;
}
</style>
<?
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

    
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
	 <strong>รายชื่อผู้เข้ารับตรวจสุขภาพประจำปี <?=$year;?><br />
	 แผนก/ฝ่าย <?  if($_GET["camp"]=="all"){ echo "ทุกสังกัด";}else{ echo $camp;}?><br />
    รายงานวันที่ <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="3%" bgcolor="6495ED">#</th>
  <th width="5%" bgcolor="6495ED">HN</th>
  <th width="4%" bgcolor="6495ED">ยศ</th>
  <th width="11%" bgcolor="6495ED">ชื่อ</th>
  <th width="3%" bgcolor="6495ED">เพศ</th>
  <th width="3%" bgcolor="6495ED">อายุ</th>
  <th width="8%" bgcolor="6495ED">ชั้นยศ</th>
  <th width="8%" bgcolor="6495ED">เลขประจำตัวประชาชน</th>
  <th width="7%" bgcolor="6495ED">สังกัด</th>
  <th width="6%" bgcolor="6495ED">ตำแหน่ง</th>
  <th width="5%" bgcolor="6495ED">ช่วยราชการ</th>
  <th width="5%" bgcolor="6495ED">สิทธิเบิก</th>
  <th width="3%" bgcolor="6495ED">idno</th>
  <th width="6%" bgcolor="6495ED">วันที่ลงทะเบียน</th>
  <th width="4%" bgcolor="6495ED">วันที่ตรวจ LAB</th>
  <th width="3%" bgcolor="6495ED">คิว LAB</th>
  <th width="4%" bgcolor="6495ED">วันที่ XRAY</th>
  <th width="6%" bgcolor="6495ED">วันที่ซักประวัติ</th>
  <th width="6%" bgcolor="6495ED">วันที่พบแพทย์</th>
  <th width="6%" bgcolor="6495ED">ค่าบริการ<br />
    LAB</th>
  <th width="6%" bgcolor="6495ED">ค่าบริการ<br />
    XRAY</th>
  <th width="6%" bgcolor="6495ED">พิมพ์ผล</th>
 </tr>

<?php
 include("connect.inc");
 if($_GET["camp"]=="all"){
 $query="SELECT * FROM chkup_solider WHERE yearchkup='$year' ORDER by thidate,idno";
 }else{
 $query="SELECT * FROM chkup_solider WHERE camp='$camp' and yearchkup='$year'  ORDER by thidate,idno";
 }
  $result = mysql_query($query)or die("Query failed");
  while($rows=mysql_fetch_array($result)){	
 
     if(empty($rows["lab"])){
		$chklab=mysql_query("select orderdate from resulthead where hn='".$rows["hn"]."' and clinicalinfo='ตรวจสุขภาพประจำปี$year' limit 1");
		list($orderdate)=mysql_fetch_array($chklab);
	} 
  
  
?>
 <? if((!empty($rows["lab"]) || !empty($orderdate)) &&  !empty($rows["xray"]) &&  !empty($rows["opd"]) && !empty($rows["dr"])){ $bgcolor="F5DEB3";}else{ $bgcolor="FF9999";}?>
  <tr>
    <td align="center" bgcolor="<?=$bgcolor;?>"><?=$num;?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["hn"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["yot"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ptname"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><? if($rows["gender"]==1){ echo "ชาย";}else if($rows["gender"]==2){ echo "หญิง";}?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["age"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=substr($rows["chunyot"],5);?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["idcard"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=substr($rows["camp"],4);?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["position"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ratchakarn"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><? if($rows["dxptright"]==1){ echo "ข้าราชการ";}?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["idno"];?></td>  
    <td bgcolor="<?=$bgcolor;?>"><?=$rows["thidate"];?></td>
    <td bgcolor="<?=$bgcolor;?>">
    <?
    if(!empty($rows["lab"])){
		echo $rows["lab"];
	}else if(!empty($orderdate)){
		echo $orderdate;
	}
	?>
    </td>
    <td bgcolor="<?=$bgcolor;?>">
    <?
    if(!empty($rows["qlab"])){
		echo $rows["qlab"];
	}else if(!empty($orderdate)){
		echo "<div style='color:red'>สั่ง LAB ผป.นอก</div>";
	}
	?>	
	</td>
    <td bgcolor="<?=$bgcolor;?>"><?=$rows["xray"];?></td>
    <td bgcolor="<?=$bgcolor;?>"><?=$rows["opd"];?></td>
    <td bgcolor="<?=$bgcolor;?>"><?=$rows["dr"];?></td>
    <td align="right" bgcolor="<?=$bgcolor;?>">
	<?
    if(!empty($rows["lab"])){
		$labsql="select price from opacc where hn='$rows[hn]' and depart='PATHO' and detail='ตรวจสุขภาพ' and credit='CHKUP$year'";
		$labquery=mysql_query($labsql);
		list($price) = mysql_fetch_array($labquery);
		echo $price;
	}else if(!empty($orderdate)){
		$labsql="select price from opacc where hn='$rows[hn]' and depart='PATHO' and detail='ค่าตรวจวิเคราะห์โรค' and credit='CHKUP$year'";
		$labquery=mysql_query($labsql);
		list($price) = mysql_fetch_array($labquery);
		echo "<div style='color:red'>$price</div>";		
	}
	?>	
    </td>
    <td align="center" bgcolor="<?=$bgcolor;?>">
	<?
		$labsql="select price from opacc where hn='$rows[hn]' and depart='XRAY' and detail='ค่าตรวจวิเคราะห์โรค' and credit='CHKUP58'";
		$labquery=mysql_query($labsql);
		list($price) = mysql_fetch_array($labquery);
		echo $price;
    ?>    
    </td>
    <td align="center" bgcolor="<?=$bgcolor;?>"><? if((!empty($rows["lab"]) || !empty($orderdate)) &&  !empty($rows["xray"]) &&  !empty($rows["opd"]) && !empty($rows["dr"])){ echo "<a href='report_dxofyear.php?hn=$rows[hn]' target='_blank'>พิมพ์</a>";}else{ echo "&nbsp;";}?></td>
  </tr>
<?  
$num++;
}       
?>
</table>
<?
include("unconnect.inc");
?>
