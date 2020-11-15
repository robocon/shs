<?php
session_start();
require "includes/functions.php";

if(PHP_VERSION_ID <= 50217){
	session_unregister("cHn");  
	session_unregister("cPtname");
	session_unregister("cPtright");
	session_unregister("nVn");
	session_unregister("nRunno");  
	session_unregister("vAN"); 
	session_unregister("thdatehn"); 
	session_unregister("cNote"); 
}else{
	unset($_SESSION['cHn']);
	unset($_SESSION['cPtname']);
	unset($_SESSION['cPtright']);
	unset($_SESSION['nVn']);
	unset($_SESSION['nRunno']);
	unset($_SESSION['vAN']);
	unset($_SESSION['thdatehn']);
	unset($_SESSION['cNote']);
}
	
?>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<form method="post" action="opnameops.php">
    <p>���Ҥ���ҡ&nbsp; ������й��ʡ��</p>
    <p>����������ŷ�駪�����й��ʡ�ŷ���ͧ������</p>
    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="name" size="12" id="aLink">
    &nbsp;&nbsp;&nbsp;&nbsp; ʡ��&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="sname" size="12"></p>
    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="  ��ŧ  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ź���  " name="B2"></p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
<table>
    <tr>
        <th bgcolor="6495ED">HN</th>
        <th bgcolor="6495ED">��</th>
        <th bgcolor="6495ED">����</th>
        <th bgcolor="6495ED">ʡ��</th>
        <th bgcolor="6495ED">�/�/� �Դ</th>
        <th bgcolor="6495ED">�ѵ� ���.</th>
        <th bgcolor="6495ED">�� þ.</th>
        <th bgcolor="6495ED">��Ǩ�Ѵ</th>
        <th bgcolor="6495ED">��Ǩ�͹</th>
        <th bgcolor="6495ED">ʶҹ� ward</th>
		<th></th>
    </tr>
<?php
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$sname = htmlspecialchars($_POST['sname'], ENT_QUOTES);

if(!empty($name)){
    include("connect.inc");

    $query = "SELECT `hn`,`yot`,`name`,`surname`,`dbirth`,`idcard` 
	FROM `opcard` 
	WHERE `name` LIKE '%$name%'";

	if( !empty($sname) ){
		$query .= " AND `surname` LIKE '%$sname%'";
	}

    $result = mysql_query($query) or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$idcard) = mysql_fetch_row ($result)) {
		
		$alert_msg = '-';
		
		$sql = sprintf("SELECT `hn`,`dcdate`, `my_ward`
		FROM `ipcard` 
		WHERE `hn` = '%s' 
		ORDER BY `row_id` DESC LIMIT 1", $hn);
		$query = mysql_query($sql);
		$item = mysql_fetch_assoc($query);
		if($item != false && $item['dcdate'] == '0000-00-00 00:00:00'){
			$alert_msg = $item['my_ward'];
		}
		
        print (" <tr>\n".
        "  <td BGCOLOR='66CDAA'><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php? cHn=$hn \">$hn</a></td>\n".
        "  <td BGCOLOR='66CDAA'>$yot</td>\n".
        "  <td BGCOLOR='66CDAA'>$name</td>\n".
        "  <td BGCOLOR='66CDAA'>$surname</td>\n".
        "  <td BGCOLOR='66CDAA'>$dbirth</td>\n".
        "  <td BGCOLOR='66CDAA'>$idcard</td>\n".
        "  <td BGCOLOR='66CDAA'><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">�� þ.</a></td>\n".
        "  <td BGCOLOR='66CDAA'><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">��Ǩ�Ѵ</a></td>\n".
		"  <td BGCOLOR='66CDAA'><a target= _BLANK href=\"ancheck.php?hn=$hn\">��Ǩ�͹</a></td>\n".
		"<td bgcolor='66cdaa' align='center'>$alert_msg</td>".
		"  <td BGCOLOR=".$color."><button type=\"button\" id=\"checkPt\" onclick=\"checkPtRight(this, event, '$idcard')\">��Ǩ�ͺ�Է��</button></td>\n".
        " </tr>\n");
    }
    include("unconnect.inc");
}
?>
</table>
<script type="text/javascript">
	/* checkIpd */
	function checkIpd(link, ev, hn){
		// SmPreventDefault(ev);
		// var href = this.href;
		var newSm = new SmHttp();
		newSm.ajax(
			'templates/regis/checkIpd.php',
			{ id: hn },
			function(res){
				var txt = JSON.parse(res);
				if( txt.state === 400 ){
					alert('ʶҹТͧ�������ѧ���� '+txt.msg+' ��سҵԴ��ͷ�� Ward ���� Discharge');
					SmPreventDefault(ev);
				}else{
					// window.open(link.href, '_blank');
				}
			},
			false // true is Syncronous and false is Assyncronous (Default by true)
		);
		
	}
</script>