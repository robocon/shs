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
$sql1 = "select * from condxofyear where hn='".$_POST['HN']."' AND status_con ='Y'";
$row = mysql_query($sql1);
$count1 = mysql_num_rows($row);
if($count1==0){
 	echo "����բ�����";
	?>
	<script>
    window.location.href='hnofyearprint.php';
    </script>
	<?
}
else{
	$result1 = mysql_fetch_array($row);
	$_SESSION['hn']=$_POST['HN'];
}
?>
        <table width="100%" border="0">
          <tr>
            <td width="51%" rowspan="9">&nbsp;</td>
            <td width="49%" align="center"><span class="font1"><strong><u>�š�õ�Ǩ�آ�Ҿ��Шӻ�</u></strong></span></td>
          </tr>
          <? $sub1 = explode("-",$result1['company'])?>
          <tr>
            <td><span class="font1"><?=$sub1[1]?>
            </span></td>
          </tr>
          <? $sub2 = explode(" ",$result1['thidate'])?>
          <? $sub3 = explode("-",$sub2[0])?>
          <tr>
            <td><span class="font1">�ѹ����Ǩ <?=$sub3[2]."/".$sub3[1]."/".$sub3[0]?></span></td>
          </tr>
          <tr>
            <td align="center"><span class="font1"><strong><u>�����Ż���ѵԷ����</u></strong></span></td>
          </tr>
          <tr>
            <td><span class="font1" style="font-size:16px">����-ʡ�� <strong><?=$result1['ptname']?>&nbsp;&nbsp;HN : <?=$result1['hn']?>&nbsp;&nbsp;���� : 
                  <span class="font1" style="font-size:16px"><strong>
                  <?=$result1['age']?>
            </strong></span></strong></span></td>
          </tr>
          <tr>
            <td><span class="font1"><?=$result1['type_check']?></span></td>
          </tr>
          <tr>
            <td align="center"><span class="font1"><strong><u>��ػ�š�õ�Ǩ���º��º 5 ��</u></strong></span></td>
          </tr>
          <tr>
            <td><table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#CCCCCC" style="border-collapse:collapse">
              <tr>
                <td width="64%" align="center"><span class="font1"><strong>��¡�õ�Ǩ</strong></span></td>
                <td width="36%" align="center"><strong><span class="font1">2011</span></strong></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><span class="font1"><strong>��鹰ҹ</strong></span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">��Ǩ��ҧ��·����</span></td>
                <td align="center"><span class="font1"><?=$result1['general']?></span></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><span class="font1"><strong>��������§</strong></span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">���ö�Ҿ������Թ (Hearing Ability)</span></td>
                <td align="center"><span class="font1">
                  <? 
				if($result1['LowRight']=="����"&$result1['LowLeft']=="����"&$result1['HighRight']=="����"&$result1['HighLeft']=="����") echo "����";
				elseif($result1['LowRight']!="����"|$result1['LowLeft']!="����"|$result1['HighRight']!="����"|$result1['HighLeft']!="����") echo "�Դ����";
				?>
                </span></td>
              </tr>
              <tr>
                <td align="left"><span class="font1">���ö�Ҿ�ͧ�ʹ (Lumg Ability)</span></td>
                <td align="center"><span class="font1"><?=$result1['stat_chest']?></span></td>
              </tr>
              </table>
              <span class="font1"><strong><br />
              ��ػ�š�õ�Ǩ</strong> <?=$result1['summary']?></span><br />
			  <br />
              <br />
              <br />
              <br />
              <br />
<br />
              <span class="font1"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ� ����ظ �ջ�ժ�</strong></span><br />
              <span class="font1"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Ҫ��ᾷ��</strong></span>
</td>
          </tr></table>
              
<div id="no_print">
<center><a href ="../nindex.htm" >&lt;&lt; ����</a> <a href="ofyearprint2.php">˹�ҶѴ�</a></center>
</div>

</body>
</html>