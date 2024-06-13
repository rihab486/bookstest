<?php

// Configure CORS
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

//include the connection file to connect for DB.
require_once("connection.php");

//sessionstart
 require_once("session_handler.php");

// include all webservices.
 include ("api.php");


?>