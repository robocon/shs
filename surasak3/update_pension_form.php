<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
    session_unregister("nRunno");  
    session_unregister("vAN");
    session_unregister("thdatehn");  
    session_unregister("cNote");  
//    session_destroy();
?>
<style>
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>ŧ����¹�����ºӹҭ����</p>
    <p>�������Ţ�ѵû�Шӵ�ǻ�ЪҪ�</p>

  <p>�Ţ�ѵû�Шӵ��
  <input name="idcard" type="text" id="idcard" size="25" maxlength="13"> 
  *13 ��ѡ</p>
<p>���� HN 
  <input name="hnid" type="text" id="hnid" size="25" maxlength="13"> 
  </p> <script type="text/javascript">
document.getElementById('idcard').focus();
</script>
 
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"> 
  
   <a href="http://192.168.1.2/sm3/nindex.htm">��Ѻ����</a>
</p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>��</th>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>ʡ��</th>
  <th bgcolor=6495ED>�/�/� �Դ</th>
  <th bgcolor=6495ED>�ѵ� ���.</th>
  <!--<th bgcolor=6495ED>�� þ.</th>
  <th bgcolor=6495ED>��Ǩ�Ѵ</th>
  <th bgcolor=6495ED>��Ǩ�͹</th>-->
  <th bgcolor=6495ED>ʶҹм����ºӹҭ</th>
  <th bgcolor=6495ED>ŧ����¹</th>
 </tr>

<?php
If (!empty($idcard)||!empty($hnid)){
    include("connect.inc");
    global $idcard;
	global $hnid;
    $query = "SELECT row_id,hn,yot,name,surname,dbirth,idcard,pension_status  FROM opcard WHERE idcard = '$idcard'";
	if($hnid!=""){
		$query = "SELECT row_id,hn,yot,name,surname,dbirth,idcard,pension_status  FROM opcard WHERE hn = '$hnid'";
	}
	//echo $query;
    $result = mysql_query($query)or die("Query failed");

    while (list ($row_id,$hn,$yot,$name,$surname,$dbirth,$idcard,$pension_status ) = mysql_fetch_row ($result)) {
		
		if($pension_status=='' or $pension_status=='N'){
			$pension="<a  target='_self' href=\"update_pension_save.php?status=Y&row_id=$row_id\">ŧ����¹<a>";	
			$status="�ѧ�����ŧ����¹";
		}elseif($pension_status=='Y'){
			$pension="<a target='_self' href=\"update_pension_save.php?status=N&row_id=$row_id\">¡��ԡŧ����¹<a>";
			$status="ŧ����¹����";
		}
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"seopcard.php?cHn=$hn \">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
         "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
         "  <td BGCOLOR=66CDAA>$idcard</td>\n".
         /*"  <td BGCOLOR=66CDAA><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">�� þ.<a></td>\n".
         "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">��Ǩ�Ѵ<a></td>\n".
   	  "  <td BGCOLOR=66CDAA><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹<a></td>\n".*/
	  "  <td BGCOLOR=66CDAA>$status</td>\n".
	  "  <td BGCOLOR=66CDAA>$pension</td>\n".
           " </tr>\n");
           }
		   include("unconnect.inc"); 
          }
?>

</table>


<br />
<hr />

<h4 class="forntsarabun1">��ª��ͼ����ºӹҭ���ŧ����¹����</h4>
<?
include("connect.inc");
$tempsql2="CREATE TEMPORARY TABLE opcard1  Select * from  opcard  WHERE pension_status='Y' ";
$tempquery2 =mysql_query($tempsql2);	  

$sql2="Select  *,concat(yot,' ',name,' ',surname) as ptname from opcard1 ";
$query2=mysql_query($sql2);

$i=1;
?>

<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun1" bordercolor="#000000" style="border-collapse:collapse" >
  <tr align="center">
    <td bgcolor="#CCCCCC">�ӴѺ</td>
    <td bgcolor="#CCCCCC">HN</td>
    <td bgcolor="#CCCCCC">����-ʡ��</td>
    <td bgcolor="#CCCCCC">�������</td>
    <td bgcolor="#CCCCCC">�������Ѿ��</td>
  </tr>
  <?
 while($arr2=mysql_fetch_array($query2)){
  ?>
  <tr>
    <td><?=$i;?></td>
    <td><a target=_BLANK  href="seopcard.php?cHn=<?=$arr2['hn'];?>"><?=$arr2['hn'];?></a></td>
    <td><?=$arr2['ptname'];?></td>
    <td><?=$arr2['address'];?>&nbsp;�.<?=$arr2['tambol'];?>&nbsp;�.<?=$arr2['ampur'];?>&nbsp;�.<?=$arr2['changwat'];?> </td>
    <td><?=$arr2['phone'];?></td>
  </tr>
  <?
  $i++;
 }

  ?>
</table>