<?php
session_start();
include "connection.php";

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>

    <style>
	
	@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

        *{
            margin:0px;
            padding:0px;
        }
		
		h3{
			font-family:Poppins;
			font-size:30px;
			text-align:center;
			padding:18px;
		}
		p{
			font-family:Poppins;
			font-weight:450;
			font-size:18px;
			text-align:center;
		}
		.about2{
			background-color:yellow;
		}
		.about2 p{
			padding:5px;
		}
		</style>
  
  </head>
  <?php include "navigation.php" ?>
  <body>
  <h3>ABOUT US</h3>
  <br><br>
  <p>We provide you with high quality facilities and guidance to explore the beauty of the Sri Lanka with the best possible experiences in travel.<br><br>

We set the background for you to drive tuk tuk like locals and enjoy your self driving experiance as tuk tuk is the best vhicle to travel around the Sri Lanka.<br><br>

We are committed to provide you with all the facilities to enjoy the beauty of the Sri Lanka in a safe and confident way.</p><br><br>

<div class="about2">
<h3>
WHY CHOOSE US
</h3>
<p>

We are your ultimate destination for a never-to-be-forgotten voyage!<br> Our authentic three-wheelers are the best travel companions to get around in Sri Lanka. We've got all the bells and whistles - from surfboard racks for beach days to insurance coverage for that extra peace of mind. Count on us for a secure and thrill-packed journey that will leave you with memories to last a lifetime.
</p><br><br>
  </div>
  <?php include"footer.php";?>
  </body>
  </html>