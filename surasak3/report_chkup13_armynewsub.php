<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<? 
include("connect.inc");
////*runno ��Ǩ�آ�Ҿ*/////////
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
	$nPrefix2="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////
?>
<a href ="../nindex.htm" >&lt;&lt; �����</a>
<p align="center" style="font-weight:bold;">��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. (�ʵ.13) ��Шӻ� 
  <?=$nPrefix2;?> (����)
</p>
<div align="center"><a href ="report_chkup13_armynew.php">��§ҹ���������</a> || <strong>��§ҹ������˭�</strong></div>

<form name="form1" method="post" action="<?=$PHP_SELF;?>" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>�ء˹���</option>
          <option value="þ.��������ѡ��������">þ.��������ѡ��������</option>
          <option value="���.32">���.32</option>
          <option value="����.�þ.3">����.�þ.3</option>
          <option value="�.17 �ѹ.2">�.17 �ѹ.2</option>
          <option value="�.�ѹ.4 ����4">�.�ѹ.4 ����4</option>
          <option value="ʧ.ʴ.��.�.�.">ʧ.ʴ.��.�.�.</option>
          <option value="���.33">���.33</option>
        </select>
        <input type="submit" name="button" id="button" value="����§ҹ">
        </label></td>
    </tr>
  </table>
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){
$sql1="SELECT *
FROM `armychkup`
WHERE `yearchkup` = '$nPrefix'  and (camp !='D33 ˹��·�������' and camp !='')  order by chunyot asc, age desc";
}else{
$sql1="SELECT *
FROM `armychkup`
WHERE `camp` like '%$_POST[camp]%' AND `yearchkup` = '$nPrefix' and camp !='' order by chunyot asc, age desc";
}
$query1=mysql_query($sql1)or die ("Query armychkup Error");
//echo $sql1;

$age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$age34mp=0;  //��зǹ ��������Թ 35 ���
$age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$age34ml=0;  //�١��ҧ ��������Թ 35 ���
$age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$age35mp=0;  //��зǹ �����Թ 35 ���
$age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$age35ml=0;  //�١��ҧ �����Թ 35 ���
$age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$totalage34m=0;
$totalage34f=0;
$totalage34=0;

$totalage35m=0;
$totalage35f=0;
$totalage35=0;

$totalage34s=0;
$totalage34p=0;
$totalage34l=0;

$totalage35s=0;
$totalage35p=0;
$totalage35l=0;

$bmi1age34m=0;
$bmi2age34m=0;
$bmi3age34m=0;
$bmi4age34m=0;
$bmi5age34m=0;

$bmi1age35m=0;
$bmi2age35m=0;
$bmi3age35m=0;
$bmi4age35m=0;
$bmi5age35m=0;

$bmi1age34f=0;
$bmi2age34f=0;
$bmi3age34f=0;
$bmi4age34f=0;
$bmi5age34f=0;

$bmi1age35f=0;
$bmi2age35f=0;
$bmi3age35f=0;
$bmi4age35f=0;
$bmi5age35f=0;

$totalbmi1age34=0;
$totalbmi2age34=0;
$totalbmi3age34=0;
$totalbmi4age34=0;
$totalbmi5age34=0;

$totalbmi1age35=0;
$totalbmi2age35=0;
$totalbmi3age35=0;
$totalbmi4age35=0;
$totalbmi5age35=0;

$totalbmi1=0;
$totalbmi2=0;
$totalbmi3=0;
$totalbmi4=0;
$totalbmi5=0;

$ht1age34m=0;
$ht2age34m=0;
$ht3age34m=0;

$ht1age35m=0;
$ht2age35m=0;
$ht3age35m=0;

$ht1age34f=0;
$ht2age34f=0;
$ht3age34f=0;

$ht1age35f=0;
$ht2age35f=0;
$ht3age35f=0;

$xrayage34m=0;
$xrayage34f=0;
$totalxrayage34=0;
$xrayage35m=0;
$xrayage35f=0;
$totalxrayage35=0;

$uaage34m=0;
$uaage34f=0;
$totaluaage34=0;
$uaage35m=0;
$uaage35f=0;
$totaluaage35=0;

$bsage35m=0;
$bsage35f=0;
$totalbsage35=0;

$cholage35m=0;
$cholage35f=0;
$totalcholage35=0;

$tgage35m=0;
$tgage35f=0;
$totaltgage35=0;

$bloodage35m=0;
$bloodage35f=0;
$totalbloodage35=0;

$prawat0age34m=0;
$prawat0age34f=0;
$totalprawat0age34=0;
$prawat0age35m=0;
$prawat0age35f=0;
$totalprawat0age35=0;

$prawat1age34m=0;
$prawat1age34f=0;
$totalprawat1age34=0;
$prawat1age35m=0;
$prawat1age35f=0;
$totalprawat1age35=0;

