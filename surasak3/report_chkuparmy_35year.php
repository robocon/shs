<?
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>รายงานผลการตรวจสุขภาพกำลังพลทหารที่มีอายุมากกว่า 35 ปี ย้อนหลัง 3 ปี</strong></p>
<div align="center">
<table width="90%" border="1" align="center" cellpadding="6" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="2%" rowspan="2" align="center"><strong>ลำดับ</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>HN</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>สังกัด/หน่วย</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>อายุ</strong></td>
    <td width="3%" rowspan="2" align="center"><strong>ประวัติโรคประจำตัว</strong></td>
    <td colspan="3" align="center"><strong>รอบเอว</strong></td>
    <td colspan="3" align="center"><strong>BMI</strong></td>
    <td colspan="3" align="center"><strong>ความดันโลหิต</strong></td>
    <td colspan="3" align="center" bgcolor="#33CCCC"><strong>น้ำตาล (BS)</strong></td>
    <td colspan="3" align="center" bgcolor="#CCFFCC"><strong>ไขมันในเลือด (CHOL)</strong></td>
    <td colspan="3" align="center" bgcolor="#33CCCC"><strong>ไขมันในเลือด (TRIG)</strong></td>
    <td colspan="3" align="center" bgcolor="#CCFFCC"><strong>BUN(การทำงานของไต)</strong></td>
    <td colspan="3" align="center" bgcolor="#33CCCC"><strong>CREA(การทำงานของไต)</strong></td>
    <td colspan="3" align="center" bgcolor="#CCFFCC"><strong>URIC(โรคเก๊าท์)</strong></td>
    <td colspan="3" align="center" bgcolor="#33CCCC"><strong>ALP(ตับ,กระดูก)</strong></td>
    <td colspan="3" align="center" bgcolor="#CCFFCC"><strong>ALT(การทำงานของตับ)</strong></td>
    <td colspan="3" align="center" bgcolor="#33CCCC"><strong>AST(การทำงานของตับ)</strong></td>
    </tr>
  <tr>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2563</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2562</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2561</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2563</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2562</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2561</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2563</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2562</strong></td>
    <td align="center" bgcolor="#FFFFFF"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2562</strong></td>
    <td width="3%" align="center" bgcolor="#33CCCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2562</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2562</strong></td>
    <td width="5%" align="center" bgcolor="#33CCCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2562</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2562</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2562</strong></td>
    <td width="5%" align="center" bgcolor="#CCFFCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2562</strong></td>
    <td width="5%" align="center" bgcolor="#33CCCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2562</strong></td>
    <td width="2%" align="center" bgcolor="#CCFFCC"><strong>ปี 2561</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2563</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2562</strong></td>
    <td width="2%" align="center" bgcolor="#33CCCC"><strong>ปี 2561</strong></td>
  </tr>
<?
$sql="select * from condxofyear_so where yearcheck='2563' group by hn order by camp, age, row_id desc";
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;


$sql1="select * from condxofyear_so where hn='".$rows["hn"]."' and yearcheck='2561' group by hn order by row_id desc";
$query1=mysql_query($sql1) or die("SQL ERROR");
$rows1=mysql_fetch_array($query1);


$sql2="select * from condxofyear_so where hn='".$rows["hn"]."' and yearcheck='2562' group by hn order by row_id desc";
//echo $sql2."<br>";
$query2=mysql_query($sql2) or die("SQL ERROR");
$rows2=mysql_fetch_array($query2);






if($rows["prawat"]=="0"){ $prawat="ไม่มีโรคประจำตัว";}else if($rows["prawat"]=="1"){ $prawat="ความดันโลหิตสูง";}else if($rows["prawat"]=="2"){ $prawat="เบาหวาน";}else if($rows["prawat"]=="3"){ $prawat="โรคหัวใจและหลอดเลือด";}else if($rows["prawat"]=="4"){ $prawat="ไขมันในเลือดสูง";}else if($rows["prawat"]=="5"){ $prawat="โรคที่กำหนดไว้ตั้งแต่ 2 โรคขึ้นไป";}else if($rows["prawat"]=="6"){ $prawat="โรคประจำตัวอื่นๆ";}else if($rows["prawat"]=="7"){ $prawat="โรคเก๊าท์";}else if($rows["prawat"]=="8"){ $prawat="โรคถุงลมโป่งพอง";}

