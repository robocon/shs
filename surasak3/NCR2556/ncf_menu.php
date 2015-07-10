<? session_start();?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN"
"http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
		<link rel="stylesheet" type="text/css" href="css/superfish.css" media="screen">
		<script type="text/javascript" src="js/jquery-1.2.6.min.js"></script>
		<script type="text/javascript" src="js/hoverIntent.js"></script>
		<script type="text/javascript" src="js/superfish.js"></script>
		<script type="text/javascript">

		// initialise plugins
		jQuery(function(){
			jQuery('ul.sf-menu').superfish();
		});
		</script>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	</head>
    
	<body >
    

		<ul class="sf-menu">
			<li>
				<a href="../../nindex.htm">โปรแกรมโรงพยาบาล</a>
			</li>
            <li>
				<a href="ncf2.php">หน้าแรก NCR</a>
			</li>
			<li>
				<a href="#">ข้อมูลใบรายงานเหตุการณ์ฯ</a>
				<ul>
					<li>
						<a href="#">ใบรายงานที่ยังไม่ได้บันทึกระดับความรุนแรง</a>

					</li>
					<li>
						<a href="#">ใบรายงานที่บันทึกระดับความรุนแรงแล้ว</a>
						
					</li>
					<li>
						<a href="#">ใบรายงานที่ยังไม่ได้ลงโปรแกรม</a>
						
					</li>
					<li>
						<a href="ncf_listall.php">ใบรายงานทั้งหมด</a>
						
					</li>
				</ul>
			</li>
			<li>
				<a href="#">รายงานสรุป</a>
				<ul>
					<li>
						<a href="#">รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</a>

					</li>
					<li>
						<a href="#">หน่วยงานที่รายงานอุบัติการณ์</a>
						
					</li>
					<li>
						<a href="#">รายงานความคลาดเคลื่อนทางยา</a>
						
					</li>
				</ul>
                <?
		   if(!$_SESSION["Userncr"]){
		   ?>
                <li>
				<a href="login.php">ลงชื่อเข้าใช้</a>
			</li>
             <? 
		   }
			?>
           <?
		   if($_SESSION["statusncr"]){
		   ?>
            <li>
				<a href="ncf_member.php">รายชื่อผู้ใช้ในระบบ</a>
			</li>
            <li>
				<a href="logout.php">ออกจากระบบ</a>
			</li>
            <li>
				ผู้ใช้=<?=$_SESSION["Namencr"];?>
			</li>
            <? 
		   }
			?>
			</li>
		</ul>

	</body>
</html>