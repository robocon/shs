<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.fontform {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<form method="POST" action="export_person1.php">
<p style="font-weight:bold">�ҹ�����Ŵ�ҹ���ᾷ������آ�Ҿ ��ٻẺ 43 ����ҵðҹ ���ҧ���1 ���ҧ PERSON ������͹</p>
<div>��������Ż�ЪҪ��ࢵ�Ѻ�Դ�ͺ��м�����</div>
  <p style="margin-left: 20px;">��͹ : <select name="rptmo" size="1" class="fontform">
    <option selected>---- ��͹ ----</option>
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
  </select>
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr' class='fontform'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
    <input name="B1" type="submit" class="fontform" value="    ��ŧ    ">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../../nindex.htm'><< �����</a></p>
</form>
