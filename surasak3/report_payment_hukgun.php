<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.style1 {
	font-size: 20px;
	font-weight: bold;
}
.style2 {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
 include("connect.inc");  
?> 
<p align="center" class="style1">��§ҹ�������µ�Ǩ�آ�Ҿ�ç����ѡ�ѹ������</p>
<div align="center"><a href="../nindex.htm"><<< ����� >>></a></div>
<form action="report_payment_hukgun1.php" method="post" target="_blank">
<p align="center">�ѹ��� : <input name="chkdate" type="text" class="style2" value="<? echo date("d");?>" size="5">
��͹ :   
<select name="chkmonth" class="style2">
    <option selected>-------���͡-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";} ?>>���Ҥ�</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";} ?>>����Ҿѹ��</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";} ?>>�չҤ�</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";} ?>>����¹</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";} ?>>����Ҥ�</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";} ?>>�Զع�¹</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";} ?>>�á�Ҥ�</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";} ?>>�ԧ�Ҥ�</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";} ?>>�ѹ��¹</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";} ?>>���Ҥ�</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";} ?>>��Ȩԡ�¹</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";} ?>>�ѹ�Ҥ�</option>

  </select> �� �.�. :  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='chkyear'  class='style2'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?> </p>
<p align="center"><input type="submit" name="submit" value="����§ҹ"></p>
</form>