<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
.style1 {font-weight: bold}
-->
</style>
<div id="non-printable">
<form id="form1" name="form1" method="post" action="comservicereport.php">
<input name="act" type="hidden" value="show" />
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td height="39" align="center"><strong>รายงานการปฏิบัติงานของลูกจ้างชั่วคราว ปฏิบัติงานห้องโปรแกรมเมอร์</strong></td>
    </tr>
    <tr>
      <td align="center">&nbsp;</td>
    </tr>
    <tr>
      <td align="center">ชื่อ - นามสกุล :
        <select name="user" class="txt1" id="user">
          <?
        $result=mysql_query("select distinct(user) as user from comservice");
		while(list($user)=mysql_fetch_array($result)){
		?>
          <option value="<?=$user;?>">
            <?=$user;?>
            </option>
          <?
		  }
		  ?>
        </select> 
        ประจำเดือน :      
		<?
        $thaimonthFull=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม", "พฤศจิกายน","ธันวาคม");
        echo "<select name='selmon' size='1'  class='txt1'>";
        for($i=0;$i<count($thaimonthFull);$i++){
        	echo "<option value='".($i+1)."' ";
			if(date("m")==$i+1){
				echo " selected";
			}
        	echo ">".$thaimonthFull[$i]."</option>";
        }
        echo "</select>";
        ?>
        ปี 
		<? 
			$y=date("Y")+543;
			$date=date("Y")+543+5;
			$dates=range(2547,$date);
			echo "<select name='selyear' size='1' class='txt1'>";
			foreach($dates as $i){
		?>
        	<option value="<?=$i;?>" <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
		<?
			}
			echo "</select>";
		?>
        <span style="margin-left: 35px;">
		 <input type="submit" value="ดูรายงาน" name="B1"  class="txt1" />
		</span></td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; กลับเมนูหลัก &gt;&gt;</a></td>
    </tr>
  </table>
