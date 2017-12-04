<?
    	include("connect.inc");
		$sql="SELECT *
FROM `condxofyear_so`
WHERE yearcheck = '2557' AND `sum2`
LIKE '%พบความเสี่ยงเบื้องต้นต่อโรค%'";
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		$sum1count1=0;
		$sum2count1=0;
		$smbasiccount2=0;		
		$smbasiccount3=0;	
		while($rows=mysql_fetch_array($query)){
		$age = substr($rows["age"],0,2);
			if($age <= 35){
				echo $rows["rs_sum21"]."-".$rows["rs_sum22"]."-".$rows["rs_sum23"]."-".$rows["rs_sum24"]."-".$rows["rs_sum25"]."<br />";	
				$sum2 =  $rows["sum2"];		
				if($sum2=="พบความเสี่ยงเบื้องต้นต่อโรค"){
					$sum2count1++;
				}				
			}			
		}		
		echo "เสี่ยง : $sum2count1 <br />";	
?>
