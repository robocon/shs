<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
</head>

<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<form id="form1" name="form1" method="post" action="solider2.php">
  <a href="abnormal_dx_all.php">��§ҹ��ػ�ء˹���</a>
<table width="42%" border="0" align="center">
  <tr>
    <td height="31" align="center"><strong>��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
          ����� :  
<select  name='camp'>
<option value='' >--���͡�ѧ�Ѵ--</option>
<option value='�����͹'>�����͹</option>
<option value='�.17 �ѹ2'>�.17 �ѹ2</option>
<option value='���ŷ��ú����32'>���ŷ��ú����32</option>
<option value='�.�.��������ѡ��������'>�.�.��������ѡ��������</option>
<option value='�.�ѹ4'>�.�ѹ4</option>
<option value='���½֡ú����ɻ�еټ�'>���½֡ú����ɻ�еټ�</option>
<option value='��.���.32'>��.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.,���.���.32'>���.,���.���.32</option>
<option value='�¡.���.32'>�¡.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ʡ.���.32'>�ʡ.���.32</option>
<!--<option value='����.���.32'>����.���.32</option>-->
<option value='���.���.32'>���.���.32</option>
<option value='͡.��� ���.32'>͡.��� ���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�Ȩ.���.32'>�Ȩ.���.32</option>
<option value='����.���.32'>����.���.32</option>
<option value='ʢ�.���.32'>ʢ�.���.32</option>
<option value='è.���.32'>è.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='����.��.���.32'>����.��.���.32</option>
<option value='��.��.���.32'>��.��.���.32</option>
<option value='�ʾ.���.32'>�ʾ.���.32</option>
<option value='��þ���ѧ ���.32'>��þ���ѧ ���.32</option>
<option value='Ƚ.�ȷ.���.32'>Ƚ.�ȷ.���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='�ٹ�����Ѿ�� ���.32'>�ٹ�����Ѿ�� ���.32</option>
<option value='���.���.32'>���.���.32</option>
<option value='��ʴըѧ��Ѵ�ӻҧ'>��ʴըѧ��Ѵ�ӻҧ</option>
<option value='��.��ѧ ʻ.��'>��.��ѧ ʻ.��</option>
<option value='��� ��.33'>��� ��.33</option>
<option value='˹��·�������'>˹��·�������</option>
<option value='aaug'>-----����ҧ����� ʤ.------</option>
<option value='a�.17 �ѹ2'>�.17 �ѹ2</option>
<option value='a˹��·�������'>˹��·�������</option>
</select>
&nbsp;�� :
<select name="year" id="yr">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
    </td>
    </tr>
  <tr>
    <td align="center"><input type="submit" name="button" id="button" value="��ŧ" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    </tr>
