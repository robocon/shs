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
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BP</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CBC</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>UA</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BS</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>TR</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>HDL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>LDL</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>BUN</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>CR</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SGOT</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>SGPT</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>ALK</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>����ѵ��ä��Шӵ��</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>TYPDIAG</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>���������§</strong></td>
    <td width="10%" align="center" bgcolor="#FF9999"><strong>������ä</strong></td>
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
    <td align="center"><?=$result["waist"];?></td>
    <td align="center">
      <? if(!empty($result["bp2"])){ echo $result["bp2"];}else{ echo $result["bp1"];}?>    </td>
    <td align="center"><?=$result["cbc_lab"];?></td>
    <td align="center"><?=$result["ua_lab"];?></td>
    <td align="center"><? if(empty($result["glu_result"])){ echo "&nbsp;";}else{ echo $result["glu_result"];}?></td>
    <td align="center"><? if(empty($result["chol_result"])){ echo "&nbsp;";}else{ echo $result["chol_result"];}?></td>
    <td align="center"><? if(empty($result["trig_result"])){ echo "&nbsp;";}else{ echo $result["trig_result"];}?></td>
    <td align="center"><? if(empty($result["hdl_result"])){ echo "&nbsp;";}else{ echo $result["hdl_result"];}?></td>
    <td align="center"><? if(empty($result["ldl_result"])){ echo "&nbsp;";}else{ echo $result["ldl_result"];}?></td>
    <td align="center"><? if(empty($result["bun_result"])){ echo "&nbsp;";}else{ echo $result["bun_result"];}?></td>
    <td align="center"><? if(empty($result["crea_result"])){ echo "&nbsp;";}else{ echo $result["crea_result"];}?></td>
    <td align="center"><? if(empty($result["alp_result"])){ echo "&nbsp;";}else{ echo $result["alp_result"];}?></td>
    <td align="center"><? if(empty($result["alt_result"])){ echo "&nbsp;";}else{ echo $result["alt_result"];}?></td>
    <td align="center"><? if(empty($result["ast_result"])){ echo "&nbsp;";}else{ echo $result["ast_result"];}?></td>
    <td align="center"><? if($result["prawat"]=="0"){ echo "������ä��Шӵ��";}else if($result["prawat"]=="1"){ echo "�����ѹ���Ե�٧";}else if($result["prawat"]=="2"){ echo "����ҹ";}else if($result["prawat"]=="3"){ echo "�ä���������ʹ���ʹ";}else if($result["prawat"]=="4"){ echo "��ѹ����ʹ�٧";}else if($result["prawat"]=="5"){ echo "�ä����˹�������� 2 �ä���� ��� "; if(!empty($result["prawat_ht"])){ echo "�����ѹ���Ե�٧ ";} if(!empty($result["prawat_dm"])){ echo "����ҹ ";} if(!empty($result["prawat_cad"])){ echo "�ä���������ʹ���ʹ ";} if(!empty($result["prawat_dlp"])){ echo "��ѹ����ʹ�٧ ";} }else if($result["prawat"]=="6"){ echo "�ä��Шӵ������";}?></td>
    <td align="center"><?=$result["diagtype"];?></td>
    <td align="center"><? if(empty($result["resultdiag_risk"])){ echo "&nbsp;";}else{ echo "����§����ä";}?></td>
    <td align="center"><? if(!empty($result["risk_ht"])){ echo "�����ѹ���Ե�٧ ";} if(!empty($result["risk_dm"])){ echo "����ҹ ";} if(!empty($result["risk_obesity"])){ echo "�ä��ǹ ";} if(!empty($result["risk_dlp"])){ echo "��ѹ����ʹ�٧ ";} ?></td>
  </tr>
