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
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>����¹���������Ǫ�ѳ��</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
<font face="Angsana New">
��͹ 
</font>
</span>
<?
$mm=date("m");
?>
 <select name="mon">
   <option value="01" <? if($mm=="01"){ echo "selected='selected'";}?>>���Ҥ�</option>
   <option value="02" <? if($mm=="02"){ echo "selected='selected'";}?>>����Ҿѹ��</option>
   <option value="03" <? if($mm=="03"){ echo "selected='selected'";}?>>�չҤ�</option>
   <option value="04" <? if($mm=="04"){ echo "selected='selected'";}?>>����¹</option>
   <option value="05" <? if($mm=="05"){ echo "selected='selected'";}?>>����Ҥ�</option>
   <option value="06" <? if($mm=="06"){ echo "selected='selected'";}?>>�Զع�¹</option>
   <option value="07" <? if($mm=="07"){ echo "selected='selected'";}?>>�á�Ҥ�</option>
   <option value="08" <? if($mm=="08"){ echo "selected='selected'";}?>>�ԧ�Ҥ�</option>
   <option value="09" <? if($mm=="09"){ echo "selected='selected'";}?>>�ѹ��¹</option>
   <option value="10" <? if($mm=="10"){ echo "selected='selected'";}?>>���Ҥ�</option>
   <option value="11" <? if($mm=="11"){ echo "selected='selected'";}?>>��Ȩԡ�¹</option>
   <option value="12" <? if($mm=="12"){ echo "selected='selected'";}?>>�ѹ�Ҥ�</option>
 </select>
<span class="font1">
<font face="Angsana New">
��
</font>
</span>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='forntsarabun'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
<input name="BOK" value="��ŧ" type="submit" />
  </span>
