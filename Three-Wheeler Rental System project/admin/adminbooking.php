<?php


include 'connection.php';


$bookings_query = "SELECT bookingid, userid, pickup_district, dropoff_district, pdate, ddate,phone_number,Passport_ID,license FROM bookings";
$bookings_result = mysqli_query($connection, $bookings_query);
if (!$bookings_result) {
    die("Error fetching bookings: " . mysqli_error($connection));
}



if (isset($_GET['complete_booking'])) {
    $bid = $_GET['complete_booking'];

    $district_query = "SELECT dropoff_district FROM bookings WHERE bookingid = $bid";
    $district_result = mysqli_query($connection, $district_query);

    if ($district_result && mysqli_num_rows($district_result) > 0) {
        $district_data = mysqli_fetch_assoc($district_result);
        $dropoff_district = $district_data['dropoff_district'];

        // Delete the booking
        $delete_query = "DELETE FROM bookings WHERE bookingid = $bid";
        $delete_result = mysqli_query($connection, $delete_query);

        if ($delete_result) {
            
            $update_vehicle_query = "
                UPDATE vehicles 
                SET available_tuktuk = available_tuktuk + 1 
                WHERE district = '$dropoff_district'
            ";
            mysqli_query($connection, $update_vehicle_query);

           
            header("Location: adminbooking.php");
            exit();
        } else {
            die("Error deleting booking: " . mysqli_error($connection));
        }
    } else {
        die("Error fetching dropoff district: " . mysqli_error($connection));
    }
}



//complete

if (isset($_GET['delete_booking'])) {
    $bid = $_GET['delete_booking'];

    $district_query = "SELECT pickup_district FROM bookings WHERE bookingid = $bid";
    $district_result = mysqli_query($connection, $district_query);

    if ($district_result && mysqli_num_rows($district_result) > 0) {
        $district_data = mysqli_fetch_assoc($district_result);
        $pickup_district = $district_data['pickup_district'];

        // Delete the booking
        $delete_query = "DELETE FROM bookings WHERE bookingid = $bid";
        $delete_result = mysqli_query($connection, $delete_query);

        if ($delete_result) {
            
            $update_vehicle_query = "
                UPDATE vehicles 
                SET available_tuktuk = available_tuktuk + 1 
                WHERE district = '$pickup_district'
            ";
            mysqli_query($connection, $update_vehicle_query);

           
            header("Location: adminbooking.php");
            exit();
        } else {
            die("Error deleting booking: " . mysqli_error($connection));
        }
    } else {
        die("Error fetching dropoff district: " . mysqli_error($connection));
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
            width: 90%;
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
            text-align: center;
			
        }
        th {
			
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
       

      


        <h2>Users Bookings</h2>
        <table>
            <tr>
				<th>User ID</th>
                <th>Booking ID</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>Pickup Date</th>
                <th>Drop Date</th>
				<th>Phone Number</th>
				<th>Passport ID</th>
				<th>license</th>
                <th>Action</th>
            </tr>
            <?php while ($booking = mysqli_fetch_assoc($bookings_result)) { ?>
                <tr>
					<td style="font-weight:bold"><?php echo $booking['userid']; ?></td>
                    <td><?php echo $booking['bookingid']; ?></td>
                    <td><?php echo $booking['pickup_district']; ?></td>
                    <td><?php echo $booking['dropoff_district']; ?></td>
                    <td><?php echo $booking['pdate']; ?></td>
                    <td><?php echo $booking['ddate']; ?></td>
					<td><?php echo $booking['phone_number']; ?></td>
					<td><?php echo $booking['Passport_ID']; ?></td>
					<td><?php echo $booking['license']; ?></td>
                    <td><a href="adminbooking.php?complete_booking=<?php echo $booking['bookingid']; ?>" class="btn-delete">Complete</a>
                    <a href="adminbooking.php?delete_booking=<?php echo $booking['bookingid']; ?>" class="btn-delete">Delete</a>
                </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
</html>
