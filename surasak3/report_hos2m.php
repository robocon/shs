<?php
    include("connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
</style>
<div id="no_print" >
<span class="font1"><font face='Angsana New'>
��Ť�ҷҧ��
</span>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <span class="font1">
  ������ѹ��� 
  <select name="day1">
    <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
    <option value="<?=$i?>">
      <?=$i?>
      </option>
    <?
	}
  ?>
  </select>
  ��͹ 
    <select name="mon1">
      <option value="01">���Ҥ�</option>
      <option value="02" selected="selected">����Ҿѹ��</option>
      <option value="03">�չҤ�</option>
      <option value="04">����¹</option>
      <option value="05">����Ҥ�</option>
      <option value="06">�Զع�¹</option>
      <option value="07">�á�Ҥ�</option>
      <option value="08">�ԧ�Ҥ�</option>
      <option value="09">�ѹ��¹</option>
      <option value="10" >���Ҥ�</option>
      <option value="11">��Ȩԡ�¹</option>
      <option value="12">�ѹ�Ҥ�</option>
    </select>
�� 
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_start' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543;?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
�֧�ѹ��� 
<select name="day2">
  <?
  	for($i=1;$i<32;$i++){
		if($i<10){
			$i="0".$i;
		}
   		?>
  <option value="<?=$i?> ">
    <?=$i?>
    </option>
  <?
	}
  ?>
</select>
��͹ 
 <select name="mon2">
   <option value="01">���Ҥ�</option>
   <option value="02" selected="selected">����Ҿѹ��</option>
   <option value="03">�չҤ�</option>
   <option value="04">����¹</option>
   <option value="05">����Ҥ�</option>
   <option value="06">�Զع�¹</option>
   <option value="07">�á�Ҥ�</option>
   <option value="08">�ԧ�Ҥ�</option>
   <option value="09">�ѹ��¹</option>
   <option value="10" >���Ҥ�</option>
   <option value="11">��Ȩԡ�¹</option>
   <option value="12">�ѹ�Ҥ�</option>
 </select>
��
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='y_end' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
</font>
<input name="BOK" value="��ŧ" type="submit" />
  </span>
</form>
</div>
<span class="font1">
<?
if(isset($_POST['BOK'])){
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӴѺ��ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���觫���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ�ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡�ë���</th>
  <th bgcolor=6495ED><font face='Angsana New'>LotNo</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�.�.5</th>
 </tr>

<?php
    include("connect.inc");
    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,price,stkbak,packamt FROM combill WHERE (date between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']."' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']."') ORDER BY getdate";
	//echo $query;
    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
   
  // echo $query;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

/*
          if ($packamt > 0){
 	$npack  =$stkbak/$packamt;
	  	     }
          else {
	$npack  ='';
	  }
*/
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">�.�.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
  print "<br>�����Ť�ҫ���������Ǫ�ѳ�������  $netprice �ҷ";
?>

</table>
<? } ?>