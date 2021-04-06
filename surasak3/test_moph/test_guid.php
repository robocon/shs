<?php 
function getRandomInt($max){
    $ii = false;
    for($i = 1; $i <= $max; $i++)
    {
        $i1 = (string) rand(1, 255);
        if($i == 7)
        {
            $i2 = chr(rand(64, 79));
        }
        else
        {
            $i2 = chr($i1);
        }
        $ii .= bin2hex($i2);
    }
    return $ii;
}

function generate_uuidv4(){ 
    $rand_int = getRandomInt(16);
    $split4 = str_split($rand_int, 4);
    $resVs = vsprintf("%04s%04s-%04s-%04s-%04s-%04s%04s%04s", $split4);
     return $resVs;
}
echo strtoupper(generate_uuidv4());