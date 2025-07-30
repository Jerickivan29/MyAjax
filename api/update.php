<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}

include 'con_db.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM t_data WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "Student not found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Student</title>
</head>
<body>
    <h2>Edit Student</h2>
    <form method="post" action="code.php">
        <input type="hidden" name="action" value="update">
        <input type="hidden" name="id" value="<?= htmlspecialchars($id) ?>">
        <input type="text" name="name" value="<?= htmlspecialchars($data['name']) ?>" placeholder="Name"><br>
        <input type="text" name="email" value="<?= htmlspecialchars($data['email']) ?>" placeholder="Email"><br>
        <input type="text" name="phone" value="<?= htmlspecialchars($data['phone']) ?>" placeholder="Phone"><br>
        <button type="submit">Update</button>
        <button type="button" onclick="window.location.href='index.php'">Cancel</button>
    </form>
</body>
</html>
