<?php
set_time_limit(30);

 include("connect.inc");   
	$month["01"] = "���Ҥ�";
    $month["02"] = "����Ҿѹ��";
    $month["03"] = "�չҤ�";
    $month["04"] = "����¹";
    $month["05"] = "����Ҥ�";
    $month["06"] = "�Զع�¹";
    $month["07"] = "�á�Ҥ�";
    $month["08"] = "�ԧ�Ҥ�";
    $month["09"] = "�ѹ��¹";
    $month["10"] = "���Ҥ�";
    $month["11"] = "��Ȩԡ�¹";
    $month["12"] = "�ѹ�Ҥ�";
?>


<style>
	body{
		font-family:"Angsana New"; font-size:20px;
	}
	.font_tr{ font-family:"Angsana New"; font-size:20px; background-color:"#F5DEB3"; }
	.font_hd{ font-family:"Angsana New"; font-size:20px; background-color:"#CD853F"; }
</style>

<form name="ff1" method="post" action="<?php echo $PHP_SELF ?>">

<TABLE>


<TR id="row2" >
	<TD align="right">�� :</TD>
	<TD>
		<INPUT TYPE="text" NAME="start_year" value="<?php if(isset($_POST["start_year"])) echo $_POST["start_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4">
	</TD>
</TR>

</TABLE>
 <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 
 <input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <INPUT TYPE="button" value="Print" Onclick="window.open('mc_soldier_print.php?sd='+document.ff1.start_year.value+'-'+document.ff1.start_month.value+'-'+document.ff1.start_day.value+'&ed='+document.ff1.end_year.value+'-'+document.ff1.end_month.value+'-'+document.ff1.end_day.value+'');">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <a target=_self  href='../nindex.htm'><<�����</a></p>
</form>


<?php

  $num=0;
