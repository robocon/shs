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
<p align="center" style="font-weight:bold;">��§ҹ�š�õ�Ǩ�آ�Ҿ���ѧ�� ��. (�ʵ.15) ��Шӻ� <?=$nPrefix2;?>
</p>
<form name="form1" method="post" action="report_chkup15_army58.php" >
<input name="act" type="hidden" value="show">
  <table width="50%" border="0" align="center" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center">˹��� :
        <label>      
        <select name="camp" id="camp">
          <option value="all" selected>�ء˹���</option>
		 <?
		 $sql="select distinct(camp1) as camp from condxofyear_so where yearcheck = '$nPrefix2' and (camp1 !='D33 ˹��·�������' and camp1 !='')";
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
</form>
<?
if($_POST["act"]=="show"){
if($_POST["camp"]=="all"){
$sql1="SELECT *
FROM `condxofyear_so`
WHERE `yearcheck` = '$nPrefix2' AND `camp1` like 'D%' and camp1 !='' group by hn ORDER BY camp1 ASC, substring(age,1,2) DESC";

}else{
$sql1="SELECT *
FROM `condxofyear_so`
WHERE `camp1`='$_POST[camp]' AND `yearcheck` = '$nPrefix2' AND `camp1` like 'D%'  and camp1 !='' group by hn ORDER BY camp1 ASC, substring(age,1,2) DESC";

}
$query1=mysql_query($sql1)or die ("Query condxofyear_so Error");
//echo $sql1;
$num1=mysql_num_rows($query1);

$age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$age34mp=0;  //��зǹ ��������Թ 35 ���
$age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$age34ml=0;  //�١��ҧ ��������Թ 35 ���
$age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

//----->����ٺ������
$c0age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$c0age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$c0age34mp=0;  //��зǹ ��������Թ 35 ���
$c0age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$c0age34ml=0;  //�١��ҧ ��������Թ 35 ���
$c0age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$c1age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$c1age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$c1age34mp=0;  //��зǹ ��������Թ 35 ���
$c1age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$c1age34ml=0;  //�١��ҧ ��������Թ 35 ���
$c1age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$c2age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$c2age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$c2age34mp=0;  //��зǹ ��������Թ 35 ���
$c2age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$c2age34ml=0;  //�١��ҧ ��������Թ 35 ���
$c2age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$c3age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$c3age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$c3age34mp=0;  //��зǹ ��������Թ 35 ���
$c3age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$c3age34ml=0;  //�١��ҧ ��������Թ 35 ���
$c3age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

//----->��ô�����š�����
$a0age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$a0age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$a0age34mp=0;  //��зǹ ��������Թ 35 ���
$a0age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$a0age34ml=0;  //�١��ҧ ��������Թ 35 ���
$a0age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$a1age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$a1age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$a1age34mp=0;  //��зǹ ��������Թ 35 ���
$a1age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$a1age34ml=0;  //�١��ҧ ��������Թ 35 ���
$a1age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$a2age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$a2age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$a2age34mp=0;  //��зǹ ��������Թ 35 ���
$a2age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$a2age34ml=0;  //�١��ҧ ��������Թ 35 ���
$a2age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$a3age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$a3age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$a3age34mp=0;  //��зǹ ��������Թ 35 ���
$a3age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$a3age34ml=0;  //�١��ҧ ��������Թ 35 ���
$a3age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

//----->����͡���ѧ���
$e0age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$e0age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$e0age34mp=0;  //��зǹ ��������Թ 35 ���
$e0age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$e0age34ml=0;  //�١��ҧ ��������Թ 35 ���
$e0age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$e1age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$e1age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$e1age34mp=0;  //��зǹ ��������Թ 35 ���
$e1age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$e1age34ml=0;  //�١��ҧ ��������Թ 35 ���
$e1age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

$e2age34ms=0;  //�ѭ�Һѵ� ��������Թ 35 ���
$e2age34fs=0;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
$e2age34mp=0;  //��зǹ ��������Թ 35 ���
$e2age34fp=0;  //��зǹ ��������Թ 35 ˭ԧ
$e2age34ml=0;  //�١��ҧ ��������Թ 35 ���
$e2age34fl=0;  //�١��ҧ ��������Թ 35 ˭ԧ

//////////////////////////// �����Թ 35 �� ////////////////////////////
$age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$age35mp=0;  //��зǹ �����Թ 35 ���
$age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$age35ml=0;  //�١��ҧ �����Թ 35 ���
$age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

//----->����ٺ������
$c0age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$c0age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$c0age35mp=0;  //��зǹ �����Թ 35 ���
$c0age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$c0age35ml=0;  //�١��ҧ �����Թ 35 ���
$c0age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$c1age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$c1age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$c1age35mp=0;  //��зǹ �����Թ 35 ���
$c1age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$c1age35ml=0;  //�١��ҧ �����Թ 35 ���
$c1age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$c2age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$c2age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$c2age35mp=0;  //��зǹ �����Թ 35 ���
$c2age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$c2age35ml=0;  //�١��ҧ �����Թ 35 ���
$c2age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$c3age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$c3age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$c3age35mp=0;  //��зǹ �����Թ 35 ���
$c3age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$c3age35ml=0;  //�١��ҧ �����Թ 35 ���
$c3age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

//----->��ô�����š�����
$a0age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$a0age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$a0age35mp=0;  //��зǹ �����Թ 35 ���
$a0age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$a0age35ml=0;  //�١��ҧ �����Թ 35 ���
$a0age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$a1age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$a1age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$a1age35mp=0;  //��зǹ �����Թ 35 ���
$a1age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$a1age35ml=0;  //�١��ҧ �����Թ 35 ���
$a1age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$a2age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$a2age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$a2age35mp=0;  //��зǹ �����Թ 35 ���
$a2age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$a2age35ml=0;  //�١��ҧ �����Թ 35 ���
$a2age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$a3age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$a3age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$a3age35mp=0;  //��зǹ �����Թ 35 ���
$a3age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$a3age35ml=0;  //�١��ҧ �����Թ 35 ���
$a3age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

//----->����͡���ѧ���
$e0age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$e0age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$e0age35mp=0;  //��зǹ �����Թ 35 ���
$e0age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$e0age35ml=0;  //�١��ҧ �����Թ 35 ���
$e0age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$e1age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$e1age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$e1age35mp=0;  //��зǹ �����Թ 35 ���
$e1age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$e1age35ml=0;  //�١��ҧ �����Թ 35 ���
$e1age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ

$e2age35ms=0;  //�ѭ�Һѵ� �����Թ 35 ���
$e2age35fs=0;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
$e2age35mp=0;  //��зǹ �����Թ 35 ���
$e2age35fp=0;  //��зǹ �����Թ 35 ˭ԧ
$e2age35ml=0;  //�١��ҧ �����Թ 35 ���
$e2age35fl=0;  //�١��ҧ �����Թ 35 ˭ԧ


$totalm=0;
$totalf=0;

$c0totalm=0;
$c0totalf=0;
$c1totalm=0;
$c1totalf=0;
$c2totalm=0;
$c2totalf=0;
$c3totalm=0;
$c3totalf=0;

$a0totalm=0;
$a0totalf=0;
$a1totalm=0;
$a1totalf=0;
$a2totalm=0;
$a2totalf=0;
$a3totalm=0;
$a3totalf=0;

$e0totalm=0;
$e0totalf=0;
$e1totalm=0;
$e1totalf=0;
$e2totalm=0;
$e2totalf=0;

$other=0;

while($rows=mysql_fetch_array($query1)){
$chkyear=substr($rows["yearcheck"],2,2);
$chunyot=substr($rows["chunyot1"],0,4);
$gender=$rows["gender"];
//echo "==>".$gender."<br>";	
if($gender==1){  //�Ȫ��
$totalm++;

if($rows["cigarette"]=="0"){
	$c0totalm++;
}else if($rows["cigarette"]=="1"){
	$c1totalm++;
}else if($rows["cigarette"]=="2"){
	$c2totalm++;
}else if($rows["cigarette"]=="3"){
	$c3totalm++;
}else{
	$c0totalm++;
}

if($rows["alcohol"]=="0"){
	$a0totalm++;
}else if($rows["alcohol"]=="1"){
	$a1totalm++;
}else if($rows["alcohol"]=="2"){
	$a2totalm++;
}else if($rows["alcohol"]=="3"){
	$a3totalm++;
}else{
	$a0totalm++;
}

if($rows["exercise"]=="0"){
	$e0totalm++;
}else if($rows["exercise"]=="1"){
	$e1totalm++;
}else if($rows["exercise"]=="2"){
	$e2totalm++;
}else{
	$e0totalm++;
}

	if($rows["age"] < 35){
		if($chunyot =="CH01"){
			$age34ms++;  //�ѭ�Һѵ� ��������Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age34ms++;
			}else if($rows["cigarette"]=="1"){
				$c1age34ms++;
			}else if($rows["cigarette"]=="2"){
				$c2age34ms++;
			}else if($rows["cigarette"]=="3"){
				$c3age34ms++;
			}else{
				$c0age34ms++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34ms++;
			}else if($rows["alcohol"]=="1"){
				$a1age34ms++;
			}else if($rows["alcohol"]=="2"){
				$a2age34ms++;
			}else if($rows["alcohol"]=="3"){
				$a3age34ms++;
			}else{
				$a0age34ms++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34ms++;
			}else if($rows["exercise"]=="1"){
				$e1age34ms++;
			}else if($rows["exercise"]=="2"){
				$e2age34ms++;	
			}else{
				$e0age34ms++;
			}					
		}else if($chunyot =="CH02"){
			$age34mp++;  //��зǹ ��������Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age34mp++;
			}else if($rows["cigarette"]=="1"){
				$c1age34mp++;
			}else if($rows["cigarette"]=="2"){
				$c2age34mp++;
			}else if($rows["cigarette"]=="3"){
				$c3age34mp++;
			}else{
				$c0age34mp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34mp++;
			}else if($rows["alcohol"]=="1"){
				$a1age34mp++;
			}else if($rows["alcohol"]=="2"){
				$a2age34mp++;
			}else if($rows["alcohol"]=="3"){
				$a3age34mp++;
			}else{
				$a0age34mp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34mp++;
			}else if($rows["exercise"]=="1"){
				$e1age34mp++;
			}else if($rows["exercise"]=="2"){
				$e2age34mp++;	
			}else{
				$e0age34mp++;
			}						
		}else if($chunyot =="CH04"){
			$age34ml++;  //�١��ҧ ��������Թ 35 ���

			if($rows["cigarette"]=="0"){
				$c0age34ml++;
			}else if($rows["cigarette"]=="1"){
				$c1age34ml++;
			}else if($rows["cigarette"]=="2"){
				$c2age34ml++;
			}else if($rows["cigarette"]=="3"){
				$c3age34ml++;
			}else{
				$c0age34ml++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34ml++;
			}else if($rows["alcohol"]=="1"){
				$a1age34ml++;
			}else if($rows["alcohol"]=="2"){
				$a2age34ml++;
			}else if($rows["alcohol"]=="3"){
				$a3age34ml++;
			}else{
				$a0age34ml++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34ml++;
			}else if($rows["exercise"]=="1"){
				$e1age34ml++;
			}else if($rows["exercise"]=="2"){
				$e2age34ml++;	
			}else{
				$e0age34ml++;
			}					
		}
	}else if($rows["age"] >=35){
		if($chunyot =="CH01"){
			$age35ms++;  //�ѭ�Һѵ� �����Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age35ms++;
			}else if($rows["cigarette"]=="1"){
				$c1age35ms++;
			}else if($rows["cigarette"]=="2"){
				$c2age35ms++;
			}else if($rows["cigarette"]=="3"){
				$c3age35ms++;
			}else{
				$c0age35ms++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35ms++;
			}else if($rows["alcohol"]=="1"){
				$a1age35ms++;

			}else if($rows["alcohol"]=="2"){
				$a2age35ms++;
			}else if($rows["alcohol"]=="3"){
				$a3age35ms++;
			}else{
				$a0age35ms++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35ms++;
			}else if($rows["exercise"]=="1"){
				$e1age35ms++;
			}else if($rows["exercise"]=="2"){
				$e2age35ms++;	
			}else{
				$e0age35ms++;
			}				
		}else if($chunyot =="CH02"){
			$age35mp++;  //��зǹ �����Թ 35 ���
			if($rows["cigarette"]=="0"){
				$c0age35mp++;
			}else if($rows["cigarette"]=="1"){
				$c1age35mp++;
			}else if($rows["cigarette"]=="2"){
				$c2age35mp++;
			}else if($rows["cigarette"]=="3"){
				$c3age35mp++;
			}else{
				$c0age35mp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35mp++;
			}else if($rows["alcohol"]=="1"){
				$a1age35mp++;
			}else if($rows["alcohol"]=="2"){
				$a2age35mp++;
			}else if($rows["alcohol"]=="3"){
				$a3age35mp++;
			}else{
				$a0age35mp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35mp++;
			}else if($rows["exercise"]=="1"){
				$e1age35mp++;
			}else if($rows["exercise"]=="2"){
				$e2age35mp++;	
			}else{
				$e0age35mp++;
			}			
		}else if($chunyot =="CH04"){
			$age35ml++;  //�١��ҧ �����Թ 35 ���

			if($rows["cigarette"]=="0"){
				$c0age35ml++;
			}else if($rows["cigarette"]=="1"){
				$c1age35ml++;
			}else if($rows["cigarette"]=="2"){
				$c2age35ml++;
			}else if($rows["cigarette"]=="3"){
				$c3age35ml++;
			}else{
				$c0age35ml++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35ml++;
			}else if($rows["alcohol"]=="1"){
				$a1age35ml++;
			}else if($rows["alcohol"]=="2"){
				$a2age35ml++;
			}else if($rows["alcohol"]=="3"){
				$a3age35ml++;
			}else{
				$a0age35ml++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35ml++;
			}else if($rows["exercise"]=="1"){
				$e1age35ml++;
			}else if($rows["exercise"]=="2"){
				$e2age35ml++;	
			}else{
				$e0age35ml++;
			}				
		}	
	}
}else if($gender==2){  // ��˭ԧ
$totalf++;

if($rows["cigarette"]=="0"){
	$c0totalf++;
}else if($rows["cigarette"]=="1"){
	$c1totalf++;
}else if($rows["cigarette"]=="2"){
	$c2totalf++;
}else if($rows["cigarette"]=="3"){
	$c3totalf++;
}else{
	$c0totalf++;
}

if($rows["alcohol"]=="0"){
	$a0totalf++;
}else if($rows["alcohol"]=="1"){
	$a1totalf++;
}else if($rows["alcohol"]=="2"){
	$a2totalf++;
}else if($rows["alcohol"]=="3"){
	$a3totalf++;
}else{
	$a0totalf++;
}

if($rows["exercise"]=="0"){
	$e0totalf++;
}else if($rows["exercise"]=="1"){
	$e1totalf++;
}else if($rows["exercise"]=="2"){
	$e2totalf++;
}else{
	$e0totalf++;
}

	if($rows["age"] < 35){
		if($chunyot =="CH01"){
			$age34fs++;  //�ѭ�Һѵ� ��������Թ 35 ˭ԧ
			
			if($rows["cigarette"]=="0"){
				$c0age34fs++;
			}else if($rows["cigarette"]=="1"){
				$c1age34fs++;
			}else if($rows["cigarette"]=="2"){
				$c2age34fs++;
			}else if($rows["cigarette"]=="3"){
				$c3age34fs++;
			}else{
				$c0age34fs++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34fs++;
			}else if($rows["alcohol"]=="1"){
				$a1age34fs++;
			}else if($rows["alcohol"]=="2"){
				$a2age34fs++;
			}else if($rows["alcohol"]=="3"){
				$a3age34fs++;
			}else{
				$a0age34fs++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34fs++;
			}else if($rows["exercise"]=="1"){
				$e1age34fs++;
			}else if($rows["exercise"]=="2"){
				$e2age34fs++;	
			}else{
				$e0age34fs++;
			}					
		}else if($chunyot =="CH02"){
			$age34fp++;  //��зǹ ��������Թ 35 ˭ԧ
			
			if($rows["cigarette"]=="0"){
				$c0age34fp++;
			}else if($rows["cigarette"]=="1"){
				$c1age34fp++;
			}else if($rows["cigarette"]=="2"){
				$c2age34fp++;
			}else if($rows["cigarette"]=="3"){
				$c3age34fp++;
			}else{
				$c0age34fp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34fp++;
			}else if($rows["alcohol"]=="1"){
				$a1age34fp++;
			}else if($rows["alcohol"]=="2"){
				$a2age34fp++;
			}else if($rows["alcohol"]=="3"){
				$a3age34fp++;
			}else{
				$a0age34fp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34fp++;
			}else if($rows["exercise"]=="1"){
				$e1age34fp++;
			}else if($rows["exercise"]=="2"){
				$e2age34fp++;	
			}else{
				$e0age34fp++;
			}						
		}else if($chunyot =="CH04"){
			$age34fl++;  //�١��ҧ ��������Թ 35 ˭ԧ

			if($rows["cigarette"]=="0"){
				$c0age34fl++;
			}else if($rows["cigarette"]=="1"){
				$c1age34fl++;
			}else if($rows["cigarette"]=="2"){
				$c2age34fl++;
			}else if($rows["cigarette"]=="3"){
				$c3age34fl++;
			}else{
				$c0age34fl++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34fl++;
			}else if($rows["alcohol"]=="1"){
				$a1age34fl++;
			}else if($rows["alcohol"]=="2"){
				$a2age34fl++;
			}else if($rows["alcohol"]=="3"){
				$a3age34fl++;
			}else{
				$a0age34fl++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34fl++;
			}else if($rows["exercise"]=="1"){
				$e1age34fl++;
			}else if($rows["exercise"]=="2"){
				$e2age34fl++;	
			}else{
				$e0age34fl++;
			}					
		}
	}else if($rows["age"] >=35){
		if($chunyot =="CH01"){
			$age35fs++;  //�ѭ�Һѵ� �����Թ 35 ˭ԧ
			
			if($rows["cigarette"]=="0"){
				$c0age35fs++;
			}else if($rows["cigarette"]=="1"){
				$c1age35fs++;
			}else if($rows["cigarette"]=="2"){
				$c2age35fs++;
			}else if($rows["cigarette"]=="3"){
				$c3age35fs++;
			}else{
				$c0age35fs++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35fs++;
			}else if($rows["alcohol"]=="1"){
				$a1age35fs++;
			}else if($rows["alcohol"]=="2"){
				$a2age35fs++;
			}else if($rows["alcohol"]=="3"){
				$a3age35fs++;
			}else{
				$a0age35fs++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35fs++;
			}else if($rows["exercise"]=="1"){
				$e1age35fs++;
			}else if($rows["exercise"]=="2"){
				$e2age35fs++;	
			}else{
				$e0age35fs++;
			}				
		}else if($chunyot =="CH02"){
			$age35fp++;  //��зǹ �����Թ 35 ˭ԧ
			if($rows["cigarette"]=="0"){
				$c0age35fp++;
			}else if($rows["cigarette"]=="1"){
				$c1age35fp++;
			}else if($rows["cigarette"]=="2"){
				$c2age35fp++;
			}else if($rows["cigarette"]=="3"){
				$c3age35fp++;
			}else{
				$c0age35fp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35fp++;
			}else if($rows["alcohol"]=="1"){
				$a1age35fp++;
			}else if($rows["alcohol"]=="2"){
				$a2age35fp++;
			}else if($rows["alcohol"]=="3"){
				$a3age35fp++;
			}else{
				$a0age35fp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35fp++;
			}else if($rows["exercise"]=="1"){
				$e1age35fp++;
			}else if($rows["exercise"]=="2"){
				$e2age35fp++;	
			}else{
				$e0age35fp++;
			}			
		}else if($chunyot =="CH04"){
			$age35fl++;  //�١��ҧ �����Թ 35 ˭ԧ

			if($rows["cigarette"]=="0"){
				$c0age35fl++;
			}else if($rows["cigarette"]=="1"){
				$c1age35fl++;
			}else if($rows["cigarette"]=="2"){
				$c2age35fl++;
			}else if($rows["cigarette"]=="3"){
				$c3age35fl++;
			}else{
				$c0age35fl++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35fl++;
			}else if($rows["alcohol"]=="1"){
				$a1age35fl++;
			}else if($rows["alcohol"]=="2"){
				$a2age35fl++;
			}else if($rows["alcohol"]=="3"){
				$a3age35fl++;
			}else{
				$a0age35fl++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35fl++;
			}else if($rows["exercise"]=="1"){
				$e1age35fl++;
			}else if($rows["exercise"]=="2"){
				$e2age35fl++;	
			}else{
				$e0age35fl++;
			}				
		}	
	}
}else{ //������
$other++;
$totalm++;
//echo "==>���� $other<br>";

if($rows["cigarette"]=="0"){
	$c0totalm++;
}else if($rows["cigarette"]=="1"){
	$c1totalm++;
}else if($rows["cigarette"]=="2"){
	$c2totalm++;
}else if($rows["cigarette"]=="3"){
	$c3totalm++;
}else{
	$c0totalm++;
}

if($rows["alcohol"]=="0"){
	$a0totalm++;
}else if($rows["alcohol"]=="1"){
	$a1totalm++;
}else if($rows["alcohol"]=="2"){
	$a2totalm++;
}else if($rows["alcohol"]=="3"){
	$a3totalm++;
}else{
	$a0totalm++;
}

if($rows["exercise"]=="0"){
	$e0totalm++;
}else if($rows["exercise"]=="1"){
	$e1totalm++;
}else if($rows["exercise"]=="2"){
	$e2totalm++;
}else{
	$e0totalm++;
}

	if($rows["age"] < 35){
		if($chunyot =="CH01"){
			$age34ms++;  //�ѭ�Һѵ� ��������Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age34ms++;
			}else if($rows["cigarette"]=="1"){
				$c1age34ms++;
			}else if($rows["cigarette"]=="2"){
				$c2age34ms++;
			}else if($rows["cigarette"]=="3"){
				$c3age34ms++;
			}else{
				$c0age34ms++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34ms++;
			}else if($rows["alcohol"]=="1"){
				$a1age34ms++;
			}else if($rows["alcohol"]=="2"){
				$a2age34ms++;
			}else if($rows["alcohol"]=="3"){
				$a3age34ms++;
			}else{
				$a0age34ms++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34ms++;
			}else if($rows["exercise"]=="1"){
				$e1age34ms++;
			}else if($rows["exercise"]=="2"){
				$e2age34ms++;	
			}else{
				$e0age34ms++;
			}					
		}else if($chunyot =="CH02"){
			$age34mp++;  //��зǹ ��������Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age34mp++;
			}else if($rows["cigarette"]=="1"){
				$c1age34mp++;
			}else if($rows["cigarette"]=="2"){
				$c2age34mp++;
			}else if($rows["cigarette"]=="3"){
				$c3age34mp++;
			}else{
				$c0age34mp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34mp++;
			}else if($rows["alcohol"]=="1"){
				$a1age34mp++;
			}else if($rows["alcohol"]=="2"){
				$a2age34mp++;
			}else if($rows["alcohol"]=="3"){
				$a3age34mp++;
			}else{
				$a0age34mp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34mp++;
			}else if($rows["exercise"]=="1"){
				$e1age34mp++;
			}else if($rows["exercise"]=="2"){
				$e2age34mp++;	
			}else{
				$e0age34mp++;
			}						
		}else if($chunyot =="CH04"){
			$age34ml++;  //�١��ҧ ��������Թ 35 ���

			if($rows["cigarette"]=="0"){
				$c0age34ml++;
			}else if($rows["cigarette"]=="1"){
				$c1age34ml++;
			}else if($rows["cigarette"]=="2"){
				$c2age34ml++;
			}else if($rows["cigarette"]=="3"){
				$c3age34ml++;
			}else{
				$c0age34ml++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age34ml++;
			}else if($rows["alcohol"]=="1"){
				$a1age34ml++;
			}else if($rows["alcohol"]=="2"){
				$a2age34ml++;
			}else if($rows["alcohol"]=="3"){
				$a3age34ml++;
			}else{
				$a0age34ml++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age34ml++;
			}else if($rows["exercise"]=="1"){
				$e1age34ml++;
			}else if($rows["exercise"]=="2"){
				$e2age34ml++;	
			}else{
				$e0age34ml++;
			}					
		}
	}else if($rows["age"] >=35){
		if($chunyot =="CH01"){
			$age35ms++;  //�ѭ�Һѵ� �����Թ 35 ���
			
			if($rows["cigarette"]=="0"){
				$c0age35ms++;
			}else if($rows["cigarette"]=="1"){
				$c1age35ms++;
			}else if($rows["cigarette"]=="2"){
				$c2age35ms++;
			}else if($rows["cigarette"]=="3"){
				$c3age35ms++;
			}else{
				$c0age35ms++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35ms++;
			}else if($rows["alcohol"]=="1"){
				$a1age35ms++;
			}else if($rows["alcohol"]=="2"){
				$a2age35ms++;
			}else if($rows["alcohol"]=="3"){
				$a3age35ms++;
			}else{
				$a0age35ms++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35ms++;
			}else if($rows["exercise"]=="1"){
				$e1age35ms++;
			}else if($rows["exercise"]=="2"){
				$e2age35ms++;	
			}else{
				$e0age35ms++;
			}				
		}else if($chunyot =="CH02"){
			$age35mp++;  //��зǹ �����Թ 35 ���
			if($rows["cigarette"]=="0"){
				$c0age35mp++;
			}else if($rows["cigarette"]=="1"){
				$c1age35mp++;
			}else if($rows["cigarette"]=="2"){
				$c2age35mp++;
			}else if($rows["cigarette"]=="3"){
				$c3age35mp++;
			}else{
				$c0age35mp++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35mp++;
			}else if($rows["alcohol"]=="1"){
				$a1age35mp++;
			}else if($rows["alcohol"]=="2"){
				$a2age35mp++;
			}else if($rows["alcohol"]=="3"){
				$a3age35mp++;
			}else{
				$a0age35mp++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35mp++;
			}else if($rows["exercise"]=="1"){
				$e1age35mp++;
			}else if($rows["exercise"]=="2"){
				$e2age35mp++;	
			}else{
				$e0age35mp++;
			}			
		}else if($chunyot =="CH04"){
			$age35ml++;  //�١��ҧ �����Թ 35 ���

			if($rows["cigarette"]=="0"){
				$c0age35ml++;
			}else if($rows["cigarette"]=="1"){
				$c1age35ml++;
			}else if($rows["cigarette"]=="2"){
				$c2age35ml++;
			}else if($rows["cigarette"]=="3"){
				$c3age35ml++;
			}else{
				$c0age35ml++;
			}
			
			if($rows["alcohol"]=="0"){
				$a0age35ml++;
			}else if($rows["alcohol"]=="1"){
				$a1age35ml++;
			}else if($rows["alcohol"]=="2"){
				$a2age35ml++;
			}else if($rows["alcohol"]=="3"){
				$a3age35ml++;
			}else{
				$a0age35ml++;
			}
			
			if($rows["exercise"]=="0"){
				$e0age35ml++;
			}else if($rows["exercise"]=="1"){
				$e1age35ml++;
			}else if($rows["exercise"]=="2"){
				$e2age35ml++;	
			}else{
				$e0age35ml++;
			}				
		}	
	}

}  //close if ��
}  //close while

