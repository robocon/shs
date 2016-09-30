 <style type="text/css">
<!--
.font1 {
	font-family:"TH Niramit AS";
	font-size:18px;
}
-->
</style>
<? 
session_start();
include("connect.inc");
	
$lbedcode=substr($_GET['code'],0,2);

if($lbedcode=='42'){
$wardname="หอผู้ป่วยรวม";	
$sortname="รวม";
	}elseif($lbedcode=='43'){
$wardname="หอผู้ป่วยสูติ";	
$sortname="สูติ";
	}elseif($lbedcode=='44'){
$wardname="หอผู้ป่วยICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="หอผู้ป่วยพิเศษ";	
$sortname="พิเศษ";
	}


?>
  <span class="font1"><?=$wardname;?> (รายการอาหาร) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target="_blank" href="ffwprn_new.php?id=<?=$lbedcode;?>">พิมพ์รายการอาหาร</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="ffwprn_new2.php?id=<?=$lbedcode;?>&typefood=<?=$_POST['menu'];?>">พิมพ์บัตรอาหาร</a>
   &nbsp;&nbsp;&nbsp;<a target=_self  href="../nindex.htm">/-----กลับเมนู</a>
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
   $ckdate=(date("Y")+543).date("-m-d"); 
 	$datenow=(date("Y")+543).date("-m-d H:i:s"); 
	
    $query = "SELECT an,bed,ptname,diagnos,diag1,food,bedcode,age,hn,ptright,bedname,bedpri
                     FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bed ASC ";
  
    $result = mysql_query($query) or die("Query failed");

    while (list ($an,$bed,$ptname,$diagnos,$diag1,$food,$bedcode,$age,$hn,$ptright,$bedname,$bedpri) = mysql_fetch_row ($result)) {

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
           "  <td BGCOLOR=#FFCC66><a target=_BLANK  href=\"food_ex.php?cAn=$an\">$food</a></td>\n".
		   "  <td BGCOLOR=66FFCC>$age</td>\n".
		   "  <td BGCOLOR=66FFCC>$weight</td>\n".
		   "  <td BGCOLOR=66FFCC>$height</td>\n".
		   "  <td BGCOLOR=66FFCC>$bmi</td>\n".
           " </tr>\n");
		   
		   ///////////////////////////  FOOD  //////////////////////////////
		   
 if($an!=''){
	 
		   $select="select * from food where regisdate like '$ckdate%' and an='$an' and typefood='".$_POST['menu']."' ";
		   
		  // echo $select."<br>";
		   $strresult = mysql_query($select) or die("Query failed food");
		   $rows=mysql_num_rows($strresult);
		   
		   $arr=mysql_fetch_array($strresult);
		   
		  if($rows){
			  
$update="UPDATE `food` SET 
`an` = '$an',
`ptname` = '$ptname',
`ptright` = '$ptright',
`bedcode` = '$bedcode',
`bedpri` = '$bedpri',
`food` = '$food',
`typefood` = '".$_POST['menu']."',
`bedname` = '$bedname' ,
officer='".$sOfficer."' WHERE  row_id='".$arr['row_id']."' ";
			
 $result1 = mysql_query($update) or die("Query failed update");			
			///echo $update."<br>";  
		  }else{
		   
		   $insert="INSERT INTO `food` (`regisdate` , `an` , `ptname` , `ptright` , `bedcode` , `bedpri` , `food` , `typefood` , `bedname` , `officer` )VALUES ('$datenow', '$an', '$ptname', '$ptright', '$bedcode', '$bedpri', '$food', '".$_POST['menu']."', '$bedname','".$sOfficer."')";
	
	 $result2 = mysql_query($insert) or die("Query failed insert");			   
		   //echo $insert."<br>";

		  } // end  if($rows)
        }
		
	}
    include("unconnect.inc");
?>
</table>

