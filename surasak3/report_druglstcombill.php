<?php
session_start();
include("connect.inc");
?>    
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center"><strong>Ẻ���Ǩ�������ҤҨѴ�����Ңͧ˹��§ҹ�Ҥ�Ѱ���ͻ�Сͺ��þԨ�óҨѴ���Ҥҡ�ҧ��</strong></p>
<div style="margin-left:5%;"><strong>����˹��§ҹ : �ç��Һ�Ť�������ѡ��������</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" rowspan="2" align="center"><strong>�ӴѺ</strong></td>
        <td width="17%" rowspan="2" align="center"><strong>����</strong></td>
    <td width="17%" rowspan="2" align="center"><strong>���͡�ä��</strong></td>
    <td width="11%" rowspan="2" align="center"><strong>�������ѭ�ҧ��</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>�����ç</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>�ٻẺ</strong></td>
    <td width="7%" rowspan="2" align="center"><strong>��Ҵ��è�</strong></td>
    <td width="15%" rowspan="2" align="center"><strong>�Ҥ��ҷ��Ѵ�������͢�Ҵ��è�<br>
      (���Ҥ��ط�Է����� VAT ���<br>
    �ӹǳ��ǹŴ/�ͧ������)</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>�ѹ��͹��<br>
    ���Ѵ��������ش</strong></td>
    <td colspan="2" align="center"><strong>����ѷ����˹���</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>���ʺ���ѷ</strong></td>
    <td align="center"><strong>���ͺ���ѷ</strong></td>
  </tr>
  <?
  $sql="select * from druglst where part='DDL' || part='DDY' || part='DDN' order by drugcode";
  $query=mysql_query($sql);
  $i=0;
  while($rows=mysql_fetch_array($query)){
  $i++;
  ?>
  <tr>
    <td align="center"><?=$i;?></td>
     <td><?=$rows["drugcode"];?></td>
    <td><?=$rows["tradname"];?></td>
    <td><?=$rows["genname"];?></td>
    <td><? if(empty($rows["strength"])){ echo "&nbsp;";}else{ echo $rows["strength"];}?></td>
    <td><? if(empty($rows["unit"])){ echo "&nbsp;";}else{ echo $rows["unit"];}?></td>
    <td><? if(empty($rows["packing"])){ echo "&nbsp;";}else{ echo $rows["packing"];}?></td>
    <td align="right"><?=number_format($rows["packpri_vat"],2);?></td>
    <?
	  $strquery="select * from combill where drugcode='".$rows["drugcode"]."' order by billdate desc limit 0,1";
	  //echo $strquery;
	  $result=mysql_query($strquery);
	  $strrows=mysql_fetch_array($result);
	?>
    <td align="center"><? if(empty($strrows["billdate"])){ echo "&nbsp;";}else{ echo $strrows["billdate"];}?></td>
    <td width="5%" align="center"><? if(empty($strrows["comcode"])){ echo "&nbsp;";}else{ echo $strrows["comcode"];}?></td>
    <td width="17%"><? if(empty($strrows["comname"])){ echo "&nbsp;";}else{ echo $strrows["comname"];}?></td>
  </tr>
  <?
  }
  ?>
</table>

