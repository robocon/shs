<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
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
    <td width="5%" align="center" bgcolor="#FF9999"><strong>ลำดับ</strong></td>
    <td width="17%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="49%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>สังกัด</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>อายุ</strong></td>
    <td width="13%" align="center" bgcolor="#FF9999"><strong>CBC</strong></td>
  </tr>
  <?
include("connect.inc");  
	$sql = "select * from armychkup where yearchkup='61' and camp !='' and cbc_lab ='' order by age desc";	
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
		$rowid=$result["row_id"];

		$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='HCT' AND a.hn ='".$result["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61'";
		//echo $labquery;
		$row = mysql_query($labquery);
		$sult = mysql_fetch_array($row);
		$resultlab=$sult["result"];
		$flaglab=$sult["flag"];
		
		if($flaglab=="N"){		
			$cbclab="ปกติ";
		}else if($flaglab=="H" || $flaglab=="L"){
			$cbclab="ผิดปกติ";
		}else{
			$cbclab="";
		}
		$update="update armychkup set cbc_lab='$cbclab' 
						where row_id='$rowid';";
		//echo $update."<br>";		
		mysql_query($update);				
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result['hn']?></td>
    <td><div style="margin-left: 10px;">
      <?=$ptname;?>
    </div></td>
    <td align="center"><?=substr($result['camp'],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$cbclab;?></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>

