<?
function calcage($birth){

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
		$pAge="$ageY";
	}else{
		$pAge="$ageY";
	}

return $pAge;
}
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
 
					<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��Ǩ�ͺ������Ѥ�չ 2018</p>

 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face="Angsana New">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 �ѹ��� <INPUT TYPE="text" NAME="rptday" maxlength="2" size="2">
 &#3648;&#3604;&#3639;&#3629;&#3609;&nbsp;
    <? $m=date('m'); ?>
  <select size="1" name="rptmo">
    <option value="">���͡</option>
    <option value="01" <? if($m=='01'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>����Ҿѹ��</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>�չҤ�</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>����¹</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>����Ҥ�</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>�Զع�¹</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>�á�Ҥ�</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>�ԧ�Ҥ�</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>�ѹ��¹</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>���Ҥ�</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>��Ȩԡ�¹</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>�ѹ�Ҥ�</option>
  </select>&nbsp;&nbsp; &#3614;.&#3624;
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>

<table>
 <tr>
  <th bgcolor=CD853F>�ѹ�������</th>
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>AN</th>
 <th bgcolor=CD853F>���� - ʡ��</th>
 <th bgcolor=CD853F>�ѵû�ЪҪ�</th>
  <th bgcolor=CD853F>�Է��</th>
 <th bgcolor=CD853F>����</th>
  <th bgcolor=CD853F>�ä��Шӵ��</th>  
  <th bgcolor=CD853F>������</th>
<th bgcolor=CD853F>�Ը���</th>
 <th bgcolor=CD853F>�ӹǹ</th>



 

 </tr>


<?php
 if($rptmo==""){
	$yym=$thiyr; 
 }else{
 	$yym=$thiyr.'-'.$rptmo; 
	 if($rptday != ""){  //����к��ѹ���
		$yym .= "-".$rptday;
	 } 
 }
 
//$drugcode='0INF2018';
  
  include("connect.inc");
   
 global $drugcode;
   $list_peoper = array();
  $list_hn = array();
 $query = "SELECT hn,an,date,drugcode,tradname,amount,price,stock,slcode,reason,part FROM drugrx WHERE (drugcode like '0INF2019_1%' || drugcode like '0INF2019_4%' || drugcode like '0INF2019_N%') and date LIKE '$yym%' ";
 echo $query;
    $result = mysql_query($query)
        or die("Query failed");
$j = $i= Mysql_num_rows($result);
    while (list ($hn,$an,$date,$drugcode,$tradname,$amount,$price,$stock,$slcode,$reason,$part) = mysql_fetch_row ($result)) {
        $Total =$Total+$amount;  
		$sal_price = $sal_price+$price;
		$list_hn[$i] = $hn;
		$list_peoper["A".$hn] = true;


list($fullname,$ptright,$idcard,$dbirth) = mysql_fetch_row(mysql_query("Select concat(yot,' ',name,' ',surname),ptright,idcard,dbirth From opcard where hn = '".$hn."' limit 1 "));
$age=calcage($dbirth);


list($congenital_disease) = mysql_fetch_row(mysql_query("Select congenital_disease From opcard where hn = '".$hn."' and congenital_disease NOT LIKE '%HIV%' limit 1 "));

 print (" <tr>\n".
"  <td BGCOLOR=F5DEB3>$date</a></td>\n".
"  <td BGCOLOR=F5DEB3>$hn</td>\n".
"  <td BGCOLOR=F5DEB3>$an</td>\n".
"  <td BGCOLOR=F5DEB3>$fullname</td>\n".
"  <td BGCOLOR=F5DEB3>$idcard</td>\n".
"  <td BGCOLOR=F5DEB3>$ptright</td>\n".
"  <td BGCOLOR=F5DEB3>$age</td>\n".
"  <td BGCOLOR=F5DEB3>$congenital_disease</td>\n".
"  <td BGCOLOR=F5DEB3>$tradname</td>\n".
"  <td BGCOLOR=F5DEB3>$slcode</td>\n".
"  <td BGCOLOR=F5DEB3>$amount</td>\n".


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
?>
</table>
