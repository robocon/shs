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
.pdxhead1 {
	font-family: "TH SarabunPSK";
	font-size: 20pt;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.subpdx {
	font-family: "TH SarabunPSK";
	font-size: 16pt;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}

hr {
  height: 2px;
  width: 100%;
  color: #000000;
  background-color: #000;
}
</style>
<!--<script>window.print();</script>-->
<?
$_GET["part"]="����Ե������Ԥ60";
$showpart="����Ե������Ԥ60";
if(isset($_GET['part'])){
	$sql = "select *  from opcardchk where part = '".$_GET['part']."' order by row asc limit 600,100";
	$result = mysql_query($sql);
while($arr = mysql_fetch_array($result)){
	
	$name_n= $arr['name']." ".$arr['surname'];
	$hn_n= $arr['HN'];
	$runno= sprintf("%03d",$arr['pid']);
	$pid=$arr['pid'];
	//echo "===>".$runno."<br>";
	$idcard_n= $arr['idcard'];
	$exam_no= $arr['exam_no'];
	$idcard =$arr['idcard'];
	$course=$arr['course'];
	$datechkup=$arr['datechkup'];
?> 
<div align="center" style="width: 99%;">
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="12%" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
        <td width="82%" align="center" class="pdx">
			<strong>
				<span class="pdx">
					<span class="pdxhead1">�͡���㺹ӷҧ��õ�Ǩ�آ�Ҿ (��سҹ����ʴ�����������ԡ��)</span>
				</span>
			</strong>
		</td>
        <td width="6%" rowspan="3" align="right" valign="top"><span class="pdx"><img src ="barcode/labstk.php?cHn=<?=$hn_n;?>" alt="" /><br />
             <div style="font-size:36px;"><?=$exam_no;?></div>
        </span></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305-6 ��� 1132</strong></td>
      </tr>
      <tr>
        <td align="center" class="pdxhead">˹��§ҹ : <?=$showpart;?>  <strong>(<?=$course;?>)</strong>&nbsp;&nbsp;��Ǩ�ѹ��� <?=$datechkup;?></td>
      </tr>
    </table>
 <hr>
 
 
       <table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#666666">
         <tr>
           <td><table width="100%">
               <tr>
                 <td width="69%" align="left" class="pdx"><strong>����-ʡ�� : 
                     <?=$name_n." [$pid]";?> 
&nbsp;&nbsp;HN :
<?=$hn_n;?>
&nbsp;&nbsp;</strong>���Ѿ�� : ...............................................</td>
               </tr>	   
			   <tr>
                 <td align="left" class="pdx">���˹ѡ...........................��. ��ǹ�٧..............................��. BP....................../...................... T.........................</td>
               </tr>
			   <tr>
                 <td align="left" class="pdx">P....................����/�ҷ� R....................����/�ҷ� �ä��Шӵ��...........................................................................</td>
               </tr>
			   <tr>
                 <td align="left" class="pdx">�ٺ������.......................... ��������......................... �͡���ѧ���......................... ����.......................................</td>
               </tr>
           </table></td>
         </tr>
       </table>      
     <table width="756">
       <tr>
         <td colspan="2" align="left" class="pdx"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
       </tr>
       <tr>
         <td class="pdx" colspan="2">
         <!-------- ʶҹյ�Ǩ  ----------->
			<table>
             <tr style='line-height:24px'>
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                   <tr align='center' style='line-height:24px'>
                     <td><strong>ʶҹ� 1</strong> <br />
                       �شŧ����¹<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                   </tr>
               </table></td>              
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>ʶҹ� 2</strong><br />
                       ��Ǩ���ʹ/�������<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
               <td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>ʶҹ� 3</strong><br />
                       ��Ǩ X-RAY<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>
				<td><table width='160' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
                 <tr align='center' style='line-height:24px'>
                     <td><strong>ʶҹ� 4</strong><br />
                       ��Ǩ�Ѵ�ѭ�ҳ�վ<br />
                       ���˹�ҷ��<br />
                       .............................</td>
                 </tr>
               </table></td>			   
             </tr>
         </table>  
         </td>
       </tr>
     </table>
     </td>
  </tr>
</table>
<p class="subpdx" align="left"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
      1. �������Ѻ��õ�Ǩ�آ�Ҿ�������Ѻ��õ�Ǩ���ú���ʶҹշ���˹�&nbsp;&nbsp;
	   2.���͡���㺹ӷҧ���ʶҹ��ش���·�����ԡ��</p><br />
</div>
    
 <?
	echo "<br>";
	echo "<div style='page-break-after:always'></div>";	  
	}
}
?>    