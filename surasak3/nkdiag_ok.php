<?
include("connect.inc");
if(isset($_POST['okbtn'])&&$_POST['icd10']!=""){
	$sql = "update icd10 SET diag_eng = '".$_POST['eng']."' ,diag_thai= '".$_POST['thai']."' where code = '".$_POST['icd10']."' ";
	$result = mysql_query($sql);
	if($result){
		echo "บันทึกเรียบร้อยแล้วคะ";
		echo "<meta http-equiv='refresh' content='2 url=nkdiag.php' />";
	}
		
}
?>