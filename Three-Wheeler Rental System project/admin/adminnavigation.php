<?php


session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    // If not an admin, redirect to login or an error page
    header("Location: login.php");
    exit(); // Stop further execution
}

include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
	<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

*{
            margin:0px;
            padding:0px;
        }

        .contaner{
			padding:5px;
            background-color:rgb(249, 250, 255);
			display:flex;
			justify-content:space-between;
			align-items:center;
        }
        .logo img{
            width: 160px;
            padding-left:16px;
            padding-top:5px;
            padding-bottom:5px;
            cursor:pointer;
        }

        li{
            display:inline-block;
        }

        li a{
            font-family:Poppins;
            text-decoration:none;
            font-size:16px;
            list-style: none;
            color:#32413d;
            margin:15px;
            font-weight:bold;
            
        }
        .btnlog{
            font-size:17px;
            font-weight:bold;
            padding:5px;
            margin-right:20px;
            border-radius:12px;
            padding:8px;
            border-style:none;
            background-color:#b388f5;
            cursor:pointer;
        }
        .btnlog a{
            text-decoration:none;
            color:white;
        }
		
		</style>
		
		</head>
		
		<body>



    <nav class="navbar">
        <div class="contaner">
            <div class="logo">
                <a href="admin.php"><img href="index.php" src="Logo.png"></a>
            </div>
            <ul>
                <li><a href="admin.php">Home</a></li>
				<li><a href="adminavalability.php">Availability</a></li>
				<li><a href="adminusers.php">Users</a></li>
				<li><a href="adminbooking.php">Bookings</a></li>
                <?php if (isset($_SESSION['userid'])): ///user not login?>
               <button class="btnlog"><a href="../logout.php">Logout</a></button>
            
                <?php else: // user log in?>
			
                <button class="btnlog"><a href="login.php">Login</a></button>
                <?php endif; ?>
                </ul>
        </div>
    </nav>
	
	</body>