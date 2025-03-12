<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/classic.min.css" />
    <link rel="stylesheet" href="css/detail.css">

</head>
<body>
    <div class="backbutton">
        <a onclick="BackToWardrobe()">
            <img src="asset/detail/back.png" alt="Back" width="36px">
        </a>
    </div>
    <h1>Add Clothes to Wardrobe</h1>

    <!-- Pratinjau gambar -->
    <div id="PreviewContainer">
        <img id="PreviewImage" class="PreviewImage" alt="Preview Image" style="width: 250px;" src="{{ asset('Asset/Wardrobe/Images/' . $data->imagePath) }}">
    </div>

    {{-- <div class="-color-picker-container">
        <h2>Select your clothes color</h2>
        <div class="-color-area" id="ColorArea"></div>
        <input type="range" class="-color-slider" id="ColorSlider" min="0" max="360" value="360">
        <div class="-color-display" id="ColorDisplay"></div>
        <div class="-hex-display" id="HexDisplay">HEX: {{ $dominantColor }}</div>
        <p style="display: none;" class="value">#ff0000</p>
      </div> --}}

    <div class="-color-picker-container" data-dominant-color="{{ $dominantColor }}">
        <h2>Select your clothes color</h2>
        <div class="-color-area" id="ColorArea"></div>
        <input type="range" class="-color-slider" id="ColorSlider" min="0" max="360" value="360">
        <div class="-color-display" id="ColorDisplay"></div>
        <div class="-hex-display" id="HexDisplay">HEX: {{ $dominantColor }}</div>
        <p style="display: none;" class="value">{{ $dominantColor }}</p>
    </div>
    

    <div class="bottomtop">
        <p>Top or Bottom</p>
        <div class="picktopbot">
            <form>
                <label for="top" class="labeltop">
                    <input type="radio" id="top" name="top" value="top">
                    <img src="Asset/detail/top.png" alt="Top" class="top">
                </label>
                <label for="bottom">
                    <input type="radio" id="bottom" name="top" value="bottom">
                    <img src="Asset/detail/bot.png" alt="Bottom" class="bottom">
                </label>
            </form>
        </div>
    </div>

    {{-- <div class="continue">
        <button type="submit" onclick="window.location.href='detailsTop'">Continue</button>
    </div> --}}
    <div class="continue">
        <button type="button" onclick="redirectToPage({{ $data->id }})">Continue</button>
    </div>

    </form>
    {{-- <script src="js/details.js"></script> --}}
    <script>
        function BackToWardrobe(){
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('UndoAddWardrobe') }}"; // Replace with your route name

            // Add CSRF Token (Required for Laravel POST requests)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            let methodInput = document.createElement("input");
            methodInput.type = "hidden";
            methodInput.name = "_method";
            methodInput.value = "DELETE";
            form.appendChild(methodInput);

            // Add test variable input
            let testInput = document.createElement("input");
            testInput.type = "hidden";
            testInput.name = "id";
            testInput.value = @json($data->id);
            form.appendChild(testInput);

            document.body.appendChild(form);
            form.submit();
        }
        function sendToControllerBottom(id,color) {
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('detailsBottom') }}"; // Replace with your route name

            // Add CSRF Token (Required for Laravel POST requests)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            // Add test variable input
            let testInput = document.createElement("input");
            testInput.type = "hidden";
            testInput.name = "id";
            testInput.value = id;
            form.appendChild(testInput);

            let testInputOne = document.createElement("input");
            testInputOne.type = "hidden";
            testInputOne.name = "color";
            testInputOne.value = color;
            form.appendChild(testInputOne);

            document.body.appendChild(form);
            form.submit();
        }
        function sendToControllerTop(id,color) {
            let form = document.createElement("form");
            form.method = "POST";
            form.action = "{{ route('detailsTop') }}"; // Replace with your route name

            // Add CSRF Token (Required for Laravel POST requests)
            let csrfToken = document.createElement("input");
            csrfToken.type = "hidden";
            csrfToken.name = "_token";
            csrfToken.value = "{{ csrf_token() }}";
            form.appendChild(csrfToken);

            // Add test variable input
            let testInput = document.createElement("input");
            testInput.type = "hidden";
            testInput.name = "id";
            testInput.value = id;
            form.appendChild(testInput);
            
            let testInputOne = document.createElement("input");
            testInputOne.type = "hidden";
            testInputOne.name = "color";
            testInputOne.value = color;
            form.appendChild(testInputOne);

            document.body.appendChild(form);
            form.submit();
        }
        function redirectToPage(id) {
        const selectedOption = document.querySelector('input[name="top"]:checked'); // Mendapatkan opsi yang dipilih

        if (!selectedOption) {
            // Jika tidak ada opsi yang dipilih, tampilkan peringatan
            alert('Please select "Top" or "Bottom" before continuing.');
        } else if (selectedOption.value === 'top') {
            // Jika opsi "Top" dipilih, pindah ke halaman detailsTop
            sendToControllerTop(id,document.querySelector('p.value').innerHTML);
        } else if (selectedOption.value === 'bottom') {
            // Jika opsi "Bottom" dipilih, pindah ke halaman detailsBottom
            // window.location.href = 'detailsBottom';
            sendToControllerBottom(id,document.querySelector('p.value').innerHTML);
        }
    }
    </script>
    <script src="js/color.js"></script>


</body>
</html>
