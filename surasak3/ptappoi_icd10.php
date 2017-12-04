<?
session_start();
    include("connect.inc");
	
	$appd=$appdate.' '.$appmo.' '.$thiyr;
	
	 print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ     ........................   $b1</b><br>";
	 print "<b>นัดมาวันที่</b> $appd ";
   	 print ".........<input type=button onclick='history.back()' value=' << กลับไป '>";
	 
	
	$b1=$_POST['b1'];
	
	if($b1=="DM"){
		$where="( icd10='E149' or icd10='E119' or icd10='E109' )";
	}else if($b1=="HT"){
		$where="icd10='I10'";
	}else{
		$where="";
	}
	
	$i=1;
	$query11="CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' ";
    $result11 = mysql_query($query11) or die("Query failed,app pp");
	 
	 
	$query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer,diag FROM appoint1 WHERE appdate = '$appd' ORDER BY doctor ASC    ";
	$result = mysql_query($query)or die("Query failed1");
	
	?>
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
<th bgcolor=6495ED>icd10</th>
<th bgcolor=6495ED>diag</th>
</tr>
    <?
	while (list ($hn,$ptname,$apptime,$came,$row_id,$age,$doctor,$depcode,$officer,$diag) = mysql_fetch_row ($result)) {
		

	
	
	//////////////////////////  list ทั้งหมด /////////////////////////
	$sql = "Select ptright,ptright1,idcard From opcard where hn = '$hn'  limit 1 ";
	$result1 = Mysql_Query($sql);
	list($ptright,$ptright1,$idcard) = Mysql_fetch_row($result1);


if(substr($ptright1,0,3)=='R07'){
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#66CDAA";
		
			}else{
				$color = "#FF0000";
		
			}
		}else if(substr($ptright1,0,3)=='R03'){
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%' )  limit 1 ";

			if(Mysql_num_rows(Mysql_Query($sql)) > 0){
				$color = "#66CDAA";
		
			}else{
				$color = "#FF0000";
		
			}
		}else{
			$color = "#66CDAA";
		}


		if(!empty($idcard)){
$sql2 = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
				$ptright2='R07 ประกันสังคม';
			}else{
				$ptright2='';
			}
	}else{
			$ptright2='ไม่มีเลขบัตร';
		}


if(!empty($hn)){
$sql3 = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
if(Mysql_num_rows(Mysql_Query($sql3)) > 0){
				$ptright3='R03 โครงการเบิกจ่ายตรง';
			}else{
				$ptright3='';
			}
	}else{
		$ptright3='ไม่มีHN';
		}

   //$num++;
   
	$ptrightall=$ptright2.$ptright3;
	//$ptrightall2=substr($ptright2.$ptright3,0,3);
	if(substr($ptright1,0,3)==substr($ptright2.$ptright3,0,3)){$color2="#66CDAA";}else{$color2="#FF0099";};
	
		
		
	$query1 = "SELECT *  FROM opday WHERE hn = '$hn' and ".$where." ";
	//echo $query1;
	$result1 = mysql_query($query1)or die("Query failed2");
	$row=mysql_num_rows($result1);
	$arr = mysql_fetch_array ($result1);
	
	if($row){
	print (" <tr>\n".
		 "  <td BGCOLOR=$color><font face='Angsana New'>$i</td>\n".
  		 "  <td BGCOLOR=$color><font face='Angsana New'>$apptime</td>\n".
    	 "  <td BGCOLOR=$color><font face='Angsana New'>$arr[hn]</td>\n".
    	 "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n".
   		 "  <td BGCOLOR=$color><font face='Angsana New'>$doctor</td>\n".
  		 "  <td BGCOLOR=$color><font face='Angsana New'>$depcode</td>\n".		
 		 "  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
  	     "  <td BGCOLOR=$color><font face='Angsana New'>$came</td>\n".
	 	 "  <td BGCOLOR=$color><font face='Angsana New'>$arr[icd10]</td>\n".
	     "  <td BGCOLOR=$color><font face='Angsana New'>$arr[diag]</td>\n".
		 " </tr>\n");
		 
		 $i++;
	
	}
	 
	}
?>
</table>
