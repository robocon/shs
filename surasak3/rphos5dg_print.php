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
����¹���������Ǫ�ѳ��
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
      <option value="02">����Ҿѹ��</option>
      <option value="03" selected="selected">�չҤ�</option>
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
   <option value="02">����Ҿѹ��</option>
   <option value="03" selected="selected">�չҤ�</option>
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
	$thmon = array('','�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.');
	if(isset($_GET['dg'])){
			 $drugcode=$_GET['dg'];
	}
	else {
	
	}

if(!empty($drugcode)){
	$query = "SELECT drugcode,tradname,genname,unit,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$drugcode' ";
	$result = mysql_query($query) or die("Query failed");

	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
				continue;
			}

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }

		if(mysql_num_rows($result)){
			$dcode=$row->drugcode;
			$tname=$row->tradname;
			$nstock=$row->stock;
			$nmainstk=$row->mainstk;
			$ntotalstk=$row->totalstk;	
			$cUnit  = $row->unit;
		}


$page=1;
    print  "<center><font face='Angsana New'><b>����¹���������Ǫ�ѳ��</b></center>";
	print  "�蹷��........$page.........<br> ";
	print  "������...............................�������ͪ�Դ��ʴ�...$tname....<br> ";
	print  "��Ҵ�����ѡɳ�...............................�ӹǹ���ҧ�٧.................................................<br> ";
	print  "˹��¹Ѻ......................�����............................�ӹǹ���ҧ���...................................<br> ";
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
</span>
<tr>
  <td colspan="2" align="center" class="font1" >�.� 
    <?=$_POST['y_end']+543;?>
  </td>
  <td rowspan="2" align="center" class="font1" >����͡���</td>
  <td rowspan="2" align="center" class="font1" >�Ѻ�ҡ-�������</td>
  <td rowspan="2" align="center" class="font1" >�Ţ����Ѻ<br>�ӴѺ��ѧ</td>
  <td colspan="3" align="center" class="font1" >�Ѻ</td>
  <td colspan="3" align="center" class="font1">����</td>
  <td colspan="3" align="center" class="font1" >�������</td>
  <td rowspan="2" align="center" class="font1" >�����˵�</td>
  </tr>
  <tr>
    <td align="center" class="font1" >��͹</td>
    <td align="center" class="font1" >�ѹ���</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1">�Ҥҵ��˹���</td>
    <td align="center" class="font1">�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
  </tr>
