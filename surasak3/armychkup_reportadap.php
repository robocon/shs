<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
include("connect.inc");
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
		$newPrefix="25".$nPrefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<p align="center"><strong>ตรวจสุขภาพทหารแบบใหม่</strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9999"><strong>No.</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>Rank</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>Name</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>ID</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Unit</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Rang Group</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>DOB</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Age</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Gender</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Smoke</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Alcohol</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Exercise</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>weight</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>hight</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>WC</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SBP</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>DBP</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>FBS</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>TG</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>HDL-C</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>LDL-C</strong></td>
  </tr>
<?
		$sql = "select *,(
    CASE 
        WHEN `camp` LIKE '%รพ.ค่ายสุรศักดิ์มนตรี' THEN '312600' 
        WHEN `camp` LIKE '%มทบ.32' THEN '312601' 
        WHEN `camp` LIKE '%ร้อย.ฝรพ.3' THEN '312602' 
        WHEN `camp` LIKE '%ร.17 พัน.2' THEN '312603' 
        WHEN `camp` LIKE '%ช.พัน.4 ร้อย4' THEN '312604' 
        WHEN `camp` LIKE '%สง.สด.จว.ล.ป.' THEN '312605' 
        WHEN `camp` LIKE '%กทพ.33' THEN '312606' 
    END
) AS `camp_code` from armychkup where yearchkup='$nPrefix' and camp !='' group by hn order by camp_code asc,chunyot asc, age desc";
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
		$waist=$result["waist"]*2.54;
		if($waist < 1){
			$waist="";
		}else{
			$waist=number_format($waist,2);
		}
		if(substr($result["chunyot"],0,4)=="CH01" || $result["chunyot"]=="นายทหารชั้นสัญญาบัตร"){
			$rankgroup="1";	
		}else if(substr($result["chunyot"],0,4)=="CH02" || $result["chunyot"]=="ทหารชั้นประทวน" || $result["chunyot"]=="นายทหารชั้นประทวน"){
			if($result["yot"]=="พลอาสา" || $result["yot"]=="พลอาสาสมัคร" || $result["yot"]=="พลอาสาฯ"){
				$rankgroup="3";
			}else{
				$rankgroup="2";
			}
		}else if(substr($result["chunyot"],0,4)=="CH04"){
			$rankgroup="4";
		}
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$result["yot"];?></td>
    <td><?=$result["ptname"];?></td>
    <td><?=$result["idcard"];?></td>
    <td align="center"><?=$result["camp_code"];?></td>
    <td align="center"><?=$rankgroup;?></td>
    <td align="center"><?=$result["birthday"];?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$result["gender"];?></td>
    <td align="center"><?=$result["cigarette"];?></td>
    <td align="center"><?=$result["alcohol"];?></td>
    <td align="center"><?=$result["exercise"];?></td>
    <td align="center"><?=$result["weight"];?></td>
    <td align="center"><?=$result["height"];?></td>
    <td align="center"><?=$waist;?></td>
    <td align="center">
      <? if(!empty($result["bp2"])){ list($bp1,$bp2)=explode("/",$result["bp2"]); echo $bp1;}else{ list($bp1,$bp2)=explode("/",$result["bp1"]); echo $bp1;}?>    </td>
    <td align="center"><? if(!empty($result["bp2"])){ list($bp1,$bp2)=explode("/",$result["bp2"]); echo $bp2;}else{ list($bp1,$bp2)=explode("/",$result["bp1"]); echo $bp2;}?></td>
    <td align="center"><? if(empty($result["glu_result"])){ echo "&nbsp;";}else{ echo $result["glu_result"];}?></td>
    <td align="center"><? if(empty($result["chol_result"])){ echo "&nbsp;";}else{ echo $result["chol_result"];}?></td>
    <td align="center"><? if(empty($result["trig_result"])){ echo "&nbsp;";}else{ echo $result["trig_result"];}?></td>
    <td align="center"><? if(empty($result["hdl_result"])){ echo "&nbsp;";}else{ echo $result["hdl_result"];}?></td>
    <td align="center"><? if(empty($result["ldl_result"])){ echo "&nbsp;";}else{ echo $result["ldl_result"];}?></td>
  </tr>
