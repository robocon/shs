<?
include("connect.inc");
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$showyear="25".$nPrefix;
?>	
<title>��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. ��Шӻ� <?=$showyear;?></title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<div id="no_print" > 
<a href ="../nindex.htm" >&lt;&lt; ��Ѻ˹����ѡ</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. ��Шӻ� <?=$showyear;?>
</p>
<form name="form1" method="post" action="reportchkup_armytp3.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>�ء˹���</option>
		 <?
		 $sql="select distinct(camp) as camp from chkup_solider where yearchkup = '$nPrefix'";
		 $query=mysql_query($sql);
		 while($rows=mysql_fetch_array($query)){
		 $camp=substr($rows["camp"],4);
		 ?>                
          <option value="<?=$rows["camp"];?>"><?=$camp;?></option>
          <?
		  }
		  ?>
        </select>
        <input type="submit" name="button" id="button" value="����§ҹ">
        </label></td>
    </tr>
  </table>
  </div>
</form>
<?
if($_POST["act"]=="show"){
	if($_POST["camp"]=="all"){
	$result="select * from chkup_solider where yearchkup='$nPrefix'";
	}else{
	$result="select * from chkup_solider where yearchkup='$nPrefix' and camp='$_POST[camp]'";
	}
	$object=mysql_query($result) or die("Query chkup_solider Error");
	$numtotal=mysql_num_rows($object);

	$sqlhos=mysql_query("select pcuname from mainhospital where pcuid='1'");
	list($pcuname)=mysql_fetch_array($sqlhos);
	
	if($_POST["camp"]=="all"){
		$showcamp="�ء˹���";
		$sql="CREATE  TEMPORARY  TABLE report_armychkup SELECT * FROM condxofyear_so where yearcheck = '$showyear' AND camp1 like 'D%' ";
		//echo $sql;
		$query=mysql_query($sql);
		
	}else{
		$showcamp=substr($_POST["camp"],4);
		$sql="CREATE  TEMPORARY  TABLE report_armychkup SELECT * FROM condxofyear_so where yearcheck = '$showyear' AND camp1 = '$_POST[camp]'";
		//echo $sql;
		$query=mysql_query($sql);	
	}
	$chksql=mysql_query("select * from report_armychkup");
	
	$numchkup=mysql_num_rows($chksql);
	$numchunyot1=0;
	$numchunyot2=0;
	$numchunyot3=0;
	$numweight1=0;
	$numweight2=0;
	$numweight3=0;
	$numweight4=0;
	$numweight5=0;
	$numage34=0;
	$numage35=0;
	$age34bp=0;
	$age35bp=0;
	$age34xray=0;
	$age35xray=0;	
	$age34uric=0;
	$age35uric=0;
	$age34hct=0;
	$age35hct=0;	
	$age35glu=0;
	$age35chol=0;		
	$age35trig=0;
	$age35hdl=0;
	$age35ldl=0;	
	$age35bun=0;	
	$age35crea=0;	
	$age35sgot=0;	
	$age35sgpt=0;	
	$age35alk=0;		
	$age34anemia=0;	
	$age35anemia=0;	
	$age34cirrhosis=0;
	$age35cirrhosis=0;
	$age34hepatitis=0;
	$age35hepatitis=0;	
	$age34cardiomegaly=0;
	$age35cardiomegaly=0;		
	$age34allergy=0;  //������
	$age35allergy=0;	
	$age34gout=0;  //��ҷ�
	$age35gout=0;		
	$age34waistline=0;  //�ͺ���
	$age35waistline=0;	
	$age34asthma=0;  //�ͺ�״
	$age35asthma=0;		
	$age34muscle=0;  //����������ѡ�ʺ
	$age35muscle=0;
	$age34ihd=0;  //�ä���㨢Ҵ���ʹ������ѧ
	$age35ihd=0;	
	$age34thyroid=0;  //���´�
	$age35thyroid=0;		
	$age34heart=0;  //�ä����
	$age35heart=0;
	$age34emphysema=0;  //�ا���觾ͧ
	$age35emphysema=0;
	$age34herniated=0;  //��͹�ͧ��д١�Ѻ��鹻���ҷ
	$age35herniated=0;
	$age34conjunctivitis=0;  //����ͺص��ѡ�ʺ
	$age35conjunctivitis=0;	
	$age34cystitis=0;  //�����л�������ѡ�ʺ
	$age35cystitis=0;	
	$age34epilepsy=0;  //���ѡ
	$age35epilepsy=0;	
	$age34fracture=0;  //��д١�ѡ����͹
	$age35fracture=0;	
	$age34cardiac=0;  //�����鹼Դ�ѧ���
	$age35cardiac=0;	
	$age34spine=0;  //��д١�ѹ��ѧ (͡) ��
	$age35spine=0;		
	$age34dermatitis=0;  //���˹ѧ�ѡ�ʺ
	$age35dermatitis=0;	
	$age34degeneration=0;  //������������
	$age35degeneration=0;	
	$age34alcoholic=0;  //�����Դ���Ԩҡ��š�����
	$age35alcoholic=0;	
	$age34copd=0;  //COPD
	$age35copd=0;	
	$age34bph=0;  //BPH
	$age35bph=0;	
	$age34kidney=0;  //䵼Դ����
	$age35kidney=0;	
	$age34pterygium=0;  //�������
	$age35pterygium=0;	
	$age34tonsil=0;  //�����͹����
	$age35tonsil=0;	
	$age34paralysis=0;  //����ҵ�ա����/���
	$age35paralysis=0;
	$age34blood=0;  //������ʹ�Դ����
	$age35blood=0;	
	$age34conanemia=0;  //���Ыմ
	$age35conanemia=0;
	$age34ht=0;  //�����ѹ���Ե�٧
	$age35ht=0;	
	$age34dm=0;  //����ҹ
	$age35dm=0;		
	
	$age34bmi1=0;  //bmi 25.1 - 29.9
	$age35bmi1=0;	
	$age34bmi2=0;  //bmi > 30
	$age35bmi2=0;		
	$age35choltrig=0;	
	$age35sgotsgpt=0;													

	$ch1cigarette0=0;
	$ch1cigarette1=0;
	$ch1cigarette2=0;
	$ch2cigarette0=0;
	$ch2cigarette1=0;
	$ch2cigarette2=0;	
	$ch3cigarette0=0;
	$ch3cigarette1=0;
	$ch3cigarette2=0;	
	
	$ch1alcohol0=0;
	$ch1alcohol1=0;
	$ch1alcohol2=0;
	$ch2alcohol0=0;
	$ch2alcohol1=0;
	$ch2alcohol2=0;	
	$ch3alcohol0=0;
	$ch3alcohol1=0;
	$ch3alcohol2=0;	
	
	$ch1exercise0=0;
	$ch1exercise1=0;
	$ch1exercise2=0;
	$ch2exercise0=0;
	$ch2exercise1=0;
	$ch2exercise2=0;	
	$ch3exercise0=0;
	$ch3exercise1=0;
	$ch3exercise2=0;				
		
	while($chkrows=mysql_fetch_array($chksql)){
		if($chkrows["chunyot1"]=="CH01 ��·��ê���ѭ�Һѵ�"){
			$numchunyot1++;
		}
		if($chkrows["chunyot1"]=="CH02 ��·��ê�鹻�зǹ"){
			$numchunyot2++;
		}
		if($chkrows["chunyot1"]=="CH04 �١��ҧ��Ш�"){
			$numchunyot3++;
		}	
		
		if($chkrows["bmi"]<=18.5){
			$numweight1++;
		}elseif($chkrows["bmi"]<23){
			$numweight2++;
		}
		else if($chkrows["bmi"]<25){
			$numweight3++;
		}
		else if($chkrows["bmi"]<30){
			$numweight4++;
		}
		else if($chkrows["bmi"]>30.0){
			$numweight5++;
		}
		
		//-------------------------------- �礪�ǧ������ -------------------------------//
		if(substr($chkrows["age"],0,2) < 35){  //���ѧ�ŷ�������ع��¡��� 35
			$numage34++;
			if($chkrows["sum4"]=="�դ�Ҥ����ѹ���Ե�Թ��һ���"){
				$age34bp++;
			}
			if($chkrows["cxr"]=="�Դ����"){
				$age34xray++;
			}	
			if($chkrows["stat_uric"]=="�Դ����"){
				$age34uric++;
			}	
			if($chkrows["stat_hct"]=="�Դ����"){
				$age34hct++;
			}
			if($chkrows["anemia"]=="Y"){
				$age34anemia++;
			}	
			if($chkrows["cirrhosis"]=="Y"){
				$age34cirrhosis++;
			}	
			if($chkrows["hepatitis"]=="Y"){
				$age34hepatitis++;
			}
			if($chkrows["cardiomegaly"]=="Y"){
				$age34cardiomegaly++;
			}																			
			if($chkrows["allergy"]=="Y"){
				$age34allergy++;
			}	
			if($chkrows["gout"]=="Y"){
				$age34gout++;
			}
			if($chkrows["bmi"] >=25.1 && $chkrows["bmi"] <=29.9){
				$age34bmi1++;
			}
			if($chkrows["bmi"] >= 30){
				$age34bmi2++;
			}			
			if($chkrows["waistline"]=="Y"){
				$age34waistline++;
			}
			if($chkrows["asthma"]=="Y"){
				$age34asthma++;
			}
			if($chkrows["muscle"]=="Y"){
				$age34muscle++;
			}
			if($chkrows["ihd"]=="Y"){
				$age34ihd++;
			}
			if($chkrows["thyroid"]=="Y"){
				$age34thyroid++;
			}	
			if($chkrows["heart"]=="Y"){
				$age34heart++;
			}
			if($chkrows["emphysema"]=="Y"){
				$age34emphysema++;
			}
			if($chkrows["herniated"]=="Y"){
				$age34herniated++;
			}
			if($chkrows["conjunctivitis"]=="Y"){
				$age34conjunctivitis++;
			}
			if($chkrows["cystitis"]=="Y"){
				$age34cystitis++;
			}
			if($chkrows["epilepsy"]=="Y"){
				$age34epilepsy++;
			}
			if($chkrows["fracture"]=="Y"){
				$age34fracture++;
			}
			if($chkrows["cardiac"]=="Y"){
				$age34cardiac++;
			}
			if($chkrows["spine"]=="Y"){
				$age34spine++;
			}
			if($chkrows["dermatitis"]=="Y"){
				$age34dermatitis++;
			}
			if($chkrows["degeneration"]=="Y"){
				$age34degeneration++;
			}
			if($chkrows["alcoholic"]=="Y"){
				$age34alcoholic++;
			}
			if($chkrows["copd"]=="Y"){
				$age34copd++;
			}
			if($chkrows["bph"]=="Y"){
				$age34bph++;
			}
			if($chkrows["kidney"]=="Y"){
				$age34kidney++;
			}
			if($chkrows["pterygium"]=="Y"){
				$age34pterygium++;
			}
			if($chkrows["tonsil"]=="Y"){
				$age34tonsil++;
			}
			if($chkrows["paralysis"]=="Y"){
				$age34paralysis++;
			}
			if($chkrows["blood"]=="Y"){
				$age34blood++;
			}	
			if($chkrows["conanemia"]=="Y"){
				$age34conanemia++;
			}
			if($chkrows["rs_sum52"]=="HT"){
				$age34ht++;
			}
			if($chkrows["rs_sum51"]=="DM"){
				$age34dm++;
			}																																																																						
		}else{  // ���ѧ�ŷ�������ص���� 35 �պ�Ժ�ó����
			$numage35++;
			if($chkrows["sum4"]=="�դ�Ҥ����ѹ���Ե�Թ��һ���"){
				$age35bp++;
			}
			if($chkrows["cxr"]=="�Դ����"){
				$age35xray++;
			}	
			if($chkrows["stat_uric"]=="�Դ����"){
				$age35uric++;
			}	
			if($chkrows["stat_hct"]=="�Դ����"){
				$age35hct++;
			}	
			if($chkrows["stat_bs"]=="�Դ����"){
				$age35glu++;
			}	
			if($chkrows["stat_chol"]=="�Դ����"){
				$age35chol++;
			}
			if($chkrows["stat_tg"]=="�Դ����"){
				$age35trig++;
			}
			if($chkrows["stat_hdl"]=="�Դ����"){
				$age35hdl++;
			}
			if($chkrows["stat_ldl"]=="�Դ����"){
				$age35ldl++;
			}						
			if($chkrows["stat_bun"]=="�Դ����"){
				$age35bun++;
			}
			if($chkrows["stat_cr"]=="�Դ����"){
				$age35crea++;
			}
			if($chkrows["stat_sgot"]=="�Դ����"){
				$age35sgot++;
			}
			if($chkrows["stat_sgpt"]=="�Դ����"){
				$age35sgpt++;
			}
			if($chkrows["stat_alk"]=="�Դ����"){
				$age35alk++;
			}																																								
			if($chkrows["anemia"]=="Y"){
				$age35anemia++;
			}	
			if($chkrows["cirrhosis"]=="Y"){
				$age35cirrhosis++;
			}	
			if($chkrows["hepatitis"]=="Y"){
				$age35hepatitis++;
			}
			if($chkrows["cardiomegaly"]=="Y"){
				$age35cardiomegaly++;
			}		
			if($chkrows["allergy"]=="Y"){
				$age35allergy++;
			}	
			if($chkrows["gout"]=="Y"){
				$age35gout++;
			}
			if($chkrows["bmi"] >25 && $chkrows["bmi"] <=29.9){
				$age35bmi1++;
			}
			if($chkrows["bmi"] >= 30){
				$age35bmi2++;
			}			
			if($chkrows["waistline"]=="Y"){
				$age35waistline++;
			}
			if($chkrows["asthma"]=="Y"){
				$age35asthma++;
			}
			if($chkrows["muscle"]=="Y"){
				$age35muscle++;
			}
			if($chkrows["ihd"]=="Y"){
				$age35ihd++;
			}
			if($chkrows["thyroid"]=="Y"){
				$age35thyroid++;
			}	
			if($chkrows["heart"]=="Y"){
				$age35heart++;
			}
			if($chkrows["emphysema"]=="Y"){
				$age35emphysema++;
			}
			if($chkrows["herniated"]=="Y"){
				$age35herniated++;
			}
			if($chkrows["conjunctivitis"]=="Y"){
				$age35conjunctivitis++;
			}
			if($chkrows["cystitis"]=="Y"){
				$age35cystitis++;
			}
			if($chkrows["epilepsy"]=="Y"){
				$age35epilepsy++;
			}
			if($chkrows["fracture"]=="Y"){
				$age35fracture++;
			}
			if($chkrows["cardiac"]=="Y"){
				$age35cardiac++;
			}
			if($chkrows["spine"]=="Y"){
				$age35spine++;
			}
			if($chkrows["dermatitis"]=="Y"){
				$age35dermatitis++;
			}
			if($chkrows["degeneration"]=="Y"){
				$age35degeneration++;
			}
			if($chkrows["alcoholic"]=="Y"){
				$age35alcoholic++;
			}
			if($chkrows["copd"]=="Y"){
				$age35copd++;
			}
			if($chkrows["bph"]=="Y"){
				$age35bph++;
			}
			if($chkrows["kidney"]=="Y"){
				$age35kidney++;
			}
			if($chkrows["pterygium"]=="Y"){
				$age35pterygium++;
			}
			if($chkrows["tonsil"]=="Y"){
				$age35tonsil++;
			}
			if($chkrows["paralysis"]=="Y"){
				$age35paralysis++;
			}
			if($chkrows["blood"]=="Y"){
				$age35blood++;
			}	
			if($chkrows["conanemia"]=="Y"){
				$age35conanemia++;
			}
			if($chkrows["rs_sum52"]=="HT"){
				$age35ht++;
			}
			if($chkrows["rs_sum51"]=="DM"){
				$age35dm++;
			}							
			if($chkrows["stat_chol"]=="�Դ����" && $chkrows["stat_tg"]=="�Դ����"){
				$age35choltrig++;
			}
			if($chkrows["stat_sgot"]=="�Դ����" && $chkrows["stat_sgpt"]=="�Դ����"){
				$age35sgotsgpt++;
			}																								
		} // close if age		
		
		
		//-------------------------------- �礪����-------------------------------//
		if($chkrows["chunyot1"]=="CH01 ��·��ê���ѭ�Һѵ�"){
			if($chkrows["cigarette"]=="" || $chkrows["cigarette"]=="0"){
				$ch1cigarette0++;
			}
			if($chkrows["cigarette"]=="1"){
				$ch1cigarette1++;
			}
			if($chkrows["cigarette"]=="2" || $chkrows["cigarette"]=="3"){
				$ch1cigarette2++;
			}
			
			if($chkrows["alcohol"]=="" || $chkrows["alcohol"]=="0"){
				$ch1alcohol0++;
			}
			if($chkrows["alcohol"]=="1"){
				$ch1alcohol1++;
			}
			if($chkrows["alcohol"]=="2" || $chkrows["alcohol"]=="3"){
				$ch1alcohol2++;
			}
			
			if($chkrows["exercise"]=="" || $chkrows["exercise"]=="0"){
				$ch1exercise0++;
			}
			if($chkrows["exercise"]=="1"){
				$ch1exercise1++;
			}
			if($chkrows["exercise"]=="2" || $chkrows["exercise"]=="3"){
				$ch1exercise2++;
			}														
		}else if($chkrows["chunyot1"]=="CH02 ��·��ê�鹻�зǹ"){
			if($chkrows["cigarette"]=="" || $chkrows["cigarette"]=="0"){
				$ch2cigarette0++;
			}
			if($chkrows["cigarette"]=="1"){
				$ch2cigarette1++;
			}
			if($chkrows["cigarette"]=="2" || $chkrows["cigarette"]=="3"){
				$ch2cigarette2++;
			}
			
			if($chkrows["alcohol"]=="" || $chkrows["alcohol"]=="0"){
				$ch2alcohol0++;
			}
			if($chkrows["alcohol"]=="1"){
				$ch2alcohol1++;
			}
			if($chkrows["alcohol"]=="2" || $chkrows["alcohol"]=="3"){
				$ch2alcohol2++;
			}
			
			if($chkrows["exercise"]=="" || $chkrows["exercise"]=="0"){
				$ch2exercise0++;
			}
			if($chkrows["exercise"]=="1"){
				$ch2exercise1++;
			}
			if($chkrows["exercise"]=="2" || $chkrows["exercise"]=="3"){
				$ch2exercise2++;
			}			
		}else if($chkrows["chunyot1"]=="CH04 �١��ҧ��Ш�"){
			if($chkrows["cigarette"]=="" || $chkrows["cigarette"]=="0"){
				$ch3cigarette0++;
			}
			if($chkrows["cigarette"]=="1"){
				$ch3cigarette1++;
			}
			if($chkrows["cigarette"]=="2" || $chkrows["cigarette"]=="3"){
				$ch3cigarette2++;
			}
			
			if($chkrows["alcohol"]=="" || $chkrows["alcohol"]=="0"){
				$ch3alcohol0++;
			}
			if($chkrows["alcohol"]=="1"){
				$ch3alcohol1++;
			}
			if($chkrows["alcohol"]=="2" || $chkrows["alcohol"]=="3"){
				$ch3alcohol2++;
			}
			
			if($chkrows["exercise"]=="" || $chkrows["exercise"]=="0"){
				$ch3exercise0++;
			}
			if($chkrows["exercise"]=="1"){
				$ch3exercise1++;
			}
			if($chkrows["exercise"]=="2" || $chkrows["exercise"]=="3"){
				$ch3exercise2++;
			}			
		}			
		
		$sumcigarette0=$ch1cigarette0+$ch2cigarette0+$ch3cigarette0;
		$sumcigarette1=$ch1cigarette1+$ch2cigarette1+$ch3cigarette1;
		$sumcigarette2=$ch1cigarette2+$ch2cigarette2+$ch3cigarette2;
		
		$sumalcohol0=$ch1alcohol0+$ch2alcohol0+$ch3alcohol0;
		$sumalcohol1=$ch1alcohol1+$ch2alcohol1+$ch3alcohol1;
		$sumalcohol2=$ch1alcohol2+$ch2alcohol2+$ch3alcohol2;
		
		$sumexercise0=$ch1exercise0+$ch2exercise0+$ch3exercise0;
		$sumexercise1=$ch1exercise1+$ch2exercise1+$ch3exercise1;
		$sumexercise2=$ch1exercise2+$ch2exercise2+$ch3exercise2;				
		
		
		
		
		
		$sumanemia=$age34anemia+$age35anemia;
		$sumcirrhosis=$age34cirrhosis+$age35cirrhosis;			
		$sumhepatitis=$age34hepatitis+$age35hepatitis;
		$sumcardiomegaly=$age34cardiomegaly+$age35cardiomegaly;
		$sumallergy=$age34allergy+$age35allergy;
		$sumgout=$age34gout+$age35gout;
		$sumbmi1=$age34bmi1+$age35bmi1;
		$sumbmi2=$age34bmi2+$age35bmi2;
		$sumwaistline=$age34waistline+$age35waistline;
		$sumasthma=$age34asthma+$age35asthma;
		$summuscle=$age34muscle+$age35muscle;
		$sumihd=$age34ihd+$age35ihd;				
		$sumthyroid=$age34thyroid+$age35thyroid;
		$sumheart=$age34heart+$age35heart;
		$sumemphysema=$age34emphysema+$age35emphysema;
		$sumherniated=$age34herniated+$age35herniated;
		$sumconjunctivitis=$age34conjunctivitis+$age35conjunctivitis;
		$sumcystitis=$age34cystitis+$age35cystitis;	
		$sumepilepsy=$age34epilepsy+$age35epilepsy;
		$sumfracture=$age34fracture+$age35fracture;
		$sumcardiac=$age34cardiac+$age35cardiac;
		$sumspine=$age34spine+$age35spine;
		$sumdermatitis=$age34dermatitis+$age35dermatitis;
		$sumdegeneration=$age34degeneration+$age35degeneration;				
		$sumalcoholic=$age34alcoholic+$age35alcoholic;
		$sumcopd=$age34copd+$age35copd;
		$sumbph=$age34bph+$age35bph;
		$sumkidney=$age34kidney+$age35kidney;
		$sumpterygium=$age34pterygium+$age35pterygium;
		$sumtonsil=$age34tonsil+$age35tonsil;	
		$sumparalysis=$age34paralysis+$age35paralysis;
		$sumblood=$age34blood+$age35blood;
		$sumconanemia=$age34conanemia+$age35conanemia;
		$sumht=$age34ht+$age35ht;
		$sumdm=$age34dm+$age35dm;		
		$sumchol=$age35chol;
		$sumtrig=$age35trig;
		$sumhdl=$age35hdl;
		$sumldl=$age35ldl;
		$sumcholtrig=$age35choltrig;
		$sumsgot=$age35sgot;
		$sumsgpt=$age35sgpt;
		$sumsgotsgpt=$age35sgotsgpt;		
		
		$totalage34=$age34ht+$age34dm+$age34anemia+$age34cirrhosis+$age34hepatitis+$age34cardiomegaly+$age34allergy+$age34gout+$age34bmi1+$age34bmi2+$age34waistline+$age34asthma+$age34muscle+$age34ihd+$age34thyroid+$age34heart+$age34emphysema+$age34herniated+$age34conjunctivitis+$age34cystitis+$age34epilepsy+$age34fracture+$age34cardiac+$age34spine+$age34dermatitis+$age34degeneration+$age34alcoholic+$age34copd+$age34bph+$age34kidney+$age34pterygium+$age34tonsil+$age34paralysis+$age34blood+$age34conanemia;	
		
			$totalage35=$age35ht+$age35dm+$age35chol+$age35trig+$age35choltrig+$age35anemia+$age35cirrhosis+$age35hepatitis+$age35sgot+$age35sgpt+$age35sgotsgpt+$age35cardiomegaly+$age35allergy+$age35gout+$age35bmi1+$age35bmi2+$age35waistline+$age35asthma+$age35muscle+$age35ihd+$age35thyroid+$age35heart+$age35emphysema+$age35herniated+$age35conjunctivitis+$age35cystitis+$age35epilepsy+$age35fracture+$age35cardiac+$age35spine+$age35dermatitis+$age35degeneration+$age35alcoholic+$age35copd+$age35bph+$age35kidney+$age35pterygium+$age35tonsil+$age35paralysis+$age35blood+$age35conanemia;
			
			$totalage=$totalage34+$totalage35;					
	}  // close while
$percenanemia=$sumanemia*100/$numchkup;
$percencirrhosis=$sumcirrhosis*100/$numchkup;
$percenhepatitis=$sumhepatitis*100/$numchkup;
$percencardiomegaly=$sumcardiomegaly*100/$numchkup;
$percenallergy=$sumallergy*100/$numchkup;
$percengout=$sumgout*100/$numchkup;
$percenbmi1=$sumbmi1*100/$numchkup;
$percenbmi2=$sumbmi2*100/$numchkup;
$percenwaistline=$sumwaistline*100/$numchkup;
$percenasthma=$sumasthma*100/$numchkup;
$percenmuscle=$summuscle*100/$numchkup;
$percenihd=$sumihd*100/$numchkup;
$percenthyroid=$sumthyroid*100/$numchkup;
$percenheart=$sumheart*100/$numchkup;
$percenemphysema=$sumemphysema*100/$numchkup;
$percenherniated=$sumherniated*100/$numchkup;
$percenconjunctivitis=$sumconjunctivitis*100/$numchkup;
$percencystitis=$sumcystitis*100/$numchkup;
$percenepilepsy=$sumepilepsy*100/$numchkup;
$percenfracture=$sumfracture*100/$numchkup;
$percencardiac=$sumcardiac*100/$numchkup;
$percenspine=$sumspine*100/$numchkup;
$percendermatitis=$sumdermatitis*100/$numchkup;
$percendegeneration=$sumdegeneration*100/$numchkup;
$percenalcoholic=$sumalcoholic*100/$numchkup;
$percencopd=$sumcopd*100/$numchkup;
$percenbph=$sumbph*100/$numchkup;
$percenkidney=$sumkidney*100/$numchkup;
$percenpterygium=$sumpterygium*100/$numchkup;
$percentonsil=$sumtonsil*100/$numchkup;
$percenparalysis=$sumparalysis*100/$numchkup;
$percenblood=$sumblood*100/$numchkup;
$percenconanemia=$sumconanemia*100/$numchkup;
$percenht=$sumht*100/$numchkup;
$percendm=$sumdm*100/$numchkup;
$percenchol=$sumchol*100/$numchkup;
$percentrig=$sumtrig*100/$numchkup;
$percenhdl=$sumhdl*100/$numchkup;
$percenldl=$sumldl*100/$numchkup;
$percencholtrig=$sumcholtrig*100/$numchkup;
$percensgot=$sumsgot*100/$numchkup;
$percensgpt=$sumsgpt*100/$numchkup;
$percensgotsgpt=$sumsgotsgpt*100/$numchkup;
?>
<!--��§ҹẺ��� 2-->
<strong>
<p align="center">Ẻ��§ҹ��ػ�š�õ�Ǩ��ҧ��� ��Шӻ� <?=$showyear;?><br>
(��Ѻ��Ѻ��ا��������ش)
</p>

<p align="center">þ. ���ӡ�õ�Ǩ <?=$pcuname;?><br>
���˹��·�����Ѻ��õ�Ǩ <?=$showcamp;?>
</p>
</strong>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2">1. ���ѧ�Ţͧ˹��·�����</td>
    <td align="right"><?=$numtotal;?> </td>
    <td colspan="2">&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td colspan="2">2. �ӹǹ������Ѻ��õ�Ǩ</td>
    <td width="26%" align="right"><?=$numchkup;?></td>
    <td colspan="2">&nbsp;&nbsp;��� ����</td>
  </tr>
  <tr>
    <td width="5%">&nbsp;</td>
    <td width="45%" align="left">2.1 ��·����ѭ�Һѵ�</td>
    <td align="right"><?=$numchunyot1;?></td>
    <td colspan="2">&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">2.2 ��·��ê�鹻�зǹ</td>
    <td align="right"><?=$numchunyot2;?></td>
    <td colspan="2">&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">2.3 �١��ҧ��Ш�</td>
    <td align="right"><?=$numchunyot3;?></td>
    <td colspan="2">&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td colspan="2">3. �Ѫ����š��</td>
    <td align="right">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">3.1 Under weight (���¡��� 18.5)</td>
    <td align="right">&nbsp;</td>
    <td width="8%" align="right"><?=$numweight1;?></td>
    <td width="16%">&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">3.2 Normal weight (18.5-22.9)</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$numweight2;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">3.3 Over weight (23.0-24.9)</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$numweight3;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">3.4 Obesity �дѺ 1 (25.0-29.9)</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$numweight4;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">3.5 Obesity �дѺ 2 (�ҡ����������ҡѺ 30)</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$numweight5;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td colspan="2">4. ������Ѻ��õ�Ǩ�������������Թ 35 �� ��Ժ�ó�</td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong><?=$numage34;?></strong></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">4.1 BP (��һ��� 140/90 mm/Hg)</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">BP �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age34bp;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">4.2 Chest X-ray �Դ����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age34xray;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">4.3 Uric Examination �Դ����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?="-";?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">4.4 Hct (��һ��� ��� = 40-54, ˭ԧ = 36-47)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">HCT �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age34hct;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">4.5 �ä����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?="-";?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">�к�</div></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">5. ������Ѻ��õ�Ǩ����������ҡ���� 35 �� ��Ժ�ó����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><strong>
      <?=$numage35;?>
    </strong></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.1 BP (��һ��� 140/90 mm/Hg)</td>
    <td align="right">&nbsp;</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">BP �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35bp;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.2 Chest X-ray �Դ����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35xray;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.3 Uric Examination �Դ����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?="-";?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.4 Hct (��һ��� ��� = 40-54, ˭ԧ = 36-47)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">HCT �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35hct;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.5 Glocose (��һ��� 68-110)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">Glocose �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35glu;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.6 Cholesterol (��һ��� 120-200)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">Cholesterol �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35chol;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.7 Triglycerides (��һ��� 50-160)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">Triglycerides �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35trig;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.8 HDL-C (��һ��� �ҡ���� 55)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">HDL-C �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35hdl;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.9 LDL-C (��һ��� ���¡��� 130)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:25px;">LDL-C �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35ldl;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.10 BUN (��һ��� 6-20)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">BUN �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35bun;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.11 Creatinine (��һ��� 0.67-1.17)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">Creatinine �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35crea;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.12 SGOT (��һ��� 0-37)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">SGOT �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35sgot;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.13 SGPT (��һ��� 0-41)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">SGPT �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35sgpt;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.14 ALK Phoshatase (��һ��� 40-129)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">ALK Phoshatase �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35alk;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.15 Uric acid (��һ��� 2.47-8.40)</td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">Uric acid �Դ����</div></td>
    <td align="right">&nbsp;</td>
    <td align="right"><?=$age35uric;?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left">5.16 �ä����</td>
    <td align="right">&nbsp;</td>
    <td align="right"><?="-";?></td>
    <td>&nbsp;&nbsp;���</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td align="left"><div style="margin-left:35px;">�к�</div></td>
    <td align="right">&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
</table>
<p><strong>�ӹǹ����Ѻ��õ�Ǩ��ҧ��·�辺�����Դ��������</strong></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="5%" rowspan="3" align="center"><strong>�ӴѺ</strong></td>
    <td width="43%" rowspan="3" align="center"><strong>þ.��.</strong></td>
    <td colspan="4" align="center"><strong>�ӹǹ����Ѻ��õ�Ǩ��ҧ��·�辺�ä���� (���)</strong></td>
  </tr>
  <tr>
    <td width="12%" rowspan="2" align="center"><strong>��������Թ<br>
35 �պ�Ժ�ó�</strong></td>
    <td width="12%" rowspan="2" align="center"><strong>�����ҡ����<br>
    35 �պ�Ժ�ó�</strong></td>
    <td colspan="2" align="center"><strong>�ӹǹ������</strong></td>
  </tr>
  <tr>
    <td width="14%" align="center"><strong>�ӹǹ<br>
      ���</strong></td>
    <td width="14%" align="center"><strong>������</strong></td>
  </tr>
  
  <tr>
    <td align="center">1</td>
    <td align="left">�����ѹ���Ե�٧ (HT)<br>
      (BP &gt; 140/90 mm/Hg)</td>
    <td align="center"><?=$age34ht;?></td>
    <td align="center"><?=$age35ht;?></td>
    <td align="center"><?=$sumht;?></td>
    <td align="center"><?=number_format($percenht,2);?></td>
  </tr>
  <tr>
    <td align="center">2</td>
    <td align="left">����ҹ (DM)<br>
      (FBS &gt; 126 mg%)</td>
    <td align="center"><?=$age34dm;?></td>
    <td align="center"><?=$age35dm;?></td>
    <td align="center"><?=$sumdm;?></td>
    <td align="center"><?=number_format($percendm,2);?></td>
  </tr>
  <tr>
    <td align="center">3</td>
    <td align="left">��ѹ����ʹ�٧<br>
      3.1 Chol &gt; 240</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35chol;?></td>
    <td align="center" valign="bottom"><?=$sumchol;?></td>
    <td align="center" valign="bottom"><?=number_format($percenchol,2);?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left">3.2 TG &gt; 200</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35trig;?></td>
    <td align="center"><?=$sumtrig;?></td>
    <td align="center"><?=number_format($percentrig,2);?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left">3.3 Chol &gt; 240 ��� TG &gt; 200</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35choltrig;?></td>
    <td align="center"><?=$sumcholtrig;?></td>
    <td align="center"><?=number_format($percencholtrig,2);?></td>
  </tr>
  <tr>
    <td align="center">4</td>
    <td align="left">���Ե�ҧ (Anemia)</td>
    <td align="center"><?=$age34anemia;?></td>
    <td align="center"><?=$age35anemia;?></td>
    <td align="center"><?=$sumanemia;?></td>
    <td align="center"><?=number_format($percenanemia,2);?></td>
  </tr>
  <tr>
    <td align="center">5</td>
    <td align="left">�Ѻ�� (Cirrhosis)</td>
    <td align="center"><?=$age34cirrhosis;?></td>
    <td align="center"><?=$age35cirrhosis;?></td>
    <td align="center"><?=$sumcirrhosis;?></td>
    <td align="center"><?=number_format($percencirrhosis,2);?></td>
  </tr>
  <tr>
    <td align="center">6</td>
    <td align="left">�ä�Ѻ�ѡ�ʺ (Hepatitis)</td>
    <td align="center"><?=$age34hepatitis;?></td>
    <td align="center"><?=$age35hepatitis;?></td>
    <td align="center"><?=$sumhepatitis;?></td>
    <td align="center"><?=number_format($percenhepatitis,2);?></td>
  </tr>
  <tr>
    <td align="center">7</td>
    <td align="left">��÷ӧҹ�ͧ�Ѻ�Դ����<br>
      7.1 SGOT &gt; 80 u/l</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35sgot;?></td>
    <td align="center" valign="bottom"><?=$sumsgot;?></td>
    <td align="center" valign="bottom"><?=number_format($percensgot,2);?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left">7.2 SGPT &gt; 80 u/l</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35sgpt;?></td>
    <td align="center"><?=$sumsgpt;?></td>
    <td align="center"><?=number_format($percensgpt,2);?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="left">7.3 SGOT &gt; 80 u/l ��� SGPT &gt; 80 u/l</td>
    <td align="center" valign="bottom"><?="-";?></td>
    <td align="center" valign="bottom"><?=$age35sgotsgpt;?></td>
    <td align="center"><?=$sumsgotsgpt;?></td>
    <td align="center"><?=number_format($percensgotsgpt,2);?></td>
  </tr>
  <tr>
    <td align="center">8</td>
    <td align="left">�����</td>
    <td align="center"><?=$age34cardiomegaly;?></td>
    <td align="center"><?=$age35cardiomegaly;?></td>
    <td align="center"><?=$sumcardiomegaly;?></td>
    <td align="center"><?=number_format($percencardiomegaly,2);?></td>
  </tr>
  <tr>
    <td align="center">9</td>
    <td align="left">������</td>
    <td align="center"><?=$age34allergy;?></td>
    <td align="center"><?=$age35allergy;?></td>
    <td align="center"><?=$sumallergy;?></td>
    <td align="center"><?=number_format($percenallergy,2);?></td>
  </tr>
  <tr>
    <td align="center">10</td>
    <td align="left">�ä��ҷ� (Gout)</td>
    <td align="center"><?=$age34gout;?></td>
    <td align="center"><?=$age35gout;?></td>
    <td align="center"><?=$sumgout;?></td>
    <td align="center"><?=number_format($percengout,2);?></td>
  </tr>
  <tr>
    <td align="center">11</td>
    <td align="left">���˹ѡ�Թ (BMI 25.1-29.9)</td>
    <td align="center"><?=$age34bmi1;?></td>
    <td align="center"><?=$age35bmi1;?></td>
    <td align="center"><?=$sumbmi1;?></td>
    <td align="center"><?=number_format($percenbmi1,2);?></td>
  </tr>
  <tr>
    <td align="center">12</td>
    <td align="left">�ä��ǹ (Obesity) (BMI &gt; 30)</td>
    <td align="center"><?=$age34bmi2;?></td>
    <td align="center"><?=$age35bmi2;?></td>
    <td align="center"><?=$sumbmi2;?></td>
    <td align="center"><?=number_format($percenbmi2,2);?></td>
  </tr>
  <tr>
    <td align="center">13</td>
    <td align="left">�ͺ����Թ<br>
      (��� &gt; 90 �.�. , ˭ԧ &gt; 80 �.�.)</td>
    <td align="center" valign="bottom"><?=$age34waistline;?></td>
    <td align="center" valign="bottom"><?=$age35waistline;?></td>
    <td align="center" valign="bottom"><?=$sumwaistline;?></td>
    <td align="center" valign="bottom"><?=number_format($percenwaistline,2);?></td>
  </tr>
  <tr>
    <td align="center">14</td>
    <td align="left">�ͺ�״ (Asthma)</td>
    <td align="center"><?=$age34asthma;?></td>
    <td align="center"><?=$age35asthma;?></td>
    <td align="center"><?=$sumasthma;?></td>
    <td align="center"><?=number_format($percenasthma,2);?></td>
  </tr>
  <tr>
    <td align="center">15</td>
    <td align="left">����������ѡ�ʺ</td>
    <td align="center"><?=$age34muscle;?></td>
    <td align="center"><?=$age35muscle;?></td>
    <td align="center"><?=$summuscle;?></td>
    <td align="center"><?=number_format($percenmuscle,2);?></td>
  </tr>
  <tr>
    <td align="center">16</td>
    <td align="left">�ä���㨢Ҵ���ʹ������ѧ</td>
    <td align="center"><?=$age34ihd;?></td>
    <td align="center"><?=$age35ihd;?></td>
    <td align="center"><?=$sumihd;?></td>
    <td align="center"><?=number_format($percenihd,2);?></td>
  </tr>
  <tr>
    <td align="center">17</td>
    <td align="left">���´�</td>
    <td align="center"><?=$age34thyroid;?></td>
    <td align="center"><?=$age35thyroid;?></td>
    <td align="center"><?=$sumthyroid;?></td>
    <td align="center"><?=number_format($percenthyroid,2);?></td>
  </tr>
  <tr>
    <td align="center">18</td>
    <td align="left">�ä����</td>
    <td align="center"><?=$age34heart;?></td>
    <td align="center"><?=$age35heart;?></td>
    <td align="center"><?=$sumheart;?></td>
    <td align="center"><?=number_format($percenheart,2);?></td>
  </tr>
  <tr>
    <td align="center">19</td>
    <td align="left">�ا���觾ͧ</td>
    <td align="center"><?=$age34emphysema;?></td>
    <td align="center"><?=$age35emphysema;?></td>
    <td align="center"><?=$sumemphysema;?></td>
    <td align="center"><?=number_format($percenemphysema,2);?></td>
  </tr>
  <tr>
    <td align="center">20</td>
    <td align="left">��͹�ͧ��д١�Ѻ��鹻���ҷ</td>
    <td align="center"><?=$age34herniated;?></td>
    <td align="center"><?=$age35herniated;?></td>
    <td align="center"><?=$sumherniated;?></td>
    <td align="center"><?=number_format($percenherniated,2);?></td>
  </tr>
  <tr>
    <td align="center">21</td>
    <td align="left">����ͺص��ѡ�ʺ (Conjunctivitis)</td>
    <td align="center"><?=$age34conjunctivitis;?></td>
    <td align="center"><?=$age35conjunctivitis;?></td>
    <td align="center"><?=$sumconjunctivitis;?></td>
    <td align="center"><?=number_format($percenconjunctivitis,2);?></td>
  </tr>
  <tr>
    <td align="center">22</td>
    <td align="left">�����л�������ѡ�ʺ (Cystitis)</td>
    <td align="center"><?=$age34cystitis;?></td>
    <td align="center"><?=$age35cystitis;?></td>
    <td align="center"><?=$sumcystitis;?></td>
    <td align="center"><?=number_format($percencystitis,2);?></td>
  </tr>
  <tr>
    <td align="center">23</td>
    <td align="left">�纻��¨ҡ�غѵ��˵� (�кء���Դ)</td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
  </tr>
  <tr>
    <td align="center">24</td>
    <td align="left">���ѡ (Epilepsy)</td>
    <td align="center"><?=$age34epilepsy;?></td>
    <td align="center"><?=$age35epilepsy;?></td>
    <td align="center"><?=$sumepilepsy;?></td>
    <td align="center"><?=number_format($percenepilepsy,2);?></td>
  </tr>
  <tr>
    <td align="center">25</td>
    <td align="left">��д١�ѡ����͹</td>
    <td align="center"><?=$age34fracture;?></td>
    <td align="center"><?=$age35fracture;?></td>
    <td align="center"><?=$sumfracture;?></td>
    <td align="center"><?=number_format($percenfracture,2);?></td>
  </tr>
  <tr>
    <td align="center">26</td>
    <td align="left">�����鹼Դ�ѧ��� (Cardiac arrhythmia)</td>
    <td align="center"><?=$age34cardiac;?></td>
    <td align="center"><?=$age35cardiac;?></td>
    <td align="center"><?=$sumcardiac;?></td>
    <td align="center"><?=number_format($percencardiac,2);?></td>
  </tr>
  <tr>
    <td align="center">27</td>
    <td align="left">��д١�ѹ��ѧ (͡) ��</td>
    <td align="center"><?=$age34spine;?></td>
    <td align="center"><?=$age35spine;?></td>
    <td align="center"><?=$sumspine;?></td>
    <td align="center"><?=number_format($percenspine,2);?></td>
  </tr>
  <tr>
    <td align="center">28</td>
    <td align="left">���˹ѧ�ѡ�ʺ</td>
    <td align="center"><?=$age34dermatitis;?></td>
    <td align="center"><?=$age35dermatitis;?></td>
    <td align="center"><?=$sumdermatitis;?></td>
    <td align="center"><?=number_format($percendermatitis,2);?></td>
  </tr>
  <tr>
    <td align="center">29</td>
    <td align="left">������������</td>
    <td align="center"><?=$age34degeneration;?></td>
    <td align="center"><?=$age35degeneration;?></td>
    <td align="center"><?=$sumdegeneration;?></td>
    <td align="center"><?=number_format($percendegeneration,2);?></td>
  </tr>
  <tr>
    <td align="center">30</td>
    <td align="left">�����Դ���Ԩҡ��š����� (Alcoholic)</td>
    <td align="center"><?=$age34alcoholic;?></td>
    <td align="center"><?=$age35alcoholic;?></td>
    <td align="center"><?=$sumalcoholic;?></td>
    <td align="center"><?=number_format($percenalcoholic,2);?></td>
  </tr>
  <tr>
    <td align="center">31</td>
    <td align="left">COPD</td>
    <td align="center"><?=$age34copd;?></td>
    <td align="center"><?=$age35copd;?></td>
    <td align="center"><?=$sumcopd;?></td>
    <td align="center"><?=number_format($percencopd,2);?></td>
  </tr>
  <tr>
    <td align="center">32</td>
    <td align="left">BPH</td>
    <td align="center"><?=$age34bph;?></td>
    <td align="center"><?=$age35bph;?></td>
    <td align="center"><?=$sumbph;?></td>
    <td align="center"><?=number_format($percenbph,2);?></td>
  </tr>
  <tr>
    <td align="center">33</td>
    <td align="left">䵼Դ����</td>
    <td align="center"><?=$age34kidney;?></td>
    <td align="center"><?=$age35kidney;?></td>
    <td align="center"><?=$sumkidney;?></td>
    <td align="center"><?=number_format($percenkidney,2);?></td>
  </tr>
  <tr>
    <td align="center">34</td>
    <td align="left">�������</td>
    <td align="center"><?=$age34pterygium;?></td>
    <td align="center"><?=$age35pterygium;?></td>
    <td align="center"><?=$sumpterygium;?></td>
    <td align="center"><?=number_format($percenpterygium,2);?></td>
  </tr>
  <tr>
    <td align="center">35</td>
    <td align="left">�����͹����</td>
    <td align="center"><?=$age34tonsil;?></td>
    <td align="center"><?=$age35tonsil;?></td>
    <td align="center"><?=$sumtonsil;?></td>
    <td align="center"><?=number_format($percentonsil,2);?></td>
  </tr>
  <tr>
    <td align="center">36</td>
    <td align="left">����ҵ�ա����/���</td>
    <td align="center"><?=$age34paralysis;?></td>
    <td align="center"><?=$age35paralysis;?></td>
    <td align="center"><?=$sumparalysis;?></td>
    <td align="center"><?=number_format($percenparalysis,2);?></td>
  </tr>
  <tr>
    <td align="center">37</td>
    <td align="left">������ʹ�Դ����</td>
    <td align="center"><?=$age34blood;?></td>
    <td align="center"><?=$age35blood;?></td>
    <td align="center"><?=$sumblood;?></td>
    <td align="center"><?=number_format($percenblood,2);?></td>
  </tr>
  <tr>
    <td align="center">38</td>
    <td align="left">���Ыմ</td>
    <td align="center"><?=$age34conanemia;?></td>
    <td align="center"><?=$age35conanemia;?></td>
    <td align="center"><?=$sumconanemia;?></td>
    <td align="center"><?=number_format($percenconanemia,2);?></td>
  </tr>
  <tr>
    <td align="center">39</td>
    <td align="left">�ä���� (�ô�к�)</td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
    <td align="center"><?="-";?></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
    <td align="center"><strong>���������</strong></td>
    <td align="center"><strong>
      <?=$totalage34;?>
    </strong></td>
    <td align="center"><strong>
      <?=$totalage35;?>
    </strong></td>
    <td align="center"><strong>
      <?=$totalage;?>
    </strong></td>
    <td align="center"><strong>
      <?="-";?>
    </strong></td>
  </tr>
</table>

<p><strong>�ĵԡ�����ô��Թ���Ե�ͧ���ѧ�� ��. ��������Դ��������§����ä<br>
˹��·�����Ѻ��õ�Ǩ 
  <?=$showcamp;?>
</strong></p>
<table width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="27%" align="center"><strong>����������ǡѺ�ĵԡ���<br>
    ��ô��Թ���Ե</strong></td>
    <td width="17%" align="center"><strong>��·���<br>
    �ѭ�Һѵ� (���)</strong></td>
    <td width="17%" align="center"><strong>��·���<br>
    ��鹻�зǹ (���)</strong></td>
    <td width="17%" align="center"><strong>�١��ҧ��Ш�<br>
    (���)</strong></td>
    <td width="17%" align="center"><strong>���<br>
    (���)</strong></td>
  </tr>
  <tr>
    <td><strong>����ٺ������</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">������ٺ</div></td>
    <td align="center"><?=$ch1cigarette0;?></td>
    <td align="center"><?=$ch2cigarette0;?></td>
    <td align="center"><?=$ch3cigarette0;?></td>
    <td align="center"><?=$sumcigarette0;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">���ٺ����ԡ����</div></td>
    <td align="center"><?=$ch1cigarette1;?></td>
    <td align="center"><?=$ch2cigarette1;?></td>
    <td align="center"><?=$ch3cigarette1;?></td>
    <td align="center"><?=$sumcigarette1;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">�ѧ�ٺ����</div></td>
    <td align="center"><?=$ch1cigarette2;?></td>
    <td align="center"><?=$ch2cigarette2;?></td>
    <td align="center"><?=$ch3cigarette2;?></td>
    <td align="center"><?=$sumcigarette2;?></td>
  </tr>
  <tr>
    <td><strong>��ô�������ͧ������š�����</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">����´���</div></td>
    <td align="center"><?=$ch1alcohol0;?></td>
    <td align="center"><?=$ch2alcohol0;?></td>
    <td align="center"><?=$ch3alcohol0;?></td>
    <td align="center"><?=$sumalcohol0;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">���ٺ����ԡ����</div></td>
    <td align="center"><?=$ch1alcohol1;?></td>
    <td align="center"><?=$ch2alcohol1;?></td>
    <td align="center"><?=$ch3alcohol1;?></td>
    <td align="center"><?=$sumalcohol1;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">�����繻�Ш�</div></td>
    <td align="center"><?=$ch1alcohol2;?></td>
    <td align="center"><?=$ch2alcohol2;?></td>
    <td align="center"><?=$ch3alcohol2;?></td>
    <td align="center"><?=$sumalcohol2;?></td>
  </tr>
  <tr>
    <td><strong>����͡���ѧ���<br>
    (ࡳ�� 3 ����/�ѻ����)</strong></td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">����͡���ѧ���</div></td>
    <td align="center"><?=$ch1exercise0;?></td>
    <td align="center"><?=$ch2exercise0;?></td>
    <td align="center"><?=$ch3exercise0;?></td>
    <td align="center"><?=$sumexercise0;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">�͡���ѧ������֧ࡳ��</div></td>
    <td align="center"><?=$ch1exercise1;?></td>
    <td align="center"><?=$ch2exercise1;?></td>
    <td align="center"><?=$ch3exercise1;?></td>
    <td align="center"><?=$sumexercise1;?></td>
  </tr>
  <tr>
    <td><div style="margin-left:25px;">�͡���ѧ��µ��ࡳ��</div></td>
    <td align="center"><?=$ch1exercise2;?></td>
    <td align="center"><?=$ch2exercise2;?></td>
    <td align="center"><?=$ch3exercise2;?></td>
    <td align="center"><?=$sumexercise2;?></td>
  </tr>
</table>


<!--����ش��§ҹẺ��� 2-->
<?
}
?>
