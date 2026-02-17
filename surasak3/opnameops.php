<?php
session_start();
require_once "includes/functions.php";
require_once "connect.php";

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

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ค้นหาจาก ชื่อ หรือ นามสกุล</title>
</head>
<body>
<style>
body {
	background-color: #FFFFF0;
    font-family: "TH SarabunPSK";
	font-size: 18px;
}
.txtsarabun {
	font-family:"TH SarabunPSK";
	font-size:20px;
}	
.style2 {
	font-family:"TH SarabunPSK";
	font-size: 18;
}
table tr td{
	padding: 6px;
}
.fButton{
    padding: 2px 4px;
    border: 1px solid #545454;
    border-radius: 3px;
    background-color: #efefef;
    color: black;
    text-decoration: none;
    display: inline-block;
}
.sweetContainer{
    text-align: left;
    font-size:16pt;
}
.sweetContainer p{
    margin: 0 0 8px 0;
}
</style>
<script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="js/ptrightOnline.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>

<form method="post" action="opnameops.php">
    <h1>ค้นหาคนไข้จาก&nbsp;ชื่อหรือนามสกุล</h1>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="name" size="12" id="aLink" class="txtsarabun">
    &nbsp;&nbsp;&nbsp;&nbsp; สกุล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="sname" size="12" class="txtsarabun"></p>
    
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="  ตกลง  " name="B1" class="txtsarabun">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ล้างค่า  " name="B2" class="txtsarabun"></p>
</form>
<table>
    <tr>
        <th bgcolor="6495ED">HN</th>
        <th bgcolor="6495ED">ยศ</th>
        <th bgcolor="6495ED">ชื่อ</th>
        <th bgcolor="6495ED">สกุล</th>
        <th bgcolor="6495ED">ว/ด/ป เกิด</th>
        <th bgcolor="6495ED">บัตร ปชช.</th>
        <th bgcolor="6495ED">มา รพ.</th>
        <th bgcolor="6495ED">ตรวจนัด</th>
        <th bgcolor="6495ED">ตรวจนอน</th>
        <th bgcolor="6495ED">สถานะ ward</th>
		<th bgcolor="6495ED">หมายเหตุ</th>
		<th bgcolor="6495ED"></th>
    </tr>
<?php
$name = htmlspecialchars($_POST['name'], ENT_QUOTES);
$sname = htmlspecialchars($_POST['sname'], ENT_QUOTES);
if(!empty($name) OR !empty($sname)){

    $query = "SELECT `hn`,`yot`,`name`,`surname`,`dbirth`,`idcard`,`idguard` FROM `opcard` WHERE ";

    if( !empty($name) ){
		$query .= "`name` LIKE '%$name%' ";
	}

	if( !empty($sname) ){ 
        if( !empty($name) ){
            $query .= "AND ";
        }

		$query .= "`surname` LIKE '%$sname%' ";
	}

    $query .= "ORDER BY `row_id` DESC";
	//echo $query;
    $result = mysql_query($query) or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$idcard,$idguard) = mysql_fetch_row ($result)) {
		
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
		$mxCode = substr($idguard,0,4);
		$defaultBgColor = '#66CDAA';
		if(empty($idcard) OR $idcard=='-' OR $mxCode=='MX07'){
			$defaultBgColor = 'red';
		}
		
        print (" <tr style='background-color: $defaultBgColor;'>\n".
        "  <td><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"javascript:void(0);\" oncontextmenu=\"return doNotOpenNewTab(event, '$hn');\" data-url=\"opedit.php?cHn=$hn\">$hn</a></td>\n".
        "  <td>$yot</td>\n".
        "  <td>$name</td>\n".
        "  <td>$surname</td>\n".
        "  <td>$dbirth</td>\n".
        "  <td>$idcard</td>\n".
        "  <td><a target= _BLANK href=\"hndaycheck.php?hn=$hn\">มา รพ.</a></td>\n".
        "  <td><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">ตรวจนัด</a></td>\n".
		"  <td><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</a></td>\n".
		"<td align='center'>$alert_msg</td>".
		"  <td>$idguard</td>\n".
		"  <td>
        <a href=\"javascript:void(0);\" class='fButton' onclick=\"SRMCheckSit('$idcard')\">SRM สปสช</a>
        </td>\n".
        " </tr>\n");
    }
    include("unconnect.inc");
}
?>
</table>

<style>
#ptrightNotify{top: 2%;left: 50%;width:700px;height:350px;margin-top: 1em;margin-left: -300px;border: 1px solid #ccc;background-color: #f3f3f3;position:fixed;}
#ptnotifyHeader{padding: 6px;background: #636363;text-align: right;}
#ptrightClose{font-size: 24px;color: #fff;text-decoration: none;}
#ptnotifyContent{padding: 6px;}
</style>
<div id="ptrightNotify" style="display: none;">
    <div id="ptnotifyHeader">
        <a href="javascript:void(0);" id="ptrightClose" onclick="document.getElementById('ptrightNotify').style.display = 'none';">Close</a>
    </div>
    <div style="padding: 6px;" id="ptnotifyContent">กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่</div>
</div>

<script type="text/javascript" src="js/nhso.js"></script>
<script type="text/javascript">
	document.getElementById('aLink').focus();

	function testCheckSit(idcard){ 
        document.getElementById('ptnotifyContent').innerHTML = 'กำลังตรวจสอบสิทธิจาก WebService สปสช กรุณารอสักครู่';
        registerChecksit('ptnotifyContent',idcard,'<?=$person_id;?>','<?=$smctoken;?>');
        document.getElementById('ptrightNotify').style.display = '';
    }

    function SRMCheckSit(idcard){
        loadSRM(idcard);
    }

    /* checkIpd */
    function checkIpd(link, ev, hn){
        ev.preventDefault();

        if (ev.ctrlKey) {
            return doNotOpenNewTab(ev, hn);
        }

        var newSm = new SmHttp();
        newSm.ajax(
            'templates/regis/checkIpd.php',
            { id: hn },
            function(res){
                var txt = JSON.parse(res);
                if( txt.state === 400 ){
                    alert('สถานะของผู้ป่วยยังอยู่ '+txt.msg+' กรุณาติดต่อที่ Ward เพื่อ Discharge');
                    
                }else{
                    const baseUrl = link.getAttribute('data-url');
                    window.open(baseUrl, 'registerVn',"width="+screen.width+",height="+screen.height);
                }
            },
            false // true is Syncronous and false is Assyncronous (Default by true)
        );
        
    }

    function doNotOpenNewTab(ev,hn){
        onSendTab(hn);
        alert("ห้ามเปิดหน้าลงทะเบียนซ้ำซ้อน");
        return false;
    }

    async function onSendTab(hn) {
        const username = encodeURIComponent('<?=$sOfficer;?>');
        const tab = encodeURIComponent('ophn จะเปิด tab ใหม่');
        const response = await fetch('open_tab.php?username='+username+'&tab='+tab+'&hn='+hn);

        if (!response.ok) {
        }

        const body = await response.text();
    }
</script>
</body>
</html>