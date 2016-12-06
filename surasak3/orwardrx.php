<?php
    session_start();
	include("connect.inc");
    if (isset($sIdname)){} else {die;} //for security
?>
<form method="POST" action="<? $_SERVER['PHP_SELF']?>"  target="_blank">
  <p><font face="Angsana New"><b>เบิกเวชภัณฑ์ ผู้ป่วยใน&nbsp;&nbsp;</b></font></p>
  <p>&nbsp;&nbsp;&nbsp;AN&nbsp;&nbsp;&nbsp;<input type="text" name="cAn" size="8"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   ตกลง   " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></p>
</form>
<?
	if(isset($_POST['B1'])){

		$sql = "Select * From ipcard where an = '".$_POST['cAn']."' and status_log!='จำหน่าย'  limit 1";
		$result = Mysql_Query($sql);
		if(mysql_num_rows($result) > 0){
			
			session_register("hn_ipd");
			session_register("cAn");
			session_register("idcard_ipd");
			session_register("ptname_ipd");
			session_register("age_ipd");
			session_register("ptright_ipd");
				
			session_register("list_drugcode");
			session_register("list_drugamount");
			session_register("list_drugslip");
				
			session_register("nRunno");
		
		   //runno  for chktranx
				$query = "SELECT title,prefix,runno FROM runno WHERE title = 'dphardep'";
				$result = mysql_query($query) or die("Query failed");
				for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
					if (!mysql_data_seek($result, $i)) {
						echo "Cannot seek to row $i\n";
						continue;
					}
					if(!($row = mysql_fetch_object($result)))
						continue;
					 }
				$_SESSION["nRunno"]=$row->runno;
				$_SESSION["nRunno"]++;
				$query ="UPDATE runno SET runno = '".$_SESSION["nRunno"]."' WHERE title='dphardep'";
				$result = mysql_query($query) or die("Query failed");
				//end  runno  for chktranx
		
				
				$_SESSION["hn_ipd"] = "" ;
				$_SESSION["idcard_ipd"] = "" ;
				$_SESSION["ptname_ipd"] = "" ;
				$_SESSION["age_ipd"] = "" ;
				$_SESSION["ptright_ipd"] = "" ;
		
				$_SESSION["list_drugcode"] = array() ;
				$_SESSION["list_drugamount"] = array() ;
				$_SESSION["list_drugslip"] = array() ;
				
				$sql = "Select an,hn,ptname, age, ptright  From ipcard where an = '".$_POST['cAn']."' limit 1";
				$result = Mysql_Query($sql);
				list($_SESSION["an_ipd"],$_SESSION["hn_ipd"],$_SESSION["ptname_ipd"],$_SESSION["age_ipd"],$_SESSION["ptright_ipd"]) = Mysql_fetch_row($result);
				$_SESSION["cAn"] =$_POST['cAn'];
				 //$_SESSION["age_ipd"] = calcage($_SESSION["age_ipd"]);
		
				echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0;URL=ward_rx.php\">";
			
			}else{
			
			session_unregister("hn_ipd");
			session_unregister("idcard_ipd");
			session_unregister("ptname_ipd");
			session_unregister("age_ipd");
			session_unregister("ptright_ipd");
			session_unregister("list_drugcode");
			session_unregister("list_drugamount");
			session_unregister("list_drugslip");
		
			
		}
	}
?>

