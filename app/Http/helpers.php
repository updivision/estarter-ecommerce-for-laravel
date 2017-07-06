<?php
// Get relation type from relation object
function getRelationType($relation = null) {

    $type = get_class($relation);
    $type = lcfirst(substr($type, strrpos($type, '\\') + 1));

    return $type;
}