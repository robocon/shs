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
$wardname="�ͼ��������";	
$sortname="���";
	}elseif($lbedcode=='43'){
$wardname="�ͼ������ٵ�";	
$sortname="�ٵ�";
	}elseif($lbedcode=='44'){
$wardname="�ͼ�����ICU";	
$sortname="ICU";
	}elseif($lbedcode=='45'){
$wardname="�ͼ����¾����";	
$sortname="�����";
	}


?>
  <span class="font1"><?=$wardname;?> (��¡�������) &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
   <a target="_blank" href="ffwprn_new.php?id=<?=$lbedcode;?>">�������¡�������</a>&nbsp;&nbsp;&nbsp;&nbsp;<a target="_blank" href="ffwprn_new2.php?id=<?=$lbedcode;?>&typefood=<?=$_POST['menu'];?>">�����ѵ������</a>
   &nbsp;&nbsp;&nbsp;<a target=_self  href="../nindex.htm">/-----��Ѻ����</a>
  </span>
  

<table class="font1">
  <tr>
    <th bgcolor=6495ED class="font1">��§</th>
    <th bgcolor=6495ED class="font1">HN</th>
    <th bgcolor=6495ED class="font1">���ͼ�����</th>
    <th bgcolor=6495ED class="font1">�ä</th>
    <th bgcolor=6495ED class="font1">�ä��Шӵ��</th>
    <th bgcolor=6495ED class="font1">�����</th>
    <th bgcolor=6495ED class="font1">����</th>
    <th bgcolor=6495ED class="font1">���˹ѡ</th>
    <th bgcolor=6495ED class="font1">��ǹ�٧</th>
    <th bgcolor=6495ED class="font1">BMI</th>
  </tr>
  <?php
   $ckdate=(date("Y")+543).date("-m-d"); 
 	$datenow=(date("Y")+543).date("-m-d H:i:s"); 
	
    $query = "SELECT an,bed,ptname,diagnos,diag1,food,bedcode,age,hn,ptright,bedname,bedpri
                     FROM bed WHERE bedcode LIKE '$lbedcode%' ORDER BY bed ASC ";
  
    $result = mysql_query($query) or die("Query failed");

    while (list ($an,$bed,$ptname,$diagnos,$diag1,$food,$bedcode,$age,$hn,$ptright,$bedname,$bedpri) = mysql_fetch_row ($result)) {

		if($diag1 == "�ä��Шӵ��"){
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

