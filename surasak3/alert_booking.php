<?
session_start();
include("connect.inc"); 

if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
	$where1 = "and ward='หอผู้ป่วยรวม' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
	$where1 = "and ward='หอผู้ป่วยสูตินรี' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
	$where1 = "and ward='หอผู้ป่วยหนัก(icu)' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
	$where1 = "and ward='หอผู้ป่วยพิเศษ' ";
}
	
$date1=(date("Y")+543)."-".date("-m-d");
$sql="SELECT * FROM  booking  WHERE  status='' $where1";
$query = mysql_query($sql); 
$row=mysql_num_rows($query);
if($row>0){
?>
	<script>
    	if(confirm("::แจ้งเตือน::\nมีการจองเตียงเพิ่มเติม กรุณาตอบรับการจองเตียงด้วยค่ะ\n(รับทราบ)")){
			window.open('booking_system/booking_show.php?code=<?=substr($_GET['code'],0,2)?>',null,'height=500,width=850,scrollbars=1');
		}
    </script>
<?
}else{
	$todayy1=date("Y")+543;
	$todaym1=date("m");
	$todayd1=date("d")+1;
	
	
	if($todayd1<=9){
		$todayd1="0".$todayd1;		
	}else{
		$todayd1=$todayd1;
	}
	$today1=$todayy1.'-'.$todaym1.'-'.$todayd1;
	
	$sql="SELECT * FROM  booking  WHERE  date_in like '$today1%' and status!='อนุมัติ' and status!='ไม่อนุมัติ' $where1";
	$query = mysql_query($sql); 
	$row=mysql_num_rows($query);
	if($row>0){
?>
		<script>
            if(confirm("::แจ้งเตือน::\nมีการจองเตียงของวันพรุ่งนี้ กรุณาอนุมัติการจองเตียงด้วยค่ะ\n(อนุมัติ)")){
                window.open('booking_system/booking_confirm.php?code=<?=substr($_GET['code'],0,2)?>',null,'height=550,width=900,scrollbars=1');
            }
        </script>
    <?
    }
}
?>