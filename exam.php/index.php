
<html>
<head>
    <title>Announcement System</title>
  <h1>Exam Instruction Announcer </h1>
<style>
        body {
            background-color: #f0f5f9; /* Light blue background */
            font-family: Arial, sans-serif;
            color: #333; /* Dark gray text */
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff; /* White container background */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Box shadow */
        }

        form {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333; /* Dark gray text */
        }

        input[type="text"]{
            width: calc(100% - 1000px); /* Adjusted width */
            padding: 8px; /* Adjusted padding */
            margin-bottom: 10px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px; /* Adjusted font size */
        }
        
        input[type="date"],
        input[type="time"] {
            width: calc(100% - 1000px); /* Adjusted width */
            padding: 8px; /* Adjusted padding */
            margin-bottom: 10px;
            border: 1px solid #ccc; /* Light gray border */
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px; /* Adjusted font size */
        }

        input[type="submit"] {
            width: 30%;
            padding: 10px;
            margin-bottom: 10px;
            background-color: #F85846; /* bluee submit button */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="button"] {
            width: 300px; /* Square button size */
            height: 100px; /* Square button size */
            margin: 5px;
            background-color: #F85846; /* Blue buttons */
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px; /* Adjusted font size */
            padding: 10px; /* Adjusted padding */
            overflow-wrap: break-word; /* Allows text to wrap */
            text-align: center; /* Center-align text */
        }

        input[type="submit"]:hover,
        input[type="button"]:hover {
            background-color: #AE1706; /* Darker blue on hover */
            white-space: normal;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    
    <form action="save_announcement.php" method="post">
       

       <label for="lecture">Announcement Text:</label>
<input type="text" id="lecture" name="lecture" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <label for="time">Time:</label>
        <input type="time" name="time" required><br>

        <input type="submit" value="Save Announcement">
      



    </form>
    
      <input type="button" value="Start Exam" onclick="insertText('Start Exam', 'lecture')">
    <input type="button" value="Use of Smartphones,Smartwatches,any blank paper,Programable calculators is strictly prohibited" onclick="insertText('Use of Smartphones,Smartwatches,any blank paper,Programable calculators is strictly prohibited', 'lecture')">
<input type="button" value="Last 10 minutes" onclick="insertText('Last 10 minutes', 'lecture')">
    
   

    <h2>Upcoming Instructions</h2>
    <?php
    include('display_announcements.php');
    
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
                            scheduledAnnouncement = setTimeout(() => playAnnouncement(lecture.lecture), timeToAnnounce);
                        }
                    });
                });
        }

        // Check for announcements every 5 seconds (adjust the interval as needed)
        setInterval(checkAnnouncements, 5000);
        
</script>
<script>
    function insertText(text, inputFieldId) {
        document.getElementById(inputFieldId).value += text;
    }
</script>

</body>
</html>
