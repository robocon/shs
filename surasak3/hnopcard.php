<?php
   session_start();
    session_unregister("cHn");  
    session_unregister("cPtname");
?>
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ดูบัตรตรวจโรค (opdcard)</p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="hn" size="12"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>
  <a target=_self  href='../nindex.htm'><<ไปเมนู</a>
<table>
 <tr>
  <th bgcolor=CD853F>HN</th>
  <th bgcolor=CD853F>ยศ</th>
  <th bgcolor=CD853F>ชื่อ</th>
  <th bgcolor=CD853F>สกุล</th>
 </tr>

<?php
If (!empty($hn)){
    include("connect.inc");
    global $hn;
    $query = "SELECT hn,yot,name,surname FROM opcard WHERE hn = '$hn'";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><a target=_BLANK  href=\"seopcard.php? cHn=$hn&cYot=$yot & cName=$name &cSurname=$surname\">$hn</a></td>\n".
           "  <td BGCOLOR=F5DEB3>$yot</td>\n".
           "  <td BGCOLOR=F5DEB3>$name</td>\n".
           "  <td BGCOLOR=F5DEB3>$surname</td>\n".
           " </tr>\n");

        //-------> start แจ้งเตือนข้อมูลเชื้อดื้อยา
            //--------------------------------//
            $sql_bacteria = "SELECT * FROM bacteria_resistant  WHERE `hn` = '".$hn."' AND Alert_Flag = 'Y' ORDER BY Id DESC ";
                    $rows_bacteria = mysql_query($sql_bacteria);
                    $num_bacteria = mysql_num_rows($rows_bacteria);
                    if(!empty($num_bacteria)){
            ?>
            <table border="0" >
            <?  
                while($rows = mysql_fetch_array($rows_bacteria)){
                        echo "<td style='background-color: red;'>";
                        echo "<img src='beacteria_img/alert.png' width='20' height='20'> เชื้อที่พบ : <font color=white>".$rows['Bacteria_Name']." <br></font>";    
                        echo "แหล่งกำเนิด : <font color=white>".$rows['Bacteria_Source']." </font> 
                                    ชื่อยา : <font color=white>".$rows['Drug_Name']."<br></font>";

                        //---> convert date 2024-05-01 to 01-05-2567
                        $tmp_y = substr($rows['Date_Send'],0,4)+543;
                        $tmp_m = substr($rows['Date_Send'],5,2);
                        $tmp_d = substr($rows['Date_Send'],8,2);
                        $Date_Send_Th = $tmp_d."-".$tmp_m."-".$tmp_y;
                        echo "วันที่ส่งตรวจ : <font color=white>".$Date_Send_Th." <br></font>";
                        echo "Ward : <font color=white>".$rows['Ward']." <br></font>";

                        if($rows['Alert_Status'] != ""){
                            echo "หมายเหตุ : <font color=white>".$rows['Alert_Status']." <br></font>";
                        }//end if Alert_Status

                        echo "</td> ";

                        echo "<td'> </td>";
                }//end while
                    echo "</tr></table>";
            }//!empty($num_bacteria)
            //-------> end แจ้งเตือนข้อมูลเชื้อดื้อยา
                //--------------------------------//
            
       }
include("unconnect.inc");
       }
?>
</table>
