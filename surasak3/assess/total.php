



<style type="text/css">
.style0 { font-family:"Angsana New"; font-size:20px}
.style1 { font-family:"Angsana New"; font-size:18px}
.style1.1 { font-family:"Angsana New"; font-size:10px; font-weight:bold;}
.style2 { font-family:"Angsana New"; font-size:21px}
.style3 { font-family:"Angsana New"; font-size:30px}
}
</style>
   <?php
   include("connect.php");
   ////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
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
////*runno ตรวจสุขภาพ*/////////



   $sql="select * from tb_assess inner join inputm on(tb_assess.row_id=inputm.row_id) where tb_assess.year ='$nPrefix'  group by tb_assess.row_id  order by tb_assess.date desc";
   $rs= mysql_query($sql); ?>
   <a target=_self  href='../../nindex.htm' ><------ ไปเมนู</a>
<strong>รายงานผลแบบประเมินความพึงพอใจ&nbsp;&nbsp;การใช้บริการโปรแกรมโรงพยาบาล ปี <?php echo $nPrefix; ?> </strong> </div>
<?php include "question.php"; ?>

<div  class="style2">1.สามารถเข้าถึงบริการได้ง่าย ขั้นตอนในการให้บริการมีความคล่องตัว ไม่ยุ่งยาก ซับซ้อน</div>
<div  class="style2">2.กระบวนการในการให้บริการเหมาะสม และรวดเร็วฉับไว</div>
<div  class="style2">3.เจ้าหน้าที่ให้บริการ ดูแลเอาใจใส่ กระตือรือร้น เต็มใจให้บริการ</div>
<div  class="style2">4.การให้คำปรึกษาและตอบข้อซักถามเกี่ยวกับเครื่องคอมพิวเตอร์และอุปกรณ์ต่อพ่วง</div>
<div  class="style2">5.มีอุปกรณ์คอมพิวเตอร์ สื่อโสตทัศน์ เทคโนโลยีที่ทันสมัย เพียงพอและเหมาะสม"</div>
<div  class="style2">6.มีส่วนร่วมในการให้ข้อมูลลงฐานข้อมูล</div>
<div  class="style2">7.ความถูกต้อง ชัดเจน น่าเชื่อถือของข้อมูล</div>
<div  class="style2">8.การให้บริการฐานข้อมูลและการค้นหาครบถ้วน</div>
<div  class="style2">9.ความทั่วถึงของระบบเครือข่ายคอมพิวเตอร์ครอบคลุมไปถึงทุกหน่วยงาน</div>
<div  class="style2">10.ได้รับการให้บริการตรงกับความต้องการ</div>
<div  class="style2">11.ความทันสมัยของอุปกรณ์ โปรแกรมที่ให้บริการ</div>
<div  class="style2">12.ชี้แจงและให้คำแนะนำเกี่ยวกับการให้บริการที่ชัดเจน</div>
<div  class="style2">13.ประสิทธิภาพการใช้งานหลังการให้บริการ</div>
<div  class="style2">14.โปรแกรมคอมพิวเตอร์มีประโยชน์ต่อผู้ใช้</div>
<div  class="style2">15.มีระบบช่วยในการเข้าใช้ข้อมูล กรณีที่เกิดปัญหา</div>
<div  class="style2">16.โดยภาพรวมทั้งหมดท่านมีความพึงพอใจอยู่ในระดับใด</div>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <td class="style0"><div align="center"><strong>ลำดับ</strong></div></td>
          <td class="style0"><div align="center"><strong>row_id</strong></div></td>
          <td class="style0"><div align="center"><strong>ชื่อ-นามสกุล</strong></div></td>
          <td class="style0"><div align="center"><strong>Menucode</strong></div></td>
          <td class="style0"><div align="center"><strong>1</strong></div></td>
          <td class="style0"><div align="center"><strong>2</strong></div></td>
          <td class="style0"><div align="center"><strong>3</strong></div></td>
          <td class="style0"><div align="center"><strong>4</strong></div></td>
          <td class="style0"><div align="center"><strong>5</strong></div></td>
          <td class="style0"><div align="center"><strong>6</strong></div></td>
          <td class="style0"><div align="center"><strong>7</strong></div></td>
          <td class="style0"><div align="center"><strong>8</strong></div></td>
          <td class="style0"><div align="center"><strong>9</strong></div></td>
          <td class="style0"><div align="center"><strong>10</strong></div></td>
          <td class="style0"><div align="center"><strong>11</strong></div></td>
          <td class="style0"><div align="center"><strong>12</strong></div></td>
          <td class="style0"><div align="center"><strong>13</strong></div></td>
          <td class="style0"><div align="center"><strong>14</strong></div></td>
          <td class="style0"><div align="center"><strong>15</strong></div></td>
          <td class="style0"><div align="center"><strong>สรุป</strong></div></td>
          <td class="style0"><div align="center"><strong>รวม</strong></div></td>
          <td class="style0"><div align="center"><strong>ร้อยละ</strong></div></td>
     
        </tr>
      </thead>
      <tbody>
        <?php
     while($show=mysql_fetch_assoc($rs)){
$sum=$show['q1']+$show['q2']+$show['q3']+$show['q4']+$show['q5']+$show['q6']+$show['q7']+$show['q8']+$show['q9']+$show['q10']+$show['q11']+$show['q12']+$show['q13']+$show['q14']+$show['q15'];
$p5=round((($sum*100)/75),2); 
$sum1+=$sum; 
$count++;?>
        <tr>
          <td class="style1"><div align="center">
            <?=$count;?>
          </div></td>
          <td class="style1"><div align="left">
            <?=$show['row_id'];?>
          </div></td>
          <td class="style1"><div align="left">
            <?=$show['name'];?><?=$show['date'];?>
          </div></td>
          <td class="style1"><div align="left">
            <?=$show['menucode'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q1'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q2'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q3'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q4'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q5'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q6'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q7'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q8'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q9'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q10'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q11'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q12'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q13'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q14'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$show['q15'];?>
          </div></td>
          <td class="style1.1"><div align="center">
            <?=$show['q16'];?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$sum;?>
          </div></td>
          <td class="style1"><div align="center">
            <?=$p5;?>
          </div></td>
        </tr>
        <? } ?>
        
        <?
          $p1=round((($sum1*100)/(75*$count)),2); 
		  
		  $sql1="SELECT sum( q1 ) , sum( q2 ) , sum( q3 ) , sum( q4 ) , sum( q5 ) , sum( q6 ) , sum( q7 ) , sum( q8 ) , sum( q9 ) , sum( q10 ) , sum( q11 ) , sum( q12 ) , sum( q13 ) , sum( q14 ) , sum( q15 ) ,sum( q16 )
FROM tb_assess AS a
INNER  JOIN inputm AS b ON ( a.row_id = b.row_id ) where a.year ='$nPrefix'  "; $rs1= mysql_query($sql1); $show1=mysql_fetch_assoc($rs1)?>
        <tr>
          <td colspan="4" class="style2"><div align="center"><b>คะแนนรวม</b></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q1 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q2 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q3 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q4 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q5 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q6 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q7 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q8 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q9 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q10 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q11 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q12 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q13 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q14 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q15 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$show1['sum( q16 )'];?>
            </strong></div></td>
          <td class="style2">
            <div align="center"><strong>
              <?=$sum1;?>
            </strong></div></td>
          <td class="style2"><div align="center"><b>
            <?=$p1;?>
          </b></div></td>
        </tr>
      </table></td>
  </tr>
</table>
