<?
session_start();
include("connect.inc");
$m=date('m');
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.fromtxt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<h2>��س����͡��͹��лշ���ͧ��ô٢�����</h2>
<form id="form1" name="form1" method="post" action="report_listsumvnmount.php">
<input name="act" type="hidden" value="show">
���͡ ��͹ : 
	<select name="m_start" class="fromtxt">
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
        </select>
		�� �.�. 
<? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='fromtxt'>";
				foreach($dates as $i){
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "</select>";
				?>&nbsp;&nbsp;&nbsp;
<input name="button" type="submit" class="fromtxt" id="button" value="��ŧ" />                
&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'> ����� </a></form>
<?
if($_POST["act"]=="show"){
$mount=$_POST["m_start"];
$year=$_POST["y_start"];
$sql="select distinct(ptright) from opday where thidate like '$year-$mount%' and ptright !=''";
$query=mysql_query($sql);
?>	
<hr>
<h3>�����ż����·�������ԡ���ç��Һ���¡����Է��<br>
��Ш���͹ <?="$mount/$year";?></h3>
<table width="50%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center">�ѹ���</td>
    <?
	while(list($ptright)=mysql_fetch_array($query)){
	?>
    <td align="center"><?=$ptright;?></td>
    <?
	}
	?>
  </tr>
 <?
if($mount=="01" || $mount=="03" || $mount=="05" || $mount=="07" || $mount=="08" || $mount=="10" || $mount=="12"){
$n=31;
}else if($mount=="04" || $mount=="06" || $mount=="09" || $mount=="11"){
$n=30;
}else if($mount=="02"){
$n=28;
}
for($i=1;$i<=$n;$i++){
 ?> 
  <tr>
    <td align="center"><?=$i;?></td>
   <?
   $sql="select distinct(ptright) from opday where thidate like '$year-$mount%'  and ptright !=''";
   $query=mysql_query($sql);
   while(list($ptright)=mysql_fetch_array($query)){
	$date=sprintf("%02d",$i);
	$sql1="select count(row_id) from opday where thidate like '$year-$mount-$date%' and ptright='$ptright'";
    $query1=mysql_query($sql1);   
    list($count)=mysql_fetch_array($query1)
   ?> 
    <td align="right"><?=$count;?></td>
  <?
  }
  ?>
  </tr>
  <?
  }
  ?>
</table>

<?
}
?>