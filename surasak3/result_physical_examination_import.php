<style type="text/css">

body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtsarabun{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
</style>
<? 
include("connect.inc");
////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
	$nPrefix2="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a>
<p align="center" style="font-weight:bold;">นำเข้าผลตรวจร่างกาย</p>
<form name="form1" method="post" action="result_physical_examination_import.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">ปีงบประมาณ&nbsp;&nbsp;
    <? 
			   $Y=date("Y")+543;
			   $Y=$Y;
			   $date=date("Y")+543;
			  
				$dates=range(2560,$date+1);
				echo "<select name='year1'  class='txtsarabun'>";
				foreach($dates as $i){

				?>
    <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>>
      <?=$i;?>
    </option>
    <?
				}
				echo "<select>";
				?>
	&nbsp;&nbsp;หน่วย :
        <label>      
        <select name="camp" id="camp" class="txtsarabun">
          <option value="all" selected>ทุกหน่วย</option>
		 <?
		 
		 $sql="select distinct(camp) as camp from condxofyear_so where `yearcheck` = '$nPrefix2'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=$rows["camp"];
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <span style="margin-left:5px;"><input type="submit" name="button" id="button" class="txtsarabun" value="ดูรายงาน"></span>
        </label></td>
    </tr>
  </table>
</form>
<?php

if($_POST["act"]=="show"){
$nPrefix=$_POST["year1"];
//12088 ยอด 1041  ราย
	if($_POST["camp"]=="all"){
		$sql1="SELECT * FROM `condxofyear_so` WHERE `yearcheck` = '$nPrefix' and (row_id >= '12106' and row_id <='12112')
		GROUP BY hn 
		ORDER BY row_id ASC, substring(age,1,2) DESC";
	}else{
		$sql1="SELECT * FROM `condxofyear_so` WHERE `yearcheck` = '$nPrefix' and (row_id >= '12106' and row_id <='12112')
		AND `camp`='$_POST[camp]' 
		GROUP BY hn 
		ORDER BY row_id ASC";		
	}	
	$query1=mysql_query($sql1)or die ("Query condxofyear_so Error");
	$num=mysql_num_rows($query1);
$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);
	
?>

<div align="center"><strong>รายงานข้อมูลการตรวจร่างกายของกำลังพลกองทัพบก(รายบุคคล) ประจำปี</strong> <?=$nPrefix;?></div>
<div align="center"><strong>หน่วยสายแพทย์ที่ทำการตรวจ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="center"><strong>หน่วยทหารที่มารับการตรวจ</strong>
  <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo substr($_POST["camp"],4);}?>
