<?
if($_GET['okbtn']=="true"){
	include("connect.inc");
	$trunc = "TRUNCATE TABLE ssodata";
	$result = mysql_query($trunc);
	if($result){
		$dd = mktime(0,0,0,date("m"),date("d")+3,date("Y"));
		$end_date=(date("Y")+543).date("-m-d",$dd);
	
		$insert = "LOAD DATA INFILE '/var/www/html/sm3/surasak3/dataupdate/hospdbon.TXT' replace INTO TABLE ssodata   FIELDS TERMINATED BY ''  ";
	//echo $insert;
		$result2 = mysql_query($insert) or die (mysql_error());
		if($result2){
			echo "��Ѻ��ا�������Է�Ի�Сѹ�ѧ�����º�������� ���ѧ��Ѻ˹���á";
			$insert2 = "insert into new (depart,new,datetime,status,user,date,numday) values ('�ٹ���ԡ�ä���������','�ٹ���ԡ�ä��� ��ӡ���Ѿഷ�����Ż�Сѹ�ѧ�����Ǥ��','".date("d/m")."/".(date("Y")+543)."','Y','".$_SESSION['sOfficer']."','".(date("Y")+543)."/".date("m/d H:i:s")."','".$end_date."')";
			mysql_query($insert2);
			echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=../nindex.htm'>";	
			echo "<br><br><a href ='../nindex.htm' >&lt;&lt; �����</a>";
		}
	}
}else{
?>
<a href ="../nindex.htm" >&lt;&lt; �����</a><br>
<center>
  <font style="font-size:30px; font-family:AngsanaUPC;">2. �׹�ѹ��û�Ѻ��ا�������Է�Ի�Сѹ�ѧ��</font><br />
<font style="font-size:40px; font-family:AngsanaUPC;"><a href="truncatesso.php?okbtn=true">��ŧ</a></font></center>
<?
}
?>