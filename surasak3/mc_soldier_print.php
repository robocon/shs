<?php
 include("connect.inc");   
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";
?>


<style>
	.font_tr{ font-family:"THSarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
	.font_hd{ font-family:"THSarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
	.font_hd1{ font-family:"THSarabunPSK"; font-size:23px; background-color:"#FFFFFF"; }
</style>
<table width="100%" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR class="font_hd1" align='center'>
	<TD>��§ҹ��õ�Ǩ�ä����¡�͹ࡳ����� (��辺�����Դ����)</TD>
</TR>
<TR class="font_hd1" align='center'>
	<TD>��Шӻ� ...........</TD>
</TR>
<TR class="font_hd1" align='center'>
	<TD>�ç��Һ�Ť�������ѡ��������  ��.�</TD>
</TR>
</table>
<table width="100%" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
 <tr class="font_hd">
<th width="10">�ӴѺ</th>
<th width="150">����-ʡ��</th>
<th width="100">�ä����Ǩ��</th>
<th width="200">�������ǧ��Ѻ��� �� �.�. ����</th>
<th width="150">���ᾷ�����Ǩ</th>
<th width="200">�������ҷ���</th>
<th width="150">�.�.�. ����Ѻ��õ�Ǩ</th>
</tr>

<?php

  $num=0;

    include("connect.inc");


$where = " AND (thidate between '".$_GET["sd"]." 00:00:00' AND '".$_GET["ed"]." 23:59:00' ) ";

 $sql = "SELECT row_id, date_format(thidate,'%d-%m-%Y'), hn, ptname, organ, dx_mc_soldier, dr1_mc_soldier, dr2_mc_soldier, dr3_mc_soldier,address,thdatehn FROM opd WHERE (dx_mc_soldier is not null AND dx_mc_soldier != '' ) ".$where." Order by  thidate ASC ";

    $result = mysql_query($sql) or die("Query failed ".mysql_error());

   
 while (list ($row_id, $date,$hn,$ptname,$organ, $dx_mc_soldier, $dr1_mc_soldier, $dr2_mc_soldier, $dr3_mc_soldier,$address1,$thdatehn) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 
	list($address) = mysql_fetch_row(mysql_query("Select concat(address,' ', tambol,' ',  ampur,' ',  changwat  ) From opcard where hn = '".$hn."' limit 0,1 "));
	$thdatehn=substr($thdatehn,0,10);

 $num++;

 print (" <tr class=\"font_tr\">\n".
"  <td align='center'>$num</td>\n".
"  <td>$ptname</a></td>\n".
"  <td>$dx_mc_soldier</td>\n".
"  <td>$dx_mc_soldier</td>\n".
"  <td>".substr($dr1_mc_soldier,5)." ".substr($dr2_mc_soldier,5)." ".substr($dr3_mc_soldier,5)."</td>\n".
"  <td>$address1</td>\n".
	"  <td align='center'>$thdatehn</td>\n".
//"  <td align='center'>3</td>\n".
//"  <td>þ.��������ѡ��������</td>\n".
 " </tr>\n");

	      

 }


include("unconnect.inc");

?>
</table>



