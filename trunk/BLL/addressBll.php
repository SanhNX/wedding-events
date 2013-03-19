<?php

function getAddressList() {
    $query = "SELECT `Id`, `Ten`
                FROM tb_diadiem d";

    $queryResult = mysql_query($query);
    $i = 0;
    $result;
    while ($seletedAutItem = mysql_fetch_array($queryResult)) {
        $Item = new Address();
        $Item->Id = $seletedAutItem['Id'];
        $Item->Ten = $seletedAutItem['Ten'];
        $result[$i] = $Item;
        $i++;
    }
    return $result;
}

function getSubAddressList() {
    $query = "SELECT `Subddid`,`DiadiemId`, `Ten`
                FROM tb_subdiadiem d";

    $queryResult = mysql_query($query);
    $i = 0;
    $result;
    while ($seletedAutItem = mysql_fetch_array($queryResult)) {
        $Item = new SubAddress();
        $Item->Id = $seletedAutItem['Id'];
        $Item->DdId = $seletedAutItem['DiadiemId'];

        $Item->Ten = $seletedAutItem['Ten'];
        $result[$i] = $Item;
        $i++;
    }
    return $result;
}

function getSubAddressList_byID($id) {
    $query = "SELECT `SubddId`,`DiadiemId`, `Ten`
                FROM tb_subdiadiem d
                WHERE d.DiadiemId = $id";

    $queryResult = mysql_query($query);
    $i = 0;
    $result;
    while ($seletedAutItem = mysql_fetch_array($queryResult)) {
        $Item = new SubAddress();
        $Item->Id = $seletedAutItem['SubddId'];
        $Item->DdId = $seletedAutItem['DiadiemId'];

        $Item->Ten = $seletedAutItem['Ten'];
        $result[$i] = $Item;
        $i++;
    }
    return $result;
}
?>