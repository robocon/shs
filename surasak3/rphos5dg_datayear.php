<?php
    include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<body>
<p><a target="_top"  href="../nindex.htm">��Ѻ���������ѡ</a> || <a href="rphos5dg_addstartdata.php" target="_blank">�ѹ�֡��¡�õ�駵�</a> || <a href="rphos5dg_editgetdate.php" target="_blank">����ѹ��� þ.5</a> || <a href="rphos5dg_printmountnew.php" target="_blank">��§ҹ þ.5 ��Ш���͹</a></p>
<p align="center"><strong>�ѹ�֡��§ҹ þ.5 ��Ш���͹</strong></p>
<form name="form1" action="<? $_SERVER['PHP_SELF']?>" method="post">
<input name="act" type="hidden" value="search" />
<p style="margin-left: 480px;"><label>������ : </label>
<input name="drugcode" type="text" />
</p>
<p style="margin-left: 480px;"><label>�� �.�. : </label>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?> 
 </p>
 <p style="margin-left:540px;"><input name="submit" type="submit" value="��ŧ" />
 </p>
</form>
<?
if($_POST["act"]=="search"){
	if(empty($_POST["drugcode"])){
		echo "<script>alert('�Դ��Ҵ ��س��к�������');</script>";
	}else{
		$sql="select drugcode from druglst where drugcode='$_POST[drugcode]'";
		//echo $sql;
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		if($num < 1){
			echo "<script>alert('�Դ��Ҵ ���������١��ͧ');</script>";
		}else{
			$drugcode=$_POST["drugcode"];
			$mount=$_POST['mon'];
			$year=$_POST['year'];
			$datedel="$year";
			$datechk="$year-01-01";
			$datestart="$year-01-01 00:00:00";
			$dateend="$year-12-31 23:59:59";
			
			$result=mysql_query("delete from drugrp5 where drugcode='$drugcode' and getdate like '$datedel%'");
			
			$sql1="select * from drugstartrp5 where drugcode='$drugcode' and getdate = '$datechk' ORDER BY getdate DESC Limit 1";
			$query1=mysql_query($sql1);
			$num1=mysql_num_rows($query1);
			$rows1=mysql_fetch_array($query1);	
			if($num == 1){				
				$add1="insert into drugrp5 set getdate='$datechk',
																drugcode='$rows1[drugcode]',
																tradname='$rows1[tradname]',
																detail='$rows1[detail]',
																rest_unitprice='$rows1[rest_unitprice]',
																rest_num='$rows1[rest_num]',
																rest_price='$rows1[rest_price]'";
				if(mysql_query($add1)){  //�ѹ�֡�ʹ¡��
					echo "<script>alert('�ѹ�֡������������ : $drugcode ��������');</script>";
					$lastid=mysql_insert_id();
					$sql2="select * from stktranx where active!='N' and drugcode='$drugcode' and (getdate between '$datestart' and '$dateend') order by getdate asc";
					//echo $sql2;
					$query2=mysql_query($sql2);
					$num2=mysql_num_rows($query2);	
								
					if($num2 > 0){
						while($rows2=mysql_fetch_array($query2)){
						$result1 = "select stkno from combill where billno = '$rows2[billno]'";
						$row1 = mysql_query($result1);
						list($stkno)=mysql_fetch_array($row1);	
												
						if($rows2["stkcut"]==0){
						$sql3="select rest_num from drugrp5 where row_id='$lastid'";
						//echo $sql3;
						$query3=mysql_query($sql3);
						list($rest_num)=mysql_fetch_array($query3);
						
						$restnum=$rows2["amount"]+$rest_num;
						$drugprice=$rows2["unitpri"]*$rows2["amount"];
						$restprice=$rows2["unitpri"]*$restnum;
						$add2="insert into drugrp5 set getdate='$rows2[getdate]',
																		drugcode='$rows2[drugcode]',
																		tradname='$rows2[tradname]',
																		billno='$rows2[billno]',
																		detail='$rows2[department]',
																		stkno='$stkno',
																		drug_unitprice='$rows2[unitpri]',
																		drug_num='$rows2[amount]',
																		drug_price='$drugprice',
																		rest_unitprice='$rows2[unitpri]',
																		rest_num='$restnum',
																		rest_price='$restprice'";		
							mysql_query($add2);  //�ѹ�֡�Ѻ��	
							$lastid=mysql_insert_id();																
						}else{
						$lastid=mysql_insert_id();
						$sql3="select rest_num from drugrp5 where row_id='$lastid'";
						//echo $sql3;
						$query3=mysql_query($sql3);
						list($rest_num)=mysql_fetch_array($query3);
						
						$restnum=$rest_num-$rows2["stkcut"];				
						$payprice=$rows2["unitpri"]*$rows2["stkcut"];
						$restprice=$rows2["unitpri"]*$restnum;
						$add2="insert into drugrp5 set getdate='$rows2[getdate]',
																		drugcode='$rows2[drugcode]',
																		tradname='$rows2[tradname]',
																		billno='$rows2[billno]',
																		detail='$rows2[department]',
																		stkno='$stkno',
																		pay_unitprice='$rows2[unitpri]',
																		pay_num='$rows2[stkcut]',
																		pay_price='$payprice',
																		rest_unitprice='$rows2[unitpri]',
																		rest_num='$restnum',
																		rest_price='$restprice'";
							mysql_query($add2);  //�ѹ�֡������	
							$lastid=mysql_insert_id();			
						}																		
						}  //close while				
					}  //close if num
				}															
			}
		}
	}
}
?>
</body>

</html>
