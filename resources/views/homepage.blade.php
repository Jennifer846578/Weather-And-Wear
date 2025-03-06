<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/homepage.css">
    <title>Homepage</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nosifer&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps:wght@400;700&display=swap"
        rel="stylesheet">

</head>

<body>
    <div class="phone-card">
        <p class="weathertext"></p>
        <x-navbar></x-navbar>
        <x-tips></x-tips>
        {{-- <x-weather-name>build\assets\homepage\wn-rain.png</x-weather-name> --}}
        <x-weather>build\assets\homepage\rain.png</x-weather>
        <x-otherinfo></x-otherinfo>
        <x-hourly-forecast></x-hourly-forecast>
        <x-view-schedule :events='$events'></x-view-schedule>
        <h1 class="whattowear">What to Wear Today?</h1>
        <x-style-selector></x-style-selector>
        <x-generate-outfit></x-generate-outfit>
    </div>
</body>

{{-- JS --}}

<script>
    // Variabel untuk menyimpan koordinat
    let latitude;
    let longitude;
    let imagePath;
    let dt;
    let temperature;

    // Fungsi mendapatkan lokasi pengguna
    function getUserLocation() {
        return new Promise((resolve, reject) => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        latitude = position.coords.latitude;
                        longitude = position.coords.longitude;

                        console.log("Latitude:", latitude, "Longitude:", longitude);
                        resolve({ latitude, longitude }); // Kirim data lokasi setelah berhasil
                    },
                    function (error) {
                        console.error("Error mendapatkan lokasi:", error);
                        reject(error);
                    },
                    {
                        enableHighAccuracy: true,
                        maximumAge: 0
                    }
                );
            } else {
                alert("Geolocation tidak didukung di browser ini.");
                reject("Geolocation tidak didukung.");
            }
        });
    }

    // Fungsi untuk mengambil data cuaca dari API
    async function getData(lat, lon) {
        try {
            let response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${lat}&lon=${lon}&appid=a98a0f5f5daa0606b7aa44514cc6cdf3&units=metric`);
            let data = await response.json();
            return data;
        } catch (error) {
            console.error('Error fetching data:', error);
            return null;
        }
    }

    // Fungsi utama untuk menjalankan aplikasi cuaca
    async function startWeatherApp() {

        try {
            // 1. Dapatkan lokasi pengguna
            let location = await getUserLocation();

            // 2. Gunakan lokasi untuk mengambil data cuaca
            let weatherData = await getData(location.latitude, location.longitude);

            if (weatherData) {
                console.log("Data Cuaca:", weatherData);

                // 3. Jalankan Kode 1 setelah API berhasil
                processWeatherData(weatherData);
            } else {
                console.error("Gagal mendapatkan data cuaca.");
            }
        } catch (error) {
            console.error("Terjadi kesalahan:", error);
        }
    }

    // Fungsi untuk memproses data cuaca dan menampilkan di halaman
    function processWeatherData(data) {

        // OTHERINFO

        console.log('Fetched Data:', data); // Now the data is available
        document.querySelector('p.location').innerHTML=data['sys']['country']+", "+data['name'];
        const timestamp = data['dt'] * 1000; // Convert seconds to milliseconds
        dt = new Date(timestamp);
        const months = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
        ];
        let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
        // document.querySelector('p.date').innerHTML=
        let count = 0;
        function updateCounter() {
                document.querySelector('p.date').innerHTML=`${days[dt.getDay()]}, ${(dt.getHours()+parseInt((dt.getMinutes()*60+dt.getSeconds()+count)/3600))%60<10?0:''}${(dt.getHours()+parseInt((dt.getMinutes()*60+dt.getSeconds()+count)/3600))%60}:${(dt.getMinutes()+parseInt((dt.getSeconds()+count)/60))%60<10?0:''}${(dt.getMinutes()+parseInt((dt.getSeconds()+count)/60))%60}:${(dt.getSeconds()+count)%60<10?0:''}${(dt.getSeconds()+count)%60}`
                count++;
            }
        updateCounter();
        setInterval(updateCounter, 1000); // Update every second
        // document.querySelector('p.date').innerHTML=`${days[dt.getDay()]} ${dt.getHours()}:${dt.getMinutes()<10?0:''}${dt.getMinutes()}`
        // document.querySelector('div.weather-temp').querySelector('p').innerHTML=`${parseInt(parseFloat(data['main']['temp']))}°`
        document.querySelector('div.weather-temp').querySelector('p').innerHTML=`${parseInt(data['main']['temp'])}°`
        console.log('akudisini',data)
        document.querySelector('p.temp-range').innerHTML=`Humidity: ${data['main']['humidity']}%`

        let weatherId = data.weather[0].id;
        temperature = Math.round(data.main.temp); // Ambil suhu dalam Celsius
        let weatherCondition = data.weather[0].main;


        console.log(`ID Cuaca: ${weatherId}, Temperatur: ${temperature}°C, Kondisi: ${weatherCondition}`);

        let weatherTextElement = document.querySelector('p.weathertext');
        let weatherImageElement = document.querySelector('div.weather-dynamic img');

        if (!weatherTextElement || !weatherImageElement) {
            console.error("Elemen cuaca tidak ditemukan.");
            return;
        }

        // Menentukan teks cuaca berdasarkan ID
        let weatherText;
        let listofWeather = {
            2: "Thunderstorm",
            3: "Drizzle",
            5: "Rain",
            6: "Snow",
            7: "Atmosphere",
            8: "Clouds"
        };

        if (weatherId === 800) {
            weatherText = "Clear";
        } else {
            let category = Math.floor(weatherId / 100);
            weatherText = listofWeather[category] || "Unknown";
        }

        // Update teks cuaca di halaman
        weatherTextElement.innerHTML = weatherText;

        // Menentukan gambar berdasarkan kondisi cuaca
        dt = new Date();
        let isNight = dt.getHours() >= 18;


        if (["Rain", "Clear", "Thunderstorm"].includes(weatherText)) {
            imagePath = `Asset/Homepage/${weatherText}_weather_${isNight ? 'malam' : 'siang'}.png`;
        } else {
            imagePath = `Asset/Homepage/${weatherText}_weather.png`;
        }

        weatherImageElement.src = imagePath;
        console.log("Gambar cuaca diperbarui:", imagePath);

        // Jalankan fungsi updateTips setelah cuaca ditampilkan
        updateTips(weatherText);
    }

    // Fungsi untuk menampilkan tips berdasarkan cuaca
    function updateTips(weatherCondition) {
        const tipsPopup = document.getElementById("tips-popup");
        const closePopupTips = document.getElementById("close-popup");
        const youtubeVideo = document.getElementById("youtube-video");
        const tipsList = document.querySelector(".popup-content ul");

        if (!tipsPopup || !closePopupTips || !youtubeVideo || !tipsList) {
            console.error("Elemen tips tidak ditemukan!");
            return;
        }

        const tipsData = {
            "Rain": {
                title: "Tips for Rainy Weather",
                video: "Asset/Homepage/rainyvideo.mp4",
                list: [
                    "Carry an umbrella or raincoat",
                    "Wear waterproof shoes",
                    "Drive carefully and avoid slippery roads"
                ]
            },
            "Clouds": {
                title: "Tips for Cloudy Weather",
                video: "Asset/Homepage/cloudyvideo.mp4",
                list: [
                    "Bring a light jacket",
                    "Expect cooler temperatures",
                    "Sunlight may still be strong, wear sunscreen"
                ]
            },
            "Thunderstorm": {
                title: "Tips for Thunderstorms",
                video: "Asset/Homepage/thunderstormvideo.mp4",
                list: [
                    "Stay indoors if possible",
                    "Avoid open fields and tall trees",
                    "Unplug electronic devices"
                ]
            },
            "Clear": {
                title: "Tips for Sunny Weather",
                video: "Asset/Homepage/clearvideo.mp4",
                list: [
                    "Use sunscreen before going outside",
                    "Wear a hat and sunglasses",
                    "Bring a water bottle to stay hydrated"
                ]
            },
            "Snow": {
                title: "Tips for Snowy Weather",
                video: "Asset/Homepage/snowyvideo.mp4",
                list: [
                    "Wear warm clothing",
                    "Drive carefully on icy roads",
                    "Use insulated boots to prevent slipping"
                ]
            },
            "Windy": {
                title: "Tips for Windy Weather",
                video: "Asset/Homepage/windyvideo.mp4",
                list: [
                    "Wear wind-resistant clothes",
                    "Avoid loose objects outdoors",
                    "Drive carefully in strong winds"
                ]
            }
        };

        if (tipsData[weatherCondition]) {
            console.log(`Menampilkan tips untuk cuaca: ${weatherCondition}`);

            // Perbarui judul modal
            closePopupTips.innerText = tipsData[weatherCondition].title;

            // Perbarui video
            youtubeVideo.src = tipsData[weatherCondition].video + "?autoplay=0&mute=1";

            // Perbarui daftar tips
            tipsList.innerHTML = "";
            tipsData[weatherCondition].list.forEach(tip => {
                let li = document.createElement("li");
                li.textContent = tip;
                tipsList.appendChild(li);
            });

            // Tampilkan popup
            tipsPopup.style.display = "flex";
        } else {
            console.error("Cuaca tidak dikenali:", weatherCondition);
        }
    }

    // Event listener untuk menampilkan tips saat tombol ditekan
    document.getElementById("tips-button").addEventListener("click", () => {
        let weatherTextElement = document.querySelector("p.weathertext");
        if (weatherTextElement) {
            updateTips(weatherTextElement.innerText.trim());
        }
    });

    // Event listener untuk menutup modal
    document.getElementById("tips-popup").addEventListener("click", () => {
        document.getElementById("tips-popup").style.display = "none";
        document.getElementById("youtube-video").src = "";
    });

    // Jalankan program
    startWeatherApp();

        // JS HOURLY FORECAST
        async function getData2() {
            try {
                let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
                console.log(latitude, longitude)
                // let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?lat='+latitude+'&lon='+longitude+'&appid=a98a0f5f5daa0606b7aa44514cc6cdf3');
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

        getData2().then(data => {
            if (!data || !data.list) {
                console.error("Invalid data structure:", data);
                return;
            }

            let indexcatch = 0;
            let currTemp1 = parseInt(data.list[indexcatch].main.temp - 273.15);
            let currWeather = data.list[indexcatch].weather[0].main;
            let currHour = new Date(data.list[indexcatch].dt * 1000).getHours();

            for (let y = 0; y < forecastcards.length; y++) {
                let tempElement = forecastcards[y].querySelector('.temp');
                let timeElement = forecastcards[y].querySelector('.time');
                let imgElement = forecastcards[y].querySelector('img');

                if (indexcatch === 0 && y === 0) {
                    tempElement.innerHTML = document.querySelector('div.weather-temp').querySelector('p').innerHTML;
                    // console.log(tempElement.innerHTML)
                    timeElement.innerHTML = "Now";
                    imgElement.src = imagePath;
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


</script>




{{-- <script>


    // JS Hourly Forecast
        async function getData() {
            try {
                // let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
                consloe.log(latitude, longitude)
                let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?lat='+latitude+'&lon='+longitude+'&appid=a98a0f5f5daa0606b7aa44514cc6cdf3');
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
                    tempElement.innerHTML = `${currTemp1}°`;
                    timeElement.innerHTML = "Now";
                    imgElement.src = imagePath;
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
    });
</script> --}}

</html>
