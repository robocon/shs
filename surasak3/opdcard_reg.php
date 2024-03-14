<?
session_start();
include("connect.inc");
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

return $pAge;
}
?>
<script type="text/javascript">
window.onload= function () { window.print();window.close();   }
</script>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.style2 {
	font-size: 24px;
	font-weight: bold;
}
.style3 {
	font-size: 20px;
	font-weight: bold;
}
.style4 {
	font-size: 32px;
	font-weight: bold;
}
-->
</style>
<?
$hn = $_GET["cHn"];
$vn = $_GET["cVn"];
$thdatehn = $_GET["cTdatehn"];


$sql="select * from opcard where hn='$hn'";
$query=mysql_query($sql) or die ("Query fail on line 37");
$rows=mysql_fetch_array($query);


$yy=date("Y")+543;
$mm=date("m");
$dd=date("d");
$time=date('H:i:s');

$thaidate="$dd/$mm/$yy ".$time;

$strSQL="select * from opday where hn='$hn' and vn='$vn' and thdatehn='$thdatehn'";
//echo $strSQL;
$strQuery=mysql_query($strSQL) or die ("Query fail on line 50");
$strRows=mysql_fetch_array($strQuery);
$strlenvn=strlen($strRows["vn"]);
list($y,$m,$d)=explode("-",substr($strRows["thidate"],0,10));
$showdate="$d/$m/$y".substr($strRows["thidate"],10);
$newdate="$y$m$d";

$date="$y-$m-$d";


$doctor=$strRows["doctor"];
	$posdr = strpos($doctor,"(ว.");
	$posdrd = strpos($doctor,"(ท.");
	if($posdr==false){
		if($posdrd==false){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว.";
			$dr1="$dc$dr";
		}else{
			$dr = substr($doctor,($posdrd+3),4);
			$dc="ท.";
			$dr1="$dc$dr";
		}
	}else{
		$dr = substr($doctor,($posdr+3),5);
		$dc="ว.";
		$dr1="$dc$dr";
		if(strlen($dr)<4){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว.";
			$dr1="$dc$dr";
		}
	}
	

$newtoborow=substr($strRows["toborow"],2,2);
list($hn1,$hn2)=explode("-",$hn);
$hn2=sprintf('%05d',$hn2);
$newhn="$hn1$hn2";
$newvn=sprintf('%03d',$vn);
$runnoopd=$newdate.$newhn.$newvn.$newtoborow;



	$sql1 = "Select thidate,type,congenital_disease,temperature,pause,rate,weight,height,bp1,bp2,bp3,bp4,organ,hpi,painscore From opd where thdatehn = '".$thdatehn."' limit 1";
	//echo $sql1;
	$query1=mysql_query($sql1);
	list($thidateopd,$type,$congenital_disease,$temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$bp3,$bp4,$organ,$hpi,$painscore) = mysql_fetch_row($query1);
	
	$timevs=substr($thidateopd,11);
	
	if(empty($temperature)){
		$temperature="...............";
	}

	if(empty($pause)){
		$pause="...............";
	}

	if(empty($rate)){
		$rate="...............";
	}

	if(empty($weight)){
		$weight="...............";
	}

	if(empty($height)){
		$height="...............";
	}

	if(empty($bp1)){
		$bp1="...............";
	}

	if(empty($bp2)){
		$bp2="...............";
	}

	if(empty($cigarette)){
		$cigarette="...............";
	}else{
		if($cigarette=="0"){
			$cigarette="ไม่สูบ";
		}else if($cigarette=="1"){
			$cigarette="สูบ";
		}else if($cigarette=="0"){
			$cigarette="เคยสูบ";
		}
	}

	if(empty($alcohol)){
		$alcohol="...............";
	}else{
		if($alcohol=="0"){
			$alcohol="ไม่ดื่ม";
		}else if($alcohol=="1"){
			$alcohol="ดื่ม";
		}else if($alcohol=="0"){
			$alcohol="เคยดื่ม";
		}
	}	
	
	if(empty($painscore)){
		$painscore="...............";
	}	


	$sql2 = "Select detail,diag_thai From icd10 where code = '".$strRows["icd10"]."' ";
	//echo $sql2;
	$query2=mysql_query($sql2);
	list($detail,$diag_thai) = mysql_fetch_row($query2);	
