<?
session_start();
include("connect.inc");
?>
<style>
	.font3{
		font-family:AngsanaUPC;
		font-size:14px;
		}
</style>
<?
if(isset($_GET['id'])){
	/*echo $_SESSION['age_now'];
	echo $_SESSION['hn_now'];
	echo $_SESSION['vn_now'];
	echo $_SESSION["yot_now"];?> <?php echo $_SESSION["name_now"];?> <?php echo $_SESSION["surname_now"];
	echo $_SESSION["ptright_now"];*/
				//echo "<br><br><br><br><center>สั่งตรวจ BMD เรียบร้อยแล้วคะ</center>";
	$sql = "select * from orderbmd where row_id = '".$_GET['id']."' ";
	$row = mysql_query($sql);
	$result = mysql_fetch_array($row);
				
	echo "<span class='font3'>วันที่ทำ:".date("d-m-").(date("Y")+543)." ".date("H:i:s")."&nbsp;&nbsp;";
	echo "วันที่สั่ง:".substr($result["date"],8,2)."-".substr($result["date"],5,2)."-".substr($result["date"],0,4)." ".substr($result["date"],11)."<br>";
	echo "HN:".$result['hn']."&nbsp;&nbsp;";
	echo "ชื่อ:".$result['ptname']."&nbsp;&nbsp;";
	echo "อายุ:".$result['age']."<br>";
	echo "เหตุผลการส่งตรวจ :<br>";
	$str_arr=array();
	for($i=1;$i<=8;$i++){
		if($result['sub'.$i]!=""){
			$s=0;
			$l=50;
			echo "-".$result['sub'.$i]."<br>";
			if($result['detail_sub'.$i]!=""){
				echo "&nbsp;๐".$result['detail_sub'.$i];
				if($result['detail_sub'.$i.'1']!=""){
					echo "&nbsp;<u>".$result['detail_sub'.$i.'1']."<u>";
				}
				echo "<br>";
			}
			//$str_arr = str_split($result['sub'.$i],50);
			for($m=1;$m<=round(strlen($result['sub'.$i])/50);$m++){
				array_push($str_arr,substr($result['sub'.$i],$s,$l));
				$s+=50;
				$l+=50;
			//	$str_all1 .= $str_arr[$m]."<br/>";
			//	echo $str_arr[$m];
			}
			//echo $str_arr;
		}			
	}
	echo "</span>";
	?>
	<script>
		window.print();
    </script>
<?
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=dt_index.php\">";
}
?>