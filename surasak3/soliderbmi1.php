<?php
    
session_start();

print "<font face='Angsana New'><b>��ª��� BMI ��õ�Ǩ�آ�Ҿ��Шӻ� $year</b>";
print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";

    include("connect.inc");

$year='2558';
 
   $query="SELECT  hn,vn,	ptname,age,camp,height,weight,pause,bmi,bp1,bp2  FROM condxofyear_so  where yearcheck=$year and age < 60 and bmi > 24.90 ORDER BY camp,bmi  DESC ";
   $result = mysql_query($query);
   if(Mysql_num_rows($result) > 0){
     
	?>

<table  align="center" style="font-family: Angsana New; font-size: 18px;">
 <tr>
 <th bgcolor="6495ED">no</th>	
 <th bgcolor="6495ED">HN</th>	
<th bgcolor="6495ED">����-ʡ��</th>
   <th bgcolor="6495ED">����</th>	
<th bgcolor="6495ED">�ѧ�Ѵ</th>
<th bgcolor="6495ED">�����٧</th>
 <th bgcolor="6495ED">���˹ѡ</th>
  <th bgcolor="6495ED">BP</th>
   <th bgcolor="6495ED">BP</th>
    <th bgcolor="6495ED">BMI</th>
  </tr>



<?php 


	$n=0; 
 while (list ($hn,$vn,$ptname,$age,$camp,$height,$weight,$pause,$bmi,$bp1,$bp2) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td ><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
			     "  <td ><font face='Angsana New'>$hn</td>\n".
				   "  <td><font face='Angsana New'>$ptname</td>\n".
				     "  <td ><font face='Angsana New'>$age</td>\n".  
					 "  <td ><font face='Angsana New'>$camp</td>\n".
					   "  <td ><font face='Angsana New'>$height</td>\n".
					     "  <td ><font face='Angsana New'>$weight</td>\n".
						   "  <td ><font face='Angsana New'>$bp1</td>\n".
						     "  <td ><font face='Angsana New'>$bp2</td>\n".
							   "  <td ><font face='Angsana New'>$bmi</td>\n".
       
               " </tr>\n");
               }

   
   include("unconnect.inc");
?>

</table>


<?php
   }
   ?>