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
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>Untitled Document</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 14pt;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 12pt;
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


<?



		$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem,exam_no  from opcardchk where hn = '".$_GET['hn']."' and part='����ҳ�' ";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
	//	$bdate = explode("-",$arr['dbirth']);
		//$_SESSION["age_n"] = "�.�.�. �Դ...".$arr['dbirth']." ";
		$_SESSION["age2_n"] = "���� :.".$arr['agey']." ��";
		
		$_SESSION['add_n'] ="...............................................................................................................";
 		$_SESSION['tel_n']="..............................";
		$_SESSION['name_n'] = $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
		$idcard =$arr['idcard'];
		
		$prog=$arr['exam_no'];
/*elseif($_POST['idcard']!=""){
		$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem from opcardchk where hn = '".$_POST['hn']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
	//	$bdate = explode("-",$arr['dbirth']);
	$_SESSION["age_n"] = "�.�.�. �Դ...".$arr['dbirth']."... ���� :.".$arr['agey'].".��";
	//	$_SESSION["age_n2"]=calcage($arr['dbirth']);
	    $_SESSION['add_n'] =".........................................";
	//	$_SESSION['tel_n'] = $arr['phone'];
		$_SESSION['name_n'] = $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
		$_SESSION['hn_n'] = $arr['hn'];
		$_SESSION['idcard_n'] = $arr['idcard'];
	}*/

	?>
 <div id="no_print" >  <a href ="../nindex.htm" >**** &lt;&lt; ����****</a> &nbsp;&nbsp;<a href="Predx_ofyear_sticker.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>" target="_blank">�����ʵԡ����</a>&nbsp;&nbsp;<a href="Predx_ofyear_stickerstool.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>&pro=<?=$_POST['pro'];?>" target="_blank">ʵԡ���� STOOL</a></div>
    <script>
    window.print();
    </script>
<table width="100%"><tr><td>
<table width="98%">
    <tr style='line-height:18px'>
    	<td width="126" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td width="687" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">Ẻ��õ�Ǩ����移ҡ���١ �ç���¹�ӻҧ����ҳ�  	  
   	    <?=$_POST['company']?></span></span></strong></td>
        <td width="13" rowspan="3" align="center" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$_SESSION['hn_n'];?>" alt="" /><br /><?=$_SESSION['hn_n'];?>
        </span></td>
    </tr>
    <tr style='line-height:18px'>
      <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
    <tr style='line-height:18px'>
      <!--<td align="center" class="pdxhead">��Ǩ������ѹ���...<?=date("d-m-").(date("Y")+543)?>...����...<?=date("H:i:s")?>....</td>-->
      <td align="center" class="pdxhead">��Ǩ������ѹ��� 25 �չҤ� 2557 </td>
      </tr>
      </table>
      <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ����Ѻ��ԡ�÷���ͼ������ٵ� <br />
      2. ���˹�ҷ���ç��Һ��������͡��á�õ�Ǩ�����Ἱ�
      </span><br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table width="100%">
    <tr>
      <td width="69%" class="pdx">HN :
        <strong>
          <?=$_SESSION['hn_n']?>
          </strong>����-ʡ�� : 
        <strong><?=$_SESSION['name_n']?></strong>
        <?=$_SESSION["age2_n"]?> <!--ID : <?//=$_SESSION["idcard_n"]?>-->
      </td>
      </tr>
    <tr>
      <td class="pdx">������� :
        <?=$_SESSION['add_n']?>&nbsp;���Ѿ�� :
  <?=$_SESSION['tel_n']?>&nbsp;�������ᾷ��</td>
      </tr>
      </table>
      </td></tr>
    </table>

<table width="756">
    <tr>
      <td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ <!--<?//=$_POST['company']?>--> <?=$pro;?></strong></td>
    </tr>
    <?
	
				echo "<tr style='line-height:15px'><td class='pdx'>��Ǩ����移ҡ���١</td><td class='pdx'>[  ]</td></tr>";
				echo "<tr style='line-height:15px'><td class='pdx'>��Ǩ����</td><td class='pdx'>[  ]</td></tr>";

			//$sumpri = number_format(($sumpri2+250),2);
			//echo "<tr style='line-height:12px'><td class='pdx' align='center'> ��ҵ�Ǩ</td><td class='pdx'>�Ҥ� 1,020.00 �ҷ</td></tr>";
	
/*if(!empty($idcard)){
					
$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				echo"<FONT SIZE='2' COLOR='#0000FF'><BR>&nbsp;&nbsp;���Է�Ի�Сѹ�ѧ�� �.�.����</FONT>";
			}else{
				echo"<FONT SIZE='2' COLOR='#0000FF'><BR>&nbsp;&nbsp;������Է�Ի�Сѹ�ѧ��</FONT>";
			}
	}else{
			echo"<FONT SIZE='5' COLOR='#0000FF'><BR>&nbsp;&nbsp;��Ǩ�ͺ�ҹ�����ż�����������Ţ��Шӵ�ǻ�ЪҪ�</FONT>";
		}*/
		//	echo "<tr style='line-height:12px'><td class='pdx' align='center'> ��Һ�ԡ��</td><td class='pdx'>�Ҥ� 100.00 �ҷ</td></tr>";
		//	echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� 1100.00 �ҷ</B></td>";
	?>
    <tr>
      <td class="pdx" colspan="2"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
      </tr>
    <tr>
      <td class="pdx" colspan="2">
      
<table>
<tr style='line-height:16px'>
<td>
  <table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'>
  <td>�ͼ������ٵ�<br>
    ���˹�ҷ��<br>.............................</td>
  </tr>
  </table>
</td>
	</tr>
</table>
</td></tr>
</table>


</body>
</html>