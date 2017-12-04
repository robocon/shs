<?php
    $appd=$appdate.' '.$appmo.' '.$thiyr;
    print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจที่มีการตรวจเลือด</b><br>";
  
  print "<b>นัดมาวันที่</b> $appd ";
   
 print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
?>



<table>
 <tr>
  <th bgcolor=6495ED>#</th>
 
 <th bgcolor=6495ED>เวลา</th>
 
 <th bgcolor=6495ED>HN</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>ชื่อ</th>

 <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>LAB</th>
 
  <th bgcolor=6495ED><font face='Angsana New'>ผู้ออกใบนัด</th>
   
 </tr>


 <?php
    
 include("connect.inc");
    
 $query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer,date,patho FROM appoint WHERE appdate = '$appd' and patho<> 'NA'  and patho <>'' and patho <>'ไม่มี'  ORDER BY row_id ASC    ";
  
 $result = mysql_query($query)
        or die("Query failed");
  
  $num=0;
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age,$doctor,$depcode,$officer,$date,$patho) = mysql_fetch_row ($result)) 
{
     
   $num++;
   
     print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
        
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$apptime</td>\n".
     
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
      
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
     
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
	
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n".
			
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$officer</td>\n".
      
//     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$came</td>\n".

//	  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".

  // "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"apprxfrm.php? cPtname=$ptname&cHn=$hn&cAge=$age&nRow=$row_id\">พิมพ์</a></td>\n".
           " </tr>\n");
  
     }
  
  include("unconnect.inc");
?>

</table>




