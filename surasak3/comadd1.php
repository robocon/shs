<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

</head>

<?php
 session_start();
include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$sql1=mysql_query("select * from com_support where head='$head' and user='$sOfficer'");
$num=mysql_num_rows($sql1);
if($num < 1){
     $sql = "INSERT INTO com_support(depart,head,detail,datetime,user,date,phone,user1,jobtype)
                  VALUES('$depart','$head','$detail','$datetime','$sOfficer','$thidate','$phone','$user','$jobtype');";
      $result = mysql_query($sql);
      if (mysql_errno() == 0){
           print "<br><br><br>";
          // print "บันทึกเรียบร้อย<br>";      
           print "บันทึกข้อมูลเรียบร้อย";
		   ?>
		 <script>
         window.opener.location.reload();
        window.open('','_self');
        setTimeout("self.close()",2000);
        </script>
           <?
			}else { 
           print "<br><br><br>รหัส  :$idname  ซ้ำของเดิม โปรดแก้ไข<br>";	   
		   ?>
            <script>
			window.opener.location.reload();
			window.open('','_self');
			setTimeout("self.close()",2000);
			</script>
		<?
        }
		}else{
		?>
		 <script>
         window.opener.location.reload();
        window.open('','_self');
        setTimeout("self.close()",2000);
        </script>        
        <?
		}
        include("unconnect.inc");
        ?>


