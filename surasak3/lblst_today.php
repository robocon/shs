<?php
	$d = date("d");
	$m = date("m");
	$yr = date("Y")+543;
    $today="$yr-$m-$d";
    
    // Just for testing
    // $today = ( date('Y')+543 ).date('-08-30');

?>
<table width="100%">
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>รายละเอียด</th>
  <th bgcolor=6495ED>ราคา</th>
  <th bgcolor=6495ED>ยกเลิก</th>


  
</tr>

<?php
//    $detail="ค่ายา";
    $num=0;
    include("connect.inc");

    $query = "SELECT date,ptname,hn,an,depart,detail,price,paid,row_id,accno,ptright,lab FROM depart WHERE date LIKE '$today%' and depart='PATHO' AND (lab = 'DR' OR lab = 'ER') ";


    $result = mysql_query($query) or die("Query failed");
    while (list ($date,$ptname,$hn,$an,$depart,$detail,$price,$paid,$row_id,$accno,$ptright,$lab) = mysql_fetch_row ($result)) {
    $num++;
	
	if(empty($lab)){
		$bgcolor= "'#FF9966'";
	}else{
		$bgcolor= "'#66CDAA'";
	}

    $time=substr($date,11);
    $totalpri=$totalpri+$price;
        print (" <tr>\n".
			"  <td BGCOLOR=".$bgcolor.">$hn</td>\n".
           "  <td BGCOLOR=".$bgcolor."><a target='right'  href=\"invdetail.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
			"  <td BGCOLOR=".$bgcolor.">$price</td>\n".
			"  <td BGCOLOR=".$bgcolor."><A HREF=\"del_lab.php?sDate=".urlencode($date)."&nRow_id=$row_id\" target=\"_blank\">ยกเลิก</A></td>\n".


           
			" </tr>\n");
       }
   
	  include("unconnect.inc");
?>
</table>





