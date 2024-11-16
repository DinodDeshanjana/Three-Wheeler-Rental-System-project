<?php


include 'connection.php';

$district = "SELECT * FROM vehicles";
$result = mysqli_query($connection,$district);


?>


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
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
			font-family:Poppins;
			color:#32413d;
			font-size:28px;
        }
        table {
			
            width: 50%;
			margin-left:25%;
            border-collapse: collapse;
            margin-bottom: 40px;
        }
        table, th, td {
			font-size:18px;
			font-family:Poppins;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: center;
			
        }
        th {
			
			background-color:#9cb4f5;
            color: white;
        }
        .ubtn{
			padding:8px;
			font-family:Poppins;
			font-size:15px;
			border-style:none;
			cursor:pointer;
			margin-left:25%;
			background-color:#4189ff;
			color:white;
			border-radius:4px;
			
			
		}
		.ubtn a{
            text-decoration:none;
            color:white;
        }


	</style>
</head>

<body>

<?php include 'adminnavigation.php'; ?>

<br><br>
<h1>Tuk Tuk Availability</h1>

<table>
    <tr>
        <th>District</th>
        <th>Available Tuk Tuk</th>
    </tr>
    <?php while($vehicle = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?php echo $vehicle['district']; ?></td>
            <td><?php echo $vehicle['available_tuktuk']; ?></td>
        </tr>
    <?php } ?>
	
</table>
<button class="ubtn"> <a href="adminupdateava.php">Update Availability</a></button>

</body>