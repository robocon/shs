<?
session_start();
include("connect.inc");
function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
</head>

<body>
<? if(!isset($_GET['view'])&!isset($_GET['stricker'])){?>
<div id="no_print" > 
<form action="pdx_ofyear.php" method="post">
<center><font class="pdxhead"><strong>㺵�Ǩ�آ�Ҿ��Шӻ�Ẻ�����</strong></font></center>
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr><td width="480" align="center" bgcolor="#FFFF99"><strong>��͡������ HN </strong></td></tr>
  <tr><td>HN: <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
  <tr><td>���� - ʡ�� : <input name="namep" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
</table>
<br />
<a href="search_dxofyear.php" target="_blank">****���Ҩҡ����-ʡ��****</a>
<br />
<a href="pdx_ofyear.php">****˹���á��Ǩ�آ�Ҿ��Шӻ�****</a>
<br />
<a href ="../nindex.htm" >**** &lt;&lt; ����****</a>
</form>
</div>

<?
}
if(isset($_POST['okhn'])){
	$sql = "select concat(yot,' ',name,' ',surname),dbirth,concat(address,' ',tambol,' ',ampur,' ',changwat),phone from opcard where hn = '".$_POST['hn']."'";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		$_SESSION["age_n"] = "�ѹ/��͹/�� �Դ....................... ���� :.........��";
		$_SESSION['add_n'] = ".....................................................................................................................................";
		$_SESSION['tel_n'] = ".......................";
		$_SESSION['name_n'] = $_POST['namep'];
		$_SESSION['hn_n'] = ".......................";
	}else{
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		$_SESSION["age_n"] = "�ѹ/��͹/�� �Դ....................... ���� :.........��";
		$_SESSION['add_n'] = ".....................................................................................................................................";
		$_SESSION['tel_n'] = ".......................";
		$_SESSION['name_n'] = $arr[0];
		$_SESSION['hn_n'] = $_POST['hn'];
	}
	?>
<form action="<? $_SERVER['PHP_SELF']?>" method="POST" name="pdxofyear1">
	<table>
    	<tr>
    	  <td colspan="2" align="center" bgcolor="#FFFF99" class="pdxhead"><strong>�����Ż���ѵ�</strong></td>
   	  </tr>
    	<tr>
        	<td width="336"><span class="pdxhead">����-ʡ�� : 
       	    <?=$_SESSION['name_n']?>
        	</span></td>
            <td width="357">&nbsp;</td>
        </tr>
        <tr>
        	<td><span class="pdxhead">˹��§ҹ : 
                <select name="company">
                  <option value='SCG-����ѷ �ٹ��������� (�ӻҧ) �ӡѴ'>����ѷ �ٹ��������� (�ӻҧ) �ӡѴ</option> 
                </select>
            </span></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">Ẻ��Ǩ�آ�Ҿ : 
            <select name="type">
              <option value='�������� 1 ��ѡ�ҹ�ٹ�ӻҧ/SCG-A(�������������������Сҡ��ʴ����������)'>�������� 1 ��ѡ�ҹ�ٹ�ӻҧ/SCG-A(�������������������Сҡ��ʴ����������)</option>
              <option value='�������� 2 ��ѡ�ҹ�ٹ�ӻҧ(������������)'>�������� 2 ��ѡ�ҹ�ٹ�ӻҧ(������������)</option>
              <option value='�������� 3 ��ѡ�ҹ�ٹ�ӻҧ(�����ʡҡ��ʴ����������)'>�������� 3 ��ѡ�ҹ�ٹ�ӻҧ(�����ʡҡ��ʴ����������)</option>
              <option value='�������� 4 ��ѡ�ҹ����áԨ(������������)'>�������� 4 ��ѡ�ҹ����áԨ(������������)</option>
              <option value='�������� 5 ��ѡ�ҹ����áԨ(�����ʡҡ��ʴ����������)'>�������� 5 ��ѡ�ҹ����áԨ(�����ʡҡ��ʴ����������)</option>
              <option value='�������� 6 ��ѡ�ҹ����áԨ(�����ʽ�蹻ٹ�������,��� Biomass)'>�������� 6 ��ѡ�ҹ����áԨ(�����ʽ�蹻ٹ�������,��� Biomass)</option>
              <option value='�������� 7 ��ѡ�ҹ����áԨ(���������§�ѧ�������ͧ�ѡ÷ӧҹ)'>�������� 7 ��ѡ�ҹ����áԨ(���������§�ѧ�������ͧ�ѡ÷ӧҹ)</option>
              <option value='�������� 8 ��ѡ�ҹ����áԨ(�����ʡҡ�ص��ˡ��������������� ������������§�ѧ�������ͧ�ѡ÷ӧҹ)'>�������� 8 ��ѡ�ҹ����áԨ(�����ʡҡ�ص��ˡ��������������� ������������§�ѧ�������ͧ�ѡ÷ӧҹ)</option>
              <option value='�������� 9 ��ѡ�ҹ����áԨ(������������������������§�ѧ�������ͧ�ѡ÷ӧҹ)'>�������� 9 ��ѡ�ҹ����áԨ(������������������������§�ѧ�������ͧ�ѡ÷ӧҹ)</option>
              <option value='�������� 10 ��ѡ�ҹ����áԨ(�����ʽ�蹻ٹ�������,��� Biomass,���§�ѧ�������ͧ�ѡ÷ӧҹ)'>�������� 10 ��ѡ�ҹ����áԨ(�����ʽ�蹻ٹ�������,��� Biomass,���§�ѧ�������ͧ�ѡ÷ӧҹ)</option>
              <option value='�������� 11 �. ��.���.����� �ҹ�ѭ�Һ��ا�ѡ������ͧ�ѡêش Clinker Production'>�������� 11 �. ��.���.����� �ҹ�ѭ�Һ��ا�ѡ������ͧ�ѡêش Clinker Production</option>
              <option value='�������� 12 ˨�.����.���.�ӻҧ������� 1'>�������� 12 ˨�.����.���.�ӻҧ������� 1</option>
              <option value='�������� 13 ˨�.����.���.�ӻҧ������� 2'>�������� 13 ˨�.����.���.�ӻҧ������� 2</option>
              <option value='�������� 14 ˨�.��պѵ��ӻҧ�����ҧ 1'>�������� 14 ˨�.��պѵ��ӻҧ�����ҧ 1</option>
              <option value='�������� 15 ˨�.��պѵ��ӻҧ�����ҧ 2'>�������� 15 ˨�.��պѵ��ӻҧ�����ҧ 2</option>
              <option value='�������� 16 �.��ҹ�á��繨�������'>�������� 16 �.��ҹ�á��繨�������</option>              <option value='�������� 17 �.��ҹ����ԭ�Ԩ'>�������� 17 �.��ҹ����ԭ�Ԩ</option>
              <option value='�������� 18 ˨�.���ͧ�˹��෤�Ԥ'>�������� 18 ˨�.���ͧ�˹��෤�Ԥ</option>
            </select>
          </span></td>
        </tr>
        <tr>
          <td colspan="2"><span class="pdxhead">�����˵�</span> <input type="text" size="20" name="comment" /></td>
        </tr>
        <tr><td colspan="2" align="center"><input type="submit"  value="   ��ŧ   " name="okselect"/></td></tr>
