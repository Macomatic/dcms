<?php
include 'envvars.php';
$dbconnect = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=" . $password);
?>