<?php


function getCatelogyList()
{
	$query = "SELECT `Id`, `Ten`
                FROM tb_loai l";

	$queryResult = mysql_query($query);
	$i=0;
	$result;
	while($seletedItem = mysql_fetch_array($queryResult))
	{
		$item = new Catelogy();
		$item->Id = $seletedItem['Id'];
		$item->Ten = $seletedItem['Ten'];
		$result[$i] = $item;
		$i++;
	}
	return $result;
}
?>