$msql=mysql_query("select pcucode, pcuname, pcupart from mainhospital where pcuid='1'");		
list($pcucode,$pcuname,$pcupart)=mysql_fetch_row($msql);
?>
<div align="center">
<div align="right">( Ẻ ç.�ʵ.15 )</div>
<h3 align="center"><strong>5. ��§ҹ��ػ�ĵԡ�����ô��Թ���Ե�ͧ���ѧ�šͧ�Ѿ������ռŵ�ͤ�������§���ä ��Шӻ�</strong> <?=$nPrefix2;?></h3>
<div align="left" style="margin-left:25%;"><strong>˹������ᾷ����ӡ�õ�Ǩ</strong>  <?="($pcucode) $pcuname";?></div>
<div align="left" style="margin-left:25%;"><strong>˹��·��÷�����Ѻ��õ�Ǩ</strong> <? if($_POST["camp"]=="all"){ echo $pcupart;}else{ echo substr($_POST["camp"],4);}?></div>
<br />
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" class="pdxpro">
  <tr>
    <td rowspan="4" align="center" valign="middle"><strong>�ӴѺ</strong></td>
    <td rowspan="4" align="center" valign="middle"><strong>��¡��</strong></td>
    <td colspan="14" align="center"><strong>�ӹǹ���ѧ�šͧ�Ѿ�� (���)</strong></td>
    </tr>
  <tr>
    <td colspan="6" align="center"><strong>��������Թ 35 �պ�Ժ�ó�</strong></td>
    <td colspan="6" align="center"><strong>�����ҡ���� 35 �պ�Ժ�ó�</strong></td>
    <td colspan="2" rowspan="2" align="center" valign="middle"><strong>���<br>
      (���)</strong></td>
    </tr>
  <tr>
    <td colspan="2" align="center"><strong>����ѭ�Һѵ�</strong></td>
    <td colspan="2" align="center"><strong>��鹻�зǹ</strong></td>
    <td colspan="2" align="center"><strong>�١��ҧ��Ш�</strong></td>
    <td colspan="2" align="center"><strong>����ѭ�Һѵ�</strong></td>
    <td colspan="2" align="center"><strong>��鹻�зǹ</strong></td>
    <td colspan="2" align="center"><strong>�١��ҧ��Ш�</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    <td align="center"><strong>���</strong></td>
    <td align="center"><strong>˭ԧ</strong></td>
    </tr>
  <tr>
    <td align="center"><strong>1</strong></td>
    <td><strong>�ӹǹ���ѧ�ŷ�����</strong></td>
    <td align="center"><? echo $age34ms;?></td>
    <td align="center"><? echo $age34fs;?></td>
    <td align="center"><? echo $age34mp;?></td>
    <td align="center"><? echo $age34fp;?></td>
    <td align="center"><? echo $age34ml;?></td>
    <td align="center"><? echo $age34fl;?></td>
    <td align="center"><? echo $age35ms;?></td>
    <td align="center"><? echo $age35fs;?></td>
    <td align="center"><? echo $age35mp;?></td>
    <td align="center"><? echo $age35fp;?></td>
    <td align="center"><? echo $age35ml;?></td>
    <td align="center"><? echo $age35fl;?></td>
    <td align="center"><? echo $totalm;?></td>
    <td align="center"><? echo $totalf;?></td>
  </tr>
  <tr>
    <td rowspan="5" align="center" valign="top"><strong>2</strong></td>
    <td><strong>����ٺ������</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>2.1 ������ٺ������</td>
    <td align="center"><? echo $c0age34ms;?></td>
    <td align="center"><? echo $c0age34fs;?></td>
    <td align="center"><? echo $c0age34mp;?></td>
    <td align="center"><? echo $c0age34fp;?></td>
    <td align="center"><? echo $c0age34ml;?></td>
    <td align="center"><? echo $c0age34fl;?></td>
    <td align="center"><? echo $c0age35ms;?></td>
    <td align="center"><? echo $c0age35fs;?></td>
    <td align="center"><? echo $c0age35mp;?></td>
    <td align="center"><? echo $c0age35fp;?></td>
    <td align="center"><? echo $c0age35ml;?></td>
    <td align="center"><? echo $c0age35fl;?></td>
    <td align="center"><? echo $c0totalm;?></td>
    <td align="center"><? echo $c0totalf;?></td>
  </tr>
  <tr>
    <td>2.2 ���ٺ������ ����ԡ����</td>
    <td align="center"><? echo $c1age34ms;?></td>
    <td align="center"><? echo $c1age34fs;?></td>
    <td align="center"><? echo $c1age34mp;?></td>
    <td align="center"><? echo $c1age34fp;?></td>
    <td align="center"><? echo $c1age34ml;?></td>
    <td align="center"><? echo $c1age34fl;?></td>
    <td align="center"><? echo $c1age35ms;?></td>
    <td align="center"><? echo $c1age35fs;?></td>
    <td align="center"><? echo $c1age35mp;?></td>
    <td align="center"><? echo $c1age35fp;?></td>
    <td align="center"><? echo $c1age35ml;?></td>
    <td align="center"><? echo $c1age35fl;?></td>
    <td align="center"><? echo $c1totalm;?></td>
    <td align="center"><? echo $c1totalf;?></td>
    </tr>
  <tr>
    <td>2.3 �ٺ�������繤��駤���</td>
    <td align="center"><? echo $c2age34ms;?></td>
    <td align="center"><? echo $c2age34fs;?></td>
    <td align="center"><? echo $c2age34mp;?></td>
    <td align="center"><? echo $c2age34fp;?></td>
    <td align="center"><? echo $c2age34ml;?></td>
    <td align="center"><? echo $c2age34fl;?></td>
    <td align="center"><? echo $c2age35ms;?></td>
    <td align="center"><? echo $c2age35fs;?></td>
    <td align="center"><? echo $c2age35mp;?></td>
    <td align="center"><? echo $c2age35fp;?></td>
    <td align="center"><? echo $c2age35ml;?></td>
    <td align="center"><? echo $c2age35fl;?></td>
    <td align="center"><? echo $c2totalm;?></td>
    <td align="center"><? echo $c2totalf;?></td>
    </tr>
  <tr>
    <td>2.4 �ٺ�������繻�Ш�</td>
    <td align="center"><? echo $c3age34ms;?></td>
    <td align="center"><? echo $c3age34fs;?></td>
    <td align="center"><? echo $c3age34mp;?></td>
    <td align="center"><? echo $c3age34fp;?></td>
    <td align="center"><? echo $c3age34ml;?></td>
    <td align="center"><? echo $c3age34fl;?></td>
    <td align="center"><? echo $c3age35ms;?></td>
    <td align="center"><? echo $c3age35fs;?></td>
    <td align="center"><? echo $c3age35mp;?></td>
    <td align="center"><? echo $c3age35fp;?></td>
    <td align="center"><? echo $c3age35ml;?></td>
    <td align="center"><? echo $c3age35fl;?></td>
    <td align="center"><? echo $c3totalm;?></td>
    <td align="center"><? echo $c3totalf;?></td>
    </tr>
  <tr>
    <td rowspan="5" align="center" valign="top"><strong>3</strong></td>
    <td><strong>��ô�������ͧ�����������š�����</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>3.1 ����´���</td>
    <td align="center"><? echo $a0age34ms;?></td>
    <td align="center"><? echo $a0age34fs;?></td>
    <td align="center"><? echo $a0age34mp;?></td>
    <td align="center"><? echo $a0age34fp;?></td>
    <td align="center"><? echo $a0age34ml;?></td>
    <td align="center"><? echo $a0age34fl;?></td>
    <td align="center"><? echo $a0age35ms;?></td>
    <td align="center"><? echo $a0age35fs;?></td>
    <td align="center"><? echo $a0age35mp;?></td>
    <td align="center"><? echo $a0age35fp;?></td>
    <td align="center"><? echo $a0age35ml;?></td>
    <td align="center"><? echo $a0age35fl;?></td>
    <td align="center"><? echo $a0totalm;?></td>
    <td align="center"><? echo $a0totalf;?></td>
    </tr>
  <tr>
    <td>3.2 �´��� ����ԡ��������</td>
    <td align="center"><? echo $a1age34ms;?></td>
    <td align="center"><? echo $a1age34fs;?></td>
    <td align="center"><? echo $a1age34mp;?></td>
    <td align="center"><? echo $a1age34fp;?></td>
    <td align="center"><? echo $a1age34ml;?></td>
    <td align="center"><? echo $a1age34fl;?></td>
    <td align="center"><? echo $a1age35ms;?></td>
    <td align="center"><? echo $a1age35fs;?></td>
    <td align="center"><? echo $a1age35mp;?></td>
    <td align="center"><? echo $a1age35fp;?></td>
    <td align="center"><? echo $a1age35ml;?></td>
    <td align="center"><? echo $a1age35fl;?></td>
    <td align="center"><? echo $a1totalm;?></td>
    <td align="center"><? echo $a1totalf;?></td>
  </tr>
  <tr>
    <td>3.3 �����繤��駤��� (����੾�Чҹ����§��������Թ 1 ���)</td>
    <td align="center"><? echo $a2age34ms;?></td>
    <td align="center"><? echo $a2age34fs;?></td>
    <td align="center"><? echo $a2age34mp;?></td>
    <td align="center"><? echo $a2age34fp;?></td>
    <td align="center"><? echo $a2age34ml;?></td>
    <td align="center"><? echo $a2age34fl;?></td>
    <td align="center"><? echo $a2age35ms;?></td>
    <td align="center"><? echo $a2age35fs;?></td>
    <td align="center"><? echo $a2age35mp;?></td>
    <td align="center"><? echo $a2age35fp;?></td>
    <td align="center"><? echo $a2age35ml;?></td>
    <td align="center"><? echo $a2age35fl;?></td>
    <td align="center"><? echo $a2totalm;?></td>
    <td align="center"><? echo $a2totalf;?></td>
  </tr>
  <tr>
    <td>3.4 �����繻�Ш�</td>
    <td align="center"><? echo $a3age34ms;?></td>
    <td align="center"><? echo $a3age34fs;?></td>
    <td align="center"><? echo $a3age34mp;?></td>
    <td align="center"><? echo $a3age34fp;?></td>
    <td align="center"><? echo $a3age34ml;?></td>
    <td align="center"><? echo $a3age34fl;?></td>
    <td align="center"><? echo $a3age35ms;?></td>
    <td align="center"><? echo $a3age35fs;?></td>
    <td align="center"><? echo $a3age35mp;?></td>
    <td align="center"><? echo $a3age35fp;?></td>
    <td align="center"><? echo $a3age35ml;?></td>
    <td align="center"><? echo $a3age35fl;?></td>
    <td align="center"><? echo $a3totalm;?></td>
    <td align="center"><? echo $a3totalf;?></td>
  </tr>
  <tr>
    <td rowspan="4" align="center" valign="top"><strong>4</strong></td>
    <td><strong>����͡���ѧ��� (ࡳ�����͡���ѧ��� 3 ���駵�� 1 �ѻ����)</strong></td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    <td align="center" bgcolor="#CCCCCC">&nbsp;</td>
    </tr>
  <tr>
    <td>4.1 ����͡���ѧ���</td>
    <td align="center"><? echo $e0age34ms;?></td>
    <td align="center"><? echo $e0age34fs;?></td>
    <td align="center"><? echo $e0age34mp;?></td>
    <td align="center"><? echo $e0age34fp;?></td>
    <td align="center"><? echo $e0age34ml;?></td>
    <td align="center"><? echo $e0age34fl;?></td>
    <td align="center"><? echo $e0age35ms;?></td>
    <td align="center"><? echo $e0age35fs;?></td>
    <td align="center"><? echo $e0age35mp;?></td>
    <td align="center"><? echo $e0age35fp;?></td>
    <td align="center"><? echo $e0age35ml;?></td>
    <td align="center"><? echo $e0age35fl;?></td>
    <td align="center"><? echo $e0totalm;?></td>
    <td align="center"><? echo $e0totalf;?></td>
    </tr>
  <tr>
    <td>4.2 �͡���ѧ��µ�ӡ���ࡳ��</td>
    <td align="center"><? echo $e1age34ms;?></td>
    <td align="center"><? echo $e1age34fs;?></td>
    <td align="center"><? echo $e1age34mp;?></td>
    <td align="center"><? echo $e1age34fp;?></td>
    <td align="center"><? echo $e1age34ml;?></td>
    <td align="center"><? echo $e1age34fl;?></td>
    <td align="center"><? echo $e1age35ms;?></td>
    <td align="center"><? echo $e1age35fs;?></td>
    <td align="center"><? echo $e1age35mp;?></td>
    <td align="center"><? echo $e1age35fp;?></td>
    <td align="center"><? echo $e1age35ml;?></td>
    <td align="center"><? echo $e1age35fl;?></td>
    <td align="center"><? echo $e1totalm;?></td>
    <td align="center"><? echo $e1totalf;?></td>
    </tr>
  <tr>
    <td>4.3 �͡���ѧ��µ��ࡳ��</td>
    <td align="center"><? echo $e2age34ms;?></td>
    <td align="center"><? echo $e2age34fs;?></td>
    <td align="center"><? echo $e2age34mp;?></td>
    <td align="center"><? echo $e2age34fp;?></td>
    <td align="center"><? echo $e2age34ml;?></td>
    <td align="center"><? echo $e2age34fl;?></td>
    <td align="center"><? echo $e2age35ms;?></td>
    <td align="center"><? echo $e2age35fs;?></td>
    <td align="center"><? echo $e2age35mp;?></td>
    <td align="center"><? echo $e2age35fp;?></td>
    <td align="center"><? echo $e2age35ml;?></td>
    <td align="center"><? echo $e2age35fl;?></td>
    <td align="center"><? echo $e2totalm;?></td>
    <td align="center"><? echo $e2totalf;?></td>
    </tr>
</table>
</div>
<?
}
?>