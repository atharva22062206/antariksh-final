  
 

<html>
<head>
    <title>Announcement System</title>
   
     <style>
      /* Reset default margin and padding for elements */
body, h1, h2, form, label, input, button {
    margin: 0;
    padding: 0;
}

/* Set a background color for the body */
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

/* Style the header */
h1 {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: white;
}

/* Style the form */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="text"],
input[type="date"],
input[type="time"],
input[type="submit"],
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

input[type="submit"],
button {
    background-color: #333;
    color: white;
    cursor: pointer;
}

/* Style the scheduled lectures button */
.scheduled-lectures button {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

/* Style the container */
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style the lecture boxes */
.lecture-box {
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 5px;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px;
}

/* Style the scheduled lectures tab */
.scheduled-lectures {
    text-align: center;
    margin-top: 10px;
}

/* Style the open lectures button */
.scheduled-lectures button {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
}

/* Responsive styles */
@media (max-width: 600px) {
    form {
        max-width: 100%;
    }
}
body, h1, h2, form, label, input, button {
    margin: 0;
    padding: 0;
}

/* Set a background color for the body */
body {
    background-color: #f2f2f2;
    font-family: Arial, sans-serif;
}

/* Style the header */
h1 {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: white;
    font-size: 28px; /* Increased font size */
}

/* Style the form */
form {
    max-width: 400px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style form labels */
label {
    display: block;
    margin-bottom: 8px; /* Slightly reduced margin */
    font-weight: bold;
}

/* Style form input elements */
input[type="text"],
input[type="date"],
input[type="time"],
input[type="submit"],
button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
}

/* Style submit button */
input[type="submit"],
button {
    background-color: #F85846; /* Blue color */
    color: white;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

/* Darker background color on hover */
input[type="submit"]:hover,
button:hover {
    background-color: #0056b3;
}

/* Style the container */
.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
}

/* Style the scheduled lectures button */
.scheduled-lectures {
    text-align: center;
    margin-top: 20px; /* Increased margin */
}

/* Style the open lectures button */
.scheduled-lectures button {
    background-color: #007bff;
    color: white;
    padding: 8px 16px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

/* Darker background color on hover */
.scheduled-lectures button:hover {
    background-color: #0056b3;
}
</style>

</head>
<body>
    
    <form action="save_announcement.php" method="post">
        <label for="facultyname">Faculty Name:</label>
        <input type="text" name="facultyname" required><br>

        <label for="lecture">Lecture:</label>
        <input type="text" name="lecture" required><br>

        <label for="date">Date:</label>
        <input type="date" name="date" required><br>

        <label for="time">Time:</label>
        <input type="time" name="time" required><br>

        <input type="submit" value="Save Announcement">
    </form>
    
    
   

    <h2>Scheduled Lectures</h2>
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
                            scheduledAnnouncement = setTimeout(() => playAnnouncement(`next lecture ${lecture.lecture}: by${lecture.facultyname}`), timeToAnnounce);
                        }
                    });
                });
        }

        // Check for announcements every 5 seconds (adjust the interval as needed)
        setInterval(checkAnnouncements, 5000);
    </script>
  
</body>
</html>
