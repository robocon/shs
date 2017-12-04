<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
.forntbold {
	font-family: "TH SarabunPSK";
	font-size:20px;
	font-weight:bold;
}
-->
</style>
<body>

<h2>รายงานผู้ป่วยบำนาญ</h2>
<form name="form1" method="post" action="">
                     
<span class="forntbold">เดือน</span>
<select name="keymonth" class="forntsarabun">
    <option  value="">---เลือกเดือน-----</option>
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
    <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
    <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
    <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
    <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
    <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
    <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
    <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
    <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
    <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
    <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
    <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
    </select>
                          <span class="forntbold">ปี พ.ศ.</span>
<? 
			   $Y=date("Y");
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='keyyear' class='forntsarabun'>";
				foreach($dates as $i){

				$ii=$i-543; ?>
                
				<option value='<?=$ii?>' <? if($Y==$ii){ echo "selected"; }?>><?=$i;?></option>
                <p>
                  <?
				}
				echo "<select>";
				?>
                  
                  
                  
                  <input name="Submit" type="submit" class="forntbold" value="ตกลง">
                    <a href="http://192.168.1.2/sm3/nindex.htm" class="forntbold">กลับเมนู</a>
                </p>
                        </div>
                      </form>
   <hr /> 
  <?php 
 if(isset($_POST['Submit'])){
	 
	 
	 switch($_POST['keymonth']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	
	$y=$_POST['keyyear']+543;
	
   $dateshow=$printmonth." ".$y;
	 
 ?>   
   <h2 class="forntbold">ผู้ป่วยบำนาญทหาร ประจำเดือน   <?=$dateshow;?></h2>     
    
    
    
    
                      
<table  border="1" cellspacing="0" cellpadding="0" class="forntsarabun" bordercolor="#000000" style="border-collapse:collapse">
  
  <tr>
    <td align="center" bgcolor="#00CCFF">ลำดับ</td>
    <td align="center" bgcolor="#00CCFF">HN</td>
    <td align="center" bgcolor="#00CCFF">ชื่อ- สกุล</td>
    <td align="center" bgcolor="#00CCFF">ครั้ง</td>
  </tr>        
<?php 
				
					include("connect.inc");
					
					$keyyear=$_POST['keyyear']+543;
					$thidate=$keyyear.'-'.$_POST['keymonth'];
					//echo $thidate;
$n=1;			
$tempsql2="CREATE TEMPORARY TABLE opcard1  Select * from  opcard  WHERE pension_status='Y' ";
$tempquery2 =mysql_query($tempsql2);

		
$tempsql1="CREATE TEMPORARY TABLE  opday1  Select * from   opday  WHERE  thidate like '$thidate%' GROUP BY hn";
$tempquery1 = mysql_query($tempsql1);
$tempsql1="CREATE TEMPORARY TABLE  opday2  Select * from   opday  WHERE  thidate like '$thidate%'";
$tempquery1 = mysql_query($tempsql1);


	$sql1="Select  *  from opday1";
	$query1=mysql_query($sql1);
	while($arr1=mysql_fetch_array($query1)){
		
		

	//	echo $arr1['hn']."<br>";

		$sql2="SELECT  *  FROM opcard1  WHERE  hn='$arr1[hn]' GROUP BY hn,name";
		$query2=mysql_query($sql2);
		$row=mysql_num_rows($query2);

		while($arr2=mysql_fetch_array($query2)){
			
			$sqlc="Select  * , Count(*)as cnum    from opday2 WHERE hn='$arr2[hn]' GROUP BY hn";
			$queryc=mysql_query($sqlc);
			$arrc=mysql_fetch_array($queryc);
			
			
			$sqlan="Select  * from opday2 WHERE hn='$arr2[hn]' and (an!=NULL or an!='')";
			$queryan=mysql_query($sqlan);
			$rowan=mysql_num_rows($queryan);
			
			if(!$rowan){
				$color="#FFFFFF";
				$opd++;
			}else{
				$color="#99CC00";
				$ipd++;
			}
  ?>
  <tr bgcolor="<?=$color;?>">
    <td><?=$n;?></td>
    <td><?=$arr2['hn'];?></td>
    <td><a href="view_pension.php?hn=<?=$arr2['hn'];?>&thidate=<?=$thidate?>"><?=$arr2['yot'].$arr2['name'].' '.$arr2['surname'];?></a></td>
    <td><?=$arrc['cnum'];?></td>
  </tr>
  <?php
 $n++; 
 $sum+=$arrc['cnum'];
  }	

  }  
  ?>
  <tr>
    <td colspan="3" align="center" bgcolor="#CCCCCC">รวมจำนวน/ ครั้ง</td>
  <td align="center" bgcolor="#CCCCCC"><?=$sum;?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#99CC00">รวมผู้ป่วยใน/ คน</td>
    <td align="center" bgcolor="#99CC00"><? if($ipd==""){ echo "0"; }else{ echo $ipd; }?></td>
  </tr>
  <tr>
    <td colspan="3" align="center" bgcolor="#FFFFCC">รวมผู้ป่วยนอก/ คน</td>
    <td><? if($opd==""){ echo "0"; }else{ echo $opd; }?></td>
  </tr>
</table>
			
					
<?

}
?>



</body>
</html>