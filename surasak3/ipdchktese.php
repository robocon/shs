<form method="post" action="
<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;��ª��ͼ����µ�� ICD 10 ��ѡ&nbsp;&nbsp;&nbsp;
  
<input type="text" name="icd10" size="20">&nbsp;&nbsp;
<font face="Angsana New">&nbsp;&nbsp; 
��&nbsp;
  <input type="text" name="thiyr" size="10"> <br>��ҵ�ͧ������͡��͹�����ѹ���� ���������е��������͹����ѹ �� 2550-06-03 �繵�
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>


<table>

 <tr>

  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>�ѹ-����</th>
 
<th bgcolor=CD853F>HN</th>
 
 <th bgcolor=CD853F>����-ʡ��</th>
  
<th bgcolor=CD853F>�ä</th>

  <th bgcolor=CD853F>ICD10 ��ѡ</th>
    <th bgcolor=CD853F>ICD10 �ͧ</th>
  

  <th bgcolor=CD853F>�ѵ� ���.</th>
  <th bgcolor=CD853F>�������</th>
  <th bgcolor=CD853F>�Ӻ�</th>
  <th bgcolor=CD853F>�����</th>
  <th bgcolor=CD853F>�ѧ��Ѵ</th>
  <th bgcolor=CD853F>���Ѿ��</th>
  
</tr>


<?php
 

  $num=0;
If (!empty($icd10)){
    include("connect.inc");
    global $icd10;
   

 $query = "SELECT a.hn,a.an,a.ptname,a.date,b.sex FROM ipcard as a, opcard as b WHERE a.hn=b.hn and a.date LIKE '$thiyr%' and b.sex='�' ORDER by b.sex  ";
    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($hn,$an,$ptname,$date,$sex) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;



 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$hn</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$an</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$date</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$sex</td>\n".
      
  
      
         " </tr>\n");

	   if($icd10 != ""){
				if(!isset($sum[$icd10]))
					$sum[$icd10] = 0;
				$sum[$icd10] = $sum[$icd10]+1;
			}
       }




include("unconnect.inc");
       }
?>

