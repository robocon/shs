<?php
include("connect.inc");
?>
<STYLE>
.font1 {
	font-family: "Angsana New";
	font-size:20px;
}

.font2 { font-family: "Angsana New"; font-size:20px; }

@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</STYLE>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<form id="form1" name="form1" method="post" action="<? $_SERVER['PHP_SELF']?>">
  <!--<a href="abnormal_dx_all.php">��§ҹ��ػ�ء˹���</a>-->
<table width="42%" border="0" align="center">
  <tr>
    <td height="31" align="center"><strong>��§ҹ��õ�Ǩ��ҧ��»�Шӻ� ��.</strong></td>
  </tr>
  <tr>
    <td height="36" align="center">
          ����� :  
<select  name='camp'>
<option value='' >--���͡�ѧ�Ѵ--</option>
<option value=''>�ء˹���</option>
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
	$sumg11=0;
	$sumg12=0;
	$sumg13=0;
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
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0319";
	if($_POST['camp']=='���.���.32') $_POST['camp']="M0320";
	if($_POST['camp']==''){
		$query123 = "select goup,count(*) as sum from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and substr(left(camp,3),2) between '02' and '10' group by goup ";
	
		$query2 = "select a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric from condxofyear_so as a, chkup_solider AS b where a.status_dr='Y' and a.yearcheck='".$_POST['year']."' AND b.hn = a.hn and substr(left(a.camp,3),2) between '02' and '10'  ";
		$_POST['camp']="���.32";
	}else{
		
		$query2 = "SELECT a.camp,a.bmi,a.age,a.bp1,a.bp2,a.cxr,a.stat_ua,a.hn,a.stat_hct,a.stat_bs,a.stat_chol,a.stat_tg,a.stat_bun,a.stat_cr,a.stat_sgot,a.stat_sgpt,a.stat_alk,a.stat_uric,a.smbasic,a.smdm,a.smht,a.smstr,a.smobe,a.round_,a.chol,a.tg,a.bs,a.sgot,a.sgpt FROM condxofyear_so AS a, chkup_solider AS b WHERE a.status_dr =  'Y' AND a.yearcheck =  '".$_POST['year']."' AND b.hn = a.hn and a.camp like '%".$_POST['camp']."%'  ";
		
	$query123 = "select goup,count(*) as sum  from chkup_solider where idno like '".substr($_POST['year'],2,2)."%' and camp like '%".$_POST['camp']."%' group by goup ";
	}


		$count33 = mysql_query($query123);
		while($result1 = mysql_fetch_array($count33)){
		$re1 = substr($result1['goup'],0,3);
		if($re1 =="G11"){
			$sumg11=$result1['sum'];
		}
		else if($re1 =="G12"){
			$sumg12=$result1['sum'];
		}else{
			$sumg13=$result1['sum'];
		}
		}
		
		
		$suma = $sumg11+$sumg12+$sumg13;
	$aa2 = mysql_query($query2);
	$count = mysql_num_rows($aa2);
	$perce = $count*100/$suma;
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
		elseif($code=="G12"|$code=="G21"){
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
		elseif($bmi>=18.50&&$bmi<=22.90){
			$bmi2++;
		}
		elseif($bmi>=23.00&&$bmi<=24.90){
			$bmi3++;
		}
		elseif($bmi>=25.00&&$bmi<=29.90){
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
		
	}
	if($_POST['camp']=='M0319') $_POST['camp']="���.���.32";
	if($_POST['camp']=='M0320') $_POST['camp']="���.���.32";

	$allcount = $count;
	?>
  <table width="100%" class="font1">
    <tr>
      <td colspan="4" align="center">�ѭ����ª��͢���Ҫ���</td>
    </tr>
    <tr>
      <td colspan="4" align="center">��õ�Ǩ��ҧ��»�Шӻ�
     &nbsp;&nbsp;&nbsp;&nbsp;<?=$_POST['year']?></td>
    </tr>
    <tr>
      <td colspan="4" align="center">˹���
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?=$_POST['camp']?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>1. �ӹǹ����Ҫ��÷���èب�ԧ</td>
      <td width="24%">&nbsp;</td>
      <td width="20%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ��·���</td>
      <td><?=$sumg11?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ����Ժ</td>
      <td><?=$sumg12?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ��������Ѥ�, ���ҹ, �١��ҧ</td>
      <td><?=$sumg13?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</td>
      <td><?=$suma?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>2. �ӹǹ����Ҫ��÷���Ѻ��õ�Ǩ</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ��·���</td>
      <td><?=$tahan1?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ����Ժ</td>
      <td><?=$tahan2?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;- ��������Ѥ�, ���ҹ, �١��ҧ</td>
      <td><?=$tahan3?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���</td>
      <td><?=$count?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�Ҫ���</td>
      <td><?=$tahan1+$tahan2;?></td>
      <td>��</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;����Ѻ��õ�Ǩ</td>
      <td><?=number_format($perce, 2, '.', '')?></td>
      <td>������</td>
    </tr>
  </table>
  <div style="page-break-after:always;"></div>
  <?
	include("abnormal_dx.php");
?>
  	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="font2">
  	  <tr>
  	    <td width="7%" colspan="2">��Ǩ�١��ͧ</td>
  	    <td width="9%">&nbsp;</td>
  	    <td width="35%">&nbsp;</td>
  	    <td width="25%">&nbsp;</td>
      </tr>
  	  <tr>
  	    <td colspan="2">.......................................................................</td>
  	    <td width="25%">&nbsp;</td>
  	    <td >(ŧ����) .......................................................</td>
  	    <td>�������ᾷ�����Ǩ</td>
      </tr>
  	  <tr>
  	    <td colspan="2">���˹� ...��.þ.��������ѡ��������....</td>
        <td width="25%">&nbsp;</td>
  	    <td >(ŧ����) .......................................................</td>
  	    <td>������� ���.ᾷ��</td>
      </tr>
  	  <tr>
  	    <td colspan="3"></td>
  	    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;.......................................................</td>
  	    <td>������� ���.ᾷ��</td>
      </tr>
</table>
  	  <?
}

?>
  	  
