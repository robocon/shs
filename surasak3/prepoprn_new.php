<?php
include 'bootstrap.php';

$vat_type = $_GET['vat'];
$type = $_GET['type'];
if( $type === 'drug' ){
	$type_txt = '��';
}else if( $type === 'supply' ){
	$type_txt = '�Ǫ�ѳ��';
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PO 3 � - <?=$type_txt;?>���VAT<?=( $vat_type == 'after' ? '��ѧ' : '��͹' );?></title>
</head>
<body>
<script>
	ie4up=nav4up=false;
	var agt = navigator.userAgent.toLowerCase();
	var major = parseInt(navigator.appVersion);
	if ((agt.indexOf('msie') != -1) && (major >= 4))
		ie4up = true;

	if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
		nav4up = true;
</script>
<style type="text/css">
*{
	font-family: TH SarabunPSK;
}
.clearfix:after{
    content: "";
    display: table;
    clear: both;
}
body{
	margin: 0;
	padding: 0;
}

.f1{
	font-size:18px;
	text-decoration:underline;
	font-weight:bold;
}

.ie7{
	position: relative; 
	width: 21cm; 
	height: 27cm; 
}

A {text-decoration:none}
A IMG {border-style:none; border-width:0;}
/* DIV {position:absolute; z-index:25;} */
.fc1-0 { COLOR:000000;FONT-SIZE:13PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.fc1-1 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-2 { COLOR:000000;FONT-SIZE:23PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-3 { COLOR:000000;FONT-SIZE:19PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:BOLD;}
.fc1-4 { COLOR:000000;FONT-SIZE:14PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.fc1-5 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:TH SarabunPSK;FONT-WEIGHT:NORMAL;}
.ad1-0 {border:0PX none 000000; }
.ad1-1 {border-left:0PX none 000000; border-right:0PX none 000000; border-top:1PX dashed 000000; border-bottom:0PX none 000000; }
.ad1-2 {border-left:1PX dashed 000000; border-right:0PX none 000000; border-top:0PX none 000000; border-bottom:0PX none 000000; }
.ad1-3 {border:1PX dashed 000000; }

.page1 div,
.page3 div{
	position: absolute;
	z-index:25;
}
.page1,
.page2{
	page-break-after: always;
}

</style>
<?php
//function baht///
function baht($nArabic){
	
    $nArabic = number_format($nArabic, 2, '.', ''); 
    $cTarget = Ltrim($nArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1,2);
   $nUnit=$x;
   $nNum=$nUnit;
   $cRead  = "(";

include("connect.inc");
 
 IF ($cLtnum <> "0"){
  $count=0;
  For ($i = 0;$i<=$nNum;$i++){
    $cNo   = Substr($cLtnum,$count,1);

     $count++;
//��ҹ��ѡ
    IF ($cNo <>0 and $cNo != "-"){
      If ($nUnit <> 1){  

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$nUnit' ";
		  
          $result = mysql_query($query) or die("Query 1 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

        $cVarU = $row->fld4;  //��ҹ��ѡ
                }
      Else {
        $cVarU = "";
              }

//��ҹ�Ţ
          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
		 
		   
          $result = mysql_query($query) or die("Query 2 failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

      $cVar1 = $row->fld2; //��ҹ����Ţ
///           
if ($nUnit =='2' && $cNo =='2'):
   $cVar1 = "���";
elseif ($nUnit == '2' && $cNo=='1'):
         $cVar1 =  "";
elseif ($nUnit =='1' && $cNo =='1' && $nNum <> 1 ):
          $cVar1 = "���";
else:
   echo "";
endif; 

      $cRead  = $cRead.$cVar1.$cVarU;
	  
        }
      $nUnit--;
            }
$cRead = $cRead."�ҷ";
	}
////Stang////  
  IF ($cRtnum <> "00"){
    $nUnit = 2;
    $count=0;
    For ($i = 0;$i<=2;$i++){  
      $cNo = Substr($cRtnum,$count,1);
      $count++;
      If ($cNo != "0"){

          $query = "SELECT * FROM thaibaht WHERE fld1 = '$cNo' ";
          $result = mysql_query($query) or die("Query failed");

          for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
          if (!mysql_data_seek($result, $i)) {
              echo "Cannot seek to row $i\n";
              continue;
          }

           if(!($row = mysql_fetch_object($result)))
               continue;
         }

         $cVar1 = $row->fld2 ;
         /////
         If ($nUnit == '2' && $cNo == '2'){
            $cVar1 = "���";
            }
         if ($nUnit == '2' && $cNo == '1'){
            $cVar1 = "" ;
             }   
         if ($nUnit == '1' && $cNo =='1'){
              $cVar1 = "���";
            }            
         If (Substr($cRtnum,0,1) == '0' && $cNo == '1'){
            $cVar1 = "˹��";
            }
         ///////
         If ($nUnit != '1'){ 
           $cRead = $cRead.$cVar1."�Ժ";
                 }
         Else{
           $cRead = $cRead.$cVar1;
                }
      }   
         $nUnit--;
             }
    $cRead = $cRead."ʵҧ��)"  ;
	}    
    else{
           $cRead = $cRead."��ǹ)" ;
           }  
    include("connect.inc");

   return $cRead;
}
///end function baht

///function convert to float number �ȹ��� 2���˹�
function vat($nVArabic){
    $nVArabic = number_format($nVArabic, 2, '.', ''); 
    $cTarget = Ltrim($nVArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
	$cRtnum=substr($cTarget,$x+1);

	$cRtnum=$cRtnum/100;
	$cRtnum=intval($cRtnum);
	$vat=$nVArabic+$cRtnum;
	return $vat;
}
///end of function convert to float number �ȹ��� 2���˹�

    

	///Load offisers
    $aMancode=array("aMancode"); 
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';

	for ($n=1; $n<=10; $n++){

		$query = "SELECT * FROM officers WHERE mancode = '$aMancode[$n]'";
		$result = mysql_query($query)
			or die("Query failed");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
				 }

			if(!($row = mysql_fetch_object($result)))
				continue;
				 }
		$aYot[$n]	=$row->yot; 
		$aFname[$n] =$row->fullname; 
		$aPost[$n]  =$row->position; 
		$aPost2[$n] =$row->position2; 
							}
///////End Load offisers

    $query = "SELECT * FROM pocompany WHERE row_id = '$nRow_id' ";
    $result = mysql_query($query) or die("Query pocompany fail");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }

//31
	$cDepart=$row->depart;
    $cDepartno=$row->departno;
    $cDepartdate=$row->departdate;
	$cPrepono=$row->prepono;
	$cPrepodate=$row->prepodate;
	$cComcode=$row->comcode;
	$cComname=$row->comname;
	$nItems=$row->items;
	$nNetprice=$row->netprice;
	$cPono=$row->pono;
	$cPodate=$row->podate;
	
	
		$query1 = "SELECT * FROM company WHERE comcode = '$cComcode'";
		$result1 = mysql_query($query1)or die("Query failed");
		$row1 = mysql_fetch_array($result1);
		if($row1){
		$fax="(  ".$row1['fax']."  )";
		}

//�ӹǹ��ҵ�ҧ�
$nVat = $nNetprice * .07;
$nVat = vat($nVat); //use function vat

if ( $vat_type === 'after' ) {
	$nPriadvat = $nNetprice;
	$nPriadvat = $nVat + $nNetprice;

}else if( $vat_type === 'before' ){
	$nNetprice1 = $nNetprice-$nVat;
	$nPriadvat = $nNetprice;
	$nNetprice -= $nVat;

}

$cPriadvat = baht($nPriadvat);//����ѡ��

//format 2 decimal
$nVat=number_format($nVat,2,'.',',');
$nPriadvat=number_format($nPriadvat,2,'.',',');
$nNetprice=number_format($nNetprice,2,'.',',');

          
///// po31.php///
?>
<div class="clearfix">
<!-- default width 22cm -->
<!-- default height 28cm -->

<!--[if IE]>
		<div class="page1 ie7" style="">
<![endif]-->
<!--[if !IE]><!-->
		<div class="page1" style="position: relative; width: 20.8cm; height: 27cm;">
<!--<![endif]-->

<?php

print "<DIV style='left:88PX;top:110PX;width:697PX;height:30PX;'><span class='fc1-5'>��ǹ�Ҫ���&nbsp;&nbsp;�ͧ���Ѫ����&nbsp;&nbsp;&nbsp;&nbsp;þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:329PX;top:49PX;width:155PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ѹ�֡��ͤ���</span></DIV>";
print "<DIV style='left:88PX;top:139PX;width:333PX;height:30PX;'><span class='fc1-5'>��� �� 0483.63.4/$cPrepono</span></DIV>";
print "<DIV style='left:402PX;top:110PX;width:257PX;height:30PX;'><span class='fc1-5'>$cPrepodate</span></DIV>";
print "<DIV style='z-index:15;left:88PX;top:27PX;width:73PX;height:80PX;'>
	<img  WIDTH=73 HEIGHT=80 SRC='bird.jpg'>
</DIV>";
print "<DIV style='left:88PX;top:169PX;width:36PX;height:30PX;'><span class='fc1-5'>����ͧ</span></DIV>";
print "<DIV style='left:88PX;top:198PX;width:36PX;height:30PX;'><span class='fc1-5'>���¹</span></DIV>";
print "<DIV style='left:138PX;top:198PX;width:283PX;height:30PX;'><span class='fc1-5'>��.þ.��������ѡ��������</span></DIV>";

print "<DIV style='left:138PX;top:169PX;width:647PX;height:30PX;'><span class='fc1-5'>��͹��ѵԨѴ��".$type_txt."</span></DIV>";

print "<DIV style='left:167PX;top:263PX;width:617PX;height:30PX;'><span class='fc1-5'>�ͧ���Ѫ���� þ.����� ��͹��ѵԨѴ��".$type_txt." ������㹡���ѡ�Ҿ�Һ�ż������纷�������</span></DIV>";
print "<DIV style='left:88PX;top:292PX;width:696PX;height:30PX;'><span class='fc1-5'>�Ѻ����ѡ�Ҿ�Һ��� þ.��������ѡ�������� �ӹǹ $nItems ��¡�� ��èѴ�Ҥ��駹���繡�èѴ�ҷ�᷹</span></DIV>";
print "<DIV style='left:88PX;top:321PX;width:696PX;height:30PX;'><span class='fc1-5'>�ͧ�ʵ�͡����������ŧ �ѧ����¡�õ����觷�����Ҵ�������</span></DIV>";
/// ��ǹ��������ͧ ////


print "<DIV style='left:167PX;top:350PX;width:317PX;height:30PX;'><span class='fc1-5'>�֧���¹�����͡�سҾԨ�ó�</span></DIV>";
print "<DIV style='left:398PX;top:393PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print "<DIV style='left:413PX;top:422PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
print "<DIV style='left:413PX;top:451PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2] $aPost2[2]</span></DIV>";

print "<DIV style='left:138PX;top:811PX;width:55PX;height:30PX;'><span class='fc1-5'>͹��ѵ�</span></DIV>";
print "<DIV style='left:118PX;top:840PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[1]</span></DIV>";
print "<DIV style='left:109PX;top:869PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[1])</span></DIV>";
print "<DIV style='left:109PX;top:898PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[1] </span></DIV>";
print "<DIV style='left:109PX;top:927PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";

print "<DIV style='left:435PX;top:550PX;width:269PX;height:30PX;'><span class='fc1-5'>���¹ ��.þ.��������ѡ��������</span></DIV>";
print "<DIV style='left:472PX;top:579PX;width:269PX;height:30PX;'><span class='fc1-5'>���Ǩ�ͺ������Ѻʶҹ��Һ����������§��</span></DIV>";
print "<DIV style='left:435PX;top:608PX;width:269PX;height:30PX;'><span class='fc1-5'>�����ʹѺʹع �ӹǹ�Թ $nPriadvat �ҷ</span></DIV>";
print "<DIV style='left:435PX;top:637PX;width:320PX;height:30PX;'><span class='fc1-5'>$cPriadvat</span></DIV>";
print "<DIV style='left:450PX;top:666PX;width:269PX;height:30PX;'><span class='fc1-5'>$aYot[5]</span></DIV>";
print "<DIV style='left:435PX;top:695PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[5])</span></DIV>";
print "<DIV style='left:435PX;top:724PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[5]</span></DIV>";
print "<DIV style='left:435PX;top:753PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[5]</span></DIV>";
print "<DIV style='left:435PX;top:782PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>............/............/............</span></DIV>";

print "<BR>";
?>
</div>
</div>




<!-- �����˹���ͧ -->
<div class="clearfix">
	<!--[if IE]>
		<div class="page2 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page2" style="position: relative; width: 20.8cm; height: 27cm;">
	<!--<![endif]-->

	<?php

	///list ��¡��
	$x=0;
    $aX   = array("x");
    $aTradname  = array("tradname ");
	$aPacking  = array(" packing");
	$aPack  = array("pack");
	$aAmount  = array(" amount");
    $aPrice   = array(" price");
    $aPackpri  = array(" packpri");
	$aSpecno   = array(" specno");

	$aEdpri = array("edpri");
	$aEdpriFrom = array("edpri_from");
	$aUnitpri = array("unitpri");
	$aPart = array("part");
	$aFreelimit = array("freelimit");

	//$x  $tradname $packing  $pack  $amount  $price  $packpri  $specno 
    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno FROM poitems WHERE idno = '$nRow_id' ";
	$result = mysql_query($query) or die("Query poitems failed");
	
	$po_page2_rows = 0;
	
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
			continue;
		
		$x++;
		$specnum = $row->specno;
		$drugc = $row->drugcode;
		if($specnum==""){
			$query2 = "SELECT spec  from druglst WHERE drugcode = '$drugc' ";
			$result2 = mysql_query($query2);
			list($specnum) = mysql_fetch_array($result2);
		}
		array_push($aX,"$x");
		array_push($aTradname,$row->tradname);
		array_push($aPacking,$row->packing);
		array_push($aPack,$row->pack);
		array_push($aAmount ,$row->amount);
		$price=$row->price;
		$price=number_format($price,2,'.',',');
		array_push($aPrice,$price);
		$packpri=$row->packpri;
		$packpri=number_format($packpri,2,'.',',');
		array_push($aPackpri,$packpri);
		array_push($aSpecno,$specnum);
		
		$sql = "SELECT * FROM druglst WHERE drugcode = '$drugc'";
		$q = mysql_query($sql) or die( mysql_error() );
		$item = mysql_fetch_assoc($q);

		array_push($aEdpri,$item['edpri']);
		array_push($aEdpriFrom,$item['edpri_from']);
		array_push($aUnitpri,$item['unitpri']);
		array_push($aPart,$item['part']);
		array_push($aFreelimit,$item['freelimit']);

		$po_page2_rows++;
	}
	
	$x++;
    array_push($aX,"");
	array_push($aTradname,"------- �����¡�� -------"); 
    array_push($aPacking,"");
    array_push($aPack,"");
    array_push($aAmount ,"");
    array_push($aPrice,"");
    array_push($aPackpri,"");
	array_push($aSpecno,"");

	// �ӹǹ��÷Ѵ���Է���ʴ����1˹�ҡ�д��
	$line_in_page = 30;
	$set_new_page = false;

	// �ӹǹ��÷Ѵ���еѴ���˹������
	$line_cutoff = 24;

	// ��Ң��������С��Ҩӹǹ����˹�
	if( $po_page2_rows >= $line_cutoff ){
		$set_new_page = true;
	}

	//���� 12 ��¡��+�����¡��(13��) ��� NULL ���array �������ʹѧ���
	for ($n=$x+1; $n<=13; $n++){
		array_push($aX,"");
		array_push($aTradname,""); 
		array_push($aPacking,"");
		array_push($aPack,"");
		array_push($aAmount ,"");
		array_push($aPrice,"");
		array_push($aPackpri,"");
		array_push($aSpecno,"");
	}

	$edpri_from_list = array(
		1 => '(�) �Ҥҷ�����Ҩҡ��äӹǳ�����ѡࡳ���褳С�������Ҥҡ�ҧ��˹�',
		2 => '(�) �Ҥҷ�����Ҩҡ�ҹ�������Ҥ���ҧ�ԧ�ͧ��ʴط�����ѭ�ա�ҧ�Ѵ��',
		3 => '(�) �Ҥ��ҵðҹ����ӹѡ������ҳ����˹��§ҹ��ҧ��蹡�˹�<br>(�Ҥ��ҵðҹ�Ǫ�ѳ���������� ��� ʸ 0228.07.2/�688 ŧ �ѹ��� 6 �ԧ�Ҥ� �.�.2556)<br>(����������ѵ�Ҥ����������������ػ�ó�㹡�úӺѴ�ѡ���ä ��� �� 0422.2/����� � 1 ŧ�ѹ��� 4 �ѹ�Ҥ� 2556)',
		4 => '(�) �Ҥҷ�����Ҩҡ����׺�ҤҨҡ��ͧ��Ҵ',
		5 => '(�) �Ҥҷ��ढ�������ͨ�ҧ������ѧ�ش�������������ͧ�է�����ҳ',
		6 => '(�) �Ҥ����㴵����ѡࡳ�� �Ըա�� �����Ƿҧ��ԺѵԢͧ˹��§ҹ�ͧ�Ѱ����',
	);
	?>
	<style type="text/css">
	.dx_tb{
		border: 1px dashed #000;
		font-size: 13pt;
	}
	.dx_tb th{
		border-bottom: 1px dashed #000;
	}
	.dx_tb th, .dx_tb td{
		border-right: 1px dashed #000;
		padding: 0 2 0 0;
		margin: 0;
	}
	.dx_tb .last_child{
		border-right: none;
	}
	.dx_detail{
		margin-top: 5px;
	}
	.dx_detail div{
		position: relative;
		padding-left: 10px;
		line-height: 13pt;
	}
	</style>

	<div style="position: relative;">
		<div style='height:30PX;' align="center"><span class='fc1-1'>�ѭ����¡��<?=$type_txt;?>����͹��ѵԨѴ���� </span></div>
		<div style='height:26PX;' class='fc1-0' align="center">
			<span>�����§ҹ�ͧ���Ѫ���� þ.��������ѡ�������� ��� �� 0483.63.4/</span>
			<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepono;?></span>
			ŧ �ѹ���
			<span style="padding: 0 10px; border-bottom: 1px dashed #000000;"><?=$cPrepodate;?></span>
		</div>
	</div>

	<div style="position: relative; font-family: TH SarabunPSK; font-size: 13pt;">

		<table class="dx_tb" style="width: 745px;">
			<tr>
				<th style="width:38px;">�ӴѺ</th>
				<th style="width:258px;">��¡��</th>
				<th style="width:51px;">˹��¹Ѻ</th>
				<th style="width:75px;">��Ҵ��è�</th>
				<th style="width:43px;">�ӹǹ</th>
				<th style="width:55px;">�Ҥҡ�ҧ</th>
				<th style="width:55px;">���觷���Ңͧ�Ҥҡ�ҧ ***</th>
				<th style="width:75px;">˹�����<br>��� VAT</th>
				<th style="width:75px;">�Ҥ�<br>��� VAT</th>
				<th  style="width:75px;" class="last_child">Spec ��.���</th>
			</tr>
			<?php 

			for ($ii=1; $ii <= $po_page2_rows; $ii++) { 

				// cost �ѧ����� &nbsp; ���е�ͧ�硵�����͹䢵�ҧ��͹
				$cost = false;
				$from = '&nbsp;';

				//  ������ػ�ó� ��º�ҡ �ػ���ԡ������Թ
				if( $part == 'DPY' OR $part == 'DPN' ){

					// �Ҥ��ػ�ó��ԡ������Թ
					if( $aFreelimit[$ii] > 0 ){
						$cost = $aFreelimit[$ii];
						$from = 3;
					}

				}else{

					// �Ҥҡ�ҧ
					if( $aEdpri[$ii] > 0 ){
						$cost = $aEdpri[$ii];
						$from = 3;
					}

				}

				// ���������Ҥҡ�ҧ ���� �Ҥ��ػ�ó�������Ҥҷع
				if( empty($cost) ){
					if( !empty($aUnitpri[$ii]) ){
						$cost = $aUnitpri[$ii];
						$from = 5;
					}
				}

				if( $cost == false ){
					$cost = '&nbsp;';
				}
				
				?>
				<tr>
					<td align="center"><?=( !empty($aX[$ii]) ? $aX[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aTradname[$ii]) ? $aTradname[$ii] : '&nbsp;' );?></td>
					<td><?=( !empty($aPacking[$ii]) ? $aPacking[$ii] : '&nbsp;' );?></td>
					<td align="center"><?=( !empty($aPack[$ii]) ? $aPack[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aAmount[$ii]) ? $aAmount[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=$cost;?></td>
					<td align="center"><?=$from;?></td>
					<td align="right"><?=( !empty($aPackpri[$ii]) ? $aPackpri[$ii] : '&nbsp;' );?></td>
					<td align="right"><?=( !empty($aPrice[$ii]) ? $aPrice[$ii] : '&nbsp;' );?></td>
					<td class="last_child" align="center"><?=( !empty($aSpecno[$ii]) ? $aSpecno[$ii] : '&nbsp;' );?></td>
				</tr>
				<?php
			}


			?>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����Թ</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nNetprice;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">���� 7.00 %</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nVat;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>��� <?=$nItems;?> ��¡��</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td style="border-bottom: 1px solid #000;">����ط��</td>
				<td style="border-bottom: 1px solid #000;" align="right"><?=$nPriadvat;?></td>
				<td class="last_child">&nbsp;</td>
			</tr>
			<tr>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td>&nbsp;</td>
				<td class="last_child">&nbsp;</td>
			</tr>
		
		</table>

	</div>
	<?php
	if ( $set_new_page === true ) {
		?>
		</div>
		</div>
		<div class="clearfix">
		<!--[if IE]>
			<div class="page2 ie7" style="">
		<![endif]-->
		<!--[if !IE]><!-->
			<div class="page2" style="position: relative; width: 20.8cm; height: 27cm;">
		<!--<![endif]-->
		<?php
	}
	?>
	<div style="position: relative;">
		<div class="dx_detail" style="position: relative;">
			<div>����Ҥһ���ҳ���͹��ѵ� ���ʹ��Թ��èѴ����㹤��ǹ�� <?=$nItems;?> ��¡��</div>
			<div>�ӹǹ�Թ <?=$nPriadvat;?> �ҷ <?=$cPriadvat;?></div>
			<div>*** �����˵�</div>
			<div>
				<div>���觷���Ңͧ�Ҥҡ�ҧ</div>
				<div style="padding-left: 20px;">
					<?php
					foreach ($edpri_from_list as $key => $value) {
						echo $value."<br>";
					}
					?>
				</div>
			</div>
		</div>
		<?php
		//  ��ͧ�� 740
		print"<DIV style='height:27PX; padding-right: 300px;' align='right'><span class='fc1-0'>��Ǩ�١��ͧ</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 250px;' align='right'><span class='fc1-0'>$aYot[2]</span></DIV>";
		print"<DIV style='height:30PX; padding-right: 150px;' align='right'><span class='fc1-0'>($aFname[2])</span></DIV>";

		//���˹�
		print"<DIV style='height:30PX; padding-right: 100px;' align='right'><span class='fc1-0'>$aPost[2] $aPost2[2]</span></DIV>";

		?>
	</div>

</div> <!-- Close class page2 -->
</div> <!-- Close Clearfix -->


<div class="clearfix">
	<!--[if IE]>
		<div class="page3 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page3" style="position: relative; width: 20.8cm; height: 27cm;">
	<!--<![endif]-->
<?php
////po33.php
// 2090
$p3_top = 0;
print"<DIV style='left:194PX;top:".$p3_top."PX;width:364PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-1'>���觫���������Ǫ�ѳ��������ͧ</span></DIV>";

$p3_top += 30;
print"<DIV style='left:194PX;top:".$p3_top."PX;width:364PX;height:41PX;TEXT-ALIGN:CENTER;'><span class='fc1-2'>�ç��Һ�Ť�������ѡ�������� �ӻҧ</span></DIV>";
$p3_top += 35;
print"<DIV style='left:194PX;top:".$p3_top."PX;width:364PX;height:34PX;TEXT-ALIGN:CENTER;'><span class='fc1-3'>���.32</span></DIV>";
print"<DIV style='left:684PX;top:".$p3_top."PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>������Ѻ</span></DIV>";

$p3_top += 30;
print"<DIV style='left:310PX;top:".$p3_top."PX;width:159PX;height:26PX;'><span class='fc1-0'>�� 0483.63.4/$cPrepono</span></DIV>";
print"<DIV style='left:281PX;top:".$p3_top."PX;width:30PX;height:26PX;'><span class='fc1-0'>�Ţ���</span></DIV>";
print"<DIV style='left:490PX;top:".$p3_top."PX;width:29PX;height:26PX;'><span class='fc1-0'>�ѹ���</span></DIV>";
print"<DIV style='left:518PX;top:".$p3_top."PX;width:105PX;height:26PX;'><span class='fc1-0'>$cPrepodate</span></DIV>";
// �մ�����
print"<div style='left:310PX;top:".($p3_top + 18)."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";
print"<div style='left:515PX;top:".($p3_top + 18)."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:156PX;'></div>";


$p3_top += 30;
print"<DIV style='left:97PX;top:".$p3_top."PX;width:91PX;height:26PX;'><span class='fc1-0'>����觫��ͧ͢�ҡ</span></DIV>";
print"<DIV style='left:187PX;top:".$p3_top."PX;width:397PX;height:26PX;'><span class='fc1-0'>($cComcode)$cComname&nbsp;&nbsp;&nbsp;$fax</span></DIV>";
print"<DIV style='left:586PX;top:".$p3_top."PX;width:104PX;height:26PX;'><span class='fc1-0'>�ѧ����¡�õ��仹��</span></DIV>";
// �մ�����
print"<div style='left:187PX;top:".($p3_top + 18)."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:399PX;'></div>";

$table_border_top = $p3_top + 27;

// ��Ǣ�͵��ҧ
$p3_top += 30;
print"<DIV style='left:7PX;top:".$p3_top."PX;width:38PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӴѺ</span></DIV>";
print"<DIV style='left:49PX;top:".$p3_top."PX;width:258PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��¡��</span></DIV>";
print"<DIV style='left:313PX;top:".$p3_top."PX;width:51PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹��¹Ѻ</span></DIV>";
print"<DIV style='left:371PX;top:".$p3_top."PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��Ҵ��è�</span></DIV>";
print"<DIV style='left:467PX;top:".$p3_top."PX;width:43PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�ӹǹ</span></DIV>";
print"<DIV style='left:520PX;top:".$p3_top."PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>˹�����</span></DIV>";
print"<DIV style='left:590PX;top:".$p3_top."PX;width:85PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>�Ҥ�</span></DIV>";
print"<DIV style='left:684PX;top:".$p3_top."PX;width:61PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>spec.</span></DIV>";
print"<DIV style='left:518PX;top:".($p3_top + 12)."PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";
print"<DIV style='left:600PX;top:".($p3_top + 12)."PX;width:64PX;height:23PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��� VAT</span></DIV>";

// �մ�������Ǣ�͵��ҧ
print"<div style='left:8PX;top:".($p3_top + 30)."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";

$start_line = $p3_top + 30;
$line_count = 1;

for ($iz=1; $iz <= $po_page2_rows; $iz++) { 
	
	print"<DIV style='left:11PX;top:".$start_line."PX;width:30PX;height:22PX;TEXT-ALIGN:CENTER;'>
	<span class='fc1-4'>$aX[$iz]</span></DIV>";
	print"<DIV style='left:49PX;top:".$start_line."PX;width:250PX;height:22PX;'><span class='fc1-4'> $aTradname[$iz]</span></DIV>";
	print"<DIV style='left:306PX;top:".$start_line."PX;width:64PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aPacking[$iz]</span></DIV>";
	print"<DIV style='left:362PX;top:".$start_line."PX;width:96PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPack[$iz]</span></DIV>";
	print"<DIV style='left:462PX;top:".$start_line."PX;width:50PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aAmount[$iz]</span></DIV>";
	print"<DIV style='left:597PX;top:".$start_line."PX;width:79PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPrice[$iz]</span></DIV>";
	print"<DIV style='left:679PX;top:".$start_line."PX;width:72PX;height:22PX;TEXT-ALIGN:CENTER;'>
		<span class='fc1-4'>$aSpecno[$iz]</span></DIV>";
	print"<DIV style='left:519PX;top:".$start_line."PX;width:63PX;height:22PX;TEXT-ALIGN:RIGHT;'>
		<span class='fc1-4'>$aPackpri[$iz]</span></DIV>";

	$start_line += 22;
	$line_count++;
	
}

/////////
$line_tx = $start_line + 10;

// ����Թ
print"<DIV style='left:496PX;top:".$line_tx."PX;width:86PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>����Թ</span></DIV>";
print"<DIV style='left:597PX;top:".$line_tx."PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'>$nNetprice</span></DIV>";


// ���� 7%
$line_tx = $line_tx + 30;
print"<DIV style='left:496PX;top:".$line_tx."PX;width:86PX;height:26PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���� 7.00 %</span></DIV>";
print"<DIV style='left:597PX;top:".$line_tx."PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'>$nVat</span></DIV>";


// ����ط��
$line_tx = $line_tx + 30;

// �������ط��
print"<div style='left:8PX;top:".$line_tx."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";
$line_tx += 10;

print"<DIV style='left:538PX;top:".$line_tx."PX;width:44PX;height:27PX;'><span class='fc1-0'>����ط��</span></DIV>";
print"<DIV style='left:597PX;top:".$line_tx."PX;width:79PX;height:26PX;TEXT-ALIGN:RIGHT;'>
<span class='fc1-0'><B>$nPriadvat</B></span></DIV>";

// ���-��¡��
print"<DIV style='left:128PX;top:".$line_tx."PX;width:93PX;height:26PX;TEXT-ALIGN:CENTER;'>
<span class='fc1-0'>$nItems</span></DIV>";
print"<DIV style='left:99PX;top:".$line_tx."PX;width:25PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���</span></DIV>";
print"<DIV style='left:225PX;top:".$line_tx."PX;width:44PX;height:27PX;'><span class='fc1-0'>��¡��</span></DIV>";

print"<div style='left:124PX;top:".($line_tx + 17)."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:102PX;'></div>";
$line_tx += 10;
// ���-��¡��

$table_border_bottom = $line_tx + 20;
$table_height = $table_border_bottom - $table_border_top;

// �մ�Դ���ҧ
print"<div style='left:8PX;top:".$table_border_bottom."PX;border-color:000000;border-style:dashed;border-width:0px;border-top-width:1PX;width:743PX;'></div>";


// ��鹢մ㹵��ҧ
print"<div style='left:44PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:311PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:365PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:461PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:515PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";
print"<div style='left:585PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='554PX'><td>&nbsp;</td></table></div>";
print"<div style='left:679PX;top:".$table_border_top."PX;border-color:000000;border-style:dashed;border-width:0px;border-left-width:1PX;height:".$table_height."PX;'><table width='0px' height='553PX'><td>&nbsp;</td></table></div>";

// ��ͺ���ҧ
print"<DIV class='box' style='z-index:10; border-color:000000;
border-style:dashed;
border-left-width:1PX;
border-bottom: 0px;
border-top-width:1PX;
border-right-width:1PX;
left:7PX;
top:".$table_border_top."PX;
width:743PX;
height:".$table_height."PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=736px height=552px><TD>&nbsp;</TD></TABLE></DIV>";


if ( $set_new_page === true ) {
	?>
	</div>
	</div>
	<div class="clearfix">
	<!--[if IE]>
		<div class="page3 ie7" style="">
	<![endif]-->
	<!--[if !IE]><!-->
		<div class="page3" style="position: relative; width: 20.8cm; height: 27cm;">
	<!--<![endif]-->
	<?php
	$table_border_bottom = 0;
}



// ��ͺ�͡���
$bottom = $table_border_bottom + 10;
$bottom_right = $bottom;
print"<DIV style='left:360PX;top:".$bottom."PX;width:263PX;height:27PX;'><span class='fc1-0'>�觢ͧ���� 15 �ѹ �Ѻ�ҡ�ѹ�����ŧ����觫���</span></DIV>";
print"<DIV style='left:360PX;top:".($bottom+20)."PX;width:319PX;height:27PX;'><span class='fc1-0'>����������ö�觢ͧ������˹� ���Դ��͡�Ѻ���� 5 �ѹ</span></DIV>";
print"<DIV style='left:360PX;top:".($bottom+40)."PX;width:263PX;height:27PX;'><span class='fc1-0'>���Ѿ�� 054-839305 ��� 1163    FAX. 054-839314</span></DIV>";

print"<DIV class='box' style='z-index:10; border-color:000000;border-style:dashed;border-bottom-style:dashed;border-bottom-width:1PX;border-left-style:dashed;border-left-width:1PX;border-top-style:dashed;border-top-width:1PX;border-right-style:dashed;border-right-width:1PX;left:44PX;top:".$bottom."PX;width:181PX;height:45PX;'>
<table border=0 cellpadding=0 cellspacing=0 width=174px height=38px><TD>&nbsp;</TD></TABLE>
</DIV>";
print"<DIV style='left:76PX;top:".$bottom."PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>���͡�����觢ͧ 7 �ش</span></DIV>";
$bottom += 20;
print"<DIV style='left:76PX;top:".$bottom."PX;width:128PX;height:27PX;TEXT-ALIGN:RIGHT;'><span class='fc1-0'>㺡ӡѺ���� 1 �ش</span></DIV>";

$bottom += 30;
print"<DIV style='left:10PX;top:".$bottom."PX;width:209PX;height:27PX;'><span class='fc1-0'>���Ѻ���觫��������</span></DIV>";
$bottom += 20;
print"<DIV style='left:10PX;top:".$bottom."PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>��������������...........</span></DIV>";
$bottom += 30;
print"<DIV style='left:10PX;top:".$bottom."PX;width:209PX;height:27PX;TEXT-ALIGN:CENTER;'><span class='fc1-0'>(��������������.)</span></DIV>";
$bottom += 20;
print"<DIV style='left:10PX;top:".$bottom."PX;width:209PX;height:27PX;'><span class='fc1-0'>����ѷ&nbsp;&nbsp;.....................................................</span></DIV>";

$bottom_right += 70;
print"<DIV style='left:330PX;top:".$bottom_right."PX;width:87PX;height:30PX;TEXT-ALIGN:RIGHT;'><span class='fc1-5'>$aYot[2]</span></DIV>";
print"<DIV style='left:423PX;top:".($bottom_right + 18)."PX;width:125PX;height:1PX;border-bottom:1px dotted black;'></DIV>";

$bottom_right += 30;
print"<DIV style='left:344PX;top:".$bottom_right."PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>($aFname[2])</span></DIV>";
$bottom_right += 30;
print"<DIV style='left:344PX;top:".$bottom_right."PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost[2]</span></DIV>";
$bottom_right += 30;
print"<DIV style='left:344PX;top:".$bottom_right."PX;width:269PX;height:30PX;TEXT-ALIGN:CENTER;'><span class='fc1-5'>$aPost2[2]</span></DIV>";
$bottom_right += 30;
print"<DIV style='left:10PX;top:".$bottom_right."PX;width:479PX;height:27PX;'><span class='f1'><u>�����˵� : ���ŧ�ѹ������觢ͧ���������Ѻ�Թ ��ѧ�ѹ���� PO ¡����ѹ����� - �ҷԵ��</u></span></DIV>";

?>
</div>
</div>

</body>
</html>