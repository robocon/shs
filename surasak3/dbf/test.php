<?php
    include("../connect.inc");
?>
<?
/*$test="�����ط�� ǧ��ѹ��� (�.1850)";
$subname = substr($test,15,5);
echo $subname;*/
?>

<?
/*		$sql11 ="select * from  drugrx  where date like '2556-10%'";
		//echo $sql11;
		$result11 = mysql_query($sql11) or die("Query failed11");
   		while($rows11 = mysql_fetch_array($result11)){	
			$reason11=$rows11["reason"];
			$reason=substr($reason11,0,1);		
			echo "���㹵��ҧ :".$reason11."---> ��ҷ��Ѵ�͡�� :".$reason."<br>";	
			if(($reason =="A" || $reason =="B" || $reason =="C" || $reason =="D" || $reason =="E" || $reason =="F") && $reason !="  "){
				$newreason ="E".$reason;
				echo "��ҷ����� E ���� ���".$newreason."<br>";
			}		
		}*/
?>

<?
/*		$sql11 ="select *, sum(price) as sumprice from  opacc  where hn='47-15276' and date like '2556-10%' group by substring(date,0,10), hn";
		echo $sql11."<br>";
		$result11 = mysql_query($sql11) or die("Query failed11");
   		$i==0;
		while($rows11 = mysql_fetch_array($result11)){	
		$i++;
			$hn=$rows11["hn"];	
			$date=$rows11["date"];	
			$sumprice=$rows11["sumprice"];
			echo "$i) �ѹ��� $date : ���ʼ����� $hn : �Ҥ���� $sumprice <br>";
		}*/
?>

<?
/*	$sql11 ="select * from  drugrx  where hn='47-15276' and date like '2556-10%'";
		echo $sql11."<br>";
		$result11 = mysql_query($sql11) or die("Query failed11");
   		$i==0;
		while($rows11 = mysql_fetch_array($result11)){	
		$i++;
			$hn=$rows11["hn"];	
			$date=$rows11["date"];	
			$price=$rows11["price"];
			echo "$i) �ѹ��� $date : ���ʼ����� $hn : �Ҥ��� $price <br>";
		}*/
?>

<?
		$sql11 ="select *, sum(price) as sumprice from  opacc  where hn='47-15276' and date like '2556-10%' group by substring(date,1,10), hn";
		echo $sql11."<br>";
		$result11 = mysql_query($sql11) or die("Query failed11");
   		$i==0;
		while($rows11 = mysql_fetch_array($result11)){	
		$i++;
			$hn=$rows11["hn"];	
			//DATEDX
			$datedx5=$rows11["date"];
			$date5 = substr($datedx5,0,10);
	
		//	echo "$i) �ѹ��� $date : ���ʼ����� $hn<br>";
			
		$sqlop ="select * from opday where hn ='".$hn."' and thidate like '$date5%'";   //  Query ��Ң����Ũҡ���ҧ opday
		echo $sqlop."<br>";
		$resultop = mysql_query($sqlop) or die("Query opday failed");
   		$rowsop = mysql_fetch_array($resultop);
		$rowid=$rowsop["row_id"];
		$vn=$rowsop["vn"];
		echo "$i) �ѹ��� $datedx5 : ���ʼ����� $hn : �ʹ� $rowid : ����� $vn<br>";
		}
?>
