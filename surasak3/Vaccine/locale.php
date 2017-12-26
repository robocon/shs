<?

// $ServerName = "localhost";
// $DatabaseName = "smdb";
// $User = "root"; 
// $Password = "1234";

// $conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้");

// mysql_select_db($DatabaseName,$conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
// mysql_query("SET NAMES TIS620", $conn);
include '../connect.php';
          
$data = $_GET['data'];
$val = $_GET['val'];

    if ($data=='vaccine') { 
        echo "<select name='vaccine' onChange=\"dochange('vaccine_detail', this.value)\" class='table_font2'>\n";
        echo "<option value='0'>===เลือกวัคซีน===</option>\n";
        $result=mysql_query("select * from vaccine order by id_vac");
        while($row = mysql_fetch_array($result)){
            echo "<option value=\"$row[id_vac]\" >$row[vac_name]</option> \n" ;
        }
    }  else if ($data=='vaccine_detail') {
        echo "<select name='vaccine_detail' class='table_font2'>\n";
        echo "<option value='0'>=== เลือกเข็ม ===</option>\n";
        $result=mysql_query("SELECT * FROM vaccine_detail WHERE id_vac= '$val' ORDER BY syringe_no asc");
        while($row = mysql_fetch_array($result)){
            echo "<option value=\"$row[syringe_no]\" >$row[detail]</option> \n" ;
        }
    }
    echo "</select>\n";

?>