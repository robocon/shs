<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<a href="../nindex.htm">&lt;&lt;-����</a> &nbsp;&nbsp;<a href="set_from_print.php" target="_blank">������ SET ��ҵѴ </a>
<? 
include("connect.inc");


$datenow=date("Y-m-d");

for($i=0;$i<=1;$i++){
	
	$tomorow=date('Y-m-d',strtotime("+$i day"));
	

$sqlnow="SELECT * FROM `set_or` WHERE date_surg='$tomorow' ";
$querynow=mysql_query($sqlnow);

$rownow=mysql_num_rows($querynow);

if($rownow){
	
	if($i==0){
?>

<h1 class="f1" style="font-family:'Angsana New'; font-size:16pt;" align="center">� SET ��ҵѴ �ѹ��� </h1>
<? 
	}else{
?>	
<h1 class="f1" style="font-family:'Angsana New'; font-size:16pt;" align="center">� SET ��ҵѴ ���觹�� </h1>	
	<?	
	}
?>
<table border="1" style="border-collapse:collapse; border-color:#000;font-family:'Angsana New'; font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#0099CC"><div align="center">�ͼ�����</div></td>
    <td bgcolor="#0099CC"><div align="center">�ѹ/��͹/��</div></td>
    <td bgcolor="#0099CC">����</td>
    <td bgcolor="#0099CC"><div align="center">hn</div></td>
    <td bgcolor="#0099CC"><div align="center">an</div></td>
    <td bgcolor="#0099CC"><div align="center">����-ʡ��</div></td>
    <td bgcolor="#0099CC"><div align="center">����</div></td>
    <td bgcolor="#0099CC"><div align="center">�Է��	</div></td>
    <td bgcolor="#0099CC"><div align="center">����ԹԨ���</div></td>
    <td bgcolor="#0099CC"><div align="center">��ü�ҵѴ</div></td>
    <td bgcolor="#0099CC"><div align="center">ᾷ��</div></td>
    <td bgcolor="#0099CC"><div align="center">��Դ����</div></td>
    <td bgcolor="#0099CC">�����˵�</td>
  </tr>
  <? 
  while($arr=mysql_fetch_array($querynow)){
	  
	  $exd=explode('-',$arr['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg=$exd[2].'-'.$exd[1].'-'.$exd[0];
  ?>
  <tr>
    <td><?=$arr['ward'];?></td>
    <td><strong>
      <?=$date_surg;?>
    </strong></td>
    <td><?=$arr['time'];?></td>
    <td><?=$arr['hn'];?></td>
    <td><?=$arr['an'];?></td>
    <td><?=$arr['ptname'];?></td>
    <td><?=$arr['age'];?></td>
    <td><?=$arr['ptright'];?></td>
    <td><?=$arr['diag'];?></td>
    <td><strong>
      <?=$arr['surg'];?>
    </strong></td>
    <td><?=$arr['doctor'];?></td>
    <td><?=$arr['inhalation_type'];?></td>
    <td><?=$arr['comment'];?></td>
  </tr>
  
  <?  } ?>
</table>

<? 
}
}
?>
<? 




$sqlGroup="SELECT substring(date_surg,1,7)as subdate FROM  `set_or` 
WHERE date_surg>='".$datenow."'
GROUP  BY subdate
ORDER  BY subdate ASC";
$queryGroup=mysql_query($sqlGroup);

while($arrG=mysql_fetch_array($queryGroup)){
	
	$sub1=explode('-',$arrG['subdate']);
	$sub1[0]=$sub1[0]+543;
	switch($sub1[1]){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}

 $dateshow=$printmonth." ".$sub1[0];
 
 $tomorow2=date('Y-m-d');
 $tomorow3=date('Y-m-d',strtotime("+1 day")); // �Ѻ�ӹǹ���� 1 �ѹ 
 

	$sql1="SELECT * FROM `set_or` WHERE  date_surg>='".$datenow."' and date_surg like '$arrG[subdate]%' AND (date_surg!='$tomorow2' and date_surg!='$tomorow3') order by date_surg asc";
	$query1=mysql_query($sql1);
?>

<h1 class="f1" style="font-family:'Angsana New'; font-size:16pt;" align="center">� SET ��ҵѴ  ��͹ <?=$dateshow;?></h1>
<table border="1" style="border-collapse:collapse; border-color:#000;font-family:'Angsana New'; font-size:16pt;" cellpadding="0" cellspacing="0" class="f1" align="center">
  <tr>
    <td bgcolor="#FFCCCC"><div align="center">�ͼ�����</div></td>
    <td bgcolor="#FFCCCC"><div align="center">�ѹ/��͹/��</div></td>
    <td bgcolor="#FFCCCC">����</td>
    <td bgcolor="#FFCCCC"><div align="center">hn</div></td>
    <td bgcolor="#FFCCCC"><div align="center">an</div></td>
    <td bgcolor="#FFCCCC"><div align="center">����-ʡ��</div></td>
    <td bgcolor="#FFCCCC"><div align="center">����</div></td>
    <td bgcolor="#FFCCCC"><div align="center">�Է��	</div></td>
    <td bgcolor="#FFCCCC"><div align="center">����ԹԨ���</div></td>
    <td bgcolor="#FFCCCC"><div align="center">��ü�ҵѴ</div></td>
    <td bgcolor="#FFCCCC"><div align="center">ᾷ��</div></td>
    <td bgcolor="#FFCCCC"><div align="center">��Դ����</div></td>
    <td bgcolor="#FFCCCC">�����˵�</td>
  </tr>
  <? 
  while($arr1=mysql_fetch_array($query1)){
	  
	   $exd=explode('-',$arr1['date_surg']);
	  $exd[0]=$exd[0]+543;
	  $date_surg2=$exd[2].'-'.$exd[1].'-'.$exd[0];
  ?>
  <tr>
    <td><?=$arr1['ward'];?></td>
    <td><strong>
      <?=$date_surg2;?>
    </strong></td>
    <td><?=$arr1['time'];?></td>
    <td><?=$arr1['hn'];?></td>
    <td><?=$arr1['an'];?></td>
    <td><?=$arr1['ptname'];?></td>
    <td><?=$arr1['age'];?></td>
    <td><?=$arr1['ptright'];?></td>
    <td><?=$arr1['diag'];?></td>
    <td><strong>
      <?=$arr1['surg'];?>
    </strong></td>
    <td><?=$arr1['doctor'];?></td>
    <td><?=$arr1['inhalation_type'];?></td>
    <td><?=$arr['comment'];?></td>
  </tr>
  
  <?  } ?>
</table>

<? } ?>