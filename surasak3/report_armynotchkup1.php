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
</style>
<?
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

    
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
?>
<strong>กำลังพลที่ยังไม่มาตรวจสุขภาพ หรือ ตรวจไม่ครบตามกระบวนการ ประจำปี <?=$year;?><br />
	 แผนก/ฝ่าย <?  if($_GET["camp"]=="all"){ echo "ทุกสังกัด";}else{ echo $camp;}?><br />
    รายงานวันที่ <?=$Thidate;?></strong>
<table width="100%" border="1" align="center" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
 <tr>
   <th width="3%" bgcolor="#FFFFFF">#</th>
  <th width="7%" bgcolor="#FFFFFF">HN</th>
  <th width="6%" bgcolor="#FFFFFF">ยศ</th>
  <th width="16%" bgcolor="#FFFFFF">ชื่อ</th>
  <th width="7%" bgcolor="#FFFFFF">อายุ</th>
  <th width="11%" bgcolor="#FFFFFF">ตำแหน่ง</th>
  <th width="13%" bgcolor="#FFFFFF">LAB</th>
  <th width="13%" bgcolor="#FFFFFF">XRAY</th>
  <th width="12%" bgcolor="#FFFFFF">วันที่พบแพทย์</th>
 </tr>

<?php
 include("connect.inc");
 $query="SELECT * FROM chkup_solider  WHERE yearchkup='$year' and camp='$camp' ORDER by row_id";
// echo $query;
  $result = mysql_query($query)or die("Query failed");
  $num=0;
  while($rows=mysql_fetch_array($result)){	
		$num++;
?>
 <? if((!empty($rows["lab"]) || !empty($orderdate)) &&  !empty($rows["xray"]) &&  !empty($rows["opd"]) && !empty($rows["dr"])){ $bgcolor="#FFFFFF";}else{ $bgcolor="#FF99CC";}?>
  <tr>
    <td align="center" bgcolor="<?=$bgcolor;?>"><?=$num;?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["hn"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["yot"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["ptname"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>"><?=$rows["age"];?></td>
	<td bgcolor="<?=$bgcolor;?>"><?=$rows["position"];?></td>
	<td align="center" bgcolor="<?=$bgcolor;?>">
	<?
    if(empty($rows["lab"])){
 		$sql1="select date,price from opacc where depart='PATHO' and hn='$rows[hn]' and credit='CHKUP$year'";
		$query1=mysql_query($sql1);
		list($labdate,$labprice) = mysql_fetch_array($query1);		
		if(!empty($labdate)){
			echo substr($labdate,0,10)." ($labprice)";
		}
	}else{
 		$sql1="select date,price from opacc where depart='PATHO' and hn='$rows[hn]' and credit='CHKUP$year'";
		$query1=mysql_query($sql1);
		list($labdate,$labprice) = mysql_fetch_array($query1);			
		if(!empty($labdate)){
			echo substr($rows["lab"],0,10)." ($labprice)";
		}
	}
	?>    </td>
    <td align="center" bgcolor="<?=$bgcolor;?>">
	<?
    if(empty($rows["xray"])){
 		$sql1="select date,price from opacc where depart='XRAY' and hn='$rows[hn]' and credit='CHKUP$year'";
		$query1=mysql_query($sql1);
		list($xraydate,$xrayprice) = mysql_fetch_array($query1);		
		if(!empty($xraydate)){
			echo substr($xraydate,0,10)." ($xrayprice)";
		}
	}else{
 		$sql1="select date,price from opacc where depart='XRAY' and hn='$rows[hn]' and credit='CHKUP$year'";
		$query1=mysql_query($sql1);
		list($xraydate,$xrayprice) = mysql_fetch_array($query1);			
		if(!empty($xraydate)){
			echo substr($rows["xray"],0,10)." ($xrayprice)";
		}
	}
	?>
    </td>
    <td align="center" bgcolor="<?=$bgcolor;?>">
	<?
    if(empty($rows["dr"])){
		$chkyear="25$year";
 		$sql1="select thidate from condxofyear_so where hn='$rows[hn]' and yearcheck='$chkyear'";
		$query1=mysql_query($sql1);
		list($drdate) = mysql_fetch_array($query1);		
		echo substr($drdate,0,10);
	}else{
		echo substr($rows["dr"],0,10);
	}
	?>    </td>
  </tr>
<?  
}       
?>
</table>

<?
include("unconnect.inc");
?>
