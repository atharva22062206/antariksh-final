<?php
$db = new SQLite3('announcements.db');
$results = $db->query('SELECT * FROM announcements');

while ($row = $results->fetchArray()) {
    echo '<tr>';
    echo '<td>' . $row['text'] . '</td>';
    echo '<td>' . ($row['repeat'] ? $row['interval'] . ' minutes' : 'No repeat') . '</td>';
    echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
    echo '</tr>';
}
?>
