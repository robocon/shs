<?php
   session_start();
//   session_destroy();
    session_unregister("dDate");  
    session_unregister("sHn");   
    session_unregister("sAn");
    session_unregister("sPtname");
    session_unregister("sDoctor");
    session_unregister("sAge");
    session_unregister("sPtright");
    session_unregister("sReport");
    session_unregister("sDetail");
    session_unregister("sRow_id"); 

    $dDate=$_GET["sDate"];
    $sHn=$_GET["cHn"];
    $sAn=$_GET["cAn"];
    $sPtname=$_GET["cPtname"];
    $sDoctor=$_GET["cDoctor"];
    $sAge=""; 
    $sPtright="";
    $sReport="";

    $sDetail=$cDetail;
    $sRow_id=$nRow_id;
  
    session_register("dDate");  
    session_register("sHn");   
    session_register("sAn");
    session_register("sPtname");
    session_register("sDoctor");
    session_register("sAge");
    session_register("sPtright");
    session_register("sReport");
    session_register("sDetail");
    session_register("sRow_id"); 

   Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
//    $bY=substr($birth,0,4);
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ��";
             }
      else{
            $pAge="$ageY �� $ageM ��͹";
                        }
      return $pAge;
          }

   include("connect.inc");
	    $query = "SELECT * FROM opcard WHERE hn = '".$_GET["cHn"]."'";
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
       	   If ($result){
  	       $sHn=$row->hn;
  	       $cYot = $row->yot;
                       $cName = $row->name;
   	       $cSurname = $row->surname;
   	       $sPtname=$row->yot.' '.$row->name.' '.$row->surname;
   	       $sPtright = $row->ptright;
                       $cAge=$row->dbirth;
                       $cAddress=$row->address;
                       $cMuang="�. $row->tambol  �. $row->ampur  �. $row->changwat" ; 
                       $sAge=calcage($cAge);
/*
HN  AN  
����
����
�Է��
�ä
ᾷ��
��¡��  
�ѹ���� $dDate
�š����ҹ
*/
    print "<font face='Angsana New' size='4'><CENTER><B>����ҹ��õ�Ǩ Xray</B> &nbsp;&nbsp;�ç��Һ�Ť�������ѡ�������� �ӻҧ �� 054-839305<BR></CENTER>";
                       print "HN $sHn&nbsp;&nbsp;";
	       if (!empty($cAn)){
		$sAn=$cAn;
	        	print "AN $sAn<br>";
			}
	       print "<B>$sPtname</B><br>";
	       print "<font face='Angsana New' size='3'>����: $sAge (�ѹ�Դ: $cAge)&nbsp;&nbsp;&nbsp;";
	       if (!empty($sPtright)){
		print "�Է�ԡ���ѡ��: $sPtright<br>";
			}
	       print "�������:$cAddress $cMuang<br>";
	       print "ᾷ��: $cDoctor&nbsp;&nbsp;&nbsp;";
                       print "��õ�Ǩ: <B>$cDetail</B><br>";
	       print "�ѹ����Ǩ: $sDate<br><BR>";
	       print "<B>����ҹ:-</B><br>";
         	   	       }  
 	  else {
  	       echo "��辺 HN : $hn ";
  	         }    
	    	       
list($report) = Mysql_fetch_row(Mysql_Query("Select report From patdata where row_id = '".$_GET["nRow_id"]."' "));
?>
</form>

<?php include("unconnect.inc");  ?>

<?php
    session_start();
    include("connect.inc");

	


       
                       print"<font face='Angsana New' size='4'>$report";
   include("unconnect.inc");
?>