$prawat2age34m=0;
$prawat2age34f=0;
$totalprawat2age34=0;
$prawat2age35m=0;
$prawat2age35f=0;
$totalprawat2age35=0;

$prawat3age34m=0;
$prawat3age34f=0;
$totalprawat3age34=0;
$prawat3age35m=0;
$prawat3age35f=0;
$totalprawat3age35=0;

$prawat4age34m=0;
$prawat4age34f=0;
$totalprawat4age34=0;
$prawat4age35m=0;
$prawat4age35f=0;
$totalprawat4age35=0;

$prawat5age34m=0;
$prawat5age34f=0;
$totalprawat5age34=0;
$prawat5age35m=0;
$prawat5age35f=0;
$totalprawat5age35=0;

$prawat6age34m=0;
$prawat6age34f=0;
$totalprawat6age34=0;
$prawat6age35m=0;
$prawat6age35f=0;
$totalprawat6age35=0;


$totalht1age34=0;
$totalht2age34=0;
$totalht3age34=0;

$totalht1age35=0;
$totalht2age35=0;
$totalht3age35=0;


$totalht1=0;
$totalht2=0;
$totalht3=0;

$total=0;
$totals=0;
$totalp=0;
$totall=0;
while($rows=mysql_fetch_array($query1)){
$total++;	
$chunyot=substr($rows["chunyot"],0,4);
$gender=$rows["gender"];
//echo "==>".$gender."<br>";	

if($rows["age"] < 35){
	$totalage34++;
	if($chunyot =="CH01"){
		$totals++;
		$totalage34s++;
	}else if($chunyot =="CH02"){
		$totalp++;
		$totalage34p++;
	}else if($chunyot =="CH04"){
		$totall++;
		$totalage34l++;
	}
	
	
}else if($rows["age"] >= 35){  //�����ҡ���� 35
	$totalage35++;
	if($chunyot =="CH01"){
		$totals++;
		$totalage35s++;
	}else if($chunyot =="CH02"){
		$totalp++;
		$totalage35p++;
	}else if($chunyot =="CH04"){
		$totall++;
		$totalage35l++;
	}
}else{
	$totalage34++;	
	if($chunyot =="CH01"){
		$totalage34s++;
	}else if($chunyot =="CH02"){
		$totalage34p++;
	}else if($chunyot =="CH04"){
		$totalage34l++;
	}	
}

// �Ѻ���������µ������Ъ�ǧ����
if($gender==1){  //�Ȫ��
$totalm++;
	if($rows["age"] < 35){  //�Ȫ�� ���ع��¡��� 35
		$totalage34m++;
		//�����
		if($chunyot =="CH01"){
			$age34ms++;	
		}else if($chunyot =="CH02"){
			$age34mp++;
		}else if($chunyot =="CH04"){
			$age34ml++;
		}
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age34m++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age34m++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age34m++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age34m++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age34m++;	
		}
		
		//ht
		$bp=substr($rows["bp1"],0,3);
		if($bp >= 140){
			$bp11=substr($rows["bp2"],0,3);  //�� bp2 ᷹
			$bp12=substr($rows["bp2"],4,2);
		}else if($bp < 140){
			$bp11=substr($rows["bp1"],0,3);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],4,2);		
		}else{
			$bp11=substr($rows["bp1"],0,2);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],3,2);		
		}
		
		if($bp11 >= 140 && $bp12 < 90){
			$ht1age34m++;	
		}else if($bp11 < 140 && $bp12 > 90){
			$ht2age34m++;	
		}else if($bp11 >=140 && $bp12 > 90){
			$ht3age34m++;	
		}
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage34m++;
		}	
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage34m++;
		}	
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age34m++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age34m++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age34m++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age34m++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age34m++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age34m++;
		}											
							
		
	}else if($rows["age"] >= 35){  //�Ȫ�� �����ҡ���� 35
		$totalage35m++;
		
		//�����
		if($chunyot =="CH01"){
			$age35ms++;	
		}else if($chunyot =="CH02"){
			$age35mp++;
		}else if($chunyot =="CH04"){
			$age35ml++;
		}	
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age35m++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age35m++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age35m++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age35m++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age35m++;	
		}
		
		//ht
		if($rows["bp1"] > 140 && $rows["bp2"] < 90){
			$ht1age35m++;	
		}else if($rows["bp1"] < 140 && $rows["bp2"] > 90){
			$ht2age35m++;	
		}else if($rows["bp1"] >140 && $rows["bmi"] > 90){
			$ht3age35m++;	
		}
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage35m++;
		}	
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage35m++;
		}
		
		//bs �Դ����
		if($rows["glu_lab"]=="�Դ����"){
			$bsage35m++;
		}
		
		//��ѹ����ʹ
		if($rows["chol_result"] > 240 && $rows["trig_result"] < 200){
			$cholage35m++;	
		}else if($rows["chol_result"] < 240 && $rows["trig_result"] > 200){
			$tgage35m++;	
		}else if($rows["chol_result"] > 240 && $rows["trig_result"] > 200){
			$bloodage35m++;	
		}	
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age35m++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age35m++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age35m++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age35m++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age35m++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age35m++;
		}											
					
	}
}else if($gender==2){  //��˭ԧ
$totalf++;
	if($rows["age"] < 35){  //��˭ԧ ���ع��¡��� 35
		$totalage34f++;
		
		//�����
		if($chunyot =="CH01"){
			$age34fs++;	
		}else if($chunyot =="CH02"){
			$age34fp++;
		}else if($chunyot =="CH04"){
			$age34fl++;
		}
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age34f++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age34f++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age34f++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age34f++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age34f++;	
		}
		
		//ht
		$bp=substr($rows["bp1"],0,3);
		if($bp >= 140){
			$bp11=substr($rows["bp2"],0,3);  //�� bp2 ᷹
			$bp12=substr($rows["bp2"],4,2);
		}else if($bp < 140){
			$bp11=substr($rows["bp1"],0,3);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],4,2);		
		}else{
			$bp11=substr($rows["bp1"],0,2);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],3,2);		
		}
		
		if(bp11 >= 140 && $bp12 < 90){
			$ht1age34f++;	
		}else if(bp11 < 140 && $bp12 > 90){
			$ht2age34f++;	
		}else if(bp11 >= 140 && $bp12 > 90){
			$ht3age34f++;	
		}	
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage34f++;
		}	
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage34f++;
		}	
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age34f++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age34f++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age34f++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age34f++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age34f++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age34f++;
		}			
									
					
	}else if($rows["age"] >= 35){  //��˭ԧ �����ҡ���� 35
		$totalage35f++;
		
		//�����
		if($chunyot =="CH01"){
			$age35fs++;	
		}else if($chunyot =="CH02"){
			$age35fp++;
		}else if($chunyot =="CH04"){
			$age35fl++;
		}
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age35f++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age35f++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age35f++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age35f++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age35f++;	
		}
		
		//ht
		$bp=substr($rows["bp1"],0,3);
		if($bp >= 140){
			$bp11=substr($rows["bp2"],0,3);  //�� bp2 ᷹
			$bp12=substr($rows["bp2"],4,2);
		}else if($bp < 140){
			$bp11=substr($rows["bp1"],0,3);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],4,2);		
		}else{
			$bp11=substr($rows["bp1"],0,2);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],3,2);		
		}
		
		if($bp11 >= 140 && $bp12 < 90){
			$ht1age35f++;	
		}else if($bp11 < 140 && $bp12 > 90){
			$ht2age35f++;	
		}else if($bp11 >= 140 && $bp12 > 90){
			$ht3age35f++;	
		}
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage35f++;
		}
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage35f++;
		}	
		
		//bs �Դ����
		if($rows["glu_lab"]=="�Դ����"){
			$bsage35f++;
		}	
		
		//��ѹ����ʹ
		if($rows["chol_result"] > 240 && $rows["trig_result"] < 200){
			$cholage35f++;	
		}else if($rows["chol_result"] < 240 && $rows["trig_result"] > 200){
			$tgage35f++;	
		}else if($rows["chol_result"] > 240 && $rows["trig_result"] > 200){
			$bloodage35f++;	
		}	
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age35f++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age35f++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age35f++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age35f++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age35f++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age35f++;
		}								
											
	}
}else{  //������ ����ҧ�ԧ���Ȫ������͹
$totalm++;
	if($rows["age"] < 35){  //�Ȫ�� ���ع��¡��� 35
		$totalage34m++;
		
		//�����
		if($chunyot =="CH01"){
			$age34ms++;	
		}else if($chunyot =="CH02"){
			$age34mp++;
		}else if($chunyot =="CH04"){
			$age34ml++;
		}	
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age34m++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age34m++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age34m++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age34m++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age34m++;	
		}	
		
		//ht
		$bp=substr($rows["bp1"],0,3);
		if($bp >= 140){
			$bp11=substr($rows["bp2"],0,3);  //�� bp2 ᷹
			$bp12=substr($rows["bp2"],4,2);
		}else if($bp < 140){
			$bp11=substr($rows["bp1"],0,3);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],4,2);		
		}else{
			$bp11=substr($rows["bp1"],0,2);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],3,2);		
		}
		
		if($bp11 >= 140 && $bp12 < 90){
			$ht1age34m++;	
		}else if($bp11 < 140 && $bp12 > 90){
			$ht2age34m++;	
		}else if($bp11 >= 140 && $bp12 > 90){
			$ht3age34m++;	
		}	
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage34m++;
		}
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage34m++;
		}	
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age34m++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age34m++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age34m++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age34m++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age34m++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age34m++;
		}				
							
	}else if($rows["age"] >= 35){  //�Ȫ�� �����ҡ���� 35
		$totalage35m++;
		
		//�����
		if($chunyot =="CH01"){
			$age35ms++;	
		}else if($chunyot =="CH02"){
			$age35mp++;
		}else if($chunyot =="CH04"){
			$age35ml++;
		}
		
		//bmi
		if($rows["bmi"] < 18.5){
			$bmi1age35m++;	
		}else if($rows["bmi"] >= 18.5 && $rows["bmi"] <= 22.9){
			$bmi2age35m++;	
		}else if($rows["bmi"] >= 23.0 && $rows["bmi"] <= 24.9){
			$bmi3age35m++;	
		}else if($rows["bmi"] >= 25.0 && $rows["bmi"] <= 29.9){
			$bmi4age35m++;	
		}else if($rows["bmi"] >= 30.0){
			$bmi5age35m++;	
		}
		
		//ht
		$bp=substr($rows["bp1"],0,3);
		if($bp >= 140){
			$bp11=substr($rows["bp2"],0,3);  //�� bp2 ᷹
			$bp12=substr($rows["bp2"],4,2);
		}else if($bp < 140){
			$bp11=substr($rows["bp1"],0,3);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],4,2);		
		}else{
			$bp11=substr($rows["bp1"],0,2);  //�� bp1 ᷹
			$bp12=substr($rows["bp1"],3,2);		
		}
		
		if($bp11 >= 140 && $bp12 < 90){
			$ht1age35m++;	
		}else if($bp11 < 140 && $bp12 > 90){
			$ht2age35m++;	
		}else if($bp11 >= 140 && $bp12 > 90){
			$ht3age35m++;	
		}	
		
		//xray �Դ����
		if($rows["xray"]=="�Դ����"){
			$xrayage35m++;
		}
		
		//ua �Դ����
		if($rows["ua_lab"]=="�Դ����"){
			$uaage35m++;
		}
		
		//bs �Դ����
		if($rows["glu_lab"]=="�Դ����"){
			$bsage35m++;
		}	
		
		//��ѹ����ʹ
		if($rows["chol_result"] > 240 && $rows["trig_result"] < 200){
			$cholage35m++;	
		}else if($rows["chol_result"] < 240 && $rows["trig_result"] > 200){
			$tgage35m++;	
		}else if($rows["chol_result"] > 240 && $rows["trig_result"] > 200){
			$bloodage35m++;	
		}		
		
		//prawat �Դ����
		if($rows["prawat"]=="1"){
			$prawat1age35m++;
		}else if($rows["prawat"]=="2"){		
			$prawat2age35m++;
		}else if($rows["prawat"]=="3"){		
			$prawat3age35m++;
		}else if($rows["prawat"]=="4"){		
			$prawat4age35m++;
		}else if($rows["prawat"]=="5"){		
			$prawat5age35m++;
		}else if($rows["prawat"]=="6"){		
			$prawat6age35m++;
		}							
										
	}
}  //close if ��
}  //close while

