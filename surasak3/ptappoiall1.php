<table>
 <tr>
  <th bgcolor=6495ED>#</th>
 
 <th bgcolor=6495ED>เวลา</th>
 
 <th bgcolor=6495ED>HN</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>

 <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>แผนก</th>
   
 <th bgcolor=6495ED><font face='Angsana New'>เจ้าหน้าที่</th>
 
 <th bgcolor=6495ED>มา?</th>
<th bgcolor=6495ED>พิมพ์ใบสั่งยา?</th>
 
 </tr>

<?php
    include("connect.inc");
   
 $query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer FROM appoint WHERE appdate = '$appd' and doctor = '$cdoctor'  ";
  
 $result = mysql_query($query)
        or die("Query failed");
  
  $num=0;
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age,$doctor,$depcode,$officer) = mysql_fetch_row ($result)) 
{
     
   $num++;
   
     print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
        
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
     
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
	
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depcode</td>\n".
			
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".
	
   "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"apprxfrm.php? cPtname=$ptname&cHn=$hn&cAge=$age&nRow=$row_id\">พิมพ์</a></td>\n".
           " </tr>\n");
  
     }
  
  include("unconnect.inc");
?>

</table>





