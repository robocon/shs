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
	$sql3 = "select distinct(camp) as name from condxofyear_so where status_dr='Y' order by camp";
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
   		<tr><td><a target="_blank" href="report_tahan_cash.php?click=<?=$arrcamp[$m]?>&y=<?=$_POST['year']?>"><?=$arrcamp[$m]?></a></td><td align="center"><?=$sum?></td></tr>
    <?
        }
    ?>
</table>
	<?
}
elseif(isset($_GET['click'])){
	//$sql = "select * from condxofyear_so where status_dr='Y' group by camp";
	//$row = mysql_query($sql);
	//while($result2 = mysql_fetch_array($row)){
	echo "<span class='ppo'>".$_GET['click']."</span><br>";
	echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>����</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>BS</td><td align='center'>CHOL</td><td align='center'>TRIG</td><td align='center'>SGPT</td><td align='center'>SGOT</td><td align='center'>ALK</td><td align='center'>BUN</td><td align='center'>CREA</td><td align='center'>URIC</td><td align='center'>X-ray</td><td align='center'>�Ҥ����</td>";
	$sql2 = "select * from condxofyear_so where status_dr='Y' and camp like '%".$_GET['click']."%' and yearcheck='".$_GET['y']."' order by hn asc";
	$row2 = mysql_query($sql2);
	$numrow = mysql_num_rows($row2);
	$z=0;
	$p=0;
	$k=0;
	while($result = mysql_fetch_array($row2)){
		$sumall=0;
		$p++;
		$z++;
		$k++;
		echo "<tr valign='top'><td>".$z."</td><td>".$result['hn']."</td><td>".$result['ptname']."</td><td>".$result['age']."</td>";
		if($result['stat_ua']!=""){
			echo "<td align='center'>50</td>";
			$uaprice+=50;
			$sumall+=50;
		}else{
			echo "<td align='center'>0</td>";
			$uaprice+=0;
			$sumall+=0;
		}
		if($result['stat_cbc']!=""){
			echo "<td align='center'>90</td>";
			$cbcprice+=90;
			$sumall+=90;
		}else{
			echo "<td align='center'>0</td>";
			$cbcprice+=0;
			$sumall+=0;
		}
		if($result['stat_bs']!=""){//����ҹ
			if($result['stat_bs']=="�Դ����"){
				echo "<td align='center'>40</td>";
			}else{
				echo "<td align='center'>40</td>";
			}	
			$bsprice+=40;
			$sumall+=40;
		}
		else{
				echo "<td align='center'>0</td>";
				$bsprice+=0;
				$sumall+=0;
		}
		if($result['stat_chol']!=""){//��ѹ
			if($result['stat_chol']=="�Դ����"){
				echo "<td align='center'>60</td>";
			}else{
				echo "<td align='center'>60</td>";
			}
			$cholprice+=60;
			$sumall+=60;
		}
		else{
				echo "<td align='center'>0</td>";
				$cholprice+=0;
				$sumall+=0;
		}
		if($result['stat_tg']!=""){//��ѹ
			if($result['stat_tg']=="�Դ����"){
				echo "<td align='center'>60</td>";
			}else{
				echo "<td align='center'>60</td>";
			}
			$tgprice+=60;
			$sumall+=60;
		}
		else{
				echo "<td align='center'>0</td>";
				$tgprice+=0;
				$sumall+=0;
		}
		if($result['stat_sgpt']!=""){//�Ѻ
			if($result['stat_sgpt']=="�Դ����"){
				echo "<td align='center'>50</td>";
			}else{
				echo "<td align='center'>50</td>";
			}
			$sgptprice+=50;
			$sumall+=50;
		}else{
				echo "<td align='center'>0</td>";
				$sgptprice+=0;
				$sumall+=0;
		}
		if($result['stat_sgot']!=""){//�Ѻ
			if($result['stat_sgot']=="�Դ����"){
				echo "<td align='center'>50</td>";
			}else{
				echo "<td align='center'>50</td>";
			}
			$sgotprice+=50;
			$sumall+=50;
		}else{
				echo "<td align='center'>0</td>";
				$sgotprice+=0;
				$sumall+=0;
		}
		if($result['stat_alk']!=""){//�Ѻ
			if($result['stat_alk']=="�Դ����"){
				echo "<td align='center'>50</td>";
			}else{
				echo "<td align='center'>50</td>";
			}
			$alkprice+=50;
			$sumall+=50;
		}else{
				echo "<td align='center'>0</td>";
				$alkprice+=0;
				$sumall+=0;
		}
		if($result['stat_bun']!=""){//�
			if($result['stat_bun']=="�Դ����"){
				echo "<td align='center'>50</td>";
			}else{
				echo "<td align='center'>50</td>";
			}
			$bunprice+=50;
			$sumall+=50;
		}else{
				echo "<td align='center'>0</td>";
				$bunprice+=0;
				$sumall+=0;
		}
		if($result['stat_cr']!=""){//�
			if($result['stat_cr']=="�Դ����"){
				echo "<td align='center'>50</td>";
			}else{
				echo "<td align='center'>50</td>";
			}
			$crprice+=50;
			$sumall+=50;
		}else{
				echo "<td align='center'>0</td>";
				$crprice+=0;
				$sumall+=0;
		}
		if($result['stat_uric']!=""){//��ҷ�
			if($result['stat_uric']=="�Դ����"){
				echo "<td align='center'>60</td>";
			}else{
				echo "<td align='center'>60</td>";
			}	
			$uricprice+=60;
			$sumall+=60;
		}
		else{
				echo "<td align='center'>0</td>";
				$uricprice+=0;
				$sumall+=0;
		}
		
		if($result['cxr']!=""){
			echo "<td align='center'>170</td>";
			$cxrprice+=170;
			$sumall+=170;//����Թ���
		}
		else{
				echo "<td align='center'>0</td>";
				$cxrprice+=0;
				$sumall+=0;//����Թ���
		}
		echo "<td align='center'>".$sumall." </td>";
		echo "</tr>";
		if($k==$numrow){
			echo "<td colspan='4' align='center'>���</td>";
			echo "<td align='center'>".number_format($uaprice)."</td>";
			echo "<td align='center'>".number_format($cbcprice)."</td>";
			echo "<td align='center'>".number_format($bsprice)."</td>";
			echo "<td align='center'>".number_format($crprice)."</td>";
			echo "<td align='center'>".number_format($bunprice)."</td>";
			echo "<td align='center'>".number_format($cholprice)."</td>";
			echo "<td align='center'>".number_format($tgprice)."</td>";
			echo "<td align='center'>".number_format($sgotprice)."</td>";
			echo "<td align='center'>".number_format($sgptprice)."</td>";
			echo "<td align='center'>".number_format($alkprice)."</td>";
			echo "<td align='center'>".number_format($uricprice)."</td>";
			echo "<td align='center'>".number_format($cxrprice)."</td>";
			$sum = $cxrprice+$uaprice+$cbcprice+$bsprice+$crprice+$bunprice+$cholprice+$tgprice+$sgotprice+$sgptprice+$alkprice+$uricprice;
			echo "<td align='center'>".number_format($sum)."</td>";
		}
		if($p==50){
			echo "</table>";
			echo "<div style='page-break-after: always'></div>";
			echo "<table border=1 style='border-collapse:collapse' class='ppo' width='100%'>";
	echo "<td align='center'>#</td><td align='center'>HN</td><td align='center'>����-ʡ��</td><td align='center'>����</td><td align='center'>UA</td><td align='center'>CBC</td><td align='center'>BS</td><td align='center'>CHOL</td><td align='center'>TRIG</td><td align='center'>SGPT</td><td align='center'>SGOT</td><td align='center'>ALK</td><td align='center'>BUN</td><td align='center'>CREA</td><td align='center'>URIC</td><td align='center'>X-ray</td><td align='center'>�Ҥ����</td>";
			$p=0;
		}		
	}
	echo "</table>";
	//}
}
?>

</body>
</html>