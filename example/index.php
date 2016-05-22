<?php 
include '../sbst.class.php';

$sbst = new sbst();

$sbst -> host = "localhost";
$sbst -> user = "root";
$sbst -> pass = "root";
$sbst -> db = "sbst";
$sbst -> table = "player_stats";
$sbst -> limit = 10;

$sbst -> mysql();
$sbst -> table();
?>
