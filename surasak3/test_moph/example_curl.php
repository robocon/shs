<?php 
$eol = <<<EOL
/**
 * Example how to set POST Method to API Broker
 */
\$post_request = array(
    'page' => 'UpdateImmunization', // and other page Ex. ImmunizationHistory, ImmunizationTarget and ETC.
    'data' => array(
        // Read more at UpdateImmunization.php page
    )
);

\$post_query = http_build_query(\$post_request);

\$curl = curl_init();
curl_setopt(\$curl, CURLOPT_AUTOREFERER, TRUE);
curl_setopt(\$curl, CURLOPT_URL, "http://surasakmontri.new.hosting/moph/index.php"); // ยังไม่เปิดใจเย็นๆ
curl_setopt(\$curl, CURLOPT_POSTFIELDS, \$post_query);
curl_setopt(\$curl, CURLOPT_HTTPHEADER, 0);
curl_setopt(\$curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt(\$curl, CURLOPT_RETURNTRANSFER, 1);
\$output = curl_exec(\$curl);
curl_close(\$curl);
EOL;

echo "<pre>";
echo $eol;
echo "</pre>";
echo "<br>";

$eol = <<<EOL
/**
 * การส่งข้อมูลที่เป็นภาษาไทยจากในเซิฟเวอร์หลักของ ร.พ.(192.168.131.250) ให้Convert จาก tis-620 เป็น utf8
 * 
 */
function toUTF8(\$str)
{
    \$str = iconv("TIS-620", "UTF-8", \$str );
    return \$str;
}
EOL;

echo "<pre>";
echo $eol;
echo "</pre>";