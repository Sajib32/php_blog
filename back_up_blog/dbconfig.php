<?php

session_start();

    $DB_host = "localhost";
    $DB_user = "root";
    $DB_pass = "";
    $DB_name = "blogproject";
    
    $DB_con = new PDO("mysql:host={$DB_host};dbname={$DB_name}",$DB_user,$DB_pass);
	//$DB_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\admin.php';
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\main.php';
    $user = new Main($DB_con);
    $admin = new User($DB_con);

?>