<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�����Ţ  AN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; AN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="an" size="12" id="aLink" ></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>AN</th>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>����-ʡ��</th>
  <th bgcolor=CD853F>�Է��</th>
  <th bgcolor=CD853F>�Ѻ����</th>
  <th bgcolor=CD853F>��˹���</th>
  <th bgcolor=CD853F>�ä</th>
  <th bgcolor=CD853F>ᾷ��</th>
  <th bgcolor=CD853F>��§</th>
  <th bgcolor=CD853F>㺢������纻���</th>
  <th bgcolor=CD853F>ʶҹ�</th>
 
 </tr>

<?php
If (!empty($an)){
    include("connect.inc");
    global $hn;
    $query = "SELECT an,hn,ptname,ptright,date,dcdate,diag,doctor,bedcode,status_log FROM ipcard WHERE an = '$an'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($an,$hn,$ptname,$ptright,$date,$dcdate,$diag,$doctor,$bedcode,$status_log) = mysql_fetch_row ($result)) {
       

	    print "<tr>";
        print   "  <td BGCOLOR=F5DEB3>$an</a></td>";
        print   "  <td BGCOLOR=F5DEB3>$hn</td>";
   	    print      "  <td BGCOLOR=F5DEB3>$ptname</td>";
        print    "  <td BGCOLOR=F5DEB3>$ptright</a></td>";
        print     "  <td BGCOLOR=F5DEB3>$date</a></td>";
        print      "  <td BGCOLOR=F5DEB3>$dcdate</td>";
        print      "  <td BGCOLOR=F5DEB3>$diag</td>";
        print     "  <td BGCOLOR=F5DEB3>$doctor</td>";
        print    "  <td BGCOLOR=F5DEB3>$bedcode</td>";
    	print	  "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"insertanchkcash.php?Can=$an&Chn=$hn&Cdate=$date\">�����</td>";
 	    print	  "  <td BGCOLOR=F5DEB3>";  
		 
          if($status_log=='��˹���'){
		  ?>
        <a href="JavaScript:if(confirm('�׹�ѹ��ûŴ��ͤ')==true){ window.location='anchkcash.php?Can=<?=$an;?>&do=update';}">�Ŵ��ͤ������</a>
           <? 
	   }else{
		  print "�Ŵ��ͤ������";
	   }
       
		echo   "</td>";
        echo   " </tr>";
		
			     /// ��Ǩ�ͺ��� ��.���ʹ��ҧ�����������
  
  	$strsql="select * from accrued where hn='".$hn."' and status_pay='n' ";
	$strresult = mysql_query($strsql);
	$strrow=mysql_num_rows($strresult);


	if($strrow>0){
		echo "<script>alert('���������ʹ��ҧ���� ��سҵ�Ǩ�ͺ') </script>";
		echo "<br><br>&nbsp;&nbsp;&nbsp<b><font style='font-weight:bold'><a target=BLANK  href='accrued_list.php?hn=$hn'>���ʹ��ҧ����</a></b></font>";

	}
		
       }
	
	   
include("unconnect.inc");
       }
?>

</table>


<?
if($_REQUEST['do']=='update'){
	include("connect.inc");
	
	$update="UPDATE ipcard set status_log='' WHERE an='".$_REQUEST['Can']."'";
	$result1=mysql_query($update);
	
	if($result1){
		echo  "�Ŵ��ͤ���������º��������";
		echo  "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=anchkcash.php'>";	
	}
		
		include("unconnect.inc");
}
?>
