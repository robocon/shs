<?php
?>
<form method="POST" action="er1day.php" >
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
 ��§ҹ�ӹǹ�ѵ���âͧ��ͧ�ء�Թ����ѹ</b></font></font></p>
  <p><font face="Angsana New"><font size="3">
 (�ѹ��� 01,02,....30,31  ���������ѹ��� ���繢����ŵ����͹)</font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
    <option selected>--��͹--</option>
    <option value="01">���Ҥ�</option>
    <option value="02">����Ҿѹ��</option>
    <option value="03">�չҤ�</option>
    <option value="04">����¹</option>
    <option value="05">����Ҥ�</option>
    <option value="06">�Զع�¹</option>
    <option value="07">�á�Ҥ�</option>
    <option value="08">�ԧ�Ҥ�</option>
    <option value="09">�ѹ��¹</option>
    <option value="10">���Ҥ�</option>
    <option value="11">��Ȩԡ�¹</option>
    <option value="12">�ѹ�Ҥ�</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="         &#3605;&#3585;&#3621;&#3591;       " name="B1">

<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>