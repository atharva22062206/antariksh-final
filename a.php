<!DOCTYPE html>
<html>
<head>
    <title>Scheduled Lectures</title>
    <style> 
     
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f5f9; /* Light blue background */
            color: #333; /* Dark gray text */
        }

        h2 {
            text-align: center;
            margin-top: 20px;
            color: #0080ff; /* Blue color for headings */
        }

        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
        }

        th, td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #0080ff; /* Light gray background for table headers */
        }

        .no-lectures-message {
            text-align: center;
            color: #0080ff; /* Blue color for no lectures message */
        }

        /* Add your CSS styles for the logo */
        .logo {
            display: inline-block;
            vertical-align: middle;
            margin-right: 10px;
            width: 200px; /* Adjust the width to make the logo smaller */
            height: auto; /* Maintain aspect ratio */
        }
    </style>
    

  
</head>
<body>
    <img src="logo1.png" alt="Your Logo" class="logo">
<?php

include('database.php');

function displayTodaysAnnouncements() {
    global $db;

    $today = date('Y-m-d');
    $result = $db->query("SELECT * FROM announcements WHERE date = '$today' ORDER BY time");

    if ($result) {
        echo '<h2>Today\'s Lectures</h2>';
        echo '<table>';
        echo '<tr><th>Faculty</th><th>Lecture</th><th>Date</th><th>Time</th></tr>';

        while ($row = $result->fetchArray()) {
            echo '<tr>';
            echo '<td>' . htmlspecialchars($row['facultyname']) . '</td>';
            echo '<td>' . htmlspecialchars($row['lecture']) . '</td>';
            echo '<td>' . htmlspecialchars($row['date']) . '</td>';
            echo '<td>' . htmlspecialchars($row['time']) . '</td>';
           
        }

        echo '</table>';
    } else {
        echo '<p class="no-lectures-message">No announcements for today.</p>';
    }
}

// Call the function to display today's announcements
displayTodaysAnnouncements();

?>
 <script>
        // JavaScript code for text-to-speech
        function playAnnouncement(text) {
            const AudioContext = window.AudioContext || window.webkitAudioContext;
            const audioContext = new AudioContext();
            const utterance = new SpeechSynthesisUtterance(text);
            speechSynthesis.speak(utterance);

            // Play an empty sound to keep the audio context active
            const buffer = audioContext.createBuffer(1, 1, 22050);
            const source = audioContext.createBufferSource();
            source.buffer = buffer;
            source.connect(audioContext.destination);
            source.start(0);
        }

        // Keep track of the scheduled announcements
        let scheduledAnnouncement;

        // Function to retrieve scheduled lectures and play announcements
        function checkAnnouncements() {
            fetch('get_announcements.php')
                .then(response => response.json())
                .then(lecturesData => {
                    const currentTime = new Date();

                    lecturesData.forEach((lecture) => {
                        const lectureDateTime = new Date(lecture.date + ' ' + lecture.time);
                        if (lectureDateTime > currentTime) {
                            const timeToAnnounce = lectureDateTime.getTime() - currentTime.getTime();

                            // Clear any previously scheduled announcement
                            if (scheduledAnnouncement) {
                                clearTimeout(scheduledAnnouncement);
                            }

                            // Schedule the new announcement
                            scheduledAnnouncement = setTimeout(() => playAnnouncement(`next lecture ${lecture.lecture}: by${lecture.facultyname}`), timeToAnnounce);
                        }
                    });
                });
        }

        // Check for announcements every 5 seconds (adjust the interval as needed)
        setInterval(checkAnnouncements, 5000);
        </script>
        <script>
        // Your existing JavaScript code

        // Function to refresh the page every 5 seconds
        function refreshPage() {
            location.reload(true); // Reload the page from the server
        }

        // Refresh the page every 5 seconds
        setInterval(refreshPage, 5000);
    </script>
    
</body>
</html>
