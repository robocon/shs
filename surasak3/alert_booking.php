<?php
session_start();
include 'connect.php';

if(isset($_GET['code'])&&substr($_GET['code'],0,2)=="42"){
	$where1 = "AND `ward` = '�ͼ��������' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="43"){
	$where1 = "AND `ward` = '�ͼ������ٵԹ��' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="44"){
	$where1 = "AND `ward` = '�ͼ�����˹ѡ(icu)' ";
}elseif(isset($_GET['code'])&&substr($_GET['code'],0,2)=="45"){
	$where1 = "AND `ward` = '�ͼ����¾����' ";
}
	
$date1 = ( date("Y")+543 )."-".date("-m-d");
$sql = "SELECT * FROM `booking` WHERE `status`='' $where1";
$query = mysql_query($sql) or die( mysql_error() ); 
$row = mysql_num_rows($query);

// ��Ҿ�觨ͧ�ҡ��ͧ����¹
if( $row > 0 ){ ?>
	<script type="text/javascript">
    	if(confirm("::����͹::\n�ա�èͧ��§������� ��سҵͺ�Ѻ��èͧ��§���¤��\n(�Ѻ��Һ)")){
			window.open('booking_system/booking_show.php?code=<?=substr($_GET['code'],0,2)?>',null,'height=500,width=850,scrollbars=1');
		}
    </script>
<?php }else{ // ����͹��͹ 1 �ѹ�óշ���ѧ�����͹��ѵ�
	$todayy1 = date("Y")+543;
	$todaym1 = date("m");
	$todayd1 = date("d")+1;
	
	if($todayd1<=9){
		$todayd1="0".$todayd1;		
	}else{
		$todayd1=$todayd1;
	}
	
	$today1 = $todayy1.'-'.$todaym1.'-'.$todayd1;
	
	$sql="SELECT * FROM `booking` 
	WHERE `date_in` LIKE '$today1%' 
	AND ( `status` != '͹��ѵ�' OR `status` != '���͹��ѵ�' OR `status` = '�Ѻ��Һ' )
	$where1";
	
	$query = mysql_query($sql) or die( mysql_error() ); 
	$row=mysql_num_rows($query);
	if($row>0){
?>
		<script>
            if(confirm("::����͹::\n�ա�èͧ��§�ͧ�ѹ���觹�� ��س�͹��ѵԡ�èͧ��§���¤��\n(͹��ѵ�)")){
                window.open('booking_system/booking_confirm.php?code=<?=substr($_GET['code'],0,2)?>',null,'height=550,width=900,scrollbars=1');
            }
        </script>
    <?php
    }
}
?>