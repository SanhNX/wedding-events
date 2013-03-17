<?php

function getFeedList($LoaiId) {
    $sql = "
                SELECT `Id`, `LoaiId`, `Tieude`, `Date`, `Noidung`, `Hinhanh`, `Video`, `Diadiem`
                FROM  tb_baiviet b 
                WHERE b.LoaiId = " . $LoaiId;
    $queryResult = mysql_query($sql);
    $i = 0;
    $result;
    while ($seletedItem = mysql_fetch_array($queryResult)) {
        $item = new Feed();
        $item->Id = $seletedItem['Id'];
        $item->LoaiId = $seletedItem['LoaiId'];
        $item->Ten = $seletedItem['Tieude'];
        $item->Date = $seletedItem['Date'];
        $item->Noidung = $seletedItem['Noidung'];

        $item->Hinhanh = $seletedItem['Hinhanh'];
        $item->Video = $seletedItem['Video'];
        $item->Diadiem = $seletedItem['Diadiem'];
        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function getFeed_byID($id) {
    $sql = "SELECT `Id`, `LoaiId`, `Tieude`, `Date`, `Noidung`, `Hinhanh`, `Video`, `Diadiem`
            FROM  tb_baiviet b
            WHERE b.Id = $id ";
    $queryResult = mysql_query($sql);

    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $seletedItem = mysql_fetch_array($queryResult);

    $item = new Feed();
    $item->Id = $seletedItem['Id'];
    $item->LoaiId = $seletedItem['LoaiId'];
    $item->Ten = $seletedItem['Tieude'];
    $item->Date = $seletedItem['Date'];
    $item->Noidung = $seletedItem['Noidung'];

    $item->Hinhanh = $seletedItem['Hinhanh'];
    $item->Video = $seletedItem['Video'];
    $item->Diadiem = $seletedItem['Diadiem'];
    return $item;
}

function addFeed($LoaiId, $Ten, $Date, $Noidung, $Hinhanh, $Video, $Diadiem) {
    //Tránh tình trạnh các biến có chứa các dấu nháy (',",..)làm sinh lỗi truy vấn
    //Ta dùng mysql_real_escape_string() để đổi sang dạng thuần string
    $LoaiId = mysql_real_escape_string($LoaiId);
    $Ten = mysql_real_escape_string($Ten);
    $Date = mysql_real_escape_string($Date);
    $Noidung = mysql_real_escape_string($Noidung);
    $Hinhanh = mysql_real_escape_string($Hinhanh);
    $Video = mysql_real_escape_string($Video);
    $Diadiem = mysql_real_escape_string($Diadiem);

    $sql = "INSERT INTO `weddingevents`.`tb_baiviet` (
	`LoaiId`, `Tieude`, `Date`, `Noidung`, 
	`Hinhanh`, `Video`, `Diadiem`) 
	VALUES ('$LoaiId', '$Ten','$Date', '$Noidung', 
	'$Hinhanh', '$Video', '$Diadiem');";
    //echo "<h2>".$sql."<h2>";
    $queryResult = mysql_query($sql);
//    $id = mysql_insert_id();
    if ($queryResult)
        return mysql_insert_id();
    else
        return -1;
}

function updateFeedDescript($id, $des) {
    $des = mysql_real_escape_string($des);
    $sql = "UPDATE `weddingevents`.`tb_baiviet`
	SET `Noidung` = '$des'	
	WHERE `tb_baiviet`.`Id` = $id;";
    $queryResult = mysql_query($sql);
    return $queryResult;
}

function updateFeedImg($id, $img) {
    $sql = "UPDATE `weddingevents`.`tb_baiviet`
	SET `Hinhanh` = '$img'	
	WHERE `tb_baiviet`.`Id` = $id;";
    $queryResult = mysql_query($sql);
    return $queryResult;
}
function deleteFeed($id) {
    $sql = "DELETE FROM `weddingevents`.`tb_baiviet` WHERE `tb_baiviet`.`Id` = $id;";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'ERROR!';
        exit;
    } else {
        echo 'SUCCESS!';
    }
}

