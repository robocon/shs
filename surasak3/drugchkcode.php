<table>
  <tr>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>AN</th>
 <th bgcolor=CD853F>���� - ʡ��</th>
  <th bgcolor=CD853F>�Է��</th>
  <th bgcolor=CD853F>�ѹ�������</th>
 <th bgcolor=CD853F>drugcode</th>
  <th bgcolor=CD853F>������</th>
<th bgcolor=CD853F>�Ը���</th>
 <th bgcolor=CD853F>�ӹǹ</th>
<th bgcolor=CD853F>�Ҥ�</th>
<th bgcolor=CD853F>�˵ؼ�</th>
 <th bgcolor=CD853F>����������ͧ����</th>
 <th bgcolor=CD853F>�������㹤�ѧ��</th>
 	<th bgcolor=CD853F>ᾷ��</th>
	<th bgcolor=CD853F>���Ѵ</th>
 </tr>


<?php
session_start();
if(!empty($_GET['code'])){
  
  include("connect.inc");
   
  $list_peoper = array();
  $list_hn = array();
  $query = "SELECT hn,an,date,drugcode,tradname,amount,price,stock,mainstk,slcode,reason,part FROM drugrx WHERE drugcode = '".$_GET['code']."' and date between '".$_SESSION['yym']." 00:00:00' and '".$_SESSION['yym2']." 23:59:59' ";
    $result = mysql_query($query) or die("Query failed");
	$j = $i= Mysql_num_rows($result);
    while (list ($hn,$an,$date,$drugcode,$tradname,$amount,$price,$stock,$mainstk,$slcode,$reason,$part) = mysql_fetch_row ($result)) {
        $Total =$Total+$amount;  
		$sal_price = $sal_price+$price;
		$list_hn[$i] = $hn;
		$list_peoper["A".$hn] = true;


list($fullname,$ptright) = mysql_fetch_row(mysql_query("Select concat(yot,' ',name,' ',surname),ptright From opcard where hn = '".$hn."' limit 1 "));

		$sql = "Select doctor,idname From phardep where date = '$date'  ";
	//$result = Mysql_Query($sql);
	//list($doctor1,$idname1) = Mysql_fetch_row($result);
		list($doctor1,$idname1)  = mysql_fetch_row(Mysql_Query($sql));


 print (" <tr>\n".

"  <td BGCOLOR=F5DEB3>$hn</td>\n".
"  <td BGCOLOR=F5DEB3>$an</td>\n".
"  <td BGCOLOR=F5DEB3>$fullname</td>\n".
	"  <td BGCOLOR=F5DEB3>$ptright</td>\n".
"  <td BGCOLOR=F5DEB3>$date</a></td>\n".
"  <td BGCOLOR=F5DEB3>$drugcode</td>\n".
"  <td BGCOLOR=F5DEB3>$tradname</td>\n".
"  <td BGCOLOR=F5DEB3>$slcode</td>\n".
"  <td BGCOLOR=F5DEB3>$amount</td>\n".
"  <td BGCOLOR=F5DEB3>$price</td>\n".
"  <td BGCOLOR=F5DEB3>$reason</td>\n".
"  <td BGCOLOR=F5DEB3>$stock</td>\n".
"  <td BGCOLOR=F5DEB3>$mainstk</td>\n".
				"  <td BGCOLOR=F5DEB3>$doctor1</td>\n".
						"  <td BGCOLOR=F5DEB3>$idname1</td>\n".

" </tr>\n");
		   $i++;
		   
       }


   
 //global $drugcode;
  $list_hn = array();
  //$list_peoper = array();
 $query = "SELECT date,hn,an,drugcode,slcode,price,tradname,sum(amount) as hn_aomunt,sum(stock) FROM drugrx WHERE hn <> '' AND drugcode = '$drugcode' and date LIKE '$yym%'   GROUP BY hn, drugcode order by  hn_aomunt DESC ";

    $result = mysql_query($query)
        or die(Mysql_Error());
$i=$i + Mysql_num_rows($result);
    while (list ($date,$hn,$an,$drugcode,$slcode,$price,$tradname,$amount,$stock) = mysql_fetch_row ($result)) {

        $Total =$Total+$amount;  
		$sal_price = $sal_price+$price;
$list_hn[$i] = $hn;
$list_peoper["A".$hn] = true;
 print (" <tr>\n".
 "  <td BGCOLOR=F5DEB3>$date</td>\n".
           "  <td BGCOLOR=F5DEB3>$hn</td>\n".
      
  "  <td BGCOLOR=F5DEB3>$an</td>\n".
 
      "  <td BGCOLOR=F5DEB3>$drugcode</td>\n".
  
    "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
     
 "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
     

      "  <td BGCOLOR=F5DEB3>$amount</td>\n".
    "  <td BGCOLOR=F5DEB3>$price</td>\n".
   
 "  <td BGCOLOR=F5DEB3>$stock</td>\n".
 
 

           " </tr>\n");
		  // $i++;
       }


print "������$tradname �����������ҡѺ  $Total ˹��� |";
print "&nbsp;&nbsp;&nbsp;&nbsp;������ ".count($list_peoper)." �� |";
print "&nbsp;&nbsp;&nbsp;&nbsp; $j ��¡�� |";
print "&nbsp;&nbsp;&nbsp;&nbsp;�Ҥ� $sal_price �ҷ";
echo "<!-- ('".implode("','",$list_hn)."') -->";
include("unconnect.inc");
       }
?>
</table>
