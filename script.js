const apiKey = 'e38e009dd3b1cd889bfee1770e62c2fb'; // Your API Key

// Navbar scroll effect
window.addEventListener('scroll', function () {
    const navbar = document.getElementById('navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

// Handle city input and automatically jump to next slide
document.getElementById('city-input').addEventListener('keypress', function (e) {
    if (e.key === 'Enter') {
        const city = e.target.value;
        fetchWeatherDataByCity(city);
        e.target.value = '';  // Clear the input field

        // Show weather details section and hide landing page
        document.getElementById('weather-details').classList.remove('hidden');
        document.getElementById('landing').classList.add('hidden');

        // Scroll to the "weather-details" section smoothly
        document.getElementById('weather-details').scrollIntoView({ behavior: 'smooth' });
    }
});

// Geolocation button event
document.getElementById('location-btn').addEventListener('click', function () {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(success, error);
    } else {
        alert('Geolocation is not supported by your browser.');
    }
});

// On successful geolocation
function success(position) {
    const latitude = position.coords.latitude;
    const longitude = position.coords.longitude;

    fetchWeatherDataByCoords(latitude, longitude);
    document.getElementById('weather-details').classList.remove('hidden');
    document.getElementById('landing').classList.add('hidden');

    // Scroll to the "weather-details" section smoothly
    document.getElementById('weather-details').scrollIntoView({ behavior: 'smooth' });
}

// Handle geolocation errors
function error() {
    alert('Unable to retrieve your location.');
}

// Fetch weather data by city name
function fetchWeatherDataByCity(city) {
    fetch(`https://api.openweathermap.org/data/2.5/forecast?q=${city}&appid=${apiKey}&units=metric`)
        .then(response => response.json())
        .then(data => displayWeather(data))
        .catch(error => console.error('Error:', error));
}

// Fetch weather data by coordinates (latitude and longitude)
function fetchWeatherDataByCoords(lat, lon) {
    fetch(`https://api.openweathermap.org/data/2.5/forecast?lat=${lat}&lon=${lon}&appid=${apiKey}&units=metric`)
        .then(response => response.json())
        .then(data => displayWeather(data))
        .catch(error => console.error('Error:', error));
}

// Display weather information
function displayWeather(data) {
    const cityName = document.getElementById('city-name');
    const currentTemp = document.getElementById('current-temp');
    const minMaxTemp = document.getElementById('min-max-temp');
    const humidity = document.getElementById('humidity');
    const windSpeed = document.getElementById('wind-speed');
    const precipitation = document.getElementById('precipitation');
    const pressure = document.getElementById('pressure');

    // Display city name and current temperature
    cityName.textContent = data.city.name;
    currentTemp.textContent = `Current: ${data.list[0].main.temp}°C`;
    minMaxTemp.textContent = `Min: ${data.list[0].main.temp_min}°C, Max: ${data.list[0].main.temp_max}°C`;

    // Display additional weather info (humidity, wind speed, precipitation, pressure)
    humidity.textContent = `${data.list[0].main.humidity}%`;
    windSpeed.textContent = `${data.list[0].wind.speed} m/s`;
    precipitation.textContent = `${data.list[0].pop * 100}%`;
    pressure.textContent = `${data.list[0].main.pressure} hPa`;

    // Display hourly and 7-day forecast
    displayHourlyForecast(data);
    displayDailyForecast(data);
}

// Display hourly forecast
function displayHourlyForecast(data) {
    const hourlyScroll = document.getElementById('hourly-scroll');
    hourlyScroll.innerHTML = ''; // Clear previous data

    // Loop through first 8 hours (3-hour intervals)
    for (let i = 0; i < 8; i++) {
        const hourData = data.list[i];
        const time = new Date(hourData.dt * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const temp = hourData.main.temp;
        const icon = `http://openweathermap.org/img/w/${hourData.weather[0].icon}.png`;

        const hourlyDiv = document.createElement('div');
        hourlyDiv.classList.add('hour-box');
        hourlyDiv.innerHTML = `
            <p>${time}</p>
            <img src="${icon}" alt="Weather Icon">
            <p>${temp}°C</p>
        `;

        hourlyScroll.appendChild(hourlyDiv);
    }
}

// Display 7-day forecast
function displayDailyForecast(data) {
    const dailyForecast = document.getElementById('daily-forecast');
    dailyForecast.innerHTML = ''; // Clear previous data

    // Loop through every 8th index (each day has 8 entries, 3-hour intervals)
    for (let i = 0; i < data.list.length; i += 8) {
        const dayData = data.list[i];
        const date = new Date(dayData.dt * 1000).toLocaleDateString();
        const tempMin = dayData.main.temp_min;
        const tempMax = dayData.main.temp_max;
        const icon = `http://openweathermap.org/img/w/${dayData.weather[0].icon}.png`;

        const dayDiv = document.createElement('div');
        dayDiv.classList.add('day-box');
        dayDiv.innerHTML = `
            <p>${date}</p>
            <img src="${icon}" alt="Weather Icon">
            <p>Min: ${tempMin}°C, Max: ${tempMax}°C</p>
        `;

        dailyForecast.appendChild(dayDiv);
    }
}

// "View More Details" button event
document.getElementById('view-more-btn').addEventListener('click', function () {
    const moreDetailsSection = document.getElementById('more-details');
    moreDetailsSection.classList.remove('hidden'); // Unhide the more details section if it's hidden

    // Scroll to the "more-details" section smoothly
    moreDetailsSection.scrollIntoView({ behavior: 'smooth' });
});


function displayHourlyForecast(data) {
    const hourlyScroll = document.getElementById('hourly-scroll');
    hourlyScroll.innerHTML = ''; // Clear previous data

    // Loop through first 8 hours (3-hour intervals)
    for (let i = 0; i < 12; i++) {
        const hourData = data.list[i];
        const time = new Date(hourData.dt * 1000).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const temp = hourData.main.temp;
        const icon = `http://openweathermap.org/img/w/${hourData.weather[0].icon}.png`;

        const hourlyDiv = document.createElement('div');
        hourlyDiv.classList.add('hour-box');
        hourlyDiv.style.paddingRight = '30px'; // Adding right padding

        hourlyDiv.innerHTML = `
            <p>${time}</p>
            <img src="${icon}" alt="Weather Icon">
            <p>${temp}°C</p>
        `;

        hourlyScroll.appendChild(hourlyDiv);
    }
}