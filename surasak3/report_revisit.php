<?php
session_start();
include("connect.inc");
/*$sql="select distinct(hn) as hn from opday where thidate between '2557-08-01 00:00:00' and '2557-08-31 23:59:59'";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
	$csql="select * from opday where hn='".$rows["hn"]."' and thidate between '2557-08-01 00:00:00' and '2557-08-31 23:59:59' ";
	//echo $csql;
	$cquery=mysql_query($csql);
	$cnum=mysql_num_rows($cquery);
	if($cnum > 1){
	$i=0;
		while($crows=mysql_fetch_array($cquery)){
		$i++;
				$thaidate1=substr($crows["thidate"],8,2);
				$tsql="select * from opday where hn='".$crows["hn"]."' and thidate between '2557-08-01 00:00:00' and '2557-08-31 23:59:59' and thidate !='".$crows["thidate"]."'";
				//echo $tsql."<br>";
				$tquery=mysql_query($tsql);
				$tnum=mysql_num_rows($tquery);		
				while($trows=mysql_fetch_array($tquery)){
				$thaidate2=substr($trows["thidate"],8,2);
					//echo "$thaidate2-$thaidate1<br>";
					$numdate=$thaidate2-$thaidate1;
					//echo $numdate."<br>";
					if($numdate ==0 || $numdate==1 || $numdate==2){
					echo "HN : ".$rows["hn"]."<br>";
					echo "$i)วันที่-->$crows[thidate]<br>";
					}
				}
				
		}  //close while
					echo "*--------------------------*<br>";
	} // close cnum
}  //close while*/
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>

<table width="36%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="27%" align="center"><strong>HN</strong></td>     
    <td width="73%" align="center"><strong>วันที่</strong></td> 
  </tr>
<?
$sql="select distinct(hn) as hn from opday where thidate between '2557-08-01 00:00:00' and '2557-08-31 23:59:59'";
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
	$csql="select hn, thidate from opday where hn='".$rows["hn"]."' and thidate between '2557-08-01 00:00:00' and '2557-08-31 23:59:59'";
	$cquery=mysql_query($csql);
	while($crows=mysql_fetch_array($cquery)){
?>  
  <tr>
    <td><?=$crows["hn"];?></td> 
    <td><?=$crows["thidate"];?></td>
  </tr>
<?
	}
}
?>  
</table>

