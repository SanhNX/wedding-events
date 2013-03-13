<?php
function add_or_change_parameter($parameter, $value)
{
	$params = array();
	$output = "?";
	$firstRun = true;
	foreach($_GET as $key=>$val)
	{
		if($key != $parameter)
		{
			if(!$firstRun)
			{
				$output .= "&";
			}
			else
			{
				$firstRun = false;
			}
			$output .= $key."=".urlencode($val);
		}
	}
	if(!$firstRun)
	$output .= "&";
	$output .= $parameter."=".urlencode($value);
	return htmlentities($output);
}
function GetFileExt($strFileName)
{
	return strtolower(substr(strrchr($strFileName, '.'), 1));
}
?>