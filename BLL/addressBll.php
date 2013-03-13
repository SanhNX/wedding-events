<?php

function getAddressList()
{
	$query = "SELECT `Id`, `Ten`
                FROM tb_diadiem d";

	$queryResult = mysql_query($query);
	$i=0;
	$result;
	while($seletedAutItem = mysql_fetch_array($queryResult))
	{
		$Item = new Address();
		$Item->Id = $seletedAutItem['Id'];
		$Item->Ten = $seletedAutItem['Ten'];
		$result[$i] = $Item;
		$i++;
	}
	return $result;
}
?>