<?php

include '../DAO/connection.php';
include '../DTO/object.php';
include '../BLL/feedBll.php';

//include './utils/simple_html_dom.php';

$id = $_POST['id'];
$type = $_POST['type'];
deleteFeed($id);
$dir = str_replace('module', '', getcwd()) . "\images\\resource\img\\" . $id;
rmdir_recursive($dir);

function rmdir_recursive($dir) {
    foreach (scandir($dir) as $file) {
        if ('.' === $file || '..' === $file)
            continue;
        if (is_dir("$dir/$file"))
            rmdir_recursive("$dir/$file");
        else
            unlink("$dir/$file");
    }
    rmdir($dir);
}

?>