<div class="forecast-container">
    <div class="forecast-title">    Forecast</div>
    <div class="card-box">
        <div class="forecast-card">
            <div class="time">3 AM</div>
            <img src="build\assets\homepage\rain.png" alt="Cloudy">
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
    



    // let currdata=@json(session('fetchdata'));
    // const timestamps = currdata * 1000; // Convert seconds to milliseconds
    // const dts = new Date(timestamps);
    // let currHour=dts.getHours();

    async function getData() {
    try {
        let response = await fetch('https://api.openweathermap.org/data/2.5/forecast?q=sentul,id&appid=3282175a32c9ea3ccd6e541b9510f24c');
        let data = await response.json();
        return data; // ✅ Data is now returned
    } catch (error) {
        console.error('Error fetching data:', error);
    }
    }
    let forecastcards=document.querySelectorAll('div.forecast-card');
    // Calling the function and using the data
    getData().then(data => {
        // console.log(data['list'].length,currDate,curr)
    // console.log('Fetched Data:', data); // Now the data is available
    // for(var x=0;x<data['list'].length;x++){
    //     const timestamp = data['list'][x]['dt'] * 1000; // Convert seconds to milliseconds
    //     const dt = new Date(timestamp);
    //     console.log(dt.getDate(),dt.getHours());
    //     // console.log(dt.getDate(),dt.getHours());
    //     if(dt.getDate()==currDate && dt.getHours()>curr && x==0){
    //         var indexcatch=x;
    //         break;
    //     }else if(dt.getDate()==currDate && dt.getHours()>=curr){
    //         var indexcatch=x;
    //         break;
    //     }
    // }
    var indexcatch=0;
    for(var y=0;y<forecastcards.length;y++){

        if(indexcatch==0 && y==0){
            forecastcards[y].querySelector('div.temp').innerHTML=`${currTemp}°`;
            forecastcards[y].querySelector('div.time').innerHTML="Now";
            forecastcards[y].classList.add('now');
        }else{
            forecastcards[y].querySelector('div.temp').innerHTML=`${parseInt(data['list'][indexcatch+(y-1)]['main']['temp']-273.15)}°`;
            const timestamps = data['list'][indexcatch+(y-1)]['dt'] * 1000; // Convert seconds to milliseconds
            const dts = new Date(timestamps);
            forecastcards[y].querySelector('div.time').innerHTML=(y==1&&indexcatch!=0?"Now":`${dts.getHours()%12} ${dts.getHours()>11?"<br>PM":"<br>AM"}`);
            if(y==1 && indexcatch!=0){
                forecastcards[y].classList.add('now');
            }else{
                forecastcards[y].classList.remove('now');
            }
        }
    }
    });
</script>

