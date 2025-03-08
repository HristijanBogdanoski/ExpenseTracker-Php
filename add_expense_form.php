<?php
session_start();
require 'jwt_helper.php';

if(!isset($_SESSION['jwt']) || !decodeJwt($_SESSION['jwt'])){
    header('Location: login.php');
    exit;
}
?>

<body>
<form action="add_expense.php" method="post">
    <label for="name"> Name: </label>
    <input type="text" name="name" id="name">
    <label for="date"> date: </label>
    <input type="date" name="date" id="date">
    <label for="amount"> amount: </label>
    <input type="number" name="amount" id="amount">
    <label for="pamynet_method"> Payment method: </label>
    <input type="text" name="pamynet_method" id="pamynet_method">

    <button type="submit">Add Expense</button>
</form>
</body>