<?php
// Create a SQLite database and table for announcements
$db = new SQLite3('announcements.db');
$db->exec('CREATE TABLE IF NOT EXISTS announcements (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    facultyname TEXT NOT NULL,
    lecture TEXT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL
)');
?>