if(substr($rows["age"],0,2) >=35){
$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='GLU'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="GLU"){
	$bs63=$result63["result"];
	$flagbs63=$result63["flag"];
}else{
	$bs63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='CHOL'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="CHOL"){
	$chol63=$result63["result"];
	$flagchol63=$result63["flag"];
}else{
	$chol63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='TRIG'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="TRIG"){
	$trig63=$result63["result"];
	$flagtrig63=$result63["flag"];
}else{
	$trig63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='BUN'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="BUN"){
	$bun63=$result63["result"];
	$flagbun63=$result63["flag"];
}else{
	$bun63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='CREA'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="CREA"){
	$crea63=$result63["result"];
	$flagcrea63=$result63["flag"];
}else{
	$crea63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='URIC'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="URIC"){
	$uric63=$result63["result"];
	$flaguric63=$result63["flag"];
}else{
	$uric63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='ALP'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="ALP"){
	$alp63=$result63["result"];
	$flagalp63=$result63["flag"];
}else{
	$alp63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='ALT'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="ALT"){
	$alt63=$result63["result"];
	$flagalt63=$result63["flag"];
}else{
	$alt63="";
}

$sql63="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี63' and b.labcode='AST'";
//echo $sql63."<br>";
$query63=mysql_query($sql63);
$result63=mysql_fetch_array($query63);
if($result63["labcode"]=="AST"){
	$ast63=$result63["result"];
	$flagast63=$result63["flag"];
}else{
	$ast63="";
}



$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='GLU'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="GLU"){
	$bs62=$result62["result"];
	$flagbs62=$result62["flag"];
}else{
	$bs62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='CHOL'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="CHOL"){
	$chol62=$result62["result"];
	$flagchol62=$result62["flag"];
}else{
	$chol62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='TRIG'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="TRIG"){
	$trig62=$result62["result"];
	$flagtrig62=$result62["flag"];
}else{
	$trig62="";
}


$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='BUN'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="BUN"){
	$bun62=$result62["result"];
	$flagbun62=$result62["flag"];
}else{
	$bun62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='CREA'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="CREA"){
	$crea62=$result62["result"];
	$flagcrea62=$result62["flag"];
}else{
	$crea62="";
}


$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='URIC'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="URIC"){
	$uric62=$result62["result"];
	$flaguric62=$result62["flag"];
}else{
	$uric62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='ALP'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="ALP"){
	$alp62=$result62["result"];
	$flagalp62=$result62["flag"];
}else{
	$alp62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='ALT'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="ALT"){
	$alt62=$result62["result"];
	$flagalt62=$result62["flag"];
}else{
	$alt62="";
}

$sql62="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี62' and b.labcode='AST'";
//echo $sql62."<br>";
$query62=mysql_query($sql62);
$result62=mysql_fetch_array($query62);
if($result62["labcode"]=="AST"){
	$ast62=$result62["result"];
	$flagast62=$result62["flag"];
}else{
	$ast62="";
}


$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='GLU'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="GLU"){
	$bs61=$result61["result"];
	$flagbs61=$result61["flag"];
}else{
	$bs61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='CHOL'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="CHOL"){
	$chol61=$result61["result"];
	$flagchol61=$result61["flag"];
}else{
	$chol61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='TRIG'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="TRIG"){
	$trig61=$result61["result"];
	$flagtrig61=$result61["flag"];
}else{
	$trig61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='BUN'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="BUN"){
	$bun61=$result61["result"];
	$flagbun61=$result61["flag"];
}else{
	$bun61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='CREA'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="CREA"){
	$crea61=$result61["result"];
	$flagcrea61=$result61["flag"];
}else{
	$crea61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='URIC'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="URIC"){
	$uric61=$result61["result"];
	$flaguric61=$result61["flag"];
}else{
	$uric61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='ALP'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="ALP"){
	$alp61=$result61["result"];
	$flagalp61=$result61["flag"];
}else{
	$alp61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='ALT'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="ALT"){
	$alt61=$result61["result"];
	$flagalt61=$result61["flag"];
}else{
	$alt61="";
}

$sql61="select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$rows["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61' and b.labcode='AST'";
//echo $sql61."<br>";
$query61=mysql_query($sql61);
$result61=mysql_fetch_array($query61);
if($result61["labcode"]=="AST"){
	$ast61=$result61["result"];
	$flagast61=$result61["flag"];
}else{
	$ast61="";
}
}else{
	$bs63="";
	$bs62="";
	$bs61="";
	$chol63="";
	$chol62="";
	$chol61="";
	$trig63="";
	$trig62="";
	$trig61="";
	$bun63="";
	$bun62="";
	$bun61="";	
	$crea63="";
	$crea62="";
	$crea61="";	
	$uric63="";
	$uric62="";
	$uric61="";
	$alp63="";
	$alp62="";
	$alp61="";	
	$alt63="";
	$alt62="";
	$alt61="";
	$ast63="";
	$ast62="";
	$ast61="";		
}