</table>
</form>
	<?
}elseif(isset($_POST['okselect'])){
        $pic = explode("-",$_POST['company']);
		if($_SESSION['hn_n']=="......................."){
			$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment) value ('','','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."')";
		}else{
			$sql2 = "insert into predxofyear(row_id,hn,ptname,company,type_check,comment) value ('','".$_SESSION['hn_n']."','".$_SESSION['name_n']."','".$_POST['company']."','".$_POST['type']."','".$_POST['comment']."')";
		}
		if(mysql_query($sql2)){
				
		}else{
			echo "�ѹ�֡�����żԴ��Ҵ ��سҺѹ�֡����������";
		}
	?>
<table width="100%"><tr><td>
<table width="87%">
    <tr>
    	<td rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="435" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td rowspan="3" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">��Ǩ������ѹ���..................................����.....................</td>
      </tr>
      </table>
      <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      <strong>1. ��سҡ�͡������<br />
2. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ� <br />
3. ����͵�Ǩ�ú�ءʶҹ����ǡ�سҹ�㺵�Ǩ�آ�Ҿ�觤׹���ʶҹշ�� 6 <br />
4. �������Ѻ��õ�Ǩ�آ�Ҿ �ջѭ�����͢��ʧ��� �Դ����ͺ�������ʶҹշ�� 6</strong></strong></span><br />
<br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$_SESSION['hn_n']?>
        </strong>       ����-ʡ�� : 
      <strong><?=$_SESSION['name_n']?></strong>
      <?=$_SESSION["age_n"]?> �Ţ�ѵû�� :.................................
      </td>
      </tr>
    <tr>
      <td class="pdx">������� :
        <?=$_SESSION['add_n']?>
