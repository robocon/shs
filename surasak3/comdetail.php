<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
</style><?php
      
 $Thaidate=date("d-m-").(date("Y")+543);
 print"<FONT SIZE='3'><CENTER>แบบรายงายการขอแก้ไข/เพิ่มเติมโปรแกรมในระบบคอมพิวเตอร์เครือข่าย<BR>";
  print"ศูนย์คอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง โทร 6206<BR></CENTER></FONT>";
$num = Y;
    include("connect.inc");
    $query = "SELECT  row,depart,head,datetime,programmer,date,detail,user1,phone FROM com_support   WHERE row=$row  ";
    $result = mysql_query($query)
        or die("Query failed111");

   if(mysql_num_rows($result)){
        
        print"<BR><BR><CENTER><table>";
        print" <tr align='center'>";
        print"  <th bgcolor=CD853F>ลำดับ</th>";
        print"  <th bgcolor=CD853F>แผนก</th>";
        print"  <th bgcolor=CD853F>หัวข้อ</th>";
		   print"  <th bgcolor=CD853F>รายละเอียด</th>";
        print"  <th bgcolor=CD853F>วันเวลาที่ร้องขอ</th>";
		print"  <th bgcolor=CD853F>ผู้ร้องขอ</th>";
		print"  <th bgcolor=CD853F>เบอร์ติดต่อ</th>";
      
        print" </tr>";
        while (list ($row,$depart,$head,$datetime,$programmer,$date,$detail,$user1,$tel) = mysql_fetch_row ($result)) {
            print (" <tr>\n".
                "  <td BGCOLOR=F5DEB3>$row</td>\n".
                "  <td BGCOLOR=F5DEB3>$depart</td>\n".
                "  <td BGCOLOR=F5DEB3>$head</a></td>\n".
            
				          "  <td BGCOLOR=F5DEB3>".nl2br($detail)."</td>\n".
							       "  <td BGCOLOR=F5DEB3>$date</td>\n".
				 "  <td BGCOLOR=F5DEB3>$user1</td>\n".
				  "  <td BGCOLOR=F5DEB3>$tel</td>\n".
                " </tr>\n");
  						    }
        print"</table></CENTER>";


	}



$row = $_GET['row'];
$sql = "SELECT * FROM `com_support_details` WHERE `com_id` = '$row' ";

$q = mysql_query($sql);
if(mysql_num_rows($q) > 0){

    ?>
    <br>
    <h3>รายละเอียดที่กำลังดำเนินการ</h3>

    <table width="100%">
        <tr valign="top" bgcolor="#FFCC00">
            <th width="20%">วันที่อัพเดทข้อมูล</th>
            <th>รายละเอียด</th>
        </tr>
    <?php
    while ($a = mysql_fetch_assoc($q)) {
        ?>
        <tr bgcolor="#FFFF99">
            <td><?=$a['date'];?></td>
            <td>
                <?=nl2br($a['detail']);?>
                <?php 
                $detail_id = $a['id'];
                $sql_img = "SELECT `path` FROM `com_support_imgs` WHERE `detail_id` = '$detail_id' ";
                $q_img = mysql_query($sql_img);
                if(mysql_num_rows($q_img) > 0 ){
                    ?>
                    <div class="clearfix">
                    <?php
                    while ($b = mysql_fetch_assoc($q_img)) {
                        ?>
                        <a href="<?=$b['path'];?>" target="_blank"><img style="height:150px;" src="<?=$b['path'];?>" alt=""></a>
                        <?php
                    }
                    ?>
                    </div>
                    <?php
                }
                
                ?>
            </td>
        </tr>
        <?php
    }


}

 include("unconnect.inc");  

?>