<?
}
?>  
</table>
<br>
<p align="center">�������Ǩ��͹�����ѧ��鹴��</p>
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>�ӴѺ</strong></td>
    <td width="45%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="45%" align="center" bgcolor="#66CC99"><strong>����-���ʡ��</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>�ѧ�Ѵ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>����</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>���˹ѡ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>��ǹ�٧</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BMI</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>����ͺ��� (����)</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BP</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CBC</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>UA</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BS</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CHOL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>TR</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>HDL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>LDL</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>BUN</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>CR</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>SGOT</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>SGPT</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>ALK</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>����ѵ��ä��Шӵ��</strong></td>
  </tr>
<?
		$sql = "select * from condxofyear_so where yearcheck='$newPrefix' and camp1 !='' and camp1 !='D34 ���.33' and camp1!='D33 ˹��·�������' group by hn order by camp1 asc,chunyot1 asc, age desc";
		//echo $sql;
		$query = mysql_query($sql);  		
		$i=0;
		while($result=mysql_fetch_array($query)){
		$i++;
		$ptname=$result["ptname"];
		$age=$result["age"];
		$waist=$result["round_"]*0.393700787;
?>		  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$result["hn"];?></td>
    <td><?=$ptname;?></td>
    <td align="center"><?=substr($result["camp1"],4);?></td>
    <td align="center"><?=$age;?></td>
    <td align="center"><?=$result["weight"];?></td>
    <td align="center"><?=$result["height"];?></td>
    <td align="center">
      <?=$result["bmi"];?>    </td>
    <td align="center"><?=number_format($waist,2);?></td>
    <td align="center">
      <? echo $result["bp1"]."/".$result["bp2"];?>    </td>
    <td align="center"><?=$result["stat_cbc"];?></td>
    <td align="center"><?=$result["stat_ua"];?></td>
    <td align="center"><? if(empty($result["bs"])){ echo "&nbsp;";}else{ echo $result["bs"];}?></td>
    <td align="center"><? if(empty($result["chol"])){ echo "&nbsp;";}else{ echo $result["chol"];}?></td>
    <td align="center"><? if(empty($result["tg"])){ echo "&nbsp;";}else{ echo $result["tg"];}?></td>
    <td align="center"><? if(empty($result["hdl"])){ echo "&nbsp;";}else{ echo $result["hdl"];}?></td>
    <td align="center"><? if(empty($result["ldl"])){ echo "&nbsp;";}else{ echo $result["ldl"];}?></td>
    <td align="center"><? if(empty($result["bun"])){ echo "&nbsp;";}else{ echo $result["bun"];}?></td>
    <td align="center"><? if(empty($result["cr"])){ echo "&nbsp;";}else{ echo $result["cr"];}?></td>
    <td align="center"><? if(empty($result["sgot"])){ echo "&nbsp;";}else{ echo $result["sgot"];}?></td>
    <td align="center"><? if(empty($result["sgpt"])){ echo "&nbsp;";}else{ echo $result["sgpt"];}?></td>
    <td align="center"><? if(empty($result["alk"])){ echo "&nbsp;";}else{ echo $result["alk"];}?></td>
    <td align="center"><? if($result["prawat"]=="0"){ echo "������ä��Шӵ��";}else if($result["prawat"]=="1"){ echo "�����ѹ���Ե�٧";}else if($result["prawat"]=="2"){ echo "����ҹ";}else if($result["prawat"]=="3"){ echo "�ä���������ʹ���ʹ";}else if($result["prawat"]=="4"){ echo "��ѹ����ʹ�٧";}else if($result["prawat"]=="5"){ echo "�ä����˹�������� 2 �ä���� ��� "; if(!empty($result["prawat_ht"])){ echo "�����ѹ���Ե�٧ ";} if(!empty($result["prawat_dm"])){ echo "����ҹ ";} if(!empty($result["prawat_cad"])){ echo "�ä���������ʹ���ʹ ";} if(!empty($result["prawat_dlp"])){ echo "��ѹ����ʹ�٧ ";} }else if($result["prawat"]=="6"){ echo "�ä��Шӵ������";}?></td>
  </tr>
<?
}
?>  
</table>
