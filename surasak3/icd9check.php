
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;��ª��ͼ����µ�� ICD 9CM&nbsp;&nbsp;&nbsp;
  
<input type="text" name="icd9cm" size="20">&nbsp;&nbsp;&nbsp;&nbsp;

<font face="Angsana New">&nbsp;&nbsp; 
��&nbsp;
  <input type="text" name="thiyr" size="10"> <br>��ҵ�ͧ������͡��͹�����ѹ���� ���������е��������͹����ѹ �� 2550-06-03 �繵�
</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <BR>�Է��� : 
<select  name='ptright'>
 <option value='' >�ٷ�����</option>
 <option value='R01' >R01&nbsp;�Թʴ</option>
 <option value='R02' >R02&nbsp;�ԡ��ѧ�ѧ��Ѵ</option>
 <option value='R03' >R03&nbsp;�ç����ԡ���µç</option>
 <option value='R04' >R04&nbsp;�Ѱ����ˡԨ</option>
 <option value='R05' >R05&nbsp;����ѷ(��Ҫ�)</option>
 <option value='R06' >R06&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö</option>
 <option value='R07' >R07&nbsp;��Сѹ�ѧ��</option>
 <option value='R08' >R08&nbsp;�.�.44(�Ҵ��㹧ҹ)</option>
 <option value='R09' >R09&nbsp;��Сѹ�آ�Ҿ��ǹ˹��</option>
 <option value='R10' >R10&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)</option>
 <option value='R11' >R11&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)</option>
 <option value='R12' >R12&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡/���ԡ��)</option>
 <option value='R13' >R13&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(㹨ѧ��ѡ�ء�Թ)</option>
 <option value='R14' >R17&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�͡�ѧ��Ѵ�ء�Թ)</option>
 <option value='R15' >R15&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)</option>
 <option value='R16' >R16&nbsp;�֡�Ҹԡ��(����͡��)</option>
 <option value='R17' >R17&nbsp;�ŷ���</option>
 <option value='R18' >R18&nbsp;�ç����ѡ���ä� (HD)</option>
 <option value='R19' >R19&nbsp;�ç��ù��(NAPA)</option>
 <option value='R20' >R20&nbsp;��Сѹ�ѧ���óդ�ʹ�ص�</option>
 <option value='R21' >R21&nbsp;ͧ��û���ͧ��ǹ��ͧ���</option>
 <option value='R22' >R22&nbsp;��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��</option>
 <option value='R23' >R23&nbsp;�ѡ���¹/�ѡ�֡�ҷ���</option>
 </select>


 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a target=_self  href='../nindex.htm'>&lt;&lt;�����</a></p>
</form>


<table>

 <tr>

  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>�ѹ-����</th>
 
<th bgcolor=CD853F>HN</th>
 
 <th bgcolor=CD853F>����-ʡ��</th>
 <th bgcolor=CD853F>�Է���</th>
  
<th bgcolor=CD853F>�ä</th>

  <th bgcolor=CD853F>ICD9CM</th>
  
  

  <th bgcolor=CD853F>�ѵ� ���.</th>
  <th bgcolor=CD853F>�������</th>
  <th bgcolor=CD853F>�Ӻ�</th>
  <th bgcolor=CD853F>�����</th>
  <th bgcolor=CD853F>�ѧ��Ѵ</th>
  <th bgcolor=CD853F>���Ѿ��</th>
  
</tr>


<?php
 

  $num=0;
If (!empty($icd9cm)){
    include("connect.inc");
    global $icd9cm;
   

 $query = "SELECT thidate, hn,ptname,diag,icd9cm,ptright FROM opday WHERE icd9cm LIKE '%$icd9cm%' and thidate LIKE '$thiyr%' AND ptright like '".$_POST["ptright"]."%' ";
    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($thidate,$hn, $ptname,$diag,$icd9cm,$ptright) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;


 $sql = "SELECT idcard,address,tambol,ampur,changwat,phone FROM opcard WHERE  hn = '".$hn."' limit 1";

   list($idcard,$address,$tambol,$ampur,$changwat,$phone) = mysql_fetch_row(Mysql_Query($sql));


 print (" <tr>\n".       
	"  <td BGCOLOR=F5DEB3>$num</td>\n".
	"  <td BGCOLOR=F5DEB3>$thidate</td>\n".
	"  <td BGCOLOR=F5DEB3>$hn</td>\n".
	"  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
	"  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
	"  <td BGCOLOR=F5DEB3>$diag</td>\n".
	"  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
	"  <td BGCOLOR=F5DEB3>$idcard</td>\n".
	"  <td BGCOLOR=F5DEB3>$address</td>\n".
	"  <td BGCOLOR=F5DEB3>$tambol</td>\n".
	"  <td BGCOLOR=F5DEB3>$ampur</td>\n".
	"  <td BGCOLOR=F5DEB3>$changwat</td>\n".
	"  <td BGCOLOR=F5DEB3>$phone</td>\n".
	" </tr>\n");

	   if($icd9cm != ""){
				if(!isset($sum[$icd9cm]))
					$sum[$icd9cm] = 0;
				$sum[$icd9cm] = $sum[$icd9cm]+1;
			}
       }

}
$icd101=$icd10;
If (!empty($icd9cm)){
    include("connect.inc");
    global $icd9cm;
   
 $query = "SELECT thidate, hn,ptname,diag,icd9cm,FROM opday WHERE icd9cm LIKE '%$icd10%' and thidate LIKE '$thiyr%'   ";
    $result = mysql_query($query)
        or die("Query failed");


   
 while (list ($thidate,$hn,$ptname,$diag,$icd9cm) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 



$sql = "SELECT idcard,address,tambol,ampur,changwat,phone FROM opcard WHERE  hn = '".$hn."' ";

   list($idcard,$address,$tambol,$ampur,$changwat,$phone) = mysql_fetch_row(Mysql_Query($sql));



 $num++;

 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$thidate</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$hn</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$diag</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
      
 
		      "  <td BGCOLOR=F5DEB3>$idcard</td>\n".
				 "  <td BGCOLOR=F5DEB3>$address</td>\n".
				 "  <td BGCOLOR=F5DEB3>$tambol</td>\n".
				 "  <td BGCOLOR=F5DEB3>$ampur</td>\n".
				 "  <td BGCOLOR=F5DEB3>$changwat</td>\n".
				 "  <td BGCOLOR=F5DEB3>$phone</td>\n".
      
         " </tr>\n");
			
		

       }


include("unconnect.inc");
       }
?>

</table>

<BR><BR>
��ػ ICD9cm

<TABLE>
<TR align="center">
	<TD BGCOLOR=F5DEB3>ICD9cm</TD>
	<TD BGCOLOR=F5DEB3>�ӹǹ������</TD>
</TR>
<?php

	foreach ($sum as $key => $value){

?>
<TR>
	<TD BGCOLOR=F5DEB3><?php echo $key;?></TD>
	<TD BGCOLOR=F5DEB3><?php echo $value;?></TD>
</TR>
<?php
}	
?>
</TABLE>