<?
}
?>  
</table>
<br>
<p align="center"><strong>ตรวจสุขภาพทหารแบบเก่า</strong></p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9999"><strong>No.</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>Rank</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>Name</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>ID</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Unit</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Rang Group</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>DOB</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Age</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Gender</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Smoke</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Alcohol</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>Exercise</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>weight</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>hight</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>WC</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SBP</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>DBP</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>FBS</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>TG</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>HDL-C</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>LDL-C</strong></td>
  </tr>
<?
$sql = "SELECT *,
(
    CASE 
        WHEN a.`camp1` LIKE '%รพ.ค่ายสุรศักดิ์มนตรี' THEN '312600' 
        WHEN a.`camp1` LIKE '%มทบ.32' THEN '312601' 
        WHEN a.`camp1` LIKE '%ร้อย.ฝรพ.3' THEN '312602' 
        WHEN a.`camp1` LIKE '%ร.17 พัน.2' THEN '312603' 
        WHEN a.`camp1` LIKE '%ช.พัน.4 ร้อย4' THEN '312604' 
        WHEN a.`camp1` LIKE '%สง.สด.จว.ล.ป.' THEN '312605' 
        WHEN a.`camp1` LIKE '%กทพ.33' THEN '312606' 
    END
) AS `camp_code`
FROM `condxofyear_so` AS a 
WHERE a.`yearcheck` = '$newPrefix' 
AND a.`camp1` != '' and a.`camp1` != 'D33 หน่วยทหารอื่นๆ'
GROUP BY a.`hn`
ORDER BY `camp_code` ASC, a.`row_id` DESC";
//echo $sql;
$query = mysql_query($sql);  		
$i=0;
while($result=mysql_fetch_array($query)){
$i++;

		$waist=$result["round_"]*0.39;
		if($waist < 1){
			$waist="";
		}else{
			$waist=number_format($waist,2);
		}
		
$sql1="select yot,ptname,idcard,age,chunyot,gender from chkup_solider where hn='$result[hn]' and yearchkup='$nPrefix'";
$query1=mysql_query($sql1);
list($yot,$ptname,$idcard,$age,$chunyot,$gender)=mysql_fetch_array($query1);

$sql2="select dbirth from opcard where hn='$result[hn]'";
$query2=mysql_query($sql2);
list($dbirth)=mysql_fetch_array($query2);

list($yy,$mm,$dd)=explode("-",$dbirth);
$yy=$yy-543;
$hbd="$yy-$mm-$dd";


		if(substr($chunyot,0,4)=="CH01"){
			$rankgroup="1";	
		}else if(substr($chunyot,0,4)=="CH02"){
			if($yot=="พลอาสา" || $yot=="พลอาสาสมัคร" || $yot=="พลอาสาฯ"){
				$rankgroup="3";
			}else{
				$rankgroup="2";
			}
		}else if(substr($chunyot,0,4)=="CH04"){
			$rankgroup="4";
		}
?>
	<tr>		  
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$yot;?></td>
    <td><?=$ptname;?></td>
    <td><?=$idcard;?></td>
    <td align="center"><?=$result["camp_code"];?></td>
    <td align="center"><?=$rankgroup;?></td>
    <td align="center"><?=$hbd;?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$gender;?></td>
    <td align="center"><?=$result["cigarette"];?></td>
    <td align="center"><?=$result["alcohol"];?></td>
    <td align="center"><?=$result["exercise"];?></td>
    <td align="center"><?=$result["weight"];?></td>
    <td align="center"><?=$result["height"];?></td>
    <td align="center"><?=$waist;?></td>
    <td align="center"><?=$result["bp1"];?></td>
    <td align="center"><?=$result["bp2"];?></td>
    <td align="center"><? if(empty($result["bs"])){ echo "&nbsp;";}else{ echo $result["bs"];}?></td>
    <td align="center"><? if(empty($result["chol"])){ echo "&nbsp;";}else{ echo $result["chol"];}?></td>
    <td align="center"><? if(empty($result["tg"])){ echo "&nbsp;";}else{ echo $result["tg"];}?></td>
    <td align="center"><? if(empty($result["hdl"])){ echo "&nbsp;";}else{ echo $result["hdl"];}?></td>
    <td align="center"><? if(empty($result["ldl"])){ echo "&nbsp;";}else{ echo $result["ldl"];}?></td>
</tr>    
<?
}
?>  
</table>