</div>
<div align="center"><strong>จำนวน</strong> <?=$num;?> <strong>นาย</strong></div>
<br />
<div align="center">
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;" class="pdxpro">
  <tr>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>วันที่ตรวจ</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>เดือนที่ตรวจ</strong></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>ปีที่ตรวจ</strong></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><strong>เลขบัตรประชาชน</strong></td>
	<td width="3%"  align="center"  bgcolor="#FFFFFF"><strong>เลข VN</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>bpd</strong></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>bpd</strong></td>
	<td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>BMI</strong></td>
	<td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>lab_ecode</strong></td>
	<td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>lab_result</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>วันที่รายงาน</strong></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><strong>เดือนที่รายงาน</strong></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><strong>ปีที่รายงาน</strong></td>	
  </tr>
  <?php
	while($arr1=mysql_fetch_array($query1)){  
	

	$opsql="select hn,yot,name,surname,idcard,sex, DAY(dbirth) as bday,MONTH(dbirth) as bmonth,(YEAR(dbirth)) as byear from opcard where hn='$arr1[hn]'";
	//echo $opsql."<br>";
	$opquery=mysql_query($opsql);
	list($hn,$yot,$name,$surname,$idcard,$gender,$bday,$bmonth,$byear)=mysql_fetch_row($opquery);	
	
	
	$servicedate=substr($arr1["thdatehn"],0,10);
	list($yy,$mm,$dd)=explode("-",$servicedate);
	$vday=$dd;
	$vmonth=$mm;
	$vyear=$yy+543;
	
	$vn=$arr1["vn"];
	$bmi=$arr1["bmi"];
	
	
	$reportdate=substr($arr1["thdatehn"],0,10);
	list($yy1,$mm1,$dd1)=explode("-",$reportdate);
	$reportday=$dd1;
	$reportmonth=$mm1;
	$reportyear=$yy1+543;	
	
	
	$bps=$arr1['bp1'];
	$bpd=$arr1['bp2'];

	//ดึงข้อมูลจาก  LAB
	$sql2 = "select * from resulthead 
	inner join resultdetail on resulthead.autonumber=resultdetail.autonumber 
	WHERE resulthead.hn ='".$arr1["hn"]."' AND clinicalinfo='ตรวจสุขภาพประจำปี66'
	AND (labcode='WBC' || labcode='PLTC' || labcode='HCT' || labcode='PROU' || labcode='RBCU' || labcode='WBCU' || labcode='GLUU' || testgroupcode='CHEM'
	&& labcode !='GFR' && labcode !='STAGE') 
	ORDER BY resulthead.testgroupname ASC , resultdetail.seq ASC";
	//echo $sql2."<br>";	
	$query2=mysql_query($sql2);
	$num2=mysql_num_rows($query2);
	if($num2 > 0){
		while($result=mysql_fetch_array($query2)){
	
		$lab_ecode=$result["labcode"];
		$lab_result=$result["result"];
		
		if($lab_ecode=="WBC"){
			$lab_result=$lab_result*1000;	
		}	
		if($lab_ecode=="PLTC"){
			$lab_result=$lab_result*1000;	
		}		
		
  ?>
  <tr>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$vday;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$vmonth;?></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$vyear;?></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$idcard;?></td>
	<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$vn;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$bps;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$bpd;?></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$bmi;?></td>
    <td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$lab_ecode;?></td>
	<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$lab_result;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$reportday;?></td>
    <td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$reportmonth;?></td>
    <td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$reportyear;?></td>	
  </tr>  
  <?php
		}
	}else{

		
		if($arr1["age"] < 35){
			$labcode[1]    =    'WBC';
			$labcode[2]    =    'HCT';
			$labcode[3]    =    'PLTC';
			$labcode[4]    =    'PROU';
			$labcode[5]    =    'GLUU';
			$labcode[6]    =    'WBCU';
			$labcode[7]    =    'RBCU';
			
			for($i=1;$i<=7;$i++){
				//echo $labcode[$i].'<br/>';
				$vn=substr($arr1["row_id"],2);
			}	
		}else{
			
			$labcode[1]    =    'WBC';
			$labcode[2]    =    'HCT';
			$labcode[3]    =    'PLTC';
			$labcode[4]    =    'PROU';
			$labcode[5]    =    'GLUU';
			$labcode[6]    =    'WBCU';
			$labcode[7]    =    'RBCU';
			$labcode[8]    =    'GLU';
			$labcode[9]    =    'CHOL';
			$labcode[10]    =    'TRIG';
			$labcode[11]    =    'BUN';
			$labcode[12]    =    'CREA';
			$labcode[13]    =    'URIC';
			$labcode[14]    =    'AST';
			$labcode[15]    =    'ALP';
			$labcode[16]    =    'ALT';
				
			for($i=1;$i< 17;$i++){
				
				//echo $labcode[$i].'<br/>';
				$vn=substr($arr1["row_id"],2);
				if($labcode[$i]=="WBC"){
					$lab_result[$i]=$arr1["cbc_wbc"];	
				}
				
				if($labcode[$i]=="HCT"){
					$lab_result[$i]=$arr1["cbc_hct"];	
				}
				
				if($labcode[$i]=="PLTC"){
					$lab_result[$i]=$arr1["cbc_pltc"];	
				}

				if($labcode[$i]=="PROU"){
					$lab_result[$i]=$arr1["ua_prou"];	
				}
				
				if($labcode[$i]=="GLUU"){
					$lab_result[$i]=$arr1["ua_gluu"];	
				}
				
				if($labcode[$i]=="WBCU"){
					$lab_result[$i]=$arr1["ua_wbcu"];	
				}
				
				if($labcode[$i]=="RBCU"){
					$lab_result[$i]=$arr1["ua_rbcu"];	
				}
				
				if($labcode[$i]=="GLU"){
					$lab_result[$i]=$arr1["bs"];	
				}
				
				if($labcode[$i]=="CHOL"){
					$lab_result[$i]=$arr1["chol"];	
				}				
				
				if($labcode[$i]=="TRIG"){
					$lab_result[$i]=$arr1["tg"];	
				}
				
				if($labcode[$i]=="BUN"){
					$lab_result[$i]=$arr1["bun"];	
				}
				
				if($labcode[$i]=="CREA"){
					$lab_result[$i]=$arr1["cr"];	
				}
				
				if($labcode[$i]=="URIC"){
					$lab_result[$i]=$arr1["uric"];	
				}
				
				if($labcode[$i]=="AST"){
					$lab_result[$i]=$arr1["sgot"];	
				}
				
				if($labcode[$i]=="ALP"){
					$lab_result[$i]=$arr1["alk"];	
				}
				
				if($labcode[$i]=="ALT"){
					$lab_result[$i]=$arr1["sgpt"];	
				}				
			?>
			  <tr>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$vday;?></td>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$vmonth;?></td>
				<td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$vyear;?></td>
				<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$idcard;?></td>
				<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$vn;?></td>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$bps;?></td>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$bpd;?></td>
				<td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$bmi;?></td>
				<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$labcode[$i];?></td>
				<td width="3%"  align="center"  bgcolor="#FFFFFF"><?=$lab_result[$i];?></td>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$reportday;?></td>
				<td width="1%"  align="center"  bgcolor="#FFFFFF"><?=$reportmonth;?></td>
				<td width="2%"  align="center"  bgcolor="#FFFFFF"><?=$reportyear;?></td>	
			  </tr> 
			<?			
			}	
		}		
	}	//close if num check lab
	
	}
	?>
</table>	
</div>


<?php	
}	
?>	