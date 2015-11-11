<?php
    include_once 'H:\xampp\htdocs\final_attempt_blog\classes\class.user.php';
    $id = $_GET['id']; 
    $user = new User;
    $user->delete($id);
?>