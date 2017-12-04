  <style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size:18px;
}
-->
</style>
 <span class="font1">หอผู้ป่วยสูตินรี (รายการอาหาร) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target="_blank" href="ffwprn_new.php?id=43">พิมพ์รายการอาหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="ffwprn_new2.php?id=43">พิมพ์บัตรอาหาร</a>
   &nbsp;&nbsp;&nbsp <a target=_self  href="../nindex.htm"><<กลับเมนู</a>
 </span>
<table class="font1">
  <tr>
  <th bgcolor=6495ED class="font1">เตียง</th>
    <th bgcolor=6495ED class="font1">HN</th>
    <th bgcolor=6495ED class="font1">ชื่อผู้ป่วย</th>
    <th bgcolor=6495ED class="font1">โรค</th>
    <th bgcolor=6495ED class="font1">โรคประจำตัว</th>
    <th bgcolor=6495ED class="font1">อาหาร</th>
     
    <th bgcolor=6495ED class="font1">อายุ</th>
    <th bgcolor=6495ED class="font1">น้ำหนัก</th>
    <th bgcolor=6495ED class="font1">ส่วนสูง</th>
    <th bgcolor=6495ED class="font1">BMI</th>
  </tr>
  <?php
    include("connect.inc");
 
    $query = "SELECT bed,ptname,diagnos,diag1,food,bedcode,age,hn
                     FROM bed WHERE bedcode LIKE '43%' ORDER BY bed ASC ";
  
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($bed,$ptname,$diagnos,$diag1,$food,$bedcode,$age,$hn) = mysql_fetch_row ($result)) {

		if($diag1 == "โรคประจำตัว"){
			$diag1_value = "";
		}else{
			$diag1_value = $diag1;
		}


 $sql = "SELECT thidate,weight,height FROM opd WHERE  hn ='$hn' order by thidate DESC limit 1 ";

   list($thidate,$weight,$height) = mysql_fetch_row(Mysql_Query($sql));

   $bmi='';
 if($height != "" && $height > 0 && $weight != "" && $weight > 0){$ht = $height/100;
	$bmi =	number_format(($weight/($ht*$ht)),2); }
		

        print (" <tr>\n".
           "  <td BGCOLOR=66FFCC>$bed</td>\n".
			  "  <td BGCOLOR=66FFCC>$hn</td>\n".
           "  <td BGCOLOR=66FFCC>$ptname</td>\n".
           "  <td BGCOLOR=66FFCC>$diagnos</td>\n".
      "  <td BGCOLOR=#00FF66>$diag1_value</td>\n".
           "  <td BGCOLOR=#FFCC66>$food</td>\n".
				    "  <td BGCOLOR=66FFCC>$age</td>\n".
			    "  <td BGCOLOR=66FFCC>$weight</td>\n".
			    "  <td BGCOLOR=66FFCC>$height</td>\n".
		
			    "  <td BGCOLOR=66FFCC>$bmi</td>\n".
           " </tr>\n");
        }
    include("unconnect.inc");
?>
</table>

