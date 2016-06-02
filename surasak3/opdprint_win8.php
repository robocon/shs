<?php
session_start();
include("connect.inc");
$cHn = $_GET['cHn'];

if( !isset($_POST['page']) ){

    $query = "SELECT no_card,name,surname FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query) or die("Query failed");
    $row = mysql_fetch_array($result);
    ?>
    <script type="text/javascript">
    function chkfrm(){
        if(document.getElementById('page').value==""){
            alert("กรุณาใส่เลขหน้าสุดท้ายด้วยค่ะ");
            return false;
        }else{
            return true;
        }
    }
    </script>
    <form action="opdprint2.php?cHn=<?=$cHn;?>" method="post" name="form2" onSubmit="return chkfrm();">
        <?=$cHn ?>&nbsp;&nbsp;<?=$row['name']?>&nbsp;&nbsp;  <?=$row['surname']?><br>
        กรุณาใส่เลขหน้าสุดท้าย <input type="text" name="page" value="<?=$row['no_card']?>" id="page" size="10">
        <input type="submit" value="ตกลง">
    </form>
	
    <?php
} else {
	
	$Thaidate=date("d-m-").(date("Y")+543);
	$page = $_POST['page']+1;

    $query = "SELECT * FROM `opcard` WHERE `hn` = '$cHn'";
    $result = mysql_query($query) or die("Query failed");
 
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$num_user = mysql_num_rows($result);
	if( $num_user > 0 ){
		$vHN = $row->hn;
		$ptname = $row->yot.' '.$row->name.'  '.$row->surname;
		$idcard = $row->idcard;
		$ptright = $row->ptright;
		$dbirth = $row->dbirth;

		$update = "UPDATE opcard SET no_card='$page' WHERE hn='$vHN'  ";
		mysql_query($update);
		?>
		<html>
			<head>
				<style type="text/css">
					body, table, tr, td{
						margin: 0;
						padding: 0;
					}
					.clear{
						clear: both;
						content: "";
						display: table;
					}
				</style>
				<script type="text/javascript">
					// window.print();
					// function CloseWindowsInTime(t){
					// t = t*1000;
					// setTimeout("window.close()",t);
					// }
					// CloseWindowsInTime(2); 
				</script>
			</head>
			<body>
				<?php
				// var_dump($page);
				?>
				<table style="width: 100%;">
					<tr>
						<td height="51px" valign="bottom">
							<div style="text-align:right; padding-right: 8%;"><?=$page;?></div>
						</td>
					</tr>
					<tr>
						<td height="41px" valign="bottom">
							<div class="" style="">
								<div style="display: inline; padding-left: 20%;">HN: <?=$vHN;?></div>
								<div style="display: inline; padding-left: 140px;"><?=$ptname;?></div>
							</div>
						</td>
					</tr>
					<tr>
						<td height="30px" valign="bottom">
							<div style="padding-left: 20%;">
								ว/ด/ป เกิด: <?=$dbirth;?>,ID: <?=$idcard;?>, สิทธิ: <?=$ptright;?>
							</div>
						</td>
					</tr>
				</table>
			</body>
		</html>
		<?php
	} else {
		echo "ไม่พบ HN : $cHn ";
	}
}