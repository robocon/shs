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
<title>�����㺹ӷҧ��Ǩ�آ�Ҿ����Է������ǹ���Ե 2560</title>
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
	font-size: 18px
}
@media print{
	#none_print { display:none;}
}
.style3 {
	color: #FFFF00
}
.style4 {color: #0000FF}
</style>
<!--<script>window.print();</script>-->
<?

$series=$_POST["series"];
$part="�ǹ���Ե60";
$showpart="����Է������ǹ���Ե 2560";
	$sql = "select HN,yot,name,surname,idcard,dbirth,agey,agem,exam_no,pid,datechkup  from opcardchk where part = '".$part."' and HN='60138' order by row asc";
	$result = mysql_query($sql);
	$i=300;
while($arr = mysql_fetch_array($result)){
	$i++;
	
	$birth_n= "�ѹ/��͹/���Դ :.....".$arr['dbirth']."......";
	$age2_n= "���� :..........".$arr['agey'].".........��";
		
	$add_n=".................................................................................................................................................";
	$tel_n="...........................................................";
	$name_n= $arr['yot'].' '.$arr['name'].' '.$arr['surname'];
	$hn_n= $arr['idcard'];
	$runno= $arr['exam_no'];
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$programe= $arr['pid'];
	$hn=$arr['HN'];
	$prog=$arr['exam_no'];
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
        <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
      </tr>
      <tr style='line-height:18px'>
        <td align="center" class="pdxhead">��Ǩ�ѹ��� <?=$datechkup;?></td>
      </tr>
    </table>
    <span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�&nbsp;&nbsp;
	   2.���͡��á�õ�Ǩ���ʶҹ�ŧ����¹</span><br />
       <table width="99%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="86%" align="left" class="pdx">HN : <strong>
                   <?=$hn_n;?></strong>
                   &nbsp;&nbsp;&nbsp;
                   HN XRAY : <strong>
                     <?=$hn;?></strong>
                     &nbsp;&nbsp;&nbsp;����-ʡ�� : <strong>
                     <?=$name_n;?>
                     </strong>&nbsp;&nbsp;&nbsp;
                   �ӴѺ LAB : <strong>
                     <?="170110".$i;?>
                     </strong>
                   <!--ID : <?//=$_SESSION["idcard_n"]?>-->                 </td>
                 <? if($programe==2){ ?>
                 <td width="7%" rowspan="2" align="left" bordercolor="#FFFF00" bgcolor="#FFFF00"><img src="images/bg-yellow.jpg" width="90" height="52" /></td>
                 <? }else if($programe==3){ ?>
                  <td width="7%" rowspan="2" align="left" bordercolor="#0000FF" bgcolor="#0000FF"><img src="images/bg-blue.jpg" width="90" height="52" /></td>
                  <? } ?>
               </tr>
               <tr>
                 <td height="23" align="left" class="pdx">���˹ѡ...................��. ��ǹ�٧.....................��. BP................./.............. P...............����/�ҷ�</td>
                </tr>
           </table></td>
         </tr>
       </table>     
     <table width="99%">
       <tr>
         <td class="pdxpro" colspan="2" align="left"><strong>��¡�õ�Ǩ�آ�Ҿ
           <!--<?//=$_POST['company']?>-->
           �������� <?=$programe;?>
         </strong></td>
       </tr>
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
<? if($programe==1){ ?>         
         <table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 1</strong><br />
                     �Ѻ㺹ӷҧ<br />
���˹�ҷ��<br />
.............................</td>
                   </tr>
               </table>
               
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 2 </strong><br />
                       �Ѵ�����ѹ���Ե<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 3</strong><br />
                     ������ʹ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 4</strong><br />
                     XRAY<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 5</strong><br />
                     ��Ǩ��<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 6</strong><br />
                       �׹�͡���㺹ӷҧ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
             </tr>
         </table>
<? }else if($programe==2){ ?>  
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 1</strong><br />
�Ѻ㺹ӷҧ<br />
���˹�ҷ��<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 2 </strong><br />
�Ѵ�����ѹ���Ե<br />
���˹�ҷ��<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 3</strong><br />
������ʹ<br />
���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 4</strong><br />
                       Swab Test<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 5</strong><br />
                     XRAY<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 6</strong><br />
                     ��Ǩ��<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>               
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 7</strong><br />
                     �׹㺹ӷҧ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                                              
             </tr>
         </table>
<? }else if($programe==3){ ?>  
<table>
             <tr style='line-height:16px'>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 1</strong><br />
�Ѻ㺹ӷҧ<br />
���˹�ҷ��<br />
.............................</td>
                   </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 2 </strong><br />
�Ѵ�����ѹ���Ե<br />
���˹�ҷ��<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 3</strong><br />
������ʹ<br />
���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 4</strong><br />
                       XRAY<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 5</strong><br />
                     ��Ǩ EKG<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>
               <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 6</strong><br />
                     ��Ǩ��<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>               
              <td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:16px'>
                     <td><strong>ʶҹ� 7</strong><br />
                     �׹㺹ӷҧ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table>
               </td>                                              
                                            
             </tr>
         </table>
<? } ?>              
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
</div>
    <div class="style2" style="margin-left:10px;"><strong>*** �����˵� ***</strong><br />
    - XRAY ��Ǩ��� <strong>ö XRAY �ʹ�������ҧ��ͧ CMS ��ѧ��ͧ��Ъ�� 1 </strong><br />
    <? if($programe==2){ ?>  
    - Swab Test ��Ǩ��� <strong>��ͧ��Ǩ�ٵԹ����Ǫ</strong><br />
    <? }else if($programe==3){ ?>  
    - EKG ��Ǩ��� <strong>��ͧ��Ǩ��</strong><br />
    <? } ?>
    - ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� <strong>��سҹ��͡���㺹ӷҧ�觤׹���˹�ҷ�� � �شŧ����¹ ��ͧ��Ъ�� 1</strong><br />
    - ��س����ҷ��͡���㺹ӷҧ��� ���ѹ�索Ҵ</div>
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
}
?>    