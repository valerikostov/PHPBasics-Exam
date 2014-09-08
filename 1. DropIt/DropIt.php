<?php
$input = $_GET['text'];
$maxFontSize = $_GET['maxFontSize'];
$minFontSize = $_GET['minFontSize'];
$step = $_GET['step'];
$output = "";
$fontSize = $minFontSize;
$flag = 0;
$overTheTop = 0;

for ($i = 0; $i < strlen($input); $i++) {
    $charInt = ord($input[$i]);
    if ($charInt % 2 == 0) {
        $output = "<span style='font-size:" . getFontSize($i) . ";text-decoration:line-through;'>" . htmlspecialchars($input[$i]) . "</span>";
    } else {
        $output = "<span style='font-size:" . getFontSize($i) . ";'>" . htmlspecialchars($input[$i]) . "</span>";
    }
    if (($charInt > 64 && $charInt < 91 ) || ($charInt > 97 && $charInt < 123)) {
        $flag = 1;
    } else {
        $flag = 0;
    }
    //echo $input[$i] . "+" . $fontSize . "; ";
    //echo $output;
    echo htmlspecialchars($output);
}

function getFontSize($i) {
    global $fontSize, $minFontSize, $maxFontSize, $step, $flag, $overTheTop;
    if ($i == 0) {return $fontSize;}
    if ($flag == 0) {return $fontSize;}
    if ($overTheTop == 0){
        $fontSize = $fontSize + $step;
        if ($fontSize >= $maxFontSize){$overTheTop = 1;}
    } else {
        $fontSize = $fontSize - $step;
        if ($fontSize <= $minFontSize){$overTheTop = 0;}
    }
    return $fontSize;
}
?>