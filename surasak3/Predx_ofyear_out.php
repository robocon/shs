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
<title>㺹ӷҧ��Ǩ�آ�Ҿ�͡˹���</title>
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
.style1 {
	font-size: 24px;
	font-weight: bold;
}
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 14px
}
</style>
</head>

<body>
<? if(!isset($_GET['view'])&!isset($_GET['stricker'])){?>
<div id="no_print" > 
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<center>
  <font class="pdxhead"><strong>㺹ӷҧ��Ǩ�آ�Ҿ��Шӻ�</strong></font>
</center>
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr><td width="480" align="center" bgcolor="#FFFF99"><strong>��͡������ HN </strong></td></tr>
  <tr>
    <td>HN : 
      <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <!--<input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
  <tr><td>���� - ʡ�� : <input name="namep" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td></tr>
  <tr>
    <td>���ʺѵû��.
      <input name="idcard" type="text" size="20" class="pdxhead"  />-->
      </td>
  </tr>
<tr>
    <td>����� : 
      <select name="pro" class="pdxpro">
      <option value="1">�����1</option>
      <option value="2">�����2</option>
      <option value="3">�����3</option>
      <option value="4">�����4</option>
      </select></td>
  </tr>
  <tr>
    <td align="center"><input type="submit"  value="   ��ŧ   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
<!--<br />
<a href="search_dxofyear.php" target="_blank">****���Ҩҡ����-ʡ��****</a>
<br />
<a href="pdx_ofyear2.php">****˹���á��Ǩ�آ�Ҿ��Шӻ�****</a>-->
<br />

</form>
</div>

<?
}
//// select hn,concat(yot,' ',name,' ',surname) as ptname,idcard,dbirth,concat(address,' ',tambol,' ',ampur,' ',changwat) as address,phone from opcard   �ͧ���

