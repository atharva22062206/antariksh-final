<?php
include('database.php');

if (isset($_GET['id'])) {
    $announcementId = $_GET['id'];

    // Use prepared statements to prevent SQL injection
    $statement = $db->prepare('DELETE FROM announcements WHERE id = ?');
    $statement->bindValue(1, $announcementId, SQLITE3_INTEGER);
    
    if ($statement->execute()) {
        // Successful deletion
        header('Location: main.php');
        exit();
    } else {
        // Failed to delete
        echo "Error deleting announcement.";
    }
} else {
    // Invalid request, no announcement ID provided
    echo "Invalid request.";
}
?>

