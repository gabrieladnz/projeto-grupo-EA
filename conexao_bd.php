<?php

// Conexão com o BD
$servername = "localhost";
$username = "root";
$password = "Admin01";

$conn = new PDO("mysql:host=$servername;dbname=empresa_bd", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
