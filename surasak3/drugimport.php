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
		?>
        <td>�ѹ���...<?=date("d")?>....��͹...<?=$arrmon[date("m")]?>...�.�...<?=date("Y")+543?>...</td>
      </tr>
      <tr>
        <td>�����ԡ <?=$_SESSION['sOfficer']?></td>
        <td>&nbsp;</td>
        <td>Ἱ�..............................</td>
      </tr>
      <tr>
        <td colspan="3">�ӹǳ��è����ҵ�����ѹ��� <?=$_SESSION['yymall']?> ��Ǩ�ͺ������ѹ��� <?=$_SESSION['datetime']?></td>
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
	  	$query = "SELECT title,prefix,runno FROM runno WHERE title = 'drugimp'";
	  	$result = mysql_query($query) or die("Query failed");
			
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
			
			if(!($row = mysql_fetch_object($result)))
				continue;
		}
			
		$nRunno=$row->runno;
		$nRunno++;
			
		$query ="UPDATE runno SET runno = $nRunno WHERE title='drugimp'";
		$result = mysql_query($query) or die("Query failed");
		
      $cont = $_POST['sump'];
	  for($p=1;$p<=$cont;$p++){
		  if($_POST['import'.$p]!=""||$_POST['import'.$p]!=0){

			$sel2 = "SELECT a.*, b.`min` AS `new_min`, b.`max` AS `new_max` 
			FROM `druglst` AS a 
			RIGHT JOIN `drug_control_user` AS b ON b.`drugcode` = a.`drugcode` 
			WHERE a.`drugcode` = '".$_POST['drx'.$p]."' 
			AND b.`username` = '".$_SESSION['sOfficer']."'";

			  $row2 = mysql_query($sel2);
			  $result2 = mysql_fetch_array($row2);

			  $r++;
			
			  $import = "insert into drugimport (thidate,drugcode,tradname,min,max,stock,mainstk,dispense,amountrx,idno,usercontrol,datesearch) values ('".$_SESSION['datetime']."','".$_POST['drx'.$p]."','".$result2['tradname']."','".$result2['new_min']."','".$result2['new_max']."','".$result2['stock']."','".$result2['mainstk']."','".$_POST['rxdrug'.$p]."','".$_POST['import'.$p]."','".$nRunno."','".$_SESSION['sOfficer']."','".$_SESSION['yymall']."')";
			  $result56 = mysql_query($import) or die(mysql_error());
	  ?>
      <tr>
        <td align="center"><?=$r?></td>
        <td><?=$_POST['drx'.$p]?></td>
        <td><?=$result2['tradname']?></td>
        <td align="center"><?=$result2['new_min']?></td>
        <td align="center"><?=$result2['new_max']?></td>
        <td align="center"><?=$result2['stock']?></td>
        <td align="center"><?=$result2['mainstk']?></td>
        <td align="center"><?=$_POST['rxdrug'.$p]?></td>
        <td align="center"><?=$_POST['import'.$p]?></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <?
		  }
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
