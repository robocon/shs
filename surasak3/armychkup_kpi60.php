<?
session_start();
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
		
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<div align="center"><strong>��Ǫ���Ѵ</strong></div>
<div align="center"><strong>�Ŵ�ҹ�����������آ�Ҿ�ͧ�ؤ�ҡ� (�.�.)</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="12%" rowspan="2" align="center"><strong>��Ǫ���Ѵ</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>�������</strong></td>
    <td colspan="2" align="center"><strong>�� 2557</strong></td>
    <td colspan="2" align="center"><strong>�� 2558</strong></td>
    <td colspan="2" align="center"><strong>�� 2559</strong></td>
    <td colspan="2" align="center"><strong>�� 2560</strong></td>
  </tr>
  <tr>
    <td width="12%" align="center"><strong>����Ҫ���</strong></td>
    <td width="8%" align="center"><strong>�١��ҧ</strong></td>
    <td width="12%" align="center"><strong>����Ҫ���</strong></td>
    <td width="8%" align="center"><strong>�١��ҧ</strong></td>
    <td width="12%" align="center"><strong>����Ҫ���</strong></td>
    <td width="8%" align="center"><strong>�١��ҧ</strong></td>
    <td width="12%" align="center"><strong>����Ҫ���</strong></td>
    <td width="8%" align="center"><strong>�١��ҧ</strong></td>
  </tr>
  <tr>
    <td>1. �����ä�����ѹ���Ե�٧</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">1.1) �����Шӹǹ�ؤ�ҡ� ����դ����ѹ���Ե�٧ ������� (BP &gt; 140/90)</div></td>
    <td align="center">&lt; 30%</td>
    <td align="center"><?
$sql56="SELECT count( row_id ) as bp56
FROM condxofyear_so
WHERE ( bp1 >140 AND bp2 >90 ) AND yearcheck =  '2556'
GROUP  BY yearcheck";
//echo $sql56;
$query56=mysql_query($sql56);
list($bp56)=mysql_fetch_array($query56);
echo $bp56;

$sql57="SELECT count( row_id ) as bp57
FROM condxofyear_so
WHERE ( bp1 >140 AND bp2 >90 ) AND yearcheck =  '2557'
GROUP  BY yearcheck";
//echo $sql57;
$query57=mysql_query($sql57);
list($bp57)=mysql_fetch_array($query57);
echo $bp57;
?></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">1.2) �����Шӹǹ�ؤ�ҡ� ����դ����ѹ���Ե�٧ ������� (BP &lt;= 140/90)</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>2. �����ä����ҹ</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">2.1) �����Шӹǹ�ؤ�ҡ� ������ä����ҹ ������� (FBS &gt;126)</div></td>
    <td align="center">&lt; 30%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">2.1) �����Шӹǹ�ؤ�ҡ� ������ä����ҹ ������� (FBS &lt;=140)</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>3. �����ä��ѹ����ʹ�٧</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">3.1) �����Шӹǹ�ؤ�ҡ� ������ä��ѹ����ʹ�٧ �������</div></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">TG &nbsp;&nbsp;&nbsp;&nbsp;&gt; 200</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">CHOL &gt; 200</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">LDL &nbsp;&nbsp;&nbsp;&gt; 160</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">3.2) �����Шӹǹ�ؤ�ҡ� ������ä��ѹ����ʹ�٧ �������</div></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">TG &nbsp;&nbsp;&nbsp;&nbsp;&lt;= 200</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">CHOL &lt;= 200</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:20px;">LDL &nbsp;&nbsp;&nbsp;&lt;= 160</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>4. ������ǹŧ�ا (�ͺ���)</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">4.1) �����Шӹǹ�ؤ�ҡ� ������ä��ǹŧ�ا ������� (��� &gt; 90 ��., ˭ԧ &gt; 80 ��.)</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">4.2) �����Шӹǹ�ؤ�ҡ� ������ä��ǹŧ�ا ������� (��� &lt;= 90 ��., ˭ԧ &lt;= 80 ��.)</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>5. ���� BMI �٧</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">5.1) �����Шӹǹ�ؤ�ҡ� ������ä��ǹ ������� (BMI &gt;= 30)</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">5.2) �����Шӹǹ�ؤ�ҡ� ������ä��ǹ ������� (BMI &lt; 30)</div></td>
    <td align="center">&gt; 50%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td>6. �����ä�������ѧ</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:10px;">5.1) �����Шӹǹ�ؤ�ҡ� ������ä�������ѧ ������� (GFR &lt; 60 ml/min)</div></td>
    <td align="center">&lt; 3%</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
</table>