</table>
</form>
</div>
<?
if(isset($_POST['button'])){
	$bmi1=0;
	$bmi2=0;
	$bmi3=0;
	$bmi4=0;
	$bmi5=0;
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
	$tahan1=0;
	$tahan2=0;
	$tahan3=0;
	$y1 = $_POST['year']-543;
	$y2=$y1+1;
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0319";
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0320";
	if($_POST['camp']=='aaug'||$_POST['camp']=='a�.17 �ѹ2'||$_POST['camp']=='a˹��·�������'){
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and (thidate between '$y1-10-01 00:00:00' and '$y2-02-28 23:59:59' ) and camp like '%".substr($_POST['camp'],1)."%' ";
		$ok=1;
	}
	elseif($_POST['camp']==''){
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and substr(left(camp,3),2) between '02' and '10'  ";
	}else{
		$query2 = "select camp,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric from condxofyear_so where status_dr='Y' and yearcheck='".$_POST['year']."' and camp like '%".$_POST['camp']."%'  ";
	}
	//echo $query2;
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric) = mysql_fetch_array($aa2)){
		$query = "select goup from opcard where hn='".$nhn."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$code = substr($result['goup'],0,3);
		
		if($code=="G11"){
			$tahan1++;//��·���
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		elseif($code=="G12" || $code=="G21" || $code=="G37"){
			$tahan2++;//����Ժ
			//echo $result['yot']."<br>";
			//echo $nhn."<br>";
		}
		/*elseif($code=="G14"){
			$tahan3++;//�١��ҧ��Ш�
		}*/
		else{
			$tahan3++;
			//echo $nhn."<br>";
		}
		
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
		$age = substr($age,0,2);
		if($age<=35){
			$count2++; 
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
			$count3++;
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
		$_POST['camp']=$camp;
	}
	if($_POST['camp']=='M0319') $_POST['camp']="���.���.32";
	if($_POST['camp']=='M0320') $_POST['camp']="���.���.32";

	$allcount = $count;
	?>
	<table width="100%" class="font1">
    	<tr>
    	  <td colspan="3" align="center"><strong>Ẻ��§ҹ��ػ�š�õ�Ǩ��ҧ��� ��Шӻ� <?=$_POST['year']?></strong></td>
   	    </tr>
        <tr>
        <td colspan="3" align="center"><strong>þ.���ӡ�õ�Ǩ ..................�ç��Һ�Ť�������ѡ��������...........................</strong></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><strong>���˹��·�����Ѻ��õ�Ǩ................<?=$_POST['camp']?>...................</strong></td>
        </tr>
        <tr>
          <td>1. �ӹǹ������Ѻ��õ�Ǩ</td>
          <td width="29%" align="center"><?=$count?></td>
          <td width="28%">���  ����</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.1 ��·����ѭ�Һѵ�</td>
          <td align="center"><?=$tahan1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.2 ��·��ê�鹻�зǹ</td>
          <td align="center"><?=$tahan2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.3 �١��ҧ��Ш�</td>
          <td align="center"><?=$tahan3?></td>
          <td>���</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center"><?=$other?></td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td width="43%">2. ��ҴѪ����š�� (BMI)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.1 Under weight (���¡��� 18.5)</td>
          <td align="center"><?=$bmi1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.2 Normal weight (18.5-22.9)</td>
          <td align="center"><?=$bmi2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.3 Over weight (23.0-24.9)</td>
          <td align="center"><?=$bmi3?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.4 Obesity �дѺ1(25-29.9)</td>
          <td align="center"><?=$bmi4?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.5 Obesity �дѺ2(�ҡ����������ҡѺ30)</td>
          <td align="center"><?=$bmi5?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><p>3. �������������Թ 35 �պ�Ժ�ó�</p></td>
          <td align="center"><?=$count2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.1 BP (��һ��� 140-90 mmHg)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP �Դ����</td>
          <td align="center"><?=$bpcount1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.2 Chest X-Ray �Դ����</td>
          <td align="center"><?=$cxrcount1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.3 Urine Examination ����</td>
          <td align="center"><?=$stat_uacount1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.4 Hct(��һ��� ���=40-54,˭ԧ 36-47)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct �Դ����</td>
          <td align="center"><?=$stat_hctcount1?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.5 �ä����</td>
          <td align="center">-</td>
          <td>���</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к�................................................................................................</td>
        </tr>
        </table>
        <div style="page-break-before:always;"></div>
       	<table width="100%" class="font1">
        <tr>
          <td width="43%" align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>4. ������������ҡ���� 35 �� ��Ժ�ó����</td>
          <td width="29%" align="center"><?=$count3?></td>
          <td width="28%">���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.1 BP (��һ��� 140/90 mmHg)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP �Դ����</td>
          <td align="center"><?=$bpcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.2 Chest X-Ray �Դ����</td>
          <td align="center"><?=$cxrcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.3 Urine Examination �Դ����</td>
          <td align="center"><?=$stat_uacount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.4 Hct(��һ��� ���=40-54,˭ԧ=36-47)</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct �Դ����</td>
          <td align="center"><?=$stat_hctcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.5 Glucose</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Glucose</td>
          <td align="center"><?=$stat_bscount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.6 Cholesterol</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cholesterol</td>
          <td align="center"><?=$stat_cholcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.7 Triglycerides</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Triglycerides</td>
          <td align="center"><?=$stat_tgcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.8 HDL-C</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HDL-C</td>
          <td align="center">����ա�õ�Ǩ</td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.9 LDL-C</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LDL-C</td>
          <td align="center">����ա�õ�Ǩ</td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.10 BUN</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUN</td>
          <td align="center"><?=$stat_buncount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.11 Creatinine</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creatinine</td>
          <td align="center"><?=$stat_crcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.12 SGOT</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGOT</td>
          <td align="center"><?=$stat_sgotcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.13 SGPT</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGPT</td>
          <td align="center"><?=$stat_sgptcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.14 ALK Phosphatase</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALK Phosphatase</td>
          <td align="center"><?=$stat_alkcount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.15 Uric acid</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uric acid</td>
          <td align="center"><?=$stat_uriccount2?></td>
          <td>���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.16 �ä����</td>
          <td align="center">0</td>
          <td>���</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к�................................................................................................</td>
        </tr>
	</table><br><br>
    <div style="page-break-after:always;"></div>
	<?
	include("abnormal_dx.php");
	?>
	<div style="page-break-after:always;"></div>
	<?
	//echo "���ͺ����������� �ѧ����Դ��ҹ";
	include("abnormal_dx_list.php");
}

?>
</body>
</html>