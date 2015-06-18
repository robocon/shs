<?php

$str = array();
for($i=0; $i<5; $i++ ){
	$str[] = '- test '.$i;
}
echo "<pre>";
var_dump($str);
echo "</pre>";
?>

<script>
	var test_str = 'ตัวอย่างรายการ\n';
	<?php
	for($i=0; $i<5; $i++ ){
		?>
		test_str += '<?php echo $str[$i]; ?>\n';
		<?php
	}
	?>
	alert(test_str);
</script>