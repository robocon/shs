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
			if($age<=35){
				$personal34++; 
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
			}
			elseif($age>35){
				$personal35++;
				if($bp1>140||$bp2>90){
					$bpcount2++;
				}
				if($cxr=="�Դ����"){
					$cxrcount2++;
				}
				if($stat_ua=="�Դ����"){
					$stat_uacount2++;
				}
				if($stat_hct=="�Դ����"){
					$stat_hctcount2++;
				}
				if($stat_bs=="�Դ����"){
					$stat_bscount2++;
				}
				if($stat_chol=="�Դ����"){
					$stat_cholcount2++;
				}
				if($stat_tg=="�Դ����"){
					$stat_tgcount2++;
				}
				if($stat_bun=="�Դ����"){
					$stat_buncount2++;
				}
				if($stat_cr=="�Դ����"){
					$stat_crcount2++;
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
				if($stat_uric=="�Դ����"){
					$stat_uriccount2++;
				}
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
<p align="center"><span><strong>Ẻ��§ҹ��ػ�š�õ�Ǩ��ҧ��� ��Шӻ� <?=$_POST["year"];?>
  <br>
</strong></span><strong>(��Ѻ��Ѻ��ا��������ش)</strong></p>
<p align="center"><strong>þ.���ӡ�õ�Ǩ �ç��Һ�Ť�������ѡ��������<br>
</strong><strong>���˹��·�����Ѻ��õ�Ǩ 
  <? if($_POST["txtcamp"]=="0"){ echo "����ء˹���"; }else{ echo $camp; }?>
</strong></p>
<table width="100%" border="0">
  <tr>
    <td colspan="2"><strong>1. ���ѧ�Ţͧ˹��·����� </strong></td>
    <td width="12%" align="right">
    <?
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
    <td width="32%"><strong>���</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>2. �ӹǹ������Ѻ��õ�Ǩ</strong></td>
    <td align="right"><?=$num;?></td>
    <td><strong>��� ����</strong></td>
  </tr>
  <tr>
    <td width="3%">&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td width="53%"><strong>2.1 ��·����ѭ�Һѵ�</strong></td>
    <td align="right"><?=$tahan1;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>2.2 ��·��ê�鹻�зǹ</strong></td>
    <td align="right"><?=$tahan2;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>2.3 �١��ҧ��Ш�</strong></td>
    <td align="right"><?=$tahan3;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td colspan="4"><strong>3. �Ѫ����š�� (BMI)</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.1 Under weight (���¡��� 18.5)</strong></td>
    <td align="right"><?=$bmi1;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.2 Normal weight (18.5-22.9)</strong></td>
    <td align="right"><?=$bmi2;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>3.3 Over weight (23.0-24.9)</strong></td>
    <td align="right"><?=$bmi3;?></td>
    <td><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>3.4 Obesity �дѺ 1 (25-29.9)</strong></td>
    <td align="right"><?=$bmi4;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>3.5 Obesity �дѺ 2 (�ҡ����������ҡѺ 30)</strong></td>
    <td align="right"><?=$bmi5;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td colspan="2"><strong>4. ������Ѻ��õ�Ǩ�������������Թ 35 �� ��Ժ�ó�</strong></td>
    <td align="right"><?=$personal34;?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.1 BP (��һ��� 140/90 mmHg)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP �Դ����</strong></td>
    <td align="right"><?=$bpcount1?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.2 Chest X-ray �Դ����</strong></td>
    <td align="right"><?=$cxrcount1?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>4.3 Uric Examination �Դ����</strong></td>
    <td align="right"><?=$stat_uacount1?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.4 Hct (��һ��� ��� = 40-45, ˭ԧ = 36-47)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hct �Դ����</strong></td>
    <td align="right"><?=$stat_hctcount1?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>4.5 �ä����</strong></td>
    <td align="right">-</td>
    <td><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�к�</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><strong>5. ������Ѻ��õ�Ǩ���������ҡ���� 35 �� ��Ժ�ó����</strong></td>
    <td align="right"><?=$personal35;?></td>
    <td align="left"><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.1 BP (��һ��� 140/90 mmHg)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>BP �Դ����</strong></td>
    <td align="right"><?=$bpcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.2 Chest X-ray �Դ����</strong></td>
    <td align="right"><?=$cxrcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <td><strong>5.3 Uric Examination �Դ����</strong></td>
    <td align="right"><?=$stat_uacount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.4 Hct (��һ��� ��� = 40-45, ˭ԧ = 36-47)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Hct �Դ����</strong></td>
    <td align="right"><?=$stat_hctcount2?></td>
    <td align="left"><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.5 Glucose (��һ��� 68-110)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Glucose �Դ����</strong></td>
    <td align="right"><?=$stat_bscount2?></td>
    <td><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.6 Cholesterol (��һ��� 120-200)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Cholesterol �Դ����</strong></td>
    <td align="right"><?=$stat_cholcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.7 Triglycerides (��һ��� 50-160)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Triglycerides �Դ����</strong></td>
    <td align="right"><?=$stat_tgcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.8 HDL-C (��һ��� �ҡ���� 55)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>HDL-C �Դ����</strong></td>
    <td align="right">����ա�õ�Ǩ</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.9 LDL-C (��һ��� ���¡��� 130)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>LDL-C �Դ����</strong></td>
    <td align="right">����ա�õ�Ǩ</td>
    <td>&nbsp;</td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.10 BUN (��һ��� 6-20)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>&nbsp;&nbsp;BUN �Դ����</strong></td>
    <td align="right"><?=$stat_buncount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.11 Creatinine (��һ��� 0.67-1.17)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Creatinine �Դ����</strong></td>
    <td align="right"><?=$stat_crcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.12 SGOT (��һ��� 0-37)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SGOT �Դ����</strong></td>
    <td align="right"><?=$stat_sgotcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.13 SGPT (��һ��� 0-41)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>SGPT �Դ����</strong></td>
    <td align="right"><?=$stat_sgptcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.14 ALK Phoshatase (��һ��� 40-129)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>ALK</strong> <strong>Phoshatase �Դ����</strong></td>
    <td align="right"><?=$stat_alkcount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.15 Uric acid (��һ��� 2.47-8.40)</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Uric acid �Դ����</strong></td>
    <td align="right"><?=$stat_uriccount2?></td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><strong>5.16 �ä����</strong></td>
    <td align="right">-</td>
    <td><strong>���</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>�к�</strong></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p align="left">&nbsp;</p>
