<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{
	display:none;
	}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
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
-->
</style>
<?
include("connect.inc"); 


$sso="R07 ประกันสังคม";	
	$sql1="Select hn,yot,name,surname,idcard,phone from   opcard   WHERE ptright
=  '".$sso."' group by hn order by row_id desc";
	$query1 = mysql_query($sql1);
	$row=mysql_num_rows($query1);
	$i=1;
	?>
    <p align="center"><strong>รายชื่อผู้ป่วยทั้งหมด สิทธิประกันสังคม</strong></p>
    <div align="center"><a href="../nindex.htm" class="forntsarabun"><< ไปเมนูหลัก >></a></div>
   <table width="100%"  border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse"> 
    <tr bgcolor="#0099FF">
    <td width="7%" align="center"><strong>ลำดับ</strong></td>
    <td width="12%" align="center"><strong>HN</strong></td>
    <td width="34%" align="center"><strong>ชื่อ-สกุล</strong></td>
    <td width="19%" align="center"><strong>ID CARD</strong></td>
    <td width="28%" align="center"><strong>เบอร์โทรศัพท์</strong></td>
    </tr>
    <?
	while($arr1=mysql_fetch_array($query1)){
		$ptname=$arr1['yot'].$arr1['name']." ".$arr1['surname'];	
			
	?>
    <tr>
      <td align="center"><?=$i;?></td>
  	  <td><?=$arr1['hn'];?></td>
      <td><?=$ptname;?></td>
      <td><?=$arr1['idcard'];?></td>
      <td><?=$arr1['phone'];?></td>
     </tr>
    <? 
		$i++;
	}  
	
	
	?>
    </table>
   