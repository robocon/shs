<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>�����㺹ӷҧ��Ǩ�آ�Ҿ</title>
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
	font-size: 14pt;
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
	font-size: 16px
}
@media print{
	#none_print { display:none;}
}
</style>
<!--<script>window.print();</script>-->
<div id="none_print">
<p align="center"><strong>�����㺹ӷҧ��Ǩ�آ�Ҿ �.�ԵҪ�</strong></p>
</div>
<?
$part="�ԵҪ�60";
$showpart="�ԵҪ� 2560";
	$sql = "select *  from opcardchk where part = '".$part."' order by row asc";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$birth_n= "�ѹ/��͹/���Դ :.....".$arr['dbirth']."......";
	$age2_n= "���� :..........".$arr['agey'].".........��";
		
	$add_n=".................................................................................................................................................";
	$tel_n="...........................................................";
	$name_n= $arr['name'].' '.$arr['surname'];
	$hn_n= $arr['HN'];
	$runno= $arr['exam_no'];
	$age= $arr['agey'];
	$idcard =$arr['idcard'];
	$pro=$arr['pid'];
	$datechkup=$arr['datechkup'];
?> 
<div align="center" style="width: 99%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr style='line-height:18px'>
        <td width="12%" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="82%" align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">㺹ӷҧ��õ�Ǩ�آ�Ҿ
          <?=$showpart;?>
        </span></span></strong></td>
        <td width="6%" rowspan="3" align="right" valign="top"><div class="pdx" style="margin-right: 10px;"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=sprintf("%03d",$runno);?></div>
        </div></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305 ��� 6701</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead">��Ǩ�ѹ��� <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�&nbsp;&nbsp;
	   2.���͡��á�õ�Ǩ���ش�ѡ����ѵ�</span><br />
       <table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?>
                   </strong>����-ʡ�� : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   ���� : <strong>
                     <?=$age;?> ��
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
               </tr>
               <tr>
                 <td align="left" class="pdx">���˹ѡ...................��. ��ǹ�٧.....................��.   P...............����/�ҷ� BP................./..............mmHg</td>
               </tr>
           </table></td>
         </tr>
       </table>       
     <table width="99%">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>��¡�õ�Ǩ�آ�Ҿ����� ��� <?=$pro;?> (���¡��)
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
		<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td height="80">��ͧ��Ҹ�<br />
                       ������ʹ/�������<br />
���˹�ҷ��<br />
<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td height="80">��ͧ XRAY<br />
                       XRAY<br />
                       ���˹�ҷ��<br />
                       <br />
                       .............................<br /></td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td height="80">OPD �ѡ����ѵ�<br />
                       �Ѵ�����ѹ���Ե<br />
                       ���˹�ҷ��<br />
                       <br />
                       .............................</td>
                 </tr>
               </table></td>
               <td>&nbsp;</td>
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
    - ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� <strong>���͡����觤׹���˹�ҷ�� � �ش�ѡ����ѵ� </strong><br />
    - ��س����ҷ��͡���㺹ӷҧ��� ���ѹ�索Ҵ</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
?>    