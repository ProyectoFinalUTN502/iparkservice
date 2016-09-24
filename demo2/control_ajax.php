<?php

require_once '../config/db.php';
require_once '../selectors/layoutSelector.php';

$type = INPUT_POST;
$id = filter_input($type, "id");
$state = filter_input($type, "state");

if ($id == NULL || $state == NULL) {
    exit();
}

changeStatePosition($id, $state);
