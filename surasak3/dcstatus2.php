<?php
session_start();
include("connect.inc");
?>
<html>
    <head>
        <title>add_user</title>
        <meta http-equiv="Content-Type" content="text/html; charset=windows-874">
        <link href="css/backoffice.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
    <?php
    $Thaidate = date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $appd = $_POST["appdate"].' '.$_POST["appmo"].' '.$_POST["thiyr"];
    
    if($_POST['status']=="������ͷ��ǹ"){
        $txt2 = $_POST["status2"];
    }else{
        $txt2 = "";
    }
    
    $statusall = $_POST["status"].' '.$_POST["status1"];
    $count = count($_POST["list_an"]);
    
    if( $count > 0 ){
        for($i=0; $i<$count; $i++){
        
            $sql = "INSERT INTO dcstatus(date,an,status,office,status2)VALUES('".$Thidate."','".$_POST["list_an"][$i]."','".$statusall."','".$_SESSION["sOfficer"]."','".$txt2."');";
            $result = Mysql_Query($sql);
            if($result){
                /************************ �͡ 㺹Ѵ ***************************/
                print "<font face='Angsana New' size='3'><center><b>�ѹ�֡�������ʴ�ʶҹл���ѵԼ������";
                print "<b><font face='Angsana New' size='3'>�ѹ���: ".$Thidate."  </b>&nbsp;&nbsp;&nbsp;<b>AN:</b> ".$_POST["list_an"][$i]." ";
                print "<b><font face='Angsana New' size='3'><U>ʶҹ�:</b> ".$statusall."</U></FONT><br>";
                echo "<meta http-equiv=\"refresh\" content=\"3;URL=dcstatus.php\">";
            }
        }
    }
    
    // include("unconnect.inc");
    list($thiyr, $mo) = explode('-', $_POST['back']);
    ?>
    <p><a href="rechkipd1.php?thiyr=<?php echo $thiyr;?>&mo=<?php echo $mo;?>">��Ѻ�˹�� OPD-rechkOPD</a></p>
    </body>
</html>