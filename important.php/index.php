<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Announcement System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        h2 {
            color: #333;
        }

        #announcementForm {
            margin-bottom: 20px;
        }

        #announcementText {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            resize: vertical;
        }

        #intervalInput {
            width: 100px;
            margin-left: 10px;
        }

        button {
            padding: 10px 20px;
            background-color: #fc7465;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

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
            background-color: #fc7465;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }

        #repeatCheckbox {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Add Announcement</h2>
    <form id="announcementForm">
        <textarea id="announcementText" rows="4" cols="50" placeholder="Enter announcement..."></textarea><br>
        <input type="checkbox" id="repeatCheckbox"> Repeat
        <input type="number" id="intervalInput" placeholder="Repeat interval (minutes)">
        <button type="button" onclick="submitAnnouncement()">Submit</button>
    </form>

    <h2>Announcements</h2>
    <table id="announcementTable" border="1">
        <tr>
            <th>Announcement</th>
            <th>Repeat Interval</th>
            <th>Delete</th>
        </tr>
        <?php include 'view.php'; ?>
    </table>

    <script>
        
   var intervalID; // Variable to hold the interval ID for stopping later

function speak(text) {
    var speechSynthesis = window.speechSynthesis;
    if ('speechSynthesis' in window && speechSynthesis) {
        var speechText = new SpeechSynthesisUtterance(text);
        speechSynthesis.speak(speechText);
    } else {
        console.error('Speech synthesis not supported');
    }
}

function submitAnnouncement() {
    var text = document.getElementById('announcementText').value;
    var repeat = document.getElementById('repeatCheckbox').checked;
    var interval = parseInt(document.getElementById('intervalInput').value);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'process.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Reload the page to update the announcements
            location.reload(); 

            // Speak the submitted announcement
            speak(text);

            // If repeat is checked and interval is set, schedule repetition
            if (repeat && interval > 0) {
                console.log("Scheduling repetition...");
                intervalID = setInterval(function() {
                    speak(text);
                }, interval * 60 * 1000); // Convert minutes to milliseconds
            }
        }
    };
    xhr.send('text=' + encodeURIComponent(text) + '&repeat=' + repeat + '&interval=' + interval);
}


</script>

    
</body>
</html>