?>
<div align="left">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
 <tr>
  <td width="6%" height="600" valign="top">&nbsp;</td>
  <td width="94%" height="600" valign="top">
  <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
	<td rowspan="2"><span align="left"><img src="images/Logo KSM.jpg" height="64" width="45"></span></td>
    <td height="28" colspan="3" align="center" class="style2"><strong>แบบบันทึกการตรวจรักษาผู้ป่วยนอก</strong></td>
    <td width="51%" rowspan="5" align="center" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">

      <tr>
        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" valign="top"><? print "<img src = \"barcode/opdcard.php?runnoopd=$runnoopd\" height=\"50\" width=\"300\">"; ?></td>
            </tr>
          
        </table>        </td>
        </tr>
      <tr>
        <td align="center" class="style3"><span class="style4">VN : <?=$strRows["vn"];?></span> วันที่ : <?=$showdate;?></td>
        </tr>
      <tr>
        <td align="left"><span class="style2">สิทธิ :  <?=$strRows["ptright"];?></span><span style="margin-left:20px;"><?=$strRows["toborow"];?></span></td>
      </tr>
    </table></td>
  </tr>
  <tr class="style2">
    <td height="28" colspan="3" align="center" class="style3"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="left" valign="top" class="style3"><strong>ชื่อ : </strong><?=$rows["yot"].$rows["name"]."  ".$rows["surname"];?></td>
    <td width="23%" align="left" valign="top"><strong>HN : </strong><?=$rows["hn"];?></td>
  </tr>
  <tr align="left" valign="top">
    <td width="14%"><strong>อายุ : </strong><?=$strRows["age"];?></td>
    <td width="12%"><strong>เพศ : </strong>
      <? if($rows["sex"]=="ช" || $rows["sex"]=="1"){ echo "ชาย";}else if($rows["sex"]=="ญ" || $rows["sex"]=="2"){ echo "หญิง";}else{ echo "ไม่ได้ระบุ";}?></td>
    <td><?=$rows["idcard"];?></td>
  </tr>
</table>
<table width="100%" height="85%" border="0" cellpadding="5" cellspacing="5" style="border-top:1px solid #000000;">
  <tr>
    <td width="45%" height="405" align="left" valign="top"><table width="100%" height="189" border="0" cellpadding="0" cellspacing="5">
      <tr>
        <td height="21" colspan="3"><strong>เวลา : </strong><?=$timevs;?><strong style="margin-left:20px;">ลักษณะผู้ป่วย : </strong></strong><?=$type;?></td>
        </tr>
      <tr>
        <td width="28%" height="21"><strong>น้ำหนัก : </strong> <?=$weight;?> กก.</td>
        <td width="30%"><strong>ส่วนสูง : </strong> <?=$height;?> ซม.</td>
        <td width="42%"><strong>BP : </strong><?=$bp1;?>/<?=$bp2;?> mmHg.</td>
      </tr>
      <tr>
        <td height="21"><strong>T : </strong><?=$temperature;?> c</td>
        <td><strong>P : </strong><?=$pause;?>/min</td>
        <td><strong>R : </strong><?=$rate;?>/min</td>
      </tr>
      <tr>
        <td height="21" colspan="3"><strong>บุหรี่ : </strong><?=$cigarette;?><strong style="margin-left:10px;">สุรา : </strong><?=$alcohol;?><strong style="margin-left:10px;">Pain Score : </strong><?=$painscore;?></td>
        </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>ประวัติการแพ้ยา : </strong>
		<span style="margin-left: 10px;">
		<?		
			$query12 = "SELECT tradname,advreact,asses FROM drugreact WHERE hn = '".$hn."' ";
			//echo $query12;
			$result12 = mysql_query($query12) or die("Query failed");
			$num12 = mysql_num_rows($result12);
			if($num12 < 1){
				echo "ไม่มีประวัติ";
				$drugreact="ไม่มีประวัติ";			
			}else{
				$drugreact="มีประวัติการแพ้ยา";
				while(list ($tradname,$advreact,$asses) = mysql_fetch_row ($result12)){
					echo "$tradname...$advreact(.$asses.) ";
				}			
				
			}
		?>		
		</span></td>
      </tr>      
	  <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>โรคประจำตัว : </strong><span style="margin-left:10px;"><?=$congenital_disease;?></span></td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>อาการนำ : </strong><span style="margin-left:10px;"><?=$organ;?></span></td>
      </tr>
      <tr>
        <td height="21" colspan="3" align="left" valign="top"><strong>PI : </strong><span style="margin-left:10px;"><?=$hpi;?></span></td>
      </tr>	  
    </table>
      <div style="margin-top:10px;" align="left">
	  	<hr>
		<div><strong>รายการสั่งยา : </strong></div>
		<span>
		<?		
			$query13 = "SELECT drugcode,tradname,amount,slcode FROM drugrx WHERE hn = '".$hn."' and date like '".$date."%' ";
			//echo $query13."<br>";
			$result13 = mysql_query($query13) or die("Query failed");
			$num13 = mysql_num_rows($result13);
			if($num13 < 1){
				echo "ไม่มียา";		
			}else{
				$i=0;
				while(list ($drugcode,$tradname,$amount,$slcode) = mysql_fetch_row ($result13)){
					$i++;
					echo "$i) $tradname...$amount ($slcode) <br>";
				}			
				
			}
		?>		
		</span>	  
	  </div>
    </td>
   <td width="55%" rowspan="2" align="left" valign="top" style="border-left:1px solid #000000;">
   <div><strong>สำหรับแพทย์ : </strong></div>
   <div style="margin-left:10px;">วินิจฉัยโรค : <?=$strRows["diag"];?></div>
   <div style="margin-left:10px;">รหัสการวินิจฉัย ICD10 : <?=$strRows["icd10"];?></div>
   <div style="margin-top:355px;"><strong>แพทย์ผู้ตรวจ : </strong><span style="margin-left:10px;"><?=$strRows["doctor"];?></span></div>
    <div><strong>เลขที่ใบประกอบวิชาชีพ : </strong><span style="margin-left:10px;"><?=$dr1;?></div>
    </td>
  </tr>
</table>
  </td>
 </tr>
 </table>
 </div>