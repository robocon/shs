<style>
.fonthead{
	font-family:"Angsana New";
	font-size:18PX;
	font-weight:bold;
}
.fontlist{
	font-family:"Angsana New";
	font-size:16PX;
}
</style>
<form method="post" action="<?php echo $PHP_SELF ?>">
<table border="0">
  <tr>
    <td height="41" colspan="2" align="center">��Ǩ�ͺ icd10 , icd9 �ҡ HN</td>
    </tr>
  <tr>
    <td align="right">HN :</td>
    <td><input type="text" name="hn" size="12" id="hn" /></td>
    </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" value="      ��ŧ      " name="B1" id="B1" /> <a target=_self  href='../nindex.htm'>��Ѻ˹������</a></td>
    </tr>
</table>

</form>

<table>
 <tr class="fonthead">
  <th bgcolor=CD853F>HN</th>
 <th bgcolor=CD853F>AN</th>
 <th bgcolor=CD853F>����-ʡ��</th>
  <th bgcolor=CD853F>�Է��</th>
  <th bgcolor=CD853F>�ѹ�������</th>
  <th bgcolor=CD853F>�ä</th>
  <th bgcolor=CD853F>ICD10 ��ѡ</th>
  <th bgcolor=CD853F>ICD10 �ͧ</th>
  <th bgcolor=CD853F>ICD9CM</th>
  <th bgcolor=CD853F>ᾷ��</th>
  </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,an,vn,ptname,ptright,thidate,diag,doctor,okopd,toborow,borow,officer,icd10,icd101,thdatehn ,officer2,icd9cm FROM opday WHERE hn = '$hn' ORDER BY thidate DESC   ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$an,$vn,$ptname,$ptright,$thidate,$diag,$doctor,$okopd,$toborow,$borow,$officer,$icd10,$icd101,$thdatehn,$officer2,$icd9cm) = mysql_fetch_row ($result)) {

if($an){
	
$sql = "SELECT diag,icd10,comorbid,icd9cm FROM ipcard WHERE  an = '$an' ";
$result1 = mysql_query($sql);

$num=mysql_num_rows($result1);
$arr=mysql_fetch_array($result1);


			if($num>0){
				$diag=$arr['diag'];
				$icd10=$arr['icd10'];
				$icd101=$arr['comorbid'];
				$icd9cm=$arr['icd9cm'];
				
			}
}

 print (" <tr class=\"fontlist\">\n".
"  <td BGCOLOR=F5DEB3>$hn</td>\n".
"  <td BGCOLOR=F5DEB3>$an</td>\n".
"  <td BGCOLOR=F5DEB3>$ptname</td>\n".
"  <td BGCOLOR=F5DEB3>$ptright</td>\n".
"  <td BGCOLOR=F5DEB3>$thidate</a></td>\n".
"  <td BGCOLOR=F5DEB3>$diag</td>\n".
"  <td BGCOLOR=F5DEB3>$icd10</td>\n".
"  <td BGCOLOR=F5DEB3>$icd101 </td>\n".
"  <td BGCOLOR=F5DEB3>$icd9cm</td>\n".
"  <td BGCOLOR=F5DEB3>$doctor</td>\n".
" </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
