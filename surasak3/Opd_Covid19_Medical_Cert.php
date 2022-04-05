<?
session_start();
include("connect.inc");

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<title>ใบรับรองแพทย์ Covid-19</title>

<p align="center" style="margin-top: 20px;"><strong>ใบรับรองแพทย์ Covid-19</strong></p>

 

<? 
if(empty($_POST['hn'])){

  echo '
  <div align="center">
  <form method="POST" action="Opd_Covid19_Medical_Cert.php" >
  </p>
      <strong>HN : </strong> <input type="text" name="hn" id="hn">
  &nbsp;&nbsp;&nbsp;
  
         <input type="submit" value="ค้นหา" name="B1"  class="txt" />
  </form> 
  </div>
  ';

}else{
  
  echo "this";

}//end if
?>
 
 