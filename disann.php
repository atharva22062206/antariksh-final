<!DOCTYPE html>
<html>
<head>
<style>
        /* ... Your existing CSS styles ... */

        /* Style the logo */
        .logo {
            text-align: center;
            margin-top: 20px; /* Adjust as needed */
        }

        /* Responsive styles for logo */
        @media (max-width: 600px) {
            .logo img {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo" width="150"> <!-- Adjust width as needed -->
    </div>
    <title>Scheduled Lectures</title>
    
    <style>
        /* Apply styles to the table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        /* Style for table header row */
        th {
            background-color: #007bff;
            color: white;
            padding: 12px;
            text-align: center;
            border-bottom: 2px solid #ddd;
            font-size: 20px; /* Increased font size for headings */
        }

        /* Alternating row colors for table rows */
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Style for table data cells */
        td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
            text-align: center;
            font-size: 18px; /* Increased font size for content */
        }

        /* Apply styles to the "No scheduled lectures" message */
        .no-lectures-message {
            margin-top: 20px;
            font-style: italic;
            color: #777;
            font-size: 18px; /* Increased font size for the message */
        }

        /* Apply styles to the page header */
        h1 {
            color: #333;
            text-align: center;
            margin-top: 20px;
            font-size: 28px; /* Increased font size for the page title */
        }

        /* Apply styles to the body */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
    <h1>Scheduled Lectures</h1>
<?php
include('database.php');

$result = $db->query('SELECT * FROM announcements');
if ($result) {
    echo '<table>';
    echo '<tr><th>Faculty</th><th>Lecture</th><th>Date</th><th>Time</th></tr>';
    while ($row = $result->fetchArray()) {
        echo '<tr>';
        echo '<td>' . $row['facultyname'] . '</td>';
        echo '<td>' . $row['lecture'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
} else {
    echo "No scheduled lectures.";
}
?>
