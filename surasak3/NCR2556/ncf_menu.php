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
				<a href="../../nindex.htm">������ç��Һ��</a>
			</li>
            <li>
				<a href="ncf2.php">˹���á NCR</a>
			</li>
			<li>
				<a href="#">���������§ҹ�˵ء�ó��</a>
				<ul>
					<li>
						<a href="#">���§ҹ����ѧ�����ѹ�֡�дѺ�����ع�ç</a>

					</li>
					<li>
						<a href="#">���§ҹ���ѹ�֡�дѺ�����ع�ç����</a>
						
					</li>
					<li>
						<a href="#">���§ҹ����ѧ�����ŧ�����</a>
						
					</li>
					<li>
						<a href="ncf_listall.php">���§ҹ������</a>
						
					</li>
				</ul>
			</li>
			<li>
				<a href="#">��§ҹ��ػ</a>
				<ul>
					<li>
						<a href="#">��§ҹ��ػ�غѵԡ�ó��ṡ��������</a>

					</li>
					<li>
						<a href="#">˹��§ҹ�����§ҹ�غѵԡ�ó�</a>
						
					</li>
					<li>
						<a href="#">��§ҹ������Ҵ����͹�ҧ��</a>
						
					</li>
				</ul>
                <?
		   if(!$_SESSION["Userncr"]){
		   ?>
                <li>
				<a href="login.php">ŧ���������</a>
			</li>
             <? 
		   }
			?>
           <?
		   if($_SESSION["statusncr"]){
		   ?>
            <li>
				<a href="ncf_member.php">��ª��ͼ������к�</a>
			</li>
            <li>
				<a href="logout.php">�͡�ҡ�к�</a>
			</li>
            <li>
				�����=<?=$_SESSION["Namencr"];?>
			</li>
            <? 
		   }
			?>
			</li>
		</ul>

	</body>
</html>