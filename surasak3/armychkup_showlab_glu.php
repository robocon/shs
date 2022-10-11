<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>

<body>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#FF9999"><strong>ลำดับ</strong></td>
    <td width="32%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="7%" align="center" bgcolor="#FF9999"><strong>สังกัด</strong></td>
    <td width="7%" align="center" bgcolor="#FF9999"><strong>อายุ</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>Result</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>Flag</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>BS</strong></td>
  </tr>
  <?
include("connect.inc");  
	$sql = "select * from armychkup where yearchkup='61' and camp !='' and age >=35 and glu_lab ='' order by age desc";	
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
		$rowid=$result["row_id"];

		$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$result["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61'";
		//echo $labquery;
		$row = mysql_query($labquery);
		$sult = mysql_fetch_array($row);
		$resultlab=$sult["result"];
		$flaglab=$sult["flag"];
		
		if($flaglab=="N"){		
			$glulab="ปกติ";
		}else if($flaglab=="H" || $flaglab=="L"){
			$glulab="ผิดปกติ";
		}else{
			$glulab="";
		}
		$update="update armychkup set glu_result='$resultlab',
														  glu_flag='$flaglab',
														  glu_lab='$glulab' 
						where row_id='$rowid';";
		echo $update."<br>";		
		mysql_query($update);				
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;">
      <?=$ptname;?>
    </div></td>
    <td align="center"><?=substr($result['camp'],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$resultlab;?></td>
    <td align="center"><?=$flaglab;?></td>
    <td align="center"><strong>
      <?=$glulab;?>
    </strong></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>
