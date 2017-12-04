<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="font1">
  <tr>
  	<td width="6%" rowspan="3" align="center">ลำดับ</td>
    <td width="19%" rowspan="3" align="center">รพ.ทบ.</td>
    <td colspan="4" align="center">จำนวนผู้รับการตรวจร่างกายที่พบโรคอื่นๆ</td>
  </tr>
  <tr>
    <td width="17%" rowspan="2" align="center">อายุไม่เกิน 35 ปีบริบูรณ์</td>
    <td width="18%" rowspan="2" align="center">อายุมากกว่า 35 ปีบริบูรณ์</td>
    <td colspan="2" align="center">จำนวนทั้งหมด</td>
  </tr>
  <tr>
    <td width="17%" align="center">จำนวน(ราย)</td>
    <td width="23%" align="center">ร้อยละ</td>
  </tr>
 <?
  $m=0;
  $diag2 = array();
  if($ok==1){
	  $query2 = "select distinct(diag) from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and diag != '' and (thidate between '2012-08-01 00:00:00' and '2012-08-23 23:59:59' ) and camp like '%".$_POST['camp']."%' order by diag asc";
	  
	  $where2 = "and (thidate between '2012-08-01 00:00:00' and '2012-08-23 23:59:59' )";
  }
  elseif($_POST['camp']==''){
 	$query2 = "select distinct(diag) from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and diag != '' and substr(left(camp,3),2) between '02' and '10' order by diag asc";
  }else{
	$query2 = "select distinct(diag) from condxofyear_so where status_dr='Y' and camp like '%".$_POST['camp']."%' and yearcheck='".$_POST['year']."' and diag != '' order by diag asc";
	}
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	while(list($diag) = mysql_fetch_array($aa2)){
		$m++;
		$cut = explode(",",$diag);
		for($k=0;$k<sizeof($cut);$k++){
			if($cut[$k]!=""){
				if(trim($cut[$k])=="DM") $cut[$k]="เบาหวาน";
				if(trim($cut[$k])=="HT") $cut[$k]="ความดันโลหิตสูง";
				if(trim($cut[$k])=="Gout") $cut[$k]="เก๊าท์";
				if(!in_array(ucfirst(trim($cut[$k])),$diag2)){
					array_push($diag2,ucfirst(trim($cut[$k])));
				}
			}
		}
	}
	for($m=0;$m<sizeof($diag2);$m++){
		$count3=0;
		$a=0;
  		$b=0;
		if($diag2[$m]=="เบาหวาน") $where ="(diag like '%".$diag2[$m]."%' or diag like '%DM%')  ";
		elseif($diag2[$m]=="ความดันโลหิตสูง") $where ="(diag like '%".$diag2[$m]."%' or diag like '%HT%')";
		elseif($diag2[$m]=="เก๊าท์") $where ="(diag like '%".$diag2[$m]."%' or diag like '%gout%')";
		else{ $where ="diag like '%".$diag2[$m]."%'";}
		if(!isset($where2)){
			$where.="and camp like '%".$_POST['camp']."%'";
		}
		$query4 = "select hn,age from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and ".$where." ".$where2;
		
		//echo $query4;
		$aa4 = mysql_query($query4);
		while(list($hn,$age) = mysql_fetch_array($aa4)){
		
		$age = substr($age,0,2);
		if($age<=35){
			$a++;
			//echo $age."<br>";
		}
		elseif($age>35){
			$b++;
			//echo $age."b";
		}
		$count3++;
		}
 ?>
  <tr>
  	<td align="center"><?=$m+1;?></td>
    <td><?=$diag2[$m]?></td>
    <td align="center"><?=$a?></td>
    <td align="center"><?=$b?></td>
    <td align="center"><?=$count3?></td>
    <?
    $percent = (100*$count3)/$allcount;
	?>
    <td align="center"><?=number_format($percent,2)?></td>
  </tr>
  <?
  $alla+=$a;
  $allb+=$b;
  $allcount3+=$count3;
	}
	//print_r($diag2);
  ?>
    <tr>
    <td align="center">&nbsp;</td>
    <td align="center">รวมทั้งสิ้น</td>
    <td align="center"><?=$alla;?></td>
    <td align="center"><?=$allb;?></td>
    <td align="center"><?=$allcount3?></td>
    <td align="center">&nbsp;</td>
  </tr>
</table>


</body>
</html>