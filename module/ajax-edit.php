<?php

include "../DAO/connection.php";
include "../DTO/object.php";
include "../BLL/feedBll.php";

//include "./utils/simple_html_dom.php";

$id = $_POST["id"];
$type = $_POST["type"];
$item = getFeed_byID($id);
echo '{';  
    echo '"Id":'.$item->Id.'';    
    echo ',"Tieude":"'.$item->Ten.'"';
    echo ',"Noidung": " '.  str_replace('"',"'",$item->Noidung).' " ';

echo '}';
?>