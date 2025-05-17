<?php
session_start();
include 'connect.php';

	
$date1 = ( date("Y")+543 )."-".date("-m-d");
$sql = "SELECT * FROM `surgery_set` WHERE `status`='Y' and active=''";
$query = mysql_query($sql) or die( mysql_error() ); 
$row = mysql_num_rows($query);

// ถ้าพึ่งจองจากห้องทะเบียน
if( $row > 0 ){ ?>
	<script type="text/javascript">
    	if(confirm("::แจ้งเตือน::\nมีใบ SETผ่าตัดใหม่ จำนวน <?=$row;?> รายการ กรุณาตอบรับข้อมูลด้วยครับ\n(รับทราบ)")){
			window.open('surgery_set_approve.php',null,'height=900,width=1200,scrollbars=1');
		}
    </script>
<?php }else{ // แจ้งเตือนก่อน 1 วันกรณีที่ยังไม่ได้อนุมัติ
	$todayy1 = date("Y");
	$todaym1 = date("m");
	$todayd1 = date("d")+1;
	
	if($todayd1<=9){
		$todayd1="0".$todayd1;		
	}else{
		$todayd1=$todayd1;
	}
	
	$today1 = $todayy1.'-'.$todaym1.'-'.$todayd1;
	
	$sql="SELECT * FROM `surgery_set` 
	WHERE `date_surg` LIKE '$today1%' 
	AND ( `status` = 'Y' AND `active` = '' )";
	
	$query = mysql_query($sql) or die( mysql_error() ); 
	$row=mysql_num_rows($query);
	if($row>0){
?>
		<script>
            if(confirm("::แจ้งเตือน::\nมีใบ SETผ่าตัดของวันพรุ่งนี้ จำนวน <?=$row;?> รายการ กรุณาตอบรับข้อมูลด้วยครับ\n(รับทราบ)")){
                window.open('surgery_set_approve.php',null,'height=600,width=1200,scrollbars=1');
            }
        </script>
    <?php
    }
}
?>