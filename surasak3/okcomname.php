<?php
  include("connect.inc");
    print "<a href='../nindex.htm'><< �����</a><br>";

   $query="SELECT row_id FROM druglst";
   $result = mysql_query($query);
   $xRec = mysql_num_rows($result);
print "�ӹǹ records $xRec<br>";
  for ($n=1; $n<=$xRec; $n++){
    $query = "SELECT * FROM druglst WHERE row_id = $n ";
    $result = mysql_query($query) or die("Query druglst failed ");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
	$cComcode =$row->comcode;
	$cComname=$row->comname;
print "<font face='Angsana New'>�Ƿ��.........= $n, druglstcomname=$cComcode, $cComname<br>";
				}
///////
if(!empty($cComcode)){
    $query = "SELECT comcode,comname FROM company WHERE comcode = '$cComcode' ";
    $result = mysql_query($query) or die("Query company failed ");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    if(mysql_num_rows($result)){
	$cCompany=$row->comname;
	print "<font face='Angsana New'>�Ƿ��.........= $n,companycomname=$cComcode, $cCompany <br><br>";
				}

        $query ="UPDATE druglst SET comname = '$cCompany'
                       WHERE row_id='$n' ";
        $result = mysql_query($query) ;
        if(mysql_errno()<>0){
                 print "failed update druglst, �� $n<br>";
		}
		}
  }
print "<br><font face='Angsana New'>���comname ���������º����<br>";
print "<br><a href='../nindex.htm'><< �����</a><br>";

include("unconnect.inc");
?>
