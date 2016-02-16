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

$alert_lists = array();
?>
<script type="text/javascript" src="templates/classic/main.js"></script>
<script type="text/javascript" src="assets/js/json2.js"></script>
<form method="post" action="<?php echo $PHP_SELF ?>">
    <p>ค้นหาคนไข้จาก&nbsp; ชื่อ</p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="text" name="name" size="12" id="aLink"></p>
    <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>
<script type="text/javascript">
    document.getElementById('aLink').focus();
</script>
<table>
    <tr>
        <th bgcolor=6495ED>HN</th>
        <th bgcolor=6495ED>ยศ</th>
        <th bgcolor=6495ED>ชื่อ</th>
        <th bgcolor=6495ED>สกุล</th>
        <th bgcolor=6495ED>ว/ด/ป เกิด</th>
        <th bgcolor=6495ED>บัตร ปชช.</th>
        <th bgcolor=6495ED>สถานะ ward</th>
    </tr>
    <?php
    $name = isset($_POST['name']) ? trim($_POST['name']) : null ;
    if (!empty($name)){
        include("connect.inc");
        
        // global $name;
        $query = "SELECT hn,yot,name,surname,dbirth,idcard FROM opcard WHERE name LIKE '$name%' ";
        $result = mysql_query($query) or die( mysql_error() );
        
        while (list ($hn,$yot,$name,$surname,$dbirth,$idcard) = mysql_fetch_row ($result)) {
        
            $alert_msg = '-';
            $sql_pre = "SELECT b.`my_ward`,b.`dcdate` FROM `bed` AS a 
            LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
            WHERE a.`hn` = '%s' ;";
            $sql = sprintf($sql_pre, $hn);
            $query = mysql_query($sql);
            $item = mysql_fetch_assoc($query);
            
            if($item != false && $item['dcdate'] == '0000-00-00 00:00:00'){
                $alert_msg = $item['my_ward'];
            }
            
            print (" <tr>\n".
            "  <td BGCOLOR=66CDAA><a target=_BLANK onclick=\"checkIpd(this, event, '$hn')\" href=\"opedit.php? cHn=$hn \">$hn</a></td>\n".
            "  <td BGCOLOR=66CDAA>$yot</td>\n".
            "  <td BGCOLOR=66CDAA>$name</td>\n".
            "  <td BGCOLOR=66CDAA>$surname</td>\n".
            "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
            "  <td BGCOLOR=66CDAA>$idcard</td>\n".
            "<td bgcolor='66cdaa' align='center'>$alert_msg</td>".
            " </tr>\n");
            if( empty($idcard) ){
                $alert_lists[] = "- $hn";
            }
            
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
					alert('สถานะของผู้ป่วยยังอยู่ '+txt.msg+' กรุณาติดต่อที่ Ward เพื่อ Discharge');
					SmPreventDefault(ev);
				}else{
					// window.open(link.href, '_blank');
				}
			},
			false // true is Syncronous and false is Assyncronous (Default by true)
		);
		
	}
</script>
<?php
if( !empty($alert_lists) ){
    $alert_name = implode("\n", $alert_lists);
    ?>
    <script type="text/javascript">
        alert('HN ดังต่อไปนี้ไม่มีหมายเลขบัตรประชาชน\n'+'<?php echo $alert_name;?>');
    </script>
<?php } ?>