//��� bmi ���ع��¡��� 35
$totalbmi1age34=$bmi1age34m+$bmi1age34f;
$totalbmi2age34=$bmi2age34m+$bmi2age34f;
$totalbmi3age34=$bmi3age34m+$bmi3age34f;
$totalbmi4age34=$bmi4age34m+$bmi4age34f;
$totalbmi5age34=$bmi5age34m+$bmi5age34f;

//��� bmi �����ҡ���� 35
$totalbmi1age35=$bmi1age35m+$bmi1age35f;
$totalbmi2age35=$bmi2age35m+$bmi2age35f;
$totalbmi3age35=$bmi3age35m+$bmi3age35f;
$totalbmi4age35=$bmi4age35m+$bmi4age35f;
$totalbmi5age35=$bmi5age35m+$bmi5age35f;

//��� bmi 
$totalbmi1=$totalbmi1age34+$totalbmi1age35;
$totalbmi2=$totalbmi2age34+$totalbmi2age35;
$totalbmi3=$totalbmi3age34+$totalbmi3age35;
$totalbmi4=$totalbmi4age34+$totalbmi4age35;
$totalbmi5=$totalbmi5age34+$totalbmi5age35;

//��� ht ���ع��¡��� 35
$totalht1age34=$ht1age34m+$ht1age34f;
$totalht2age34=$ht2age34m+$ht2age34f;
$totalht3age34=$ht3age34m+$ht3age34f;

