<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $db = new SQLite3('announcements.db');
    $stmt = $db->prepare('DELETE FROM announcements WHERE id=:id');
    $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
    $stmt->execute();
}
header("Location: index.php");
?>
