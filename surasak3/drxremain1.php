<body Onload="window.print();">

<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(2/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>




<?php
    session_start();
    include("connect.inc");
  
  Function calcage($birth){

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

    $query = "SELECT * FROM dphardep WHERE row_id = '$sRow_id' "; 
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
    $dRxdate=$row->date;
    $rxHn=$row->hn;
    $rxPtname=$row->ptname;
    $rxDoctor=$row->doctor;
    $rxNetprice=$row->price;
    $rxDiag=$row->diag;
     $rxPtright=$row->ptright;
 $rxvn=$row->tvn;
  $phakew=$row->kew;
	   $Essd   =$row->essd;  //����Թ�����㹺ѭ������ѡ��觪ҵ�
    $Nessdy =$row->nessdy;     //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��
    $Nessdn =$row->nessdn;    //����Թ����ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����
    $DSY     =$row->dsy;   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ��
    $DSN    =$row->dsn;   //����Թ����Ǫ�ѳ�� ��ǹ����ԡ�����  
    $DPY    =$row->dpy;   //����Թ����ػ�ó� ��ǹ����ԡ��
    $DPN     =$row->dpn;   //����Թ����ػ�ó� ��ǹ����ԡ�����  

$netfree=$Essd+$Nessdy+$DPY;
$netpay=$Nessdn+$DSY+ $DSN+$DPN;
$total=$Essd+$Nessdy+$DSY+$DPY+$Nessdn+$DSN+$DPN;


	   $d=substr($dRxdate,8,2);
    $m=substr($dRxdate,5,2);
    $y=substr($dRxdate,0,4);

	  $t=substr($dRxdate,11,8);
  

	$sql = "Select dbirth From opcard where hn='".$rxHn."' limit 1";
	list($dbirth) = Mysql_fetch_row(Mysql_Query($sql));
	
	$age = calcage($dbirth);

 print "<br><center><font face='Angsana New' size= '4' ><b>&nbsp;&nbsp;��¡�ä�ҧ�����Ҩҡ�ͧ���Ѫ����</b></font>&nbsp;&nbsp; <font face='Angsana New' size= '4' ><b>�ç��Һ�Ť�������ѡ�������� �ӻҧ</b></font></center></u> ";
    print "<br><font face='Angsana New' size= '4' ><b>&nbsp;&nbsp;��ͧ������(�����¹͡)</b></font>&nbsp;&nbsp; <font face='Angsana New' size= 3 ><b><b> </b>&nbsp;&nbsp;�Է��:$rxPtright</b></font> <font face='Angsana New' size= '1' ><INPUT TYPE=\"checkbox\" NAME=\"\" readonly>�������&nbsp;&nbsp;<INPUT TYPE=\"checkbox\" NAME=\"\" readonly>����.....................<br>";
    print "<font face='cordia New' size= '4'> &nbsp;&nbsp;��ҧ����������ѹ���&nbsp; $d/$m/$y&nbsp;&nbsp;$t&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����ѹ���.............................";
    print "<font face='Angsana New' size= '5'><br><b>&nbsp;&nbsp;����&nbsp;$rxPtname</b> &nbsp;HN:&nbsp;$rxHn&nbsp;&nbsp; ";
	print "<font face='cordia New' size= '2'>&nbsp;&nbsp<b>����&nbsp;$age</b>&nbsp;&nbsp; ";
    print "<font face='Angsana New' size= '2'>�ä: $rxDiag<br></font><br>";
	$num1='0';
 $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$rxHn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");

   if(mysql_num_rows($result)){

	print"<tr>	<td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>����ѵԡ������</b></u>";
  while (list ($tradname,$advreact,$asses) = mysql_fetch_row ($result)) {
	  $num1++;
	     print (" <tr>\n".
             
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=3><b><u>$num1</b></u></font ></td>\n".
                " </tr>\n");
            print (" <tr>\n".
             
                "  <td BGCOLOR=F5DEB3><font face='cordia New' size=4><b><u>$tradname...$advreact($asses)</b></u></font ></td>\n".
                " </tr>\n");
  						    }

print "</div>";

  }

?>

<table>
 <tr>
  
 </tr>

<?php

 

$num='0';
    $query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part, b.detail1, b.detail2, b.detail3, b.detail4  FROM ddrugrx as a, drugslip as b WHERE a.slcode = b.slcode AND a.row_id = '".$_GET["grow_id"]."'  AND a.date = '".$_GET["sDate"]."'  limit 1 ";
    $result = mysql_query($query)
        or die("Query failed");

  
	
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part,  $detail1, $detail2, $detail3, $detail4) = mysql_fetch_row ($result)) {
		$num++;

        print (" <tr>\n".
			  "  <td><font face='Angsana New' >&nbsp;&nbsp;$num.</td>\n".
			    "  <td><font face='Angsana New' size='2'>$drugcode</td>\n".
           "  <td><font face='Angsana New' size='3'><b>$tradname</b></td>\n".
           "  <td align='right'><font face='Angsana New' size='3'>&nbsp;�ӹǹ&nbsp;<b>(&nbsp;$amount&nbsp;)</b></td>\n".
           "  <td align='right'><font face='Angsana New'  >&nbsp;�Ҥ�&nbsp;$price<br></td>\n".
			    " </tr>\n".
		   " <tr>\n".
			  "  <td align='right'><font face='Angsana New'  size='2'>&nbsp;&nbsp;&nbsp;$part</td>\n".
			     "  <td align='right'><font face='Angsana New'  size='3'>�Ը���&nbsp;$slcode</td>\n".
           "  <td><font face='Angsana New' size='2'>&nbsp;$detail1 &nbsp; $detail2 &nbsp; $detail3 &nbsp; $detail4</td>\n".
           " </tr>\n");
		if($num == 10){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}else if($num == 20){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}
		$sql3 = "INSERT INTO `drxremain` (`date`,`hn`,`drugcode`,`drugname`,`amount`,`slcode`,`doctor`,`price`,`status`)VALUES ('".$dRxdate."','".$rxHn."','".$drugcode."','".$tradname."','".$amount."','".$slcode."','".$rxDoctor."','".$price."','�ѧ�����Դ�Ҥ���');";
$result2 = Mysql_Query($sql3);
      }
   
