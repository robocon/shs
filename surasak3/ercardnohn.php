
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>������ѹ�֡������  �ä/�ѵ���� ��ͧ�ء�Թ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p></p>
  <p>����� HN ��������ä�����¹͡</p>
  <p>���Ҥ���ҡ&nbsp; HN</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hnno" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>

</form>
<?php

    $today="$d-$m-$yr";

       $today="$yr-$m-$d";

?>
<table>

 <tr>

 
 <th bgcolor=6495ED>#</th> 
<th bgcolor=6495ED>�ѹ</th>

 
 <th bgcolor=6495ED>����</th>

  
<th bgcolor=6495ED>HN</th>


  <th bgcolor=6495ED>����</th>


  <th bgcolor=6495ED>AN</th>

 
 <th bgcolor=6495ED>�ä�ҡOPD</th>

  
<th bgcolor=6495ED>ᾷ��</th>

 
 <th bgcolor=6495ED><font face='Angsana New'>ŧ��¡��ER</th>

  </tr>




<?php

   
If (!empty($hnno)){
    include("connect.inc");
    global $hnno;
 $query = "SELECT vn,thdatehn,thidate,hn,ptname,an,diag,doctor,erok FROM opday WHERE erok='N'and hn ='$hnno' ";

   
 $result = mysql_query($query)

        or die("Query failed");



   
 while (list ($vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$erok) = mysql_fetch_row ($result)) {

     
   $time=substr($thidate,11);
	
$num++;

       
 print (" <tr>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".

    
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$thidate</td>\n".

   
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'><a   href=\"dxeredit.php? cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cGoup=$goup&cDxg=$dxgroup&cIcd10=$icd10&cVn=$vn\">$hn</td>\n".

        
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</a></td>\n".

       
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".

     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".

     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".

      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$erok</td>\n".

   
        " </tr>\n");

       }

   
include("unconnect.inc");
       }
?>
</table>