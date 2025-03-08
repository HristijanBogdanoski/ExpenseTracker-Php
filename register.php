<?php
session_start();
require 'jwt_helper.php';

if(isset($_SESSION['jwt'])){
    $decoded = decodeJwt($_SESSION['jwt']);
    if($decoded){
        header('Location: index.php');
        exit;
    }
}
?>
<form action="register_handler.php" method="post">
    <label for="username">Username</label>
    <input type="text" name="username" id="username">

    <label for="password">Password</label>
    <input type="password" name="password" id="password">

    <button type="submit">Register</button>
</form>