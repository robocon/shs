<?php
    session_start();
    $sOfficer="";
	$smenucode = "";
	$sRowid="";
	$sLevel="";
    session_register("sOfficer");
	session_register("smenucode");
	session_register("sRowid");
	session_register("sLevel");
//error_reporting (E_ALL ^ E_NOTICE);

function displaydate($x) {
	$thai_m=array("���Ҥ�","����Ҿѹ��","�չҤ�","����¹","����Ҥ�","�Զع�¹","�á�Ҥ�","�ԧ�Ҥ�","�ѹ��¹","���Ҥ�","��Ȩԡ�¹","�ѹ�Ҥ�");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="�ѹ��� $d ��͹ $m �.�. $y";
	return $displaydate;
} // end function displaydate

$showdate=displaydate(date("Y-m-d"));
$showtime=date("H:i:s");

    include("connect.inc");
//    print "$username<br>";
//    print "$password<br>";
    $query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
    $result = mysql_query($query) or die( mysql_error($Conn) );
        for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }
    if(mysql_num_rows($result)){
         $sOfficer=$row->name;
         $menucode=$row->menucode;
		  $_SESSION["smenucode"]=$row->menucode;
		$sRowid=$row->row_id;
		 $sLevel=$row->level;
$where_search= "";
//if($_SESSION["smenucode"] == "ADM"){
///////Ẻ�ͺ���//////
/*$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' ";
$result3 = mysql_query($query3) or die("Query failed");
$nrow3 = mysql_num_rows($result3);
if($nrow3==0){
	?>
	<script>
    window.open("assess/question_com.php",null,'height=550,width=850,scrollbars=1');
    </script>
	<?
}*/
////////////////////////////////
echo "
<FORM METHOD=POST ACTION=\"\">
	<INPUT TYPE=\"text\" NAME=\"search\" size=\"10\">&nbsp;<INPUT TYPE=\"submit\" value=\"����\">
</FORM>
";

	if(isset($_POST["search"]) && trim($_POST["search"]) <> ""){
		$xxx = explode(" ",$_POST["search"]);
		//$search_where_arr = array();
		//foreach($){
		//	$search_where .= " menu ";
		//}

		$yyy = implode("%' AND menu like '%",$xxx);
		$where_search = " AND (menu like '%".$yyy."%')";
		//echo $yyy;
	//}
}

	/*//echo "<script>alert('���ͺ') </script>";*/
 //print (" <tr>\n".
 // "  <td BGCOLOR='#008400'><font face='THSarabunPSK' size='3' color='#FFFFFF' >   $sOfficer </font></td>\n".
			//	" </tr>\n");
         print "<body bgcolor='#008080' text='#00FFFF' link='#FFFFFF' vlink='#FFFFFF' alink='#FFFFFF' onload='Realtime();'>";
         print "<table>";
		
         print "<tr>";
         print "<th bgcolor=#005555><font face='THSarabunPSK' size='4'>����</th>";
         print "</tr>";
if($menucode=='ADM' ){
	$sort = "ORDER BY menu ASC";
}elseif($menucode=='ADMPHA' ){
	$sort = "ORDER BY menu_sort2 ASC ,menu ASC";
}else{
	$sort = "ORDER BY menu_sort ASC ,menu ASC";
}
				 		
if($menucode=="ADM"){
		print (" <tr>\n".
                "  <td BGCOLOR='#CCFFCC' align='center' style='color: red;'><strong><font face='THSarabunPSK' size='4'  >$showdate <div id='divDetail'></div></font></strong></td>\n".
				" </tr>\n");
				
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::�͡�ҡ�к�($sOfficer)</font></a></td>\n".
				" </tr>\n");
		
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::�駫���/��Ѻ��ا�����</font></a></td>\n".
				" </tr>\n");	
				
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"holiday_add.php\"><font face='THSarabunPSK' size='3' >::�����������ѹ��ش��Шӻ� (Holiday)</font></a></td>\n".
				" </tr>\n");					
				
				
				print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"showcomservice.php\"><font face='THSarabunPSK' size='3' >::�ѹ�֡��û�Ժѵԧҹ</font></a></td>\n".
				" </tr>\n");	

		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_blank' href=\"showuser.php?menucode=$menucode\"><font face='THSarabunPSK' size='3' >::�Ѵ��â����ż����ҹ</font></a></td>\n".
				" </tr>\n");									 
					 
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- �Ѵ���͡���</font></a></td>\n".
				" </tr>\n");			
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n".
				" </tr>\n");	
}else if($sLevel=="admin"){
		print (" <tr>\n".
                "  <td BGCOLOR='#CCFFCC' align='center' style='color: red;'><strong><font face='THSarabunPSK' size='4'  >$showdate <div id='divDetail'></div></font></strong></td>\n".
				" </tr>\n");
				
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::�͡�ҡ�к�($sOfficer)</font></a></td>\n".
				" </tr>\n");
		
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::�駫���/��Ѻ��ا�����</font></a></td>\n".
				" </tr>\n");	

		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"holiday_add.php\"><font face='THSarabunPSK' size='3' >::�����������ѹ��ش��Шӻ� (Holiday)</font></a></td>\n".
				" </tr>\n");					

		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_blank' href=\"showuser.php?menucode=$menucode\"><font face='THSarabunPSK' size='3' >::�Ѵ��â����ż����ҹ</font></a></td>\n".
				" </tr>\n");									 
					 
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- �Ѵ���͡���</font></a></td>\n".
				" </tr>\n");			
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n".
				" </tr>\n");	
}else if($menucode=="ADMXR"){						
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::�͡�ҡ�к�($sOfficer)</font></a></td>\n".
				" </tr>\n");
		
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::�駫���/��Ѻ��ا�����</font></a></td>\n".
				" </tr>\n");					 
					 
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- �Ѵ���͡���</font></a></td>\n".
				" </tr>\n");			
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n".
				" </tr>\n");	
}else{
		print (" <tr>\n".
                "  <td BGCOLOR='#CCFFCC' align='center' style='color: red;'><strong><font face='THSarabunPSK' size='4'  >$showdate <div id='divDetail'></div></font></strong></td>\n".
				" </tr>\n");
							
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4'  >::�͡�ҡ�к�($sOfficer)</font></a></td>\n".
				" </tr>\n");

