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
<form id="form1" name="form1" method="post" action="solider3.php">
  <table width="42%" border="0" align="center">
    <tr>
    <td height="31" align="center"><strong>��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.3</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
          ����� :  
<select  name='camp'>
<option value='' >--���͡�ѧ�Ѵ--</option>
<option value=''>������</option>
<!--<option value='�����͹'>�����͹</option>-->
<option value='�.17 �ѹ2'>�.17 �ѹ2</option>
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
<!--<option value='aaug'>-----����ҧ����� ʤ.------</option>
<option value='a�.17 �ѹ2'>�.17 �ѹ2</option>
<option value='a˹��·�������'>˹��·�������</option>-->
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
	$stat_sum1=0;
	$stat_sum2=0;
	$stat_dm1=0;
	$stat_ht1=0;
	$stat_str1=0;
	$stat_obe1=0;
	$stat_dm2=0;
	$stat_ht2=0;
	$stat_str2=0;
	$stat_obe2=0;
	$stat_dm3=0;
	$stat_ht3=0;
	$stat_str3=0;
	$stat_obe3=0;
	$stat_dm4=0;
	$stat_ht4=0;
	$stat_str4=0;
	$stat_obe4=0;
	$y1 = $_POST['year']-543;
	$y2=$y1+1;
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0319";
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0320";
	
	if($_POST['camp']==''){
		$query123 = "select count(*) as sum from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and substr(left(camp,3),2) between '02' and '10'  ";
		
		$sqlall = "SELECT  a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric,a.smbasic,a.smdm,a.smht,a.smstr,a.smobe,a.round_,a.chol,a.tg,a.bs,a.sgot,a.sgpt FROM condxofyear_so AS a, chkup_solider AS b WHERE a.status_dr =  'Y' AND a.yearcheck =  '".$_POST['year']."' AND b.hn = a.hn AND substr( left( a.camp, 3  ) , 2 ) BETWEEN  '02' AND  '10'";
		$_POST['camp']="���.32";
		
	}else{
		$query123 = "select goup,count(*) as sum  from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and camp like '%".$_POST['camp']."%' group by goup ";
		$sqlall = "SELECT a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric,a.smbasic,a.smdm,a.smht,a.smstr,a.smobe,a.round_,a.chol,a.tg,a.bs,a.sgot,a.sgpt FROM condxofyear_so AS a, chkup_solider AS b WHERE a.status_dr =  'Y' AND a.yearcheck =  '".$_POST['year']."' AND b.hn = a.hn and a.camp like '%".$_POST['camp']."%'  ";
	}

	$aa2 = mysql_query($query2);
	
	$aa9 = mysql_query($sqlall);
	$count = mysql_num_rows($aa9);//�ӹǹ����������ҵ�Ǩ
	if($_POST['camp']=="���.32"){
		$count=970;
	}
	elseif($_POST['camp']=="����.��.���.32"){
		$count=54;
	}
	elseif($_POST['camp']=="���.���.32"){
		$count=7;
	}
	elseif($_POST['camp']=="��ʴըѧ��Ѵ�ӻҧ"){
		$count=51;
	}
	elseif($_POST['camp']=="���.���.32"){
		$count=7;
	}
	elseif($_POST['camp']=="�.�ѹ4"){
		$count=54;
	}
	
	$aa3 = mysql_query($query123);
	while($rep3 = mysql_fetch_array($aa3)){
		$count33+=$rep3['sum'];//�ӹǹ����������ͧ��Ǩ
		if(substr($rep3['goup'],0,3)=="G11"){
			$tahan31=$rep3['sum'];//��·���
		}
		elseif(substr($rep3['goup'],0,3)=="G12"|substr($rep3['goup'],0,3)=="G21"){
			$tahan32=$rep3['sum'];//����Ժ
		}
		else{
			$tahan33=$rep3['sum'];
		}
	}
	$percent1=($count*100)/$count33;
	
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric,$smbasic,$smdm,$smht,$smstr,$smobe,$round,$chol,$tg,$bs,$sgot,$sgpt) = mysql_fetch_array($aa9)){
			
		$query = "select goup,sex from opcard where hn='".$nhn."'";
		$aa = mysql_query($query);
		$result = mysql_fetch_array($aa);
		$code = substr($result['goup'],0,3);
		
		if($bmi<18.50){
			$bmi1++;
		}
		elseif($bmi>=18.50&&$bmi<=24.99){
			$bmi2++;
		}
		elseif($bmi>=25.00&&$bmi<=29.99){
			$bmi3++;
		}
		elseif($bmi>=30.00){
			$bmi4++;
		}
		if($result['sex']=="�"&&$round>80){
			$roundcount++;
		}
		elseif($result['sex']=="�"&&$round>90){
			$roundcount++;
		}
		
		if($chol>240||$tg>200){
			$cholcount++;
		}
		
		if($bs>126){
			$bscount++;
		}
		
		if($sgot>80||$sgpt>80){
			$sgcount++;
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
			if($smbasic=="��辺��������§"){
				$stat_sum1++;
			}elseif($smbasic=="����������§���ͧ�鹵���ä"){
				$stat_sum3++;
				if($smdm=="Y"){
					$stat_dm1++;
				}
				if($smht=="Y"){
					$stat_ht1++;
				}
				if($smstr=="Y"){
					$stat_str1++;
				}
				if($smobe=="Y"){
					$stat_obe1++;
				}	 	
			}elseif($smbasic=="���´����ä������ѧ"){
				$stat_sum5++;
				if($smdm=="Y"){
					$stat_dm2++;
				}
				if($smht=="Y"){
					$stat_ht2++;
				}
				if($smstr=="Y"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
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
			if($smbasic=="��辺��������§"){
				$stat_sum2++;
			}elseif($smbasic=="����������§���ͧ�鹵���ä"){
				$stat_sum4++;
				if($smdm=="Y"){
					$stat_dm3++;
				}
				if($smht=="Y"){
					$stat_ht3++;
				}
				if($smstr=="Y"){
					$stat_str3++;
				}
				if($smobe=="Y"){
					$stat_obe3++;
				}
			}elseif($smbasic=="���´����ä������ѧ"){
				$stat_sum6++;
				if($smdm=="Y"){
					$stat_dm4++;
				}
				if($smht=="Y"){
					$stat_ht4++;
				}
				if($smstr=="Y"){
					$stat_str4++;
				}
				if($smobe=="Y"){
					$stat_obe4++;
				}
			}
		}
		//$_POST['camp']=$camp;
	}
	
	if($_POST['camp']=='M0319') $_POST['camp']="���.���.32";
	if($_POST['camp']=='M0320') $_POST['camp']="���.���.32";

	$allcount = $count;
	?>
	<table width="100%" class="font1">
    	<tr>
    	  <td colspan="3" align="center"><strong>Ẻ��§ҹ��ػ�š�õ�Ǩ��ҧ��� ��Шӻ� 
   	      <?=$_POST['year']?></strong></td>
   	    </tr>
        <tr>
        <td colspan="3" align="center"><strong>þ.��.���ӡ�õ�Ǩ ..................�ç��Һ�Ť�������ѡ��������...........................</strong></td>
        </tr>
        <tr>
          <td colspan="3" align="center"><strong>���˹��·�����Ѻ��õ�Ǩ................<?=$_POST['camp']?>...................</strong></td>
        </tr>
        <tr>
          <td>1. �ʹ�ͧ���ѧ���˹��·�����</td>
          <td width="23%" align="center"></td>
          <td width="26%">&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.1 �ӹǹ</td>
          <td align="center"><?=$count33?></td>
          <td> ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;1.2 ������</td>
          <td align="center">100</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
        </tr>
        <tr>
          <td>2. �ʹ�ͧ���ѧ�ŷ������Ѻ��õ�Ǩ</td>
          <td align="center"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.1 �ӹǹ</td>
          <td align="center"><?=$count;?></td>
          <td> ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;2.2 ������</td>
          <td align="center"><?=number_format(((100*$count)/$count33),2)?></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>3. ��û����Թ�š�õ�Ǩ</td>
          <td align="center"></td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.1 ��������� </td>
          <td>�ӹǹ
          <?=$stat_sum1+$stat_sum2;?> ���</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.2 ���������§ </td>
          <td>�ӹǹ
          <?=$stat_sum3+$stat_sum4;?> ���</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;3.3 ��������ä </td>
          <td>�ӹǹ
          <?=$stat_sum5+$stat_sum6?> ���</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="3">&nbsp;</td>
      </tr>
        <tr>
          <td width="51%">4. �š�õ�Ǩ��ҧ�����С�õ�Ǩ�ͧ��ͧ��Ժѵԡ��</td>
          <td align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.1 ���ѧ�ŷ����������й��˹ѡ�Թ ( BMI = 25.1-29.9 )</td>
          <td>�ӹǹ <?=$bmi3?>            ��� </td>
          <td>������ <?=number_format(((100*$bmi3)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.2 ���ѧ�ŷ���������ä��ǹ ( BMI &gt; 30 )</td>
          <td>�ӹǹ            <?=$bmi4?>
          ��� </td>
          <td>������ <?=number_format(((100*$bmi4)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.3 ���ѧ�ŷ���������ͺ����Թ ( ��� &gt; 90 ��.,˭ԧ &gt; 80 ��. )</td>
          <td>�ӹǹ
            <?=$roundcount?>
          ��� </td>
          <td>������ <?=number_format(((100*$roundcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.4 ���ѧ�ŷ���������дѺ��ѹ����ʹ�٧<br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;( Chol &gt; 240 ���/���� TG &gt; 200 )</td>
          <td>�ӹǹ
            <?=$cholcount?>
          ��� </td>
          <td>������ <?=number_format(((100*$cholcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.5 ���ѧ�ŷ�������Ф����ѹ���Ե�٧ ( BP &gt;140 / 90 mmHg  )</td>
          <td>�ӹǹ
            <?=$bpcount1+$bpcount2;?>
            ��� </td>
          <td>������ <?=number_format(((100*($bpcount1+$bpcount2))/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.6 ���ѧ�ŷ�������й�ӵ������ʹ�٧ ( FBS &gt; 126 mg% ) </td>
          <td>�ӹǹ
            <?=$bscount?>
            ��� </td>
          <td>������ <?=number_format(((100*$bscount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.7 ���ѧ�ŷ������ǡ�ó�ӧҹ�ͧ�Ѻ�Դ���� <br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(SGOT &gt; 80 u/l ������� SGPT &gt; 80 u/l) </td>
          <td>�ӹǹ
            <?=$sgcount?>
            ��� </td>
          <td>������ <?=number_format(((100*$sgcount)/$count),2)?></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.8 ���ѧ�ŷ���������ä����</td>
          <td>�ӹǹ
            
            - ��� </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.9 ���ѧ�ŷ���纻��¨ҡ�غѵ��˵ب�ṡ���������<br>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ͧ����Դ�غѵ��˵�</td>
          <td>�ӹǹ
            
            - ��� </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;4.10 ���ѧ�ŷ���ռš�÷��ͺ���ö�Ҿ��ҧ��¼�ҹࡳ��</td>
          <td>�ӹǹ
            
            - ��� </td>
          <td></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        </table>
<div style="page-break-before:always;"></div>
<div style="page-break-before:always"></div>

        <table width="100%" class="font1">
        <tr>
          <td width="100%">5.��ػ�š�õ�Ǩ��ҧ���� ��ṡ�� 3 ����� (100%)</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.1 ��������� ..
          <?=$stat_sum1+$stat_sum2?>.. ��� �Դ��������...<?=round((($stat_sum1+$stat_sum2)*100)/$count,2)?>......</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��������Թ 35 �� ��Ժ�ó� ..<?=$stat_sum1?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�����ҡ���� 35 �� ��Ժ�ó� ..<?=$stat_sum2?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��û�ԺѵԢͧ þ.��.��.3 ����Ѻ���ѧ�š��������.....�����йӡ�ô��ŵ��ͧ ��е�Ǩ�Ѵ��ͧ��ӷء 1 ��......</td>
        </tr>

        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.2 ���������§��ͧ������ѧ ..<?=$stat_sum3+$stat_sum4?>.. ��� �Դ��������....<?=round((($stat_sum3+$stat_sum4)*100)/$count,2)?>.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��������Թ 35 �� ��Ժ�ó� ..<?=$stat_sum3?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�����ҡ���� 35 �� ��Ժ�ó� ..<?=$stat_sum4?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�ä����ͧ������ѧ㹡��ѧ�š��������§ 5 �ӴѺ�á</td>
        </tr>
        <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.�ä ����ҹ �ӹǹ ....<? echo $stat_dm1+$stat_dm3;?>.... ���</td>
          </tr>
          <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.�ä �����ѹ���Ե�٧ �ӹǹ ....<? echo $stat_ht1+$stat_ht3;?>.... ���</td>
          </tr>
          <tr>
          <td>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.�ä  ��ʹ�������ͧ�պ�ѹ �ӹǹ ....<? echo $stat_str1+$stat_str3;?>.... ���</td>
          </tr>
          <tr>
          <td>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�ä  ��ǹ �ӹǹ ....<? echo $stat_obe1+$stat_obe3;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��û�ԺѵԢͧ þ.��.��.3 ����Ѻ���ѧ�š��������§��ͧ������ѧ.....ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;5.3 ����������� ..<?=$stat_sum5+$stat_sum6?>.. ��� �Դ��������....<?=round((($stat_sum5+$stat_sum6)*100)/$count,2)?>.....</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��������Թ 35 �� ��Ժ�ó� ..<?=$stat_sum5?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�����ҡ���� 35 �� ��Ժ�ó� ..<?=$stat_sum6?>.. ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�ä����Ǩ��㹡���������� 5 �ӴѺ�á </td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.�ä ����ҹ �ӹǹ ....<? echo $stat_dm2+$stat_dm4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.�ä �����ѹ���Ե�٧ �ӹǹ ....<? echo $stat_ht2+$stat_ht4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.�ä  ��ʹ�������ͧ�պ�ѹ �ӹǹ ....<? echo $stat_str2+$stat_str4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�ä  ��ǹ �ӹǹ ....<? echo $stat_obe2+$stat_obe4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��û�ԺѵԢͧ þ.��.��.3 ����Ѻ���ѧ�š����������.....�觵�������ѡ��.....</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
</table>
<br><br>
	<?
}

?>
</body>
</html>