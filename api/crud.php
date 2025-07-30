<?php
include 'con_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    switch ($action) {
        case 'create':
            $stmt = $pdo->prepare("INSERT INTO t_data (name, email, phone) VALUES (?, ?, ?)");
            if ($stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone']])) {
                echo "Student added.";
            } else {
                echo "Failed to add student.";
            }
            break;

        case 'read':
            $stmt = $pdo->query("SELECT * FROM t_data ORDER BY id DESC");
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td class='name'>{$row['name']}</td>
                        <td class='email'>{$row['email']}</td>
                        <td class='phone'>{$row['phone']}</td>
                        <td>
                            <button class='update' data-id='{$row['id']}'>Update</button>
                            <button class='delete' data-id='{$row['id']}'>Delete</button>
                        </td>
                      </tr>";
            }
            break;

        case 'delete':
            $stmt = $pdo->prepare("DELETE FROM t_data WHERE id = ?");
            if ($stmt->execute([$_POST['id']])) {
                echo "Deleted successfully.";
            } else {
                echo "Delete failed.";
            }
            break;

        case 'update':
            $stmt = $pdo->prepare("UPDATE t_data SET name = ?, email = ?, phone = ? WHERE id = ?");
            if ($stmt->execute([$_POST['name'], $_POST['email'], $_POST['phone'], $_POST['id']])) {
                // For form submission from edit.php
                if (!isset($_SERVER['HTTP_X_REQUESTED_WITH'])) {
                    header("Location: index.php");
                    exit;
                }
                echo "Updated successfully.";
            } else {
                echo "Update failed.";
            }
            break;

        default:
            echo "Invalid action.";
            break;
    }
}
