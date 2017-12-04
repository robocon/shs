<?
$thyear=$_SESSION["thyear"];
$ksyear=$_SESSION["ksyear"];
$month=$_SESSION["month"];
$mon=$_SESSION["mon"];
?>
<div align="center">
<p><strong>จำนวนผู้มารับบริการฝังเข็มจำแนกตามสาเหตุการป่วยและความพึงพอใจของผู้มารับบริการฝังเข็ม (รง.ผสต.10)<br>
หน่วยงาน  โรงพยาบาลค่ายสุรศักดิ์มนตรี <br>
ประจำเดือน <?=$mon;?>&nbsp;ปี <?=$thyear;?><br>
(10.1) รายงานจำนวนผู้มารรับบริการฝังเข็มจำแนกตามสาเหตุการป่วย</strong></p>
  <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
    <tr>
      <td width="4%" align="center"><strong>กลุ่มที่</strong></td>
      <td width="83%" align="center"><strong>สาเหตุการป่วย (ชื่อโรค)</strong></td>
      <td width="13%" align="center"><strong>จำนวนผู้ป่วย (ราย)</strong></td>
    </tr>
    <tr>
      <td align="center">1</td>
      <td align="left">โรคติดเชื้อและปรสิต Cetain infectious and parasitic diseases</td>
    <?
		$sql1="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='01'";
		$query1=mysql_query($sql1) or die ("Error");
		$num1=mysql_num_rows($query1);
	?>
      <td align="center"><?=$num1;?></td>
    </tr>
    <tr>
      <td align="center">2</td>
      <td align="left">เนื้องอก (รวมมะเร็ง) Neopiasms</td>
    <?
		$sql2="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='02'";
		$query2=mysql_query($sql2) or die ("Error");
		$num2=mysql_num_rows($query2);
	?>      
      <td align="center"><?=$num2;?></td>
    </tr>
    <tr>
      <td align="center">3</td>
      <td align="left">โรคเลือดและอวัยวะสร้างเลือดและความผิดปกติเกี่ยวกับภูมิคุ้มกัน Diseases of the blood forming organs and certain disorders involving the immune mechanism</td>
    <?
		$sql3="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='03'";
		$query3=mysql_query($sql3) or die ("Error");
		$num3=mysql_num_rows($query3);
	?>      
      <td align="center"><?=$num3;?></td>
    </tr>
    <tr>
      <td align="center">4</td>
      <td align="left">โรคเกี่ยวกับต่อมไร้ท่อ โภชนาการ และเมตะบอลิสัม Endocnine,nutritional and metabolic diseases</td>
    <?
		$sql4="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='04'";
		$query4=mysql_query($sql4) or die ("Error");
		$num4=mysql_num_rows($query4);
	?>      
      <td align="center"><?=$num4;?></td>
    </tr>
    <tr>
      <td align="center">5</td>
      <td align="left">ภาวะแปรปรวนทางจิตและพฤติกรรม Mental and belhavioural disorders</td>
    <?
		$sql5="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='05'";
		$query5=mysql_query($sql5) or die ("Error");
		$num5=mysql_num_rows($query5);
	?>      
      <td align="center"><?=$num5;?></td>
    </tr>
    <tr>
      <td align="center">6</td>
      <td align="left">โรคระบบประสาท Diseases of the nervous system</td>
    <?
		$sql6="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='06'";
		$query6=mysql_query($sql6) or die ("Error");
		$num6=mysql_num_rows($query6);
	?>      
      <td align="center"><?=$num6;?></td>
    </tr>
    <tr>
      <td align="center">7</td>
      <td align="left">โรคตารวมส่วนประกอบของตา Diseases of the eye and adnexa</td>
    <?
		$sql7="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='07'";
		$query7=mysql_query($sql7) or die ("Error");
		$num7=mysql_num_rows($query7);
	?>      
      <td align="center"><?=$num7;?></td>
    </tr>
    <tr>
      <td align="center">8</td>
      <td align="left">โรคหูและปุ่มกกหู Diseases of the ear and mastoid process</td>
    <?
		$sql8="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='08'";
		$query8=mysql_query($sql8) or die ("Error");
		$num8=mysql_num_rows($query8);
	?>      
      <td align="center"><?=$num8;?></td>
    </tr>
    <tr>
      <td align="center">9</td>
      <td align="left">โรคระบบไหลเวียนเลือด Diseases of the circulatory system</td>
    <?
		$sql9="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='09'";
		$query9=mysql_query($sql9) or die ("Error");
		$num9=mysql_num_rows($query9);
	?>      
      <td align="center"><?=$num9;?></td>
    </tr>
    <tr>
      <td align="center">10</td>
      <td align="left">โรคระบบหายใจ Diseases of the respiratory system</td>
    <?
		$sql10="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='10'";
		$query10=mysql_query($sql10) or die ("Error");
		$num10=mysql_num_rows($query10);
	?>      
      <td align="center"><?=$num10;?></td>
    </tr>
    <tr>
      <td align="center">11</td>
      <td align="left">โรคระบบย่อยอาหาร Diseases of the digestive system</td>
    <?
		$sql11="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='11'";
		$query11=mysql_query($sql11) or die ("Error");
		$num11=mysql_num_rows($query11);
	?>      
      <td align="center"><?=$num11;?></td>
    </tr>
    <tr>
      <td align="center">12</td>
      <td align="left">โรคผิวหนังและเนื้อเยื้อใต้ผิวหนัง Diseases of the skin and subcutaneous tissue</td>
    <?
		$sql12="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='12'";
		$query12=mysql_query($sql12) or die ("Error");
		$num12=mysql_num_rows($query12);
	?>      
      <td align="center"><?=$num12;?></td>
    </tr>
    <tr>
      <td align="center">13</td>
      <td align="left">โรคระบบกล้ามเนื้อ รวมโครงร่าง และเนื้อยึดเสริม Diseases of the musculoskeletal system and connective tissue</td>
    <?
		$sql13="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='13'";
		$query13=mysql_query($sql13) or die ("Error");
		$num13=mysql_num_rows($query13);
	?>      
      <td align="center"><?=$num13;?></td>
    </tr>
    <tr>
      <td align="center">14</td>
      <td align="left">โรคระบบสืบพันธุ์ร่วมปัสสาวะ Diseases of the genitouninary system</td>
    <?
		$sql14="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='14'";
		$query14=mysql_query($sql14) or die ("Error");
		$num14=mysql_num_rows($query14);
	?>      
      <td align="center"><?=$num14;?></td>
    </tr>
    <tr>
      <td align="center">15</td>
      <td align="left">อาการ,อาการแสดง และสิ่งปกติที่พบได้จากการตรวจทางคลินิกและทางห้องปฏิบัติการที่ไม่สามารถจำแนกโรคในกลุ่มอื่น</td>
    <?
		$sql15="select * from clinicnid where date_time between '$ksyear-$month-15 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='15'";
		$query15=mysql_query($sql15) or die ("Error");
		$num15=mysql_num_rows($query15);
	?>      
      <td align="center"><?=$num15;?></td>
    </tr>
    <tr>
      <td align="center">16</td>
      <td align="left">สาเหตุป่วยอื่น ๆ ที่มิได้จัดจำแนกไว้ในกลุ่มที่ 1-15 ดังกล่าวข้างต้น</td>
    <?
		$sql16="select * from clinicnid where date_time between '$ksyear-$month-01 00:00:00' and '$ksyear-$month-31 23:59:59' and groupnid='16'";
		$query16=mysql_query($sql16) or die ("Error");
		$num16=mysql_num_rows($query16);
	?>      
      <td align="center"><?=$num16;?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td align="center"><strong>รวมทั้งสิ้น</strong></td>
      <td align="center">
	  <?
      $sum=$num1+$num2+$num3+$num4+$num5+$num6+$num7+$num8+$num9+$num10+$num11+$num12+$num13+$num14+$num15+$num16;
	  echo $sum;
	  ?></td>
    </tr>
  </table>
  <p><strong></strong></p>
</div>
</body>
</html>
