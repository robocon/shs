<?php
?>
<form method="POST" action="den1day.php" >
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
��ػ�ӹǹ�ѵ���âͧ�ͧ�ѹ����� ����ѹ</b></font></font></p>
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
  </select><!--<select size="1" name="thiyr">
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option selected>2551</option>
    <option>2552</option>
    <option>2553</option>
    <option>2554</option>
    <option>2555</option>

  </select>-->
  <select name="thiyr">
    <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
    <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
    <?php }?>
  </select>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="         &#3605;&#3585;&#3621;&#3591;       " name="B1">

<?php
    print "&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
?>