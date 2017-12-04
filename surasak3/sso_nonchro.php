<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
-->
</style>
<div id="no_print">
<A HREF="../nindex.htm">&lt;&lt; ไปเมนู</A>
<form action="" method="post" name="form1">
  <table  border="0" align="center">
    <tr>
      <td colspan="2" align="center" bgcolor="#CCCCCC">รายงานโรคทั่วไป  ประกันสังคม</td>
    </tr>
    <tr>
      <td colspan="2" align="center">ผป.นอกยอดเงิน &gt; 500 บาท , ผป.ในยอดเงิน &gt; 5000 บาท</td>
    </tr>
    <tr>
      <td>เดือน/ปี</td>
      <td>
        <select name="mon" class="font1">
          <option value="01" <? if($_POST['mon']=='01'){ echo "selected"; }?>>มกราคม</option>
          <option value="02" <? if($_POST['mon']=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
          <option value="03" <? if($_POST['mon']=='03'){ echo "selected"; }?>>มีนาคม</option>
          <option value="04" <? if($_POST['mon']=='04'){ echo "selected"; }?>>เมษายน</option>
          <option value="05" <? if($_POST['mon']=='05'){ echo "selected"; }?>>พฤษภาคม</option>
          <option value="06" <? if($_POST['mon']=='06'){ echo "selected"; }?>>มิถุนายน</option>
          <option value="07" <? if($_POST['mon']=='07'){ echo "selected"; }?>>กรกฎาคม</option>
          <option value="08" <? if($_POST['mon']=='08'){ echo "selected"; }?>>สิงหาคม</option>
          <option value="09" <? if($_POST['mon']=='09'){ echo "selected"; }?>>กันยายน</option>
          <option value="10" <? if($_POST['mon']=='10'){ echo "selected"; }?>>ตุลาคม</option>
          <option value="11" <? if($_POST['mon']=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
          <option value="12" <? if($_POST['mon']=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
        <? 
			   
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='font1'>";
				foreach($dates as $i){
				?>
        <option value='<?=$i?>' <? if($_POST['y_start']==$i){ echo "selected"; }?>>
          <?=$i;?>
        </option>
        <?
				}
				echo "</select>";
				?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>ประเภท</td>
      <td><input type="radio" name="type" id="radio" value="OPD"  checked="checked"/>
        ผป.นอก
        <input type="radio" name="type" id="radio2" value="IPD" />
        <label for="radio2">ผป.ใน</label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><input type="submit" name="search" id="search" value="ตกลง" /></td>
    </tr>
  </table>
</form>
</div>
<?
	include("connect.inc");
	if(isset($_POST['search'])){
		$type=$_POST['type'];
		if($type=='OPD'){
			$where="and an IS NULL ";
			$sql = "select * from opday where icd10 NOT IN (
'E119', 'E149', 'I10', 'K746', 'K759', 'I500', 'I619', 'C349', 'C509', 'C539', 'C189', 'C220', 'C229', 'J449', 'N185', 'G20', 'G700', 'E232', 'G35', 'E232', 'G35', 'E785', 'M069', 'M059', 'H409', 'N049', 'M329', 'D619', 'D569', 'D66', 'L409', 'L309', 'L509', 'D693', 'E059', 'F419', 'F329'
) and thidate like '".$_POST['y_start']."-".$_POST['mon']."%' and ptright like 'R07%' $where";
		}else if($type=='IPD'){
			//$where="and an IS NOT NULL ";
			$sql = "select * from ipcard where icd10 NOT IN (
'E119', 'E149', 'I10', 'K746', 'K759', 'I500', 'I619', 'C349', 'C509', 'C539', 'C189', 'C220', 'C229', 'J449', 'N185', 'G20', 'G700', 'E232', 'G35', 'E232', 'G35', 'E785', 'M069', 'M059', 'H409', 'N049', 'M329', 'D619', 'D569', 'D66', 'L409', 'L309', 'L509', 'D693', 'E059', 'F419', 'F329'
) and dcdate like '".$_POST['y_start']."-".$_POST['mon']."%' and ptright like 'R07%' ";
		}
		
		$rows = mysql_query($sql);
		?>
		<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse" class="forntsarabun">
        <tr bgcolor="#FF99FF"><td width="8%" align="center">ลำดับ</td>
          <td width="18%" align="center">วันที่</td>
          <td width="18%" align="center">HN</td>
          <td width="39%" align="center">ชื่อ-สกุล</td><td width="10%" align="center">ICD10</td><td width="17%" align="center">จำนวนเงิน</td></tr>
		<?
	if($type=='OPD'){
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select sum(price) from depart where hn='".$result['hn']."' and date like '".substr($result['thidate'],0,10)."%' ";
			$rows2 = mysql_query($sql2);
			list($price1) = mysql_fetch_array($rows2);
			
			$sql3 = "select sum(price) from phardep where hn='".$result['hn']."' and date like '".substr($result['thidate'],0,10)."%' ";
			$rows3 = mysql_query($sql3);
			list($price2) = mysql_fetch_array($rows3);
			$sumpri = $price1+$price2;
			if($sumpri>=500){
				?>
				<tr><td align="center"><?=++$p;?></td><td><?=substr($result['thidate'],8,2)."-".substr($result['thidate'],5,2)."-".substr($result['thidate'],0,4)?></td>
				  <td><?=$result['hn']?></td>
			    <td><?=$result['ptname']?></td><td align="center"><?=$result['icd10']?></td><td align="right"><?=$sumpri?></td></tr>
				<?
			}
		}
	}else{
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select sum(price) from ipacc where an='".$result['an']."' ";
			$rows2 = mysql_query($sql2);
			list($price1) = mysql_fetch_array($rows2);
			
			if($price1>=5000){
				?>
				<tr><td align="center"><?=++$p;?></td><td><?=substr($result['dcdate'],8,2)."-".substr($result['dcdate'],5,2)."-".substr($result['dcdate'],0,4)?></td>
				  <td><?=$result['hn']?></td>
			    <td><?=$result['ptname']?></td><td align="center"><?=$result['icd10']?></td><td align="right"><?=$price1?></td></tr>
				<?
			}
		}
	}
		?>
		</table>
		<?
	}
?>


