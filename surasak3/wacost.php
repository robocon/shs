<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ����ѡ�Ҿ�Һ�ż����»�Сѹ�ѧ�� ";
  //  print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
//    print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ͼ���Сѹ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Ţ�ѵü�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ���ѵ�-���͹�¨�ҧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>����͡�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���������Ѻ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѡ������</th>
<th bgcolor=6495ED><font face='Angsana New'>��Һ�ԡ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>icd10��ѡ</th>
 <th bgcolor=6495ED><font face='Angsana New'>icd10�ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>icd9</th>

  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,note,diag,patho,xray,phar,emer,surg,physi,denta,other,doctor,idcard,icd10,icd9cm,icd101 FROM opday WHERE thidate LIKE '$today%' and ptright LIKE 'R07%'";
    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
 $totalpri=0;
    while (list ($ptname,$hn,$note,$diag,$patho,$xray,$phar,$emer,$surg,$physi,$denta,$other,$doctor,$idcard,$icd10,$icd9,$icd101) = mysql_fetch_row ($result)) {
        $n++;
$free=0;	
//      $time=substr($thidate,11);
        $etc=$emer+$surg+$physi+$denta+$other;
        $netprice=$patho+$xray+$phar+$etc;
if($phar>0){$netprice=$netprice+50;};

if($phar>0){$free=$free+50;};

   $totalpri=$totalpri+$netprice;

$doctor1=substr($doctor,0,5);
if  ($doctor1=='MD022'){$doctor2="00000";} else 
if  ($doctor1=='MD006'){$doctor2="12891";} else 
if  ($doctor1=='MD007'){$doctor2="12456";} else 
if  ($doctor1=='MD008'){$doctor2="16633";} else 
if  ($doctor1=='MD009'){$doctor2="19364";} else 
if  ($doctor1=='MD011'){$doctor2="20186";} else 
if  ($doctor1=='MD013'){$doctor2="19921";} else 
if  ($doctor1=='MD014'){$doctor2="20182";} else 
if  ($doctor1=='MD015'){$doctor2="21504";} else 
if  ($doctor1=='MD016'){$doctor2="21329";} else 
if  ($doctor1=='MD020'){$doctor2="3448";} else 
if  ($doctor1=='MD030'){$doctor2="5947";} else 
if  ($doctor1=='MD036'){$doctor2="20278";} else 
if  ($doctor1=='MD037'){$doctor2="10212";} else 
if  ($doctor1=='MD041'){$doctor2="27035";} else 
if  ($doctor1=='MD043'){$doctor2="1850";} else 
if  ($doctor1=='MD047'){$doctor2="24535";} else 
if  ($doctor1=='MD048'){$doctor2="29290";} else 
if  ($doctor1=='MD049'){$doctor2="37555";} else 
if  ($doctor1=='MD050'){$doctor2="37525";} else 
if  ($doctor1=='MD051'){$doctor2="24512";} else 
if  ($doctor1=='MD052'){$doctor2="19286";} else 
{$doctor2 ="";};

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
	 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$note</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xray</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$phar</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$etc</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$free</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor &nbsp;($doctor2)</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd101</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9</td>\n".
           " </tr>\n");
       }
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>