//��� ht �����ҡ���� 35
$totalht1age35=$ht1age35m+$ht1age35f;
$totalht2age35=$ht2age35m+$ht2age35f;
$totalht3age35=$ht3age35m+$ht3age35f;

//��� ht 
$totalht1=$totalht1age34+$totalht1age35;
$totalht2=$totalht2age34+$totalht2age35;
$totalht3=$totalht3age34+$totalht3age35;

//��� xray
$totalxrayage34=$xrayage34m+$xrayage34f;
$totalxrayage35=$xrayage35m+$xrayage35f;
$totalxray=$totalxrayage34+$totalxrayage35;

//��� ua
$totaluaage34=$uaage34m+$uaage34f;
$totaluaage35=$uaage35m+$uaage35f;
$totalua=$totaluaage34+$totaluaage35;

//��� bs
$totalbsage35=$bsage35m+$bsage35f;
$totalbs=$totalbsage34+$totalbsage35;

//��� chol
$totalcholage35=$cholage35m+$cholage35f;
$totalchol=$totalcholage34+$totalcholage35;

//��� tg
$totaltgage35=$tgage35m+$tgage35f;
$totaltg=$totaltgage34+$totaltgage35;

//�����ѹ����ʹ
$totalbloodage35=$bloodage35m+$bloodage35f;
$totalblood=$totalbloodage34+$totalbloodage35;

