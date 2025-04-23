<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รหัสยาเวชภัณฑ์</title>
</head>
<body>
<style>
	*{
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	@media print{
		body{
			font-size: 16px;
		}
	}
</style>
<?php
echo "รหัสยาเวชภัณฑ์";
?>
<table>
    <tr>
        <th bgcolor=CC9900>
            <font face='Angsana New'>รหัส
        </th>
        <th bgcolor=CC9900>
            <font face='Angsana New'>ชื่อการค้า
        </th>
        <th bgcolor=CC9900>
            <font face='Angsana New'>ทุน
        </th>
        <th bgcolor=CC9900>
            <font face='Angsana New'>ขาย
        </th>
        <th bgcolor=CC9900>
            <font face='Angsana New'>กำไร(%)
        </th>
        <th bgcolor=CC9900>
            <font face='Angsana New'>เบิกได้?
        </th>
    </tr>
    <?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname,unitpri,salepri,part FROM druglst ORDER BY drugcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list($drugcode, $tradname, $unitpri, $salepri, $part) = mysql_fetch_row($result)) {
        if ($unitpri <> 0 and $salepri <> 0) {
            $profit = ($salepri - $unitpri) * 100 / $unitpri;
            $profit = number_format($profit, 1);
        } else {
            $xUnitpri = 0;
            $xSalepri = 0;
            $profit = 0;
        }
        print(" <tr>\n" .
            // "  <td BGCOLOR=99CCFF><font face='Angsana New'><a target='left'  href=\"drugcheck.php? dcode=$drugcode\">$drugcode</a></td>\n".
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$drugcode</a></td>\n" .
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$tradname</td>\n" .
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unitpri</td>\n" .
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n" .
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$profit</td>\n" .
            "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n" .
            " </tr>\n");
    }
    ?>
</table>
</body>
</html>