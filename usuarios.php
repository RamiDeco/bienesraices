<?php
    //Realizar la conexion
    require 'includes/config/database.php';
    $db = conectarDB();
    //Crear email y password
    $email = 'correo@correo.com';
    $password = 123456;
    
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    
    //Armar la consulta
    $query = "INSERT INTO usuarios (email, password) VALUES ('".$email."', '".$passwordHash."');";
    
    //Realizar la consulta
    $result = mysqli_query($db, $query);