//��� prawat
$totalprawat0age34=$prawat0age34m+$prawat0age34f;
$totalprawat1age34=$prawat1age34m+$prawat1age34f;
$totalprawat2age34=$prawat2age34m+$prawat2age34f;
$totalprawat3age34=$prawat3age34m+$prawat3age34f;
$totalprawat4age34=$prawat4age34m+$prawat4age34f;
$totalprawat5age34=$prawat5age34m+$prawat5age34f;
$totalprawat6age34=$prawat6age34m+$prawat6age34f;

$totalprawat0age35=$prawat0age35m+$prawat0age35f;
$totalprawat1age35=$prawat1age35m+$prawat1age35f;
$totalprawat2age35=$prawat2age35m+$prawat2age35f;
$totalprawat3age35=$prawat3age35m+$prawat3age35f;
$totalprawat4age35=$prawat4age35m+$prawat4age35f;
$totalprawat5age35=$prawat5age35m+$prawat5age35f;
$totalprawat6age35=$prawat6age35m+$prawat6age35f;

$totalprawat0=$totalprawat0age34+$totalprawat0age35;
$totalprawat1=$totalprawat1age34+$totalprawat1age35;
$totalprawat2=$totalprawat2age34+$totalprawat2age35;
$totalprawat3=$totalprawat3age34+$totalprawat3age35;
$totalprawat4=$totalprawat4age34+$totalprawat4age35;
$totalprawat5=$totalprawat5age34+$totalprawat5age35;
$totalprawat6=$totalprawat6age34+$totalprawat6age35;

$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);

