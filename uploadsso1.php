<html> 
<head> 
<title>surasakmontri</title> 
</head> 
<body> 
<? if(copy($_FILES["filUpload"]["tmp_name"],"myfile/".$_FILES["filUpload"]["name"])) 
{    
echo "Copy/Upload Complete"; 
} 
 ?> 
</body> 
</html>