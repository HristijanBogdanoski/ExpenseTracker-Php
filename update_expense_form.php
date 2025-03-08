<?php

session_start();
require 'jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJwt($_SESSION['jwt'])) {
    header('Location: login.php');
    exit;
}

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $db = new Sqlite3(__DIR__ . '/database/db.sqlite');

    $stmt = $db->prepare("SELECT * FROM expenses WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $result=$stmt->execute();
    $expense = $result->fetchArray(SQLITE3_ASSOC);
    $db->close();

} else{
    echo "Failed to get ID";
}
?>



<body>
<?php if($expense): ?>
    <form action="update_expense.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($expense['id']); ?>" />
        <label for="name">Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($expense['name']); ?>" required/>
        <br />
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo htmlspecialchars($expense['date']); ?>" required/>
        <br />
        <label for="amount">Amount:</label>
        <input type="number" name="amount" value="<?php echo htmlspecialchars($expense['amount']); ?>" required/>
        <br />
        <label for="payment_method">payment_method:</label>
        <input type="text" name="payment_method" value="<?php echo htmlspecialchars($expense['payment_method']); ?>" required/>
        <br />
        <button type="submit">Update expense</button>
    </form>
<?php endif; ?>
</body>
