<?php
include 'bootstrap.php';

$action = ( isset($_POST['action']) ) ? trim($_POST['action']) : false ;
if( $action === 'convert' ){
	
	$file = $_FILES['file_name'];

	if(strrchr($file['name'], ".") != '.csv'){
		$_SESSION['x-msg'] = '͹حҵ੾����� .csv ��ҹ��';
		$_SESSION['type'] = 'warning';
		header('Location: convert_to_opttxt.php');
		exit;
	}
	
	$fop = fopen($file['tmp_name'], 'r');
	
	$i = 0;
	$item_lists = array(); // �������纤�������������������� Main array
	$key_lists = array(); // �������纤���ҡ row ����á
	$new_items = array(); // �红����ŷ������ҡ item_lists
	while (! feof($fop) ) {
		
		$items = fgetcsv($fop);
		
		// ����á��������ҧ�繤���
		if( $i === 0 ){
			$key_lists = $items;
			
		}else{
			$ii = 0;
			foreach( $items as $key => $item ){
				
				// �Ѻ��� Key - Value
				$key_name = strtolower($key_lists[$ii]);
				
				// ��չ�����ŷ��ҧ����� String null ����繤����ҧ
				$item_lists[$key_name] = ( !empty($item) && $item !== 'null' ) ? trim($item) : '' ;
				$ii++;
			}
		}
		
		if( !empty($item_lists) ){
			$new_items[] = $item_lists;
		}
		
		$i++;
		
	}
	
	fclose($fop);
	
	$opt_text = '';
	foreach( $new_items as $key => $item ){
		$opt_text .= $item['hn'].','.$item['pid'].','.$item['name'].','.$item['flag']."\n";
	}
	$size = strlen($opt_text);
	header('Content-Description: File Transfer');
	header('Content-Type: application/octet-stream');
	header('Content-Disposition: attachment; filename=optdata.txt');
	header('Connection: Keep-Alive');
	header('Content-Length: '.$size);
	echo $opt_text;
	exit;
}

include 'templates/classic/header.php';
?>
<style type="text/css">
	ol li{ list-style-type: decimal; }
</style>
<div class="site-body">
	<div class="site-center">
		<div class="cell">
			
			<h3>������ŧ����͹�Ѿഷ ͻ�. </h3>
			<?php
			if( isset($_SESSION['x-msg']) ){
				?>
				<div style="color: red; margin: 1em;"><?php echo $_SESSION['x-msg']; ?></div>
				<?php
				unset($_SESSION['x-msg']);
			}
			?>
			<div>
				<form method="post" action="convert_to_opttxt.php" enctype="multipart/form-data">
					<div class="col">
						<div class="col width-1of4">���͡��� (�ͧ�Ѻ��� .csv ��ҹ��)</div>
						<div class="col width-fill">
							<div class="cell">
								<input type="file" name="file_name">
							</div>
						</div>
					</div>
					<div class="col">
						<div class="col width-1of4"></div>
						<div class="col width-fill">
							<div class="cell">
								<button type="submit">�ӡ���ŧ���</button>
								<input type="hidden" name="action" value="convert"
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class="col">
				<div class="cell">
					<h3>�Ըա�����ҧ��� .csv</h3>
					<ol>
						<li>�Դ��� .xls ���� Microsoft Excel</li>
						<li>���͡���� ��� > �ѹ�֡��</li>
						<li>㹪�ͧ �ѹ�֡�繪�Դ������͡ CSV (Comma delimited) (*.csv)</li>
						<li>��ѧ�ҡ���ѹ�֡����ա��ͧ��ͤ����駢����������͡ ��</li>
					</ol>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';