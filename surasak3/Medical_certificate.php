<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��Ѻ�ͧ������ҹ͡�ѭ������ѡ��觪ҵ�</title>
 <link type="text/css" href="sm3_style.css" rel="stylesheet" />
 <? include("connect.php");
 
	$sqlrunno="SELECT prefix,runno FROM `runno` WHERE `title` = 'Medcer' ";
	$queryrunno=mysql_query($sqlrunno) or die (mysql_error());
	$arrrunno=mysql_fetch_array($queryrunno);
	

	$year_now = substr(date("Y")+543,2);
	
/*//if($arrrunno['prefix']!=$year_now){
$sql1= "Update runno set prefix = '$year_now', runno = 1 where  title = 'Medcer'";
$result1 = mysql_query($sql1)or die (mysql_error());

//}*/


session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
	session_unregister("sVn");
    session_unregister("sPtright");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sEssd");
    session_unregister("sNessdy");
    session_unregister("sNessdn");
    session_unregister("sDPY");
    session_unregister("sDPN");
    session_unregister("sDSY");
    session_unregister("sDSN");
    session_unregister("sNetprice");
    session_unregister("sDiag"); 
    session_unregister("sAccno"); 
    session_unregister("sRow_id"); 
    session_unregister("sRow"); 
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aSlipcode");
    session_unregister("aMoney"); 

//   
    $dDate=$sDate;
    $sHn="";
    $sAn="";
    $sPtright="";
    $sPtname="";
    $sDoctor="";
    $sEssd="";
    $sNessdy="";
    $sNessdn="";
    $sNetprice="";
    $sDPY="";
    $sDPN="";  
  
    $sDSY="";
    $sDSN="";    

    $sDiag="";
    $sRow_id=$nRow_id;
    $sAccno=$nAccno;

    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aPrice  = array("                          �ҤҢ��  ");
    $aPart = array("part");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    $aMoney= array("       ����Թ   ");
    $sRow=array("row_id of ipacc");

    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
	session_register("sVn");
    session_register("sPtright");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sEssd");
    session_register("sNessdy");
    session_register("sNessdn");
    session_register("sDPY");
    session_register("sDPN");
    session_register("sDSY");
    session_register("sDSN");
    session_register("sNetprice");
    session_register("sDiag"); 
    session_register("sAccno"); 
    session_register("sRow_id"); 
    session_register("sRow"); 

    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aPrice");
    session_register("aPart");
    session_register("aAmount");
    session_register("aSlipcode");
    session_register("aMoney");
   
    include("connect.inc");
  
 $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id'  "; 
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
	$sRow=$row->row_id;
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtright=$row->ptright;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sDSY=$row->dsy;
    $sDSN=$row->dsn;     
    $sNetprice=$row->price;
	$sPaid=$row->paid;
    $sDiag=$row->diag;
	$_SESSION["sVn"]=$row->tvn;

	$query = "SELECT tradname,amount,price,part,reason FROM drugrx WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."'and part='DDY' ";
    $result = mysql_query($query)or die("Query failed");

   // print "<font face='Angsana New'>$sPtname<br> ";
    $ptright=substr($sPtright,4);
    $doctor=substr($sDoctor,5);
  //  print "HN: $sHn, �Է���:$ptright<br>";
   
// echo $doctor;
print "<DIV style='z-index:0'> &nbsp; </div>";


  $sql1="SELECT mdcode FROM `inputm` WHERE 1 AND `name` LIKE '%$sDoctor%'";
  $query1=mysql_query($sql1)or die (mysql_error());
  $arr1=mysql_fetch_assoc($query1);
  
  		$sql2="SELECT * FROM `doctor` WHERE 1 AND `name`LIKE '$arr1[mdcode]%'";	
		$query2=mysql_query($sql2)or die (mysql_error());
 		$arr2=mysql_fetch_assoc($query2);
  // $sDoctor
  
/*  echo $sql1."<BR>";
  echo $sql2;*/
  $subdoctor=substr($arr2['name'],6);
  
  
  //////////////  ���Ţ ������� �Ţ��� 
  
