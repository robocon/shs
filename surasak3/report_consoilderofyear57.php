<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?php
include("../connect.inc");
?>
<table width="100%" border="0" cellspacing="0" cellpadding="2" align="center">
  <form action="<? $PHP_SELF; ?>" method="post" name="form1" id="form1">
    <tr>
      <td align="right" valign="bottom"><span>˹��§ҹ :</span>
        <select  name="txtcamp">
         <option value="0">---------- ���͡ ----------</option>
          <option value="M02">�.17 �ѹ2</option>
          <option value="M04">�.�.��������ѡ��������</option>
          <option value="M05">�.�ѹ4</option>
          <option value="M06">���½֡ú����ɻ�еټ�</option>
          <option value="M0301">��.���.32</option>
          <option value="M0302">���.���.32</option>
          <option value="M0303">���.,���.���.32</option>
          <option value="M0304">�¡.���.32</option>
          <option value="M0305">���.���.32</option>
          <option value="M0306">���.���.32</option>
          <option value="M0307">���.���.32</option>
          <option value="M0308">���.���.32</option>
          <option value="M0309">�ʡ.���.32</option>
          <option value="M0311">���.���.32</option>
          <option value="͡.���">͡.��� ���.32</option>
          <option value="����">����.���.32</option>
          <option value="M0314">���.���.32</option>
          <option value="M0315">�Ȩ.���.32</option>
          <option value="M0316">����.���.32</option>
          <option value="M0317">ʢ�.���.32</option>
          <option value="è">è.���.32</option>
          <option value="M0318">���.���.32</option>
          <option value="M0319">���.���.32</option>
          <option value="M0320">���.���.32</option>
          <option value="M0321">����.��.���.32</option>
          <option value="M0322">��.��.���.32</option>
          <option value="M0323">�ʾ.���.32</option>
          <option value="M0324">��þ���ѧ ���.32</option>
          <option value="M0325">Ƚ.�ȷ.���.32</option>
          <option value="���.���.32">���.���.32</option>
          <option value="M0327">�ٹ�����Ѿ�� ���.32</option>
          <option value="M0328">���.���.32</option>
          <option value="M08">��ʴըѧ��Ѵ�ӻҧ</option>
        </select>
        &nbsp;�� :
        <select name="year" id="yr">
          <?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
          <option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
          <?php }?>
        </select>
        <input type="submit" class="formbutton" name="submit" value="���Ң�����" />
        <input type="hidden" name="page" value="1" /></td>
    </tr>
  </form>
