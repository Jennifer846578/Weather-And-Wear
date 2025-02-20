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
</head>
<body>
    <div class="phone-card">
        <body> 
            <p class="weathertext"></p>
            <x-navbar></x-navbar>
            {{-- <x-tips></x-tips> --}}
            {{-- <x-weather-name>build\assets\homepage\wn-rain.png</x-weather-name> --}}
            <x-weather>build\assets\homepage\rain.png</x-weather>
            <x-otherinfo></x-otherinfo>
            <x-hourly-forecast></x-hourly-forecast>
            <x-view-schedule></x-view-schedule>
            <h1>What to Wear Today?</h1>
            <x-style-selector></x-style-selector>
            <x-generate-outfit></x-generate-outfit>
        </body>
    </div>
</body>
<script>

    // script jason
    // end

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
    let currTemp= parseInt(@json($fetchdata['main']['temp'])-273.15 )


    async function getData() {
    try {
        let response = await fetch('https://api.openweathermap.org/data/2.5/weather?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
        // let response = await fetch(`https://api.openweathermap.org/data/2.5/weather?lat=${latitude}&lon=${longtitude}&appid=3282175a32c9ea3ccd6e541b9510f24c`);
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
    }
    document.querySelector('p.weathertext').innerHTML=listofWeather[currId-2];
    // console.log(curr);

    let teks=document.querySelector('p.weathertext');
    console.log(teks.innerHTML)
    console.log("build/assets/homepage/"+teks.innerHTML+".png" )
    let gambar=document.querySelector('div.weather-dynamic').querySelector('img');
    });
</script>
</html>
