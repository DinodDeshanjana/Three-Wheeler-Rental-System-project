<?php
session_start();
include "connection.php";

$message = "";
$book_now_url = "";

// Check if the form was submitted via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if both pickup and dropoff 
    if (isset($_POST['pickup']) && isset($_POST['dropoff'])) {
        $pickup = $_POST['pickup'];
        $dropoff = $_POST['dropoff'];

        // Check available tuk tuk
        $sql = "SELECT available_tuktuk FROM vehicles WHERE district = '$pickup'";
        $result = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($result);

        // Check tuk tuk availability
        if ($row && $row['available_tuktuk'] > 0) {
            $message = "Tuk Tuk are available from $pickup to $dropoff.<br> 1 day Rent price 10$";
            $book_now_url = "booking.php?pickup=" . urlencode($pickup) . "&dropoff=" . urlencode($dropoff);
        } else {
            $message = "No Tuk tuk available for booking from $pickup.";
            $book_now_url = null;
        }

        // Redirect to the same page to remove the form data
        header("Location: " . $_SERVER['PHP_SELF'] . "?message=" . urlencode($message) . "&book_now_url=" . urlencode($book_now_url));
        exit();
    } else {
        // pickup or dropoff is missing error message
        $message = "Please enter both pickup and dropoff locations.";
    }
} else if (isset($_GET['message'])) {
    // redirected retrieve the message from the URL
    $message = urldecode($_GET['message']);
    $book_now_url = urldecode($_GET['book_now_url']);
}

