<?php
session_start();

// Hardcoded username and password pairs
$users = array(
    'user1' => 'password1',
    'user2' => 'password2',
    'atharva' => 'admin',
    'raj' => 'admin'
);

// Check if the user is already logged in
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome</title>
    </head>
    <body>
        <h1>Welcome, <?php echo $username; ?>!</h1>
        <p>This is your personalized dashboard.</p>
        <!-- Add more HTML content as needed -->
        <a href="welcome.php?action=logout">Logout</a>
    </body>
    </html>
    <?php
    exit; // Terminate script execution after displaying welcome message
} else {
    // Check if the form is submitted
    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Check if the username and password are valid
        if(array_key_exists($username, $users) && $users[$username] === $password) {
            $_SESSION['username'] = $username;
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Welcome</title>
            </head>
            <body>
                <!--<h1>Welcome, <?php echo $username; ?>!</h1>-->
                <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Antariksh</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  

  <style>
    body { 
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
      margin: 0; 
      padding: 0; 
      background-color: #ffffff; /* Changed background color to white */
      color: #333; /* Changed text color to a darker shade */
    }
     .logout-link {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            border: 1px solid #4CAF50;
        }

        /* Hover effect for the logout link */
        .logout-link:hover {
            background-color: #45a049;
            border-color: #45a049;
        }
    nav { 
      width: 250px; 
      background-color: #2980b9; 
      padding: 20px; 
      box-sizing: border-box; 
      float: left; 
      height: 100vh; 
      text-align: center; /* Center align the content */
    }
    nav img { 
      max-width: 100px; /* Adjust the size of your logo */
      margin-top: 10px; /* Adjust the margin as needed */
    }
    nav a { 
      display: block; 
      color: #fff; 
      text-decoration: none; 
      padding: 10px; 
      margin-bottom: 10px; 
      background-color: #3498db; /* Changed nav link background color to a lighter blue shade */
      border-radius: 5px; 
      transition: background-color 0.3s ease, transform 0.2s ease; 
    }
    nav a i { 
      margin-right: 10px; 
    }
    nav a:hover { 
      background-color: #2c3e50; /* Changed nav link background color on hover to a darker shade */
      transform: scale(1.05); /* Added a slight scale effect on hover */
    }
    section { 
      padding: 20px; 
      box-sizing: border-box; 
      position: relative; 
      overflow: hidden; /* Add overflow property to handle iframes */
    }
    iframe { 
      width: 100%; 
      height: 700px; 
      border: 0; 
      border-radius: 5px;
    }
    .middle-content {
      text-align: center;
      margin: 100px auto; /* Adjust margin as needed */
    }
    .middle-content img {
      max-width: 500px; /* Adjust the size of your image */
      margin-bottom: 20px; /* Adjust spacing between image and text */
    }
    .middle-content p {
      font-family: 'Times New Roman', Times, serif;
      font-size: 60px; /* Adjust font size as needed */
    }

    @media screen and (max-width: 768px) {
      nav {
        width: 100%; /* Make the navigation bar take full width on smaller screens */
        height: auto; /* Allow the height to adjust based on content */
        float: none; /* Remove the float */
      }
      
      section {
        margin-left: 0; /* Reset the margin */
      }

      .middle-content {
        margin: 50px auto; /* Adjust the margin for smaller screens */
      }

      .middle-content p {
        font-size: 24px; /* Adjust the font size for smaller screens */
      }

      .middle-content img {
        max-width: 80%; /* Adjust the maximum width of the image relative to its container */
      }
      
    }
    /* Logout button styles */
a.logout {
    display: block;
    background-color: #bd3615;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    width: fit-content;
    clear: both; /* Ensure it's below other elements */
    float: none; /* Reset float */
}

a.logout:hover {
    background-color: #444;
}


  </style>
 <!-- <style>
 
      /* Reset CSS */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
    margin: 0;
    padding: 0;
}

h1, h2 {
    text-align: center;
    margin-bottom: 20px;
}

form {
    width: 300px;
    margin: 0 auto;
}

form input[type="text"],
form input[type="password"],
form input[type="submit"] {
    width: 100%;
    padding: 10px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

a {
    display: block;
    text-align: center;
    margin-top: 20px;
    text-decoration: none;
    color: #333;
}

a:hover {
    color: #666;
}

/* Navigation */
nav {
    background-color: #333;
    overflow: hidden;
}

nav a {
    float: left;
    display: block;
    color: white;
    text-align: center;
    padding: 14px 20px;
    text-decoration: none;
}

nav a:hover {
    background-color: #ddd;
    color: #333;
}

/* Content Section */
section {
    margin-top: 20px;
    display: flex;
    justify-content: center;
}

.middle-content {
    text-align: center;
}

/* Iframe container styles */
#iframe-container {
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 5px;
    overflow: hidden; /* Hide any overflow content */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Add a subtle shadow */
}

iframe {
    width: 100%; /* Make sure the iframe fills its container */
    height: 500px; /* Make sure the iframe fills its container */
    border: none; /* Remove default border */
}

/* Logout button styles */
a.logout {
    display: block;
    background-color: #333;
    color: #fff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 20px;
    width: fit-content;
}

a.logout:hover {
    background-color: #444;
}


  </style>-->

  
  
</head>
<body>
    <!--<a href="welcome.php?action=logout">Logout</a>-->
    

  <header></header>
  <nav> 
    <a href="welcome.php?action=logout" class="logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
    <a href="#" onclick="showContent('admin')"><i class="fas fa-users"></i> Admin</a>
    <a href="#" onclick="showContent('exam')"><i class="fas fa-clipboard"></i> Exam</a>
    <a href="#" onclick="showContent('important')"><i class="fas fa-exclamation-triangle"></i> Important</a>
    <a href="#" onclick="showContent('display')"><i class="fas fa-tv"></i> Display</a>
   <a href="#" onclick="showContent('attendance')"><i class="fas fa-calendar-check"></i> Attendance</a>
    
  </nav>
  <section>
    <div class="middle-content">
      <img src="logo1.png" alt="Image">
      <p>Welcome to the Admin Panel of Antariksh</p>
    </div>
    <iframe id="content" src="" frameborder="0"></iframe>
  </section>
  <div id="iframe-container">
    <iframe id="content" src="" frameborder="0"></iframe>
</div>
  <script>
    function showContent(contentType) {
      var iframe = document.getElementById('content');
      iframe.style.display = "block"; // Show the iframe when a button is clicked
      var middleContent = document.querySelector('.middle-content');
      middleContent.style.display = "none"; // Hide the middle content when a button is clicked
      switch (contentType) {
        case 'admin': iframe.src = 'main.php'; break;
        case 'exam': iframe.src = 'exam.php'; break;
        case 'important': iframe.src = 'important.php'; break;
        case 'display': iframe.src = 'a.php'; break;
        case 'attendance': iframe.src = 'attend.php'; break;
        default: // Handle default case or leave it empty
      }
    }
  </script>

                
            </body>
            </html>
            <?php
            exit; // Terminate script execution after displaying welcome message
        } else {
            echo "Invalid username or password. Please try again.";
            echo "<br><a href='welcome.php'>Back to Login</a>";
        }
    } else {
        // Display login form if not logged in
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
        
    </style>
        </head>
        <body>
            
            <form method="post" action="welcome.php">
                Username: <input type="text" name="username"><br>
                Password: <input type="password" name="password"><br>
                <input type="submit" value="Login">
            </form>
        </body>
        </html>
        <?php
    }
}

// Handle logout
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    // Unset all of the session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to login page
    header("Location: welcome.php");
    exit;
}
?>