���Ѿ�� :
<?=$_SESSION['tel_n']?></td>
    </tr>
    <tr>
      <td class="pdx">���ͪҵ� :.................. �ѭ�ҵ� :.................. ��ʹ� :.................. </td>
    </tr>
    <tr>
      <td class="pdx">��������ʹ :................. ʶҹ�Ҿ  [ ] �ʴ [ ] ���� [ ] ����/����� [ ] ���� </td>
    </tr>
    <tr>
      <td class="pdx">�Դ� :................................... ��ô� :................................... ������� :................................... </td>
    </tr>
    <tr>
      <td class="pdx"> ���������ö�Դ����� :.................................................. ����Ǣ�ͧ��...........................���Ѿ��............................</td>
    </tr>
    <tr>
      <td class="pdx">�Է�ԡ���ѡ�� [ ] ����ѷ(��Ҫ�) [ ] ��Сѹ�ѧ�� [ ] �Թʴ [ ] ���� .....................</td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table>
    <tr>
      <td colspan="3" class="pdx"><strong>ʶҹշ�� 1 �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩʶҹչ��ء��</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx">���˹ѡ :.............��. ��ǹ�٧ :.............��. �ä��Шӵ�� :.................................. ���� :........................................................... </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx">T :.................... C � P :...................����/�ҷ� R :....................����/�ҷ� BP :.........../..............mmHg.</td>
      </tr>
      </table></td></tr>
    </table>
    <?
	$ban = explode(" ",$_POST['type']);
    $arrtype = array('��Ǩ x-ray �ʹ','��Ǩ���ö�Ҿ�ʹ','��Ǩ���ö�Ҿ������Թ','��Ǩ˹�ҷ��ͧ�Ѻ','��Ǩ˹�ҷ��ͧ�','��Ǩ��������ó�ͧ������ʹ','��Ǩ�������','��Ǩ����ҳ����˹ѡ');
	?>
