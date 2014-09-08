<?php
$word = $_GET['text'];
$redValue = $_GET['red'];
$greenValue = $_GET['green'];
$blueValue = $_GET['blue'];
$nthValue = $_GET['nth'];
$output = "";
if (strlen(dechex($redValue))<2){
    $rgb = '#' . "0" . dechex($redValue);
} else {
    $rgb = '#' . dechex($redValue);
}
if (strlen(dechex($greenValue))<2){
    $rgb .= "0" . dechex($greenValue);
} else {
    $rgb .= dechex($greenValue);
}
if (strlen(dechex($blueValue))<2){
    $rgb .= "0" . dechex($blueValue);
} else {
    $rgb .= dechex($blueValue);
}
$output = "<p>";

for ($i = 0; $i < strlen($word); $i++){
    $x = $i + 1;
    if ($x % $nthValue == 0 ){
        $output .= '<span style="color: ' . $rgb . '">' . htmlspecialchars($word[$i]) . '</span>';
    }else {
        $output .=  htmlspecialchars($word[$i]);
    }

}

$output .= "</p>";
echo ($output);

?>