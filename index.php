<?php

$host = "localhost";
$username = "root";
$password = "";
$database = "weatherforcast";

$connection = mysqli_connect($host, $username, $password, $database);

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}



if (isset($_GET['cityInput'])) 
{
    $city = $_GET['cityInput'];
    
    $query = "SELECT * FROM city WHERE NAME = '$city'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            $data = array(
                'temperature' => $row['TEMPERATURE'],
                'description' => $row['DESCRIPTION'],
                'humidity' => $row['HUMIDITY'],
                'windSpeed' => $row['WIND_SPEED']
            );

            header('Content-Type: application/json');
            echo json_encode($data);
        } 
        else {
            header('Content-Type: application/json');
            echo json_encode(null);
        }
    } 



    else {
        echo "Error: " . mysqli_error($connection);
    }

}



?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
    <title>Weather Forecast</title>
</head>
<body>

<div class="background-image">  
    <div class="mainContainer">

        <div class="searchInput">
            <i class="fa-solid fa-location-dot"></i>&nbsp;
            <form id="searchForm" method="get" action="index.php">
                <input type="text" placeholder="Enter your location" id="searchinput" name="cityInput" value="Cairo">
                <button id="searchbutton" type="submit" name="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
                <button id="clearButton" type="button"><i class="fas fa-times"></i></button>
            </form>
        </div>

        <div class="weather-part">

            <div class="weather-box">
                <p class="temprature">22C</p>
                <p class="description">Cloudy and there is a chance of raining</p>
            </div>

            <div class="weather-details">

                <div class="column-wind">
                    <i class="fa-solid fa-wind"></i>
		            <div class="text">
		    	        <span class="numb-W">20M/S</span>
                        <p>Wind</p>
		            </div>
			    </div>

        	    <div class="column-humidity">
                    <i class="fa-solid fa-water"></i>
		  		    <div class="text">
		                <span class="numb-H">4%</span>
		                <p>Humidity</p>
		            </div>
		        </div>
            </div>
	    </div>
        
    </div>
</div>
<script src="index.js"></script>
</body>
</html>