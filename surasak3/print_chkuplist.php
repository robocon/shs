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
.style1 {
	font-size: 24px;
	font-weight: bold;
}
-->
</style>
<?
	include("connect.inc");	
	$sql="SELECT  a.HN, a.yot, a.name, a.surname, a.idcard, b.hn, b.ptname, b.weight, b.height, b.bp1, b.bp2, b.p ,a.exam_no FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='$_GET[part]' order by a.row asc ";
	//echo $sql;
	$cquery=mysql_query($sql);
	$num=mysql_num_rows($cquery);
?>
<p align="center" class="style1">หน่วยงาน 
  <?=$_GET["part"];?>
</p>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9999"><strong>#</strong></td>
       <td width="15%" align="center" bgcolor="#FF9999"><strong>รหัสนักศึกษา</strong></td>
    <td width="15%" align="center" bgcolor="#FF9999"><strong>IDCARD</strong></td>
      <td width="9%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="28%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>WEIGHT</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>HEIGHT</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>BP1</strong></td>
    <td width="8%" align="center" bgcolor="#FF9999"><strong>BP2</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>P</strong></td>
    <td width="11%" align="center" bgcolor="#FF9999"><strong>AMP</strong></td>
  </tr>
<?
	$i=0;
	while($result=mysql_fetch_array($cquery)){
	$i++;
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><? if(empty($result['exam_no'])){ echo "&nbsp;";}else{ echo $result['exam_no'];}?></td>
      <td align="center"><? if(empty($result['idcard'])){ echo "&nbsp;";}else{ echo $result['idcard'];}?></td>
    <td align="center"><? if(empty($result['hn'])){ echo $result['HN'];}else{ echo $result['hn'];}?></td>
    <td><? if(empty($result['ptname'])){ echo $result['yot']." ".$result['name']." ".$result['surname'];}else{ echo $result['ptname'];}?></td>
    <td align="center"><? if(empty($result['weight'])){ echo "&nbsp;";}else{ echo $result['weight'];}?></td>
    <td align="center"><? if(empty($result['height'])){ echo "&nbsp;";}else{ echo $result['height'];}?></td>
    <td align="center"><? if(empty($result['bp1'])){ echo "&nbsp;";}else{ echo $result['bp1'];}?></td>
    <td align="center"><? if(empty($result['bp2'])){ echo "&nbsp;";}else{ echo $result['bp2'];}?></td>
    <td align="center"><? if(empty($result['p'])){ echo "&nbsp;";}else{ echo $result['p'];}?></td>
    <?
	$sql1=mysql_query("select b.result from resulthead as a inner join resultdetail as b on a.autonumber=b.autonumber where a.hn='".$result['hn']."' and a.clinicalinfo='AMP ,'");
	list($resultamp)=mysql_fetch_row($sql1);	
	?>
    <td align="center"><? if(empty($resultamp)){ echo "&nbsp;";}else{ echo $resultamp;}?></td>
  </tr>
<?	
	}
?>  
</table>

