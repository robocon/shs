<?php
session_start();
    session_unregister("x");
    session_unregister("aDate");
 session_unregister("atxDate");
    session_unregister("chkdate");
    session_unregister("repdate");

    session_unregister("aHn");
    session_unregister("aAn");
    session_unregister("aIdname");
    session_unregister("aDepart");
    session_unregister("aDetail");
    session_unregister("aPrice");
    session_unregister("aPaid");
    session_unregister("aPhar");  
    session_unregister("aPharpaid");    
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aPtright");
    session_unregister("aCredit");
    session_unregister("aCreditpaid");
    session_unregister("aLabo");
    session_unregister("aLabopaid");
    session_unregister("aXray");
    session_unregister("aXraypaid");  
    session_unregister("aSurg");    
    session_unregister("aSurgpaid");
    session_unregister("aEmer");
    session_unregister("aEmerpaid");
    session_unregister("aDent");
    session_unregister("aDentpaid");
    session_unregister("aPhysi");
    session_unregister("aPhysipd");
	 session_unregister("aNid");
    session_unregister("aNidpd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
    session_unregister("aCredit");
	session_unregister("aCredit_d");
	session_unregister("aPaidcscd");
	session_unregister("aVn");
		session_unregister("aLastupdate");
		session_unregister("acredit_detail"); 
//
//
    $x            =0;
    $aDate     =array("time");
     $atxDate     =array("time2");
    $chkdate="";   
    $repdate="";

    $aHn        =array("hn");
    $aAn         =array("an");  
    $aIdname  =array("idname");
    $Netprice  ="";   
    $Netpaid   ="";
    $aDepart   =array("depart");
    $aDetail    = array("detail");
    $aPrice   =array("price");
    $aPaid    = array("paid");
    $aPhar      =array("phar");
    $aPharpaid=array("pharpaid"); 
    $aEssd     =array("DDL");
    $aNessdy =array("DDY");
    $aNessdn =array("DDN");
    $aDPY      =array("DPY");
    $aDPN      =array("DPN");   
    $aDSY      =array("DSY");
    $aDSN      =array("DSN");   
	$aPtright   =array("ptright");  
	$aCredit   =array("credit");  
	$aCreditpaid  =array("creditpaid");  
    $aLabo        =array("labo");
    $aLabopaid  =array("labopaid");
    $aXray         =array("xray");
    $aXraypaid =array("xraypaid");
    $aSurg        =array("surg");
    $aSurgpaid =array("surgpaid");
    $aEmer        =array("emer");
    $aEmerpaid  =array("emerpaid");
    $aDent          =array("dent");
    $aDentpaid  =array("dentpaid");
    $aPhysi       =array("physi");
	$aPhysipd       =array("physipd");
	$aNid       =array("nid");
    $aNidpd  =array("nidpd");
    $aHemo       =array("hemo");
    $aHemopd  =array("hemopd");
    $aOther      =array("other");
    $aOtherpd  =array("otherpd");
    $aWard      =array("Ward");
    $aWardpd  =array("Wardpd");
	$aCredit     =array("Credit");
	$aCredit_d     =array("Credit_detail");
	$aPaidcscd     =array("paidcscd");
$aVn     =array("vn");
$aLastupdate     =array("lastupdate");
$acredit_detail =array("credit_detail");

    session_register("x");
    session_register("aDate");
  session_register("atxDate");
    session_register("chkdate");
    session_register("repdate");

    session_register("aHn");
    session_register("aAn");
    session_register("aIdname");
    session_register("aDepart");
    session_register("aDetail");
    session_register("aPrice");
    session_register("aPaid");
    session_register("aPhar");  
    session_register("aPharpaid");    
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aPtright");
    session_register("aCredit");
    session_register("aCreditpaid");
    session_register("aLabo");
    session_register("aLabopaid");
    session_register("aXray");
    session_register("aXraypaid");  
    session_register("aSurg");    
    session_register("aSurgpaid");
    session_register("aEmer");
    session_register("aEmerpaid");
    session_register("aDent");
    session_register("aDentpaid");
    session_register("aPhysi");
    session_register("aPhysipd");
	  session_register("aNid");
    session_register("aNidpd");
    session_register("aHemo");
    session_register("aHemopd");
    session_register("aOther");
    session_register("aOtherpd");
    session_register("aWard");
    session_register("aWardpd");
    session_register("aCredit");
	   session_register("aCredit_d");
	      session_register("aPaidcscd");
		   session_register("aVn");
		     session_register("aLastupdate");
			     session_register("acredit_detail");

    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
//    $chkdate=($chkdate).date(" H:i:s"); 

    $today="$d-$m-$yr";
    $repdate=$today; 
    print "<p>�Դ C ���µç || <a href='opmonreplgoc.php'>�Դ C ���µç ͻ�.</a></p>";      	
    print "�ѭ������Ѻ�����¹͡ ���µç ���Դ C ";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";

    $chkdate=("$yr-$m-$d").date(" H:i:s"); 
	$rowid = array("row_id");
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
    <th bgcolor=6495ED>VN</th>
  <th bgcolor=6495ED>Ἱ�</th>
  <th bgcolor=6495ED>��¡��</th>
  <th bgcolor=6495ED>�Ҥ�</th>

  <th bgcolor=6495ED>������</th>
    <th bgcolor=6495ED>���ʷ��Դ</th>
    
  <th bgcolor=6495ED>�Ҥ��ԡ</th>
  <th bgcolor=6495ED>���.���Թ</th>
  <th bgcolor=6495ED>�ѹ����Ѻ��ا</th>
  </tr>

<?php
    include("connect.inc");

session_unregister("credit_1");
session_unregister("credit_2");
session_unregister("credit_3");
session_unregister("credit_4");
session_unregister("credit_5");
session_unregister("credit_6");
session_unregister("credit_7");
session_unregister("credit_8");

$credit_1=" ";
$credit_2=" ";
$credit_3=" ";
$credit_4=" ";
$credit_5=" ";
$credit_6=" ";
$credit_7=" ";
$credit_8=" ";


session_register("credit_1");
session_register("credit_2");
session_register("credit_3");
session_register("credit_4");
session_register("credit_5");
session_register("credit_6");
session_register("credit_7");
session_register("credit_8");



    $query = "SELECT * FROM opacc WHERE  credit = '�ԴC' order by credit_detail  ";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      
	array_push($rowid,$row->row_id);
    array_push($aDate,$row->date);
	  array_push($atxDate,$row->txdate);
    array_push($aHn,$row->hn);
    array_push($aAn,$row->an);        
    array_push($aDepart,$row->depart);
    array_push($aDetail,$row->detail);
    array_push($aPrice,$row->price);
    array_push($aPaid,$row->paidcscd);
	array_push($aCredit,$row->credit);
    array_push($aPtright,$row->ptright);
	array_push($aCredit_d,$row->credit_detail);
    array_push($aIdname,$row->idname);
	array_push($aPaidcscd,$row->paidcscd);
	array_push($aVn,$row->vn);
	array_push($aLastupdate,$row->lastupdate);
		array_push($acredit_detail,$row->credit_detail);


if ($row->depart=="PHAR"){
	        array_push($aPhar,$row->price);  
            array_push($aPharpaid,$row->paidcscd);
            array_push($aEssd,$row->essd);
            array_push($aNessdy,$row->nessdy);
         //   array_push($aNessdn,$row->nessdn);
            array_push($aDPY,$row->dpy);
            array_push($aDPN,$row->dpn); 
            array_push($aDSY,$row->dsy);  
            array_push($aDSN,$row->dsn);
            }   
if ($row->depart=="PATHO"){
            array_push($aLabo,$row->price);  
            array_push($aLabopaid,$row->paidcscd);
            } 
if ($row->depart=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aXraypaid,$row->paidcscd);
            } 
