<?php
session_start();

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $db = new SQLite3(__DIR__ . '/database/db.sqlite');
    $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");

    try {
        $stmt->bindValue(':username', $username);
        $stmt->bindValue(':password', $hashedPassword);
        $stmt->execute();
        echo "New record created successfully";
    } catch(PDOException $e) {
        echo $e->getMessage();
    }

}

