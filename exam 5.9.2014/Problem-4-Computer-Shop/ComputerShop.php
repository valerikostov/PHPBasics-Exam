<?php
$text = $_GET['list'];
$filter = $_GET['filter'];
$order = $_GET['order'];
$minPrice = $_GET['minPrice'];
$maxPrice = $_GET['maxPrice'];

$items = preg_split("/\r?\n/", $text, -1, PREG_SPLIT_NO_EMPTY);
$itemList = [];
$lineNum = 1;

foreach ($items as $item) {
    $itemInfo = preg_split("/\|/", $item);
    $currentItem = new stdClass();
    $currentItem->line = $lineNum;
    $currentItem->name = trim($itemInfo[0]);
    $currentItem->type = trim($itemInfo[1]);
    $components = explode(", ", trim($itemInfo[2]));
    $currentItem->components = $components;
    $currentItem->price = floatval(trim($itemInfo[3]));
    $itemList[] = $currentItem;
    $lineNum++;
}

uasort($itemList, function($i1,$i2) use ($order) {
    if ($i1->price == $i2->price) {
        return ($i1->line > $i2->line) ? 1: -1;
    }
    return ($order == "ascending" ^ ($i1->price < $i2->price)) ? 1 : -1;
});

foreach ($itemList as $item) {
    if(($item->price >= $minPrice) && ($item->price <= $maxPrice) && ($item->type == $filter || $filter == "all")){

        $components1 = htmlspecialchars($item->components[0]);
        $components2 = htmlspecialchars($item->components[1]);
        $components3 = htmlspecialchars($item->components[2]);
        $item->name = htmlspecialchars($item->name);
        $item->type = htmlspecialchars($item->type);
        $item->line = htmlspecialchars($item->line);
        $item->price = htmlspecialchars(number_format($item->price,2,".",""));
        echo ('<div class="product" id="product' . $item->line . '"><h2>' .
            $item->name . '</h2><ul><li class="component">' . $components1 .
            '</li><li class="component">' . $components2 . '</li><li class="component">'
            . $components3 . '</li></ul><span class="price">' . $item->price . '</span></div>');
    }
}
?>