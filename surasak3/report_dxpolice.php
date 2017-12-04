<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
.tet {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.tet1 {
	font-family: "TH SarabunPSK";
	font-size: 36px;
}
.text3 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.text {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
.texthead {
	font-family: "TH SarabunPSK";
	font-size: 25px;
}
.text1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.text2 {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.textsub {
	font-size: 15px;
}
-->
</style>
<?
if(isset($_POST['hn'])){
	$select = "select * from out_result_chkup where hn = '".$_POST['hn']."'";
	$row = mysql_query($select);
	$num = mysql_num_rows($row);

	if($num>0){
	?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> , <a href ="report_dxofyear.php" >[ HN ใหม่ ]</a>
<table width="485" border="1" cellpadding="0" cellspacing="0"><tr>
    <td width="101" align="center"><span class="tet">วันที่ตรวจ</span></td>
    <td width="197" align="center"><span class="tet">ชื่อ-สกุล</span></td>
    <td width="37" align="center">&nbsp;</td>
    <td width="53" align="center">&nbsp;</td>
    <td width="46" align="center">&nbsp;</td></tr>
    <?
    
		$i=0;
		while($result = mysql_fetch_array($row)){
			if($i==1){
					$i=0;
					$bgcolor = "#FFFFA6";
				}else{
					$bgcolor = "#FFFFFF";
					$i=1;
				}
		?>
		<tr bgcolor=<?=$bgcolor?>><td><span class="tet">11-09-2556
		</span></td>
		  <td><span class="tet">
		  <?=$result["ptname"]?>
		  </span></td>
		  <td align="center"><span class="tet"><a href="report_dxpolice.php?id=<?=$result["row_id"]?>" target="_blank">พิมพ์</a></span></td>
          <td align="center"><span class="tet"><a href="report_dxpolice.php?id=<?=$result["row_id"]?>&no" target="_blank">ดูข้อมูล</a></span></td>
		  <td align="center"><span class="tet"><a href="report_dxpolice.php?ids=<?=$result["row_id"]?>" target="_blank">Stricker</a></span></td>
		</tr>
		<?
		}
	}else{
		?>
        <meta content="1" http-equiv="refresh"  />
		<?
	}
	?>
</table>
	<?
}elseif(isset($_GET['ids'])){
	$detail = "select * from out_result_chkup where row_id = '".$_GET['ids']."' ";
	$result = Mysql_Query($detail);
	$arrs = Mysql_fetch_assoc($result);
	?>
<script language="javascript">
		window.print();
	</script>
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
	<tr>
	  <td>ผลการตรวจสุขภาพประจำปี</td>
	  </tr>
	<tr>
		<td>ชื่อ : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
	  </tr>
	<tr>
	  <td>วันที่ตรวจ : <?php echo $arrs["thidate"];?></td>
	  </tr>
	  <tr>
		<td>ผลการตรวจ : <?php echo $arrs["summary"];?></td>
	  </tr>
      <?
      	if($_POST['normal41']=="ผิดปกติ"|$_POST['normal42']=="ผิดปกติ"|$_POST['normal43']=="ผิดปกติ") $text41="ตับ";
		if($_POST['normal44']=="ผิดปกติ"|$_POST['normal45']=="ผิดปกติ") $text44="ไต";
		if($_POST['normal46']=="ผิดปกติ"|$_POST['normal48']=="ผิดปกติ") $text46="ไขมัน";
		if($_POST['normal47']=="ผิดปกติ") $text47="เบาหวาน";
		if($_POST['normal49']=="ผิดปกติ") $text49="URIC";
		if($_POST['normal81']=="ผิดปกติ") $text81="CBC";
		if($_POST['normal']=="ผิดปกติ") $text="UA";
	  ?>
	  <? if($arrs["summary"]=="ผิดปกติ"){?>
	  <tr>
	    <td>Diag: <?=$arrs["diag"]?></td>
      </tr>
      <tr>
	    <td>บันทึกจากแพทย์: <?=$arrs["dx"]?></td>
      </tr>
      <tr>
	    <td>ความผิดปกติ: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
      </tr>
      <? }?>
	  <tr>
		<td>แพทย์ : <?php echo $arrs["doctor"];?></td>
	  </tr>
</table>
<?
}elseif(isset($_GET['id'])){

	$select = "select * from out_result_chkup  where row_id='".$_GET['id']."'";
	$row = mysql_query($select);
	$result = mysql_fetch_array($row);
	
$sql1="CREATE TEMPORARY TABLE  result1  Select * from  resulthead  WHERE hn='".$result['hn']."' and clinicalinfo ='ตรวจสุขภาพตำรวจ' ";
$query1 = mysql_query($sql1); 
	

?>
<table width="100%">
<tr>
  <td>
<table width="100%">
<tr>
  <td width="9%" rowspan="3" align="center" valign="top" class="texthead"><img src="logo.jpg" width="87" height="83" /></td>
  <td width="77%" align="center" valign="top" class="texthead"><strong>แบบรายงานการตรวจสุขภาพตำรวจ</strong></td>
  <td width="14%" align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="texthead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร.054-839305</strong></td>
  <td align="center" valign="top" class="texthead">&nbsp;</td>
</tr>
<tr>
  <td align="center" valign="top" class="text3"><span class="text"><span class="text1"><span class="text2">ตรวจเมื่อวันที่  11 กันยายน 2556
  </span></span></span></td>
  <td align="center" valign="top" class="text3">&nbsp;</td>
</tr>
</table>
</td></tr>
<tr>
  <td valign="top">
  <table border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" width="92%" >
  <tr><td>
  <table width="97%" class="text1"><tr><td width="15%" valign="top" class="text2"><strong>HN :</strong>    <?=$result['hn']?></td>
  <td colspan="3" valign="top" class="text2"><strong>ชื่อ :</strong>    <span style="font-size:24px"><strong><?=$result['ptname']?></strong></span></td>
  <td valign="top" class="text2"><strong>อายุ :</strong>
    <?=$result['age']?></td>
  <td valign="top" class="text3"><strong>สังกัด : </strong>
    <span style="font-size:24px"><strong><?=$result['camp']?></strong></span>
  </td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>น้ำหนัก: </strong>
  <?=$result['weight']?>กก.</span></td>
  <td width="14%" valign="top"><span class="text3"><strong>ส่วนสูง:</strong>
    <?=$result['height']?>
ซม.</span></td>
  <td width="10%" valign="top"><span class="text3"><strong>BMI: </strong>
    <u><?=$result['bmi']?></u>
  </span></td>
  <td width="14%" valign="top"><span class="text3"><strong>รอบเอว:</strong>
    <?=$result['round_']?>
ซม.</span></td>
  <td width="19%" valign="top"><span class="text3"><strong>แพ้ยา:</strong> 
  </span></td>
  <td width="28%" valign="top"><span class="text3"><strong>โรคประจำตัว:
  </strong>
  </span></td>
  </tr>
<tr>
  <td valign="top"><span class="text3"><strong>บุหรี่: </strong>
    <? if($result['cigarette']=="1") echo "สูบ"; else echo "ไม่สูบ";?>
  </span></td>
  <td valign="top"><span class="text3"><strong>สุรา: </strong>
    <? if($result['alcohol']=="1") echo "ดื่ม"; else echo "ไม่ดื่ม";?>
  </span></td>
  <td valign="top"><span class="text3"><strong>T:</strong>
<u><?=$result['temperature']?></u>
C ํ</span></td>
  <td valign="top"><span class="text3"><strong>P:
  </strong>
    <?=$result['pause']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>R: </strong>
    <?=$result['rate']?>
ครั้ง/นาที</span></td>
  <td valign="top"><span class="text3"><strong>BP:</strong>
    <u><?=$result['bp1']?>
/
<?=$result['bp2']?>
mmHg.</u></span></td>
</tr>
<tr>

  </tr>
  </table></td></tr></table></td>
  </tr>
<tr class="text3">
  <td align="center" valign="top" ><strong class="text" style="font-size:22px"><u>UA : การตรวจการทำงานของปัสสาวะ</u></strong>
    <table width="100%">
      <tr>
      <?
	$sql="SELECT * FROM result1 WHERE profilecode='UA' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
	 // echo $sql;
		//echo $arrresult['autonumber'];
		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		echo"<table border=\"0\" width='100%'  cellspacing=\"1\" cellpadding=\"1\"><tr>";
		$intRows = 0;
		//echo $strSQL;
		while($objResult = mysql_fetch_array($objQuery))
		{
			echo "<td class='text3'>"; 
			$intRows++;
	?>

				<?=$objResult["labcode"];?> &nbsp;&nbsp;: &nbsp;<?=$objResult["result"];?><?=$objResult["unit"];?>

	<?
			echo"</td>";
			if(($intRows)%6==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	?>
        </tr>
        
    </table>
    <hr />
</tr>
<tr class="text3">
  <td align="center" valign="top" ><center><strong class="text" style="font-size:22px"><u>CBC : การตรวจเม็ดเลือด</u></strong></center>
    <table width="100%">
    <tr>
     <?
	$sql="SELECT * FROM result1 WHERE profilecode='CBC' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
	 // echo $sql;
		//echo $arrresult['autonumber'];
		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		echo"<table border=\"0\" width='100%'  cellspacing=\"1\" cellpadding=\"1\"><tr >";
		$intRows = 0;
		//echo $strSQL;
		while($objResult = mysql_fetch_array($objQuery))
		{
			echo "<td class='text3'>"; 
			$intRows++;
	?>
		<?=$objResult["labcode"];?> &nbsp;&nbsp;: &nbsp;<?=$objResult["result"];?><?=$objResult["unit"];?>

	<?
			echo"</td>";
			if(($intRows)%6==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	?>
       
          </tr>
  </table>   
   <hr />
</tr>
   <tr class="text3">
  <td align="center" valign="top" ><center><strong class="text" style="font-size:22px"><u>STOOL : การตรวจอุจจาระ</u></strong></center>
    <table width="100%">
    <tr>
     <?
	$sql="SELECT * FROM result1 WHERE profilecode='STOOL' ";
	$query = mysql_query($sql);
	$arrresult = mysql_fetch_array($query);
	 // echo $sql;
		//echo $arrresult['autonumber'];
		$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
		$objQuery = mysql_query($strSQL);
		echo"<table border=\"0\" width='100%'  cellspacing=\"1\" cellpadding=\"1\"><tr >";
		$intRows = 0;
		//echo $strSQL;
		while($objResult = mysql_fetch_array($objQuery))
		{
			echo "<td class='text3'>"; 
			$intRows++;
	?>
		<?=$objResult["labcode"];?> &nbsp;&nbsp;: &nbsp;<?=$objResult["result"];?><?=$objResult["unit"];?>

	<?
			echo"</td>";
			if(($intRows)%6==0)
			{
				echo"</tr>";
			}
		}
		echo"</tr></table>";
	?>
       
          </tr>
  </table>   
   <hr />
   </td></tr>
<tr>
  <td valign="top" class="text"></td>
  </tr>
<tr>
<td valign="top">
<? 	
$sql="SELECT * FROM result1 WHERE profilecode='METAMP' ";
$query = mysql_query($sql);
$arrresult = mysql_fetch_array($query); 

$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
	?>  
  
  <strong class="text" style="font-size:22px"><u>AMP</u></strong>   :   <strong class="text3" ><?=$objResult["result"];?><?=$objResult["unit"];?></strong><BR /></td>
</tr>
<tr>
 <td valign="top">
<? 	
$sql="SELECT * FROM result1 WHERE profilecode='VDRL' ";
$query = mysql_query($sql);
$arrresult = mysql_fetch_array($query); 

$strSQL = "SELECT * FROM resultdetail  WHERE autonumber='".$arrresult['autonumber']."' ";
$objQuery = mysql_query($strSQL);
$objResult = mysql_fetch_array($objQuery);
?>  
  <strong class="text" style="font-size:22px"><u>VDRL</u></strong>   :   <strong class="text3" ><?=$objResult["result"];?><?=$objResult["unit"];?></strong><BR /></td>
</tr>
<tr>
  <td valign="top"><strong class="text" style="font-size:22px"><u>Xray</u></strong>  : <strong class="text3" ><?=$result['cxr']?></strong></td>
</tr>
</table>

<span class="text">
<?
}else{
?>
</span>
<!--<a href="report_dxofyear_emp.php">พิมพ์ใบตรวจสุขภาพลูกจ้าง</a>-->
<form name="formdx" action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
<span class="tet1">พิมพ์ใบตรวจสุขภาพตำรวจ</span> <br />
  <br />
  <span class="tet1">&nbsp;&nbsp;&nbsp;&nbsp;กรอก HN : </span>
    <input name="hn" type="text" size="10" class="tet1">
  <input type="submit" name="ok" value="ตกลง">
  <br />
  <br />

<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a> 
</center>
</form>

<table border="1" width="30%" class="text1" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
<?	

////*runno ตรวจสุขภาพ*/////////
	$Aquery = "select * from  out_result_chkup  order by row_id asc";
	$rw = mysql_query($Aquery);
	while($fet = mysql_fetch_array($rw)){
		
		?>
		<tr><td><a href="report_dxpolice.php?id=<?=$fet["row_id"]?>" target="_blank"><?=$fet['hn']?></a></td><td><?=$fet['ptname']?></td></tr>
		<?
	}
	echo "</table>";
}
?>
