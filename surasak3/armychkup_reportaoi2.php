<?
session_start();
//if (isset($sIdname)){} else {die;} //for security
include("connect.inc");
		$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
		$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		$nPrefix=$row->prefix;
		$newPrefix="25".$nPrefix;
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#FF9999"><strong>�ӴѺ</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#FF9999"><strong>����-���ʡ��</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�ѧ�Ѵ</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>����</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>���˹ѡ</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>��ǹ�٧</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BMI</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>����ͺ��� (����)</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�Ѵ % ����˹ѧ (Fat Mass)</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�Ѵ % ����˹ѧ (Muscle Mass)</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š���Ѵ % ����˹ѧ</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�Ѵ�ç�պ���</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š�÷��ͺ/���˹ѡ���</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š���Ѵ�ç�պ���</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�Ѵ�ç����´��</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š�÷��ͺ/���˹ѡ���</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š���Ѵ�ç����´��</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�վ�á�͹���ͺ 3 minute step test</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�վ�������ҧ���ͺ 3 minute step test</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�վ����ѧ���ͺ 3 minute step test</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>�š�÷��ͺ 3 minute step test</strong></td>
  </tr>
<?
		$sql = "select * from armychkup where status_print ='1' and typechkup!='out' and yearchkup='$nPrefix' and camp !='' and camp !='D34 ���.33' group by hn order by camp asc,chunyot asc, age desc";
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["yot"]." ".$result["ptname"];
		$age=$result["age"];
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=substr($result["camp"],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$result["weight"];?></td>
    <td align="center"><?=$result["height"];?></td>
    <td align="center">
      <?=$result["bmi"];?>    </td>
    <td align="center"><? if(empty($result["waist"]) || $result["waist"]==0){ echo "&nbsp;";}else{ echo $result["waist"];}?></td>
    <td align="center"><? if(empty($result["fat_mass"]) || $result["fat_mass"]==0){ echo "&nbsp;";}else{ echo $result["fat_mass"];}?></td>
    <td align="center"><? if(empty($result["muscle_mass"]) || $result["muscle_mass"]==0){ echo "&nbsp;";}else{ echo $result["muscle_mass"];}?></td>
    <td align="center">
      <? if($result["result_fat"]=="1"){ echo "���";}else if($result["result_fat"]=="2"){ echo "��͹��ҧ���";}else if($result["result_fat"]=="3"){ echo "����ǹ";}else if($result["result_fat"]=="4"){ echo "��͹��ҧ��ǹ";}else if($result["result_fat"]=="5"){ echo "��ǹ";}?></td>
    <td align="center"><? if(empty($result["hand1"]) || $result["hand1"]==0){ echo "&nbsp;";}else{ echo $result["hand1"];}?></td>
    <td align="center"><? if(empty($result["hand2"]) || $result["hand2"]==0){ echo "&nbsp;";}else{ echo $result["hand2"];}?></td>
    <td align="center"><? if($result["result_hand"]=="1"){ echo "���";}else if($result["result_hand"]=="2"){ echo "��͹��ҧ���";}else if($result["result_hand"]=="3"){ echo "����";}else if($result["result_hand"]=="4"){ echo "��";}else if($result["result_hand"]=="5"){ echo "���ҡ";}?></td>
    <td align="center"><? if(empty($result["leg1"]) || $result["leg1"]==0){ echo "&nbsp;";}else{ echo $result["leg1"];}?></td>
    <td align="center"><? if(empty($result["leg2"]) || $result["leg2"]==0){ echo "&nbsp;";}else{ echo $result["leg2"];}?></td>
    <td align="center"><? if($result["result_leg"]=="1"){ echo "���";}else if($result["result_leg"]=="2"){ echo "��͹��ҧ���";}else if($result["result_leg"]=="3"){ echo "����";}else if($result["result_leg"]=="4"){ echo "��";}else if($result["result_leg"]=="5"){ echo "���ҡ";}?></td>
    <td align="center"><? if(empty($result["steptest1"]) || $result["steptest1"]==0){ echo "&nbsp;";}else{ echo $result["steptest1"];}?></td>
    <td align="center"><? if(empty($result["steptest2"]) || $result["steptest2"]==0){ echo "&nbsp;";}else{ echo $result["steptest2"];}?></td>
    <td align="center"><? if(empty($result["steptest3"]) || $result["steptest3"]==0){ echo "&nbsp;";}else{ echo $result["steptest3"];}?></td>
    <td align="center"><? if($result["result_steptest"]=="1"){ echo "���";}else if($result["result_steptest"]=="2"){ echo "��͹��ҧ���";}else if($result["result_steptest"]=="3"){ echo "����";}else if($result["result_steptest"]=="4"){ echo "��";}else if($result["result_steptest"]=="5"){ echo "���ҡ";}?></td>
  </tr>
<?
}
?>  
</table>
<br>
