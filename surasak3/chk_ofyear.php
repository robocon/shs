<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>


<form name="f1" method="post">
�кػ� <input name="yearcheck" value="" type="text" />

<br />��ǧ����
<select name="age">
<option value="">������</option>
<option value="1">���¡���35</option>
<option value="2">�ҡ����35</option>
</select>
<br />
<input name="b1" type="submit" value="��ŧ" />
</form>


<? 
if(isset($_POST['b1'])){
	
	include("connect.inc");
	
	if($_POST['age']==1){
		$where="and substring(age,1,2)<35";
	}else if($_POST['age']==2){
		$where="and substring(age,1,2)>35";
	}else{
		$where="";
	}
	
$sql="SELECT  distinct(camp)as camp,count(*) count 
FROM  `condxofyear_so`  WHERE  `yearcheck` = '".$_POST['yearcheck']."'  $where group by camp";

$query=mysql_query($sql)or die (mysql_error());
//echo $sql;

	?>
    <table  border="1" bordercolor="#000000" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
  <tr>
    <td rowspan="2" align="center">˹��·���㹤����Ѻ�Դ�ͺ</td>
    <td rowspan="2" align="center">�ӹǹ���ѧ�� (���)</td>
    <td colspan="2" align="center">�ӹǹ���ѧ�ŷ������Ѻ��õ�Ǩ</td>
    <td colspan="5" align="center">&nbsp;</td>
    <td rowspan="2" align="center">�����˵�</td>
    <td rowspan="2" align="center">�š�õ�Ǩ CBC �Դ���� <br />
      (���)</td>
    <td rowspan="2" align="center">�š�õ�Ǩ X-ray �ʹ<br />
      �Դ���� (���)</td>
    <td rowspan="2" align="center">�š�õ�Ǩ<br />
      ������мԴ���� <br />
    (���)</td>
    <td rowspan="2" align="center">����</td>
  </tr>
  <tr>
    <td align="center">�ӹǹ</td>
    <td align="center">������</td>
    <td align="center">����<br />
    (���)</td>
    <td align="center">���¡��һ���<br />
    (���)</td>
    <td align="center">���˹ѡ�Թ<br />
    (���)</td>
    <td align="center">��ǹ�дѺ1<br />
    (���)</td>
    <td align="center">��ǹ�дѺ2<br />
    (���)</td>
    </tr>
    <?

	while($arr=mysql_fetch_array($query)){
		
	$sql1="SELECT count(bmi) as bmi1 FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and  bmi < 18.5 and`yearcheck` = '".$_POST['yearcheck']."'  $where";
	$query1=mysql_query($sql1)or die (mysql_error());
	$arr1=mysql_fetch_array($query1)	;

	
	
	$sql2="SELECT count(bmi)as bmi2
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and ( bmi >=18.5 and bmi <=22.9) and `yearcheck` = '".$_POST['yearcheck']."' $where ";
	$query2=mysql_query($sql2)or die (mysql_error());
	$arr2=mysql_fetch_array($query2)	;
	
	
		$sql3="SELECT count(bmi)as bmi3
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and ( bmi >22.9 and bmi <=24.9) and `yearcheck` = '".$_POST['yearcheck']."'  $where";
	$query3=mysql_query($sql3)or die (mysql_error());
	$arr3=mysql_fetch_array($query3)	;
	
		$sql4="SELECT count(bmi)as bmi4
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and ( bmi >24.9 and bmi <=29.9) and `yearcheck` = '".$_POST['yearcheck']."'  $where";
	$query4=mysql_query($sql4)or die (mysql_error());
	$arr4=mysql_fetch_array($query4)	;
	
		
		$sql5="SELECT count(bmi)as bmi5
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and ( bmi >29.9) and `yearcheck` = '".$_POST['yearcheck']."'  $where";
	$query5=mysql_query($sql5)or die (mysql_error());	
	$arr5=mysql_fetch_array($query5)	;
	
	
	
			
		$sql6="SELECT count(bmi)as bmi6
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and stat_cbc ='�Դ����' and `yearcheck` = '".$_POST['yearcheck']."' $where ";
	$query6=mysql_query($sql6)or die (mysql_error());	
	$arr6=mysql_fetch_array($query6)	;
	
		$sql7="SELECT count(bmi)as bmi7
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and cxr ='�Դ����' and `yearcheck` = '".$_POST['yearcheck']."'  $where";
	$query7=mysql_query($sql7)or die (mysql_error());	
	$arr7=mysql_fetch_array($query7)	;
	
		$sql8="SELECT count(bmi)as bmi8
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and stat_ua ='�Դ����' and `yearcheck` = '".$_POST['yearcheck']."' $where ";
	$query8=mysql_query($sql8)or die (mysql_error());	
	$arr8=mysql_fetch_array($query8)	;
	
		$sql9="SELECT count(bmi)as bmi9
FROM `condxofyear_so` WHERE camp ='".$arr['camp']."' and summary ='����' and `yearcheck` = '".$_POST['yearcheck']."' $where ";
	$query9=mysql_query($sql9)or die (mysql_error());	
	$arr9=mysql_fetch_array($query9)	;
	
	
	//echo $sql9;
	
	
		//$avg=$arr['count']*100/
		//echo $sql2;
		
/*		if($arr2['bmi']<18.5){
			$bmi1++;
			
		}else if($arr2['bmi']>=18.5 && $arr2['bmi']<=22.9){
			$bmi2++;
		}else if($arr2['bmi']>=23 && $arr2['bmi']<=24.9){
			$bmi3++;
		}else if($arr2['bmi']>=25 && $arr2['bmi']<=29.9){
			$bmi4++;
		}else if($arr2['bmi']>=30){
			$bmi5++;
		}*/
		?>
  <tr>
    <td><?=$arr['camp'];?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$arr['count'];?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$arr2['bmi2'];?></td>
    <td align="center"><?=$arr1['bmi1'];?></td>
    <td align="center"><?=$arr3['bmi3'];?></td>
    <td align="center"><?=$arr4['bmi4'];?></td>
    <td align="center"><?=$arr5['bmi5'];?></td>
    <td align="center">&nbsp;</td>
    <td align="center"><?=$arr6['bmi6'];?></td>
    <td align="center"><?=$arr7['bmi7'];?></td>
    <td align="center"><?=$arr8['bmi8'];?></td>
    <td align="center"><?=$arr9['bmi9'];?></td>
  </tr>


    
        
        
<?


	}
	?>
    </table>
    <?
}
?>
</body>
</html>