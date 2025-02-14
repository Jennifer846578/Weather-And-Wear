<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/homepage.css">
    <title>Homepage</title>
</head>
<body>
    <div class="phone-card">
        <body>
            <p class="weathertext"></p>
            <x-navbar></x-navbar>
            {{-- <x-tips></x-tips> --}}
            <x-weather-name>build\assets\homepage\wn-rain.png</x-weather-name>
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
    const timestamp = @json($fetchdata['dt']) * 1000; // Convert seconds to milliseconds
    const dt = new Date(timestamp);
    let curr=dt.getHours();
    let currDate=dt.getDate();
    let currTemp= parseInt(@json($fetchdata['main']['temp'])-273.15 )
    let currId=parseInt(@json($fetchdata['weather'][0]['id'])/100);
    console.log(currId);
    listofWeather=['ThunderStorm','Rain','Rain','Rain','Snow','Atmosphere','Clouds','Additional'];
    if(parseInt(@json($fetchdata['weather'][0]['id']))==800){
        document.querySelector(p.weathertext).innerHTML="Clear";
    }
    document.querySelector('p.weathertext').innerHTML=listofWeather[currId-2];
    // console.log(curr);
</script>
</html>