if(!empty($rows["bp1"]) && !empty($rows["bp2"])){
	$bp63=$rows["bp1"]."/".$rows["bp2"];
}else{
	$bp63="";
}

if(!empty($rows2["bp1"]) && !empty($rows2["bp2"])){
	$bp62=$rows2["bp1"]."/".$rows2["bp2"];
}else{
	$bp62="";
}

if(!empty($rows1["bp1"]) && !empty($rows1["bp2"])){
	$bp61=$rows1["bp1"]."/".$rows1["bp2"];
}else{
	$bp61="";
}

?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["camp"];?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$prawat;?></td>
    <td align="center"><?=$rows["round_"];?></td>
    <td align="center"><?=$rows2["round_"];?></td>
    <td align="center"><?=$rows1["round_"];?></td>
    <td align="center"><?=$rows["bmi"];?></td>
    <td align="center"><?=$rows2["bmi"];?></td>
    <td align="center"><?=$rows1["bmi"];?></td>
    <td align="center"><?=$bp63;?></td>
    <td align="center"><?=$bp62;?></td>
    <td align="center"><?=$bp61;?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagbs63=="N"){ echo $bs63;}else{ echo "<strong style='color:red'>$bs63</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagbs62=="N"){ echo $bs62;}else{ echo "<strong style='color:red'>$bs62</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagbs61=="N"){ echo $bs61;}else{ echo "<strong style='color:red'>$bs61</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagchol63=="N"){ echo $chol63;}else{ echo "<strong style='color:red'>$chol63</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagchol62=="N"){ echo $chol62;}else{ echo "<strong style='color:red'>$chol62</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagchol61=="N"){ echo $chol61;}else{ echo "<strong style='color:red'>$chol61</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagtrig63=="N"){ echo $trig63;}else{ echo "<strong style='color:red'>$trig63</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagtrig62=="N"){ echo $trig62;}else{ echo "<strong style='color:red'>$trig62</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagtrig61=="N"){ echo $trig61;}else{ echo "<strong style='color:red'>$trig61</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagbun63=="N"){ echo $bun63;}else{ echo "<strong style='color:red'>$bun63</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagbun62=="N"){ echo $bun62;}else{ echo "<strong style='color:red'>$bun62</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagbun61=="N"){ echo $bun61;}else{ echo "<strong style='color:red'>$bun61</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagcrea63=="N"){ echo $crea63;}else{ echo "<strong style='color:red'>$crea63</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagcrea62=="N"){ echo $crea62;}else{ echo "<strong style='color:red'>$crea62</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagcrea61=="N"){ echo $crea61;}else{ echo "<strong style='color:red'>$crea61</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flaguric63=="N"){ echo $uric63;}else{ echo "<strong style='color:red'>$uric63</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flaguric62=="N"){ echo $uric62;}else{ echo "<strong style='color:red'>$uric62</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flaguric61=="N"){ echo $uric61;}else{ echo "<strong style='color:red'>$uric61</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagalp63=="N"){ echo $alp63;}else{ echo "<strong style='color:red'>$alp63</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagalp62=="N"){ echo $alp62;}else{ echo "<strong style='color:red'>$alp62</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagalp61=="N"){ echo $alp61;}else{ echo "<strong style='color:red'>$alp61</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagalt63=="N"){ echo $alt63;}else{ echo "<strong style='color:red'>$alt63</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagalt62=="N"){ echo $alt62;}else{ echo "<strong style='color:red'>$alt62</strong>";}?></td>
    <td align="center" bgcolor="#CCFFCC"><? if($flagalt61=="N"){ echo $alt61;}else{ echo "<strong style='color:red'>$alt61</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagast63=="N"){ echo $ast63;}else{ echo "<strong style='color:red'>$ast63</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagast62=="N"){ echo $ast62;}else{ echo "<strong style='color:red'>$ast62</strong>";}?></td>
    <td align="center" bgcolor="#33CCCC"><? if($flagast61=="N"){ echo $ast61;}else{ echo "<strong style='color:red'>$ast61</strong>";}?></td>
  </tr>
  <?
  }
  ?>
</table>

</div>
