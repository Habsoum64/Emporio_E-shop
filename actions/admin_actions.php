<?php

session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../settings/connection.php");

if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] != 'admin') {
    echo json_encode(['success' => false, 'message' => 'Unauthorized access']);
    exit;
}

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'fetch_users') {
    fetchUsers($con);
} elseif ($action == 'delete_user') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    deleteUser($con, $user_id);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

error_reporting(E_ALL);
ini_set('display_errors', 1);

include("../settings/connection.php");

$action = isset($_POST['action']) ? $_POST['action'] : '';

if ($action == 'fetch_users') {
    fetchUsers($con);
} elseif ($action == 'delete_user') {
    $user_id = isset($_POST['user_id']) ? intval($_POST['user_id']) : 0;
    deleteUser($con, $user_id);
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid action']);
}

function fetchUsers($con) {
    $sql = "SELECT id, first_name, last_name, email, user_role FROM users";
    $result = $con->query($sql);

    if ($result === false) {
        error_log('Query Error: ' . $con->error);
        echo json_encode(['success' => false, 'message' => 'Query Error: ' . $con->error]);
        return;
    }

    $users = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = $row;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'No users found']);
        return;
    }

    $con->close();

    echo json_encode(['success' => true, 'users' => $users]);
}

function deleteUser($con, $user_id) {
    $sql = "DELETE FROM users WHERE id = ?";
    
    if ($stmt = $con->prepare($sql)) {
        $stmt->bind_param("i", $user_id);
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            error_log('Failed to delete user: ' . $stmt->error);
            echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
        }
        $stmt->close();
    } else {
        error_log('Failed to prepare statement: ' . $con->error);
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement: ' . $con->error]);
    }

    $con->close();
}
?>
