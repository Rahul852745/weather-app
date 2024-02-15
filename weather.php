<?php
$apiKey = '48c4516b3ae7101edaa899b455dca6ea';
$city = isset($_GET['city']) ? $_GET['city'] : 'New York';
$apiUrl = "http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey";

$weatherData = file_get_contents($apiUrl);
$weatherInfo = json_decode($weatherData, true);

// echo '<pre>';
// var_dump($weatherInfo);
if ($weatherInfo['cod'] == 200) {
    $temp = $weatherInfo['main']['temp'];
    $description = $weatherInfo['weather'][0]['description'];
    $icon = $weatherInfo['weather'][0]['icon'];
} else {
    $error = $weatherInfo['message'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
</head>

<body>
    <h1>Weather App</h1>
    <form action="" method="get">
        <label for="city">Enter city:</label>
        <input type="text" name="city" id="city" required>
        <button type="submit">Get Weather</button>
    </form>

    <?php if (isset($error)) : ?>
        <p>Error: <?php echo $error; ?></p>
    <?php else : ?>
        <h2>Weather in <?php echo $city; ?></h2>
        <p>Temperature: <?php echo $temp; ?> &deg;C</p>
        <p>Description: <?php echo $description; ?></p>
        <img src="http://openweathermap.org/img/w/<?php echo $icon; ?>.png" alt="Weather Icon">
    <?php endif; ?>
</body>

</html>