if ($row->depart=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aSurgpaid,$row->paidcscd);
            } 
if ($row->depart=="EMER"){
            array_push($aEmer,$row->price);  
            array_push($aEmerpaid,$row->paidcscd);
            } 
if ($row->depart=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aDentpaid,$row->paidcscd);
            } 
if ($row->depart=="PHYSI"){
            array_push($aPhysi,$row->price);  
            array_push($aPhysipd,$row->paidcscd);
			            } 
if ($row->depart=="NID"){
            array_push($aNid,$row->price);  
            array_push($aNidpd,$row->paidcscd);
            } 
if ($row->depart=="HEMO"){
            array_push($aHemo,$row->price);  
            array_push($aHemopd,$row->paidcscd);
            } 
if ($row->depart=="OTHER"){
            array_push($aOther,$row->price);  
            array_push($aOtherpd,$row->paidcscd);
            } 
if ($row->depart=="WARD"){
            array_push($aWard,$row->price);  
            array_push($aWardpd,$row->paidcscd);
            } 
if (!empty($row->credit)){
            array_push($aCreditpaid,$row->paidcscd);  
				
				switch($row->credit){
					case "�Թʴ" : $_SESSION["credit_1"]=$_SESSION["credit_1"]+$row->paid; break;
					case "��ا෾" : $_SESSION["credit_2"]=$_SESSION["credit_2"]+$row->paid; break;
					case "������" : $_SESSION["credit_3"]=$_SESSION["credit_3"]+$row->paid; break;
					case "���µç" : $_SESSION["credit_4"]=$_SESSION["credit_4"]+$row->paid; break;
					case "��Сѹ�ѧ��" : $_SESSION["credit_5"]=$_SESSION["credit_5"]+$row->paid; break;
					case "30�ҷ" : $_SESSION["credit_6"]=$_SESSION["credit_6"]+$row->paid; break;
					case "�Թ����" : $_SESSION["credit_7"]=$_SESSION["credit_7"]+$row->paid; break;
					case "����" : $_SESSION["credit_8"]=$_SESSION["credit_8"]+$row->paid; break;
				}

            } 
