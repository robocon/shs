<?php
session_start();
include("connect.inc");

if($_GET["action"] == "del"){
	
		
		$sql = "Select drugcode, item, hn, part, salepri, amount, freepri From ddrugrx where row_id='".$_GET["grow_id"]."' AND date = '".$_GET["sDate"]."' limit 1 ";

		list($drugcode, $item, $hn, $part, $salepri, $amount, $freepri) = Mysql_fetch_row(Mysql_Query($sql));
		
		$update= "";
		
		if($freepri > $salepri)
			$freepri = $salepri;

		switch($part){
				case "DDL": $update .= ",essd=essd-".($salepri*$amount);break;
				case "DDY": $update .= ",nessdy=nessdy-".($salepri*$amount); break;
				case "DDN": $update .= ",nessdn=nessdn-".($salepri*$amount); break;
				
				case "DPY": 
					$update .= ",dpy=dpy-".($freepri*$amount);
					$update .= ",dpn=dpn-".(($salepri - $freepri) * $amount); 
				
				break;
				case "DPN": $update .= ",dpn=dpn-".($salepri*$amount); break;
				case "DSY": 
					$sql2 = "Select medical_sup_free From druglst where drugcode = '".$drugcode."' limit 0,1";
				list($medical_sup_free) = mysql_fetch_row(mysql_query($sql2));
					
					if($medical_sup_free ==0){
						$update .= ",dsn=dsn-".($salepri*$amount); 
					}else{
						$update .= ",dsy=dsy-".($freepri*$amount); 
						$update .= ",dsn=dsn-".(($salepri - $freepri)*$amount); 
					}
				
				break;
				case "DSN": $update .= ",dsn=dsn-".($salepri*$amount); break;

		}

		
		
		
		$sql = "Delete From ddrugrx where row_id = '".$_GET["grow_id"]."' limit 1";
		$result = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());

		$sql = "update ddrugrx set item = item-1 where idno='".$_GET["grow_id2"]."' AND date = '".$_GET["sDate"]."'  ";

		if($result==true)
			$result2 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());

		$sql = "update dphardep set item=item-1, price=price-".($salepri*$amount)." ".$update."  where row_id='".$_GET["grow_id2"]."' AND date = '".$_GET["sDate"]."' limit 1; ";
		
		if($result2 ==true)
			$result3 = Mysql_Query($sql) or die("เกิดความผิดพลาดในระบบ กรูณา พิมพ์หน้าจอนี้ไว้ให้โปรแกรมเมอร์ดูครับ<BR> ".Mysql_error());

		if($result==true && $result2==true && $result3 == true){
			echo "ลบข้อมูลเรียบร้อยแล้ว กรุณาปิดหน้านี้ด้วยครับ
			<SCRIPT LANGUAGE=\"JavaScript\">
				
				opener.location.reload();
				setTimeout(\"window.close()';\",1000);

			</SCRIPT>
			";
		}
		

}



include("unconnect.inc");
?>