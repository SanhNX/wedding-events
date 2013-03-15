<?php

function getFeedList($LoaiId) {
    $sql = "
                SELECT `Id`, `LoaiId`, `Tieude`, `Date`, `Noidung`, `Hinhanh`, `Video`, `Diadiem`
                FROM  tb_baiviet b 
                WHERE b.LoaiId = ".$LoaiId;
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

function addBook($LoaiId, 
        $Ten,
        $Date,
        $Noidung,
        $Hinhanh, 
        $Video, 
        $Diadiem) {
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
    $id = mysql_insert_id();
    return $queryResult;
}

function updateBookImage($id, $iconUrl, $bannerUrl) {
    $sql = "UPDATE `heliumdb`.`book`
	SET `IconUrl` = '$iconUrl', 
	`BannerUrl` = '$bannerUrl' 
	WHERE `book`.`BookID` = $id;";
    $queryResult = mysql_query($sql);
    
    return $queryResult;
}

?>