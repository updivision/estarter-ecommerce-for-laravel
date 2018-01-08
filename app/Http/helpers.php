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

// Get models
function getModels($path, $exception = []){
    $out = [];
    $results = scandir($path);
    foreach ($results as $result) {
        if ($result === '.' or $result === '..') continue;
        $filename = $path . '/' . $result;
        if (is_dir($filename)) {
            $out = array_merge($out, getModels($filename));
        } else {
            $out[] = substr($filename,0,-4);
        }
    }
    return $out;
}

function getStringBetween($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;

    return substr($string, $ini, $len);
}