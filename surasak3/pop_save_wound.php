<CENTER><BR>
<?php

	if($_GET["hn"] == ""){
		
		echo "��س� ��͡ HN ";

	}else{
 include("connect.inc");
		$sql = "Select yot,  name,  surname, ptright From opcard where hn = '".$_GET["hn"]."'  limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);
			if($rows == 0){
				echo "����������Ţ HN ����ҹ�к�";
			}else{
				$arr = Mysql_fetch_assoc($result);
				echo $arr["yot"]," ",$arr["name"]," ",$arr["surname"],"<BR>";
				echo "�Է��� ",$arr["ptright"];
				Mysql_free_result($result);
			}

 include("unconnect.inc");
	}
	
?>
<BR><BR>
<A HREF="#" Onclick="window.close();">�Դ˹�ҹ��</A>
</CENTER>