<?php 
include 'bootstrap.php';
DB::load();

/**
 * �Ѵ��â�����
 */
// ��á�зӵ�ҧ� �� �ѹ�֡, ���, ź
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false;

// ˹�ҵ�ҧ����ʴ��ŵ�ҧ� �� ˹����¡��, ˹�ҿ����
$page = isset($_REQUEST['page']) ? trim($_REQUEST['page']) : false;

// �ش����ʴ����˹�ҹ���
$view = isset($_REQUEST['view']) ? trim($_REQUEST['view']) : false;
if( $action === 'save' ){
	
}


/**
 * �ʴ����ǹ�ͧ view
 */
include 'templates/classic/header.php';

?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
			<?php
			// ����
			include 'templates/ward/nav.php';
			if( $page === false ){ // Home && Default page
				?>
				<h3>��¡��</h3>
				<?php
			}elseif( $page === 'form' ){
				include 'templates/ward/form.php';
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';