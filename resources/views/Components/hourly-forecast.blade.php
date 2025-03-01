<div class="forecast-container">
    <div class="forecast-title">Hourly Forecast</div>
    <div class="card-box">
        <div class="forecast-card">
            <div class="time">3 AM</div>
            <img src="Asset/Homepage/rain_weather_siang.png" alt="Cloudy">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card now">
            <div class="time">Now</div>
            <img src="build\assets\homepage\rain.png" alt="Cloudy">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card">
            <div class="time">2 AM</div>
            <img src="build\assets\homepage\rain.png" alt="Cloudy with wind">
            <div class="temp">18°</div>
        </div>
        <div class="forecast-card">
            <div class="time">4 AM</div>
            <img src="build\assets\homepage\rain.png" alt="Cloudy">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card">
            <div class="time">4 AM</div>
            <img src="build\assets\homepage\rain.png" alt="Cloudy">
            <div class="temp">19°</div>
        </div>
    </div>
</div>

<script>
    async function getData() {
        try {
            let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
            let data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function getImagePath(weather, hour) {
        if (weather === "Rain" || weather === "Clear") {
            return hour >= 18 ? `Asset/Homepage/${weather}_weather_malam.png` : `Asset/Homepage/${weather}_weather_siang.png`;
        } else {
            return `Asset/Homepage/${weather}_weather.png`;
        }
    }

    document.addEventListener("DOMContentLoaded", async () => {
        let forecastcards = document.querySelectorAll('div.forecast-card');
        let data = await getData();
        let indexcatch = 0;

        for (let y = 0; y < forecastcards.length; y++) {
            let forecastData = data['list'][indexcatch + (y - 1)];
            let timestamp = forecastData['dt'] * 1000;
            let dt = new Date(timestamp);
            let hour = dt.getHours();
            let weatherCondition = forecastData['weather'][0]['main'];
            let imagePath = getImagePath(weatherCondition, hour);

            forecastcards[y].querySelector('div.temp').innerHTML = `${parseInt(forecastData['main']['temp'] - 273.15)}°`;
            forecastcards[y].querySelector('div.time').innerHTML = (y == 1 && indexcatch != 0) ? "Now" : `${hour % 12 || 12} ${hour >= 12 ? "PM" : "AM"}`;
            forecastcards[y].querySelector('img').src = imagePath;
            forecastcards[y].querySelector('img').alt = weatherCondition;
            console.log(imagePath)
        }
    });

</script>

