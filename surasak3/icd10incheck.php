<?php
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


?>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ª��ͼ����µ�� ICD 10</p>
<form method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>
<TR>
	<TD align="right">ICD10 ��ѡ :</TD>
	<TD>
		<input type="text" name="icd10" size="20" value="<?php echo isset( $_POST['icd10'] ) ?  $_POST['icd10'] : '' ;?>">
		<span>* ������ҧ������͡�����ǧ �� D00-D22</span>
	</TD>
</TR>
<TR>
	<TD align="right">ICD10 �ͧ :</TD>
	<TD><input type="text" name="icd101" size="20"></TD>
</TR>
<TR>
  <TD align="right">ICD �ä�á</TD>
  <TD><input type="text" name="icd102" size="20"/></TD>
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
</TABLE>
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
 </select> <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
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
 
<th bgcolor=CD853F>AN</th>
 
 <th bgcolor=CD853F>����-ʡ��</th>
  
<th bgcolor=CD853F>�ä</th>

  <th bgcolor=CD853F>ICD10</th>
  <th bgcolor=CD853F>ICD10 (�ä�ͧ)</th>
  <th bgcolor=CD853F>ICD10 (�ä�á)</th>
  
<th bgcolor=CD853F>�ѹ��˹���</th>
<th bgcolor=CD853F>D/C Type</th>
</tr>

<?php
$num=0;
If (!empty($B1)){
	
include("connect.inc");
global $icd10, $thiyr;

$icd10 = trim(strtoupper($_POST['icd10']));
$icd101 = $_POST['icd101'];
$icd102 = $_POST['icd102'];

// if( empty($icd10) AND empty($icd101) AND empty($icd102) ){
// 	echo '<p style="color: red;">��س����͡ ICD10 ��ѡ, �ͧ ���� �ä�á</p>';
// 	exit;
// }


// ���͹䢡�ô� ICD10
$statement = array();
if( $icd10 != '' ){ 
	
	$match = preg_match('/\-/', $icd10);
	
	// If not match range format
	if( $match === 0 ){
		$statement[] = " `icd10` LIKE '%$icd10%' " ;
	}else{
		list($min_txt, $max_txt) = explode('-', $icd10);
		
		$key_txt = substr($min_txt, 0, 1);
		$num_start = (float) substr($min_txt, 1);
		$num_end = (float) substr($max_txt, 1);
		$sprint_len = strlen(substr($max_txt, 1));
		
		$filter_lists = array();
		for ($num_start; $num_start <= $num_end; $num_start++) { 
			$test_icd10 = sprintf('%0'.$sprint_len.'d', $num_start);
			$filter_lists[] = " `icd10` LIKE '$key_txt$test_icd10%' ";
		}
		$test_final = implode( ' OR ', $filter_lists);
		
		$statement[] = ' ( '.$test_final.' ) ';
	}
}

if( $icd101 != '' ){
	$statement[] = " `comorbid` LIKE '%$icd101%'";
}

if( $icd102 != '' ){
	$statement[] = " `complica` LIKE '%$icd102%'";
}

$where1 = '';
if( !empty($statement) ){
	$where1 = '( '.implode(' AND ', $statement).' )';
}

// Filter ����ѹ���
$where = ( empty($where1) ? '' : ' AND ' );
if($_POST["type"] == "2"){
	$where .= " ( `date` between '".($_POST["start_year"])."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00' AND '".($_POST["end_year"])."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:59' ) ";
}else{
	$where .= " `date` LIKE '$thiyr%' ";
}

if($_POST["ptright"] != ""){
	$where .= " AND `ptright` LIKE '".$_POST["ptright"]."%' ";
}

$query = "
SELECT MAX( `date` ) AS `date2`,`date`,`hn`,`an`,`ptname`,`diag`,`icd10`,`comorbid`,`dcdate`,`dctype`,`complica`
FROM `ipcard` 
WHERE $where1 $where 
GROUP BY `hn`
ORDER BY `date` ASC 
";


// $query = "SELECT date,hn,an,ptname,diag,icd10, comorbid,dcdate, dctype ,complica FROM ipcard WHERE ".$where1."  ".$where." ORDER BY `date` ASC ";

$result = mysql_query($query)or die( mysql_error() );

   
 while (list ($date2,$date,$hn,$an,$ptname,$diag,$icd10, $comorbid,$dcdate, $dctype ,$complica) = mysql_fetch_row ($result)) 
{
        $Total =$Total+$amount; 


 $num++;

 print (" <tr>\n".

       
       "  <td BGCOLOR=F5DEB3>$num</td>\n".
   
       "  <td BGCOLOR=F5DEB3>$date</td>\n".
   
    "  <td BGCOLOR=F5DEB3>$hn</td>\n".
  
"  <td BGCOLOR=F5DEB3>$an</td>\n".
  
   "  <td BGCOLOR=F5DEB3>$ptname</a></td>\n".
     
      "  <td BGCOLOR=F5DEB3>$diag</td>\n".
    
  "  <td BGCOLOR=F5DEB3>$icd10</td>\n".
  "  <td BGCOLOR=F5DEB3>$comorbid</td>\n".
   "  <td BGCOLOR=F5DEB3>$complica</td>\n".
"  <td BGCOLOR=F5DEB3>$dcdate</td>\n".
"  <td BGCOLOR=F5DEB3>$dctype</td>\n".
       
         " </tr>\n");

	      if($icd10 != ""){
				if(!isset($sum[$icd10]))
					$sum[$icd10] = 0;
				$sum[$icd10] = $sum[$icd10]+1;
			}

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
	if(count($sum) > 0){
	foreach ($sum as $key => $value){

?>
<TR>
	<TD BGCOLOR=F5DEB3><?php echo $key;?></TD>
	<TD BGCOLOR=F5DEB3><?php echo $value;?></TD>
</TR>
<?php
}	}
?>
</TABLE>
