<form method="POST" action="appoited.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   ��ª��ͼ����¹Ѵ���ᾷ��</b></font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
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
  <p><font face="Angsana New">ᾷ����Ѵ&nbsp;


 <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y' order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }?>
</font> </p>
<p>�Ѵ������
  <select size="1" name="detail2">
    <option value="">�ٷ�����</option>
    <?
      $app = "select * from applist  WHERE status='Y' ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
		  $str="";
		  if($menucode == "ADMMAINOPD"){ 
		  	$str = " Selected ";
		  }
?>
    <option value="<?=$result['appvalue']?>" <?=$str;?>>
      <?=$result['applist']?>
      </option>
    <?
	  }
?>
    <!--<option value="FU01" <?php //if($menucode == "ADMMAINOPD"){ echo " Selected ";}?>>��Ǩ����Ѵ</option>
<option value="FU02">����ŵ�Ǩ</option>
<option value="FU03">�͹�ç��Һ��</option>
<option value="FU04">�ѹ�����</option>
<option value="FU05">��ҵѴ</option>
<option value="FU06">�ٵ�</option>
<option value="FU07">��չԡ�ѧ���</option>
<option value="FU08">Echo</option>
<option value="FU09">��š�д١</option>
<option value="FU10">����Ҿ</option>
<option value="FU11">��Ǩ����Ѵ���������ѵԼ������</option>
<option value="FU12">�ǴἹ��</option>
<option value="FU13">��ͧ������</option>
<option value="FU20)">��ͧ������(��Թԡ�����)</option>
<option value="FU14">������ʹ��辺ᾷ��</option>
<option value="FU15">OPD �͡�����Ҫ���</option>
<option value="FU16">��Թԡ���¡����͡���Ҿ����(��Һ�ԡ�� 100 �ҷ)</option>
<option value="FU17">X-ray ��辺ᾷ��</option>
<option value="FU18">�Ѵ������ ER ��辺ᾷ��</option>
<option value="FU19"> ��ŵ��ҫ�Ǵ�</option>
<option value="FU21">��Թԡ C OPD</option>
<option value="FU22">OPD �Ǫ��ʵ���蹿�</option>
<option value="FU26">EMG</option>
<option value="FU27">X-ray ��͹��ᾷ��</option>
<option value="FU28">Lab ��͹��ᾷ��</option>
<option value="FU29">X-ray + Lab ��͹��ᾷ��</option>
<option value="FU30 ��Թԡ�ä�">��Թԡ�ä�</option>-->
  </select>
</p>
  <input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a>&nbsp&nbsp;&nbsp<a target=_self  href='hnappoi1.php'>�͡㺹Ѵ����</a></p>
  </form>
    <br><a target=_BLANK href="calendar.php">��ԷԹ</a>

<form method="POST" action="appoited1.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   ��ª��ͼ����¹Ѵ���Ἱ�</b></font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;

<select size="1" name="appdate">
    <option selected>--�ѹ���--</option>
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
    

<select size="1" name="appmo">
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
  <p><font face="Angsana New">Ἱ����Ѵ&nbsp;

  <select size="1" name="detail">
    <option selected><���͡Ἱ�></option>
    <?
      $app = "select * from applist   WHERE status='Y' ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
?>
<option value="<?=$result['appvalue']?>" ><?=$result['applist']?></option>
<?
	  }
?>
    <!--<option value="FU01 ��Ǩ����Ѵ">��Ǩ����Ѵ</option>
