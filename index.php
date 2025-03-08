<?php

session_start();
require 'jwt_helper.php';

if (!isset($_SESSION['jwt']) || !decodeJwt($_SESSION['jwt'])) {
    header('Location: login.php');
    exit;
}

$db = new Sqlite3(__DIR__ . '/database/db.sqlite');
$query = "SELECT * FROM expenses";
$result = $db->query($query);

if(!$result) {
    die("Error: " . $db->lastErrorMsg());

}
?>

<div>
    <a href="add_expense_form.php">
        Add expense
    </a>
    <a href="logout_handler.php">
        Logout
    </a>
</div>
<table>
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Payment Method</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php if($result):?>
        <?php while($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['date']); ?></td>
                <td><?php echo htmlspecialchars($row['amount']); ?></td>
                <td><?php echo htmlspecialchars($row['payment_method']); ?></td>
                <td>
                    <form action="delete_expense.php" method="post" style="...">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Delete</button>
                    </form>
                    <form action="update_expense_form.php" method="get" style="...">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                        <button type="submit">Update</button>
                    </form>
                </td>
            </tr>
        <?php endwhile;?>
    <?php endif;?>
    </tbody>
</table>
