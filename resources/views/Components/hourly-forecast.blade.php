<div class="forecast-container">
    <div class="forecast-title">Forecast</div>
    <div class="card-box">
        <div class="forecast-card">
            <div class="time">11 AM</div>
            <img src="build/assets/homepage/rain.png" alt="Weather">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card now">
            <div class="time">Now</div>
            <img src="build/assets/homepage/rain.png" alt="Weather">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card">
            <div class="time"> AM</div>
            <img src="build/assets/homepage/rain.png" alt="Weather">
            <div class="temp">18°</div>
        </div>
        <div class="forecast-card">
            <div class="time">4 AM</div>
            <img src="build/assets/homepage/rain.png" alt="Weather">
            <div class="temp">19°</div>
        </div>
        <div class="forecast-card">
            <div class="time">4 AM</div>
            <img src="build/assets/homepage/rain.png" alt="Weather">
            <div class="temp">19°</div>
        </div>
    </div>
</div>

{{-- <script>
    async function getData() {
        try {
            let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
            let data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching data:', error);
        }
    }

    function getWeatherIcon(weather, hour) {
        if (weather === "Rain" || weather === "Clear" || weather === "Thunderstorm") {
            return `Asset/Homepage/${weather}_weather_${hour >= 18 ? 'malam' : 'siang'}.png`;
        } else {
            return `Asset/Homepage/${weather}_weather.png`;
        }
    }

    let forecastcards = Array.from(document.querySelectorAll('.forecast-card'));

    getData().then(data => {
        if (!data || !data.list) {
            console.error("Invalid data structure:", data);
            return;
        }

        let indexcatch = 0;
        let currTemp = parseInt(data.list[indexcatch].main.temp - 273.15);
        let currWeather = data.list[indexcatch].weather[0].main;
        let currHour = new Date(data.list[indexcatch].dt * 1000).getHours();

        for (let y = 0; y < forecastcards.length; y++) {
            let tempElement = forecastcards[y].querySelector('.temp');
            let timeElement = forecastcards[y].querySelector('.time');
            let imgElement = forecastcards[y].querySelector('img');

            if (indexcatch === 0 && y === 0) {
                tempElement.innerHTML = `${currTemp}°`;
                timeElement.innerHTML = "Now";
                imgElement.src = getWeatherIcon(currWeather, currHour);
                forecastcards[y].classList.add('now');
            } else {
                let tempCelsius = parseInt(data.list[indexcatch + (y - 1)].main.temp - 273.15);
                let timestamps = data.list[indexcatch + (y - 1)].dt * 1000;
                let weather = data.list[indexcatch + (y - 1)].weather[0].main;
                let dts = new Date(timestamps);
                let hour = dts.getHours();
                let period = hour >= 12 ? "PM" : "AM";
                let displayHour = hour % 12 || 12;

                tempElement.innerHTML = `${tempCelsius}°`;
                timeElement.innerHTML = (y === 1 && indexcatch !== 0) ? "Now" : `${displayHour} ${period}`;
                imgElement.src = getWeatherIcon(weather, hour);

                if (y === 1 && indexcatch !== 0) {
                    forecastcards[y].classList.add('now');
                } else {
                    forecastcards[y].classList.remove('now');
                }
            }
        }
    });
</script> --}}




