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
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 14px
}
</style>
<!--<script>window.print();</script>-->
<?
$_GET["part"]="�ͺ���Ǩ58-2";
$showpart="�ͺ���Ǩ 2558";
if(isset($_GET['part'])){
	$sql = "select hn,yot,name,surname,idcard,dbirth,agey,agem,exam_no,datechkup  from opcardchk where part = '".$_GET['part']."' order by row asc limit 300,260";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$birth_n= "�ѹ/��͹/���Դ :.....".$arr['dbirth']."......";
	$age2_n= "���� :..........".$arr['agey'].".........��";
		
	$add_n="............................................................................................................";
	$tel_n="..............................................";
	$name_n= $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
	$hn_n= $arr['hn'];
	$runno= substr($arr['hn'],4,3);
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$exam_no= $arr['exam_no'];
	$idcard =$arr['idcard'];
	$prog=$arr['exam_no'];
	$datechkup=$arr['datechkup'];
?> 
<div align="center" style="width: 99%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style='line-height:18px'>
        <td width="12%" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="82%" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">Ẻ��õ�Ǩ�آ�Ҿ
          <?=$showpart;?>
        </span></span></strong></td>
        <td width="6%" rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=$runno;?></div>
        </span></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead">��Ǩ�ѹ��� <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�&nbsp;&nbsp;
	   2.���͡��á�õ�Ǩ���ʶҹ�ŧ����¹</span><br />
       <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?>
                   </strong>����-ʡ�� : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   �Ţ��Шӵ���ͺ : <strong>
                     <?=$exam_no;?>
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">������� :
                   <?=$add_n;?>
                   &nbsp;���Ѿ�� :
                   <?=$tel_n;?>�������ᾷ��</td>
               </tr>
               <tr>
                 <td align="left" class="pdx">���˹ѡ...................��. ��ǹ�٧.....................��. BP................./.............. P...............����/�ҷ�</td>
               </tr>
           </table></td>
         </tr>
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
         <td class="pdxpro" colspan="2" align="left"><strong>��¡�õ�Ǩ�آ�Ҿ
           <!--<?//=$_POST['company']?>-->
           <? //$pro;?>
         </strong></td>
       </tr>
       <?
/*			$q =1;
			for($r=0;$r<count($arrtype2);$r++){
				echo "<tr style='line-height:15px'><td class='pdx'>".$q.". ".$arrtype2[$r]."</td><td class='pdx'>[  ]</td></tr>";
				$q++;
			//	$sumpri+=$arrprice2[$r];
			}	*/
			//$sumpri = number_format(($sumpri2+250),2);
			echo "<tr style='line-height:12px'><td class='pdx' align='center'>��Ǩ�آ�Ҿ</td><td class='pdx'>�Ҥ�&nbsp;&nbsp;800.00 �ҷ</td></tr>";
	
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
			echo "<tr style='line-height:12px'><td class='pdx' align='center'>��Һ�ԡ��&nbsp;&nbsp;&nbsp;&nbsp;</td><td class='pdx'>�Ҥ�&nbsp;&nbsp;100.00 �ҷ</td></tr>";
			echo "<tr style='line-height:12px'><td class='pdx' align='center'><B>���</B></td><td class='pdx'><B>�Ҥ� 900.00 �ҷ</B></td>";
	?>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2"><table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 1 <br />
                       ŧ����¹/�����Թ<br />
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
                     �Ѵ�����ѹ���Ե<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 5<br />
X-RAY<br />
���˹�ҷ��<br />
.............................</td>
                   </tr>
               </table></td>               
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td>ʶҹ� 6<br />
                     �׹�͡���㺹ӷҧ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                              
             </tr>
         </table>
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong>*** �����˵� ***</strong><br />
    - ����ʵ�������蹷���դ���� STOOL  �Դ�Ѻ�ͧ��лء����纵�����ҧ�ب����������º���� ��͹�������˹�ҷ��<br />
    - ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� ���͡����觤׹���˹�ҷ�� � �شŧ����¹ <br />
    - ��س����ҷ��͡���㺹ӷҧ��� ���ѹ�索Ҵ</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    