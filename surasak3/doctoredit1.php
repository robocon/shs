<?php 
session_start();
include("connect.inc");

print "<a target=_self  href='../nindex.htm' class='forntsarabun'><------ �����</a>&nbsp;&nbsp;";
print"<a target=_self  href='new_doctor.php' class='forntsarabun'>����ᾷ������</a><br>";

$Thaidate=date("d-m-").(date("Y")+543);

$query = "SELECT  row_id,name,doctorcode,menucode FROM doctor WHERE status ='Y' ORDER BY row_id  ";
$result = mysql_query($query) or die("Query failed111");
?>
<style type="text/css">
.forntsarabun {
	font-family: "TH Sarabun New","TH SarabunPSK";
	font-size: 22px;
}
</style>
<?php 

if( !empty($_SESSION['x-msg']) ){
    ?>
    <div style="padding: 10px;border: 1px solid #000000;background-color: #fffdbc;margin: 10px;"><?=$_SESSION['x-msg'];?></div>
    <?php
    unset($_SESSION['x-msg']);
}

if(mysql_num_rows($result)){
    print "<div class='forntsarabun'>ᾷ��Ѩ�غѹ</div>";
    ?>
    <table class="forntsarabun" bordercolor="#000000">
        <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
            <th>����</th>
            <th>���� �.</th>
            <th>Ἱ�</th>
            <th>���</th>
        </tr>
        <?php
        while (list ($row,$name,$doctorcode,$menucode) = mysql_fetch_row ($result)) {
            ?>
            <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
                <td><?=$menucode;?></td>
                <td><a href="doctordele.php?row=<?=$row;?>">�Դ�����ҹ</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}


print "<br><br><div class='forntsarabun'>ᾷ�����</div><br>";
$Thaidate=date("d-m-").(date("Y")+543);

$query = "SELECT  row_id,name,doctorcode,menucode FROM doctor   WHERE status ='N' ORDER BY row_id  ";
$result = mysql_query($query) or die("Query failed111");

if(mysql_num_rows($result)){
    //  print"�������";
    ?>
    <table class="forntsarabun" bordercolor="#000000">
        <tr bgcolor=#33CC66 onMouseOver="this.style.backgroundColor='#0066FF'" onMouseOut="this.style.backgroundColor=''">
            <th>����</th>
            <th>���� �.</th>
            <th>Ἱ�</th>
            <th>���</th>
        </tr>
        <?php
        while (list ($row,$name,$doctorcode,$menucode) = mysql_fetch_row ($result)) {
            ?>
            <tr bgcolor="#FFFFCC" onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
                <td><?=$name;?></td>
                <td><?=$doctorcode;?></td>
                <td>	<?=$menucode;?></td>
                <td><a  href="doctordele1.php?row=<?=$row;?>">�ӡ�Ѻ��������</a></td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
}
 include("unconnect.inc");  
?>
