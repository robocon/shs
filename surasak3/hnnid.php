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
<script>
function checkType(){
	if(document.form3.servicd1.checked==false&&document.form3.servicd2.checked==false){
		alert('��س����͡��äԴ��������');
		return false;
	}
	else{
		return true;
	}
}
</script>
<form name="form3" method="POST" action="<?php echo $PHP_SELF ?>" onsubmit="return checkType();">
  <p>�����¹͡  HN (��ҡ�Ǫ����¹)</p>
  <p>&nbsp;&nbsp;HN&nbsp;&nbsp;<input type="text" name="hn" size="12">
  <br />
    <br />
  <input type="radio" value="1" name="servicd" id="servicd1"  /> �Դ��Һ�ԡ�� 50 �ҷ
  <br />
  <input type="radio" value="0" name="servicd" id="servicd2" /> 
  ���Դ��Һ�ԡ�� 50 �ҷ
  </p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="        ��ŧ        " name="B1"></p>
</form>

<?php
 if(!empty($hn)){
	//$tvn=$vn;
	//$cHn=$hn;
    include("connect.inc");
    $vnlab = 'EX92 �͡ VN �� �ѧ���';   
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
		$thdatevn=$d.'-'.$m.'-'.$yr.$tvn;
////////////�Դ�Թ 50 �ҷ
		if($_POST['servicd']=="1"){
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
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
				$result = mysql_query($query) or die("Query failed");

				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$tvn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$tvn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}
		}
		////////////////////////////////���Դ�Թ 50 �ҷ
		
  	      print "VN  :$tvn<br>";
 	       print "HN :$cHn<br>";
   	     print "$cPtname<br>";
   	     print "�Է�ԡ���ѡ�� :$cPtright<br>";

 $sql = "SELECT idguard FROM opcard WHERE hn = '".$cHn."' Order by row_id DESC limit 1";
    list($idguard) = mysql_fetch_row(Mysql_Query($sql));
  
    print "������ : $idguard";


    	    print "<br><a href='erask.php'>!���Ͷ١��ͧ ����¡�õ���</a>";
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
$nPhaok = 'p';
             	         $thdatevn=$d.'-'.$m.'-'.$yr.$nVn;
      	         $query ="UPDATE runno SET runno = $nVn,startday=now()  WHERE title='VN'";
	         $result = mysql_query($query) or die("Query failed");
	    $tvn=$nVn;
//                         print "�ѹ����  ����� VN = $nVn <br>";
	                                     }	
//ŧ����¹� opday table
$nPhaok = 'p';
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp,note,toborow,phaok,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$nVn',
	                    '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','$nPhaok',' $cIdcard','".$_SESSION["sOfficer"]."');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");
///
////////////�Դ�Թ 50 �ҷ
		if($_POST['servicd']=="1"){
			$check = "select * from depart where hn = '".$cHn."' and  detail = '(55020/55021 ��Һ�ԡ�ü����¹͡)' and date like '".(date("Y")+543).date("-m-d")."%' ";
			$resultcheck = mysql_query($check);
			$cal = mysql_num_rows($resultcheck);
			if($cal==0){
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
				$result = mysql_query($query) or die("Query failed");

				$query = "INSERT INTO depart(chktranx,date,ptname,hn,an,depart,item,detail,price,sumyprice,sumnprice,paid, idname,accno,tvn,ptright)VALUES('".$nRunno."','".$thidate."','".$cPtname."','".$cHn."','','OTHER','1','(55020/55021 ��Һ�ԡ�ü����¹͡)', '50','50','0','','".$_SESSION["sOfficer"]."','0','".$tvn."','".$cPtright."');";
				$result = mysql_query($query);
				$idno=mysql_insert_id();
			 
				$query = "INSERT INTO patdata(date,hn,an,ptname,item,code,detail,amount,price,yprice,nprice,depart,part,idno,ptright) VALUES('".$thidate."','".$cHn."','','".$cPtname."','1','SERVICE','(55020/55021 ��Һ�ԡ�ü����¹͡)','1','50','50','0','OTHER','OTHER','".$idno."','".$cPtright."');";
				$result = mysql_query($query) or die("Query failed,cannot insert into patdata");
				
				$query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '".$tvn."' ";
      			$result = mysql_query($query) or die("Query failed,update opday");
			}
		}
		////////////////////////////////���Դ�Թ 50 �ҷ
        print "VN  :$tvn<br>";
        print "HN :$cHn<br>";
        print "$cPtname<br>";
        print "�Է�ԡ���ѡ�� :$cPtright";
        print "<br><a href='erask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
                            }
else {
   print"��辺 HN $hn ��Ǫ����¹";
	}
    }

//��Ǩ�����ŧ����¹�ѧ��������ѧ� Opday2

$query = "SELECT count(hn) FROM opday2 WHERE thdatehn = '$thdatehn' AND (left(toborow,5) = 'EX 92'  ) Order by row_id DESC limit 1 ";
$result = Mysql_Query($query);
list($count_opday2) = Mysql_fetch_row($result);

if($count_opday2 == 0){
	
	$query = "SELECT * FROM opcard WHERE hn = '$hn' limit 1 ";
	 $result = mysql_query($query) or die("Query failed");
	$row = mysql_fetch_object($result);
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

	$query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,ptname,
                	     ptright,goup,camp,note,toborow,phaok,idcard,officer)VALUES('$thidate','$thdatehn','$cHn','$tvn',
	                    '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','$nPhaok',' $cIdcard','".$_SESSION["sOfficer"]."');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");

		
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
        print "<br><a href='erask.php'>���Ͷ١��ͧ ����¡�õ���</a>";
*/

    include("unconnect.inc");
   }
?>

