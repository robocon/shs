<CENTER><BR>
<?php

	if($_GET["hn"] == ""){
		
		echo "กรุณา กรอก HN ";

	}else{
 include("connect.inc");
		$sql = "Select yot,  name,  surname, ptright From opcard where hn = '".$_GET["hn"]."'  limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
			if($rows == 0){
				echo "ไม่มาหมายเลข HN ที่ท่านระบุ";
			}else{
				$arr = Mysql_fetch_assoc($result);
				echo $arr["yot"]," ",$arr["name"]," ",$arr["surname"],"<BR>";
				echo "สิทธิ์ ",$arr["ptright"];
				Mysql_free_result($result);
			}

 include("unconnect.inc");
	}
	
?>
<BR><BR>
<A HREF="#" Onclick="window.close();">ปิดหน้านี้</A>
</CENTER>