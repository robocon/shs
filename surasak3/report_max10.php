<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
$thmonth=$thyear."-".$month;
?>
<div align="center">
<p><strong>Ẻ��§ҹʶԵԡ���纻��� 10 �ѹ�Ѻ�٧�ش<br>
  �ͧ�������Ѻ��õ�Ǩ�ѡ��� þ. ��������ѡ��������<br>
  ��Ш���͹  <?=$mon;?>&nbsp;�� <?=$thyear;?></strong></p>
      <?
	  $sql="select * from pstmax where yrmonth= '$thmonth' order by sumcase desc limit 0,10";
	  $query=mysql_query($sql);
	  $num=mysql_num_rows($query);
	  if(empty($num)){
	  	echo "<script>alert('�ѧ����բ�������к� ��س����ѡ���� �к��оҷ�ҹ��Ҵ���§ҹ �ʵ.5 ��͹ �ҡ�������ҹ���͡����§ҹ�Ǫ�����ա���駤�Ѻ');window.location='menupst.php?page=pst5';</script>";
	  }
	  ?>   
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="4%" rowspan="2" align="center"><strong>�ѹ�Ѻ</strong></td>
      <td width="47%" rowspan="2" align="center"><strong>�����ä</strong></td>
      <td colspan="4" align="center"><strong>������������</strong></td>
      <td width="13%" rowspan="2" align="center"><strong>�����˵�</strong></td>
    </tr>
    <tr>
      <td width="9%" align="center"><strong>�</strong></td>
      <td width="9%" align="center"><strong>�</strong></td>
      <td width="9%" align="center"><strong>�</strong></td>
      <td width="9%" align="center"><strong>���</strong></td>
    </tr> 
    <?
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	?>  
    <tr>
      <td align="center"><?=$i;?></td>
      <td align="left"><?=$rows["diag"];?></td>
      <td align="center"><?=$rows["case1"];?></td>
      <td align="center"><?=$rows["case2"];?></td>
      <td align="center"><?=$rows["case3"];?></td>
      <td align="center"><?=$rows["sumcase"];?></td>
      <td align="center">&nbsp;</td>
    </tr>
    <?
	}
	?>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>���</strong></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
    </tr>
  </table>
  <p>�����˵�	�. = ���ѧ�� �. = ��ͺ���� �. = �����͹</p>
<p style="margin-left:100px;"><strong>��Ǩ�١��ͧ</strong></p>
</div>
