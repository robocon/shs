<?
include("connect.inc");
?>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 20px;
}
.font2 {
	font-size: 24px;
}
-->
</style>
<?
if(!isset($_POST['hn'])){
?>
<A HREF="../nindex.htm"><<�����</A>
<form name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>" target="_blank">
<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#336633" class="font1">
  <tr>
    <td align="center" class="font1"><strong class="font2">���Ҥ������µ�� HN</strong></td>
  </tr>
  <tr>
    <td>HN : 
      <input name="hn" type="text" id="hn" size="10">
      <br>
      �ѹ��� 
     <?
			$date=31;
			$dates=range(1,$date);
			$y=1;
			echo "<select name='day1'>";
			foreach($dates as $i){
	?>
      	<option value='<? if($i<10) echo "0";?><?=$i?>' <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
	<?
			}
			echo "<select>";
	?>
      ��͹ 
      <select name="mon1">
        <option value="01">���Ҥ�</option>
        <option value="02">����Ҿѹ��</option>
        <option value="03">�չҤ�</option>
        <option value="04">����¹</option>
        <option value="05">����Ҥ�</option>
        <option value="06">�Զع�¹</option>
        <option value="07" selected="selected">�á�Ҥ�</option>
        <option value="08">�ԧ�Ҥ�</option>
        <option value="09">�ѹ��¹</option>
        <option value="10">���Ҥ�</option>
        <option value="11">��Ȩԡ�¹</option>
        <option value="12">�ѹ�Ҥ�</option>
      </select>
      �.�.
      <?
      $y=2553;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='yr1'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
	  ?>
      -
      �ѹ���
      <?
			$date=31;
			$y=12;
			$dates=range(1,$date);
			echo "<select name='day2'>";
			foreach($dates as $i){
	?>
      	<option value='<? if($i<10) echo "0";?><?=$i?>' <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
	<?
			}
			echo "<select>";
	?>
��͹
<select name="mon2">
  <option value="01">���Ҥ�</option>
  <option value="02">����Ҿѹ��</option>
  <option value="03">�չҤ�</option>
  <option value="04">����¹</option>
  <option value="05">����Ҥ�</option>
  <option value="06">�Զع�¹</option>
  <option value="07">�á�Ҥ�</option>
  <option value="08">�ԧ�Ҥ�</option>
  <option value="09" selected="selected">�ѹ��¹</option>
  <option value="10">���Ҥ�</option>
  <option value="11">��Ȩԡ�¹</option>
  <option value="12">�ѹ�Ҥ�</option>
</select>
�.�.
<?
$y=2555;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='yr2'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
?>
<br>
��¡�÷���ͧ���
<select name="detail">
  <option value="ALL">--- ������ ---</option>
  <option value="PHAR">---- �� ----</option>
</select>
 </td>
  </tr>
  <tr>
    <td align="center">
      <input type="submit" name="ok" id="ok" value=" ���� ">
</td>
  </tr>
</table>
</form>
<?
}
if(isset($_POST['hn'])){
	$tphadate =array();
	$tpatdate =array();
	$pripatdate =array();
	$priphadate =array();
	$k=0;	
	$opd = "select * from opcard where hn ='".$_POST['hn']."' ";
	$ropd = mysql_query($opd);
	$rep = mysql_fetch_array($ropd);
	echo "<strong><span class='font1' >Ẻ��§ҹ�������¼����¹͡ HD</span>";
	echo "<br><span class='font1' >���� : ".$rep['yot']." ".$rep['name']." ".$rep['surname']." HN : ".$_POST['hn']." ���ʺѵû�� : ".$rep['idcard']."</span>";
    echo "<br><span class='font1' >������¡�õ�����ѹ��� ".$_POST['day1']."-".$_POST['mon1']."-".$_POST['yr1']." �֧�ѹ��� ".$_POST['day2']."-".$_POST['mon2']."-".$_POST['yr2']." </span></strong>";
	echo "<br><br><span class='font1' ><a href='reportcash3.php?all&hn=$_POST[hn]'><strong>----- �ѹ������Ѻ��ԡ�� -----</strong></a></span>";
	$sql = "select *,sum(price) as a from opacc where hn='".$_POST['hn']."' and credit ='HD' and date between '".$_POST['yr1']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59' group by left(txdate,10) ";
	$rows = mysql_query($sql);
	?>
	<table border="1" class="font1">
                <tr>
                  <td align="center"><strong>#</strong></td>
                    <td align="center"><strong>�ѹ���</strong></td>
                    <td align="center"><strong>�����������</strong></td>
                </tr>
	<?
	while($result = mysql_fetch_array($rows)){
		$k++;
		?>
                <tr>
                  <td align="center"><?=$k?></td>
                    <td><a href="reportcash3.php?hn=<?=$result['hn']?>&date=<?=substr($result['txdate'],0,10)?>" target="_blank"><?=substr($result['txdate'],8,2)."-".substr($result['txdate'],5,2)."-".substr($result['txdate'],0,4)." ".substr($result['txdate'],11)?></a></td>
                    <td align="right"><?=number_format($result['a'],2)?></td>
                </tr>
		<?
		$prices4+=$result['a'];
	}
	?>
    <tr>
                  <td align="center" colspan="2"><strong>���</strong></td>
                  <td align="right"><strong>
                  <?=number_format($prices4,2);?>
                  </strong></td>
      </tr>
	</table><br />
	<div style="page-break-after:always"></div>
    <?
	if($_POST['detail']=="ALL"){
		$k=0;
    echo "<br><span class='font1' ><strong>----- �ʴ���������´ ------</strong></span>";
		?>
        <table border='1' class='font1'>
		<tr>
         	<td align="center"><strong>#</strong></td>
          <td align="center"><strong>�ѹ���-�����Ѻ��ԡ��</strong></td>
          <td align="center"><strong>����</strong></td>
          <td align="center"><strong>��¡��</strong></td>
          <td align="center"><strong>�ӹǹ</strong></td>
          <td align="center"><strong>�Ҥ�</strong></td>
          <td align="center"><strong>�Ҥ����</strong></td>
          <td align="center"><strong>�ԡ�����</strong></td>
            <td align="center"><strong>������</strong></td>
		</tr>
		<?
		$sql = "select * from opacc where hn='".$_POST['hn']."' and credit ='HD' and date between '".$_POST['yr1']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59' ";
		$rows = mysql_query($sql);
		while($result = mysql_fetch_array($rows)){
			if($result['depart']!="PHAR"){
				$sql2 = "select * from patdata where hn='".$_POST['hn']."' and date = '".$result['txdate']."'";
				$rows2 = mysql_query($sql2);
			}else{
				$sql2 = "select * from drugrx where hn='".$_POST['hn']."' and date = '".$result['txdate']."'";
				$rows2 = mysql_query($sql2);
			}
			
			while($result2 = mysql_fetch_array($rows2)){
				if($result['depart']!="PHAR"){
					if(array_key_exists($result2['code'],$tpatdate)){
						$tpatdate[$result2['code']]+=$result2['amount'];
						$pripatdate[$result2['code']]+=$result2['price'];
					}else{
						$tpatdate[$result2['code']]=$result2['amount'];
						$pripatdate[$result2['code']]=$result2['price'];
					}
				}else{
					if(array_key_exists($result2['drugcode'],$tphadate)){
						$tphadate[$result2['drugcode']]+=$result2['amount'];
						$priphadate[$result2['drugcode']]+=$result2['price'];
					}else{
						$tphadate[$result2['drugcode']]=$result2['amount'];
						$priphadate[$result2['drugcode']]=$result2['price'];
						
					}
				}
				
				$k++;
				?>
				<tr>
                	<td align="center"><?=$k?></td>
                    <td><?=substr($result['txdate'],8,2)."-".substr($result['txdate'],5,2)."-".substr($result['txdate'],0,4)." ".substr($result['txdate'],11)?></td>
                    <td><?=$result2['drugcode']?><?=$result2['code']?></td>
                    <td><?=$result2['tradname']?><?=$result2['detail']?></td>
                    <td align="right"><?=$result2['amount']?></td>
                    <td align="right"><?=$result2['price']/$result2['amount']?></td>
                    <td align="right"><?=number_format($result2['price'],2)?></td>
                    <td align="right"><? if($result2['part']=="DDN"){ echo $result2['price']; }else{ echo "&nbsp;";}?></td>
                    <td><?=$result2['part']?></td>
                </tr>
				<?
				$prices1+= $result2['price'];
			}
		}
		?>
        <tr>
				  <td colspan="6" align="center"><strong>���</strong></td>
				  <td align="right"><strong>
			      <?=number_format($prices1,2)?>
				  </strong></td>
	      <td colspan="2" align="center"><strong>�ҷ</strong></td>
		  </tr>
           </table><br />
			<div style="page-break-after:always"></div>
----- <span class="font1"><strong>��ػ����������е��</strong></span>
-----                
<table border="1" class="font1">
                        <tr>
                          <td align="center"><strong>#</strong></td>
                            <td align="center"><strong>������</strong></td>
                            <td align="center"><strong>������</strong></td>
                            <td align="center"><strong>�ӹǹ</strong></td>
                            <td align="center"><strong>�Ҥ����</strong></td>
                        </tr>
                <?
                    foreach($tphadate as $keys => $value){
						$p++;
                    ?>
                    
                        <tr>
                          <td align="center"><?=$p?></td>
                            <td><?=$keys?></td>
                            <?
                            $sql4 = "select tradname from drugrx where drugcode = '$keys' ";
							$rows4 =mysql_query($sql4);
							list($trad) = mysql_fetch_array($rows4);
							?>
                            <td><?=$trad?></td>
                            <td align="right"><?=$value?></td>
                            <td align="right"><?=number_format($priphadate[$keys],2)?></td>
                        </tr>
                    <?
					$pri6 += $priphadate[$keys];
                }
                ?> 
                <tr>
                          <td colspan="4" align="center"><strong>���</strong></td>
                          <td align="right"><strong>
                          <?=number_format($pri6,2)?>
                          </strong></td>
  </tr>
                </table>
    <br />
            <span class="font1"><strong>----- ��ػ�ѵ�������е��</strong></span> -----
<table border="1" class="font1">
                        <tr>
                          <td align="center"><strong>#</strong></td>
                            <td align="center"><strong>�����ѵ����</strong></td>
                            <td align="center"><strong>������</strong></td>
                            <td align="center"><strong>�ӹǹ</strong></td>
                            <td align="center"><strong>�Ҥ����</strong></td>
                        </tr>
                <?
                    foreach($tpatdate as $keys => $value){
						$u++;
                    ?>
                    
                        <tr>
                          <td align="center"><?=$u?></td>
                            <td><?=$keys?></td>
                            <?
                            $sql5 = "select detail from patdata where code = '$keys' ";
							$rows5 =mysql_query($sql5);
							list($detail) = mysql_fetch_array($rows5);
							if($keys=="SERVICE"){
								$detail = "(55020/55021 ��Һ�ԡ�ü����¹͡)";
							}
							?>
                            <td><?=$detail?></td>
                            <td align="right"><?=$value?></td>
                            <td align="right"><?=number_format($pripatdate[$keys],2)?></td>
                        </tr>
                    
                    <?
					$pri7 +=$pripatdate[$keys];
                }
                ?>
                 <tr>
                          <td colspan="4" align="center"><strong>���</strong></td>
                          <td align="right"><strong>
                          <?=number_format($pri7,2)?>
                          </strong></td>
 				 </tr>
                </table>
        <?
	}elseif($_POST['detail']=="PHAR"){
		echo "<br><span class='font1' ><strong>----- �ʴ���������´ -----</strong></span>";
		?>
        <table border='1' class='font1'>
		<tr>
         	<td align="center"><strong>#</strong></td>
            <td align="center"><strong>�ѹ���-�����Ѻ��ԡ��</strong></td>
            <td align="center"><strong>������</strong></td>
            <td align="center"><strong>���͡�ä��</strong></td>
            <td align="center"><strong>�ӹǹ</strong></td>
            <td align="center"><strong>�Ҥ�</strong></td>
            <td align="center"><strong>�Ҥ����</strong></td>
            <td align="center"><strong>�ԡ�����</strong></td>
            <td align="center"><strong>������</strong></td>
		</tr>
		<?
		$sql = "select * from opacc where hn='".$_POST['hn']."' and credit ='HD' and depart = 'PHAR' and date between '".$_POST['yr1']."-".$_POST['mon1']."-".$_POST['day1']." 00:00:00' and '".$_POST['yr2']."-".$_POST['mon2']."-".$_POST['day2']." 23:59:59' ";
		//echo $sql;
		
		$rows = mysql_query($sql);
		
		while($result = mysql_fetch_array($rows)){
			$sql2 = "select * from drugrx where hn='".$_POST['hn']."' and date = '".$result['txdate']."' and (part='DDL' OR part='DDY' OR part='DDN') ";
			//echo $sql2;
			$rows2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($rows2)){
				
				if(array_key_exists($result2['drugcode'],$tphadate)){
					$tphadate[$result2['drugcode']]+=$result2['amount'];
					$priphadate[$result2['drugcode']]+=$result2['price'];
					
				}else{
					$tphadate[$result2['drugcode']]=$result2['amount'];
					$priphadate[$result2['drugcode']]=$result2['price'];
					
				}
				$k++;
				?>
				<tr>
                	<td align="center"><?=$k?></td>
                    <td><?=substr($result['txdate'],8,2)."-".substr($result['txdate'],5,2)."-".substr($result['txdate'],0,4)." ".substr($result['txdate'],11)?></td>
                    <td><?=$result2['drugcode']?></td>
                    <td><?=$result2['tradname']?></td>
                    <td align="right"><?=$result2['amount']?></td>
                    <td align="right"><?=$result2['price']/$result2['amount']?></td>
                    <td align="right"><?=number_format($result2['price'],2)?></td>
                    <td align="right"><? if($result2['part']=="DDN"){ echo $result2['price']; }else{ echo "&nbsp;";}?></td>
                    <td><?=$result2['part']?></td>
                </tr>
				<?
				$prices2 +=$result2['price']; 
			}
		}
	?>
<tr>
				  <td colspan="6" align="center"><strong>���</strong></td>
				  <td align="right"><strong>
			      <?=number_format($prices2,2)?>
				  </strong></td>
	      <td colspan="2" align="center"><strong>�ҷ</strong></td>
		  </tr>
	</table>
     <br />
     <div style="page-break-after:always"></div>
<span class="font1"><strong>----- ��ػ����������е��</strong></span>
-----	
<table border="1" class="font1">
        	<tr>
        	  <td align="center"><strong>#</strong></td>
            	<td align="center"><strong>������</strong></td>
            	<td align="center"><strong>������</strong></td>
                <td align="center"><strong>�ӹǹ</strong></td>
                <td align="center"><strong>�Ҥ����</strong></td>
            </tr>
	<?
		foreach($tphadate as $keys => $value){
			$e++;
		?>
		
            <tr>
              <td align="center"><?=$e?></td>
            	<td><?=$keys?></td>
                <?
                $sql4 = "select tradname from drugrx where drugcode = '$keys' ";
				$rows4 =mysql_query($sql4);
				list($trad) = mysql_fetch_array($rows4);
				?>
            	<td><?=$trad?></td>
                <td align="right"><?=$value?></td>
                <td align="right"><?=number_format($priphadate[$keys],2)?></td>
            </tr>
		<?
		$pri8 += $priphadate[$keys];
	}
	?>
    <tr>
           <td colspan="4" align="center"><strong>���</strong></td>
            <td align="right"><strong><?=number_format($pri8,2)?></strong></td>
 	</tr>
	</table>
    <?
	}
}
?>