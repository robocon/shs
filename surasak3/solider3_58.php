
<?php
   //print"<br><b>��ª��ͼ�����Ǩ�آ�Ҿ��ӡѹ</b>";
 include("connect.inc");
   $query="SELECT  hn,ptname,camp1,COUNT(*) AS duplicate FROM  condxofyear_so where yearcheck ='2558' and camp1 !=''  GROUP BY hn  HAVING duplicate > 1";
   $result = mysql_query($query);
     $n=0;
 while (list ($hn,$ptname,$camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n,</td>\n".
              // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>HN: $hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>����: $ptname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ѧ�Ѵ: $camp</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ���駷���� = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>

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
<form id="form1" name="form1" method="post" action="solider3_58.php">
  <table width="42%" border="0" align="center">
    <tr>
    <td height="31" align="center"><strong>��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.3</strong></td>
  </tr>
  <tr>
   
     <td align="center" ><strong>�ѧ�Ѵ (��Ǩ�آ�Ҿ) : </strong></td></tr>
  <tr>
    <td><select name="camp"  id="camp">
    
     <option value="">������</option>
      <option value="D01 þ.��������ѡ��������">þ.��������ѡ��������</option>
      <option value="D02 ��� ��� ͡.��� ���.32">��� ��� ͡.��� ���.32</option>
      <option value="D03 ���.���.32">���.���.32</option>
      <option value="D04 ʧ.ʴ.��.�.�.">ʧ.ʴ.��.�.�.</option>
      <option value="D05 ���.���.32">���.���.32</option>
      <option value="D06 �¡.���.32">�¡.���.32</option>
      <option value="D07 ���.���.32">���.���.32</option>
      <option value="D08 ���.���.32">���.���.32</option>
      <option value="D09 ���.���.32">���.���.32</option>
      <option value="D10 �ʡ.���.32">�ʡ.���.32</option> 
      <option value="D11 ���.���.32">���.���.32</option>  
      <option value="D12 ����.���.32">����.���.32</option> 
      <option value="D13 ��.���.32">��.���.32</option> 
      <option value="D14 ���.���.32">���.���.32</option>  
      <option value="D15 ���.���.32">���.���.32</option> 
      <option value="D16 ��Ȩ.���.32">��Ȩ.���.32</option> 
      <option value="D17 ���.���.32">���.���.32</option>  
      <option value="D18 ���.���.32">���.���.32</option> 
      <option value="D19 ��.�.���.32">��.�.���.32</option> 
      <option value="D20 ���.���.32">���.���.32</option>  
      <option value="D21 �ͧ è.���.32">�ͧ è.���.32</option>                                    
      <option value="D22 ����.��.���.32">����.��.���.32</option>  
      <option value="D23 ���.���.32">���.���.32</option>  
      <option value="D24 ʢ�.���.32">ʢ�.���.32</option>  
      <option value="D25 ��þ���ѧ ���.32">��þ���ѧ ���.32</option>  
      <option value="D26 ����.���.32">����.���.32</option>  
      <option value="D27 �ʾ.���.32">�ʾ.���.32</option>  
      <option value="D28 ��.��.���.32">��.��.���.32</option>  
      <option value="D29 Ƚ.�ȷ.���.32">Ƚ.�ȷ.���.32</option>  
      <option value="D30 �.17 �ѹ.2">�.17 �ѹ.2</option>  
      <option value="D31 �.�ѹ.4 ����4">�.�ѹ.4 ����4</option>  
      <option value="D32 ����.�þ.3">����.�þ.3</option>
        <option value="D34 ���.33">���.33</option>
      <option value="D33 ˹��·�������">˹��·�������</option>                            
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
	///if($_POST['camp']=='���.���.32') $_POST['camp']="M0319";
//	if($_POST['camp']=='���.���.32') $_POST['camp']="M0320";
	
	if($_POST['camp']==''){
		$query123 = "select count(*) as sum from chkup_solider where yearchkup like '".substr($_POST['year'],2,2)."%'   ";
		
		$sqlall = "SELECT camp1,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric,smbasic,smdm,smht,smstr,smobe,round_,chol,tg,bs,sgot,sgpt,sum1,sum2,sum3,sum4,sum5,rs_sum21,rs_sum22,rs_sum23,rs_sum24,rs_sum25,rs_sum51,rs_sum52,rs_sum53 FROM condxofyear_so WHERE yearcheck =  '".$_POST['year']."' AND  camp1 like 'D%'  ";
		
	}else{
		$query123 = "select goup,count(*) as sum  from chkup_solider where yearchkup like '".substr($_POST['year'],2,2)."%'  and camp like '%".$_POST['camp']."%' group by goup ";
		$sqlall = "SELECT camp1,bmi,age,bp1,bp2,cxr,stat_ua,hn,stat_hct,stat_bs,stat_chol,stat_tg,stat_bun,stat_cr,stat_sgot,stat_sgpt,stat_alk,stat_uric,smbasic,smdm,smht,smstr,smobe,round_,chol,tg,bs,sgot,sgpt,sum1,sum2,sum3,sum4,sum5,rs_sum21,rs_sum22,rs_sum23,rs_sum24,rs_sum25,rs_sum51,rs_sum52,rs_sum53 FROM condxofyear_so WHERE yearcheck =  '".$_POST['year']."' AND  camp1 like '%".$_POST['camp']."%'  ";
		
	}

//echo $sqlall;
	$aa2 = mysql_query($query2);
	
	$aa9 = mysql_query($sqlall);
	$count = mysql_num_rows($aa9);//�ӹǹ����������ҵ�Ǩ
	
	
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
	
	while(list($camp,$bmi,$age,$bp1,$bp2,$cxr,$stat_ua,$nhn,$stat_hct,$stat_bs,$stat_chol,$stat_tg,$stat_bun,$stat_cr,$stat_sgot,$stat_sgpt,$stat_alk,$stat_uric,$smbasic,$smdm,$smht,$smstr,$smobe,$round,$chol,$tg,$bs,$sgot,$sgpt,$smbasic1,$smbasic2,$smbasic3,$smbasic4,$smbasic5,$rs_sum21,$rs_sum22,$rs_sum23,$rs_sum24,$rs_sum25,$rs_sum51,$rs_sum52,$rs_sum53) = mysql_fetch_array($aa9)){
			
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
			
			
			
			if($smbasic5=="���´����ä������ѧ"){
				$stat_sum5++;
				if($rs_sum51=="DM"){
					$stat_dm2++;
				}
				if($rs_sum52=="HT"){
					$stat_ht2++;
				}
				if($rs_sum53=="DLP"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
			}else if($smbasic3=="�����й��˹ѡ�Թ" || $smbasic4=="�դ�Ҥ����ѹ���Ե�Թ��һ���" ||$smbasic2=="����������§���ͧ�鹵���ä"){
				$stat_sum3++;
				if($rs_sum21=="��ӵ��"){
					$stat_dm1++;
				}if($rs_sum22=="��ѹ"){
					$stat_dm1_1++;
				}if($rs_sum23=="���Ԥ"){
					$stat_dm1_2++;
				}if($rs_sum24=="�Ѻ"){
					$stat_dm1_3++;
				}if($rs_sum25=="�"){
					$stat_dm1_4++;
				}
				if($smbasic4=="�դ�Ҥ����ѹ���Ե�Թ��һ���"){
					$stat_ht1++;
				}
				
				if($smbasic3=="�����й��˹ѡ�Թ"){
					$stat_obe1++;
				}
			}	 
			else if($smbasic1=="���� (��辺��������§)"){
				$stat_sum1++;	
			
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
			
			
			
			
			if($smbasic5=="���´����ä������ѧ"){
				$stat_sum6++;
				if($rs_sum51=="DM"){
					$stat_dm2++;
				}
				if($rs_sum52=="HT"){
					$stat_ht2++;
				}
				if($rs_sum53=="DLP"){
					$stat_str2++;
				}
				if($smobe=="Y"){
					$stat_obe2++;
				}
			}elseif($smbasic3=="�����й��˹ѡ�Թ" || $smbasic4=="�դ�Ҥ����ѹ���Ե�Թ��һ���" ||$smbasic2=="����������§���ͧ�鹵���ä"){
				$stat_sum4++;
				if($rs_sum21=="��ӵ��"){
					$stat_dm3++; }
					if($rs_sum22=="��ѹ"){
					$stat_dm3_1++;
					}if($rs_sum23=="���Ԥ"){
					$stat_dm3_2++;
					}if($rs_sum24=="�Ѻ"){
					$stat_dm3_3++;
					}if($rs_sum25=="�"){
					$stat_dm3_4++;
				}
				if($smbasic4=="�դ�Ҥ����ѹ���Ե�Թ��һ���"){
					$stat_ht3++;
				}
				if($smbasic3=="�����й��˹ѡ�Թ" ){
					$stat_obe3++;
				} 
			}
			else if($smbasic1=="���� (��辺��������§)"){
				$stat_sum2++;
			}
		}
		//$_POST['camp']=$camp;
	}
	
	
	//���ä
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
<br>
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
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�ä����ͧ������ѧ㹡��ѧ�š��������§ </td>
        </tr>
        <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.�ä ����ҹ �ӹǹ ....<? echo $stat_dm1+$stat_dm3;?>.... ���</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.�ä ��ѹ����ʹ �ӹǹ ....<? echo $stat_dm1_1+$stat_dm3_1;?>.... ���</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.�ä ��ҷ� �ӹǹ ....<? echo $stat_dm1_2+$stat_dm3_2;?>.... ���</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�ä �Ѻ �ӹǹ ....<? echo $stat_dm1_3+$stat_dm3_3;?>.... ���</td>
          </tr>
          <tr>
          <td>      		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;5.�ä � �ӹǹ ....<? echo $stat_dm1_4+$stat_dm3_4;?>.... ���</td>
          </tr>
       
          <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;6.�ä �����ѹ���Ե�٧ �ӹǹ ....<? echo $stat_ht1+$stat_ht3;?>.... ���</td>
          </tr>
          <tr>
          <td>        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;7.�ä  ��ǹ �ӹǹ ....<? echo $stat_obe1+$stat_obe3;?>.... ���</td>
        </tr>
        
   
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��û�ԺѵԢͧ þ.��.��.3 ����Ѻ���ѧ�š��������§��ͧ������ѧ.....ŧ����¹���������§��͡�����ä Metabolic ����й�����ç��û�Ѻ����¹�ĵԡ���.....</td>
        </tr>
             <br>
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
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-�ä����Ǩ��㹡����������  </td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;1.�ä ����ҹ �ӹǹ ....<? echo $stat_dm2+$stat_dm4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;2.�ä �����ѹ���Ե�٧ �ӹǹ ....<? echo $stat_ht2+$stat_ht4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;3.�ä  ��ѹ����ʹ�٧ �ӹǹ ....<? echo $stat_str2+$stat_str4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;4.�ä  ��ǹ �ӹǹ ....<? echo $bmi4;?>.... ���</td>
        </tr>
        <tr>
          <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-��û�ԺѵԢͧ þ.��.��.3 ����Ѻ���ѧ�š����������.....�觵�������ѡ��.....</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
</table>
<br>

<?php


    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" G:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today;   
	 $doctor="$doctor1";   

  $camp111 = $_POST['camp'];
	 print "<font face='Angsana New' size='3'>��ª��ͼ�������������Ѻ��õ�Ǩ�آ�Ҿ��Шӻ� $year ";
	 print "<font face='Angsana New' size='2'>Ἱ�/���� $camp111   <br>";   
    print "<font face='Angsana New' size='2'><b>��§ҹ�ѹ��� $Thidate</b> ";
  
	$today="$yr-$m-$d";
    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$num=1;
?>
<table>
 <tr>
   <th bgcolor=6495ED><font size='2'>#</th>
  <th bgcolor=6495ED><font size='2'>HN</th>
  <th bgcolor=6495ED><font size='2'>����</th>
  <th bgcolor=6495ED><font size='2'>���˹�</th>
    <th bgcolor=6495ED><font size='2'>idno</th>
    <th bgcolor=6495ED><font size='2'>�˵ؼ�</th>
	

<?php
 include("connect.inc");
 $query="SELECT hn,camp,position,idno  FROM chkup_solider WHERE camp like '%".$_POST['camp']."%' ORDER by goup,idno";
  $result = mysql_query($query)or die("Query failed");
    while (list ($hn,$camp,$group,$idno) = mysql_fetch_row ($result)) {	

		$tbsql="select * from condxofyear_so where hn='$hn' and yearcheck =  '".$_POST['year']."'  ";
  		$tbresult = mysql_query($tbsql)or die("Query failed");
		//echo $tbsql."</br>";
		$num1=mysql_num_rows($tbresult);
		//echo "--->".$num1."</br>";
		if($num1 < 1){

$sql = "Select yot,name,surname From opcard where hn = '$hn' ";
	list($yot,$name,$surname)  = mysql_fetch_row(Mysql_Query($sql));

$fullname=$yot.''.$name.'&nbsp;'.$surname;
if($dr!=""){
	$dr=(substr($dr,0,4)+543)."-".substr($dr,5);
}
if($opd!=""){
	$opd=(substr($opd,0,4)+543)."-".substr($opd,5);
}
 	print("<tr>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$hn</td>\n".
	"<td bgcolor=F5DEB3><font face='Angsana New'>$fullname</td>\n".
//	"<td bgcolor=F5DEB3><font face='Angsana New'>$camp</td>\n".    
	"<td bgcolor=F5DEB3><font face='Angsana New'>$group</td>\n".    
	"<td bgcolor=F5DEB3 ><font face='Angsana New'>$idno</td>\n".  
		"<td bgcolor=F5DEB3 ><font face='Angsana New'></td>\n".  
	" </tr>\n");
$num++;
}       
	}
include("unconnect.inc");
//�ʴ���¡�ä׹�Թ
?>




<br><br>
	<?
}

?>

</body>
</html>