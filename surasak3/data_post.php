<?
header("content-type: text/html; charset=tis-620");
header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header ("Cache-Control: no-cache, must-revalidate");
header ("Pragma: no-cache");
?>
<style type="text/css">
<!--
.txtsarabun {	font-family: "TH SarabunPSK";
	font-size: 16px;
}
-->
</style>
<?
include("connect.inc");   
          
$data = $_GET['data'];  //type
$val = $_GET['val'];  // id
$datar = $_GET['datar'];  //type
$valr = $_GET['valr'];  // id

     if ($data=='type') { 
		 $val = substr($_GET['val'],0,3);  // id
		  echo "<select name='subgroup' class='txtsarabun'>\n";
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
          echo "<select name='doctor' onChange=\"dochange('clinic', this.value)\" class='txtsarabun'>\n";
          echo "<option value='0'>--------------- ���͡ᾷ�� ---------------</option>\n";
          $result=mysql_query("select * from doctor where status='y' ORDER BY opdstatus DESC , row_id ASC");
          while($row = mysql_fetch_array($result)){
               echo "<option value=\"$row[row_id]\" >$row[name]</option> \n" ;
          }
	}
	echo "</select>\n";
	
	
	if($data=='clinic' && $datar =='room'){
		echo "<select name='clinic' class='txtsarabun'>\n";
		echo "<option value='0'>----- ���͡��չԤ -----</option>\n"; 
		$result=mysql_query("SELECT * FROM doctor WHERE status='y' and row_id= '$val'");
			while($row = mysql_fetch_array($result)){
					echo "<option value=\"$row[clinic]\" selected=\"selected\">$row[clinic]</option> \n" ;
			}
		$result1=mysql_query("SELECT * FROM clinic");
			while($row1 = mysql_fetch_array($result1)){
					echo "<option value=\"$row1[detail]\">$row1[detail]</option> \n" ;
			}				
		}			  
		echo "</select>\n";
	
	if($data=='clinic' && $datar =='room'){
		 echo "<select name='room' class='txtsarabun'>\n";
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