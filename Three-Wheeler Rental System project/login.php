<?php
session_start();


include "connection.php";

//  error variable
$error = "";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($connection, $_POST['email']); // Now using email instead of username
    $password = mysqli_real_escape_string($connection, $_POST['password']);

   
    $sql = "SELECT * FROM user WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

      
        if ($user && $password === $user['password']) {
            
            $_SESSION['email'] = $user['email']; // Store email instead of username
            $_SESSION['userid'] = $user['userid'];  // Use the actual 'userid' column
            $_SESSION['role'] = $user['role'];   // Store user role

            if (isset($_SESSION['pickup']) && isset($_SESSION['dropoff'])) {
                
                header("Location: booking.php?pickup=" . urlencode($_SESSION['pickup']) . "&dropoff=" . urlencode($_SESSION['dropoff']));
                exit();
            } else {
                
                if ($_SESSION['role'] === 'admin') {
                    header("Location: admin/admin.php"); // Admin dashboard
                } else {
                    header("Location: index.php"); // User homepage
                }
                exit();
            }
        } else {
            // Invalid password
            $error = "Invalid email or password.";
        }
    } else {
        // Invalid email
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
	
    <style>
        
		@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        body, html {
            height: 100%;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0; /* Light grey background */
            display: flex;
            flex-direction: column;
			padding:0;
		
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
            background-color:  #4189ff   ;
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
		.error{
			color:red;
		}
		
    </style>
</head>
<body>

<?php include "navigation.php"?>

<div class="container">
        <div class="user">
            <h1>User Login</h1>
            <!-- Display error message  login fails -->
            <?php if ($error): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>
            <form method="POST" autocomplete="off" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <div class="details">
                    <label>Email</label>
                    <input type="text" name="email" required>
                    <label>Password</label>
                    <input type="password" name="password" required>
                </div>
                <button class="btr" type="submit" name="login">Login</button><br>
                <p>Don't have an account?<a href="register.php">  Sign Up</a></p>
            </form>
        </div>
    </div>
</body>
</html>