$x++;
       }
 //include("unconnect.inc");

print "<font face='Angsana New'><br>�ӹǹ������ $x ��¡�� �ѧ���<br>";
//   $x++;
   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
		 $time2=substr($atxDate[$n],11,5);
		 
		 $Nquery = "Select hn, status From cscddata where hn = '$aHn[$n]' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			if(Mysql_num_rows(Mysql_Query($Nquery)) > 0){
				if($aPaidcscd[$n]>0){
					$color="#F5DEB3";	
				}else{
					$color="#FF0000";	
				}
			}else{
				$color="#FF0000";	
			}
			
        print("<tr>\n".
                "<td bgcolor=$color><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aDate[$n]</td>\n".
			"<td bgcolor=$color><font face='Angsana New'>$atxDate[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aHn[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aAn[$n]</td>\n".   
			 "<td bgcolor=$color><font face='Angsana New'>$aVn[$n]</td>\n".    
                "<td bgcolor=$color><font face='Angsana New'>$aDepart[$n]</td>\n".
                "<td bgcolor=$color><font face='Angsana New'>$aDetail[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aPrice[$n]</td>\n".  
          //      "<td bgcolor=$color><font face='Angsana New'>$aPaid[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'><A HREF=\"edit_cashcscd1.php?id=$rowid[$n]\" target='_blank'>$aCredit[$n]</A></td>\n".  
					       "<td bgcolor=$color><font face='Angsana New'>$acredit_detail[$n]</td>\n".  
		  //	   "<td bgcolor=$color><font face='Angsana New'>$aCredit_d[$n]</td>\n".
				  	   "<td bgcolor=$color><font face='Angsana New'>$aPaidcscd[$n]</td>\n".
            //    "<td bgcolor=$color><font face='Angsana New'>$aPtright[$n]</td>\n".  
                "<td bgcolor=$color><font face='Angsana New'>$aIdname[$n]</td>\n".  
					  "<td bgcolor=$color><font face='Angsana New'>$aLastupdate[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

//�ʴ���¡�ä׹�Թ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'><br>�ʴ���¡�ä׹�Թ<br></th>";
    print "</table>";

   print "<table>";
   print "<tr>";
  print "<th bgcolor=9999CC>#</th>";
  print "<th bgcolor=9999C>����</th>";
  print "<th bgcolor=9999C>HN</th>";
 print " <th bgcolor=9999C>AN</th>";
  print "<th bgcolor=9999C>Ἱ�</th>";
 print " <th bgcolor=9999C>��¡��</th>";
  print "<th bgcolor=9999C>�Ҥ�</th>";
 print " <th bgcolor=9999C>�����Թ</th>";
 print " <th bgcolor=9999C>�ѵ��ôԵ</th>";
 print " <th bgcolor=9999C>�Է��</th>";
  print "<th bgcolor=9999C>���.���Թ</th>";
  print "</tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        if ($aPaid[$n]<0){
           print("<tr>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$num</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$time</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aHn[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aAn[$n]</td>\n". 
			    "<td bgcolor=99CCCC><font face='Angsana New'>$aVn[$n]</td>\n". 
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDepart[$n]</td>\n".
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aDetail[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPrice[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aPaid[$n]</td>\n".  
                 "<td bgcolor=99CCCC><font face='Angsana New'>$aCredit[$n]</td>\n".  
                 "<td bgcolor=99CCCC><font face='Angsana New'>$aPtright[$n]</td>\n".  
                   "<td bgcolor=99CCCC><font face='Angsana New'>$aIdname[$n]</td>\n".  
                   " </tr>\n");
          $num++;
		     }       
		        }
?>
</table>
    <br><a target=_BLANK href="opmchkcscd.php">��Ǩ�ͺ�Թ����Ѻ�����¹͡���µç</a>
    
   
 <br>&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<�����> </a>


<br>- CheckCode: �ʴ�੾��������� ��ͼԴ��Ҵ/��͹ <br>
11  ����к� InvNo<br>
12  InvNo ���<br>
16  ����к� AuthCode<br>
17  Authcode ���١��ͧ<br>
21  ����к� HN ���¡��<br>
22  HN �������㹷���¹������Է��<br>
26  ����к� MemberNo ���� Member No ���ç�Ѻ HN<br>
27  MemberNo �������㹷���¹������Է��<br>
28  MemberNo �١�ЧѺ�Է�ԷӸ�á���<br>
31  ����բ�������¹���������<br>
32  ��������¹���������١��ͧ<br>
33  ��������¹���������ç�Ѻ����¹<br>
41  �Ţ͹��ѵ�����������������(�óթء�Թ)<br>
42  �Ţ͹��ѵԹ��١���������������(�óթء�Թ)<br>
43  ���Ţ͹��ѵ��Թ���ҷ���˹� (�óթء�Թ) -- �ѧ�����<br>
44  ���ԡ����ѡ��� �Թ�������ҷ���˹�(�óթء�Թ) -- �ѧ�����<br>
45  ������Է��������Է���ԡ���µç�Ѻ����ѭ�ա�ҧ �� ���Է�� ���., �ʷ�. �繵� (�óթء�Թ)<br>
51  ����к� Station<br>
52  DTTran �ѹ�����������ࡳ�����˹�<br>
53  DTTran ����͡��ǧ���Է���ԡ<br>
54  DTTran ����͡��ǧ���͹��ѵԢ����ҤǺ���੾�� (OCPA/RDPA/DDPA)<br>
55  �ա�����ԡ����ѡ��� ��ӫ�͹� þ.���ǡѹ (���ԡ��ҧ�ѹ�ѹ)<br>
56  �ա�����ԡ����ѡ��� ��ӫ�͹� þ.���ǡѹ (���ԡ��ѹ���ǡѹ)<br>
57  ���ԡ����ѡ��� ��ӫ�͹�Ѻ����ԡ���Ҩ��¤�ҿ͡���ʹ��ҧ� (HD)<br>
61  Amount ���������Ū�Դ����Ţ, �� 0 ���� �Դź<br>
62  �������¡�� OPBills �ͧ BillTran ��� (�� InvNo �� key)<br>
63  ����¡�� OPBills �ͧ InvNo �����������Ǵ���١��ͧ<br>
64  �ʹ��� Amount, Paid �ͧ InvNo ������ç�Ѻ������ OPBills<br>
65  ��¡�� OPBills �������� BillTran �ӡѺ�Ҵ���<br>
66  ����к� BillNo �ó� Paid > 0<br>
67  Paid �ҡ���� Amount<br>
70  �͵�Ǩ�ͺ/���觢���������<br>
71  ����駼š�þԨ�ó��Է�ԡ�ÿ͡䵨ҡ ���. (��.�Է�ԫ�ӫ�͹)<br>
72  �ա���ԡ�����ͧ�Թ�ѵ�ҷ���˹�(100 �ҷ/�ѹ)<br>
73  �ա���ԡ����ѡ����蹷���������Ǣ�ͧ�Ѻ����ѡ��<br>
90  Dispense ID ��� �Ѻ�������������<br>
91  Dispense ID � Dispensing link �����Ѻ DispensedItems / �ӹǹ�����ҡѺ Items Count ����к�<br>
92  Dispense ID � DispensedItems link �����Ѻ Dispensing<br>
93  �ʹ�ԡ�ͧ Dispensing ��� DispensedItems ���ç�ѹ<br>
94  �Ҵ�����ŷ���˹���ҵ�ͧ�� (required)<br>
95  � BillTran �ա���ԡ����� ��Ҵ��������� BillDisp<br>
96  �բ�������� BillDisp  ������ա���ԡ������ BillTran<br>
97  �ʹ�ԡ��� Billtran �����ҡѺ Dispensing<br>
98  �ӹǹ�Թ�����ԡ���١��ͧ (charge # claim+paid+other)<br>
99  ��辺���������¡���ҷ�� þ. ����� (�ѧ�����)<br>
9A  �Ţ �. ᾷ�����١��ͧ����ٻẺ����˹�<br>
9B  ����¡���ҷ�������ԡ��к����µç (Glucosamine)<br>