<option value="FU02 ����ŵ�Ǩ">����ŵ�Ǩ</option>
<option value="FU03 �͹�ç��Һ��">�͹�ç��Һ��</option>
<option value="FU04 �ѹ�����">�ѹ�����</option>
<option value="FU05 ��ҵѴ">��ҵѴ</option>
<option value="FU06 �ٵ�">�ٵ�</option>
<option value="FU07 ��չԡ�ѧ���">��չԡ�ѧ���</option>
<option value="FU08 Echo">Echo</option>
<option value="FU09 ��š�д١">��š�д١</option>
<option value="FU10 ����Ҿ">����Ҿ</option>
<option value="FU11 ��Ǩ����Ѵ���������ѵԼ������">��Ǩ����Ѵ���������ѵԼ������</option>
<option value="FU12 �ǴἹ��">�ǴἹ��</option>
<option value="FU13 ��ͧ������">��ͧ������</option>
<option value="FU20 ��ͧ������(��Թԡ�����)">��ͧ������(��Թԡ�����)</option>
<option value="FU14 ������ʹ��辺ᾷ��">������ʹ��辺ᾷ��</option>
<option value="FU15 OPD �͡����">OPD �͡�����Ҫ���</option>
<option value="FU16 ��Թԡ�����">��Թԡ���¡����͡���Ҿ����(��Һ�ԡ�� 100 �ҷ)</option>
<option value="FU17 X-ray ��辺ᾷ��">X-ray ��辺ᾷ��</option>
<option value="FU18 �Ѵ������ ER ��辺ᾷ��">�Ѵ������ ER ��辺ᾷ��</option>
<option value="FU19 ��ŵ��ҫ�Ǵ�"> ��ŵ��ҫ�Ǵ�</option>
<option value="FU21 ��Թԡ C OPD">��Թԡ C OPD</option>
<option value="FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�">OPD �Ǫ��ʵ���蹿�</option>
<option value="FU26 EMG">EMG</option>
<option value="FU27 X-ray ��͹��ᾷ��">X-ray ��͹��ᾷ��</option>
<option value="FU28 Lab ��͹��ᾷ��">Lab ��͹��ᾷ��</option>
<option value="FU29 X-ray + Lab ��͹��ᾷ��">X-ray + Lab ��͹��ᾷ��</option>
<option value="FU30 ��Թԡ�ä�">��Թԡ�ä�</option>-->

    </select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
 </form>

  <form method="POST" action="appoited3.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   ��ª��ͼ����µ����ùѴ������</b></font></font></p>
  <font face="Angsana New">�ѹ���&nbsp;&nbsp;

<select size="1" name="appdate">
    <option value="" selected>--</option>
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
    

<select size="1" name="appmo">
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
  <p><font face="Angsana New">�Ѵ������&nbsp;

<select size="1" name="detail">
<?
      $app = "select * from applist   WHERE status='Y'  ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
?>
<option value="<?=$result['appvalue']?>" ><?=$result['applist']?></option>
<?
	  }
?>
<!--<option value="FU01 ��Ǩ����Ѵ">��Ǩ����Ѵ</option>
<option value="FU02 ����ŵ�Ǩ">����ŵ�Ǩ</option>
<option value="FU03 �͹�ç��Һ��">�͹�ç��Һ��</option>
<option value="FU04 �ѹ�����">�ѹ�����</option>
<option value="FU05 ��ҵѴ">��ҵѴ</option>
<option value="FU06 �ٵ�">�ٵ�</option>
<option value="FU07 ��չԡ�ѧ���">��չԡ�ѧ���</option>
<option value="FU08 Echo">Echo</option>
<option value="FU09 ��š�д١">��š�д١</option>
<option value="FU10 ����Ҿ">����Ҿ</option>
<option value="FU11 ��Ǩ����Ѵ���������ѵԼ������">��Ǩ����Ѵ���������ѵԼ������</option>
<option value="FU12 �ǴἹ��">�ǴἹ��</option>
<option value="FU13 ��ͧ������">��ͧ������</option>
<option value="FU20 ��ͧ������(��Թԡ�����)">��ͧ������(��Թԡ�����)</option>
<option value="FU14 ������ʹ��辺ᾷ��">������ʹ��辺ᾷ��</option>
<option value="FU15 OPD �͡����">OPD �͡�����Ҫ���</option>
<option value="FU16 ��Թԡ�����">��Թԡ���¡����͡���Ҿ����(��Һ�ԡ�� 100 �ҷ)</option>
<option value="FU17 X-ray ��辺ᾷ��">X-ray ��辺ᾷ��</option>
<option value="FU18 �Ѵ������ ER ��辺ᾷ��">�Ѵ������ ER ��辺ᾷ��</option>
<option value="FU19 ��ŵ��ҫ�Ǵ�"> ��ŵ��ҫ�Ǵ�</option>
<option value="FU21 ��Թԡ C OPD">��Թԡ C OPD</option>
<option value="FU22 ��Ǩ����ѴOPD �Ǫ��ʵ���蹿�">OPD �Ǫ��ʵ���蹿�</option>
<option value="FU26 EMG">EMG</option>
<option value="FU27 X-ray ��͹��ᾷ��">X-ray ��͹��ᾷ��</option>
<option value="FU28 Lab ��͹��ᾷ��">Lab ��͹��ᾷ��</option>
<option value="FU29 X-ray + Lab ��͹��ᾷ��">X-ray + Lab ��͹��ᾷ��</option>
<option value="FU30 ��Թԡ�ä�">��Թԡ�ä�</option>-->

</select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>


