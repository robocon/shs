<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}

?>
<table align="center"  border="1" bordercolor="009688" cellspacing="0" cellpadding="0" width="85%">
<tr>
	<td>
		<table width="100%">
			<thead>
				<TR class="font_title" align="center">
					<TD bgcolor="009688">รหัสยา</TD>
					<TD bgcolor="009688">ชื่อยา</TD>
					<TD bgcolor="009688">ประเภท</TD>
					<TD bgcolor="009688">วิธีใช้</TD>
					<TD bgcolor="009688">จำนวน</TD>
					<TD bgcolor="009688">สถานะ</TD>
					<TD bgcolor="009688">OFF / ลบ</TD>
					<!-- <TD bgcolor="009688">แก้ไข</TD> -->
				</TR>
			</thead>
			<tbody id="drugSessionItems">
			<?php
			for($j=0; $j<$_SESSION["num_list"]; $j++){

				if($_SESSION["list_druglst"]["statcon"][$j] == "CONT"){
                    $bgcolor = "#00CC99";
                }else{
                    $bgcolor = "#FFFFCC";
                }
				
				$drugcode = $_SESSION["list_druglst"]["drugcode"][$j];
				$row_id = $_SESSION["list_druglst"]["row_id"][$j];
				$genname = $_SESSION["list_druglst"]["genname"][$j];
				$slcode = $_SESSION["list_druglst"]["slcode"][$j];
				$amount = $_SESSION["list_druglst"]["amount"][$j];
				$tradname = $_SESSION["list_druglst"]["tradname"][$j];
				$part = $_SESSION["list_druglst"]["part"][$j];
				?>
				<tr bgcolor="<?= $bgcolor; ?>" id="trParent<?= $j ?>">
					<td><?= $drugcode ?></td>
					<td><b><?= $tradname ?></b><br><?= $genname ?></td>
					<td><?= $part ?></td>
					<td id="tdContainer<?= $j ?>">
                        <input 
                        type="text" 
                        class="txtsarabun" 
                        id="slcode<?= $j ?>" 
                        name="slcode<?= $j ?>" 
                        data-container="tdContainer<?= $j ?>" 
                        onkeyup="getAttributeItem('<?= $row_id ?>',this.getAttribute('id'),this.value, '<?= $j ?>');" 
                        value="<?= $slcode ?>" size="6">
                    </td>
					<td >
                        <input type="text" class="txtsarabun" id="amount<?= $j ?>" name="amount<?= $j ?>" value="<?= $amount ?>" size="3" onchange="updateAmount('<?= $row_id ?>','<?= $drugcode ?>',this.value)"></TD>
					<td align="center">
						<select name="statusdrug<?=$j?>" class="txtsarabun" id="statusdrug<?=$j?>" onchange="updateStatdrugSession('<?=$j;?>','<?=$row_id;?>',this.value)">
							<option value="STAT1" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT1"){ echo "selected";}?>>Stat</option>
							<option value="STAT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="STAT"){ echo "selected";}?>>One day</option>
							<option value="CONT" <? if($_SESSION["list_druglst"]["statcon"][$j]=="CONT"){ echo "selected";}?>>Continue</option>
							<option value="OLD" <? if($_SESSION["list_druglst"]["statcon"][$j]=="OLD"){ echo "selected";}?>>ยาเดิม</option>
						</select>
					</td>
					<td align="center">
						<?php
						if($_SESSION["list_druglst"]["row_id"][$j] != ''){
							?>
							<a href="javascript:void(0);" onclick="del_session('<?= $j ?>','<?= $row_id; ?>')">OFF</a>
							<?php
						}else{
							?>
							<a href="javascript:void(0);" onclick="del_session('<?= $j ?>','')">ลบ</a>
							<?php
						}
						?>
					</td>
				</tr>
			<?php
			}// end for
			?>
			</tbody>
		</table>
		</td>
	</tr>
</table>
<?php
if($_SESSION["num_list"] > 0){
	?>
	<form action="add_drug.php?an=<?= $_GET['an']; ?>&bed=<?= $_GET['bed']; ?>&bedcode=<?= $_GET['bedcode']; ?>&date=<?= $_GET['date']; ?>" method="post" style="margin-bottom: 1em; margin-top:1em;">
		<div style="text-align:center;">
			<button type="submit" name="Save_dgprofile" class="txtsarabun" value="บันทึกข้อมูลใน DrugProfile">บันทึกข้อมูลใน DrugProfile</button>
		</div>
	</form>
<?php
}
?>