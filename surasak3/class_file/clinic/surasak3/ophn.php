<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("cAge");  
    session_unregister("nRunno");  
    session_unregister("vAN");
    session_unregister("thdatehn");  
    session_unregister("cNote");  
	 session_unregister("Ptright1");
//    session_destroy();
?>


<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>���Ҥ���ҡ&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12" id="aLink"></p>
<script type="text/javascript">
document.getElementById('aLink').focus();
</script>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>


<table>
 <tr>
  <th height="22" bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED width="70">��</th>
  <th bgcolor=6495ED>����</th>
   
  <th bgcolor=6495ED>ʡ��</th>
  <th bgcolor=6495ED>�Է��</th>
<th bgcolor=6495ED>�� þ.</th>
  <th bgcolor=6495ED>��Ǩ�͹</th>
 <th bgcolor=6495ED>㺵��</th>
<!-- <th bgcolor=6495ED>��ҹ͡</th>
 <th bgcolor=6495ED>������</th>
 <th bgcolor=6495ED>㺵�Ǩ�ä</th>-->
  <th bgcolor=6495ED colspan="5">㺵�Ǩ�ä</th>
  </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$ptright,$ptright1,$idcard) = mysql_fetch_row ($result)) {
		
	

		if(substr($ptright,0,3)=='R07' && !empty($idcard)){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#CCFF00";
			}else{
				$color = "FF8C8C";
			}
		}else if(substr($ptright,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "99CC00";
			}else{
				$color = "FF8C8C";
			}
		}else{
			$color = "66CDAA";
		}




        print (" <tr>\n".
           "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opedit.php? cHn=$hn & cName=$name &cSurname=$surname\">$hn</a></td>\n".
           "  <td BGCOLOR=".$color.">$yot</td>\n".
           "  <td BGCOLOR=".$color.">$name</td>\n".
           "  <td BGCOLOR=".$color.">$surname</td>\n".
			   "  <td BGCOLOR=".$color.">$ptright</td>\n".
 "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">�� þ.</td>\n".
         "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">��Ǩ�Ѵ</td>\n".
   // "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹</td>\n".
"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"opdprint2.php?cHn=$hn\">㺵��</td>\n".
	/*"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$hn\">��ҹ͡</td>\n".
	"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">�����¹Ѵ</td>\n".
"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$hn\">㺵�Ǩ�ä</td>\n".*/
	"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointhdvn.php?cHn=$hn\">�</td>\n".
  "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointdenvn.php?cHn=$hn\">�ѹ</td>\n".
  "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointeyevn.php?cHn=$hn\">��</td>\n".
"  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appointbgvn.php?cHn=$hn\">�ٵ�</td>\n".
  "  <td BGCOLOR=".$color." align='center'><a target= _BLANK href=\"rg_appoint.php?cHn=$hn\">��.�Ѵ</td>\n".
  
  

           " </tr>\n");
		   $_SESSION['hn']=$hn;
		   $_SESSION['name']=$name;
		   $_SESSION['surname']=$surname;
		   
	}
	
	

	$sql1="SELECT  * FROM opcard
where name='".$_SESSION['name']."' and surname='".$_SESSION['surname']."' and hn !='". $_SESSION['hn']."' ";
	$result1 = mysql_query($sql1);
	$rows1=mysql_num_rows($result1);
	if($rows1){
	 echo "<font color='#FF0000'>���</font>";
	}

	
// ��Ǩ�ͺ�������¹ HN AN �͹��鹻�����
	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_hn != $year_now){
		$sql = "Update runno set prefix = '".$year_now."-', runno = 0 where  title = 'HN' limit 1;";
		$result = mysql_Query($sql);
	}
	$sql = "Select left(prefix,2) From runno where title = 'AN' ";
	list($title_an) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_an != $year_now){
		$sql = "Update runno set prefix = '".$year_now."/', runno = 0 where  title = 'AN' limit 1;";
		$result = mysql_Query($sql);
	}
	// END

?>
</table>
<FONT SIZE="2" COLOR="#990000">***��͸Ժ��***</FONT> <BR>
<FONT SIZE="" COLOR="66CDAA">������ ��� �ѧ�����ӡ�õ�Ǩ�Է�ԡ���ѡ��</FONT><BR>
<FONT SIZE="" COLOR="#CCFF00">��������͹ ��� ��Ǩ�ͺ���� ���Է�Ի�Сѹ�ѧ��</FONT><BR>
<FONT SIZE="" COLOR="#99CC00">��������͹ ��� ��Ǩ�ͺ���� ���Է�Ԩ��µç</FONT><BR>
<FONT SIZE="" COLOR="#FF0033">��ᴧ ��� ������Է��</FONT><BR>

<hr />


<?
/////////////


	$sql_chkname="SELECT  * FROM opcard
where name='".$_SESSION['name']."' and surname='".$_SESSION['surname']."' and hn !='". $_SESSION['hn']."'  limit 5";
	$result_chkname = mysql_query($sql_chkname);
	$rows=mysql_num_rows($result_chkname);
	
	if($rows){	
?>


<h2><font color="#FF0000">����͹</font></h2>
<h3>�ռ����� ����  <?= $_SESSION['name']?> <?=$_SESSION['surname'];?>  ��� ��к�����¹</h3>
<h3>��سҵ�Ǩ�ͺ������</h3>
<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>��</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
  <th bgcolor=6495ED>�Է��</th>
 <th bgcolor=6495ED>�� þ.</th>
  <th bgcolor=6495ED>��Ǩ�͹</th>
 <th bgcolor=6495ED>㺵��</th>
 <th bgcolor=6495ED>��ҹ͡</th>
 <th bgcolor=6495ED>������</th>
 <th bgcolor=6495ED>㺵�Ǩ�ä</th>
 </tr>
<?
	while($dbarr= mysql_fetch_array($result_chkname)){

	print (" <tr>\n".
           "  <td BGCOLOR=".$color."><a target=_BLANK  href=\"opedit.php? cHn=$dbarr[hn] & cName=$dbarr[name] &cSurname=$dbarr[surname]\">$dbarr[hn]</a></td>\n".
           "  <td BGCOLOR=".$color.">$dbarr[yot]</td>\n".
           "  <td BGCOLOR=".$color.">$dbarr[name]</td>\n".
           "  <td BGCOLOR=".$color.">$dbarr[surname]</td>\n".
			   "  <td BGCOLOR=".$color.">$dbarr[ptright]</td>\n".
 "  <td BGCOLOR=".$color."><a target= _BLANK href=\"hndaycheck.php?hn=$dbarr[hn]\">�� þ.</td>\n".
         "  <td BGCOLOR=".$color."><a target= _BLANK href=\"appdaycheck.php?hn=$dbarr[hn]\">��Ǩ�Ѵ</td>\n".
   // "  <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹</td>\n".
"  <td BGCOLOR=".$color."><a target= _BLANK href=\"opdprint2.php?cHn=$dbarr[hn]\">㺵��</td>\n".
	"  <td BGCOLOR=".$color."><a target= _BLANK href=\"edprint.php?cHn=$dbarr[hn]\">��ҹ͡</td>\n".
	"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint.php?cHn=$dbarr[hn]\">�����¹Ѵ</td>\n".
"  <td BGCOLOR=".$color."><a target= _BLANK href=\"rg_appoint1.php?cHn=$dbarr[hn]\">㺵�Ǩ�ä</td>\n".
 
           " </tr>\n");  
	}
}
session_unregister("hn");
session_unregister("name");
session_unregister("surname");


       }
?>
</table>

