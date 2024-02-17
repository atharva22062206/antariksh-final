<!DOCTYPE html>
<html>
<head>
    <title>Scheduled Lectures</title>
      <style>
  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}

h2 {
    color: #fc968b;
    margin-bottom: 10px;
}

h3 {
    color: #555;
    margin-top: 20px;
    margin-bottom: 10px;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #e0e0e0;
    padding: 12px;
    text-align: left;
}

th {
    background-color: #007bff;
    color: #fff;
}

tr:hover {
    background-color: #f5f5f5;
}

.no-lectures-message {
    color: #888;
    margin-top: 20px;
}

a {
    text-decoration: none;
    color: #007bff;
}

a:hover {
    text-decoration: underline;
}

td a {
    color: #dc3545;
}

td a:hover {
    text-decoration: none;
    color: #bd2130;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
}

th, td {
    border: 1px solid #e0e0e0;
    padding: 12px;
    text-align: center; /* Center-align the content */
}

th {
    background-color: #F85846;
    color: #fff;
}
</style>

  
</head>
<body>
<?php
include('database.php');

function displayAnnouncementsByCalendar() {
    global $db;

    $result = $db->query('SELECT * FROM announcements ORDER BY date, time');

    if ($result) {
        $currentMonth = null;
        $currentWeek = null;
        $currentDay = null;

        // Initialize an empty calendar array
        $calendar = [];

        while ($row = $result->fetchArray()) {
            $date = strtotime($row['date']);
            $month = date('F Y', $date);
            $weekInMonth = ceil(date('d', $date) / 7); // Calculate week number within the month
            $day = date('l', $date);

            // Initialize the calendar array for the current month and week
            if (!isset($calendar[$month][$weekInMonth])) {
                $calendar[$month][$weekInMonth] = [];
            }

            // Add the announcement to the corresponding day
            $calendar[$month][$weekInMonth][$day][] = [
                'facultyname' => htmlspecialchars($row['facultyname']),
                'lecture' => htmlspecialchars($row['lecture']),
                'date' => htmlspecialchars($row['date']),
                'time' => htmlspecialchars($row['time']),
                'id' => $row['id']
            ];
        }

    // ...

foreach ($calendar as $month => $weeks) {
    echo '<h2>' . $month . '</h2>';

    foreach ($weeks as $weekInMonth => $days) {
        echo '<h3>Week ' . $weekInMonth . '</h3>';
        echo '<table>';
        echo '<tr><th>Day</th><th>Faculty</th><th>Lecture</th><th>Date</th><th>Time</th><th>Action</th></tr>';

        foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $dayOfWeek) {
            if (isset($days[$dayOfWeek])) {
                $firstAnnouncementPrinted = false;

                foreach ($days[$dayOfWeek] as $announcement) {
                    echo '<tr>';

                    // Display the day column only for the first announcement
                    if (!$firstAnnouncementPrinted) {
                        echo '<td rowspan="' . count($days[$dayOfWeek]) . '">' . $dayOfWeek . '</td>';
                        $firstAnnouncementPrinted = true;
                    }

                    echo '<td>' . $announcement['facultyname'] . '</td>';
                    echo '<td>' . $announcement['lecture'] . '</td>';
                    echo '<td>' . $announcement['date'] . '</td>';
                    echo '<td>' . $announcement['time'] . '</td>';
                    echo '<td><a href="delete_announcement.php?id=' . $announcement['id'] . '" onclick="return confirm(\'Are you sure you want to delete this announcement?\')">Delete</a></td>';
                    echo '</tr>';
                }
            } else {
                // Display empty cells for days without announcements
                echo '<tr>';
                echo '<td>' . $dayOfWeek . '</td>';
                echo '<td colspan="4"></td>';
                echo '</tr>';
            }
        }

        echo '</table>';
    }
}

// ...


        echo '</table>';
    }
}




// Call the function to display announcements by calendar
displayAnnouncementsByCalendar();
?>
