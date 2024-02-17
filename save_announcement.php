<?php
include('database.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $facultyname = $_POST['facultyname'];
    $lecture = $_POST['lecture'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $stmt = $db->prepare('INSERT INTO announcements (facultyname, lecture, date, time) VALUES (:facultyname, :lecture, :date, :time)');
    $stmt->bindValue(':facultyname', $facultyname, SQLITE3_TEXT);
    $stmt->bindValue(':lecture', $lecture, SQLITE3_TEXT);
    $stmt->bindValue(':date', $date, SQLITE3_TEXT);
    $stmt->bindValue(':time', $time, SQLITE3_TEXT);

     if ($stmt->execute()) {
        header('Location: main.php');
        exit; // Terminate the current script to ensure proper redirection
    } else {
        echo "Error saving announcement.";
    }
}
?>