If (!empty($B1)){
    include("connect.inc");

	$sql = "Create temporary table sub_dxofyear Select * From dxofyear where thidate like '".$_POST["start_year"]."%' ";
	$result = mysql_query($sql) or die("1Query failed ".mysql_error());

	$sql = "Create temporary table sub_resulthead Select a.* From resulthead as a inner join sub_dxofyear  as b ON a.hn = b.hn where a.orderdate like '".$_POST["start_year"]."%' AND (a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻաͧ�Ѻ��' OR a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻաͧ�Ѿ��') ";
	$result = mysql_query($sql) or die("2Query failed ".mysql_error());

	$sql = "Create temporary table sub_resultdetail Select a.*, b.hn, b.profilecode  From resultdetail as a inner join sub_resulthead as b ON b.`autonumber` = a.`autonumber`  ";
	$result = mysql_query($sql) or die("3Query failed ".mysql_error());

	$sql = "Create temporary table sub_opcard select a.hn , a.yot, a.name, a.surname, left(a.goup, 3) as goup , a.dbirth From opcard as a , sub_dxofyear as b where a.hn = b.hn ";
	$result = mysql_query($sql) or die("4Query failed ".mysql_error());


//�Ҩӹǹ������Ѻ��ԡ��
 $sql = "Select goup, count(goup) as c_goup From sub_dxofyear as a inner join sub_opcard as b ON a.hn=b.hn group by goup";
 $result = mysql_query($sql) or die("5Query failed ".mysql_error());
 while($arr = mysql_fetch_assoc($result))
{
		$list1[$arr["goup"]] = $arr["c_goup"];
		//echo "<BR>",$arr["goup"]," ",$arr["c_goup"];
		$list_sum += $arr["c_goup"];
 }

//�� bmi ���Դ����
  $sql = "Select weight, height From sub_dxofyear  ";
 $result = mysql_query($sql) or die("6Query failed ".mysql_error());
 while($arr = mysql_fetch_assoc($result))
{
        
		if($arr["height"] =="" || $arr["weight"] ==""){
			$list22++;
		}else{
			$ht = $arr["height"]/100;
			$bmi = $arr["weight"]/($ht*$ht);

			if($bmi >= 18.5 && $bmi <= 22.9)
				$list22++;
			else if($bmi < 18.5)
				$list21++;
			else if($bmi >= 23.0 && $bmi <= 24.9)
				$list23++;
			else if($bmi >= 25.0 && $bmi <= 29.9)
				$list24++;
			else if($bmi >= 30.0)
				$list25++;
		}
}

//�� bp ���Դ����
 $sql = "Select bp1, bp2  From sub_dxofyear as a inner join sub_opcard as b ON a.hn=b.hn where dbirth <= '2519-01-01' ";
 $result = mysql_query($sql) or die("7Query failed ".mysql_error());
 while($arr = mysql_fetch_assoc($result)){
	
	//echo "<br />",$arr["bp1"]," ",$arr["bp2"];
	if($arr["bp1"] > 140 || $arr["bp2"] < 90){
		$list31++;
		//echo "<BR>",$arr["bp1"]," ",$arr["bp2"];
	}
		
 }

  $sql = "Select bp1, bp2 From sub_dxofyear as a inner join sub_opcard as b ON a.hn=b.hn where dbirth > '2519-01-01' ";
 $result = mysql_query($sql) or die("Query failed ".mysql_error());
 while($arr = mysql_fetch_assoc($result)){
	
	if($arr["bp1"] > 140 || $arr["bp2"] < 90){
		$list41++;
		//echo "<BR>",$arr["bp1"]," ",$arr["bp2"];
	}

 }

$sql = "Select distinct a.autonumber, a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth <= '2519-01-01'  AND a.profilecode = 'UA' AND a.flag <> 'N' AND a.flag <> '*'  ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list33 = mysql_num_rows($result);


$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth <= '2519-01-01'  AND a.profilecode = 'HCT' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list34 = mysql_num_rows($result);
// while($arr = mysql_fetch_assoc($result)){
//	echo "<BR>",$arr["flag"]," ";
// }

$sql = "Select distinct a.autonumber, a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'UA' AND a.flag <> 'N' AND a.flag <> '*'  ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list43 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'HCT' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list44 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'Glu' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list45 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'CHOL' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list46 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'TRI' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list47 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'HDL' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list48 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'LDL' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list49 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'BUN' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list410 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'CREA' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list411 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'AST' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list412 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'ALT' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list413 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'ALP' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list414 = mysql_num_rows($result);

$sql = "Select a.flag From sub_resultdetail as a INNER JOIN sub_opcard as b ON a.hn = b.hn where b.dbirth > '2519-01-01'  AND a.profilecode = 'URIC' AND a.flag <> 'N' ";
$result  = mysql_query($sql) or die("Query failed ".mysql_error());
$list415 = mysql_num_rows($result);

include("unconnect.inc");

}
?>

<CENTER>
Ẻ��§ҹ��ػ�š�õ�Ǩ��ҧ��� ��Шӻ� 2554<BR>
þ.���ӡ�õ�Ǩ  þ.��������ѡ��������
<BR>���˹��·�����Ѻ��õ�Ǩ  þ.��������ѡ��������
</CENTER>



1. �ӹǹ������Ѻ��õ�Ǩ                       ��� ����
<Table width="400" border="0">
	<TR>
		<TD width="300" >1.1&nbsp;&nbsp;��·����ѭ�Һѵ�             </TD><TD> <?php echo $list1["G11"];?>           </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >1.2&nbsp;&nbsp;��·��ê�鹻�зǹ             </TD><TD> <?php echo $list1["G12"];?>           </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >1.3&nbsp;&nbsp;�١��ҧ��Ш�           </TD><TD> <?php echo $list1["G14"];?>            </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >1.4&nbsp;&nbsp;����           </TD><TD> <?php echo $list_sum-$list1["G14"]-$list1["G12"]-$list1["G11"];?>            </TD><TD align="right">���</TD></TR>
</Table>

2. ��ҴѪ����š�� (BMI)
<Table width="400" border="0">
	<TR>
	<TD width="300" >2.1&nbsp;&nbsp;Under weight (���¡��� 18.5)            </TD><TD> <?php echo $list21;?>            </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >2.2&nbsp;&nbsp;Normal weight (18.5-22.9)         </TD><TD> <?php echo $list22;?>              </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >2.3&nbsp;&nbsp;Over weight (23.0-24.9)         </TD><TD> <?php echo $list23;?>             </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >2.4&nbsp;&nbsp;Obesity �дѺ 1 (25.0-29.9)          </TD><TD> <?php echo $list24;?>             </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >2.5&nbsp;&nbsp;Obesity �дѺ 2 (�ҡ����������ҡѺ 30 )           </TD><TD> <?php echo $list25;?>            </TD><TD align="right">���</TD></TR>
