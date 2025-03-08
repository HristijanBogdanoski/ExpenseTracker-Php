<?php

session_start();
require 'jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJwt($_SESSION['jwt'])) {
    header('Location: login.php');
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])){
    $id = $_POST["id"];
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $payment_method = $_POST["payment_method"];

    $db = new Sqlite3(__DIR__ . '/database/db.sqlite');

    $query = ("UPDATE expenses SET name = :name, amount = :amount, date = :date, payment_method = :payment_method WHERE id = :id");
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':amount', $amount);
    $stmt->bindValue(':payment_method', $payment_method);
    $stmt->execute();

    $db->close();
    header("Location: index.php");
    exit();

}else{
    echo "error in updating";
}