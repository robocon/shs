<?php
	session_start();

$user_code = $_SESSION['smenucode'];
$user_id = $_SESSION['sIdname'];
if( $user_code !== 'ADM' ){
    
    // ตรวจสอบชื่อ และ menucode ว่าอยู่ในรายการหรือไม่
    $check_level = in_array($user_code, array('ADMPH', 'ADMPHA'));
    $check_user = in_array($user_id, array('พรทิพา'));
	//$check_user = in_array($user_id, array('อรัญญา', 'วนิดาดา', 'พรทิพา'));
	//$check_user = in_array($user_id, array('อรัญญา', 'วนิดาดา', 'พรทิพา','ชุติกาญจน์','ชนากานต์','เพียงออ','รุ่งทิวา','อมรรัตน์','ศุภรัตน์1','ศุภรัตน์2','ชนากานต์'));
   
    if( $check_level === false OR $check_user === false ){
        ?>
        <p>คุณไม่มีสิทธิ์ในการแก้ไขจำนวนยาในห้องจ่าย กรุณาติดต่อ</p>
        <ol>
            <li>พ.อ.หญิง พรทิพา จันทร์ณรงค์</li>
        </ol>
        <p>เพื่อทำการขอใช้สิทธิ์แก้ไขข้อมูลสต๊อกยา</p>
        <p><a href="../nindex.htm">คลิกที่นี่</a> เพื่อกลับไปหน้าเมนูหลัก</p>
        <?php
        exit;
    }
}

	function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    $str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

	include("connect.inc");

	if(isset($_POST["editstock"])){
		

		$sql = "Update druglst set stock = '".$_POST["stock"]."' , oldstock = '".$_POST["oldstock"]."', totalstk='".($_POST["mainstk"]+$_POST["stock"])."' , edit_user = '".$_SESSION["sOfficer"]."', edit_date = '".date("Y-m-d")."' where drugcode = '".$_POST["drugcode"]."' ";

		$result = Mysql_Query($sql);

		if($result){
			echo "แก้ไขข้อมูลเรียบร้อยแล้ว<BR>";
			echo "
				<TABLE>
				<TR>
					<TD align=\"right\">ชื่อยา :</TD>
					<TD>".$_POST["tradname"]."</TD>
				</TR>
				<TR>
					<TD align=\"right\">จำนวนในห้องจ่าย : </TD>
					<TD>".number_format($_POST["stock"],0)."</TD>
				</TR>
				<TR>
					<TD align=\"right\">จำนวนในคลัง :</TD>
					<TD>".number_format($_POST["mainstk"],0)." </TD>
				</TR>
					<TR>
					<TD align=\"right\">จำนวนทั้งหมด :</TD>
					<TD>".number_format(($_POST["mainstk"]+$_POST["stock"]),0)."</TD>
				</TR>
				</TABLE>

			";

		}else{
			echo "ไม่สามารถแก้ไขข้อมูลได้";
		}

		echo "<BR><A HREF=\"".$_SERVER['PHP_SELF']."\">&lt;&lt; กลับ</A>";
		exit();

	}


    print  "แก้ไขจำนวนยาในห้องจ่าย <br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">รหัสยา : </a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ตกลง     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a></font></p>
</form>

<table width="500">
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>รหัส</th>
  <th bgcolor=CC9900><font face='Angsana New'>ชื่อยา</th>
  <th bgcolor=CC9900><font face='Angsana New'>จำนวนในคลัง</th>
  <th bgcolor=CC9900><font face='Angsana New'>จำนวนในห้องจ่าย</th>
  <th bgcolor=CC9900><font face='Angsana New'>รวมสุทธิ</th>
  <th bgcolor=CC9900><font face='Angsana New'>&nbsp;</th>
 </tr>
<?php
If (!empty($drugcode)){
    

    $query = "SELECT drugcode, tradname, stock, oldstock ,mainstk,totalstk FROM druglst WHERE drugcode like '".$_POST["drugcode"]."%' ";
    $result = mysql_query($query) or die("Query failed");

    while (list ($drugcode, $trandname, $stock, $oldstock,$mainstk,$totalstk) = mysql_fetch_row ($result)) {
		if($oldstock == 0) $oldstock = $stock;
        print (" <FORM METHOD=POST ACTION=\"$PHP_SELF\">
           <tr>\n".
           "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$trandname</td>\n".
    "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=#FFCC99><INPUT TYPE=\"text\" NAME=\"stock\" value=\"$stock\"></td>\n".
    "  <td BGCOLOR=#FFCC99><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=#FFCC99><INPUT TYPE=\"submit\" name=\"editstock\" value=\" แก้ไข \"></td>\n".
           " </tr>
		   <INPUT TYPE=\"hidden\" name=\"drugcode\" value=\"".jschars($drugcode)."\">
		   <INPUT TYPE=\"hidden\" name=\"mainstk\" value=\"".$mainstk."\">
		   <INPUT TYPE=\"hidden\" name=\"tradname\" value=\"".jschars($trandname)."\">
			<INPUT TYPE=\"hidden\" name=\"oldstock\" value=\"".$oldstock."\">
           </FORM>
			
		   \n");
         }

  
          }
 include("unconnect.inc");
?>
</table>


