<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>test test test</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		$(document).on('change', '#test1', function(){
			if($(this).val() == '2222'){
				$('option#opd').remove();
			}else{
				if($('#opd').length == 0){
					$('option#pre-opd').after('<option id="opd">cccc</option>');
				}
			}
		});
	});
	</script>
</head>
<body>
	test1 
	<select id="test1" name="test1">
		<option value="1111">1111</option>
		<option value="2222">2222</option>
		<option value="3333">3333</option>
		<option value="4444">4444</option>
	</select>
	<br>
	test2
	<select id="test2" name="test2">
		<option>aaaa</option>
		<option id="pre-opd">bbbb</option>
		<option id="opd">cccc</option>
		<option>dddd</option>
	</select>
</body>
</html>