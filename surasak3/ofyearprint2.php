<?
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
.font1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
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
<?
$sql1 = "select * from condxofyear where hn='".$_SESSION['hn']."' AND status_con ='Y'";
$row = mysql_query($sql1);
$result1 = mysql_fetch_array($row);
?>
<table width="100%" border="0" class="font1">
          <tr>
            <td width="51%" align="center"><strong class="font1"><u>�š�õ�Ǩ��ҧ���</u></strong></td>
            <td width="49%" align="center" valign="top" class="font1"><strong><u>��Ǩ���ö�Ҿ������Թ (Hearing Efficiency)</u></strong><br /></td>
          </tr>
          <tr>
            <td width="51%"><table width="98%" border="0">
              <tr>
                <td colspan="2" class="font1"><u><strong>��������´�š�õ�Ǩ��ҧ��·����</strong></u></td>
              </tr>
              <tr>
                <td width="41%" class="font1">���˹ѡ/Weight (kg.) : <strong>
                  <?=$result1['weight']?>
                </strong></td>
                <td width="59%" class="font1">�����ѹ���Ե/Pressure : <strong>
                  <?=$result1['bp1']?>
                  /
                  <?=$result1['bp2']?>
                  mmHg.</strong></td>
              </tr>
              <tr>
                <td>��ǹ�٧/Height (Cm.) : <strong>
                  <?=$result1['height']?>
                </strong></td>
                <td class="font1">�վ��/Pulse : <strong>
                  <?=$result1['pause']?>
                </strong></td>
              </tr>
              <tr>
                <td colspan="2">�Ѫ����š�� : <strong>
                  <?=$result1['bmi']?>
                </strong></td>
              </tr>
              <tr>
                <td><u><strong>�š�õ�Ǩ��ҧ��·����</strong></u></td>
                <td class="font1"><?=$result1['general']?>
                  &nbsp;
                  <?=$result1['reason_general']?></td>
              </tr>
            </table></td>
            <td><table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
              <tr>
                <td colspan="3" align="center"><strong>����������§�ٴ��·����</strong></td>
                <td colspan="3" align="center"><strong>����������§�٧</strong></td>
              </tr>
              <tr>
                <td width="18%" align="center"><strong>����������§</strong></td>
                <td width="16%" align="center"><strong>����</strong></td>
                <td width="19%" align="center"><strong>���</strong></td>
                <td width="19%" align="center"><strong>����������§</strong></td>
                <td width="14%" align="center"><strong>����</strong></td>
                <td width="14%" align="center"><strong>���</strong></td>
              </tr>
              <tr>
                <td align="center">500</td>
                <td align="center"><strong>
                  <?=$result1['hear500L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear500R']?>
                </strong></td>
                <td align="center">4000</td>
                <td align="center"><strong>
                  <?=$result1['hear4000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear4000R']?>
                </strong></td>
              </tr>
              <tr>
                <td align="center">1000</td>
                <td align="center"><strong>
                  <?=$result1['hear1000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear1000R']?>
                </strong></td>
                <td align="center">6000</td>
                <td align="center"><strong>
                  <?=$result1['hear6000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear6000R']?>
                </strong></td>
              </tr>
              <tr>
                <td align="center">2000</td>
                <td align="center"><strong>
                  <?=$result1['hear2000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear2000R']?>
                </strong></td>
                <td align="center">8000</td>
                <td align="center"><strong>
                  <?=$result1['hear8000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear8000R']?>
                </strong></td>
              </tr>
              <tr>
                <td align="center">3000</td>
                <td align="center"><strong>
                  <?=$result1['hear3000L']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['hear3000R']?>
                </strong></td>
                <td align="center">&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td align="center">LOW TONE</td>
                <td align="center"><strong>
                  <?=$result1['LowLeft']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['LowRight']?>
                </strong></td>
                <td align="center">HIGH TONE</td>
                <td align="center"><strong>
                  <?=$result1['HighLeft']?>
                </strong></td>
                <td align="center"><strong>
                  <?=$result1['HighRight']?>
                </strong></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td rowspan="27" valign="top"><table width="100%" border="0">
              <tr>
                <td colspan="2" align="center"><strong><u>��Ǩ���ö�Ҿ�ʹ Lung Ability</u></strong></td>
              </tr>
              <tr>
                <td colspan="2"><table width="89%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
                  <tr>
                    <td align="center">&nbsp;</td>
                    <td align="center"><strong>PRE#1</strong></td>
                    <td align="center"><strong>PREDICTED</strong></td>
                    <td align="center"><strong>%PREDICTED</strong></td>
                  </tr>
                  <tr>
                    <td width="18%" align="center">FVC</td>
                    <td width="16%" align="center"><strong>
                      <?=$result1['FVC1']?>
                    </strong></td>
                    <td width="19%" align="center"><strong>
                      <?=$result1['FVC2']?>
                    </strong></td>
                    <td width="19%" align="center"><strong>
                      <?=$result1['FVC3']?>
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="center">FEV1</td>
                    <td align="center"><strong>
                      <?=$result1['FEV1']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['FEV2']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['FEV3']?>
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="center">FEV1%</td>
                    <td align="center"><strong>
                      <?=$result1['RO1']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['RO2']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['RO3']?>
                    </strong></td>
                  </tr>
                  <tr>
                    <td align="center">FEF2575</td>
                    <td align="center"><strong>
                      <?=$result1['PEF1']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['PEF2']?>
                    </strong></td>
                    <td align="center"><strong>
                      <?=$result1['PEF3']?>
                    </strong></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td width="40%"><strong><u>�š�õ�Ǩ </u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
                <td width="60%"><strong>
                  <?=$result1['stat_chest']?>
                </strong></td>
              </tr>
            </table>
            </td>
            <td><u><strong>�š�õ�Ǩ</strong></u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <? 
			if($result1['LowRight']=="����"&$result1['LowLeft']=="����"&$result1['HighRight']=="����"&$result1['HighLeft']=="����") echo "����";
			elseif($result1['LowRight']!="����"|$result1['LowLeft']!="����"|$result1['HighRight']!="����"|$result1['HighLeft']!="����") echo "�Դ����";
				?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><strong>�ѹ�֡</strong>&nbsp;&nbsp;<br />
            <?=nl2br($result1['dx'])?></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td align="center"><strong>�ç��Һ�Ť�������ѡ�������� �.�ӻҧ</strong></td>
          </tr>
          <tr>
            <td align="center"><strong>�Ţ��� 1 ���� 1 �.�ӻҧ-��� �.�Ԫ�� �.���ͧ �.�ӻҧ 52100</strong></td>
          </tr>
          <tr>
            <td align="center"><strong>��.054-839305 �����.054-839310</strong></td>
          </tr>
          <tr>
            <td align="center"><strong>www.surasakhospital.mi.th</strong></td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td>
           </td>
          </tr>
          <tr>
            <td class="font1">
            </td>
          </tr>
        </table>
<div id="no_print">
<center><a href="hnofyearprint.php">˹���á</a></center>
</div>
</body>
</html>