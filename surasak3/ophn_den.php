<?php
   session_start();
   
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>�����㺻���ѵԼ����·ҧ�ѹ����� �ҡ&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12" id="aLink"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>
<hr />
<? 
if (!empty($_POST['hn'])){
    include("connect.inc");


    $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '".$_POST['hn']."'";
    $result = mysql_query($query)or die("Query failed");
	
	
	$rows=mysql_num_rows($result);
	
	
	if($rows){

?>

<table>
 <tr>
  <th height="22" bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED width="70">��</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
  <th bgcolor=6495ED>�Է��</th>
<th bgcolor=6495ED>�����㺵�� ˹�� </th>
<th bgcolor=6495ED>�����㺵�� ��ѧ </th>
  </tr>

<?php



    while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {

        print (" <tr>\n".
           "  <td>$hn</td>\n".
           "  <td>$yot</td>\n".
           "  <td>$name</td>\n".
           "  <td>$surname</td>\n".
		   "  <td>$ptright</td>\n".
           "  <td  align='center'><a href='opdprint_den.php?hn=$hn' target=_blank>������ҹ˹��</a></td>\n".
		   "  <td  align='center'><a href='opdprint_den2.php?hn=$hn' target=_blank>������ҹ��ѧ</a></td>\n".
		 //   "  <td  align='center'>������ҹ��ѧ</td>\n".
           " </tr>\n");	   
	}

?>
</table>


<?
	}else{
		
	echo "<h4>��辺 HN </h4>";
	}

include("unconnect.inc");
       }
?>


