<?php

include "../DAO/connection.php";
include "../DTO/object.php";
include "../BLL/feedBll.php";
include "../BLL/addressBll.php";


//include "./utils/simple_html_dom.php";

$id = $_POST["id"];
$type = $_POST["type"];
switch ($type) {
    case 'listDD':
        $itemList = getSubAddressList_byID($id);
        if (count($itemList) == 0) {
            echo '';
            return;
        }
        echo '{"list":[';
        for ($i = 0; $i < count($itemList); $i++) {
            $item = $itemList[$i];
            echo '{"SubddId":"' . $item->Id . '"';
            echo ',"Ten": " ' . $item->Ten . ' "}';
            if ($i + 1 < count($itemList))
                echo ",";
        }

        echo ']}';
        break;
    default :break;
}
?>