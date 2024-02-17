<!DOCTYPE html>
<html>
<head>
    <title>Scheduled Lectures</title>
    <style>
    table {
    width: 100%;
    border-collapse: collapse;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

tr:nth-child(even) {
    background-color: #f2d0d0;
}

tr:hover {
    background-color: #ddd;
}

h2 {
    font-size: 24px;
    margin-top: 20px;
}

h3 {
    font-size: 20px;
    margin-top: 10px;
    margin-bottom: 5px;
}

/* Style for delete links */
td a[href*="delete_announcement.php"] {
    color: red;
    font-weight: bold;
    text-decoration: none;
}

td a[href*="delete_announcement.php"]:hover {
    text-decoration: underline;
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
        echo '<tr><th>Day</th><th>Lecture</th><th>Date</th><th>Time</th><th>Action</th></tr>';

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
