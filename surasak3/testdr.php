<body>
<? 
include("connect.inc");

$doctor="¸Ñ­­ÒÇ´Õ ÁÙÅÃÑµ¹ì (¾·.» 1038)";
$posdr = strpos($doctor,"Ç.");
	$posdrd = strpos($doctor,"·.");
	$posdrdpt = strpos($doctor,"¾·.»");
	//echo  $posdrdpt."<BR>";
	//echo $posdr;
	
	if($posdr==false){  ///////// 1
		
		if($posdrd==false){
				
				if($posdrdpt==false){
			
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			//echo $seldr;
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="Ç";
			$dr1="$dc$dr";
				}else{ 
			$dr = substr($doctor,($posdrdpt+4),4);
			$dc="-";
			$dr1="$dc$dr";

			}
		}else{
			$dr = substr($doctor,($posdrd+4),4);
			$dc="·";
			$dr1="$dc$dr";
				echo $dr1;
		}

	}else{  //1  if posdr
		
		$dr = substr($doctor,($posdr+2),5);
		$dc="Ç";
		$dr1="$dc$dr";
		if(strlen($dr)<4){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="Ç";
			$dr1="$dc$dr";
			
		
		}
	}

	?>
</body>