if(isset($_POST['okhn'])){
	if($_POST['hn']!=""){
		$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem,exam_no  from opcardchk where hn = '".$_POST['hn']."' and part='����ҳ�58' ";
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
			$_SESSION['exam_no'] = $arr['exam_no'];
		$idcard =$arr['idcard'];
		
		$prog=$arr['exam_no'];
	}/*elseif($_POST['idcard']!=""){
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
 <div id="no_print" >  <a href ="../nindex.htm" >**** &lt;&lt; ����****</a> &nbsp;&nbsp;<a href="Predx_ofyear_sticker.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>&exam_no=<?=$_SESSION['exam_no']?>" target="_blank">�����ʵԡ����</a>&nbsp;&nbsp;<a href="Predx_ofyear_stickerstool.php?name=<?=$_SESSION['name_n']?>&idcard=<?=$_SESSION['idcard_n']?>&hn=<?=$_SESSION['hn_n']?>&pro=<?=$_POST['pro'];?>" target="_blank">ʵԡ���� STOOL</a>  <a href="Predx_ofyear_out22.php?&hn=<?=$_SESSION['hn_n']?>" target="_blank">㺵�Ǩ����移ҡ���١</a></div>
    <script>
    window.print();
    </script>
<table width="100%"><tr><td>
<table width="98%">
    <tr style='line-height:18px'>
      <td width="126" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
      <td width="687" align="center" class="pdxhead"><span class="style1">&nbsp;Ẻ��õ�Ǩ�آ�Ҿ �ç���¹�ӻҧ����ҳ�</span></td>
      <td width="13" rowspan="3" align="center" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$_SESSION['hn_n'];?>" alt="" /><br />
          <?=$_SESSION['hn_n'];?>
      </span></td>
    </tr>
    <tr style='line-height:18px'>
      <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
    <tr style='line-height:18px'>
      <!--<td align="center" class="pdxhead">��Ǩ������ѹ���...<?=date("d-m-").(date("Y")+543)?>...����...<?=date("H:i:s")?>....</td>-->
      <td align="center" class="pdxhead">�ӡ�õ�Ǩ �ѹ��� 16 �չҤ� 2558 </td>
      </tr>
    </table>
<span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�&nbsp;&nbsp;
	   2.���͡��á�õ�Ǩ���ʶҹ�ŧ����¹</span><br />
      <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table width="100%">
    <tr>
      <td width="69%" class="pdx">HN :
        <strong>
          <?=$_SESSION['hn_n']?>
          </strong>����-ʡ�� : 
        <strong><?=$_SESSION['name_n']?></strong>
        <?=$_SESSION["age2_n"]?> <!--ID : <?//=$_SESSION["idcard_n"]?>-->      </td>
      </tr>
    <tr>
      <td class="pdx">������� :
        <?=$_SESSION['add_n']?>&nbsp;���Ѿ�� :
  <?=$_SESSION['tel_n']?>&nbsp;�������ᾷ��</td>
      </tr>
    <tr>
      <td class="pdx">���˹ѡ................��. ��ǹ�٧.....................��. BP................/.............. P..............����/�ҷ� ���˹�ҷ��.........................</td>
      </tr>
      </table>
      </td></tr>
    </table>
    <?
$arrtype = array('��Ǩ x-ray �ʹ','CBC(��Ǩ��������ó�ͧ������ʹ)','UA(��Ǩ�������)','��ѹ(CHOL,TRI)','����ҹ(BS)','��Ǩ˹�ҷ��ͧ�Ѻ(SGOT,SGPT,ALK)','��Ǩ˹�ҷ��ͧ�(BUN,CR)','��ҷ�(URIC)');
$arrprice = array('560','90.00','50.00','120.00','40.00','150.00','100.00','60.00');

//$arrtype1 = array('��ӵ������ʹ(BS)','��ѹ����ʹ (CHOL)','��Ǩ��÷ӧҹ�ͧ�(CR)','��Ǩ��÷ӧҹ�ͧ�Ѻ(SGOP,SGOT)');
if($prog==1){
$arrtype2= array('��Ǩ��ҧ��·������ᾷ��(PE)','��Ǩ��������ó�ͧ������ʹ (CBC)','��Ǩ�����������ó�Ẻ (UA)','X-ray (������˭�)');
	
	$pro="��������1 (���ع��¡��� 35 ��) ";
	$p="P1";
}elseif($prog==2){


$arrtype2= array('��Ǩ��ҧ��·������ᾷ��(PE)','��Ǩ��������ó�ͧ������ʹ (CBC)','��Ǩ�����������ó�Ẻ (UA)','X-ray (������˭�)','����(����Ѻ���˭ԧ��ԡ�÷���ç��Һ��)','��Ǩ����移ҡ���١(����Ѻ���˭ԧ��ԡ�÷���ç��Һ��)');
$pro="��������2 (���ع��¡��� 35 ��) ";
$p="P2";

}else if($prog==3){
$arrtype2= array('��Ǩ��ҧ��·������ᾷ��(PE)','��Ǩ��������ó�ͧ������ʹ (CBC)','��Ǩ�����������ó�Ẻ (UA)','X-ray (������˭�)','��Ǩ��ӵ������ʹ(FBS)','��õ�Ǩ���дѺ�ô���Ԥ (Uric)','��Ǩ��÷ӧҹ�ͧ�Ѻ(SGOP,SGOT)','��Ǩ��÷ӧҹ�ͧ�(CR,BUN)','��Ǩ��ѹ����ʹ(CHOL,TRI)');

	
	$pro="��������3 (�����ҡ���� 35 ��)  ";
	$p="P3";
}else if($prog==4){
$arrtype2= array('��Ǩ��ҧ��·������ᾷ��(PE)','��Ǩ��������ó�ͧ������ʹ (CBC)','��Ǩ�����������ó�Ẻ (UA)','X-ray (������˭�)','��Ǩ��ӵ������ʹ(FBS)','��õ�Ǩ���дѺ�ô���Ԥ (Uric)','��Ǩ��÷ӧҹ�ͧ�Ѻ(SGOP,SGOT)','��Ǩ��÷ӧҹ�ͧ�(CR,BUN)','��Ǩ��ѹ����ʹ(CHOL,TRI)','����(����Ѻ���˭ԧ��ԡ�÷���ç��Һ��)','��Ǩ����移ҡ���١(����Ѻ���˭ԧ��ԡ�÷���ç��Һ��)');

	
	$pro="��������4 (�����ҡ���� 35 ��)  ";
	$p="P4";
}
//$arrprice2 = array('','90.00','50.00','170.00','40.00','60.00','100.00','50.00','60.00','');
	?>
<table width="756">
    <tr>
      <td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ <!--<?//=$_POST['company']?>--> <?="�����$pro";?></strong></td>
    </tr>
    <tr>
      <td class="pdx" colspan="2"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
      </tr>
    <tr>
      <td class="pdx" colspan="2"><table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 1 <br />
                       ŧ����¹<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 2<br />
                       ��Ǩ�������<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 3<br />
                       ��Ǩ���ʹ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 4<br />
                       XRAY<br />
                       ���˹�ҷ��<br />
                    .............................</td>
                 </tr>
               </table></td>               
             </tr>
        </table></td>
    </tr>
</table>
	<?
}
	
	?>
    <div class="style2" style="margin-left:10px;">* �ӡ�õ�Ǩ�ú�ءʶҹ����� ���͡����觤׹���˹�ҷ�� � �شŧ����¹</div>
</body>
</html>