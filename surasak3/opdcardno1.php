<?php
session_start();
include 'connect.inc';

$action = ( isset($_POST['action']) ) ? $_POST['action'] : false ;
if( $action === false ){

	$d = $_POST['d'];
	$m = $_POST['m'];
	$yr = $_POST['yr'];

	$today="$d-$m-$yr";
	print "�ѹ��� $today  ��ª��ͤ����ҧ�׹�ѵ����§����ӴѺ���ҡ�͹��ѧ";
	print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
	$today="$yr-$m-$d";

	?>
	<style type="text/css">
	*{
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	</style>
	<form action="opdcardno1.php" method="post" id="mainForm">
		<table>
			<tr>
				<th bgcolor=6495ED>
					<input type="checkbox" onclick="checkAll(this)" title="���͡������">
				</th>
				<th bgcolor=6495ED>#</th>
				<th bgcolor=6495ED>�ѹ - ����</th>
				<th bgcolor=6495ED>HN</th>
				<th bgcolor=6495ED>����</th>
				<th bgcolor=6495ED>AN</th>
				<th bgcolor=6495ED>�ä</th>
				<th bgcolor=6495ED>ᾷ��</th>
				<th bgcolor=6495ED>�׹OPD</th>
				<th bgcolor=6495ED>�͡��</th>
				<th bgcolor=6495ED>���</th>
			</tr>
			<?php
			$detail="�����";
			$query = "SELECT row_id,vn,thdatehn, date_format(thidate, '%d/%m/%Y %H:%i:%s'),hn,ptname,an,diag,doctor,okopd,toborow,borow 
			FROM opday 
			WHERE okopd='N'
			AND thidate LIKE '$today%' ";
			$result = mysql_query($query)or die("Query failed");
			$opd = 0;
			while (list ($row_id,$vn,$thdatehn,$thidate,$hn,$ptname,$an,$diag,$doctor,$okopd,$toborow,$borow) = mysql_fetch_row ($result)) {
				$num++;
				if(substr($toborow,0,4) == "EX15"){
					$bg="FFCC99";
				}else if(substr($toborow,0,4) == "EX12"){
					$bg="FFCC99";
				}else if(substr($toborow,0,4) == "EX19"){
					$bg="FFCC99";
				}else if(substr($toborow,0,5) == "EX 91"){
					$bg="FFCC99";
				}else if($toborow == "�͡ VN �� LAB"){
					$bg="FFCC99";
				}else{
					$bg="66CDAA";
					$opd++;
				}

				?>
				<tr bgcolor="<?=$bg;?>">
					<td>
						<input type="checkbox" name="row_id[]" value="<?=$row_id;?>" onclick="checkOne(this)">
					</td>
					<td><?=$num;?></td>
					<td><?=$thidate;?></td>
					<td><?=$hn;?></td>
					<td>
						<?php
						$aLink = "chkopd.php?cTdatehn=$thdatehn&cPtname=$ptname&cHn=$hn&cDoctor=$doctor&cDiag=$diag&cOkopd=$okopd&cVn=$vn";
						?>
						<a href="<?=$aLink;?>" target="_BLANK"><?=$ptname;?></a>
					</td>
					<td><?=$an;?></td>
					<td><?=$diag;?></td>
					<td><?=$doctor;?></td>
					<td><?=$okopd;?></td>
					<td><?=$toborow;?></td>
					<td><?=$borow;?></td>
				</tr>
				<?php
			}
			include("unconnect.inc");
			?>
			<tr>
				<td colspan="10" align="right">
					�ӹǹ OPDCard �٭��� : <?php echo $opd;?>
				</td>
			</tr>
		</table>
		<button type="button" style="padding: 4px 6px;" onclick="check_rows()">��ŧ��������¹ʶҹ��� Y</button>
		<input type="hidden" name="action" value="change_status">
		<input type="hidden" name="d" value="<?=$d;?>">
		<input type="hidden" name="m" value="<?=$m;?>">
		<input type="hidden" name="yr" value="<?=$yr;?>">
		
	</form>
	<script type="text/javascript">
		var num_checked = 0;
		function checkAll(source){
			var boxs = document.getElementsByName('row_id[]');
			var rows = boxs.length;
			var i = 0;
			for( i; i < rows; i++ ){

				if( boxs[i].checked !== source.checked ){
					boxs[i].checked = source.checked;
					if( boxs[i].checked === true ){
						num_checked++;
					}else{
						num_checked--;
					}
				}

			}
		}

		function checkOne(source){
			if( source.checked === true ){
				num_checked++;
			}else{
				num_checked--;
			}
		}

		function check_rows(){
			if( num_checked === 0 ){
				alert('���͡ HN ����ͧ��á�͹����¹ʶҹ�');
			}else{
				var form = document.getElementById('mainForm');
				form.submit();
			}
		}
	</script>
	<?php
}elseif( $action === 'change_status' ){

	$d = $_POST['d'];
	$m = $_POST['m'];
	$yr = $_POST['yr'];
	$row_ids = $_POST['row_id'];

	foreach( $row_ids as $key => $val ){
		$query ="UPDATE `opday` 
		SET `okopd` = 'Y' 
		WHERE `row_id` = '$val' ";
		mysql_query($query) or die( mysql_error() );
	}
		
	// ����ѹ��͹��Ѻ�˹���ʴ���¡�����
	?>
	<p>��Ѻʶҹ��� Y ���º����</p>
	<form action="opdcardno1.php" method="post" id="hideForm">
		<input type="hidden" name="d" value="<?=$d;?>">
		<input type="hidden" name="m" value="<?=$m;?>">
		<input type="hidden" name="yr" value="<?=$yr;?>">
	</form>
	<script type="text/javascript">
	window.onload = function(){
		window.setTimeout(function(){
			var form = document.getElementById('hideForm');
			form.submit();
		}, 1500);
	}
	</script>
	<?php
	exit;
}