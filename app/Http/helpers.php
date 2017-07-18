<?php
// Get relation type from relation object
function getRelationType($relation = null) {

    $type = get_class($relation);
    $type = lcfirst(substr($type, strrpos($type, '\\') + 1));

    return $type;
}

// Format number with decimals
function decimalFormat($number = 0, $decimals = 2)
{
	return number_format((float)$number, $decimals, '.', '');
}