<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Bar</title>

    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
            margin:0px;
            padding:0px;
        }

        .contaner{
            background-color:rgb(249, 250, 255);
			display:flex;
			justify-content:space-between;
			align-items:center;
			padding:3px;
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
            font-size:18px;
            font-weight:bold;
            padding:7.5px;
            margin-right:20px;
            border-radius:19px;
            border-style:none;
			background-color:#b388f5   ;
            /*background-color:#3ef632;*/
            cursor:pointer;
        }
        .btnlog a{
			padding:7px;
            text-decoration:none;
            color:white;
			font-weight:bold;
        }
    </style>
</head>
<body>
    

    <nav class="navbar">
        <div class="contaner">
            <div class="logo">
                <a href="index.php"><img href="index.php" src="Logo.png"></a>
            </div>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="details.php">Details</a></li>
                <li><a href="index.php">Booking</a></li>
                <li><a href="about.php">About US</a></li>
                <?php if (!isset($_SESSION['userid'])): ///user not login?>
                <button class="btnlog"><a href="login.php">Login</a></button>
                <button class="btnlog"><a href="register.php">Signup</a></button>
            
                <?php else: // user log in?>
				<button class="btnlog"><a href="udashboard.php">Account</a></button>
                <button class="btnlog"><a href="logout.php">Logout</a></button>
                <?php endif; ?>
                </ul>
        </div>
    </nav>
</body>
</html>