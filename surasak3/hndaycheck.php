<form method="post" action="<?php echo $PHP_SELF ?>">
  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ�ӹǹ���駷�����ç��Һ��</p>
  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>HN</th>
 <th bgcolor=CD853F><font face='Angsana New'>AN</th>
 <th bgcolor=CD853F><font face='Angsana New'>VN</th>
  <th bgcolor=CD853F><font face='Angsana New'>���</th>
  <th bgcolor=CD853F><font face='Angsana New'>����-ʡ��</th>
  <th bgcolor=CD853F><font face='Angsana New'>�Է��</th>
 
  <th bgcolor=CD853F><font face='Angsana New'>�ä</th>
  
  <th bgcolor=CD853F><font face='Angsana New'>ICD ��ѡ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ICD �ͧ</th>
  <th bgcolor=CD853F><font face='Angsana New'>ᾷ��</th>
    <th bgcolor=CD853F>�ѹ�������</th>
    <th bgcolor=CD853F><font face='Angsana New'>�׹ OPD</th>


<th bgcolor=CD853F><font face='Angsana New'>�͡��</th>


    <th bgcolor=CD853F><font face='Angsana New'>������</th>

 
<th bgcolor=CD853F><font face='Angsana New'>���ѹ�֡</th>
<th bgcolor=CD853F><font face='Angsana New'>ŧ����</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101,thdatehn ,officer2,kew FROM opday WHERE hn = '$hn' ORDER BY thidate DESC   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$vn,$ptname,$ptright,$thidate,$diag,$doctor,$okopd,$toborow,$borow,$officer,$icd10,$icd101,$thdatehn,$officer2,$kew) = mysql_fetch_row ($result)) {


$sql = "SELECT hn FROM opday2 WHERE  thdatehn = '$thdatehn'  limit 2 ";
			if(Mysql_num_rows(Mysql_Query($sql)) > 1){
				$ptname1="<a  href=\"hndaycheck1.php?hn=$hn&thdatehn=$thdatehn\">$ptname</a>";

			}else{
				$ptname1="$ptname";
			}
$thidated=substr($thidate,8,2);
$thidatem=substr($thidate,5,2);
$thidatey=substr($thidate,0,4);
$thidatet=substr($thidate,10,9);
$thidateall=$thidated.'-'.$thidatem.'-'.$thidatey.'  '.$thidatet;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3 width=80 style='font-size:20px;'><font face='Angsana New'><a  href=\"appdaycheck.php?hn=$hn\">$hn</td>\n".
           "  <td BGCOLOR=F5DEB3 width=40 style='font-size:16px;'><font face='Angsana New'><a target=_BLANK href=\"dxipedit1.php?cAn=$an\">$an</td>\n".
  "  <td BGCOLOR=F5DEB3  width=20 style='font-size:20px;'><font face='Angsana New'>$vn</td>\n".
			     "  <td BGCOLOR=F5DEB3  width=20 style='font-size:20px;'><font face='Angsana New'>$kew</td>\n".
           "  <td BGCOLOR=F5DEB3  width=200 style='font-size:20px;'><font face='Angsana New'>$ptname1</td>\n".
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:16px;'><font face='Angsana New'>$ptright</td>\n".
          
           "  <td BGCOLOR=F5DEB3  width=80 style='font-size:16px;'><font face='Angsana New'>$diag</td>\n".
 "  <td BGCOLOR=F5DEB3  width=80 style='font-size:16px;'><font face='Angsana New'>$icd10</td>\n".
 "  <td BGCOLOR=F5DEB3  width=80 style='font-size:16px;'><font face='Angsana New'>$icd101 </td>\n".
           "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$doctor</td>\n".
 			"  <td BGCOLOR=F5DEB3  width=200 style='font-size:20px;'><font face='Angsana New'><b>$thidateall</b></a></td>\n".		   
   "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$okopd</td>\n".

       
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$toborow</td>\n".

           
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$borow</td>\n".

         
     "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$officer</td>\n".

 
			        "  <td BGCOLOR=F5DEB3 width=80 style='font-size:16px;'><font face='Angsana New'>$officer2</td>\n".

    
           " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
