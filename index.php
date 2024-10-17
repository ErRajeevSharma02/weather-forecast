<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Website</title>
    <link rel="stylesheet" href="styles.css">
    <script src="script.js" defer></script>
</head>

<body>

    <!-- Navbar -->
    <header id="navbar" class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#landing">
                    <h1>CLOUD.WATCH</h1>
                </a>
            </div>
            <nav>
                <ul class="menu">
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li><a href="login.php" id="sign-in-link">Sign In</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- PHP logic for handling form submission -->
    <?php
        $weatherData = null;

        if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['city'])) {
            $city = htmlspecialchars($_POST['city']);

            // Make API call to get weather data (this needs to be implemented with OpenWeather API or similar)
            // $weatherData = getWeatherDataByCity($city); 

            // For now, mock some weather data for demonstration
            $weatherData = [
                'city' => $city,
                'temp' => 24,
                'temp_min' => 20,
                'temp_max' => 27,
                'humidity' => 75,
                'wind_speed' => 5,
                'precipitation' => 10,
                'pressure' => 1012,
            ];
        }
    ?>

    <!-- Landing Page -->
    <section id="landing" class="landing">
        <div class="quote">
            <h2>"Sunshine is delicious, rain is refreshing, wind braces up, snow is exhilarating; there is no such thing
                as bad weather, only different kinds of good weather."</h2>
        </div>
        <div class="input-container">
            <form method="POST" action="">
                <input type="text" id="city-input" name="city" placeholder="Enter Your City" required>
                <button type="submit" id="location-btn">Use My Location</button>
            </form>
        </div>
    </section>

    <!-- Weather Details -->
    <section id="weather-details" class="weather-details <?php echo empty($weatherData) ? 'hidden' : ''; ?>">
        <div class="weather-info">
            <div class="left-info">
                <h2 id="city-name"><?php echo !empty($weatherData) ? $weatherData['city'] : ''; ?></h2>
                <p id="current-temp">Current Temp: <?php echo !empty($weatherData) ? $weatherData['temp'] . '°C' : ''; ?></p>
                <p id="min-max-temp">Min: <?php echo !empty($weatherData) ? $weatherData['temp_min'] . '°C' : ''; ?>, Max: <?php echo !empty($weatherData) ? $weatherData['temp_max'] . '°C' : ''; ?></p>
            </div>
        </div>
        <button id="view-more-btn">View More Details</button>
    </section>

    <!-- Detailed Weather Info -->
    <section id="more-details" class="hidden details-section">
        <div class="detail-box">
            <img src="assets/humidity.png" alt="">
            <h3>Humidity</h3>
            <p id="humidity"><?php echo !empty($weatherData) ? $weatherData['humidity'] . '%' : ''; ?></p>
        </div>
        <div class="detail-box">
            <img src="assets/anemometer.png" alt="">
            <h3>Wind Speed</h3>
            <p id="wind-speed"><?php echo !empty($weatherData) ? $weatherData['wind_speed'] . ' m/s' : ''; ?></p>
        </div>
        <div class="detail-box">
            <img src="assets/precipitation.png" alt="">
            <h3>Precipitation</h3>
            <p id="precipitation"><?php echo !empty($weatherData) ? $weatherData['precipitation'] . '%' : ''; ?></p>
        </div>
        <div class="detail-box">
            <img src="assets/pressure-gauge.png" alt="">
            <h3>Pressure</h3>
            <p id="pressure"><?php echo !empty($weatherData) ? $weatherData['pressure'] . ' hPa' : ''; ?></p>
        </div>
    </section>

    <!-- Hourly Weather Forecast -->
    <section id="hourly-forecast" class="hidden forecast-section">
        <h2>Hourly Forecast</h2>
        <div id="hourly-scroll" class="scroll-container">
            <!-- PHP logic to display hourly forecast dynamically -->
            <?php
                if (!empty($weatherData)) {
                    for ($i = 0; $i < 24; $i++) {
                        echo '<div class="hour-box">';
                        echo '<p>' . ($i + 1) . ' PM</p>'; // Dummy hour data
                        echo '<img src="http://openweathermap.org/img/w/10d.png" alt="Weather Icon">'; // Dummy icon
                        echo '<p>' . ($weatherData['temp'] - rand(0, 5)) . '°C</p>'; // Dummy temp data
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </section>

    <!-- 7-Day Forecast -->
    <section id="weekly-forecast" class="hidden forecast-section">
        <h2>Weekly Forecast</h2>
        <div id="daily-forecast" class="grid-container">
            <!-- PHP logic to display daily forecast dynamically -->
            <?php
                if (!empty($weatherData)) {
                    for ($i = 0; $i < 7; $i++) {
                        echo '<div class="daily-box">';
                        echo '<p>Day ' . ($i + 1) . '</p>'; // Dummy day
                        echo '<img src="http://openweathermap.org/img/w/10d.png" alt="Weather Icon">'; // Dummy icon
                        echo '<p>Min: ' . ($weatherData['temp_min'] - rand(0, 2)) . '°C, Max: ' . ($weatherData['temp_max'] + rand(0, 2)) . '°C</p>';
                        echo '</div>';
                    }
                }
            ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section hidden">
        <h2>About Us</h2>
        <p class="subline">Cloud Watch provides you with accurate weather predictions. Get the forecast for your day and
            week, plan wisely, and stay prepared for whatever comes your way!</p>

        <!-- Key Features -->
        <div class="key-features">
            <div class="feature-box1">
                <h3>Real-Time Weather</h3>
                <p>Get up-to-date weather conditions for any city in the world.</p>
            </div>
            <div class="feature-box2">
                <h3>Weekly Day Forecast</h3>
                <p>Plan your week with reliable daily weather forecasts.</p>
            </div>
            <div class="feature-box3">
                <h3>Hourly Updates</h3>
                <p>Stay informed with accurate hourly predictions for your location.</p>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section hidden">
        <h2>Feedback </h2>
       
    <form action="https://api.web3forms.com/submit" method="POST">

        <!-- Replace with your Access Key -->
        <input type="hidden" name="access_key" value="eae3be49-cd8b-45a1-9cc3-6a622fc8ceaa">
    
        <!-- Form Inputs. Each input must have a name="" attribute -->
        <input type="text" name="name" required placeholder="Enter your name" >
        <input type="email" name="email" required placeholder="Enter your email">
        <textarea name="message" placeholder="Feedback" required></textarea>
    
        <!-- Honeypot Spam Protection -->
        <input type="checkbox" name="botcheck" class="hidden" style="display: none;">
    
        <!-- Custom Confirmation / Success Page -->
        <!-- <input type="hidden" name="redirect" value="https://mywebsite.com/thanks.html"> -->
    
        <button type="submit">Submit Form</button>
    
    </form>
    
    </section>

</body>

</html>