?>
<div align="center">
<div align="right">( Ẻ ç.�ʵ.13 )</div>
<h3 align="center"><strong>3. ��§ҹ��ػ�š�õ�Ǩ��ҧ��¢ͧ���ѧ�šͧ�Ѿ�� ��Шӻ�</strong> <?=$nPrefix2;?></h3>
<div align="left"><strong>˹������ᾷ����ӡ�õ�Ǩ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="left"><strong>˹��·��÷�����Ѻ��õ�Ǩ</strong> <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo $_POST["camp"];}?></div>
<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="pdxpro">
  <tr>
    <td rowspan="3" align="center" valign="middle"><strong>�ӴѺ</strong></td>
    <td rowspan="3" align="center" valign="middle"><strong>��¡��</strong></td>
    <td colspan="7" align="center"><strong>�ӹǹ���ѧ�šͧ�Ѿ�� (���)</strong></td>
    </tr>
  <tr>
    <td colspan="3" align="center"><strong>��������Թ 35 �պ�Ժ�ó�</strong></td>
    <td colspan="3" align="center"><strong>�����ҡ���� 35 �պ�Ժ�ó</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>���<br>
      (���)</strong></td>
  </tr>
  <tr>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>1</strong></td>
    <td><strong>�ӹǹ���ѧ�ŷ�����</strong></td>
    <td align="center"><? echo $totalage34m;?></td>
    <td align="center"><? echo $totalage34f;?></td>
    <td align="center"><strong><? echo $totalage34;?></strong></td>
    <td align="center"><? echo $totalage35m;?></td>
    <td align="center"><? echo $totalage35f;?></td>
    <td align="center"><strong><? echo $totalage35;?></strong></td>
    <td align="center"><strong><? echo $total;?></strong></td>
  </tr>
  <tr>
    <td align="center"><strong>2</strong></td>
    <td><strong>�ӹǹ���ѧ�ŷ�����Ѻ��õ�Ǩ</strong></td>
    <td align="center"><? echo $totalage34m;?></td>
    <td align="center"><? echo $totalage34f;?></td>
    <td align="center"><strong><? echo $totalage34;?></strong></td>
    <td align="center"><? echo $totalage35m;?></td>
    <td align="center"><? echo $totalage35f;?></td>
    <td align="center"><strong><? echo $totalage35;?></strong></td>
    <td align="center"><strong><? echo $total;?></strong></td>
    </tr>
  <tr>
    <td rowspan="4" align="center" valign="top"><strong>3</strong></td>
    <td><strong>�ӹǹ���ѧ�ŷ�����Ѻ��õ�Ǩ ��ṡ��������</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>3.1 ��·��ê���ѭ�Һѵ�</td>
    <td align="center"><? echo $age34ms;?></td>
    <td align="center"><? echo $age34fs;?></td>
    <td align="center"><strong><? echo $totalage34s;?></strong></td>
    <td align="center"><? echo $age35ms;?></td>
    <td align="center"><? echo $age35fs;?></td>
    <td align="center"><strong><? echo $totalage35s;?></strong></td>
    <td align="center"><strong><? echo $totals;?></strong></td>
  </tr>
  <tr>
    <td>3.2 ��·��ê�鹻�зǹ</td>
    <td align="center"><? echo $age34mp;?></td>
    <td align="center"><? echo $age34fp;?></td>
    <td align="center"><strong><? echo $totalage34p;?></strong></td>
    <td align="center"><? echo $age35mp;?></td>
    <td align="center"><? echo $age35fp;?></td>
    <td align="center"><strong><? echo $totalage35p;?></strong></td>
    <td align="center"><strong><? echo $totalp;?></strong></td>
  </tr>
  <tr>
    <td>3.3 �١��ҧ��Ш�</td>
    <td align="center"><? echo $age34ml;?></td>
    <td align="center"><? echo $age34fl;?></td>
    <td align="center"><strong><? echo $totalage34l;?></strong></td>
    <td align="center"><? echo $age35ml;?></td>
    <td align="center"><? echo $age35fl;?></td>
    <td align="center"><strong><? echo $totalage35l;?></strong></td>
    <td align="center"><strong><? echo $totall;?></strong></td>
  </tr>
  <tr>
    <td rowspan="6" align="center" valign="top"><strong>4</strong></td>
    <td><strong>�ӹǹ���ѧ�ŷ�����Ѻ��õ�Ǩ ��ṡ�����ҴѪ����š�� (BMI)</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>4.1 ���˹ѡ���¡��һ��� (BMI &lt; 18.5 kg/m2)</td>
    <td align="center"><? echo $bmi1age34m;?></td>
    <td align="center"><? echo $bmi1age34f;?></td>
    <td align="center"><strong><? echo $totalbmi1age34;?></strong></td>
    <td align="center"><? echo $bmi1age35m;?></td>
    <td align="center"><? echo $bmi1age35f;?></td>
    <td align="center"><strong><? echo $totalbmi1age35;?></strong></td>
    <td align="center"><strong><? echo $totalbmi1;?></strong></td>
  </tr>
  <tr>
    <td>4.2 ���˹ѡ���� (BMI = 18.5-22.9 kg/m2)</td>
    <td align="center"><? echo $bmi2age34m;?></td>
    <td align="center"><? echo $bmi2age34f;?></td>
    <td align="center"><strong><? echo $totalbmi2age34;?></strong></td>
    <td align="center"><? echo $bmi2age35m;?></td>
    <td align="center"><? echo $bmi2age35f;?></td>
    <td align="center"><strong><? echo $totalbmi2age35;?></strong></td>
    <td align="center"><strong><? echo $totalbmi2;?></strong></td>
  </tr>
  <tr>
    <td>4.3 ���˹ѡ�Թ �дѺ1 (BMI = 23.0-24.9 kg/m2)</td>
    <td align="center"><? echo $bmi3age34m;?></td>
    <td align="center"><? echo $bmi3age34f;?></td>
    <td align="center"><strong><? echo $totalbmi3age34;?></strong></td>
    <td align="center"><? echo $bmi3age35m;?></td>
    <td align="center"><? echo $bmi3age35f;?></td>
    <td align="center"><strong><? echo $totalbmi3age35;?></strong></td>
    <td align="center"><strong><? echo $totalbmi3;?></strong></td>
  </tr>
  <tr>
    <td>4.4 ���˹ѡ�Թ �дѺ2 (BMI = 25.0-29.9 kg/m2)</td>
    <td align="center"><? echo $bmi4age34m;?></td>
    <td align="center"><? echo $bmi4age34f;?></td>
    <td align="center"><strong><? echo $totalbmi4age34;?></strong></td>
    <td align="center"><? echo $bmi4age35m;?></td>
    <td align="center"><? echo $bmi4age35f;?></td>
    <td align="center"><strong><? echo $totalbmi4age35;?></strong></td>
    <td align="center"><strong><? echo $totalbmi4;?></strong></td>
  </tr>
  <tr>
    <td>4.5 ������ǹ (BMI &gt;= 30 kg/m2)</td>
    <td align="center"><? echo $bmi5age34m;?></td>
    <td align="center"><? echo $bmi5age34f;?></td>
    <td align="center"><strong><? echo $totalbmi5age34;?></strong></td>
    <td align="center"><? echo $bmi5age35m;?></td>
    <td align="center"><? echo $bmi5age35f;?></td>
    <td align="center"><strong><? echo $totalbmi5age35;?></strong></td>
    <td align="center"><strong><? echo $totalbmi5;?></strong></td>
  </tr>
  <tr>
    <td rowspan="5" align="center" valign="top"><strong>5</strong></td>
    <td><strong>�����ѹ���Ե�Դ���� (Hypertension)</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>5.1 Systolic �Դ���� (Systolic &gt; 140 mmHg) (���ҧ����)</td>
    <td align="center"><? echo $ht1age34m;?></td>
    <td align="center"><? echo $ht1age34f;?></td>
    <td align="center"><strong><? echo $totalht1age34;?></strong></td>
    <td align="center"><? echo $ht1age35m;?></td>
    <td align="center"><? echo $ht1age35f;?></td>
    <td align="center"><strong><? echo $totalht1age35;?></strong></td>
    <td align="center"><strong><? echo $totalht1;?></strong></td>
  </tr>
  <tr>
    <td>5.2 Diastolic �Դ���� (Diastolic &gt; 90 mmHg) (���ҧ����)</td>
    <td align="center"><? echo $ht2age34m;?></td>
    <td align="center"><? echo $ht2age34f;?></td>
    <td align="center"><strong><? echo $totalht2age34;?></strong></td>
    <td align="center"><? echo $ht2age35m;?></td>
    <td align="center"><? echo $ht2age35f;?></td>
    <td align="center"><strong><? echo $totalht2age35;?></strong></td>
    <td align="center"><strong><? echo $totalht2;?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">5.3 Systolic �Դ���� (&gt;140 mmHg) ��� Diastolic �Դ���� (&gt;90 mmHg) </td>
    <td align="center"><? echo $ht3age34m;?></td>
    <td align="center"><? echo $ht3age34f;?></td>
    <td align="center"><strong><? echo $totalht3age34;?></strong></td>
    <td align="center"><? echo $ht3age35m;?></td>
    <td align="center"><? echo $ht3age35f;?></td>
    <td align="center"><strong><? echo $totalht3age35;?></strong></td>
    <td align="center"><strong><? echo $totalht3;?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">(������ ��� 5.1 ��� ��� 5.2)</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>6</strong></td>
    <td><strong>Chest x-ray �Դ����</strong></td>
    <td align="center"><? echo $xrayage34m;?></td>
    <td align="center"><? echo $xrayage34f;?></td>
    <td align="center"><strong><? echo $totalxrayage34;?></strong></td>
    <td align="center"><? echo $xrayage35m;?></td>
    <td align="center"><? echo $xrayage35f;?></td>
    <td align="center"><strong><? echo $totalxrayage35;?></strong></td>
    <td align="center"><strong><? echo $totalxray;?></strong></td>
  </tr>
  <tr>
    <td align="center"><strong>7</strong></td>
    <td><strong>Urine examination �Դ����</strong></td>
    <td align="center"><? echo $uaage34m;?></td>
    <td align="center"><? echo $uaage34f;?></td>
    <td align="center"><strong><? echo $totaluaage34;?></strong></td>
    <td align="center"><? echo $uaage35m;?></td>
    <td align="center"><? echo $uaage35f;?></td>
    <td align="center"><strong><? echo $totaluaage35;?></strong></td>
    <td align="center"><strong><? echo $totalua;?></strong></td>
  </tr>
  <tr>
    <td align="center"><strong>8</strong></td>
    <td><strong>Glucose �Դ���� (DM) (Glucose &gt; 126 mg/dL)</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center"><? echo $bsage35m;?></td>
    <td align="center"><? echo $bsage35f;?></td>
    <td align="center"><strong><? echo $totalbsage35;?></strong></td>
    <td align="center"><strong><? echo $totalbs;?></strong></td>
  </tr>
  <tr>
    <td rowspan="5" align="center" valign="top"><strong>9</strong></td>
    <td><strong>������ѹ����ʹ�٧</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>9.1 Total Cholesterol &gt; 240 mmHg (���ҧ����)</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center"><? echo $cholage35m;?></td>
    <td align="center"><? echo $cholage35f;?></td>
    <td align="center"><strong><? echo $totalcholage35;?></strong></td>
    <td align="center"><strong><? echo $totalchol;?></strong></td>
  </tr>
  <tr>
    <td>9.2 Triglycerides &gt; 200 mmHg (���ҧ����)</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center"><? echo $tgage35m;?></td>
    <td align="center"><? echo $tgage35f;?></td>
    <td align="center"><strong><? echo $totaltgage35;?></strong></td>
    <td align="center"><strong><? echo $totaltg;?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">9.3 Total Cholesterol &gt; 240 mmHg ��� Triglycerides &gt; 200 mmHg</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center"><? echo $bloodage35m;?></td>
    <td align="center"><? echo $bloodage35f;?></td>
    <td align="center"><strong><? echo $totalbloodage35;?></strong></td>
    <td align="center"><strong><? echo $totalblood;?></strong></td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">(������ ��� 9.1 ��� ��� 9.2)</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><strong>10</strong></td>
    <td><strong>�ŵ�Ǩ����移ҡ���١ (Pap-smear) �Դ����</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center">0</td>
    <td align="center"><strong>0</strong></td>
    <td align="center"><strong>0</strong></td>
  </tr>
  <tr>
    <td rowspan="7" align="center" valign="top"><strong>11</strong></td>
    <td><strong>����ѵ��ä��Шӵ�Ǣͧ������Ѻ��õ�Ǩ</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>11.1 �����ѹ���Ե�٧</td>
    <td align="center"><? echo $prawat1age34m;?></td>
    <td align="center"><? echo $prawat1age34f;?></td>
    <td align="center"><strong><? echo $totalprawat1age34;?></strong></td>
    <td align="center"><? echo $prawat1age35m;?></td>
    <td align="center"><? echo $prawat1age35f;?></td>
    <td align="center"><strong><? echo $totalprawat1age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat1;?></strong></td>
  </tr>
  <tr>
    <td>11.2 ����ҹ</td>
    <td align="center"><? echo $prawat2age34m;?></td>
    <td align="center"><? echo $prawat2age34f;?></td>
    <td align="center"><strong><? echo $totalprawat2age34;?></strong></td>
    <td align="center"><? echo $prawat2age35m;?></td>
    <td align="center"><? echo $prawat2age35f;?></td>
    <td align="center"><strong><? echo $totalprawat2age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat2;?></strong></td>
  </tr>
  <tr>
    <td>11.3 �ä���������ʹ���ʹ</td>
    <td align="center"><? echo $prawat3age34m;?></td>
    <td align="center"><? echo $prawat3age34f;?></td>
    <td align="center"><strong><? echo $totalprawat3age34;?></strong></td>
    <td align="center"><? echo $prawat3age35m;?></td>
    <td align="center"><? echo $prawat3age35f;?></td>
    <td align="center"><strong><? echo $totalprawat3age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat3;?></strong></td>
  </tr>
  <tr>
    <td>11.4 ��ѹ����ʹ�٧</td>
    <td align="center"><? echo $prawat4age34m;?></td>
    <td align="center"><? echo $prawat4age34f;?></td>
    <td align="center"><strong><? echo $totalprawat4age34;?></strong></td>
    <td align="center"><? echo $prawat4age35m;?></td>
    <td align="center"><? echo $prawat4age35f;?></td>
    <td align="center"><strong><? echo $totalprawat4age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat4;?></strong></td>
  </tr>
  <tr>
    <td>11.5 �ä��Шӵ�� 4 �ä����˹���������ѹ ����� 2 �ä����</td>
    <td align="center"><? echo $prawat5age34m;?></td>
    <td align="center"><? echo $prawat5age34f;?></td>
    <td align="center"><strong><? echo $totalprawat5age34;?></strong></td>
    <td align="center"><? echo $prawat5age35m;?></td>
    <td align="center"><? echo $prawat5age35f;?></td>
    <td align="center"><strong><? echo $totalprawat5age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat5;?></strong></td>
  </tr>
  <tr>
    <td>11.6 �ä��Шӵ������ �͡�˹�ͨҡ 4 �ä����˹����</td>
    <td align="center"><? echo $prawat6age34m;?></td>
    <td align="center"><? echo $prawat6age34f;?></td>
    <td align="center"><strong><? echo $totalprawat6age34;?></strong></td>
    <td align="center"><? echo $prawat6age35m;?></td>
    <td align="center"><? echo $prawat6age35f;?></td>
    <td align="center"><strong><? echo $totalprawat6age35;?></strong></td>
    <td align="center"><strong><? echo $totalprawat6;?></strong></td>
  </tr>
</table>
</div>
<?
}
?>