function getFeed_byDDAndSubDD($dd, $subdd) {
    $sql = "SELECT `Id`, `LoaiId`, `Tieude`, `Date`, `Noidung`, `Hinhanh`, `Video`
            FROM  tb_baiviet b
            WHERE b.Diadiem = $dd AND b.SubDiadiem = $subdd ";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $i = 0;
    $result;
    while ($seletedItem = mysql_fetch_array($queryResult)) {

        $item = new Feed();
        $item->Id = $seletedItem['Id'];
        $item->LoaiId = $seletedItem['LoaiId'];
        $item->Ten = $seletedItem['Tieude'];
        $item->Date = $seletedItem['Date'];
        $item->Noidung = $seletedItem['Noidung'];
        $item->Hinhanh = $seletedItem['Hinhanh'];
        $item->Video = $seletedItem['Video'];
        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function getFeed_byDD($dd) {
    $sql = "SELECT `Id`, `LoaiId`, `Tieude`, `Date`, `Noidung`, `Hinhanh`, `Video`
            FROM  tb_baiviet b
            WHERE b.Diadiem = $dd";
    $queryResult = mysql_query($sql);
    if (!$queryResult) {
        echo 'Could not run query: ' . $id . mysql_error();
        exit;
    }
    $i = 0;
    $result;
    while ($seletedItem = mysql_fetch_array($queryResult)) {

        $item = new Feed();
        $item->Id = $seletedItem['Id'];
        $item->LoaiId = $seletedItem['LoaiId'];
        $item->Ten = $seletedItem['Tieude'];
        $item->Date = $seletedItem['Date'];
        $item->Noidung = $seletedItem['Noidung'];
        $item->Hinhanh = $seletedItem['Hinhanh'];
        $item->Video = $seletedItem['Video'];
        $result[$i] = $item;
        $i++;
    }
    return $result;
}

function buildGridFeed($type, $page, $size) {
    $itemList = getFeedList($type);

    echo '<table class="admin-grid">';
    $max = ($page + 1) * $size > count($itemList) ? count($itemList) : ($page + 1) * $size;
    for ($i = $page * $size; $i < $max; $i++) {
        $item = $itemList[$i];
        echo "<tr id='item-$item->Id'>";

        echo "<td>" . $item->Id . "</td>";
        echo "<td>" . $item->LoaiId . "</td>";
        echo "<td class='grid-col-medium'>" . $item->Ten . "</td>";
        echo "<td>" . $item->Diadiem . "</td>";
        $html = str_get_html($item->Noidung);
        echo "<td class='grid-col-large'><div class='grid-des'>" . $html->plaintext . "</div></td>";
        echo "<td><img class='grid-img' src='images/resource/img/" . $item->Id . "/" . $item->Id . "-0.jpeg' />";
        echo "<td>" . $item->Video . "</td>";
        echo "<td class='grid-col-button'><a class='btn-edit' name='btnEdit' title='Chỉnh sửa' onClick='editFeedAjax(" . $item->Id . ")'></a></td>";
        echo "<td class='grid-col-button'><a class='btn-delete' name='btnDelete' title='Xóa' onClick='deleteFeedAjax(" . $item->Id . ")'></a></td>";
    }
    echo "<tr><td colspan='9' class=''>";
    for ($i = 0; $i < count($itemList) / $size; $i++) {
        if ($page == $i)
            echo "<span class='btn-page active'>" . ($i + 1) . "</span>";
        else
            echo "<a class='btn-page' href='admin-baiviet.php?type=$type&page=$i'>" . ($i + 1) . "</a>";
    }
    echo "<a class='btn-add' id='btn-add' onClick='expandAddPage()' >Thêm</a>";
    echo "</td></tr>";

    echo "</table>";
}

?>