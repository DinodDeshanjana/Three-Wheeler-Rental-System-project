<?php
session_start();

include "connection.php";

if (isset($_POST['register'])) {
    // Get user input
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $password = $_POST['password']; 
    $role = 'user'; 

    
    $sql = "INSERT INTO user (fname, lname, email, password, role) VALUES ('$fname', '$lname', '$email', '$password', '$role')";

    if (mysqli_query($connection, $sql)) {
        
        header("Location: login.php");
        exit();
    } else {
       
        echo "Error: " . mysqli_error($connection);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0; /* Light grey background */
            display: flex;
            flex-direction: column;
			padding:0px;
        }

        .container {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .user {
            background-color: white;
            width: 320px;
            border-radius: 10px;
            padding: 30px;
            padding-right:55px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        h1 {
            font-size: 24px;
            margin-bottom: 9px;
            font-weight: 600;
            color: #333; /* Darker color for heading */
        }

        .details {
            text-align: left;
        }

        .details label {
            display: block;
            font-weight: 500;
            color: #333; /* Text color */
        }

        input {
            width: 100%;
            padding: 7px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
            background-color: #fafafa;
            font-family:Poppins;
        }

        input:focus {
            outline: none;
        }

        .btr {
            padding: 12px;
            border: none;
            background-color:  #4189ff ;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            width: 340px;
            font-size: 16px;
        }

        .btr:hover {
            background-color:  #4189ff ;
        }
		p{
			padding-top:10px;
			text-align:left;	
			font-size:17px;
		}
		p a{
			text-decoration:none;
			color:blue;
		}
    </style>
</head>
<body>

<?php include "navigation.php"?>


 <div class="container">
        <div class="user">
            <h1>User Registration</h1>
            
            <form method="POST" autocomplete="off" >
                <div class="details">
                    <label>First Name</label>
                    <input type="text" name="fname" required>
                    <label>Last Name</label>
                    <input type="text" name="lname" required>
                    <label>Email</label>
                    <input type="email" name="email" required>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button class="btr" type="submit" name="register">Register</button><br>
                <p>Already have an account?<a href="login.php">  Login</a></p>
            </form>
        </div>
    </div>
</body>
</html>
