<?php
//importo conexion
require 'includes/config/database.php';
$db = conectarDB();

//crear email y password
$nombre = 'test1';
$apellido = '223';
$email = 'correo1@correo.com';
$clave = '54321';

$passwordHash = password_hash($clave, PASSWORD_DEFAULT);
var_dump($passwordHash);

//crear el usuario 
$query = "INSERT INTO usuario (nombre, apellido, correo, clave) VALUES ('${nombre}','${apellido}','${email}','${passwordHash}');";

echo $query;
//agregar a la bd
mysqli_query($db, $query);
