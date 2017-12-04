<body Onload="document.getElementById('page').focus();">
<?php
include("connect.inc");
if($_POST['page']!=""){
    ?>

    <Script Language="JavaScript">
        // window.print();
        function CloseWindowsInTime(t){
            t = t*1000;
            // setTimeout("window.close()",t);
        }
        CloseWindowsInTime(2/*ใส่เวลาเป็นวินาทีนะครับตรงเลข 5 */); 
    </Script>
	
    <?php
    session_start();
    $Thaidate=date("d-m-").(date("Y")+543);
    $page = $_POST['page']+1;
    Function calcage($birth){
        $today = getdate();   
        $nY  = $today['year']; 
        $nM = $today['mon'] ;
        $bY=substr($birth,0,4)-543;
        $bM=substr($birth,5,2);
        $ageY=$nY-$bY;
        $ageM=$nM-$bM;
        if ($ageM<0) {
            $ageY=$ageY-1;
            $ageM=12+$ageM;
        }
        if ($ageM==0){
            $pAge="$ageY ปี";
        }else{
            $pAge="$ageY ปี $ageM เดือน";
        }
        return $pAge;
    }
    //


    $query = "SELECT * FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
    or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}

		if(!($row = mysql_fetch_object($result)))
			continue;
    }
    If ($result){
		$regisdate= $row->regisdate;
		$idcard = $row->idcard;
		$vHN = $row->hn;
		$yot= $row->yot;
		$name= $row->name;
		$surname = $row->surname;
		$ptname = $yot.' '.$name.'  '.$surname;
		$goup = $row->goup;
		$married = $row->married;
		//	$cbirth (วันเกิดข้อความเก็บไว้ดู)
		$cbirth = $row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
		$dbirth = $row->dbirth;
		$guardian = $row->guardian;
		$idguard = $row->idguard;
		$nation = $row->nation;
		$religion = $row->religion;
		$career = $row->career;
		$ptright = $row->ptright;
		$address = $row->address;
		$tambol = $row->tambol;
		$ampur = $row->ampur;
		$changwat = $row->changwat;
		$phone = $row->phone;
		$father = $row->father;
		$mother = $row->mother;
		$couple = $row->couple;
		$note = $row->note;
		$sex = $row->sex;
		$camp = $row->camp;
		$race = $row->race;
		//  2494-05-28
		$d = substr($dbirth,8,2);
		$m = substr($dbirth,5,2); 
		$y = substr($dbirth,0,4); 
		$birthdate = "$d-$m-$y"; //print into opdcard
		$cAge = calcage($dbirth);
		$cPtname = $yot.' '.$name.'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$surname;

		$update = "update opcard set no_card='$page' where hn='$vHN'  ";
		// mysql_query($update);
    } else {
    	echo "ไม่พบ HN : $cHn ";
    }
	
    include("unconnect.inc");
	?>
	
    <HTML>
    <script>
		ie4up=nav4up=false;
		var agt = navigator.userAgent.toLowerCase();
		var major = parseInt(navigator.appVersion);
		if ((agt.indexOf('msie') != -1) && (major >= 4))
			ie4up = true;
		if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))
			nav4up = true;
    </script>
    <head>
    <STYLE>
		*{
			font-family: "Cordia New";
			font-size: 24px;
		}
    A {text-decoration:none}
    A IMG {border-style:none; border-width:0;}
    /*DIV {position:absolute; z-index:25;}*/
    .fc1-0 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
    .fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}
    .fc1-2 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}
    .fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}
    .ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
    .ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}
    </STYLE>
    <TITLE>Crystal Report Viewer</TITLE>
    </head>
	<!--
    <BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>
    <DIV style='z-index:0'> &nbsp; </div>
    <DIV style='left:150PX;top:50PX;width:200PX;height:30PX;'><span class='fc1-0'><?=$vHN;?></span></DIV>
    <DIV style='left:370PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'><?=$ptname;?></span></DIV>
    <DIV style='left:660PX;top:5PX;width:700PX;height:30PX;'><span class='fc1-0'><?=$page;?></span></DIV>
    <DIV style='left:150PX;top:80PX;width:700PX;height:30PX;'><span class='fc1-1'>ว/ด/ป เกิด&nbsp;<?=$dbirth;?>&nbsp;&nbsp;ID:<?=$idcard;?>&nbsp;&nbsp;<?=$ptright;?></span></DIV>
    -->
	
	<div style="width: 812px; margin-top: 22px;">
		<table width="100%">
			<tr>
				<td colspan="2">
					<div style="text-align: right; margin-right: 75px; font-weight: bold;"><?=$page;?></div>
				</td>
			</tr>
			<tr>
				<td width="50%">
					<div style="margin-left: 188px; font-weight: bold;"><?=$vHN;?></div>
				</td>
				<td>
					<div style="font-weight: bold;"><?=$ptname;?></div>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<div style="margin-left: 188px;">ว/ด/ป เกิด&nbsp;<?=$dbirth;?>&nbsp;&nbsp;ID:<?=$idcard;?>&nbsp;&nbsp;<?=$ptright;?></div>
				</td>
			</tr>
		</table>
	</div>
	
	</HTML>
	<?php
}else{
    
    $query = "SELECT no_card,name,surname FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query) or die("Query failed");
    $row = mysql_fetch_array($result);
    ?>
    <script>
    function chkfrm(){
        if(document.getElementById('page').value==""){
            alert("กรุณาใส่เลขหน้าสุดท้ายด้วยค่ะ");
            return false;
        }else{
            return true;
        }
    }
    </script>
    <form action="<? $_SERVER['PHP_SELF']?>" method="post" name="form2" onSubmit="return chkfrm();">
        <? echo $cHn ?>&nbsp;&nbsp;<?=$row['name']?>&nbsp;&nbsp;  <?=$row['surname']?>
        <br>
        กรุณาใส่เลขหน้าสุดท้าย <input type="text" name="page" value="<?=$row['no_card']?>" id="page" size="10">
        <input type="submit" value="   ตกลง   " name="send">
    </form>
    <?
}
?>
</BODY>