<?
session_start();
include("connect.inc");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
</style>
<body>
<?php include("dt_menu.php");?>
<?php include("dt_patient.php");?>
<?
		$temparr=array();
		$pausearr=array();
		$ratearr=array();
		$weightarr=array();	 
		$heightarr=array();
		$bp1arr=array();
		$bp2arr=array();
		$thaidate=array();
		$diag1=array();
		$sql = "Create Temporary table opd2 Select * From opd where hn='".$_SESSION["hn_now"]."' order by thidate desc limit 10";
		$result = mysql_query($sql);

		$opdsign = "select * from opd2 order by thidate asc limit 10";
		$result2 = mysql_query($opdsign);
		
		while($arr2 = mysql_fetch_assoc($result2)){
			$ym = explode("-",$arr2['thidate']);
			$d = explode(" ",$ym[2]);
			$date = $d[0]."-".$ym[1]."-".$ym[0]." ".$d[1];
			
			$sql = "Select diag From opday where hn='".$_SESSION["hn_now"]."' and thidate like '".$ym[0]."-".$ym[1]."-".$d[0]."%'";

			$result = mysql_query($sql);
			$arr = mysql_fetch_assoc($result);
			
			array_push($diag1,$arr['diag']);
			array_push($thaidate,$date);
			array_push($temparr,$arr2['temperature']);
			array_push($pausearr,$arr2['pause']);
			array_push($ratearr,$arr2['rate']);
			array_push($weightarr,$arr2['weight']);
			array_push($heightarr,$arr2['height']);
			array_push($bp1arr,$arr2['bp1']);
			array_push($bp2arr,$arr2['bp2']);
		}
?>

