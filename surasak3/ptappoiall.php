<?php
    
session_start();
/*
if($_SESSION["sIdname"] != "bbm"){
	echo "���������ҧ��Ѻ��ا";
	exit();
}
*/
$appd=$appdate.' '.$appmo.' '.$thiyr;
print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
print "<b>�Ѵ���ѹ���</b> $appd ";
print ".........<input type=button onclick='history.back()' value=' << ��Ѻ� '>";

include("connect.inc");
// $query="CREATE TEMPORARY TABLE appoint1 
// SELECT *, left( `doctor` , 5 ) AS codedoctor 
// FROM appoint 
// WHERE appdate = '$appd' ";

$query="CREATE TEMPORARY TABLE appoint1 
SELECT a.*, LEFT( a.`doctor` , 5 ) AS `codedoctor` 
FROM `appoint` AS a 
RIGHT JOIN (
	SELECT MAX(`row_id`) AS `lastid`, SUBSTRING(`doctor`, 1,5) AS `drcode`
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	GROUP BY `hn`, `drcode`
) AS b ON b.`lastid` = a.`row_id` 
WHERE a.`apptime` != '¡��ԡ��ùѴ' 
ORDER BY a.`date` ASC ";
$result = mysql_query($query) or die( mysql_error() );


  print "�ӹǹ�����¹Ѵ����ᾷ�� �����͡ᾷ�� = ��ª��ͼ�����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  codedoctor,COUNT(*) AS duplicate 
   FROM appoint1 where codedoctor <> 'MD007' 
   GROUP BY codedoctor 
   HAVING duplicate > 0 
   ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($codedoctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

list($doctor) = mysql_fetch_row(mysql_query("Select name From doctor where name like '{$codedoctor}%' limit 1 "));
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"ptappoiall2.php? doctor=$codedoctor&appd=$appd\">$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�Ѵ�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }

$query="SELECT  doctor,COUNT(*) AS duplicate FROM appoint1 where codedoctor = 'MD007' GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);

 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;


            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"ptappoiall2.php? doctor=$doctor&appd=$appd\">$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�Ѵ�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>


<?php
include("connect.inc");
$query = "CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' ";
$result = mysql_query($query) or die("Query failed,app");

print "�ӹǹ�����¹Ѵ<a target=_self  href='../nindex.htm'><<�����</a><br> ";

// Query ������
// $query="SELECT  detail,COUNT(*) AS duplicate 
// FROM appoint1 
// GROUP BY detail 
// HAVING duplicate > 0 
// ORDER BY doctor";

$query = "
SELECT a.`detail`, COUNT(a.`hn`) AS `duplicate` 
FROM `appoint` AS a 
INNER JOIN (
	SELECT `row_id`,`hn`, MAX(`row_id`) AS `id`, SUBSTRING(`doctor`, 1,5) AS `drcode`
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	GROUP BY `hn`, `drcode`
) AS b ON b.`id` = a.`row_id` 
WHERE a.`apptime` != '¡��ԡ��ùѴ' 
GROUP BY `detail`
";

$result = mysql_query($query);
$n=0;
$num=0;
while (list ($detail,$duplicate) = mysql_fetch_row ($result)) {
    $n++;
    $num= $duplicate+$num;
    print (" <tr>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"ptappoiall3.php? detail=$detail&appd=$appd\">$detail&nbsp;&nbsp;</a></td>\n".
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>�Ѵ�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
    " </tr>\n<br>");
}
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
include("unconnect.inc");
?>


<table>
 <tr>
  <th bgcolor=6495ED>#</th>
 
 <th bgcolor=6495ED>����</th>
 
 <th bgcolor=6495ED>HN</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>����</th>

 <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>
   
 <th bgcolor=6495ED><font face='Angsana New'>���˹�ҷ��</th>
 
 <th bgcolor=6495ED>��?</th>
<th bgcolor=6495ED>�ѹ�����͡㺹Ѵ</th>

 <th bgcolor=6495ED>�Է����ѡ</th>
 <th bgcolor=6495ED>�Է���ͧ</th>
  <th bgcolor=6495ED>���Է��</th>
 
 </tr>

<?php
    include("connect.inc");
    // $query = "SELECT hn,ptname,apptime,came,row_id,age,doctor,depcode,officer,date 
	// FROM appoint 
	// WHERE appdate = '$appd' 
	// ORDER BY row_id ASC    ";
	$query = "SELECT a.`hn`,a.`ptname`,a.`apptime`,a.`came`,a.`row_id`,a.`age`,a.`doctor`,a.`depcode`,a.`officer`,a.`date`
FROM `appoint` AS a 
RIGHT JOIN (
    SELECT MAX(`row_id`) AS `lastid`, SUBSTRING(`doctor`, 1,5) AS `drcode`
    FROM `appoint` 
    WHERE `appdate` = '$appd' 
    GROUP BY `hn`,`drcode`
) AS b ON b.`lastid` = a.`row_id`
ORDER BY a.`date` ASC";
  
 $result = mysql_query($query)
        or die("Query failed");
  
  $num=0;
    while (list ($hn,$ptname,$apptime,$came,$row_id,$age,$doctor,$depcode,$officer,$date) = mysql_fetch_row ($result)) 
{
     
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
}

/*

else  if(substr($ptright1,0,3)=='R33'){
		$sql = "Select flag From optdata where hn = '$hn'  order by row_id desc limit 1 ";

	$result = Mysql_Query($sql);
	list($flag) = Mysql_fetch_row($result);
	
					if($flag==""){
									$color = "#66CDAA";
		
										}else{
									$color = "#FF0000";
		
										}
										
}


*/


else if(substr($ptright1,0,3)=='R33'){
		$sql = "Select hn,flag From optdata where hn = '$hn' AND  flag !='E' limit 1 ";
		if(Mysql_num_rows(Mysql_Query($sql)) > 0){
			$color = "#66CDAA";
		
		}else{
			$color = "#FF0000";
		
		}
}
else{


		$color = "#66CDAA";
}





if(!empty($idcard)){
	$sql2 = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
	if(Mysql_num_rows(Mysql_Query($sql2)) > 0){
		$ptright2='R07 ��Сѹ�ѧ��';
	}else{
		$ptright2='';
	}
}else{
	$ptright2='������Ţ�ѵ�';
}


if(!empty($hn)){
	$sql3 = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";			
	if(Mysql_num_rows(Mysql_Query($sql3)) > 0){
		$ptright3='R03 �ç����ԡ���µç';
	}else{
		$ptright3='';
	}
}else{
	$ptright3='�����HN';
}


$num++;
   
$ptrightall=$ptright2.$ptright3;
//$ptrightall2=substr($ptright2.$ptright3,0,3);
	if(substr($ptright1,0,3)==substr($ptright2.$ptright3,0,3)){$color2="#66CDAA";}else{$color2="#FF0099";};

	if(substr($ptright1,0,3)==substr($ptright2.$ptright3,0,3)&&substr($ptright1,0,3)==substr($ptright,0,3)){$color2="#66CDAA";}else{$color2="#FF0099";};
	
     print (" <tr>\n".
         
		 "  <td BGCOLOR=$color><font face='Angsana New'>$num</td>\n".
        
   "  <td BGCOLOR=$color><font face='Angsana New'>$apptime</td>\n".
     
      "  <td BGCOLOR=$color><font face='Angsana New'><a href=\"printpt.php? cHn=$hn&cPtname=$ptname&cIdcard=$idcard&cPtright1=$ptright1\" target=\"_blank\"  >$hn</a></td>\n".
      
     "  <td BGCOLOR=$color><font face='Angsana New'>$ptname</td>\n".
     
   "  <td BGCOLOR=$color><font face='Angsana New'>$doctor</td>\n".
	
  "  <td BGCOLOR=$color><font face='Angsana New'>$depcode</td>\n".
			
  "  <td BGCOLOR=$color><font face='Angsana New'>$officer</td>\n".
      
     "  <td BGCOLOR=$color><font face='Angsana New'>$came</td>\n".

	  "  <td BGCOLOR=$color><font face='Angsana New'>$date</td>\n".
	     "  <td BGCOLOR=$color2><font face='Angsana New'>$ptright1</td>\n".
		  "  <td BGCOLOR=$color2><font face='Angsana New'>$ptright</td>\n".
		   "  <td BGCOLOR=$color2><font face='Angsana New'>$ptrightall</td>\n".



  // "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"apprxfrm.php? cPtname=$ptname&cHn=$hn&cAge=$age&nRow=$row_id\">�����</a></td>\n".
           " </tr>\n");
  
     }
  
  include("unconnect.inc");
?>

</table>

<div ><a href="ptappoiall_chk.php?appd=<?=$appd;?>" target="_blank">�����㺵�Ǩ�ͺ�Է���</a></div>


