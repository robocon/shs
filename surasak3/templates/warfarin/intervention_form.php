<div class="col">
	<div class="cell">
		<div>
			<h3>������ѹ�֡������ Intervention</h3>
		</div>
		<div>
			<form action="phar_warfarin.php" method="post" id="interventionForm">
				<div class="col">
					<div class="cell">
						<label for="">�ѹ��� 
							<input type="text" id="inter_date" name="inter_date" value="<?=$date_val;?>">
						</label>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<label for="inter_detail inline">��������´</label>
						<div>
							<textarea name="inter_detail" id="inter_detail" cols="60" rows="5"></textarea>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">�ѹ�֡������</button>
						<input type="hidden" name="action" value="save_intervention">
						<input type="hidden" name="page" value="inr">
						<input type="hidden" name="id" value="<?=$id;?>">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
$(function(){
	$(document).on('submit', '#interventionForm', function(){
		
		var detail = $('#inter_detail').val();
		if(detail === ''){
			alert("��سҡ�͡��������´");
			return false;
		}
		
	});
});
</script>