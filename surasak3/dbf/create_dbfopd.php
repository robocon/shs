<?php
    include("../connect.inc");
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: AngsanaUPC;
	font-size:14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>ส่งออกข้อมูล DBF</strong></font></span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>

<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="429" border="0">
    <tr>
      <td width="30">เดือน :</td>
      <td width="94"> 
       <select name="mon">
           <option value="01">มกราคม</option>
           <option value="02">กุมภาพันธ์</option>
           <option value="03">มีนาคม</option>
           <option value="04">เมษายน</option>
           <option value="05">พฤษภาคม</option>
           <option value="06">มิถุนายน</option>
           <option value="07">กรกฎาคม</option>
           <option value="08">สิงหาคม</option>
           <option value="09">กันยายน</option>
           <option value="10">ตุลาคม</option>
           <option value="11">พฤศจิกายน</option>
           <option value="12">ธันวาคม</option>
       </select>	  </td>
      <td width="108">พ.ศ. : &nbsp;&nbsp;
		<?
        $Y=date("Y")+543;
        $date=date("Y")+543+5;
                      
        $dates=range(2547,$date);
        echo "<select name='year' class='forntsarabun'>";
        foreach($dates as $i){
        ?>
<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
            </option>
        <?
        }
        echo "<select>";
        ?>      </td>
      <td width="26" align="right"><font face="Angsana New">สิทธิ :</font></td>
      <td width="99"><select name="credit" id="credit">
        <option value="OFC" selected="selected">จ่ายตรง</option>
        <option value="SSS">ประกันสังคม</option>
        <option value="LGO">อปท</option>
      </select>      </td>
      <td width="46"><input name="BOK" value="ตกลง" type="submit" /></td>
    </tr>
  </table>
</form>
</font>
</span>
<?
if(isset($_POST['BOK'])){

$year = $_POST['year'];
$newyear = $year-543;
$yy = substr($newyear,2,2);
$mm =$_POST['mon'];

if($_POST['credit']=="OFC"){
	$newptright = "จ่ายตรง";
}else if($_POST['credit']=="SSS"){
	$newptright = "ประกันสังคม";
}else if($_POST['credit']=="LGO"){
	$newptright = "จ่ายตรง อปท.";
}

//--------------------Start DataSet3-------------------------//
$dbname3 = "OPD".$yy.$mm.".dbf";
	$def3 = array(
	  array("HN","C",15),
	  array("CLINIC","C",4),
	  array("DATEOPD","D"),
	  array("TIMEOPD","C",4),
	  array("SEQ","C",15),
	  array("UUC","C",1)
	);

	// creation
	if (!dbase_create($dbname3, $def3)) {
	  echo "Error, can't create the database3\n";
	}
		$sqlop3 ="select hn, txdate from  opacc  where credit like '$newptright%' and (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by substring(date,1,10), hn";
		//echo "test-->".$sqlop3."<br>";
   		$resultop3 = mysql_query($sqlop3) or die("Query failed3");
		while($rowsop3 = mysql_fetch_array($resultop3)){
			$hnop=$rowsop3["hn"];	
			
			$datetime=$rowsop3["txdate"];
			$dateopacc = substr($datetime,0,10);	
			
		
		
		$sql3 ="select * from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query เอาข้อมูลจากตาราง opday
		//echo "วันที่ $datetime ==>".$sql3."<br>";
		$result3 = mysql_query($sql3) or die("Query opday failed");
   		$rows3 = mysql_fetch_array($result3);
		$rowid=$rows3["row_id"];
		$newrowid = substr($rowid,3,4);
		
		$hn3=$rows3["hn"];  //  HN ใช้ตัวแปรนี้นำเข้าข้อมูล
		$vn3=$rows3["vn"]; 
		
		//datetime
		$datetime3=$rows3["thidate"];
		$date3 = substr($datetime3,0,10);
		$date =explode("-",$date3);
		$newdate=$date[0]-543;
		$newdateopd =$newdate.$date[1].$date[2];  //  DATEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		$time3 = substr($datetime3,11,8);	
		$newtime =explode(":",$time3);
		$newtimeopd = $newtime[0].$newtime[1];  //  TIMEOPD ใช้ตัวแปรนี้นำเข้าข้อมูล

		//clinic
		$clinic3=$rows3["clinic"];
		$clinic1=0;
		$clinic2=1;
   		$clinic=substr($clinic3,0,2);
		if($clinic==''){$clinic="00";} ;
		$newclinic=$clinic1.$clinic.$clinic2;  //  CLINIC ใช้ตัวแปรนี้นำเข้าข้อมูล
		
		//SEQ
		$lenvn=strlen($vn3);
		if($lenvn=="1"){
			$newvn="00".$vn3;
		}else if($lenvn=="2"){
			$newvn="0".$vn3;
		}else if($lenvn=="3"){
			$newvn=$vn3;
		}
		$newseq=$newdateopd.$newvn.$newrowid;  //  SEQ ใช้ตัวแปรนี้นำเข้าข้อมูล

		$ucc3="1";  //  UCC ใช้ตัวแปรนี้นำเข้าข้อมูล

	$db3 = dbase_open($dbname3, 2);
		if ($db3) {
			  dbase_add_record($db3, array(
				  $hn3, 
				  $newclinic,		  
				  $newdateopd,
				  $newtimeopd, 		
				  $newseq, 				  		  
				  $ucc3));   
					dbase_close($db3);
				}  //if db
	}  //while
//--------------------End DataSet3-------------------------//

}  // if check box ปิดสุดท้าย
?>