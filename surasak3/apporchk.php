<form method="POST" action="orappoi.php">
  <p><font face="Angsana New size = 3 ">����ª��ͼ����¹Ѵ ��ҵѴ��Ш���͹<BR>
    ��Ҵٷ����͹����ͧ���͡�ѹ���<BR>&#3609;&#3633;&#3604;&#3617;&#3634;&#3623;&#3633;&#3609;&#3607;&#3637;&#3656;&nbsp;&nbsp;&nbsp;&nbsp;
  <select size="1" name="appdate" id="appdate">
    <option selected="selected">--�ѹ���--</option>
     <option value="">������͡</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
  </select>
&nbsp;&nbsp;&nbsp;&nbsp;<select size="1" name="appmo">
    <option selected>--��͹--</option>
    <option value="���Ҥ�">���Ҥ�</option>
    <option value="����Ҿѹ��">����Ҿѹ��</option>
    <option value="�չҤ�">�չҤ�</option>
    <option value="����¹">����¹</option>
    <option value="����Ҥ�">����Ҥ�</option>
    <option value="�Զع�¹">�Զع�¹</option>
    <option value="�á�Ҥ�">�á�Ҥ�</option>
    <option value="�ԧ�Ҥ�">�ԧ�Ҥ�</option>
    <option value="�ѹ��¹">�ѹ��¹</option>
    <option value="���Ҥ�">���Ҥ�</option>
    <option value="��Ȩԡ�¹">��Ȩԡ�¹</option>
    <option value="�ѹ�Ҥ�">�ѹ�Ҥ�</option>
	
 </select> <!--&nbsp;&nbsp; &#3614;.&#3624;.<select size="1" name="thiyr">
    <option selected>2547</option>
    <option>2548</option>
    <option>2549</option>
    <option>2550</option>
    <option>2551</option>
    <option>2552</option>
    <option>2553</option>
	<option>2554</option>
	<option>2555</option>
	<option>2556</option>
  </select>-->
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr' class='fontsara'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
  </p>
  
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;     " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>
