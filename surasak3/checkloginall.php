<?php
	session_start();
	if(empty($sOfficer) || $_SESSION["sOfficer"] == ""){
		?>
		<script>
        	alert("Login �ͧ��ҹ������� ��س� Login �����/n����ջѭ�ҡ����ҹ �Դ��� 6206 ��");
        </script>
		<?
		//echo "�����¤�Ѻ��� Login �ͧ��ҹ�������1<BR> <A HREF=\"..\\sm3.php\">&lt;&lt; ��Ѻ˹����ѡ</A>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=..\sm3.php\"  target='_parent'>";

	
	}else{
		$ServerName = "localhost";
		$DatabaseName = "smdb";
		$User = "root"; 
		$Password = "1234";
		
		//�Դ��͡Ѻ�ҹ�����ż�ҹ�ѧ��ѹ MySQL
		$Conn = mysql_connect($ServerName,$User,$Password) or die ("�������ö�Դ��͡Ѻ����������� ");
		
		//���͡���Ͱҹ������ ��� smdb
		mysql_select_db($DatabaseName,$Conn) or die ("�������ö�Դ��͡Ѻ�ҹ��������");
	}

?>