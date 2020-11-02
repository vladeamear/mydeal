<?php

$db_cfg = require_once 'config/db.php';
$db_cfg = array_values($db_cfg);
require_once 'functions.php';

$link = mysqli_connect(...$db_cfg);
mysqli_set_charset($link, "utf8");

$categories = [];
$content = '';