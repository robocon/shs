<?php
    session_start();
	include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.ppo {
	font-family: "TH SarabunPSK";
	font-size:14px;
}
.ppo1 {
	font-family: "TH SarabunPSK";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
-->
</style>
</head>
 
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
<table width="42%" border="0" align="center">
  <tr>
    <td align="center">��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.</td>
  </tr>
  <tr>
    <td align="center">
         
&nbsp;�� :
<select name="year">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="��ŧ" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	//$arrcamp = array('�����͹','�.17 �ѹ2','���ŷ��ú����32','�.�.��������ѡ��������','�.�ѹ4','���½֡ú����ɻ�еټ�','��.���.32','���.���.32','���.,���.���.32','�¡.���.32','���.���.32','���.���.32','���.���.32','���.���.32','�ʡ.���.32','����.���.32','���.���.32','͡.��� ���.32','����.���.32','���.���.32','�Ȩ.���.32','����.���.32','ʢ�.���.32','è.���.32','���.���.32','��.���.32','���.���.32','����.��.���.32','��.��.���.32','�ʾ.���.32','��þ���ѧ ���.32','Ƚ.�ȷ.���.32','���.���.32','�ٹ�����Ѿ�� ���.32','���.���.32','��ʴըѧ��Ѵ�ӻҧ','��.��ѧ ʻ.��','��� ��.33','˹��·�������','ͺ�.���ҧ');
	$arrcamp = array();
	$sql3 = "select distinct(camp) as name from condxofyear_so where status_dr = 'Y' order by camp";
	$row3 = mysql_query($sql3);
	while($result3 = mysql_fetch_array($row3)){
		array_push($arrcamp,$result3['name']);        
	}
	?>
    <table class='ppo1' border="1" style="border-collapse:collapse" align="center">
    <tr><td align="center">˹���</td><td align="center">�ӹǹ</td></tr>
    <?
    for($m=0;$m<count($arrcamp);$m++){
		$sql2 = "select count(*) as sum from condxofyear_so where status_dr='Y' and camp like '%".$arrcamp[$m]."%' and yearcheck='".$_POST['year']."'";
		$row2 = mysql_query($sql2);
		list($sum) = mysql_fetch_array($row2);
	?>
   		<tr><td><a target="_blank" href="report_tahan.php?click=<?=$arrcamp[$m]?>&y=<?=$_POST['year']?>"><?=$arrcamp[$m]?></a></td><td align="center"><?=$sum?></td></tr>
    <?
        }
    ?>
</table>
	<?
}
elseif(isset($_GET['click'])){
	echo "<span class='ppo'>".$_GET['click']."</span><br>";
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>����</td><td align='center'>���˹ѡ</td><td align='center'>��ǹ�٧</td><td align='center'>�ͺ���</td><td align='center'>T</td><td align='center'>P</td><td align='center'>BMI</td><td align='center'>BP</td><td align='center'>�ŵ�Ǩ��ҧ��·����</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>����ҹ</td><td align='center'>��ѹ</td><td align='center'>�Ѻ</td><td align='center'>�</td><td align='center'>��ҷ�</td><td align='center'>��ꡫ����</td><td align='center'>ᾷ��</td><td align='center'>��ػ�š�õ�Ǩ</td><td align='center'>Diag</td><td align='center'>�ѹ�֡�ҡᾷ��</td>";
	$sql2 = "select * from condxofyear_so where status_dr='Y' and camp like '%".$_GET['click']."%' and yearcheck='".$_GET['y']."' order by hn asc";
	$row2 = mysql_query($sql2);
	$numrow = mysql_num_rows($row2);
	$z=0;
	$p=0;
	while($result = mysql_fetch_array($row2)){
		$p++;
		$z++;
		echo "<tr valign='top'><td>".$z."</td><td>".$result['hn']."</td><td>".$result['ptname']."</td><td>".$result['age']."</td><td>".$result['weight']."</td><td>".$result['height']."</td><td>".$result['round_']."</td><td>".$result['temperature']."</td><td>".$result['pause']."</td><td>".$result['bmi']."</td><td>".$result['bp1']."/".$result['bp2']."</td><td>".$result['general']."<br>".$result['reason_general']."</td><td>".$result['stat_ua']."</td><td>".$result['stat_cbc']."</td>";
		if($result['stat_bs']!=""){//����ҹ
			if($result['stat_bs']=="�Դ����"){
				echo "<td>�Դ����</td>";
			}else{
				echo "<td>����</td>";
			}			
		}
		else{
				echo "<td>-</td>";
		}
		if($result['stat_chol']!=""||$result['stat_tg']!=""){//��ѹ
			if($result['stat_chol']=="�Դ����"||$result['stat_tg']=="�Դ����"){
				echo "<td>�Դ����</td>";
			}else{
				echo "<td>����</td>";
			}
		}
		else{
				echo "<td>-</td>";
		}
		if($result['stat_sgot']!=""||$result['stat_sgpt']!=""||$result['stat_alk']!=""){//�Ѻ
			if($result['stat_sgot']=="�Դ����"||$result['stat_sgpt']=="�Դ����"||$result['stat_alk']=="�Դ����"){
				echo "<td>�Դ����</td>";
			}else{
				echo "<td>����</td>";
			}
		}else{
				echo "<td>-</td>";
		}
		if($result['stat_bun']!=""||$result['stat_cr']!=""){//�
			if($result['stat_bun']=="�Դ����"||$result['stat_cr']=="�Դ����"){
				echo "<td>�Դ����</td>";
			}else{
				echo "<td>����</td>";
			}
		}else{
				echo "<td>-</td>";
		}
		if($result['stat_uric']!=""){//��ҷ�
			if($result['stat_uric']=="�Դ����"){
				echo "<td>�Դ����</td>";
			}else{
				echo "<td>����</td>";
			}			
		}
		else{
				echo "<td>-</td>";
		}
		echo "<td>".$result['cxr']."</td><td>".$result['doctor']." </td><td>".$result['summary']." </td><td>".$result['diag']." </td><td>".nl2br($result['dx'])." </td>";
		echo "</tr>";
		if($p==18){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>����</td><td align='center'>���˹ѡ</td><td align='center'>��ǹ�٧</td><td align='center'>�ͺ���</td><td align='center'>T</td><td align='center'>P</td><td align='center'>BMI</td><td align='center'>BP</td><td align='center'>�ŵ�Ǩ��ҧ��·����</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>����ҹ</td><td align='center'>��ѹ</td><td align='center'>�Ѻ</td><td align='center'>�</td><td align='center'>��ҷ�</td><td align='center'>��ꡫ����</td><td align='center'>ᾷ��</td><td align='center'>��ػ�š�õ�Ǩ</td><td align='center'>Diag</td><td align='center'>�ѹ�֡�ҡᾷ��</td>";
			$p=0;
		}		
	}
	echo "</table>";
	//}
}
?>

</body>
</html>