<table width="85%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#FFCCCC">
  <tr>
    <td>&nbsp;</td>
    <td align="center"><?php echo $thaidate[0]?></td>
    <td align="center"><?php echo $thaidate[1]?></td>
    <td align="center"><?php echo $thaidate[2]?></td>
    <td align="center"><?php echo $thaidate[3]?></td>
    <td align="center"><?php echo $thaidate[4]?></td>
    <td align="center"><?php echo $thaidate[5]?></td>
    <td align="center"><?php echo $thaidate[6]?></td>
    <td align="center"><?php echo $thaidate[7]?></td>
    <td align="center"><?php echo $thaidate[8]?></td>
    <td align="center"><?php echo $thaidate[9]?></td>
  </tr>
  <tr>
    <td width="10%">T :  (C&deg;)</td>
    <td width="9%" align="center"><?php echo $temparr[0]?></td>
    <td width="9%" align="center"><?php echo $temparr[1]?></td>
    <td width="9%" align="center"><?php echo $temparr[2]?></td>
    <td width="9%" align="center"><?php echo $temparr[3]?></td>
    <td width="9%" align="center"><?php echo $temparr[4]?></td>
    <td width="9%" align="center"><?php echo $temparr[5]?></td>
    <td width="9%" align="center"><?php echo $temparr[6]?></td>
    <td width="9%" align="center"><?php echo $temparr[7]?></td>
    <td width="9%" align="center"><?php echo $temparr[8]?></td>
    <td width="9%" align="center"><?php echo $temparr[9]?></td>
  </tr>
  <tr>
    <td>P :  (ครั้ง/นาที)&nbsp;</td>
    <td width="9%" align="center"><?php echo $pausearr[0]?></td>
    <td width="9%" align="center"><?php echo $pausearr[1]?></td>
    <td width="9%" align="center"><?php echo $pausearr[2]?></td>
    <td width="9%" align="center"><?php echo $pausearr[3]?></td>
    <td width="9%" align="center"><?php echo $pausearr[4]?></td>
    <td width="9%" align="center"><?php echo $pausearr[5]?></td>
    <td width="9%" align="center"><?php echo $pausearr[6]?></td>
    <td width="9%" align="center"><?php echo $pausearr[7]?></td>
    <td width="9%" align="center"><?php echo $pausearr[8]?></td>
    <td width="9%" align="center"><?php echo $pausearr[9]?></td>
  </tr>
  <tr>
    <td>R :  (ครั้ง/นาที)</td>
    <td width="9%" align="center"><?php echo $ratearr[0]?></td>
    <td width="9%" align="center"><?php echo $ratearr[1]?></td>
    <td width="9%" align="center"><?php echo $ratearr[2]?></td>
    <td width="9%" align="center"><?php echo $ratearr[3]?></td>
    <td width="9%" align="center"><?php echo $ratearr[4]?></td>
    <td width="9%" align="center"><?php echo $ratearr[5]?></td>
    <td width="9%" align="center"><?php echo $ratearr[6]?></td>
    <td width="9%" align="center"><?php echo $ratearr[7]?></td>
    <td width="9%" align="center"><?php echo $ratearr[8]?></td>
    <td width="9%" align="center"><?php echo $ratearr[9]?></td>
  </tr>
  <tr>
    <td>BP :  (mmHg.&nbsp;)</td>
    <td width="9%" align="center"><?php echo $bp1arr[0]."/".$bp2arr[0]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[1]."/".$bp2arr[1]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[2]."/".$bp2arr[2]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[3]."/".$bp2arr[3]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[4]."/".$bp2arr[4]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[5]."/".$bp2arr[5]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[6]."/".$bp2arr[6]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[7]."/".$bp2arr[7]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[8]."/".$bp2arr[8]?></td>
    <td width="9%" align="center"><?php echo $bp1arr[9]."/".$bp2arr[9]?></td>
  </tr>
  <tr>
    <td>Weight :  (กก.)</td>
    <td width="9%" align="center"><?php echo $weightarr[0]?></td>
    <td width="9%" align="center"><?php echo $weightarr[1]?></td>
    <td width="9%" align="center"><?php echo $weightarr[2]?></td>
    <td width="9%" align="center"><?php echo $weightarr[3]?></td>
    <td width="9%" align="center"><?php echo $weightarr[4]?></td>
    <td width="9%" align="center"><?php echo $weightarr[5]?></td>
    <td width="9%" align="center"><?php echo $weightarr[6]?></td>
    <td width="9%" align="center"><?php echo $weightarr[7]?></td>
    <td width="9%" align="center"><?php echo $weightarr[8]?></td>
    <td width="9%" align="center"><?php echo $weightarr[9]?></td>
  </tr>
  <tr>
    <td>Height :  (ซม.)</td>
    <td width="9%" align="center"><?php echo $heightarr[0]?></td>
    <td width="9%" align="center"><?php echo $heightarr[1]?></td>
    <td width="9%" align="center"><?php echo $heightarr[2]?></td>
    <td width="9%" align="center"><?php echo $heightarr[3]?></td>
    <td width="9%" align="center"><?php echo $heightarr[4]?></td>
    <td width="9%" align="center"><?php echo $heightarr[5]?></td>
    <td width="9%" align="center"><?php echo $heightarr[6]?></td>
    <td width="9%" align="center"><?php echo $heightarr[7]?></td>
    <td width="9%" align="center"><?php echo $heightarr[8]?></td>
    <td width="9%" align="center"><?php echo $heightarr[9]?></td>
  </tr>
  <tr>
    <td>อาการ :</td>
    <td align="center"><?php echo $diag1[0]?></td>
    <td align="center"><?php echo $diag1[1]?></td>
    <td align="center"><?php echo $diag1[2]?></td>
    <td align="center"><?php echo $diag1[3]?></td>
    <td align="center"><?php echo $diag1[4]?></td>
    <td align="center"><?php echo $diag1[5]?></td>
    <td align="center"><?php echo $diag1[6]?></td>
    <td align="center"><?php echo $diag1[7]?></td>
    <td align="center"><?php echo $diag1[8]?></td>
    <td align="center"><?php echo $diag1[9]?></td>
  </tr>
</table>
</body>
</html>