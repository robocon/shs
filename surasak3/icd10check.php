<?php
set_time_limit(30);
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

?>


<a target=_self  href='../nindex.htm'>&lt;&lt;�����</a>
<form method="post" action="<?php echo $PHP_SELF ?>">
 
 <TABLE>
<TR>
	<TD colspan="2">��ª��ͼ����µ��</TD>
</TR>
<TR>
	<TD> ICD 10 ��ѡ</TD>
	<TD><input type="text" name="icd10" size="20" value="<?php echo isset( $_POST['icd10'] ) ?  $_POST['icd10'] : '' ;?>"></TD>
</TR>
<TR>
	<TD>ICD 10 �ͧ</TD>
	<TD><input type="text" name="icd101" size="20"></TD>
</TR>
<TR>
	<TD align="right" valign="top">������¡������ :</TD>
	<TD><INPUT TYPE="radio" NAME="type" value="1" onclick="hidden_style('1');" checked> ��Ш��� ��, ��͹ ���� �ѹ <BR><INPUT TYPE="radio" NAME="type" value="2"  onclick="hidden_style('2');"> ���͡�繪�ǧ </TD>
</TR>
<TR id="row1">
	<TD align="right" valign="top">�� :</TD>
	<TD><input type="text" name="thiyr" size="10" value="<?php echo isset($_POST['thiyr']) ? $_POST['thiyr'] : date('Y')+543 ;?>"> <BR>*��ҵ�ͧ������͡��͹�����ѹ���� ���������е��������͹����ѹ �� 2550-06-03 �繵�
</TD>
</TR>
<TR id="row2" style="display:none">
	<TD align="right">������ѹ��� :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="start_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="start_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4">
	</TD>
</TR>
<TR id="row3" style="display:none">
	<TD align="right">�֧�ѹ��� :</TD>
	<TD><INPUT TYPE="text" NAME="end_day" value="<?php echo date("d");?>" size="2" maxlength="2"> / 
		<SELECT NAME="end_month">
		<?php
		foreach($month as $value => $index){
			echo "<OPTION VALUE=\"",$value,"\" ";
			 if(date("m") == $value) echo " Selected ";
			echo ">",$index;
			
			}	?>
			
		</SELECT> / 
		<INPUT TYPE="text" NAME="end_year" value="<?php echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
</TR>
<TR>
	<TD>���� : </TD>
	<TD><SELECT NAME="list_age">
							<Option value=""></option>
							<Option value=" <">�ҡ����</option>
							<Option value=" <=">�ҡ���������ҡѺ</option>
							<Option value=" >">���¡���</option>
							<Option value=" >=">���¡���</option>
						</SELECT>
						<SELECT NAME="age">
							<Option value=""></option>
							<?php for($i=1;$i<=70;$i++){?>
								<Option value="<?php echo $i;?>"><?php echo $i;?></option>
							<?php }?>
						</SELECT></TD>
</TR>
<TR>
	<TD>�Է��� : </TD>
	<TD><select  name='ptright'>
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
 </select></TD>
</TR>
<TR>
  <TD colspan="2">���͡��������ä��� : 
    <input type="radio" name="search1" value="1" checked="checked" />
    ����ӹǹ���� 
    <input type="radio" name="search1" value="2" />
    ����ӹǹ��</TD>
  </TR>
 </TABLE>

 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 </p>
</form>
<SCRIPT LANGUAGE="JavaScript">
<!--
	function hidden_style(xxx){

			document.getElementById('row1').style.display = 'none';
			document.getElementById('row2').style.display = 'none';
			document.getElementById('row3').style.display = 'none';
			
			if(xxx == 1){
				document.getElementById('row1').style.display = '';
			}else{
				document.getElementById('row2').style.display = '';
				document.getElementById('row3').style.display = '';
			}
	}

//-->
</SCRIPT>

<table>

 <tr>

  <th bgcolor=CD853F>#</th>
 

  <th bgcolor=CD853F>�ѹ-����</th>
 
<th bgcolor=CD853F>HN</th>
 
 <th bgcolor=CD853F>����-ʡ��</th>
 <th bgcolor=CD853F>����</th>
 <th bgcolor=CD853F>�Է���</th>
  