<span class="font1">
<?
		$_POST['day2']=trim($_POST['day2']);
		$query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  FROM stktranx  WHERE drugcode = '$drugcode' and (getdate between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']."' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']."') ORDER BY getdate limit 1";
		//echo $query."<br>";
		
		$result = mysql_query($query) or die("Query failed");
    	$num=0;
   		list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result);

		if($stkcut==0){  //��ҿ�Ŵ�Ѵ�� ��ҡѺ 0 (�ա��Ѻ���)
			$total =$mainstk-$amount;
			//echo "�ա���Ѻ��� $mainstk-$amount==>".$total."<br>";
		}else{
			$total =$mainstk+$stkcut;
			//echo "$mainstk+$stkcut==>".$total."<br>";
		}
		$totalpri = $total*$unitpri;
		$month = substr($getdate,5,2);
		$day = substr($getdate,8,2);
		$month=$thmon[$month+0];
		print (" <tr>\n".
           "  <td align='center'><font face='Angsana New'>$month</td>\n".
           "  <td align='center'><font face='Angsana New'>01</td>\n".
           "  <td ><font face='Angsana New'>&nbsp;</td>\n".
           "  <td ><font face='Angsana New'>�ʹ¡��</td>\n".
		   "  <td ><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$total</td>\n".
           "  <td  align='right'><font face='Angsana New'>$totalpri</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           " </tr>\n");
		   
		$query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  FROM stktranx  WHERE drugcode = '$drugcode' and (getdate between '".$_POST['y_start']."-".$_POST['mon1']."-".$_POST['day1']."' and '".$_POST['y_end']."-".$_POST['mon2']."-".$_POST['day2']."') ORDER BY getdate ";
		//echo $query;
		
		$result = mysql_query($query) or die("Query failed");
    	$num=0;
   		while (list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result)) {
			$k++;
			$sql3 = "select stkno from combill where billno = '$billno' and lotno='$lotno' ";
			//echo $sql3;
			$row3 = mysql_query($sql3);
			list($stkno)=mysql_fetch_array($row3);
			
			$num++;
			$netprice  =$unitpri*$amount;  //�Ҥҵ��˹���*�ӹǹ
			$stkcutpri =$unitpri*$stkcut;
			$netlotpri =$unitpri*$netlotno;
			$mainstkpri =$unitpri*$mainstk;
			$month = substr($getdate,5,2);
			$day = substr($getdate,8,2);
			
			$month=$thmon[$month+0];
			
        	print (" <tr>\n".
           "  <td align='center'><font face='Angsana New'>$month</td>\n".
           "  <td align='center'><font face='Angsana New'>$day</td>\n".
           "  <td ><font face='Angsana New'>&nbsp;$billno</td>\n".
           "  <td ><font face='Angsana New'>$department</td>\n".
		   "  <td ><font face='Angsana New'>&nbsp;$stkno</td>\n");  //�Ţ����Ѻ�ӴѺ��ѧ
		   if($netprice==0){
			   print ("  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n". 
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n");
		   }else{
			   print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
			   "  <td  align='right'><font face='Angsana New'>$amount</td>\n".
			   "  <td  align='right'><font face='Angsana New'>$netprice</td>\n");
		   }
		   
		   if($stkcut ==0 || $stkcut ==""){
			   print ("  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n". 
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
			   "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n");
		   }else{
			   if($stkcutpri==0){  //�Һ�ԨҤ
					print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcut</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcutpri</td>\n");
			   }else{
					print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcut</td>\n".
					"  <td  align='right'><font face='Angsana New'>$stkcutpri</td>\n");
			   }
			}
		   
           print ("  <td  align='right'><font face='Angsana New'>$unitpri</td>\n".
		   "  <td  align='right'><font face='Angsana New'>$mainstk</td>\n".
           "  <td  align='right'><font face='Angsana New'>$mainstkpri</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
           " </tr>\n");
		   /*
		    "  <td  align='right'><font face='Angsana New'>$netlotno</td>\n".
           "  <td  align='right'><font face='Angsana New'>$netlotpri</td>\n".
           "  <td  align='right'><font face='Angsana New'>&nbsp;</td>\n".
		   */
		   if($k==20){
			   $k=0;
			   $page++;
		   	echo "</table>";
			echo "<div style='page-break-after:always'></div>";
		   	print  "<center><font face='Angsana New'><b>����¹���������Ǫ�ѳ��</b></center>";
			print  "�蹷��........$page.........<br> ";
			print  "������...............................�������ͪ�Դ��ʴ�....$tname....<br> ";
			print  "��Ҵ�����ѡɳ�...............................�ӹǹ���ҧ�٧.................................................<br> ";
			print  "˹��¹Ѻ......................�����............................�ӹǹ���ҧ���...................................<br> ";
?>
</span>
<table width="100%" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
  <td colspan="2" align="center" class="font1" >�.� 
    <?=$_POST['y_end']+543;?>
  </td>
  <td rowspan="2" align="center" class="font1" >����͡���</td>
  <td rowspan="2" align="center" class="font1" >�Ѻ�ҡ-�������</td>
  <td rowspan="2" align="center" class="font1" >�Ţ����Ѻ<br>�ӴѺ��ѧ</td>
  <td colspan="3" align="center" class="font1" >�Ѻ</td>
  <td colspan="3" align="center" class="font1">����</td>
  <td colspan="3" align="center" class="font1" >�������</td>
  <td rowspan="2" align="center" class="font1" >�����˵�</td>
  </tr>
  <tr>
    <td align="center" class="font1" >��͹</td>
    <td align="center" class="font1" >�ѹ���</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1">�Ҥҵ��˹���</td>
    <td align="center" class="font1">�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
    <td align="center" class="font1" >�Ҥҵ��˹���</td>
    <td align="center" class="font1" >�ӹǹ</td>
    <td align="center" class="font1" >�ӹǹ�Թ</td>
  </tr>
  <?
		   }
		   
		}
}
}
include("unconnect.inc");
?>
</table> 