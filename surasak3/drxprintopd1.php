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
  $rxpharin=$row->pharin;

  $phakew=$row->kew;
   $kewphar=$row->kewphar;
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
//  print "<font face='Angsana New' size= 4 ><b><CENTER>���¡���ҡ�Ѻ��ҹ</CENTER></b></font>";
    print "<TR  style=\"line-height: 14px;\"> <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>���¡����</b></font></td>\n";
    print " <td><font face='Angsana New' size='1' >&nbsp;$d/$m/$y&nbsp;&nbsp;$t</td>\n<BR>";
    print " <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>����&nbsp;$rxPtname</b> &nbsp;HN:&nbsp;$rxHn</td>\n<BR>";
//	print "<font face='Angsana New' size=1 >&nbsp;&nbsp<b>����&nbsp;$age</b>&nbsp;&nbsp; ";
    print " <td><font face='Angsana New' size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ä: $rxDiag</font></td>\n<BR>";
	$num1='0';
 $query = "SELECT tradname,advreact,asses FROM drugreact WHERE  hn = '$rxHn' ";
    $result = mysql_query($query)
        or die("Query drugreact failed");
/*
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
*/
?>

<table>
 <tr>
  
 </tr>

<?php

 

$num='0';
    $query = "SELECT a.tradname,a.drugcode, a.amount, a.price, a.slcode, a.drugcode, a.part, b.detail1, b.detail2, b.detail3, b.detail4, a.drug_inject_amount,a.drug_inject_slip, a.drug_inject_type,a.drug_inject_etc,a.office,c.unit FROM ddrugrx as a, drugslip as b,druglst as c WHERE a.slcode = b.slcode AND a.idno = '$sRow_id'   AND a.date = '$dRxdate' AND a.drugcode = c.drugcode ";
    $result = mysql_query($query)
        or die("Query failed");

  
	
    while (list ($tradname,$drugcode,$amount,$price,$slcode,$drugcode,$part,  $detail1, $detail2, $detail3, $detail4,$dia,$dis,$dit,$die,$office,$unit) = mysql_fetch_row ($result)) {
		$num++;

        print (" <TR  style=\"line-height: 14px;\">\n".
			  "  <td><font face='Angsana New'  size='1' >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$num.</td>\n".
			  //  "  <td><font face='Angsana New' style='line-height:15px; size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$drugcode</td>\n".
           "  <td><font face='Angsana New'  size='1'><b>&nbsp;$tradname</b>&nbsp;[$unit]</td>\n".
           "  <td align='right'><font face='Angsana New' size='1'>&nbsp;<b>(&nbsp;$amount&nbsp;)</b></td>\n".
        "  <td align='right'><font face='Angsana New'  size='1'><B>$slcode</B></td>\n".
		//	  "  <td align='right'><font face='Angsana New'  size='1'><B>�Ը���</B></td>\n".
      //     "  <td><font face='Angsana New' size='1'>&nbsp;$detail1 &nbsp; $detail2 &nbsp; $detail3 &nbsp; $detail4&nbsp;&nbsp;$dia&nbsp;$dis&nbsp;$dit&nbsp;$die &nbsp;$office</td>\n".
           " </tr>\n");
		if($num == 10){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}else if($num == 20){
			print ("<tr><td><div style=\"page-break-before: always;\"></div></td></tr>");
		}
      }
   
?>
</table>
<?php

 print "<font face='Angsana New' style='line-height:15px; size='1'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ᾷ�� :$rxDoctor &nbsp;&nbsp;&nbsp;";
   // print "<font face='Angsana New'>(<b>�ԡ��&nbsp;$netfree&nbsp;�ҷ</b>&nbsp;&nbsp;&nbsp;�ԡ�����&nbsp;$netpay  &nbsp;�ҷ)&nbsp;&nbsp; <font face='Angsana New' size='4'>����Թ  $rxNetprice  �ҷ</font><br>";
	//  print "<font face='Angsana New' size='1'>�ѭ������ѡ �ԡ��&nbsp;$Essd &nbsp;</font>";
   // print "<font face='Angsana New' size='1'>�͡�ѭ������ѡ�ԡ�� &nbsp;$Nessdy &nbsp;&nbsp;�ԡ�����&nbsp; $Nessdn &nbsp;</font>";
    //print "<font face='Angsana New' size='1'>����Ǫ�ѳ���ԡ�� &nbsp;$DSY &nbsp;&nbsp;�ԡ�����&nbsp;$DSN &nbsp;</font>";
  //  print "<font face='Angsana New' size='1'>����ػ�ó��ԡ��  &nbsp;$DPY &nbsp;&nbsp;�ԡ�����&nbsp;$DPN <br></font>";
	
	    
   

	//print "<font face='Angsana New' size='2'>����Ѻ��ͧ��&nbsp;&nbsp;�������.................���Ѵ..................";
//	print "<font face='Angsana New'>����Ǩ�ͺ...................................������................................<br>";


 $thdatevn1 = $d.'-'.$m.'-'.$y.$rxHn;
  $thdatevn2 = $d.'-'.$m.'-'.$y.$rxvn;
$thdatevn3 = $y.'-'.$m.'-'.$d;

 $timedate = date("H:i:s"); 
 $sql = "SELECT time1 FROM opday WHERE  thdatevn = '".$thdatevn2."' Order by row_id DESC limit 1";

   list($timestd) = mysql_fetch_row(Mysql_Query($sql));


   // print "<font face='Angsana New' size='2'>����&nbsp;������ŧ����¹&nbsp;$timestd &nbsp; ᾷ�������&nbsp$t&nbsp  �Ѻ������&nbsp;$rxpharin...�ѹ�֡������&nbsp;$timedate&nbsp; �Ѵ��........... ��Ǩ�ͺ��...........  ������.............";

$today1=(date("Y")+543).date("-m-d");	
$sql = "Select hn,ptname From dphardep WHERE hn = '".$rxHn."' AND  date LIKE '$today1%' and dr_cancle is null ";
	$result = Mysql_Query($sql);

	if(Mysql_num_rows($result) > 1){
		list($hn,$ptname) = Mysql_fetch_row($result);
	//echo "<br><font face='Angsana New' size='5'><center>***���������������ҡ���� 1 �*** </center></FONT>";
	}
	 include("unconnect.inc");
?>

