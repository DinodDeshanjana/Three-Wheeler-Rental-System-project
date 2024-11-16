<?php
session_start();
include "connection.php";

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tuk Tuk Details</title>

    <style>
	
	@import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

      body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color: #009688;
            color: white;
            padding: 20px;
            text-align: center;
        }
        section {
            padding: 20px;
            margin: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            color: #333;
        }
        .pricing, .book-info {
            margin-top: 20px;
        }
        .pricing ul, .book-info ul {
            list-style-type: none;
            padding: 0;
        }
        .pricing li, .book-info li {
            padding: 5px 0;
        }

		</style>
  
  </head>
  <?php include "navigation.php" ?>
  <body>
  <br>
  
  <header>
    <h1>Tuk Tuk Sri Lanka</h1>
    <p>Explore Sri Lanka with the convenience and charm of a tuk-tuk!</p>
</header>


<section>
    <h2>Tuk Tuk Details</h2>
    <p>Why Choose Us?</p>
    <p>Explore Sri Lanka with the convenience and charm of a tuk-tuk! Perfect for tourists and locals alike, our tuk-tuks are reliable, affordable, and easy to book.</p>
</section>

<section class="pricing">
    <h2>Rental Pricing</h2>
    <ul>
        <li><strong>1 Day:</strong> $10</li>
        <li><strong>Special rates:</strong> Available for long-term rentals. Contact us for details.</li>
    </ul>
</section>

<section class="book-info">
    <h2>How to Book?</h2>
    <ul>
        <li><strong>Check Availability:</strong> Use our availability checker by selecting your pick-up and drop-off locations. You do not need to log in to view availability.</li>
        <li><strong>Register or Log In:</strong> To make a booking, create an account or log in to your existing account.</li>
    </ul>
</section>

<?php include"footer.php";?>
  </body>
  </html>