?>
</table>
<?php
	//print "<font face='Angsana New' size='4'><br><b><center>**�ѧ�����ӡ�õѴʵ�͡**</center></b>";
 print "<font face='Angsana New' size='2'><br>&nbsp;&nbsp;ᾷ�� :$rxDoctor ";
  print "<font face='Angsana New' size='4'><br><b>&nbsp;&nbsp;**�Դ�Ҥ������º��������**</b> ";
   // print "<font face='Angsana New'>(<b>�ԡ��&nbsp;$netfree&nbsp;�ҷ</b>&nbsp;&nbsp;&nbsp;�ԡ�����&nbsp;$netpay  &nbsp;�ҷ)&nbsp;&nbsp; <font face='Angsana New' size='4'>����Թ  $rxNetprice  �ҷ</font><br>";
	//  print "<font face='Angsana New' size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd &nbsp;</font>";
   // print "<font face='Angsana New' size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn &nbsp;</font>";
   // print "<font face='Angsana New' size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN &nbsp;</font>";
   // print "<font face='Angsana New' size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";
	
	    
   

	print "<font face='Angsana New' size='2'><br>&nbsp;&nbsp;����Ѻ��ͧ��&nbsp;&nbsp;���Դ.....................���Ѵ......................";
	print "<font face='Angsana New'>&nbsp;&nbsp;����Ǩ�ͺ......................������......................";

	print "<font face='Angsana New' size='4'><br><b>&nbsp;&nbsp;**�����˵�**</b>";
	print "<font face='Angsana New' size='3'><br>&nbsp;&nbsp;�������·�����Ѻ�����Դ��ͷ����ͧ������ ��ͧ��ԡ�������Ţ 6  ";
print "<font face='Angsana New' size='3'><br>&nbsp;&nbsp;�ͺ�������ͧ�� �Դ��ͧ͡���Ѫ���� �� 054-839305 ��� 1160 ";

 $thdatevn1 = $d.'-'.$m.'-'.$y.$rxHn;
  $thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
$thdatevn3 = $y.'-'.$m.'-'.$d;

 $timedate = date("H:i:s"); 
 $sql = "SELECT time1 FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";

   list($timestd) = mysql_fetch_row(Mysql_Query($sql));


//    print "<font face='Angsana New' size='2'>����&nbsp;������ŧ����¹&nbsp;$timestd &nbsp ᾷ�������&nbsp$t&nbsp  �Ѻ������.............�ѹ�֡������&nbsp$timedate&nbsp �Ѵ��................ ��Ǩ�ͺ��.............  ������.............";
	 include("unconnect.inc");
?>