if($sOfficer=='��ó� �����ѡ��� (�.16633)'){
	print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='main' href=\"newpassdrug.php\"><font face='THSarabunPSK' size='3' >::����¹���� Lock ��è�����</font></a></td>\n".
				" </tr>\n");	
	print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='main' href=\"lock_drug_md.php\"><font face='THSarabunPSK' size='3' >::�к��ҷ���ͧ��� Lock/Un Lock</font></a></td>\n".
				" </tr>\n");
	print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='main' href=\"report_cscdformonth.php\"><font face='THSarabunPSK' size='3' >::��§ҹ���ԡ�Թ����ѭ�ա�ҧ (�����¹͡)</font></a></td>\n".
				" </tr>\n");							
}
		
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"com_support.php\"><font face='THSarabunPSK' size='3' >::�駫���/��Ѻ��ا�����</font></a></td>\n".
				" </tr>\n");		
				
		print (" <tr>\n".
                "  <td BGCOLOR='#008400'><a target='_top' href=\"holiday_add.php\"><font face='THSarabunPSK' size='3' >::�����������ѹ��ش��Шӻ� (Holiday)</font></a></td>\n".
				" </tr>\n");					
							 
					 
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"document_list.php\"><font face='THSarabunPSK' size='3' >::Edocument- �Ѵ���͡���</font></a></td>\n".
				" </tr>\n");			
		print (" <tr>\n".
                "  <td BGCOLOR='#008484'><a target='_top' href=\"km_index.php?act=view\"><font face='THSarabunPSK' size='3' >::KM- Knowledge base</font></a></td>\n".
				" </tr>\n");	
}							 
echo '<div id="test_dr_menu" style="display: none;">'.$sOfficer.'</div>';
if($menucode=='ADMCT' || $menucode=='ADMFINANCE'){
 $query = "SELECT menu,script,target FROM menulst WHERE menucode LIKE '$menucode%' AND status='Y'  ".$sort;
 $result = mysql_query($query) or die( mysql_error($Conn) );

 	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
               print (" <tr>\n".
                  "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
                  " </tr>\n");
                  };
}elseif($sOfficer=='������ �زԸҴ� (�.33906)'){
    $query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' ".$where_search." ".$sort;
    $result = mysql_query($query) or die( mysql_error($Conn) );
    
    while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
        "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
        " </tr>\n");
    }
}elseif($sOfficer=='��Է��� ��ظҴ� (�.38228)'){
    $query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' ".$where_search." ".$sort;
    $result = mysql_query($query) or die( mysql_error($Conn) );
    
    while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
        "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
        " </tr>\n");
    }
}elseif($sOfficer=='����Թ��� ����չҤ (�.19921)'){
	 $query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADM19921' AND status='Y' ".$where_search." ".$sort;
	 $result = mysql_query($query) or die( mysql_error($Conn) );
	
			while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
				   print (" <tr>\n".
					  "  <td BGCOLOR='#005555'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
					  " </tr>\n");
					  } 
}else{

$sql2="select * from menu_user WHERE member_code='".$sRowid."'";
$result2= mysql_query($sql2) or die( mysql_error($Conn) );
$rows=mysql_num_rows($result2);

if($rows){///  ����� rows

 $query = "SELECT menu,link ,sort,target FROM menu_user WHERE member_code='".$sRowid."' and sort !=0 ORDER BY `sort` ASC"; // ����� 0 ����ʴ�
 $result = mysql_query($query) or die( mysql_error($Conn) );

        while (list ($menu,$link ,$sort,$target) = mysql_fetch_row ($result)) {
               print (" <tr>\n".
                  "  <td BGCOLOR='#008484'><a target='$target' href=\"$link?\"><font face='THSarabunPSK' size='4'>$menu</font></a></td>\n".
                  " </tr>\n");
                  }
				  		  
}else{
				  
	$query = "SELECT menu,script,target FROM menulst WHERE menucode like '$menucode%' AND status='Y' ".$where_search." ".$sort;
	$result = mysql_query($query) or die( mysql_error($Conn) );

	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
	print (" <tr>\n".
	"  <td BGCOLOR='#008484' style='padding: 3px;'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4'  COLOR='#ffffff'>$menu</font></a></td>\n".
	" </tr>\n");
	}
				  
}/// �Դ if rows		  

}
	//��úѭ����� �ء������
	$query = "SELECT menu,script,target FROM menulst WHERE status='Y' and menucode = 'ALL' ORDER BY menu_sort ASC ";
	$result = mysql_query($query) or die( mysql_error($Conn) );

	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR='#008484'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='3' >$menu</font></a></td>\n".
		" </tr>\n");
	};
	print (" <tr>\n".
	"  <td BGCOLOR='#008400'><a target='_top' href=\"../sm3.php\"><font face='THSarabunPSK' size='4' >::Logout- �͡�ҡ�к�</font></a></td>\n".
	" </tr>\n");

	print "</table>";
	
	// ����͹㹤����á��� login 
	if( $menucode == 'ADM' && empty($_SESSION['net_alert']) ){
		$sql_internet = "SELECT COUNT(`idcard`) AS `count_id` 
		FROM `internet` 
		WHERE `idcard` = '' ;";
		$q_net = mysql_query($sql_internet);
		$net = mysql_fetch_assoc($q_net);
		if( $net['count_id'] > 0 && $net['count_id'] < 20 ){
			?>
			<script>alert('�ӹǹ����� internet ������');</script>
			<?php
			$_SESSION['net_alert'] = true;
		}
	}

	if($menucode=='ADMOPD') // ����繨��.����¹
	{
		$prev1Year = ( date("Y", strtotime("-1 year")) + 543 ).'-'.date("m-d", strtotime("-1 year"));
		$sql = "SELECT `row_id` FROM `ipcard` WHERE `date` >= '$prev1Year' AND `bedcode` IS NULL AND `dcdate` = '0000-00-00 00:00:00' ";
		$q = mysql_query($sql);
		if(mysql_num_rows($q) > 0)
		{
			?>
			<style>
				#regisNotify a {
					color: black!important;
				}
			#regisNotify{
				position: absolute;
				top: 0;
				left: 0;
				width: 100%;
				height: 100%;
				background-color: #ffffff;
				color: #000;
			}
			#regisCloseBtn{
				color: #000;
				width: 100%;
				display: table;
				padding: 8px;
			}
			</style>
			<div id="regisNotify">
				<div>
					<div style="text-align: center;"><a href="javascript:void(0); id="regisCloseBtn" onclick="btnClose()">[�Դ]</a></div>
					<div>
						<p>����͹!!! �բ����ż�����㹷�������¡��ԡ admit </p>
						<p>������� <a href="cancel_admit.php" target="_blank" onclick="btnClose()">¡��ԡ admit</a></p>
					</div>
				</div>
			</div>
			<script>
				function btnClose()
				{
					document.getElementById('regisNotify').style.visibility = "hidden";
				}
			</script>
			<?php 
			//$_SESSION['regisNotify_SESS'] = 1;
		}
	}

	print "</body>";
	include("unconnect.inc");

}
   else {
        print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
        print "...<br>";
        print "...<br>";
        print "...<br>";
        print "...<br>";
        print "<font face='THSarabunPSK' size='5'>...����ҹ !... <a href='login.php' >����к�����</a></font>";
        print "</body>";
       session_unregister("sIdname");
       session_unregister("sPword");
       session_unregister("sOfficer");
	   session_unregister("sRowid");
	   session_unregister("sLevel");
            }
?>
<style type="text/css" media="screen">
@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.eot") /* EOT file for IE */
}
@font-face {
 font-family: THSarabunPSK;
 src: url("/sm3/surasak3/THSarabun.ttf") /* TTF file for CSS3 browsers */
}
</style>
<script language="javascript" src="js/jquery-1.8.0.min.js"></script>
<script>
function Realtime(){
	$.ajax({url:"ajaxtime.php",
		async:false,
		cache:false,
		global:false,
		type:"POST",
		data:"",
		dataType:"html",
		success: function(result){ 

			// ������ŧ�繵���Ţ����Ѻ JS
			var prepare_date = Date.parse(result);
			Real(prepare_date);
		}
	});
}

function Real(prepare_date){ 
	setInterval(function(){ 

		// +1 ����������
		prepare_date += 1000;
		var d = new Date(prepare_date);
		var hour = to2Digit(d.getHours());
		var min = to2Digit(d.getMinutes());
		var sec = to2Digit(d.getSeconds());
		document.getElementById("divDetail").innerHTML = hour+':'+min+':'+sec+' �.';
	}, 1000);
}

function to2Digit(i){ 
	if(i < 10){
		i = "0"+i;
	}
	return i;
}
</script>