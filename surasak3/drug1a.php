<?php
    session_start();
?>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">
	function ClickCheckAll(vol)
	{
	
		var i=1;
		for(i=1;i<=document.f1.hdnCount.value;i++)
		{
			if(vol.checked == true)
			{
				eval("document.f1.drugprint"+i+".checked=true");
			}
			else
			{
				eval("document.f1.drugprint"+i+".checked=false");
			}
		}
	}

	
</script>
<?=$cbedname;?>   เตียง : <?=$cBed;?><BR />
ชื่อผู้ป่วย : <?=$Ptname;?>    AN:<u><?=$cAn;?></u> HN: <u><?=$cHn;?></u>

<form name="f1" method="post" action="sticker_dg1a.php?cAn=<?=$cAn;?>&bedname=<?=$cbedname;?>&bed=<?=$cBed;?>&hn=<?=$cHn;?>&ptname=<?=$Ptname;?>">
<table>
 <tr>
   <th class="class_drug"><input name="CheckAll" type="checkbox" id="CheckAll" value="Y" onClick="ClickCheckAll(this);" title="คลิกเพื่อเลือกทั้งหมด นะคราฟ">
    </div></th>
    <th class="class_drug">#</th>
   <th class="class_drug">วันที่</th>
   <th class="class_drug">รายการ</th>
   <th class="class_drug">หน่วยนับ</th>
   <th class="class_drug">วิธิใช้</th>
   <th class="class_drug">จำนวน</th>
   <th class="class_drug">สถานะ</th>
   <th class="class_drug">ON/OFF</th>
   <th class="class_drug">วันที่ OFF</th>
   <th class="class_drug"><span class="class_drug2">Sticker</span></th>
 </tr>
 
<?php
    $n=0;
    include("connect.inc");//and onoff='ON'
        //an,part,idno,totalamt,totalpri,statcon,onoff,officer
        $query = "SELECT   date,drugcode,tradname,unit,slcode,amount,statcon,onoff,dateoff ,row_id FROM dgprofile  WHERE an = '$cAn' ORDER BY date desc , date ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($date,$drugcode,$tradname,$unit,$slcode,$amount,$statcon,$onoff,$dateoff,$row_id) = mysql_fetch_row ($result)) {
            $n++;
            $date=substr($date,0,10);
            $dateoff=substr($dateoff,0,10);
			

if($n%2==0)
{
$bg = "#CCCCCC";
}
else
{
$bg = "#FFFFFF";
}
			?>
            <tr>
			  	<td bgcolor='<?=$bg;?>' class='class_drug2'><div align="center">
      <input type="checkbox" name="drugprint[]" id="drugprint<?=$n;?>" value="<?=$row_id;?>"></div></td>
           		<td bgcolor='<?=$bg;?>' class='class_drug2'><?=$n;?></td>
               	<td bgcolor='<?=$bg;?>' class='class_drug2'><?=$date;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$tradname;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$unit;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$slcode;?>               </td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$amount;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$statcon;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$onoff;?></td>
               <td bgcolor='<?=$bg;?>' class='class_drug2'><?=$dateoff;?></td>
              <td align="center" bgcolor='<?=$bg;?>' class='class_drug2'><a href="sticker1a.php?ptname=<?=$Ptname;?>&bed=<?=$cBed;?>&dr=<?=$tradname;?>&slcode=<?=$slcode;?>">พิมพ์</a></td>
               </tr>
 <input type="hidden" name="slcode<?=$n;?>" value="<?=$slcode;?>" />
 <input type="hidden" name="drugcode<?=$n;?>" value="<?=$drugcode;?>"/>        
<?
 }
include("unconnect.inc");
?>
            <tr>
              <td colspan="11" align="center" bgcolor='99CCCC' >
              <input type="hidden" name="hdnCount" value="<?=$n;?>">
              <input type="submit" name="b1" value="ตกลง" /></td>
    </tr>

<!--            <tr>
              <td colspan="10" align="center" bgcolor='99CCCC' class='class_drug2'>
              <input type="hidden" name="hdnCount" value="<?//=$n;?>">
              
              <input type="submit" name="print" value="     Print STICKER   " style="background-color:#CCC; font-size:14px;" >
              </td>
    </tr>-->
</table>

</form>