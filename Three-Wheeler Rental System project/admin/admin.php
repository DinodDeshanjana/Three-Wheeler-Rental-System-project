
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
	<style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

.card a{
	font-size:23px;
	font-family:Poppins;
	text-decoration:none;
	font-weight:bold;
	color:white;
}
.card button{
	border-style:none;
	border-radius:9px;
	padding:17px;
	width:auto;
	height:110px;

}
.card{
	align-items:center;
	display:flex;
	justify-content:center;
	padding-top:80px;
	gap:40px;
}

h1{
	font-family:Poppins;
	text-align:center;
	padding-top:80px;
	color:#32413d;
}
.btn1{
	background-color:#b084f8;
}
.btn2{
	background-color:#45fd82;
}
.btn3{
	background-color:#f380ff;
}
hr{
	width:50%;
	margin:0 auto;
	height:2px;
	background-color:#333;
	border-style:none;
}
</style>

</head>

<body>

<?php include 'adminnavigation.php'; ?>

<h1>Welcome to Admin Dashboard</h1><br>
<hr>
<div class="card">
<button class="btn1"> <a href="adminavalability.php">Availability Tuk Tuk</a></button>
<button class="btn2"> <a href="adminusers.php">Users Details</a></button>
<button class="btn3"> <a href="adminbooking.php">Users Tuk Tuk Booking <br>Detials</a></button>
</div>

</body>

</html>