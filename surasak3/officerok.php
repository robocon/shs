<?php
    include("connect.inc");
/*
CREATE TABLE officers (
  row_id int(11) NOT NULL auto_increment,
  mancode varchar(16) default NULL,
  position varchar(40) default NULL,
  position2 varchar(40) default NULL,
  yot varchar(40) default NULL,
  fullname varchar(40) default NULL,
  PRIMARY KEY  (row_id),
  KEY mancode (mancode)
) TYPE=MyISAM;
*/
	$aMancode[1]='director';
	$aMancode[2]='pharmacy';
	$aMancode[3]='logis';
	$aMancode[4]='logis2';
	$aMancode[5]='budget';
	$aMancode[6]='reciever';
	$aMancode[7]='reciever2';
	$aMancode[8]='reciever3';
	$aMancode[9]='witness';
	$aMancode[10]='witness2';
	$aMancode[11]='headmony';
	$aMancode[12]='headmonysub';
	$aMancode[13]='headmony2';

//1
	$query ="UPDATE officers SET 
				position='$post1',position2='$post21',	
				yot='$yot1',fullname='$fname1'
             WHERE  mancode='$aMancode[1]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//2
	$query ="UPDATE officers SET 
				position='$post2',position2='$post22',	
				yot='$yot2',fullname='$fname2'
             WHERE  mancode='$aMancode[2]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//3
	$query ="UPDATE officers SET 
				position='$post3',position2='$post23',	
				yot='$yot3',fullname='$fname3'
             WHERE  mancode='$aMancode[3]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//4
	$query ="UPDATE officers SET 
				position='$post4',position2='$post24',	
				yot='$yot4',fullname='$fname4'
             WHERE  mancode='$aMancode[4]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//5
	$query ="UPDATE officers SET 
				position='$post5',position2='$post25',	
				yot='$yot5',fullname='$fname5'
             WHERE  mancode='$aMancode[5]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//6
	$query ="UPDATE officers SET 
				position='$post6',position2='$post26',	
				yot='$yot6',fullname='$fname6'
             WHERE  mancode='$aMancode[6]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//7
	$query ="UPDATE officers SET 
				position='$post7',position2='$post27',	
				yot='$yot7',fullname='$fname7'
             WHERE  mancode='$aMancode[7]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//8
	$query ="UPDATE officers SET 
				position='$post8',position2='$post28',	
				yot='$yot8',fullname='$fname8'
             WHERE  mancode='$aMancode[8]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//9
	$query ="UPDATE officers SET 
				position='$post9',position2='$post29',	
				yot='$yot9',fullname='$fname9'
             WHERE  mancode='$aMancode[9]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//10
	$query ="UPDATE officers SET 
				position='$post10',position2='$post210',	
				yot='$yot10',fullname='$fname10'
             WHERE  mancode='$aMancode[10]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//11
		 	$query ="UPDATE officers SET 
				position='$post11',position2='$post211',	
				yot='$yot11',fullname='$fname11'
             WHERE  mancode='$aMancode[11]'";
	$result = mysql_query($query)
         or die("Query failed,update officers");
//13		 
$query ="UPDATE officers SET 
				position='$post13',position2='$post213',	
				yot='$yot13',fullname='$fname13'
             WHERE  mancode='$aMancode[13]'";
	$result = mysql_query($query)or die("Query failed,update officers");


	//echo mysql_errno() . ": " . mysql_error(). "\n";
	//echo "<br>";

	print "...............บันทึกข้อมูลเรียบร้อย<br>";
?>
