<p align="center">����� Order Lab �ѧ�Ѵ ��Ǩ�آ�Ҿ���û�Шӻ� 2561
<form name="form1" id="form1" method="post" action="<? $PHP_SELF; ?>">
<input name="act" type="hidden" value="add">   
<input name="Submit" type="submit" value="��ԡ����� ���͹���� Lab ��Ǩ�آ�Ҿ����" />
</form>
<p align="center" style="color:#FF0000; font-size:28px; font-weight:bold;">!!! ��ԡ��������� ੾���ѹ��� 26/11/60 ��ҹ��</p>
</p>
<?
if($_POST["act"]=="add"){
	include("connect.inc"); 
	$sql="SELECT *
FROM chkup_solider where (yearchkup='61' and active='' and camp != 'D01 þ.��������ѡ��������') order by  row_id asc";
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	//echo $num;
	while($rows=mysql_fetch_array($query)){
	
		list($d,$m,$y)=explode(" ",$rows["birthday"]);
		if($m=="���Ҥ�"){
			$mm="01";
		}else if($m=="����Ҿѹ��"){
			$mm="02";
		}else if($m=="�չҤ�"){
			$mm="03";
		}else if($m=="����¹"){
			$mm="04";
		}else if($m=="����Ҥ�"){
			$mm="05";
		}else if($m=="�Զع�¹"){
			$mm="06";
		}else if($m=="�á�Ҥ�"){
			$mm="07";
		}else if($m=="�ԧ�Ҥ�"){
			$mm="08";
		}else if($m=="�ѹ��¹"){
			$mm="09";
		}else if($m=="���Ҥ�"){
			$mm="10";
		}else if($m=="��Ȩԡ�¹"){
			$mm="11";
		}else if($m=="�ѹ�Ҥ�"){
			$mm="12";
		}
		
		
		
		
		$dbirth="$y-$mm-$d 00:00:00";  //ok
		
		$ptname=$rows["yot"]." ".$rows["ptname"];  //ok
		
		$Thidate2 = date("Y").date("-m-d H:i:s");  //ok
		$patienttype = "OPD";  //ok
		
		$clinicalinfo = "��Ǩ�آ�Ҿ��Шӻ�61";  //ok
		if($rows["gender"]=="1"){  //ok
			$gender = "M";
		}else{
			$gender="F";
		}
		
		$priority = "R";
		
		$sql1 = "INSERT INTO `orderhead` ( `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  ) VALUES ('', '".$Thidate2."', '".$rows["lab"]."', '".$rows["hn"]."', '".$patienttype."', '".$ptname."', '".$gender."', '".$dbirth."', '', '', '','".$cliniciancode."', 'MD022 (����Һᾷ��)', '".$priority."', '".$clinicalinfo."');";
		//echo "------------------------------------------------<br>";
		//echo $sql1."<br>";
		$result1 = mysql_query($sql1)or die("Query failed,INSERT orderhead ");
		
		if($rows["age"] < 35){ 
			$arrlab=array('CBC','UA');
		}else{
			$arrlab=array('CBC','UA','BS','CHOL','TRI','HDL','BUN','CR','ALK','SGPT','SGOT','URIC');
		}
		
		foreach ($arrlab as $value) {
		   list($code,$oldcode,$detail) = mysql_fetch_row(mysql_query("Select code,oldcode,detail From labcare where code = '".$value."' limit 0,1 "));   
		   
			$sql2 = "INSERT INTO `orderdetail` ( `labnumber` , `labcode`, `labcode1` , `labname` ) VALUES ('".$rows["lab"]."', '".$code."', '".$oldcode."', '".$detail."');";
			$result2 = mysql_query($sql2) or die("Query failed,INSERT orderdetail");
			//echo "==>".$sql2."<br>";
		}	
		
	}  //close while
	?>
    <script>alert('����� Order Lab ���º�������� ��سһԴ˹�ҵ�ҧ��� !!!');window.close();</script>
    <?
}  //close if act=add
?>