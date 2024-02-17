<?php
$text = $_POST['text'];
$repeat = isset($_POST['repeat']) ? 1 : 0;
$interval = isset($_POST['interval']) ? $_POST['interval'] : null;

$db = new SQLite3('announcements.db');
$db->exec("CREATE TABLE IF NOT EXISTS announcements (id INTEGER PRIMARY KEY, text TEXT, repeat INTEGER, interval INTEGER)");

$stmt = $db->prepare('INSERT INTO announcements (text, repeat, interval) VALUES (:text, :repeat, :interval)');
$stmt->bindValue(':text', $text, SQLITE3_TEXT);
$stmt->bindValue(':repeat', $repeat, SQLITE3_INTEGER);
$stmt->bindValue(':interval', $interval, SQLITE3_INTEGER);
$stmt->execute();

header("Location: index.php");
?>
