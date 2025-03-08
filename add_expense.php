<?php
session_start();
require 'jwt_helper.php';
if(!isset($_SESSION['jwt']) && !isset($_SESSION['token'])){
    header('Location: index.php');
    exit;
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = $_POST["name"];
    $amount = $_POST["amount"];
    $date = $_POST["date"];
    $payment_method = $_POST["payment_method"];

    $db = new SQLite3(__DIR__ . '/database/db.sqlite');

    $stm=$db->prepare("INSERT INTO expenses (name, amount, date, payment_method) VALUES ('$name','$amount','$date','$payment_method')");
    $stm->bindValue(':name', $name);
    $stm->bindValue(':amount', $amount);
    $stm->bindValue(':date', $date);
    $stm->bindValue(':payment_method', $payment_method);

    if($stm->execute()){
        header("location: index.php");
    }else{
        echo "error adding";
    }
    $db->close();
}else{
    echo "error processing request";
}