$sqlno="INSERT INTO `certificate_number` ( `ref_id` , `no1` , `no2` )
VALUES ( '$sRow', '".$arrrunno['prefix']."', '".$arrrunno['runno']."');";
$queryno=mysql_query($sqlno)or die (mysql_error());

 ?>
 <style type="text/css">
 #apDiv1 {
	position: absolute;
	left: 963px;
	top: 12px;
	width: 211px;
	height: 63px;
	z-index: 1;
}
 #apDiv2 {
	position: absolute;
	z-index: 1;
	left: 640px;
	top: 3px;
}
 #apDiv {
	position: absolute;
	z-index: 1;
	left: 640px;
	top: 35px;
	
}
.font16{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
.font14{
	font-family:"TH SarabunPSK";
	font-size:14pt;
}
DIV {position:absolute; z-index:25;}
 </style>
</head>

<body onload="window.print() ">


<table  border="0" align="center"  width="100%">
  <tr>
    <td align="center">&nbsp;<!--�ç��Һ�Ť�������ѡ�������� <div id="apDiv2">������� &nbsp;&nbsp;<?//=$arrrunno['prefix'];?>/01</div>--></td>
    </tr>
  <tr>
    <td align="right" >�Ţ���&nbsp;&nbsp;&nbsp;<?=$arrrunno['runno'];?>/<?=$arrrunno['prefix'];?><!--������� &nbsp;&nbsp;<?//=$arrrunno['prefix'];?>/01&nbsp;&nbsp;&nbsp;<u>��Ѻ�ͧ������ҹ͡�ѭ������ѡ��觪ҵ�</u>-->
      <!--<div id="apDiv">�Ţ���&nbsp;&nbsp;<?//=$arrrunno['runno'];?></div>--></td>
    </tr>
  <tr>
    <td align="right"> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
 
  <tr>
    <td><span class="fontsara1">&nbsp;<!--<u>��ҧ�֧</u> ˹ѧ��͡�з�ǧ��ä�ѧ���·���ش ��� ��.0422.2/�.111 ŧ 24 �.�. 56</span>--></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td style="text-indent:3cm;"><span class="font16">��Ҿ��� 
      <?=$arr2['yot']?> 
      <?=$subdoctor;?>
    ᾷ���ç��Һ�Ť�������ѡ�������� ���ԹԨ������� ���Ѻ�ͧ���</span></td>
  </tr>
  <tr>
    <td><span class="font16"> <?=$Fulname;?>&nbsp;&nbsp;HN: <?=$hn;?>  &nbsp;&nbsp;������Ѻ��õ�Ǩ�ѡ�� � �ç��Һ�Ť�������ѡ�������� ������ѹ��� &nbsp;&nbsp;
        <?=$_GET['tDate'];?>
    </span></td>
  </tr>
  <tr>
    <td><span class="font16">�դ������繵�ͧ�� �ҹ͡�ѭ������ѡ��觪ҵ�㹡���ѡ�Ҥ��駹�����Թ �ӹǹ 
        <?="**".$Nessdy."**"?>
    �ҷ �ѧ���</span></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <? while (list ($tradname,$amount, $price,$part,$reason) = mysql_fetch_row ($result)) {
?>
  <tr>
    <td><span class="font14"><?=$tradname;?>&nbsp;�˵ؼ�&nbsp;<?=$reason;?></span></td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
  </tr>

</table>
<? 
 



print "<DIV style='left:450PX;top:380PX;width:306PX;height:30PX;'><span class='font16'>$arr2[yot]</span></DIV>";
print "<DIV style='left:480PX;top:410PX;width:306PX;height:30PX;'><span class='font16'>$subdoctor</span></DIV>";
print "<DIV style='left:430PX;top:440PX;width:306PX;height:30PX;'><span class='font16'>���˹� &nbsp;$arr2[position2]</span></DIV>";
?>
<? 

$nRunno=$arrrunno['runno']+1;	
$query ="UPDATE runno SET runno = $nRunno  WHERE title='Medcer'";
$result = mysql_query($query) or die("Query failed runno");	
?>
</body>
</html>