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
<div align="center"><strong>ตัวชี้วัด</strong></div>
<div align="center"><strong>ผลด้านการส่งเสริมสุขภาพของบุคลากร (ร.พ.)</strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="12%" rowspan="2" align="center"><strong>ตัวชี้วัด</strong></td>
    <td width="8%" rowspan="2" align="center"><strong>เป้าหมาย</strong></td>
    <td colspan="2" align="center"><strong>ปี 2557</strong></td>
    <td colspan="2" align="center"><strong>ปี 2558</strong></td>
    <td colspan="2" align="center"><strong>ปี 2559</strong></td>
    <td colspan="2" align="center"><strong>ปี 2560</strong></td>
  </tr>
  <tr>
    <td width="12%" align="center"><strong>ข้าราชการ</strong></td>
    <td width="8%" align="center"><strong>ลูกจ้าง</strong></td>
    <td width="12%" align="center"><strong>ข้าราชการ</strong></td>
    <td width="8%" align="center"><strong>ลูกจ้าง</strong></td>
    <td width="12%" align="center"><strong>ข้าราชการ</strong></td>
    <td width="8%" align="center"><strong>ลูกจ้าง</strong></td>
    <td width="12%" align="center"><strong>ข้าราชการ</strong></td>
    <td width="8%" align="center"><strong>ลูกจ้าง</strong></td>
  </tr>
  <tr>
    <td>1. ภาวะโรคความดันโลหิตสูง</td>
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
    <td><div style="margin-left:10px;">1.1) ร้อยละจำนวนบุคลากร ที่มีความดันโลหิตสูง รายใหม่ (BP &gt; 140/90)</div></td>
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
    <td><div style="margin-left:10px;">1.2) ร้อยละจำนวนบุคลากร ที่มีความดันโลหิตสูง ที่คุมได้ (BP &lt;= 140/90)</div></td>
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
    <td>2. ภาวะโรคเบาหวาน</td>
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
    <td><div style="margin-left:10px;">2.1) ร้อยละจำนวนบุคลากร ที่มีโรคเบาหวาน รายใหม่ (FBS &gt;126)</div></td>
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
    <td><div style="margin-left:10px;">2.1) ร้อยละจำนวนบุคลากร ที่มีโรคเบาหวาน ที่คุมได้ (FBS &lt;=140)</div></td>
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
    <td>3. ภาวะโรคไขมันในเลือดสูง</td>
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
    <td><div style="margin-left:10px;">3.1) ร้อยละจำนวนบุคลากร ที่มีโรคไขมันในเลือดสูง รายใหม่</div></td>
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
    <td><div style="margin-left:10px;">3.2) ร้อยละจำนวนบุคลากร ที่มีโรคไขมันในเลือดสูง ที่คุมได้</div></td>
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
    <td>4. ภาวะอ้วนลงพุง (รอบเอว)</td>
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
    <td><div style="margin-left:10px;">4.1) ร้อยละจำนวนบุคลากร ที่มีโรคอ้วนลงพุง รายใหม่ (ชาย &gt; 90 ซม., หญิง &gt; 80 ซม.)</div></td>
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
    <td><div style="margin-left:10px;">4.2) ร้อยละจำนวนบุคลากร ที่มีโรคอ้วนลงพุง ที่คุมได้ (ชาย &lt;= 90 ซม., หญิง &lt;= 80 ซม.)</div></td>
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
    <td>5. ภาวะ BMI สูง</td>
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
    <td><div style="margin-left:10px;">5.1) ร้อยละจำนวนบุคลากร ที่มีโรคอ้วน รายใหม่ (BMI &gt;= 30)</div></td>
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
    <td><div style="margin-left:10px;">5.2) ร้อยละจำนวนบุคลากร ที่มีโรคอ้วน ที่คุมได้ (BMI &lt; 30)</div></td>
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
    <td>6. ภาวะโรคไตเรื้อรัง</td>
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
    <td><div style="margin-left:10px;">5.1) ร้อยละจำนวนบุคลากร ที่มีโรคไตเรื้อรัง รายใหม่ (GFR &lt; 60 ml/min)</div></td>
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


