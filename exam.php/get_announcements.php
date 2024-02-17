<?php
include('database.php');

$result = $db->query('SELECT * FROM announcements');
$lectures = array();
while ($row = $result->fetchArray()) {
    $lectures[] = $row;
}
echo json_encode($lectures);
?>
