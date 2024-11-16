<?php

session_start();

//  pickup and dropoff variables
$pickup = isset($_GET['pickup']) ? $_GET['pickup'] : (isset($_SESSION['pickup']) ? $_SESSION['pickup'] : null);
$dropoff = isset($_GET['dropoff']) ? $_GET['dropoff'] : (isset($_SESSION['dropoff']) ? $_SESSION['dropoff'] : null);

$conn = mysqli_connect("localhost", "root", "", "tuktuk_booking");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// user is not logged in, login page and save the current request
if (!isset($_SESSION['userid'])) {
    if ($pickup && $dropoff) {
        $_SESSION['pickup'] = $pickup;
        $_SESSION['dropoff'] = $dropoff;
    }
    header("Location: login.php?redirect=" . urlencode($_SERVER['REQUEST_URI']));
    exit();
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pickup = $_POST['pickup'];
    $dropoff = $_POST['dropoff'];
    $userid = $_SESSION['userid'];
    $Pdate = $_POST['pdate'];
    $Ddate = $_POST['ddate'];
	$Phone_number = $_POST['Phone_number'];
	$Passport_ID = $_POST['Passport_ID'];
	$license = $_POST['license'];

    // Check available tricycles in the pickup district
    if (isset($_POST['Submit'])) {
        // Update vehicle availability
        $update_sql = "UPDATE vehicles SET available_tuktuk = available_tuktuk - 1 WHERE district = '$pickup'";
        mysqli_query($conn, $update_sql);

        // Insert booking into the database
        $insert_sql = "INSERT INTO bookings (userid, pickup_district, dropoff_district, pdate, ddate,Phone_number,Passport_ID,license) 
                       VALUES ('$userid', '$pickup', '$dropoff', '$Pdate', '$Ddate','$Phone_number','$Passport_ID','$license')";
        $result = mysqli_query($conn, $insert_sql);
        if ($result) {
            header("Location: udashboard.php");
            exit();
        } else {
            echo "No tricycles available for booking from $pickup.";
        }
    }
	
	if (!$pickup || !$dropoff) {
	header("location: index.php");
    echo "Pickup and Dropoff locations are required.";
    exit();
}
}

?>
  <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuk Tuk Booking</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap');

        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* Body styling */
        body {
            background-color: #f7f7f7;
        }

        /* Navigation styling */
        nav {
          
           margin:5px;
            background-color: #ff5722;
            color: #fff;
            text-align: center;
            
        }

        /* Container styling */
        .booking-container {
            width: 90%;
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            display: flex;
            overflow: hidden;
        }

        /* Left Side: Image and Details */
        .left-side {
            flex: 1;
            background-color: #f9f9f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }

        .left-side img {
            width: 350px;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .left-side h2 {
            font-size: 22px;
            color: #333;
            margin-bottom: 10px;
            text-align:Left;
        }

        .left-side p {
            color: #666;
            line-height: 1.6;
            text-align: Left;
			font-size:16px;
        }

        /* Right Side: Booking Form */
        .right-side {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background-color: #fff;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
        }

        .booking-form label {
            font-size: 15px;
            color: #333;
            margin-bottom: 5px;
        }

        .booking-form input,
        .booking-form select {
            padding: 10px;
            font-size: 14px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            outline: none;
        }

        .booking-form button {
            padding: 12px;
            font-size: 16px;
            color: #fff;
            background-color: #ff5722;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .booking-form button:hover {
            background-color: #e64a19;
        }
		.booking-container .btnr{
			margin-Right:308px;
			padding:10px;
			background-color:#4189ff;
			border-radius:4px;
			border-style:none;
			color:white;
			cursor:pointer;
			font-size:15px;
		}
		
    </style>
</head>
<body>

    
    <?php include "navigation.php" ?>

   
    <div class="booking-container">
        
        <div class="left-side">
            <img src="image/btuktuk.png" alt="Tuk Tuk Rental">
            <h2>Bajaj RE SP Three Wheeler</h2>
            <p>Bajaj RE  is the leading model for the RE portfolio. <br>It's highly compact and easy to park and manoeuver on the roads whilst carrying  three passengers and extra load without breaking a sweat.
			<br><br>In addition to the special safety features such as the Safety Rubber Cover, Seat Belt, Grab handles, RHS Safety Fence and Cover Joint Plate, Bajaj RE SP is equipped with following upgraded features </p><br>
		<button class="btnr"><a href="details.php" style="text-decoration:none; color:white">Read More</a></button>
        </div>

        <!-- Right Side Booking Form -->
        <div class="right-side">
    <form class="booking-form" action="booking.php" method="POST">
        <label for="pickup">Pickup District:</label>
        <input type="text" name="pickup" value="<?php echo htmlspecialchars($pickup); ?>" readonly>

        <label for="dropoff">Dropoff District:</label>
        <input type="text" name="dropoff" value="<?php echo htmlspecialchars($dropoff); ?>" readonly>

        <label>Pickup Date:</label>
        <input type="date" name="pdate" id="pdate" required>

        <label>Dropoff Date:</label>
        <input type="date" name="ddate" id="ddate" required>

        <label>Phone Number:</label>
        <input type="text" name="Phone_number" required>

        <label>Passport ID:</label>
        <input type="text" name="Passport_ID" required>

        <label>Do you have a Driver's License?</label>
        <div class="radio-group">
            <input type="radio" id="license_yes" name="license" value="yes" required>
            <label for="license_yes">Yes</label><br>
            <input type="radio" id="license_no" name="license" value="no">
            <label for="license_no">No</label>
        </div>

        <!-- Total Price  -->
		<p style="font-weight: bold; font-size: 18px; color: #333;">$10 Per Day </p>
        <p id="price-display" style="font-weight: bold; font-size: 18px; color: #333;">Total Price: $0</p>
		<br>
        <button class="sbtn" type="submit" value="Submit Booking" name="Submit">Book Now</button>
    </form>
</div>

<script>
    const pdateInput = document.getElementById('pdate');
    const ddateInput = document.getElementById('ddate');
    const priceDisplay = document.getElementById('price-display');

    function calculatePrice() {
        const pdateValue = pdateInput.value;
        const ddateValue = ddateInput.value;

        if (pdateValue && ddateValue) {
            const pdate = new Date(pdateValue);
            const ddate = new Date(ddateValue);

            if (ddate >= pdate) {
                const days = (ddate - pdate) / (1000 * 60 * 60 * 24) + 1; // Include pickup day
                const price = days * 10;
                priceDisplay.textContent = `Total Price: $${price}`;
            } else {
                priceDisplay.textContent = "Error: Drop-off date must be on or after pickup date.";
            }
        } else {
            priceDisplay.textContent = "Total Price: $0";
        }
    }

    pdateInput.addEventListener('change', calculatePrice);
    ddateInput.addEventListener('change', calculatePrice);
</script>


</body>
</html>