// Close the database connection
mysqli_close($connection);
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TukTuk</title>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
			text-decoration:none;
			margin:0px;
			padding:0px;
			box-sizing:border-box;
			
		}
		/*main page 3 items*/
        h1{
			
            position:absolute;
            top:120px;
            width: 100%;
            text-align:center;
            font-family:poppins;
            font-size:22px;
            color:yellow;
			font-weight:bold;
        }
        h2{
            position:absolute;
            top: 159px;;
            width: 100%;
            text-align:center;
            font-family:poppins;
            font-size:37px;
            color:yellow;
			font-weight:bold;
        }
        .p1{
            position:absolute;
            top: 230px;
            width: 100%;
            text-align:center;
            font-family:poppins;
            font-size:23px;
            color:white;
            font-weight:bold;
        }
	
			
		.custom-select{
			color: #363636  ;
			position:absolute;
			top:50%;
			left:24%;
			margin-top: 26px;
			width: 500px;
			display: flex; 
			
		}
	

		select {
			color: #333 ;
			background-color:white;
			margin-left:20px;
			width: 100%;
			padding: 7px;
			border-radius: 8px;
			font-size: 16px;
			font-family:Poppins;
			border-style:none;
			align-items:center;
			justify-content:space-between;
			
		}  

		.btn2{
			position:absolute;
			left:520px;
			width:170px;
			background-color:white;
			border-style:none;
			font-size:16px;
			border-radius:8px;
			padding:7.5px;
            cursor: pointer;
			font-family:Poppins;
			color: #333;
				
		}

		/* Modal (Popup) styles */
		.modal {
            display: none;
            position: fixed;
            z-index: 1;
            padding-top: 250px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 25px;
            border: 1px solid #888;
            width: 35%;
            text-align: center;
			border-radius:10px;
			font-size:16px;
			font-family:Poppins;
			font-weight:bold;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
		
		
        /* Button styles */
		
        .book-now {
            background-color:  #ff5722;
            color: white;
            padding: 10px 20px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
			margin-top:25px;
        }
		
		 select:focus {
            outline: none;
        }
		
		
        /* tuk tuk card 3 */
		
		.card-container {
			display: flex;
			justify-content: center;
			flex-wrap: nowrap;
			padding-top:30px;
			gap: 115px; 
		}

		.card {
			width: 330px;
			overflow: hidden;
			border-radius:10px;
			background-color:#f0f0f0;
			box-shadow:0px 2px 4px rgba(0,0,0,0.2);
		}


		img {
			width: 100%;
			height:auto;
		}
		
		.card-content p{
			font-family:poppins;
			color:#34495e;
			padding:10px;
			font-size:16px;
			text-align:center;
	
		}
		
		.card-content h3{
			padding:5px;
			text-align:center;
			font-family:poppins;
			color:#2874a6;
		}
		
		/*main card*/
		
		.maincard{
			
			padding:20px;
			display:flex;
			width: 1400px;
			overflow: hidden;
			border-radius:18px;
			background-color:#f0f0f0;
			box-shadow:0px 2px 4px rgba(0,0,0,0.2);
			
			
		}
		.maincardmg{
			width: 370px;
			height:auto;
			border-radius:18px;
			
		}
		.maincardcon{
			align-items:center;
			padding-left:50px;
			padding-top:30px;
		}
		.maincardc p{
			font-family:Poppins;
			font-size:20px;
			padding:20px;
			text-align:center;
			color:#45384b;
			
		}
		.maincardc h5{
			font-family:Poppins;
			font-size:24px;
			padding-top:17px;
			text-align:center;
			color:#2c272b;
			
		}
		.maincardc h4{
			font-family:Poppins;
			font-size:52px;
			color:#af1379;
			text-align:center;
		
			
		}
		.maincardc Button{
			padding:7px;
			width:100px;
			font-size:19px;
			font-family:Poppins;
			border-radius:7px;
			cursor: pointer;
			border-style:none;
			color:white;
			background-color:#4189ff  ;
			margin-left:450px;
		}
		.maincardc .tdetails{
			text-align:center;
			font-weight:bold;
			font-size:20px;
			
		}

    </style>
	
</head>

<body>
    

    <?php include "navigation.php" ?>

    <img style="width:100%" src="image/Sigiriya.jpg">

    <h1>Sri Lanka</h1>
    <h2>Rent a Tuk Tuk in Sri Lanka</h2>
    <p class="p1">Rent a Tuk tuk and enjoy the freedom to explore at your own pace. <br>Stop wherever you choose and experience Sri Lanka like a local. Start your adventure today!</p>
	
<form method="post" action="index.php">
  
    <div  class="custom-select">
	
        <select name="pickup" id="pickup">
		
			<option value="" disabled selected>pickup Location</option>
            <option value="Kandy">Kandy</option>
            <option value="Colombo">Colombo</option>
            <option value="Matara">Matara</option>
        </select>

        <select name="dropoff" id="dropoff" >
			<option value="" disabled selected >dropoff Location</option>
		
            <option value="Kandy">Kandy</option>
            <option value="Colombo">Colombo</option>
            <option value="Matara">Matara</option>
        </select>
		
		<Button class="btn2" type="submit" value="Check Avalability" name="Avalability">Check Avalability</Button>
		 </div>
</form>


<div class="maincardcon">
<div class="maincard">
<img class="maincardmg" src="image/tuk1.jpg" alt="Tuk Tuk">
<div class="maincardc">
<h5>Embark on an Unforgettable Adventure</h5>
<h4>Drive Your Own Tuktuk</h4>
<p>
Wait, you’re going to let me drive a three wheeler in Sri Lanka? Yes we are and you’re going to LOVE IT!<br><br>

We rent tuktuks to travellers who want the freedom to explore Sri Lanka by driving an authentic and reliable rickshaw! Moreover get off the beaten track and find the amazing places other tourists miss.<br>
<p class="tdetails">Our Tuk TUk Details</p>
<Button><a style="text-decoration:none; color:white" href="details.php">Details</a></Button>
</div>
</div>
</div>




<div class="card-container">
  <div class="card">
    <img src="image/tuuu.jpg" alt="Tuk Tuk 1">
    <div class="card-content">
      <h3>Adventure Awaits in Sri Lanka</h3>
      <p>Ready for an unforgettable journey? Hop into our tuk tuks and embark on an adventure through Sri Lanka's breathtaking landscapes. Discover hidden waterfalls, charming villages, and the iconic Sigiriya rock fortress.
</p>
    </div>
  </div>

  

  <div class="card">
    <img src="image/tuk3.jpg" alt="Tuk Tuk 3">
    <div class="card-content">
      <h3>Cultural Journeys through Sri Lanka</h3>
      <p>Dive into Sri Lanka’s rich history and vibrant culture. Travel in style to ancient temples, local markets, and iconic landmarks. Our tuk tuk tours provide an immersive experience, connecting you with the heart of Sri Lanka.</p>
    </div>
  </div>
  
  <div class="card">
    <img src="image/tuk4.jpg" alt="Tuk Tuk 4">
    <div class="card-content">
      <h3>Adventure Awaits in Ella</h3>
      <p>Ride through the stunning landscapes of Ella. Experience nature and local culture up close with our tuk tuk adventure tours.</p>
    </div>
  </div>
</div>
<br>



<?php include"footer.php";?>

<!-- The Modal (Popup Box) -->
<div id="myModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="availabilityMessage"></p>
        <a id="bookNowLink" class="book-now" href="#">Book now</a>
    </div>
</div>

<script>
    // Get the modal element
    var modal = document.getElementById("myModal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Function to show modal with a custom message and link
    function showModal(message, link) {
        document.getElementById("availabilityMessage").innerHTML = message;
        if (link) {
            document.getElementById("bookNowLink").href = link;
            document.getElementById("bookNowLink").style.display = "inline-block";
        } else {
            document.getElementById("bookNowLink").style.display = "none";
        }
        modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.style.display = "none";
    }

    // When the user clicks anywhere outside the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    <?php if (!empty($message)) { ?>
        // Trigger modal with PHP-generated message
        window.onload = function() {
            showModal("<?php echo $message; ?>", "<?php echo $book_now_url; ?>");
        };
    <?php } ?>
</script>

</body>
</html>