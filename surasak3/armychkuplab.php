<p align="center">����� Order Lab ��Ǩ�آ�Ҿ���û�Шӻ� 2560
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="������� ���͹���� Lab" />
</form>
</p>
<?
if($_POST["act"]=="add"){
	include("connect.inc"); 
	//$sql="select hn,yot,ptname,age,gender from  chkup_solider where camp like 'D01 þ.��������ѡ��������%' and yearchkup='60' order by row_id asc";  //þ.��������ѡ��������
	/*$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp = 'D02 ��� ��� ͡.��� ���.32' OR camp = 'D11 ���.���.32' OR camp = 'D12 ����.���.32' OR camp = 'D03 ���.���.32' OR camp = 'D08 ���.���.32' OR camp = 'D16 ��Ȩ.���.32' OR camp = 'D05 ���.���.32' OR camp = 'D06 �¡.���.32' OR camp = 'D07 ���.���.32' OR camp = 'D15 ���.���.32' OR camp = 'D10 �ʡ.���.32' OR camp = 'D27 �ʾ.���.32' OR camp = 'D28 ��.��.���.32' OR camp = 'D21 �ͧ è.���.32'
)
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //����Ѻ��Ǩ�ѹ��� 15-11-59*/

	/*$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (hn = '48-3474')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //����Ѻ��Ǩ�ѹ��� 16-11-59*/

/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (camp like 'D13%' and hn = '48-3471' || hn = '59-539' || hn = '54-11551' || hn = '47-6157')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";*/


/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D09%' OR camp like 'D22%' OR camp like 'D26%' OR camp like 'D35%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //����Ѻ��Ǩ�ѹ��� 17-11-59  100 ��*/

/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D23%' OR camp like 'D24%' OR camp like 'D20%' OR camp like 'D18%' OR camp like 'D14%' OR camp like 'D17%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //����Ѻ��Ǩ�ѹ��� 18-11-59  104 ��
*/
/*	$sql="select hn,yot,ptname,age,gender from  chkup_solider where yearchkup='60' AND (
camp like 'D04%' OR camp like 'D32%')
GROUP BY hn
ORDER BY camp ASC , chunyot ASC";  //����Ѻ��Ǩ�ѹ��� 21-11-59  108 ��*/

/*	$sql="SELECT hn, yot, ptname, age, gender
FROM chkup_solider
WHERE yearchkup = '60' AND (
camp
LIKE 'D30%'
) AND (
active = 'n' || active = ''
)
GROUP BY hn
ORDER BY camp ASC , chunyot ASC , yot DESC";  //����Ѻ��Ǩ�ѹ��� 23-11-59  187 ��*/

	$sql="SELECT hn, yot, ptname, age, gender
FROM chkup_solider
WHERE yearchkup = '60' AND (
camp
LIKE 'D31%'
) AND active = '' 
GROUP BY hn
ORDER BY camp ASC , chunyot ASC , yot DESC";  //����Ѻ��Ǩ�ѹ��� 25-11-59  58 ��
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	while($rows=mysql_fetch_array($query)){
	
		$dbirth="0000-00-00 00:00:00";
		
		$ptname=$rows["yot"]." ".$rows["ptname"];
		
		$query1 = "SELECT runno, startday FROM runno WHERE title = 'lab'";
		$result = mysql_query($query1) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nLab=$row->runno;
		$dLabdate=$row->startday;
		$dLabdate=substr($dLabdate,0,10);
		
		$Thidate2 = date("Y").date("-m-d H:i:s");
		$patienttype = "OPD";
		
		$clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�60";
		if($rows["gender"]=="1"){
			$gender = "M";
		}else{
			$gender="F";
		}
		
		$priority = "R";
		
		$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".date("ymd").sprintf("%03d", $nLab)."', '".$rows["hn"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (����Һᾷ��)', '".$priority."', '".$clinicalinfo."');";
		//echo $sql1."<br>";
		$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
		
		if($rows["age"] < 35){ 
			$arrlab=array('CBC','UA');
		}else{
			$arrlab=array('CBC','UA','BS','CHOL','TRI','HDL','BUN','CR','ALK','SGPT','SGOT','URIC');
		}
		
		foreach ($arrlab as $value) {
		   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
		   
			$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".date("ymd").sprintf("%03d", $nLab)."', '".$code."', '".$oldcode."', '".$detail."');";
			$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
			//echo "==>".$sql2."<br>";
		}
		
		$nLab++;
		$query3 ="UPDATE runno SET runno = $nLab, startday = '$dLabdate' WHERE title='lab'";
		$result3 = mysql_query($query3) or die("Query failed runno");	
		
	}  //close while
	?>
    <script>alert('����� Order Lab ���º�������� ��سһԴ˹�ҵ�ҧ��� !!!');window.close();</script>
    <?
}  //close if act=add
?>