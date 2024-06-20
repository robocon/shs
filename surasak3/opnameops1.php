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
<form method="post" action="<?php echo $PHP_SELF ?>">
  <p>ค้นหาคนไข้จาก&nbsp; ชื่อและนามสกุล</p>
    <p>ให้ใส่ข้อมูลทั้งชื่อและนามสกุลทั้งสองข้อมุล</p>

  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ชื่อ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="name" size="12">&nbsp;&nbsp;&nbsp;&nbsp; สกุล&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="text" name="sname" size="12"></p>
 
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
  <input type="submit" value="  ตกลง  " name="B1">&nbsp;&nbsp;&nbsp;&nbsp; <input type="reset" value="  ลบทิ้ง  " name="B2"></p>
</form>

<table>
 <tr>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ยศ</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สกุล</th>
  <th bgcolor=6495ED>ว/ด/ป เกิด</th>
  <th bgcolor=6495ED>บัตร ปชช.</th>

 </tr>

<?php
If (!empty($name)){
    include("connect.inc");
    global $name;
    $query = "SELECT hn,yot,name,surname,dbirth,idcard FROM opcard WHERE name LIKE '$name%' and surname LIKE '$sname%' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($hn,$yot,$name,$surname,$dbirth,$idcard) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"seopcard.php? cHn=$hn \">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$yot</td>\n".
           "  <td BGCOLOR=66CDAA>$name</td>\n".
           "  <td BGCOLOR=66CDAA>$surname</td>\n".
         "  <td BGCOLOR=66CDAA>$dbirth</td>\n".
         "  <td BGCOLOR=66CDAA>$idcard</td>\n".
                   " </tr>\n");


        //-------> start แจ้งเตือนข้อมูลเชื้อดื้อยา
            //--------------------------------//
            $sql_bacteria = "SELECT * FROM bacteria_resistant  WHERE `hn` = '".$hn."' AND Alert_Flag = 'Y' ORDER BY Id DESC ";
                    $rows_bacteria = mysql_query($sql_bacteria);
                    $num_bacteria = mysql_num_rows($rows_bacteria);
                    if(!empty($num_bacteria)){
                        echo "<tr><td>";
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
                    echo "</tr></td>";
            }else{

                echo "<tr><td>";
                echo "</tr></td>";
            }//!empty($num_bacteria)
            //-------> end แจ้งเตือนข้อมูลเชื้อดื้อยา
                //--------------------------------//


           }
include("unconnect.inc");
          }
?>

</table>