<th bgcolor=CD853F>�ä</th>

  <th bgcolor=CD853F>ICD10 ��ѡ</th>
  
  <th bgcolor=CD853F>ICD10 �ͧ</th>
  

  <th bgcolor=CD853F>�ѵ� ���.</th>
  <th bgcolor=CD853F>�������</th>
  <th bgcolor=CD853F>�Ӻ�</th>
  <th bgcolor=CD853F>�����</th>
  <th bgcolor=CD853F>�ѧ��Ѵ</th>
  <th bgcolor=CD853F>���Ѿ��</th>
  
</tr>


<?php
 

  $num=0;
If (!empty($icd10)){
    include("connect.inc");
    global $icd10;
   

if($_POST["list_age"] != "" && $_POST["age"] != ""){
		$str_age = mktime(0,0,0,date("m"),date("d"),date("Y")-$_POST["age"]);
		$ste = (date("Y",$str_age)+543).date("-m-d",$str_age);
		$where_age = " AND hn in (Select hn From opcard where dbirth ".$_POST["list_age"]." '".$ste."') ";

   }
	
	if($_POST["type"] == "2"){
		$where = " and (thidate between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:00' ) ";
	}else{
		$where = " and thidate LIKE '$thiyr%' ";
	}
	
	if($_POST["search1"] == "2"){
		$where2 = "group by hn  ";
	}else{
		$where2 = "";
	}
	
	

 $query = "SELECT thidate,hn,ptname,diag,icd10,icd101, ptright FROM opday WHERE icd10 LIKE '%$icd10%'  and icd101 LIKE '%$icd101%' AND ptright like '".$_POST["ptright"]."%' ".$where." ".$where_age." ".$where2 ;

    $result = mysql_query($query)
        or die("Query failed");

   
 while (list ($thidate,$hn, $ptname,$diag,$icd10,$icd101,$ptright) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;


 $sql = "SELECT idcard,address,tambol,ampur,changwat,phone,dbirth FROM opcard WHERE  hn = '".$hn."' limit 1";

   list($idcard,$address,$tambol,$ampur,$changwat,$phone,$dbirth) = mysql_fetch_row(Mysql_Query($sql));


 print (" <tr>\n".       
	"  <td BGCOLOR=F5DEB3>$num</td>\n".
	"  <td BGCOLOR=F5DEB3>$thidate</td>\n".
	"  <td BGCOLOR=F5DEB3>$hn</td>\n".
	"  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"hndrugcheck.php? sDate=$thidate&hn=$hn\">$ptname</a></td>\n".
	"  <td BGCOLOR=F5DEB3>".calcage($dbirth)."</td>\n".
	"  <td BGCOLOR=F5DEB3>$ptright</a></td>\n".
	"  <td BGCOLOR=F5DEB3>$diag</td>\n".
	"  <td BGCOLOR=F5DEB3>$icd10</td>\n".
	"  <td BGCOLOR=F5DEB3>$icd101</td>\n".
	"  <td BGCOLOR=F5DEB3>$idcard</td>\n".
	"  <td BGCOLOR=F5DEB3>$address</td>\n".
	"  <td BGCOLOR=F5DEB3>$tambol</td>\n".
	"  <td BGCOLOR=F5DEB3>$ampur</td>\n".
	"  <td BGCOLOR=F5DEB3>$changwat</td>\n".
	"  <td BGCOLOR=F5DEB3>$phone</td>\n".
	" </tr>\n");

	   if($icd10 != ""){
				if(!isset($sum[$icd10]))
					$sum[$icd10] = 0;
				$sum[$icd10] = $sum[$icd10]+1;
			}
       }

}
$icd101=$icd10;
If (!empty($icd10)){
    include("connect.inc");
    global $icd10;
   
 $query = "SELECT thidate, hn,ptname,diag,icd10,icd101 FROM opday WHERE icd101 LIKE '%$icd10%' and thidate LIKE '$thiyr%'   ";
    $result = mysql_query($query)
        or die("Query failed");


   
 while (list ($thidate,$hn,$ptname,$diag,$icd10,$icd101) = mysql_fetch_row ($result)) 
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
    
  "  <td BGCOLOR=F5DEB3>$icd10</td>\n".
      
  "  <td BGCOLOR=F5DEB3>$icd101</td>\n".

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
��ػ ICD10

<TABLE>
<TR align="center">
	<TD BGCOLOR=F5DEB3>ICD10</TD>
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

