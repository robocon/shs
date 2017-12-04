<?
include("../connect.inc");
		$sql="SELECT * FROM chkup_solider";		
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		echo "-->".$num;
		$tahan1=0;
		$tahan2=0;
		$tahan3=0;			
		while($rows=mysql_fetch_array($query)){
		$code = substr($rows["goup"],0,3);
			
			if($code=="G11"){
				$tahan1++;//นายทหาร
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}elseif($code=="G12" || $code=="G21" || $code=="G37"){
				$tahan2++;//นายสิบ
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}else{
				$tahan3++;
				//echo $nhn."<br>";
			}			
		
		}  // while
		echo "นายทหาร $tahan1 <br />";	
		echo "นายสิบ $tahan2 <br />";	
		echo "ลูกจ้าง $tahan3 <br />";					
?>
