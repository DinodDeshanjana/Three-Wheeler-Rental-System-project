<?php

include 'connection.php';

$users_query = "SELECT userid, fname, lname, email FROM user";
$users_result = mysqli_query($connection, $users_query);
if (!$users_result) {
    die("Error fetching users: " . mysqli_error($connection));
}


if (isset($_GET['delete_user'])) {
    $userId = $_GET['delete_user'];

   
    $districts_query = "SELECT dropoff_district FROM bookings WHERE userid = $userId";
    $districts_result = mysqli_query($connection, $districts_query);

    if ($districts_result && mysqli_num_rows($districts_result) > 0) {
        
        while ($district_data = mysqli_fetch_assoc($districts_result)) {
            $dropoff_district = $district_data['dropoff_district'];
            
           
            $update_vehicle_query = "
                UPDATE vehicles 
                SET available_tuktuk = available_tuktuk + 1 
                WHERE district = '$dropoff_district'
            ";
            mysqli_query($connection, $update_vehicle_query);
        }
    }

    // Delete user's bookings
    $delete_bookings_query = "DELETE FROM bookings WHERE userid = $userId";
    mysqli_query($connection, $delete_bookings_query);

    // Delete the user
    $delete_user_query = "DELETE FROM user WHERE userid = $userId";
    $delete_user_result = mysqli_query($connection, $delete_user_query);

    if ($delete_user_result) {
       
        header("Location: adminusers.php");
        exit();
    } else {
        die("Error deleting user: " . mysqli_error($connection));
    }
}

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
        h2 {
            text-align: left;
            margin-bottom: 20px;
			font-family:Poppins;
			color:#32413d;
			font-size:26px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 40px;
			
        }
        table, th, td {
			font-family:Poppins;
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            
        }
        th {
			text-align: center;
           background-color:#9cb4f5;
            color: white;
        }
        .btn-delete {
			
            background-color:#fe5959;
            color: white;
            padding: 5px 10px;
            text-decoration: none;
            border-radius: 4px;
        }
     
		
	
    </style>
</head>
<body>

    <?php include 'adminnavigation.php'; ?>


    <div class="container">
       

        <h2>Users</h2>
<table>
    <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Action</th> 
    </tr>
    <?php while ($user = mysqli_fetch_assoc($users_result)) { ?>
        <tr>
            <td style="font-weight:bold"><?php echo $user['userid']; ?></td>
            <td><?php echo $user['fname']; ?></td>
            <td><?php echo $user['lname']; ?></td>
            <td><?php echo $user['email']; ?></td>
            <td><a href="adminusers.php?delete_user=<?php echo $user['userid']; ?>" class="btn-delete">Delete</a></td> 
        </tr>
    <?php } ?>
</table>

    </div>
</body>
</html>
