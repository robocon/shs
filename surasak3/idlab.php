<?php
    $cHn="";
    $cPtname="";
    $cPtright="";
    $nRunno="";
	$tvn="";
    session_register("nRunno");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
    session_register("tvn");
?>
<form method="POST" action="<?php echo $PHP_SELF ?>">
  <p>�����¹͡ ID</p>
  <p>&nbsp;&nbsp;ID&nbsp;
  <input type="text" name="idcard" size="20" id="aLink"><script type="text/javascript">

document.getElementById('aLink').focus();

</script></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="        ��ŧ        " name="B1"></p>
</form>

<?php
include("connect.inc");
if((!empty($hn) && $confirm != true)|(!empty($idcard))){

$today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

$thdatehn=$d.'-'.$m.'-'.$yr.$hn;
 $query = "SELECT hn, concat(yot,' ',name,' ',surname) as ptname, ptright FROM opcard WHERE idcard = '$idcard'  limit 1 ";

 $result = mysql_query($query) or die(Mysql_Error());
 list($xxx,$yyy,$zzz) = Mysql_fetch_row($result);
	
	print "HN :$xxx<br>";
   	print "$yyy<br>";
   	print "�Է�ԡ���ѡ�� :$zzz";
    print "<br><a href='idlab.php?hn=".$xxx."&confirm=true'>!���Ͷ١��ͧ ����¡�õ���</a>";

}else If (!empty($hn) && !empty($confirm)){
	//$tvn=$vn;
	//$cHn=$hn;
    include("connect.inc");
    $vnlab = 'EX93 �͡ VN �� LAB';   
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatehn=$d.'-'.$m.'-'.$yr.$hn;
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
// ��Ǩ�����ŧ����¹�����ѧ
    $query = "SELECT * FROM opday WHERE thdatehn = '$thdatehn' Order by row_id DESC ";
    $result = mysql_query($query)
        or die("Query failed,opday");

		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

 //     $cHn=$row->hn;
        if(mysql_num_rows($result)){
  //�ó�ŧ����¹����
  	      $cHn=$row->hn;
  	      $cPtname=$row->ptname;
 	       $cPtright=$row->ptright;
  	  $tvn=$row->vn;
  	      //print "VN  :$tvn<br>";
 	      // print "HN :$cHn<br>";
   	     //print "$cPtname<br>";
   	     //print "�Է�ԡ���ѡ�� :$cPtright";
    	    //print "<br><a href='labask.php'>!���Ͷ١��ͧ ����¡�õ���</a>";
			 echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
			}
else  {
//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ
	    $query = "SELECT * FROM opcard WHERE hn = '$hn'";
	    $result = mysql_query($query) or die("Query failed");

	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
			     	              }
	        if(!($row = mysql_fetch_object($result)))
	            continue;
			    	      }
        if(mysql_num_rows($result)){
	      $cHn=$row->hn;
	      $cYot = $row->yot;
	      $cName = $row->name;
	      $cSurname = $row->surname;
          $cPtname=$cYot.' '.$cName.'  '.$cSurname;
	      $cPtright = $row->ptright;
          $cGoup=$row->goup;
	      $cCamp=$row->camp;
          $cNote=$row->note;
   $cIdcard=$row->idcard;

    //print"$cPtname $cGoup<br>";

    //��˹���� VN �ҡ runno table
	    $query = "SELECT * FROM runno WHERE title = 'VN'";
	    $result = mysql_query($query) or die("Query failed");
	    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
				              }
	        if(!($row = mysql_fetch_object($result)))
	            continue;
				                                       }
	    $nVn=$row->runno;
	    $dVndate=$row->startday;
	    $dVndate=substr($dVndate,0,10);
	    $today = date("Y-m-d");  
                    //�ѧ�������¹�ѹ���
                    if($today==$dVndate){
                         $nVn++;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	   $tvn=$nVn;
//	        print "�������Ţ VN = $nVn<br>";
			     }
//�ѹ����
                    if($today<>$dVndate){    
                         $nVn=1;
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	    $tvn=$nVn;
//                         print "�ѹ����  ����� VN = $nVn <br>";
	                                     }	
//ŧ����¹� opday table
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp,note,toborow,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	                    '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','$cIdcard','".$_SESSION["sOfficer"]."');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");
///
      //  print "VN  :$tvn<br>";
       // print "HN :$cHn<br>";
       // print "$cPtname<br>";
       // print "�Է�ԡ���ѡ�� :$cPtright";
       // print "<br><a href='labask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=labask.php\">";
                            }
else {
   print"��辺 HN $hn ��Ǫ����¹";
	}
    }
//runno  for chktranx
    $query = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $nRunno=$row->runno;
    $nRunno++;

    $query ="UPDATE runno SET runno = $nRunno WHERE title='depart'";
    $result = mysql_query($query)
        or die("Query failed");
//end  runno  for chktranx
/*
        print "VN  :$tvn<br>";
        print "HN :$cHn<br>";
        print "$cPtname<br>";
        print "�Է�ԡ���ѡ�� :$cPtright";
        print "<br><a href='labask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
*/

    include("unconnect.inc");
   }
?>

