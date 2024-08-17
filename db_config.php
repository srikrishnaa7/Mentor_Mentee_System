<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'id21950056_techrathamintern02032024');
define('DB_PASSWORD', 'Techratham@1ntern');
define('DB_NAME', 'id21950056_mentor_mentee_db');

$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}
?>