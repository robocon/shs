
<Script Language="JavaScript">
function CloseWindowsInTime(t){
t = t*1000;
setTimeout("window.close()",t);
}
CloseWindowsInTime(1/*����������ԹҷչФ�Ѻ�ç�Ţ 5 */); 
</Script>


<?php
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
   include("connect.inc");
   //�Ҩӹǹ��
   $query="SELECT row_id FROM bed";
   $result = mysql_query($query);
   $nRec = mysql_num_rows($result);
  print"�ӹǹ����ѡ�Ҿ�Һ�����º����,  �Դ˹�ҵ�ҧ���<br>";
  print "�ӹǹ�� =  $nRec<br>";

  for ($n=1; $n<=$nRec; $n++){

        $query = "SELECT * FROM bed WHERE row_id = $n ";
        $result = mysql_query($query) or die("Query ipcard failed");
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    if(mysql_num_rows($result)){
          $nRow_id=$row->row_id;
          $cAn=$row->an;
		  $cAccno=$row->accno;
	}

		     //clean bed
	if (empty($cAn)){
	   $sql = "UPDATE bed SET price='0',
			    paid= '0',
			    debt='0',
                caldate=' '
	   WHERE row_id='$nRow_id' ";
       $result = mysql_query($sql) or die("Query failed ipcard");
							  }
//////////

	if (!empty($cAn)){
////�ӹǹ����ѡ�Ҿ�Һ�Ũҡ ipacc table ��� an �����ҡ bed
  $nNetprice=0;
    $nNetpaid=0;
    $no=0;
   $query = "SELECT price,paid FROM ipacc WHERE an = '$cAn' and accno= '$cAccno' ";
    $result = mysql_query($query)
        or die("Query failed ipacc");
    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }
        if(!($row = mysql_fetch_object($result)))
            continue;      

$no++;
$nNetprice =$nNetprice+$row->price;
$nNetpaid = $nNetpaid+$row->paid;
//print"$no, price=$nNetprice, paid=$nNetpaid<br>";
       }
print"n=$n,bed-row_id=$nRow_id;an=$cAn,accno=$cAccno; item= $no, price=$nNetprice, paid=$nNetpaid<br>";
//update ipcard
	   $sql = "UPDATE ipcard SET price='$nNetprice',
			    paid= '$nNetpaid',
                calc='$Thidate'
	   WHERE an='$cAn' ";
       $result = mysql_query($sql) or die("Query failed ipcard");
       echo mysql_errno() . ": " . mysql_error(). "\n";
       echo "<br>";
//update bed
	   $sql = "UPDATE bed SET price='$nNetprice',
			    paid= '$nNetpaid',
			    debt=$nNetprice-$nNetpaid,
                caldate='$Thidate'
	   WHERE row_id='$nRow_id' ";
       $result = mysql_query($sql) or die("Query failed ipcard");
       echo mysql_errno() . ": " . mysql_error(). "\n";
       echo "<br>";
   }
  }
  print"�ӹǹ����ѡ�Ҿ�Һ�����º����,  �Դ˹�ҵ�ҧ���";
 include("unconnect.inc");
?>
