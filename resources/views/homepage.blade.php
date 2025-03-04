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
    <link href="https://fonts.googleapis.com/css2?family=Oleo+Script+Swash+Caps:wght@400;700&display=swap" rel="stylesheet">

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
            <x-view-schedule></x-view-schedule>
            <h1 class="whattowear">What to Wear Today?</h1>
            <x-style-selector></x-style-selector>
            <x-generate-outfit></x-generate-outfit>
    </div>
</body>

{{-- JS --}}

<script>
    // GET USER LOCATION
    function getUserLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.watchPosition(
                function (position) {
                    let latitude = position.coords.latitude;
                    let longitude = position.coords.longitude;

                    console.log("Latitude:", latitude, "Longitude:", longitude);
                },
                function (error) {
                    console.error("Error mendapatkan lokasi:", error);
                },
                {
                    enableHighAccuracy: true,
                    maximumAge: 0
                }
            );
        } else {
            alert("Geolocation tidak didukung di browser ini.");
        }
    }

    getUserLocation();

    const timestamp = @json($fetchdata['dt']) * 1000; // Convert seconds to milliseconds
    const dt = new Date(timestamp);
    let curr=dt.getHours();
    let currDate=dt.getDate();
    let currTemp1= parseInt(@json($fetchdata['main']['temp'])-273.15 )


    // WEATHER API

    async function getData() {
    try {
        let response = await fetch('https://api.openweathermap.org/data/2.5/weather?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
        let data = await response.json();
        return data; // ✅ Data is now returned
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    }

    // Calling the function and using the data
    getData().then(data => {
    let currId=parseInt(data['weather'][0]['id']/100);
    listofWeather=['ThunderStorm','Rain','Rain','Rain','Snow','Atmosphere','Clouds','Additional'];
    if(parseInt(data['weather'][0]['id'])==800){
        document.querySelector(p.weathertext).innerHTML="Clear";
    }else{
        document.querySelector('p.weathertext').innerHTML=listofWeather[currId-2];
    }

    //  CHANGE IMAGE BASE ON WEATHER
    let teks = document.querySelector('p.weathertext');
    let imagePath;

    if (teks) {
        console.log(teks.innerHTML);

        if (teks.innerHTML == "Rain" || teks.innerHTML == "Clear" || teks.innerHTML == "Thunderstorm") {
            if (dt.getHours() >= 18) {
                imagePath = `Asset/Homepage/${teks.innerHTML}_weather_malam.png`;
            } else {
                imagePath = `Asset/Homepage/${teks.innerHTML}_weather_siang.png`;
            }
        } else {
            imagePath = `Asset/Homepage/${teks.innerHTML}_weather.png`;
        }

        console.log(imagePath);

        // Mencari elemen gambar dalam div.weather-dynamic dan mengganti src-nya
        let gambar = document.querySelector('div.weather-dynamic img');

        if (gambar) {
            gambar.src = imagePath;
        } else {
            console.error("Elemen gambar tidak ditemukan dalam div.weather-dynamic");
        }
    } else {
     console.error("Elemen p.weathertext tidak ditemukan");
    }

    // CHANGE TIPS CONTENT BASED ON WEATHER
    function updateTips() {
        const weatherTextElement = document.querySelector("p.weathertext"); // Ambil elemen setiap kali updateTips dipanggil
        if (!weatherTextElement) {
            console.error("Elemen p.weathertext tidak ditemukan!");
            return;
        }

        let weatherCondition = weatherTextElement.innerText.trim(); // Gunakan innerText untuk memastikan nilai yang diambil

        const tipsPopup = document.getElementById("tips-popup");
        const closePopupTips = document.getElementById("close-popup");
        const youtubeVideo = document.getElementById("youtube-video");
        const tipsList = document.querySelector(".popup-content ul");

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
                    "Prioritize layers with wind-resistant fabrics",
                    "Use tight-fitting clothes to minimize flapping",
                    "Wear accessories like hats and gloves to protect exposed areas"
                ]
            }
        };

        if (tipsData[weatherCondition]) {
            console.log(`Mengupdate modal dengan cuaca: ${weatherCondition}`);

            // Perbarui judul modal
            closePopupTips.innerText = tipsData[weatherCondition].title;

            // Perbarui video YouTube
            youtubeVideo.src = tipsData[weatherCondition].video + "?autoplay=0&mute=1";

            // Perbarui daftar tips
            tipsList.innerHTML = "";
            tipsData[weatherCondition].list.forEach(tip => {
                let li = document.createElement("li");
                li.textContent = tip;
                tipsList.appendChild(li);
            });
        } else {
            console.error("Cuaca tidak dikenali:", weatherCondition);
        }
    }

    // Pastikan tips diperbarui saat tombol ditekan
    document.getElementById("tips-button").addEventListener("click", () => {
        updateTips();
        document.getElementById("tips-popup").style.display = "flex";
    });

    // Tutup modal saat tombol close ditekan
    document.getElementById("close-popup").addEventListener("click", () => {
        document.getElementById("tips-popup").style.display = "none";
        document.getElementById("youtube-video").src = ""; // Reset video agar tidak tetap bermain di latar belakang
    });

    // Tutup modal jika pengguna klik di luar modal
    window.addEventListener("click", (e) => {
        if (e.target === document.getElementById("tips-popup")) {
            document.getElementById("tips-popup").style.display = "none";
            document.getElementById("youtube-video").src = ""; // Reset video
        }
    });

    // JIKA LOGIN SUKSES
    document.addEventListener("DOMContentLoaded", function () {
    let loginSuccess = document.getElementById("login_success").value === "true";

    if (loginSuccess) {
        console.log("Login berhasil, menampilkan popup tips...");
        updateTips();
        document.getElementById("tips-popup").style.display = "flex";
    }
});

// JS Hourly Forecast
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
</script>
</html>
