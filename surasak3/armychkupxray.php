<p align="center">����� Order XRAY ��Ǩ�آ�Ҿ���û�Шӻ� 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���͹���� Xray" />
</form>
</p>
<?		
if($_POST["act"]=="add"){
	include("connect.inc"); 
	//$sql="select hn,yot,ptname,age,gender from  chkup_solider where camp like 'D01 þ.��������ѡ��������%' and yearchkup='60' order by row_id asc";  //þ.��������ѡ��������
	$sql="SELECT hn, yot, ptname, age, gender
FROM chkup_solider
WHERE yearchkup = '60' AND (
camp
LIKE 'D31%'
) AND active = '' 
GROUP BY hn
ORDER BY camp ASC , chunyot ASC , yot DESC";
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	$n=0;
	while($rows=mysql_fetch_array($query)){	
	$n++;
	//echo $n.") ";
	
		$query1 = "SELECT runno FROM runno WHERE title = 'xrayno'";
		$result = mysql_query($query1) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nXray=$row->runno;	
		
		//xray_doctor
		$date="2559-11-25 02:00:00";
		//echo $date."<br>";
		$hn=$rows["hn"];
		$yot=$rows["yot"];
		$ptname=$rows["ptname"];
		$age=$rows["age"];
		list($name,$surname)=explode(" ",$ptname);
		$detail="1.CHEST CHECK UP";
		$doctor="MD022 (����Һᾷ��)";
		$xrayno=$nLab;
		$film="digital";
		$type_diag="��Ǩ�آ�Ҿ";
		$detail_all="1.CHEST CHECK UP";
		
		$query1 = "SELECT dbirth FROM opcard WHERE hn = '$hn'";
		$result = mysql_query($query1) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nDbirth=$row->dbirth;

		
		$dbirth=$nDbirth;
		
		$sql5="insert into xray_doctor set date='$date',
														  hn='$hn',
														  yot='$yot',
														  name='$name',
														  sname='$surname',
														  detail='$detail',
														  doctor='$doctor',
														  xrayno='$nXray',
														  film='$film',
														  type_diag='$type_diag',
														  detail_all='$detail_all',
														  dbirth='$dbirth',
														  orderby='XRAY'";
		//echo $sql5."<br>";
		$query5 = mysql_query($sql5) or die("Query failed xray_doctor");
		
		
		
		$doctor_detail="CHEST CHECK UP";
		$sql6="insert into xray_doctor_detail set date='$date',
														  hn='$hn',
														  xrayno='$nXray',
														  doctor_detail='$doctor_detail',
														  detail_all='$detail_all'";
		//echo $sql6."<br>";	
		$query6 = mysql_query($sql6) or die("Query failed xray_doctor_detail");			
		
		$ptright="R22 ��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��";
		$patient_from="OPD";
		$sql7="insert into xray_stat set date='$date',
														  hn='$hn',
														  ptname='$ptname',
														  age='$age',
														  ptright='$ptright',
														  patient_from='$patient_from',
														  detail='$detail',
														  doctor='$doctor',
														  digital='1',
														  10_12='0',
														  14_14='0',
														  NONE='0',
														  office='��ѳ�� ��þĵԾ���',
														  remark='170',
														  cancle='0'";
		//echo $sql7."<br>";
		$query7 = mysql_query($sql7) or die("Query failed xray_stat");															  
		//echo "************************************************<br>";
		
		
		
		
				
		$nXray++;
		$query3 ="UPDATE runno SET runno = $nXray WHERE title='xrayno'";
		$result3 = mysql_query($query3) or die("Query failed runno");
	}  //close while
	?>
    <script>alert('����� Order XRAY ���º�������� ��سһԴ˹�ҵ�ҧ��� !!!');window.close();</script>
    <?
}  //close if act=add
?>