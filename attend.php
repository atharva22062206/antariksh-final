<!DOCTYPE html>
<html>
<head>
    <title>Biometric Attendance System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        /* Style the embedded Google Sheet iframe */
        iframe {
            width: 100%;
            height: 500px;
            border: 1px solid #ccc;
        }

        .download-link {
            text-align: center;
            margin-top: 20px;
        }

        /* Style the download button */
        .download-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }

        .download-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Biometric Attendance System</h1>

        <!-- Embed the Google Sheet -->
        <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vQgGUeQWklaID_J3T1kBwuEz6ms56PnpHoSgMWVqW3F9S6BtwTUTe-gUcsN6XxauyDUhh4vEAvTrweW/pubhtml?gid=0&single=true"></iframe>

        <!-- Provide a styled download button -->
        <div class="download-link">
            <a href="https://docs.google.com/spreadsheets/d/e/2PACX-1vQgGUeQWklaID_J3T1kBwuEz6ms56PnpHoSgMWVqW3F9S6BtwTUTe-gUcsN6XxauyDUhh4vEAvTrweW/pub?output=xlsx" class="download-button" download>Download Data</a>
        </div>
    </div>
</body>
</html>
