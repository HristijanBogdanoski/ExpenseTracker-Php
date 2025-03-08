<?php
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["id"])){
    $id=intval($_POST["id"]);
    $db = new SQLite3(__DIR__ . '/database/db.sqlite');

    $stmt = $db->prepare("DELETE FROM expenses WHERE id = :id");
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
    $db->close();
    header('Location: index.php');
    exit();
}else{
    echo "Error deleting";
}