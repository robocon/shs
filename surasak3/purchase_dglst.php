<?php
session_start();

$user_code = $_SESSION['smenucode'];
$user_id = $_SESSION['sIdname'];
if( $user_code !== 'ADM' ){
    
    // ��Ǩ�ͺ���� ��� menucode ����������¡���������
    $check_level = in_array($user_code, array('ADMPH', 'ADMPURCHASE'));
    $check_user = in_array($user_id, array('��ѭ��','purchase'));
    
    if( $check_level === false OR $check_user === false ){
        ?>
        <p>�س������Է���㹡����䢢������� ��سҵԴ���</p>
        <ol>
            <li>�.�.˭ԧ ��ѭ�� �����</li>
        </ol>
        <p>���ͷӡ����䢢����� ʻ.���ᾷ��</p>
        <p><a href="../nindex.htm">��ԡ�����</a> ���͡�Ѻ�˹��������ѡ</p>
        <?php
        exit;
    }
}

  print "��¡��ʻ.���ᾷ��<br> ";
if(isset($_GET["action"]) && $_GET["action"] == "drugcode"){
include("connect.inc");
	
	$sql = "Select drugcode,tradname from druglst  where  drugcode like '%".$_GET["search1"]."%' AND grouptype='pc' limit 10 ";
	$result = Mysql_Query($sql)or die(Mysql_error());

	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: center; width:300px; height:430px; overflow:auto; \">";

		echo "<table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FF99CC\"><tr align=\"center\" bgcolor=\"#333333\"><td width=\"80\"><font style=\"color: #FFFFFF;\"><strong>������</strong></font></td><td width=\"150\" align='center'><font style=\"color: #FFFFFF;\"><strong>������(��ä��)</strong></font></td><td width=\"20\"><strong>&nbsp;&nbsp;<A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\"><font style=\"color: #FFFF99;\">�Դ</font></A></strong></td></tr>";


		$i=1;
		while($se = Mysql_fetch_assoc($result)){
		echo "<tr><td><A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('".$_GET["getto"]."').value = '".trim($se["drugcode"])."';document.getElementById('list').innerHTML ='';\">&nbsp;",$se["drugcode"],"</A></td><td>&nbsp;".$se['tradname']."</td><td>&nbsp;</td></tr>";
		}
		
		echo "</TABLE></Div>";
	}

exit();
}
?>
<script>
function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}
function searchSuggest(str,len,getto) {
	
		str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){

			url = 'purchase_dglst.php?action=drugcode&search1=' + str+'&getto=' + getto;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);

			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<body onLoad="document.getElementById('drugcode').focus();">
<form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New">
<Div id="list" style="left:150PX;top:70PX;position:absolute;"></Div>
<a target='right' href="purchase_drugcode.php">������ ?</a>&nbsp;&nbsp;
<input type="text" name="drugcode" size="10" id='drugcode' onKeyPress="searchSuggest(this.value,2,'drugcode');">&nbsp;&nbsp;&nbsp;&nbsp;
<input type="submit" value="  ��ŧ  " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED>����</th>
  <th bgcolor=6495ED>���͡�ä��</th>
  <th bgcolor=6495ED>�������ѭ</th>
  <th bgcolor=6495ED>�ҤҢ��</th>
  <th bgcolor=6495ED>PART</th>
  <th bgcolor=6495ED>��ͧ����</th>
  <th bgcolor=6495ED>㹤�ѧ</th>
  <th bgcolor=6495ED>�ط��</th>
  <th bgcolor=6495ED>packing</th>
  <th bgcolor=6495ED>�Ҥ�/ᾤ (��� VAT)</th>
  <th bgcolor=6495ED>�Ҥҡ�ҧ</th>
  <th bgcolor=6495ED>�Ҥҷع</th>
  <th bgcolor=6495ED>���ʺ���ѷ</th>
  <th bgcolor=6495ED>���ͺ���ѷ</th>
   <th bgcolor=6495ED>���� 24 ��ѡ</th>
   <th bgcolor=6495ED>ʻ<br>���ᾷ��</th>
 </tr>

<?php
/*
  comcode char(10) default NULL,
*  drugcode char(10) default NULL,
*  tradname char(30) default NULL,
  genname char(30) default NULL,
  unit char(10) default NULL,
  unitpri double default NULL,
*  salepri double default NULL,
*  part char(5) default NULL,
  freepri double default NULL,
*  stock int(11) default NULL,
*  mainstk int(11) default NULL,
*  totalstk int(11) default NULL,
  slcode char(10) default NULL,
  bcode char(10) default NULL,
  edpri double default NULL,
  pack char(15) default NULL,
  packpri double default NULL,
  contract double default NULL,
*/
If (!empty($drugcode)){
    include("connect.inc");

    $query = "SELECT drugcode,tradname,genname,salepri,part,stock,mainstk,totalstk, pack, packpri_vat, comcode, comname, unitpri,code24, edpri,spec FROM druglst WHERE drugcode LIKE '$drugcode%' AND grouptype ='pc' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname, $salepri,$part,$stock,$mainstk,$totalstk,$pack,$packpri_vat, $comcode, $comname, $unitpri,$code24, $edpri,$spec) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a   href=\"purchase_dgedit.php?Dgcode=$drugcode\">$drugcode</a></td>\n".
           "  <td BGCOLOR=66CDAA>$tradname</td>\n".
		   "  <td BGCOLOR=66CDAA>$genname</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA>$part</td>\n".
           "  <td BGCOLOR=66CDAA>$stock</td>\n".
           "  <td BGCOLOR=66CDAA>$mainstk</td>\n".
           "  <td BGCOLOR=66CDAA>$totalstk</td>\n".
		 "  <td BGCOLOR=66CDAA>$pack</td>\n".
		 "  <td BGCOLOR=66CDAA>$packpri_vat</td>\n".
		"  <td BGCOLOR=66CDAA>$edpri</td>\n".
		"  <td BGCOLOR=66CDAA>$unitpri</td>\n".
		 "  <td BGCOLOR=66CDAA>$comcode</td>\n".
		 "  <td BGCOLOR=66CDAA>$comname</td>\n".
			    "  <td BGCOLOR=66CDAA>$code24</td>\n".
				"  <td BGCOLOR=66CDAA>$spec</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>
</body>

