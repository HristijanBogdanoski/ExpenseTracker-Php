<?php
session_start();
require 'jwt_helper.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = new SQLite3(__DIR__ . '/database/db.sqlite');
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindValue(':username', $username);
    $res=$stmt->execute();
    $user = $res->fetchArray(SQLITE3_ASSOC);

    if($user && password_verify($password, $user['password'])){
        $token = createJwt($user['id'],$user['username']);

        session_regenerate_id(true);
        $_SESSION['jwt'] = $token;

        header('Location: index.php');
        exit();
    }
} else{
    echo "error in login";
    exit();
}
