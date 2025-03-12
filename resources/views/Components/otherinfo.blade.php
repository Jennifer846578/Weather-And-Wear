{{-- <link rel="stylesheet" href="css/homepage.css"> --}}

<div class="weather-detail-box">
    <div class="weather-card">
        <div class="weather-details">
            <p class="date"></p>
            <p class="location">Indonesia, Bogor</p>
            <p class="temp-range">H:24° L:18°</p>
        </div>
        <div class="weather-temp">
            <p>19°</p>
        </div>
    </div>
</div>

{{-- <script>
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
    // console.log('Fetched Data:', data); // Now the data is available
    document.querySelector('p.location').innerHTML=data['sys']['country']+", "+data['name'];
    const timestamp = data['dt'] * 1000; // Convert seconds to milliseconds
    const dt = new Date(timestamp);
    const months = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
    ];
    let days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];
    // document.querySelector('p.date').innerHTML=
    let count = 0;
    function updateCounter() {
            document.querySelector('p.date').innerHTML=`${days[dt.getDay()]}, ${(dt.getHours()-15+parseInt((dt.getMinutes()*60+dt.getSeconds()+count)/3600))%60<10?0:''}${(dt.getHours()-15+parseInt((dt.getMinutes()*60+dt.getSeconds()+count)/3600))%60}:${(dt.getMinutes()+parseInt((dt.getSeconds()+count)/60))%60<10?0:''}${(dt.getMinutes()+parseInt((dt.getSeconds()+count)/60))%60}:${(dt.getSeconds()+count)%60<10?0:''}${(dt.getSeconds()+count)%60}`
            count++;
        }
    updateCounter();
    setInterval(updateCounter, 1000); // Update every second
    // document.querySelector('p.date').innerHTML=`${days[dt.getDay()]} ${dt.getHours()}:${dt.getMinutes()<10?0:''}${dt.getMinutes()}`
    document.querySelector('div.weather-temp').querySelector('p').innerHTML=`${parseInt(parseFloat(data['main']['temp'])-273.15)}°`
    document.querySelector('p.temp-range').innerHTML=`Humidity: ${data['main']['humidity']}%`
    });


</script> --}}

