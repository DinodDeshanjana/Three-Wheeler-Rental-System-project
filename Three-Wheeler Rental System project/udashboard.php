<?php
session_start();


if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

include'connection.php';


$loggedInUser = $_SESSION['userid'];

$sql_user = "SELECT userid, fname, lname, email FROM user WHERE userid = '$loggedInUser'";
$result_user = mysqli_query($connection, $sql_user);

if (!$result_user) {
    die("Query failed: " . mysqli_error($connection));
}

$user_data = mysqli_fetch_assoc($result_user);
$loggedInUserId = $user_data['userid'];  

$sql_booking = "SELECT bookingid, userid, pickup_district, dropoff_district, pdate, ddate,Phone_number,Passport_ID,license  FROM bookings WHERE userid = '$loggedInUserId'";
$result_booking = mysqli_query($connection, $sql_booking);

if (!$result_booking) {
    die("Query failed: " . mysqli_error($connection));
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Board</title>

    <style>

@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

body {
    
    justify-content: center;
    align-items: center;
	font-family:Poppins;
 
}

.container {
    display: flex;
    flex-direction: column;
    align-items: center;
	padding:45px;
}

h1 {
	
    text-align: center;
    margin-bottom: 20px;
}

.user-info, .booking-info {
    background-color: white;
    padding: 20px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 690px;
}
.booking-info{
	width: 1100px;
}

h2 {
	font-size:23px;
    margin-bottom: 10px;
	text-align:center;
	color:#2c272b;
	
}

p {
    margin-bottom: 5px;
	font-size:15px;
	color:#2c272b;

}

table {
    width: 100%;
    border-collapse: collapse;
	color:#2c272b;
}

table, th, td {
    border: 1px solid #ddd;
}

th, td {
    padding: 10px;
    text-align: center;
}

th {
  background-color:#9cb4f5;
}
.ebtn{
	
	padding:5px;
	font-family:Poppins;
	font-size:16px;
	width:65px;
	cursor:pointer;
	border-radius:4px;
	border-style:none;
	background-color:#4189ff;
	color:white;
}
input{
    padding: 8px;
    font-size: 16px;
    margin-bottom: 15px;
    border: 1px solid #ddd;
    border-radius: 5px;
    outline: none;
	width:50%;
}
a{
	 text-decoration:none;
     color:white;
}

    </style>
</head>
<body>


<?php include "navigation.php"?>



<div class="container">


    <div class="user-info">
        <h2>Your Profile Information</h2>
        <p><strong>First Name: </strong> <br><input type="text" value="<?php echo  $user_data['fname']; ?>" readonly></</p>
        <p><strong>Last Name: </strong><br><input type="text" value="<?php echo  $user_data['lname']; ?>" readonly></p>
        <p><strong>Email: </strong><br><input type="text" value="<?php echo  $user_data['email']; ?>" readonly> </p>
		<button class="ebtn"><a href="userupdate">Edite</a></button>
    </div>

    <div class="booking-info">
    <h2>Booking Information</h2>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Pickup Location</th>
                <th>Drop Location</th>
                <th>Pickup Date</th>
                <th>Drop Date</th>
				<th>Phone Number</th>
				<th>Passport ID</th>
				<th>license</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            if (mysqli_num_rows($result_booking) > 0) {
              
                while ($booking_data = mysqli_fetch_assoc($result_booking)) {
                    echo "<tr>";
                    echo "<td>" . $booking_data['bookingid'] . "</td>";
                    echo "<td>" . $booking_data['pickup_district'] . "</td>";
                    echo "<td>" . $booking_data['dropoff_district'] . "</td>";
                    
                    echo "<td>" . $booking_data['pdate'] . "</td>";
                    echo "<td>" . $booking_data['ddate'] . "</td>";
					echo "<td>" . $booking_data['Phone_number'] . "</td>";
					echo "<td>" . $booking_data['Passport_ID'] . "</td>";
                    echo "<td>" . $booking_data['license'] . "</td>";
					echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No bookings found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</div>
<?php include"footer.php";?>
</body>
</html>