</Table>

3. ���������������Թ 35 �� ��Ժ�ó�   ���
<Table width="400" border="0">
	<TR>
		<TD colspan="3" width="300" >3.1&nbsp;&nbsp; BP (��һ��� 140/90 mmHg)</TD></TR>
	<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP (�Դ����)            </TD><TD> <?php echo $list31;?>           </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >3.2&nbsp;&nbsp;Chest X-Ray �Դ����                       </TD><TD> <?php echo $list33;?>          </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >3.3&nbsp;&nbsp;Urine Examination �Դ����             </TD><TD> <?php echo $list33;?>          </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >3.4&nbsp;&nbsp;Hct (��һ��� ���=40 , ˭ԧ = 36-47 )
	<TR>
		<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct �Դ����              </TD><TD> <?php echo $list34;?>         </TD><TD align="right">���</TD></TR>
	<TR>
		<TD width="300" >3.5&nbsp;&nbsp;�ä����                       </TD><TD> <?php echo $list35;?>          </TD><TD align="right">���</TD></TR>
	<TR>
		<TD colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к�</TD></TR>
</Table>

4. ������������ҡ���� 35 �� ��Ժ�ó����                   ���
<Table width="400" border="0">
	<TR>
	<TD colspan="3" width="300" >4.1&nbsp;&nbsp; BP (��һ��� 140/90 mmHg)</TD></TR>
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BP (�Դ����)             </TD><TD> <?php echo $list41;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >4.2&nbsp;&nbsp;Chest X-Ray �Դ����              </TD><TD> &nbsp;<?php echo $list;?>         </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >4.3&nbsp;&nbsp;Urine Examination �Դ����            </TD><TD> <?php echo $list43;?>           </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.4&nbsp;&nbsp;Hct (��һ��� ���=40-54 , ˭ԧ = 36-47 )
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Hct �Դ����            </TD><TD> <?php echo $list44;?>           </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.5&nbsp;&nbsp;Glucose (��һ��� 68-110)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Glucose �Դ����             </TD><TD> <?php echo $list45;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.6&nbsp;&nbsp;Cholesterol (��һ��� 120-200)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cholesterol �Դ����              </TD><TD> <?php echo $list46;?>         </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.7&nbsp;&nbsp;Triglycerides (��һ��� 50-160)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Triglycerides �Դ����           </TD><TD> <?php echo $list47;?>           </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.8&nbsp;&nbsp;HTable-C (��һ��� �ҡ���� 55)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HTable-C �Դ����             ������Ǩ      </TD><TD> <?php echo $list48;?>    </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.9&nbsp;&nbsp;LTable-C (��һ��� ���¡��� 130)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;LTable-C �Դ����             ������Ǩ      </TD><TD> <?php echo $list49;?>    </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.10&nbsp;&nbsp;BUN (��һ��� 6-20)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;BUN �Դ����            </TD><TD> <?php echo $list410;?>           </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.11&nbsp;&nbsp;Creatinine (��һ��� 0.67-1.17)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Creatinine �Դ����             </TD><TD> <?php echo $list411;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.12&nbsp;&nbsp;SGOT (��һ��� 0-37)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGOT �Դ����            </TD><TD> <?php echo $list412;?>           </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.13&nbsp;&nbsp;SGPT (��һ��� 0-41)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SGPT �Դ����             </TD><TD> <?php echo $list413;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.14&nbsp;&nbsp;ALK Phosphatase (��һ��� 40-129)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ALK Phosphatase �Դ����             </TD><TD> <?php echo $list414;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3" width="300" >4.15&nbsp;&nbsp;Uric acid (��һ��� 2.47-8.40)
	<TR>
	<TD>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Uric acid �Դ����             </TD><TD> <?php echo $list415;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD width="300" >4.16&nbsp;&nbsp;�ä����                      </TD><TD> &nbsp;<?php echo $list;?>          </TD><TD align="right">���</TD></TR>
	<TR>
	<TD colspan="3">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�к�</TD></TR>
</Table>



<?php

//include("add_report_mc.php");

?>


