



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
   ////*runno ��Ǩ�آ�Ҿ*/////////
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
////*runno ��Ǩ�آ�Ҿ*/////////



   $sql="select * from tb_assess inner join inputm on(tb_assess.row_id=inputm.row_id) where tb_assess.year ='$nPrefix'  group by tb_assess.row_id  order by tb_assess.date desc";
   $rs= mysql_query($sql); ?>
   <a target=_self  href='../../nindex.htm' ><------ �����</a>
<strong>��§ҹ��Ẻ�����Թ�����֧���&nbsp;&nbsp;������ԡ��������ç��Һ�� �� <?php echo $nPrefix; ?> </strong> </div>
<?php include "question.php"; ?>

<div  class="style2">1.����ö��Ҷ֧��ԡ������� ��鹵͹㹡������ԡ���դ������ͧ��� �������ҡ �Ѻ��͹</div>
<div  class="style2">2.��кǹ���㹡������ԡ��������� ����Ǵ���ǩѺ��</div>
<div  class="style2">3.���˹�ҷ������ԡ�� ����������� ��е������� ��������ԡ��</div>
<div  class="style2">4.������ӻ�֡����еͺ��ͫѡ�������ǡѺ����ͧ��������������ػ�ó��;�ǧ</div>
<div  class="style2">5.���ػ�ó���������� �����ʵ��ȹ� ෤����շ��ѹ���� ��§������������"</div>
<div  class="style2">6.����ǹ����㹡����������ŧ�ҹ������</div>
<div  class="style2">7.�����١��ͧ �Ѵਹ ������Ͷ�ͧ͢������</div>
<div  class="style2">8.�������ԡ�ðҹ��������С�ä��Ҥú��ǹ</div>
<div  class="style2">9.�������Ƕ֧�ͧ�к����͢��¤����������ͺ����件֧�ء˹��§ҹ</div>
<div  class="style2">10.���Ѻ�������ԡ�õç�Ѻ������ͧ���</div>
<div  class="style2">11.�����ѹ���¢ͧ�ػ�ó� ������������ԡ��</div>
<div  class="style2">12.���ᨧ��������й�����ǡѺ�������ԡ�÷��Ѵਹ</div>
<div  class="style2">13.����Է���Ҿ�����ҹ��ѧ�������ԡ��</div>
<div  class="style2">14.����������������ջ���ª���ͼ����</div>
<div  class="style2">15.���к�����㹡������������ �óշ���Դ�ѭ��</div>
<div  class="style2">16.���Ҿ�����������ҹ�դ����֧���������дѺ�</div>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
<tbody>
  <tr>
    <td><table width="100%" border="1" cellpadding="0" cellspacing="0">
      <thead>
        <tr>
          <td class="style0"><div align="center"><strong>�ӴѺ</strong></div></td>
          <td class="style0"><div align="center"><strong>row_id</strong></div></td>
          <td class="style0"><div align="center"><strong>����-���ʡ��</strong></div></td>
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
          <td class="style0"><div align="center"><strong>��ػ</strong></div></td>
          <td class="style0"><div align="center"><strong>���</strong></div></td>
          <td class="style0"><div align="center"><strong>������</strong></div></td>
     
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
          <td colspan="4" class="style2"><div align="center"><b>��ṹ���</b></div></td>
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