<table width="857">
    <tr>
      <td class="pdxpro">&nbsp;</td>
    </tr>
    <tr>
      <td class="pdxpro"><strong>��¡�õ�Ǩ�آ�Ҿ <?=$row['type_check']?></strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<4;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=3;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="5"){
			$q =1;
			for($r=3;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="6"){
			$q =1;
			for($r=0;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="7"){
			$q =1;
			for($r=2;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="8"){
			$q =1;
			for($r=2;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="9"){
			$q =1;
			for($r=2;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="10"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="11"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="12"){
				echo "1. ��Ǩ x-ray �ʹ<br>";
				echo "2. ��Ǩ���ö�Ҿ������Թ";
		}
		elseif($ban[1]=="13"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="14"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="15"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="16"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="17"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="18"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
	  ?></td>
      </tr>
    <tr>
      <td class="pdx"><? if($_POST['comment']==""){ } else{ echo "�����˵� :".$_POST['comment'];}?></td>
    </tr>
    <tr>
      <td class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="2"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br> ��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="3"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="4"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="5"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="6"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="7"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></table>";
		}
		elseif($ban[1]=="8"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="9"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="10"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="11"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="12"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="13"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="14"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="15"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="16"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="17"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="18"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
	  ?></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="pdx">����Ǩ�ͺ.....................................................................</td>
    </tr>
    </table>
</td></tr></table>
	<?
}elseif(isset($_GET['view'])){
	?>
		<script>
           window.print();
      	</script>
	<?
	$sqls = "select * from predxofyear where row_id = '".$_GET['view']."'";
	$datenow = (date("Y")+543).date("-m-d H:i:s");
	$time = date("H:i:s");
	$date = date("d-m-").(date("Y")+543);
	$result = mysql_query($sqls);
	$row = mysql_fetch_array($result);
	$pic = explode("-",$row['company']);
	$ban = explode(" ",$row['type_check']);
    $arrtype = array('��Ǩ x-ray �ʹ','��Ǩ���ö�Ҿ�ʹ','��Ǩ���ö�Ҿ������Թ','��Ǩ˹�ҷ��ͧ�Ѻ','��Ǩ˹�ҷ��ͧ�','��Ǩ��������ó�ͧ������ʹ','��Ǩ�������','��Ǩ����ҳ����˹ѡ');
	$sqlupdate = "update predxofyear SET thidate = '$datenow' where row_id = '".$_GET['view']."'";
	mysql_query($sqlupdate);

	?>
	<table width="100%"><tr><td>
<table width="87%">
    <tr>
    	<td rowspan="4" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="435" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td rowspan="4" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">��Ǩ������ѹ���......<?=$date?>.....����....<?=$time?>...</td>
      </tr>
      </table>
      <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      <strong>1. ��سҡ�͡������<br />
2. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ� <br />
3. ����͵�Ǩ�ú�ءʶҹ����ǡ�سҹ�㺵�Ǩ�آ�Ҿ�觤׹���ʶҹշ�� 6 <br />
4. �������Ѻ��õ�Ǩ�آ�Ҿ �ջѭ�����͢��ʧ��� �Դ����ͺ�������ʶҹշ�� 6</strong></strong></span><br />
<br />
      <table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td class="pdxpro">HN :
        <strong>
        <?=$row['hn']?>
        </strong>       ����-ʡ�� : 
      <strong><?=$row['ptname']?></strong>
      �ѹ/��͹/�� �Դ....................... ���� :...........�� �Ţ�ѵû�� :.................................
      </td>
      </tr>
    <tr>
      <td class="pdx">������� :
        .....................................................................................................................................
���Ѿ�� :
.......................</td>
    </tr>
    <tr>
      <td class="pdx">���ͪҵ� :.................. �ѭ�ҵ� :.................. ��ʹ� :.................. </td>
    </tr>
    <tr>
      <td class="pdx">��������ʹ :................. ʶҹ�Ҿ  [ ] �ʴ [ ] ���� [ ] ����/����� [ ] ���� </td>
    </tr>
    <tr>
      <td class="pdx">�Դ� :................................... ��ô� :................................... ������� :................................... </td>
    </tr>
    <tr>
      <td class="pdx"> ���������ö�Դ����� :.................................................. ����Ǣ�ͧ��...........................���Ѿ��............................</td>
    </tr>
    <tr>
      <td class="pdx">�Է�ԡ���ѡ�� [ ] ����ѷ(��Ҫ�) [ ] ��Сѹ�ѧ�� [ ] �Թʴ [ ] ���� .....................</td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="83%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table>
    <tr>
      <td colspan="3" class="pdx"><strong>ʶҹշ�� 1 �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩʶҹչ��ء��</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx">���˹ѡ :.............��. ��ǹ�٧ :.............��. �ä��Шӵ�� :.................................. ���� :........................................................... </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx">T :.................... C � P :...................����/�ҷ� R :....................����/�ҷ� BP :.........../..............mmHg.</td>
      </tr>
      </table></td></tr>
    </table>

<table width="857">
    <tr>
      <td class="pdxpro">&nbsp;</td>
    </tr>
    <tr>
      <td class="pdxpro"><strong>��¡�õ�Ǩ�آ�Ҿ <?=$_POST['type']?></strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			$q =1;
			for($r=0;$r<4;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="2"){
			$q =1;
			for($r=0;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="3"){
			$q =1;
			for($r=0;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="4"){
			$q =1;
			for($r=3;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="5"){
			$q =1;
			for($r=3;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="6"){
			$q =1;
			for($r=0;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="7"){
			$q =1;
			for($r=2;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="8"){
			$q =1;
			for($r=2;$r<8;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="9"){
			$q =1;
			for($r=2;$r<7;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="10"){
			$q =1;
			for($r=0;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="11"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="12"){
				echo "1. ��Ǩ x-ray �ʹ<br>";
				echo "2. ��Ǩ���ö�Ҿ������Թ";
		}
		elseif($ban[1]=="13"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="14"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="15"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="16"){
			$q =1;
			for($r=1;$r<3;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="17"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
		elseif($ban[1]=="18"){
			$q =1;
			for($r=1;$r<2;$r++){
				echo $q.". ".$arrtype[$r]."<br>";
				$q++;
			}	
		}
	  ?></td>
      </tr>
    <tr>
      <td class="pdx"><? if($row['comment']==""){ } else{ echo "�����˵� :".$row['comment'];}?></td>
    </tr>
    <tr>
      <td class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
      </tr>
    <tr>
      <td class="pdx">
	  <? 
	  	if($ban[1]=="1"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="2"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br> ��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="3"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="4"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="5"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="6"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="7"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></table>";
		}
		elseif($ban[1]=="8"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="9"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 2<br>������ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="10"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="11"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="12"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 5<br>��硫�����<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="13"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="14"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="15"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="16"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 4<br>��Ǩ������Թ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="17"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
		elseif($ban[1]=="18"){
			echo "<table><tr><td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 1<br>�ѡ����ѵ�<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td>";
			echo "<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center'><td>ʶҹ� 3<br>��Ǩ���ö�Ҿ�ʹ<br>����Ѻ�Դ�ͺ<br>.............................</td></tr></table></td></tr></table>";
		}
	  ?></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
    </tr>
    <tr>
      <td align="center" class="pdx">����Ǩ�ͺ.....................................................................</td>
    </tr>
    </table>
</td></tr></table>
	<?
}elseif(isset($_GET['stricker'])){
	$sqls = "select * from predxofyear where row_id = '".$_GET['stricker']."'";
	$result = mysql_query($sqls);
	$row = mysql_fetch_array($result);
	$pic = explode("-",$row['company']);
	echo "<span class='stricker1'>".$pic[1]."</span><br>";
	?>
	<span class='stricker'><strong>HN:<?=$row['hn']?></strong></span><br />
    <span class='stricker'><strong>����:<?=$row['ptname']?></strong></span><br />
	<span class='stricker1'><?=$row['type_check']?></span>
    <script>
    window.print();
    </script>
<?
}
include("unconnect.inc");

?>
</body>
</html>