</form>
</div>
<?
if(isset($_POST['BOK'])){
	$thmon = array('','�.�.','�.�.','��.�.','��.�.','�.�.','��.�.','�.�.','�.�.','�.�.','�.�.','�.�.','�.�.');
	
	if($_POST['mon']=="01"){
		$mon ="�.�.";
	}else if($_POST['mon']=="02"){
		$mon ="�.�.";
	}else if($_POST['mon']=="03"){
		$mon ="��.�.";
	}else if($_POST['mon']=="04"){
		$mon ="��.�.";
	}else if($_POST['mon']=="05"){
		$mon ="�.�.";
	}else if($_POST['mon']=="06"){
		$mon ="��.�.";
	}else if($_POST['mon']=="07"){
		$mon ="�.�.";
	}else if($_POST['mon']=="08"){
		$mon ="�.�.";
	}else if($_POST['mon']=="09"){
		$mon ="�.�.";
	}else if($_POST['mon']=="10"){
		$mon ="�.�.";
	}else if($_POST['mon']=="11"){
		$mon ="�.�.";
	}else if($_POST['mon']=="12"){
		$mon ="�.�.";
	}																		
	
	
	if(isset($_GET['dg'])){
			 $drugcode=$_GET['dg'];
	}
	else {
	}


$sql = "SELECT drugcode, LEFT(drugcode,2) as newdrugcode FROM druglst  where drugcode !='' group by drugcode order by drugcode";
$result = mysql_query($sql) or die("Query failed1");
$num=mysql_num_rows($result);
while($rows = mysql_fetch_array($result)){
	$dbdcode=trim($rows["drugcode"]);  // �Ҫ����ҷ��е��
	$newcode=$rows["newdrugcode"];
	//&& ($newcode =="11" && $dbdcode =="11KETO*" || $dbdcode =="11NEPH") || $newcode !="11"
//if(($newcode =="9U" && $dbdcode =="9ULTRA300" || $newcode =="11" && $dbdcode =="11KETO*" || $dbdcode =="11NEPH") || $newcode !="9B" && $newcode !="9D" && $newcode !="9E" && $newcode !="9F" && $newcode !="9U" && $newcode !="11" && $newcode !="12" && $newcode !="13" && $newcode !="14" && $newcode !="15" && $newcode !="16" && $newcode !="17" && $newcode !="18" && $newcode !="19"){

				$sql1 = "SELECT * FROM stktranx WHERE drugcode ='".$dbdcode."' order by row_id DESC limit 1";
				//echo ">>>".$sql1."<br>";
				$result1 = mysql_query($sql1) or die("Query failed2");
				$num1=mysql_num_rows($result1);
				while($row = mysql_fetch_array($result1)){
					$dcode=$row["drugcode"];
					//$tname=$row["tradname"];
					
					$tbsql = "SELECT tradname FROM druglst  where drugcode ='".$dcode."'";
					$tbresult = mysql_query($tbsql) or die("Query druglst failed");
					$tbrows = mysql_fetch_array($tbresult);
						$tname=$tbrows["tradname"];					
								
					$page = 1;
					print  "<center><font face='Angsana New'><b>����¹���������Ǫ�ѳ��</b></center>";
					print  "�蹷��........$page.........<br>";
					print  "������...............................�������ͪ�Դ��ʴ�...($dcode)$tname....<br> ";
					print  "��Ҵ�����ѡɳ�...............................�ӹǹ���ҧ�٧.................................................<br> ";
					print  "˹��¹Ѻ......................�����............................�ӹǹ���ҧ���...................................<br> ";
					
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse">
<tr>
  <td colspan="2" align="center" class="font1" >�.� 
    <?=$_POST['year']+543;?></td>
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
 <!--���ʴ���¡���ʹ¡�Ңͧ��͹����	-->   
<?
				$sqlchk = "SELECT drugcode FROM stktranx WHERE drugcode ='".$dbdcode."' and (getdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by drugcode order by getdate,row_id";
				//echo "$sqlchk </br>";
				$resultchk = mysql_query($sqlchk) or die("Query failed2");
				 list($chkcode) = mysql_fetch_row ($resultchk);
				$chkcode = trim($chkcode);
				$dcode = trim($dcode);
   				//echo "$dcode<===>$chkcode";
   if($dcode ==$chkcode){
   		//echo "$dcode == $chkcode </br>";
  		$query3 = "SELECT getdate,billno,drugcode,tradname,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  FROM stktranx  WHERE drugcode ='".$dbdcode."' and (getdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') ORDER BY getdate limit 1";  // �ʹ¡��
		//echo "��ҡѺ : ".$query3."<br>";
		$result3 = mysql_query($query3) or die("Query failed");
   		list($getdate,$billno,$drugcode,$tname,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result3);
		
		if($stkcut==0){  //��ҿ�Ŵ�Ѵ�� ��ҡѺ 0 (�ա���Ѻ���)
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
	}else{
		//echo "'$dcode' != '$chkcode' </br>";
		$yearchk=$_POST["year"];
		$monthchk=$_POST["mon"];
		$monthchk=sprintf("%02d",$monthchk);
  		$query3 = "SELECT getdate,billno,drugcode,tradname,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk  FROM stktranx  WHERE drugcode ='".$dbdcode."'  and getdate < '$yearchk-$monthchk-01' ORDER BY getdate DESC, row_id DESC limit 1";  // �ʹ¡��
		//echo "�����ҡѺ : ".$query3;	
		$result3 = mysql_query($query3) or die("Query failed");
   		list($getdate,$billno,$drugcode,$tname,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result3);

		$total =$mainstk;
		$totalpri = $total*$unitpri;
		$month = substr($getdate,5,2);
		$day = substr($getdate,8,2);
		$month=$thmon[$month+0];		
	}
  ?>
		<tr align="right">
           <td align="center"><font face="Angsana New"><?=$mon;?></font></td>
           <td align="center"><font face="Angsana New">01</font></td>
           <td ><font face="Angsana New">&nbsp;</font></td>
           <td align="left"><font face="Angsana New">�ʹ¡��</font></td>
		   <td ><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
           <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		   <td  align="right"><font face="Angsana New"><?=$unitpri;?></font></td>
		   <td  align="right"><font face="Angsana New"><?=$total;?></font></td>
           <td  align="right"><font face="Angsana New"><?=number_format($totalpri,2);?></font></td>
           <td  align="right"><font face="Angsana New">&nbsp;</font></td>
           </tr>
 <!--�����ʴ���¡���ʹ¡�Ңͧ��͹����	-->    
   
<!--���ʴ���¡�ä�������͹��Ǣͧ�����͹����	-->  
<?     	   
if($dbdcode=="4TA15" || $dbdcode=="4ALC450"){
		$query2 = "SELECT getdate,billno,drugcode,tradname,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk,amountfree  FROM stktranx  WHERE drugcode ='".$dbdcode."' and (getdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') ORDER BY getdate asc, row_id asc";
}else{
		$query2 = "SELECT getdate,billno,drugcode,tradname,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk,amountfree  FROM stktranx  WHERE drugcode ='".$dbdcode."' and (getdate between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') ORDER BY getdate asc, row_id asc";
}		
		//echo "��¡�����͹ : ".$query2;
		$result2 = mysql_query($query2) or die("Query failed");
		$tbnum2=mysql_num_rows($result2);
    	$num2=0;
   		while (list($getdate,$billno,$drugcode,$tname,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk,$amountfree) = mysql_fetch_row ($result2)) {
			$k++;
			$sql3 = "select stkno from combill where billno = '$billno' ";
			$row3 = mysql_query($sql3);
			list($stkno)=mysql_fetch_array($row3);
			
			$num2++;
			if($stkno=="�Ңͧ��"){
			$netprice = "Y";
			}else{
			$netprice  =$unitpri*$amount;	
			}
			
			$stkcutpri =$unitpri*$stkcut;
			$netlotpri =$unitpri*$netlotno;
			$mainstkpri =$unitpri*$mainstk;
			
						
			$month = substr($getdate,5,2);
			$day = substr($getdate,8,2);
			
			$month=$thmon[$month+0];					
?>		
        	<tr align="right">
          		<td align="center"><font face="Angsana New"><?=$month;?></font></td>
               <td align="center"><font face="Angsana New"><?=$day;?></font></td>
		   		<?
				if($billno==""){
				?>
                <td align="center"><font face="Angsana New">&nbsp;</font></td>
                <? }else{ ?>
                <td align="center"><font face="Angsana New"><?=$billno;?></font></td>
                <? } ?>
           		<td align="left" ><font face="Angsana New"><?=$department;?></font></td>
		   		<?
				if($stkno==""){
				?>
                <td align="center" ><font face="Angsana New">&nbsp;</font></td>
            <? }else{ ?>
                <td align="center" ><font face="Angsana New"><?=$stkno;?></font></td>
              <? } ?>
			<?
               if($netprice=="Y"){
            ?>
                <!--�Ѻ-->
			   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		      <td  align="right"><font face="Angsana New"><? if($stkno==""){echo "";}else{echo $amount;}?></font></td>
		      <td  align="right"><font face="Angsana New"><? if($stkno==""){echo "";}else{echo "0.00";}?></font></td>
	         <?    
                 }else{
                ?>
			   <td  align="right"><font face="Angsana New"><?=$unitpri;?></font></td>
		      <td  align="right"><font face="Angsana New"><?=$amount;?></font></td>
		      <td  align="right"><font face="Angsana New"><?=number_format($netprice,2);?></font></td>
		    <?
					}
				if($stkcutpri==0){
				?>
                <!--����-->
			   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
		      <td  align="right"><font face="Angsana New">&nbsp;</font></td>
			   <td  align="right"><font face="Angsana New">&nbsp;</font></td>
				 <?
                  }else{
                  ?>
          		<td  align="right"><font face="Angsana New"><?=$unitpri;?></font></td>
           		<td  align="right"><font face="Angsana New"><?=$stkcut;?></font></td>
		  		<td  align="right"><font face="Angsana New"><?=number_format($stkcutpri,2);?></font></td>
		  		<?
                 }
				 ?>
				<!--�������-->
				<td  align="right"><font face="Angsana New"><?=$unitpri;?></font></td>
				<td  align="right"><font face="Angsana New"><?=$mainstk;?></font></td>
				<td  align="right"><font face="Angsana New"><?=number_format($mainstkpri,2);?></font></td>
<? if($amountfree =="0"){ ?>
				<td  align="left"><font face="Angsana New">&nbsp;</font></td>
<? }else{ ?>  
				<td  align="left"><font face="Angsana New"><?="���ӹǹ $amountfree";?></font></td>
<? } ?>                
  </tr>    
            <?  
					}  //while (list($getdate,$billno,$drugcode,$tname,$lotno,$department,$unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result2)) { 
			?>
<!--�����ʴ���¡�ä�������͹��Ǣͧ�����͹����	-->                        
             </table>
<?					echo "<br>";
				echo "<div style='page-break-after:always'></div>";
				}  //  while($row = mysql_fetch_array($result1)){ ǹ�Ң����ŵ�������� 
		//	} // if check ��������
		}  // while($rows = mysql_fetch_array($result)){  ǹ������
	}  //  if(isset($_POST['BOK'])){
?>