</form>
</div> 
<?
if($_POST["act"]=="show"){
$selmon=$_POST["selmon"];
	if($selmon=="01"){
		$mon ="มกราคม";
		$selmon="01";
	}else if($selmon=="02"){
		$mon ="กุมภาพันธ์";
		$selmon="02";
	}else if($selmon=="03"){
		$mon ="มีนาคม";
		$selmon="03";
	}else if($selmon=="04"){
		$mon ="เมษายน";
		$selmon="04";
	}else if($selmon=="05"){
		$mon ="พฤษภาคม";
		$selmon="05";
	}else if($selmon=="06"){
		$mon ="มิถุนายน";
		$selmon="06";
	}else if($selmon=="07"){
		$mon ="กรกฎาคม";
		$selmon="07";
	}else if($selmon=="08"){
		$mon ="สิงหาคม";
		$selmon="08";
	}else if($selmon=="09"){
		$mon ="กันยายน";
		$selmon="09";
	}else if($selmon=="10"){
		$mon ="ตุลาคม";
		$selmon="10";
	}else if($selmon=="11"){
		$mon ="พฤศจิกายน";
		$selmon="11";
	}else if($selmon=="12"){
		$mon ="ธันวาคม";
		$selmon="12";
	}
$thyear=$_POST["selyear"];
$ksyear=$_POST["selyear"]-543;

$sql="select * from comservice where user='$_POST[user]' and datework like '$ksyear-$selmon%' order by datework asc, timework asc";
$query=mysql_query($sql); 
$num=mysql_num_rows($query);  
?>
<table width="80%" border="0" align="center">
  <tr>
    <td align="center"><span class="style1"><strong>รายงานการปฏิบัติงานของลูกจ้างชั่วคราว ปฏิบัติงานห้องโปรแกรมเมอร์ </strong></span></td>
  </tr>
  <tr>
    <td align="center"><strong>ชื่อผู้ปฏิบัติงาน : </strong><?=$_POST["user"];?>  <strong>ประจำเดือน</strong> : <?=$mon." ".$thyear;?>      <strong><a target="_self"  href='../nindex.htm'></a></strong></td>
  </tr>
</table>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" rowspan="2" align="center" class="style4"><strong>ลำดับที่ </strong></td>
    <td height="25" colspan="2" align="center" class="style4"><strong>วันที่ปฏิบัติงาน</strong></td>
    <td width="14%" rowspan="2" align="center" class="style4"><strong>แผนกที่ร้องขอ</strong></td>
    <td width="14%" rowspan="2" align="center" class="style4"><strong>ผู้ที่ร้องขอ</strong></td>
    <td width="15%" rowspan="2" align="center" class="style4"><strong>สถานที่ปฏิบัติงาน</strong></td>
    <td width="51%" rowspan="2" align="center" class="style4"><strong>รายละเอียดงาน</strong></td>
  </tr>
  <tr>
    <td width="9%" height="25" align="center" class="style4"><strong>วัน/เดือน/ปี</strong></td>
    <td width="6%" align="center" class="style4"><strong>เวลา</strong></td>
  </tr>
  <?
if(empty($num)){
echo "
	<tr>
		<td colspan='7' align='center' bgcolor='#EBF2D3' class='style3'><--------------- ไม่มีข้อมูลในระบบ ---------------></td>
	</tr>
";
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	$ited_request1=$rows["datework"];
	list($y,$m,$d)=explode("-",$ited_request1);
	$y=$y+543;
	$newdate="$d/$m/$y";	
?>
  <tr>
    <td height="23" align="center" bgcolor="#FFFFFF"><?=$i;?></td>
    <td align="center" bgcolor="#FFFFFF"><?=$newdate;?></td>
    <td align="center" bgcolor="#FFFFFF"><?=$rows["timework"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["depart"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["personal"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["location"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["detail"];?></td>
  </tr>
  <?
	}
}
?>
</table>
<div style="margin-right: 200px;">
<p>&nbsp;</p>
<p style="margin-left: 550px;"><strong>เรียน &nbsp;หัวหน้าศูนย์บริการคอมพิวเตอร์</strong></p>
<p style="margin-left: 585px;">- ขอส่งรายงานการปฏิบัติงานห้องโปรแกรมเมอร์<br>ประจำเดือน<?=$mon." ".$thyear;?> </p>
<p style="margin-left: 585px;">ลงชื่อ</p>
<div align="center" style="margin-left: 615px; width: 200px;">(<?=$_POST["user"];?>)</div>
<div align="center" style="margin-left: 615px; width: 200px;">ผู้ปฏิบัติงาน</div>
<div align="center" style="margin-left: 615px; width: 200px;">........../........../............</div>

<p>&nbsp;</p>

<p style="margin-left: 550px;"><strong>เรียน &nbsp;ผอ.รพ.ค่ายฯ</strong></p>
<div style="margin-left: 585px;">............................................................................</div>
<div style="margin-left: 585px;">............................................................................</div>
<br />
<div align="left" style="margin-left: 615px; width: 200px;">พ.ต.</div>
<div align="center" style="margin-left: 615px; width: 200px;">(สมเพชร &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แสงศรีจันทร์)</div>
<div align="center" style="margin-left: 615px; width: 200px;">หัวหน้าศูนย์บริการคอมพิวเตอร์</div>
<div align="center" style="margin-left: 615px; width: 200px;">........../........../............</div>

<p>&nbsp;</p>

<div style="margin-left: 585px;">............................................................................</div>
<div style="margin-left: 585px;">............................................................................</div>
<br />
<div align="left" style="margin-left: 615px; width: 200px;">พ.อ.</div>
<div align="center" style="margin-left: 615px; width: 200px;">(ณัฐนนท์ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ภุคุกะ)</div>
<div align="center" style="margin-left: 615px; width: 200px;">ผอ.รพ.ค่ายสุรศักดิ์มนตรี</div>
<div align="center" style="margin-left: 615px; width: 200px;">........../........../............</div>
</div>
<?
}
?>