</table>
<?
		if($_POST["txtcamp"]=="0"){
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]'";		
		}else{
			$sql="SELECT *
			FROM condxofyear_so
			WHERE yearcheck =  '$_POST[year]' AND camp
			LIKE  '%$_POST[txtcamp]%'";		
		}
		$query=mysql_query($sql);
		$num=mysql_num_rows($query);
		$numht1=0;
		$tahan1=0;
		$tahan2=0;
		$tahan3=0;		
		$bmi1=0;
		$bmi2=0;
		$bmi3=0;
		$bmi4=0;
		$bmi5=0;	
		$personal34=0;
		$personal35=0;
		$bpcount1=0;
		$bpcount2=0;	
		$cxrcount1=0;
		$cxrcount2=0;
		$stat_uacount1=0;
		$stat_uacount2=0;
		$stat_hctcount1=0;
		$stat_hctcount2=0;
		$stat_bscount2=0;
		$stat_cholcount2=0;
		$stat_tgcount2=0;
		$stat_buncount2=0;
		$stat_crcount2=0;
		$stat_sgotcount2=0;
		$stat_sgptcount2=0;
		$stat_alkcount2=0;
		$stat_uriccount2=0;		
		$roundcount=0;		
		$choltgcount=0;
		$bscount1=0;
		$bscount2=0;
		$heartcount=0;
		$emphysemacount=0;
		$alcoholiccount=0;
		$sum1count1=0;
		$sum2count1=0;
		$smbasiccount2=0;		
		$smbasiccount3=0;						
		
		while($rows=mysql_fetch_array($query)){
		$camp = $rows["camp"];
		$age = substr($rows["age"],0,2);
		$bp1 = $rows["bp1"];
		$bp2 = $rows["bp2"];
		$cxr = $rows["cxr"];
		$stat_ua = $rows["stat_ua"];
		$stat_hct = $rows["stat_hct"];
		$stat_bs =  $rows["stat_bs"];
		$stat_chol =  $rows["stat_chol"];
		$stat_tg =  $rows["stat_tg"];
		$stat_bun =  $rows["stat_bun"];
		$stat_cr =  $rows["stat_cr"];
		$stat_sgot =  $rows["stat_sgot"];
		$stat_sgpt =  $rows["stat_sgpt"];
		$stat_alk =  $rows["stat_alk"];
		$stat_uric =  $rows["stat_uric"];
		$round =  $rows["round_"];	
		$chol =  $rows["chol"];	
		$tg =  $rows["tg"];		
		$bs =  $rows["bs"];
		$heart =  $rows["heart"];
		$gout =  $rows["gout"];
		$emphysema =  $rows["emphysema"];
		$alcoholic =  $rows["alcoholic"];
		$sum1 =  $rows["sum1"];	
		$sum2 =  $rows["sum2"];			
		
		
				if($bp1>140||$bp2>90){
					$bpcount1++;
				}
				if($cxr=="�Դ����"){
					$cxrcount1++;
				}
				if($stat_ua=="�Դ����"){
					$stat_uacount1++;
				}
				if($stat_hct=="�Դ����"){
					$stat_hctcount1++;
				}
				
				
				if($round > 90){
					$roundcount++;
				}
				if($chol > 239 && $tg > 200){
					$choltgcount++;
				}
				if($bs >= 100 && $bs <= 125){
					$bscount1++;
				}				
				if($bs > 125){
					$bscount2++;
				}	
				if($stat_sgot=="�Դ����"){
					$stat_sgotcount2++;
				}
				if($stat_sgpt=="�Դ����"){
					$stat_sgptcount2++;
				}
				if($stat_alk=="�Դ����"){
					$stat_alkcount2++;
				}
				if($heart=="Y"){
					$heartcount++;
				}		
				if($gout=="Y"){
					$goutcount++;
				}	
				if($emphysema=="Y"){
					$emphysemacount++;
				}					
				if($alcoholic=="Y"){
					$alcoholiccount++;
				}	
				if($sum1=="���� (��辺��������§)"){
					$sum1count1++;
				}
				if($sum2=="����������§���ͧ�鹵���ä"){
					$sum2count1++;
				}				
				if($smbasic=="����������§���ͧ�鹵���ä"){
					$smbasiccount2++;
				}
				if($smbasic=="���´����ä������ѧ"){
					$smbasiccount3++;
				}																																					
				
			$nhn = $rows["hn"];
			$sql1 = "select goup from opcard where hn='".$nhn."'";
			//echo $sql1;
			$aa = mysql_query($sql1);
			$result = mysql_fetch_array($aa);			
			$code = substr($result['goup'],0,3);
			
			if($code=="G11"){
				$tahan1++;//��·���
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}elseif($code=="G12" || $code=="G21" || $code=="G37"){
				$tahan2++;//����Ժ
				//echo $result['yot']."<br>";
				//echo $nhn."<br>";
			}else{
				$tahan3++;
				//echo $nhn."<br>";
			}			
		
			$bmi = $rows["bmi"];		
			if($bmi<18.50){
				$bmi1++;
			}
			elseif($bmi>=18.50&&$bmi<=22.99){
				$bmi2++;
			}
			elseif($bmi>=23.00&&$bmi<=24.99){
				$bmi3++;
			}
			elseif($bmi>=25.00&&$bmi<=29.99){
				$bmi4++;
			}
			elseif($bmi>=30.00){
				$bmi5++;
			}		
		
		}  // while
		//echo $numht1;	
?>
<p>&nbsp;</p>
<p align="center"><span><strong>Ẻ����������§ҹ��ػ�š�õ�Ǩ��ҧ��»�Шӻ� 
  <?=$_POST["year"];?> (
  <? if($_POST["txtcamp"]=="0"){ echo "����ء˹���"; }else{ echo "�¡���˹���"; }?>
  )<br>
</strong></span></p>
<p>
  <?
if($_POST["txtcamp"]=="0"){
	echo "<p align=\"center\"><strong>˹��·������Ѻ��õ�Ǩ��ҧ��·����� 33 ˹���<br>";
}else{
	echo "<p align=\"center\"><strong>˹��·������Ѻ��õ�Ǩ��ҧ��� $camp<br>";
}
?>
  <span align="center"><strong>˹��·��ӡ�õ�Ǩ �ç��Һ�Ť�������ѡ��������</strong></span></p>
