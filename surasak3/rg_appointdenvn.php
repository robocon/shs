<?php

	session_start();
	session_unregister("nVn");  
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cPtright");
	session_unregister("cPtright1");
	session_unregister("nVn");  
	session_unregister("cAge");  
	session_unregister("cNote");  
	session_unregister("cIdcard"); 
	session_unregister("cIdguard"); 
	$nRunno="";
	$vAN="";
	$cPtname="";
	$cPtright="";    
	$nVn="";
	$cAge="";
	$borow='';
	session_register("nVn");  
	session_register("nRunno");  
	session_register("vAN");
	session_register("cHn");  
	session_register("cPtname");
	session_register("cPtright");
	session_register("cPtright1");
	session_register("nVn");  
	session_register("cAge");  
	session_register("cNote");  
	session_register("cIdcard");  
	session_register("cIdguard");  

	Function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

	include("connect.inc");
	
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";
	
	$hn = $_GET["cHn"];
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  
    $thdatehn=$d.'-'.$m.'-'.$yr.$hn;
    $thidate = (date("Y")+543).date("-m-d H:i:s"); 
	
	$sql = "Select * From appoint  where hn = '".$_GET["cHn"]."' AND appdate = '".date("d")." ".$month[date("m")]." ".(date("Y")+543)."' limit 0,1 ";
		$result = Mysql_Query($sql);
		$rows = Mysql_num_rows($result);

		if($rows == 0){
			echo "����������繼����¹Ѵ";
			exit();
		}
	if(!empty($_GET["cHn"])){
	/*
	//$tvn=$vn;
	//$cHn=$hn;
	$hn = $_GET["cHn"];
    include("connect.inc");
    $vnlab = 'EX07 �ѹ�����';
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
  	    $_SESSION["nVn"] = $tvn;

	$query = "SELECT dbirth, idguard,idcard FROM opcard WHERE hn = '$hn' Order by row_id DESC limit 0,1";
    $result = mysql_query($query);
	$arr = Mysql_fetch_assoc($result);
		$cAge=calcage($arr["dbirth"]);
		$cIdguard = $arr["idguard"];
		$cIdcard = $arr["idcard"];
			}else{
//�Ң����Ũҡ opcard �ͧ $cHn ��������㹡ó�ŧ����¹���� �����ѧ���ŧ*/
	    $query = "SELECT * FROM opcard WHERE hn = '".$hn."' ";
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
		  $cAge=calcage($row->dbirth);
		$cIdguard = $row->idguard;
		$cIdcard = $row->idcard;

    //print"$cPtname $cGoup<br>";

    /*//��˹���� VN �ҡ runno table
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
	    $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,ptname, ptright,goup,camp,note,toborow,time1,idcard,dxgroup)VALUES('$thidate','$thdatehn','$cHn','$nVn', '$thdatevn','$cPtname','$cPtright','$cGoup','$cCamp','$cNote','$vnlab','".date("H:i:s")."','$cIdcard','21');";
	    $result = mysql_query($query) or die("Query failed,cannot insert into opday");
///
	$_SESSION["nVn"] = $tvn;
	}*/
    }

	
    include("unconnect.inc");
   }

echo "<meta http-equiv='refresh' content='0; URL = vnprint.php?toborow=EX07 �ѹ�����' />";
?>