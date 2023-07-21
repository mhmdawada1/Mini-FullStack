<?php

$mysqli = new mysqli("localhost","root",null, "foodex_db");
if (!$mysqli) {
    die('a connection was unsuccesful');
}