<p>
</p>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><strong>1. �ʹ�ͧ���ѧ���˹��·�����</strong></td>
    <td width="13%" align="right">&nbsp;</td>
    <td width="9%">&nbsp;</td>
    <td width="24%">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>�ӹǹ</strong></td>
    <td align="right"><?
		if($_POST["txtcamp"]=="0"){
			$sqlchkup="SELECT *
			FROM chkup_solider";		
		}else{
			$sqlchkup="SELECT *
			FROM chkup_solider
			WHERE  camp
			LIKE  '%$_POST[txtcamp]%'";		
		}
		$querychkup=mysql_query($sqlchkup);
		$numchkup=mysql_num_rows($querychkup);
		echo $numchkup;
	?>    </td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>2. �ʹ�ͧ���ѧ�ŷ���Ѻ��õ�Ǩ</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td width="3%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="51%"><strong>2.1 �ӹǹ</strong></td>
    <td align="right"><?=$num;?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>2.2 ������</strong></td>
    <td align="right">
	<? 
		$sum=$num*100/$numchkup;
		echo number_format($sum,2);
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5"><strong>3. ��û����Թ�š�õ�Ǩ</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.1 ���������</strong></td>
    <td align="right"><?=$sum1count1;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumnormal=$sum1count1*100/$num;
		echo number_format($sumnormal,2);
	?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.2 ���������§</strong></td>
    <td align="right"><?=$sum2count1;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumseang=$sum2count1*100/$num;
		echo number_format($sumseang,2);
	?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.3 ��������ä</strong></td>
    <td align="right">
	<?
	$sum3count1=$num-$sum1count1-$sum2count1;
	echo $sum3count1;
	?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumdiag=$sum3count1*100/$num;
		echo number_format($sumdiag,2);
	?></td>
  </tr>
  
  <tr>
    <td colspan="5"><strong>4. �š�õ�Ǩ��ҧ�����С�õ�Ǩ�ͧ��ͧ��Ժѵԡ��</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.1 ���ѧ�ŷ�������й��˹ѡ�Թ</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$bmi4;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumbmi4=$bmi4*100/$num;
		echo number_format($sumbmi4,2);
	?></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.2 ���ѧ�ŷ���������ä��ǹ</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$bmi5;?></td>
    <td align="right"><strong>������</strong></td>
    <td>
	<? 
		$sumbmi5=$bmi5*100/$num;
		echo number_format($sumbmi5,2);
	?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.3 ���ѧ�ŷ���������ͺ����Թ</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$roundcount;?></td>
    <td align="right"><strong>������</strong></td>
    <td>
	<? 
		$sumround=$roundcount*100/$num;
		echo number_format($sumround,2);
	?>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.4 ���ѧ�ŷ���������дѺ��ѹ����ʹ�٧</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$choltgcount;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumcholtg=$choltgcount*100/$num;
		echo number_format($sumcholtg,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.5 ���ѧ�ŷ�������Ф����ѹ���Ե�٧</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$bpcount1;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumbp=$bpcount1*100/$num;
		echo number_format($sumbp,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.6 ���ѧ�ŷ�������й�ӵ������ʹ�٧</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$bscount1;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumbs1=$bscount1*100/$num;
		echo number_format($sumbs1,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.7 ���ѧ�ŷ������ǡ�ó�ӧҹ�ͧ�Ѻ�Դ����</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right">
	<?
		$counttub=$stat_sgotcount2+$stat_sgptcount2+$stat_alkcount2;
		echo $counttub;
	?>    </td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumtub=$counttub*100/$num;
		echo number_format($sumtub,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.8 ���ѧ�ŷ���������ä����</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$heartcount;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumheart=$heartcount*100/$num;
		echo number_format($sumheart,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.9 ���ѧ�ŷ���������ä����ҹ</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$bscount2;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumbs2=$bscount2*100/$num;
		echo number_format($sumbs2,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.10 ���ѧ�ŷ���������ä��ҷ�</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$goutcount;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumgout=$goutcount*100/$num;
		echo number_format($sumgout,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.11 ���ѧ�ŷ���������ä�ا���觾ͧ</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;�ӹǹ</strong></td>
    <td align="right"><?=$emphysemacount;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumemphysema=$emphysemacount*100/$num;
		echo number_format($sumemphysema,2);
	?>    </td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.12 ���ѧ�ŷ���դ����Դ���Ԩҡ��š������ (Alcoholic)</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�ӹǹ</strong></td>
    <td align="right"><?=$alcoholiccount;?></td>
    <td align="right"><strong>������</strong></td>
    <td><? 
		$sumalcoholic=$alcoholiccount*100/$num;
		echo number_format($sumalcoholic,2);
	?>    </td>
  </tr>
  
  <tr>
    <td colspan="5"><strong>5. ��ô��Թ�������Ἱ��âͧ þ.��.��.3 㹡��ѧ�š������ҧ�</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.1 ���������</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.2 ���������§</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  
  
  
  
  
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.3 ��������ä</strong></td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="4">......................................................................................................................................................................................................................</td>
  </tr>
</table>
<p align="left">&nbsp;</p>
