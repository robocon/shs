
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
-->
</style>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<form action="stat_opcard.php" method="post" name="statopcard">
<table>
<tr><td width="256" align="center" class="font1"><strong>สถิติผู้ป่วยใหม่</strong></td>
</tr>
<tr>
  <td align="center" class="font1"> 
  เดือน 
    <select name="m">
      <?
	$month = array('0','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	for($a=1;$a<13;$a++){
		if($a<10) $ss = "0";
		else $ss='';
	?>
      <option value="<?=$ss?><?=$a?>" <? if($m==$a) echo "selected='selected'"?>>
        <?=$month[$a]?>
        </option>
      <?
	}
	?>
    </select>
    พ.ศ.
    <select name="yr">
      <?
	$year = date("Y")+543;
	for($a=($year-5);$a<($year+5);$a++){
	?>
      <option value="<?=$ss?><?=$a?>" <? if($year==$a) echo "selected='selected'"?>>
        <?=$a?>
        </option>
      <?
	}
	?>
    </select>
    </td>
</tr>
<tr>
  <td align="center" ><input name="search" type="submit" value="  ตกลง  " class="font1"/></td>
</tr> 
</table>
</form>


<?
include("connect.inc");

if(isset($_POST['search'])){
		?>
<table width="673" border="0">
			  <tr>
			    <td width="334" valign="top">
                <?
            if(isset($_POST['m'])&isset($_POST['yr'])){ 
			$query = "CREATE TEMPORARY TABLE date01 SELECT * FROM opcard WHERE regisdate like '".($_POST['yr']-543)."-".$_POST['m']."-%' ";
		
			$result = mysql_query($query);
			$yr1 = $_POST['yr']-543;
			$m1 = $_POST['m'];
			?>
			<table width="323" border="1" cellpadding="0" cellspacing="0" >
				<tr>
				<td colspan="4" align="center"><span class="font1">เดือน 
			    <?=$month[($_POST['m']+0)]?> ปี <?=$_POST['yr']?>
				</span></td>
				</tr>
				<tr>
				<td width="34" align="center"><span class="font1">วันที่</span></td>
				<td width="113" align="center"><span class="font1">จำนวนผู้ป่วยใหม่</span></td>
                <td width="73" align="center"><span class="font1">ที่รับบริการ</span></td>
                <td width="93" align="center"><span class="font1">ที่ไม่รับบริการ</span></td>
				</tr>

			<?
			$arrm = array('0','31','29','31','30','31','30','31','31','30','31','30','31');
			$m2 = $m1+0;
			for($i=1;$i<=$arrm[$m2];$i++){
				if($i<10) $a = "0".$i;
				else $a = $i;
				$query = "select count(*) as numday from date01 where regisdate like '".$yr1."-".$m1."-".$a."%'";
				$row = mysql_query($query);
				?>
				<tr>
				<?
				$result = mysql_fetch_array($row);
				echo "<td align='center' class='font1'>".$a."</td>";
				echo "<td align='center' class='font1'>".$result['numday']."</td>";
				$service1=0;
				$service2=0;
				$query1 = "select hn,name from date01 where regisdate like '".$yr1."-".$m1."-".$a."%'";
				$row1= mysql_query($query1);
				while($result1 = mysql_fetch_array($row1)){
					$query2 = "select * from opday where thidate like '".$_POST['yr']."-".$m1."-".$a."%' and hn='".$result1['hn']."' and doctor is null";
					$row2 = mysql_query($query2);
					$num = mysql_num_rows($row2);
					if($num=="1"){
						$service2++;
					}
					elseif($num=="0"){
						$service1++;
					}
				}
				echo "<td align='center' class='font1'>".$service1."</td>";
				echo "<td align='center' class='font1'>".$service2."</td></tr>";
			}?>
			</table>
                </td>
			    <td width="329" valign="top">
                <?
                $query = "select count(*) as nummonth from date01 ";
				$row = mysql_query($query);
				$result = mysql_fetch_array($row);
				?>
                <table width="295" border="1" cellpadding="0" cellspacing="0">
			      <tr class="font1">
			        <td width="197">ผู้ป่วยใหม่ทั้งหมด<br />
			          เดือน

		            <?=$month[($_POST['m']+0)]?> ปี <?=$_POST['yr']?></td>
			        <td width="56" align="center"><?=$result['nummonth']?></td>
			        <td width="34" align="center">คน</td>
		          </tr>
		        </table>
                <br />
                <?
                $query = "select count(*) as numyear from opcard where regisdate like '".$yr1."-%' ";
				$row = mysql_query($query);
				$result = mysql_fetch_array($row);
				?>
                <table width="295" border="1" cellpadding="0" cellspacing="0">
			      <tr class="font1">
			        <td width="197">ผู้ป่วยใหม่ทั้งหมด<br />
		            ปี		              <?=$_POST['yr']?></td>
			        <td width="56" align="center"><?=$result['numyear']?></td>
			        <td width="34" align="center">คน</td>
		          </tr>
		        </table></td>
              </tr>
</table>
            <?
		}
}
?>

</body>
</html>