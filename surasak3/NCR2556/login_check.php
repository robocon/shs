<?
session_start();

include("connect.inc");

	$strSQL = "SELECT * FROM member WHERE  username = '".trim($_POST['txtUsername'])."' 
	and password = '".trim($_POST['txtPassword'])."'";
	$objQuery = mysql_query($strSQL);
	$objResult = mysql_fetch_array($objQuery);
	
	
		$desql="SELECT * FROM `departments`  WHERE code='$objResult[until]' ";
		$dequery = mysql_query($desql);
		$dearr = mysql_fetch_array($dequery);
		
	if(!$objResult)
	{
			echo "Username and Password Incorrect!";
			//header("location:ncf2.php");
			echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=ncf2.php'>";
	}
	else
	{
			$_SESSION["Namencr"] = $objResult["name"];
			$_SESSION["Userncr"] = $objResult["username"];
			$_SESSION["statusncr"] = $objResult["status"];
			$_SESSION["Codencr"] = $objResult["until"];
			$_SESSION["Untilncr"] = $dearr["name"];
			session_write_close();
			
/*			if($objResult["status"] == "admin")
			{*/
			//	header("location:ncr_admin.php");
				echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=ncr_admin.php'>";
			//}

	}
   ?>