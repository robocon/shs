<?php
session_start();
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/
        $query ="UPDATE company SET comname = '$comname',
              			  comaddr='$comaddr',
			              ampur='$ampur',	
			              changwat='$changwat',
			              tel='$tel',
						  fax='$fax',
						  pobillno='$pobillno',
						  pobilldate='$pobilldate',
						  pobillno2='$pobillno2',
						  pobilldate2='$pobilldate2',
						  pobillno3='$pobillno3',
						  pobilldate3='$pobilldate3'						  						  
                       WHERE comcode = '$cComcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update company");
if ($result){
        print "���ʺ���ѷ  :$cComcode<br>";
        print "���ͺ���ѷ    :$comname<br>";
        print "����������ѷ  :$comaddr<br>";
        print "ࢵ/����� :$ampur<br>";
        print "�ѧ��Ѵ      :$changwat<br>";
        print "���Ѿ��          :$tel<br>";
		 print "�����          :$fax<br>";
		 print "�Ţ�����ʹ��Ҥ�1          :$pobillno<br>";
		 print "ŧ�ѹ���1          :$pobilldate<br>";
		 print "�Ţ�����ʹ��Ҥ�2          :$pobillno2<br>";
		 print "ŧ�ѹ���2          :$pobilldate2<br>";
		 print "�Ţ�����ʹ��Ҥ�3          :$pobillno3<br>";
		 print "ŧ�ѹ���3          :$pobilldate3<br>";		 		 
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>���ʺ���ѷ  :$cComcode  �Ҩ��Ӣͧ��� �ô���<br>";
           }
include("unconnect.inc");
?>
<?php
session_start();
include("connect.inc");
/*
  comcode  comname  comaddr   ampur  changwat   tel
*/
        $query ="UPDATE druglst SET comname = '$comname'
              			 WHERE comcode = '$cComcode' ";
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
if ($result){
        print "���ʺ���ѷ  :$cComcode<br>";
		 print "���ͺ���ѷ    :$comname<br>";
        print "�ѹ�֡���������º����<br>";
	}	
   else { 
        print "<br><br><br>���ʺ���ѷ  :$cComcode  �Ҩ��Ӣͧ��� �ô���<br>";
           }
include("unconnect.inc");
?>









