<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
.font1 {
	font-family:"TH SarabunPSK";
}
-->
</style>
<table width="100%" border="0" class="font1">
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="3" align="center">�ç��Һ�Ť�������ѡ��������</td>
        </tr>
      <tr>
        <td colspan="3" align="center">��ԡ������Ǫ�ѳ�� �ͧ���Ѫ����</td>
        </tr>
      <tr>
        <td colspan="3" align="center">�ͧ���Ѫ���� �͡��������Ţ FR-PHA-004/3 ��䢤��駷�� ...02...</td>
        </tr>
      <tr>
        <td width="28%">&nbsp;</td>
        <td width="24%">&nbsp;</td>
        <td width="48%">�ѹ����ռźѧ�Ѻ�� ...�.�...2551</td>
      </tr>
      <tr>
        <td>�����ԡ</td>
        <td>&nbsp;</td>
        <?
        $arrmon =  array("","���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
		$sel1 = "select * from drugimport where usercontrol= '".$_SESSION['sOfficer']."' and idno='".$_GET['id']."' ";
		$row1 = mysql_query($sel1);
		$result1 = mysql_fetch_array($row1);
		?>
        <td>�ѹ���...<?=substr($result1['thidate'],0,2)?>....��͹...<?=$arrmon[substr($result1['thidate'],3,2)+0]?>...�.�...<?=substr($result1['thidate'],6,4)?>...</td>
      </tr>
      <tr>
        <td>�����ԡ <?=$result1['usercontrol']?></td>
        <td>&nbsp;</td>
        <td>Ἱ�..............................</td>
      </tr>
      <tr>
        <td colspan="3">�ӹǳ��è����ҵ�����ѹ��� <?=$result1['datesearch']?> ��Ǩ�ͺ������ѹ��� <?=$result1['thidate']?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
      <tr>
        <td width="4%" rowspan="2" align="center">�ӴѺ</td>
        <td width="13%" rowspan="2" align="center">Drugcode</td>
        <td width="32%" rowspan="2" align="center">Tradname</td>
        <td width="6%" rowspan="2" align="center">Min</td>
        <td width="5%" rowspan="2" align="center">Max</td>
        <td width="6%" rowspan="2" align="center">��ͧ����</td>
        <td width="5%" rowspan="2" align="center">��ѧ</td>
        <td width="6%" rowspan="2" align="center">������</td>
        <td colspan="2" align="center">�ӹǹ</td>
        <td width="7%" rowspan="2" align="center">�����˵�</td>
      </tr>
      <tr>
        <td width="8%" align="center">���ԡ</td>
        <td width="8%" align="center">���¨�ԧ</td>
      </tr>
      <?
		$sel2 = "select * from drugimport where usercontrol= '".$_SESSION['sOfficer']."' and idno='".$_GET['id']."'";
		$row2 = mysql_query($sel2);
		while($result2 = mysql_fetch_array($row2)){
			$r++;

	  ?>
      <tr>
        <td align="center"><?=$r?></td>
        <td><?=$result2['drugcode']?></td>
        <td><?=$result2['tradname']?></td>
        <td align="center"><?=$result2['min']?></td>
        <td align="center"><?=$result2['max']?></td>
        <td align="center"><?=$result2['stock']?></td>
        <td align="center"><?=$result2['mainstk']?></td>
        <td align="center"><?=$result2['dispense']?></td>
        <td align="center"><?=$result2['amountrx']?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?
	  }
	  ?>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="0">
      <tr>
        <td colspan="2">��Ǩ����������.................................................................................</td>
        <td colspan="2">���ԡ����ػ�ó�������к����㹪�ͧ &quot;�ӹǹ�ԡ&quot; ��Т��ͺ���</td>
        </tr>
      <tr>
        <td colspan="2"> .........................................................................................................</td>
        <td colspan="2">..........................................................................�繼���Ѻ᷹</td>
        </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ŧ���) ����Ǩ�ͺ</td>
        <td>�ѹ ��͹ ��</td>
        <td>(ŧ���) ����ԡ</td>
        <td>�ѹ ��͹ ��</td>
      </tr>
      <tr>
        <td colspan="2">͹��ѵ���������੾�����¡����Шӹǹ������Ǩ�ͺ�ʹ�</td>
        <td colspan="2">���Ѻ����ػ�ó�����¡����Шӹǹ��������㹪�ͧ &quot;���¨�ԧ&quot;</td>
        </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ŧ���) �����觨���</td>
        <td>�ѹ ��͹ ��</td>
        <td>(ŧ���) ����Ѻ</td>
        <td>�ѹ ��͹ ��</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
        <td>...................................</td>
      </tr>
      <tr>
        <td>(ŧ���) ������</td>
        <td>�ѹ ��͹ ��</td>
        <td>(ŧ���) ���.��ǹ�Ǻ����ҧ�ѭ��</td>
        <td>�ѹ ��͹ ��</td>
      </tr>
    </table></td>
  </tr>
</table>
