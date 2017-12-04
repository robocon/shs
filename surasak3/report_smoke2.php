<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>
<body>
  <? 
include("connect.inc");
?>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a></p>

<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="30%">
		<?
        $sql1="SELECT `cigarette`, `cigok`
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE b.`icd10` like 'J44%' AND b.`thidate` like '2558%' group by b.hn";
        $query1=mysql_query($sql1)or die ("Query Error");
        $num1=mysql_num_rows($query1);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows1=mysql_fetch_array($query1)){
            if($rows1["cigarette"]=="" || $rows1["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows1["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if( $rows1["cigok"]=="0" OR empty($rows1["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows1["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows1["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>COPD (J44)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num1;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>        </td>
    <td width="30%">
 		<?
        $sql2="SELECT `cigarette`, `cigok`
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE (b.`icd10` like 'A15%' OR b.`icd10` like 'A16%')  AND b.`thidate` like '2558%' group by b.hn";
		//echo $sql2;
        $query2=mysql_query($sql2)or die ("Query Error");
        $num2=mysql_num_rows($query2);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows2=mysql_fetch_array($query2)){
            if($rows2["cigarette"]=="" || $rows2["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows2["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if( $rows2["cigok"]=="0" OR empty($rows2["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows2["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows2["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>TB (A15, A16)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num2;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>    </td>
    <td width="30%">
		<?
        $sql3="SELECT `cigarette`, `cigok`
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE (b.`icd10` like 'I10%' OR b.`icd10` like 'I251%')  AND b.`thidate` like '2558%' group by b.hn";
		//echo $sql2;
        $query3=mysql_query($sql3)or die ("Query Error");
        $num3=mysql_num_rows($query3);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows3=mysql_fetch_array($query3)){
            if($rows3["cigarette"]=="" || $rows3["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows3["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if($rows3["cigok"]=="0" OR empty($rows3["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows3["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows3["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>หัวใจ, HT, CAD (I10, I251)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num3;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>
		<?
        $sql4="SELECT `cigarette`, `cigok`
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE (b.`icd10` like 'I61%' OR b.`icd10` like 'I63%' OR b.`icd10` like 'I64%' OR b.`icd10` like 'I69%') AND b.`thidate` like '2558%' group by b.hn";
        $query4=mysql_query($sql4)or die ("Query Error");
        $num4=mysql_num_rows($query4);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows4=mysql_fetch_array($query4)){
            if($rows4["cigarette"]=="" || $rows4["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows4["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if($rows4["cigok"]=="0" OR empty($rows4["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows4["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows4["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>สมอง Stroke (I61, I63, I64, I69)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num4;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>        </td>
    <td width="30%">
 		<?
        $sql5="SELECT `cigarette`, `cigok` 
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE (b.`icd10` like 'E10%' OR b.`icd10` like 'E11%' OR b.`icd10` like 'E14%')  AND b.`thidate` like '2558%' group by b.hn";
		//echo $sql2;
        $query5=mysql_query($sql5)or die ("Query Error");
        $num5=mysql_num_rows($query5);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows5=mysql_fetch_array($query5)){
            if($rows5["cigarette"]=="" || $rows5["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows5["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if($rows5["cigok"]=="0" OR empty($rows5["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows5["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows5["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>เบาหวาน (E10, E11, E14)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num5;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>    
    </td>
    <td>
 		<?
        $sql6="SELECT `cigarette`, `cigok` 
        FROM `opd` as a inner join opday as b on a.hn=b.hn
        WHERE (b.`icd10` like 'F10%' OR b.`icd10` like 'F20%' OR b.`icd10` like 'F32%' OR b.`icd10` like 'F41%')  AND b.`thidate` like '2558%' group by b.hn";
		//echo $sql2;
        $query6=mysql_query($sql6)or die ("Query Error");
        $num6=mysql_num_rows($query6);
        $cigarette0=0;
        $cigarette1=0;
        $cigarette2=0;
        $cigok0=0;
        $cigok1=0;
        
        while($rows6=mysql_fetch_array($query6)){
            if($rows6["cigarette"]=="" || $rows6["cigarette"]=="0"){  //ไม่สูบ
                $cigarette0++;
            }else if($rows6["cigarette"]=="1"){  //สูบ
                $cigarette1++;
                if($rows6["cigok"]=="0" OR empty($rows6["cigok"]) ){  //ไม่อยากเลิก
                    $cigok0++;
                }else if($rows6["cigok"]=="1"){  //อยากเลิก
                    $cigok1++;
                }
            }else if($rows6["cigarette"]=="2"){  //เคยสูบ
                $cigarette2++;
            }
        }
        ?>
        <table width="80%" border="1" align="left" cellpadding="3" cellspacing="0" bordercolor="#000000">
          <tr>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>จิตเวช (F10, F20, F32, F41)</strong></td>
          </tr>
          <tr>
            <td><strong>ทั้งหมด</strong></td>
            <td align="right"><?=$num6;?></td>
          </tr>
          <tr>
            <td width="38%"><strong>1. ไม่สูบบุหรี่</strong></td>
            <td width="62%" align="right"><?=$cigarette0;?></td>
          </tr>
          <tr>
            <td><strong>2. เคยสูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette2;?></td>
          </tr>
          <tr>
            <td><strong>3. สูบบุหรี่</strong></td>
            <td align="right"><?=$cigarette1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.1 อยากเลิก</strong></td>
            <td align="right"><?=$cigok1;?></td>
          </tr>
          <tr>
            <td><strong>&nbsp;&nbsp;3.2 ไม่อยากเลิก</strong></td>
            <td align="right"><?=$cigok0;?></td>
          </tr>
        </table>    
    
    </td>
  </tr>
</table>


</body>
</html>
