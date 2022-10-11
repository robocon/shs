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
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CBC</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>UA</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>BS</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>CHOL</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>TRI</strong></td>
    <td width="12%" align="center" bgcolor="#FF9999"><strong>HDL</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>LDL</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>URIC</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>BUN</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>CREA</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>ALP</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>ALT/SGPT</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>AST/SGOT</strong></td>
  </tr>
  <?
include("connect.inc");  
	$sql = "select * from armychkup where yearchkup='61' and camp !='' order by camp asc, chunyot asc, age desc";	
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
if($age >=35){
	if(empty($result['glu_lab'])){
		$labquery = "select * from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where b.labcode='GLU' AND a.hn ='".$result["hn"]."' and a.clinicalinfo='ตรวจสุขภาพประจำปี61'";
		//echo $labquery;
		$row = mysql_query($labquery);
		$sult = mysql_fetch_array($row);
		$resultlab=$sult["result"];
		$unitlab=$sult["unit"];
		$ranglab=$sult["normalrange"];
		$flaglab=$sult["flag"];
		
		$glulab=$resultlab;
	}else{
		$glulab=$result['glu_lab'];
	}	
}else if($age < 35){
	$glulab="";
}	
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><div style="margin-left: 10px;">
      <?=$ptname;?>
    </div></td>
    <td align="center"><?=substr($result['camp'],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><strong>
      <?=$result['cbc_lab'];?>
    </strong></td>
    <td align="center"><?=$result['ua_lab'];?></td>
    <td align="center"><strong>
      <?=$glulab;?>
    </strong></td>
    <td align="center"><?=$result['chol_lab'];?></td>
    <td align="center"><strong>
    <?=$result['trig_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['hdl_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['ldl_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['uric_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['bun_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['crea_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['alp_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['alt_lab'];?>
    </strong></td>
    <td align="center"><strong>
      <?=$result['ast_lab'];?>
    </strong></td>
  </tr>
  <?
}
?>
</table>
</body>
</html>
