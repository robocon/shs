<?
header("content-type: text/html; charset=tis-620");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");

include("connect.inc");   
          
$data = $_GET['data'];  //type
$val = $_GET['val'];  // id
$datar = $_GET['datar'];  //type
$valr = $_GET['valr'];  // id

     if ($data=='type') { 
		 $val = substr($_GET['val'],0,3);  // id
		  echo "<select name='subgroup'>\n";
		  if($val =="G40"){
               echo "<option value=\"(�) �Դ���ôҢͧ������������ҷ��١��ͧ��������¢ͧ���ѧ�� ��.\" >�Դ���ôҢͧ������������ҷ��١��ͧ��������¢ͧ���ѧ�� ��.</option> \n" ;
			   echo "<option value=\"(�) ����ͧ�����Դ���ô����ǡѹ�ͧ���ѧ�� ��.\" >����ͧ�����Դ���ô����ǡѹ�ͧ���ѧ�� ��.</option> \n" ;
			   echo "<option value=\"(�) ��� ��� �� ��� �ͧ���ѧ�� ��.��� ������������ҷ��١��ͧ���������\" >��� ��� �� ��� �ͧ���ѧ�� ��.��� ������������ҷ��١��ͧ���������</option> \n" ;
			   echo "<option value=\"(�) �ا ��� ��� �� �ͧ���ѧ�� ��.��� ������������ҷ��١��ͧ���������\" >�ا ��� ��� �� �ͧ���ѧ�� ��.��� ������������ҷ��١��ͧ���������</option> \n" ;
		}else{
          echo "<option value=''>-------------- ����ͧ���͡������ --------------</option>\n";	
		}
	}
     echo "</select>\n";
	 
	if($data=='doctor') { 
          echo "<select name='doctor' onChange=\"dochange('clinic', this.value)\">\n";
          echo "<option value='0'>--------------- ���͡ᾷ�� ---------------</option>\n";
          $result=mysql_query("select * from doctor where status='y' ORDER BY opdstatus DESC , row_id ASC");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[row_id]\" >$row[name]</option> \n" ;
          }
	}
	echo "</select>\n";
	
	
	if($data=='clinic' && $datar =='room'){
		echo "<select name='clinic'>\n";
		echo "<option value='0'>----- ���͡��չԤ -----</option>\n"; 
		$result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$val'");
			while($row = mysql_fetch_array($result)){
					echo "<option value=\"$row[position]\" selected=\"selected\">$row[position]</option> \n" ;
			}
			echo " <option value='99 �Ǫ��Ժѵ�'>�Ǫ��Ժѵ�</option>";
			echo " <option value='01 ����á���'>����á���</option>";
			echo " <option value='02 ���¡���'>���¡���</option>";
			echo " <option value='03 �ٵԡ���'>�ٵԡ���</option>";
			echo " <option value='04 �����Ǫ����'>�����Ǫ����</option>";
			echo " <option value='05 ������Ǫ'>������Ǫ</option>";
			echo " <option value='06 �ʵ �� ���ԡ'>�ʵ �� ���ԡ</option>";
			echo " <option value='07 �ѡ��'>�ѡ��</option>";
			echo " <option value='08 ���¡�����д١'>���¡�����дء</option>";
			echo " <option value='09 �Ե�Ǫ'>�Ե�Ǫ</option>";
			echo " <option value='10 �ѧ���Է��'>�ѧ���Է��</option>";
			echo " <option value='11 �ѹ�����'>�ѹ�����</option>";
			echo " <option value='12 �ء�Թ'>�ء�Թ</option>";
			echo " <option value='13 ����Ҿ�ӺѴ'>����Ҿ�ӺѴ</option>";
			echo " <option value='14 ᾷ��Ἱ��'>ᾷ��Ἱ��</option>";
			echo " <option value='15 PCU � þ.'>PCU � þ.</option>";
			echo " <option value='01 ��Թԡ COPD'>��Թԡ COPD</option>";
			echo " <option value='99 ���¡����ҧ�Թ�������'>���¡����ҧ�Թ�������</option>";
			echo " <option value='16 ��Թԡ�ä�'>��Թԡ�ä�</option>";
			echo " <option value='99 ����'>����</option>";
					if($_SESSION["smenucode"] != "ADMMAINOPD"){
					echo " <option value='14 �Ǫ��ʵ���鹿�'>�Ǫ��ʵ���鹿�</option>";
					}
					echo " <option value='99 ����'>����</option>";					
		}			  
		echo "</select>\n";
	
	if($data=='clinic' && $datar =='room'){
		 echo "<select name='room'>\n";
		echo "<option value='0'>----- ���͡��ͧ -----</option>\n"; 
		 $result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$valr'");
		 while($row = mysql_fetch_array($result)){
		   echo "<option value=\"$row[room]\" selected=\"selected\">$row[room]</option> \n" ;
		 }
		 echo "<option value='��ͧ��Ǩ੾���ä'>��ͧ��Ǩ੾���ä</option>\n"; 		 
		 echo "<option value='��ͧ 1'>��ͧ 1</option>\n";
		 echo "<option value='��ͧ 2'>��ͧ 2</option>\n";
		 echo "<option value='��ͧ 3'>��ͧ 3</option>\n";
		 echo "<option value='��ͧ 4'>��ͧ 4</option>\n";
		 echo "<option value='��ͧ 5'>��ͧ 5</option>\n";
		 echo "<option value='��ͧ 6'>��ͧ 6</option>\n";
		 echo "<option value='��ͧ 7'>��ͧ 7</option>\n";
		 echo "<option value='��ͧ 8'>��ͧ 8</option>\n"; 	 	
		 echo "<option value='��ͧ 9'>��ͧ 9</option>\n"; 	 
		 echo "<option value='��ͧ 10'>��ͧ 10</option>\n";	 
		 echo "<option value='��ͧ ...............'>��ͧ .............</option>\n"; 	 	 
	}			  
	echo "</select>\n";
		
	
?>