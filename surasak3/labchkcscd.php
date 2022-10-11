<?
include("connect.inc");
$sql="select * from lab_cscd";
$query=mysql_query($sql);
$num=mysql_num_rows($query);
$i=0;
while($rows=mysql_fetch_array($query)){
	$chksql="select * from labcare where codex='".$rows["codecscd"]."' and (code NOT LIKE '%SSO%' OR code NOT LIKE 'C-%')";
	$chkquery=mysql_query($chksql);
	$chknum=mysql_num_rows($chkquery);	
	$result=mysql_fetch_array($chkquery);
	if($chknum > 0){
		if($rows["yprice"] <> $result["yprice"]){
			$i++;
			echo "[$i]".$rows["codelab"]."--->".$rows["yprice"]."==>".$result["yprice"]."<br>";
			if($rows["yprice"] > $result["yprice"]){
				$price=$rows["yprice"];
				$yprice=$rows["yprice"];
				$nprice="0";
				$edit="update labcare set price='$price', yprice='$yprice', nprice='$nprice' where row_id='".$result["row_id"]."' ";		
				//mysql_query($edit);		
			}else{
				$yprice=$rows["yprice"];
				$nprice=$result["price"]-$rows["yprice"];
				$edit1="update labcare set yprice='$yprice', nprice='$nprice' where row_id='".$result["row_id"]."' ";
				//mysql_query($edit1);
			}
			//echo $edit."<br>";		
		}
	}
}
?>
