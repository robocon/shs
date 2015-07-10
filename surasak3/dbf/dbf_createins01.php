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
.style1 {
font-family: AngsanaUPC;
font-size: 14px;
}
.style2 {
	font-family: AngsanaUPC;
	font-size: 14px;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="Angsana New" size="+2">
<strong>ส่งออกข้อมูล DBF แฟ้มที่ 01 (INS)</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../../nindex.htm"><< ไปเมนู</a>

<span class="font1">
<font face="Angsana New">
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
  <table width="484" border="0">
    <tr>
      <td width="37">เดือน :</td>
      <td width="102"> 
   <select name="mon">
           <option value="01" selected="selected">มกราคม</option>
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
       </select></td>
      <td width="110">พ.ศ. : &nbsp;&nbsp;
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
      <td width="35" align="right"><font face="Angsana New">สิทธิ :</font></td>
      <td width="120"><select name="credit" id="credit">
          <option value="000" selected="selected">----ทั้งหมด----</option>
          <option value="OFC">จ่ายตรง</option>
          <option value="SSS">ประกันสังคม</option>
          <option value="LGO">อปท</option>
        </select>
      </td>
      <td width="54"><input name="BOK" value="ตกลง" type="submit" /></td>
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
	$newcredit = "จ่ายตรง";
}else if($_POST['credit']=="SSS"){
	$newcredit = "ประกันสังคม";
}else if($_POST['credit']=="LGO"){
	$newcredit = "จ่ายตรง อปท.";
}

//--------------------Start DataSet1-------------------------//
$dbname1 = "INS".$yy.$mm.".dbf";
	$def1 = array(
	  array("HN","C", 15),
	  array("INSCL","C",  3),
	  array("SUBTYPE","C",  2),
	  array("CID","C",16),
	  array("DATEIN","D"),
	  array("DATEEXP","D"),
	  array("HOSPMAIN","C",5),
	  array("HOSPSUB","C",5),
	  array("GOVCODE","C",6),
	  array("GOVNAME_ID","C",255),
	  array("PERMITNO","C",30),
	  array("DOCNO","C", 30),
	  array("OWNRPID","C",13),
	  array("OWNNAME","C",255),
	 
	);
	
	// creation
	if (!dbase_create($dbname1, $def1)) {
	  echo "Error, can't create the database1\n";
	};
	
if($_POST['credit']	=="000"){	
		$sqlop1 ="select hn, txdate from  opacc  where (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by substring(date,1,10), hn";
}else{
		$sqlop1 ="select hn, txdate from  opacc  where credit like '$newcredit%' and (date between '".$_POST['year']."-".$_POST['mon']."-"."01"." 00:00:00' and '".$_POST['year']."-".$_POST['mon']."-"."31"." 23:59:59') group by substring(date,1,10), hn";
}		
		//echo "test-->".$sqlop3."<br>";
   		$resultop1 = mysql_query($sqlop1) or die("Query failed3");
		while($rowsop1 = mysql_fetch_array($resultop1)){
			$hnop=$rowsop1["hn"];	
			
			$datetime=$rowsop1["txdate"];
			$dateopacc = substr($datetime,0,10);	
	
		$sql1 ="select hn,ptright from opday where hn ='".$hnop."' and thidate like '$dateopacc%'";   //  Query เอาข้อมูลจากตาราง opday
		$result1 = mysql_query($sql1) or die("Query failed1");
   		$rows1 = mysql_fetch_array($result1);
		$hcode1 ="11512";
		$hn1=$rows1["hn"];
		
		if($_POST['credit']	=="000"){
			$ptright=$rows1["ptright"];
			$codeptright = substr($ptright,0,3);	
			//  กำหนดตัวแปรของ สิทธิ์การรักษา
			if($codeptright =="R06"){
				$newptright ="UCS";
			}else if($codeptright =="R03"){
				$newptright ="OFC";
			}else if($codeptright =="R07"){
				$newptright ="SSS";
			}else if($codeptright =="R33"){
				$newptright ="LGO";
			}else if($codeptright =="R27"){
				$newptright ="SSI";
			}else{
				$newptright ="";
			}			
		}else{
			$newptright=$_POST['credit'];
		}
		


		$db1 = dbase_open($dbname1, 2);
		if ($db1) {
			  dbase_add_record($db1, array(
				  $hn1, 
				  $newptright, 
				  $subtype1, 
				  $cid1,
				  $datein1, 
				  $dateexp1, 
				  $hcode1, 
				  $hospsub1,
				  $govcode1, 
				  $govname1, 
				  $permitno1, 
				  $docno1,		
				  $ownprid1, 
				  $ownname1));   
					dbase_close($db1);
				}  //if db
		} ; //while		
//--------------------End DataSet1-------------------------//

}  // if check box ปิดสุดท้าย
?>